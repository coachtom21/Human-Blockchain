<?php
/**
 * Template Name: Present Presence
 *
 * Research portal landing: Human Gold + Algorithmic Alchemy. Combines the
 * Explore Research Prompt hero with the Quick Overview behavioral science brief.
 *
 * @package HelloElementorChild
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Replace these with the actual media URLs once available.
// For self-hosted files (mp4/webm/ogv/mov) the template renders <video>; otherwise <iframe>.
$hb_pp_video_1_url = 'http://humanblockchain.info/wp-content/uploads/2026/05/The_Human_Gold_Experiment__How_Do_We_Measure_Trust_.mp4';
$hb_pp_video_2_url = 'http://humanblockchain.info/wp-content/uploads/2026/05/The-Human-Gold-Experiment_-Presenting-Presence1.mp4';
$hb_pp_podcast_url = 'http://humanblockchain.info/wp-content/uploads/2026/05/Verifying_real_humans_in_a_synthetic_world.mp4';
$hb_pp_pdf_url     = 'http://humanblockchain.info/wp-content/uploads/2026/05/Present-Presence-HTML.pdf';

$hb_pp_contact_email = 'coachtom@legacytoliveby.org';

$hb_pp_video_exts = array( 'mp4', 'webm', 'ogv', 'mov' );
$hb_pp_audio_exts = array( 'mp3', 'm4a', 'ogg', 'oga', 'wav' );

/**
 * Resolve the file extension portion of a URL (empty string when not present).
 *
 * @param string $url Absolute or relative URL.
 * @return string Lowercased extension without the leading dot.
 */
$hb_pp_url_ext = static function ( $url ) {
	$path = (string) wp_parse_url( (string) $url, PHP_URL_PATH );
	return strtolower( (string) pathinfo( $path, PATHINFO_EXTENSION ) );
};

$hb_pp_video_1_ext     = $hb_pp_url_ext( $hb_pp_video_1_url );
$hb_pp_video_2_ext     = $hb_pp_url_ext( $hb_pp_video_2_url );
$hb_pp_video_1_is_file = in_array( $hb_pp_video_1_ext, $hb_pp_video_exts, true );
$hb_pp_video_2_is_file = in_array( $hb_pp_video_2_ext, $hb_pp_video_exts, true );

$hb_pp_podcast_ext        = $hb_pp_url_ext( $hb_pp_podcast_url );
$hb_pp_podcast_has_player = in_array( $hb_pp_podcast_ext, array_merge( $hb_pp_video_exts, $hb_pp_audio_exts ), true );

/**
 * MIME type for the HTML5 <source> tag based on extension.
 *
 * The podcast slot uses $as_audio = true so video containers (mp4/webm/etc.)
 * are advertised as audio/* and the browser renders an <audio> control strip.
 *
 * @param string $ext      Lowercased file extension.
 * @param bool   $as_audio True to map video containers to their audio MIME.
 * @return string
 */
$hb_pp_media_mime = static function ( $ext, $as_audio = false ) {
	if ( $as_audio ) {
		$map = array(
			'mp4'  => 'audio/mp4',
			'webm' => 'audio/webm',
			'ogv'  => 'audio/ogg',
			'mov'  => 'audio/mp4',
			'mp3'  => 'audio/mpeg',
			'm4a'  => 'audio/mp4',
			'ogg'  => 'audio/ogg',
			'oga'  => 'audio/ogg',
			'wav'  => 'audio/wav',
		);
	} else {
		$map = array(
			'mp4'  => 'video/mp4',
			'webm' => 'video/webm',
			'ogv'  => 'video/ogg',
			'mov'  => 'video/quicktime',
			'mp3'  => 'audio/mpeg',
			'm4a'  => 'audio/mp4',
			'ogg'  => 'audio/ogg',
			'oga'  => 'audio/ogg',
			'wav'  => 'audio/wav',
		);
	}
	return isset( $map[ $ext ] ) ? $map[ $ext ] : 'application/octet-stream';
};
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>
		<?php
		echo esc_html( get_the_title() ?: __( 'Present Presence', 'hello-elementor-child' ) );
		echo ' | ';
		echo esc_html( get_bloginfo( 'name' ) );
		?>
	</title>
	<?php wp_head(); ?>
