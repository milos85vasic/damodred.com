<?php
/**
 * The template used for displaying latest post in full width in home page
 *
 * @package Bloog Lite
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
        <?php
        $bloog_comment_post_numbers = get_theme_mod('comment_number_post_setting','1');    
        $bloog_comment_count = get_comments_number();
        ?>
        <?php $bloog_slide_cat = get_the_category();?>
        <a class="bloog_post_title" href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a>
        <span class="date_post"><?php echo get_the_date(); ?></span>        
    </header><!-- .entry-header -->

    <div class="entry-content">
        <?php
        $bloog_img_src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'bloog-homeslider-image-size', true ); 
        ?>
        <div class="bloog_img_wrap">
            <a href="<?php the_permalink(); ?>"><img src="<?php echo $bloog_img_src[0]; ?>" /></a>
            <a class="bloog_cat" href="<?php echo esc_url(get_category_link( $bloog_slide_cat[0]->term_id )); ?>"><?php echo $bloog_slide_cat[0]->name;?></a>
            <div class="blog-comment-views">
                <?php if($bloog_comment_post_numbers == '1'){ ?>
                <p><span><?php echo esc_attr($bloog_comment_count); ?></span></p>
                <?php } ?>
            </div>
        </div>
        <div class="excerpt_post_content"><?php
           echo wp_trim_words(get_the_content(),76,'...'); ?></div>
           <a class="continue_link" href="<?php the_permalink(); ?>"><?php esc_html_e('Read More','bloog-lite');?></a>
           <footer class="entry-footer">
            <span class="share_this_home"><?php esc_html_e('Share This','bloog-lite');?></span>
            <?php 
            if( is_plugin_active( 'accesspress-social-share/accesspress-social-share.php' ) ) {
                echo do_shortcode('[apss-share networks="facebook, twitter, pinterest"]');
            }
            ?>
        </footer><!-- .entry-footer -->
    </div><!-- .entry-content -->

    
</article><!-- #post-## -->