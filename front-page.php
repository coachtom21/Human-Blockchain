<?php
/**
 * Front page — Showing Up Counts (deliverable index.html as a WordPress template).
 * Do not overwrite WordPress index.php.
 * Free path: Start Playing Free → YAM’er / register-device.
 * Paid path: Continue as a MEGAvoter → /megavoter/ ($12 checkout).
 * LAUGH RSVP: Find a LAUGH → /r.
 *
 * @package HelloElementorChild
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$hb_su = static function ( $path ) {
	return home_url( $path );
};

$yamer_url = $hb_su( '/register-device/' );
if ( class_exists( 'Cpm_Humanblockchain_Membership' ) && method_exists( 'Cpm_Humanblockchain_Membership', 'get_pmpro_level_id_for_tier' ) && function_exists( 'pmpro_url' ) ) {
	$yamer_level = (int) Cpm_Humanblockchain_Membership::get_pmpro_level_id_for_tier( 'yamer' );
	if ( $yamer_level > 0 ) {
		$yamer_checkout = pmpro_url( 'checkout', 'level=' . $yamer_level );
		if ( is_string( $yamer_checkout ) && $yamer_checkout !== '' ) {
			$yamer_url = add_query_arg(
				array(
					'level'       => $yamer_level,
					'cpm_hb_tier' => 'yamer',
				),
				$yamer_checkout
			);
		}
	}
}

$megavoter_url = $hb_su( '/megavoter/' );
$laugh_url     = $hb_su( '/r' );
$move_url      = $hb_su( '/r' );
$xp_url        = $hb_su( '/my-xp/' );
$host_url      = $hb_su( '/organize' );
$dash_url      = $hb_su( '/organize' );
$faith_url     = $hb_su( '/r' );
$trade_url     = $hb_su( '/trade' );
$account_url   = $hb_su( '/my-account/' );
$privacy_url   = $hb_su( '/privacy-policy/' );
$terms_url     = $hb_su( '/terms/' );
$contact_url   = $hb_su( '/contact/' );
$mega_start    = 'https://www.megavoters.com/start/';
$logged_in     = is_user_logged_in();
$is_megavoter  = function_exists( 'hb_user_can_access_shop' ) && hb_user_can_access_shop();

$css_file = get_stylesheet_directory() . '/assets/css/showing-up-home.css';
$css_ver  = file_exists( $css_file ) ? (string) filemtime( $css_file ) : HELLO_ELEMENTOR_CHILD_VERSION;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="description" content="<?php echo esc_attr__( 'Oligopoly: Community Checkers — a Human Blockchain game of showing up.', 'hello-elementor-child' ); ?>" />
	<title><?php echo esc_html( __( 'Showing Up Counts', 'hello-elementor-child' ) . ' | ' . get_bloginfo( 'name' ) ); ?></title>
	<?php wp_head(); ?>
	<link rel="stylesheet" href="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/css/showing-up-home.css' ); ?>?ver=<?php echo esc_attr( $css_ver ); ?>" />
</head>
<body <?php body_class( 'hb-showing-up' ); ?>>
<?php wp_body_open(); ?>
<a class="skip" href="#main"><?php esc_html_e( 'Skip to content', 'hello-elementor-child' ); ?></a>
<?php get_template_part( 'templates-parts/part', 'nwp-site-header' ); ?>
<main id="main">
	<section class="hero">
		<div class="wrap hero-copy">
			<p class="kicker"><?php esc_html_e( 'Oligopoly: Community Checkers', 'hello-elementor-child' ); ?></p>
			<h1><?php esc_html_e( 'Showing Up Counts.', 'hello-elementor-child' ); ?></h1>
			<p class="hero-lede"><?php esc_html_e( 'What happens when a community measures presence without turning it into money?', 'hello-elementor-child' ); ?></p>
			<p><?php esc_html_e( 'Human Blockchain is a four-year game of registered devices, shared encounters, and LAUGH events. Every gathering adds something to the board.', 'hello-elementor-child' ); ?></p>
			<div class="links">
				<?php if ( ! $logged_in ) : ?>
				<a class="primary" href="<?php echo esc_url( $yamer_url ); ?>"><?php esc_html_e( 'Start Playing Free', 'hello-elementor-child' ); ?></a>
				<a class="ghost" href="<?php echo esc_url( $laugh_url ); ?>"><?php esc_html_e( 'Find a LAUGH', 'hello-elementor-child' ); ?></a>
				<a class="ghost" href="#how"><?php esc_html_e( 'See How It Works', 'hello-elementor-child' ); ?></a>
				<?php else : ?>
				<a class="primary" href="<?php echo esc_url( $laugh_url ); ?>"><?php esc_html_e( 'Find a LAUGH', 'hello-elementor-child' ); ?></a>
				<a class="ghost" href="#how"><?php esc_html_e( 'See How It Works', 'hello-elementor-child' ); ?></a>
				<?php endif; ?>
			</div>
			<small><?php esc_html_e( 'Participation is voluntary. XP is not money.', 'hello-elementor-child' ); ?></small>
		</div>
	</section>

	<section class="section shade" id="how">
		<div class="wrap reading">
			<p class="kicker"><?php esc_html_e( 'Community Checkers', 'hello-elementor-child' ); ?></p>
			<h2><?php esc_html_e( 'Two devices. Three Yeses. One move.', 'hello-elementor-child' ); ?></h2>
			<p><?php esc_html_e( 'Every registered device becomes a checker. People move the game forward by showing up and voluntarily confirming an encounter with another registered device.', 'hello-elementor-child' ); ?></p>
			<ol>
				<li><strong><?php esc_html_e( 'Yes—the encounter occurred.', 'hello-elementor-child' ); ?></strong></li>
				<li><strong><?php esc_html_e( 'Yes—the correct gateway is identified: Trade or Gratitude.', 'hello-elementor-child' ); ?></strong></li>
				<li><strong><?php esc_html_e( 'Yes—the recipient accepts the Experience Presence record.', 'hello-elementor-child' ); ?></strong></li>
			</ol>
			<p><?php esc_html_e( 'When all three responses are Yes, presence is documented and the board is enhanced. No device wins alone, and no word selected during an encounter determines leadership.', 'hello-elementor-child' ); ?></p>
			<a class="primary" href="<?php echo esc_url( $move_url ); ?>"><?php esc_html_e( 'Make a Move', 'hello-elementor-child' ); ?></a>
		</div>
	</section>

	<section class="statement">
		<div class="wrap split">
			<div>
				<p class="kicker"><?php esc_html_e( 'Experience Presence', 'hello-elementor-child' ); ?></p>
				<h2><?php esc_html_e( 'One sextillion XP.', 'hello-elementor-child' ); ?></h2>
			</div>
			<div>
				<p class="large"><?php esc_html_e( 'You showed up. The encounter happened. The board changed.', 'hello-elementor-child' ); ?></p>
				<p><?php esc_html_e( 'XP is gameplay. It is not cash, cryptocurrency, credit, an investment, or something that can be spent or redeemed.', 'hello-elementor-child' ); ?></p>
				<a class="primary" href="<?php echo esc_url( $xp_url ); ?>"><?php esc_html_e( 'View My XP', 'hello-elementor-child' ); ?></a>
			</div>
		</div>
	</section>

	<section class="section">
		<div class="wrap reading">
			<p class="kicker"><?php esc_html_e( 'Three Universal Gateways', 'hello-elementor-child' ); ?></p>
			<h2><?php esc_html_e( 'Identity. Trade. Gratitude.', 'hello-elementor-child' ); ?></h2>
			<p><?php esc_html_e( 'Identity registers or recognizes a device entering the Human Blockchain experience. Trade documents presence around a financial encounter using the Banking QR. Gratitude documents presence around a Human Gold encounter.', 'hello-elementor-child' ); ?></p>
			<p><?php esc_html_e( 'Trade and Gratitude encounters carry a symbolic community weight of $30—a token to play with. It does not make XP worth $30, and it does not turn gratitude into money.', 'hello-elementor-child' ); ?></p>
			<p><?php esc_html_e( 'The universal QR codes provide the gateways. The encounter provides the meaning.', 'hello-elementor-child' ); ?></p>
			<div class="links">
				<a class="primary" href="<?php echo esc_url( $laugh_url ); ?>"><?php esc_html_e( 'Identity / Gratitude', 'hello-elementor-child' ); ?></a>
				<a class="ghost" href="<?php echo esc_url( $trade_url ); ?>"><?php esc_html_e( 'Trade (locked)', 'hello-elementor-child' ); ?></a>
			</div>
		</div>
	</section>

	<?php if ( ! $is_megavoter ) : ?>
	<section class="section shade" id="join">
		<div class="wrap">
			<p class="kicker"><?php esc_html_e( 'Choose Your Path', 'hello-elementor-child' ); ?></p>
			<h2><?php esc_html_e( 'Start free or participate more deeply.', 'hello-elementor-child' ); ?></h2>
			<div class="choices">
				<?php if ( ! $logged_in ) : ?>
				<article>
					<p class="label"><?php esc_html_e( 'Observer / YAM’er', 'hello-elementor-child' ); ?></p>
					<h3><?php esc_html_e( 'Free', 'hello-elementor-child' ); ?></h3>
					<p><?php esc_html_e( 'Your email address and mobile phone number are all you need to start playing Oligopoly: Community Checkers. No Discord credentials or membership payment are required.', 'hello-elementor-child' ); ?></p>
					<a class="primary" href="<?php echo esc_url( $yamer_url ); ?>"><?php esc_html_e( 'Start Playing Free', 'hello-elementor-child' ); ?></a>
				</article>
				<?php endif; ?>
				<article>
					<p class="label"><?php esc_html_e( 'Participant / MEGAvoter', 'hello-elementor-child' ); ?></p>
					<h3><?php esc_html_e( '$12 annually', 'hello-elementor-child' ); ?></h3>
					<p><?php esc_html_e( 'Participate more deeply in LAUGH events and the Human Blockchain community, and unlock Shop.', 'hello-elementor-child' ); ?></p>
					<a class="primary" href="<?php echo esc_url( $megavoter_url ); ?>"><?php esc_html_e( 'Continue as a MEGAvoter', 'hello-elementor-child' ); ?></a>
				</article>
			</div>
		</div>
	</section>
	<?php endif; ?>

	<section class="section" id="laugh">
		<div class="wrap split">
			<div>
				<p class="kicker"><?php esc_html_e( 'Leaders Annual United Group Hug', 'hello-elementor-child' ); ?></p>
				<h2><?php esc_html_e( 'Create a LAUGH event.', 'hello-elementor-child' ); ?></h2>
				<p><?php esc_html_e( 'Churches, NGOs, companies, organizations, neighborhood groups, and grassroots organizers can bring Community Checkers together through gatherings with their own character and purpose.', 'hello-elementor-child' ); ?></p>
				<div class="links">
					<a class="primary" href="<?php echo esc_url( $host_url ); ?>"><?php esc_html_e( 'Create a LAUGH', 'hello-elementor-child' ); ?></a>
					<a class="ghost" href="<?php echo esc_url( $laugh_url ); ?>"><?php esc_html_e( 'Find a LAUGH', 'hello-elementor-child' ); ?></a>
				</div>
			</div>
			<div>
				<h3><?php esc_html_e( 'Organizers can use this HBC portal to:', 'hello-elementor-child' ); ?></h3>
				<p><?php esc_html_e( 'Schedule and publish events, manage RSVPs and communications, access the three universal QR codes, document attendance and outcomes, report aggregate participation, and review ongoing performance.', 'hello-elementor-child' ); ?></p>
				<div class="links">
					<a class="primary" href="<?php echo esc_url( $dash_url ); ?>"><?php esc_html_e( 'Open Organizer Dashboard', 'hello-elementor-child' ); ?></a>
					<a class="ghost" href="<?php echo esc_url( $mega_start ); ?>"><?php esc_html_e( 'Start with MEGAvoters', 'hello-elementor-child' ); ?></a>
				</div>
			</div>
		</div>
	</section>

	<section class="statement compact">
		<div class="wrap split">
			<div>
				<p class="kicker"><?php esc_html_e( 'Community Reputation', 'hello-elementor-child' ); ?></p>
				<h2><?php esc_html_e( 'Reliability grows when people return.', 'hello-elementor-child' ); ?></h2>
			</div>
			<div>
				<p><?php esc_html_e( 'This HBC portal documents aggregate participation so communities and organizers can recognize reliable attendance, completed events, organizer follow-through, returning participation, and shared progress.', 'hello-elementor-child' ); ?></p>
				<p><?php esc_html_e( 'Community reputation is not a financial rating, popularity contest, or public ranking of individuals.', 'hello-elementor-child' ); ?></p>
			</div>
		</div>
	</section>

	<section class="section">
		<div class="wrap split">
			<div>
				<p class="kicker"><?php esc_html_e( 'Practice FAITH', 'hello-elementor-child' ); ?></p>
				<h2><?php esc_html_e( 'Fair. Accepting. Insightful. Transparent. Humble.', 'hello-elementor-child' ); ?></h2>
				<p><?php esc_html_e( 'FAITH is not a test of belief. It is a covenant for how people meet one another while playing. A person may participate, decline, observe, or walk away without judgment.', 'hello-elementor-child' ); ?></p>
				<a class="primary" href="<?php echo esc_url( $faith_url ); ?>"><?php esc_html_e( 'Read the FAITH Covenant', 'hello-elementor-child' ); ?></a>
			</div>
			<div>
				<p class="kicker"><?php esc_html_e( 'Optional Touchstones', 'hello-elementor-child' ); ?></p>
				<h2><?php esc_html_e( 'A reminder, not a requirement.', 'hello-elementor-child' ); ?></h2>
				<p><?php esc_html_e( 'Touchstones may be requested with a confirmed LAUGH RSVP and received at the event when available. Organizers will never prepare more touchstones than the number requested by confirmed attendees.', 'hello-elementor-child' ); ?></p>
				<p><?php echo wp_kses_post( __( 'A touchstone is <strong>not</strong> required to start playing, attend an event, register a device, complete an encounter, receive XP, or belong to the community.', 'hello-elementor-child' ) ); ?></p>
				<div class="links">
					<a class="primary" href="<?php echo esc_url( $laugh_url ); ?>"><?php esc_html_e( 'Find an Event and RSVP', 'hello-elementor-child' ); ?></a>
					<a class="ghost" href="<?php echo esc_url( $mega_start ); ?>"><?php esc_html_e( 'Start with MEGAvoters', 'hello-elementor-child' ); ?></a>
				</div>
			</div>
		</div>
	</section>

	<section class="section" id="milestones">
		<div class="wrap">
			<p class="kicker"><?php esc_html_e( 'Inaugural Leadership Recognition', 'hello-elementor-child' ); ?></p>
			<h2><?php esc_html_e( 'Let presence reveal leadership.', 'hello-elementor-child' ); ?></h2>
			<div class="dates">
				<div>
					<time>August 11, 2027</time>
					<h3><?php esc_html_e( 'XP Findings Snapshot', 'hello-elementor-child' ); ?></h3>
					<p><?php esc_html_e( 'The patterns created by participating devices will be preserved.', 'hello-elementor-child' ); ?></p>
				</div>
				<div>
					<time>September 1, 2027</time>
					<h3><?php esc_html_e( 'Inaugural Recognition', 'hello-elementor-child' ); ?></h3>
					<p><strong>10 PMGs</strong> — <?php esc_html_e( 'Presence Maestro Generators', 'hello-elementor-child' ); ?><br><strong>500 Captains</strong></p>
				</div>
			</div>
			<p class="note"><?php esc_html_e( 'Nobody will know beforehand which devices will be recognized. There will be no public formula, qualifying threshold, prediction, or leadership leaderboard. A visible XP balance does not guarantee recognition.', 'hello-elementor-child' ); ?></p>
		</div>
	</section>

	<section class="final">
		<div class="wrap reading">
			<p class="kicker"><?php esc_html_e( 'May 16, 2030', 'hello-elementor-child' ); ?></p>
			<h2><?php esc_html_e( 'The Human Gold Discovery', 'hello-elementor-child' ); ?></h2>
			<p><?php esc_html_e( 'For four years, communities will gather, play, practice FAITH, and leave marks of presence on the board. The game will not tell participants what they are expected to discover.', 'hello-elementor-child' ); ?></p>
			<p class="large"><?php esc_html_e( 'Bring your presence. Meet another person. Make a move.', 'hello-elementor-child' ); ?></p>
			<div class="links">
				<?php if ( ! $logged_in ) : ?>
				<a class="primary" href="<?php echo esc_url( $yamer_url ); ?>"><?php esc_html_e( 'Start Playing Free', 'hello-elementor-child' ); ?></a>
				<a class="ghost" href="<?php echo esc_url( $laugh_url ); ?>"><?php esc_html_e( 'Find a LAUGH', 'hello-elementor-child' ); ?></a>
				<?php else : ?>
				<a class="primary" href="<?php echo esc_url( $laugh_url ); ?>"><?php esc_html_e( 'Find a LAUGH', 'hello-elementor-child' ); ?></a>
				<?php endif; ?>
			</div>
		</div>
	</section>
</main>
<footer>
	<div class="wrap footer-row">
		<p><?php esc_html_e( 'Human Blockchain · Oligopoly: Community Checkers · Experience Presence', 'hello-elementor-child' ); ?></p>
		<nav>
			<a href="<?php echo esc_url( $account_url ); ?>"><?php esc_html_e( 'My Account', 'hello-elementor-child' ); ?></a>
			<a href="<?php echo esc_url( $privacy_url ); ?>"><?php esc_html_e( 'Privacy', 'hello-elementor-child' ); ?></a>
			<a href="<?php echo esc_url( $terms_url ); ?>"><?php esc_html_e( 'Terms', 'hello-elementor-child' ); ?></a>
			<a href="<?php echo esc_url( $contact_url ); ?>"><?php esc_html_e( 'Contact', 'hello-elementor-child' ); ?></a>
			<a href="<?php echo esc_url( home_url( '/how-it-works/' ) ); ?>"><?php esc_html_e( 'How It Works', 'hello-elementor-child' ); ?></a>
			<a href="<?php echo esc_url( home_url( '/treasured-penny/' ) ); ?>"><?php esc_html_e( 'Treasured Penny', 'hello-elementor-child' ); ?></a>
		</nav>
	</div>
	<div class="wrap footnote"><?php esc_html_e( 'One sextillion XP is gameplay—not money. Participation is voluntary.', 'hello-elementor-child' ); ?></div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
