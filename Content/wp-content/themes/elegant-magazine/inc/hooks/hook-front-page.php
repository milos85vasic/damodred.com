<?php
if ( ! function_exists( 'elegant_magazine_front_page_widgets_section' ) ) :
    /**
     *
     * @since Elegant Magazine 1.0.0
     *
     * @param null
     * @return null
     *
     */
    function elegant_magazine_front_page_widgets_section() {
        ?>
        <!-- Main Content section -->
        <?php

                $frontpage_layout = elegant_magazine_get_option('frontpage_content_alignment');

        ?>
        <?php if ( is_active_sidebar( 'home-content-widgets') || is_active_sidebar( 'home-sidebar-widgets') ) {  ?>
            <section class="section-block-upper">
                <div id="primary" class="content-area">
                    <main id="main" class="site-main">
                        <?php dynamic_sidebar('home-content-widgets'); ?>
                    </main>
                </div>
                <?php if (is_active_sidebar( 'home-sidebar-widgets') && $frontpage_layout != 'full-width-content' ) { ?>
                <div id="secondary" class="sidebar-area col-right col-sm-4">
                    <aside class="widget-area">
                        <div class="theiaStickySidebar">
                            <?php dynamic_sidebar('home-sidebar-widgets'); ?>
                        </div>
                    </aside>
                </div>
                <?php } ?>
            </section>
        <?php }
    }
endif;
add_action( 'elegant_magazine_front_page_section', 'elegant_magazine_front_page_widgets_section', 50 );