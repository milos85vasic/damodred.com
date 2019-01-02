<?php
if (!class_exists('Elegant_Magazine_author_info')) :
    /**
     * Adds Elegant_Magazine_author_info widget.
     */
    class Elegant_Magazine_author_info extends AFthemes_Widget_Base
    {
        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $this->text_fields = array('em-author-info-title', 'em-author-info-subtitle', 'em-author-info-image', 'em-author-info-name', 'em-author-info-desc');
            $this->url_fields = array('em-author-info-facebook', 'em-author-info-twitter', 'em-author-info-linkedin');

            $widget_ops = array(
                'classname' => 'elegant_magazine_author_info_widget',
                'description' => __('Displays author info.', 'elegant-magazine'),
                'customize_selective_refresh' => true,
            );

            parent::__construct('elegant_magazine_author_info', __('EM Author Info', 'elegant-magazine'), $widget_ops);
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


                echo $args['before_widget'];
                $title = apply_filters('widget_title', $instance['em-author-info-title'], $instance, $this->id_base);
                $subtitle = isset($instance['em-author-info-subtitle']) ? ($instance['em-author-info-subtitle']) : '';
                $profile_image = isset($instance['em-author-info-image']) ? ($instance['em-author-info-image']) : '';
                $name = isset($instance['em-author-info-name']) ? ($instance['em-author-info-name']) : '';
                $desc = isset($instance['em-author-info-desc']) ? ($instance['em-author-info-desc']) : '';
                $facebook = isset($instance['em-author-info-facebook']) ? ($instance['em-author-info-facebook']) : '';
                $twitter = isset($instance['em-author-info-twitter']) ? ($instance['em-author-info-twitter']) : '';
                $linkedin = isset($instance['em-author-info-linkedin']) ? ($instance['em-author-info-linkedin']) : '';

                ?>
                <?php if (!empty($title)): ?>
                    <h2 class="widget-title">
                        <span><?php echo esc_html($title); ?></span>
                    </h2>
                <?php endif; ?>
                <?php if (!empty($subtitle)): ?>
                    <p class="em-widget-subtitle"><?php echo esc_html($subtitle); ?></p>
                <?php endif; ?>

                <div class="posts-author-wrapper">

                    <?php if (!empty($profile_image)) : ?>
                        <figure class="em-author-img bg-image">
                            <img src="<?php echo esc_attr($profile_image); ?>" alt=""/>
                        </figure>
                    <?php endif; ?>
                    <div class="em-author-details">
                    <?php if (!empty($name)) : ?>
                        <h4 class="em-author-display-name"><?php echo esc_html($name); ?></h4>
                    <?php endif; ?>
                    <?php if (!empty($desc)) : ?>
                        <p class="em-author-display-name"><?php echo esc_html($desc); ?></p>
                    <?php endif; ?>

                    <?php if (!empty($facebook) || !empty($twitter) || !empty($linkedin)) : ?>
                        <ul>
                            <?php if (!empty($facebook)) : ?>
                                <li>
                                    <a href="<?php echo esc_url($facebook); ?>" target="_blank"><i
                                                class='fab fa-facebook-f'></i></a>
                                </li>
                            <?php endif; ?>
                            <?php if (!empty($twitter)) : ?>
                                <li>
                                    <a href="<?php echo esc_url($twitter); ?>" target="_blank"><i
                                                class='fab fa-twitter'></i></a>
                                </li>
                            <?php endif; ?>
                            <?php if (!empty($linkedin)) : ?>
                                <li>
                                    <a href="<?php echo esc_url($linkedin); ?>" target="_blank"><i
                                                class='fab fa-linkedin-in'></i></a>
                                </li>
                            <?php endif; ?>
                        </ul>

                    <?php endif; ?>
                    </div>
                </div>
                <?php
                //print_pre($all_posts);
                // close the widget container
                echo $args['after_widget'];

            //$instance = parent::em_sanitize_data( $instance, $instance );


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
                echo parent::em_generate_text_input('em-author-info-title', __('Title', 'elegant-magazine'), __('Title', 'elegant-magazine'));
                echo parent::em_generate_text_input('em-author-info-subtitle', __('Subtitle', 'elegant-magazine'), __('Subtitle', 'elegant-magazine'));
                echo parent::em_generate_image_upload('em-author-info-image', __('Profile image', 'elegant-magazine'), __('Profile image', 'elegant-magazine'));
                echo parent::em_generate_text_input('em-author-info-name', __('Name', 'elegant-magazine'), __('Name', 'elegant-magazine'));
                echo parent::em_generate_text_input('em-author-info-desc', __('Descriptions', 'elegant-magazine'), '');
                echo parent::em_generate_text_input('em-author-info-facebook', __('Facebook', 'elegant-magazine'), '');
                echo parent::em_generate_text_input('em-author-info-twitter', __('Twitter', 'elegant-magazine'), '');
                echo parent::em_generate_text_input('em-author-info-linkedin', __('LinkedIn', 'elegant-magazine'), '');
            }
        }
    }
endif;