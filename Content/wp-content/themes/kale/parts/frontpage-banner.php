<?php
/**
 * Frontpage Banner, Slider
 *
 * @package kale
 */
?>
<!-- Frontpage Banner / Slider -->

<?php 
$kale_frontpage_banner = kale_get_option('kale_frontpage_banner'); 
$kale_example_content = kale_get_option('kale_example_content'); 
$kale_frontpage_banner_link_images = kale_get_option('kale_frontpage_banner_link_images');
?>

<?php 

$force_banner = false;

/*** Posts Slider ***/ 

if ($kale_frontpage_banner == 'Posts') { 
    $kale_frontpage_posts_slider_category = kale_get_option('kale_frontpage_posts_slider_category');
    $kale_frontpage_posts_slider_number = kale_get_option('kale_frontpage_posts_slider_number');
    $args = array( 'posts_per_page' => $kale_frontpage_posts_slider_number, 'category' => $kale_frontpage_posts_slider_category );
    $kale_posts_slider = get_posts( $args ); 
    $n = count($kale_posts_slider);
    if($n > 2) { #owl carousel limitation?
    ?>
    <div class="frontpage-slider frontpage-posts-slider">
        <div class="owl-carousel">
        <?php foreach ( $kale_posts_slider as $post ) { 
            setup_postdata( $post );  
            $src = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'kale-slider' ) ;
			$featured_image = '';
            if($src) $featured_image = $src[0]; 
            else if($kale_example_content == 1) $featured_image = kale_get_sample('slide'); 
            if($featured_image) { ?>
            <div class="owl-carousel-item">
			
				<?php if($kale_frontpage_banner_link_images == 0) { ?>
					<img src="<?php echo esc_url($featured_image) ?>" alt="<?php the_title_attribute(); ?>" />
					<div class="caption">
						<p class="date"><?php echo get_the_date(); ?></p>
						<h2><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
						<p class="read-more"><a href="<?php the_permalink(); ?>"><?php printf( _nx( '1 Comment', '%1$s Comments', get_comments_number(), 'comments title', 'kale' ), number_format_i18n( get_comments_number() ) ); ?></a></p>
					</div>
				<?php } else { ?>
					<a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url($featured_image) ?>" alt="<?php the_title_attribute(); ?>" /></a>
				<?php } ?>
            </div>
            <?php }
        } wp_reset_postdata(); ?>
        </div>
    </div>
<?php 
    } else { $force_banner = true; }
}

/*** Banner ***/ 

if($kale_frontpage_banner == 'Banner' || $force_banner) { 
    $header_image = get_header_image(); 
    $kale_banner_heading = kale_get_option('kale_banner_heading');
    $kale_banner_description = kale_get_option('kale_banner_description');
    $kale_banner_url = kale_get_option('kale_banner_url');
    if($header_image != '') { 
?>
    <div class="frontpage-banner">
        
        <?php if($kale_frontpage_banner_link_images == 0) { ?>
            <img src="<?php echo $header_image ?>" alt="<?php echo esc_attr($kale_banner_heading); ?>" />
            <div class="caption">
                <?php if($kale_banner_url != '' && $kale_banner_heading != '') { ?>
                <h2><a href="<?php echo esc_url($kale_banner_url); ?>"><?php echo esc_html($kale_banner_heading); ?></a></h2>
                <?php } ?>
                <?php if($kale_banner_url == '' && $kale_banner_heading != '') { ?>
                <h2><?php echo esc_html($kale_banner_heading); ?></h2>
                <?php } ?>
                <?php if($kale_banner_description != '') { ?>
                <p class="read-more"><?php echo esc_html($kale_banner_description); ?></p>
                <?php } ?>
            </div>
        <?php } else { ?>
            <?php if($kale_banner_url != '') { ?><a href="<?php echo esc_url($kale_banner_url); ?>"><?php } ?>
            <img src="<?php echo $header_image ?>" alt="<?php echo esc_attr($kale_banner_heading); ?>" />
            <?php if($kale_banner_url != '') { ?></a><?php } ?>
        <?php } ?>
        
    </div>
<?php 
    }
} 
?>

<!-- /Frontpage Banner / Slider -->