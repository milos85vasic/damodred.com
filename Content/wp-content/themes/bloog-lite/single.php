<?php
/**
 * The template for displaying all single posts.
 *
 * @package Bloog Lite
 */

get_header(); ?>
<?php            
global $post;
$bloog_layout_home = get_theme_mod('single_page_layout_setting','fullwidth-single-page');
if($bloog_layout_home == 'fullwidth-single-page'){
    $bloog_layout_home = 'fullwidth-home';
}else{
    $bloog_layout_home = 'fullwidth-sidebar-home';
}
?>
<div class="bloog-wrapper">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

            <?php
            if(have_posts()){
                while(have_posts()){
                    the_post();
                    get_template_part( 'template-parts/content', 'single' );
                }

                ?>
                <div class="home_pagination_link">
                    <?php                    
                    the_post_navigation();                   
                    ?>
                </div>
                <?php
            				// If comments are open or we have at least one comment, load up the comment template
                if ( comments_open() || get_comments_number() ) :
                 comments_template();
             endif;
             ?>
             <?php
         } ?>

     </main><!-- #main -->
 </div><!-- #primary -->
 <?php if( $bloog_layout_home == 'fullwidth-sidebar-home'){ 
    get_sidebar();
} ?>
</div> <!-- end of bloog-wrapper -->

<?php get_footer(); ?>
