<?php
/**
 * Canonical YAM JAM verification states (dual-ledger).
 *
 * Use these slugs when persisting or API responses so UI copy and data stay aligned.
 *
 * @package HelloElementorChild
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Verification model: seller fulfillment vs community true-event verification.
 */
final class HB_Yamjam_Verification_Model {

	/* Community ledger (proof / YAM JAM accounting). */

	/** No complete proof record yet. */
	public const COMMUNITY_PENDING = 'pending';

	/**
	 * Proof of Delivery + final destination both satisfied.
	 * Not yet a verified true event: Y/Y/Y, dual QR, time window, and distance must still pass.
	 */
	public const COMMUNITY_PROOF_RECORDED = 'proof_recorded';

	/**
	 * Authoritative “VERIFIED” for community modeled value & cooperative benefit lines.
	 * All Y/Y/Y plus YAM-is-On + NWP QR valid, execution window, and distance rules satisfied.
	 */
	public const COMMUNITY_VERIFIED_TRUE_EVENT = 'verified_true_event';

	/**
	 * Delivery/fulfillment side shows complete, but true-event gates failed or timed out.
	 * Community lines do not advance to verified; subject to review/appeal.
	 */
	public const COMMUNITY_TRUE_EVENT_FAILED = 'true_event_failed';

	/** Facilitator or governance marked invalid (fraud, bad data, etc.). */
	public const COMMUNITY_REJECTED = 'rejected';

	/* Seller ledger (operational fulfillment). */

	public const SELLER_FULFILLMENT_PENDING = 'pending';

	public const SELLER_FULFILLMENT_DELIVERED = 'delivered';

	public const SELLER_FULFILLMENT_FAILED = 'failed';
}
