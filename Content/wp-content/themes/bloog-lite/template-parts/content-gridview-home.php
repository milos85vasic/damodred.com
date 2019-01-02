<?php
/**
 * The template used for displaying latest post in full width in home page
 *
 * @package Bloog Lite
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
        <?php $bloog_slide_cat = get_the_category();?>
        <?php $bloog_img_src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'bloog-post-image-withsidebar', false ); ?>
        <div class="bloog_img_wrap">
            <a href="<?php the_permalink(); ?>"><img src="<?php echo $bloog_img_src[0]; ?>" /></a>
            <a class="bloog_cat" href="<?php echo esc_url(get_category_link( $bloog_slide_cat[0]->term_id )); ?>"><?php echo $bloog_slide_cat[0]->name;?></a>
		</div>
        <a class="bloog_post_title" href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a>
        <div class="excerpt_post_content"><?php
         echo wp_trim_words(get_the_content(),76,'...'); ?></div>
        <span class="date_post"><?php echo get_the_date(); ?></span>
    </header><!-- .entry-header -->

</article><!-- #post-## -->