<?php
/**
 * Recent posts widget
 * Get recent posts and display in widget
 * @package Blogg
 */

/**
 * Recent posts class.
 */
class Blogg_Recent_Posts_Widget extends WP_Widget {
	/**
	 * Default widget options.
	 * @var array
	 */
	protected $defaults;

	/**
	 * Widget setup.
	 */
	public function __construct() {
		$this->defaults = array(
			'title'     => esc_html__( 'Blogg Recent Posts', 'blogg' ),
			'number'    => 3,
			'show_date' => true,
		);
		parent::__construct(
			'blogg-recent-posts',
			esc_html__( 'Blogg Recent Posts', 'blogg' ),
			array(
				'description' => esc_html__( 'A widget that displays your recent posts from all categories or a category with thumbnails.', 'blogg' ),
			)
		);
	}

	/**
	 * How to display the widget on the screen.
	 * @param array $args     Widget parameters.
	 * @param array $instance Widget instance.
	 */
	public function widget( $args, $instance ) {
		$instance = wp_parse_args( $instance, $this->defaults );
		$query    = new WP_Query( array(
			'posts_per_page'      => absint( $instance['number'] ),
			'ignore_sticky_posts' => true,
		) );
		if ( ! $query->have_posts() ) {
			return;
		}

		echo $args['before_widget']; // WPCS: XSS OK.

		$title = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );
		if ( $title ) {
			echo $args['before_title'], $title, $args['after_title']; // WPCS: XSS OK.
		}
		?>
		<ul class="blogg-recent-posts-widget">
			<?php while ( $query->have_posts() ) : $query->the_post(); ?>
				<li class="rp-item">

					<?php if ( has_post_thumbnail() ) : ?>
					<figure class="rp-thumbnail">
							<a class="rp-image-link" href="<?php esc_url(the_permalink()); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
								<?php the_post_thumbnail( 'blogg-recent-thumbnail' ); ?>
							</a>
					</figure>
					
					<?php else: ?>
					<figure class="rp-thumbnail">
							<a class="rp-image" href="<?php esc_url(the_permalink()); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
								<img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/no-recent.png" alt="<?php esc_html_e( 'No Image', 'blogg');?>"/>
							</a>
					</figure>
					
					<?php endif; ?>
					
					<div class="rp-content">
						<h4 class="rp-title">
							<a href="<?php esc_url(the_permalink()); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
						</h4>		
						<div class="rp-post-date"><?php echo get_the_date(); ?></div>						
					</div>

				</li>

			<?php endwhile; ?>
		</ul>

		<?php
		wp_reset_postdata();

		echo $args['after_widget']; // WPCS: XSS OK.
	}

	/**
	 * Update the widget settings.
	 * @param array $new_instance New widget instance.
	 * @param array $old_instance Old widget instance.
	 * @return array
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title']  = sanitize_text_field( $new_instance['title'] );
		$instance['number'] = absint( $new_instance['number'] );

		return $instance;
	}

	/**
	 * Widget form.
	 * @param array $instance Widget instance.
	 * @return void
	 */
	public function form( $instance ) {
		$instance = wp_parse_args( $instance, $this->defaults ); ?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'blogg' ); ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e( 'Number of posts to show:', 'blogg' ); ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" value="<?php echo absint( $instance['number'] ); ?>" size="3">
		</p>
		<?php
	}
}
