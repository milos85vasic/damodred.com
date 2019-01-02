<?php
if (!class_exists('Elegant_Magazine_Tabbed_Posts')) :
    /**
     * Adds Elegant_Magazine_Tabbed_Posts widget.
     */
    class Elegant_Magazine_Tabbed_Posts extends AFthemes_Widget_Base
    {
        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $this->text_fields = array('em-tabbed-popular-posts-title', 'em-tabbed-latest-posts-title', 'em-tabbed-categorised-posts-title');

            $this->select_fields = array('em-show-excerpt', 'em-enable-categorised-tab', 'em-select-category');

            $widget_ops = array(
                'classname' => 'elegant_magazine_tabbed_posts_widget',
                'description' => __('Displays tabbed posts lists from selected settings.', 'elegant-magazine'),
                'customize_selective_refresh' => true,
            );

            parent::__construct('elegant_magazine_tabbed_posts', __('EM Tabbed Posts', 'elegant-magazine'), $widget_ops);
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
            $tab_id = 'tabbed-' . $this->number;


            /** This filter is documented in wp-includes/default-widgets.php */

            $show_excerpt = isset($instance['em-show-excerpt']) ? $instance['em-show-excerpt'] : 'true';
            $excerpt_length =  '20';
            $number_of_posts = '5';


            $popular_title = isset($instance['em-tabbed-popular-posts-title']) ? $instance['em-tabbed-popular-posts-title'] : __('EM Popular', 'elegant-magazine');
            $latest_title = isset($instance['em-tabbed-latest-posts-title']) ? $instance['em-tabbed-latest-posts-title'] : __('EM Latest', 'elegant-magazine');


            $enable_categorised_tab = isset($instance['em-enable-categorised-tab']) ? $instance['em-enable-categorised-tab'] : 'true';
            $categorised_title = isset($instance['em-tabbed-categorised-posts-title']) ? $instance['em-tabbed-categorised-posts-title'] : __('EM Categorised', 'elegant-magazine');
            $category = isset($instance['em-select-category']) ? $instance['em-select-category'] : '0';


            // open the widget container
            echo $args['before_widget'];
            ?>
            <div class="tabbed-container">
                <div class="tabbed-head">
                    <ul class="nav nav-tabs af-tabs" role="tablist">
                        <li role="presentation" class="tab tab-popular active">
                            <a href="#<?php echo esc_attr($tab_id); ?>-popular"
                               aria-controls="<?php esc_attr_e('Popular', 'elegant-magazine'); ?>" role="tab"
                               data-toggle="tab" class="font-family-1">
                                <?php echo esc_html($popular_title); ?>
                            </a>
                        </li>
                        <li class="tab tab-recent">
                            <a href="#<?php echo esc_attr($tab_id); ?>-recent"
                               aria-controls="<?php esc_attr_e('Recent', 'elegant-magazine'); ?>" role="tab"
                               data-toggle="tab" class="font-family-1">
                                <?php echo esc_html($latest_title); ?>
                            </a>
                        </li>
                        <?php if ($enable_categorised_tab == 'true'): ?>
                            <li class="tab tab-categorised">
                                <a href="#<?php echo esc_attr($tab_id); ?>-categorised"
                                   aria-controls="<?php esc_attr_e('Categorised', 'elegant-magazine'); ?>" role="tab"
                                   data-toggle="tab" class="font-family-1">
                                    <?php echo esc_html($categorised_title); ?>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
                <div class="tab-content">
                    <div id="<?php echo esc_attr($tab_id); ?>-popular" role="tabpanel" class="tab-pane active">
                        <?php
                        elegant_magazine_render_posts('popular', $show_excerpt, $excerpt_length, $number_of_posts);
                        ?>
                    </div>
                    <div id="<?php echo esc_attr($tab_id); ?>-recent" role="tabpanel" class="tab-pane">
                        <?php
                        elegant_magazine_render_posts('recent', $show_excerpt, $excerpt_length, $number_of_posts);
                        ?>
                    </div>
                    <?php if ($enable_categorised_tab == 'true'): ?>
                        <div id="<?php echo esc_attr($tab_id); ?>-categorised" role="tabpanel" class="tab-pane">
                            <?php
                            elegant_magazine_render_posts('categorised', $show_excerpt, $excerpt_length, $number_of_posts, $category);
                            ?>
                        </div>
                    <?php endif; ?>
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
            $options = array(
                'true' => __('Yes', 'elegant-magazine'),
                'false' => __('No', 'elegant-magazine')

            );


            // generate the text input for the title of the widget. Note that the first parameter matches text_fields array entry

            ?><h4><?php _e('Popular Posts', 'elegant-magazine'); ?></h4><?php
            echo parent::em_generate_text_input('em-tabbed-popular-posts-title', __('Title', 'elegant-magazine'), __('Popular', 'elegant-magazine'));

            ?><h4><?php _e('Latest Posts', 'elegant-magazine'); ?></h4><?php
            echo parent::em_generate_text_input('em-tabbed-latest-posts-title', __('Title', 'elegant-magazine'), __('Latest', 'elegant-magazine'));

            $categories = elegant_magazine_get_terms();
            if (isset($categories) && !empty($categories)) {
                ?><h4><?php _e('Categorised Posts', 'elegant-magazine'); ?></h4>
                <?php
                echo parent::em_generate_select_options('em-enable-categorised-tab', __('Select category', 'elegant-magazine'), $options);
                echo parent::em_generate_text_input('em-tabbed-categorised-posts-title', __('Title', 'elegant-magazine'), __('EM Categorised', 'elegant-magazine'));
                echo parent::em_generate_select_options('em-select-category', __('Select category', 'elegant-magazine'), $categories);

            }
            ?><h4><?php _e('Settings for all tabs', 'elegant-magazine'); ?></h4><?php
            echo parent::em_generate_select_options('em-show-excerpt', __('Show excerpt', 'elegant-magazine'), $options);

        }
    }
endif;