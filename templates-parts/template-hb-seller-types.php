<?php
/**
 * Template Name: Seller Types
 *
 * Client source: humanblockchain-seller-types.html
 * Does not replace the YAM-is-On landing popup.
 *
 * @package HelloElementorChild
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$how_url  = function_exists( 'hb_how_it_works_url' ) ? hb_how_it_works_url() : home_url( '/how-it-works/' );
$css_file = get_stylesheet_directory() . '/assets/css/hb-seller-types.css';
$css_ver  = file_exists( $css_file ) ? (string) filemtime( $css_file ) : HELLO_ELEMENTOR_CHILD_VERSION;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title><?php echo esc_html( __( 'Seller Types', 'hello-elementor-child' ) . ' | ' . get_bloginfo( 'name' ) ); ?></title>
	<meta name="description" content="<?php echo esc_attr__( 'Every seller is first a giver. Seller roles on Human Blockchain.', 'hello-elementor-child' ); ?>" />
	<?php wp_head(); ?>
	<link rel="stylesheet" href="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/css/hb-seller-types.css' ); ?>?ver=<?php echo esc_attr( $css_ver ); ?>" />
</head>
<body <?php body_class( 'hb-st-body' ); ?>>
	<?php wp_body_open(); ?>
	<a class="skip" href="#main"><?php esc_html_e( 'Skip to content', 'hello-elementor-child' ); ?></a>
	<?php get_template_part( 'templates-parts/part', 'nwp-site-header' ); ?>

	<main id="main" class="hb-st-page">
		<header class="hb-hero">
			<div class="hb-wrap">
				<p class="hb-eyebrow"><?php esc_html_e( 'Human Blockchain • Seller Types', 'hello-elementor-child' ); ?></p>
				<h1><?php esc_html_e( 'Every seller is first a giver.', 'hello-elementor-child' ); ?></h1>
				<p class="hb-lead"><?php esc_html_e( '“Seller” identifies an encounter role—not a permanent rank and not permission to issue unlimited personal value. The seller/giver provides the invitation, item, service, gratitude, or proof that a buyer/recipient may accept.', 'hello-elementor-child' ); ?></p>
			</div>
		</header>

		<section class="hb-section">
			<div class="hb-wrap">
				<span class="hb-kicker"><?php esc_html_e( 'First understand the funnel', 'hello-elementor-child' ); ?></span>
				<h2 class="hb-title"><?php esc_html_e( 'The seller path begins before HumanBlockchain.info', 'hello-elementor-child' ); ?></h2>
				<p class="hb-intro"><?php esc_html_e( 'MEGAvoters.com opens the invitation. LegacyToLiveBy.org hosts the Human Gold Rush RSVP, FAITH covenant, touchstone choice, and LAUGH event experience. HumanBlockchain.info registers the device, confirms the role, and records proof. No site should pretend to perform all three jobs.', 'hello-elementor-child' ); ?></p>
				<div class="hb-banner">
					<p>
						<strong><?php esc_html_e( 'MEGAvoters.com → LegacyToLiveBy.org → HumanBlockchain.info', 'hello-elementor-child' ); ?></strong><br>
						<?php esc_html_e( 'Invitation → RSVP and showing up → device proof, role acceptance, and ledger status', 'hello-elementor-child' ); ?>
					</p>
					<span class="hb-pill"><?php esc_html_e( 'Three sites • One journey', 'hello-elementor-child' ); ?></span>
				</div>
			</div>
		</section>

		<section class="hb-section hb-section--white">
			<div class="hb-wrap">
				<span class="hb-kicker"><?php esc_html_e( 'Participation roles', 'hello-elementor-child' ); ?></span>
				<h2 class="hb-title"><?php esc_html_e( 'Choose what fits this encounter', 'hello-elementor-child' ); ?></h2>
				<p class="hb-intro"><?php esc_html_e( 'A person may give in one encounter and receive in another. The system measures consent and presence without turning a flexible human role into a fixed identity.', 'hello-elementor-child' ); ?></p>
				<div class="hb-cards">
					<article class="hb-card">
						<span class="hb-tag"><?php esc_html_e( 'Observer path', 'hello-elementor-child' ); ?></span>
						<h3><?php esc_html_e( 'YAM\'er buyer/recipient', 'hello-elementor-child' ); ?></h3>
						<p><?php esc_html_e( 'A free observer, shopper, buyer, or gratitude recipient. This is not a seller type, but every seller needs a consenting recipient.', 'hello-elementor-child' ); ?></p>
						<ul>
							<li><?php esc_html_e( 'Registers a device and accepts the covenant', 'hello-elementor-child' ); ?></li>
							<li><?php esc_html_e( 'Uses the buyer/recipient side of two-scan proof', 'hello-elementor-child' ); ?></li>
							<li><?php esc_html_e( 'Accepts Discord Gracebook when receiving consideration', 'hello-elementor-child' ); ?></li>
							<li><?php esc_html_e( 'Has no automatic fiscal responsibility', 'hello-elementor-child' ); ?></li>
						</ul>
					</article>
					<article class="hb-card">
						<span class="hb-tag"><?php esc_html_e( 'Participant path', 'hello-elementor-child' ); ?></span>
						<h3><?php esc_html_e( 'MEGAvoter seller/giver', 'hello-elementor-child' ); ?></h3>
						<p><?php esc_html_e( 'A participant, messenger, sponsor, seller, or giver who helps invitations and items reach their intended recipients.', 'hello-elementor-child' ); ?></p>
						<ul>
							<li><?php esc_html_e( 'Connects to the $12 annual membership pledge', 'hello-elementor-child' ); ?></li>
							<li><?php esc_html_e( 'May request the Tiger\'s Eye touchstone backorder', 'hello-elementor-child' ); ?></li>
							<li><?php esc_html_e( 'Accepts buyer/recipient and seller/giver group assignments', 'hello-elementor-child' ); ?></li>
							<li><?php esc_html_e( 'Confirms delivery or gratitude through two-scan proof', 'hello-elementor-child' ); ?></li>
						</ul>
					</article>
					<article class="hb-card">
						<span class="hb-tag"><?php esc_html_e( 'Personal', 'hello-elementor-child' ); ?></span>
						<h3><?php esc_html_e( 'Individual seller/giver', 'hello-elementor-child' ); ?></h3>
						<p><?php esc_html_e( 'One registered device meets another. “You And Me” is enough to create the smallest proof-of-presence encounter and seek the Treasured Penny.', 'hello-elementor-child' ); ?></p>
						<ul>
							<li><?php esc_html_e( 'Personal NWP reference: up to $0.01 for an accepted encounter', 'hello-elementor-child' ); ?></li>
							<li><?php esc_html_e( 'No storefront or organization required', 'hello-elementor-child' ); ?></li>
							<li><?php esc_html_e( 'Recipient capacity still follows the daily cap', 'hello-elementor-child' ); ?></li>
							<li><?php esc_html_e( 'Additional gratitude flows to community surplus', 'hello-elementor-child' ); ?></li>
						</ul>
					</article>
					<article class="hb-card">
						<span class="hb-tag"><?php esc_html_e( 'Community', 'hello-elementor-child' ); ?></span>
						<h3><?php esc_html_e( 'POC seller/giver', 'hello-elementor-child' ); ?></h3>
						<p><?php echo wp_kses( __( 'A POC is a <strong>Patron Organizing Community</strong>. The working model pairs a five-seller proof team with a wider 30-member community.', 'hello-elementor-child' ), array( 'strong' => array() ) ); ?></p>
						<ul>
							<li><?php esc_html_e( 'Five seller/givers provide checker-and-balance proof', 'hello-elementor-child' ); ?></li>
							<li><?php esc_html_e( 'Seller/giver and buyer/recipient roles can change by encounter', 'hello-elementor-child' ); ?></li>
							<li><?php esc_html_e( 'POC NWP reference: up to $0.02 for an accepted encounter', 'hello-elementor-child' ); ?></li>
							<li><?php esc_html_e( 'Serendipity can form groups across communities', 'hello-elementor-child' ); ?></li>
						</ul>
					</article>
					<article class="hb-card hb-card--wide">
						<span class="hb-tag"><?php esc_html_e( 'Host network', 'hello-elementor-child' ); ?></span>
						<h3><?php esc_html_e( 'Guild or LAUGH host seller/giver', 'hello-elementor-child' ); ?></h3>
						<p><?php esc_html_e( 'A church, nonprofit, community center, merchant, or organizer may host a LAUGH fulfillment event or coordinate a wider guild. Hosts confirm presence and participation; they do not have to collect payment at the event.', 'hello-elementor-child' ); ?></p>
						<ul>
							<li><?php esc_html_e( 'Provides the place, welcome, fulfillment workflow, and optional open mic', 'hello-elementor-child' ); ?></li>
							<li><?php esc_html_e( 'Counts confirmed touchstones, attendance, fulfillment, and voluntary speakers without recording private words or stories', 'hello-elementor-child' ); ?></li>
							<li><?php esc_html_e( 'Guild NWP reference: up to the full $0.03 daily recipient capacity', 'hello-elementor-child' ); ?></li>
							<li><?php esc_html_e( 'Separates the no-payment Human Gold Rush showcase from any later WooCommerce settlement', 'hello-elementor-child' ); ?></li>
						</ul>
					</article>
				</div>
			</div>
		</section>

		<section class="hb-section">
			<div class="hb-wrap">
				<span class="hb-kicker"><?php esc_html_e( 'The Treasured Penny', 'hello-elementor-child' ); ?></span>
				<h2 class="hb-title"><?php esc_html_e( 'A race toward less personal claim—and more community support', 'hello-elementor-child' ); ?></h2>
				<p class="hb-intro"><?php esc_html_e( 'The daily reference is not wages, a price, or cash value. It symbolizes accepted presence. A buyer/recipient can accept no more than $0.03 of NWP reference per day, while the seller/giver role remains open and excess accepted gratitude supports the append-only community surplus.', 'hello-elementor-child' ); ?></p>
				<div class="hb-levels">
					<article class="hb-level">
						<div class="hb-value">$0.01</div>
						<h3><?php esc_html_e( 'Individual', 'hello-elementor-child' ); ?></h3>
						<p><?php esc_html_e( 'Two devices. One accepted “You And Me” encounter. The Treasured Penny is the preferred personal-level signal.', 'hello-elementor-child' ); ?></p>
					</article>
					<article class="hb-level">
						<div class="hb-value">$0.02</div>
						<h3><?php esc_html_e( 'Five-seller POC', 'hello-elementor-child' ); ?></h3>
						<p><?php esc_html_e( 'A Patron Organizing Community adds shared proof and coordinated seller/giver support.', 'hello-elementor-child' ); ?></p>
					</article>
					<article class="hb-level">
						<div class="hb-value">$0.03</div>
						<h3><?php esc_html_e( 'Guild', 'hello-elementor-child' ); ?></h3>
						<p><?php esc_html_e( 'The full daily recipient capacity represents community-scale recognition, not a payment.', 'hello-elementor-child' ); ?></p>
					</article>
				</div>
				<div class="hb-callout">
					<h3><?php esc_html_e( 'The Easter Egg is delivered by the process', 'hello-elementor-child' ); ?></h3>
					<p><?php esc_html_e( 'You do not have to search for it. Your presence created it. The individual accepts only the penny; the community supports the rest.', 'hello-elementor-child' ); ?></p>
				</div>
			</div>
		</section>

		<section class="hb-section hb-section--white">
			<div class="hb-wrap">
				<span class="hb-kicker"><?php esc_html_e( 'Which QR belongs to the encounter?', 'hello-elementor-child' ); ?></span>
				<h2 class="hb-title"><?php esc_html_e( 'Seller/givers must keep gratitude and trade separate', 'hello-elementor-child' ); ?></h2>
				<div class="hb-table-wrap">
					<table class="hb-table">
						<thead>
							<tr>
								<th><?php esc_html_e( 'QR type', 'hello-elementor-child' ); ?></th>
								<th><?php esc_html_e( 'Purpose', 'hello-elementor-child' ); ?></th>
								<th><?php esc_html_e( 'What the recipient accepts', 'hello-elementor-child' ); ?></th>
								<th><?php esc_html_e( 'Money boundary', 'hello-elementor-child' ); ?></th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td><?php esc_html_e( 'Identity / v-card QR', 'hello-elementor-child' ); ?></td>
								<td><?php esc_html_e( 'Device presence and the “You And Me” encounter', 'hello-elementor-child' ); ?></td>
								<td><?php esc_html_e( 'Identity-level proof and permitted NWP recognition', 'hello-elementor-child' ); ?></td>
								<td><?php esc_html_e( 'No payment is created', 'hello-elementor-child' ); ?></td>
							</tr>
							<tr>
								<td><?php esc_html_e( 'YAM-is-On Trade QR', 'hello-elementor-child' ); ?></td>
								<td><?php esc_html_e( 'Product or service trade through the WooCommerce path', 'hello-elementor-child' ); ?></td>
								<td><?php esc_html_e( 'An expected $30 trade value', 'hello-elementor-child' ); ?></td>
								<td><?php esc_html_e( 'Fiscal obligations and settlement remain outside XP', 'hello-elementor-child' ); ?></td>
							</tr>
							<tr>
								<td><?php esc_html_e( 'Seeking Gratitude QR', 'hello-elementor-child' ); ?></td>
								<td><?php esc_html_e( 'Thank someone for showing up or serving others', 'hello-elementor-child' ); ?></td>
								<td><?php esc_html_e( 'A $30 trade-value-equivalent XP allocation', 'hello-elementor-child' ); ?></td>
								<td><?php esc_html_e( 'Never fiat, crypto, cash, or a promise to pay', 'hello-elementor-child' ); ?></td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="hb-callout">
					<h3><?php esc_html_e( 'XP is Experience Presence', 'hello-elementor-child' ); ?></h3>
					<p><?php esc_html_e( 'Issued, pending, matured, disputed, reconciled, and extinguished are ledger statuses. XP and NWP are non-cash measures of verified participation. The dot-over-equal sign (≐) communicates correlation—not convertibility.', 'hello-elementor-child' ); ?></p>
				</div>
			</div>
		</section>

		<section class="hb-section">
			<div class="hb-wrap">
				<span class="hb-kicker"><?php esc_html_e( 'Activation checklist', 'hello-elementor-child' ); ?></span>
				<h2 class="hb-title"><?php esc_html_e( 'Before a seller/giver becomes active', 'hello-elementor-child' ); ?></h2>
				<div class="hb-cards">
					<article class="hb-card">
						<h3><?php esc_html_e( '1. Accept', 'hello-elementor-child' ); ?></h3>
						<p><?php esc_html_e( 'Confirm the FAITH covenant and the simple behavioral-study terms.', 'hello-elementor-child' ); ?></p>
					</article>
					<article class="hb-card">
						<h3><?php esc_html_e( '2. Register', 'hello-elementor-child' ); ?></h3>
						<p><?php esc_html_e( 'Register the device and choose MEGAvoter participant/seller/giver status.', 'hello-elementor-child' ); ?></p>
					</article>
					<article class="hb-card">
						<h3><?php esc_html_e( '3. Join', 'hello-elementor-child' ); ?></h3>
						<p><?php esc_html_e( 'Accept Discord Gracebook and a Peace Pentagon branch and group assignment.', 'hello-elementor-child' ); ?></p>
					</article>
					<article class="hb-card">
						<h3><?php esc_html_e( '4. Confirm', 'hello-elementor-child' ); ?></h3>
						<p><?php esc_html_e( 'Use the correct QR and obtain two-device consent for each proof encounter.', 'hello-elementor-child' ); ?></p>
					</article>
				</div>
			</div>
		</section>

		<section class="hb-cta">
			<div class="hb-wrap">
				<h2><?php esc_html_e( 'Give freely. Let the recipient choose.', 'hello-elementor-child' ); ?></h2>
				<p><?php esc_html_e( 'Participate, observe, or walk away remains a valid choice at every encounter. Presence is recognized; character is never scored.', 'hello-elementor-child' ); ?></p>
				<a class="hb-btn" href="<?php echo esc_url( $how_url ); ?>"><?php esc_html_e( 'See How It Works', 'hello-elementor-child' ); ?></a>
			</div>
		</section>

		<footer class="hb-foot">
			<div class="hb-wrap"><?php esc_html_e( 'HumanBlockchain.info • Seller/giver roles • Fixed recipient capacity • Community surplus', 'hello-elementor-child' ); ?></div>
		</footer>
	</main>

	<?php get_template_part( 'templates-parts/part', 'nwp-site-footer' ); ?>
	<?php wp_footer(); ?>
</body>
</html>
