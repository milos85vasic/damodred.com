<?php
/**
 * The template for displaying pages
 *
 * @package juliet
 */
?>
<?php get_header(); ?>

<?php 
$juliet_pages_sidebar = juliet_get_option('juliet_pages_sidebar'); 
$juliet_pages_featured_image_show = juliet_get_option('juliet_pages_featured_image_show');
?>

<?php if($juliet_pages_sidebar == 1) { ?><div class="row two-columns"><div class="main-column col-md-9"><?php } 
else { ?><div class="row one-column"><div class="main-column col-md-12"><?php } ?>
    
        <?php while ( have_posts() ) : the_post(); ?>
        
        <!-- Page Content -->
        <div id="page-<?php the_ID(); ?>" <?php post_class('entry entry-page'); ?>>
        
            <?php $title = get_the_title(); ?>
            <?php if($title == '') { ?>
            <h1 class="entry-title"><?php esc_html_e('Page ID: ', 'juliet'); the_ID(); ?></h1>
            <?php } else { ?>
            <h1 class="entry-title"><?php the_title(); ?></h1>
            <?php } ?>
            
			<?php 
            if($juliet_pages_featured_image_show == 1) { 
                if(has_post_thumbnail()) { ?>
                <div class="entry-thumb"><?php the_post_thumbnail( 'full', array( 'alt' => get_the_title(), 'class'=>'img-responsive' ) ); ?></div><?php } 
            } ?>
			
            <div class="entry-content"><div class="page-content"><?php the_content(); ?></div></div>
        
        </div>
        <!-- /Page Content -->
        
        <!-- Page Comments -->
        <?php if ( comments_open() ) : ?>
        <hr />
        <?php comments_template(); ?>
        <?php endif; ?>  
        <!-- /Page Comments -->  
        
    </div>
    <!-- /Main Column -->

    <?php if($juliet_pages_sidebar == 1)  get_sidebar();  ?>

</div>
<!-- /One or Two Columns -->

<?php endwhile; ?>

<?php get_footer(); ?>