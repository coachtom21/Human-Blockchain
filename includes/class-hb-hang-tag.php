<?php
/**
 * Human Blockchain — Gratitude Hang-Tag (My Account).
 *
 * @package HelloElementorChild
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * 3×6 hang-tag preview with dynamic vCard QR on the front.
 */
class Hb_Hang_Tag {

	const REWRITE_FLUSH_OPTION = 'hb_wc_hang_tag_rewrite_flushed';

	/**
	 * Bootstrap hooks.
	 *
	 * @return void
	 */
	public static function init() {
		add_action( 'init', array( __CLASS__, 'register_endpoint' ) );
		add_action( 'init', array( __CLASS__, 'maybe_flush_rewrites' ), 999 );
		add_filter( 'woocommerce_account_menu_items', array( __CLASS__, 'account_menu_item' ), 42 );
		add_filter( 'woocommerce_endpoint_hang-tag_title', array( __CLASS__, 'endpoint_title' ) );
		add_action( 'woocommerce_account_hang-tag_endpoint', array( __CLASS__, 'render_endpoint' ) );
		add_action( 'wp_ajax_hb_refresh_hang_tag_qr', array( __CLASS__, 'ajax_refresh_qr' ) );
	}

	/**
	 * Register WooCommerce endpoint slug.
	 *
	 * @return void
	 */
	public static function register_endpoint() {
		add_rewrite_endpoint( 'hang-tag', EP_ROOT | EP_PAGES );
	}

