<?php
/**
 * Template Name: ETF
 *
 * XP (Experience Presence) ETF — Present Presence / New World Pennies landing.
 *
 * @package HelloElementorChild
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Media URLs — update placeholders when assets are ready.
$hb_etf_video_1_url = 'http://humanblockchain.info/wp-content/uploads/2026/05/Nothing-to-Lose.mp4';
$hb_etf_video_2_url = 'http://humanblockchain.info/wp-content/uploads/2026/05/XP__The_Anti-Speculation_Asset.mp4';
$hb_etf_video_3_url = 'http://humanblockchain.info/wp-content/uploads/2026/05/The-Four-Year-Buildout11.mp4';
$hb_etf_video_4_url = 'http://humanblockchain.info/wp-content/uploads/2026/05/Engineering_the_Trust_Index.mp4';
$hb_etf_video_5_url = 'http://humanblockchain.info/wp-content/uploads/2026/05/Measuring-Gratitude_-The-New-World-Penny1.mp4';

$hb_etf_podcast_1_url = 'http://humanblockchain.info/wp-content/uploads/2026/05/Proving_Human_Presence_Without_Money.mp4';
$hb_etf_podcast_2_url = 'http://humanblockchain.info/wp-content/uploads/2026/05/The_financial_index_for_human_presence.mp4';

$hb_etf_pdf_gdrive_id    = '1Mbs9I2pjM5aXBlrjZKYX-MzRDuvCmWYW';
$hb_etf_pdf_1_url        = 'https://drive.google.com/file/d/' . $hb_etf_pdf_gdrive_id . '/view?usp=sharing';
$hb_etf_pdf_1_download   = 'https://drive.google.com/uc?export=download&id=' . $hb_etf_pdf_gdrive_id;
$hb_etf_pdf_2_url        = 'https://drive.google.com/file/d/1cNujrVu_jFy36r25YeGuZaRR0IMoCBd-/view?usp=sharing';

$hb_etf_video_exts = array( 'mp4', 'webm', 'ogv', 'mov' );
$hb_etf_audio_exts = array( 'mp3', 'm4a', 'ogg', 'oga', 'wav' );

$hb_etf_url_ext = static function ( $url ) {
	$path = (string) wp_parse_url( (string) $url, PHP_URL_PATH );
	return strtolower( (string) pathinfo( $path, PATHINFO_EXTENSION ) );
};

$hb_etf_media_mime = static function ( $ext, $as_audio = false ) {
	if ( $as_audio ) {
		$map = array(
			'mp4' => 'audio/mp4', 'webm' => 'audio/webm', 'ogv' => 'audio/ogg', 'mov' => 'audio/mp4',
			'mp3' => 'audio/mpeg', 'm4a' => 'audio/mp4', 'ogg' => 'audio/ogg', 'oga' => 'audio/ogg', 'wav' => 'audio/wav',
		);
	} else {
		$map = array(
			'mp4' => 'video/mp4', 'webm' => 'video/webm', 'ogv' => 'video/ogg', 'mov' => 'video/quicktime',
			'mp3' => 'audio/mpeg', 'm4a' => 'audio/mp4', 'ogg' => 'audio/ogg', 'oga' => 'audio/ogg', 'wav' => 'audio/wav',
		);
	}
	return isset( $map[ $ext ] ) ? $map[ $ext ] : 'application/octet-stream';
};

/**
 * Render a video slot or placeholder.
 *
 * @param string   $url       Media URL.
 * @param string   $title     Accessible title.
 * @param string   $subtitle  Placeholder label when empty.
 * @param callable $url_ext   Extension helper.
 * @param callable $mime      MIME helper.
 * @param array    $exts      Video extensions.
 */
