<?php
/**
 * Doorway counts on HumanBlockchain: register started through complete.
 *
 * @package HelloElementorChild
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class HB_Doorway_Counts {

	const OPTION = 'hb_doorway_counts';

	/**
	 * @return void
	 */
	public static function init() {
		add_action( 'admin_menu', array( __CLASS__, 'admin_menu' ) );
	}

	/**
	 * @return array<string,int>
	 */
	public static function all() {
		$stored = get_option( self::OPTION, array() );
		$keys   = array(
			'registration_started',
			'device_registered',
			'gracebook_accepted',
			'onboarding_complete',
		);
		$out = array();
		foreach ( $keys as $key ) {
			$out[ $key ] = isset( $stored[ $key ] ) ? (int) $stored[ $key ] : 0;
		}
		return $out;
	}

	/**
	 * @param string $key Count key.
	 * @return void
	 */
	public static function bump( $key ) {
		$counts = self::all();
		if ( ! array_key_exists( $key, $counts ) ) {
			return;
		}
		$counts[ $key ] = $counts[ $key ] + 1;
		update_option( self::OPTION, $counts, false );
	}

	/**
	 * @return void
	 */
	public static function admin_menu() {
		add_management_page(
			__( 'Doorway counts', 'hello-elementor-child' ),
			__( 'Doorway counts', 'hello-elementor-child' ),
			'manage_options',
			'hb-doorway',
			array( __CLASS__, 'admin_page' )
		);
	}

	/**
	 * @return void
	 */
	/**
	 * @return array<string,int>
	 */
	public static function mega_counts() {
		$url = class_exists( 'HB_Start_Activate' )
			? HB_Start_Activate::mega_rest_base() . '/megavoters/v1/doorway'
			: 'https://megavoters.com/wp-json/megavoters/v1/doorway';

		$response = wp_remote_get(
			$url,
			array(
				'timeout'   => 8,
				'sslverify' => ! ( class_exists( 'HB_Start_Activate' ) && HB_Start_Activate::is_local_env() ),
			)
		);
		if ( is_wp_error( $response ) ) {
			return array( 'start_viewed' => 0, 'participate_chosen' => 0 );
		}

		$body = json_decode( (string) wp_remote_retrieve_body( $response ), true );
		if ( ! is_array( $body ) ) {
			return array( 'start_viewed' => 0, 'participate_chosen' => 0 );
		}

		return array(
			'start_viewed'       => isset( $body['start_viewed'] ) ? (int) $body['start_viewed'] : 0,
			'participate_chosen' => isset( $body['participate_chosen'] ) ? (int) $body['participate_chosen'] : 0,
		);
	}

	public static function admin_page() {
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}
		$mega   = self::mega_counts();
		$counts = self::all();
		$rows   = array(
			'Start viewed'          => $mega['start_viewed'],
			'Participate chosen'    => $mega['participate_chosen'],
			'Registration started'  => $counts['registration_started'],
			'Device registered'     => $counts['device_registered'],
			'Gracebook accepted'    => $counts['gracebook_accepted'],
			'Onboarding complete'   => $counts['onboarding_complete'],
		);
		?>
		<div class="wrap">
			<h1><?php esc_html_e( 'Doorway counts', 'hello-elementor-child' ); ?></h1>
			<p><?php esc_html_e( 'These six counts only. No XP, shop, or pageview extras.', 'hello-elementor-child' ); ?></p>
			<table class="widefat striped" style="max-width:480px">
				<tbody>
					<?php foreach ( $rows as $label => $value ) : ?>
						<tr><th><?php echo esc_html( $label ); ?></th><td><?php echo (int) $value; ?></td></tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
		<?php
	}
}
