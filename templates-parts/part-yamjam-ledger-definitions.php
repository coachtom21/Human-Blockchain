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

		<p class="ledger-definitions-disclosure">
			<?php echo esc_html__( 'This ledger is a proof-of-participation and cooperative accounting system, not a security, investment contract, bank account, or promise of financial return. Final implementation requires legal, tax, and cooperative governance review.', 'hello-elementor-child' ); ?>
		</p>
	</div>
</section>