	/**
	 * Flush rewrite rules once so /my-account/hang-tag/ resolves.
	 *
	 * @return void
	 */
	public static function maybe_flush_rewrites() {
		if ( get_option( self::REWRITE_FLUSH_OPTION, '' ) === 'yes' ) {
			return;
		}
		flush_rewrite_rules( false );
		update_option( self::REWRITE_FLUSH_OPTION, 'yes', false );
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
			if ( 'postcard' === $key ) {
				$new_items['hang-tag'] = __( 'Hang-Tag', 'hello-elementor-child' );
				$inserted            = true;
			}
		}
		if ( ! $inserted ) {
			$new_items['hang-tag'] = __( 'Hang-Tag', 'hello-elementor-child' );
		}
		return $new_items;
	}

	/**
	 * WooCommerce page heading.
	 *
	 * @return string
	 */
	public static function endpoint_title() {
		return __( 'Gratitude Hang-Tag', 'hello-elementor-child' );
	}

	/**
	 * Theme image URLs for hang-tag artwork.
	 *
	 * @return array{logo:string,doves:string}
	 */
	public static function get_image_urls() {
		$base = trailingslashit( get_stylesheet_directory_uri() ) . 'assets/images/hang-tag/';
		return array(
			'logo'  => $base . 'ssa-logo.png',
			'doves' => $base . 'doves.jpg',
		);
	}

	/**
	 * Ensure vCard assets exist and return scan + QR image URLs.
	 *
	 * @param int $user_id User ID.
	 * @return array{scan_url:string,qr_image_url:string}
	 */
	public static function get_qr_assets( $user_id ) {
		$user_id  = (int) $user_id;
		$scan_url = '';

		if ( class_exists( 'Hb_Postcard' ) ) {
			$assets = Hb_Postcard::ensure_vcard_qr_assets( $user_id );
			if ( ! is_wp_error( $assets ) ) {
				$scan_url = isset( $assets['scan_url'] ) ? (string) $assets['scan_url'] : '';
			}
		}

		if ( $scan_url === '' && class_exists( 'Hb_Postcard' ) ) {
			$scan_url = Hb_Postcard::get_display_scan_url( $user_id );
		}

		return array(
			'scan_url'      => $scan_url,
			'qr_image_url'  => self::get_qr_image_url( $user_id, $scan_url ),
		);
	}

	/**
	 * Branded or fallback QR raster URL for the front slot.
	 *
	 * @param int    $user_id  User ID.
	 * @param string $scan_url Encoded scan URL.
	 * @return string
	 */
	public static function get_qr_image_url( $user_id, $scan_url = '' ) {
		$user_id  = (int) $user_id;
		$scan_url = trim( (string) $scan_url );

		if ( $scan_url === '' && class_exists( 'Hb_Postcard' ) ) {
			$scan_url = Hb_Postcard::get_display_scan_url( $user_id );
		}

		$postcard_qr = (string) get_user_meta( $user_id, 'hb_postcard_qr_image_url', true );
		if ( $postcard_qr !== '' ) {
			return esc_url_raw( $postcard_qr );
		}

		$vcard_qr = (string) get_user_meta( $user_id, 'hb_vcard_qr_image_url', true );
		if ( $vcard_qr !== '' ) {
			return esc_url_raw( $vcard_qr );
		}

		if ( $scan_url !== '' ) {
			$size = 120;
			$base = apply_filters( 'cpm_nwp_qr_png_remote_url', 'https://api.qrserver.com/v1/create-qr-code/?size=' . $size . 'x' . $size . '&data=', $scan_url );
			return esc_url_raw( $base . rawurlencode( $scan_url ) );
		}

		return '';
	}

	/**
	 * Decorative placeholder grid when no live QR is available yet.
	 *
	 * @return string
	 */
	private static function get_placeholder_qr_grid() {
		$pattern = array(
			'qon', 'qon', 'qon', 'qof', 'qon', 'qon', 'qon',
			'qon', 'qof', 'qon', 'qof', 'qon', 'qof', 'qon',
			'qon', 'qof', 'qon', 'qof', 'qof', 'qof', 'qon',
			'qof', 'qof', 'qon', 'qon', 'qof', 'qof', 'qof',
			'qon', 'qof', 'qon', 'qof', 'qon', 'qof', 'qon',
			'qon', 'qof', 'qon', 'qof', 'qon', 'qof', 'qon',
			'qon', 'qon', 'qon', 'qof', 'qon', 'qon', 'qon',
		);
		$html = '';
		foreach ( $pattern as $cell ) {
			$html .= '<div class="qc ' . esc_attr( $cell ) . '"></div>';
		}
		return $html;
	}

	/**
	 * Front of hang-tag (dynamic QR in Universal QR slot).
	 *
	 * @param string $qr_image_url QR image URL.
	 * @return void
	 */
	private static function render_front( $qr_image_url ) {
		$images = self::get_image_urls();
		?>
		<div class="tag front">
			<div class="punch-hole"></div>

			<div class="front-top">
				<div class="ssa-logo">
					<img src="<?php echo esc_url( $images['logo'] ); ?>" alt="<?php esc_attr_e( 'Small Street Applied Atlanta cityscape logo', 'hello-elementor-child' ); ?>">
					<div class="ssa-text">
						<span class="ssa-name"><?php echo wp_kses( __( 'Small Street<br>Applied &ndash; Atlanta', 'hello-elementor-child' ), array( 'br' => array() ) ); ?></span>
						<span class="ssa-sub"><?php esc_html_e( 'Human Blockchain · Guild', 'hello-elementor-child' ); ?></span>
					</div>
				</div>
				<div class="expires-badge">
					<?php echo wp_kses( __( 'Expires<br>12/31/2030<br><span style="color:rgba(255,255,255,0.3)">D&eacute;tente 2030</span>', 'hello-elementor-child' ), array( 'br' => array(), 'span' => array( 'style' => true ) ) ); ?>
				</div>
			</div>

			<div class="doves-wrap">
				<img src="<?php echo esc_url( $images['doves'] ); ?>" alt="<?php esc_attr_e( 'White doves in flight with Member Treasury crest', 'hello-elementor-child' ); ?>">
				<div class="doves-overlay"></div>
			</div>

			<p class="tagline"><?php echo wp_kses( __( '&ldquo;Seek Gratitude<br>for Showing Up&rdquo;', 'hello-elementor-child' ), array( 'br' => array() ) ); ?></p>

			<div class="front-bottom">
				<div class="qr-zone">
					<div class="qr-box">
						<div class="qr-inner<?php echo $qr_image_url === '' ? ' qr-inner--placeholder' : ''; ?>">
							<?php if ( $qr_image_url !== '' ) : ?>
								<img
									id="hb-hang-tag-qr-img"
									class="hb-hang-tag-qr-img"
									src="<?php echo esc_url( $qr_image_url ); ?>"
									alt="<?php esc_attr_e( 'Your dynamic Universal QR', 'hello-elementor-child' ); ?>"
									width="62"
									height="62"
								>
							<?php else : ?>
								<?php echo self::get_placeholder_qr_grid(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							<?php endif; ?>
						</div>
					</div>
					<div class="qr-info">
						<p class="qr-label"><?php esc_html_e( 'Universal QR', 'hello-elementor-child' ); ?></p>
						<p class="qr-route">
							<?php echo wp_kses( __( 'Registered device &rarr; wallet<br>Unregistered &rarr; onboarding<br>UUID links to your account', 'hello-elementor-child' ), array( 'br' => array() ) ); ?>
						</p>
					</div>
				</div>

				<div class="detente-strip">
					<div class="detente-dot"></div>
					<span class="detente-text"><?php esc_html_e( 'YAM Trading · Atlanta, USA · YAM-is-On Delivery', 'hello-elementor-child' ); ?></span>
					<div class="detente-dot"></div>
				</div>
			</div>
		</div>
		<?php
	}

	/**
	 * Back of hang-tag (static FAITH / value grid).
	 *
	 * @return void
	 */
	private static function render_back() {
		?>
		<div class="tag back">
			<div class="back-punch"></div>

			<p class="back-title"><?php esc_html_e( 'Practice FAITH', 'hello-elementor-child' ); ?></p>
			<p class="back-sub"><?php esc_html_e( 'Relational ethic · LLM Consortium standard', 'hello-elementor-child' ); ?></p>

			<div class="faith-table">
				<?php
				$faith_rows = array(
					array( 'f', __( 'Fair', 'hello-elementor-child' ), __( 'Equal regard for everyone, no conditions', 'hello-elementor-child' ) ),
					array( 'a', __( 'Accepting', 'hello-elementor-child' ), __( 'Meet people where they are', 'hello-elementor-child' ) ),
					array( 'i', __( 'Insightful', 'hello-elementor-child' ), __( 'Listen deeper than words', 'hello-elementor-child' ) ),
					array( 't', __( 'Transparent', 'hello-elementor-child' ), __( 'No hidden agendas — show your reasoning', 'hello-elementor-child' ) ),
					array( 'h', __( 'Humble', 'hello-elementor-child' ), __( 'Stay open to being changed by others', 'hello-elementor-child' ) ),
				);
				foreach ( $faith_rows as $row ) :
					?>
				<div class="faith-row">
					<div class="fl fl-<?php echo esc_attr( $row[0] ); ?>"><?php echo esc_html( strtoupper( $row[0] ) ); ?></div>
					<div class="faith-content">
						<p class="faith-word"><?php echo esc_html( $row[1] ); ?></p>
						<p class="faith-def"><?php echo esc_html( $row[2] ); ?></p>
					</div>
				</div>
					<?php
				endforeach;
				?>
			</div>

			<hr class="divider">

			<div class="value-grid">
				<div class="val-card">
					<p class="val-num green">$103</p>
					<p class="val-label"><?php echo wp_kses( __( 'community value<br>per 10-pack', 'hello-elementor-child' ), array( 'br' => array() ) ); ?></p>
				</div>
				<div class="val-card">
					<p class="val-num amber">$.03</p>
					<p class="val-label"><?php echo wp_kses( __( 'daily cap · surplus<br>to community pool', 'hello-elementor-child' ), array( 'br' => array() ) ); ?></p>
				</div>
				<div class="val-card">
					<p class="val-num blue">&infin;</p>
					<p class="val-label"><?php echo wp_kses( __( 'NWP tokens<br>no cap on giving', 'hello-elementor-child' ), array( 'br' => array() ) ); ?></p>
				</div>
				<div class="val-card">
					<p class="val-num purple">3</p>
					<p class="val-label"><?php echo wp_kses( __( 'tiers · individual<br>POC · guild', 'hello-elementor-child' ), array( 'br' => array() ) ); ?></p>
				</div>
			</div>

			<div class="gestures">
				<div class="gesture-line">
					<div class="g-icon gi-r">&darr;</div>
					<p class="g-text"><strong><?php esc_html_e( 'Scan to receive', 'hello-elementor-child' ); ?></strong> &mdash; <?php esc_html_e( 'point camera at any QR', 'hello-elementor-child' ); ?></p>
				</div>
				<div class="gesture-line">
					<div class="g-icon gi-s">&uarr;</div>
					<p class="g-text"><strong><?php esc_html_e( 'Show to send', 'hello-elementor-child' ); ?></strong> &mdash; <?php esc_html_e( 'open your identity, let them scan', 'hello-elementor-child' ); ?></p>
				</div>
			</div>

			<div class="rules-line">
				<span class="rule-chip rc-time"><?php esc_html_e( '3 min window', 'hello-elementor-child' ); ?></span>
				<span class="rule-chip rc-dist"><?php esc_html_e( '50 m radius', 'hello-elementor-child' ); ?></span>
				<span class="rule-chip rc-cap"><?php esc_html_e( '$.03 cap / day', 'hello-elementor-child' ); ?></span>
			</div>

			<p class="mentor-line"><?php esc_html_e( 'Lilburn Co-op — mentor & Human Blockchain guild', 'hello-elementor-child' ); ?></p>

			<div class="back-footer">
				<p class="footer-org"><?php esc_html_e( 'Small Street Applied – Atlanta · Détente 2030', 'hello-elementor-child' ); ?></p>
				<p class="footer-note"><?php esc_html_e( 'Human Gold Experiment 2026–2030 · lilburnco-op.org · Expires 12/31/2030', 'hello-elementor-child' ); ?></p>
			</div>
		</div>
		<?php
	}

	/**
	 * AJAX: refresh vCard QR assets for the hang-tag preview.
	 *
	 * @return void
	 */
	public static function ajax_refresh_qr() {
		check_ajax_referer( 'hb_hang_tag', 'nonce' );

		if ( ! is_user_logged_in() ) {
			wp_send_json_error( array( 'message' => __( 'Not logged in.', 'hello-elementor-child' ) ), 403 );
		}

		$user_id = (int) get_current_user_id();
		$assets  = self::get_qr_assets( $user_id );

		if ( $assets['scan_url'] === '' ) {
			wp_send_json_error(
				array(
					'message' => __( 'Could not create your vCard link. Complete your profile or generate a postcard first.', 'hello-elementor-child' ),
				)
			);
		}

		wp_send_json_success(
			array(
				'scan_url'     => esc_url_raw( $assets['scan_url'] ),
				'qr_image_url' => esc_url_raw( $assets['qr_image_url'] ),
				'message'      => __( 'QR updated.', 'hello-elementor-child' ),
			)
		);
	}

	/**
	 * My Account endpoint markup.
	 *
	 * @return void
	 */
	public static function render_endpoint() {
		if ( ! is_user_logged_in() ) {
			echo '<p>' . esc_html__( 'Please log in to view your hang-tag.', 'hello-elementor-child' ) . '</p>';
			return;
		}

		$user_id = (int) get_current_user_id();
		$assets  = self::get_qr_assets( $user_id );
		$scan_url     = $assets['scan_url'];
		$qr_image_url = $assets['qr_image_url'];
		$has_qr       = $scan_url !== '';

		$css_file = get_stylesheet_directory() . '/assets/css/hb-hang-tag-account.css';
		$css_ver  = file_exists( $css_file ) ? (string) filemtime( $css_file ) : HELLO_ELEMENTOR_CHILD_VERSION;
		$js_file  = get_stylesheet_directory() . '/assets/js/hb-hang-tag-account.js';
		$js_ver   = file_exists( $js_file ) ? (string) filemtime( $js_file ) : HELLO_ELEMENTOR_CHILD_VERSION;

		wp_enqueue_style(
			'hb-hang-tag-fonts',
			'https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,700&family=Inter:wght@300;400;500;600&display=swap',
			array(),
			null
		);
		wp_enqueue_style(
			'hb-hang-tag-account',
			get_stylesheet_directory_uri() . '/assets/css/hb-hang-tag-account.css',
			array( 'hb-hang-tag-fonts' ),
			$css_ver
		);
		wp_enqueue_script(
			'hb-hang-tag-account',
			get_stylesheet_directory_uri() . '/assets/js/hb-hang-tag-account.js',
			array(),
			$js_ver,
			true
		);
		wp_localize_script(
			'hb-hang-tag-account',
			'hbHangTag',
			array(
				'ajaxUrl' => admin_url( 'admin-ajax.php' ),
				'nonce'   => wp_create_nonce( 'hb_hang_tag' ),
				'i18n'    => array(
					'refreshing' => __( 'Refreshing QR…', 'hello-elementor-child' ),
					'copied'     => __( 'Copied.', 'hello-elementor-child' ),
					'copyFail'   => __( 'Could not copy.', 'hello-elementor-child' ),
					'refreshFail'=> __( 'Could not refresh QR.', 'hello-elementor-child' ),
				),
			)
		);
		?>
		<div id="hb-hang-tag-tools" class="hb-hang-tag-tools">
			<h3><?php esc_html_e( 'Gratitude Hang-Tag', 'hello-elementor-child' ); ?></h3>
			<p class="hb-hang-tag-intro">
				<?php esc_html_e( 'Your 3×6 Gratitude Hang-Tag pairs the YAM-is-On front design with a Practice FAITH back. The Universal QR slot shows your live dynamic vCard — the same scan URL as your postcard.', 'hello-elementor-child' ); ?>
			</p>

			<div class="hb-hang-tag-layout">
				<div class="hb-hang-tag-actions-col">
					<p class="hb-hang-tag-actions">
						<button type="button" class="button alt" id="hb-hang-tag-refresh-btn">
							<?php esc_html_e( 'Refresh QR', 'hello-elementor-child' ); ?>
						</button>
						<button type="button" class="button" id="hb-hang-tag-print-btn">
							<?php esc_html_e( 'Print hang-tag', 'hello-elementor-child' ); ?>
						</button>
						<span id="hb-hang-tag-status" class="hb-hang-tag-status" role="status" aria-live="polite"></span>
					</p>

					<div class="hb-hang-tag-scan-field">
						<label for="hb-hang-tag-scan-url"><strong><?php esc_html_e( 'Dynamic vCard link (scans resolve to your live profile)', 'hello-elementor-child' ); ?></strong></label>
						<input
							type="url"
							id="hb-hang-tag-scan-url"
							readonly
							value="<?php echo esc_attr( $scan_url ); ?>"
							placeholder="<?php esc_attr_e( 'Refresh QR to create your vCard link', 'hello-elementor-child' ); ?>"
						>
						<p class="hb-hang-tag-actions">
							<a
								class="button"
								id="hb-hang-tag-preview-link"
								href="<?php echo esc_url( $has_qr ? $scan_url : '#' ); ?>"
								target="_blank"
								rel="noopener noreferrer"
								<?php echo $has_qr ? '' : ' aria-disabled="true" tabindex="-1"'; ?>
							><?php esc_html_e( 'Preview vCard', 'hello-elementor-child' ); ?></a>
							<button type="button" class="button" id="hb-hang-tag-copy-btn"<?php echo $has_qr ? '' : ' disabled'; ?>><?php esc_html_e( 'Copy link', 'hello-elementor-child' ); ?></button>
						</p>
					</div>
				</div>

				<div class="hb-hang-tag-preview-col">
					<h4><?php esc_html_e( 'Preview', 'hello-elementor-child' ); ?></h4>
					<div class="hb-hang-tag-preview-duo hb-hang-tag-print-area" id="hb-hang-tag-print-area">
						<figure class="hb-hang-tag-preview-card">
							<figcaption class="hb-hang-tag-preview-label"><?php esc_html_e( 'Front', 'hello-elementor-child' ); ?></figcaption>
							<div class="hb-hang-tag-preview-stage">
								<p class="print-label"><?php esc_html_e( 'Front — 3″ × 6″', 'hello-elementor-child' ); ?></p>
								<?php self::render_front( $qr_image_url ); ?>
							</div>
						</figure>
						<figure class="hb-hang-tag-preview-card">
							<figcaption class="hb-hang-tag-preview-label"><?php esc_html_e( 'Back', 'hello-elementor-child' ); ?></figcaption>
							<div class="hb-hang-tag-preview-stage">
								<p class="print-label"><?php esc_html_e( 'Back — 3″ × 6″', 'hello-elementor-child' ); ?></p>
								<?php self::render_back(); ?>
							</div>
						</figure>
					</div>
					<p class="hb-hang-tag-print-note"><?php esc_html_e( 'Print front and back at 3×6 inches. Use card stock with a punch hole at the top center.', 'hello-elementor-child' ); ?></p>
				</div>
			</div>
		</div>
		<?php
	}
}

Hb_Hang_Tag::init();
