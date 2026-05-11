<?php
/**
 * REST API for the verify-me Discord bot: membership lookup + verification XP (HumanBlockchain).
 *
 * Routes (Bearer: HB_DISCORD_BOT_API_KEY constant or option hb_discord_bot_api_key):
 * - GET  /wp-json/hb/v1/discord-bot/membership?email=
 * - POST /wp-json/hb/v1/discord-bot/verification
 *
 * @package HumanBlockchain
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Discord bot integration (server-to-server).
 */
class HB_Discord_Bot_Rest {

	/**
	 * Hooks.
	 */
	public static function init() {
		add_action( 'rest_api_init', array( __CLASS__, 'register_routes' ) );
	}

	/**
	 * API key from wp-config constant or option.
	 *
	 * @return string
	 */
	public static function get_stored_api_key() {
		if ( defined( 'HB_DISCORD_BOT_API_KEY' ) && HB_DISCORD_BOT_API_KEY !== '' && HB_DISCORD_BOT_API_KEY !== null ) {
			return (string) HB_DISCORD_BOT_API_KEY;
		}
		return trim( (string) get_option( 'hb_discord_bot_api_key', '' ) );
	}

	/**
	 * @param WP_REST_Request $request Request.
	 * @return bool|WP_Error
	 */
	public static function permission_bearer( WP_REST_Request $request ) {
		$stored = self::get_stored_api_key();
		if ( $stored === '' ) {
			return new WP_Error(
				'hb_bot_api_disabled',
				__( 'Discord bot API key is not configured (HB_DISCORD_BOT_API_KEY or hb_discord_bot_api_key).', 'hello-elementor-child' ),
				array( 'status' => 503 )
			);
		}
		$auth_header = $request->get_header( 'Authorization' );
		$auth_header = is_string( $auth_header ) ? $auth_header : '';
		$api_key     = preg_replace( '/^\s*Bearer\s+/i', '', trim( $auth_header ) );
		if ( ! is_string( $api_key ) || $api_key === '' || ! hash_equals( $stored, $api_key ) ) {
			return new WP_Error(
				'rest_forbidden',
				__( 'Invalid or missing Bearer token.', 'hello-elementor-child' ),
				array( 'status' => 401 )
			);
		}
		return true;
	}

	/**
	 * Register routes.
	 */
	public static function register_routes() {
		register_rest_route(
			'hb/v1',
			'/discord-bot/membership',
			array(
				'methods'             => WP_REST_Server::READABLE,
				'callback'            => array( __CLASS__, 'handle_membership' ),
				'permission_callback' => array( __CLASS__, 'permission_bearer' ),
				'args'                => array(
					'email' => array(
						'required'          => true,
						'type'              => 'string',
						'sanitize_callback' => 'sanitize_email',
					),
				),
			)
		);

		register_rest_route(
			'hb/v1',
			'/discord-bot/verification',
			array(
				'methods'             => WP_REST_Server::CREATABLE,
				'callback'            => array( __CLASS__, 'handle_verification' ),
				'permission_callback' => array( __CLASS__, 'permission_bearer' ),
			)
		);
	}

	/**
	 * Map PMPro / display level name to bot roles: pioneer (MEGAvoter) | patron.
	 *
	 * @param string $level_name Level label.
	 * @return string|null pioneer, patron, or null if unknown / inactive tier.
	 */
	public static function normalize_membership_slug( $level_name ) {
		$name = strtolower( trim( (string) $level_name ) );
		if ( $name === '' ) {
			return null;
		}
		if ( strpos( $name, 'patron' ) !== false ) {
			return 'patron';
		}
		if ( strpos( $name, 'pioneer' ) !== false || strpos( $name, 'yamer' ) !== false || strpos( $name, 'mega' ) !== false ) {
			return 'pioneer';
		}
		return null;
	}

	/**
	 * Resolve membership for a WordPress user email.
	 *
	 * @param string $email Email.
	 * @return array{member:bool, membership_name:?string, user_id:int}
	 */
	public static function resolve_membership_by_email( $email ) {
		$email = sanitize_email( $email );
		if ( ! $email || ! is_email( $email ) ) {
			return array(
				'member'            => false,
				'membership_name'   => null,
				'user_id'           => 0,
			);
		}

		$user = get_user_by( 'email', $email );
		if ( ! $user instanceof WP_User ) {
			return array(
				'member'            => false,
				'membership_name'   => null,
				'user_id'           => 0,
			);
		}

		$uid = (int) $user->ID;

		if ( function_exists( 'pmpro_getMembershipLevelForUser' ) ) {
			$level = pmpro_getMembershipLevelForUser( $uid );
			if ( ! $level || empty( $level->id ) ) {
				return array(
					'member'            => false,
					'membership_name'   => null,
					'user_id'           => $uid,
				);
			}
			$slug = self::normalize_membership_slug( isset( $level->name ) ? $level->name : '' );
			if ( $slug === null ) {
				return array(
					'member'            => false,
					'membership_name'   => null,
					'user_id'           => $uid,
				);
			}
			return array(
				'member'            => true,
				'membership_name'   => $slug,
				'user_id'           => $uid,
			);
		}

		$raw = get_user_meta( $uid, '_membership_level', true );
		if ( is_array( $raw ) && ! empty( $raw['name'] ) ) {
			$slug = self::normalize_membership_slug( $raw['name'] );
			if ( $slug === null ) {
				return array(
					'member'            => false,
					'membership_name'   => null,
					'user_id'           => $uid,
				);
			}
			return array(
				'member'            => true,
				'membership_name'   => $slug,
				'user_id'           => $uid,
			);
		}

		return array(
			'member'            => false,
			'membership_name'   => null,
			'user_id'           => $uid,
		);
	}

