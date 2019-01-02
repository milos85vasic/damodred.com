<?php
/**
* Template part for displaying posts.
*
* @link https://developer.wordpress.org/themes/basics/template-hierarchy/
*
* @package GalleryWP WordPress Theme
* @copyright Copyright (C) 2018 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*/
?>

<div id="post-<?php the_ID(); ?>" class="gallerywp-grid-post <?php echo esc_attr( gallerywp_post_grid_cols() ); ?>">
<div class="gallerywp-grid-post-inside">

    <?php if ( has_post_thumbnail() ) { ?>
    <?php if ( !(gallerywp_get_option('hide_thumbnail')) ) { ?>
    <div class="gallerywp-grid-post-thumbnail">
        <a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php /* translators: %s: post title. */ echo esc_attr( sprintf( __( 'Permanent Link to %s', 'gallerywp' ), the_title_attribute( 'echo=0' ) ) ); ?>"><?php the_post_thumbnail(gallerywp_grid_thumb_style(), array('class' => 'gallerywp-grid-post-thumbnail-img')); ?></a>
        <?php gallerywp_grid_postmeta(); ?>
    </div>
    <?php } else { ?>
    <div class="gallerywp-grid-post-thumbnail">
        <a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php /* translators: %s: post title. */ echo esc_attr( sprintf( __( 'Permanent Link to %s', 'gallerywp' ), the_title_attribute( 'echo=0' ) ) ); ?>"><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/no-image-4-4.jpg' ); ?>" class="gallerywp-grid-post-thumbnail-img"/></a>
        <?php gallerywp_grid_postmeta(); ?>
    </div>
    <?php } ?>
    <?php } else { ?>
    <div class="gallerywp-grid-post-thumbnail">
        <a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php /* translators: %s: post title. */ echo esc_attr( sprintf( __( 'Permanent Link to %s', 'gallerywp' ), the_title_attribute( 'echo=0' ) ) ); ?>"><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/no-image-4-4.jpg' ); ?>" class="gallerywp-grid-post-thumbnail-img"/></a>
        <?php gallerywp_grid_postmeta(); ?>
    </div>
    <?php } ?>

    <div class="gallerywp-grid-post-details">
    <?php if ( !(gallerywp_get_option('hide_post_categories_home')) ) { ?><?php gallerywp_grid_cats(); ?><?php } ?>

    <?php the_title( sprintf( '<h3 class="gallerywp-grid-post-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
    </div>

</div>
</div>