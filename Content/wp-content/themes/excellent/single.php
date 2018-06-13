<?php
/**
 * The template for displaying all single posts.
 *
 * @package Theme Freesia
 * @subpackage Excellent
 * @since Excellent 1.0
 */
get_header();
	$excellent_settings = excellent_get_theme_options();
	?>
<div class="wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<?php global $excellent_settings;
			while( have_posts() ) {
				the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class();?>>
				<?php $excellent_entry_meta_single = $excellent_settings['excellent_entry_meta_single']; ?>
				<header class="entry-header">
					<?php if($excellent_entry_meta_single=='show'){ ?>
					<div class="entry-meta">
						<?php $format = get_post_format();
							if ( current_theme_supports( 'post-formats', $format ) ) {
								printf( '<span class="entry-format">%1$s<a href="%2$s">%3$s</a></span>',
									sprintf( ''),
									esc_url( get_post_format_link( $format ) ),
									get_post_format_string( $format )
								);
							} 
							if ( is_singular( 'post' ) ) {?>
								<span class="cat-links">
									<?php the_category(', '); ?>
								</span>
								<!-- end .cat-links -->
								<?php $tag_list = get_the_tag_list( '', __( ', ', 'excellent' ) );
								if(!empty($tag_list)){ ?>
									<span class="tag-links">
									<?php   echo get_the_tag_list( '', __( ', ', 'excellent' ) ); ?>
									</span> <!-- end .tag-links -->
								<?php }
							}else{ ?>
							<nav id="image-navigation" class="navigation image-navigation">
								<div class="nav-links">
									<div class="nav-previous"><?php previous_image_link( false, __( 'Previous Image', 'excellent' ) ); ?></div>
									<div class="nav-next"><?php next_image_link( false, __( 'Next Image', 'excellent' ) ); ?></div>
								</div><!-- .nav-links -->
							</nav><!-- .image-navigation -->
						<?php	} ?>
					</div>
					<?php } ?>
					<h2 class="entry-title"><?php the_title();?></h2> <!-- end.entry-title -->
					<?php if($excellent_entry_meta_single=='show'){ ?>
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
				</header>
				<!-- end .entry-header -->
					<div class="entry-content">
							<?php the_content(); ?>			
					</div><!-- end .entry-content -->
				</article><!-- end .post -->
				<?php
				if ( comments_open() || get_comments_number() ) {
					comments_template();
				}
				if ( is_singular( 'attachment' ) ) {
					// Parent post navigation.
					the_post_navigation( array(
								'prev_text' => _x( '<span class="meta-nav">Published in</span><span class="post-title">%title</span>', 'Parent post link', 'excellent' ),
							) );
				} elseif ( is_singular( 'post' ) ) {
				the_post_navigation( array(
						'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next', 'excellent' ) . '</span> ' .
							'<span class="screen-reader-text">' . __( 'Next post:', 'excellent' ) . '</span> ' .
							'<span class="post-title">%title</span>',
						'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous', 'excellent' ) . '</span> ' .
							'<span class="screen-reader-text">' . __( 'Previous post:', 'excellent' ) . '</span> ' .
							'<span class="post-title">%title</span>',
					) );
				}
			} ?>
		</main><!-- end #main -->
	</div> <!-- #primary -->
<?php
get_sidebar();
?>
</div><!-- end .wrap -->
<?php
get_footer();