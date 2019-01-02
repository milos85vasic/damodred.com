<?php 
$juliet_enable_off_canvas_menu = juliet_get_option('juliet_enable_off_canvas_menu');
$juliet_example_content = juliet_get_option('juliet_example_content');

if($juliet_enable_off_canvas_menu == 1) { 
?>
<!-- Off Canvas Menu -->
<div id="side-page-overlay"></div>
<div id="side-page">
	<div class="inner">
		<a href="#" class="side-page-close"><i class="fa fa-times"></i></a>
        
        <!-- Logo -->
        <div class="logo">
            <?php 
            if(juliet_get_option('juliet_image_logo_show') == 1) { 
                if ( function_exists( 'the_custom_logo' ) ) the_custom_logo();  
            } 
            else { 
                $juliet_text_logo = juliet_get_option('juliet_text_logo'); if($juliet_text_logo == '') $juliet_text_logo = get_bloginfo('name'); 
                if ( is_front_page() ) { ?>
                <h1 class="header-logo-text"><?php echo esc_html($juliet_text_logo); ?></h1>
                <?php } else { ?>
                <div class="header-logo-text"><?php echo esc_html($juliet_text_logo); ?></div>
                <?php } ?>
            <?php } ?>
		</div>
        <!-- /Logo -->
        
        <!-- Tagline -->
		<?php if( display_header_text() ) { ?>
        <div class="tagline"><?php $tagline = get_bloginfo('description'); if($tagline != '') { ?><p><?php echo esc_html($tagline); ?></p><?php } ?></div>
        <?php } ?>
        <!-- /Tagline -->
        
		<?php if ( has_nav_menu( 'offcanvas' ) ) {  ?>
        <!-- Navigation -->
        <?php wp_nav_menu( array( 'theme_location' => 'offcanvas',  'depth' => 1, 'container' => 'div', 'container_class' => 'side-page-nav', 'menu_class' => '' ) ); ?>
        <!-- /Navigation -->
        <?php } else if ($juliet_example_content == 1) { wp_page_menu( array( 'depth' => 1, 'container' => '', 'menu_class' => 'side-page-nav' ) ); } ?>

        <?php if(is_active_sidebar('sidebar-offcanvas')) { ?><div class="sidebar-offcanvas"><?php dynamic_sidebar('sidebar-offcanvas'); ?></div><?php } ?>
        
	</div>
</div>
<!-- /Off Canvas Menu -->
<?php } ?>
