<?php
/**
 * Theme functions and definitions.
 *
 * For additional information on potential customization options,
 * read the developers' documentation:
 *
 * https://developers.elementor.com/docs/hello-elementor-theme/
 *
 * @package HelloElementorChild
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'HELLO_ELEMENTOR_CHILD_VERSION', '2.0.0' );

/**
 * Permalink of the page using the NWP Landing template, or home.
 *
 * @return string
 */
function hb_get_nwp_landing_permalink() {
	static $cached = null;
	if ( null !== $cached ) {
		return $cached;
	}
	$pages = get_pages(
		array(
			'meta_key'   => '_wp_page_template',
			'meta_value' => 'templates-parts/template-nwp-landing.php',
			'number'     => 1,
		)
	);
	$cached = ( ! empty( $pages[0] ) ) ? get_permalink( $pages[0]->ID ) : home_url( '/' );
	return $cached;
}

/**
 * URL to a section on the NWP landing page.
 *
 * @param string $section_id Hash id without #, e.g. how-it-works.
 * @return string
 */
function hb_nwp_landing_section_url( $section_id ) {
	$base = hb_get_nwp_landing_permalink();
	$base = rtrim( (string) $base, '/' );
	$hash = ltrim( (string) $section_id, '#' );
	return esc_url( $base . '/#' . $hash );
}

/**
 * Whether the current singular page needs WooCommerce My Account UI assets.
 * Detects shortcode in post content and in Elementor JSON (common cause of missing styles).
 *
 * @param int $post_id Post ID.
 * @return bool
 */
function hb_post_uses_woocommerce_my_account( $post_id ) {
	$post_id = (int) $post_id;
	if ( $post_id <= 0 ) {
		return false;
	}
	$content = (string) get_post_field( 'post_content', $post_id );
	if ( function_exists( 'has_shortcode' ) && has_shortcode( $content, 'woocommerce_my_account' ) ) {
		return true;
	}
	if ( strpos( $content, 'woocommerce_my_account' ) !== false ) {
		return true;
	}
	$elementor = get_post_meta( $post_id, '_elementor_data', true );
	if ( is_string( $elementor ) && $elementor !== '' ) {
		if ( strpos( $elementor, 'woocommerce_my_account' ) !== false ) {
			return true;
		}
		if ( strpos( $elementor, '[woocommerce_my_account]' ) !== false ) {
			return true;
		}
	}
	return false;
}

/**
 * Load My Account / login polish CSS when on the account page or when the page embeds the WC account shortcode.
 *
 * @return bool
 */
function hb_should_enqueue_my_account_styles() {
	if ( ! class_exists( 'WooCommerce' ) ) {
		return false;
	}
	if ( apply_filters( 'hb_enqueue_my_account_styles', false ) ) {
		return true;
	}
	if ( function_exists( 'is_account_page' ) && is_account_page() ) {
		return true;
	}
	if ( is_page_template( 'templates-parts/template-my-account.php' ) ) {
		return true;
	}
	if ( is_singular() ) {
		$post_id = get_queried_object_id();
		if ( $post_id && hb_post_uses_woocommerce_my_account( $post_id ) ) {
			return true;
		}
	}
	return false;
}

/**
 * Detect PMPro login shortcode/block in post content or Elementor JSON.
 *
 * @param int $post_id Post ID.
 * @return bool
 */
function hb_post_uses_pmpro_login( $post_id ) {
	$post_id = (int) $post_id;
	if ( $post_id <= 0 ) {
		return false;
	}
	$content = (string) get_post_field( 'post_content', $post_id );
	if ( function_exists( 'has_shortcode' ) && has_shortcode( $content, 'pmpro_login' ) ) {
		return true;
	}
	if ( strpos( $content, '[pmpro_login' ) !== false ) {
		return true;
	}
	if ( function_exists( 'has_block' ) && has_block( 'pmpro/login-form', $post_id ) ) {
		return true;
	}
	if ( strpos( $content, 'pmpro/login-form' ) !== false ) {
		return true;
	}
	$elementor = get_post_meta( $post_id, '_elementor_data', true );
	if ( is_string( $elementor ) && $elementor !== '' ) {
		if ( strpos( $elementor, 'pmpro_login' ) !== false || strpos( $elementor, 'pmpro/login-form' ) !== false ) {
			return true;
		}
	}
	return false;
}

/**
 * Load PMPro membership login page / form styles.
 *
 * @return bool
 */
function hb_should_enqueue_pmpro_login_styles() {
	if ( ! defined( 'PMPRO_VERSION' ) ) {
		return false;
	}
	if ( apply_filters( 'hb_enqueue_pmpro_login_styles', false ) ) {
		return true;
	}
	if ( function_exists( 'pmpro_is_login_page' ) && pmpro_is_login_page() ) {
		return true;
	}
	$login_page_id = (int) get_option( 'pmpro_login_page_id' );
	if ( $login_page_id && is_page( $login_page_id ) ) {
		return true;
	}
	if ( is_singular() ) {
		$post_id = get_queried_object_id();
		if ( $post_id && hb_post_uses_pmpro_login( $post_id ) ) {
			return true;
		}
	}
	return false;
}

/**
 * Paid Memberships Pro login UI — loads after Elementor when active.
 *
 * @return void
 */
function hb_enqueue_pmpro_login_ui_styles() {
	if ( ! hb_should_enqueue_pmpro_login_styles() ) {
		return;
	}
	$pmpro_login_css = get_stylesheet_directory() . '/assets/css/pmpro-login.css';
	$deps            = array( 'hello-elementor-child-style' );
	if ( wp_style_is( 'pmpro_frontend', 'registered' ) ) {
		$deps[] = 'pmpro_frontend';
	}
	if ( wp_style_is( 'elementor-frontend', 'registered' ) ) {
		$deps[] = 'elementor-frontend';
	}
	wp_enqueue_style(
		'hb-pmpro-login-ui',
		get_stylesheet_directory_uri() . '/assets/css/pmpro-login.css',
		$deps,
		file_exists( $pmpro_login_css ) ? filemtime( $pmpro_login_css ) : HELLO_ELEMENTOR_CHILD_VERSION
	);
}
add_action( 'wp_enqueue_scripts', 'hb_enqueue_pmpro_login_ui_styles', 101 );

/**
 * Thank-you / order-received page UI — after WooCommerce blocks + Elementor when present.
 *
 * @return void
 */
function hb_enqueue_order_received_ui_styles() {
	if ( ! function_exists( 'is_order_received_page' ) || ! is_order_received_page() ) {
		return;
	}
	$thanks_css  = get_stylesheet_directory() . '/assets/css/order-received.css';
	$thanks_deps = array( 'hello-elementor-child-style' );
	if ( wp_style_is( 'wc-blocks-packages-style', 'registered' ) ) {
		$thanks_deps[] = 'wc-blocks-packages-style';
	}
	if ( wp_style_is( 'wc-blocks-style-checkout', 'registered' ) ) {
		$thanks_deps[] = 'wc-blocks-style-checkout';
	}
	if ( wp_style_is( 'elementor-frontend', 'registered' ) ) {
		$thanks_deps[] = 'elementor-frontend';
	}
	wp_enqueue_style(
		'hb-order-received-ui',
		get_stylesheet_directory_uri() . '/assets/css/order-received.css',
		$thanks_deps,
		file_exists( $thanks_css ) ? filemtime( $thanks_css ) : HELLO_ELEMENTOR_CHILD_VERSION
	);
}
add_action( 'wp_enqueue_scripts', 'hb_enqueue_order_received_ui_styles', 102 );

/**
 * Load child theme scripts & styles.
 *
 * @return void
 */
