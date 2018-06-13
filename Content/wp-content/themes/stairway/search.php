<?php
/**
 * The search results template file.
 * @package StairWay
 * @since StairWay 1.0.0
*/
get_header(); ?>

<div id="wrapper-content">
<?php if ( have_posts() ) : ?>
  <div class="content-headline-wrapper">
    <div class="content-headline">
      <h1><?php printf( __( 'Search Results for: %s', 'stairway' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
<?php stairway_get_breadcrumb(); ?>
    </div>
  </div>
  <div class="container">
  <div id="main-content">
    <div id="content"> 
<p class="number-of-results"><?php _e( '<strong>Number of Results</strong>: ', 'stairway' ); ?><?php echo $wp_query->found_posts; ?></p>
<?php while (have_posts()) : the_post(); ?>      
<?php get_template_part( 'content', 'archives' ); ?>
<?php endwhile; ?>

<?php if ( $wp_query->max_num_pages > 1 ) : ?>
		<div class="navigation" role="navigation">
			<h2 class="navigation-headline section-heading"><?php _e( 'Search results navigation', 'stairway' ); ?></h2>
      <div class="nav-wrapper">
        <p class="navigation-links">
<?php $big = 999999999;
echo paginate_links( array(
	'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
	'format' => '?paged=%#%',
	'current' => max( 1, get_query_var('paged') ),
  'prev_text' => __( '&larr; Previous', 'stairway' ),
	'next_text' => __( 'Next &rarr;', 'stairway' ),
	'total' => $wp_query->max_num_pages
) );
?>
        </p>
      </div>
		</div>
<?php endif; ?>

<?php else : ?>
  <div class="content-headline-wrapper">
    <div class="content-headline">
      <h1><?php _e( 'Nothing Found', 'stairway' ); ?></h1>
<?php stairway_get_breadcrumb(); ?>
    </div>
  </div>
  <div class="container">
  <div id="main-content">
    <div id="content">
    <p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'stairway' ); ?></p><?php get_search_form(); ?>
<?php endif; ?>
    </div> <!-- end of content -->
  </div>
<?php get_sidebar(); ?>
  </div>
</div>     <!-- end of wrapper-content -->
<?php get_footer(); ?>