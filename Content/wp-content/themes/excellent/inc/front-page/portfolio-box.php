<?php
/**
 * Portfolio
 *
 * Displays in Corporate template.
 *
 * @package Theme Freesia
 * @subpackage Excellent
 * @since Excellent 1.0.1
 */
add_action('excellent_display_portfolio_box','excellent_portfolio_box');
function excellent_portfolio_box(){
	$excellent_settings = excellent_get_theme_options();
	if($excellent_settings['excellent_disable_portfolio_box'] != 1){
		$excellent_portfolio_box_total_page_no = 0;
		$excellent_portfolio_box_list_page	= array();
		for( $i = 1; $i <= $excellent_settings['excellent_total_portfolio_box']; $i++ ){
			if( isset ( $excellent_settings['excellent_portfolio_box_features_' . $i] ) && $excellent_settings['excellent_portfolio_box_features_' . $i] > 0 ){
				$excellent_portfolio_box_total_page_no++;

				$excellent_portfolio_box_list_page	=	array_merge( $excellent_portfolio_box_list_page, array( $excellent_settings['excellent_portfolio_box_features_' . $i] ) );
			}
		}
		if (!empty( $excellent_portfolio_box_list_page)  && $excellent_portfolio_box_total_page_no > 0 ) {
			echo '<!-- Portfolio Box ============================================= -->'; ?>
				<div class="portfolio-box clearfix">
					<?php	$excellent_portfolio_box_get_featured_posts 		= new WP_Query(array(
						'posts_per_page'      	=> intval($excellent_settings['excellent_total_portfolio_box']),
						'post_type'           	=> array('page'),
						'post__in'            	=> array_values($excellent_portfolio_box_list_page),
						'orderby'             	=> 'post__in',
					));
					while ($excellent_portfolio_box_get_featured_posts->have_posts()):$excellent_portfolio_box_get_featured_posts->the_post();
					$i=1; ?>
					<div class="four-column-full-width">
						<div class="portfolio-title-wrap freesia-animation fadeInRight" data-wow-delay="0.6s">
							<h2 class="portfolio-title"><a title="<?php echo the_title_attribute('echo=0'); ?>" href="<?php the_permalink(); ?>"><?php the_title();?></a></h2>
						</div>
						<?php if (has_post_thumbnail()) { ?>
							<div class="portfolio-img freesia-animation fadeInLeft" data-wow-delay="0.6s">
								<a title="<?php echo the_title_attribute('echo=0'); ?>" href="<?php the_permalink(); ?>"><?php the_post_thumbnail();?></a>
							</div>
						<?php } ?>
					</div><!-- end .four-column-full-width -->
					<?php $i++;
					 endwhile; ?>
				</div><!-- end .portfolio-box -->
			<?php }
		wp_reset_postdata();
	}
}
