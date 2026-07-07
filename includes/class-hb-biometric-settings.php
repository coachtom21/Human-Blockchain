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
		add_action( 'init', array( __CLASS__, 'register_endpoint' ) );
		add_action( 'init', array( __CLASS__, 'maybe_create_table' ), 5 );
		add_filter( 'woocommerce_account_menu_items', array( __CLASS__, 'account_menu_item' ), 42 );
		add_action( 'woocommerce_account_biometric-login_endpoint', array( __CLASS__, 'render_endpoint' ) );

		add_action( 'wp_ajax_hb_biometric_register_begin', array( __CLASS__, 'ajax_register_begin' ) );
		add_action( 'wp_ajax_hb_biometric_register_complete', array( __CLASS__, 'ajax_register_complete' ) );
		add_action( 'wp_ajax_hb_biometric_remove', array( __CLASS__, 'ajax_remove' ) );

		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'enqueue_account_assets' ), 110 );
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
		$host = wp_parse_url( home_url(), PHP_URL_HOST );
		$host = is_string( $host ) ? strtolower( $host ) : '';
		if ( str_starts_with( $host, 'www.' ) ) {
			$host = substr( $host, 4 );
		}
		return (string) apply_filters( 'hb_webauthn_rp_id', $host );
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
			$formats = array( 'none', 'packed', 'apple', 'android-key', 'android-safetynet' );
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
		check_ajax_referer( 'hb_biometric_settings', 'nonce' );

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
					'message' => __( 'Biometric login is not available on this site right now. Please contact support.', 'hello-elementor-child' ),
				),
				500
			);
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
				false,
				'required',
				false,
				self::get_exclude_credential_ids( $user_id )
			);
		} catch ( Exception $e ) {
			wp_send_json_error( array( 'message' => $e->getMessage() ), 500 );
		}

		$challenge = $server->getChallenge();
		if ( $challenge ) {
			set_transient(
				self::challenge_transient_key( $user_id ),
				base64_encode( $challenge->getBinaryString() ),
				self::CHALLENGE_TTL
			);
		}

		wp_send_json_success( array( 'publicKey' => $args->publicKey ) );
	}

	/**
	 * @return void
	 */
	public static function ajax_register_complete() {
		check_ajax_referer( 'hb_biometric_settings', 'nonce' );

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
		$stored  = get_transient( self::challenge_transient_key( $user_id ) );
		if ( ! $stored ) {
			wp_send_json_error(
				array(
					'message' => __( 'Your setup session expired. Please try again.', 'hello-elementor-child' ),
				),
				400
			);
		}

		$client_data_b64      = isset( $_POST['clientDataJSON'] ) ? sanitize_text_field( wp_unslash( $_POST['clientDataJSON'] ) ) : '';
		$attestation_b64      = isset( $_POST['attestationObject'] ) ? sanitize_text_field( wp_unslash( $_POST['attestationObject'] ) ) : '';
		$device_label         = isset( $_POST['device_label'] ) ? sanitize_text_field( wp_unslash( $_POST['device_label'] ) ) : '';
		$client_data_json     = self::base64url_decode( $client_data_b64 );
		$attestation_object   = self::base64url_decode( $attestation_b64 );

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
		} catch ( Exception $e ) {
			wp_send_json_error( array( 'message' => $e->getMessage() ), 400 );
		}

		delete_transient( self::challenge_transient_key( $user_id ) );

		$cred_id_b64 = base64_encode( $data->credentialId->getBinaryString() );
		if ( '' === $device_label ) {
			$device_label = self::default_device_label();
		}

		global $wpdb;
		$inserted = $wpdb->insert(
			self::table_name(),
			array(
				'user_id'                => $user_id,
				'credential_id'          => $cred_id_b64,
				'credential_public_key'  => (string) $data->credentialPublicKey,
				'sign_count'             => (int) $data->signatureCounter,
				'device_label'           => $device_label,
				'attestation_format'     => (string) $data->attestationFormat,
				'created_at'             => current_time( 'mysql' ),
			),
			array( '%d', '%s', '%s', '%d', '%s', '%s', '%s' )
		);

		if ( ! $inserted ) {
			wp_send_json_error(
				array(
					'message' => __( 'Could not save biometric login for this device.', 'hello-elementor-child' ),
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
		check_ajax_referer( 'hb_biometric_settings', 'nonce' );

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
	 * @param int $user_id User ID.
	 * @return string
	 */
	private static function challenge_transient_key( $user_id ) {
		return 'hb_webauthn_challenge_' . (int) $user_id;
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
				'ajaxUrl'           => admin_url( 'admin-ajax.php' ),
				'nonce'             => wp_create_nonce( 'hb_biometric_settings' ),
				'isEndpoint'        => self::is_biometric_endpoint(),
				'canManage'         => self::user_can_manage_passkeys(),
				'registerBegin'     => 'hb_biometric_register_begin',
				'registerComplete'  => 'hb_biometric_register_complete',
				'removeAction'      => 'hb_biometric_remove',
				'i18n'              => array(
					'unsupported'       => __( 'Biometric login is not available on this device or browser. Continue using phone + OTP.', 'hello-elementor-child' ),
					'needActivation'    => __( 'Activate your device with OTP before enabling biometric login.', 'hello-elementor-child' ),
					'enableBtn'         => __( 'Enable Face ID / fingerprint login', 'hello-elementor-child' ),
					'enabling'          => __( 'Waiting for biometric confirmation…', 'hello-elementor-child' ),
					'removeConfirm'     => __( 'Remove biometric login for this device?', 'hello-elementor-child' ),
					'errorGeneric'      => __( 'Something went wrong. Please try again or use phone + OTP.', 'hello-elementor-child' ),
					'httpsRequired'     => __( 'Biometric login requires a secure (HTTPS) connection.', 'hello-elementor-child' ),
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

			<div class="hb-biometric-settings__unsupported" id="hb-biometric-unsupported" hidden>
				<p><?php esc_html_e( 'Biometric login is not available on this device or browser. You can continue signing in with phone + OTP.', 'hello-elementor-child' ); ?></p>
			</div>

			<?php if ( ! $can_manage ) : ?>
				<div class="hb-biometric-settings__notice hb-biometric-settings__notice--warn">
					<p><?php esc_html_e( 'Activate your device with a one-time SMS code before you can enable biometric login on this device.', 'hello-elementor-child' ); ?></p>
				</div>
			<?php else : ?>
				<div class="hb-biometric-settings__supported" id="hb-biometric-supported" hidden>
					<p class="hb-biometric-settings__intro">
						<?php esc_html_e( 'Use Face ID or fingerprint to sign in faster on this device after your phone has been verified once with OTP. OTP remains available for new devices and account recovery.', 'hello-elementor-child' ); ?>
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
							placeholder="<?php esc_attr_e( 'e.g. My iPhone', 'hello-elementor-child' ); ?>"
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
