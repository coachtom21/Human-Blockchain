<?php
/**
 * Detente 2030 research portal — videos, podcasts, script PDFs (shared data).
 *
 * @package HelloElementorChild
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Build label from media URL filename.
 *
 * @param string $url      Media URL.
 * @param string $fallback Fallback label.
 * @return string
 */
function hb_d2030_label_from_url( $url, $fallback = '' ) {
	if ( empty( $url ) ) {
		return $fallback;
	}
	$path = wp_parse_url( $url, PHP_URL_PATH );
	if ( empty( $path ) ) {
		return $fallback;
	}
	$file = basename( $path );
	$file = preg_replace( '/\.[^.]+$/', '', $file );
	$file = preg_replace( '/[-_]+/', ' ', $file );
	$file = trim( preg_replace( '/\s+/', ' ', (string) $file ) );
	return $file !== '' ? $file : $fallback;
}

/**
 * Videos, podcasts, and PDF documents for Detente 2030 / Human Ledger.
 *
 * @return array{videos: array<int, array{url: string, title: string}>, podcasts: array<int, array{url: string, title: string}>, pdfs: array<int, array{url: string, title: string}>, featured_video: array{url: string, title: string}|null}
 */
function hb_get_d2030_research_resources() {
	$featured_video_raw = array(
		'url'   => apply_filters( 'hb_d2030_featured_video_url', 'https://humanblockchain.info/wp-content/uploads/2026/06/Coach-Toms-Vision_-The-Human-Blockchain1.mp4' ),
		'title' => apply_filters( 'hb_d2030_featured_video_title', __( "Coach Tom's Vision: The Human Blockchain", 'hello-elementor-child' ) ),
	);
	$videos = array(
		array(
			'url'   => apply_filters( 'hb_d2030_video_1_url', 'https://humanblockchain.info/wp-content/uploads/2026/05/Hello_Device_Experiment.mp4' ),
			'title' => hb_d2030_label_from_url( apply_filters( 'hb_d2030_video_1_url', 'https://humanblockchain.info/wp-content/uploads/2026/05/Hello_Device_Experiment.mp4' ), 'Video 1' ),
		),
		array(
			'url'   => apply_filters( 'hb_d2030_video_2_url', 'https://humanblockchain.info/wp-content/uploads/2026/05/Organized_Krill_Study-1.mp4' ),
			'title' => hb_d2030_label_from_url( apply_filters( 'hb_d2030_video_2_url', 'https://humanblockchain.info/wp-content/uploads/2026/05/Organized_Krill_Study-1.mp4' ), 'Video 2' ),
		),
		array(
			'url'   => apply_filters( 'hb_d2030_video_3_url', 'https://humanblockchain.info/wp-content/uploads/2026/05/Gracebook__Presence_Economics__Architecting_Trust_Without_Capi.mp4' ),
			'title' => apply_filters( 'hb_d2030_video_3_title', __( 'Gracebook: Presence Economics — Architecting Trust Without Capital', 'hello-elementor-child' ) ),
		),
		array(
			'url'   => apply_filters( 'hb_d2030_video_4_url', 'https://humanblockchain.info/wp-content/uploads/2026/05/Join-the-Human-Blockchain-Experiment_-YA-2026-05-131.mp4' ),
			'title' => apply_filters( 'hb_d2030_video_4_title', __( 'Join the Human Blockchain Experiment', 'hello-elementor-child' ) ),
		),
		array(
			'url'   => apply_filters( 'hb_d2030_video_5_url', 'https://humanblockchain.info/wp-content/uploads/2026/05/The-Three-Minute-Economy_-A-New-Era-of-H-2026-05-131.mp4' ),
			'title' => apply_filters( 'hb_d2030_video_5_title', __( 'The Three Minute Economy — A New Era of Human Blockchain', 'hello-elementor-child' ) ),
		),
		array(
			'url'   => apply_filters( 'hb_d2030_video_6_url', 'https://humanblockchain.info/wp-content/uploads/2026/05/From-Petrodollars-to-Human-Presence_-The-2026-05-151.mp4' ),
			'title' => apply_filters( 'hb_d2030_video_6_title', __( 'From Petrodollars to Human Presence', 'hello-elementor-child' ) ),
		),
		array(
			'url'   => apply_filters( 'hb_d2030_video_7_url', 'https://humanblockchain.info/wp-content/uploads/2026/05/Engineering_Trust__The_Mechanics_of_Verified_Human_Presence-1.mp4' ),
			'title' => apply_filters( 'hb_d2030_video_7_title', __( 'Engineering Trust: The Mechanics of Verified Human Presence', 'hello-elementor-child' ) ),
		),
		array(
			'url'   => apply_filters( 'hb_d2030_video_8_url', 'https://humanblockchain.info/wp-content/uploads/2026/05/Engineering_the_Human_Blockchain__The_Mathematics_of_Verified_P-1.mp4' ),
			'title' => apply_filters( 'hb_d2030_video_8_title', __( 'Engineering the Human Blockchain: The Mathematics of Verified Presence', 'hello-elementor-child' ) ),
		),
		array(
			'url'   => apply_filters( 'hb_d2030_video_9_url', 'https://humanblockchain.info/wp-content/uploads/2026/05/Discovering-Human-Gold_-The-YAM-JAM-Rewa-2026-05-191.mp4' ),
			'title' => apply_filters( 'hb_d2030_video_9_title', __( 'Discovering Human Gold: The YAM JAM Rewa', 'hello-elementor-child' ) ),
		),
		array(
			'url'   => apply_filters( 'hb_d2030_video_10_url', 'https://humanblockchain.info/wp-content/uploads/2026/05/Architecting_the_Non-Custodial_Network__The_VFN_MSB_Dual-Layer_-1.mp4' ),
			'title' => apply_filters( 'hb_d2030_video_10_title', __( 'Architecting the Non-Custodial Network: The VFN-MSB Dual-Layer', 'hello-elementor-child' ) ),
		),
	);

	$podcasts = array(
		array(
			'url'   => apply_filters( 'hb_d2030_podcast_1_url', 'https://humanblockchain.info/wp-content/uploads/2026/05/Human_participation_as_a_measurable_economic_signal.mp4' ),
			'title' => hb_d2030_label_from_url( apply_filters( 'hb_d2030_podcast_1_url', 'https://humanblockchain.info/wp-content/uploads/2026/05/Human_participation_as_a_measurable_economic_signal.mp4' ), 'Podcast 1' ),
		),
		array(
			'url'   => apply_filters( 'hb_d2030_podcast_2_url', 'https://humanblockchain.info/wp-content/uploads/2026/05/How_symbolic_pledges_build_accountability-1.mp4' ),
			'title' => hb_d2030_label_from_url( apply_filters( 'hb_d2030_podcast_2_url', 'https://humanblockchain.info/wp-content/uploads/2026/05/How_symbolic_pledges_build_accountability-1.mp4' ), 'Podcast 2' ),
		),
		array(
			'url'   => apply_filters( 'hb_d2030_podcast_3_url', 'https://humanblockchain.info/wp-content/uploads/2026/05/The_Gracebook_human_blockchain_experiment.mp4' ),
			'title' => apply_filters(
				'hb_d2030_podcast_3_title',
				hb_d2030_label_from_url(
					apply_filters( 'hb_d2030_podcast_3_url', 'https://humanblockchain.info/wp-content/uploads/2026/05/The_Gracebook_human_blockchain_experiment.mp4' ),
					__( 'The Gracebook Human Blockchain Experiment', 'hello-elementor-child' )
				)
			),
		),
		array(
			'url'   => apply_filters( 'hb_d2030_podcast_4_url', 'https://humanblockchain.info/wp-content/uploads/2026/05/A_blockchain_for_pure_human_gratitude.mp4' ),
			'title' => apply_filters( 'hb_d2030_podcast_4_title', __( 'A Blockchain for Pure Human Gratitude', 'hello-elementor-child' ) ),
		),
		array(
			'url'   => apply_filters( 'hb_d2030_podcast_5_url', 'https://humanblockchain.info/wp-content/uploads/2026/06/Poor-Mans-Web3_-.mp4' ),
			'title' => apply_filters( 'hb_d2030_podcast_5_title', __( 'Poor Man\'s Web3', 'hello-elementor-child' ) ),
		),
	);

	$pdfs = apply_filters(
		'hb_d2030_script_pdfs',
		array(
			array(
				'url'   => apply_filters( 'hb_d2030_script_pdf_url', 'https://drive.google.com/file/d/1xxjF_mjRmFQvvfidVEC9m5SllTAw-Ca3/view?usp=sharing' ),
				'title' => apply_filters( 'hb_d2030_script_pdf_title', __( 'Detente 2030 Classroom Script', 'hello-elementor-child' ) ),
			),
			array(
				'url'   => apply_filters( 'hb_d2030_script_pdf_2_url', 'https://drive.google.com/file/d/1IneYiu_URK8HkTQP8ifF4wpusjyzvZVh/view?usp=sharing' ),
				'title' => apply_filters( 'hb_d2030_script_pdf_2_title', __( 'Regulator-facing Trust Market Memo — HPI and Kalshi Mirror', 'hello-elementor-child' ) ),
			),
			array(
				'url'   => apply_filters( 'hb_d2030_script_pdf_3_url', 'https://drive.google.com/file/d/1xooc8tQzLs-b1xvkydQm_WAaYdquZWcf/view?usp=sharing' ),
				'title' => apply_filters( 'hb_d2030_script_pdf_3_title', __( 'VFN-MSB Sustainability', 'hello-elementor-child' ) ),
			),
			array(
				'url'   => apply_filters( 'hb_d2030_script_pdf_4_url', 'https://drive.google.com/file/d/1IxAHfX7_b3oV20nh-b2vJzVGmdDVeAy0/view?usp=sharing' ),
				'title' => apply_filters( 'hb_d2030_script_pdf_4_title', __( 'Poor Man\'s Web3', 'hello-elementor-child' ) ),
			),
		)
	);

	$videos   = hb_d2030_filter_resource_items( $videos );
	$podcasts = hb_d2030_filter_resource_items( $podcasts );
	$pdfs     = hb_d2030_filter_resource_items( is_array( $pdfs ) ? $pdfs : array() );
	$featured = hb_d2030_filter_resource_items( array( $featured_video_raw ) );

	return apply_filters(
		'hb_d2030_research_resources',
		array(
			'videos'         => $videos,
			'podcasts'       => $podcasts,
			'pdfs'           => $pdfs,
			'featured_video' => ! empty( $featured ) ? $featured[0] : null,
		)
	);
}

/**
 * @param array<int, array<string, string>> $items Resource rows.
 * @return array<int, array{url: string, title: string}>
 */
function hb_d2030_filter_resource_items( array $items ) {
	$out = array();
	foreach ( $items as $item ) {
		if ( ! is_array( $item ) ) {
			continue;
		}
		$url = isset( $item['url'] ) ? trim( (string) $item['url'] ) : '';
		if ( $url === '' ) {
			continue;
		}
		$title = isset( $item['title'] ) ? trim( (string) $item['title'] ) : '';
		if ( $title === '' ) {
			$title = hb_d2030_label_from_url( $url, __( 'Resource', 'hello-elementor-child' ) );
		}
		$out[] = array(
			'url'   => $url,
			'title' => $title,
		);
	}
	return $out;
}
