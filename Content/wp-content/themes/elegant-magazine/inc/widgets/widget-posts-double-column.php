<?php
if (!class_exists('Elegant_Magazine_Double_Col_Categorised_Posts')) :
    /**
     * Adds Elegant_Magazine_Double_Col_Categorised_Posts widget.
     */
    class Elegant_Magazine_Double_Col_Categorised_Posts extends AFthemes_Widget_Base
    {
        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $this->text_fields = array('em-categorised-posts-title', 'em-categorised-posts-subtitle');
            $this->select_fields = array('em-select-category');

            $widget_ops = array(
                'classname' => 'elegant_magazine_double_col_categorised_posts',
                'description' => __('Displays posts from selected category in double column.', 'elegant-magazine'),
                'customize_selective_refresh' => true,
            );

            parent::__construct('elegant_magazine_double_col_categorised_posts', __('EM Posts - Double Column ', 'elegant-magazine'), $widget_ops);
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

            $title = apply_filters('widget_title', $instance['em-categorised-posts-title'], $instance, $this->id_base);
            $subtitle = isset($instance['em-categorised-posts-subtitle']) ? $instance['em-categorised-posts-subtitle'] : '';
            $category = isset($instance['em-select-category']) ? $instance['em-select-category'] : '0';
            $number_of_posts = '5';
            $excerpt_length = '45';

            // open the widget container
            echo $args['before_widget'];
            ?>
            <?php if(!empty($title)): ?>
            <h2 class="widget-title">
                <span><?php echo esc_html($title); ?></span>
            </h2>
        <?php endif; ?>
            <?php if (!empty($subtitle)): ?>
                <p class="em-widget-subtitle"><?php echo esc_html($subtitle); ?></p>
            <?php endif; ?>
            <?php
                $all_posts = elegant_magazine_get_posts($number_of_posts, $category);
            ?>
            <div class="widget-wrapper">
                <div class="row-sm">
                    <?php
                    if ($all_posts->have_posts()) :
                        $post_count = 0;
                        while ($all_posts->have_posts()) : $all_posts->the_post();
                            if (has_post_thumbnail()) {
                                $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'elegant-magazine-medium');
                                $url = $thumb['0'];
                            } else {
                                $url = '';
                            }
                            global $post;
                            $author_id = $post->post_author;

                            if ($post_count < 1):
                                ?>
                                <div class="col col-five">
                                    <div class="spotlight-post spotlight-post-1">
                                        <figure class="categorised-article">
                                            <div class="categorised-article-wrapper">
                                                <div class="data-bg data-bg-hover data-bg-categorised" data-background="<?php echo esc_url($url); ?>">
                                                    <a class="em-figure-link" href="<?php the_permalink(); ?>"></a>

                                                    <div class="figure-categories figure-categories-1 figure-categories-bg">
                                                        <?php echo elegant_magazine_post_format($post->ID); ?>
                                                        <?php elegant_magazine_post_categories(); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </figure>
                                        <figcaption>
                                            <h3 class="article-title article-title-2">
                                                <a href="<?php the_permalink(); ?>">
                                                    <?php the_title(); ?>
                                                </a>
                                            </h3>
                                            <div class="grid-item-metadata">
                                                <?php elegant_magazine_post_item_meta(); ?>
                                            </div>
                                            <div class="full-item-discription">
                                                <div class="post-description">
                                                    <?php the_excerpt();  ?>
                                                </div>
                                            </div>
                                        </figcaption>
                                    </div>
                                </div>
                                <?php else: ?>
                            <?php

                                if (has_post_thumbnail()) {
                                    $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'elegant-magazine-medium-small');
                                    $url = $thumb['0'];
                                } else {
                                    $url = '';
                                }
                                ?>
                                <div class="col col-five">
                                    <figure class="categorised-article categorised-article-list">
                                        <div class="categorised-article-wrapper">
                                            <div class="col col-four col-image">
                                                <figure class="categorised-article">
                                                    <div class="categorised-article-item">
                                                        <div class="article-item-image">
                                                            <a href="<?php the_permalink(); ?>">
                                                                <img src="<?php echo esc_url($url); ?>" alt="<?php the_title_attribute(); ?>"></a>
                                                        </div>
                                                    </div>
                                                </figure>
                                            </div>
                                            <div class="col col-six col-details">
                                                <div class="figure-categories">

                                                    <?php elegant_magazine_post_categories('/'); ?>
                                                </div>
                                                <h3 class="article-title">
                                                    <a href="<?php the_permalink(); ?>">
                                                        <?php the_title(); ?>
                                                    </a>
                                                </h3>

                                                <div class="grid-item-metadata">
                                                    <?php echo elegant_magazine_post_format($post->ID); ?>
                                                    <?php elegant_magazine_post_item_meta(); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </figure>
                                </div>
                                <?php
                            endif;
                            $post_count++;
                        endwhile;
                    endif;
                    wp_reset_postdata();
                    ?>

                </div>
            </div>

            <?php
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


            //print_pre($terms);
            $categories = elegant_magazine_get_terms();

            if (isset($categories) && !empty($categories)) {
                // generate the text input for the title of the widget. Note that the first parameter matches text_fields array entry
                echo parent::em_generate_text_input('em-categorised-posts-title', __('Title', 'elegant-magazine'), __('Double Column Posts', 'elegant-magazine'));
                echo parent::em_generate_text_input('em-categorised-posts-subtitle', __('Subtitle', 'elegant-magazine'), __('Double Column Posts Subtitle', 'elegant-magazine' ));
                echo parent::em_generate_select_options('em-select-category', __('Select category', 'elegant-magazine'), $categories);

            }

            //print_pre($terms);


        }

    }
endif;