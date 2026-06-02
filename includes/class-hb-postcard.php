<?php
/**
 * Human Blockchain — 4×6 printable postcard (My Account).
 *
 * @package HelloElementorChild
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Postcard generator: personal NWP referral QR on a 4×6 layout.
 */
class Hb_Postcard {

	const META_POC       = 'hb_postcard_poc_name';
	const META_SPONSOR   = 'hb_postcard_sponsor_name';
	const META_CAMPAIGN  = 'hb_postcard_campaign_message';
	const META_IMAGE_URL = 'hb_postcard_image_url';
	const META_REF_URL   = 'hb_postcard_referral_url';

	/** Reference canvas for QR placement (matches Detente2030Postcard.png). */
	const REF_WIDTH  = 1536;
	const REF_HEIGHT = 1024;

	/** Default master artwork (Media Library). */
	const DEFAULT_TEMPLATE_URL = 'https://humanblockchain.info/wp-content/uploads/2026/06/Detente2030Postcard.png';

	/**
	 * Bootstrap hooks.
	 *
	 * @return void
	 */
	public static function init() {
		add_action( 'init', array( __CLASS__, 'register_endpoint' ) );
		add_filter( 'woocommerce_account_menu_items', array( __CLASS__, 'account_menu_item' ), 41 );
		add_action( 'woocommerce_account_postcard_endpoint', array( __CLASS__, 'render_endpoint' ) );
		add_action( 'woocommerce_account_vcard_endpoint', array( __CLASS__, 'redirect_vcard_to_postcard' ) );

		add_action( 'wp_ajax_hb_save_postcard_fields', array( __CLASS__, 'ajax_save_fields' ) );
		add_action( 'wp_ajax_hb_generate_postcard', array( __CLASS__, 'ajax_generate' ) );
		add_action( 'wp_ajax_hb_delete_postcard', array( __CLASS__, 'ajax_delete' ) );
		add_action( 'wp_ajax_hb_download_postcard', array( __CLASS__, 'ajax_download' ) );

		add_filter( 'cpm_hb_referral_source_nwp_id', array( __CLASS__, 'map_referral_user_to_device' ) );
	}

	/**
	 * Register WooCommerce endpoint slug.
	 *
	 * @return void
	 */
	public static function register_endpoint() {
		add_rewrite_endpoint( 'postcard', EP_ROOT | EP_PAGES );
		// Legacy slug still resolves (redirect handler above).
		add_rewrite_endpoint( 'vcard', EP_ROOT | EP_PAGES );
	}

	/**
	 * @param array<string, string> $items Menu items.
	 * @return array<string, string>
	 */
	public static function account_menu_item( $items ) {
		if ( ! is_array( $items ) ) {
			return $items;
		}
		unset( $items['vcard'] );
		$new_items = array();
		$inserted  = false;
		foreach ( $items as $key => $label ) {
			$new_items[ $key ] = $label;
			if ( 'xp-ledger' === $key ) {
				$new_items['postcard'] = __( 'Postcard', 'hello-elementor-child' );
				$inserted            = true;
			}
		}
		if ( ! $inserted ) {
			$new_items['postcard'] = __( 'Postcard', 'hello-elementor-child' );
		}
		return $new_items;
	}

	/**
	 * Legacy VCard tab → Postcard.
	 *
	 * @return void
	 */
	public static function redirect_vcard_to_postcard() {
		wp_safe_redirect( wc_get_account_endpoint_url( 'postcard' ) );
		exit;
	}

	/**
	 * Map ?ref={user_id} to wp_nwp_devices.id when needed.
	 *
	 * @param int $ref Referral value from registration form.
	 * @return int
	 */
	public static function map_referral_user_to_device( $ref ) {
		$ref = absint( $ref );
		if ( $ref <= 0 ) {
			return 0;
		}
		global $wpdb;
		$table = $wpdb->prefix . 'nwp_devices';
		if ( $wpdb->get_var( $wpdb->prepare( "SHOW TABLES LIKE %s", $table ) ) !== $table ) {
			return $ref;
		}
		$exists = $wpdb->get_var( $wpdb->prepare( "SELECT id FROM {$table} WHERE id = %d LIMIT 1", $ref ) );
		if ( $exists ) {
			return (int) $ref;
		}
		$mapped = $wpdb->get_var( $wpdb->prepare( "SELECT id FROM {$table} WHERE user_id = %d ORDER BY id DESC LIMIT 1", $ref ) );
		return $mapped ? (int) $mapped : $ref;
	}

	/**
	 * Personal referral landing URL (home / YAM landing with ref).
	 *
	 * @param int $user_id User ID.
	 * @return string
	 */
	public static function get_referral_url( $user_id ) {
		$user_id = (int) $user_id;
		$base    = apply_filters( 'hb_postcard_referral_landing_url', home_url( '/' ), $user_id );
		$url     = add_query_arg( 'ref', $user_id, $base );
		return esc_url_raw( apply_filters( 'hb_postcard_referral_url', $url, $user_id ) );
	}

