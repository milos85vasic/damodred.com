<?php
/**
 * Gallery
 *
 * Displays in Corporate template.
 *
 * @package Theme Freesia
 * @subpackage Excellent
 * @since Excellent 1.0.1
 */
add_action('excellent_display_our_testimonial','excellent_our_testimonial');
function excellent_our_testimonial(){
	$excellent_settings = excellent_get_theme_options();
	if($excellent_settings['excellent_disable_our_testimonial'] != 1){
		$excellent_our_testimonial_total_page_no = 0;
		$excellent_our_testimonial_list_page	= array();
		for( $i = 1; $i <= $excellent_settings['excellent_total_our_testimonial']; $i++ ){
			if( isset ( $excellent_settings['excellent_our_testimonial_features_' . $i] ) && $excellent_settings['excellent_our_testimonial_features_' . $i] > 0 ){
				$excellent_our_testimonial_total_page_no++;

				$excellent_our_testimonial_list_page	=	array_merge( $excellent_our_testimonial_list_page, array( $excellent_settings['excellent_our_testimonial_features_' . $i] ) );
			}
		}
		if (( !empty( $excellent_our_testimonial_list_page ) || !empty($excellent_settings['excellent_our_testimonial_title']) )  && $excellent_our_testimonial_total_page_no > 0 ) { 
			echo '<!-- Testimonial Box============================================= -->';?>
			<div class="testimonial-box">
				<div class="testimonial-bg">
					<div class="wrap">
						<div class="inner-wrap">
						<?php	$excellent_our_testimonial_get_featured_posts 		= new WP_Query(array(
							'posts_per_page'      	=> intval($excellent_settings['excellent_total_our_testimonial']),
							'post_type'           	=> array('page'),
							'post__in'            	=> array_values($excellent_our_testimonial_list_page),
							'orderby'             	=> 'post__in',
						));
						if($excellent_settings['excellent_our_testimonial_title'] != ''){ ?>
							<h2 class="box-title"><?php echo esc_attr($excellent_settings['excellent_our_testimonial_title']);?> </h2>
						<?php } ?>
							<div class="testimonials">
								<div class="testimonial-slider">
									<ul class="slides">
										<?php
										while ($excellent_our_testimonial_get_featured_posts->have_posts()):$excellent_our_testimonial_get_featured_posts->the_post();
										$excellent_attachment_id = get_post_thumbnail_id();
										$excellent_image_attributes = wp_get_attachment_image_src($excellent_attachment_id);
										$i=1; ?>
											<li>
											<?php if(get_the_content()): ?>
												<div class="testimonial-quote">
													<?php the_content(); ?>
												</div>
												<div>
												<?php endif;
												if (has_post_thumbnail()) {
														the_post_thumbnail();
												} ?>
												</div>
												<cite><?php the_title(); ?></cite>
											</li>
										<?php $i++;
										 endwhile; ?>
									</ul><!-- end .slides -->
								</div><!-- end .testimonials -->
							</div><!-- end .testimonials -->
						</div> <!-- end .inner-wrap -->
					</div><!-- end .wrap -->
				</div><!-- end .testimonial_bg -->
			</div><!-- end .testimonial-box -->
	<?php }
		wp_reset_postdata();
	}
}
