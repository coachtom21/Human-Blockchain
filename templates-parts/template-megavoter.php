<?php
/**
 * Template Name: MEGAvoter Participant
 *
 * Participant / MEGAvoter $12 path. Membership turns on after a successful order.
 * Discord is optional. This does not open Create a LAUGH.
 *
 * @package HelloElementorChild
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$account_url  = home_url( '/my-account/' );
$home_url     = home_url( '/' );
$register_url = home_url( '/register-device/?start=1' );
$branch_err   = isset( $_GET['branch_needed'] ); // phpcs:ignore WordPress.Security.NonceVerification.Recommended
$branches     = class_exists( 'Cpm_Humanblockchain_Membership' )
	? Cpm_Humanblockchain_Membership::get_branch_options()
	: array(
		'planning'     => __( 'Planning', 'hello-elementor-child' ),
		'budget'       => __( 'Budget', 'hello-elementor-child' ),
		'media'        => __( 'Media', 'hello-elementor-child' ),
		'distribution' => __( 'Distribution', 'hello-elementor-child' ),
		'membership'   => __( 'Membership', 'hello-elementor-child' ),
	);

get_header();
?>
<style>
	.hb-megavoter{background:#03080e;min-height:calc(100vh - 160px);padding:40px 0 88px;color:#ecebe5}
	.hb-megavoter-inner{width:min(1120px,calc(100% - 42px));margin:0 auto}
	.hb-megavoter-inner h1,.hb-megavoter-inner .lede,.hb-megavoter-inner p{max-width:46rem}
	.hb-megavoter .kicker{color:#f0c45b;font-size:.72rem;font-weight:900;text-transform:uppercase;letter-spacing:.17em;margin:0 0 12px}
	.hb-megavoter h1{font-family:Georgia,serif;font-weight:500;font-size:clamp(2.2rem,5vw,3.6rem);line-height:1.08;color:#fff2d0;margin:0 0 18px}
	.hb-megavoter .lede{font:500 1.35rem/1.45 Georgia,serif;color:#64ccff;margin:0 0 18px}
	.hb-megavoter p{font-size:1.05rem;line-height:1.7;color:#cfd3db;margin:0 0 16px}
	.hb-megavoter .links{display:flex;flex-wrap:wrap;gap:16px;margin:28px 0 8px}
	.hb-megavoter .primary,
	.hb-megavoter button.primary,
	.hb-megavoter a.ghost{display:inline-block;padding:13px 22px;border-radius:4px;font-weight:800;line-height:1.2;text-align:center;text-decoration:none;font-size:1rem;cursor:pointer}
	.hb-megavoter .primary,
	.hb-megavoter button.primary{background:#64ccff;border:1px solid #64ccff;color:#06101b}
	.hb-megavoter a.ghost{background:transparent;border:1px solid #64ccff;color:#64ccff}
	.hb-megavoter .text-link{color:#64ccff;font-weight:800;align-self:center}
	.hb-megavoter .note{color:#aeb6c6;font-size:.95rem}
	.hb-megavoter ol{margin:24px 0;padding:0;list-style:none;border-top:1px solid rgba(205,220,255,.18)}
	.hb-megavoter li{padding:16px 0;border-bottom:1px solid rgba(205,220,255,.18);font:500 1.15rem Georgia,serif;color:#fff2d0}
	.hb-megavoter fieldset{border:1px solid rgba(205,220,255,.18);border-radius:8px;padding:18px 18px 8px;margin:28px 0 12px}
	.hb-megavoter legend{color:#f0c45b;font-size:.72rem;font-weight:900;text-transform:uppercase;letter-spacing:.17em;padding:0 8px}
	.hb-megavoter .branches{display:grid;grid-template-columns:repeat(auto-fit,minmax(140px,1fr));gap:10px;margin:12px 0 8px}
	.hb-megavoter .branch{display:block}
	.hb-megavoter .branch input{position:absolute;opacity:0;pointer-events:none}
	.hb-megavoter .branch span{display:block;padding:12px 10px;border:1px solid rgba(205,220,255,.22);border-radius:6px;text-align:center;font-weight:800;color:#fff2d0;cursor:pointer}
	.hb-megavoter .branch input:focus-visible + span{outline:2px solid #64ccff;outline-offset:2px}
	.hb-megavoter .branch input:checked + span{background:#64ccff;color:#06101b;border-color:#64ccff}
	.hb-megavoter .err{color:#fca5a5;font-weight:700}
	body.page-template-template-megavoter #content,
	body.page-megavoter #content{background:#03080e}
	body.page-template-template-megavoter .cpm-hb-get-started-wrap,
	body.page-megavoter .cpm-hb-get-started-wrap{display:none}
	body.page-template-template-megavoter .xoo-wsc-modal,
	body.page-template-template-megavoter .xoo-wsc-slider-modal,
	body.page-template-template-megavoter .xoo-wsc-basket,
	body.page-megavoter .xoo-wsc-modal,
	body.page-megavoter .xoo-wsc-slider-modal,
	body.page-megavoter .xoo-wsc-basket{display:none!important}
</style>
<main id="content" class="site-main hb-megavoter" role="main">
	<div class="hb-megavoter-inner">
	<p class="kicker"><?php esc_html_e( 'Participant / MEGAvoter · $12 annually', 'hello-elementor-child' ); ?></p>
	<h1><?php esc_html_e( 'Continue as a MEGAvoter.', 'hello-elementor-child' ); ?></h1>
	<p class="lede"><?php esc_html_e( 'One $12 yearly membership. After the order succeeds, you can see the Shop. It is not XP, not a touchstone, and not a host dashboard.', 'hello-elementor-child' ); ?></p>
	<p><?php esc_html_e( 'Participant / MEGAvoter is the paid role that unlocks WooCommerce Shop. Free Observers play without a cart. Discord is optional. Creating a LAUGH is a later host permission.', 'hello-elementor-child' ); ?></p>
	<ol>
		<li><?php esc_html_e( 'Choose one Peace Pentagon branch.', 'hello-elementor-child' ); ?></li>
		<li><?php esc_html_e( 'Complete the $12 MEGAvoter checkout on this site.', 'hello-elementor-child' ); ?></li>
		<li><?php esc_html_e( 'Membership turns on only after the order succeeds. Then Shop is available on this site.', 'hello-elementor-child' ); ?></li>
	</ol>
	<form method="post" action="<?php echo esc_url( home_url( '/megavoter/' ) ); ?>">
		<?php wp_nonce_field( 'hb_megavoter_checkout', 'hb_megavoter_nonce' ); ?>
		<input type="hidden" name="hb_megavoter_checkout" value="1" />
		<fieldset>
			<legend><?php esc_html_e( 'Peace Pentagon branch', 'hello-elementor-child' ); ?></legend>
			<?php if ( $branch_err ) : ?>
				<p class="err"><?php esc_html_e( 'Choose a branch to continue to checkout.', 'hello-elementor-child' ); ?></p>
			<?php endif; ?>
			<p class="note"><?php esc_html_e( 'Choose the area where your time, experience, or goodwill most naturally fits. This first branch becomes defining when membership is confirmed.', 'hello-elementor-child' ); ?></p>
			<div class="branches">
				<?php foreach ( $branches as $slug => $label ) : ?>
					<label class="branch">
						<input type="radio" name="branch" value="<?php echo esc_attr( $slug ); ?>" required />
						<span><?php echo esc_html( $label ); ?></span>
					</label>
				<?php endforeach; ?>
			</div>
		</fieldset>
		<div class="links">
			<button type="submit" class="primary"><?php esc_html_e( 'Continue to $12 checkout', 'hello-elementor-child' ); ?></button>
			<?php if ( ! is_user_logged_in() ) : ?>
			<a class="ghost" href="<?php echo esc_url( $register_url ); ?>"><?php esc_html_e( 'Start playing free instead', 'hello-elementor-child' ); ?></a>
			<?php endif; ?>
		</div>
	</form>
	<p class="note"><?php esc_html_e( 'Already a member? Open My Account.', 'hello-elementor-child' ); ?> <a class="text-link" href="<?php echo esc_url( $account_url ); ?>"><?php esc_html_e( 'My Account', 'hello-elementor-child' ); ?></a></p>
	<p class="note"><a class="text-link" href="<?php echo esc_url( $home_url ); ?>"><?php esc_html_e( 'Back to Showing Up Counts', 'hello-elementor-child' ); ?></a></p>
	</div>
</main>
<?php
get_footer();