	/**
	 * Ensure a QR Tiger hosted vCard scan URL exists (photo, name, contact buttons).
	 *
	 * Regenerates the vCard campaign so profile data stays current on each postcard build.
	 *
	 * @param int $user_id User ID.
	 * @return string|WP_Error Public scan URL (e.g. qr1.be/…).
	 */
	public static function ensure_vcard_scan_url( $user_id ) {
		$user_id = (int) $user_id;
		if ( ! function_exists( 'hb_generate_qrtiger_qr_for_vcard' ) ) {
			return new WP_Error(
				'no_vcard',
				__( 'vCard generator is unavailable. Check that the theme is loaded correctly.', 'hello-elementor-child' )
			);
		}

		$previous_qr = (string) get_user_meta( $user_id, 'hb_vcard_qr_image_url', true );
		if ( $previous_qr !== '' && function_exists( 'hb_delete_qr_image_file_for_user' ) ) {
			hb_delete_qr_image_file_for_user( $user_id, $previous_qr );
		}

		$qr = hb_generate_qrtiger_qr_for_vcard( $user_id );
		if ( is_wp_error( $qr ) ) {
			return $qr;
		}

		if ( ! empty( $qr['short_url'] ) ) {
			update_user_meta( $user_id, 'hb_vcard_short_url', esc_url_raw( $qr['short_url'] ) );
		}
		if ( ! empty( $qr['qr_id'] ) ) {
			update_user_meta( $user_id, 'hb_vcard_qr_id', sanitize_text_field( (string) $qr['qr_id'] ) );
		}
		if ( ! empty( $qr['image_url'] ) && function_exists( 'hb_persist_qr_image_to_file' ) ) {
			$persisted = hb_persist_qr_image_to_file( $user_id, $qr['image_url'] );
			if ( ! is_wp_error( $persisted ) ) {
				update_user_meta( $user_id, 'hb_vcard_qr_image_url', esc_url_raw( $persisted ) );
			}
		}

		$scan_url = ! empty( $qr['short_url'] ) ? (string) $qr['short_url'] : (string) get_user_meta( $user_id, 'hb_vcard_short_url', true );
		if ( $scan_url === '' ) {
			return new WP_Error(
				'no_scan_url',
				__( 'QRTiger did not return a vCard scan URL. Check API settings in NWP Gateway.', 'hello-elementor-child' )
			);
		}

		return esc_url_raw( apply_filters( 'hb_postcard_vcard_scan_url', $scan_url, $user_id ) );
	}

	/**
	 * URL encoded in the postcard QR (hosted vCard contact page).
	 *
	 * @param int $user_id User ID.
	 * @return string
	 */
	public static function get_display_scan_url( $user_id ) {
		$user_id = (int) $user_id;
		$vcard   = (string) get_user_meta( $user_id, 'hb_vcard_short_url', true );
		if ( $vcard !== '' ) {
			return $vcard;
		}
		return (string) get_user_meta( $user_id, self::META_REF_URL, true );
	}

	/**
	 * @param int $user_id User ID.
	 * @return array{poc:string,sponsor:string,campaign:string}
	 */
	public static function get_fields( $user_id ) {
		$user_id = (int) $user_id;
		return array(
			'poc'      => (string) get_user_meta( $user_id, self::META_POC, true ),
			'sponsor'  => (string) get_user_meta( $user_id, self::META_SPONSOR, true ),
			'campaign' => (string) get_user_meta( $user_id, self::META_CAMPAIGN, true ),
		);
	}

	/**
	 * @param int                $user_id User ID.
	 * @param array<string,mixed> $raw     POST fields.
	 * @return array{poc:string,sponsor:string,campaign:string}|WP_Error
	 */
	public static function save_fields( $user_id, array $raw ) {
		$poc      = isset( $raw['poc'] ) ? sanitize_text_field( wp_unslash( $raw['poc'] ) ) : '';
		$sponsor  = isset( $raw['sponsor'] ) ? sanitize_text_field( wp_unslash( $raw['sponsor'] ) ) : '';
		$campaign = isset( $raw['campaign'] ) ? sanitize_textarea_field( wp_unslash( $raw['campaign'] ) ) : '';
		$poc      = mb_substr( $poc, 0, 80 );
		$sponsor  = mb_substr( $sponsor, 0, 80 );
		$campaign = mb_substr( $campaign, 0, 200 );

		update_user_meta( (int) $user_id, self::META_POC, $poc );
		update_user_meta( (int) $user_id, self::META_SPONSOR, $sponsor );
		update_user_meta( (int) $user_id, self::META_CAMPAIGN, $campaign );

		return array(
			'poc'      => $poc,
			'sponsor'  => $sponsor,
			'campaign' => $campaign,
		);
	}

