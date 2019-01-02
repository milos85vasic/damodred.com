<?php
if (!function_exists('elegant_magazine_banner_slider')) :
    /**
     * Banner Slider
     *
     * @since Elegant Magazine 1.0.0
     *
     */
    function elegant_magazine_banner_slider()
    {

        if (1 != elegant_magazine_get_option('show_main_news_section')) {
            return null;
        }

        $em_slider_category = elegant_magazine_get_option('select_slider_news_category');
        $em_number_of_slides = 3;
        $em_featured_category = elegant_magazine_get_option('select_featured_news_category');
        $em_number_of_featured_news = 2;


        ?>

        <section class="af-blocks af-main-banner">
            <div class="container">
                <div class="row no-gutter">
                    <div class="col-md-6 col-sm-12 no-gutter-col" data-mh="banner-height">
                        <div class="main-slider">
                            <?php
                            $slider_posts = elegant_magazine_get_posts($em_number_of_slides, $em_slider_category);
                            if ($slider_posts->have_posts()) :
                                while ($slider_posts->have_posts()) : $slider_posts->the_post();
                                    if (has_post_thumbnail()) {
                                        $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'large');
                                        $url = $thumb['0'];
                                    } else {
                                        $url = '';
                                    }
                                    global $post;

                                    ?>
                                    <figure class="slick-item">
                                        <div class="data-bg data-bg-hover data-bg-hover data-bg-slide" data-background="<?php echo esc_url($url); ?>">
                                            <a class="em-figure-link" href="<?php the_permalink(); ?>"></a>
                                            <figcaption class="slider-figcaption slider-figcaption-1">
                                                <div class="figure-categories figure-categories-bg">
                                                    <?php echo elegant_magazine_post_format($post->ID); ?>
                                                    <?php elegant_magazine_post_categories(); ?>
                                                </div>
                                                <div class="title-heading">
                                                    <h3 class="article-title slide-title">
                                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                    </h3>
                                                </div>
                                                <div class="grid-item-metadata grid-item-metadata-1">
                                                    <?php elegant_magazine_post_item_meta(); ?>
                                                </div>
                                            </figcaption>
                                        </div>
                                    </figure>
                                    <?php
                                endwhile;
                            endif;
                            wp_reset_postdata();
                            ?>
                        </div>

                        <div class="af-navcontrols">
                            <div class="slide-count">
                                <span class="current"></span> of
                                <span class="total"></span>
                            </div>
                        </div>

                    </div>


                    <?php
                    $featured_posts = $slider_posts = elegant_magazine_get_posts($em_number_of_featured_news, $em_featured_category);
                    ?>
                    <?php
                    
                    if ($featured_posts->have_posts()) :
                        while ($featured_posts->have_posts()) :
                            $featured_posts->the_post();
                            global $post;

                            if (has_post_thumbnail()) {
                                $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'elegant-magazine-medium');
                                $url = $thumb['0'];
                            } else {
                                $url = '';
                            }

                            ?>
                            <div class="col-md-3 col-6-3 col-xs-6 no-gutter-col banner-half" data-mh="banner-height">
                                <figure class="featured-article">
                                    <div class="featured-article-wrapper">
                                        <div class="data-bg data-bg-hover data-bg-hover data-bg-featured" data-background="<?php echo esc_url($url); ?>">
                                            <a class="em-figure-link" href="<?php the_permalink(); ?>"></a>
                                            <div class="figure-categories figure-categories-1 figure-categories-bg">
                                                <?php echo elegant_magazine_post_format($post->ID); ?>
                                                <?php elegant_magazine_post_categories(); ?>
                                            </div>
                                        </div>
                                    </div>
                                </figure>

                                <figcaption>
                                    <div class="title-heading">
                                        <h3 class="article-title article-title-1">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php the_title(); ?>
                                            </a>
                                        </h3>
                                    </div>
                                    <div class="grid-item-metadata">
                                        <?php elegant_magazine_post_item_meta(); ?>
                                    </div>
                                </figcaption>
                            </div>

                        <?php endwhile;
                    endif;
                    wp_reset_postdata();
                    ?>

                </div>
            </div>
        </section>

        <!-- end slider-section -->
        <?php
    }
endif;
add_action('elegant_magazine_action_front_page', 'elegant_magazine_banner_slider', 40);