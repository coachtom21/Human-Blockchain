<?php
/**
 * Template Name: Register Device
 *
 * Observer / YAM’er free path: email + mobile + OTP. No Woo cart. No Discord required.
 *
 * @package HelloElementorChild
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$account_url = home_url( '/my-account/' );
$home_url    = home_url( '/' );

get_header();
?>
<style>
	.hb-observer{background:#03080e;min-height:calc(100vh - 160px);padding:40px 0 88px;color:#ecebe5}
	.hb-observer-inner{width:min(1120px,calc(100% - 42px));margin:0 auto}
	.hb-observer-inner h1,.hb-observer-inner .lede,.hb-observer-inner p{max-width:46rem}
	.hb-observer .kicker{color:#f0c45b;font-size:.72rem;font-weight:900;text-transform:uppercase;letter-spacing:.17em;margin:0 0 12px}
	.hb-observer h1{font-family:Georgia,serif;font-weight:500;font-size:clamp(2.2rem,5vw,3.6rem);line-height:1.08;color:#fff2d0;margin:0 0 18px}
	.hb-observer .lede{font:500 1.35rem/1.45 Georgia,serif;color:#64ccff;margin:0 0 18px}
	.hb-observer p{font-size:1.05rem;line-height:1.7;color:#cfd3db;margin:0 0 16px}
	.hb-observer .links{display:flex;flex-wrap:wrap;gap:16px;margin:28px 0 8px}
	.hb-observer .primary,
	.hb-observer a.primary,
	.hb-observer a.ghost{display:inline-block;padding:13px 22px;border-radius:4px;font-weight:800;line-height:1.2;text-align:center;text-decoration:none;font-size:1rem;cursor:pointer}
	.hb-observer .primary,
	.hb-observer a.primary{background:#64ccff;border:1px solid #64ccff;color:#06101b}
	.hb-observer a.ghost{background:transparent;border:1px solid #64ccff;color:#64ccff}
	.hb-observer .text-link{color:#64ccff;font-weight:800;align-self:center}
	.hb-observer .note{color:#aeb6c6;font-size:.95rem}
	.hb-observer ol{margin:24px 0;padding:0;list-style:none;border-top:1px solid rgba(205,220,255,.18)}
	.hb-observer li{padding:16px 0;border-bottom:1px solid rgba(205,220,255,.18);font:500 1.15rem Georgia,serif;color:#fff2d0}
	body.page-template-template-register-device #content,
	body.page-register-device #content{background:#03080e}
	body.page-template-template-register-device .cpm-hb-get-started-wrap,
	body.page-register-device .cpm-hb-get-started-wrap{display:none}
	body.page-template-template-register-device .xoo-wsc-modal,
	body.page-template-template-register-device .xoo-wsc-slider-modal,
	body.page-template-template-register-device .xoo-wsc-basket,
	body.page-register-device .xoo-wsc-modal,
	body.page-register-device .xoo-wsc-slider-modal,
	body.page-register-device .xoo-wsc-basket{display:none!important}
</style>
<main id="content" class="site-main hb-observer" role="main">
	<div class="hb-observer-inner">
	<p class="kicker"><?php esc_html_e( 'Observer / YAM’er · Free', 'hello-elementor-child' ); ?></p>
	<h1><?php esc_html_e( 'Start playing free.', 'hello-elementor-child' ); ?></h1>
	<p class="lede"><?php esc_html_e( 'Email and mobile. Then a one-time phone code. That is the whole Observer path.', 'hello-elementor-child' ); ?></p>
	<p><?php esc_html_e( 'Your registered phone is a checker piece. You can play, decline, or walk away. Nobody is judged for walking away. Discord is optional. There is no cart.', 'hello-elementor-child' ); ?></p>
	<ol>
		<li><?php esc_html_e( 'Enter your email and mobile number.', 'hello-elementor-child' ); ?></li>
		<li><?php esc_html_e( 'Verify the one-time code sent to that phone.', 'hello-elementor-child' ); ?></li>
		<li><?php esc_html_e( 'You are in as Observer. XP can stay empty until two phones complete a move.', 'hello-elementor-child' ); ?></li>
	</ol>
	<div class="links">
		<button type="button" class="primary cpm-nwp-open-modal" data-cpm-modal="cpm-nwp-register-modal"><?php esc_html_e( 'Register this device', 'hello-elementor-child' ); ?></button>
		<a class="ghost" href="<?php echo esc_url( $account_url ); ?>"><?php esc_html_e( 'I already registered — My Account', 'hello-elementor-child' ); ?></a>
	</div>
	<p class="note"><?php esc_html_e( 'Already have a number on file? Use Activate device inside the form to request a new code. $12 MEGAvoter membership is a later choice, not this page.', 'hello-elementor-child' ); ?></p>
	<p class="note"><a class="text-link" href="<?php echo esc_url( $home_url ); ?>"><?php esc_html_e( 'Back to Showing Up Counts', 'hello-elementor-child' ); ?></a></p>
	</div>
</main>
<?php
get_footer();
