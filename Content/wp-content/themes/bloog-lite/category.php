<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Bloog Lite
 */

get_header(); ?>

<div class="bloog-wrapper">
 <div id="primary" class="content-area">
  <main id="main" class="site-main" role="main">
    
    <?php
    global $post;
    $bloog_layout_home = get_theme_mod('categorypage_layout_setting','fullwidth-category-page');
    if($bloog_layout_home == 'fullwidth-category-page'){
        $bloog_layout_home = 'fullwidth-home';
    }elseif( $bloog_layout_home == 'gridview-category-page'){
        $bloog_layout_home = 'gridview-home';
    }else{
        $bloog_layout_home = 'fullwidth-sidebar-home';
    }
    $bloog_layout_homearr_category = '';
    for($i=1; $i<=4; $i++){
        $bloog_layout_homecat_home = get_theme_mod('home_post_display_cat_'.$i);
    }
    ?>
    <?php
    if(have_posts()){
        while(have_posts()){
            the_post();
            get_template_part( 'template-parts/content', $bloog_layout_home );
        }
        ?>
        <div class="home_pagination_link">
            <?php
            next_posts_link('Older Entries', $post->max_num_pages );
            previous_posts_link('Newer Entries');
            ?>
        </div>
        <?php
    } 
    ?>
</main><!-- #main -->
</div><!-- #primary -->
<?php if( $bloog_layout_home == 'fullwidth-sidebar-home'){ 
    get_sidebar();
} ?>
</div> <!-- end of bloog-wrapper -->
<?php get_footer(); ?>
