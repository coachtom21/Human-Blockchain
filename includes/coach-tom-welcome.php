<?php
/**
 * Coach Tom Welcomes Everyone — click-to-play audio (no autoplay, no tracking).
 *
 * @package HelloElementorChild
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Asset base URL for the Coach Tom player.
 *
 * @return string
 */
function hb_coach_tom_asset_base() {
	return trailingslashit( get_stylesheet_directory_uri() . '/assets/coach-tom' );
}

/**
 * Enqueue Coach Tom player assets on How It Works.
 *
 * @return void
 */
function hb_enqueue_coach_tom_welcome() {
	if ( ! hb_is_how_it_works_page() ) {
		return;
	}

	$dir     = get_stylesheet_directory() . '/assets/coach-tom/';
	$css     = $dir . 'coach-tom-audio.css';
	$js      = $dir . 'coach-tom-audio.js';
	$base    = hb_coach_tom_asset_base();
	$css_ver = file_exists( $css ) ? (string) filemtime( $css ) : HELLO_ELEMENTOR_CHILD_VERSION;
	$js_ver  = file_exists( $js ) ? (string) filemtime( $js ) : HELLO_ELEMENTOR_CHILD_VERSION;

	wp_enqueue_style( 'hb-coach-tom-welcome', $base . 'coach-tom-audio.css', array(), $css_ver );
	wp_enqueue_script( 'hb-coach-tom-welcome', $base . 'coach-tom-audio.js', array(), $js_ver, true );
}
add_action( 'wp_enqueue_scripts', 'hb_enqueue_coach_tom_welcome', 30 );

/**
 * Print the Coach Tom player (HBC color mode).
 *
 * @return void
 */
function hb_render_coach_tom_welcome() {
	static $instance = 0;
	$instance++;

	$site      = 'hbc';
	$heading   = 'ctw-title-' . $site . '-' . $instance;
	$audio_src = hb_coach_tom_asset_base() . 'coach-tom-welcomes-everyone.mp3';
	?>
	<section class="ctw-audio" data-site="<?php echo esc_attr( $site ); ?>" aria-labelledby="<?php echo esc_attr( $heading ); ?>">
		<div class="ctw-audio__mark" aria-hidden="true">CT</div>
		<div class="ctw-audio__content">
			<div class="ctw-audio__meta">
				<p class="ctw-audio__eyebrow"><?php esc_html_e( 'A welcome from Coach Tom', 'hello-elementor-child' ); ?></p>
				<span class="ctw-audio__badge"><?php esc_html_e( '5-minute message', 'hello-elementor-child' ); ?></span>
			</div>
			<h2 id="<?php echo esc_attr( $heading ); ?>"><?php esc_html_e( 'Coach Tom Welcomes Everyone', 'hello-elementor-child' ); ?></h2>
			<p class="ctw-audio__intro"><?php esc_html_e( 'Before you choose how to enter, take a few minutes to hear what this study is asking - and what it will never ask of you.', 'hello-elementor-child' ); ?></p>
			<audio class="ctw-audio__media" preload="metadata">
				<source src="<?php echo esc_url( $audio_src ); ?>" type="audio/mpeg">
				<?php esc_html_e( 'Your browser does not support HTML audio.', 'hello-elementor-child' ); ?>
			</audio>
			<div class="ctw-audio__controls">
				<button class="ctw-audio__toggle" type="button" aria-label="<?php esc_attr_e( 'Play Coach Tom Welcomes Everyone', 'hello-elementor-child' ); ?>">
					<span class="ctw-audio__icon" aria-hidden="true">&gt;</span>
					<span class="ctw-audio__action"><?php esc_html_e( 'Play welcome', 'hello-elementor-child' ); ?></span>
				</button>
				<div class="ctw-audio__timeline">
					<input class="ctw-audio__seek" type="range" min="0" max="100" value="0" step="0.1" aria-label="<?php esc_attr_e( 'Audio progress', 'hello-elementor-child' ); ?>">
					<div class="ctw-audio__time" aria-live="off">
						<span class="ctw-audio__current">0:00</span><span aria-hidden="true"> / </span><span class="ctw-audio__duration">4:47</span>
					</div>
				</div>
			</div>
			<p class="ctw-audio__note"><?php esc_html_e( 'You remain free to observe, participate, browse, shop, or walk away. No response is treated as a character judgment.', 'hello-elementor-child' ); ?></p>
		</div>
	</section>
	<?php
}
