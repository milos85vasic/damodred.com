<?php
if (!function_exists('elegant_magazine_ticker_news')):
    /**
     * Ticker Slider
     *
     * @since Elegant Magazine 1.0.0
     *
     */
    function elegant_magazine_ticker_news() {
        if (1 != elegant_magazine_get_option('show_ticker_news_section')) {
            return null;
        }
        $em_ticker_news_title    = elegant_magazine_get_option('ticker_section_title');
        $em_ticker_news_category = elegant_magazine_get_option('select_ticker_news_category');
        $em_number_of_ticker_news   = 3;
        ?>
        <div class="trending-posts-line">
            <div class="container">
                <div class="trending-line">
                    <div class="trending-now primary-color">
                        <div class="alert-spinner">
                            <div class="double-bounce1"></div>
                            <div class="double-bounce2"></div>
                        </div>
                        <strong><?php echo esc_html($em_ticker_news_title);?></strong>
                    </div>
                    <?php
                    $all_posts = elegant_magazine_get_posts($em_number_of_ticker_news, $em_ticker_news_category); ?>
                    <div class="trending-slides">
                        <?php
                        if ($all_posts->have_posts()): ?>
                            <div class='marquee' data-speed='30000' data-gap='0' data-duplicated='true'>
                            <?php while ($all_posts->have_posts()):$all_posts->the_post(); ?>


                                    <a href="<?php the_permalink();?>"> 
                                        <?php

                                        if (has_post_thumbnail()) {
                                            $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'elegant-magazine-thumbnail-small');
                                            $url = $thumb['0']; ?>
                                            <img src="<?php echo esc_url($url); ?>" alt="<?php the_title_attribute(); ?>">
                                        <?php } ?>

                                        <?php the_title(); ?>
                                    </a>

                            <?php
                            endwhile; ?>
                            </div>
                        <?php endif;
                        wp_reset_postdata();
                        ?>

                    </div>

                </div>
            </div>
        </div>
        <!-- Trending line END -->
        <?php
    }
endif;

add_action('elegant_magazine_action_ticker_news', 'elegant_magazine_ticker_news', 10);