function hello_elementor_child_scripts_styles() {

	wp_enqueue_style(
		'hello-elementor-child-style',
		get_stylesheet_directory_uri() . '/style.css',
		[
			'hello-elementor-theme-style',
		],
		HELLO_ELEMENTOR_CHILD_VERSION
	);

	wp_enqueue_style(
		'hb-responsive',
		get_stylesheet_directory_uri() . '/assets/css/responsive.css',
		array( 'hello-elementor-child-style' ),
		HELLO_ELEMENTOR_CHILD_VERSION
	);

	$nwp_header_path = get_stylesheet_directory() . '/assets/css/nwp-site-header.css';
	wp_enqueue_style(
		'hb-nwp-site-header',
		get_stylesheet_directory_uri() . '/assets/css/nwp-site-header.css',
		array( 'hello-elementor-child-style' ),
		file_exists( $nwp_header_path ) ? filemtime( $nwp_header_path ) : HELLO_ELEMENTOR_CHILD_VERSION
	);

	$nwp_footer_path = get_stylesheet_directory() . '/assets/css/nwp-site-footer.css';
	wp_enqueue_style(
		'hb-nwp-site-footer',
		get_stylesheet_directory_uri() . '/assets/css/nwp-site-footer.css',
		array( 'hb-nwp-site-header' ),
		file_exists( $nwp_footer_path ) ? filemtime( $nwp_footer_path ) : HELLO_ELEMENTOR_CHILD_VERSION
	);

	$nwp_header_js = get_stylesheet_directory() . '/assets/js/nwp-site-header.js';
	wp_enqueue_script(
		'hb-nwp-site-header',
		get_stylesheet_directory_uri() . '/assets/js/nwp-site-header.js',
		array(),
		file_exists( $nwp_header_js ) ? filemtime( $nwp_header_js ) : HELLO_ELEMENTOR_CHILD_VERSION,
		true
	);

	// Enqueue OTP Popup styles - use filemtime for cache busting
	$otp_css_path = get_stylesheet_directory() . '/assets/css/otp-popup.css';
	wp_enqueue_style(
		'hb-otp-popup-style',
		get_stylesheet_directory_uri() . '/assets/css/otp-popup.css',
		array(),
		file_exists( $otp_css_path ) ? filemtime( $otp_css_path ) : HELLO_ELEMENTOR_CHILD_VERSION
	);

	wp_enqueue_script(
		'hb-otp-popup-script',
		get_stylesheet_directory_uri() . '/assets/js/otp-popup.js',
		array('jquery'),
		HELLO_ELEMENTOR_CHILD_VERSION,
		true
	);

	wp_localize_script( 'hb-otp-popup-script', 'hbOTPVars', array(
		'backorderUrl' => home_url( '/backorder' ),
	) );

	// Enqueue Font Awesome for icons
	wp_enqueue_style(
		'hb-font-awesome',
		'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css',
		array(),
		'6.5.2'
	);

	$mobile_sidebar_path = get_stylesheet_directory() . '/assets/js/mobile-sidebar.js';
	wp_enqueue_script(
		'hb-mobile-sidebar',
		get_stylesheet_directory_uri() . '/assets/js/mobile-sidebar.js',
		array(),
		file_exists( $mobile_sidebar_path ) ? filemtime( $mobile_sidebar_path ) : HELLO_ELEMENTOR_CHILD_VERSION,
		true
	);

	if ( function_exists( 'is_checkout' ) && is_checkout() && ! is_order_received_page() ) {
		$checkout_css = get_stylesheet_directory() . '/assets/css/checkout.css';
		$checkout_deps = array( 'hello-elementor-child-style' );
		if ( wp_style_is( 'wc-blocks-packages-style', 'registered' ) ) {
			$checkout_deps[] = 'wc-blocks-packages-style';
		}
		if ( wp_style_is( 'wc-blocks-style-checkout', 'registered' ) ) {
			$checkout_deps[] = 'wc-blocks-style-checkout';
		}
		wp_enqueue_style(
			'hb-checkout-ui',
			get_stylesheet_directory_uri() . '/assets/css/checkout.css',
			$checkout_deps,
			file_exists( $checkout_css ) ? filemtime( $checkout_css ) : HELLO_ELEMENTOR_CHILD_VERSION
		);
	}

	if ( function_exists( 'is_cart' ) && is_cart() ) {
		$cart_css = get_stylesheet_directory() . '/assets/css/cart.css';
		$cart_deps = array( 'hello-elementor-child-style' );
		if ( wp_style_is( 'wc-blocks-packages-style', 'registered' ) ) {
			$cart_deps[] = 'wc-blocks-packages-style';
		}
		if ( wp_style_is( 'wc-blocks-style-cart', 'registered' ) ) {
			$cart_deps[] = 'wc-blocks-style-cart';
		}
		wp_enqueue_style(
			'hb-cart-ui',
			get_stylesheet_directory_uri() . '/assets/css/cart.css',
			$cart_deps,
			file_exists( $cart_css ) ? filemtime( $cart_css ) : HELLO_ELEMENTOR_CHILD_VERSION
		);
	}

}
add_action( 'wp_enqueue_scripts', 'hello_elementor_child_scripts_styles', 20 );

/**
 * Account / login UI loads late so Elementor frontend is registered (dependency order).
 *
 * @return void
 */
function hb_enqueue_my_account_ui_styles() {
	if ( ! hb_should_enqueue_my_account_styles() ) {
		return;
	}
	$my_account_css  = get_stylesheet_directory() . '/assets/css/my-account.css';
	$my_account_deps = array( 'hello-elementor-child-style' );
	if ( wp_style_is( 'elementor-frontend', 'registered' ) ) {
		$my_account_deps[] = 'elementor-frontend';
	}
	wp_enqueue_style(
		'hb-my-account-ui',
		get_stylesheet_directory_uri() . '/assets/css/my-account.css',
		$my_account_deps,
		file_exists( $my_account_css ) ? filemtime( $my_account_css ) : HELLO_ELEMENTOR_CHILD_VERSION
	);
}
add_action( 'wp_enqueue_scripts', 'hb_enqueue_my_account_ui_styles', 100 );

/**
 * YAM JAM ledger definitions table styles (NWP landing + My Account / Woo account pages).
 *
 * @return void
 */
function hb_enqueue_yamjam_ledger_definitions_css() {
	$nwp_landing    = function_exists( 'is_page_template' ) && is_page_template( 'templates-parts/template-nwp-landing.php' );
	$standalone_acc = function_exists( 'is_page_template' ) && is_page_template( 'templates-parts/template-my-account.php' );
	if ( ! $nwp_landing && ! $standalone_acc && ! hb_should_enqueue_my_account_styles() ) {
		return;
	}
	$ledger_css = get_stylesheet_directory() . '/assets/css/yamjam-ledger-definitions.css';
	if ( ! file_exists( $ledger_css ) ) {
		return;
	}

	$deps = array();
	if ( wp_style_is( 'hb-my-account-ui', 'enqueued' ) || wp_style_is( 'hb-my-account-ui', 'registered' ) ) {
		$deps[] = 'hb-my-account-ui';
	}
	if ( empty( $deps ) && wp_style_is( 'hello-elementor-child-style', 'registered' ) ) {
		$deps[] = 'hello-elementor-child-style';
	}

	wp_enqueue_style(
		'hb-yamjam-ledger-definitions',
		get_stylesheet_directory_uri() . '/assets/css/yamjam-ledger-definitions.css',
		$deps,
		filemtime( $ledger_css )
	);
}
add_action( 'wp_enqueue_scripts', 'hb_enqueue_yamjam_ledger_definitions_css', 102 );

/**
 * Render dual-ledger definitions on WooCommerce My Account Dashboard (embedded).
 *
 * @return void
 */
function hb_render_yamjam_ledger_definitions_embed_on_wc_dashboard() {
	get_template_part(
		'templates-parts/part',
		'yamjam-ledger-definitions',
		array(
			'embed'      => true,
			'section_id' => 'ledger-definitions-account',
		)
	);
}
add_action( 'woocommerce_account_dashboard', 'hb_render_yamjam_ledger_definitions_embed_on_wc_dashboard', 4 );