	/**
	 * Footer contact line for postcard.
	 *
	 * @param int $user_id User ID.
	 * @return string
	 */
	public static function get_footer_line( $user_id ) {
		$user    = get_userdata( (int) $user_id );
		$site    = wp_parse_url( home_url( '/' ), PHP_URL_HOST );
		$site    = is_string( $site ) ? $site : 'humanblockchain.info';
		$discord = apply_filters(
			'cpm_nwp_discord_invite_url',
			get_option( 'cpm_nwp_discord_invite_url', 'https://discord.com/invite/g5jreAPbra' )
		);
		$phone   = (string) get_user_meta( (int) $user_id, 'billing_phone', true );
		if ( '' === $phone ) {
			$phone = (string) get_user_meta( (int) $user_id, 'mega-mobile', true );
		}
		$email = $user instanceof WP_User ? (string) $user->user_email : '';
		$parts = array( $site );
		if ( is_string( $discord ) && $discord !== '' ) {
			$parts[] = 'Discord Gracebook';
		}
		if ( $email !== '' ) {
			$parts[] = $email;
		} elseif ( $phone !== '' ) {
			$parts[] = $phone;
		}
		return implode( ' • ', $parts );
	}

	/**
	 * Fetch QR PNG binary for a URL.
	 *
	 * @param string $target_url URL to encode.
	 * @param int    $size       Pixel size.
	 * @return string|WP_Error
	 */
	public static function fetch_qr_png( $target_url, $size = 400 ) {
		$size    = max( 120, min( 600, (int) $size ) );
		$base    = apply_filters( 'cpm_nwp_qr_png_remote_url', 'https://api.qrserver.com/v1/create-qr-code/?size=' . $size . 'x' . $size . '&data=', $target_url );
		$req_url = $base . rawurlencode( $target_url );
		$resp    = wp_remote_get(
			$req_url,
			array(
				'timeout'   => 25,
				'sslverify' => true,
			)
		);
		if ( is_wp_error( $resp ) ) {
			return $resp;
		}
		$code = (int) wp_remote_retrieve_response_code( $resp );
		$body = (string) wp_remote_retrieve_body( $resp );
		if ( $code < 200 || $code >= 300 || strlen( $body ) < 8 ) {
			return new WP_Error( 'qr_fetch', __( 'Could not generate QR code.', 'hello-elementor-child' ) );
		}
		if ( "\x89PNG" !== substr( $body, 0, 4 ) ) {
			return new WP_Error( 'qr_invalid', __( 'QR service did not return a valid PNG.', 'hello-elementor-child' ) );
		}
		return $body;
	}

	/**
	 * Configured master template URL.
	 *
	 * @return string
	 */
	private static function get_template_url_config() {
		$url = apply_filters( 'hb_postcard_template_url', self::DEFAULT_TEMPLATE_URL );
		if ( ! is_string( $url ) || trim( $url ) === '' ) {
			$att_id = (int) apply_filters( 'hb_postcard_template_attachment_id', 0 );
			if ( $att_id > 0 ) {
				$url = (string) wp_get_attachment_url( $att_id );
			}
		}
		$url = is_string( $url ) ? trim( $url ) : '';
		if ( $url !== '' ) {
			return esc_url_raw( $url );
		}
		$theme_default = get_stylesheet_directory() . '/assets/images/medici-postcard-master.png';
		if ( is_file( $theme_default ) ) {
			return trailingslashit( get_stylesheet_directory_uri() ) . 'assets/images/medici-postcard-master.png';
		}
		return '';
	}

	/**
	 * Resolve optional master template image path on disk.
	 *
	 * @return string Absolute path or empty.
	 */
	private static function get_template_path() {
		$url = self::get_template_url_config();
		if ( $url === '' ) {
			return '';
		}
		$upload = wp_upload_dir();
		if ( ! empty( $upload['basedir'] ) && ! empty( $upload['baseurl'] ) && 0 === strpos( $url, $upload['baseurl'] ) ) {
			$rel  = ltrim( substr( $url, strlen( $upload['baseurl'] ) ), '/' );
			$path = trailingslashit( $upload['basedir'] ) . rawurldecode( $rel );
			return is_file( $path ) ? $path : '';
		}
		if ( 0 === strpos( $url, get_stylesheet_directory_uri() ) ) {
			$rel  = ltrim( substr( $url, strlen( get_stylesheet_directory_uri() ) ), '/' );
			$path = trailingslashit( get_stylesheet_directory() ) . $rel;
			return is_file( $path ) ? $path : '';
		}
		// Same site, different scheme/host (e.g. humanblockchain.local vs .info).
		$path_from_url = self::path_from_site_upload_url( $url );
		if ( $path_from_url !== '' && is_file( $path_from_url ) ) {
			return $path_from_url;
		}
		return '';
	}

	/**
	 * Map /wp-content/uploads/... URL to local uploads path when possible.
	 *
	 * @param string $url Media URL.
	 * @return string
	 */
	private static function path_from_site_upload_url( $url ) {
		$path = wp_parse_url( $url, PHP_URL_PATH );
		if ( ! is_string( $path ) || strpos( $path, '/wp-content/uploads/' ) === false ) {
			return '';
		}
		$upload = wp_upload_dir();
		if ( empty( $upload['basedir'] ) ) {
			return '';
		}
		$rel  = ltrim( substr( $path, strpos( $path, '/wp-content/uploads/' ) + strlen( '/wp-content/uploads/' ) ), '/' );
		$full = trailingslashit( $upload['basedir'] ) . rawurldecode( $rel );
		return $full;
	}

