<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="<?php bloginfo( 'description' ); ?>">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>

	<!-- Announcement Bar -->
	<div class="announcement-bar">
		<?php esc_html_e( 'NOIR STUDIO — COLLECTION 001 / NOW IN SEASON', 'custom-local-theme' ); ?>
	</div>

	<!-- Header & Navigation -->
	<header id="site-header">
		<div class="header-inner">
			<div class="site-branding">
				<?php
					// Display site title
					if ( function_exists( 'noir_theme_get_site_title' ) ) {
						echo wp_kses_post( noir_theme_get_site_title() );
					}
				?>
			</div>

			<button class="menu-toggle" id="menu-toggle" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle Menu', 'custom-local-theme' ); ?>">
				<span>☰</span>
			</button>

			<?php
				// Display primary navigation
				if ( function_exists( 'noir_theme_get_primary_menu' ) ) {
					echo wp_kses_post( noir_theme_get_primary_menu() );
				}
			?>
		</div>
	</header>