/**
 * Load HumanBlockchain core files
 */
function hb_load_core_files() {
	$includes_dir = get_stylesheet_directory() . '/includes';
	
	// Load service classes
	if ( file_exists( $includes_dir . '/class-device-registration-service.php' ) ) {
		require_once $includes_dir . '/class-device-registration-service.php';
	}
	
	if ( file_exists( $includes_dir . '/class-qrtiger-service.php' ) ) {
		require_once $includes_dir . '/class-qrtiger-service.php';
	}
	
	if ( file_exists( $includes_dir . '/class-discord-service.php' ) ) {
		require_once $includes_dir . '/class-discord-service.php';
	}
	
	if ( file_exists( $includes_dir . '/class-serendipity-service.php' ) ) {
		require_once $includes_dir . '/class-serendipity-service.php';
	}
	
	if ( file_exists( $includes_dir . '/class-hb-rest-api.php' ) ) {
		require_once $includes_dir . '/class-hb-rest-api.php';
	}

	if ( file_exists( $includes_dir . '/class-hb-yamjam-verification-model.php' ) ) {
		require_once $includes_dir . '/class-hb-yamjam-verification-model.php';
	}
}
add_action( 'after_setup_theme', 'hb_load_core_files' );

/**
 * Register REST API routes
 */
function hb_register_rest_routes() {
	HB_REST_API::register_routes();
}
add_action( 'rest_api_init', 'hb_register_rest_routes' );

/**
 * Run database migrations on theme activation
 */
function hb_activate_theme() {
	require_once get_stylesheet_directory() . '/database/migrations/001_create_device_tables.php';
	hb_create_device_tables();
}
add_action( 'after_switch_theme', 'hb_activate_theme' );

/**
 * Check and run migrations if needed
 */
function hb_check_migrations() {
	$current_version = get_option( 'hb_db_version', '0.0.0' );
	
	// Run migration 001 if needed
	if ( version_compare( $current_version, '1.0.0', '<' ) ) {
		require_once get_stylesheet_directory() . '/database/migrations/001_create_device_tables.php';
		hb_create_device_tables();
		$current_version = '1.0.0'; // Update after migration
	}
	
	// Run migration 002 if needed (add hybrid method columns)
	if ( version_compare( $current_version, '1.1.0', '<' ) ) {
		require_once get_stylesheet_directory() . '/database/migrations/002_add_hybrid_method_columns.php';
		$result = hb_add_hybrid_method_columns();
		if ( ! is_wp_error( $result ) ) {
			update_option( 'hb_db_version', '1.1.0' );
			$current_version = '1.1.0';
		}
	}
	
	// Run migration 003 if needed (verify indexes and migrate data)
	if ( version_compare( $current_version, '1.2.0', '<' ) ) {
		require_once get_stylesheet_directory() . '/database/migrations/003_verify_and_migrate_data.php';
		$result = hb_verify_and_migrate_data();
		if ( ! is_wp_error( $result ) ) {
			update_option( 'hb_db_version', '1.2.0' );
		}
	}
}
add_action( 'admin_init', 'hb_check_migrations' );
add_action( 'init', 'hb_check_migrations_frontend' );

/**
 * Get site logo dynamically
 * Returns WordPress custom logo or site icon, with fallback to CSS-based logo
 * 
 * @param string $size Logo size (thumbnail, medium, large, full)
 * @param array $attrs Additional attributes for img tag
 * @return string HTML for logo
 */
function hb_get_site_logo( $size = 'medium', $attrs = array() ) {
	$default_attrs = array(
		'class' => 'logo',
		'alt' => get_bloginfo( 'name' ) . ' Logo',
		'aria-hidden' => 'true'
	);
	$attrs = wp_parse_args( $attrs, $default_attrs );
	
	// Try to get custom logo first
	$custom_logo_id = get_theme_mod( 'custom_logo' );
	if ( $custom_logo_id ) {
		$logo_url = wp_get_attachment_image_url( $custom_logo_id, $size );
		if ( $logo_url ) {
			$logo_html = '<img src="' . esc_url( $logo_url ) . '"';
			foreach ( $attrs as $key => $value ) {
				if ( $key === 'aria-hidden' && $value === 'true' ) {
					$logo_html .= ' aria-hidden="true"';
				} else {
					$logo_html .= ' ' . esc_attr( $key ) . '="' . esc_attr( $value ) . '"';
				}
			}
			$logo_html .= ' style="height: 100%; object-fit: contain;" />';
			return $logo_html;
		}
	}
	
	// Fallback to site icon
	$site_icon_id = get_option( 'site_icon' );
	if ( $site_icon_id ) {
		$icon_url = wp_get_attachment_image_url( $site_icon_id, $size );
		if ( $icon_url ) {
			$logo_html = '<img src="' . esc_url( $icon_url ) . '"';
			foreach ( $attrs as $key => $value ) {
				if ( $key === 'aria-hidden' && $value === 'true' ) {
					$logo_html .= ' aria-hidden="true"';
				} else {
					$logo_html .= ' ' . esc_attr( $key ) . '="' . esc_attr( $value ) . '"';
				}
			}
			$logo_html .= ' style="height: 100%; object-fit: contain;" />';
			return $logo_html;
		}
	}
	
	// Fallback to CSS-based logo (existing style) - return empty div/span that CSS will style
	$fallback_class = isset( $attrs['class'] ) ? $attrs['class'] : 'logo';
	$aria_hidden = isset( $attrs['aria-hidden'] ) && $attrs['aria-hidden'] === 'true' ? ' aria-hidden="true"' : '';
	
	// Return appropriate element based on class
	if ( strpos( $fallback_class, 'mark' ) !== false || strpos( $fallback_class, 'icon' ) !== false ) {
		return '<div class="' . esc_attr( $fallback_class ) . '"' . $aria_hidden . '></div>';
	}
	
	return '<span class="' . esc_attr( $fallback_class ) . '"' . $aria_hidden . '></span>';
}

/**
 * Check migrations on frontend (for manual trigger)
 */
function hb_check_migrations_frontend() {
	// Only run if migration parameter is present and user is admin
	if ( isset( $_GET['hb_run_migration_003'] ) && current_user_can( 'manage_options' ) ) {
		require_once get_stylesheet_directory() . '/database/migrations/003_verify_and_migrate_data.php';
		hb_verify_and_migrate_data();
	}
}

/**
 * Register templates-parts directory for page templates
 * This allows WordPress to find page templates in the templates-parts subdirectory
 */
function hb_register_template_directory( $templates ) {
	$template_dir = get_stylesheet_directory() . '/templates-parts';
	
	if ( is_dir( $template_dir ) ) {
		$files = glob( $template_dir . '/template-*.php' );
		foreach ( $files as $file ) {
			$template_name = 'templates-parts/' . basename( $file );
			// Get template name from file header
			$file_data = get_file_data( $file, array( 'Template Name' => 'Template Name' ) );
			$display_name = ! empty( $file_data['Template Name'] ) ? $file_data['Template Name'] : basename( $file, '.php' );
			$templates[ $template_name ] = $display_name;
		}
	}
	
	return $templates;
}
add_filter( 'theme_page_templates', 'hb_register_template_directory' );

/**
 * Resolve template path when WordPress loads page templates
 * This ensures templates in templates-parts directory are loaded correctly
 */
function hb_resolve_template_path( $template ) {
	global $post;
	
	if ( ! $post || ! is_page() ) {
		return $template;
	}
	
	$page_template = get_post_meta( $post->ID, '_wp_page_template', true );
	
	if ( $page_template && strpos( $page_template, 'templates-parts/' ) === 0 ) {
		$template_path = get_stylesheet_directory() . '/' . $page_template;
		if ( file_exists( $template_path ) ) {
			return $template_path;
		}
	}
	
	return $template;
}
add_filter( 'template_include', 'hb_resolve_template_path', 99 );

