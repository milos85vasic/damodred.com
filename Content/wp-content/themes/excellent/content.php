<?php
/**
 * The template for displaying content.
 *
 * @package Theme Freesia
 * @subpackage Excellent
 * @since Excellent 1.0
 */
$excellent_settings = excellent_get_theme_options(); ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class();?>>
		<?php $excellent_blog_post_image = $excellent_settings['excellent_blog_post_image'];
		if( has_post_thumbnail() && $excellent_blog_post_image == 'on') { ?>
			<div class="post-image-content">
				<figure class="post-featured-image">
					<a href="<?php the_permalink();?>" title="<?php echo the_title_attribute('echo=0'); ?>">
					<?php the_post_thumbnail(); ?>
					</a>
				</figure><!-- end.post-featured-image  -->
			</div> <!-- end.post-image-content -->
		<?php } ?>
		<header class="entry-header">
		<?php  $entry_format_meta_blog = $excellent_settings['excellent_entry_meta_blog'];
			if($entry_format_meta_blog == 'show-meta' ){?>
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
				</span>
				<!-- end .cat-links -->
				<?php $tag_list = get_the_tag_list( '', __( ', ', 'excellent' ) );
				if(!empty($tag_list)){ ?>
					<span class="tag-links">
					<?php   echo get_the_tag_list( '', __( ', ', 'excellent' ) ); ?>
					</span> <!-- end .tag-links -->
				<?php }  ?>
			</div>
			<?php } ?>
			<h2 class="entry-title"> <a href="<?php the_permalink(); ?>" title="<?php echo the_title_attribute('echo=0'); ?>"> <?php the_title();?> </a> </h2> <!-- end.entry-title -->
			<?php if($entry_format_meta_blog == 'show-meta' ){ ?> 
				<div class="entry-meta">
					<span class="author vcard"><span><?php esc_html_e('by','excellent');?></span><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" title="<?php the_author(); ?>">
					<?php the_author(); ?> </a></span>
					<span class="posted-on"><a title="<?php echo esc_attr( get_the_time() ); ?>" href="<?php the_permalink(); ?>">
					<?php the_time( get_option( 'date_format' ) ); ?> </a></span>
					<?php if ( comments_open() ) { ?>
					<span class="comments"><i class="fa fa-comment-o"></i>
					<?php comments_popup_link( __( 'No Comments', 'excellent' ), __( '1 Comment', 'excellent' ), __( '% Comments', 'excellent' ), '', __( 'Comments Off', 'excellent' ) ); ?> </span>
					<?php } ?>
				</div><!-- end .entry-meta -->
			<?php } ?>
			</header><!-- end .entry-header -->
			<div class="entry-content">
			<?php
			$excellent_tag_text = $excellent_settings['excellent_tag_text'];
			$content_display = $excellent_settings['excellent_blog_content_layout'];
			if($content_display == 'excerptblog_display'):
					the_excerpt(); ?>
				<a href="<?php echo esc_url(get_permalink());?>" class="more-link"><?php echo esc_attr($excellent_tag_text);?></a>
				<?php else:
					the_content( sprintf($excellent_tag_text));
				endif; ?>
			</div> <!-- end .entry-content -->
			<?php wp_link_pages( array( 
					'before'            => '<div style="clear: both;"></div><div class="pagination clearfix">'.esc_html__( 'Pages:', 'excellent' ),
					'after'             => '</div>',
					'link_before'       => '<span>',
					'link_after'        => '</span>',
					'pagelink'          => '%',
					'echo'              => 1
				) ); ?>
		</article><!-- end .post -->