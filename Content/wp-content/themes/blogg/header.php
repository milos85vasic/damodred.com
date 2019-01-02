<?php
/**
 * The header for our theme
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 * @package Blogg
 */
	if ( ! defined( 'ABSPATH' ) ) {
		exit; // Exit if accessed directly.
	}
	
?><!DOCTYPE html>
    <html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="profile" href="https://gmpg.org/xfn/11">

        <?php wp_head(); ?>
    </head>

    <body <?php body_class(); ?>>
	 
        <div id="page" class="site">
            <a class="skip-link screen-reader-text" href="#content">
                <?php esc_html_e( 'Skip to content', 'blogg' ); ?>
            </a>
			
		<header id="masthead" class="site-header">
			
			<div class="container">
				<div class="row no-gutter align-items-center">
					<div class="col-lg-auto">                
						<div class="site-branding">
						<?php 
						if ( has_custom_logo() ) {
							the_custom_logo();
						} else {				
								
								if ( is_front_page() && is_home() ) { ?>
									<h1 class="site-title">
										<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
											<?php bloginfo( 'name' ); ?>
										</a>
									</h1>
								<?php
								} else {						
								?>
							<p class="site-title">
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
									<?php bloginfo( 'name' ); ?>
								</a>
							</p>
							<?php
							}						
							$blogg_description = get_bloginfo( 'description', 'display' );
								if ( $blogg_description && esc_attr(get_theme_mod( 'blogg_show_site_description', true ) ) || is_customize_preview() )  { 
							?>
							<p class="site-description">
								<?php echo $blogg_description; /* WPCS: xss ok. */ ?>
							</p>
							<?php 
							} 
						}
						?>
					</div><!-- .site-branding -->
				</div>
					<div class="col">              				
						<?php get_template_part( 'template-parts/navigation/nav', 'primary' ); ?>
				</div>
				</div>
			</div>				
		</header><!-- #masthead -->

		<?php // Display slider if enabled		 
			if (  is_front_page() && esc_attr(get_theme_mod( 'blogg_display_slider', false )  )  ) { 
				blogg_post_slider(); 
				wp_reset_postdata();
			}
		?>
		<?php get_template_part( 'template-parts/sidebars/sidebar', 'banner' ); ?>
				
		<?php 
		if ( esc_attr(get_theme_mod( 'blogg_display_featured_boxes', false )  ) && is_front_page() ) { 
			blogg_featured_boxes_section();
		}
		?>
		
		<?php 
		if ( ! is_home() ) {
			get_template_part( 'template-parts/sidebars/sidebar', 'breadcrumbs' ); 
		}
		?>

		<div id="content-wrapper">
			<div id="content" class="site-content container">
			
			<?php get_template_part( 'template-parts/sidebars/sidebar', 'top' ); ?>
			
			