	/**
	 * Load master artwork from disk or remote URL.
	 *
	 * @return resource|\GdImage|WP_Error
	 */
	private static function load_master_image() {
		$url  = self::get_template_url_config();
		$path = self::get_template_path();
		if ( $path !== '' ) {
			$img = self::load_template_image( $path );
			if ( $img ) {
				return $img;
			}
		}
		if ( $url === '' ) {
			return new WP_Error(
				'no_template',
				__( 'Postcard master artwork is not configured.', 'hello-elementor-child' )
			);
		}
		$response = wp_remote_get(
			$url,
			array(
				'timeout'   => 30,
				'sslverify' => true,
			)
		);
		if ( is_wp_error( $response ) ) {
			return $response;
		}
		$code = (int) wp_remote_retrieve_response_code( $response );
		$body = (string) wp_remote_retrieve_body( $response );
		if ( $code < 200 || $code >= 300 || $body === '' ) {
			return new WP_Error( 'template_fetch', __( 'Could not download the postcard master artwork.', 'hello-elementor-child' ) );
		}
		$img = imagecreatefromstring( $body );
		if ( ! $img ) {
			return new WP_Error( 'template_load', __( 'Could not load the postcard master artwork.', 'hello-elementor-child' ) );
		}
		return $img;
	}

	/**
	 * Public URL for the master template (preview in My Account).
	 *
	 * @return string
	 */
	public static function get_template_url() {
		$url = self::get_template_url_config();
		return $url !== '' ? $url : '';
	}

	/**
	 * Load master artwork from disk.
	 *
	 * @return resource|\GdImage|null
	 */
	private static function load_template_image( $path ) {
		$ext = strtolower( pathinfo( $path, PATHINFO_EXTENSION ) );
		if ( in_array( $ext, array( 'jpg', 'jpeg' ), true ) ) {
			return imagecreatefromjpeg( $path );
		}
		if ( 'png' === $ext ) {
			return imagecreatefrompng( $path );
		}
		return null;
	}

	/**
	 * QR stamp position scaled to the master canvas (bottom-right on Medici art).
	 *
	 * @param int $w Canvas width.
	 * @param int $h Canvas height.
	 * @param int $user_id User ID.
	 * @return array{x:int,y:int,size:int,wipe:bool}
	 */
	private static function get_qr_placement( $w, $h, $user_id ) {
		$ref = apply_filters(
			'hb_postcard_qr_placement_ref',
			array(
				'x'    => 1310,
				'y'    => 840,
				'size' => 150,
			),
			$user_id
		);
		$scale_x = $w / self::REF_WIDTH;
		$scale_y = $h / self::REF_HEIGHT;
		$scale   = ( $scale_x + $scale_y ) / 2;
		$placement = array(
			'x'    => (int) round( (float) ( $ref['x'] ?? 1485 ) * $scale_x ),
			'y'    => (int) round( (float) ( $ref['y'] ?? 855 ) * $scale_y ),
			'size' => (int) round( (float) ( $ref['size'] ?? 230 ) * $scale ),
			'wipe' => (bool) apply_filters( 'hb_postcard_qr_wipe_background', true, $user_id ),
		);
		return apply_filters( 'hb_postcard_qr_placement', $placement, $user_id, $w, $h );
	}

	/**
	 * Optional "To:" address block (left of QR on master art).
	 *
	 * @param int $w Canvas width.
	 * @param int $h Canvas height.
	 * @param int $user_id User ID.
	 * @return array{x:int,y:int,w:int,h:int}
	 */
	private static function get_address_zone( $w, $h, $user_id ) {
		$ref = array(
			'x' => 836,
			'y' => 768,
			'w' => 392,
			'h' => 154,
		);
		$scale_x = $w / self::REF_WIDTH;
		$scale_y = $h / self::REF_HEIGHT;
		$zone    = array(
			'x' => (int) round( $ref['x'] * $scale_x ),
			'y' => (int) round( $ref['y'] * $scale_y ),
			'w' => (int) round( $ref['w'] * $scale_x ),
			'h' => (int) round( $ref['h'] * $scale_y ),
		);
		return apply_filters( 'hb_postcard_address_zone', $zone, $user_id, $w, $h );
	}

	/**
	 * @return string
	 */
	private static function get_font_path() {
		$candidates = array(
			get_stylesheet_directory() . '/assets/fonts/Georgia.ttf',
			'/System/Library/Fonts/Supplemental/Georgia.ttf',
			'/Library/Fonts/Georgia.ttf',
			'/usr/share/fonts/truetype/liberation/LiberationSerif-Regular.ttf',
			'/usr/share/fonts/truetype/dejavu/DejaVuSerif.ttf',
		);
		foreach ( $candidates as $path ) {
			if ( is_file( $path ) ) {
				return $path;
			}
		}
		return '';
	}

