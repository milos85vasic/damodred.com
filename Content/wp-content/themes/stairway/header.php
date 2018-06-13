<?php
/**
 * The header template file.
 * @package StairWay
 * @since StairWay 1.0.0
*/
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<?php global $stairway_options_db; ?>
  <meta charset="<?php bloginfo( 'charset' ); ?>" /> 
  <meta name="viewport" content="width=device-width" />  
  <title><?php wp_title( '|', true, 'right' ); ?></title>  
  <!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->
<?php if ($stairway_options_db['stairway_favicon_url'] != ''){ ?>
	<link rel="shortcut icon" href="<?php echo esc_url($stairway_options_db['stairway_favicon_url']); ?>" />
<?php } ?>
<?php wp_head(); ?>  
</head>
 
<body <?php body_class(); ?> id="wrapper"> 
<header id="wrapper-header">
<?php if ( !is_page_template('template-landing-page.php') ) { ?>
<?php if ( has_nav_menu( 'top-navigation' ) || $stairway_options_db['stairway_header_facebook_link'] != '' || $stairway_options_db['stairway_header_twitter_link'] != '' || $stairway_options_db['stairway_header_google_link'] != '' || $stairway_options_db['stairway_header_rss_link'] != '' ) {  ?>
  <div class="top-navigation-wrapper">
    <div class="top-navigation">
<?php if ( has_nav_menu( 'top-navigation' ) ) { wp_nav_menu( array( 'menu_id'=>'top-nav', 'theme_location'=>'top-navigation' ) ); } ?>
      
      <div class="header-icons">
<?php if ($stairway_options_db['stairway_header_facebook_link'] != ''){ ?>
        <a class="social-icon facebook-icon" href="<?php echo esc_url($stairway_options_db['stairway_header_facebook_link']); ?>"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/icon-facebook.png" alt="Facebook" /></a>
<?php } ?>
<?php if ($stairway_options_db['stairway_header_twitter_link'] != ''){ ?>
        <a class="social-icon twitter-icon" href="<?php echo esc_url($stairway_options_db['stairway_header_twitter_link']); ?>"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/icon-twitter.png" alt="Twitter" /></a>
<?php } ?>
<?php if ($stairway_options_db['stairway_header_google_link'] != ''){ ?>
        <a class="social-icon google-icon" href="<?php echo esc_url($stairway_options_db['stairway_header_google_link']); ?>"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/icon-google.png" alt="Google +" /></a>
<?php } ?>
<?php if ($stairway_options_db['stairway_header_rss_link'] != ''){ ?>
        <a class="social-icon rss-icon" href="<?php echo esc_url($stairway_options_db['stairway_header_rss_link']); ?>"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/icon-rss.png" alt="RSS" /></a>
<?php } ?>
      </div>
    </div>
  </div>
<?php }} ?>
  
  <div class="header-content-wrapper">
    <div class="header-content">
      <div class="title-box">
<?php if ( $stairway_options_db['stairway_logo_url'] == '' ) { ?>
        <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></p>
<?php } else { ?>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img class="header-logo" src="<?php echo esc_url($stairway_options_db['stairway_logo_url']); ?>" alt="<?php bloginfo( 'name' ); ?>" /></a>
<?php } ?>
      </div>
<?php if ( !is_page_template('template-landing-page.php') ) { ?>
      <div class="menu-box">
<?php if ( has_nav_menu( 'main-navigation' ) ) { wp_nav_menu( array( 'menu_id'=>'nav', 'theme_location'=>'main-navigation' ) ); } ?>
      </div>
<?php } ?>
    </div>
  </div>
<?php if ( is_home() || is_front_page() ) { ?>
  <div class="header-image">
    <div class="header-image-text-wrapper">
      <div class="header-image-text">
<?php if ( $stairway_options_db['stairway_header_image_headline'] != '' ) { ?>
        <p class="header-image-headline"><?php echo esc_attr($stairway_options_db['stairway_header_image_headline']); ?></p>
<?php } if ( $stairway_options_db['stairway_header_image_link_url'] != '' || $stairway_options_db['stairway_header_image_link_text'] != '' ) { ?>
        <p class="header-image-link-wrapper"><a class="header-image-link" href="<?php echo esc_url($stairway_options_db['stairway_header_image_link_url']); ?>"><?php echo esc_attr($stairway_options_db['stairway_header_image_link_text']); ?></a></p>
<?php } ?>
      </div>
    </div>
  </div>
<?php } elseif ( $stairway_options_db['stairway_display_header_image'] == 'Everywhere' ) { ?>
  <div class="header-image">
  </div>
<?php } ?>
<?php if ( is_home() && $stairway_options_db['stairway_display_site_description'] != 'Hide' ) { ?>  
  <div class="header-description-wrapper">
    <div class="header-description">
      <h1><?php bloginfo( 'description' ); ?></h1>
    </div>
  </div>
<?php } ?>
</header> <!-- end of wrapper-header -->