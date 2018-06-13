<?php
/**
 * Template Name: About Page
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Bloog Lite
 */

get_header(); ?>

<div class="bloog-wrapper">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
      <?php
      global $post;
      $bloog_layout_home = get_theme_mod('single_page_layout_setting','fullwidth-single-page');
      if($bloog_layout_home == 'fullwidth-single-page'){
        $bloog_layout_home = 'fullwidth-home';
      }else{
        $bloog_layout_home = 'fullwidth-sidebar-home';
      }
      ?>
      <?php
      if(have_posts()){
        while(have_posts()){
          the_post();
          get_template_part( 'template-parts/content', 'about' );
        }
        ?>
        <div class="home_pagination_link">
          <?php
          next_posts_link('Older Entries', $post->max_num_pages );
          previous_posts_link('Newer Entries');
          ?>
        </div>
        <?php
      } ?>
      
    </main><!-- #main -->
  </div><!-- #primary -->
</div> <!-- end of bloog-wrapper -->
<?php get_footer();