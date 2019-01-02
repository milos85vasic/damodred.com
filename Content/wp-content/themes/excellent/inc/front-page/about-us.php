<?php
/**
 * Upcoming Excellent
 *
 * Displays in Corporate template.
 *
 * @package Theme Freesia
 * @subpackage Excellent
 * @since Excellent 1.0.1
 */
add_action('excellent_display_about_us','excellent_about_us');
function excellent_about_us(){
	$excellent_settings = excellent_get_theme_options();
	if($excellent_settings['excellent_disable_about_us'] ==0){
		$i =1;
		$excellent_about_us	= array();
		$excellent_about_us	=	array_merge( $excellent_about_us, array( $excellent_settings['excellent_about_us'] ) );
		$excellent_get_about_us_section 		= new WP_Query(array(
								'posts_per_page'      	=> intval($excellent_settings['excellent_about_us']),
								'post_type'           	=> array('page'),
								'post__in'            	=> array_values($excellent_about_us),
								'orderby'             	=> 'post__in',
							)); ?>

		<!-- About Box ============================================= -->
		<div class="about-box">
			<div class="wrap">
				<div class="inner-wrap">
					<?php
					if($excellent_settings['excellent_about_title'] !='') { ?>
						<h2 class="box-title"><?php echo esc_html($excellent_settings['excellent_about_title']);?></h2>
					<?php }
					if($excellent_settings['excellent_about_description'] !=''){ ?>
						<p class="box-sub-title"><?php echo esc_attr($excellent_settings['excellent_about_description']); ?></p>
					<?php }
					if($excellent_get_about_us_section->have_posts()):$excellent_get_about_us_section->the_post();
						if ( has_post_thumbnail() ) { ?>
						<div class="two-column-full-width freesia-animation fadeInLeft" data-wow-delay="0.7s">
							<div class="about-img">
							<?php if($excellent_settings['excellent_about_us_remove_link']==0){ ?>
								<a title="<?php echo the_title_attribute('echo=0'); ?>" href="<?php the_permalink();?>"><?php the_post_thumbnail(); ?></a>
							<?php }else{
								the_post_thumbnail();
							} ?>
						   </div>
						</div><!-- end .two-column-full-width -->
						<?php	} ?>
						<div class="two-column-full-width freesia-animation fadeInRight" data-wow-delay="0.7s">	
							<div class="about-content">
								<div class="about-text">
									<h2 class="about-title">
									<?php if($excellent_settings['excellent_about_us_remove_link']==0){ ?>
										<a title="<?php echo the_title_attribute('echo=0'); ?>" href="<?php the_permalink();?>"><?php the_title(); ?></a>
										<?php }else{
											the_title();
										} ?>
									</h2>
									<?php the_content(); ?>
								</div><!-- end .about-text -->
							</div><!-- end .about-content -->
						</div><!-- end .two-column-full-width -->
					<?php endif; ?>
				</div><!-- end .inner-wrap -->
			</div><!-- end .wrap -->
		</div><!-- end .about-box -->
		<?php wp_reset_postdata();
	}
}