<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package Bloog Lite
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function bloog_lite_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

    if (is_page('fullwidth-sidebar-home')|| is_page('full-width-sidebar-category-page')){
        $classes [] = 'fullwidth-sidebar-home';
    }
    
    if (is_page('gridview-home') || is_page('grid-view-category-page')){
        $classes [] = 'gridview-home';
    }
    
    if (is_page('fullwidth-home') || is_page('full-width-category-page')){
        $classes [] = 'fullwidth-home';
    }

    return $classes;
}
add_filter( 'body_class', 'bloog_lite_body_classes' );

// for hom page slider     
function bloog_lite_home_slider_cb(){
    for($i=1; $i<=6; $i++){
        $post_id = get_theme_mod("slider_$i");
        if(!empty($post_id)){
            $bloog_slider[] = $post_id;
        }
    }
    $bloog_slider_mode = get_theme_mod('slider_mode_setting', 'horizontal');
    $bloog_slider_speed = get_theme_mod('slider_speed_setting', '3500');
    $bloog_slider_autoslide_opt = get_theme_mod('auto_slide_setting', '0'); 
    $bloog_lite_pause_duration = get_theme_mod('home_slider_pause_setting', '3500');

    $bloog_comment_num_display = get_theme_mod('comment_number_slider_setting','1'); 
    $bloog_comment_count = get_comments_number();      
    ?>
    <script type="text/javascript">
        jQuery(document).ready(function ($){
            $("#medi_home_slider").bxSlider({
                pager: false,
                auto: <?php if(absint($bloog_slider_autoslide_opt) == 0){ echo 'true';}else{ echo 'false';} ?>,
                mode: "<?php echo esc_html($bloog_slider_mode); ?>",
                speed: <?php echo absint($bloog_slider_speed); ?>,
                pause: <?php echo absint($bloog_lite_pause_duration); ?>
            });
        });
    </script>
    <?php 
    if(!empty($bloog_slider)){
        $bloog_count = 1;
        echo '<ul id="medi_home_slider">';
        foreach($bloog_slider as $bloog_row){
            if( ($bloog_count == 1) || ($bloog_count%2 == 1)){
               echo '<li>';   
           }
           $bloog_slide_img = wp_get_attachment_image_src( get_post_thumbnail_id($bloog_row), 'bloog-homeslider-image-size', false ); 
           $bloog_slide_cat = get_the_category($bloog_row);
           ?>
           <div class="slider_conent">
             <?php if(has_post_thumbnail($bloog_row)){ ?>
             <a href="<?php echo esc_url(get_the_permalink($bloog_row)); ?>"><img src="<?php echo esc_url($bloog_slide_img[0]); ?>"/></a>
             <?php } ?>
             <div class="slider-caption-status">
                <?php if($bloog_comment_num_display == '1'){ ?>
                <p class="slider-caption-comment"><span><?php echo esc_attr($bloog_comment_count); ?></span><i class="fa fa-comments"></i></p>
                <?php } ?>
            </div>
            <div class="slider-caption-wrap">
                <div class="slider-caption-title"><a href="<?php echo esc_url(get_category_link( $bloog_slide_cat[0]->term_id )); ?>"><?php echo $bloog_slide_cat[0]->name; ?></a></div>
                <div class="slider_caption">
                    <span class="slider_title"><a href="<?php echo esc_url(get_the_permalink($bloog_row)); ?>"><?php echo get_the_title($bloog_row); ?></a></span>
                </div>
            </div>
        </div>
        <?php
        $bloog_count++;
        if( ($bloog_count%2 == 1) ){
           echo '</li>';   
       }
   }
   echo '</ul>';
}
}
add_action('bloog_lite_home_slider','bloog_lite_home_slider_cb',10);