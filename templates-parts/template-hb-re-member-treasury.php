<?php
/**
 * Template Name: Re-Member Treasury
 *
 * Client source: HBC_Re-Member_Treasury.html (v7)
 * Consumer videos, regulator video, regulator podcast/PDF are wired. Consumer podcast/PDF stay empty.
 *
 * @package HelloElementorChild
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$patron_url = function_exists( 'hb_patron_membership_url' )
	? hb_patron_membership_url()
	: home_url( '/patron-membership/' );
$penny_img  = get_stylesheet_directory_uri() . '/assets/images/re-member-treasury-peace-pentagon-penny.jpg';
$css_file   = get_stylesheet_directory() . '/assets/css/hb-re-member-treasury.css';
$css_ver    = file_exists( $css_file ) ? (string) filemtime( $css_file ) : HELLO_ELEMENTOR_CHILD_VERSION;
$consumer_video_url     = 'https://humanblockchain.info/wp-content/uploads/2026/08/Anatomy_of_an_Encounter__The_Human_Gold_Experiment-1.mp4';
$consumer_video_two_url = 'https://humanblockchain.info/wp-content/uploads/2026/08/The_Anatomy_of_a_Digital_Handshake.mp4';
$regulator_video_url    = 'https://humanblockchain.info/wp-content/uploads/2026/08/Architecting_the_Zero-Trust_Presence_Ledger.mp4';
$regulator_podcast_url  = 'https://humanblockchain.info/wp-content/uploads/2026/08/Sextillion_Worthless_Points_for_Human_Presence1.mp4';
$regulator_pdf_url      = get_stylesheet_directory_uri() . '/assets/pdf/HBC_True_Testnet_Regulatory_Handout.pdf';
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title><?php echo esc_html( __( 'Re-Member Treasury', 'hello-elementor-child' ) . ' | ' . get_bloginfo( 'name' ) ); ?></title>
	<meta name="description" content="<?php echo esc_attr__( 'The Human Blockchain Re-Member Treasury records confirmed presence and acceptance as Experience Presence—behavioral data, never money.', 'hello-elementor-child' ); ?>" />
	<?php wp_head(); ?>
	<link rel="stylesheet" href="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/css/hb-re-member-treasury.css' ); ?>?ver=<?php echo esc_attr( $css_ver ); ?>" />
</head>
<body <?php body_class( 'hb-rmt-page' ); ?>>
	<?php wp_body_open(); ?>
	<a class="skip" href="#main"><?php esc_html_e( 'Skip to content', 'hello-elementor-child' ); ?></a>
	<?php get_template_part( 'templates-parts/part', 'nwp-site-header' ); ?>

	<main id="main">
		<section class="hbc-hero">
			<div class="hbc-wrap hbc-hero-grid">
				<div>
					<p class="hbc-eyebrow"><?php esc_html_e( 'Behavioral data • Never money', 'hello-elementor-child' ); ?></p>
					<h1><?php esc_html_e( 'Re-Member Treasury', 'hello-elementor-child' ); ?></h1>
					<p class="hbc-hero-lead"><?php esc_html_e( 'A community memory built by presence, delivery, and acceptance alone. It records the moments people choose to show up for one another—without creating a spendable balance.', 'hello-elementor-child' ); ?></p>
					<div class="hbc-hero-actions">
						<a class="hbc-button hbc-button-primary" href="#how-it-works"><?php esc_html_e( 'See how presence is recorded', 'hello-elementor-child' ); ?></a>
						<a class="hbc-button hbc-button-secondary" href="#boundaries"><?php esc_html_e( 'Understand the boundaries', 'hello-elementor-child' ); ?></a>
						<a class="hbc-button hbc-button-secondary" href="<?php echo esc_url( $patron_url ); ?>"><?php esc_html_e( 'How Patron leadership is earned', 'hello-elementor-child' ); ?></a>
					</div>
				</div>
				<figure class="hbc-pentagon-stage" aria-label="<?php echo esc_attr__( 'Backside of the Peace Pentagon Penny featuring Legacy to Live By and Bounty for Inspirational Services', 'hello-elementor-child' ); ?>">
					<img src="<?php echo esc_url( $penny_img ); ?>" alt="<?php echo esc_attr__( 'Legacy to Live By side of the Peace Pentagon Penny with hands, globe, eagle, and Bounty for Inspirational Services', 'hello-elementor-child' ); ?>" width="860" height="860" />
					<figcaption class="hbc-pentagon-caption"><?php esc_html_e( 'Backside · Peace Pentagon Penny', 'hello-elementor-child' ); ?></figcaption>
				</figure>
			</div>
		</section>

		<section class="hbc-strip" aria-label="<?php echo esc_attr__( 'Treasury principles', 'hello-elementor-child' ); ?>">
			<div class="hbc-wrap hbc-strip-grid">
				<div class="hbc-strip-item"><strong><?php esc_html_e( 'Append-only', 'hello-elementor-child' ); ?></strong><span><?php esc_html_e( 'New events clarify history without erasing it.', 'hello-elementor-child' ); ?></span></div>
				<div class="hbc-strip-item"><strong><?php esc_html_e( 'Ring-fenced', 'hello-elementor-child' ); ?></strong><span><?php esc_html_e( 'XP remains separate from fiscal and trade records.', 'hello-elementor-child' ); ?></span></div>
				<div class="hbc-strip-item"><strong><?php esc_html_e( 'Nonspendable', 'hello-elementor-child' ); ?></strong><span><?php esc_html_e( 'Experience Presence is recognition, never money.', 'hello-elementor-child' ); ?></span></div>
			</div>
		</section>

		<section class="hbc-section hbc-section-alt" id="meaning">
			<div class="hbc-wrap">
				<p class="hbc-section-kicker"><?php esc_html_e( 'What the treasury means', 'hello-elementor-child' ); ?></p>
				<h2><?php esc_html_e( 'A treasury of confirmed human moments—not accumulated money.', 'hello-elementor-child' ); ?></h2>
				<p class="hbc-section-intro"><?php esc_html_e( 'The Re-Member Treasury preserves evidence that registered devices completed a defined encounter. Its value begins with people showing up, delivering, and accepting—not with deposits, purchases, investment, or ownership.', 'hello-elementor-child' ); ?></p>
				<div class="hbc-framework-grid">
					<article class="hbc-card">
						<div class="hbc-card-number">01</div>
						<h3><?php esc_html_e( 'Presence begins the record', 'hello-elementor-child' ); ?></h3>
						<p><?php esc_html_e( 'A scan of an Identity, YAM-is-On Trade, or Seeking Gratitude QR code creates a pending, timestamped presence event.', 'hello-elementor-child' ); ?></p>
					</article>
					<article class="hbc-card">
						<div class="hbc-card-number">02</div>
						<h3><?php esc_html_e( 'Acceptance completes the proof', 'hello-elementor-child' ); ?></h3>
						<p><?php esc_html_e( 'Two registered devices confirm delivery, acceptance, and the encounter requirements through the Y/Y/Y proof.', 'hello-elementor-child' ); ?></p>
					</article>
					<article class="hbc-card">
						<div class="hbc-card-number">03</div>
						<h3><?php esc_html_e( 'The community remembers', 'hello-elementor-child' ); ?></h3>
						<p><?php esc_html_e( 'The XP Community Surplus issues one sextillion Experience Presence and preserves the event in an append-only history.', 'hello-elementor-child' ); ?></p>
					</article>
				</div>
			</div>
		</section>

		<section class="hbc-section" id="inspiration">
			<div class="hbc-wrap">
				<p class="hbc-section-kicker"><?php esc_html_e( 'The inspiration', 'hello-elementor-child' ); ?></p>
				<h2><?php esc_html_e( 'Borrowing discipline from finance without turning gratitude into finance.', 'hello-elementor-child' ); ?></h2>
				<p class="hbc-section-intro"><?php esc_html_e( 'These references provide metaphors for separation, responsibility, and long-term service. They do not provide Human Blockchain with banking authority or government affiliation.', 'hello-elementor-child' ); ?></p>
				<div class="hbc-inspiration">
					<article class="hbc-inspiration-card">
						<span class="hbc-tag"><?php esc_html_e( 'Section 25A inspiration', 'hello-elementor-child' ); ?></span>
						<h3><?php esc_html_e( 'A ring-fenced position on the record', 'hello-elementor-child' ); ?></h3>
						<p><?php echo wp_kses( __( 'Section 25A of the Federal Reserve Act—the Edge Act—inspires the discipline of keeping defined undertakings and records separated. Here, the comparison stops at disciplined recordkeeping: <strong>XP is not a deposit, bank capital, trade-finance instrument, or spendable wallet balance.</strong>', 'hello-elementor-child' ), array( 'strong' => array() ) ); ?></p>
					</article>
					<article class="hbc-inspiration-card">
						<span class="hbc-tag"><?php esc_html_e( 'BIS 2.0 inspiration', 'hello-elementor-child' ); ?></span>
						<h3><?php esc_html_e( 'Bounty for Inspirational Service', 'hello-elementor-child' ); ?></h3>
						<p><?php esc_html_e( 'BIS 2.0 imagines a long-horizon, gratitude-only framework in which the human evidence that remains is presence. It asks what communities may discover when service and acceptance are measured before money—not how XP may be cashed out.', 'hello-elementor-child' ); ?></p>
					</article>
				</div>
				<div class="hbc-boundary">
					<strong><?php esc_html_e( 'No claim of authority or affiliation', 'hello-elementor-child' ); ?></strong>
					<p><?php esc_html_e( 'Human Blockchain is not a bank, Federal Reserve entity, Bank for International Settlements program, or government project. “Section 25A” and “BIS 2.0” describe inspiration only. Actual money, trade settlements, fees, and tax matters remain in separate fiscal systems and require their own professional review.', 'hello-elementor-child' ); ?></p>
				</div>
			</div>
		</section>

		<section class="hbc-section hbc-section-alt" id="how-it-works">
			<div class="hbc-wrap">
				<p class="hbc-section-kicker"><?php esc_html_e( 'How a moment is Re-Membered', 'hello-elementor-child' ); ?></p>
				<h2><?php esc_html_e( 'One simple participant experience. Four protected steps behind it.', 'hello-elementor-child' ); ?></h2>
				<div class="hbc-proof-flow">
					<article class="hbc-proof-step">
						<h3><?php esc_html_e( 'Choose a doorway', 'hello-elementor-child' ); ?></h3>
						<p><?php esc_html_e( 'Scan Identity, YAM-is-On Trade, or Seeking Gratitude. Any one can begin a pending presence record.', 'hello-elementor-child' ); ?></p>
					</article>
					<article class="hbc-proof-step">
						<h3><?php esc_html_e( 'Identify authority', 'hello-elementor-child' ); ?></h3>
						<p><?php esc_html_e( 'The seller/giver initiates under Individual, POC—Patron Organizing Community—or Guild authority.', 'hello-elementor-child' ); ?></p>
					</article>
					<article class="hbc-proof-step">
						<h3><?php esc_html_e( 'Confirm Y/Y/Y', 'hello-elementor-child' ); ?></h3>
						<p><?php esc_html_e( 'Both devices confirm delivery and acceptance, and the defined encounter requirements are validated.', 'hello-elementor-child' ); ?></p>
					</article>
					<article class="hbc-proof-step">
						<h3><?php esc_html_e( 'Re-Member', 'hello-elementor-child' ); ?></h3>
						<p><?php esc_html_e( 'One confirmed proof receives one sextillion XP from Community Surplus and enters its 12-week maturity window.', 'hello-elementor-child' ); ?></p>
					</article>
				</div>
				<div class="hbc-callout">
					<div>
						<h3><?php esc_html_e( 'No scan remains a valid choice.', 'hello-elementor-child' ); ?></h3>
						<p><?php esc_html_e( 'A person may participate, observe, or walk away. No device-level event is created without a scan, and no response is treated as a character judgment.', 'hello-elementor-child' ); ?></p>
					</div>
					<a class="hbc-button hbc-button-primary" href="#faith"><?php esc_html_e( 'Practice FAITH', 'hello-elementor-child' ); ?></a>
				</div>
			</div>
		</section>

		<section class="hbc-section" id="authority">
			<div class="hbc-wrap">
				<p class="hbc-section-kicker"><?php esc_html_e( 'Seller / giver authority', 'hello-elementor-child' ); ?></p>
				<h2><?php esc_html_e( 'Three ways to initiate. One standard for mutual acceptance.', 'hello-elementor-child' ); ?></h2>
				<p class="hbc-section-intro"><?php esc_html_e( 'Authority identifies the capacity in which the seller/giver initiates an encounter. It does not create financial ownership or withdrawal rights.', 'hello-elementor-child' ); ?></p>
				<div class="hbc-authority-grid">
					<article class="hbc-card hbc-authority-card">
						<div class="hbc-authority-icon">I</div>
						<h3><?php esc_html_e( 'Individual', 'hello-elementor-child' ); ?></h3>
						<p><?php esc_html_e( 'One registered seller/giver initiates a personal You And Me encounter.', 'hello-elementor-child' ); ?></p>
					</article>
					<article class="hbc-card hbc-authority-card">
						<div class="hbc-authority-icon">P</div>
						<h3><?php esc_html_e( 'POC', 'hello-elementor-child' ); ?></h3>
						<p><?php esc_html_e( 'A Patron Organizing Community initiates through an authorized member and shared purpose.', 'hello-elementor-child' ); ?></p>
					</article>
					<article class="hbc-card hbc-authority-card">
						<div class="hbc-authority-icon">G</div>
						<h3><?php esc_html_e( 'Guild', 'hello-elementor-child' ); ?></h3>
						<p><?php esc_html_e( 'An authorized guild participant initiates within the guild’s defined community role.', 'hello-elementor-child' ); ?></p>
					</article>
				</div>
			</div>
		</section>

		<section class="hbc-section hbc-section-alt" id="study-controls">
			<div class="hbc-wrap">
				<p class="hbc-section-kicker"><?php esc_html_e( 'Behavioral-study controls', 'hello-elementor-child' ); ?></p>
				<h2><?php esc_html_e( 'Fixed reference values keep the measuring stick still.', 'hello-elementor-child' ); ?></h2>
				<p class="hbc-section-intro"><?php esc_html_e( 'Future algorithms may compare, challenge, or attempt to outperform these controls. They may not rewrite the original proof, reprice an active position, or turn gratitude into money.', 'hello-elementor-child' ); ?></p>
				<div class="hbc-controls-grid">
					<article class="hbc-card hbc-control-card">
						<h3><?php esc_html_e( 'YAM-is-On', 'hello-elementor-child' ); ?></h3>
						<span class="hbc-value">$30</span>
						<p><?php esc_html_e( 'Fixed expected WooCommerce trade-value reference. Any actual fiscal activity remains outside the XP ledger.', 'hello-elementor-child' ); ?></p>
					</article>
					<article class="hbc-card hbc-control-card">
						<h3><?php esc_html_e( 'Seeking Gratitude', 'hello-elementor-child' ); ?></h3>
						<span class="hbc-value"><?php esc_html_e( '$30-equivalent', 'hello-elementor-child' ); ?></span>
						<p><?php esc_html_e( 'Fixed never-money XP study allocation. “Equivalent” is a comparison label, not cash value or a redemption right.', 'hello-elementor-child' ); ?></p>
					</article>
					<article class="hbc-card hbc-control-card">
						<h3><?php esc_html_e( 'Maturity window', 'hello-elementor-child' ); ?></h3>
						<span class="hbc-value"><?php esc_html_e( '12 weeks', 'hello-elementor-child' ); ?></span>
						<p><?php esc_html_e( 'Issued, pending, matured, disputed, reconciled, and extinguished remain append-only XP statuses—not payment obligations.', 'hello-elementor-child' ); ?></p>
					</article>
				</div>
			</div>
		</section>

		<section class="hbc-section" id="faith">
			<div class="hbc-wrap">
				<div class="hbc-faith">
					<div class="hbc-faith-header">
						<div>
							<p class="hbc-section-kicker" style="color:#bff5ec"><?php esc_html_e( 'The human covenant', 'hello-elementor-child' ); ?></p>
							<h2><?php esc_html_e( 'Practice FAITH with the record—and with one another.', 'hello-elementor-child' ); ?></h2>
						</div>
						<p><?php esc_html_e( 'The purpose is not surveillance, accusation, or judgment. United Citizens acting as Organized Krill may compare stated commitments with observable outcomes, while applying the same transparent standard to themselves.', 'hello-elementor-child' ); ?></p>
					</div>
					<div class="hbc-faith-grid" aria-label="<?php echo esc_attr__( 'FAITH covenant', 'hello-elementor-child' ); ?>">
						<div class="hbc-faith-word"><strong>F</strong><span><?php esc_html_e( 'Fair', 'hello-elementor-child' ); ?></span></div>
						<div class="hbc-faith-word"><strong>A</strong><span><?php esc_html_e( 'Accepting', 'hello-elementor-child' ); ?></span></div>
						<div class="hbc-faith-word"><strong>I</strong><span><?php esc_html_e( 'Insightful', 'hello-elementor-child' ); ?></span></div>
						<div class="hbc-faith-word"><strong>T</strong><span><?php esc_html_e( 'Transparent', 'hello-elementor-child' ); ?></span></div>
						<div class="hbc-faith-word"><strong>H</strong><span><?php esc_html_e( 'Humble', 'hello-elementor-child' ); ?></span></div>
					</div>
				</div>
			</div>
		</section>

		<section class="hbc-section hbc-section-alt" id="boundaries">
			<div class="hbc-wrap">
				<p class="hbc-section-kicker"><?php esc_html_e( 'The plain-language boundary', 'hello-elementor-child' ); ?></p>
				<h2><?php esc_html_e( 'XP remembers what happened. It does not become something to spend.', 'hello-elementor-child' ); ?></h2>
				<p class="hbc-section-intro"><?php esc_html_e( 'The Re-Member Treasury may support behavioral study, community governance, and comparisons among experimental models. It does not hold customer funds, promise returns, finance an investment, or establish a monetary claim.', 'hello-elementor-child' ); ?></p>
				<div class="hbc-boundary">
					<strong><?php esc_html_e( 'Gratitude can accumulate without limit.', 'hello-elementor-child' ); ?></strong>
					<p><?php esc_html_e( 'Money can arise only through a separately documented, legally recognized transaction outside the XP ledger. The Re-Member Treasury records behavioral evidence—not deposits, wealth, or ownership.', 'hello-elementor-child' ); ?></p>
				</div>
			</div>
		</section>

		<section class="hbc-section hbc-media-portal" id="treasury-media">
			<div class="hbc-wrap">
				<p class="hbc-section-kicker"><?php esc_html_e( 'Watch, listen, and review', 'hello-elementor-child' ); ?></p>
				<h2><?php esc_html_e( 'Choose the Re-Member Treasury explanation prepared for you.', 'hello-elementor-child' ); ?></h2>
				<p class="hbc-section-intro"><?php esc_html_e( 'The same proposed testnet is explained through two separate lenses. Consumer materials focus on participation and choice. Government and regulator materials focus on controls, separation, records, and the planned May 17, 2030 transition review.', 'hello-elementor-child' ); ?></p>
				<div class="hbc-media-audiences">
					<article class="hbc-media-audience" aria-labelledby="consumer-media-title">
						<header class="hbc-media-header">
							<span class="hbc-media-label"><?php esc_html_e( 'Consumer facing', 'hello-elementor-child' ); ?></span>
							<h3 id="consumer-media-title"><?php esc_html_e( 'Understand your choices', 'hello-elementor-child' ); ?></h3>
							<p><?php esc_html_e( 'Plain-language materials for Observers, Participants, Patrons, and people who choose to walk away.', 'hello-elementor-child' ); ?></p>
						</header>
						<div class="hbc-media-slots">
							<section class="hbc-media-slot" data-media-slot="consumer-video">
								<span class="hbc-media-slot-type"><?php esc_html_e( 'Videos', 'hello-elementor-child' ); ?></span>
								<h4><?php esc_html_e( 'Consumer videos', 'hello-elementor-child' ); ?></h4>
								<p><?php esc_html_e( 'Two plain-language films: the Human Gold encounter, then the digital handshake that records it.', 'hello-elementor-child' ); ?></p>
								<div class="hbc-video-player">
									<p class="hbc-video-player__title"><?php esc_html_e( 'Anatomy of an Encounter: The Human Gold Experiment', 'hello-elementor-child' ); ?></p>
									<video class="hbc-media-player--video" controls preload="metadata" playsinline controlslist="nodownload" title="<?php echo esc_attr__( 'Anatomy of an Encounter: The Human Gold Experiment', 'hello-elementor-child' ); ?>">
										<source src="<?php echo esc_url( $consumer_video_url ); ?>" type="video/mp4" />
										<?php esc_html_e( 'Your browser does not support HTML video.', 'hello-elementor-child' ); ?>
									</video>
								</div>
								<div class="hbc-video-player">
									<p class="hbc-video-player__title"><?php esc_html_e( 'The Anatomy of a Digital Handshake', 'hello-elementor-child' ); ?></p>
									<video class="hbc-media-player--video" controls preload="metadata" playsinline controlslist="nodownload" title="<?php echo esc_attr__( 'The Anatomy of a Digital Handshake', 'hello-elementor-child' ); ?>">
										<source src="<?php echo esc_url( $consumer_video_two_url ); ?>" type="video/mp4" />
										<?php esc_html_e( 'Your browser does not support HTML video.', 'hello-elementor-child' ); ?>
									</video>
								</div>
							</section>
							<section class="hbc-media-slot" data-media-slot="consumer-podcast">
								<span class="hbc-media-slot-type"><?php esc_html_e( 'Podcast 1 of 2', 'hello-elementor-child' ); ?></span>
								<h4><?php esc_html_e( 'Consumer podcast', 'hello-elementor-child' ); ?></h4>
								<p><?php esc_html_e( 'Suggested topic: Coach Tom explains why gratitude is recorded as presence and never offered as spendable money.', 'hello-elementor-child' ); ?></p>
								<div class="hbc-media-placeholder hbc-media-placeholder--audio"><?php esc_html_e( 'Podcast not published yet', 'hello-elementor-child' ); ?></div>
							</section>
							<section class="hbc-media-slot" data-media-slot="consumer-pdf">
								<span class="hbc-media-slot-type"><?php esc_html_e( 'PDF 1 of 2', 'hello-elementor-child' ); ?></span>
								<h4><?php esc_html_e( 'Consumer guide', 'hello-elementor-child' ); ?></h4>
								<p><?php esc_html_e( 'A short downloadable explanation of consent, privacy, study choices, Patron qualification, and the never-money XP boundary.', 'hello-elementor-child' ); ?></p>
								<div class="hbc-media-download">
									<span><?php esc_html_e( 'PDF not published yet', 'hello-elementor-child' ); ?></span>
									<span class="hbc-button hbc-button-primary is-disabled"><?php esc_html_e( 'Download consumer guide', 'hello-elementor-child' ); ?></span>
								</div>
							</section>
						</div>
					</article>
					<article class="hbc-media-audience hbc-media-audience--regulator" aria-labelledby="regulator-media-title">
						<header class="hbc-media-header">
							<span class="hbc-media-label"><?php esc_html_e( 'Government and regulator facing', 'hello-elementor-child' ); ?></span>
							<h3 id="regulator-media-title"><?php esc_html_e( 'Review the testnet boundaries', 'hello-elementor-child' ); ?></h3>
							<p><?php esc_html_e( 'Control-focused materials for government, regulatory, legal, tax, banking, nonprofit, and institutional reviewers.', 'hello-elementor-child' ); ?></p>
						</header>
						<div class="hbc-media-slots">
							<section class="hbc-media-slot" data-media-slot="regulator-video">
								<span class="hbc-media-slot-type"><?php esc_html_e( 'Video 2 of 2', 'hello-elementor-child' ); ?></span>
								<h4><?php esc_html_e( 'Government and regulator video', 'hello-elementor-child' ); ?></h4>
								<p><?php esc_html_e( 'Architecting the Zero-Trust Presence Ledger — append-only records, fiscal and XP separation, and the planned May 17, 2030 review.', 'hello-elementor-child' ); ?></p>
								<div class="hbc-video-player">
									<p class="hbc-video-player__title"><?php esc_html_e( 'Architecting the Zero-Trust Presence Ledger', 'hello-elementor-child' ); ?></p>
									<video class="hbc-media-player--video" controls preload="metadata" playsinline controlslist="nodownload" title="<?php echo esc_attr__( 'Architecting the Zero-Trust Presence Ledger', 'hello-elementor-child' ); ?>">
										<source src="<?php echo esc_url( $regulator_video_url ); ?>" type="video/mp4" />
										<?php esc_html_e( 'Your browser does not support HTML video.', 'hello-elementor-child' ); ?>
									</video>
								</div>
							</section>
							<section class="hbc-media-slot" data-media-slot="regulator-podcast">
								<span class="hbc-media-slot-type"><?php esc_html_e( 'Podcast 2 of 2', 'hello-elementor-child' ); ?></span>
								<h4><?php esc_html_e( 'Government and regulator podcast', 'hello-elementor-child' ); ?></h4>
								<p><?php esc_html_e( 'Suggested topic: why Section 25A and BIS references are inspirational comparisons only and create no banking, government, or institutional affiliation.', 'hello-elementor-child' ); ?></p>
								<div class="hbc-podcast-player">
									<p class="hbc-podcast-player__title"><?php esc_html_e( 'Sextillion Worthless Points for Human Presence', 'hello-elementor-child' ); ?></p>
									<audio class="hbc-media-player hbc-media-player--audio" controls preload="metadata" title="<?php echo esc_attr__( 'Sextillion Worthless Points for Human Presence', 'hello-elementor-child' ); ?>">
										<source src="<?php echo esc_url( $regulator_podcast_url ); ?>" type="audio/mp4" />
										<?php esc_html_e( 'Your browser does not support HTML audio.', 'hello-elementor-child' ); ?>
									</audio>
								</div>
							</section>
							<section class="hbc-media-slot" data-media-slot="regulator-pdf">
								<span class="hbc-media-slot-type"><?php esc_html_e( 'PDF 2 of 2', 'hello-elementor-child' ); ?></span>
								<h4><?php esc_html_e( 'Government and regulator handout', 'hello-elementor-child' ); ?></h4>
								<p><?php esc_html_e( 'Download the control summary describing the proposed testnet, nonspendable XP, fiscal separation, simulated results, record retention, and proposed May 17, 2030 transition review.', 'hello-elementor-child' ); ?></p>
								<div class="hbc-media-download">
									<span><?php esc_html_e( 'HBC True Testnet Regulatory Handout', 'hello-elementor-child' ); ?></span>
									<a class="hbc-button hbc-button-primary" href="<?php echo esc_url( $regulator_pdf_url ); ?>" download><?php esc_html_e( 'Download regulator handout', 'hello-elementor-child' ); ?></a>
								</div>
							</section>
						</div>
					</article>
				</div>
				<div class="hbc-boundary">
					<strong><?php esc_html_e( 'Testnet and affiliation notice', 'hello-elementor-child' ); ?></strong>
					<p><?php esc_html_e( 'These materials describe a proposed behavioral-study testnet. XP is nonspendable, nonconvertible, nonredeemable, and never money. References to Section 25A, BIS, government, regulators, Unity Village, or any institution do not state endorsement, affiliation, approval, or legal authority.', 'hello-elementor-child' ); ?></p>
				</div>
			</div>
		</section>

		<section class="hbc-section" id="patron-gateway">
			<div class="hbc-wrap">
				<p class="hbc-section-kicker"><?php esc_html_e( 'Continue from the Treasury', 'hello-elementor-child' ); ?></p>
				<h2><?php esc_html_e( 'Earn the MEGA Patron leadership position by showing up.', 'hello-elementor-child' ); ?></h2>
				<p class="hbc-section-intro"><?php esc_html_e( 'Your Peace Pentagon branch is selected earlier, at Observer or Participant entry into the presence study. Confirmed presence within that inherited branch—not payment or hat possession—qualifies a person for Patron Membership under published criteria. An unnumbered MEGA Patron hat may later recognize acceptance of the earned position.', 'hello-elementor-child' ); ?></p>
				<div class="hbc-callout">
					<div>
						<h3><?php esc_html_e( 'Presence earns the position. Acceptance seals the recognition.', 'hello-elementor-child' ); ?></h3>
						<p><?php esc_html_e( 'Hat delivery and two-device acceptance may record an already-earned position. Patron rights activate only through a confirmed Seeking Gratitude “Human Gold” QR acceptance proof. Identity and Trade QR scans cannot substitute. The hat does not create membership, change the inherited branch, or improve rank.', 'hello-elementor-child' ); ?></p>
					</div>
					<a class="hbc-button hbc-button-primary" href="<?php echo esc_url( $patron_url ); ?>"><?php esc_html_e( 'See the earned Patron pathway', 'hello-elementor-child' ); ?></a>
				</div>
			</div>
		</section>
	</main>

	<?php get_template_part( 'templates-parts/part', 'nwp-site-footer' ); ?>
	<?php wp_footer(); ?>
</body>
</html>
