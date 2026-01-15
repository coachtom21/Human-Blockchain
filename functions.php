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
