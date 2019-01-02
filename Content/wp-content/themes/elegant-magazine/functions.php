<?php
/**
 * Elegant Magazine functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Elegant_Magazine
 */

if (!function_exists('elegant_magazine_setup')):
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    /**
     *
     */
    /**
     *
     */
    function elegant_magazine_setup()
    {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on Elegant Magazine, use a find and replace
         * to change 'elegant-magazine' to the name of your theme in all the template files.
         */
        load_theme_textdomain('elegant-magazine', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');

        // Add featured image sizes
        add_image_size('elegant-magazine-featured', 1024, 0); // width, height, crop
        add_image_size('elegant-magazine-medium', 720, 380, true); // width, height, crop
        add_image_size('elegant-magazine-medium-small', 300, 200, true); // width, height, crop
        add_image_size('elegant-magazine-thumbnail-small', 50, 50, true); // width, height, crop


        /*
         * Enable support for Post Formats on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/post-formats/
         */
        add_theme_support('post-formats', array('image', 'video', 'gallery'));

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'em-primary-nav' => esc_html__('Primary Menu', 'elegant-magazine'),
            'em-top-nav' => esc_html__('Top Menu', 'elegant-magazine'),
            'em-social-nav' => esc_html__('Social Menu', 'elegant-magazine'),
            'em-footer-nav' => esc_html__('Footer Menu', 'elegant-magazine'),
        ));

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));

        // Set up the WordPress core custom background feature.
        add_theme_support('custom-background', apply_filters('elegant_magazine_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        )));

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support('custom-logo', array(
            'flex-width' => true,
            'flex-height' => true,
        ));


    }
endif;
add_action('after_setup_theme', 'elegant_magazine_setup');


/**
 * Demo export/import
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Elegant_Magazine
 */
if (!function_exists('elegant_magazine_ocdi_files')) :
    /**
     * OCDI files.
     *
     * @since 1.0.0
     *
     * @return array Files.
     */
    function elegant_magazine_ocdi_files()
    {

        return apply_filters( 'aft_demo_import_files', array(              
            array(
              'import_file_name'             => esc_html__( 'Elegant Magazine', 'elegant-magazine' ),   
              'local_import_file'            => trailingslashit( get_template_directory() ) . 'demo-content/default/elegant-magazine.xml',
              'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'demo-content/default/elegant-magazine.wie',
              'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'demo-content/default/elegant-magazine.dat',      
              'import_preview_image_url'     => trailingslashit( get_template_directory_uri() ) . 'demo-content/assets/elegant-magazine.jpg',    
              'preview_url'                  => 'https://demo.afthemes.com/elegant-magazine/',
            ),
            array(
              'import_file_name'             => esc_html__( 'Elegant Magazine - Newsportal', 'elegant-magazine' ),   
              'local_import_file'            => trailingslashit( get_template_directory() ) . 'demo-content/newsportal/elegant-magazine.xml',
              'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'demo-content/newsportal/elegant-magazine.wie',
              'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'demo-content/newsportal/elegant-magazine.dat',      
              'import_preview_image_url'     => trailingslashit( get_template_directory_uri() ) . 'demo-content/assets/elegant-magazine-newsportal.jpg',    
              'preview_url'                  => 'https://demo.afthemes.com/elegant-magazine/newsportal/',
            ),
            array(
              'import_file_name'             => esc_html__( 'Magazine 7 - Clean Blog', 'elegant-magazine' ),   
              'local_import_file'            => trailingslashit( get_template_directory() ) . 'demo-content/minimal/elegant-magazine.xml',
              'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'demo-content/minimal/elegant-magazine.wie',
              'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'demo-content/minimal/elegant-magazine.dat',      
              'import_preview_image_url'     => trailingslashit( get_template_directory_uri() ) . 'demo-content/assets/elegant-magazine-minimal.jpg',    
              'preview_url'                  => 'https://demo.afthemes.com/elegant-magazine/minimal/',
            ),
        ));
    }
endif;
add_filter('pt-ocdi/import_files', 'elegant_magazine_ocdi_files');


/**
 * function for google fonts
 */
if (!function_exists('elegant_magazine_fonts_url')):

    /**
     * Return fonts URL.
     *
     * @since 1.0.0
     * @return string Fonts URL.
     */
    function elegant_magazine_fonts_url()
    {

        $fonts_url = '';
        $fonts = array();
        $subsets = 'latin,latin-ext';

        /* translators: If there are characters in your language that are not supported by Oswald, translate this to 'off'. Do not translate into your own language. */
        if ('off' !== _x('on', 'Oswald font: on or off', 'elegant-magazine')) {
            $fonts[] = 'Oswald:300,400,700';
        }

        /* translators: If there are characters in your language that are not supported by Lato, translate this to 'off'. Do not translate into your own language. */
        if ('off' !== _x('on', 'Lato font: on or off', 'elegant-magazine')) {
            $fonts[] = 'Source+Sans+Pro:400,400i,700,700i';
        }

        if ($fonts) {
            $fonts_url = add_query_arg(array(
                'family' => urldecode(implode('|', $fonts)),
                'subset' => urldecode($subsets),
            ), 'https://fonts.googleapis.com/css');
        }
        return $fonts_url;
    }
endif;

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function elegant_magazine_content_width()
{
    $GLOBALS['content_width'] = apply_filters('elegant_magazine_content_width', 640);
}

add_action('after_setup_theme', 'elegant_magazine_content_width', 0);

/**
 * Load Init for Hook files.
 */
require get_template_directory() . '/inc/custom-style.php';

/**
 * Enqueue scripts and styles.
 */
function elegant_magazine_scripts()
{

    $min = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
    wp_enqueue_style('font-awesome-v5', get_template_directory_uri() . '/assets/font-awesome-v5/css/fontawesome-all' . $min . '.css');
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/bootstrap/css/bootstrap' . $min . '.css');
    wp_enqueue_style('slick', get_template_directory_uri() . '/assets/slick/css/slick' . $min . '.css');
    wp_enqueue_style('sidr', get_template_directory_uri() . '/assets/sidr/css/jquery.sidr.dark.css');

    $fonts_url = elegant_magazine_fonts_url();

    if (!empty($fonts_url)) {
        wp_enqueue_style('elegant-magazine-google-fonts', $fonts_url, array(), null);
    }
    wp_enqueue_style('elegant-magazine-style', get_stylesheet_uri());

    wp_add_inline_style('elegant-magazine-style', elegant_magazine_custom_style());

    wp_enqueue_script('elegant-magazine-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true);
    wp_enqueue_script('elegant-magazine-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true);

    wp_enqueue_script('slick', get_template_directory_uri() . '/assets/slick/js/slick' . $min . '.js', array('jquery'), '', true);
    wp_enqueue_script('bootstrap', get_template_directory_uri() . '/assets/bootstrap/js/bootstrap' . $min . '.js', array('jquery'), '', true);
    wp_enqueue_script('sidr', get_template_directory_uri() . '/assets/sidr/js/jquery.sidr' . $min . '.js', array('jquery'), '', true);
    wp_enqueue_script('matchheight', get_template_directory_uri() . '/assets/jquery-match-height/jquery.matchHeight' . $min . '.js', array('jquery'), '', true);
    wp_enqueue_script('marquee', get_template_directory_uri() . '/lib/marquee/jquery.marquee.js', array('jquery'), '', true);
    wp_enqueue_script('sticky-sidebar', get_template_directory_uri() . '/lib/theiaStickySidebar/theia-sticky-sidebar.min.js', array('jquery'), '', true);

    wp_enqueue_script('elegant-magazine-script', get_template_directory_uri() . '/assets/script.js', array('jquery'), '', 1);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}

add_action('wp_enqueue_scripts', 'elegant_magazine_scripts');


/**
 * Enqueue admin scripts and styles.
 *
 * @since Elegant Magazine 1.0.0
 */
function elegant_magazine__admin_scripts($hook)
{
    if ('widgets.php' === $hook) {
        wp_enqueue_media();
        wp_enqueue_script('elegant-magazine-widgets', get_template_directory_uri() . '/assets/widgets.js', array('jquery'), '1.0.0', true);
    }
}

add_action('admin_enqueue_scripts', 'elegant_magazine__admin_scripts');


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-images.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/init.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/ocdi.php';


/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
    require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
    require get_template_directory() . '/inc/woocommerce.php';
}