$hb_etf_render_video = static function ( $url, $title, $subtitle, $url_ext, $mime, $exts ) {
	$url = trim( (string) $url );
	if ( $url !== '' && in_array( $url_ext( $url ), $exts, true ) ) {
		$ext = $url_ext( $url );
		echo '<div class="hb-etf-media-player">';
		echo '<video controls preload="metadata" playsinline>';
		echo '<source src="' . esc_url( $url ) . '" type="' . esc_attr( $mime( $ext, false ) ) . '">';
		esc_html_e( 'Your browser does not support the video element.', 'hello-elementor-child' );
		echo '</video></div>';
		return;
	}
	if ( $url !== '' && false === strpos( $url, 'PLACEHOLDER' ) ) {
		echo '<div class="hb-etf-media-player">';
		echo '<iframe src="' . esc_url( $url ) . '" title="' . esc_attr( $title ) . '" allowfullscreen></iframe>';
		echo '</div>';
		return;
	}
	echo '<div class="hb-etf-media-placeholder">';
	echo '<h3>' . esc_html( $subtitle ) . '</h3>';
	echo '<p>' . esc_html__( 'Video coming soon.', 'hello-elementor-child' ) . '</p>';
	echo '</div>';
};

/**
 * Render podcast / audio slot.
 *
 * @param string   $url      Media URL.
 * @param string   $subtitle Placeholder label.
 * @param callable $url_ext  Extension helper.
 * @param callable $mime     MIME helper.
 * @param array    $v_exts   Video extensions.
 * @param array    $a_exts   Audio extensions.
 */
$hb_etf_render_podcast = static function ( $url, $subtitle, $url_ext, $mime, $v_exts, $a_exts ) use ( $hb_etf_render_video ) {
	$url = trim( (string) $url );
	$ext = $url !== '' ? $url_ext( $url ) : '';
	if ( $url !== '' && in_array( $ext, array_merge( $v_exts, $a_exts ), true ) ) {
		echo '<div class="hb-etf-podcast-player">';
		echo '<h3>' . esc_html( $subtitle ) . '</h3>';
		echo '<audio controls preload="metadata" style="width:100%;">';
		echo '<source src="' . esc_url( $url ) . '" type="' . esc_attr( $mime( $ext, true ) ) . '">';
		echo '</audio>';
		echo '</div>';
		return;
	}
	echo '<div class="hb-etf-media-placeholder hb-etf-media-placeholder--podcast">';
	echo '<h3>' . esc_html( $subtitle ) . '</h3>';
	echo '<p>' . esc_html__( 'Podcast coming soon.', 'hello-elementor-child' ) . '</p>';
	echo '</div>';
};
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>
		<?php
		echo esc_html( get_the_title() ?: __( 'Present Presence | New World Pennies', 'hello-elementor-child' ) );
		echo ' | ';
		echo esc_html( get_bloginfo( 'name' ) );
		?>
	</title>
	<?php wp_head(); ?>
