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
	<header id="masthead" class="site-header">
				<div class="header-row-one">
					<div class="col-80">
						<div class="row">
							<div class="site-branding">
								<?php
									the_custom_logo();
								?>
							</div><!-- .site-branding -->

							<div class="header secondary-menu-wrap">
								<nav id="secondary-menu" class="secondary-navigation">
									<!--<button class="menu-toggle" aria-controls="seconary-menu"></button>-->
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
							<nav id="site-navigation" class="main-navigation clear">
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
							<!--<button class="search-toggle toggle" aria-controls="primary-menu" aria-expanded="false">
								<i class="fas fa-search"></i>
								<span class="sr-only">
								<?php 
									esc_html_e( 'Search', 'chocolate-passion' ) . ' ' . bloginfo('name')
								?>
								</span>
							</button>-->						
					</div><!--.col-80-->
				</div><!--.header-row-two-->
				<div class="header-row-three">
					<div class="col-80">
						<div class="row">
							<div class="site-info">	
							<?php
								if ( is_front_page() && is_home() && get_bloginfo( 'desription' ) ) :
									?>
									<h1 class="site-title"><?php bloginfo( 'description' ); ?></h1>
									<?php
								/*else :
									?>
									<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
									<?php
									
									$chocolate_passion_description = get_bloginfo( 'description', 'display' );
									if ( $chocolate_passion_description || is_customize_preview() ) :
										?>
										<p class="site-description"><?php echo $chocolate_passion_description; /* WPCS: xss ok. *//* ?></p>
									<?php 
									endif; */
								endif; 
							?>
								
							</div><!--.site-info-->
						</div>
					</div>
				</div>
	</header><!-- #masthead -->

	<div id="content" class="site-content">