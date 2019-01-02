<?php echo $args[ 'before_widget' ]; ?>
<div id="rpwwt-<?php echo $args[ 'widget_id' ];?>" class="rpwwt-widget">
	<?php if ( $title ) echo $args[ 'before_title' ] . $title . $args[ 'after_title' ]; ?>
	<ul>
	<?php while ( $r->have_posts() ) : $r->the_post(); ?>
		<li<?php 
			$classes = array();
			if ( is_sticky() ) { 
				$classes[] = 'rpwwt-sticky';
			}
			if ( $bools[ 'print_post_categories' ] ) {
				$cats = get_the_category();
				if ( is_array( $cats ) and $cats ) {
					foreach ( $cats as $cat ) {
						$classes[] = $cat->slug;
					}
				}
			}
			if ( $classes ) {
				echo ' class="', join( ' ', $classes ), '"';
			}
			?>><a href="<?php the_permalink(); ?>"<?php echo $this->customs[ 'link_target' ]; ?>><?php 
			if ( $bools[ 'show_thumb' ] ) : 
				$is_thumb = false;
				// if only first image
				if ( $bools[ 'only_1st_img' ] ) :
					// try to find and to display the first post image and to return success
					$is_thumb = $this->the_first_post_image();
				else :
					// look for featured image
					if ( has_post_thumbnail() ) : 
						// if there is featured image then show it
						the_post_thumbnail( $this->customs[ 'thumb_dimensions' ] );
						$is_thumb = true;
					else :
						// if user wishes first image trial
						if ( $bools[ 'try_1st_img' ] ) :
							// try to find and to display the first post image and to return success
							$is_thumb = $this->the_first_post_image();
						endif; // try_1st_img 
					endif; // has_post_thumbnail
				endif; // only_1st_img
				// if there is no image 
				if ( ! $is_thumb ) :
					// if user allows default image then
					if ( $bools[ 'use_default' ] ) :
						echo $default_img;
					endif; // use_default
				endif; // not is_thumb
				// (else do nothing)
			endif; // show_thumb
			// show title if wished
			if ( ! $bools[ 'hide_title' ] ) {
				?><span class="rpwwt-post-title"><?php if ( $post_title = $this->get_the_trimmed_post_title() ) { echo $post_title; } else { the_ID(); } ?></span><?php
			}
			?></a><?php 
			if ( $bools[ 'show_author' ] ) : 
				?><div class="rpwwt-post-author"><?php echo esc_html( $this->get_the_author() ); ?></div><?php 
			endif;
			if ( $bools[ 'show_categories' ] ) : 
				?><div class="rpwwt-post-categories"><?php echo $this->get_the_categories( $r->post->ID ); ?></div><?php 
			endif;
			if ( $bools[ 'show_date' ] ) : 
				?><div class="rpwwt-post-date"><?php echo get_the_date(); ?></div><?php 
			endif;
			if ( $bools[ 'show_excerpt' ] ) : 
				?><div class="rpwwt-post-excerpt"><?php echo $this->get_the_trimmed_excerpt(); ?></div><?php 
			endif;
			if ( $bools[ 'show_comments_number' ] ) : 
				?><div class="rpwwt-post-comments-number"><?php echo get_comments_number_text(); ?></div><?php 
			endif; 
		?></li>
	<?php endwhile; ?>
	</ul>
</div><!-- .rpwwt-widget -->
<?php echo $args[ 'after_widget' ]; ?>