/**
 * Create registration pages automatically
 * Run once by visiting: ?hb_create_pages=1 (as admin)
 */
function hb_create_registration_pages() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	
	$pages = array(
		array(
			'title' => 'Activate Device',
			'slug' => 'activate-device',
			'template' => 'templates-parts/template-activate-device.php',
		),
		array(
			'title' => 'Validate v-Card',
			'slug' => 'activate-device-step-2',
			'template' => 'templates-parts/template-activate-device-step-2.php',
		),
		array(
			'title' => 'Connect Discord',
			'slug' => 'activate-device-step-3',
			'template' => 'templates-parts/template-activate-device-step-3.php',
		),
		array(
			'title' => 'Choose Membership',
			'slug' => 'activate-device-step-4',
			'template' => 'templates-parts/template-activate-device-step-4.php',
		),
		array(
			'title' => 'Registration Complete',
			'slug' => 'activate-device-complete',
			'template' => 'templates-parts/template-activate-device-complete.php',
		),
		array(
			'title'    => 'My Account',
			'slug'     => 'my-account',
			'template' => 'templates-parts/template-my-account.php',
		),
	);
	
	$created = 0;
	$updated = 0;
	
	foreach ( $pages as $page_data ) {
		$page = get_page_by_path( $page_data['slug'] );
		
		if ( ! $page ) {
			$page_id = wp_insert_post( array(
				'post_title'   => $page_data['title'],
				'post_name'    => $page_data['slug'],
				'post_status'  => 'publish',
				'post_type'    => 'page',
				'post_content' => '',
			) );
			
			if ( $page_id && ! is_wp_error( $page_id ) ) {
				update_post_meta( $page_id, '_wp_page_template', $page_data['template'] );
				$created++;
			}
		} else {
			// Update existing page template if needed
			$current_template = get_post_meta( $page->ID, '_wp_page_template', true );
			if ( $current_template !== $page_data['template'] ) {
				update_post_meta( $page->ID, '_wp_page_template', $page_data['template'] );
				$updated++;
			}
		}
	}
	
	return array( 'created' => $created, 'updated' => $updated );
}

// Auto-create pages if requested
if ( isset( $_GET['hb_create_pages'] ) && current_user_can( 'manage_options' ) ) {
	$result = hb_create_registration_pages();
	echo '<div style="padding:20px; background:#fff; margin:20px;">';
	echo '<h2>Pages Created!</h2>';
	echo '<p>Created: ' . $result['created'] . ' pages</p>';
	echo '<p>Updated: ' . $result['updated'] . ' pages</p>';
	echo '<p><a href="' . admin_url( 'edit.php?post_type=page' ) . '">View Pages</a></p>';
	echo '</div>';
	exit;
}

/**
 * Include OTP Verification Popup on non-home pages only.
 * Home page has its own inline role popup in template-home.php.
 */
function hb_include_otp_popup() {
	if ( ! is_admin() && ! is_front_page() ) {
		$popup_file = get_stylesheet_directory() . '/templates-parts/popup-otp-verification.php';
		if ( file_exists( $popup_file ) ) {
			include $popup_file;
		}
	}
}
add_action( 'wp_footer', 'hb_include_otp_popup' );

/**
 * Register WooCommerce My Account endpoint for XP Ledger.
 */
function hb_register_xp_ledger_endpoint() {
	add_rewrite_endpoint( 'xp-ledger', EP_ROOT | EP_PAGES );
}
add_action( 'init', 'hb_register_xp_ledger_endpoint' );

/**
 * Add XP Ledger tab to WooCommerce My Account menu.
 *
 * @param array<string, string> $items Menu items.
 * @return array<string, string>
 */
function hb_add_xp_ledger_account_menu_item( $items ) {
	if ( ! is_array( $items ) ) {
		return $items;
	}

	$new_items = array();
	$inserted  = false;
	foreach ( $items as $key => $label ) {
		$new_items[ $key ] = $label;
		if ( 'orders' === $key ) {
			$new_items['xp-ledger'] = __( 'XP Ledger', 'hello-elementor-child' );
			$inserted               = true;
		}
	}

	if ( ! $inserted ) {
		$new_items['xp-ledger'] = __( 'XP Ledger', 'hello-elementor-child' );
	}

	return $new_items;
}
add_filter( 'woocommerce_account_menu_items', 'hb_add_xp_ledger_account_menu_item', 40 );

/**
 * Sum XP analytics from ledger rows. Pending is tracked separately; total/buyer/seller exclude pending.
 *
 * @param array<int, object> $xp_rows Rows from Cpm_Humanblockchain_Xp_Ledger::get_ledger_rows_for_user.
 * @return array{total:string,pending:string,buyer:string,seller:string}
 */
function hb_xp_ledger_sum_analytics_from_rows( $xp_rows ) {
	$analytics = array(
		'total'   => '0',
		'pending' => '0',
		'buyer'   => '0',
		'seller'  => '0',
	);
	if ( ! is_array( $xp_rows ) ) {
		return $analytics;
	}

	$add_bigints = static function ( $a, $b ) {
		$a = ltrim( preg_replace( '/\D/', '', (string) $a ), '0' );
		$b = ltrim( preg_replace( '/\D/', '', (string) $b ), '0' );
		if ( $a === '' ) {
			$a = '0';
		}
		if ( $b === '' ) {
			$b = '0';
		}
		if ( function_exists( 'bcadd' ) ) {
			return bcadd( $a, $b, 0 );
		}
		$carry = 0;
		$out   = '';
		$i     = strlen( $a ) - 1;
		$j     = strlen( $b ) - 1;
		while ( $i >= 0 || $j >= 0 || $carry > 0 ) {
			$da    = $i >= 0 ? (int) $a[ $i ] : 0;
			$db    = $j >= 0 ? (int) $b[ $j ] : 0;
			$sum   = $da + $db + $carry;
			$out   = (string) ( $sum % 10 ) . $out;
			$carry = (int) floor( $sum / 10 );
			$i--;
			$j--;
		}
		$out = ltrim( $out, '0' );
		return $out === '' ? '0' : $out;
	};

	foreach ( $xp_rows as $row ) {
		$units       = isset( $row->xp_units ) ? (string) $row->xp_units : '0';
		$scan_type   = isset( $row->scan_type ) ? (string) $row->scan_type : '';
		$scan_status = isset( $row->scan_status ) ? (string) $row->scan_status : '';
		if ( $scan_status === 'pending' ) {
			$analytics['pending'] = $add_bigints( $analytics['pending'], $units );
		} else {
			$analytics['total'] = $add_bigints( $analytics['total'], $units );
			if ( $scan_type === 'buyer_scan' ) {
				$analytics['buyer'] = $add_bigints( $analytics['buyer'], $units );
			}
			if ( $scan_type === 'seller_scan' ) {
				$analytics['seller'] = $add_bigints( $analytics['seller'], $units );
			}
		}
	}

	return $analytics;
}

/**
 * Render XP Ledger endpoint content on Woo My Account.
 */
