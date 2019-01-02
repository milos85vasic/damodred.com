<?php
if (!function_exists('elegant_magazine_banner_advertisement')):
    /**
     * Ticker Slider
     *
     * @since Elegant Magazine 1.0.0
     *
     */
    function elegant_magazine_banner_advertisement() {

        if ( '' == elegant_magazine_get_option('banner_advertisement_section')) {
            return null;
        }
        $elegant_magazine_banner_advertisement    = elegant_magazine_get_option('banner_advertisement_section');
        $elegant_magazine_banner_advertisement    = absint($elegant_magazine_banner_advertisement);
        $elegant_magazine_banner_advertisement    = wp_get_attachment_image($elegant_magazine_banner_advertisement, 'full');
        $elegant_magazine_banner_advertisement_url = elegant_magazine_get_option('banner_advertisement_section_url');
        $elegant_magazine_banner_advertisement_url = isset($elegant_magazine_banner_advertisement_url) ? esc_url($elegant_magazine_banner_advertisement_url) : '#';



        ?>
        <div class="banner-promotions-wrapper">
            <div class="container">
                <a href="<?php echo esc_url($elegant_magazine_banner_advertisement_url); ?>" target="_blank">
                    <?php echo $elegant_magazine_banner_advertisement; ?>
                </a>
            </div>
        </div>
        <!-- Trending line END -->
        <?php
    }
endif;

add_action('elegant_magazine_action_banner_advertisement', 'elegant_magazine_banner_advertisement', 10);