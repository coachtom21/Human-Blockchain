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

	$is_account_ui = false;
	if ( function_exists( 'is_account_page' ) && is_account_page() ) {
		$is_account_ui = true;
	} elseif ( is_page_template( 'templates-parts/template-my-account.php' ) ) {
		$is_account_ui = true;
	}
	if ( $is_account_ui ) {
		$my_account_css = get_stylesheet_directory() . '/assets/css/my-account.css';
		wp_enqueue_style(
			'hb-my-account-ui',
			get_stylesheet_directory_uri() . '/assets/css/my-account.css',
			array( 'hello-elementor-child-style' ),
			file_exists( $my_account_css ) ? filemtime( $my_account_css ) : HELLO_ELEMENTOR_CHILD_VERSION
		);
	}

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

}
add_action( 'wp_enqueue_scripts', 'hello_elementor_child_scripts_styles', 20 );


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
	echo '<th style="text-align:left;padding:8px;border-bottom:1px solid #ddd;">' . esc_html__( 'Remote', 'hello-elementor-child' ) . '</th>';
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
		echo '<td style="padding:8px;border-bottom:1px solid #eee;">' . esc_html( isset( $row->remote_sync_status ) ? (string) $row->remote_sync_status : '' ) . '</td>';
		echo '<td style="padding:8px;border-bottom:1px solid #eee;">' . esc_html( isset( $row->ledger_date ) ? (string) $row->ledger_date : '' ) . '</td>';
		echo '</tr>';
	}

	echo '</tbody></table></div>';
}
add_action( 'woocommerce_account_xp-ledger_endpoint', 'hb_render_xp_ledger_account_endpoint' );
