<?php
/**
 * Displays the header content
 *
 * @package Theme Freesia
 * @subpackage Excellent
 * @since Excellent 1.0
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<?php
$excellent_settings = excellent_get_theme_options(); ?>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<link rel="profile" href="http://gmpg.org/xfn/11" />
<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php endif;
wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="page" class="site">
<!-- Masthead ============================================= -->
<header id="masthead" class="site-header">
	<div class="custom-header">
		<div class="custom-header-media">
		<?php the_custom_header_markup(); ?>
		</div>
	</div>
	<div class="top-bar">
		<div class="wrap">
			<?php
			if( is_active_sidebar( 'excellent_header_info' )) {
				dynamic_sidebar( 'excellent_header_info' );
			}
			if (has_nav_menu('topmenu')) {
				$args = array(
					'theme_location' => 'topmenu',
					'container'      => '',
					'items_wrap'     => '<ul class="top-menu">%3$s</ul>',
					); ?>
			<div class="top-bar-menu">
				<div class="top-menu-toggle">			
					<span><?php esc_html_e('MENU','excellent'); ?></span>
			  	</div>
				<?php wp_nav_menu($args); ?>
			</div><!-- end .top-bar-menu -->
			<?php } ?>
		</div><!-- end .wrap -->
	</div><!-- end .top-bar -->
	<!-- Top Header============================================= -->
	<div class="top-header">
		<div class="wrap">
			<?php do_action('excellent_site_branding'); //<!-- end .custom-logo-link -->
			$search_form = $excellent_settings['excellent_search_custom_header'];
			if (1 != $search_form) { ?>
				<div id="search-toggle" class="header-search"></div>
				<div id="search-box" class="clearfix">
					<?php get_search_form();?>
				</div>  <!-- end #search-box -->
			<?php } ?>
		</div>
	</div><!-- end .top-header -->
	<!-- Main Header============================================= -->
	<div id="sticky-header" class="clearfix">
		<div class="wrap">
			<div class="header-navigation-wrap">
			<?php
				if($excellent_settings['excellent_top_social_icons'] == 0):
					echo '<div class="header-social-block">';
						do_action('excellent_social_links');
					echo '</div>'.'<!-- end .header-social-block -->';
				endif; ?>
			<!-- Main Nav ============================================= -->
					<h3 class="nav-site-title">
						<a href="<?php echo esc_url(home_url('/'));?>" title="<?php echo esc_html(get_bloginfo('name', 'display'));?>"><?php bloginfo('name');?></a>
					</h3>
			<?php
				if (has_nav_menu('primary')) {
					$args = array(
					'theme_location' => 'primary',
					'container'      => '',
					'items_wrap'     => '<ul id="primary-menu" class="menu nav-menu">%3$s</ul>',
					); ?>
				<nav id="site-navigation" class="main-navigation clearfix">
					<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
						<span class="line-one"></span>
						<span class="line-two"></span>
						<span class="line-three"></span>
					</button><!-- end .menu-toggle -->
					<?php wp_nav_menu($args);//extract the content from apperance-> nav menu ?>
				</nav> <!-- end #site-navigation -->
				<?php } else {// extract the content from page menu only ?>
				<nav id="site-navigation" class="main-navigation clearfix">
					<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
						<span class="line-one"></span>
						<span class="line-two"></span>
						<span class="line-three"></span>
					</button><!-- end .menu-toggle -->
					<?php	wp_page_menu(array('menu_class' => 'menu', 'items_wrap'     => '<ul id="primary-menu" class="menu nav-menu">%3$s</ul>')); ?>
				</nav> <!-- end #site-navigation -->
				<?php } ?>
			</div> <!-- end .header-navigation-wrap -->
		</div> <!-- end .wrap -->
	</div><!-- end #sticky-header -->
	<!-- Main Slider ============================================= -->
	<?php
		$enable_slider = $excellent_settings['excellent_enable_slider'];
		if ($enable_slider=='frontpage'|| $enable_slider=='enitresite'){
			 if(is_front_page() && ($enable_slider=='frontpage') ) {
				if($excellent_settings['excellent_slider_type'] == 'default_slider') {
						excellent_category_sliders();
				}else{
					if(class_exists('Excellent_Plus_Features')):
						do_action('excellent_image_sliders');
					endif;
				}
			}
			if($enable_slider=='enitresite'){
				if($excellent_settings['excellent_slider_type'] == 'default_slider') {
						excellent_category_sliders();
				}else{
					if(class_exists('Excellent_Plus_Features')):
						do_action('excellent_image_sliders');
					endif;
				}
			}
		} ?>
</header> <!-- end #masthead -->
<?php
$excellent_display_page_single_featured_image = $excellent_settings['excellent_display_page_single_featured_image'];
if(is_single() || is_page()){
		if(has_post_thumbnail() && $excellent_display_page_single_featured_image == 0 ){?>
<!-- Single post and Page image ============================================= -->
		<div class="single-featured-image-header"><?php the_post_thumbnail(); ?></div>
		<?php }
} ?>
<!-- Main Page Start ============================================= -->
<div class="site-content-contain">
	<div id="content" class="site-content">