	/**
	 * Draw wrapped TTF text; falls back to imagestring.
	 *
	 * @param \GdImage|resource $img    Image.
	 * @param int               $size   Font size.
	 * @param int               $x      X.
	 * @param int               $y      Y.
	 * @param int               $max_w  Max width.
	 * @param string            $text   Text.
	 * @param int               $color  GD color.
	 * @return int New Y after text.
	 */
	private static function draw_text_block( $img, $size, $x, $y, $max_w, $text, $color ) {
		$text = trim( (string) $text );
		if ( $text === '' ) {
			return $y;
		}
		$font = self::get_font_path();
		if ( $font !== '' && function_exists( 'imagettftext' ) ) {
			$words = preg_split( '/\s+/', $text );
			$line  = '';
			$lh    = (int) round( $size * 1.45 );
			foreach ( $words as $word ) {
				$test = $line === '' ? $word : $line . ' ' . $word;
				$box  = imagettfbbox( $size, 0, $font, $test );
				$w    = is_array( $box ) ? abs( $box[2] - $box[0] ) : 0;
				if ( $w > $max_w && $line !== '' ) {
					imagettftext( $img, $size, 0, $x, $y, $color, $font, $line );
					$y    += $lh;
					$line  = $word;
				} else {
					$line = $test;
				}
			}
			if ( $line !== '' ) {
				imagettftext( $img, $size, 0, $x, $y, $color, $font, $line );
				$y += $lh;
			}
			return $y;
		}
		imagestring( $img, 3, $x, $y, substr( $text, 0, 60 ), $color );
		return $y + 16;
	}

	/**
	 * Stamp personal QR (and optional address lines) onto the master postcard PNG.
	 *
	 * @param int $user_id User ID.
	 * @return string|WP_Error PNG binary.
	 */
	public static function compose_png( $user_id ) {
		if ( ! function_exists( 'imagecreatefrompng' ) ) {
			return new WP_Error( 'gd_missing', __( 'Image library (GD) is not available on this server.', 'hello-elementor-child' ) );
		}

		$user_id  = (int) $user_id;
		$fields   = self::get_fields( $user_id );
		$scan_url = self::ensure_vcard_scan_url( $user_id );

		if ( is_wp_error( $scan_url ) ) {
			return $scan_url;
		}

		if ( self::get_template_url_config() === '' ) {
			return new WP_Error(
				'no_template',
				__( 'Postcard master artwork is not configured.', 'hello-elementor-child' )
			);
		}

		$img = self::load_master_image();
		if ( is_wp_error( $img ) ) {
			return $img;
		}

		$w = imagesx( $img );
		$h = imagesy( $img );
		if ( $w < 1 || $h < 1 ) {
			imagedestroy( $img );
			return new WP_Error( 'template_size', __( 'Postcard master artwork has invalid dimensions.', 'hello-elementor-child' ) );
		}

		imagealphablending( $img, true );
		imagesavealpha( $img, true );

		$has_address = ( $fields['poc'] !== '' || $fields['sponsor'] !== '' || $fields['campaign'] !== '' );
		if ( $has_address ) {
			$zone  = self::get_address_zone( $w, $h, $user_id );
			$cream = imagecolorallocate( $img, 245, 230, 196 );
			$ink   = imagecolorallocate( $img, 29, 27, 22 );
			imagefilledrectangle( $img, $zone['x'], $zone['y'], $zone['x'] + $zone['w'], $zone['y'] + $zone['h'], $cream );
			$line_y = $zone['y'] + (int) round( $zone['h'] * 0.22 );
			if ( $fields['poc'] !== '' ) {
				self::draw_text_block( $img, 14, $zone['x'] + 12, $line_y, $zone['w'] - 24, 'TO: ' . $fields['poc'], $ink );
				$line_y += 28;
			}
			if ( $fields['sponsor'] !== '' ) {
				self::draw_text_block( $img, 12, $zone['x'] + 12, $line_y, $zone['w'] - 24, 'Sponsor: ' . $fields['sponsor'], $ink );
				$line_y += 24;
			}
			if ( $fields['campaign'] !== '' ) {
				self::draw_text_block( $img, 11, $zone['x'] + 12, $line_y, $zone['w'] - 24, $fields['campaign'], $ink );
			}
		}

		$placement   = self::get_qr_placement( $w, $h, $user_id );
		$qr_binary   = self::fetch_qr_png( $scan_url, max( 200, $placement['size'] + 40 ) );
		if ( is_wp_error( $qr_binary ) ) {
			imagedestroy( $img );
			return $qr_binary;
		}

		$qr_img = imagecreatefromstring( $qr_binary );
		if ( ! $qr_img ) {
			imagedestroy( $img );
			return new WP_Error( 'qr_decode', __( 'Could not decode QR image.', 'hello-elementor-child' ) );
		}

		$qr_size = (int) $placement['size'];
		$qr_x    = (int) $placement['x'];
		$qr_y    = (int) $placement['y'];
		$wipe_pad = (int) apply_filters( 'hb_postcard_qr_wipe_padding', 8, $user_id, $placement );
		$wipe_pad = max( 0, min( 32, $wipe_pad ) );

		if ( ! empty( $placement['wipe'] ) ) {
			$white = imagecolorallocate( $img, 255, 255, 255 );
			imagefilledrectangle( $img, $qr_x - $wipe_pad, $qr_y - $wipe_pad, $qr_x + $qr_size + $wipe_pad, $qr_y + $qr_size + $wipe_pad, $white );
		}

		imagecopyresampled( $img, $qr_img, $qr_x, $qr_y, 0, 0, $qr_size, $qr_size, imagesx( $qr_img ), imagesy( $qr_img ) );
		imagedestroy( $qr_img );

		ob_start();
		imagepng( $img, null, 6 );
		$png = ob_get_clean();
		imagedestroy( $img );

		return is_string( $png ) && $png !== '' ? $png : new WP_Error( 'png_empty', __( 'Postcard export failed.', 'hello-elementor-child' ) );
	}

