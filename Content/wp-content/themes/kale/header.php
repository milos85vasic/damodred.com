<?php
/**
 * The Header for the theme.
 *
 * Displays all of the <head> section and logo, navigation, header widgets
 *
 * @package kale
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

<body <?php body_class(); ?>>

<div class="main-wrapper">
    <div class="container">
        
        <!-- Header -->
        <div class="header">
        
            <?php if ( is_active_sidebar( 'header-row-1-left' ) || is_active_sidebar( 'header-row-1-right' ) ) { ?>
            <!-- Header Row 1 -->
            <div class="header-row-1">
                <div class="row">
				
					<!-- Widget / Social Menu -->
                    <div class="col-sm-6 header-row-1-left">
					<?php if ( is_active_sidebar( 'header-row-1-left' ) ) { ?><?php dynamic_sidebar( 'header-row-1-left' ); ?><?php } ?>
                    </div>
					<!-- /Widget / Social Menu -->
					
                    <!-- Widget / Top Menu -->
					<div class="col-sm-6 header-row-1-right">
					<?php if ( is_active_sidebar( 'header-row-1-right' ) ) { ?><?php dynamic_sidebar( 'header-row-1-right' ); ?><?php } ?>
					</div>
					<!-- /Widget / Top Menu -->
					
                </div>
            </div>
			<div class="header-row-1-toggle"><i class="fa fa-angle-down"></i></div>
            <!-- /Header Row 1 -->
            <?php } ?>
            
            <!-- Header Row 2 -->
            <div class="header-row-2">
                <div class="logo">
                    <?php 
                    if(kale_get_option('kale_image_logo_show') == 1) { 
                        if ( function_exists( 'the_custom_logo' ) ) the_custom_logo(); 
                    } 
                    else { 
                        $kale_text_logo = kale_get_option('kale_text_logo');
                        if($kale_text_logo == '') $kale_text_logo = get_bloginfo('name');
                    ?>
					
						<?php if ( is_front_page() ) { ?>
						<h1 class="header-logo-text"><a href="<?php echo esc_url(home_url('/')); ?>"><?php echo esc_html($kale_text_logo) ?></a></h1>
						<?php } else { ?>
						<div class="header-logo-text"><a href="<?php echo esc_url(home_url('/')); ?>"><?php echo esc_html($kale_text_logo) ?></a></div>
						<?php } ?>
					
                    <?php } ?>
                </div>
                <?php if( display_header_text() ) { ?>
                <div class="tagline"><?php $tagline = get_bloginfo('description'); if($tagline != '') { ?><p><?php echo esc_html($tagline); ?></p><?php } ?></div>
                <?php } ?>
            </div>
            <!-- /Header Row 2 -->
            
            
            <!-- Header Row 3 -->
            <div class="header-row-3">
                <nav class="navbar navbar-default">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".header-row-3 .navbar-collapse" aria-expanded="false">
                        <span class="sr-only"><?php esc_html_e('Toggle Navigation', 'kale'); ?></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        </button>
                    </div>
                    <!-- Navigation -->
                    <?php if ( has_nav_menu( 'header' ) ) {
                        $args = array('theme_location'    => 'header', 
                                      'depth'             => 3,
                                      'container'         => 'div',
                                      'container_class'   => 'navbar-collapse collapse',
                                      'menu_class'        => 'nav navbar-nav',
                                      'fallback_cb'       => '',
                                      'walker'            => new wp_bootstrap_navwalker() );
                        if(kale_get_option('kale_nav_search_icon') == 1) 
                                $args['items_wrap'] = kale_nav_items_wrap();
                        wp_nav_menu( $args );
                    } else {
                        //wp_page_menu(array('depth'=>1, 'show_home' => true, 'menu_class'=>'navbar-collapse collapse' ));
                        kale_default_nav();
                    }
                    ?>
                    <!-- /Navigation -->
                </nav>
            </div>
            <!-- /Header Row 3 -->
            
            
        </div>
        <!-- /Header -->
        
<?php if(is_front_page() && !is_paged() ) { 
get_template_part('parts/frontpage', 'banner'); 
get_template_part('parts/frontpage', 'featured'); 
} ?>
        