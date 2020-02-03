<?php
/**
 * The header for the banner-header.php page template.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package chocolate_passion
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class( 'banner-header' ); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'chocolate-passion' ); ?></a>

	<header id="masthead" class="site-header">
		<nav id="site-navigation" class="main-navigation clear">
			<button class="search-toggle toggle" aria-controls="primary-menu" aria-expanded="false">
				<i class="fas fa-search"></i>
					<span class="sr-only">
						<?php esc_html_e( 'Search', 'chocolate-passion' ) . ' ' . bloginfo('name') ?>
					</span>
			</button>
			<?php get_search_form(); ?>
			<button class="menu-toggle toggle" aria-controls="primary-menu" aria-expanded="false">
				<i class="fas fa-bars"></i>
				<span class="sr-only"><?php esc_html_e( 'Primary Menu', 'chocolate-passion' ); ?></span>
			</button>	
			<?php
				wp_nav_menu( array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu',
					'menu_class'	 => 'clear'
				) );
			?>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">