	/**
	 * @param int    $user_id User ID.
	 * @param string $binary  PNG bytes.
	 * @return string|WP_Error Public URL.
	 */
	public static function persist_png( $user_id, $binary ) {
		$upload = wp_upload_dir();
		if ( ! empty( $upload['error'] ) || empty( $upload['basedir'] ) || empty( $upload['baseurl'] ) ) {
			return new WP_Error( 'upload_dir', __( 'Upload directory is not available.', 'hello-elementor-child' ) );
		}
		$dir = trailingslashit( $upload['basedir'] ) . 'hb-postcards';
		if ( ! wp_mkdir_p( $dir ) ) {
			return new WP_Error( 'mkdir', __( 'Could not create postcard storage folder.', 'hello-elementor-child' ) );
		}
		$filename = 'postcard-user-' . (int) $user_id . '-' . wp_generate_password( 6, false, false ) . '.png';
		$path     = trailingslashit( $dir ) . $filename;
		if ( false === file_put_contents( $path, $binary ) ) {
			return new WP_Error( 'write', __( 'Could not save postcard file.', 'hello-elementor-child' ) );
		}
		return trailingslashit( $upload['baseurl'] ) . 'hb-postcards/' . rawurlencode( $filename );
	}

	/**
	 * @param int    $user_id User ID.
	 * @param string $url     Stored URL.
	 * @return void
	 */
	public static function delete_file( $user_id, $url ) {
		if ( ! is_string( $url ) || $url === '' ) {
			return;
		}
		$upload = wp_upload_dir();
		if ( empty( $upload['basedir'] ) ) {
			return;
		}
		if ( ! preg_match( '#/hb-postcards/(postcard-user-' . (int) $user_id . '-[a-z0-9]+\.png)(?:\?|$)#i', $url, $m ) ) {
			return;
		}
		$path = trailingslashit( $upload['basedir'] ) . 'hb-postcards/' . wp_basename( $m[1] );
		if ( is_file( $path ) ) {
			wp_delete_file( $path );
		}
	}

	/**
	 * @return void
	 */
	public static function ajax_save_fields() {
		if ( ! is_user_logged_in() ) {
			wp_send_json_error( array( 'message' => __( 'You must be logged in.', 'hello-elementor-child' ) ), 401 );
		}
		check_ajax_referer( 'hb_postcard', 'nonce' );
		$user_id = (int) get_current_user_id();
		$fields  = self::save_fields( $user_id, $_POST );
		if ( is_wp_error( $fields ) ) {
			wp_send_json_error( array( 'message' => $fields->get_error_message() ) );
		}
		wp_send_json_success(
			array(
				'fields'  => $fields,
				'message' => __( 'Postcard details saved.', 'hello-elementor-child' ),
			)
		);
	}

	/**
	 * @return void
	 */
	public static function ajax_generate() {
		if ( ! is_user_logged_in() ) {
			wp_send_json_error( array( 'message' => __( 'You must be logged in.', 'hello-elementor-child' ) ), 401 );
		}
		check_ajax_referer( 'hb_postcard', 'nonce' );
		$user_id = (int) get_current_user_id();
		if ( ! empty( $_POST['poc'] ) || ! empty( $_POST['sponsor'] ) || ! empty( $_POST['campaign'] ) ) {
			self::save_fields( $user_id, $_POST );
		}
		$previous = (string) get_user_meta( $user_id, self::META_IMAGE_URL, true );
		self::delete_file( $user_id, $previous );

		$png = self::compose_png( $user_id );
		if ( is_wp_error( $png ) ) {
			wp_send_json_error( array( 'message' => $png->get_error_message() ) );
		}
		$url = self::persist_png( $user_id, $png );
		if ( is_wp_error( $url ) ) {
			wp_send_json_error( array( 'message' => $url->get_error_message() ) );
		}
		$scan_url = self::get_display_scan_url( $user_id );
		update_user_meta( $user_id, self::META_IMAGE_URL, esc_url_raw( $url ) );
		update_user_meta( $user_id, self::META_REF_URL, esc_url_raw( $scan_url ) );

		wp_send_json_success(
			array(
				'image_url'    => esc_url_raw( $url ),
				'scan_url'     => esc_url_raw( $scan_url ),
				'referral_url' => esc_url_raw( self::get_referral_url( $user_id ) ),
				'message'      => __( 'Postcard generated.', 'hello-elementor-child' ),
			)
		);
	}