	/**
	 * GET membership by email (for Discord bot).
	 *
	 * @param WP_REST_Request $request Request.
	 * @return WP_REST_Response|WP_Error
	 */
	public static function handle_membership( WP_REST_Request $request ) {
		$email  = sanitize_email( $request->get_param( 'email' ) );
		$parsed = self::resolve_membership_by_email( $email );
		return new WP_REST_Response(
			array(
				'member'            => (bool) $parsed['member'],
				'membership_name'   => $parsed['membership_name'],
			),
			200
		);
	}

	/**
	 * POST Discord verification: link Discord user, award XP (idempotent by event id).
	 *
	 * @param WP_REST_Request $request Request.
	 * @return WP_REST_Response|WP_Error
	 */
	public static function handle_verification( WP_REST_Request $request ) {
		$params = $request->get_json_params();
		if ( ! is_array( $params ) ) {
			$params = array();
		}

		$email = isset( $params['email'] ) ? sanitize_email( $params['email'] ) : '';
		if ( ! $email || ! is_email( $email ) ) {
			return new WP_Error(
				'invalid_email',
				__( 'Valid email is required.', 'hello-elementor-child' ),
				array( 'status' => 400 )
			);
		}

		$discord_id = isset( $params['discord_id'] ) ? sanitize_text_field( (string) $params['discord_id'] ) : '';
		if ( $discord_id === '' ) {
			return new WP_Error(
				'invalid_discord',
				__( 'discord_id is required.', 'hello-elementor-child' ),
				array( 'status' => 400 )
			);
		}

		$parsed = self::resolve_membership_by_email( $email );
		if ( ! $parsed['member'] || empty( $parsed['membership_name'] ) ) {
			return new WP_Error(
				'not_member',
				__( 'No active Pioneer/Patron-style membership for this email.', 'hello-elementor-child' ),
				array( 'status' => 403 )
			);
		}

		$user = get_user_by( 'email', $email );
		if ( ! $user instanceof WP_User ) {
			return new WP_Error(
				'user_not_found',
				__( 'User not found.', 'hello-elementor-child' ),
				array( 'status' => 404 )
			);
		}

		$uid = (int) $user->ID;

		$event_id = isset( $params['id'] ) ? sanitize_text_field( (string) $params['id'] ) : '';
		if ( $event_id !== '' ) {
			$done = get_user_meta( $uid, 'hb_discord_verification_events', true );
			$list = is_array( $done ) ? $done : array();
			if ( in_array( $event_id, $list, true ) ) {
				$total = (int) get_user_meta( $uid, 'hb_discord_xp_total', true );
				return new WP_REST_Response(
					array(
						'success'           => true,
						'duplicate'       => true,
						'message'         => __( 'Event already recorded.', 'hello-elementor-child' ),
						'xp_total'        => $total,
						'membership_name' => $parsed['membership_name'],
					),
					200
				);
			}
		}

		$xp_raw = isset( $params['xp_awarded'] ) ? $params['xp_awarded'] : 5000000;
		$xp     = is_numeric( $xp_raw ) ? (int) $xp_raw : 5000000;

		update_user_meta( $uid, 'hb_discord_id', $discord_id );
		if ( isset( $params['discord_username'] ) && $params['discord_username'] !== '' ) {
			update_user_meta( $uid, 'hb_discord_username', sanitize_text_field( $params['discord_username'] ) );
		}
		if ( isset( $params['discord_display_name'] ) && $params['discord_display_name'] !== '' ) {
			update_user_meta( $uid, 'hb_discord_display_name', sanitize_text_field( $params['discord_display_name'] ) );
		}
		if ( isset( $params['guild_id'] ) && $params['guild_id'] !== '' ) {
			update_user_meta( $uid, 'hb_discord_guild_id', sanitize_text_field( (string) $params['guild_id'] ) );
		}
		if ( isset( $params['joined_at'] ) && $params['joined_at'] !== '' ) {
			update_user_meta( $uid, 'hb_discord_joined_at', sanitize_text_field( (string) $params['joined_at'] ) );
		}
		if ( isset( $params['joined_via_invite'] ) && $params['joined_via_invite'] !== '' ) {
			update_user_meta( $uid, 'hb_discord_joined_via_invite', esc_url_raw( (string) $params['joined_via_invite'] ) );
		}

		$total = (int) get_user_meta( $uid, 'hb_discord_xp_total', true );
		$total += $xp;
		update_user_meta( $uid, 'hb_discord_xp_total', $total );
		update_user_meta( $uid, 'hb_discord_last_xp_award', $xp );
		update_user_meta( $uid, 'hb_discord_verified_at', current_time( 'mysql', true ) );

		if ( $event_id !== '' ) {
			$done = get_user_meta( $uid, 'hb_discord_verification_events', true );
			$list = is_array( $done ) ? $done : array();
			$list[] = $event_id;
			if ( count( $list ) > 200 ) {
				$list = array_slice( $list, -200 );
			}
			update_user_meta( $uid, 'hb_discord_verification_events', $list );
		}

		return new WP_REST_Response(
			array(
				'success'           => true,
				'duplicate'         => false,
				'xp_total'          => $total,
				'xp_awarded'        => $xp,
				'membership_name'   => $parsed['membership_name'],
			),
			200
		);
	}
}
