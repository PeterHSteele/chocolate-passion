<?php
/**
 * The header for our theme
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

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'chocolate-passion' ); ?></a>
	<header id="masthead" class="site-header" role="banner">
				<div class="header-row-one">
					<div class="col-80">
						<div class="row">
							<div class="site-branding">
								<?php
									the_custom_logo();
								?>
							</div><!-- .site-branding -->
							<div class="header secondary-menu-wrap">
								<nav id="secondary-menu" class="secondary-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Secondary', 'chocolate-passion' ); ?>">
									<?php 
										wp_nav_menu( array(
											'theme_location' => 'menu-2',
											'menu_id' => 'nav-secondary-menu',
											'fallback_cb' => false
										));
									?>
								</nav>
							</div><!--secondary-menu-wrap-->
						</div><!--.row-->
					</div><!--.col-80-->
				</div><!--.header-row-one-->
				<div class="header-row-two">
					<div class="col-80"> 
							<nav id="site-navigation" class="main-navigation clear" role="navigation" aria-label="<?php esc_attr_e( 'Primary', 'chocolate-passion' ); ?>">
								<?php get_search_form(); ?>
								<button class="menu-toggle toggle" aria-controls="primary-menu" aria-pressed="false">
									<i class="fas fa-bars"></i>
									<span class="screen-reader-text"><?php esc_html_e( 'Primary Menu', 'chocolate-passion' ); ?></span>
								</button>	
								<?php
								wp_nav_menu( array(
									'theme_location' => 'menu-1',
									'menu_id'        => 'primary-menu',
									'menu_class'	 => 'clear accessible-hide nav-menu'
								) );
								?>
							</nav><!-- #site-navigation -->					
					</div><!--.col-80-->
				</div><!--.header-row-two-->
				<div class="header-row-three">
					<div class="col-80">
						<div class="row">
							<div class="site-info">	
							<?php
								if ( is_front_page() && is_home() && get_bloginfo( 'description' ) ) : ?>
									<h1 class="site-title"><?php bloginfo( 'description' ); ?></h1>
								<?php elseif ( is_front_page() && is_home() ): ?> 
									<h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
								<?php endif; 
							?>
							</div><!--.site-info-->
						</div><!--row-->
					</div><!--.col-80-->
				</div><!--.header-row-three-->
				<?php if ( function_exists( 'is_woocommerce' ) && is_woocommerce() ) :
					get_template_part( 'template-parts/header', 'shop' );
				endif; ?>
				<div class="custom-header-wrap">
					<?php the_header_image_tag(); ?>
				</div>
	</header><!-- #masthead -->

	<div id="content" class="site-content">