function hb_render_xp_ledger_account_endpoint() {
	if ( ! is_user_logged_in() ) {
		echo '<p>' . esc_html__( 'Please log in to view your XP ledger.', 'hello-elementor-child' ) . '</p>';
		return;
	}

	if ( ! class_exists( 'Cpm_Humanblockchain_Xp_Ledger' ) ) {
		echo '<p>' . esc_html__( 'XP ledger module is not active.', 'hello-elementor-child' ) . '</p>';
		return;
	}

	$user_id    = (int) get_current_user_id();
	$xp_rows    = Cpm_Humanblockchain_Xp_Ledger::get_ledger_rows_for_user( $user_id, 200 );
	$xp_summary = Cpm_Humanblockchain_Xp_Ledger::get_xp_summary_for_user( $user_id );

	$xp_display_html = static function ( $value ) {
		$digits = preg_replace( '/\D/', '', (string) $value );
		$digits = ltrim( $digits, '0' );
		if ( $digits === '' ) {
			return '0 XP';
		}
		$tz = 0;
		while ( strlen( $digits ) > 1 && substr( $digits, -1 ) === '0' ) {
			$digits = substr( $digits, 0, -1 );
			$tz++;
		}
		$len  = strlen( $digits );
		$frac = substr( $digits, 1 );
		if ( $frac === '' ) {
			$coeff = $digits;
			$exp   = (string) $tz;
		} else {
			$coeff = $digits[0] . '.' . rtrim( $frac, '0' );
			$coeff = rtrim( $coeff, '.' );
			$exp   = (string) ( $tz + $len - 1 );
		}
		return esc_html( $coeff ) . ' x 10^' . esc_html( $exp ) . ' XP';
	};

	$analytics = hb_xp_ledger_sum_analytics_from_rows( $xp_rows );

	echo '<h3>' . esc_html__( 'XP Ledger', 'hello-elementor-child' ) . '</h3>';
	echo '<p>' . esc_html__( 'Your scan ledger history from HumanBlockchain.', 'hello-elementor-child' ) . '</p>';
	echo '<p><strong>' . esc_html__( 'Rows:', 'hello-elementor-child' ) . '</strong> ' . esc_html( (string) (int) $xp_summary['row_count'] ) . '</p>';
	echo '<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(170px,1fr));gap:10px;margin:12px 0 14px;">';
	echo '<div style="padding:12px;border:1px solid rgba(255,255,255,.14);border-radius:12px;background:rgba(255,255,255,.03);"><div style="font-size:.72rem;opacity:.8;text-transform:uppercase;letter-spacing:.04em;">' . esc_html__( 'Total XP', 'hello-elementor-child' ) . '</div><div style="font-size:1rem;font-weight:700;margin-top:5px;">' . $xp_display_html( $analytics['total'] ) . '</div></div>';
	echo '<div style="padding:12px;border:1px solid rgba(255,255,255,.14);border-radius:12px;background:rgba(255,255,255,.03);"><div style="font-size:.72rem;opacity:.8;text-transform:uppercase;letter-spacing:.04em;">' . esc_html__( 'Pending XP', 'hello-elementor-child' ) . '</div><div style="font-size:1rem;font-weight:700;margin-top:5px;">' . $xp_display_html( $analytics['pending'] ) . '</div></div>';
	echo '<div style="padding:12px;border:1px solid rgba(255,255,255,.14);border-radius:12px;background:rgba(255,255,255,.03);"><div style="font-size:.72rem;opacity:.8;text-transform:uppercase;letter-spacing:.04em;">' . esc_html__( 'Buyer XP', 'hello-elementor-child' ) . '</div><div style="font-size:1rem;font-weight:700;margin-top:5px;">' . $xp_display_html( $analytics['buyer'] ) . '</div></div>';
	echo '<div style="padding:12px;border:1px solid rgba(255,255,255,.14);border-radius:12px;background:rgba(255,255,255,.03);"><div style="font-size:.72rem;opacity:.8;text-transform:uppercase;letter-spacing:.04em;">' . esc_html__( 'Seller XP', 'hello-elementor-child' ) . '</div><div style="font-size:1rem;font-weight:700;margin-top:5px;">' . $xp_display_html( $analytics['seller'] ) . '</div></div>';
	echo '</div>';

	if ( empty( $xp_rows ) ) {
		echo '<p>' . esc_html__( 'No XP ledger transactions yet.', 'hello-elementor-child' ) . '</p>';
		return;
	}

	echo '<div style="overflow:auto;border:1px solid #ddd;border-radius:8px;">';
	echo '<table style="width:100%;border-collapse:collapse;">';
	echo '<thead><tr>';
	echo '<th style="text-align:left;padding:8px;border-bottom:1px solid #ddd;">' . esc_html__( 'ID', 'hello-elementor-child' ) . '</th>';
	echo '<th style="text-align:left;padding:8px;border-bottom:1px solid #ddd;">' . esc_html__( 'Type', 'hello-elementor-child' ) . '</th>';
	echo '<th style="text-align:left;padding:8px;border-bottom:1px solid #ddd;">' . esc_html__( 'Transaction', 'hello-elementor-child' ) . '</th>';
	echo '<th style="text-align:left;padding:8px;border-bottom:1px solid #ddd;">' . esc_html__( 'XP', 'hello-elementor-child' ) . '</th>';
	echo '<th style="text-align:left;padding:8px;border-bottom:1px solid #ddd;">' . esc_html__( 'Status', 'hello-elementor-child' ) . '</th>';
	echo '<th style="text-align:left;padding:8px;border-bottom:1px solid #ddd;">' . esc_html__( 'Date', 'hello-elementor-child' ) . '</th>';
	echo '</tr></thead><tbody>';

	foreach ( $xp_rows as $row ) {
		$row_status = isset( $row->scan_status ) ? (string) $row->scan_status : '';
		$row_class  = ( 'pending' === $row_status ) ? ' class="hb-xp-row--pending"' : '';
		echo '<tr' . $row_class . '>';
		echo '<td style="padding:8px;border-bottom:1px solid #eee;">' . esc_html( isset( $row->id ) ? (string) (int) $row->id : '' ) . '</td>';
		echo '<td style="padding:8px;border-bottom:1px solid #eee;">' . esc_html( isset( $row->scan_type ) ? (string) $row->scan_type : '' ) . '</td>';
		echo '<td style="padding:8px;border-bottom:1px solid #eee;word-break:break-all;">' . esc_html( isset( $row->transaction_id ) ? (string) $row->transaction_id : '' ) . '</td>';
		echo '<td style="padding:8px;border-bottom:1px solid #eee;">' . $xp_display_html( isset( $row->xp_units ) ? (string) $row->xp_units : '0' ) . '</td>';
		echo '<td style="padding:8px;border-bottom:1px solid #eee;">' . esc_html( isset( $row->scan_status ) ? (string) $row->scan_status : '' ) . '</td>';
		echo '<td style="padding:8px;border-bottom:1px solid #eee;">' . esc_html( isset( $row->ledger_date ) ? (string) $row->ledger_date : '' ) . '</td>';
		echo '</tr>';
	}

	echo '</tbody></table></div>';
}
add_action( 'woocommerce_account_xp-ledger_endpoint', 'hb_render_xp_ledger_account_endpoint' );

/**
 * Register WooCommerce My Account endpoint for VCard.
 */
function hb_register_vcard_endpoint() {
	add_rewrite_endpoint( 'vcard', EP_ROOT | EP_PAGES );
}
add_action( 'init', 'hb_register_vcard_endpoint' );

/**
 * Add VCard tab to WooCommerce My Account menu.
 *
 * @param array<string, string> $items Menu items.
 * @return array<string, string>
 */
function hb_add_vcard_account_menu_item( $items ) {
	if ( ! is_array( $items ) ) {
		return $items;
	}

	$new_items = array();
	$inserted  = false;
	foreach ( $items as $key => $label ) {
		$new_items[ $key ] = $label;
		if ( 'xp-ledger' === $key ) {
			$new_items['vcard'] = __( 'VCard', 'hello-elementor-child' );
			$inserted           = true;
		}
	}

	if ( ! $inserted ) {
		$new_items['vcard'] = __( 'VCard', 'hello-elementor-child' );
	}

	return $new_items;
}
add_filter( 'woocommerce_account_menu_items', 'hb_add_vcard_account_menu_item', 41 );

