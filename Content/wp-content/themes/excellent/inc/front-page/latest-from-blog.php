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
add_action('excellent_display_latest_from_blog_box','excellent_latest_from_blog_box');
function excellent_latest_from_blog_box(){
	$excellent_settings = excellent_get_theme_options();
	$latest_from_blog = $excellent_settings['excellent_display_blog_category'];
	if($excellent_settings['excellent_disable_latest_blog'] != 1){
		if($latest_from_blog == 'blog')
			{
				$get_latest_from_blog_posts = new WP_Query(array(
					'posts_per_page' =>  intval($excellent_settings['excellent_total_latest_from_blog']),
					'post_type'					=> 'post',
					'ignore_sticky_posts' 	=> true
				));
			}	else {
				$get_latest_from_blog_posts = new WP_Query(array(
					'posts_per_page' =>  intval($excellent_settings['excellent_total_latest_from_blog']),
					'post_type'					=> 'post',
					'category__in' => intval($excellent_settings['excellent_latest_from_blog_category_list']),
				));
			}
		if ( !empty($excellent_settings['excellent_latest_blog_title']) || $get_latest_from_blog_posts !='') { 
		echo '<!-- Latest Blog ============================================= -->';?>
		<div class="latest-blog-box">
			<div class="wrap">
				<div class="inner-wrap">
				<?php	
				if($excellent_settings['excellent_latest_blog_title'] != ''){ ?>
					<h2 class="box-title"><?php echo esc_attr($excellent_settings['excellent_latest_blog_title']);?> </h2>
				<?php }
				if($excellent_settings['excellent_latest_blog_description'] != ''){ ?>
				<p class="box-sub-title"><?php echo esc_attr($excellent_settings['excellent_latest_blog_description']);?></p>
				<?php } ?>
				<div class="column clearfix">
					<?php
					$i=1;
					while ($get_latest_from_blog_posts->have_posts()):$get_latest_from_blog_posts->the_post();
						if($i % 3 ==1 && $i >=0){
							$blog_class = 'fadeInLeft';
						}elseif($i % 3 ==2 && $i >=0){
							$blog_class = 'fadeInUp';
						}else{
							$blog_class = 'fadeInRight';
							} ?>
						<div class="three-column freesia-animation <?php echo esc_attr($blog_class); ?>" data-wow-delay="0.8s">
						<div class="latest-blog-content">
						<article id="post-<?php the_ID(); ?>" <?php post_class();?>>
							<?php if (has_post_thumbnail()) { ?>
								<div class="latest-blog-image">
									<figure class="post-featured-image">
										<a title="<?php echo the_title_attribute('echo=0'); ?>" href="<?php the_permalink();?>"><?php the_post_thumbnail(); ?></a>
									</figure><!-- end.post-featured-image -->
								</div><!-- end.post-image-content -->
								<?php } ?>
								<div class="latest-blog-text">
									<div <?php post_class();?>>
										<header class="entry-header">
											<div class="entry-meta">
												<?php $format = get_post_format();
												if ( current_theme_supports( 'post-formats', $format ) ) {
													printf( '<span class="entry-format">%1$s<a href="%2$s">%3$s</a></span>',
														sprintf( ''),
														esc_url( get_post_format_link( $format ) ),
														get_post_format_string( $format )
													);
												} ?>
												<span class="cat-links">
													<?php the_category(', '); ?>
												</span><!-- end .cat-links -->
												<?php $tag_list = get_the_tag_list( '', __( ', ', 'excellent' ) );
													if(!empty($tag_list)){ ?>
													<span class="tag-links">
													<?php   echo get_the_tag_list( '', __( ', ', 'excellent' ) ); ?>
													</span> <!-- end .tag-links -->
													<?php } ?>
											</div>
											<h2 class="entry-title">
												<a title="<?php echo the_title_attribute('echo=0'); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
											</h2><!-- end.entry-title -->
											<div class="entry-meta">
												<span class="author vcard"><span><?php esc_html_e('by','excellent');?></span><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" title="author"><?php the_author(); ?></a></span>
												<span class="posted-on"><a title="<?php echo esc_attr( get_the_time() ); ?>" href="<?php the_permalink(); ?>">
													<?php the_time( get_option( 'date_format' ) ); ?> </a></span>
												<?php if ( comments_open() ) { ?>
												<span class="comments"><i class="fa fa-comment-o"></i>
												<?php comments_popup_link( __( 'No Comments', 'excellent' ), __( '1 Comment', 'excellent' ), __( '% Comments', 'excellent' ), '', __( 'Comments Off', 'excellent' ) ); ?> </span>
												<?php } ?>
											</div><!-- end .entry-meta -->
										</header><!-- end .entry-header -->
										<div class="entry-content">
											<?php the_content(); ?>
									</div><!-- end .entry-content -->
								</div><!-- end .post -->
							</div><!-- end .latest-blog-text -->
						</article><!-- end .post -->
				</div><!-- end .latest-blog-content -->
			</div><!-- end .three-column -->
					<?php 
					$i++;
					endwhile; ?>
		</div><!-- end .column -->
	</div><!-- end .inner-wrap -->
</div><!-- end .wrap -->
</div><!-- end .latest-blog-box -->
		<?php }
	wp_reset_postdata();
	}
}
