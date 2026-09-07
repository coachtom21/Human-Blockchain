<?php
/**
 * Mega → HBC activate funnel: redeem handoff, register device, Gracebook accept, welcome mail.
 *
 * @package HelloElementorChild
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class HB_Start_Activate {

	const COOKIE_NAME       = 'hb_mega_funnel';
	const TRANSIENT_PREFIX  = 'hb_funnel_';
	const COVENANT_VERSION  = '2026-09-04';
	const PAGE_OPTION       = 'hb_activate_funnel_page';

	/**
	 * Hook the funnel.
	 *
	 * @return void
	 */
	public static function init() {
		add_action( 'init', array( __CLASS__, 'ensure_page' ), 21 );
		add_action( 'init', array( __CLASS__, 'bootstrap_handoff' ), 22 );
		add_filter( 'template_include', array( __CLASS__, 'template_include' ), 101 );
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'enqueue' ), 40 );
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'dequeue_shop_assets' ), 999 );
		add_filter( 'woocommerce_enqueue_styles', array( __CLASS__, 'disable_woo_styles' ) );
		add_filter( 'xoo_wsc_is_sidecart_page', array( __CLASS__, 'disable_side_cart' ) );
		add_action( 'wp', array( __CLASS__, 'unhook_side_cart' ) );
		add_filter( 'pre_get_document_title', array( __CLASS__, 'document_title' ) );
		add_action( 'wp_ajax_hb_funnel_register', array( __CLASS__, 'ajax_register' ) );
		add_action( 'wp_ajax_nopriv_hb_funnel_register', array( __CLASS__, 'ajax_register' ) );
		add_action( 'wp_ajax_hb_funnel_gracebook', array( __CLASS__, 'ajax_gracebook' ) );
		add_action( 'wp_ajax_nopriv_hb_funnel_gracebook', array( __CLASS__, 'ajax_gracebook' ) );
		add_action( 'cpm_hb_after_device_registered', array( __CLASS__, 'after_device_registered' ), 10, 3 );
		add_action( 'pmpro_after_checkout', array( __CLASS__, 'after_membership' ), 10, 2 );
	}

	/**
	 * @return bool
	 */
	public static function is_activate_page() {
		if ( is_admin() ) {
			return false;
		}
		if ( function_exists( 'is_page' ) && is_page( 'activate' ) ) {
			return true;
		}
		if ( isset( $_SERVER['REQUEST_URI'] ) && preg_match( '#/activate(/|\?|$)#', (string) $_SERVER['REQUEST_URI'] ) ) {
			return true;
		}
		return false;
	}

	/**
	 * Cookie id for this browser's funnel, or empty.
	 *
	 * @return string
	 */
	private static function funnel_id( $posted = '' ) {
		$posted = preg_replace( '/[^a-f0-9]/', '', (string) $posted );
		if ( strlen( $posted ) >= 16 ) {
			return $posted;
		}
		if ( empty( $_COOKIE[ self::COOKIE_NAME ] ) ) {
			return '';
		}
		return preg_replace( '/[^a-f0-9]/', '', (string) wp_unslash( $_COOKIE[ self::COOKIE_NAME ] ) );
	}

	/**
	 * @return array<string,mixed>
	 */
	private static function load_funnel( $posted = '' ) {
		$id = self::funnel_id( $posted );
		if ( $id === '' || strlen( $id ) < 16 ) {
			return array();
		}
		$data = get_transient( self::TRANSIENT_PREFIX . $id );
		return is_array( $data ) ? $data : array();
	}

	/**
	 * @param array<string,mixed> $data Funnel payload.
	 * @return void
	 */
	private static function save_funnel( $data, $posted = '' ) {
		$id = self::funnel_id( $posted );
		if ( $id === '' || strlen( $id ) < 16 ) {
			$id = bin2hex( random_bytes( 16 ) );
			if ( ! headers_sent() ) {
				$expire = time() + HOUR_IN_SECONDS;
				if ( PHP_VERSION_ID >= 70300 ) {
					setcookie(
						self::COOKIE_NAME,
						$id,
						array(
							'expires'  => $expire,
							'path'     => '/',
							'secure'   => is_ssl(),
							'httponly' => true,
							'samesite' => 'Lax',
						)
					);
				} else {
					setcookie( self::COOKIE_NAME, $id, $expire, '/', '', is_ssl(), true );
				}
			}
			$_COOKIE[ self::COOKIE_NAME ] = $id;
		}
		set_transient( self::TRANSIENT_PREFIX . $id, $data, HOUR_IN_SECONDS );
	}

	/**
	 * @return void
	 */
	public static function ensure_page() {
		if ( get_option( self::PAGE_OPTION ) === '1' ) {
			$page = get_page_by_path( 'activate' );
			if ( $page instanceof WP_Post ) {
				return;
			}
		}

		$page = get_page_by_path( 'activate' );
		if ( ! ( $page instanceof WP_Post ) ) {
			$id = wp_insert_post(
				array(
					'post_title'     => __( 'Activate', 'hello-elementor-child' ),
					'post_name'      => 'activate',
					'post_status'    => 'publish',
					'post_type'      => 'page',
					'post_content'   => '',
					'comment_status' => 'closed',
					'ping_status'    => 'closed',
				)
			);
		} else {
			$id = (int) $page->ID;
		}

		if ( $id && ! is_wp_error( $id ) ) {
			update_post_meta( (int) $id, '_wp_page_template', 'templates-parts/template-hb-activate.php' );
		}

		update_option( self::PAGE_OPTION, '1' );
	}

	/**
	 * Redeem ?handoff= once, then drop the token from the URL.
	 *
	 * @return void
	 */
	public static function bootstrap_handoff() {
		if ( ! self::is_activate_page() || ( defined( 'DOING_AJAX' ) && DOING_AJAX ) ) {
			return;
		}

		$token = isset( $_GET['handoff'] ) ? sanitize_text_field( wp_unslash( $_GET['handoff'] ) ) : '';
		if ( $token === '' ) {
			return;
		}

		$result = self::redeem_mega_token( $token );
		if ( is_wp_error( $result ) ) {
			self::save_funnel(
				array(
					'error' => $result->get_error_message(),
				)
			);
		} else {
			self::save_funnel(
				array(
					'branch'             => $result['branch'],
					'role'               => 'participant',
					'redeemed'           => true,
					'device_registered'  => false,
					'gracebook_accepted' => false,
					'user_id'            => 0,
					'email'              => '',
				)
			);
			if ( class_exists( 'HB_Doorway_Counts' ) ) {
				HB_Doorway_Counts::bump( 'registration_started' );
			}
		}

		wp_safe_redirect( home_url( '/activate/' ) );
		exit;
	}

	/**
	 * @param string $template Template path.
	 * @return string
	 */
	public static function template_include( $template ) {
		if ( ! self::is_activate_page() ) {
			return $template;
		}
		$file = get_stylesheet_directory() . '/templates-parts/template-hb-activate.php';
		return file_exists( $file ) ? $file : $template;
	}

	/**
	 * @param string $title Title.
	 * @return string
	 */
	public static function document_title( $title ) {
		if ( self::is_activate_page() ) {
			return __( 'Activate this device | HumanBlockchain', 'hello-elementor-child' );
		}
		return $title;
	}

	/**
	 * @param mixed $styles Woo styles.
	 * @return mixed
	 */
	public static function disable_woo_styles( $styles ) {
		return self::is_activate_page() ? array() : $styles;
	}

	/**
	 * @param mixed $enabled Whether the side cart renders.
	 * @return mixed
	 */
	public static function disable_side_cart( $enabled ) {
		return self::is_activate_page() ? false : $enabled;
	}

	/**
	 * The side cart caches its page flag before filters run. Remove the footer markup.
	 *
	 * @return void
	 */
	public static function unhook_side_cart() {
		if ( ! self::is_activate_page() ) {
			return;
		}
		if ( function_exists( 'xoo_wsc_frontend' ) ) {
			remove_action( 'wp_footer', array( xoo_wsc_frontend(), 'cart_markup' ) );
		}
	}

	/**
	 * @return void
	 */
	public static function dequeue_shop_assets() {
		if ( ! self::is_activate_page() ) {
			return;
		}

		$handles = array(
			'woocommerce',
			'woocommerce-layout',
			'woocommerce-smallscreen',
			'woocommerce-general',
			'woocommerce-inline',
			'woocommerce-pre-orders-main-css',
			'wc-add-to-cart',
			'wc-cart-fragments',
			'wc-country-select',
			'select2',
			'selectWoo',
			'jquery-blockui',
			'js-cookie',
			'xoo-wsc-style',
			'xoo-wsc-fonts',
			'xoo-wsc-js',
		);
		foreach ( $handles as $handle ) {
			wp_dequeue_style( $handle );
			wp_dequeue_script( $handle );
		}
	}

	/**
	 * @return void
	 */
	public static function enqueue() {
		if ( ! self::is_activate_page() ) {
			return;
		}

		wp_dequeue_style( 'hello-elementor' );
		wp_dequeue_style( 'hello-elementor-theme-style' );
		wp_dequeue_style( 'hello-elementor-header-footer' );
		wp_dequeue_style( 'hello-elementor-child-style' );
		wp_dequeue_style( 'hb-nwp-site-header' );
		wp_dequeue_style( 'hb-nwp-site-footer' );
		wp_dequeue_style( 'hb-otp-popup-style' );
		wp_dequeue_script( 'hb-nwp-site-header' );
		wp_dequeue_script( 'hb-otp-popup-script' );

		$css = get_stylesheet_directory() . '/assets/css/hb-activate.css';
		$js  = get_stylesheet_directory() . '/assets/js/hb-activate.js';

		wp_enqueue_style(
			'hb-activate',
			get_stylesheet_directory_uri() . '/assets/css/hb-activate.css',
			array(),
			file_exists( $css ) ? (string) filemtime( $css ) : HELLO_ELEMENTOR_CHILD_VERSION
		);
		wp_enqueue_script(
			'hb-activate',
			get_stylesheet_directory_uri() . '/assets/js/hb-activate.js',
			array(),
			file_exists( $js ) ? (string) filemtime( $js ) : HELLO_ELEMENTOR_CHILD_VERSION,
			true
		);

		$state = self::state();
		wp_localize_script(
			'hb-activate',
			'HB_ACTIVATE',
			array(
				'ajaxUrl'        => admin_url( 'admin-ajax.php' ),
				'nonce'          => wp_create_nonce( 'hb_funnel' ),
				'funnelId'       => self::funnel_id(),
				'discordUrl'     => self::discord_invite_url(),
				'state'          => $state,
				'branchLabel'    => self::branch_label( isset( $state['branch'] ) ? $state['branch'] : '' ),
			)
		);
	}

	/**
	 * @return array<string,mixed>
	 */
	public static function state() {
		$data = self::load_funnel();

		return array(
			'error'              => isset( $data['error'] ) ? (string) $data['error'] : '',
			'redeemed'           => ! empty( $data['redeemed'] ),
			'branch'             => isset( $data['branch'] ) ? (string) $data['branch'] : '',
			'device_registered'  => ! empty( $data['device_registered'] ),
			'gracebook_accepted' => ! empty( $data['gracebook_accepted'] ),
		);
	}

	/**
	 * @param string $branch Slug.
	 * @return string
	 */
	public static function branch_label( $branch ) {
		$map = array(
			'planning'     => __( 'Planning', 'hello-elementor-child' ),
			'budget'       => __( 'Budget', 'hello-elementor-child' ),
			'media'        => __( 'Media', 'hello-elementor-child' ),
			'distribution' => __( 'Distribution', 'hello-elementor-child' ),
			'membership'   => __( 'Membership', 'hello-elementor-child' ),
		);
		return isset( $map[ $branch ] ) ? $map[ $branch ] : $branch;
	}

	/**
	 * @return string
	 */
	public static function discord_invite_url() {
		return apply_filters(
			'cpm_nwp_discord_invite_url',
			get_option( 'cpm_nwp_discord_invite_url', 'https://discord.com/invite/g5jreAPbra' )
		);
	}

	/**
	 * @return bool
	 */
	public static function is_local_env() {
		if ( defined( 'WP_ENVIRONMENT_TYPE' ) && 'local' === WP_ENVIRONMENT_TYPE ) {
			return true;
		}
		if ( function_exists( 'wp_get_environment_type' ) && 'local' === wp_get_environment_type() ) {
			return true;
		}
		$host = wp_parse_url( home_url(), PHP_URL_HOST );
		return is_string( $host ) && (bool) preg_match( '/\.local$/i', $host );
	}

	/**
	 * @param string $site mega|llb.
	 * @param string $path Path beginning with /.
	 * @return string
	 */
	public static function sister_url( $site, $path ) {
		$local = self::is_local_env();
		$hosts = array(
			'mega' => $local ? 'http://megavoters.local' : 'https://megavoters.com',
			'llb'  => $local ? 'http://legacytoliveby.local' : 'https://legacytoliveby.org',
		);
		$base  = isset( $hosts[ $site ] ) ? $hosts[ $site ] : $hosts['mega'];
		return $base . $path;
	}

	/**
	 * @return string
	 */
	public static function mega_start_url() {
		return self::sister_url( 'mega', '/start/' );
	}

	/**
	 * @return string
	 */
	public static function mega_rest_base() {
		if ( defined( 'HB_MEGAVOTERS_REST_URL' ) && HB_MEGAVOTERS_REST_URL ) {
			return untrailingslashit( HB_MEGAVOTERS_REST_URL );
		}
		return untrailingslashit( self::sister_url( 'mega', '/wp-json' ) );
	}

	/**
	 * @param string $token Raw handoff token.
	 * @return array<string,string>|WP_Error
	 */
	public static function redeem_mega_token( $token ) {
		if ( ! preg_match( '/^[a-f0-9]{64}$/', $token ) ) {
			return new WP_Error( 'hb_bad_handoff', __( 'This handoff is not valid. Return to Start and try again.', 'hello-elementor-child' ) );
		}

		$args = array(
			'timeout'   => 15,
			'sslverify' => ! self::is_local_env(),
			'headers'   => array(
				'Content-Type' => 'application/json',
			),
			'body'      => wp_json_encode( array( 'handoff' => $token ) ),
		);

		if ( defined( 'MEGAVOTERS_HANDOFF_SECRET' ) && MEGAVOTERS_HANDOFF_SECRET ) {
			$args['headers']['X-Megavoters-Handoff-Key'] = MEGAVOTERS_HANDOFF_SECRET;
		}

		$response = wp_remote_post( self::mega_rest_base() . '/megavoters/v1/handoff/redeem', $args );
		if ( is_wp_error( $response ) ) {
			return new WP_Error( 'hb_redeem_http', __( 'We could not confirm your Start choice. Return to Start and try again.', 'hello-elementor-child' ) );
		}

		$code = (int) wp_remote_retrieve_response_code( $response );
		$body = json_decode( (string) wp_remote_retrieve_body( $response ), true );

		if ( 200 !== $code || ! is_array( $body ) || empty( $body['branch'] ) ) {
			$message = is_array( $body ) && ! empty( $body['message'] )
				? (string) $body['message']
				: __( 'This handoff has expired or was already used. Return to Start and begin again.', 'hello-elementor-child' );
			return new WP_Error( 'hb_redeem_fail', $message );
		}

		$branch = sanitize_key( (string) $body['branch'] );
		$allowed = array( 'planning', 'budget', 'media', 'distribution', 'membership' );
		if ( ! in_array( $branch, $allowed, true ) ) {
			return new WP_Error( 'hb_bad_branch', __( 'The branch on this handoff is not recognized.', 'hello-elementor-child' ) );
		}

		return array(
			'branch'          => $branch,
			'source'          => isset( $body['source'] ) ? sanitize_key( (string) $body['source'] ) : 'megavoters_start',
			'consent_version' => isset( $body['consent_version'] ) ? sanitize_text_field( (string) $body['consent_version'] ) : '',
		);
	}

	/**
	 * Register this device only.
	 *
	 * @return void
	 */
	public static function ajax_register() {
		check_ajax_referer( 'hb_funnel', 'nonce' );

		$posted = isset( $_POST['funnel_id'] ) ? sanitize_text_field( wp_unslash( $_POST['funnel_id'] ) ) : '';
		$state  = self::load_funnel( $posted );

		if ( empty( $state['redeemed'] ) || empty( $state['branch'] ) ) {
			wp_send_json_error( array( 'message' => __( 'Start from MEGAvoters so this device can inherit your branch.', 'hello-elementor-child' ) ) );
		}

		if ( ! empty( $state['device_registered'] ) ) {
			wp_send_json_success( array( 'already' => true ) );
		}

		$email  = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
		$mobile = isset( $_POST['mobile'] ) ? sanitize_text_field( wp_unslash( $_POST['mobile'] ) ) : '';
		$hash   = isset( $_POST['device_hash'] ) ? sanitize_text_field( wp_unslash( $_POST['device_hash'] ) ) : '';
		$ok     = ! empty( $_POST['privacy_ok'] );

		if ( ! $ok ) {
			wp_send_json_error( array( 'message' => __( 'Please accept the privacy disclosure to continue.', 'hello-elementor-child' ) ) );
		}
		if ( ! is_email( $email ) ) {
			wp_send_json_error( array( 'message' => __( 'Enter a valid email so we can recognize this device.', 'hello-elementor-child' ) ) );
		}
		if ( $hash === '' || strlen( $hash ) < 16 ) {
			wp_send_json_error( array( 'message' => __( 'This browser could not be recognized. Try another device or reload.', 'hello-elementor-child' ) ) );
		}

		$user_id = self::resolve_user( $email );
		if ( is_wp_error( $user_id ) ) {
			wp_send_json_error( array( 'message' => $user_id->get_error_message() ) );
		}

		$device_id = self::insert_device_row( $user_id, $email, $mobile, $hash, sanitize_key( (string) $state['branch'] ) );
		if ( is_wp_error( $device_id ) ) {
			wp_send_json_error( array( 'message' => $device_id->get_error_message() ) );
		}

		$branch = sanitize_key( (string) $state['branch'] );
		$role   = 'participant';

		update_user_meta( $user_id, 'hb_funnel_branch', $branch );
		update_user_meta( $user_id, 'hb_funnel_role', $role );
		update_user_meta( $user_id, 'hb_device_registered', '1' );
		update_user_meta( $user_id, 'hb_device_registered_at', gmdate( 'c' ) );

		$state['device_registered'] = true;
		$state['user_id']           = $user_id;
		$state['email']             = $email;
		$state['role']              = $role;
		self::save_funnel( $state, $posted );

		if ( class_exists( 'HB_Doorway_Counts' ) ) {
			HB_Doorway_Counts::bump( 'device_registered' );
		}

		self::send_welcome_letter( $user_id, $email, $role, $branch );

		wp_send_json_success(
			array(
				'message' => __( 'Device recognized. One step remains.', 'hello-elementor-child' ),
			)
		);
	}

	/**
	 * Explicit Gracebook covenant. Joining Discord alone does not call this.
	 *
	 * @return void
	 */
	public static function ajax_gracebook() {
		check_ajax_referer( 'hb_funnel', 'nonce' );

		$posted = isset( $_POST['funnel_id'] ) ? sanitize_text_field( wp_unslash( $_POST['funnel_id'] ) ) : '';
		$state  = self::load_funnel( $posted );

		if ( empty( $state['device_registered'] ) ) {
			wp_send_json_error( array( 'message' => __( 'Register this device first.', 'hello-elementor-child' ) ) );
		}

		$user_id = isset( $state['user_id'] ) ? (int) $state['user_id'] : 0;
		if ( $user_id < 1 ) {
			wp_send_json_error( array( 'message' => __( 'We could not attach this acceptance to a device record.', 'hello-elementor-child' ) ) );
		}

		$already_gracebook = (string) get_user_meta( $user_id, 'hb_gracebook_accepted', true ) === '1';

		update_user_meta( $user_id, 'hb_gracebook_accepted', '1' );
		update_user_meta( $user_id, 'hb_gracebook_accepted_at', gmdate( 'c' ) );
		update_user_meta( $user_id, 'hb_covenant_version', self::COVENANT_VERSION );

		$state['gracebook_accepted'] = true;
		self::save_funnel( $state, $posted );

		if ( class_exists( 'HB_Doorway_Counts' ) && ! $already_gracebook ) {
			HB_Doorway_Counts::bump( 'gracebook_accepted' );
			if ( ! empty( $state['device_registered'] ) && (string) get_user_meta( $user_id, 'hb_onboarding_complete', true ) !== '1' ) {
				update_user_meta( $user_id, 'hb_onboarding_complete', '1' );
				HB_Doorway_Counts::bump( 'onboarding_complete' );
			}
		}

		wp_send_json_success(
			array(
				'message'    => __( 'Community Checker ready.', 'hello-elementor-child' ),
				'discordUrl' => self::discord_invite_url(),
			)
		);
	}

	/**
	 * @param int    $device_id Device row.
	 * @param int    $wp_user_id User.
	 * @param string $email Email.
	 * @return void
	 */
	public static function after_device_registered( $device_id, $wp_user_id, $email ) {
		unset( $device_id );
		$funnel = self::load_funnel();
		if ( empty( $funnel['redeemed'] ) ) {
			return;
		}
		$role   = isset( $funnel['role'] ) ? (string) $funnel['role'] : 'participant';
		$branch = isset( $funnel['branch'] ) ? (string) $funnel['branch'] : '';
		if ( $wp_user_id && $branch ) {
			update_user_meta( (int) $wp_user_id, 'hb_funnel_branch', sanitize_key( $branch ) );
			update_user_meta( (int) $wp_user_id, 'hb_funnel_role', sanitize_key( $role ) );
		}
	}

	/**
	 * Same letters after membership.
	 *
	 * @param int   $user_id User.
	 * @param mixed $order   Order.
	 * @return void
	 */
	public static function after_membership( $user_id, $order = null ) {
		unset( $order );
		$user_id = (int) $user_id;
		$user    = get_userdata( $user_id );
		if ( ! $user || ! is_email( $user->user_email ) ) {
			return;
		}
		$role   = (string) get_user_meta( $user_id, 'hb_funnel_role', true );
		$branch = (string) get_user_meta( $user_id, 'hb_funnel_branch', true );
		if ( $role !== 'observer' ) {
			$role = 'participant';
		}
		self::send_welcome_letter( $user_id, $user->user_email, $role, $branch, 'membership' );
	}

	/**
	 * @param string $email Email.
	 * @return int|WP_Error
	 */
	private static function resolve_user( $email ) {
		$current = get_current_user_id();
		if ( $current > 0 ) {
			return $current;
		}
		$existing = email_exists( $email );
		if ( $existing ) {
			return (int) $existing;
		}
		$user_id = wp_insert_user(
			array(
				'user_login' => sanitize_user( current( explode( '@', $email ) ) . wp_rand( 100, 999 ), true ),
				'user_email' => $email,
				'user_pass'  => wp_generate_password( 24, true ),
				'role'       => 'subscriber',
			)
		);
		return is_wp_error( $user_id ) ? $user_id : (int) $user_id;
	}

	/**
	 * @param int    $user_id User.
	 * @param string $email Email.
	 * @param string $mobile Phone.
	 * @param string $hash Device hash.
	 * @param string $branch Start branch.
	 * @return int|WP_Error
	 */
	private static function insert_device_row( $user_id, $email, $mobile, $hash, $branch ) {
		global $wpdb;
		$table = $wpdb->prefix . 'nwp_devices';
		$like  = $wpdb->esc_like( $table );

		if ( $wpdb->get_var( $wpdb->prepare( 'SHOW TABLES LIKE %s', $like ) ) !== $table ) {
			return 0;
		}

		$exists = $wpdb->get_var(
			$wpdb->prepare(
				"SELECT id FROM {$table} WHERE device_hash = %s LIMIT 1",
				$hash
			)
		);
		if ( $exists ) {
			self::persist_start_branch( (int) $exists, $branch );
			return (int) $exists;
		}

		$email_exists = $wpdb->get_var(
			$wpdb->prepare(
				"SELECT id FROM {$table} WHERE LOWER(TRIM(email)) = %s LIMIT 1",
				strtolower( trim( $email ) )
			)
		);
		if ( $email_exists ) {
			self::persist_start_branch( (int) $email_exists, $branch );
			return (int) $email_exists;
		}

		$ok = $wpdb->insert(
			$table,
			array(
				'user_id'             => $user_id,
				'device_hash'         => $hash,
				'email'               => $email,
				'phone'               => $mobile !== '' ? $mobile : null,
				'registered_at'       => current_time( 'mysql' ),
				'registration_status' => 'registered',
				'ip_address'          => isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) : null,
				'user_agent'          => isset( $_SERVER['HTTP_USER_AGENT'] ) ? substr( sanitize_text_field( wp_unslash( $_SERVER['HTTP_USER_AGENT'] ) ), 0, 512 ) : null,
			),
			array( '%d', '%s', '%s', '%s', '%s', '%s', '%s', '%s' )
		);

		if ( ! $ok ) {
			return 0;
		}

		$device_id = (int) $wpdb->insert_id;
		self::persist_start_branch( $device_id, $branch );
		do_action( 'cpm_hb_after_device_registered', $device_id, $user_id, $email );
		return $device_id;
	}

	/**
	 * Lock the Start branch on the device row when the column exists.
	 *
	 * @param int    $device_id Device row.
	 * @param string $branch Branch slug.
	 * @return void
	 */
	private static function persist_start_branch( $device_id, $branch ) {
		global $wpdb;
		$device_id = (int) $device_id;
		$branch    = sanitize_key( $branch );
		if ( $device_id < 1 || $branch === '' ) {
			return;
		}

		$table   = $wpdb->prefix . 'nwp_devices';
		$columns = $wpdb->get_col( "DESCRIBE {$table}", 0 );
		if ( ! is_array( $columns ) || ! in_array( 'peace_pentagon_branch', $columns, true ) ) {
			return;
		}

		$current = $wpdb->get_var(
			$wpdb->prepare(
				"SELECT peace_pentagon_branch FROM {$table} WHERE id = %d LIMIT 1",
				$device_id
			)
		);
		if ( is_string( $current ) && $current !== '' ) {
			return;
		}

		$data    = array( 'peace_pentagon_branch' => $branch );
		$formats = array( '%s' );
		if ( in_array( 'branch_source', $columns, true ) ) {
			$data['branch_source'] = 'user';
			$formats[]             = '%s';
		}
		if ( in_array( 'branch_preference', $columns, true ) ) {
			$data['branch_preference'] = $branch;
			$formats[]                 = '%s';
		}

		$wpdb->update( $table, $data, array( 'id' => $device_id ), $formats, array( '%d' ) );
	}

	/**
	 * @param int    $user_id User.
	 * @param string $email To.
	 * @param string $role observer|participant.
	 * @param string $branch Branch slug.
	 * @param string $reason device|membership.
	 * @return void
	 */
	public static function send_welcome_letter( $user_id, $email, $role, $branch, $reason = 'device' ) {
		$flag = 'hb_welcome_' . sanitize_key( $role ) . '_' . sanitize_key( $reason );
		if ( get_user_meta( $user_id, $flag, true ) ) {
			return;
		}

		$label   = self::branch_label( $branch );
		$is_obs  = ( 'observer' === $role );
		$subject = $is_obs
			? __( 'Welcome — Observer / YAM’er', 'hello-elementor-child' )
			: __( 'Welcome — Participant / MEGAvoter', 'hello-elementor-child' );
		$body = $is_obs ? self::observer_letter( $label ) : self::participant_letter( $label );

		$sent = wp_mail( $email, $subject, $body, array( 'Content-Type: text/plain; charset=UTF-8' ) );
		if ( $sent ) {
			update_user_meta( $user_id, $flag, gmdate( 'c' ) );
		}
	}

	/**
	 * @param string $branch_label Branch name.
	 * @return string
	 */
	private static function participant_letter( $branch_label ) {
		$branch_label = $branch_label !== '' ? $branch_label : '[SELECTED BRANCH]';
		return "Welcome to the Human Gold Rush.\n\n"
			. "Your smartphone has been registered for the Participant/MEGAvoter pathway within your selected Peace Pentagon branch:\n\n"
			. $branch_label . "\n\n"
			. "This first Peace Pentagon branch selection is defining and cannot be changed.\n\n"
			. "Your two pending POC assignments\n\n"
			. "Every MEGAvoter is placed into two separate assignments within the selected branch:\n\n"
			. "- Pending Buyer/Recipient POC\n"
			. "- Pending Seller/Giver POC\n\n"
			. "POC means Patron Organizing Community.\n\n"
			. "Both assignments remain pending while balanced 30-member communities develop through the Serendipity Protocol. The protocol uses next-device-up placement. Registration does not guarantee immediate POC activation or permission to claim that a complete community already exists.\n\n"
			. "Think of the scan as an approval screen\n\n"
			. "At a retailer, a card terminal presents a transaction and asks whether the customer approves it.\n\n"
			. "HumanBlockchain uses a similar moment of choice, but your smartphone is not a card reader or payment terminal.\n\n"
			. "As a MEGAvoter, your device may present an Identity, Trade, or Gratitude encounter. The recipient’s device independently reviews the request and chooses:\n\n"
			. "- Accept\n"
			. "- Decline\n"
			. "- Observe\n"
			. "- Walk away\n"
			. "- Scan nothing\n\n"
			. "No payment card is required. No bank account is accessed. No card or banking information is captured. Presenting a QR request does not complete the encounter.\n\n"
			. "Three voluntary QR gateways\n\n"
			. "Identity\n\n"
			. "“I choose to offer recognition or contact.”\n\n"
			. "An Identity scan may present your registered device, virtual business card, or Peace Pentagon Penny contact information. Someone may view or save the contact information without completing a transaction.\n\n"
			. "Trade\n\n"
			. "“I choose to present a stated trade encounter.”\n\n"
			. "A Trade scan places the proposed encounter before the recipient. Like reviewing a retailer’s approval screen, the recipient decides whether the information is accurate before accepting it.\n\n"
			. "Gratitude\n\n"
			. "“I choose to recognize presence, service, or goodwill.”\n\n"
			. "A Gratitude scan offers Experience Presence recognition without turning gratitude into payment or money.\n\n"
			. "Where required, a valid encounter uses two distinct registered devices within the established three-minute and 50-meter guidelines. Both sides must affirm the Y/Y/Y questions before the testnet records the proof as true.\n\n"
			. "What may be captured\n\n"
			. "A voluntary scan may record only what is needed for the chosen encounter:\n\n"
			. "- Pseudonymous device references\n"
			. "- Identity, Trade, or Gratitude gateway\n"
			. "- Timestamp\n"
			. "- Limited proximity confirmation\n"
			. "- Buyer/recipient and seller/giver relationship\n"
			. "- Y/Y/Y confirmation\n"
			. "- Acceptance or other transaction status\n"
			. "- Applicable pending POC assignments\n\n"
			. "The system does not require anyone’s private story, touchstone word, beliefs, counseling information, or reason for responding. It does not continuously track a person’s location.\n\n"
			. "Two different ledgers\n\n"
			. "HumanBlockchain keeps money and mankind separate.\n\n"
			. "The financial ledger records actual trade, money-related obligations, receipts, settlements, and reconciliations.\n\n"
			. "The Experience Presence ledger records voluntarily confirmed moments of showing up.\n\n"
			. "XP means Experience Presence. A qualified encounter may produce a testnet XP entry, but XP is never money, cryptocurrency, wages, legal tender, or a ranking of human worth.\n\n"
			. "What Human Gold means\n\n"
			. "Every person experiences the same 24 hours each day. No one can recover a moment after it passes.\n\n"
			. "Human Gold recognizes the time people freely choose to share through service, listening, delivery, trade, gratitude, and presence.\n\n"
			. "HumanBlockchain records only the encounters both parties choose to post. It does not attempt to capture or judge the rest of anyone’s life.\n\n"
			. "Your next step\n\n"
			. "Discord Gracebook acceptance is required to complete MEGAvoter onboarding. Joining the server alone does not constitute acceptance.\n\n"
			. "You must explicitly acknowledge the Practice FAITH covenant:\n\n"
			. "Fair • Accepting • Insightful • Transparent • Humble\n\n"
			. "After Discord acceptance, your Buyer/Recipient and Seller/Giver POC assignments remain pending until the Serendipity Protocol develops the appropriate 30-member Patron Organizing Communities.\n\n"
			. "Registration recognizes intention. Serendipity organizes community. Two devices confirm the encounter. Separate ledgers preserve the difference between money and showing up.\n\n"
			. "No response is ever treated as a character judgment.\n\n"
			. "HumanBlockchain.info\n"
			. "Human Gold Rush • Community Checkers • Proposed Detente 2030 Testnet\n";
	}

	/**
	 * @param string $branch_label Branch name.
	 * @return string
	 */
	private static function observer_letter( $branch_label ) {
		$branch_label = $branch_label !== '' ? $branch_label : '[SELECTED BRANCH]';
		return "Welcome to the Human Gold Rush.\n\n"
			. "Your smartphone has been registered as an Observer/YAM’er device within your selected Peace Pentagon branch:\n\n"
			. $branch_label . "\n\n"
			. "Registration recognizes the device as a voluntary Community Checker. It does not measure your character, beliefs, importance, or human worth.\n\n"
			. "Think of the scan as an approval screen\n\n"
			. "At a retailer, a card terminal presents information and asks whether you approve a purchase. HumanBlockchain uses a similar moment of choice—but your smartphone is not being used as a payment terminal.\n\n"
			. "One device presents an Identity, Trade, or Gratitude encounter. Your device lets you review it and choose:\n\n"
			. "Accept\n"
			. "Decline\n"
			. "Observe\n"
			. "Walk away\n"
			. "Scan nothing\n\n"
			. "No payment card is required. No bank account is accessed. No card or banking information is captured. A scan records only the encounter you deliberately choose to confirm.\n\n"
			. "Three voluntary QR gateways\n\n"
			. "Identity\n\n"
			. "“I choose to be recognized as present.”\n\n"
			. "An Identity scan may recognize your registered device or allow you to review someone’s virtual business-card information. It does not create a purchase or transfer money.\n\n"
			. "Trade\n\n"
			. "“I choose to consider a trade encounter.”\n\n"
			. "A Trade scan presents the stated transaction for your review. Like reading a retailer’s approval screen, you decide whether the information is accurate before accepting it.\n\n"
			. "Gratitude\n\n"
			. "“I choose to recognize someone’s presence or service.”\n\n"
			. "A Gratitude scan records a voluntary human acknowledgment without treating gratitude or XP as money.\n\n"
			. "What may be captured\n\n"
			. "A voluntary scan may record only the information needed for that encounter:\n\n"
			. "Pseudonymous device references\n"
			. "Identity, Trade, or Gratitude gateway\n"
			. "Timestamp\n"
			. "Limited proximity confirmation\n"
			. "Acceptance, decline, or unresolved status\n\n"
			. "HumanBlockchain does not need your private story, touchstone word, beliefs, counseling information, or reason for responding. It does not continuously track your location.\n\n"
			. "Two different ledgers\n\n"
			. "Money and showing up belong on separate ledgers.\n\n"
			. "The financial ledger records actual money-related activity, trade obligations, receipts, and reconciliations.\n\n"
			. "The Experience Presence ledger records human encounters that two devices voluntarily confirmed.\n\n"
			. "XP means Experience Presence. It is not money, cryptocurrency, wages, a prize, legal tender, or a measure of human worth.\n\n"
			. "What Human Gold means\n\n"
			. "Every person receives the same 24 hours each day. No one can save those hours for tomorrow or rewind the clock.\n\n"
			. "Human Gold is a way to recognize how people choose to spend that limited time—showing up, helping, listening, serving, trading, or expressing gratitude.\n\n"
			. "HumanBlockchain records only the encounters you choose to post. Everything else remains yours.\n\n"
			. "Discord Gracebook acceptance is the final step in completing your Observer/YAM’er onboarding. Joining the Discord server alone is not acceptance; you must explicitly acknowledge the Practice FAITH covenant.\n\n"
			. "Your time is yours. Your presence is yours. Confirmation is always your choice.\n\n"
			. "No response is ever treated as a character judgment.\n\n"
			. "HumanBlockchain.info\n"
			. "Human Gold Rush • Community Checkers • Proposed Detente 2030 Testnet\n";
	}
}