/**
 * Build vCard 3.0 body for current user.
 *
 * @param int $user_id User ID.
 * @return string
 */
function hb_build_user_vcard_body( $user_id ) {
	$user = get_userdata( $user_id );
	if ( ! $user ) {
		return '';
	}

	$first  = (string) get_user_meta( $user_id, 'first_name', true );
	$last   = (string) get_user_meta( $user_id, 'last_name', true );
	$email  = (string) $user->user_email;
	$phone  = (string) get_user_meta( $user_id, 'billing_phone', true );
	$phone2 = (string) get_user_meta( $user_id, 'mega-mobile', true );
	if ( '' === $phone ) {
		$phone = $phone2;
	}
	$name = trim( trim( $first . ' ' . $last ) );
	if ( '' === $name ) {
		$name = (string) $user->display_name;
	}
	if ( '' === $name ) {
		$name = (string) $user->user_login;
	}

	$esc = static function ( $value ) {
		$value = str_replace( array( "\r\n", "\r", "\n" ), '\\n', (string) $value );
		return str_replace(
			array( '\\', ';', ',' ),
			array( '\\\\', '\;', '\,' ),
			$value
		);
	};

	$lines   = array();
	$lines[] = 'BEGIN:VCARD';
	$lines[] = 'VERSION:3.0';
	$lines[] = 'PRODID:-//HumanBlockchain//VCard//EN';
	$lines[] = 'FN:' . $esc( $name );
	$lines[] = 'N:' . $esc( $last ) . ';' . $esc( $first ) . ';;;';
	if ( '' !== $email ) {
		$lines[] = 'EMAIL;TYPE=INTERNET:' . $esc( $email );
	}
	if ( '' !== $phone ) {
		$lines[] = 'TEL;TYPE=CELL:' . $esc( preg_replace( '/\s+/', '', $phone ) );
	}
	$lines[] = 'URL:' . esc_url_raw( home_url( '/my-account/' ) );
	$lines[] = 'END:VCARD';

	return implode( "\r\n", $lines ) . "\r\n";
}

/**
 * Save generated vCard file in uploads and return URL.
 *
 * @param int    $user_id User ID.
 * @param string $body    VCard content.
 * @return string|WP_Error
 */
function hb_save_user_vcard_file( $user_id, $body ) {
	$upload = wp_upload_dir();
	if ( ! empty( $upload['error'] ) || empty( $upload['basedir'] ) || empty( $upload['baseurl'] ) ) {
		return new WP_Error( 'upload_dir', __( 'Upload directory is not available.', 'hello-elementor-child' ) );
	}

	$dir = trailingslashit( $upload['basedir'] ) . 'hb-vcards';
	if ( ! wp_mkdir_p( $dir ) ) {
		return new WP_Error( 'mkdir', __( 'Could not create vCard storage folder.', 'hello-elementor-child' ) );
	}

	$file = wp_unique_filename( $dir, 'user-' . (int) $user_id . '-contact.vcf' );
	$path = trailingslashit( $dir ) . $file;
	$ok   = file_put_contents( $path, $body );
	if ( false === $ok ) {
		return new WP_Error( 'write', __( 'Could not write vCard file.', 'hello-elementor-child' ) );
	}

	return trailingslashit( $upload['baseurl'] ) . 'hb-vcards/' . rawurlencode( $file );
}

/**
 * Resolve QRTiger credentials from NWP settings.
 *
 * @return array{key:string,url:string}
 */
function hb_get_qrtiger_credentials() {
	$key = trim( (string) get_option( 'cpm_nwp_qrtiger_api_key', '' ) );
	$url = trim( (string) get_option( 'cpm_nwp_qrtiger_api_url', '' ) );
	if ( '' === $url ) {
		$url = 'https://api.qrtiger.com';
	}
	$host = strtolower( (string) wp_parse_url( $url, PHP_URL_HOST ) );
	if ( in_array( $host, array( 'qrtiger.com', 'www.qrtiger.com' ), true ) ) {
		$url = 'https://api.qrtiger.com';
	}
	return array(
		'key' => $key,
		'url' => untrailingslashit( esc_url_raw( $url ) ),
	);
}

/**
 * Generate a QR image for a vCard URL via QRTiger.
 *
 * @param string $vcard_url Public VCard file URL.
 * @return array|WP_Error
 */
function hb_generate_qrtiger_qr_for_vcard( $vcard_url ) {
	$creds = hb_get_qrtiger_credentials();
	if ( '' === $creds['key'] ) {
		return new WP_Error( 'missing_key', __( 'QRTiger API key is missing in NWP Gateway settings.', 'hello-elementor-child' ) );
	}

	$endpoint = $creds['url'] . '/api/campaign/';
	$payload  = array(
		'qr'         => array(
			'size'           => 500,
			'logo'           => '',
			'colorDark'      => '#1D2F6F',
			'backgroundColor'=> '#FFFFFF',
			'transparentBkg' => false,
		),
		'qrUrl'      => esc_url_raw( $vcard_url ),
		'qrType'     => 'qr2',
		'qrCategory' => 'url',
	);

	$response = wp_remote_post(
		$endpoint,
		array(
			'timeout' => 30,
			'headers' => array(
				'Authorization' => 'Bearer ' . $creds['key'],
				'Content-Type'  => 'application/json',
				'Accept'        => 'application/json',
			),
			'body'    => wp_json_encode( $payload ),
		)
	);

	if ( is_wp_error( $response ) ) {
		return $response;
	}

	$code = (int) wp_remote_retrieve_response_code( $response );
	$body = (string) wp_remote_retrieve_body( $response );
	$data = json_decode( $body );

	$qr_image = '';
	$qr_id    = '';
	if ( is_object( $data ) ) {
		// Most common QR Tiger structure.
		if ( ! empty( $data->data->qrImage ) && is_string( $data->data->qrImage ) ) {
			$qr_image = $data->data->qrImage;
		}
		if ( ! empty( $data->data->qrId ) && is_string( $data->data->qrId ) ) {
			$qr_id = $data->data->qrId;
		}
		// Tolerate alternative structure returned by some clients/proxies.
		if ( '' === $qr_image && ! empty( $data->qrImage ) && is_string( $data->qrImage ) ) {
			$qr_image = $data->qrImage;
		}
		if ( '' === $qr_id && ! empty( $data->qrId ) && is_string( $data->qrId ) ) {
			$qr_id = $data->qrId;
		}
	}

	if ( $code < 200 || $code > 299 || '' === $qr_image ) {
		$msg = __( 'QRTiger did not return a valid QR image.', 'hello-elementor-child' );

		$json_status = null;
		if ( is_object( $data ) && isset( $data->status ) && is_numeric( $data->status ) ) {
			$json_status = (int) $data->status;
		}

		// QR Tiger often returns HTTP 200 with {"status":403} for invalid key or missing API access.
		if ( 403 === $json_status ) {
			$msg = __( 'QR Tiger rejected the request (forbidden). Check the QRTiger API key in NWP Gateway settings: it must be active, copied correctly, and your QR Tiger plan must allow API / dynamic QR creation.', 'hello-elementor-child' );
		} elseif ( null !== $json_status && $json_status >= 400 ) {
			$msg = sprintf(
				/* translators: %d: status code from QR Tiger JSON body */
				__( 'QR Tiger returned an error status in the response body (%d). Check API credentials and account limits.', 'hello-elementor-child' ),
				$json_status
			);
		} elseif ( is_object( $data ) ) {
			if ( ! empty( $data->message ) && is_string( $data->message ) ) {
				$msg = $data->message;
			} elseif ( ! empty( $data->error ) && is_string( $data->error ) ) {
				$msg = $data->error;
			} elseif ( ! empty( $data->data->message ) && is_string( $data->data->message ) ) {
				$msg = $data->data->message;
			} elseif ( '' !== trim( $body ) ) {
				$snippet = sanitize_text_field( substr( trim( $body ), 0, 220 ) );
				if ( '' !== $snippet ) {
					$msg = sprintf(
						/* translators: 1: HTTP code, 2: response snippet */
						__( 'QRTiger response (%1$d): %2$s', 'hello-elementor-child' ),
						$code,
						$snippet
					);
				}
			}
		} elseif ( '' !== trim( $body ) ) {
			$snippet = sanitize_text_field( substr( trim( $body ), 0, 220 ) );
			if ( '' !== $snippet ) {
				$msg = sprintf(
					/* translators: 1: HTTP code, 2: response snippet */
					__( 'QRTiger response error (%1$d): %2$s', 'hello-elementor-child' ),
					$code,
					$snippet
				);
			}
		} elseif ( 0 !== $code ) {
			$msg = sprintf(
				/* translators: %d: HTTP response code */
				__( 'QRTiger response error (HTTP %d).', 'hello-elementor-child' ),
				$code
			);
		}
		return new WP_Error( 'qrtiger_response', $msg );
	}

	return array(
		'image_url' => esc_url_raw( (string) $qr_image ),
		'qr_id'     => '' !== $qr_id ? sanitize_text_field( (string) $qr_id ) : '',
	);
}

