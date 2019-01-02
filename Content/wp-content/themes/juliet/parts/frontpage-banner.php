
<?php
/**
 * Frontpage Banner
 *
 * @package juliet
 */
?>
<?php 

/*** Banner ***/ 

$header_image = get_header_image(); 
$juliet_banner_heading = juliet_get_option('juliet_banner_heading');
$juliet_banner_description = juliet_get_option('juliet_banner_description');
$juliet_banner_url = juliet_get_option('juliet_banner_url');
if($header_image != '') { 
?>
<!-- Frontpage Banner -->
<div class="container">
    <div class="frontpage-banner">
        <img src="<?php echo esc_url($header_image) ?>" alt="<?php echo esc_attr($juliet_banner_heading); ?>" class="img-responsive" />
		
		<?php if($juliet_banner_heading != '' || $juliet_banner_description != '') { ?>
        <div class="caption">
            
            <?php if($juliet_banner_url != '' && $juliet_banner_heading != '') { ?><h2><a href="<?php echo esc_url($juliet_banner_url); ?>"><?php echo esc_html($juliet_banner_heading); ?></a></h2><?php } ?>
        
            <?php if($juliet_banner_url == '' && $juliet_banner_heading != '') { ?><h2><?php echo esc_html($juliet_banner_heading); ?></h2><?php } ?>
            
            <?php if($juliet_banner_description != '') { ?><p class="description"><?php echo wp_kses_post($juliet_banner_description); ?></p><?php } ?>
            
        </div>
		<?php } ?>
    </div>
</div>
<!-- /Frontpage Banner -->
<?php  } ?>