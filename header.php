<?php
/**
 * The template for displaying the header.
 *
 * HumanBlockchain.info — Custom topbar design.
 *
 * @package HelloElementorChild
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$viewport_content = apply_filters( 'hello_elementor_viewport_content', 'width=device-width, initial-scale=1' );
$enable_skip_link = apply_filters( 'hello_elementor_enable_skip_link', true );
$skip_link_url = apply_filters( 'hello_elementor_skip_link_url', '#content' );

// Primary menu args for desktop & sidebar (uses menu-1 / Header from parent theme)
$header_has_menu = has_nav_menu( 'menu-1' );
$menu_args = array(
	'theme_location' => 'menu-1',
	'container'      => false,
	'menu_class'     => 'menu-nav',
	'fallback_cb'    => false,
	'depth'          => 1,
);

// Default fallback links when no menu is assigned (Appearance → Menus)
$header_fallback_links = array(
	array( 'url' => home_url( '/membership' ), 'label' => 'Membership' ),
	array( 'url' => home_url( '/how-it-works' ), 'label' => 'How it works' ),
	array( 'url' => home_url( '/' ) . '#faq', 'label' => 'FAQs' ),
	array( 'url' => home_url( '/' ) . '#organizers', 'label' => 'Organizers' ),
	array( 'url' => home_url( '/detente-2030' ), 'label' => 'Detente 2030' ),
	array( 'url' => home_url( '/proof-of-delivery' ), 'label' => 'Proof of Delivery' ),
	array( 'url' => home_url( '/poc-guilds' ), 'label' => 'POC Guilds' ),
	array( 'url' => home_url( '/kite-festival' ), 'label' => 'Kite Festival', 'class' => 'btn primary' ),
);
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="<?php echo esc_attr( $viewport_content ); ?>">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
	<link rel="stylesheet" href="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/css/responsive.css" />
	<style>
		/* Topbar / Nav — HumanBlockchain header styles */
		:root{
			--bg:#0b1220;
			--bg2:#070d18;
			--panel:rgba(18,31,61,.70);
			--line:rgba(232,238,252,.12);
			--text:#e8eefc;
			--muted:#b8c3e6;
			--accent:#7dd3fc;
			--accent2:#a78bfa;
			--radius:18px;
			--font:ui-sans-serif,system-ui,-apple-system,Segoe UI,Roboto,Arial,sans-serif;
		}
		.topbar{
			position:sticky;top:0;z-index:50;
			background:rgba(11,18,32,.78);
			backdrop-filter:blur(10px);
			border-bottom:1px solid var(--line);
			width:100%;
		}
		.topbar .wrap{
			max-width:none;width:100%;
			padding-left:24px;padding-right:24px;
		}
		.nav{
			display:flex;align-items:center;justify-content:space-between;
			gap:12px;padding:14px 0;flex-wrap:wrap;
		}
		.brand{display:flex;align-items:center;gap:10px;min-width:220px;text-decoration:none;color:inherit}
		.logo{
			width:28px;height:28px;border-radius:10px;
			background:linear-gradient(135deg,rgba(125,211,252,.95),rgba(167,139,250,.95));
			box-shadow:0 10px 20px rgba(0,0,0,.25);
			display:flex;align-items:center;justify-content:center;overflow:hidden;
		}
		.logo img{height:100%;object-fit:contain;border-radius:10px}
		.brand b{letter-spacing:.3px}
		.brand .small.tagline{white-space:normal;line-height:1.35;max-width:280px;font-size:12px;color:var(--muted)}
		.menu{display:flex;align-items:center;gap:6px;flex-wrap:wrap;justify-content:center;flex:1 1 auto;min-width:0}
		.menu-nav{display:flex;align-items:center;gap:6px;flex-wrap:wrap;justify-content:center;list-style:none;margin:0;padding:0}
		.menu-nav li{margin:0}
		.menu a,.menu-nav a{
			font-size:14px;color:var(--muted);
			padding:8px 10px;border-radius:12px;border:1px solid transparent;text-decoration:none;
		}
		.menu a:hover{background:rgba(232,238,252,.06);color:var(--text);border-color:rgba(232,238,252,.10)}
		.cta{display:flex;align-items:center;gap:10px;flex-wrap:wrap;flex-shrink:0}
		.btn{
			display:inline-flex;align-items:center;justify-content:center;gap:10px;
			padding:10px 14px;border-radius:14px;border:1px solid var(--line);
			background:rgba(232,238,252,.06);color:var(--text);font-weight:800;font-size:14px;
			text-decoration:none;cursor:pointer;box-shadow:0 10px 18px rgba(0,0,0,.18);
			transition:transform .08s ease,filter .08s ease,background .12s ease,border-color .12s ease;
		}
		.btn:hover{background:rgba(232,238,252,.10);transform:translateY(-1px)}
		.btn.primary{border-color:transparent;background:linear-gradient(135deg,rgba(125,211,252,.95),rgba(167,139,250,.95));color:#071024}
		.btn.primary:hover{filter:brightness(1.05)}
		.btn.ghost{background:transparent;border-color:rgba(232,238,252,.18)}
		.hamburger{display:none}
		@media(min-width:901px){.hamburger{display:none!important}}
		.hamburger label{
			display:inline-flex;align-items:center;justify-content:center;
			width:44px;height:44px;border-radius:14px;border:1px solid rgba(232,238,252,.16);
			background:rgba(232,238,252,.06);cursor:pointer;
		}
		.hamburger label:hover{background:rgba(232,238,252,.10)}
		.hamburger svg{width:22px;height:22px}
		#navtoggle{display:none}
		.sidebar-overlay{display:none;position:fixed;inset:0;background:rgba(0,0,0,.5);backdrop-filter:blur(4px);z-index:9998;opacity:0;transition:opacity .3s ease;cursor:pointer}
		@media(min-width:901px){.sidebar-overlay{display:none!important;pointer-events:none}}
		.sidebar-overlay.active{display:block;opacity:1}
		@media(min-width:901px){.sidebar-overlay.active{display:none!important}}
		.sidebar-menu{
			position:fixed;top:0;right:-100%;width:320px;max-width:85vw;height:100vh;
			background:rgba(11,18,32,.95);backdrop-filter:blur(20px);border-left:1px solid rgba(232,238,252,.12);
			z-index:9999;overflow-y:auto;transition:right .3s ease;padding:20px;
			display:flex;flex-direction:column;gap:20px;
		}
		@media(min-width:901px){.sidebar-menu{display:none!important;right:-100%!important;pointer-events:none}}
		.sidebar-menu.active{right:0}
		@media(min-width:901px){.sidebar-menu.active{display:none!important}}
		body.sidebar-open{overflow:hidden}
		.sidebar-header{display:flex;align-items:center;justify-content:space-between;padding-bottom:16px;border-bottom:1px solid rgba(232,238,252,.12)}
		.sidebar-close{
			display:inline-flex;align-items:center;justify-content:center;width:40px;height:40px;border-radius:12px;
			border:1px solid rgba(232,238,252,.16);background:rgba(232,238,252,.06);cursor:pointer;color:var(--text);
		}
		.sidebar-close:hover{background:rgba(232,238,252,.10)}
		.sidebar-close svg{width:20px;height:20px}
		.sidebar-menu-links{display:flex;flex-direction:column;gap:8px}
		.sidebar-menu-links .menu-nav{flex-direction:column;gap:8px}
		.sidebar-menu-links .menu-nav a{display:block;padding:14px 16px;border-radius:14px}
		.sidebar-menu-links .menu-nav a.btn{width:100%;justify-content:center}
		.sidebar-menu-links a{
			display:block;padding:14px 16px;border-radius:14px;color:var(--muted);border:1px solid transparent;
			font-size:15px;text-decoration:none;transition:all .12s ease;
		}
		.sidebar-menu-links a:hover{background:rgba(232,238,252,.06);color:var(--text);border-color:rgba(232,238,252,.10)}
		.sidebar-device-section{padding:16px;border-radius:16px;background:rgba(232,238,252,.05);border:1px solid rgba(232,238,252,.12)}
		.sidebar-device-section h3{font-size:14px;font-weight:800;margin:0 0 12px;color:var(--text);text-transform:uppercase;letter-spacing:.5px}
		.sidebar-device-section .device-status{margin-bottom:0;display:none}
		.sidebar-device-section .device-status.active{display:flex}
		.sidebar-device-section #activate-device-sidebar{display:block}
		.sidebar-device-section .device-status.active~#activate-device-sidebar{display:none!important}
		.sidebar-buttons{display:flex;flex-direction:column;gap:10px;margin-top:auto;padding-top:20px;border-top:1px solid rgba(232,238,252,.12)}
		.sidebar-buttons .btn{width:100%;justify-content:center}
		.device-status{display:none;padding:12px 16px;border-radius:14px;background:rgba(134,239,172,.1);border:1px solid rgba(134,239,172,.3);align-items:center;gap:12px}
		.device-status.active{display:flex}
		.status-dot{width:10px;height:10px;border-radius:50%;background:#86efac;box-shadow:0 0 0 3px rgba(134,239,172,.2);flex-shrink:0}
		.device-activate-wrapper{display:flex;gap:10px;flex-wrap:wrap;align-items:center}
		@media(max-width:900px){.menu{display:none}.cta .device-activate-wrapper{display:none}.cta .btn.ghost{display:none}.hamburger{display:block}.brand .small.tagline{display:none}.brand b{font-size:16px}}
		@media(max-width:600px){.brand .small{display:none}}
	</style>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<?php if ( $enable_skip_link ) : ?>
<a class="skip-link screen-reader-text" href="<?php echo esc_url( $skip_link_url ); ?>"><?php esc_html_e( 'Skip to content', 'hello-elementor' ); ?></a>
<?php endif; ?>

<header class="topbar">
	<div class="wrap">
		<nav class="nav" aria-label="Primary">
			<a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<?php echo function_exists( 'hb_get_site_logo' ) ? hb_get_site_logo( 'medium', array( 'class' => 'logo', 'aria-hidden' => 'true' ) ) : ''; ?>
				<div>
					<b><?php echo esc_html( get_bloginfo( 'name' ) ); ?></b><br>
					<span class="small tagline">Device-driven trust • 2-scan Proof of Delivery • XP accounting</span>
				</div>
			</a>

			<div class="menu" aria-label="Menu">
				<?php
				if ( $header_has_menu ) {
					wp_nav_menu( array_merge( $menu_args, array(
						'items_wrap' => '<ul class="%2$s">%3$s</ul>',
					) ) );
				} else {
					echo '<ul class="menu-nav">';
					foreach ( $header_fallback_links as $item ) {
						$class = ! empty( $item['class'] ) ? ' class="' . esc_attr( $item['class'] ) . '"' : '';
						echo '<li><a href="' . esc_url( $item['url'] ) . '"' . $class . '>' . esc_html( $item['label'] ) . '</a></li>';
					}
					echo '</ul>';
				}
				?>
			</div>

			<div class="cta">
				<button class="btn primary open-join-poc-trigger" id="openJoinPOC" type="button">Start POC</button>
				<a class="btn ghost" href="<?php echo esc_url( home_url( '/pod-mode' ) ); ?>">PoD Mode</a>

				<div class="hamburger">
					<input id="navtoggle" type="checkbox" />
					<label for="navtoggle" aria-label="Open menu">
						<svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
							<path d="M4 7h16M4 12h16M4 17h16" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
						</svg>
					</label>
				</div>
			</div>
		</nav>
	</div>

	<div class="sidebar-overlay"></div>

	<div class="sidebar-menu" aria-label="Mobile Sidebar Menu">
		<div class="sidebar-header">
			<h2 style="margin:0;font-size:18px;font-weight:800;">Menu</h2>
			<label for="navtoggle" class="sidebar-close" aria-label="Close menu">
				<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
					<line x1="18" y1="6" x2="6" y2="18"></line>
					<line x1="6" y1="6" x2="18" y2="18"></line>
				</svg>
			</label>
		</div>

		<div class="sidebar-menu-links">
			<?php
			if ( $header_has_menu ) {
				wp_nav_menu( array_merge( $menu_args, array(
					'items_wrap' => '<ul class="%2$s">%3$s</ul>',
				) ) );
			} else {
				echo '<ul class="menu-nav">';
				foreach ( $header_fallback_links as $item ) {
					$class = ! empty( $item['class'] ) ? ' class="' . esc_attr( $item['class'] ) . '"' : '';
					$style = ! empty( $item['class'] ) ? ' style="justify-content:center;"' : '';
					echo '<li><a href="' . esc_url( $item['url'] ) . '"' . $class . $style . '>' . esc_html( $item['label'] ) . '</a></li>';
				}
				echo '</ul>';
			}
			?>
		</div>

		<div class="sidebar-buttons">
			<button type="button" class="btn primary open-join-poc-trigger" style="width:100%;justify-content:center;">Start POC</button>
			<a class="btn ghost" href="<?php echo esc_url( home_url( '/pod-mode' ) ); ?>">PoD Mode</a>
		</div>
	</div>
</header>
