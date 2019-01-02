<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Elegant_Magazine
 */

get_header(); ?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main">

            <?php
            while (have_posts()) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <?php elegant_magazine_get_block('header') ?>
                    <div class="entry-content-wrap">
                        <?php
                        get_template_part('template-parts/content', get_post_type());


                        $show_related_posts = esc_attr(elegant_magazine_get_option('single_show_related_posts'));
                        if($show_related_posts):
                            if ('post' === get_post_type()) :
                                elegant_magazine_get_block('related');
                            endif;
                        endif;

                        the_post_navigation();

                        // If comments are open or we have at least one comment, load up the comment template.
                        if (comments_open() || get_comments_number()) :
                            comments_template();
                        endif;
                        ?>
                    </div>
                </article>
            <?php

            endwhile; // End of the loop.
            ?>

        </main><!-- #main -->
    </div><!-- #primary -->
<?php ?>
<?php
get_sidebar();
get_footer();
