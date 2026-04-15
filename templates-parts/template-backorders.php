<?php
/**
 * Template Name: Backorders
 *
 * WooCommerce pre-orders / backorders landing page (VFN fulfillment flow).
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>
		<?php
		echo esc_html( get_the_title() ?: __( 'Backorders', 'hello-elementor-child' ) );
		echo ' | ';
		echo esc_html( get_bloginfo( 'name' ) );
		?>
	</title>
<?php
$shop_url = home_url( '/shop' );
if ( function_exists( 'wc_get_page_permalink' ) ) {
	$wc_shop = wc_get_page_permalink( 'shop' );
	if ( $wc_shop ) {
		$shop_url = $wc_shop;
	}
}
?>
	<style>
		:root{
			--bg:#0b1020;
			--text:#eef2ff;
			--muted:#b8c1e3;
			--line:rgba(255,255,255,.14);
			--shadow:0 18px 50px rgba(0,0,0,.55);
			--radius:18px;
			--accent:#34d399;
			--warn:#fbbf24;
		}
		*{box-sizing:border-box}
		body{
			margin:0;
			min-height:100vh;
			font-family: system-ui,-apple-system,Segoe UI,Roboto,Helvetica,Arial;
			background:
				radial-gradient(1000px 650px at 20% 10%, rgba(120,160,255,.18), transparent 60%),
				radial-gradient(900px 650px at 80% 85%, rgba(52,211,153,.12), transparent 65%),
				var(--bg);
			color:var(--text);
		}
		.nav{
			position:sticky; top:0; z-index:10;
			backdrop-filter: blur(10px);
			background: rgba(11,16,32,.68);
			border-bottom:1px solid var(--line);
		}
		.nav-inner{
			max-width:1100px;
			margin:0 auto;
			padding:14px 18px;
			display:flex;
			justify-content:space-between;
			align-items:center;
			gap:14px;
			flex-wrap:wrap;
			position: relative;
		}
		.brand{
			display:flex; gap:10px; align-items:center;
			text-decoration:none; color:var(--text);
			min-width:200px;
		}
		.logo{
			width:28px;height:28px;border-radius:10px;
			background:
				radial-gradient(circle at 30% 30%, rgba(52,211,153,.9), transparent 60%),
				radial-gradient(circle at 70% 70%, rgba(120,160,255,.9), transparent 60%),
				rgba(255,255,255,.06);
			border:1px solid var(--line);
			flex:0 0 auto;
			display: flex;
			align-items: center;
			justify-content: center;
			overflow: hidden;
		}
		.logo img{
			height: 100%;
			object-fit: contain;
			border-radius: 10px;
		}
		.brand h1{margin:0;font-size:14px;letter-spacing:.4px}
		.brand small{display:block;font-size:12px;color:var(--muted)}
		.nav-links{display:flex;gap:10px;flex-wrap:wrap}
		.nav-links a{
			text-decoration:none;
			color:var(--muted);
			font-weight:850;
			font-size:12px;
			padding:10px 12px;
			border-radius:999px;
			border:1px solid rgba(255,255,255,.10);
			background: rgba(255,255,255,.04);
			transition: all .12s ease;
		}
		.nav-links a:hover{
			background: rgba(255,255,255,.08);
			color: var(--text);
		}
		.hamburger-menu{ display:none; }
		.hamburger-toggle{ display:none; }
		.hamburger-btn{
			display: inline-flex;
			align-items: center;
			justify-content: center;
			width: 44px;
			height: 44px;
			border-radius: 12px;
			border: 1px solid rgba(255,255,255,.16);
			background: rgba(255,255,255,.06);
			cursor: pointer;
			transition: background .12s ease;
			flex-shrink: 0;
		}
		.hamburger-btn:hover{ background: rgba(255,255,255,.10); }
		.hamburger-btn svg{ width: 22px; height: 22px; stroke: currentColor; }
		.sidebar-overlay{
			display:none;
			position: fixed;
			top: 0; left: 0; right: 0; bottom: 0;
			background: rgba(0, 0, 0, 0.5);
			backdrop-filter: blur(4px);
			z-index: 9998;
			opacity: 0;
			transition: opacity 0.3s ease;
			cursor: pointer;
		}
		.sidebar-overlay.active{ display: block; opacity: 1; }
		.sidebar-menu{
			position: fixed;
			top: 0;
			right: -100%;
			width: 320px;
			max-width: 85vw;
			height: 100vh;
			background: rgba(11,18,32,.95);
			backdrop-filter: blur(20px);
			border-left: 1px solid rgba(255,255,255,.12);
			z-index: 9999;
			overflow-y: auto;
			transition: right 0.3s ease;
			padding: 20px;
			display: flex;
			flex-direction: column;
			gap: 20px;
			-webkit-overflow-scrolling: touch;
		}
		.sidebar-menu.active{ right: 0; }
		.sidebar-header{
			display: flex;
			align-items: center;
			justify-content: space-between;
			padding-bottom: 16px;
			border-bottom: 1px solid rgba(255,255,255,.12);
		}
		.sidebar-header h2{ margin: 0; font-size: 18px; font-weight: 800; color: var(--text); }
		.sidebar-close{
			display: inline-flex;
			align-items: center;
			justify-content: center;
			width: 40px; height: 40px;
			border-radius: 12px;
			border: 1px solid rgba(255,255,255,.16);
			background: rgba(255,255,255,.06);
			cursor: pointer;
			color: var(--text);
			transition: background .12s ease;
		}
		.sidebar-close:hover{ background: rgba(255,255,255,.10); }
		.sidebar-close svg{ width: 20px; height: 20px; }
		.sidebar-menu-links{ display: flex; flex-direction: column; gap: 8px; }
		.sidebar-menu-links a{
			display: block;
			padding: 14px 16px;
			border-radius: 14px;
			color: var(--muted);
			border: 1px solid transparent;
			font-size: 15px;
			text-decoration: none;
			transition: all .12s ease;
		}
		.sidebar-menu-links a:hover{
			background: rgba(255,255,255,.06);
			color: var(--text);
			border-color: rgba(255,255,255,.10);
		}
		@media (max-width: 900px){
			.nav-links{ display: none; }
			.hamburger-menu{ display: block; }
			.brand{ min-width: auto; flex: 1; min-width: 0; }
			.brand small{ display: none; }
			.brand h1{
				font-size: 16px;
				white-space: nowrap;
				overflow: hidden;
				text-overflow: ellipsis;
			}
		}
		body.sidebar-open{ overflow: hidden; position: fixed; width: 100%; }

		.wrap{ max-width:1100px; margin:0 auto; padding:26px 18px 60px; }
		.card{
			border:1px solid var(--line);
			background: rgba(255,255,255,.05);
			border-radius: var(--radius);
			box-shadow: var(--shadow);
			overflow:hidden;
		}
		.card-inner{ padding:22px; }
		.badge{
			display:inline-flex;align-items:center;gap:8px;
			padding:8px 12px;border-radius:999px;
			border:1px solid rgba(255,255,255,.14);
			background: rgba(0,0,0,.18);
			color:var(--muted);
			font-size:12px;
			letter-spacing:.2px;
		}
		.badge .dot{
			width:8px;height:8px;border-radius:50%;
			background:var(--accent);
			box-shadow:0 0 0 3px rgba(52,211,153,.18);
		}
		h2{ margin:12px 0 10px; font-size:clamp(26px,3vw,36px); line-height:1.15; letter-spacing:.2px; }
		.lead{ margin:10px 0; font-size:16px; line-height:1.65; color: var(--muted); max-width:72ch; }
		.grid{
			display:grid;
			grid-template-columns: 1.08fr .92fr;
			gap:18px;
			margin-top:16px;
			align-items:start;
		}
		@media(max-width:900px){ .grid{ grid-template-columns:1fr; } }
		.panel{
			border:1px solid rgba(255,255,255,.14);
			background: rgba(0,0,0,.18);
			border-radius:16px;
			padding:16px;
			margin-bottom:12px;
		}
		.panel h3{ margin:0 0 10px; color:var(--text); font-size:18px; letter-spacing:.15px; }
		.panel ul{ margin:8px 0 0; padding-left:20px; color: rgba(238,242,255,.92); line-height:1.6; }
		.panel li{ margin:8px 0; }
		.callout{
			margin-top:12px;
			padding:16px;
			border-radius:16px;
			border:1px solid rgba(251,191,36,.35);
			background: rgba(251,191,36,.06);
			font-size:15px;
			line-height:1.6;
			color: rgba(238,242,255,.95);
		}
		.callout b{ color: var(--text); }
		.cta{ display:grid; gap:12px; align-content:start; }
		.btn{
			display:flex; justify-content:space-between; align-items:center; gap:12px;
			text-decoration:none; border-radius: 14px;
			padding:16px 16px; font-weight:950;
			border:1px solid rgba(255,255,255,.14);
			background: rgba(255,255,255,.06);
			color: var(--text);
			cursor:pointer; font-size:16px;
		}
		.btnPrimary{
			background: linear-gradient(180deg,#34d399,#10b981);
			color:#052015; border-color: rgba(52,211,153,.35);
		}
		.btn .sub{
			display:block; font-size:13px; font-weight:800; opacity:.86; margin-top:4px;
			color: rgba(255,255,255,.86);
		}
		.btnPrimary .sub{ color:#062015; opacity:.8; }
		.arrow{ font-weight:950; }
		.fineprint{
			margin-top:14px; padding-top:12px; border-top:1px solid rgba(255,255,255,.14);
			font-size:13px; color:var(--muted); line-height:1.6;
		}
		.editor-content{
			margin-top: 22px;
			padding-top: 22px;
			border-top: 1px solid var(--line);
		}
		.editor-content :where(p,ul,ol){ color: rgba(238,242,255,.92); line-height: 1.65; }
		.editor-content a{ color: var(--accent); }
	</style>
	<link rel="stylesheet" href="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/css/responsive.css' ); ?>" />
</head>
<body <?php body_class( 'hb-page-backorders' ); ?>>
<?php
while ( have_posts() ) :
	the_post();
	$page_id = get_the_ID();
	?>
	<header class="nav">
		<div class="nav-inner">
			<a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<?php echo hb_get_site_logo( 'medium', array( 'class' => 'logo', 'aria-hidden' => 'true' ) ); ?>
				<div>
					<h1><?php echo esc_html( get_bloginfo( 'name' ) ); ?></h1>
					<small><?php esc_html_e( 'Backorders & pre-orders', 'hello-elementor-child' ); ?></small>
				</div>
			</a>

			<nav class="nav-links" aria-label="<?php esc_attr_e( 'Primary', 'hello-elementor-child' ); ?>">
				<a href="<?php echo esc_url( home_url( '/how-it-works' ) ); ?>"><?php esc_html_e( 'How It Works', 'hello-elementor-child' ); ?></a>
				<a href="<?php echo esc_url( $shop_url ); ?>"><?php esc_html_e( 'Shop', 'hello-elementor-child' ); ?></a>
				<a href="<?php echo esc_url( home_url( '/faq' ) ); ?>"><?php esc_html_e( 'FAQ', 'hello-elementor-child' ); ?></a>
				<a href="<?php echo esc_url( home_url( '/register-device' ) ); ?>"><?php esc_html_e( 'Register Device', 'hello-elementor-child' ); ?></a>
			</nav>

			<div class="hamburger-menu">
				<input type="checkbox" id="hamburger-toggle-<?php echo (int) $page_id; ?>" class="hamburger-toggle" />
				<label for="hamburger-toggle-<?php echo (int) $page_id; ?>" class="hamburger-btn" aria-label="<?php esc_attr_e( 'Open menu', 'hello-elementor-child' ); ?>">
					<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
						<path d="M4 7h16M4 12h16M4 17h16"/>
					</svg>
				</label>
			</div>
		</div>

		<div class="sidebar-overlay" id="sidebar-overlay-<?php echo (int) $page_id; ?>"></div>
		<div class="sidebar-menu" id="sidebar-menu-<?php echo (int) $page_id; ?>" aria-label="<?php esc_attr_e( 'Mobile menu', 'hello-elementor-child' ); ?>">
			<div class="sidebar-header">
				<h2><?php esc_html_e( 'Menu', 'hello-elementor-child' ); ?></h2>
				<label for="hamburger-toggle-<?php echo (int) $page_id; ?>" class="sidebar-close" aria-label="<?php esc_attr_e( 'Close menu', 'hello-elementor-child' ); ?>">
					<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
						<line x1="18" y1="6" x2="6" y2="18"></line>
						<line x1="6" y1="6" x2="18" y2="18"></line>
					</svg>
				</label>
			</div>
			<div class="sidebar-menu-links">
				<a href="<?php echo esc_url( home_url( '/how-it-works' ) ); ?>"><?php esc_html_e( 'How It Works', 'hello-elementor-child' ); ?></a>
				<a href="<?php echo esc_url( $shop_url ); ?>"><?php esc_html_e( 'Shop', 'hello-elementor-child' ); ?></a>
				<a href="<?php echo esc_url( home_url( '/faq' ) ); ?>"><?php esc_html_e( 'FAQ', 'hello-elementor-child' ); ?></a>
				<a href="<?php echo esc_url( home_url( '/register-device' ) ); ?>"><?php esc_html_e( 'Register Device', 'hello-elementor-child' ); ?></a>
				<a href="<?php echo esc_url( home_url( '/pod-mode' ) ); ?>"><?php esc_html_e( 'PoD Mode', 'hello-elementor-child' ); ?></a>
			</div>
		</div>
	</header>

	<script>
	(function() {
		const toggleId = 'hamburger-toggle-<?php echo (int) $page_id; ?>';
		const toggle = document.getElementById(toggleId);
		const overlay = document.getElementById('sidebar-overlay-<?php echo (int) $page_id; ?>');
		const sidebar = document.getElementById('sidebar-menu-<?php echo (int) $page_id; ?>');
		function toggleSidebar(open) {
			if (overlay && sidebar && toggle) {
				if (open) {
					overlay.classList.add('active');
					sidebar.classList.add('active');
					document.body.classList.add('sidebar-open');
					toggle.checked = true;
				} else {
					overlay.classList.remove('active');
					sidebar.classList.remove('active');
					document.body.classList.remove('sidebar-open');
					toggle.checked = false;
				}
			}
		}
		if (toggle) {
			toggle.addEventListener('change', function() { toggleSidebar(this.checked); });
		}
		if (overlay) {
			overlay.addEventListener('click', function() { toggleSidebar(false); });
		}
		const sidebarLinks = sidebar ? sidebar.querySelectorAll('.sidebar-menu-links a') : [];
		sidebarLinks.forEach(function(link) {
			link.addEventListener('click', function() { toggleSidebar(false); });
		});
	})();
	</script>

	<main class="wrap">
		<section class="card">
			<div class="card-inner">
				<div class="badge"><span class="dot" aria-hidden="true"></span> <?php esc_html_e( 'WooCommerce • VFN fulfillment', 'hello-elementor-child' ); ?></div>

				<h2><?php the_title(); ?></h2>
				<p class="lead">
					<?php esc_html_e( 'Pre-orders and backorders are placed in the shop. The Verification Network (VFN) routes fulfillment to members so scans and delivery stay aligned with the Human Blockchain process.', 'hello-elementor-child' ); ?>
				</p>

				<div class="grid">
					<div>
						<div class="panel">
							<h3><?php esc_html_e( 'How it fits together', 'hello-elementor-child' ); ?></h3>
							<ul>
								<li><?php esc_html_e( 'Choose products that allow backorder or preorder in the WooCommerce shop.', 'hello-elementor-child' ); ?></li>
								<li><?php esc_html_e( 'Complete checkout like any other order; fulfillment may queue until inventory or routing is assigned.', 'hello-elementor-child' ); ?></li>
								<li><?php esc_html_e( 'Device registration and PoD Mode connect your scans when you participate as buyer or seller on the network.', 'hello-elementor-child' ); ?></li>
							</ul>
						</div>
						<div class="callout">
							<b><?php esc_html_e( 'Heads-up', 'hello-elementor-child' ); ?></b>
							<?php esc_html_e( 'Shipping and timing follow the rules shown at checkout and in your order emails. For product-specific questions, use the contact options on the shop or ask in Discord after you join.', 'hello-elementor-child' ); ?>
						</div>
					</div>
					<aside class="cta">
						<a class="btn btnPrimary" href="<?php echo esc_url( $shop_url ); ?>">
							<div>
								<?php esc_html_e( 'Open the shop', 'hello-elementor-child' ); ?>
								<span class="sub"><?php esc_html_e( 'Place a backorder or preorder', 'hello-elementor-child' ); ?></span>
							</div>
							<div class="arrow" aria-hidden="true">→</div>
						</a>
						<a class="btn" href="<?php echo esc_url( home_url( '/how-it-works' ) ); ?>">
							<div>
								<?php esc_html_e( 'How It Works', 'hello-elementor-child' ); ?>
								<span class="sub"><?php esc_html_e( 'Overview of the flow', 'hello-elementor-child' ); ?></span>
							</div>
							<div class="arrow" aria-hidden="true">→</div>
						</a>
						<a class="btn" href="<?php echo esc_url( home_url( '/faq' ) ); ?>">
							<div>
								<?php esc_html_e( 'FAQ', 'hello-elementor-child' ); ?>
								<span class="sub"><?php esc_html_e( 'Common answers', 'hello-elementor-child' ); ?></span>
							</div>
							<div class="arrow" aria-hidden="true">→</div>
						</a>
						<div class="fineprint">
							<?php esc_html_e( 'This page is informational. Terms, availability, and pricing are governed by the store at checkout.', 'hello-elementor-child' ); ?>
						</div>
					</aside>
				</div>

				<?php if ( get_the_content() ) : ?>
					<div class="editor-content entry-content">
						<?php the_content(); ?>
					</div>
				<?php endif; ?>
			</div>
		</section>
	</main>
	<?php
endwhile;
?>
</body>
</html>
