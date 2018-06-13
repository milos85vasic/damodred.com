<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Envy Blog
 */

get_header();
?>

    <div class="row <?php echo esc_attr( 'has-' . envy_blog_layout_class() ); ?>">
        <div id="primary" class="content-area <?php echo esc_attr( 'has-' . envy_blog_layout_class() ); ?>">
            <main id="main" class="site-main">

                <?php
                if ( have_posts() ) :

                    if ( is_home() && ! is_front_page() ) : ?>
                        <header>
                            <h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
                        </header>

                        <?php
                    endif;

                    /* Start the Loop */
                    while ( have_posts() ) : the_post();

                        /*
                         * Include the Post-Format-specific template for the content.
                         * If you want to override this in a child theme, then include a file
                         * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                         */
                        get_template_part( 'template-parts/content', get_post_format() );

                    endwhile;

                    // Pagination
                    get_template_part( 'layouts/pagination/pagination', get_post_format() );

                else :

                    get_template_part( 'template-parts/content', 'none' );

                endif; ?>

            </main><!-- #main -->
        </div><!-- #primary -->

        <?php get_sidebar(); ?>

    </div><!-- .row -->

<?php
get_footer();
