<?php
/**
 * Template Name: Page without Comments
 * The template file for pages without the comments section.
 * @package StairWay
 * @since StairWay 1.0.3
*/
get_header(); ?>

<div id="wrapper-content">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
  <div class="content-headline-wrapper">
    <div class="content-headline">
      <h1><?php the_title(); ?></h1>
<?php stairway_get_breadcrumb(); ?>
    </div>
  </div>
  <div class="container">
  <div id="main-content">
    <article id="content">
      <div class="post-thumbnail"><?php stairway_get_display_image_page(); ?></div> 
      <div class="entry-content">
<?php the_content(); ?>
<?php edit_post_link( __( '(Edit)', 'stairway' ), '<p>', '</p>' ); ?>
      </div>
<?php endwhile; endif; ?>
    </article> <!-- end of content -->
  </div>
<?php get_sidebar(); ?>
  </div>
</div>     <!-- end of wrapper-content -->
<?php get_footer(); ?>