/**
 * AJAX: Generate VCard + QRTiger QR for logged-in user.
 */
function hb_ajax_generate_vcard_qr() {
	if ( ! is_user_logged_in() ) {
		wp_send_json_error( array( 'message' => __( 'You must be logged in.', 'hello-elementor-child' ) ), 401 );
	}
	check_ajax_referer( 'hb_generate_vcard_qr', 'nonce' );

	$user_id = (int) get_current_user_id();
	$body    = hb_build_user_vcard_body( $user_id );
	if ( '' === $body ) {
		wp_send_json_error( array( 'message' => __( 'Could not build vCard from profile.', 'hello-elementor-child' ) ) );
	}

	$file_url = hb_save_user_vcard_file( $user_id, $body );
	if ( is_wp_error( $file_url ) ) {
		wp_send_json_error( array( 'message' => $file_url->get_error_message() ) );
	}

	$qr = hb_generate_qrtiger_qr_for_vcard( $file_url );
	if ( is_wp_error( $qr ) ) {
		wp_send_json_error(
			array(
				'message' => $qr->get_error_message(),
				'url'     => $file_url,
			)
		);
	}

	update_user_meta( $user_id, 'hb_vcard_file_url', esc_url_raw( $file_url ) );
	update_user_meta( $user_id, 'hb_vcard_qr_image_url', $qr['image_url'] );
	update_user_meta( $user_id, 'hb_vcard_qr_id', $qr['qr_id'] );

	wp_send_json_success(
		array(
			'url'          => esc_url_raw( $file_url ),
			'qr_image_url' => $qr['image_url'],
			'message'      => __( 'VCard generated successfully.', 'hello-elementor-child' ),
		)
	);
}
add_action( 'wp_ajax_hb_generate_vcard_qr', 'hb_ajax_generate_vcard_qr' );

/**
 * AJAX: Delete saved VCard and QR references.
 */
function hb_ajax_delete_vcard_qr() {
	if ( ! is_user_logged_in() ) {
		wp_send_json_error( array( 'message' => __( 'You must be logged in.', 'hello-elementor-child' ) ), 401 );
	}
	check_ajax_referer( 'hb_delete_vcard_qr', 'nonce' );

	$user_id  = (int) get_current_user_id();
	$file_url = (string) get_user_meta( $user_id, 'hb_vcard_file_url', true );
	if ( $file_url !== '' ) {
		$upload = wp_upload_dir();
		if ( ! empty( $upload['basedir'] ) && preg_match( '#/hb-vcards/([^?#]+\.vcf)$#i', $file_url, $m ) ) {
			$path = trailingslashit( $upload['basedir'] ) . 'hb-vcards/' . wp_basename( $m[1] );
			if ( is_file( $path ) ) {
				if ( function_exists( 'wp_delete_file' ) ) {
					wp_delete_file( $path );
				} else {
					@unlink( $path );
				}
			}
		}
	}

	delete_user_meta( $user_id, 'hb_vcard_file_url' );
	delete_user_meta( $user_id, 'hb_vcard_qr_image_url' );
	delete_user_meta( $user_id, 'hb_vcard_qr_id' );

	wp_send_json_success( array( 'message' => __( 'VCard and QR removed.', 'hello-elementor-child' ) ) );
}
add_action( 'wp_ajax_hb_delete_vcard_qr', 'hb_ajax_delete_vcard_qr' );

/**
 * Download generated QR image for current user (PNG/JPG).
 */