	/**
	 * @return void
	 */
	public static function ajax_delete() {
		if ( ! is_user_logged_in() ) {
			wp_send_json_error( array( 'message' => __( 'You must be logged in.', 'hello-elementor-child' ) ), 401 );
		}
		check_ajax_referer( 'hb_postcard', 'nonce' );
		$user_id = (int) get_current_user_id();
		$url     = (string) get_user_meta( $user_id, self::META_IMAGE_URL, true );
		self::delete_file( $user_id, $url );
		delete_user_meta( $user_id, self::META_IMAGE_URL );
		delete_user_meta( $user_id, self::META_REF_URL );
		wp_send_json_success( array( 'message' => __( 'Postcard removed.', 'hello-elementor-child' ) ) );
	}

	/**
	 * @return void
	 */
	public static function ajax_download() {
		nocache_headers();
		if ( ! is_user_logged_in() ) {
			status_header( 403 );
			wp_die( esc_html__( 'Forbidden.', 'hello-elementor-child' ) );
		}
		if ( ! isset( $_GET['nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_GET['nonce'] ) ), 'hb_postcard_download' ) ) {
			status_header( 403 );
			wp_die( esc_html__( 'Invalid security token.', 'hello-elementor-child' ) );
		}
		$format = isset( $_GET['format'] ) ? strtolower( sanitize_key( wp_unslash( $_GET['format'] ) ) ) : 'png';
		if ( 'jpeg' === $format ) {
			$format = 'jpg';
		}
		$user_id = (int) get_current_user_id();
		$url     = (string) get_user_meta( $user_id, self::META_IMAGE_URL, true );
		if ( $url === '' ) {
			status_header( 404 );
			wp_die( esc_html__( 'No postcard available. Generate one first.', 'hello-elementor-child' ) );
		}
		$upload = wp_upload_dir();
		$path   = '';
		if ( ! empty( $upload['basedir'] ) && ! empty( $upload['baseurl'] ) && 0 === strpos( $url, $upload['baseurl'] ) ) {
			$rel  = ltrim( substr( $url, strlen( $upload['baseurl'] ) ), '/' );
			$path = trailingslashit( $upload['basedir'] ) . rawurldecode( $rel );
		}
		if ( $path === '' || ! is_file( $path ) ) {
			status_header( 404 );
			wp_die( esc_html__( 'Postcard file not found.', 'hello-elementor-child' ) );
		}
		$binary = (string) file_get_contents( $path );
		if ( $binary === '' ) {
			status_header( 502 );
			wp_die( esc_html__( 'Empty postcard file.', 'hello-elementor-child' ) );
		}
		if ( 'jpg' === $format && function_exists( 'imagecreatefrompng' ) ) {
			$im = imagecreatefrompng( $path );
			if ( $im ) {
				ob_start();
				imagejpeg( $im, null, 92 );
				$binary = ob_get_clean();
				imagedestroy( $im );
				header( 'Content-Type: image/jpeg' );
				header( 'Content-Disposition: attachment; filename="postcard-' . $user_id . '.jpg"' );
				header( 'Content-Length: ' . strlen( $binary ) );
				echo $binary; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				exit;
			}
		}
		header( 'Content-Type: image/png' );
		header( 'Content-Disposition: attachment; filename="postcard-' . $user_id . '.png"' );
		header( 'Content-Length: ' . strlen( $binary ) );
		echo $binary; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		exit;
	}

	/**
	 * My Account endpoint markup.
	 *
	 * @return void
	 */
	public static function render_endpoint() {
		if ( ! is_user_logged_in() ) {
			echo '<p>' . esc_html__( 'Please log in to manage your postcard.', 'hello-elementor-child' ) . '</p>';
			return;
		}

		$user_id     = (int) get_current_user_id();
		$image_url    = (string) get_user_meta( $user_id, self::META_IMAGE_URL, true );
		$scan_url     = self::get_display_scan_url( $user_id );
		$referral_url = self::get_referral_url( $user_id );
		$has_image    = $image_url !== '';
		$ajax_url    = admin_url( 'admin-ajax.php' );
		$nonce       = wp_create_nonce( 'hb_postcard' );
		$dl_nonce    = wp_create_nonce( 'hb_postcard_download' );
		$png_href    = add_query_arg(
			array(
				'action' => 'hb_download_postcard',
				'format' => 'png',
				'nonce'  => $dl_nonce,
			),
			$ajax_url
		);
		$jpg_href    = add_query_arg(
			array(
				'action' => 'hb_download_postcard',
				'format' => 'jpg',
				'nonce'  => $dl_nonce,
			),
			$ajax_url
		);
		$css_file    = get_stylesheet_directory() . '/assets/css/hb-postcard-account.css';
		$css_ver     = file_exists( $css_file ) ? (string) filemtime( $css_file ) : HELLO_ELEMENTOR_CHILD_VERSION;
		$js_file     = get_stylesheet_directory() . '/assets/js/hb-postcard-account.js';
		$js_ver      = file_exists( $js_file ) ? (string) filemtime( $js_file ) : HELLO_ELEMENTOR_CHILD_VERSION;

		wp_enqueue_style(
			'hb-postcard-account',
			get_stylesheet_directory_uri() . '/assets/css/hb-postcard-account.css',
			array(),
			$css_ver
		);
		wp_enqueue_script(
			'hb-postcard-account',
			get_stylesheet_directory_uri() . '/assets/js/hb-postcard-account.js',
			array(),
			$js_ver,
			true
		);
		wp_localize_script(
			'hb-postcard-account',
			'hbPostcard',
			array(
				'ajaxUrl' => $ajax_url,
				'nonce'   => $nonce,
				'i18n'    => array(
					'generating'  => __( 'Generating postcard…', 'hello-elementor-child' ),
					'saving'      => __( 'Saving…', 'hello-elementor-child' ),
					'copied'      => __( 'Copied.', 'hello-elementor-child' ),
					'copyFail'    => __( 'Could not copy.', 'hello-elementor-child' ),
					'confirmDel'  => __( 'Remove your saved postcard?', 'hello-elementor-child' ),
				),
			)
		);
		?>
		<div id="hb-postcard-tools" class="hb-postcard-tools" data-has-image="<?php echo $has_image ? '1' : '0'; ?>">
			<h3><?php esc_html_e( 'Postcard', 'hello-elementor-child' ); ?></h3>
			<p class="hb-postcard-intro">
				<?php esc_html_e( 'Your hosted vCard QR is stamped onto the official Detente 2030 Medici Dual-Ledger postcard (bottom-right). Scanning opens your contact page with photo, name, and save-to-phone options — same as the previous VCard flow.', 'hello-elementor-child' ); ?>
			</p>

			<div class="hb-postcard-layout">
				<div class="hb-postcard-form-col">
					<p class="hb-postcard-actions">
						<button type="button" class="button alt" id="hb-postcard-generate-btn">
							<?php echo $has_image ? esc_html__( 'Regenerate Postcard', 'hello-elementor-child' ) : esc_html__( 'Generate Postcard', 'hello-elementor-child' ); ?>
						</button>
						<span id="hb-postcard-status" role="status" aria-live="polite"></span>
					</p>

					<div class="hb-postcard-referral" id="hb-postcard-referral-wrap"<?php echo $has_image ? '' : ' hidden'; ?>>
						<label for="hb-postcard-ref-url"><strong><?php esc_html_e( 'Public vCard link (encoded in QR)', 'hello-elementor-child' ); ?></strong></label>
						<input type="url" id="hb-postcard-ref-url" readonly value="<?php echo esc_attr( $scan_url ); ?>" placeholder="<?php esc_attr_e( 'Generate postcard to create your vCard link', 'hello-elementor-child' ); ?>">
						<p class="hb-postcard-actions">
							<a class="button" id="hb-postcard-ref-preview" href="<?php echo esc_url( $scan_url !== '' ? $scan_url : '#' ); ?>" target="_blank" rel="noopener noreferrer"<?php echo $scan_url === '' ? ' aria-disabled="true" tabindex="-1"' : ''; ?>><?php esc_html_e( 'Preview vCard', 'hello-elementor-child' ); ?></a>
							<button type="button" class="button" id="hb-postcard-ref-copy"<?php echo $scan_url === '' ? ' disabled' : ''; ?>><?php esc_html_e( 'Copy link', 'hello-elementor-child' ); ?></button>
						</p>
						<p class="hb-postcard-referral-note">
							<?php esc_html_e( 'NWP referral link (separate from QR):', 'hello-elementor-child' ); ?>
							<a href="<?php echo esc_url( $referral_url ); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html( $referral_url ); ?></a>
						</p>
					</div>

					<div id="hb-postcard-download-wrap"<?php echo $has_image ? '' : ' hidden'; ?>>
						<p class="hb-postcard-actions">
							<a class="button" id="hb-postcard-dl-png" href="<?php echo esc_url( $png_href ); ?>"><?php esc_html_e( 'Download PNG (4×6)', 'hello-elementor-child' ); ?></a>
							<a class="button" id="hb-postcard-dl-jpg" href="<?php echo esc_url( $jpg_href ); ?>"><?php esc_html_e( 'Download JPG', 'hello-elementor-child' ); ?></a>
							<button type="button" class="button" id="hb-postcard-delete-btn"><?php esc_html_e( 'Delete', 'hello-elementor-child' ); ?></button>
						</p>
					</div>
				</div>

				<div class="hb-postcard-preview-col" id="hb-postcard-preview-col"<?php echo $has_image ? '' : ' hidden'; ?>>
					<h4><?php esc_html_e( 'Preview', 'hello-elementor-child' ); ?></h4>
					<div class="hb-postcard-preview-frame">
						<img
							id="hb-postcard-preview-img"
							class="hb-postcard-preview-img"
							src="<?php echo $has_image ? esc_url( $image_url ) : ''; ?>"
							alt="<?php esc_attr_e( 'Generated 4×6 postcard with your vCard QR', 'hello-elementor-child' ); ?>"
							<?php echo $has_image ? '' : ' hidden'; ?>
						>
					</div>
					<p class="hb-postcard-print-note" id="hb-postcard-print-note"<?php echo $has_image ? '' : ' hidden'; ?>><?php esc_html_e( 'Print at 4×6 inches (300 DPI). PNG preserves the full Medici artwork.', 'hello-elementor-child' ); ?></p>
				</div>
			</div>
		</div>
		<?php
	}
}

Hb_Postcard::init();
