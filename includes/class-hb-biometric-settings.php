<?php
/**
 * Biometric (WebAuthn / passkey) settings — My Account endpoint.
 *
 * @package HelloElementorChild
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register and manage platform passkeys for faster return login on supported mobile devices.
 */
class Hb_Biometric_Settings {

	const TABLE_VERSION_OPTION = 'hb_passkeys_db_version';
	const TABLE_VERSION        = '1.0.0';
	const CHALLENGE_TTL        = 300;

	/**
	 * Bootstrap hooks.
	 *
	 * @return void
	 */
	public static function init() {
		add_action( 'init', array( __CLASS__, 'maybe_finish_passkey_login' ), 1 );
		add_action( 'init', array( __CLASS__, 'register_endpoint' ) );
		add_action( 'init', array( __CLASS__, 'maybe_create_table' ), 5 );
		add_filter( 'woocommerce_account_menu_items', array( __CLASS__, 'account_menu_item' ), 42 );
		add_action( 'woocommerce_account_biometric-login_endpoint', array( __CLASS__, 'render_endpoint' ) );

		add_action( 'wp_ajax_hb_biometric_register_begin', array( __CLASS__, 'ajax_register_begin' ) );
		add_action( 'wp_ajax_hb_biometric_register_complete', array( __CLASS__, 'ajax_register_complete' ) );
		add_action( 'wp_ajax_hb_biometric_remove', array( __CLASS__, 'ajax_remove' ) );

		add_action( 'wp_ajax_hb_biometric_login_begin', array( __CLASS__, 'ajax_login_begin' ) );
		add_action( 'wp_ajax_nopriv_hb_biometric_login_begin', array( __CLASS__, 'ajax_login_begin' ) );
		add_action( 'wp_ajax_hb_biometric_login_complete', array( __CLASS__, 'ajax_login_complete' ) );
		add_action( 'wp_ajax_nopriv_hb_biometric_login_complete', array( __CLASS__, 'ajax_login_complete' ) );

		add_action( 'woocommerce_before_customer_login_form', array( __CLASS__, 'render_guest_login_panel' ), 5 );
		add_action( 'hb_my_account_guest_login', array( __CLASS__, 'render_guest_login_panel' ) );

		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'enqueue_account_assets' ), 110 );
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'enqueue_guest_login_assets' ), 111 );
	}

	/**
	 * @return string
	 */
	public static function table_name() {
		global $wpdb;
		return $wpdb->prefix . 'hb_passkeys';
	}

	/**
	 * Create passkeys table when needed.
	 *
	 * @return void
	 */
	public static function maybe_create_table() {
		$installed = get_option( self::TABLE_VERSION_OPTION, '' );
		if ( self::TABLE_VERSION === $installed ) {
			return;
		}

		global $wpdb;
		$table           = self::table_name();
		$charset_collate = $wpdb->get_charset_collate();

		require_once ABSPATH . 'wp-admin/includes/upgrade.php';

		$sql = "CREATE TABLE {$table} (
			id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
			user_id bigint(20) unsigned NOT NULL,
			credential_id varchar(512) NOT NULL,
			credential_public_key longtext NOT NULL,
			sign_count bigint(20) unsigned NOT NULL DEFAULT 0,
			device_label varchar(191) NOT NULL DEFAULT '',
			attestation_format varchar(64) NOT NULL DEFAULT '',
			created_at datetime NOT NULL,
			last_used_at datetime DEFAULT NULL,
			PRIMARY KEY  (id),
			UNIQUE KEY credential_id (credential_id(191)),
			KEY user_id (user_id)
		) {$charset_collate};";

		dbDelta( $sql );
		update_option( self::TABLE_VERSION_OPTION, self::TABLE_VERSION, false );
		flush_rewrite_rules( false );
	}

	/**
	 * @return void
	 */
	public static function register_endpoint() {
		add_rewrite_endpoint( 'biometric-login', EP_ROOT | EP_PAGES );
	}

	/**
	 * @param array<string, string> $items Menu items.
	 * @return array<string, string>
	 */
	public static function account_menu_item( $items ) {
		if ( ! is_array( $items ) ) {
			return $items;
		}

		$new_items = array();
		$inserted  = false;
		foreach ( $items as $key => $label ) {
			$new_items[ $key ] = $label;
			if ( 'edit-account' === $key ) {
				$new_items['biometric-login'] = __( 'Biometric login', 'hello-elementor-child' );
				$inserted                     = true;
			}
		}

		if ( ! $inserted ) {
			$rebuilt = array();
			foreach ( $new_items as $key => $label ) {
				if ( 'customer-logout' === $key && ! $inserted ) {
					$rebuilt['biometric-login'] = __( 'Biometric login', 'hello-elementor-child' );
					$inserted                   = true;
				}
				$rebuilt[ $key ] = $label;
			}
			$new_items = $rebuilt;
		}

		if ( ! $inserted ) {
			$new_items['biometric-login'] = __( 'Biometric login', 'hello-elementor-child' );
		}

		return $new_items;
	}

	/**
	 * Whether the current user may manage passkeys.
	 *
	 * @return bool
	 */
	public static function user_can_manage_passkeys() {
		if ( ! is_user_logged_in() ) {
			return false;
		}

		if ( class_exists( 'Cpm_Humanblockchain_Device_Registry' )
			&& method_exists( 'Cpm_Humanblockchain_Device_Registry', 'current_user_has_activated_device' ) ) {
			return Cpm_Humanblockchain_Device_Registry::current_user_has_activated_device();
		}

		return true;
	}

	/**
	 * Relying party ID (registrable domain).
	 *
	 * @return string
	 */
	public static function get_rp_id() {
		$host = '';
		if ( ! empty( $_SERVER['HTTP_HOST'] ) ) {
			$host = strtolower( sanitize_text_field( wp_unslash( $_SERVER['HTTP_HOST'] ) ) );
			$host = preg_replace( '/:\d+$/', '', $host );
		}
		if ( '' === $host ) {
			$host = wp_parse_url( home_url(), PHP_URL_HOST );
			$host = is_string( $host ) ? strtolower( $host ) : '';
		}
		if ( str_starts_with( $host, 'www.' ) ) {
			$host = substr( $host, 4 );
		}
		return (string) apply_filters( 'hb_webauthn_rp_id', $host );
	}

	/**
	 * Read a base64url field from POST without stripping payload bytes.
	 *
	 * @param string $key POST key.
	 * @return string
	 */
	private static function get_post_base64url( $key ) {
		if ( ! isset( $_POST[ $key ] ) ) {
			return '';
		}
		$raw = wp_unslash( $_POST[ $key ] );
		if ( ! is_string( $raw ) ) {
			return '';
		}
		$raw = trim( $raw );
		if ( '' === $raw || ! preg_match( '/^[A-Za-z0-9_-]+$/', $raw ) ) {
			return '';
		}
		return $raw;
	}

	/**
	 * Prepare creation options for the browser (strip invalid extension keys).
	 *
	 * @param object $public_key PublicKeyCredentialCreationOptions partial.
	 * @return object
	 */
	private static function prepare_public_key_for_browser( $public_key ) {
		if ( ! is_object( $public_key ) ) {
			return $public_key;
		}
		if ( isset( $public_key->extensions ) ) {
			unset( $public_key->extensions );
		}
		$public_key->attestation = 'none';
		return $public_key;
	}

	/**
	 * @param int $user_id User ID.
	 * @return string
	 */
	private static function challenge_transient_key( $user_id ) {
		return 'hb_webauthn_challenge_' . (int) $user_id;
	}

	/**
	 * @param string $token Login session token.
	 * @return string
	 */
	private static function login_challenge_transient_key( $token ) {
		return 'hb_webauthn_login_' . preg_replace( '/[^a-zA-Z0-9]/', '', (string) $token );
	}

	/**
	 * Whether guest biometric login assets should load site-wide.
	 *
	 * @return bool
	 */
	public static function should_enqueue_guest_login_script() {
		if ( is_user_logged_in() || is_admin() ) {
			return false;
		}
		return (bool) apply_filters( 'hb_enqueue_biometric_guest_login', true );
	}

	/**
	 * Whether the current request is a guest sign-in page.
	 *
	 * @return bool
	 */
	public static function is_guest_login_context() {
		if ( is_user_logged_in() ) {
			return false;
		}
		if ( function_exists( 'is_account_page' ) && is_account_page() ) {
			return true;
		}
		if ( function_exists( 'is_page_template' ) && is_page_template( 'templates-parts/template-my-account.php' ) ) {
			return true;
		}
		return (bool) apply_filters( 'hb_enqueue_biometric_guest_login', false );
	}

	/**
	 * Whether a user may sign in with a saved passkey.
	 *
	 * @param int $user_id User ID.
	 * @return bool
	 */
	private static function user_can_login_with_passkey( $user_id ) {
		$user_id = (int) $user_id;
		if ( $user_id <= 0 ) {
			return false;
		}
		if ( class_exists( 'Cpm_Humanblockchain_Device_Registry' )
			&& method_exists( 'Cpm_Humanblockchain_Device_Registry', 'user_has_activated_device' ) ) {
			return Cpm_Humanblockchain_Device_Registry::user_has_activated_device( $user_id );
		}
		return true;
	}

	/**
	 * Find WordPress user ID from a registered device phone number.
	 *
	 * @param string $mobile_raw Raw phone input.
	 * @return int
	 */
	private static function find_user_id_by_phone( $mobile_raw ) {
		$mobile_raw = trim( (string) $mobile_raw );
		if ( '' === $mobile_raw || ! class_exists( 'Cpm_Humanblockchain_Otp_Service' ) ) {
			return 0;
		}

		global $wpdb;
		$table        = $wpdb->prefix . 'nwp_devices';
		$variants     = Cpm_Humanblockchain_Otp_Service::get_phone_match_variants( $mobile_raw );
		$last10       = Cpm_Humanblockchain_Otp_Service::get_phone_last_national_digits_for_match( $mobile_raw );
		$placeholders = array();
		$values       = array();
		$digits_expr  = "REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(phone, '+', ''), ' ', ''), '-', ''), '(', ''), ')', '')";

		foreach ( $variants as $variant ) {
			$placeholders[] = "{$digits_expr} = %s";
			$values[]       = preg_replace( '/\D/', '', (string) $variant );
		}
		if ( $last10 ) {
			$placeholders[] = "RIGHT({$digits_expr}, 10) = %s";
			$values[]       = $last10;
		}
		if ( empty( $placeholders ) ) {
			return 0;
		}

		$sql = "SELECT user_id FROM {$table} WHERE phone IS NOT NULL AND phone != '' AND user_id > 0 AND ("
			. implode( ' OR ', $placeholders )
			. ') ORDER BY updated_at DESC, id DESC LIMIT 1';

		// phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared -- placeholders built above.
		$user_id = $wpdb->get_var( $wpdb->prepare( $sql, $values ) );
		return $user_id ? (int) $user_id : 0;
	}

	/**
	 * @param int $user_id User ID.
	 * @return array<int, string>
	 */
	private static function get_allow_credential_ids_for_user( $user_id ) {
		global $wpdb;
		$user_id = (int) $user_id;
		if ( $user_id <= 0 ) {
			return array();
		}

		$rows = $wpdb->get_col(
			$wpdb->prepare(
				"SELECT credential_id FROM " . self::table_name() . ' WHERE user_id = %d',
				$user_id
			)
		);
		if ( ! is_array( $rows ) ) {
			return array();
		}

		$ids = array();
		foreach ( $rows as $cred_id_b64 ) {
			$raw = base64_decode( (string) $cred_id_b64, true );
			if ( false !== $raw && '' !== $raw ) {
				$ids[] = $raw;
			}
		}
		return $ids;
	}

	/**
	 * @param string $cred_id_b64 Standard base64 credential id.
	 * @return object|null
	 */
	private static function get_passkey_by_credential_id( $cred_id_b64 ) {
		global $wpdb;
		$cred_id_b64 = (string) $cred_id_b64;
		if ( '' === $cred_id_b64 ) {
			return null;
		}

		self::maybe_create_table();
		$row = $wpdb->get_row(
			$wpdb->prepare(
				'SELECT * FROM ' . self::table_name() . ' WHERE credential_id = %s LIMIT 1',
				$cred_id_b64
			)
		);
		return $row ? $row : null;
	}

	/**
	 * Find a passkey row from raw credential id bytes (tries common encodings).
	 *
	 * @param string $cred_raw Raw credential id bytes.
	 * @return object|null
	 */
	private static function find_passkey_by_credential_raw( $cred_raw ) {
		$cred_raw = (string) $cred_raw;
		if ( '' === $cred_raw ) {
			return null;
		}

		$variants = array(
			base64_encode( $cred_raw ),
			rtrim( strtr( base64_encode( $cred_raw ), '+/', '-_' ), '=' ),
		);

		foreach ( array_unique( $variants ) as $variant ) {
			$row = self::get_passkey_by_credential_id( $variant );
			if ( $row ) {
				return $row;
			}
		}

		return null;
	}

	/**
	 * @param string $token Login token.
	 * @param array<string, mixed> $data Session payload.
	 * @return void
	 */
	private static function store_login_challenge( $token, array $data ) {
		set_transient( self::login_challenge_transient_key( $token ), $data, self::CHALLENGE_TTL );
	}

	/**
	 * @param string $token Login token.
	 * @return array<string, mixed>|false
	 */
	private static function get_login_challenge( $token ) {
		$stored = get_transient( self::login_challenge_transient_key( $token ) );
		return is_array( $stored ) ? $stored : false;
	}

	/**
	 * @param string $token Login token.
	 * @return void
	 */
	private static function clear_login_challenge( $token ) {
		delete_transient( self::login_challenge_transient_key( $token ) );
	}

	/**
	 * Verify guest login AJAX nonce or return JSON error.
	 *
	 * @return void
	 */
	private static function verify_login_ajax_nonce() {
		if ( ! check_ajax_referer( 'hb_biometric_login', 'nonce', false ) ) {
			wp_send_json_error(
				array(
					'message' => __( 'Session expired. Reload this page and try again.', 'hello-elementor-child' ),
				),
				403
			);
		}
	}

	/**
	 * Redirect URL after successful biometric login.
	 *
	 * @return string
	 */
	private static function login_redirect_url() {
		$redirect = '';
		if ( isset( $_POST['redirect_to'] ) ) {
			$redirect = wp_validate_redirect(
				esc_url_raw( wp_unslash( $_POST['redirect_to'] ) ),
				''
			);
		}
		if ( '' === $redirect && class_exists( 'Cpm_Humanblockchain_Public' ) && method_exists( 'Cpm_Humanblockchain_Public', 'get_my_account_page_url' ) ) {
			$redirect = Cpm_Humanblockchain_Public::get_my_account_page_url();
		}
		if ( '' === $redirect && function_exists( 'wc_get_page_permalink' ) ) {
			$redirect = wc_get_page_permalink( 'myaccount' );
		}
		if ( ! is_string( $redirect ) || '' === $redirect ) {
			$redirect = home_url( '/my-account/' );
		}
		return (string) apply_filters( 'hb_biometric_login_redirect', $redirect );
	}

	/**
	 * Set WordPress (and WooCommerce) auth cookies for a user.
	 *
	 * @param int $user_id User ID.
	 * @return void
	 */
	private static function establish_user_session( $user_id ) {
		$user_id = (int) $user_id;
		if ( $user_id <= 0 ) {
			return;
		}

		$user = get_user_by( 'id', $user_id );
		if ( ! $user ) {
			return;
		}

		wp_set_current_user( $user_id );
		wp_set_auth_cookie( $user_id, true, is_ssl() );
		if ( function_exists( 'wc_set_customer_auth_cookie' ) ) {
			wc_set_customer_auth_cookie( $user_id );
		}
		do_action( 'wp_login', $user->user_login, $user );
	}

	/**
	 * One-time redirect token so login cookies are set on a normal page load (not admin-ajax).
	 *
	 * @param int $user_id User ID.
	 * @return string
	 */
	private static function create_passkey_finish_token( $user_id ) {
		$token = wp_generate_password( 32, false, false );
		set_transient( 'hb_passkey_finish_' . $token, (int) $user_id, 60 );
		return $token;
	}

	/**
	 * Complete passkey login after redirect from biometric verification.
	 *
	 * @return void
	 */
	public static function maybe_finish_passkey_login() {
		if ( is_user_logged_in() ) {
			return;
		}

		$token = isset( $_GET['hb_passkey_finish'] ) ? sanitize_text_field( wp_unslash( $_GET['hb_passkey_finish'] ) ) : '';
		if ( '' === $token ) {
			return;
		}

		$user_id = get_transient( 'hb_passkey_finish_' . $token );
		delete_transient( 'hb_passkey_finish_' . $token );

		if ( ! is_numeric( $user_id ) || (int) $user_id <= 0 ) {
			return;
		}

		self::establish_user_session( (int) $user_id );

		$redirect = remove_query_arg( 'hb_passkey_finish' );
		if ( ! is_string( $redirect ) || '' === $redirect ) {
			if ( class_exists( 'Cpm_Humanblockchain_Public' ) && method_exists( 'Cpm_Humanblockchain_Public', 'get_my_account_page_url' ) ) {
				$redirect = Cpm_Humanblockchain_Public::get_my_account_page_url();
			} else {
				$redirect = home_url( '/my-account/' );
			}
		}

		wp_safe_redirect( $redirect );
		exit;
	}

	/**
	 * Verify WebAuthn assertion without strict sign-count checks (platform passkeys).
	 *
	 * @param string $client_data_json Client data JSON.
	 * @param string $auth_data Authenticator data bytes.
	 * @param string $signature Signature bytes.
	 * @param string $credential_public_key PEM public key.
	 * @param string $challenge_raw Expected challenge bytes.
	 * @return bool
	 */
	private static function process_get_lenient( $client_data_json, $auth_data, $signature, $credential_public_key, $challenge_raw ) {
		if ( ! class_exists( '\lbuchs\WebAuthn\Attestation\AuthenticatorData' )
			|| ! class_exists( '\lbuchs\WebAuthn\Binary\ByteBuffer' ) ) {
			return false;
		}

		$client_data = json_decode( $client_data_json );
		if ( ! is_object( $client_data )
			|| ! isset( $client_data->type, $client_data->challenge, $client_data->origin )
			|| 'webauthn.get' !== $client_data->type ) {
			return false;
		}

		$challenge_buf = \lbuchs\WebAuthn\Binary\ByteBuffer::fromBase64Url( $client_data->challenge );
		$expected      = $challenge_buf instanceof \lbuchs\WebAuthn\Binary\ByteBuffer
			? $challenge_buf->getBinaryString()
			: '';
		$stored        = $challenge_raw instanceof \lbuchs\WebAuthn\Binary\ByteBuffer
			? $challenge_raw->getBinaryString()
			: (string) $challenge_raw;

		if ( $expected !== $stored ) {
			return false;
		}

		$origin_host = wp_parse_url( $client_data->origin, PHP_URL_HOST );
		$origin_host = is_string( $origin_host ) ? strtolower( trim( $origin_host, '.' ) ) : '';
		$rp_id       = strtolower( self::get_rp_id() );
		if ( '' === $origin_host || ! ( $origin_host === $rp_id || str_ends_with( $origin_host, '.' . $rp_id ) ) ) {
			return false;
		}

		if ( ! is_string( $credential_public_key ) || '' === trim( $credential_public_key ) ) {
			return false;
		}

		try {
			$auth_obj = new \lbuchs\WebAuthn\Attestation\AuthenticatorData( $auth_data );
		} catch ( Throwable $e ) {
			return false;
		}

		if ( $auth_obj->getRpIdHash() !== hash( 'sha256', self::get_rp_id(), true ) ) {
			return false;
		}

		if ( ! $auth_obj->getUserPresent() || ! $auth_obj->getUserVerified() ) {
			return false;
		}

		$data_to_verify  = $auth_data;
		$data_to_verify .= hash( 'sha256', $client_data_json, true );

		$public_key = openssl_pkey_get_public( $credential_public_key );
		if ( false === $public_key ) {
			return false;
		}

		$verified = openssl_verify( $data_to_verify, $signature, $public_key, OPENSSL_ALGO_SHA256 );
		return 1 === $verified;
	}

	/**
	 * Load WebAuthn server library.
	 *
	 * @return \lbuchs\WebAuthn\WebAuthn|null
	 */
	private static function webauthn_server() {
		$autoload = get_stylesheet_directory() . '/vendor/autoload.php';
		if ( ! file_exists( $autoload ) ) {
			return null;
		}
		require_once $autoload;

		if ( ! class_exists( '\lbuchs\WebAuthn\WebAuthn' ) ) {
			return null;
		}

		try {
			$formats = array( 'none', 'packed', 'apple', 'android-key', 'android-safetynet', 'tpm' );
			$server  = new \lbuchs\WebAuthn\WebAuthn(
				apply_filters( 'hb_webauthn_rp_name', get_bloginfo( 'name' ) ?: 'Human Blockchain' ),
				self::get_rp_id(),
				$formats,
				true
			);

			$cert_dir = get_stylesheet_directory() . '/vendor/lbuchs/webauthn/_test/rootCertificates';
			if ( is_dir( $cert_dir ) ) {
				$server->addRootCertificates( $cert_dir );
			}

			return $server;
		} catch ( Exception $e ) {
			return null;
		}
	}

	/**
	 * @param int $user_id User ID.
	 * @return array<int, object>
	 */
	public static function get_passkeys_for_user( $user_id ) {
		global $wpdb;
		$user_id = (int) $user_id;
		if ( $user_id <= 0 ) {
			return array();
		}

		$table = self::table_name();
		if ( $wpdb->get_var( $wpdb->prepare( 'SHOW TABLES LIKE %s', $table ) ) !== $table ) {
			return array();
		}

		$rows = $wpdb->get_results(
			$wpdb->prepare(
				"SELECT id, device_label, attestation_format, created_at, last_used_at FROM {$table} WHERE user_id = %d ORDER BY created_at DESC",
				$user_id
			)
		);

		return is_array( $rows ) ? $rows : array();
	}

	/**
	 * Extract raw credential id bytes from processCreate result.
	 *
	 * @param mixed $credential_id Credential id from WebAuthn library.
	 * @return string
	 */
	private static function credential_id_to_raw( $credential_id ) {
		if ( $credential_id instanceof \lbuchs\WebAuthn\Binary\ByteBuffer ) {
			return $credential_id->getBinaryString();
		}
		return (string) $credential_id;
	}

	/**
	 * Lenient registration fallback when strict attestation validation fails (common on Apple passkeys).
	 *
	 * @param \lbuchs\WebAuthn\WebAuthn $server WebAuthn server.
	 * @param string                    $client_data_json Client data JSON.
	 * @param string                    $attestation_object Attestation object bytes.
	 * @param string                    $challenge_raw Challenge bytes.
	 * @return \stdClass|null
	 */
	private static function process_create_lenient( $server, $client_data_json, $attestation_object, $challenge_raw ) {
		if ( ! class_exists( '\lbuchs\WebAuthn\CBOR\CborDecoder' )
			|| ! class_exists( '\lbuchs\WebAuthn\Attestation\AuthenticatorData' )
			|| ! class_exists( '\lbuchs\WebAuthn\Binary\ByteBuffer' ) ) {
			return null;
		}

		$client_data = json_decode( $client_data_json );
		if ( ! is_object( $client_data )
			|| ! isset( $client_data->type, $client_data->challenge, $client_data->origin )
			|| 'webauthn.create' !== $client_data->type ) {
			return null;
		}

		$challenge_buf = \lbuchs\WebAuthn\Binary\ByteBuffer::fromBase64Url( $client_data->challenge );
		$expected      = $challenge_buf instanceof \lbuchs\WebAuthn\Binary\ByteBuffer
			? $challenge_buf->getBinaryString()
			: '';
		$stored        = $challenge_raw instanceof \lbuchs\WebAuthn\Binary\ByteBuffer
			? $challenge_raw->getBinaryString()
			: (string) $challenge_raw;

		if ( $expected !== $stored ) {
			return null;
		}

		try {
			$decoded = \lbuchs\WebAuthn\CBOR\CborDecoder::decode( $attestation_object );
		} catch ( Exception $e ) {
			return null;
		}

		if ( ! is_array( $decoded )
			|| empty( $decoded['authData'] )
			|| ! ( $decoded['authData'] instanceof \lbuchs\WebAuthn\Binary\ByteBuffer ) ) {
			return null;
		}

		try {
			$auth_data = new \lbuchs\WebAuthn\Attestation\AuthenticatorData( $decoded['authData']->getBinaryString() );
		} catch ( Exception $e ) {
			return null;
		}

		$rp_id_hash = hash( 'sha256', self::get_rp_id(), true );
		if ( $auth_data->getRpIdHash() !== $rp_id_hash ) {
			return null;
		}

		if ( ! $auth_data->getUserVerified() ) {
			return null;
		}

		try {
			$credential_id     = $auth_data->getCredentialId();
			$credential_pubkey = $auth_data->getPublicKeyPem();
		} catch ( Exception $e ) {
			return null;
		}

		$data                     = new \stdClass();
		$data->credentialId       = $credential_id;
		$data->credentialPublicKey = $credential_pubkey;
		$data->signatureCounter   = $auth_data->getSignCount() > 0 ? $auth_data->getSignCount() : null;
		$data->attestationFormat  = isset( $decoded['fmt'] ) ? (string) $decoded['fmt'] : 'none';

		return $data;
	}

	/**
	 * @param int $user_id User ID.
	 * @return array<int, string>
	 */
	private static function get_exclude_credential_ids( $user_id ) {
		global $wpdb;
		$table = self::table_name();
		$rows  = $wpdb->get_col(
			$wpdb->prepare(
				"SELECT credential_id FROM {$table} WHERE user_id = %d",
				(int) $user_id
			)
		);
		if ( ! is_array( $rows ) ) {
			return array();
		}

		$exclude = array();
		foreach ( $rows as $cred_id_b64 ) {
			$raw = base64_decode( (string) $cred_id_b64, true );
			if ( false !== $raw && '' !== $raw ) {
				$exclude[] = $raw;
			}
		}
		return $exclude;
	}

	/**
	 * @return void
	 */
	public static function ajax_register_begin() {
		self::verify_ajax_nonce();

		if ( ! self::user_can_manage_passkeys() ) {
			wp_send_json_error(
				array(
					'message' => __( 'Verify your phone with OTP and activate your device before enabling biometric login.', 'hello-elementor-child' ),
				),
				403
			);
		}

		$server = self::webauthn_server();
		if ( ! $server ) {
			$autoload = get_stylesheet_directory() . '/vendor/autoload.php';
			$message  = file_exists( $autoload )
				? __( 'Biometric login could not start on the server. Contact support.', 'hello-elementor-child' )
				: __( 'Biometric login library is missing on the server. Deploy the theme vendor folder or run composer install.', 'hello-elementor-child' );
			wp_send_json_error( array( 'message' => $message ), 500 );
		}

		$user    = wp_get_current_user();
		$user_id = (int) $user->ID;
		$hex_id  = sprintf( '%016x', $user_id );

		try {
			$args = $server->getCreateArgs(
				hex2bin( $hex_id ),
				$user->user_login,
				$user->display_name ?: $user->user_login,
				120,
				true,
				'required',
				false,
				self::get_exclude_credential_ids( $user_id )
			);
		} catch ( Exception $e ) {
			wp_send_json_error( array( 'message' => $e->getMessage() ), 500 );
		}

		$challenge = $server->getChallenge();
		if ( $challenge ) {
			self::store_registration_challenge( $user_id, base64_encode( $challenge->getBinaryString() ) );
		}

		wp_send_json_success(
			array(
				'publicKey' => self::prepare_public_key_for_browser( $args->publicKey ),
				'rpId'      => self::get_rp_id(),
			)
		);
	}

	/**
	 * @return void
	 */
	public static function ajax_register_complete() {
		self::verify_ajax_nonce();

		if ( ! self::user_can_manage_passkeys() ) {
			wp_send_json_error(
				array(
					'message' => __( 'Verify your phone with OTP and activate your device before enabling biometric login.', 'hello-elementor-child' ),
				),
				403
			);
		}

		$server = self::webauthn_server();
		if ( ! $server ) {
			wp_send_json_error(
				array(
					'message' => __( 'Biometric login is not available on this site right now.', 'hello-elementor-child' ),
				),
				500
			);
		}

		$user_id = get_current_user_id();
		$stored  = self::get_registration_challenge( $user_id );
		if ( ! $stored ) {
			wp_send_json_error(
				array(
					'message' => __( 'Your setup session expired. Please try again.', 'hello-elementor-child' ),
				),
				400
			);
		}

		$client_data_b64    = self::get_post_base64url( 'clientDataJSON' );
		$attestation_b64    = self::get_post_base64url( 'attestationObject' );
		$device_label       = isset( $_POST['device_label'] ) ? sanitize_text_field( wp_unslash( $_POST['device_label'] ) ) : '';
		$client_data_json   = self::base64url_decode( $client_data_b64 );
		$attestation_object = self::base64url_decode( $attestation_b64 );

		if ( false === $client_data_json || false === $attestation_object ) {
			wp_send_json_error(
				array(
					'message' => __( 'Invalid biometric response from your device.', 'hello-elementor-child' ),
				),
				400
			);
		}

		$challenge_raw = base64_decode( $stored, true );
		if ( false === $challenge_raw ) {
			wp_send_json_error(
				array(
					'message' => __( 'Could not validate setup session.', 'hello-elementor-child' ),
				),
				400
			);
		}

		try {
			$data = $server->processCreate(
				$client_data_json,
				$attestation_object,
				$challenge_raw,
				true,
				true,
				false,
				false
			);
		} catch ( Throwable $e ) {
			$data = self::process_create_lenient( $server, $client_data_json, $attestation_object, $challenge_raw );
			if ( ! $data ) {
				wp_send_json_error(
					array(
						'message' => $e->getMessage() ?: __( 'Biometric verification failed.', 'hello-elementor-child' ),
					),
					400
				);
			}
		}

		self::clear_registration_challenge( $user_id );

		$cred_id_b64 = base64_encode( self::credential_id_to_raw( $data->credentialId ) );
		if ( '' === $device_label ) {
			$device_label = self::default_device_label();
		}

		self::maybe_create_table();
		global $wpdb;
		$inserted = $wpdb->insert(
			self::table_name(),
			array(
				'user_id'                => $user_id,
				'credential_id'          => $cred_id_b64,
				'credential_public_key'  => (string) $data->credentialPublicKey,
				'sign_count'             => isset( $data->signatureCounter ) ? (int) $data->signatureCounter : 0,
				'device_label'           => $device_label,
				'attestation_format'     => (string) $data->attestationFormat,
				'created_at'             => current_time( 'mysql' ),
			),
			array( '%d', '%s', '%s', '%d', '%s', '%s', '%s' )
		);

		if ( ! $inserted ) {
			wp_send_json_error(
				array(
					'message' => __( 'Could not save biometric login for this device.', 'hello-elementor-child' ) . ( $wpdb->last_error ? ' (' . $wpdb->last_error . ')' : '' ),
				),
				500
			);
		}

		wp_send_json_success(
			array(
				'message'      => __( 'Biometric login enabled on this device.', 'hello-elementor-child' ),
				'passkey_id'   => (int) $wpdb->insert_id,
				'device_label' => $device_label,
				'created_at'   => mysql2date( get_option( 'date_format' ), current_time( 'mysql' ) ),
			)
		);
	}

	/**
	 * @return void
	 */
	public static function ajax_remove() {
		self::verify_ajax_nonce();

		if ( ! is_user_logged_in() ) {
			wp_send_json_error( array( 'message' => __( 'You must be logged in.', 'hello-elementor-child' ) ), 403 );
		}

		$passkey_id = isset( $_POST['passkey_id'] ) ? absint( $_POST['passkey_id'] ) : 0;
		if ( $passkey_id <= 0 ) {
			wp_send_json_error( array( 'message' => __( 'Invalid passkey.', 'hello-elementor-child' ) ), 400 );
		}

		global $wpdb;
		$deleted = $wpdb->delete(
			self::table_name(),
			array(
				'id'      => $passkey_id,
				'user_id' => get_current_user_id(),
			),
			array( '%d', '%d' )
		);

		if ( ! $deleted ) {
			wp_send_json_error( array( 'message' => __( 'Could not remove biometric login.', 'hello-elementor-child' ) ), 400 );
		}

		wp_send_json_success(
			array(
				'message' => __( 'Biometric login removed.', 'hello-elementor-child' ),
			)
		);
	}

	/**
	 * Begin WebAuthn authentication (guest or logged-in).
	 *
	 * @return void
	 */
	public static function ajax_login_begin() {
		self::verify_login_ajax_nonce();

		$server = self::webauthn_server();
		if ( ! $server ) {
			wp_send_json_error(
				array(
					'message' => __( 'Biometric login is not available on this site right now.', 'hello-elementor-child' ),
				),
				500
			);
		}

		$phone_raw = isset( $_POST['phone'] ) ? sanitize_text_field( wp_unslash( $_POST['phone'] ) ) : '';
		$user_id   = 0;
		$cred_ids  = array();

		if ( '' !== $phone_raw ) {
			$user_id = self::find_user_id_by_phone( $phone_raw );
			if ( $user_id <= 0 ) {
				wp_send_json_error(
					array(
						'message' => __( 'This number is not registered. Sign in with OTP after registering your device.', 'hello-elementor-child' ),
					),
					404
				);
			}
			if ( ! self::user_can_login_with_passkey( $user_id ) ) {
				wp_send_json_error(
					array(
						'message' => __( 'Activate your device with OTP before using biometric login.', 'hello-elementor-child' ),
					),
					403
				);
			}
			$cred_ids = self::get_allow_credential_ids_for_user( $user_id );
			if ( empty( $cred_ids ) ) {
				wp_send_json_error(
					array(
						'message' => __( 'Biometric login is not set up for this account. Enable it in My Account after signing in with OTP.', 'hello-elementor-child' ),
					),
					404
				);
			}
		}

		try {
			$args = $server->getGetArgs( $cred_ids, 120, true, true, true, true, true, 'required' );
		} catch ( Exception $e ) {
			wp_send_json_error( array( 'message' => $e->getMessage() ), 500 );
		}

		$challenge = $server->getChallenge();
		if ( ! $challenge ) {
			wp_send_json_error(
				array(
					'message' => __( 'Could not start biometric login.', 'hello-elementor-child' ),
				),
				500
			);
		}

		$token = wp_generate_password( 32, false, false );
		self::store_login_challenge(
			$token,
			array(
				'challenge_b64' => base64_encode( $challenge->getBinaryString() ),
				'user_id_hint'  => $user_id,
				'mode'          => '' !== $phone_raw ? 'phone' : 'discoverable',
			)
		);

		wp_send_json_success(
			array(
				'publicKey'  => $args->publicKey,
				'loginToken' => $token,
				'rpId'       => self::get_rp_id(),
			)
		);
	}

	/**
	 * Complete WebAuthn authentication and sign the user in.
	 *
	 * @return void
	 */
	public static function ajax_login_complete() {
		self::verify_login_ajax_nonce();

		$server = self::webauthn_server();
		if ( ! $server ) {
			wp_send_json_error(
				array(
					'message' => __( 'Biometric login is not available on this site right now.', 'hello-elementor-child' ),
				),
				500
			);
		}

		$token = isset( $_POST['login_token'] ) ? sanitize_text_field( wp_unslash( $_POST['login_token'] ) ) : '';
		if ( '' === $token ) {
			wp_send_json_error(
				array(
					'message' => __( 'Login session expired. Please try again.', 'hello-elementor-child' ),
				),
				400
			);
		}

		$stored = self::get_login_challenge( $token );
		if ( ! $stored || empty( $stored['challenge_b64'] ) ) {
			wp_send_json_error(
				array(
					'message' => __( 'Login session expired. Please try again.', 'hello-elementor-child' ),
				),
				400
			);
		}

		$cred_id_b64url   = self::get_post_base64url( 'id' );
		$client_data_b64  = self::get_post_base64url( 'clientDataJSON' );
		$auth_data_b64    = self::get_post_base64url( 'authenticatorData' );
		$signature_b64    = self::get_post_base64url( 'signature' );
		$client_data_json = self::base64url_decode( $client_data_b64 );
		$auth_data        = self::base64url_decode( $auth_data_b64 );
		$signature        = self::base64url_decode( $signature_b64 );
		$cred_raw         = self::base64url_decode( $cred_id_b64url );

		if ( false === $client_data_json || false === $auth_data || false === $signature || false === $cred_raw ) {
			wp_send_json_error(
				array(
					'message' => __( 'Invalid biometric response from your device.', 'hello-elementor-child' ),
				),
				400
			);
		}

		$cred_id_b64  = base64_encode( $cred_raw );
		$passkey_row  = self::find_passkey_by_credential_raw( $cred_raw );
		if ( ! $passkey_row ) {
			wp_send_json_error(
				array(
					'message' => __( 'This biometric login is not registered on this site. Sign in with your number + OTP, then re-enable biometric login in My Account.', 'hello-elementor-child' ),
				),
				404
			);
		}

		$user_id = (int) $passkey_row->user_id;

		if ( ! self::user_can_login_with_passkey( $user_id ) ) {
			wp_send_json_error(
				array(
					'message' => __( 'Activate your device with OTP before using biometric login.', 'hello-elementor-child' ),
				),
				403
			);
		}

		$challenge_raw = base64_decode( (string) $stored['challenge_b64'], true );
		if ( false === $challenge_raw ) {
			wp_send_json_error(
				array(
					'message' => __( 'Could not validate login session.', 'hello-elementor-child' ),
				),
				400
			);
		}

		// Platform passkeys (Touch ID / iCloud) often use a fixed signCount of 0 — skip counter validation.
		$prev_sign_count = null;
		$verified          = false;

		try {
			$verified = $server->processGet(
				$client_data_json,
				$auth_data,
				$signature,
				(string) $passkey_row->credential_public_key,
				$challenge_raw,
				$prev_sign_count,
				true,
				true
			);
		} catch ( Throwable $e ) {
			$verified = self::process_get_lenient(
				$client_data_json,
				$auth_data,
				$signature,
				(string) $passkey_row->credential_public_key,
				$challenge_raw
			);
			if ( ! $verified ) {
				wp_send_json_error(
					array(
						'message' => $e->getMessage() ?: __( 'Biometric verification failed.', 'hello-elementor-child' ),
					),
					400
				);
			}
		}

		if ( ! $verified ) {
			wp_send_json_error(
				array(
					'message' => __( 'Biometric verification failed.', 'hello-elementor-child' ),
				),
				400
			);
		}

		self::clear_login_challenge( $token );

		$new_sign_count = $server->getSignatureCounter();
		global $wpdb;
		$wpdb->update(
			self::table_name(),
			array(
				'sign_count'   => null !== $new_sign_count ? (int) $new_sign_count : (int) $passkey_row->sign_count,
				'last_used_at' => current_time( 'mysql' ),
			),
			array( 'id' => (int) $passkey_row->id ),
			array( '%d', '%s' ),
			array( '%d' )
		);

		$user = get_user_by( 'id', $user_id );
		if ( ! $user ) {
			wp_send_json_error(
				array(
					'message' => __( 'Account not found.', 'hello-elementor-child' ),
				),
				404
			);
		}

		$finish_token = self::create_passkey_finish_token( $user_id );
		$redirect     = add_query_arg( 'hb_passkey_finish', $finish_token, self::login_redirect_url() );

		if ( ! headers_sent() ) {
			nocache_headers();
		}

		wp_send_json_success(
			array(
				'message'  => __( 'Signed in successfully.', 'hello-elementor-child' ),
				'redirect' => $redirect,
			)
		);
	}

	/**
	 * Guest sign-in panel (Face ID / Touch ID + OTP fallback).
	 *
	 * @return void
	 */
	public static function render_guest_login_panel() {
		if ( ! self::is_guest_login_context() ) {
			return;
		}
		static $rendered = false;
		if ( $rendered ) {
			return;
		}
		$rendered = true;
		?>
		<div class="hb-biometric-login hb-biometric-login--guest" id="hb-biometric-login-guest" hidden>
			<div class="hb-biometric-login__card">
				<h2 class="hb-biometric-login__title"><?php esc_html_e( 'Sign in faster', 'hello-elementor-child' ); ?></h2>
				<p class="hb-biometric-login__intro">
					<?php esc_html_e( 'Use Face ID, Touch ID, or fingerprint if you already enabled biometric login on this device. OTP remains available for new devices.', 'hello-elementor-child' ); ?>
				</p>
				<button type="button" class="button hb-biometric-login__btn" id="hb-biometric-login-btn">
					<?php esc_html_e( 'Sign in with Face ID / Touch ID', 'hello-elementor-child' ); ?>
				</button>
				<button type="button" class="button hb-biometric-login__btn hb-biometric-login__btn--secondary" id="hb-biometric-login-otp-btn">
					<?php esc_html_e( 'Sign in with number + OTP', 'hello-elementor-child' ); ?>
				</button>
				<p class="hb-biometric-login__feedback" id="hb-biometric-login-feedback" role="status" aria-live="polite"></p>
			</div>
		</div>
		<?php
	}

	/**
	 * Enqueue guest biometric login assets.
	 *
	 * @return void
	 */
	public static function enqueue_guest_login_assets() {
		if ( ! self::should_enqueue_guest_login_script() ) {
			return;
		}

		$css_path = get_stylesheet_directory() . '/assets/css/hb-biometric-settings.css';
		$js_path  = get_stylesheet_directory() . '/assets/js/hb-biometric-login.js';

		wp_enqueue_style(
			'hb-biometric-settings',
			get_stylesheet_directory_uri() . '/assets/css/hb-biometric-settings.css',
			array(),
			file_exists( $css_path ) ? filemtime( $css_path ) : HELLO_ELEMENTOR_CHILD_VERSION
		);

		$deps = array( 'jquery' );
		if ( wp_script_is( 'cpm-humanblockchain', 'registered' ) ) {
			$deps[] = 'cpm-humanblockchain';
		}

		wp_enqueue_script(
			'hb-biometric-login',
			get_stylesheet_directory_uri() . '/assets/js/hb-biometric-login.js',
			$deps,
			file_exists( $js_path ) ? filemtime( $js_path ) : HELLO_ELEMENTOR_CHILD_VERSION,
			true
		);

		$my_account_url = home_url( '/my-account/' );
		if ( class_exists( 'Cpm_Humanblockchain_Public' ) && method_exists( 'Cpm_Humanblockchain_Public', 'get_my_account_page_url' ) ) {
			$my_account_url = Cpm_Humanblockchain_Public::get_my_account_page_url();
		} elseif ( function_exists( 'wc_get_page_permalink' ) ) {
			$my_account_url = wc_get_page_permalink( 'myaccount' );
		}

		wp_localize_script(
			'hb-biometric-login',
			'hbBiometricLogin',
			array(
				'ajaxUrl'          => admin_url( 'admin-ajax.php' ),
				'nonce'            => wp_create_nonce( 'hb_biometric_login' ),
				'loginBegin'       => 'hb_biometric_login_begin',
				'loginComplete'    => 'hb_biometric_login_complete',
				'myAccountUrl'     => $my_account_url,
				'autoPromptOnLoad' => self::is_guest_login_context(),
				'i18n'             => array(
					'unsupported'    => __( 'Biometric login is not available on this device or browser. Use your number + OTP.', 'hello-elementor-child' ),
					'signingIn'      => __( 'Waiting for biometric confirmation…', 'hello-elementor-child' ),
					'loginBtn'       => __( 'Sign in with Face ID / Touch ID', 'hello-elementor-child' ),
					'otpBtn'         => __( 'Sign in with number + OTP', 'hello-elementor-child' ),
					'orUseOtp'       => __( 'or use your number', 'hello-elementor-child' ),
					'errorGeneric'   => __( 'Something went wrong. Please try again or use your number + OTP.', 'hello-elementor-child' ),
					'httpsRequired'  => __( 'Biometric login requires a secure (HTTPS) connection.', 'hello-elementor-child' ),
					'sessionExpired' => __( 'Session expired. Reload this page and try again.', 'hello-elementor-child' ),
					'cancelled'      => __( 'Biometric sign-in was cancelled.', 'hello-elementor-child' ),
				),
			)
		);
	}

	/**
	 * Verify AJAX nonce or return JSON error.
	 *
	 * @return void
	 */
	private static function verify_ajax_nonce() {
		if ( ! check_ajax_referer( 'hb_biometric_settings', 'nonce', false ) ) {
			wp_send_json_error(
				array(
					'message' => __( 'Session expired. Reload this page and try again.', 'hello-elementor-child' ),
				),
				403
			);
		}
	}

	/**
	 * Persist registration challenge for the current user.
	 *
	 * @param int    $user_id User ID.
	 * @param string $challenge_b64 Base64-encoded challenge bytes.
	 * @return void
	 */
	private static function store_registration_challenge( $user_id, $challenge_b64 ) {
		$user_id = (int) $user_id;
		set_transient( self::challenge_transient_key( $user_id ), $challenge_b64, self::CHALLENGE_TTL );
		update_user_meta( $user_id, 'hb_webauthn_pending_challenge', $challenge_b64 );
	}

	/**
	 * @param int $user_id User ID.
	 * @return string|false
	 */
	private static function get_registration_challenge( $user_id ) {
		$user_id = (int) $user_id;
		$stored  = get_transient( self::challenge_transient_key( $user_id ) );
		if ( is_string( $stored ) && '' !== $stored ) {
			return $stored;
		}
		$meta = get_user_meta( $user_id, 'hb_webauthn_pending_challenge', true );
		return is_string( $meta ) && '' !== $meta ? $meta : false;
	}

	/**
	 * @param int $user_id User ID.
	 * @return void
	 */
	private static function clear_registration_challenge( $user_id ) {
		$user_id = (int) $user_id;
		delete_transient( self::challenge_transient_key( $user_id ) );
		delete_user_meta( $user_id, 'hb_webauthn_pending_challenge' );
	}

	/**
	 * @param string $data Base64url string.
	 * @return string|false
	 */
	private static function base64url_decode( $data ) {
		$data = strtr( $data, '-_', '+/' );
		$pad  = strlen( $data ) % 4;
		if ( $pad ) {
			$data .= str_repeat( '=', 4 - $pad );
		}
		return base64_decode( $data, true );
	}

	/**
	 * @return string
	 */
	private static function default_device_label() {
		if ( wp_is_mobile() ) {
			return __( 'Mobile device', 'hello-elementor-child' );
		}
		return __( 'This device', 'hello-elementor-child' );
	}

	/**
	 * Enqueue nav + page scripts on WooCommerce account pages.
	 *
	 * @return void
	 */
	public static function enqueue_account_assets() {
		if ( ! function_exists( 'is_account_page' ) || ! is_account_page() || ! is_user_logged_in() ) {
			return;
		}

		$js_path  = get_stylesheet_directory() . '/assets/js/hb-biometric-settings.js';
		$css_path = get_stylesheet_directory() . '/assets/css/hb-biometric-settings.css';

		$deps = array( 'hello-elementor-child-style' );
		if ( wp_style_is( 'hb-my-account-ui', 'registered' ) ) {
			$deps[] = 'hb-my-account-ui';
		}

		wp_enqueue_style(
			'hb-biometric-settings',
			get_stylesheet_directory_uri() . '/assets/css/hb-biometric-settings.css',
			$deps,
			file_exists( $css_path ) ? filemtime( $css_path ) : HELLO_ELEMENTOR_CHILD_VERSION
		);

		wp_enqueue_script(
			'hb-biometric-settings',
			get_stylesheet_directory_uri() . '/assets/js/hb-biometric-settings.js',
			array( 'jquery' ),
			file_exists( $js_path ) ? filemtime( $js_path ) : HELLO_ELEMENTOR_CHILD_VERSION,
			true
		);

		wp_localize_script(
			'hb-biometric-settings',
			'hbBiometric',
			array(
				'ajaxUrl'          => admin_url( 'admin-ajax.php' ),
				'nonce'            => wp_create_nonce( 'hb_biometric_settings' ),
				'canManage'        => self::user_can_manage_passkeys(),
				'registerBegin'    => 'hb_biometric_register_begin',
				'registerComplete' => 'hb_biometric_register_complete',
				'removeAction'     => 'hb_biometric_remove',
				'i18n'              => array(
					'unsupported'       => __( 'Biometric login is not available on this device or browser. Continue using your number + OTP.', 'hello-elementor-child' ),
					'needActivation'    => __( 'Activate your device with OTP before enabling biometric login.', 'hello-elementor-child' ),
					'enableBtn'         => __( 'Enable Face ID / fingerprint login', 'hello-elementor-child' ),
					'enabling'          => __( 'Waiting for biometric confirmation…', 'hello-elementor-child' ),
					'removeConfirm'     => __( 'Remove biometric login for this device?', 'hello-elementor-child' ),
					'errorGeneric'      => __( 'Something went wrong. Please try again or use your number + OTP.', 'hello-elementor-child' ),
					'httpsRequired'     => __( 'Biometric login requires a secure (HTTPS) connection.', 'hello-elementor-child' ),
					'sessionExpired'    => __( 'Session expired. Reload this page and try again.', 'hello-elementor-child' ),
				),
			)
		);
	}

	/**
	 * @return bool
	 */
	private static function is_biometric_endpoint() {
		if ( ! function_exists( 'is_wc_endpoint_url' ) ) {
			return false;
		}
		return is_wc_endpoint_url( 'biometric-login' );
	}

	/**
	 * Render My Account endpoint content.
	 *
	 * @return void
	 */
	public static function render_endpoint() {
		if ( ! is_user_logged_in() ) {
			echo '<p>' . esc_html__( 'Please log in to manage biometric login.', 'hello-elementor-child' ) . '</p>';
			return;
		}

		$user     = wp_get_current_user();
		$passkeys = self::get_passkeys_for_user( (int) $user->ID );
		$can_manage = self::user_can_manage_passkeys();
		?>
		<div class="hb-biometric-settings" id="hb-biometric-settings">
			<h2><?php esc_html_e( 'Biometric login', 'hello-elementor-child' ); ?></h2>

			<?php if ( ! $can_manage ) : ?>
				<div class="hb-biometric-settings__notice hb-biometric-settings__notice--warn">
					<p><?php esc_html_e( 'Activate your device with a one-time SMS code before you can enable biometric login on this device.', 'hello-elementor-child' ); ?></p>
					<p class="hb-biometric-settings__hint">
						<?php esc_html_e( 'Use the Activate Your Phone button in the site header, complete OTP verification, then return here.', 'hello-elementor-child' ); ?>
					</p>
				</div>
			<?php else : ?>
				<div class="hb-biometric-settings__unsupported" id="hb-biometric-unsupported" style="display:none;">
					<p><?php esc_html_e( 'Biometric login is not available on this device or browser. You can continue signing in with phone + OTP.', 'hello-elementor-child' ); ?></p>
				</div>

				<div class="hb-biometric-settings__supported" id="hb-biometric-supported">
					<p class="hb-biometric-settings__intro">
						<?php esc_html_e( 'Use Face ID, Touch ID, or fingerprint to sign in faster on this device after your number has been verified once with OTP. OTP remains available for new devices and account recovery.', 'hello-elementor-child' ); ?>
					</p>

					<div class="hb-biometric-settings__enable">
						<label class="hb-biometric-settings__label" for="hb-biometric-device-label">
							<?php esc_html_e( 'Device name (optional)', 'hello-elementor-child' ); ?>
						</label>
						<input
							type="text"
							id="hb-biometric-device-label"
							class="hb-biometric-settings__input"
							maxlength="80"
							placeholder="<?php esc_attr_e( 'e.g. My MacBook', 'hello-elementor-child' ); ?>"
						/>
						<button type="button" class="button hb-biometric-settings__btn" id="hb-biometric-enable-btn">
							<?php esc_html_e( 'Enable Face ID / fingerprint login', 'hello-elementor-child' ); ?>
						</button>
						<p class="hb-biometric-settings__feedback" id="hb-biometric-feedback" role="status" aria-live="polite"></p>
					</div>
				</div>
			<?php endif; ?>

			<?php if ( ! empty( $passkeys ) ) : ?>
				<div class="hb-biometric-settings__list-wrap">
					<h3><?php esc_html_e( 'Registered devices', 'hello-elementor-child' ); ?></h3>
					<ul class="hb-biometric-settings__list" id="hb-biometric-passkey-list">
						<?php foreach ( $passkeys as $row ) : ?>
							<li class="hb-biometric-settings__list-item" data-passkey-id="<?php echo esc_attr( (string) $row->id ); ?>">
								<div class="hb-biometric-settings__list-meta">
									<strong><?php echo esc_html( $row->device_label ?: __( 'Device', 'hello-elementor-child' ) ); ?></strong>
									<span><?php echo esc_html( mysql2date( get_option( 'date_format' ), $row->created_at ) ); ?></span>
								</div>
								<button type="button" class="hb-biometric-settings__remove hb-biometric-remove-btn">
									<?php esc_html_e( 'Remove', 'hello-elementor-child' ); ?>
								</button>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
			<?php else : ?>
				<ul class="hb-biometric-settings__list" id="hb-biometric-passkey-list" hidden></ul>
			<?php endif; ?>
		</div>
		<?php
	}
}

Hb_Biometric_Settings::init();
