<?php
if (!class_exists('Elegant_Magazine_Posts_Carousel')) :
    /**
     * Adds Elegant_Magazine_Posts_Carousel widget.
     */
    class Elegant_Magazine_Posts_Carousel extends AFthemes_Widget_Base
    {
        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $this->text_fields = array('em-posts-slider-title', 'em-posts-slider-subtitle');
            $this->select_fields = array('em-select-category');

            $widget_ops = array(
                'classname' => 'elegant_magazine_posts_carousel_widget',
                'description' => __('Displays posts carousel from selected category.', 'elegant-magazine'),
                'customize_selective_refresh' => true,
            );

            parent::__construct('elegant_magazine_posts_carousel', __('EM Posts Carousel', 'elegant-magazine'), $widget_ops);
        }

        /**
         * Front-end display of widget.
         *
         * @see WP_Widget::widget()
         *
         * @param array $args Widget arguments.
         * @param array $instance Saved values from database.
         */

        public function widget($args, $instance)
        {
            $instance = parent::em_sanitize_data($instance, $instance);
            /** This filter is documented in wp-includes/default-widgets.php */

            $title = apply_filters('widget_title', $instance['em-posts-slider-title'], $instance, $this->id_base);
            $subtitle = isset($instance['em-posts-slider-subtitle']) ? $instance['em-posts-slider-subtitle'] : '';
            $category = isset($instance['em-select-category']) ? $instance['em-select-category'] : '0';
            $number_of_posts = '5';

            // open the widget container
            echo $args['before_widget'];
            ?>
            <?php if (!empty($title)): ?>
            <h2 class="widget-title">
                <span><?php echo esc_html($title); ?></span>
            </h2>
        <?php endif; ?>
            <?php if (!empty($subtitle)): ?>
            <p class="em-widget-subtitle"><?php echo esc_html($subtitle); ?></p>
        <?php endif; ?>
            <?php
            $all_posts = elegant_magazine_get_posts($number_of_posts, $category);;
            ?>
            <div class="posts-carousel">
                <?php
                if ($all_posts->have_posts()) :
                    while ($all_posts->have_posts()) : $all_posts->the_post();
                        if (has_post_thumbnail()) {
                            $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'elegant-magazine-medium');
                            $url = $thumb['0'];
                        } else {
                            $url = '';
                        }
                        global $post;
                        $author_id = $post->post_author;
                        ?>
                        <div class="slick-item">
                            <figure class="carousel-image">
                                <div class="no-gutter-col banner-half" data-mh="carousal-height">
                                    <figure class="featured-article">
                                        <div class="featured-article-wrapper">
                                            <div class="data-bg data-bg-hover data-bg-hover data-bg-featured"
                                                 data-background="<?php echo esc_url($url); ?>">
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
                                </figcaption>
                            </figure>
                        </div>
                    <?php
                    endwhile;
                endif;
                wp_reset_postdata();
                ?>
            </div>

            <?php
            //print_pre($all_posts);

            // close the widget container
            echo $args['after_widget'];
        }

        /**
         * Back-end widget form.
         *
         * @see WP_Widget::form()
         *
         * @param array $instance Previously saved values from database.
         */
        public function form($instance)
        {
            $this->form_instance = $instance;
            $categories = elegant_magazine_get_terms();
            if (isset($categories) && !empty($categories)) {
                // generate the text input for the title of the widget. Note that the first parameter matches text_fields array entry
                echo parent::em_generate_text_input('em-posts-slider-title', 'Title', 'Posts Carousel');
                echo parent::em_generate_text_input('em-posts-slider-subtitle', 'Subtitle', 'Posts Carousel Subtitle');
                echo parent::em_generate_select_options('em-select-category', __('Select category', 'elegant-magazine'), $categories);

            }
        }
    }
endif;