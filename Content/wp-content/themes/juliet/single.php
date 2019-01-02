<?php
/**
 * The template for displaying posts
 *
 * @package juliet
 */
?>
<?php get_header(); ?>

<?php
$juliet_posts_meta_show = juliet_get_option('juliet_posts_meta_show');
$juliet_posts_date_show = juliet_get_option('juliet_posts_date_show');
$juliet_posts_category_show = juliet_get_option('juliet_posts_category_show');
$juliet_posts_author_show = juliet_get_option('juliet_posts_author_show');
$juliet_posts_tags_show = juliet_get_option('juliet_posts_tags_show');
$juliet_posts_sidebar = juliet_get_option('juliet_posts_sidebar');
$juliet_posts_featured_image_show = juliet_get_option('juliet_posts_featured_image_show');
?>

<?php if($juliet_posts_sidebar == 1) { ?><div class="row two-columns"><div class="main-column col-md-9"><?php } 
else { ?><div class="row one-column"><div class="main-column col-md-12"><?php } ?>
    
        <?php while ( have_posts() ) : the_post(); ?>
        
        <!-- Post Content -->
        <div id="post-<?php the_ID(); ?>" <?php post_class('entry entry-post'); ?>>
            
            <div class="entry-header">
				
            
                <?php if($juliet_posts_meta_show == 1 && $juliet_posts_category_show == 1) { ?>
                <div class="entry-meta">
                    <div class="entry-category"><?php the_category( ' ~ ' ); ?></div>
                </div>
                <?php } ?>
                    
                <?php $title = get_the_title(); ?>
                <?php if($title == '') { ?>
                <h1 class="entry-title"><?php esc_html_e('Post ID: ', 'juliet'); the_ID(); ?></h1>
                <?php } else { ?>
                <h1 class="entry-title"><?php the_title(); ?></h1>
                <?php } ?>
                
                <?php if($juliet_posts_meta_show == 1 && ($juliet_posts_author_show == 1 || $juliet_posts_date_show == 1) ) { ?>
                <div class="entry-meta">
                    <?php 
                    $juliet_temp = array();
                    if($juliet_posts_author_show == 1)  $juliet_temp[] = '<div class="entry-author"><span class="vcard author author_name"><span class="fn">' . esc_html_e('by ', 'juliet') . get_the_author() . '</span></span></div>';
                    if($juliet_posts_date_show == 1)    $juliet_temp[] = '<div class="entry-date date updated">' . get_the_date() . '</div>';
                    if($juliet_temp) $juliet_str = implode('<span class="sep"> - </span>', $juliet_temp);
                    echo $juliet_str;
                    ?>
                </div>
                <?php } ?>

                <div class="clearfix"></div>
            </div>
            
            <?php 
            if($juliet_posts_featured_image_show == 1) { 
                if(has_post_thumbnail()) { ?>
                <div class="entry-thumb"><?php the_post_thumbnail( 'full', array( 'alt' => get_the_title(), 'class'=>'img-responsive' ) ); ?></div><?php } 
            } ?>
            
            <div class="entry-content">
            <div class="single-content">
                <?php the_content(); ?>
				<?php wp_link_pages(); ?>
            </div>
            </div>
            
            <?php if ( $juliet_posts_meta_show == 1 && $juliet_posts_tags_show == 1 && has_tag() ) { ?>
            <div class="entry-footer">
                <div class="entry-meta">
                    <div class="entry-tags"><?php the_tags('',''); ?></div>
                </div>
            </div>
            <?php } ?>
        
        </div>
        <!-- /Post Content -->
                
        <hr />
        
        <div class="pagination-post">
            <div class="previous_post"><?php previous_post_link('%link','%title'); ?></div>
            <div class="next_post"><?php next_post_link('%link','%title'); ?></div>
        </div>
        
        <!-- Post Comments -->
        <?php if ( comments_open() ) : ?>
        <hr />
        <?php comments_template(); ?>
        <?php endif; ?>  
        <!-- /Post Comments -->
        
    </div>
    <!-- /Main Column -->
    
    
    <?php if($juliet_posts_sidebar == 1)  get_sidebar();  ?>
    
</div>
<!-- /Two Columns -->
        
<?php endwhile; ?>

<?php get_footer(); ?>