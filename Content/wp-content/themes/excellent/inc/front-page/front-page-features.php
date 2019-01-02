<?php
/**
 * Front Page Features
 *
 * Displays in Corporate template.
 *
 * @package Theme Freesia
 * @subpackage Excellent
 * @since Excellent 1.0.1
 */
add_action('excellent_display_front_page_features','excellent_front_page_features');
function excellent_front_page_features(){
	$excellent_settings = excellent_get_theme_options();
	if($excellent_settings['excellent_disable_features'] != 1){
		$excellent_total_page_no = 0;
		$excellent_list_page	= array();
		for( $i = 1; $i <= $excellent_settings['excellent_total_features']; $i++ ){
			if( isset ( $excellent_settings['excellent_frontpage_features_' . $i] ) && $excellent_settings['excellent_frontpage_features_' . $i] > 0 ){
				$excellent_total_page_no++;

				$excellent_list_page	=	array_merge( $excellent_list_page, array( $excellent_settings['excellent_frontpage_features_' . $i] ) );
			}
		}
		if (( !empty( $excellent_list_page ) || !empty($excellent_settings['excellent_features_title']) || !empty($excellent_settings['excellent_features_description']) )  && $excellent_total_page_no > 0 ) {
		echo '<!-- Our Feature Box ============================================= -->'; ?>
			<div class="our-feature-box">
				<div class="wrap">
					<div class="inner-wrap">
					<?php	$excellent_feature_box_get_featured_posts 		= new WP_Query(array(
						'posts_per_page'      	=> intval($excellent_settings['excellent_total_features']),
						'post_type'           	=> array('page'),
						'post__in'            	=> array_values($excellent_list_page),
						'orderby'             	=> 'post__in',
					));
					if($excellent_settings['excellent_features_title'] != ''){ ?>
						<h2 class="box-title"><?php echo esc_attr($excellent_settings['excellent_features_title']);?> </h2>
					<?php }
				if($excellent_settings['excellent_features_description'] != ''){ ?>
					<p class="feature-sub-title"><?php echo esc_attr($excellent_settings['excellent_features_description']); ?></p>
				<?php } ?>
					<div class="column clearfix">
					<?php
					$i=1;
					while ($excellent_feature_box_get_featured_posts->have_posts()):$excellent_feature_box_get_featured_posts->the_post();
						if($i % 3 ==1 && $i >=0){
								$blog_class = '0.5s';
						}elseif($i % 3 ==2 && $i >=0){
								$blog_class = '0.6s';
						}else{
								$blog_class = '0.7s';
						}  ?>
						<div class="three-column freesia-animation fadeInLeft" data-wow-delay="<?php echo esc_attr($blog_class); ?>">
							<div class="feature-content">
								<?php if (has_post_thumbnail() && $excellent_settings['excellent_disable_features_image']==0) { ?>
									<a class="feature-icon" href="<?php the_permalink();?>" title="<?php echo the_title_attribute('echo=0'); ?>" alt="<?php echo the_title_attribute('echo=0'); ?>"><?php the_post_thumbnail(); ?></a>
								<?php } ?>
								<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
										<h3 class="feature-title"><a href="<?php the_permalink();?>" title="<?php echo the_title_attribute('echo=0'); ?>" rel="bookmark"><?php the_title();?></a></h3>
									<?php the_excerpt(); ?>
								</article>
								<?php
								if($excellent_settings['excellent_disable_features_readmore'] == 0){
									$excerpt_text = $excellent_settings['excellent_tag_text'];
									if($excerpt_text == '' || $excerpt_text == 'Read More') : ?>
										<a title="<?php echo the_title_attribute('echo=0'); ?>" href="<?php the_permalink();?>" class="more-link"><?php esc_html_e('Read More', 'excellent');?></a>
									<?php else: ?>
										<a title="<?php echo the_title_attribute('echo=0'); ?>" href="<?php the_permalink();?>" class="more-link"><?php echo esc_attr($excellent_settings[ 'excellent_tag_text' ]);?></a>
									<?php endif;
								} ?>
								</div> <!-- end .feature-content -->
							</div><!-- end .three-column -->
						<?php 
						$i++;
						endwhile; ?>
						</div><!-- .end column-->
					</div><!-- end .inner-wrap -->
				</div><!-- end .wrap -->
			</div><!-- end .our-feature-box -->
		<?php }
	wp_reset_postdata();
	}
}
