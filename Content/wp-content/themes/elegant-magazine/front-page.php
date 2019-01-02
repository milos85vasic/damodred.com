<?php
/**
 * The template for displaying home page.
 * @package Elegant_Magazine
 */

get_header();
if ( 'posts' == get_option( 'show_on_front' ) ) {
    include( get_home_template() );
} else {

    /**
     * elegant_magazine_action_sidebar_section hook
     * @since Elegant Magazine 1.0.0
     *
     * @hooked elegant_magazine_front_page_section -  20
     * @sub_hooked elegant_magazine_front_page_section -  20
     */
    do_action('elegant_magazine_front_page_section');


    if (elegant_magazine_get_option('frontpage_content_status') == 1) {
        ?>
        <section class="section-block recent-blog">
            <div class="primary-1">
                <?php
                while ( have_posts() ) : the_post();
                    the_title('<h2 class="widget-title">', '</h2>');
                    get_template_part( 'template-parts/content', 'page' );

                endwhile; // End of the loop.
                ?>
            </div><!-- #primary -->

            <?php   get_sidebar();   ?>

        </section>
    <?php }
}
get_footer();