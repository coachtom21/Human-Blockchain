<?php
/**
 * REST API for the verify-me Discord bot: membership lookup + verification XP (HumanBlockchain).
 *
 * Routes (Bearer: HB_DISCORD_BOT_API_KEY constant or option hb_discord_bot_api_key):
 * - GET  /wp-json/hb/v1/discord-bot/membership?email=
 * - GET  /wp-json/hb/v1/discord-bot/wallet?discord_id= | ?discord_username=
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
		$auth_header = self::get_authorization_header_value( $request );
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
	 * Raw Authorization header: REST first, then PHP superglobals (some Apache/FastCGI stacks omit it from REST).
	 *
	 * @param WP_REST_Request $request Request.
	 * @return string
	 */
	private static function get_authorization_header_value( WP_REST_Request $request ) {
		$h = $request->get_header( 'Authorization' );
		if ( is_string( $h ) && $h !== '' ) {
			return $h;
		}
		if ( ! empty( $_SERVER['HTTP_AUTHORIZATION'] ) && is_string( $_SERVER['HTTP_AUTHORIZATION'] ) ) {
			return $_SERVER['HTTP_AUTHORIZATION'];
		}
		if ( ! empty( $_SERVER['REDIRECT_HTTP_AUTHORIZATION'] ) && is_string( $_SERVER['REDIRECT_HTTP_AUTHORIZATION'] ) ) {
			return $_SERVER['REDIRECT_HTTP_AUTHORIZATION'];
		}
		return '';
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

		register_rest_route(
			'hb/v1',
			'/discord-bot/wallet',
			array(
				'methods'             => WP_REST_Server::READABLE,
				'callback'            => array( __CLASS__, 'handle_wallet' ),
				'permission_callback' => array( __CLASS__, 'permission_bearer' ),
				'args'                => array(
					'discord_id'         => array(
						'required'          => false,
						'type'              => 'string',
						'sanitize_callback' => 'sanitize_text_field',
					),
					'discord_username'   => array(
						'required'          => false,
						'type'              => 'string',
						'sanitize_callback' => 'sanitize_text_field',
					),
				),
			)
		);
	}

	/**
	 * Resolve WordPress user ID from Discord id or username (hb_discord_* meta / login).
	 *
	 * @param string $discord_id         Discord snowflake or empty.
	 * @param string $discord_username   Discord handle or empty.
	 * @return int User ID or 0.
	 */
	private static function find_user_id_for_discord_wallet( $discord_id, $discord_username ) {
		global $wpdb;

		$discord_id = trim( (string) $discord_id );
		if ( $discord_id !== '' && ctype_digit( $discord_id ) ) {
			$uid = (int) $wpdb->get_var(
				$wpdb->prepare(
					"SELECT user_id FROM {$wpdb->usermeta} WHERE meta_key = 'hb_discord_id' AND meta_value = %s LIMIT 1",
					$discord_id
				)
			);
			if ( $uid > 0 ) {
				return $uid;
			}
		}

		$discord_username = trim( (string) $discord_username );
		if ( $discord_username !== '' ) {
			$uid = (int) $wpdb->get_var(
				$wpdb->prepare(
					"SELECT u.ID FROM {$wpdb->users} u
					INNER JOIN {$wpdb->usermeta} m ON m.user_id = u.ID AND m.meta_key = 'hb_discord_username' AND LOWER(m.meta_value) = LOWER(%s)
					LIMIT 1",
					$discord_username
				)
			);
			if ( $uid > 0 ) {
				return $uid;
			}

			$maybe = get_user_by( 'login', $discord_username );
			if ( $maybe instanceof WP_User ) {
				return (int) $maybe->ID;
			}
		}

		return 0;
	}

	/**
	 * GET wallet / XP ledger summary for Discord !profile / !transaction (HumanBlockchain).
	 *
	 * @param WP_REST_Request $request Request.
	 * @return WP_REST_Response|WP_Error
	 */
	public static function handle_wallet( WP_REST_Request $request ) {
		$discord_id       = (string) $request->get_param( 'discord_id' );
		$discord_username = (string) $request->get_param( 'discord_username' );
		$discord_id       = trim( $discord_id );
		$discord_username = trim( $discord_username );

		if ( $discord_id === '' && $discord_username === '' ) {
			return new WP_Error(
				'missing_param',
				__( 'Provide discord_id and/or discord_username.', 'hello-elementor-child' ),
				array( 'status' => 400 )
			);
		}

		$uid = self::find_user_id_for_discord_wallet( $discord_id, $discord_username );
		if ( $uid <= 0 ) {
			return new WP_REST_Response( array( 'found' => false ), 200 );
		}

		$user = get_userdata( $uid );
		if ( ! $user instanceof WP_User ) {
			return new WP_REST_Response( array( 'found' => false ), 200 );
		}

		$email = sanitize_email( $user->user_email );
		$mem   = self::resolve_membership_by_email( $email );
		$membership_name = ! empty( $mem['member'] ) && ! empty( $mem['membership_name'] )
			? (string) $mem['membership_name']
			: 'unverified';

		$discord_block = array(
			'discord_id'           => (string) get_user_meta( $uid, 'hb_discord_id', true ),
			'discord_username'     => (string) get_user_meta( $uid, 'hb_discord_username', true ),
			'discord_display_name' => (string) get_user_meta( $uid, 'hb_discord_display_name', true ),
			'joined_at'            => (string) get_user_meta( $uid, 'hb_discord_joined_at', true ),
			'verified_at'          => (string) get_user_meta( $uid, 'hb_discord_verified_at', true ),
		);

		$ledger_rows = array();
		$total_xp    = '0';
		if ( class_exists( 'Cpm_Humanblockchain_Xp_Ledger' ) ) {
			$rows = Cpm_Humanblockchain_Xp_Ledger::get_ledger_rows_for_user( $uid, 200 );
			if ( is_array( $rows ) ) {
				foreach ( $rows as $row ) {
					if ( ! is_object( $row ) ) {
						continue;
					}
					$ledger_rows[] = array(
						'scan_type'        => isset( $row->scan_type ) ? (string) $row->scan_type : '',
						'transaction_id'   => isset( $row->transaction_id ) ? (string) $row->transaction_id : '',
						'xp_units'         => isset( $row->xp_units ) ? (string) $row->xp_units : '0',
						'scan_status'      => isset( $row->scan_status ) ? (string) $row->scan_status : '',
						'ledger_date'      => isset( $row->ledger_date ) ? (string) $row->ledger_date : '',
						'order_id'         => isset( $row->order_id ) && $row->order_id !== null && $row->order_id !== '' ? (int) $row->order_id : null,
					);
					$u = preg_replace( '/\D/', '', isset( $row->xp_units ) ? (string) $row->xp_units : '0' );
					if ( $u === '' ) {
						continue;
					}
					if ( function_exists( 'bcadd' ) ) {
						$total_xp = bcadd( $total_xp, $u, 0 );
					} else {
						$total_xp = (string) ( (int) $total_xp + (int) $u );
					}
				}
			}
		}

		return new WP_REST_Response(
			array(
				'found'             => true,
				'user_id'           => $uid,
				'user_email'        => $email,
				'user_login'        => $user->user_login,
				'display_name'      => $user->display_name,
				'membership_name'   => $membership_name,
				'discord'           => $discord_block,
				'ledger_rows'       => $ledger_rows,
				'total_xp'          => $total_xp,
			),
			200
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
	 * Map a PMPro level object to Discord role slug (pioneer | patron).
	 *
	 * Uses cpm-humanblockchain tier ↔ level ID when available so renames like
	 * "Free" still resolve; then name heuristics; then PMPro "free level" → pioneer bucket.
	 *
	 * @param object $level Row from pmpro_getMembershipLevelsForUser() or similar.
	 * @return string|null pioneer, patron, or null.
	 */
	private static function discord_slug_from_pmpro_level_object( $level ) {
		if ( empty( $level ) || ! is_object( $level ) || empty( $level->id ) ) {
			return null;
		}
		$lid = (int) $level->id;
		if ( class_exists( 'Cpm_Humanblockchain_Membership' ) && is_callable( array( 'Cpm_Humanblockchain_Membership', 'tier_slug_for_pmpro_level_id' ) ) ) {
			$tier = Cpm_Humanblockchain_Membership::tier_slug_for_pmpro_level_id( $lid );
			if ( 'patron' === $tier ) {
				return 'patron';
			}
			if ( 'megavoter' === $tier || 'yamer' === $tier ) {
				return 'pioneer';
			}
		}
		$from_name = self::normalize_membership_slug( isset( $level->name ) ? (string) $level->name : '' );
		if ( null !== $from_name ) {
			return $from_name;
		}
		if ( function_exists( 'pmpro_getLevel' ) && function_exists( 'pmpro_isLevelFree' ) ) {
			$def = pmpro_getLevel( $lid );
			if ( $def && pmpro_isLevelFree( $def ) ) {
				return 'pioneer';
			}
		}
		return null;
	}

	/**
	 * Map Get started tier slug (cpm-humanblockchain) to Discord bot membership_name.
	 *
	 * @param string $tier yamer|megavoter|patron.
	 * @return string|null pioneer|patron.
	 */
	public static function hb_get_started_tier_to_bot_slug( $tier ) {
		$tier = sanitize_key( (string) $tier );
		if ( $tier === 'patron' ) {
			return 'patron';
		}
		if ( $tier === 'megavoter' || $tier === 'yamer' ) {
			return 'pioneer';
		}
		return null;
	}

	/**
	 * Read HumanBlockchain local _membership_level (JSON from modal/checkout).
	 *
	 * @param int $user_id User ID.
	 * @return array{member:bool, membership_name:?string}
	 */
	private static function resolve_membership_from_user_meta( $user_id ) {
		$user_id = (int) $user_id;
		$raw     = get_user_meta( $user_id, '_membership_level', true );
		$dec     = null;
		if ( is_string( $raw ) && $raw !== '' ) {
			$tmp = json_decode( $raw, true );
			if ( is_array( $tmp ) ) {
				$dec = $tmp;
			}
		} elseif ( is_array( $raw ) ) {
			$dec = $raw;
		}
		if ( ! is_array( $dec ) ) {
			return array(
				'member'          => false,
				'membership_name' => null,
			);
		}
		if ( ! empty( $dec['tier'] ) ) {
			$slug = self::hb_get_started_tier_to_bot_slug( (string) $dec['tier'] );
			if ( $slug !== null ) {
				return array(
					'member'          => true,
					'membership_name' => $slug,
				);
			}
		}
		if ( ! empty( $dec['level_name'] ) ) {
			$slug = self::normalize_membership_slug( (string) $dec['level_name'] );
			if ( $slug !== null ) {
				return array(
					'member'          => true,
					'membership_name' => $slug,
				);
			}
		}
		if ( ! empty( $dec['name'] ) ) {
			$slug = self::normalize_membership_slug( (string) $dec['name'] );
			if ( $slug !== null ) {
				return array(
					'member'          => true,
					'membership_name' => $slug,
				);
			}
		}
		return array(
			'member'          => false,
			'membership_name' => null,
		);
	}

	/**
	 * WooCommerce Get started orders store tier in _cpm_hb_membership_tier; PMPro user level may not be set yet.
	 *
	 * @param string $email User email.
	 * @param int    $user_id User ID.
	 * @return array{member:bool, membership_name:?string, user_id:int}
	 */
	private static function resolve_membership_from_wc_orders( $email, $user_id ) {
		$user_id = (int) $user_id;
		$email   = sanitize_email( $email );
		if ( ! function_exists( 'wc_get_orders' ) ) {
			return array(
				'member'          => false,
				'membership_name' => null,
				'user_id'         => $user_id,
			);
		}

		$statuses = apply_filters(
			'hb_discord_bot_membership_wc_order_statuses',
			array( 'processing', 'completed', 'on-hold', 'pending' )
		);
		if ( ! is_array( $statuses ) || empty( $statuses ) ) {
			$statuses = array( 'processing', 'completed', 'on-hold' );
		}

		$query_sets = array();
		if ( $user_id > 0 ) {
			$query_sets[] = array(
				'limit'       => 10,
				'customer_id' => $user_id,
				'orderby'     => 'date',
				'order'       => 'DESC',
				'status'      => $statuses,
				'meta_key'    => '_cpm_hb_membership_tier',
			);
		}
		if ( is_email( $email ) ) {
			$query_sets[] = array(
				'limit'         => 10,
				'billing_email' => $email,
				'orderby'       => 'date',
				'order'         => 'DESC',
				'status'        => $statuses,
				'meta_key'      => '_cpm_hb_membership_tier',
			);
		}

		foreach ( $query_sets as $args ) {
			$orders = wc_get_orders( $args );
			if ( ! is_array( $orders ) ) {
				continue;
			}
			foreach ( $orders as $order ) {
				if ( ! is_object( $order ) || ! method_exists( $order, 'get_meta' ) ) {
					continue;
				}
				$tier = $order->get_meta( '_cpm_hb_membership_tier', true );
				$tier = is_string( $tier ) ? sanitize_key( $tier ) : '';
				if ( $tier === '' ) {
					continue;
				}
				$slug = self::hb_get_started_tier_to_bot_slug( $tier );
				if ( $slug !== null ) {
					return array(
						'member'          => true,
						'membership_name' => $slug,
						'user_id'         => $user_id,
					);
				}
			}
		}

		return array(
			'member'          => false,
			'membership_name' => null,
			'user_id'         => $user_id,
		);
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

		if ( function_exists( 'pmpro_getMembershipLevelsForUser' ) ) {
			$levels = pmpro_getMembershipLevelsForUser( $uid );
			if ( ! empty( $levels ) && is_array( $levels ) ) {
				$level = reset( $levels );
				if ( $level && ! empty( $level->id ) ) {
					$slug = self::discord_slug_from_pmpro_level_object( $level );
					if ( $slug !== null ) {
						return array(
							'member'            => true,
							'membership_name'   => $slug,
							'user_id'           => $uid,
						);
					}
				}
			}
		} elseif ( function_exists( 'pmpro_getMembershipLevelForUser' ) ) {
			$level = pmpro_getMembershipLevelForUser( $uid );
			if ( $level && ! empty( $level->id ) ) {
				$slug = self::discord_slug_from_pmpro_level_object( $level );
				if ( $slug !== null ) {
					return array(
						'member'            => true,
						'membership_name'   => $slug,
						'user_id'           => $uid,
					);
				}
			}
		}

		$from_meta = self::resolve_membership_from_user_meta( $uid );
		if ( ! empty( $from_meta['member'] ) && ! empty( $from_meta['membership_name'] ) ) {
			return array(
				'member'            => true,
				'membership_name'   => $from_meta['membership_name'],
				'user_id'           => $uid,
			);
		}

		$from_wc = self::resolve_membership_from_wc_orders( $email, $uid );
		if ( ! empty( $from_wc['member'] ) && ! empty( $from_wc['membership_name'] ) ) {
			return $from_wc;
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

		$ledger_ok = false;
		if ( class_exists( 'Cpm_Humanblockchain_Xp_Ledger' ) ) {
			$ledger_ok = Cpm_Humanblockchain_Xp_Ledger::record_discord_verification_xp(
				$uid,
				$xp,
				$event_id !== '' ? $event_id : (string) time(),
				array(
					'discord_id'        => $discord_id,
					'guild_id'          => isset( $params['guild_id'] ) ? (string) $params['guild_id'] : '',
					'discord_username'  => isset( $params['discord_username'] ) ? (string) $params['discord_username'] : '',
				)
			);
		}

		return new WP_REST_Response(
			array(
				'success'           => true,
				'duplicate'         => false,
				'xp_total'          => $total,
				'xp_awarded'        => $xp,
				'membership_name'   => $parsed['membership_name'],
				'xp_ledger_recorded' => $ledger_ok,
			),
			200
		);
	}
}
