<?php
/**
 * The tag archive template file.
 * @package StairWay
 * @since StairWay 1.0.0
*/
get_header(); ?>

<div id="wrapper-content">
<?php if ( have_posts() ) : ?>
  <div class="content-headline-wrapper">
    <div class="content-headline">
      <h1><?php printf( __( 'Tag Archive: %s', 'stairway' ), '<span>' . single_tag_title( '', false ) . '</span>' ); ?></h1>
<?php stairway_get_breadcrumb(); ?>
    </div>
  </div>
  <div class="container">
  <div id="main-content">
    <div id="content"> 
<?php if ( tag_description() ) : ?><div class="archive-meta"><?php echo tag_description(); ?></div><?php endif; ?>
<?php while (have_posts()) : the_post(); ?>      
<?php get_template_part( 'content', 'archives' ); ?>
<?php endwhile; endif; ?>
<?php stairway_content_nav( 'nav-below' ); ?>
    </div> <!-- end of content -->
  </div>
<?php get_sidebar(); ?>
  </div>
</div>     <!-- end of wrapper-content -->
<?php get_footer(); ?>