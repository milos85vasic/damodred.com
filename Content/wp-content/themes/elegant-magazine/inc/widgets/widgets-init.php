<?php

// Load widget base.
require_once get_template_directory() . '/inc/widgets/widgets-base.php';

/* Theme Widget sidebars. */
require get_template_directory() . '/inc/widgets/widgets-register-sidebars.php';

/* Theme Widget sidebars. */
require get_template_directory() . '/inc/widgets/widgets-common-functions.php';

/* Theme Widgets*/
require get_template_directory() . '/inc/widgets/widget-posts-slider.php';
require get_template_directory() . '/inc/widgets/widget-posts-carousel.php';
require get_template_directory() . '/inc/widgets/widget-posts-single-column.php';
require get_template_directory() . '/inc/widgets/widget-posts-double-column.php';
require get_template_directory() . '/inc/widgets/widget-posts-double-column-double-categories.php';
require get_template_directory() . '/inc/widgets/widget-posts-express-column.php';
require get_template_directory() . '/inc/widgets/widget-posts-tabbed.php';
require get_template_directory() . '/inc/widgets/widget-social-contacts.php';
require get_template_directory() . '/inc/widgets/widget-author-info.php';


/* Register site widgets */
if ( ! function_exists( 'elegant_magazine_widgets' ) ) :
    /**
     * Load widgets.
     *
     * @since 1.0.0
     */
    function elegant_magazine_widgets() {
        register_widget( 'Elegant_Magazine_Posts_Slider' );
        register_widget( 'Elegant_Magazine_Posts_Carousel' );
        register_widget( 'Elegant_Magazine_Single_Col_Categorised_Posts' );
        register_widget( 'Elegant_Magazine_Double_Col_Categorised_Posts' );
        register_widget( 'Elegant_Magazine_Double_Col_Double_Categorised_Posts' );
        register_widget( 'Elegant_Magazine_Express_Col_Categorised_Posts' );
        register_widget( 'Elegant_Magazine_Tabbed_Posts' );
        register_widget( 'Elegant_Magazine_Social_Contacts' );
        register_widget( 'Elegant_Magazine_author_info' );

    }
endif;
add_action( 'widgets_init', 'elegant_magazine_widgets' );
