<?php
/**
 * Template part for displaying single posts.
 *
 * @package Bloog Lite
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
        <?php
        $bloog_comment_post_numbers = get_theme_mod('comment_number_post_setting','1');    
        $bloog_comment_count = get_comments_number();   
        $bloog_slide_cat = get_the_category();?>
        <div class="bloog_post_title"><?php echo get_the_title(); ?></div>
        <span class="date_post"><?php echo get_the_date(); ?></span>
    </header><!-- .entry-header -->

    <div class="entry-content">
        <?php
        $bloog_img_src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'bloog-post-image-withsidebar', false ); 
        ?>
        <div class="bloog_img_wrap">
            <?php if(has_post_thumbnail()){ ?>
            <img src="<?php echo $bloog_img_src[0]; ?>" />
            <?php } ?>
            <?php if($bloog_slide_cat!=null){?>
            <a class="bloog_cat" href="<?php echo esc_url(get_category_link( $bloog_slide_cat[0]->term_id )); ?>"><?php echo $bloog_slide_cat[0]->name;?></a>
            <?php } ?>
            <div class="blog-comment-views">
                <?php if($bloog_comment_post_numbers == '1'){ ?>
                <p><span><?php echo esc_attr($bloog_comment_count); ?></span></p>
                <?php } ?>
            </div>
        </div>
        <div class="excerpt_post_content"><?php the_content(); ?></div>
    </div><!-- .entry-content -->

    <footer class="entry-footer">
        <?php 
        if( is_plugin_active( 'accesspress-social-share/accesspress-social-share.php' ) ) {
            echo do_shortcode('[apss-share networks="facebook, twitter, pinterest"]');
        }
        ?>
    </footer><!-- .entry-footer -->
</article><!-- #post-## -->

