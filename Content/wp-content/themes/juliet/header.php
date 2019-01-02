<?php
/**
 * The Header for the theme.
 *
 * Displays all of the <head> section and logo, navigation, header widgets
 *
 * @package juliet
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
    <?php wp_head(); ?>
</head>

<?php $class[]=juliet_get_body_class(); if(is_front_page() && !is_paged()) $class[]='frontpage'; ?>
<?php if(juliet_get_option('juliet_skin') == 'Contemporary') $class[]='style2'; ?>
<body <?php body_class($class); ?>>

<?php get_template_part('parts/header', 'offcanvas'); ?>

<div class="main-wrapper">
	<!-- Header -->
	<div class="header">
    
        <?php $juliet_enable_off_canvas_menu = juliet_get_option('juliet_enable_off_canvas_menu'); ?>
        <?php if ( is_active_sidebar( 'header-row-1-left' ) || is_active_sidebar( 'header-row-1-right' ) || $juliet_enable_off_canvas_menu == 1) { ?>
		<!-- Header Row 1 -->
		<div class="header-row-1">
			<div class="container">
				<div class="row">
                    <?php if ( is_active_sidebar( 'header-row-1-left' ) || $juliet_enable_off_canvas_menu == 1 ) { ?>
					<!-- Left -->
					<div class="col-sm-4 header-row-1-left">
						<?php if($juliet_enable_off_canvas_menu == 1) { ?><a href="#" class="side-page-toggle"><i class="fa fa-bars"></i></a><?php } ?>
						<?php if ( is_active_sidebar( 'header-row-1-left' ) ) { dynamic_sidebar( 'header-row-1-left' ); } ?>
					</div>
					<!-- /Left -->
					<?php } ?>
                    
                    <?php if ( is_active_sidebar( 'header-row-1-right' ) ) { ?>
					<!-- Right -->
					<div class="col-sm-8 header-row-1-right"><?php dynamic_sidebar( 'header-row-1-right' ); ?></div>
					<!-- /Right -->
                    <?php } ?>
				</div>
			</div>
		</div>
		<a href="javascript:;" class="header-row-1-toggle"></a>
		<!-- /Header Row 1 -->
        <?php } ?>
		
		
		<!-- Header Row 2 -->
		<div class="header-row-2">
			<div class="container">
			
				<!-- Left -->
				<div class="header-row-2-left">
                    <?php $tagline_class = ''; if(juliet_get_option('juliet_image_logo_show') == 1) $tagline_class = 'image-logo'; ?>
					<div class="logo <?php echo esc_attr($tagline_class); ?>">
                        <?php
                        if(juliet_get_option('juliet_image_logo_show') == 1) { 
                            if ( function_exists( 'the_custom_logo' ) ) the_custom_logo(); 
                        } 
                        else { 
                            $juliet_text_logo = juliet_get_option('juliet_text_logo');
                            if($juliet_text_logo == '') $juliet_text_logo = get_bloginfo('name'); 
							if ( is_front_page() ) { ?>
                            <h1 class="header-logo-text"><a href="<?php echo esc_url(home_url('/')); ?>"><?php echo esc_html($juliet_text_logo) ?></a></h1>
							<?php } else { ?>
							<div class="header-logo-text"><a href="<?php echo esc_url(home_url('/')); ?>"><?php echo esc_html($juliet_text_logo) ?></a></div>
							<?php } ?>
                        <?php } ?>
					</div>
                    <?php if( display_header_text() ) { $tagline = get_bloginfo('description'); if($tagline != '') { ?>
                    <!-- Tagline -->
                    <div class="tagline <?php echo $tagline_class ?>"><p><?php echo esc_html($tagline); ?></p></div>
                    <!-- /Tagline -->
                    <?php } } ?>
                    
				</div>
				<!-- /Left -->
				
				<!-- Right -->
				<div class="header-row-2-right">
					<nav class="navbar navbar-default">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".header-row-2-right .navbar-collapse" aria-expanded="false">
								<span class="sr-only"><?php esc_html_e('Toggle Navigation', 'juliet'); ?></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<!-- Navigation -->
                        <?php 
						$args = array('theme_location'    => 'header', 
									  'depth'             => 3,
									  'container'         => 'div',
									  'container_class'   => 'navbar-collapse collapse',
									  'menu_class'        => 'nav navbar-nav',
									  'fallback_cb'       => 'juliet_default_nav',
									  'walker'            => new wp_bootstrap_navwalker() );
                        wp_nav_menu( $args );
                        ?>
                    <!-- /Navigation -->
					</nav>
				</div>
				<!-- /Right -->
			</div>
		</div>
		<!-- /Header Row 2 -->
		
	</div>
	<!-- /Header -->
    
    <?php 
    if(is_front_page() && !is_paged() ) { 
        get_template_part('parts/frontpage', 'banner'); 
    } 
    ?>
    
    <div class="container">
	
	<?php 
	if(is_front_page() && !is_paged() ) { 
		get_template_part('parts/frontpage', 'featured'); 
		echo '<hr />';
	} 
	?>