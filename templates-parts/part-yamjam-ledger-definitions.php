<?php
/**
 * YAM JAM dual-ledger definitions table — shared across NWP landing & account pages.
 *
 * @package HelloElementorChild
 *
 * @param array<string, mixed> $args {
 *     Optional. Loaded from get_template_part( ..., array( … ) ).
 *
 *     @type bool   $embed      Strip section chrome for use inside cards / WC content.
 *     @type string $section_id HTML id for the section anchor.
 * }
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$hb_ld_defaults = array(
	'embed'      => false,
	'section_id' => 'ledger-definitions',
);

$hb_ld = isset( $args ) && is_array( $args ) ? $args : array();
$hb_ld = wp_parse_args( $hb_ld, $hb_ld_defaults );

$hb_ld_sid         = is_string( $hb_ld['section_id'] ) ? trim( $hb_ld['section_id'] ) : '';
$hb_ld_sid         = $hb_ld_sid !== '' ? $hb_ld_sid : 'ledger-definitions';
$hb_ld_embed_class = ! empty( $hb_ld['embed'] ) ? ' ledger-definitions--embed' : '';
?>
<section class="ledger-definitions<?php echo esc_attr( $hb_ld_embed_class ); ?>" id="<?php echo esc_attr( $hb_ld_sid ); ?>" aria-labelledby="ledger-definitions-title-<?php echo esc_attr( $hb_ld_sid ); ?>">
	<div class="ledger-definitions-inner">
		<header class="ledger-definitions-head">
			<span class="ledger-definitions-kicker"><?php echo esc_html__( 'Definitions', 'hello-elementor-child' ); ?></span>
			<h2 id="<?php echo esc_attr( 'ledger-definitions-title-' . $hb_ld_sid ); ?>"><?php echo esc_html__( 'YAM JAM pledge, trade value & ledger lines', 'hello-elementor-child' ); ?></h2>
			<p>
				<?php echo esc_html__( 'These terms describe how a single customer pledge (for example $30) maps to fulfillment economics on one side and verified community accounting on the other. Figures shown are illustrative for the standard $30 pledge model.', 'hello-elementor-child' ); ?>
			</p>
		</header>

		<div class="ledger-definitions-table-wrap">
			<table class="ledger-definitions-table">
				<caption>
					<?php echo esc_html__( 'Each row states whether that line implies cash movement. Ledger and cooperative lines are proof-of-participation accounting unless you are separately executing a lawful payment.', 'hello-elementor-child' ); ?>
				</caption>
				<thead>
					<tr>
						<th scope="col"><?php echo esc_html__( 'Term', 'hello-elementor-child' ); ?></th>
						<th scope="col"><?php echo esc_html__( 'What it means', 'hello-elementor-child' ); ?></th>
						<th scope="col"><?php echo esc_html__( 'Cash movement', 'hello-elementor-child' ); ?></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<th scope="row">
							<?php echo esc_html__( 'Pledge amount', 'hello-elementor-child' ); ?>
							<span class="ledger-definitions-term-note"><?php echo esc_html__( 'Not necessarily limited to ledger-only accounting—this is the commercial order price for the qualifying offer.', 'hello-elementor-child' ); ?></span>
						</th>
						<td>
							<?php echo esc_html__( 'The headline price paid (or pledged) by the buyer for the bundle—real product fulfillment plus participation in the verification flow. Example: $30.', 'hello-elementor-child' ); ?>
						</td>
						<td class="ledger-definitions-cash">
							<?php echo esc_html__( 'Usually yes: this is normal commerce payment. Still not a separate “investment” or guaranteed return.', 'hello-elementor-child' ); ?>
						</td>
					</tr>
					<tr>
						<th scope="row">
							<?php echo esc_html__( 'Modeled trade value', 'hello-elementor-child' ); ?>
							<span class="ledger-definitions-term-note"><?php echo esc_html__( 'Not necessarily cash movement—naming unit for a verified event in the model.', 'hello-elementor-child' ); ?></span>
						</th>
						<td>
							<?php echo esc_html__( 'The nominal trade-value unit assigned when verification rules pass (often stated as $30 in the covenant copy). It describes the modeled envelope for the event, not a second automatic payout.', 'hello-elementor-child' ); ?>
						</td>
						<td class="ledger-definitions-cash">
							<?php echo esc_html__( 'No—by default this is modeled accounting tied to proof, not an extra cash transfer.', 'hello-elementor-child' ); ?>
						</td>
					</tr>
					<tr>
						<th scope="row">
							<?php echo esc_html__( 'Seller margin (actual $)', 'hello-elementor-child' ); ?>
							<span class="ledger-definitions-term-note"><?php echo esc_html__( 'Not necessarily cash movement from the ledger—this is fulfillment economics drawn from the pledge.', 'hello-elementor-child' ); ?></span>
						</th>
						<td>
							<?php echo esc_html__( 'Operational slice for production, COGS, packaging, shipping, and labor (example: $19.70). Earned through delivery; kept distinct from community value lines.', 'hello-elementor-child' ); ?>
						</td>
						<td class="ledger-definitions-cash">
							<?php echo esc_html__( 'Real business economics from the sale, not a second “ledger payment” to the seller.', 'hello-elementor-child' ); ?>
						</td>
					</tr>
					<tr>
						<th scope="row">
							<?php echo esc_html__( 'Community modeled value ($)', 'hello-elementor-child' ); ?>
							<span class="ledger-definitions-term-note"><?php echo esc_html__( 'Not necessarily cash movement—verification-side allocation only.', 'hello-elementor-child' ); ?></span>
						</th>
						<td>
							<?php echo esc_html__( 'Recorded after Proof of Delivery and final destination (and Y/Y/Y rules when applied). Example: $10.30 split across buyer signal, community pool, patronage, and POD system cost in the model.', 'hello-elementor-child' ); ?>
						</td>
						<td class="ledger-definitions-cash">
							<?php echo esc_html__( 'No—modeled splits for cooperative accounting unless a separate lawful settlement process pays out.', 'hello-elementor-child' ); ?>
						</td>
					</tr>
					<tr>
						<th scope="row">
							<?php echo esc_html__( 'Cooperative benefit ($)', 'hello-elementor-child' ); ?>
							<span class="ledger-definitions-term-note"><?php echo esc_html__( 'Not necessarily cash movement—secured in the ledger as a recognition line.', 'hello-elementor-child' ); ?></span>
						</th>
						<td>
							<?php echo esc_html__( 'A fixed recognition amount in the dual-ledger story (example: $0.40), senior in policy to downstream settlement narratives. Stored as proof and cooperative benefit record.', 'hello-elementor-child' ); ?>
						</td>
						<td class="ledger-definitions-cash">
							<?php echo esc_html__( 'No—unless governance and lawful processes separately deliver funds.', 'hello-elementor-child' ); ?>
						</td>
					</tr>
				</tbody>
			</table>
		</div>

		<div class="ledger-definitions-verify" id="<?php echo esc_attr( 'ledger-verification-authority-' . $hb_ld_sid ); ?>">
			<h3 class="ledger-definitions-verify-title"><?php echo esc_html__( 'Which rule is authoritative for “VERIFIED”?', 'hello-elementor-child' ); ?></h3>
			<p class="ledger-definitions-verify-lead">
				<?php echo esc_html__( 'Seller fulfillment and community verification are separate. The stricter Y/Y/Y + scan rules decide when the community ledger may post verified value—not shipping status alone.', 'hello-elementor-child' ); ?>
			</p>

			<h4 class="ledger-definitions-verify-subtitle"><?php echo esc_html__( 'Y/Y/Y rule — three prompts (all must be YES)', 'hello-elementor-child' ); ?></h4>
			<p class="ledger-definitions-verify-note">
				<?php echo esc_html__( 'Verified (true event) requires every prompt below to return YES, in addition to valid YAM-is-On + NWP universal QR scans, timestamp/geo/device records, and the allowed time-and-distance window.', 'hello-elementor-child' ); ?>
			</p>
			<ol class="ledger-yyy-prompts" aria-label="<?php echo esc_attr__( 'Y Y Y verification prompts', 'hello-elementor-child' ); ?>">
				<li>
					<strong><?php echo esc_html__( 'Y1 — Proof of Delivery', 'hello-elementor-child' ); ?></strong>
					— <?php echo esc_html__( 'Prompt equivalent: “Is this Proof of Delivery?” Buyer and seller attest the delivery proof step for this encounter.', 'hello-elementor-child' ); ?>
				</li>
				<li>
					<strong><?php echo esc_html__( 'Y2 — Final destination', 'hello-elementor-child' ); ?></strong>
					— <?php echo esc_html__( 'Prompt equivalent: “Is this the final destination?” Confirms handoff/arrival meets your final-destination rule for this event.', 'hello-elementor-child' ); ?>
				</li>
				<li>
					<strong><?php echo esc_html__( 'Y3 — NWP acceptance (issuer type)', 'hello-elementor-child' ); ?></strong>
					— <?php echo esc_html__( 'Prompt equivalent: “Do you accept this New World Penny (NWP) issued by:” a specific individual, a Patron Organizing Community / 5-seller group (POC), or a guild? The participant chooses the matching issuer path and must answer YES for the encounter to count as a true event.', 'hello-elementor-child' ); ?>
				</li>
			</ol>

			<ol class="ledger-verify-flow" aria-label="<?php echo esc_attr__( 'Community verification sequence', 'hello-elementor-child' ); ?>">
				<li>
					<strong><?php echo esc_html__( 'Pending', 'hello-elementor-child' ); ?></strong>
					— <?php echo esc_html__( 'Community ledger: no complete proof record yet. Seller ledger may still be pending or in progress.', 'hello-elementor-child' ); ?>
				</li>
				<li>
					<strong><?php echo esc_html__( 'Proof recorded (POD + final destination)', 'hello-elementor-child' ); ?></strong>
					— <?php echo esc_html__( 'Both Proof of Delivery and final destination are satisfied. This is still not Verified (true event): modeled community lines and cooperative benefit stay locked until Y/Y/Y and scan gates pass.', 'hello-elementor-child' ); ?>
				</li>
				<li>
					<strong><?php echo esc_html__( 'Verified (community ledger—true event)', 'hello-elementor-child' ); ?></strong>
					— <?php echo esc_html__( 'Only if Y1, Y2, and Y3 are all YES (see list above), both universal QR codes validate, scans fall within the allowed time window and distance, and policy checks pass. Then community modeled value and cooperative benefit may be recorded as under your model.', 'hello-elementor-child' ); ?>
				</li>
			</ol>

			<div class="ledger-definitions-table-wrap ledger-definitions-table-wrap--verify">
				<table class="ledger-definitions-table ledger-definitions-table--verify">
					<caption class="ledger-verify-caption">
						<?php echo esc_html__( 'Authoritative mapping: one event, two ledgers. “VERIFIED” below refers to the community ledger true-event row only.', 'hello-elementor-child' ); ?>
					</caption>
					<thead>
						<tr>
							<th scope="col"><?php echo esc_html__( 'Layer', 'hello-elementor-child' ); ?></th>
							<th scope="col"><?php echo esc_html__( 'What advances it', 'hello-elementor-child' ); ?></th>
							<th scope="col"><?php echo esc_html__( 'VERIFIED?', 'hello-elementor-child' ); ?></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<th scope="row"><?php echo esc_html__( 'Seller ledger', 'hello-elementor-child' ); ?></th>
							<td><?php echo esc_html__( 'Physical fulfillment / delivery and normal order economics (margin, COGS path). Independent of QR Y/Y/Y.', 'hello-elementor-child' ); ?></td>
							<td class="ledger-definitions-cash"><?php echo esc_html__( 'Use fulfillment states (delivered vs failed)—not the same flag as community “VERIFIED.”', 'hello-elementor-child' ); ?></td>
						</tr>
						<tr>
							<th scope="row"><?php echo esc_html__( 'Community ledger', 'hello-elementor-child' ); ?></th>
							<td><?php echo esc_html__( 'Starts at Pending → moves to Proof recorded when POD + final destination pass → becomes Verified (true event) only when Y/Y/Y plus dual QR + time + distance gates pass.', 'hello-elementor-child' ); ?></td>
							<td class="ledger-definitions-cash"><strong><?php echo esc_html__( 'Only after full Y/Y/Y + constraints.', 'hello-elementor-child' ); ?></strong></td>
						</tr>
					</tbody>
				</table>
			</div>

			<h3 class="ledger-definitions-verify-title ledger-definitions-verify-title--secondary"><?php echo esc_html__( 'Seller shows delivered—but Y/Y/Y or scan gates failed', 'hello-elementor-child' ); ?></h3>
			<p class="ledger-definitions-verify-lead">
				<?php echo esc_html__( 'This is expected to be visible as split status: operations can be complete while the cooperative proof path is incomplete or failed.', 'hello-elementor-child' ); ?>
			</p>
			<ul class="ledger-verify-partial">
				<li><?php echo esc_html__( 'Seller ledger: remains delivered (or your operational equivalent). We do not auto-reverse real-world fulfillment solely because cooperative verification failed.', 'hello-elementor-child' ); ?></li>
				<li><?php echo esc_html__( 'Community ledger: stays at Proof recorded until the true-event checks pass, or moves to a failed / needs-review outcome if the session expires, distance or time limits fail, QR validation fails, or any Y/N breaks the Y/Y/Y rule.', 'hello-elementor-child' ); ?></li>
				<li><?php echo esc_html__( 'Modeled community value and cooperative benefit: not posted as verified until the community ledger reaches Verified (true event). No double counting with seller margin.', 'hello-elementor-child' ); ?></li>
				<li><?php echo esc_html__( 'Appeals & corrections: participants may request a manual review (evidence export, facilitator or governance review, device/clock/GPS edge cases). Outcomes may correct ledger classification; they do not imply a promise of any payment.', 'hello-elementor-child' ); ?></li>
			</ul>
		</div>

		<p class="ledger-definitions-disclosure">
			<?php echo esc_html__( 'This ledger is a proof-of-participation and cooperative accounting system, not a security, investment contract, bank account, or promise of financial return. Final implementation requires legal, tax, and cooperative governance review.', 'hello-elementor-child' ); ?>
		</p>
	</div>
</section>
