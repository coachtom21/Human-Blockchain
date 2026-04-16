<?php
/**
 * Template Name: My Account
 *
 * Logged-in account overview: profile, membership (API sync + saved meta), XP ledger rows.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! is_user_logged_in() ) {
	auth_redirect();
	exit;
}

$current_user = wp_get_current_user();
$uid          = (int) $current_user->ID;

$membership_notice = '';
$membership_notice_type = '';

if ( isset( $_GET['hb_refresh_membership'], $_GET['_wpnonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_GET['_wpnonce'] ) ), 'hb_my_account_refresh_membership' ) ) {
	if ( class_exists( 'Cpm_Humanblockchain_Membership' ) ) {
		$result = Cpm_Humanblockchain_Membership::refresh_membership_from_api_for_user( $uid );
		if ( ! empty( $result['ok'] ) ) {
			$membership_notice      = __( 'Membership synced successfully from the API.', 'hello-elementor-child' );
			$membership_notice_type = 'success';
		} elseif ( ! empty( $result['skipped'] ) ) {
			$membership_notice      = isset( $result['message'] ) ? (string) $result['message'] : '';
			$membership_notice_type = 'muted';
		} else {
			$membership_notice      = isset( $result['message'] ) ? (string) $result['message'] : __( 'Membership API returned an error.', 'hello-elementor-child' );
			$membership_notice_type = 'error';
		}
	} else {
		$membership_notice      = __( 'HumanBlockchain membership module is not active.', 'hello-elementor-child' );
		$membership_notice_type = 'error';
	}
}

$membership_meta_raw = get_user_meta( $uid, '_membership_level', true );
$membership_meta   = is_string( $membership_meta_raw ) ? json_decode( $membership_meta_raw, true ) : null;
if ( ! is_array( $membership_meta ) ) {
	$membership_meta = array();
}

$xp_rows    = array();
$xp_summary = array(
	'row_count'   => 0,
	'total_xp'    => '0',
	'total_exact' => false,
);
if ( class_exists( 'Cpm_Humanblockchain_Xp_Ledger' ) ) {
	$xp_rows    = Cpm_Humanblockchain_Xp_Ledger::get_ledger_rows_for_user( $uid, 200 );
	$xp_summary = Cpm_Humanblockchain_Xp_Ledger::get_xp_summary_for_user( $uid );
}

$refresh_url = wp_nonce_url( add_query_arg( 'hb_refresh_membership', '1', get_permalink() ), 'hb_my_account_refresh_membership' );

$xp_to_scientific = static function ( $value, $precision = 4 ) {
	$digits = preg_replace( '/\D/', '', (string) $value );
	if ( ! is_string( $digits ) ) {
		$digits = '0';
	}
	$digits = ltrim( $digits, '0' );
	if ( $digits === '' ) {
		return '0';
	}
	$precision = max( 0, (int) $precision );
	$exp       = strlen( $digits ) - 1;
	$lead      = substr( $digits, 0, 1 );
	$tail      = substr( $digits, 1, $precision );
	if ( $tail !== '' ) {
		$mantissa = $lead . '.' . rtrim( $tail, '0' );
		$mantissa = rtrim( $mantissa, '.' );
	} else {
		$mantissa = $lead;
	}
	return $mantissa . 'e' . $exp;
};
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title><?php echo esc_html( get_the_title() ?: __( 'My Account', 'hello-elementor-child' ) ); ?> | <?php echo esc_html( get_bloginfo( 'name' ) ); ?></title>
	<style>
		:root{
			--bg:#0b1020;
			--card:#101a34;
			--text:#eef2ff;
			--muted:#b8c1e3;
			--line:rgba(255,255,255,.14);
			--accent:#34d399;
			--err:#f87171;
			--radius:18px;
		}
		*{box-sizing:border-box}
		body{
			margin:0;
			min-height:100vh;
			font-family:system-ui,-apple-system,Segoe UI,Roboto,Helvetica,Arial,sans-serif;
			background:
				radial-gradient(1000px 650px at 20% 10%, rgba(120,160,255,.18), transparent 60%),
				radial-gradient(900px 650px at 80% 85%, rgba(52,211,153,.12), transparent 65%),
				var(--bg);
			color:var(--text);
		}
		.wrap{max-width:960px;margin:0 auto;padding:28px 18px 48px}
		h1{font-size:1.75rem;margin:0 0 8px;font-weight:650}
		.sub{color:var(--muted);font-size:.95rem;margin:0 0 28px}
		.grid{display:grid;gap:18px}
		@media(min-width:720px){.grid-2{grid-template-columns:1fr 1fr}}
		.card{
			background:var(--card);
			border:1px solid var(--line);
			border-radius:var(--radius);
			padding:20px 22px;
			box-shadow:0 18px 50px rgba(0,0,0,.35);
		}
		.card h2{margin:0 0 14px;font-size:1.1rem;font-weight:650}
		dl{margin:0;display:grid;gap:10px}
		dt{color:var(--muted);font-size:.8rem;text-transform:uppercase;letter-spacing:.04em;margin:0}
		dd{margin:0;font-size:.95rem;word-break:break-word}
		.badge{display:inline-block;padding:4px 10px;border-radius:999px;font-size:.78rem;border:1px solid var(--line);color:var(--muted)}
		.notice{margin:0 0 16px;padding:12px 14px;border-radius:12px;font-size:.9rem;border:1px solid var(--line)}
		.notice.success{border-color:rgba(52,211,153,.45);background:rgba(52,211,153,.08)}
		.notice.error{border-color:rgba(248,113,113,.5);background:rgba(248,113,113,.1);color:#fecaca}
		.notice.muted{color:var(--muted)}
		.actions{margin-top:14px;display:flex;flex-wrap:wrap;gap:10px;align-items:center}
		a.btn, .btn{
			display:inline-flex;align-items:center;gap:8px;
			padding:10px 16px;border-radius:12px;text-decoration:none;font-size:.9rem;
			background:rgba(52,211,153,.18);color:var(--text);border:1px solid rgba(52,211,153,.45);
			cursor:pointer;font-weight:600;
		}
		a.btn.secondary, .btn.secondary{background:rgba(255,255,255,.06);border-color:var(--line);color:var(--muted)}
		.table-wrap{overflow:auto;margin-top:12px;border-radius:12px;border:1px solid var(--line)}
		table{width:100%;border-collapse:collapse;font-size:.82rem}
		th,td{padding:10px 12px;text-align:left;border-bottom:1px solid var(--line);vertical-align:top}
		th{color:var(--muted);font-weight:600;font-size:.72rem;text-transform:uppercase;letter-spacing:.04em;background:rgba(0,0,0,.2)}
		tr:last-child td{border-bottom:0}
		code.xp{font-size:.72rem;word-break:break-all;color:#c7d2fe}
		.empty{color:var(--muted);font-size:.9rem;margin:8px 0 0}
	</style>
</head>
<body>
	<div class="wrap">
		<h1><?php esc_html_e( 'My account', 'hello-elementor-child' ); ?></h1>
		<p class="sub"><?php echo esc_html( sprintf( /* translators: %s: display name */ __( 'Signed in as %s', 'hello-elementor-child' ), $current_user->display_name ) ); ?></p>

		<?php if ( $membership_notice !== '' ) : ?>
			<p class="notice <?php echo esc_attr( $membership_notice_type ); ?>"><?php echo esc_html( $membership_notice ); ?></p>
		<?php endif; ?>

		<div class="grid grid-2">
			<div class="card">
				<h2><?php esc_html_e( 'Profile', 'hello-elementor-child' ); ?></h2>
				<dl>
					<dt><?php esc_html_e( 'Display name', 'hello-elementor-child' ); ?></dt>
					<dd><?php echo esc_html( $current_user->display_name ); ?></dd>
					<dt><?php esc_html_e( 'Email', 'hello-elementor-child' ); ?></dt>
					<dd><?php echo esc_html( $current_user->user_email ); ?></dd>
					<dt><?php esc_html_e( 'Username', 'hello-elementor-child' ); ?></dt>
					<dd><?php echo esc_html( $current_user->user_login ); ?></dd>
					<dt><?php esc_html_e( 'Member since', 'hello-elementor-child' ); ?></dt>
					<dd><?php echo esc_html( date_i18n( get_option( 'date_format' ), strtotime( $current_user->user_registered ) ) ); ?></dd>
					<dt><?php esc_html_e( 'Roles', 'hello-elementor-child' ); ?></dt>
					<dd><?php echo esc_html( implode( ', ', $current_user->roles ) ); ?></dd>
				</dl>
				<p class="actions">
					<a class="btn secondary" href="<?php echo esc_url( wp_logout_url( home_url( '/' ) ) ); ?>"><?php esc_html_e( 'Log out', 'hello-elementor-child' ); ?></a>
				</p>
			</div>

			<div class="card">
				<h2><?php esc_html_e( 'Membership', 'hello-elementor-child' ); ?></h2>
				<?php if ( empty( $membership_meta ) ) : ?>
					<p class="empty"><?php esc_html_e( 'No membership record is stored for this account yet. Complete membership selection on the site to link your level.', 'hello-elementor-child' ); ?></p>
				<?php else : ?>
					<dl>
						<dt><?php esc_html_e( 'Level name', 'hello-elementor-child' ); ?></dt>
						<dd><?php echo isset( $membership_meta['level_name'] ) ? esc_html( (string) $membership_meta['level_name'] ) : '—'; ?></dd>
						<dt><?php esc_html_e( 'Level ID', 'hello-elementor-child' ); ?></dt>
						<dd><?php echo isset( $membership_meta['level_id'] ) ? esc_html( (string) (int) $membership_meta['level_id'] ) : '—'; ?></dd>
						<dt><?php esc_html_e( 'Remote user ID', 'hello-elementor-child' ); ?></dt>
						<dd><?php echo isset( $membership_meta['user_id'] ) ? esc_html( (string) (int) $membership_meta['user_id'] ) : '—'; ?></dd>
						<dt><?php esc_html_e( 'Last action', 'hello-elementor-child' ); ?></dt>
						<dd><?php echo isset( $membership_meta['action'] ) ? esc_html( (string) $membership_meta['action'] ) : '—'; ?></dd>
						<dt><?php esc_html_e( 'Saved at', 'hello-elementor-child' ); ?></dt>
						<dd><?php echo isset( $membership_meta['saved_at'] ) ? esc_html( (string) $membership_meta['saved_at'] ) : '—'; ?></dd>
						<dt><?php esc_html_e( 'Flags', 'hello-elementor-child' ); ?></dt>
						<dd>
							<?php if ( ! empty( $membership_meta['success'] ) ) : ?><span class="badge"><?php esc_html_e( 'Success', 'hello-elementor-child' ); ?></span><?php endif; ?>
							<?php if ( ! empty( $membership_meta['unchanged'] ) ) : ?><span class="badge"><?php esc_html_e( 'Unchanged', 'hello-elementor-child' ); ?></span><?php endif; ?>
							<?php if ( ! empty( $membership_meta['user_created'] ) ) : ?><span class="badge"><?php esc_html_e( 'User created', 'hello-elementor-child' ); ?></span><?php endif; ?>
							<?php if ( empty( $membership_meta['success'] ) && empty( $membership_meta['unchanged'] ) && empty( $membership_meta['user_created'] ) ) : ?>—<?php endif; ?>
						</dd>
					</dl>
				<?php endif; ?>
				<?php if ( class_exists( 'Cpm_Humanblockchain_Membership' ) ) : ?>
					<p class="actions">
						<a class="btn" href="<?php echo esc_url( $refresh_url ); ?>"><?php esc_html_e( 'Sync membership from API', 'hello-elementor-child' ); ?></a>
					</p>
					<p class="empty" style="margin-top:10px"><?php esc_html_e( 'Uses the same Bearer-authenticated membership endpoint as the site settings (re-sends your saved level with email and phone).', 'hello-elementor-child' ); ?></p>
				<?php endif; ?>
			</div>
		</div>

		<div class="card" style="margin-top:18px">
			<h2><?php esc_html_e( 'XP & ledger', 'hello-elementor-child' ); ?></h2>
			<?php if ( ! class_exists( 'Cpm_Humanblockchain_Xp_Ledger' ) ) : ?>
				<p class="empty"><?php esc_html_e( 'XP ledger plugin is not active.', 'hello-elementor-child' ); ?></p>
			<?php else : ?>
				<dl style="grid-template-columns:repeat(auto-fit,minmax(160px,1fr));display:grid;gap:12px">
					<div>
						<dt><?php esc_html_e( 'Ledger rows', 'hello-elementor-child' ); ?></dt>
						<dd><?php echo esc_html( (string) (int) $xp_summary['row_count'] ); ?></dd>
					</div>
					<div>
						<dt><?php esc_html_e( 'Total XP (scientific)', 'hello-elementor-child' ); ?></dt>
						<dd>
							<?php if ( ! empty( $xp_summary['total_exact'] ) ) : ?>
								<code class="xp"><?php echo esc_html( $xp_to_scientific( (string) $xp_summary['total_xp'] ) ); ?></code>
							<?php else : ?>
								<span class="empty" style="margin:0"><?php esc_html_e( 'Exact total requires the PHP BCMath extension (bcadd). Per-row values are still listed below.', 'hello-elementor-child' ); ?></span>
							<?php endif; ?>
						</dd>
					</div>
				</dl>

				<?php if ( empty( $xp_rows ) ) : ?>
					<p class="empty"><?php esc_html_e( 'No XP ledger transactions for this user yet.', 'hello-elementor-child' ); ?></p>
				<?php else : ?>
					<div class="table-wrap">
						<table>
							<thead>
								<tr>
									<th><?php esc_html_e( 'ID', 'hello-elementor-child' ); ?></th>
									<th><?php esc_html_e( 'Type', 'hello-elementor-child' ); ?></th>
									<th><?php esc_html_e( 'Transaction', 'hello-elementor-child' ); ?></th>
									<th><?php esc_html_e( 'XP (scientific)', 'hello-elementor-child' ); ?></th>
									<th><?php esc_html_e( 'Status', 'hello-elementor-child' ); ?></th>
									<th><?php esc_html_e( 'Remote', 'hello-elementor-child' ); ?></th>
									<th><?php esc_html_e( 'Ledger date', 'hello-elementor-child' ); ?></th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ( $xp_rows as $row ) : ?>
									<tr>
										<td><?php echo isset( $row->id ) ? esc_html( (string) (int) $row->id ) : ''; ?></td>
										<td><?php echo isset( $row->scan_type ) ? esc_html( (string) $row->scan_type ) : ''; ?></td>
										<td><code class="xp"><?php echo isset( $row->transaction_id ) ? esc_html( (string) $row->transaction_id ) : ''; ?></code></td>
										<td><code class="xp"><?php echo isset( $row->xp_units ) ? esc_html( $xp_to_scientific( (string) $row->xp_units ) ) : ''; ?></code></td>
										<td><?php echo isset( $row->scan_status ) ? esc_html( (string) $row->scan_status ) : ''; ?></td>
										<td><?php echo isset( $row->remote_sync_status ) ? esc_html( (string) $row->remote_sync_status ) : ''; ?></td>
										<td><?php echo isset( $row->ledger_date ) ? esc_html( (string) $row->ledger_date ) : ''; ?></td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				<?php endif; ?>
			<?php endif; ?>
		</div>

		<p class="actions" style="margin-top:22px">
			<a class="btn secondary" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'hello-elementor-child' ); ?></a>
		</p>
	</div>
</body>
</html>
