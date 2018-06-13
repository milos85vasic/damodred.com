<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Fotografo
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	
	<header id="masthead" class="site-header">
		<div class="site-branding container">	
			<div class="logo">
				<a rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
			</div>
			<?php 
			$description = get_bloginfo( 'description', 'display' );
			if ( $description || is_customize_preview() ) : ?>
				<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
			<?php
			endif; ?>
			<a id="menu-toogle" class="menu-toogle" href="#"><span aria-hidden="true" class="icon_menu-square_alt2"></span></a>
		</div>	
	</header><!-- #masthead -->
	<div id="nav-panel" class="nav-panel">
		<div class="site-branding">
			<div class="logo">
				<a rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
			</div>
			<?php 
			$description = get_bloginfo( 'description', 'display' );
			if ( $description || is_customize_preview() ) : ?>
				<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
			<?php
			endif; ?>
			
			
		</div>
		
			<?php 

			if( has_nav_menu('menu-1') ){
				echo '<nav id="nav" class="main-nav">';
					echo '<h6 class="widget-title">' . esc_html__('Menu', 'fotografo') . '</h6>';
					wp_nav_menu( array( 'theme_location' => 'menu-1', 'container'=>'', 'fallback_cb' =>'', 'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>') );
				echo '</nav>';
			}
			else 
				if (current_user_can( 'administrator' )){
					echo '<nav id="nav" class="main-nav">';
						echo '<h6 class="widget-title">' . esc_html__('Menu', 'fotografo') . '</h6>';
						echo '<ul class="no-menu"><li><a href="' . esc_url( admin_url('/') ) . 'nav-menus.php">'. esc_html__('Go to "Appearance - Menus" to set-up menu', 'fotografo') . '</a></li></ul>';	
					echo '</nav>';
				}
			?>
			
		<?php get_sidebar();?>
		<footer id="colophon" class="site-footer" role="contentinfo">
			<div class="site-info">
				<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'fotografo' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'fotografo' ), 'WordPress' ); ?></a><br>
				<?php printf( esc_html__( 'Theme: %1$s by %2$s.', 'fotografo' ), 'Fotografo', '<a href="http://awothemes.pro" rel="designer">Awothemes</a>' ); ?>
			</div><!-- .site-info -->
		</footer><!-- #colophon -->
	</div>