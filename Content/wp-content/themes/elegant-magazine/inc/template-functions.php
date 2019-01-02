<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Elegant_Magazine
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function elegant_magazine_body_classes($classes)
{
    // Adds a class of hfeed to non-singular pages.
    if (!is_singular()) {
        $classes[] = 'hfeed';
    }

    global $post;

    $global_layout = elegant_magazine_get_option('global_content_alignment');
    $page_layout = $global_layout;
    $disable_class = '';
    $frontpage_content_status = elegant_magazine_get_option('frontpage_content_status');
    if (1 != $frontpage_content_status) {
        $disable_class = 'disable-default-home-content';
    }

    // Check if single.
    if ($post && is_singular()) {
        $post_options = get_post_meta($post->ID, 'elegant-magazine-meta-content-alignment', true);
        if (!empty($post_options)) {
            $page_layout = $post_options;
        } else {
            $page_layout = $global_layout;
        }
    }


    if (is_front_page() || is_home()) {
        $frontpage_layout = elegant_magazine_get_option('frontpage_content_alignment');

        if (!empty($frontpage_layout)) {
            $page_layout = $frontpage_layout;
        } else {
            $page_layout = $global_layout;
        }

    }

    if ($page_layout == 'align-content-right') {
        if (!is_active_sidebar('home-sidebar-widgets') || !is_active_sidebar('sidebar-1')) {
            $classes[] = 'full-width-content ' . $disable_class;
        } else {
            $classes[] = 'align-content-right ' . $disable_class;
        }
    } elseif ($page_layout == 'full-width-content') {
        $classes[] = 'full-width-content ' . $disable_class;
    } else {
        if (!is_active_sidebar('home-sidebar-widgets')) {
            if ((is_home() || is_front_page()) && !is_active_sidebar('sidebar-1')) {
                $classes[] = 'full-width-content ' . $disable_class;
            } else {
                $classes[] = 'align-content-left ' . $disable_class;
            }
        } else {
            if (!is_active_sidebar('sidebar-1')) {
                $classes[] = 'full-width-content ' . $disable_class;
            } else {
                $classes[] = 'align-content-left ' . $disable_class;
            }
        }

    }
    return $classes;


}
add_filter( 'body_class', 'elegant_magazine_body_classes' );




/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function elegant_magazine_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'elegant_magazine_pingback_header' );



if (!function_exists('elegant_magazine_get_block')) :
    /**
     *
     * @since Elegant Magazine 1.0.0
     *
     * @param null
     * @return null
     *
     */
    function elegant_magazine_get_block( $block = 'full' ) {

        get_template_part('inc/hooks/blocks/block-post', $block);

    }
endif;

if (!function_exists('elegant_magazine_archive_title')) :
    /**
     *
     * @since Elegant Magazine 1.0.0
     *
     * @param null
     * @return null
     *
     */

    function elegant_magazine_archive_title($title)
    {
        if (is_category()) {
            $title = single_cat_title('', false);
        } elseif (is_tag()) {
            $title = single_tag_title('', false);
        } elseif (is_author()) {
            $title = '<span class="vcard">' . get_the_author() . '</span>';
        } elseif (is_post_type_archive()) {
            $title = post_type_archive_title('', false);
        } elseif (is_tax()) {
            $title = single_term_title('', false);
        }

        return $title;
    }

    add_filter('get_the_archive_title', 'elegant_magazine_archive_title');
endif;

/* Display Breadcrumbs */
if ( ! function_exists( 'elegant_magazine_get_breadcrumb' ) ) :

    /**
     * Simple breadcrumb.
     *
     * @since 1.0.0
     */
    function elegant_magazine_get_breadcrumb() {

        $enable_breadcrumbs = elegant_magazine_get_option('enable_breadcrumb');
        if ( 1 != $enable_breadcrumbs ) {
            return;
        }
        // Bail if Home Page.
        if ( is_front_page() || is_home() ) {
            return;
        }


        if ( ! function_exists( 'breadcrumb_trail' ) ) {

            /**
             * Load libraries.
             */

            require_once  get_template_directory()  . '/lib/breadcrumbs/breadcrumbs.php';
        }

        $breadcrumb_args = array(
            'container'   => 'div',
            'show_browse' => false,
        ); ?>


        <div class="em-breadcrumbs font-family-1">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <?php breadcrumb_trail( $breadcrumb_args ); ?>
                    </div>
                </div>
            </div>
        </div>


   <?php }
    add_action('elegant_magazine_action_get_breadcrumb', 'elegant_magazine_get_breadcrumb');

endif;

/* Display Breadcrumbs */
if (!function_exists('elegant_magazine_excerpt_length')) :

    /**
     * Simple excerpt length.
     *
     * @since 1.0.0
     */

    function elegant_magazine_excerpt_length($length)
    {
       if(!is_admin()){

           return 15;
       }
    }

    add_filter('excerpt_length', 'elegant_magazine_excerpt_length', 999);
endif;


/* Display Breadcrumbs */
if (!function_exists('elegant_magazine_excerpt_more')) :

    /**
     * Simple excerpt more.
     *
     * @since 1.0.0
     */
    function elegant_magazine_excerpt_more($more)
    {
        if(!is_admin()){

            return '';
        }
    }

    add_filter('excerpt_more', 'elegant_magazine_excerpt_more');
endif;

// if (!is_admin()) {
//     function elegant_magazine_search_filter($query) {
//         if ($query->is_search) {
//             $query->set('post_type', 'post');
//         }
//         return $query;
//     }
//     add_filter('pre_get_posts','elegant_magazine_search_filter');
// }