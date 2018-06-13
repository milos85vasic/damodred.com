<?php
/**
 * The author archive template file.
 * @package StairWay
 * @since StairWay 1.0.0
*/
get_header(); ?>

<div id="wrapper-content">
<?php if ( have_posts() ) : ?>
<?php the_post(); ?>
  <div class="content-headline-wrapper">
    <div class="content-headline">
      <h1><?php printf( __( 'Author Archive: %s', 'stairway' ), '<span class="vcard">' . get_the_author() . '</span>' ); ?></h1>
<?php stairway_get_breadcrumb(); ?>
    </div>
  </div>
  <div class="container">
  <div id="main-content">
    <div id="content">
<?php rewind_posts(); ?>        
<?php if ( get_the_author_meta( 'description' ) ) : ?>
		<div class="author-info">
		<div class="author-description">
			<h2><?php printf( __( 'About %s', 'stairway' ), get_the_author() ); ?></h2>
      <div class="author-avatar">
			<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'stairway_author_bio_avatar_size', 60 ) ); ?>
		  </div>
			<p><?php the_author_meta( 'description' ); ?></p>
		</div>
		</div>
<?php endif; ?>
 
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