<?php
/**
 * The 404 page (Not Found) template file.
 * @package StairWay
 * @since StairWay 1.0.0
*/
get_header(); ?>

<div id="wrapper-content">
  <div class="content-headline-wrapper">
    <div class="content-headline">
      <h1><?php _e( 'Nothing Found', 'stairway' ); ?></h1>
<?php stairway_get_breadcrumb(); ?>
    </div>
  </div>
  <div class="container">
  <div id="main-content">
    <article id="content"> 
      <div class="entry-content">
        <p><?php _e( 'Apologies, but no results were found for your request. Perhaps searching will help you to find a related content.', 'stairway' ); ?></p><?php get_search_form(); ?>
      </div>
    </article> <!-- end of content -->
  </div>
<?php get_sidebar(); ?>
  </div>
</div>     <!-- end of wrapper-content -->
<?php get_footer(); ?>