</head>
<body <?php body_class( 'present-presence' ); ?>>
	<?php get_template_part( 'templates-parts/part', 'nwp-site-header' ); ?>

	<section class="hb-research-page">
		<style>
			.hb-research-page {
				font-family: Arial, sans-serif;
				color: #172033;
				background: #f7f8fb;
				padding: 48px 20px;
			}
			.hb-container { max-width: 1120px; margin: 0 auto; }
			.hb-hero {
				background: linear-gradient(135deg, #111827, #283b6b);
				color: #ffffff;
				border-radius: 24px;
				padding: 48px 32px;
				box-shadow: 0 18px 40px rgba(0,0,0,0.18);
			}
			.hb-eyebrow {
				text-transform: uppercase;
				letter-spacing: 0.12em;
				font-size: 13px;
				font-weight: 700;
				color: #ffd166;
				margin-bottom: 14px;
			}
			.hb-hero h1 {
				font-size: clamp(32px, 5vw, 56px);
				line-height: 1.05;
				margin: 0 0 18px;
			}
			.hb-hero p {
				font-size: 19px;
				line-height: 1.6;
				max-width: 820px;
				margin: 0 0 24px;
			}
			.hb-button-row {
				display: flex;
				flex-wrap: wrap;
				gap: 14px;
				margin-top: 28px;
			}
			.hb-btn {
				display: inline-block;
				padding: 14px 20px;
				border-radius: 999px;
				text-decoration: none;
				font-weight: 700;
				transition: 0.2s ease;
			}
			.hb-btn-primary { background: #ffd166; color: #111827; }
			.hb-btn-secondary {
				border: 1px solid rgba(255,255,255,0.5);
				color: #ffffff;
			}
			.hb-btn:hover { transform: translateY(-2px); opacity: 0.92; }
			.hb-grid {
				display: grid;
				grid-template-columns: repeat(3, 1fr);
				gap: 22px;
				margin-top: 32px;
			}
			.hb-card {
				background: #ffffff;
				border-radius: 20px;
				padding: 26px;
				box-shadow: 0 10px 30px rgba(17,24,39,0.08);
				border: 1px solid #e7e9f0;
			}
			.hb-card h2,
			.hb-card h3 { margin-top: 0; color: #111827; }
			.hb-card p,
			.hb-card li { line-height: 1.6; color: #4b5563; }
			.hb-wide { grid-column: span 3; }
			.hb-two  { grid-column: span 2; }
			.hb-video-grid {
				display: grid;
				grid-template-columns: repeat(2, 1fr);
				gap: 22px;
				margin-top: 22px;
			}
			.hb-media-box {
				background: #0f172a;
				color: #ffffff;
				border-radius: 18px;
				overflow: hidden;
				min-height: 260px;
				display: flex;
				align-items: center;
				justify-content: center;
				text-align: center;
				padding: 24px;
			}
			.hb-media-box iframe { width: 100%; aspect-ratio: 16 / 9; border: 0; }
			.hb-podcast { background: #fff7e6; border-left: 6px solid #ffd166; }
			.hb-summary-list {
				display: grid;
				grid-template-columns: repeat(2, 1fr);
				gap: 14px;
				padding: 0;
				list-style: none;
			}
			.hb-summary-list li {
				background: #f3f5fa;
				padding: 16px;
				border-radius: 14px;
			}
			.hb-pdf-box {
				background: #eef6ff;
				border: 1px solid #cfe5ff;
				border-radius: 18px;
				padding: 24px;
				margin-top: 20px;
			}
			.hb-pdf-actions {
				display: flex;
				flex-wrap: wrap;
				gap: 12px;
				margin-top: 16px;
			}
			.hb-pdf-actions a,
			.hb-pdf-actions button {
				border: 0;
				border-radius: 999px;
				padding: 12px 18px;
				font-weight: 700;
				cursor: pointer;
				text-decoration: none;
				background: #1d4ed8;
				color: #ffffff;
			}
			.hb-pdf-actions .hb-light-btn {
				background: #ffffff;
				color: #1d4ed8;
				border: 1px solid #bcd7ff;
			}
			.hb-modal {
				display: none;
				position: fixed;
				z-index: 9999;
				inset: 0;
				background: rgba(15,23,42,0.8);
				padding: 24px;
			}
			.hb-modal-content {
				background: #ffffff;
				max-width: 960px;
				height: 86vh;
				margin: 0 auto;
				border-radius: 20px;
				overflow: hidden;
				position: relative;
			}
			.hb-modal iframe { width: 100%; height: 100%; border: 0; }
			.hb-close {
				position: absolute;
				top: 12px;
				right: 12px;
				background: #111827;
				color: #ffffff;
				border: 0;
				border-radius: 999px;
				padding: 10px 14px;
				cursor: pointer;
				font-weight: 700;
				z-index: 2;
			}
			.hb-footer-cta {
				margin-top: 34px;
				text-align: center;
				background: #111827;
				color: #ffffff;
				padding: 36px 24px;
				border-radius: 24px;
			}
			.hb-footer-cta h2 { margin-top: 0; font-size: 32px; }
			@media (max-width: 800px) {
				.hb-grid,
				.hb-video-grid,
				.hb-summary-list { grid-template-columns: 1fr; }
				.hb-wide,
				.hb-two { grid-column: span 1; }
				.hb-hero { padding: 36px 24px; }
			}
		</style>

		<div class="hb-container">

			<div class="hb-hero">
				<div class="hb-eyebrow"><?php esc_html_e( 'Explore Research Prompt', 'hello-elementor-child' ); ?></div>
				<h1><?php esc_html_e( 'Human Gold: Measuring Verified Human Cooperation', 'hello-elementor-child' ); ?></h1>
				<p>
					<?php esc_html_e( 'Human Blockchain invites behavioral science researchers to explore how verified human presence, cooperation, and delivery integrity can become a transparent trust layer for fiat and crypto systems — not a replacement for them.', 'hello-elementor-child' ); ?>
				</p>

				<div class="hb-button-row">
					<a href="#hb-overview" class="hb-btn hb-btn-primary"><?php esc_html_e( 'Quick Overview', 'hello-elementor-child' ); ?></a>
					<a href="#hb-media" class="hb-btn hb-btn-secondary"><?php esc_html_e( 'Watch Research Videos', 'hello-elementor-child' ); ?></a>
					<a href="#hb-pdf" class="hb-btn hb-btn-secondary"><?php esc_html_e( 'View PDF Brief', 'hello-elementor-child' ); ?></a>
				</div>
			</div>

			<div id="hb-overview" class="hb-grid">

				<div class="hb-card hb-wide">
					<h2><?php esc_html_e( 'Quick Summary', 'hello-elementor-child' ); ?></h2>
					<p>
						<?php esc_html_e( 'The Human Gold Experiment studies whether authentic human cooperation can be measured through voluntary device-based proof of presence. The goal is to create a behavioral science framework where a verified interaction becomes a trusted signal of reputation, participation, and delivery integrity.', 'hello-elementor-child' ); ?>
					</p>

					<ul class="hb-summary-list">
						<li><strong><?php esc_html_e( 'Core Question:', 'hello-elementor-child' ); ?></strong><br><?php esc_html_e( 'Can verified human interaction reduce speculative noise?', 'hello-elementor-child' ); ?></li>
						<li><strong><?php esc_html_e( 'Method:', 'hello-elementor-child' ); ?></strong><br><?php esc_html_e( 'Two universal QR codes, device identity, timestamp, distance, and consent.', 'hello-elementor-child' ); ?></li>
						<li><strong><?php esc_html_e( 'Window:', 'hello-elementor-child' ); ?></strong><br><?php esc_html_e( '3 minutes, 50 meters, one verified human interaction.', 'hello-elementor-child' ); ?></li>
						<li><strong><?php esc_html_e( 'Purpose:', 'hello-elementor-child' ); ?></strong><br><?php esc_html_e( 'Measure cooperation before fiat or crypto value moves.', 'hello-elementor-child' ); ?></li>
					</ul>
				</div>

				<div class="hb-card">
					<h3><?php esc_html_e( 'Why Researchers Should Care', 'hello-elementor-child' ); ?></h3>
					<p><?php esc_html_e( 'AI can imitate attention, but it cannot easily prove authentic human cooperation. This creates a timely research opportunity for public policy, behavioral economics, civic trust, and digital governance.', 'hello-elementor-child' ); ?></p>
				</div>

				<div class="hb-card">
					<h3><?php esc_html_e( 'What Is Human Gold?', 'hello-elementor-child' ); ?></h3>
					<p><?php esc_html_e( 'Human Gold is not money. It is a metaphor for verified human presence — the scarce social resource that becomes more valuable as artificial intelligence and speculation create more noise.', 'hello-elementor-child' ); ?></p>
				</div>

				<div class="hb-card">
					<h3><?php esc_html_e( 'What Is Being Tested?', 'hello-elementor-child' ); ?></h3>
					<p><?php esc_html_e( 'The study tests whether voluntary proof-of-presence events can establish reputation, trust, and measurable cooperation without replacing existing financial systems.', 'hello-elementor-child' ); ?></p>
				</div>

			</div>

			<div id="hb-media" class="hb-card hb-wide" style="margin-top:32px;">
				<h2><?php esc_html_e( 'Research Media', 'hello-elementor-child' ); ?></h2>
				<p><?php esc_html_e( 'Here are two research videos and one podcast overview here for fast discovery by students, researchers, institutional reviewers, and civic partners.', 'hello-elementor-child' ); ?></p>

				<div class="hb-video-grid">
					<div class="hb-media-box">
						<?php if ( $hb_pp_video_1_is_file ) : ?>
							<video controls preload="metadata" playsinline style="width:100%; aspect-ratio: 16 / 9; border:0;">
								<source src="<?php echo esc_url( $hb_pp_video_1_url ); ?>" type="<?php echo esc_attr( $hb_pp_media_mime( $hb_pp_video_1_ext ) ); ?>">
								<?php esc_html_e( 'Your browser does not support the video element.', 'hello-elementor-child' ); ?>
							</video>
						<?php else : ?>
							<iframe src="<?php echo esc_url( $hb_pp_video_1_url ); ?>" title="<?php esc_attr_e( 'Human Gold Research Overview Video', 'hello-elementor-child' ); ?>" allowfullscreen></iframe>
						<?php endif; ?>
					</div>

					<div class="hb-media-box">
						<?php if ( $hb_pp_video_2_is_file ) : ?>
							<video controls preload="metadata" playsinline style="width:100%; aspect-ratio: 16 / 9; border:0;">
								<source src="<?php echo esc_url( $hb_pp_video_2_url ); ?>" type="<?php echo esc_attr( $hb_pp_media_mime( $hb_pp_video_2_ext ) ); ?>">
								<?php esc_html_e( 'Your browser does not support the video element.', 'hello-elementor-child' ); ?>
							</video>
						<?php else : ?>
							<iframe src="<?php echo esc_url( $hb_pp_video_2_url ); ?>" title="<?php esc_attr_e( 'Algorithmic Alchemy Research Video', 'hello-elementor-child' ); ?>" allowfullscreen></iframe>
						<?php endif; ?>
					</div>
				</div>

				<div class="hb-card hb-podcast" style="margin-top:22px;">
					<h3><?php esc_html_e( 'Podcast Overview', 'hello-elementor-child' ); ?></h3>
					<p><?php esc_html_e( 'Listen to the research prompt explaining Human Gold, Algorithmic Alchemy, and the behavioral science opportunity behind verified human cooperation.', 'hello-elementor-child' ); ?></p>

					<?php if ( $hb_pp_podcast_has_player ) : ?>
						<audio controls preload="metadata" style="width:100%;">
							<source src="<?php echo esc_url( $hb_pp_podcast_url ); ?>" type="<?php echo esc_attr( $hb_pp_media_mime( $hb_pp_podcast_ext, true ) ); ?>">
							<?php esc_html_e( 'Your browser does not support the audio element.', 'hello-elementor-child' ); ?>
						</audio>
					<?php else : ?>
						<iframe src="<?php echo esc_url( $hb_pp_podcast_url ); ?>" title="<?php esc_attr_e( 'Podcast Overview', 'hello-elementor-child' ); ?>" style="width:100%; height:180px; border:0; border-radius:12px;" allow="autoplay"></iframe>
					<?php endif; ?>
				</div>
			</div>

			<div id="hb-pdf" class="hb-pdf-box">
				<h2><?php esc_html_e( 'Research Brief PDF', 'hello-elementor-child' ); ?></h2>
				<p><?php esc_html_e( 'Download or preview the PDF research brief for a quick institutional overview, study framing, and implementation prompt.', 'hello-elementor-child' ); ?></p>

				<div class="hb-pdf-actions">
					<a href="<?php echo esc_url( $hb_pp_pdf_url ); ?>" target="_blank" rel="noopener"><?php esc_html_e( 'Open PDF', 'hello-elementor-child' ); ?></a>
					<?php $hb_pp_pdf_filename = basename( (string) wp_parse_url( $hb_pp_pdf_url, PHP_URL_PATH ) ); ?>
					<a
						href="<?php echo esc_url( $hb_pp_pdf_url ); ?>"
						class="hb-light-btn"
						id="hbPdfDownloadBtn"
						download="<?php echo esc_attr( $hb_pp_pdf_filename ); ?>"
						data-filename="<?php echo esc_attr( $hb_pp_pdf_filename ); ?>"
					><?php esc_html_e( 'Download PDF', 'hello-elementor-child' ); ?></a>
					<button type="button" id="hbPdfPreviewBtn"><?php esc_html_e( 'Preview PDF', 'hello-elementor-child' ); ?></button>
				</div>
			</div>

			<div class="hb-footer-cta">
				<h2><?php esc_html_e( 'Urgency to Act', 'hello-elementor-child' ); ?></h2>
				<p><?php esc_html_e( 'The question is not whether human behavior will be measured in the AI age. The question is whether researchers will help ensure it is measured fairly, transparently, voluntarily, and with human dignity at the center.', 'hello-elementor-child' ); ?></p>
				<a href="<?php echo esc_url( 'mailto:' . $hb_pp_contact_email ); ?>" class="hb-btn hb-btn-primary"><?php esc_html_e( 'Become a Researcher', 'hello-elementor-child' ); ?></a>
			</div>

		</div>

		<div id="hbPdfModal" class="hb-modal" role="dialog" aria-modal="true" aria-label="<?php esc_attr_e( 'Research Brief PDF Preview', 'hello-elementor-child' ); ?>">
			<div class="hb-modal-content">
				<button type="button" class="hb-close" id="hbPdfCloseBtn"><?php esc_html_e( 'Close', 'hello-elementor-child' ); ?></button>
				<iframe src="<?php echo esc_url( $hb_pp_pdf_url ); ?>" title="<?php esc_attr_e( 'Research Brief PDF Preview', 'hello-elementor-child' ); ?>"></iframe>
			</div>
		</div>

		<script>
			(function () {
				var openBtn     = document.getElementById('hbPdfPreviewBtn');
				var closeBtn    = document.getElementById('hbPdfCloseBtn');
				var modal       = document.getElementById('hbPdfModal');
				var downloadBtn = document.getElementById('hbPdfDownloadBtn');

				if (modal) {
					if (openBtn)  { openBtn.addEventListener('click', function () { modal.style.display = 'block'; }); }
					if (closeBtn) { closeBtn.addEventListener('click', function () { modal.style.display = 'none'; }); }
					modal.addEventListener('click', function (event) {
						if (event.target === modal) { modal.style.display = 'none'; }
					});
					document.addEventListener('keydown', function (event) {
						if (event.key === 'Escape' && modal.style.display === 'block') {
							modal.style.display = 'none';
						}
					});
				}

				if (downloadBtn) {
					downloadBtn.addEventListener('click', function (event) {
						var url = downloadBtn.getAttribute('href');
						var filename = downloadBtn.getAttribute('data-filename') || 'download.pdf';
						if (!url) { return; }

						event.preventDefault();

						fetch(url, { credentials: 'omit' })
							.then(function (response) {
								if (!response.ok) { throw new Error('HTTP ' + response.status); }
								return response.blob();
							})
							.then(function (blob) {
								var blobUrl = URL.createObjectURL(blob);
								var anchor  = document.createElement('a');
								anchor.href = blobUrl;
								anchor.download = filename;
								document.body.appendChild(anchor);
								anchor.click();
								anchor.remove();
								setTimeout(function () { URL.revokeObjectURL(blobUrl); }, 1000);
							})
							.catch(function () {
								// CORS or network failure (e.g. cross-origin asset without
								// Access-Control-Allow-Origin). Fall back to opening the file
								// in a new tab so the user can still save it manually.
								window.open(url, '_blank', 'noopener');
							});
					});
				}
			}());
		</script>
	</section>

	<section class="quick-overview-section">

		<style>
			.quick-overview-section {
				font-family: Arial, sans-serif;
				background: #f7f9fc;
				padding: 60px 20px;
				color: #172033;
			}
			.qo-container { max-width: 1180px; margin: 0 auto; }
			.qo-header { text-align: center; margin-bottom: 48px; }
			.qo-eyebrow {
				display: inline-block;
				font-size: 13px;
				font-weight: 700;
				letter-spacing: .14em;
				text-transform: uppercase;
				color: #1d4ed8;
				margin-bottom: 14px;
			}
			.qo-header h2 {
				font-size: clamp(34px, 5vw, 58px);
				line-height: 1.05;
				margin: 0 0 18px;
				color: #0f172a;
			}
			.qo-header p {
				max-width: 850px;
				margin: 0 auto;
				font-size: 20px;
				line-height: 1.7;
				color: #475569;
			}
			.qo-highlight {
				background: linear-gradient(135deg, #111827, #1e3a8a);
				color: #ffffff;
				padding: 42px;
				border-radius: 28px;
				margin-bottom: 42px;
				box-shadow: 0 18px 40px rgba(0,0,0,0.12);
			}
			.qo-highlight h2 { margin-top: 0; font-size: 36px; margin-bottom: 18px; }
			.qo-highlight p {
				font-size: 19px;
				line-height: 1.8;
				margin-bottom: 0;
				color: rgba(255,255,255,0.92);
			}
			.qo-grid {
				display: grid;
				grid-template-columns: repeat(3, 1fr);
				gap: 24px;
				margin-bottom: 42px;
			}
			.qo-card {
				background: #ffffff;
				border-radius: 22px;
				padding: 28px;
				border: 1px solid #e5e7eb;
				box-shadow: 0 8px 24px rgba(15,23,42,0.06);
				transition: 0.2s ease;
			}
			.qo-card:hover { transform: translateY(-4px); }
			.qo-card h3 {
				margin-top: 0;
				margin-bottom: 14px;
				font-size: 24px;
				color: #0f172a;
			}
			.qo-card p { line-height: 1.7; color: #4b5563; margin-bottom: 0; }
			.qo-process {
				background: #ffffff;
				border-radius: 28px;
				padding: 42px;
				border: 1px solid #dbe3ef;
				box-shadow: 0 8px 24px rgba(15,23,42,0.05);
				margin-bottom: 42px;
			}
			.qo-process h2 {
				margin-top: 0;
				text-align: center;
				font-size: 38px;
				margin-bottom: 36px;
			}
			.qo-steps {
				display: grid;
				grid-template-columns: repeat(4, 1fr);
				gap: 22px;
			}
			.qo-step {
				background: #f8fafc;
				border-radius: 20px;
				padding: 24px;
				text-align: center;
				border: 1px solid #e2e8f0;
			}
			.qo-step-number {
				width: 54px;
				height: 54px;
				border-radius: 50%;
				background: #1d4ed8;
				color: #ffffff;
				display: flex;
				align-items: center;
				justify-content: center;
				font-size: 22px;
				font-weight: 700;
				margin: 0 auto 18px;
			}
			.qo-step h4 {
				margin-top: 0;
				margin-bottom: 12px;
				font-size: 21px;
				color: #111827;
			}
			.qo-step p {
				font-size: 15px;
				line-height: 1.6;
				color: #475569;
				margin-bottom: 0;
			}
			.qo-summary-box {
				background: linear-gradient(135deg, #fff7e6, #ffffff);
				border: 1px solid #ffe0a3;
				border-radius: 26px;
				padding: 38px;
			}
			.qo-summary-box h2 {
				margin-top: 0;
				font-size: 34px;
				margin-bottom: 18px;
				color: #111827;
			}
			.qo-summary-box p {
				font-size: 18px;
				line-height: 1.8;
				color: #4b5563;
				margin-bottom: 0;
			}
			.qo-quote {
				margin-top: 28px;
				padding-left: 22px;
				border-left: 5px solid #f59e0b;
				font-size: 24px;
				line-height: 1.5;
				color: #111827;
				font-weight: 600;
			}
			@media (max-width: 980px) {
				.qo-grid,
				.qo-steps { grid-template-columns: 1fr; }
				.qo-highlight,
				.qo-process,
				.qo-summary-box { padding: 28px; }
			}
		</style>

		<div class="qo-container">

			<div class="qo-header">
				<div class="qo-eyebrow"><?php esc_html_e( 'Quick Overview', 'hello-elementor-child' ); ?></div>
				<h2><?php esc_html_e( 'Human Gold & Algorithmic Alchemy', 'hello-elementor-child' ); ?></h2>
				<p><?php esc_html_e( 'Human Blockchain is a behavioral science initiative exploring whether verified human cooperation can become a transparent trust layer supporting fiat and crypto systems in the age of artificial intelligence.', 'hello-elementor-child' ); ?></p>
			</div>

			<div class="qo-highlight">
				<h2><?php esc_html_e( 'Why This Matters Now', 'hello-elementor-child' ); ?></h2>
				<p><?php esc_html_e( 'Artificial intelligence can imitate engagement. Algorithms can manipulate attention. Speculation can distort financial value. But authentic human presence remains scarce. The Human Gold Experiment studies whether verified participation, cooperation, and delivery integrity can become measurable signals of trust in a rapidly automated world.', 'hello-elementor-child' ); ?></p>
			</div>

			<div class="qo-grid">

				<div class="qo-card">
					<h3><?php esc_html_e( 'What Is Human Gold?', 'hello-elementor-child' ); ?></h3>
					<p><?php esc_html_e( 'Human Gold is not a currency. It is a concept representing verified human participation and cooperation. It measures presence, accountability, and engagement rather than speculation.', 'hello-elementor-child' ); ?></p>
				</div>

				<div class="qo-card">
					<h3><?php esc_html_e( 'What Is Algorithmic Alchemy?', 'hello-elementor-child' ); ?></h3>
					<p><?php esc_html_e( 'Algorithmic Alchemy transforms speculation into reconciliation by measuring proven human interaction. The focus shifts from extracting attention to verifying authentic participation.', 'hello-elementor-child' ); ?></p>
				</div>

				<div class="qo-card">
					<h3><?php esc_html_e( 'What Is Being Tested?', 'hello-elementor-child' ); ?></h3>
					<p><?php esc_html_e( 'Researchers study whether voluntary proof-of-presence events can establish measurable trust, improve accountability, and reduce noise in digital economic environments.', 'hello-elementor-child' ); ?></p>
				</div>

			</div>

			<div class="qo-process">

				<h2><?php esc_html_e( 'How the Verification Process Works', 'hello-elementor-child' ); ?></h2>

				<div class="qo-steps">

					<div class="qo-step">
						<div class="qo-step-number">1</div>
						<h4><?php esc_html_e( 'Identity', 'hello-elementor-child' ); ?></h4>
						<p><?php esc_html_e( 'Registered devices establish voluntary participation through universal QR identity verification.', 'hello-elementor-child' ); ?></p>
					</div>

					<div class="qo-step">
						<div class="qo-step-number">2</div>
						<h4><?php esc_html_e( 'Presence', 'hello-elementor-child' ); ?></h4>
						<p><?php esc_html_e( 'Two participants confirm interaction within a 3-minute window and 50-meter proximity range.', 'hello-elementor-child' ); ?></p>
					</div>

					<div class="qo-step">
						<div class="qo-step-number">3</div>
						<h4><?php esc_html_e( 'Verification', 'hello-elementor-child' ); ?></h4>
						<p><?php esc_html_e( 'Timestamp, location, and confirmation responses create an append-only record of participation.', 'hello-elementor-child' ); ?></p>
					</div>

					<div class="qo-step">
						<div class="qo-step-number">4</div>
						<h4><?php esc_html_e( 'Research', 'hello-elementor-child' ); ?></h4>
						<p><?php esc_html_e( 'Behavioral science researchers evaluate cooperation, trust formation, and participation metrics.', 'hello-elementor-child' ); ?></p>
					</div>

				</div>

			</div>

			<div class="qo-summary-box">

				<h2><?php esc_html_e( 'A Trust Layer — Not a Replacement System', 'hello-elementor-child' ); ?></h2>
				<p><?php esc_html_e( 'Human Gold does not seek to replace fiat currency or cryptocurrency. It functions as a verification layer measuring authentic participation before speculative financial value enters the equation. The initiative is designed as a voluntary behavioral science framework focused on trust, transparency, and measurable cooperation.', 'hello-elementor-child' ); ?></p>

				<div class="qo-quote">
					<?php esc_html_e( '“The question is not whether human behavior will be measured in the AI age. The question is whether it will be measured fairly, transparently, and voluntarily.”', 'hello-elementor-child' ); ?>
				</div>

			</div>

		</div>

	</section>

	<?php get_template_part( 'templates-parts/part', 'nwp-site-footer' ); ?>
	<?php wp_footer(); ?>
</body>
</html>
