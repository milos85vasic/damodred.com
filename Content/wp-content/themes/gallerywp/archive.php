<?php
/**
* The template for displaying archive pages.
*
* @link https://developer.wordpress.org/themes/basics/template-hierarchy/
*
* @package GalleryWP WordPress Theme
* @copyright Copyright (C) 2018 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*/

get_header(); ?>

<div class="gallerywp-main-wrapper clearfix" id="gallerywp-main-wrapper" itemscope="itemscope" itemtype="http://schema.org/Blog" role="main">
<div class="theiaStickySidebar">
<div class="gallerywp-main-wrapper-inside clearfix">

<?php gallerywp_top_widgets(); ?>

<div class="gallerywp-posts-wrapper" id="gallerywp-posts-wrapper">

<div class="gallerywp-posts">

<header class="page-header">
<?php the_archive_title( '<h1 class="page-title">', '</h1>' ); ?>
<?php the_archive_description( '<div class="taxonomy-description">', '</div>' ); ?>
</header>

<div class="gallerywp-posts-content">

<?php if (have_posts()) : ?>

    <div class="gallerywp-posts-container">
    <?php $gallerywp_total_posts = $wp_query->post_count; ?>
    <?php $gallerywp_post_counter=1; while (have_posts()) : the_post(); ?>

        <?php get_template_part( 'template-parts/content', gallerywp_post_style() ); ?>

    <?php $gallerywp_post_counter++; endwhile; ?>
    </div>
    <div class="clear"></div>

    <?php gallerywp_posts_navigation(); ?>

<?php else : ?>

  <?php get_template_part( 'template-parts/content', 'none' ); ?>

<?php endif; ?>

</div>
</div>

</div><!--/#gallerywp-posts-wrapper -->

<?php gallerywp_bottom_widgets(); ?>

</div>
</div>
</div><!-- /#gallerywp-main-wrapper -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>