function hb_ajax_download_vcard_qr() {
	nocache_headers();
	if ( ! is_user_logged_in() ) {
		status_header( 403 );
		wp_die( esc_html__( 'Forbidden.', 'hello-elementor-child' ) );
	}
	if ( ! isset( $_GET['nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_GET['nonce'] ) ), 'hb_download_vcard_qr' ) ) {
		status_header( 403 );
		wp_die( esc_html__( 'Invalid security token.', 'hello-elementor-child' ) );
	}
	$format = isset( $_GET['format'] ) ? strtolower( sanitize_key( wp_unslash( $_GET['format'] ) ) ) : 'png';
	if ( 'jpeg' === $format ) {
		$format = 'jpg';
	}
	if ( ! in_array( $format, array( 'png', 'jpg' ), true ) ) {
		$format = 'png';
	}

	$user_id = (int) get_current_user_id();
	$img_url = (string) get_user_meta( $user_id, 'hb_vcard_qr_image_url', true );
	if ( '' === $img_url ) {
		status_header( 404 );
		wp_die( esc_html__( 'No QR image available.', 'hello-elementor-child' ) );
	}

	$response = wp_remote_get(
		$img_url,
		array(
			'timeout' => 25,
			'headers' => array( 'Accept' => 'image/*,*/*;q=0.8' ),
		)
	);
	if ( is_wp_error( $response ) || (int) wp_remote_retrieve_response_code( $response ) !== 200 ) {
		status_header( 502 );
		wp_die( esc_html__( 'Could not fetch QR image.', 'hello-elementor-child' ) );
	}
	$binary = wp_remote_retrieve_body( $response );
	if ( '' === $binary ) {
		status_header( 502 );
		wp_die( esc_html__( 'Empty image response.', 'hello-elementor-child' ) );
	}

	$filename = 'vcard-qr-' . $user_id;
	if ( 'jpg' === $format ) {
		if ( ! function_exists( 'imagecreatefromstring' ) || ! function_exists( 'imagejpeg' ) ) {
			status_header( 501 );
			wp_die( esc_html__( 'JPG export needs PHP GD. Use PNG instead.', 'hello-elementor-child' ) );
		}
		$im = @imagecreatefromstring( $binary );
		if ( ! $im ) {
			status_header( 500 );
			wp_die( esc_html__( 'Could not convert image to JPG.', 'hello-elementor-child' ) );
		}
		header( 'Content-Type: image/jpeg' );
		header( 'Content-Disposition: attachment; filename="' . sanitize_file_name( $filename . '.jpg' ) . '"' );
		header( 'X-Content-Type-Options: nosniff' );
		imagejpeg( $im, null, 92 );
		imagedestroy( $im );
		exit;
	}

	header( 'Content-Type: image/png' );
	header( 'Content-Disposition: attachment; filename="' . sanitize_file_name( $filename . '.png' ) . '"' );
	header( 'X-Content-Type-Options: nosniff' );
	// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	echo $binary;
	exit;
}
add_action( 'wp_ajax_hb_download_vcard_qr', 'hb_ajax_download_vcard_qr' );

/**
 * Render VCard endpoint content on Woo My Account.
 */
function hb_render_vcard_account_endpoint() {
	if ( ! is_user_logged_in() ) {
		echo '<p>' . esc_html__( 'Please log in to manage your VCard.', 'hello-elementor-child' ) . '</p>';
		return;
	}

	$user_id      = (int) get_current_user_id();
	$saved_vcard  = (string) get_user_meta( $user_id, 'hb_vcard_file_url', true );
	$saved_qr_img = (string) get_user_meta( $user_id, 'hb_vcard_qr_image_url', true );
	$ajax_url     = admin_url( 'admin-ajax.php' );
	$gen_nonce    = wp_create_nonce( 'hb_generate_vcard_qr' );
	$del_nonce    = wp_create_nonce( 'hb_delete_vcard_qr' );
	$dl_nonce     = wp_create_nonce( 'hb_download_vcard_qr' );
	$png_href     = add_query_arg(
		array(
			'action' => 'hb_download_vcard_qr',
			'format' => 'png',
			'nonce'  => $dl_nonce,
		),
		$ajax_url
	);
	$jpg_href     = add_query_arg(
		array(
			'action' => 'hb_download_vcard_qr',
			'format' => 'jpg',
			'nonce'  => $dl_nonce,
		),
		$ajax_url
	);

	echo '<div id="hb-vcard-tools" data-ajax-url="' . esc_attr( $ajax_url ) . '" data-generate-nonce="' . esc_attr( $gen_nonce ) . '" data-delete-nonce="' . esc_attr( $del_nonce ) . '" data-download-nonce="' . esc_attr( $dl_nonce ) . '">';
	echo '<h3>' . esc_html__( 'VCard', 'hello-elementor-child' ) . '</h3>';
	echo '<p>' . esc_html__( 'Generate your QR Tiger vCard from your account profile.', 'hello-elementor-child' ) . '</p>';
	echo '<p><button type="button" class="button alt" id="hb-vcard-generate-btn">' . esc_html__( 'Generate VCard', 'hello-elementor-child' ) . '</button> <span id="hb-vcard-status" role="status" aria-live="polite"></span></p>';
	echo '<p><label for="hb-vcard-url"><strong>' . esc_html__( 'VCard URL', 'hello-elementor-child' ) . '</strong></label><br><input type="url" id="hb-vcard-url" value="' . esc_attr( $saved_vcard ) . '" readonly style="width:100%;max-width:760px;"></p>';
	echo '<p><button type="button" class="button" id="hb-vcard-copy-url-btn">' . esc_html__( 'Copy vCard URL', 'hello-elementor-child' ) . '</button></p>';
	echo '<div id="hb-vcard-qr-section"' . ( $saved_qr_img === '' ? ' style="display:none;"' : '' ) . '>';
	echo '<h4>' . esc_html__( 'Generated QR', 'hello-elementor-child' ) . '</h4>';
	echo '<p><img id="hb-vcard-qr-img" src="' . esc_url( $saved_qr_img ) . '" alt="' . esc_attr__( 'VCard QR code', 'hello-elementor-child' ) . '" style="max-width:320px;height:auto;border-radius:8px;"></p>';
	echo '<p><a class="button" id="hb-vcard-download-png" href="' . esc_url( $png_href ) . '">' . esc_html__( 'Download QR (PNG)', 'hello-elementor-child' ) . '</a> ';
	echo '<a class="button" id="hb-vcard-download-jpg" href="' . esc_url( $jpg_href ) . '">' . esc_html__( 'Download QR (JPG)', 'hello-elementor-child' ) . '</a> ';
	echo '<button type="button" class="button" id="hb-vcard-copy-image-btn">' . esc_html__( 'Copy image URL', 'hello-elementor-child' ) . '</button> ';
	echo '<button type="button" class="button" id="hb-vcard-delete-btn">' . esc_html__( 'Delete', 'hello-elementor-child' ) . '</button></p>';
	echo '</div>';
	echo '</div>';
	?>
	<script>
	(function () {
		var root = document.getElementById("hb-vcard-tools");
		if (!root || root.dataset.ready === "1") { return; }
		root.dataset.ready = "1";
		var statusEl = document.getElementById("hb-vcard-status");
		var urlInput = document.getElementById("hb-vcard-url");
		var qrImg = document.getElementById("hb-vcard-qr-img");
		var qrSection = document.getElementById("hb-vcard-qr-section");
		var ajaxUrl = root.getAttribute("data-ajax-url") || "";
		function setStatus(msg, isError) {
			if (!statusEl) { return; }
			statusEl.textContent = msg || "";
			statusEl.style.color = isError ? "#ff6b6b" : "";
		}
		function post(action, nonce) {
			var body = new URLSearchParams();
			body.append("action", action);
			body.append("nonce", nonce);
			return fetch(ajaxUrl, {
				method: "POST",
				credentials: "same-origin",
				headers: { "Content-Type": "application/x-www-form-urlencoded; charset=UTF-8" },
				body: body.toString()
			}).then(function (r) { return r.json(); });
		}
		function copyText(value) {
			if (!value) { return Promise.reject(new Error("Missing value")); }
			if (navigator.clipboard && navigator.clipboard.writeText) { return navigator.clipboard.writeText(value); }
			var t = document.createElement("textarea");
			t.value = value;
			document.body.appendChild(t);
			t.select();
			document.execCommand("copy");
			document.body.removeChild(t);
			return Promise.resolve();
		}
		document.addEventListener("click", function (ev) {
			var gen = ev.target.closest("#hb-vcard-generate-btn");
			if (gen) {
				ev.preventDefault();
				gen.disabled = true;
				setStatus("Generating...", false);
				post("hb_generate_vcard_qr", root.getAttribute("data-generate-nonce") || "")
					.then(function (res) {
						var data = (res && res.data) ? res.data : {};
						if (!res || !res.success) {
							setStatus((data && data.message) ? data.message : "Could not generate VCard.", true);
							return;
						}
						if (urlInput && data.url) { urlInput.value = data.url; }
						if (qrImg && data.qr_image_url) { qrImg.src = data.qr_image_url; }
						if (qrSection) { qrSection.style.display = ""; }
						setStatus(data.message || "Generated.", false);
					})
					.catch(function () { setStatus("Could not generate VCard.", true); })
					.finally(function () { gen.disabled = false; });
				return;
			}
			var del = ev.target.closest("#hb-vcard-delete-btn");
			if (del) {
				ev.preventDefault();
				del.disabled = true;
				setStatus("Removing...", false);
				post("hb_delete_vcard_qr", root.getAttribute("data-delete-nonce") || "")
					.then(function (res) {
						if (res && res.success) {
							if (urlInput) { urlInput.value = ""; }
							if (qrImg) { qrImg.src = ""; }
							if (qrSection) { qrSection.style.display = "none"; }
							setStatus((res.data && res.data.message) ? res.data.message : "Removed.", false);
						} else {
							setStatus((res && res.data && res.data.message) ? res.data.message : "Could not remove.", true);
						}
					})
					.catch(function () { setStatus("Could not remove.", true); })
					.finally(function () { del.disabled = false; });
				return;
			}
			var copyUrl = ev.target.closest("#hb-vcard-copy-url-btn");
			if (copyUrl) {
				ev.preventDefault();
				copyText(urlInput ? urlInput.value : "").then(function () {
					setStatus("vCard URL copied.", false);
				}).catch(function () {
					setStatus("Could not copy URL.", true);
				});
				return;
			}
			var copyImg = ev.target.closest("#hb-vcard-copy-image-btn");
			if (copyImg) {
				ev.preventDefault();
				copyText(qrImg ? qrImg.src : "").then(function () {
					setStatus("Image URL copied.", false);
				}).catch(function () {
					setStatus("Could not copy image URL.", true);
				});
			}
		});
	})();
	</script>
	<?php
}
add_action( 'woocommerce_account_vcard_endpoint', 'hb_render_vcard_account_endpoint' );
