<?php
/**
 * Template Name: Showing Up — next route
 *
 * Placeholder / explainer pages linked from the new homepage.
 * Observer signup is live at /r. Hosting is /organize. Trade stays locked.
 *
 * @package HelloElementorChild
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$slug = get_post_field( 'post_name', get_queried_object_id() );
$register_url  = home_url( '/r' );
$megavoter_url = 'https://www.megavoters.com/discover/';
$account_url   = home_url( '/my-account/' );
$mega_start    = 'https://www.megavoters.com/start/';
$logged_in     = is_user_logged_in();

$copy = array(
	'laugh-events'         => array(
		'kicker' => __( 'Find a LAUGH', 'hello-elementor-child' ),
		'title'  => __( 'Gatherings will list here.', 'hello-elementor-child' ),
		'body'   => __( 'Observers will be able to find a LAUGH and RSVP when this list is live. You can register a phone now and play free.', 'hello-elementor-child' ),
	),
	'host-a-laugh'         => array(
		'kicker' => __( 'Create a LAUGH', 'hello-elementor-child' ),
		'title'  => __( 'Hosting ships after Observer signup.', 'hello-elementor-child' ),
		'body'   => __( 'Creating a gathering is for permitted MEGAvoter hosts. Pay $12 to become a Participant first. Free Observers register a phone and do not host from this path. The dashboard itself ships later.', 'hello-elementor-child' ),
	),
	'organizer-dashboard'  => array(
		'kicker' => __( 'Organizer Dashboard', 'hello-elementor-child' ),
		'title'  => __( 'Your community tools are not live yet.', 'hello-elementor-child' ),
		'body'   => __( 'The dashboard will manage events, RSVPs, attendance, and reports for that organizer. Observer / YAM’er signup does not open it.', 'hello-elementor-child' ),
	),
	'make-a-move'          => array(
		'kicker' => __( 'Make a Move', 'hello-elementor-child' ),
		'title'  => __( 'The scan is specified. It is not this slice.', 'hello-elementor-child' ),
		'body'   => __( 'A registered Observer will be able to receive a Trade or Gift, check Y/Y/Y, and accept XP. Register your phone now so you are ready.', 'hello-elementor-child' ),
	),
	'my-xp'                => array(
		'kicker' => __( 'My XP', 'hello-elementor-child' ),
		'title'  => __( 'Experience Presence lives on My Account.', 'hello-elementor-child' ),
		'body'   => __( 'XP is gameplay, not money. A personal balance shows on My Account after two registered phones complete a move. Until then, the balance can stay empty.', 'hello-elementor-child' ),
	),
	'gracebook'            => array(
		'kicker' => __( 'Gracebook', 'hello-elementor-child' ),
		'title'  => __( 'Discord is not part of this site.', 'hello-elementor-child' ),
		'body'   => __( 'Human Blockchain does not use Discord or Gracebook to register, play, host, or receive XP. Use My Account, Find a LAUGH, or continue as a MEGAvoter.', 'hello-elementor-child' ),
	),
	'practice-faith'       => array(
		'kicker' => __( 'Practice FAITH', 'hello-elementor-child' ),
		'title'  => __( 'Fair. Accepting. Insightful. Transparent. Humble.', 'hello-elementor-child' ),
		'body'   => __( 'FAITH is not a test of belief. It is a covenant for how people meet. A person may participate, decline, observe, or walk away without judgment.', 'hello-elementor-child' ),
	),
	'contact'              => array(
		'kicker' => __( 'Contact', 'hello-elementor-child' ),
		'title'  => __( 'Reach the Human Blockchain team.', 'hello-elementor-child' ),
		'body'   => __( 'For this site, write Coach Tom at coachtom@legacytoliveby.org. Participation is voluntary.', 'hello-elementor-child' ),
	),
);

$block = isset( $copy[ $slug ] ) ? $copy[ $slug ] : array(
	'kicker' => get_bloginfo( 'name' ),
	'title'  => get_the_title(),
	'body'   => __( 'This route is part of the Human Blockchain portal. Start by registering a phone as a free Observer.', 'hello-elementor-child' ),
);

get_header();
?>
<style>
	.hb-next{background:#03080e;min-height:calc(100vh - 160px);padding:56px 0 96px;color:#ecebe5}
	.hb-next-inner{width:min(1120px,calc(100% - 42px));margin:0 auto}
	.hb-next-inner h1,.hb-next-inner p{max-width:42rem}
	.hb-next .kicker{color:#f0c45b;font-size:.72rem;font-weight:900;text-transform:uppercase;letter-spacing:.17em;margin:0 0 14px}
	.hb-next h1{font-family:Georgia,serif;font-weight:500;font-size:clamp(2rem,5vw,3.2rem);line-height:1.1;color:#fff2d0;margin:0 0 22px}
	.hb-next p{font-size:1.1rem;line-height:1.7;color:#cfd3db;margin:0 0 22px}
	.hb-next .links{display:flex;flex-wrap:wrap;align-items:center;gap:16px;margin-top:28px}
	.hb-next a.primary,.hb-next a.ghost{display:inline-block;padding:13px 22px;border-radius:4px;font-weight:800;line-height:1.2;text-align:center;text-decoration:none}
	.hb-next a.primary{background:#64ccff;border:1px solid #64ccff;color:#06101b}
	.hb-next a.ghost{background:transparent;border:1px solid #64ccff;color:#64ccff}
	body.page .site-main,body.page #content,body.page{background:#03080e}
</style>
<main id="content" class="site-main hb-next" role="main">
	<div class="hb-next-inner">
	<p class="kicker"><?php echo esc_html( $block['kicker'] ); ?></p>
	<h1><?php echo esc_html( $block['title'] ); ?></h1>
	<p><?php echo esc_html( $block['body'] ); ?></p>
	<div class="links">
		<?php if ( 'my-xp' === $slug ) : ?>
			<a class="primary" href="<?php echo esc_url( $account_url ); ?>"><?php esc_html_e( 'Open My Account', 'hello-elementor-child' ); ?></a>
		<?php elseif ( 'host-a-laugh' === $slug || 'organizer-dashboard' === $slug ) : ?>
			<a class="primary" href="<?php echo esc_url( $megavoter_url ); ?>"><?php esc_html_e( 'Continue as a MEGAvoter', 'hello-elementor-child' ); ?></a>
			<?php if ( ! $logged_in ) : ?>
			<a class="ghost" href="<?php echo esc_url( $register_url ); ?>"><?php esc_html_e( 'Start Playing Free', 'hello-elementor-child' ); ?></a>
			<?php endif; ?>
		<?php elseif ( 'gracebook' === $slug ) : ?>
			<a class="primary" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Back to Showing Up Counts', 'hello-elementor-child' ); ?></a>
			<a class="ghost" href="<?php echo esc_url( $account_url ); ?>"><?php esc_html_e( 'My Account', 'hello-elementor-child' ); ?></a>
		<?php elseif ( 'contact' === $slug ) : ?>
			<a class="primary" href="mailto:coachtom@legacytoliveby.org"><?php esc_html_e( 'Email Coach Tom', 'hello-elementor-child' ); ?></a>
		<?php elseif ( ! $logged_in ) : ?>
			<a class="primary" href="<?php echo esc_url( $register_url ); ?>"><?php esc_html_e( 'Start Playing Free', 'hello-elementor-child' ); ?></a>
			<a class="ghost" href="<?php echo esc_url( $mega_start ); ?>"><?php esc_html_e( 'Start with MEGAvoters', 'hello-elementor-child' ); ?></a>
		<?php else : ?>
			<a class="ghost" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Back to Showing Up Counts', 'hello-elementor-child' ); ?></a>
		<?php endif; ?>
	</div>
	</div>
</main>
<?php
get_footer();