</head>
<body <?php body_class( 'hb-etf-page' ); ?>>
	<?php get_template_part( 'templates-parts/part', 'nwp-site-header' ); ?>

	<div class="hb-etf-wrap">
		<style>
			.hb-etf-wrap {
				--bg: #07111f;
				--panel: #101827;
				--panel2: #141f33;
				--line: #2d4268;
				--gold: #f4c542;
				--green: #38d39f;
				--text: #f5f7fb;
				--muted: #b9c7e6;
				font-family: Arial, Helvetica, sans-serif;
				background: var(--bg);
				color: var(--text);
				line-height: 1.6;
			}
			.hb-etf-wrap * { box-sizing: border-box; }
			.hb-etf-hero {
				padding: 78px 22px;
				text-align: center;
				background: linear-gradient(135deg, #101a3d, #18345f);
			}
			.hb-etf-hero h1 {
				font-size: clamp(2.4rem, 6vw, 4.4rem);
				margin: 0 0 12px;
				color: var(--text);
			}
			.hb-etf-hero p {
				max-width: 920px;
				margin: 0 auto 24px;
				font-size: clamp(1rem, 2.5vw, 1.18rem);
				color: var(--muted);
			}
			.hb-etf-badge {
				display: inline-block;
				padding: 10px 18px;
				border: 1px solid var(--gold);
				border-radius: 999px;
				color: var(--gold);
				font-weight: bold;
				margin-bottom: 22px;
			}
			.hb-etf-cta {
				display: inline-flex;
				align-items: center;
				justify-content: center;
				background: var(--green);
				color: #06111f;
				padding: 15px 28px;
				border-radius: 999px;
				text-decoration: none;
				font-weight: bold;
				text-align: center;
				line-height: 1.2;
				border: 0;
				cursor: pointer;
				transition: opacity 0.2s ease, transform 0.2s ease;
			}
			.hb-etf-cta:hover { opacity: 0.92; transform: translateY(-1px); color: #06111f; }
			.hb-etf-section {
				max-width: 1120px;
				margin: auto;
				padding: 54px 22px;
			}
			.hb-etf-section h2 {
				color: var(--text);
				font-size: clamp(1.6rem, 4vw, 2.2rem);
				margin: 0 0 16px;
			}
			.hb-etf-highlight { color: var(--green); font-weight: bold; }
			.hb-etf-card-grid,
			.hb-etf-media-grid,
			.hb-etf-pdf-grid {
				display: grid;
				grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
				gap: 22px;
				margin-top: 28px;
			}
			.hb-etf-card {
				background: var(--panel2);
				border: 1px solid var(--line);
				border-radius: 20px;
				padding: 24px;
			}
			.hb-etf-card h3 { color: var(--gold); margin-top: 0; }
			.hb-etf-card p { color: var(--muted); margin-bottom: 0; }
			.hb-etf-media-box,
			.hb-etf-pdf-box {
				background: var(--panel);
				border: 2px dashed var(--line);
				border-radius: 20px;
				min-height: 210px;
				padding: 20px;
				display: flex;
				flex-direction: column;
				align-items: stretch;
				justify-content: center;
				text-align: center;
				color: var(--muted);
			}
			.hb-etf-media-box--podcast { min-height: 160px; }
			.hb-etf-media-player video,
			.hb-etf-media-player iframe {
				width: 100%;
				aspect-ratio: 16 / 9;
				border: 0;
				border-radius: 12px;
				background: #000;
			}
			.hb-etf-media-placeholder h3,
			.hb-etf-pdf-box h3 { color: var(--gold); margin: 0 0 8px; }
			.hb-etf-media-placeholder p { margin: 0; font-size: 0.95rem; }
			.hb-etf-podcast-player { width: 100%; padding: 8px 0; text-align: left; }
			.hb-etf-podcast-player h3 {
				margin: 0 0 10px;
				color: var(--gold);
				font-size: clamp(1.15rem, 2.2vw, 1.35rem);
				line-height: 1.35;
			}
			.hb-etf-limit-box {
				background: linear-gradient(135deg, #15213a, #0f2a2b);
				border: 1px solid var(--green);
				border-radius: 22px;
				padding: 30px;
				margin-top: 28px;
			}
			.hb-etf-limit-box h3 { color: var(--green); margin-top: 0; }
			.hb-etf-limit-box p { color: var(--muted); }
			.hb-etf-steps { margin-top: 28px; }
			.hb-etf-step {
				background: var(--panel2);
				border-left: 5px solid var(--green);
				border-radius: 14px;
				padding: 20px;
				margin-bottom: 16px;
				color: var(--muted);
			}
			.hb-etf-step strong { color: var(--text); }
			.hb-etf-footer {
				text-align: center;
				padding: 64px 22px;
				background: #101a3d;
			}
			.hb-etf-footer h2 { color: var(--text); margin-top: 0; }
			.hb-etf-footer p { color: var(--muted); max-width: 640px; margin: 0 auto 20px; }
			.hb-etf-small {
				color: var(--muted);
				font-size: 0.92rem;
				margin-top: 24px;
			}
			.hb-etf-pdf-actions {
				display: flex;
				flex-wrap: wrap;
				gap: 10px;
				justify-content: center;
				margin-top: 16px;
			}
			.hb-etf-cta--outline {
				background: transparent;
				color: var(--green);
				border: 1px solid var(--green);
			}
			.hb-etf-cta--outline:hover { color: var(--green); background: rgba(56, 211, 159, 0.1); }
			@media (max-width: 600px) {
				.hb-etf-hero { padding: 56px 18px; }
				.hb-etf-section { padding: 40px 16px; }
				.hb-etf-card-grid,
				.hb-etf-media-grid,
				.hb-etf-pdf-grid { grid-template-columns: 1fr; }
				.hb-etf-pdf-actions { flex-direction: column; }
				.hb-etf-pdf-actions .hb-etf-cta { width: 100%; }
			}
		</style>

		<section class="hb-etf-hero">
			<div class="hb-etf-badge"><?php esc_html_e( 'Present Presence', 'hello-elementor-child' ); ?></div>
			<h1><?php esc_html_e( 'Digital New World Pennies', 'hello-elementor-child' ); ?></h1>
			<p>
				<?php esc_html_e( 'We create digital New World Pennies that are strictly gratitude. They are not money, not tokens, not securities, and not speculation. They are participation recognition issued by people, groups, and guilds to acknowledge verified human presence.', 'hello-elementor-child' ); ?>
			</p>
			<a class="hb-etf-cta" href="#access"><?php esc_html_e( 'Access the Study Materials', 'hello-elementor-child' ); ?></a>
		</section>

		<section class="hb-etf-section">
			<h2><?php esc_html_e( 'Quick Overview', 'hello-elementor-child' ); ?></h2>
			<p>
				<?php esc_html_e( 'A New World Penny, or NWP, is a digital expression of gratitude. It recognizes participation, presence, cooperation, and acknowledgment. Because it is never money, the supply is unlimited to give away. The only civilizational limit is not supply — it is each person’s daily capacity to accept recognition.', 'hello-elementor-child' ); ?>
			</p>

			<div class="hb-etf-card-grid">
				<div class="hb-etf-card">
					<h3><?php esc_html_e( 'Personal NWP', 'hello-elementor-child' ); ?></h3>
					<p><?php esc_html_e( 'Issued by one person to recognize another person’s presence, contribution, or act of participation.', 'hello-elementor-child' ); ?></p>
				</div>
				<div class="hb-etf-card">
					<h3><?php esc_html_e( '5-Seller Group NWP', 'hello-elementor-child' ); ?></h3>
					<p><?php esc_html_e( 'Issued by a trusted 5-seller group to recognize cooperation, local trust, and verified participation.', 'hello-elementor-child' ); ?></p>
				</div>
				<div class="hb-etf-card">
					<h3><?php esc_html_e( 'Guild NWP', 'hello-elementor-child' ); ?></h3>
					<p><?php esc_html_e( 'Issued by a guild or organized community as shared gratitude for participation in a larger mission.', 'hello-elementor-child' ); ?></p>
				</div>
				<div class="hb-etf-card">
					<h3><?php esc_html_e( 'Immutable Publishing Rights', 'hello-elementor-child' ); ?></h3>
					<p><?php esc_html_e( 'Licensing rights to publish and distribute NWP are immutable. Once granted, they exist as a durable participation right.', 'hello-elementor-child' ); ?></p>
				</div>
			</div>
		</section>

		<section class="hb-etf-section">
			<h2><?php esc_html_e( 'The Daily Acceptance Principle', 'hello-elementor-child' ); ?></h2>
			<div class="hb-etf-limit-box">
				<h3><?php esc_html_e( 'Unlimited to Give. Limited to Accept.', 'hello-elementor-child' ); ?></h3>
				<p>
					<?php
					echo wp_kses_post(
						sprintf(
							/* translators: %s: highlighted dollar amount */
							__( 'New World Pennies can be issued without artificial scarcity because they are gratitude, not money. However, from a civilization standpoint, each person can accept only a maximum daily recognition value of %s.', 'hello-elementor-child' ),
							'<span class="hb-etf-highlight">$0.03</span>'
						)
					);
					?>
				</p>
				<p>
					<?php esc_html_e( 'This keeps NWP focused on gratitude, prevents hoarding, and protects the system from becoming speculative. Plenty can be given. Only a humble amount can be accepted.', 'hello-elementor-child' ); ?>
				</p>
			</div>
		</section>

		<section class="hb-etf-section">
			<h2><?php esc_html_e( 'How Present Presence Works', 'hello-elementor-child' ); ?></h2>
			<div class="hb-etf-steps">
				<div class="hb-etf-step">
					<strong><?php esc_html_e( '1. A person, group, or guild issues NWP.', 'hello-elementor-child' ); ?></strong><br>
					<?php esc_html_e( 'The NWP is offered as gratitude for participation or presence.', 'hello-elementor-child' ); ?>
				</div>
				<div class="hb-etf-step">
					<strong><?php esc_html_e( '2. The recipient voluntarily accepts.', 'hello-elementor-child' ); ?></strong><br>
					<?php esc_html_e( 'Acceptance is opt-in and capped by the daily $.03 recognition limit.', 'hello-elementor-child' ); ?>
				</div>
				<div class="hb-etf-step">
					<strong><?php esc_html_e( '3. The event becomes a participation datapoint.', 'hello-elementor-child' ); ?></strong><br>
					<?php esc_html_e( 'The record reflects acknowledgment, not financial transfer.', 'hello-elementor-child' ); ?>
				</div>
				<div class="hb-etf-step">
					<strong><?php esc_html_e( '4. The ledger remains non-financial.', 'hello-elementor-child' ); ?></strong><br>
					<?php esc_html_e( 'No fiat, crypto, token, security, or remuneration is created.', 'hello-elementor-child' ); ?>
				</div>
			</div>
		</section>

		<section class="hb-etf-section">
			<h2><?php esc_html_e( 'Video Library', 'hello-elementor-child' ); ?></h2>
			<div class="hb-etf-media-grid">
				<div class="hb-etf-media-box">
					<?php
					$hb_etf_render_video(
						$hb_etf_video_1_url,
						__( 'What Is Present Presence?', 'hello-elementor-child' ),
						__( 'Video 1: What Is Present Presence?', 'hello-elementor-child' ),
						$hb_etf_url_ext,
						$hb_etf_media_mime,
						$hb_etf_video_exts
					);
					?>
				</div>
				<div class="hb-etf-media-box">
					<?php
					$hb_etf_render_video(
						$hb_etf_video_2_url,
						__( 'New World Pennies Are Gratitude, Not Money', 'hello-elementor-child' ),
						__( 'Video 2: New World Pennies Are Gratitude, Not Money', 'hello-elementor-child' ),
						$hb_etf_url_ext,
						$hb_etf_media_mime,
						$hb_etf_video_exts
					);
					?>
				</div>
				<div class="hb-etf-media-box">
					<?php
					$hb_etf_render_video(
						$hb_etf_video_3_url,
						__( 'The $.03 Daily Acceptance Limit', 'hello-elementor-child' ),
						__( 'Video 3: The $.03 Daily Acceptance Limit', 'hello-elementor-child' ),
						$hb_etf_url_ext,
						$hb_etf_media_mime,
						$hb_etf_video_exts
					);
					?>
				</div>
				<div class="hb-etf-media-box">
					<?php
					$hb_etf_render_video(
						$hb_etf_video_4_url,
						__( 'Personal, Group, and Guild Recognition', 'hello-elementor-child' ),
						__( 'Video 4: Personal, Group, and Guild Recognition', 'hello-elementor-child' ),
						$hb_etf_url_ext,
						$hb_etf_media_mime,
						$hb_etf_video_exts
					);
					?>
				</div>
				<div class="hb-etf-media-box">
					<?php
					$hb_etf_render_video(
						$hb_etf_video_5_url,
						__( 'Measuring Gratitude: The New World Penny', 'hello-elementor-child' ),
						__( 'Video 5: Measuring Gratitude: The New World Penny', 'hello-elementor-child' ),
						$hb_etf_url_ext,
						$hb_etf_media_mime,
						$hb_etf_video_exts
					);
					?>
				</div>
			</div>
		</section>

		<section class="hb-etf-section">
			<h2><?php esc_html_e( 'Podcast Access', 'hello-elementor-child' ); ?></h2>
			<div class="hb-etf-media-grid">
				<div class="hb-etf-media-box hb-etf-media-box--podcast">
					<?php
					$hb_etf_render_podcast(
						$hb_etf_podcast_1_url,
						__( 'Podcast 1: Presence as the Rarest Human Signal', 'hello-elementor-child' ),
						$hb_etf_url_ext,
						$hb_etf_media_mime,
						$hb_etf_video_exts,
						$hb_etf_audio_exts
					);
					?>
				</div>
				<div class="hb-etf-media-box hb-etf-media-box--podcast">
					<?php
					$hb_etf_render_podcast(
						$hb_etf_podcast_2_url,
						__( 'Podcast 2: Gratitude, Reputation, and the Human Blockchain', 'hello-elementor-child' ),
						$hb_etf_url_ext,
						$hb_etf_media_mime,
						$hb_etf_video_exts,
						$hb_etf_audio_exts
					);
					?>
				</div>
			</div>
		</section>

		<section id="access" class="hb-etf-section">
			<h2><?php esc_html_e( 'PDF Access Points', 'hello-elementor-child' ); ?></h2>
			<div class="hb-etf-pdf-grid">
				<div class="hb-etf-pdf-box">
					<h3><?php esc_html_e( 'PDF 1', 'hello-elementor-child' ); ?></h3>
					<p><?php esc_html_e( 'XP Experience Presence ETF overview and case study.', 'hello-elementor-child' ); ?></p>
					<div class="hb-etf-pdf-actions">
						<a class="hb-etf-cta" href="<?php echo esc_url( $hb_etf_pdf_1_url ); ?>" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Open PDF', 'hello-elementor-child' ); ?></a>
						<a class="hb-etf-cta hb-etf-cta--outline" href="<?php echo esc_url( $hb_etf_pdf_1_download ); ?>" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Download', 'hello-elementor-child' ); ?></a>
					</div>
				</div>
				<div class="hb-etf-pdf-box">
					<h3><?php esc_html_e( 'PDF 2', 'hello-elementor-child' ); ?></h3>
					<p><?php esc_html_e( 'XP ETF participation metric and research variable analysis.', 'hello-elementor-child' ); ?></p>
					<div class="hb-etf-pdf-actions">
						<a class="hb-etf-cta" href="<?php echo esc_url( $hb_etf_pdf_2_url ); ?>" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Open PDF', 'hello-elementor-child' ); ?></a>
					</div>
				</div>
			</div>
		</section>

		<section class="hb-etf-footer">
			<h2><?php esc_html_e( 'Present Presence', 'hello-elementor-child' ); ?></h2>
			<p>
				<?php esc_html_e( 'Give gratitude freely. Accept recognition humbly. Prove human presence without turning gratitude into money.', 'hello-elementor-child' ); ?>
			</p>
			<a
				href="#"
				class="hb-etf-cta cpm-nwp-open-modal"
				data-cpm-modal="cpm-nwp-register-modal"
				aria-controls="cpm-nwp-register-modal"
				aria-haspopup="dialog"
			><?php esc_html_e( 'Register Device / Opt In', 'hello-elementor-child' ); ?></a>
			<p class="hb-etf-small">
				<?php esc_html_e( 'No fiat. No crypto. No remuneration. No passive tracking. Participation recognition only.', 'hello-elementor-child' ); ?>
			</p>
		</section>
	</div>

	<?php get_template_part( 'templates-parts/part', 'nwp-site-footer' ); ?>
	<?php wp_footer(); ?>
</body>
</html>
