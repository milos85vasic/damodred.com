<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Blogg
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Displays the date and author of a post
 */
if ( ! function_exists( 'blogg_entry_meta' ) ) :

	function blogg_entry_meta() {

 echo '<ul class="entry-meta post-details">' ;
				blogg_sticky_entry_post();				
				blogg_entry_author();
				blogg_entry_date();
				blogg_entry_post_format();
				blogg_get_first_cat_name();
				blogg_entry_comments();
				blogg_edit_link();

		echo '</ul>';
	}
endif;

/**
 * Displays the meta info for the default blog styles
 */
if ( ! function_exists( 'blogg_default_entry_meta' ) ) :

	function blogg_default_entry_meta() {

 echo '<ul class="entry-meta post-details">' ;	
				blogg_sticky_entry_post();  
				blogg_entry_author();
				blogg_entry_date();
				blogg_entry_post_format();
				blogg_entry_comments();
				blogg_edit_link();
		echo '</ul>';
	}
endif;


// Display the post meta info for the grid blog
if ( ! function_exists( 'blogg_date_block' ) ) :
function blogg_date_block() {
	$time_string = '<div class="block-day">%1$s</div><div class="block-month-year">%2$s %3$s</div>';
	$posted_on = sprintf( $time_string,
         get_the_date( 'd' ),
		 get_the_date( 'M' ),
		get_the_date( 'Y' )
	);
	echo '<ul class="entry-meta post-details col-sm-2">' . wp_kses_post($posted_on) . '</ul>';
}
endif; 



if ( ! function_exists( 'blogg_sticky_entry_post' ) ) :
	// Returns the sticky label
	function blogg_sticky_entry_post() {         
				if( is_sticky()  && ! is_archive() && esc_attr(get_theme_mod( 'blogg_show_featured_tag', true ) ) ) { 
					echo '<li class="meta-featured-label"><span class="featured-label">', esc_html_e('Featured', 'blogg'), '</span></li>';
				}
	}
endif;


if ( ! function_exists( 'blogg_entry_post_format' ) ) :
	// Returns the format post label
	function blogg_entry_post_format() {
		
		$format = get_post_format();
		if ( current_theme_supports( 'post-formats', $format ) ) {
			$format = sprintf( '<li class="entry-format">%1$s<a href="%2$s">%3$s</a></li>',
				sprintf( '<span class="screen-reader-text">%s </span>', _x( 'Format', 'Used before post format.', 'blogg' ) ),
				esc_url( get_post_format_link( $format ) ),
				get_post_format_string( $format )
			);
		}
		echo $format; // WPCS: XSS OK.
	}
endif;


if ( ! function_exists( 'blogg_entry_date' ) ) :
	// Returns the post date
	function blogg_entry_date() {

		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);
		
		$posted_on = sprintf(
			/* translators: %s: post date */
		__( '<span class="screen-reader-text">Posted on</span> %s', 'blogg' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>' );

		echo '<li class="posted-on meta-date">' . $posted_on . '</li>'; // WPCS: XSS OK.	
	}
endif;


if ( ! function_exists( 'blogg_entry_author' ) ) :
	// Returns the post author
	function blogg_entry_author() {

		$author_avatar_size = apply_filters( 'blogg_author_avatar_size', 48 );
		$author_string = sprintf( '<div class="byline">%1$s <span class="author vcard"><span class="written-by">%2$s</span><a class="url fn n" href="%3$s">%4$s</a></span></div>',
			get_avatar( get_the_author_meta( 'user_email' ), $author_avatar_size ),
			_x( 'Written by', 'Used before post author name.', 'blogg' ),
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			get_the_author()
		);		

		echo '<li class="posted-by meta-author">' . $author_string . '</li>'; // WPCS: XSS OK.	
	}
endif;


if ( ! function_exists( 'blogg_entry_comments' ) ) :
	// Displays the post comments
	function blogg_entry_comments() {

		if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<li class="comments-link">';
				comments_popup_link(
					esc_html__( 'Comment', 'blogg' )
				);
			echo '</li>';
		}
	}
endif;



// Get the full category list for a post
if ( ! function_exists( 'blogg_categories' ) ) :
function blogg_categories() {		
	echo get_the_category_list(); // WPCS: XSS OK.
	}
endif;

// Get just the first category name of a post
function blogg_get_first_cat_name() {
	if ( 'post' === get_post_type() ) {
		$cats = get_the_category();
		echo '<li class="post-meta-category">' . esc_html( $cats[0]->name ) . '</li>';
	}
}

// Edit link function
if ( ! function_exists( 'blogg_edit_link' ) ) :
	function blogg_edit_link() {
		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'blogg' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<li class="edit-link">',
			'</li>'
		);
	}
endif;

if ( ! function_exists( 'blogg_more_link' ) ) :
	/**
	 * Displays the more link on excerpts
	 */
	function blogg_more_link() {
		?>

    <a href="<?php echo esc_url( get_permalink() ) ?>" class="more-link">
        <?php esc_html_e( 'Read More', 'blogg' ); ?>
    </a>

    <?php
	}
endif;

if ( ! function_exists( 'blogg_post_image_archives' ) ) :
	/**
	 * Displays the featured image on archive posts.
	 */
	function blogg_post_image_archives() {
	
		// Set image size.
		$image_size = get_theme_mod( 'blog_layout' );  ?>

        <?php if (has_post_thumbnail() ) { ?>
        <figure class="post-image">	
			<a class="wp-post-image-link" href="<?php the_permalink(); ?>" rel="bookmark">
			
				<?php 
				// Set the post thumbnail based on the blog layout and active cropped thumbnail setting
				$blogg_blog_layout = get_theme_mod( 'blogg_blog_layout', 'default' );
				switch ( esc_attr($blogg_blog_layout ) ) {
				
				case "grid":
					// grid thumbnail
					the_post_thumbnail( 'blogg-grid-thumbnail' );
				break;
				
				case "default-left":
				case "default":
					// standard thumbnail
					the_post_thumbnail( 'blogg-standard-thumbnail' );
				break;
				
				default:
					the_post_thumbnail( 'post-thumbnails' ); 
				}
			?>
            </a>
			<?php // Enable or disable the caption feature
			if( esc_attr(get_theme_mod( 'blogg_show_featured_captions', true ) ) ) {			
				$get_description = get_post(get_post_thumbnail_id())->post_excerpt;
				  if(!empty($get_description) ) {
					  // If caption exists - show it
				  echo '<figcaption class="featured-caption">' . esc_html($get_description) . '</figcaption>';
				  }
				}
			?>
        </figure>

        <?php
		}
	}
endif;


if ( ! function_exists( 'blogg_post_default_image' ) ) :
	// Displays the featured image on single posts in a standard default format
	function blogg_post_default_image() {
	?>
<div id="default-post-header">
            
                <?php
				echo '<figure class="post-image default-post-image">';
				the_post_thumbnail(); 
				echo '</figure>';
				?>
            
</div>
            <?php
	}
endif;


if ( ! function_exists( 'blogg_default_page_image' ) ) :
	// Displays the featured image on single posts
	function blogg_default_page_image() {
		?>
<div id="default-post-header">
            
                <?php
				echo '<figure class="post-image">';
				the_post_thumbnail(); 
				echo '</figure>';
				?>
            
</div>
       <?php
	}
endif;



if ( ! function_exists( 'blogg_entry_footer' ) ) :
	/**
	 * Displays the categories, tags and comments of a post
	 */
	function blogg_entry_footer() {

		if( is_singular() ) {
			// Display Tags only on single posts.
			if( esc_attr(get_theme_mod( 'blogg_meta_tags', true ) ) ) {
				blogg_entry_tags(); 
			}
		} else {
			// Display comments only on blog index and archives.
			echo blogg_entry_comments(); // WPCS: XSS OK.	
		}
	}
endif;

if ( ! function_exists( 'blogg_entry_tags' ) ) :
	/**
	 * Displays the post tags on single post view
	 */
	function blogg_entry_tags() {

	$tag_list = get_the_tag_list( '<ul class="entry-tags"><li>', '</li><li>', '</li></ul>' );
	 
	if ( $tag_list && ! is_wp_error( $tag_list ) ) {
		echo $tag_list; // WPCS: XSS OK.	
	}		
		
	}
endif;


/**
 * Custom comment output
 */
function blogg_comment( $comment, $args, $depth ) { ?>
	<li <?php comment_class( 'clearfix' ); ?> id="li-comment-
		<?php comment_ID(); ?>">

		<div id="comment-<?php comment_ID(); ?>" class="comment-body">

			<div class="comment-wrapper">

				<div class="comment-author vcard clearfix">
					<?php echo get_avatar( $comment, 65 ); ?>
					<h6 class="comment-cite">
						<?php comment_author_link() ?>
					</h6>
					<span class="comment-date"><?php echo get_comment_date(); ?></span>
					<span class="comment-edit"><?php edit_comment_link( esc_html__( 'Edit', 'blogg' ) ); ?></span>
				</div>

				<div class="comment-content">
					<?php comment_text() ?>
					<p class="reply">
						<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ) ?>
					</p>
				</div>

				<?php if ( $comment->comment_approved == '0' ) : ?>
				<em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'blogg' ) ?></em>
				<?php endif; ?>
			</div>
		</div>
		<?php
}

/**
* Display custom archive titles without the labels
* Disable for the default archive title style from the customizer > Theme Options > Blog Settings
*/
 if ( esc_attr(get_theme_mod( 'blogg_show_archive_labels', true ) ) ) :
 
if ( ! function_exists( 'blogg_archive_title' ) ) :

function blogg_archive_title( $before = '', $after = '' ) {
	if ( is_category() ) {
		$title = single_cat_title( '', false );
	} elseif ( is_tag() ) {
		$title = sprintf( 
		/* translators: %s: Name of tag */
		esc_html__( 'Articles with %s', 'blogg' ), single_tag_title( '', false ) );
	} elseif ( is_author() ) {
		$title = sprintf( 
		/* translators: %s: Name of author */
		esc_html__( 'Articles by %s', 'blogg' ), '<span class="vcard">' . get_the_author() . '</span>' );
	} elseif ( is_year() ) {
		$title = sprintf( 
		/* translators: %s: Name of year */
		esc_html__( 'Articles from: %s', 'blogg' ), get_the_date( esc_html_x( 'Y', 'yearly archives date format', 'blogg' ) ) );
	} elseif ( is_month() ) {
		$title = sprintf( 
		/* translators: %s: Name of month  */
		esc_html__( 'Articles from %s', 'blogg' ), get_the_date( esc_html_x( 'F Y', 'monthly archives date format', 'blogg' ) ) );
	} elseif ( is_day() ) {
		$title = sprintf( 
		/* translators: %s: Name of day */
		esc_html__( 'Articles from %s', 'blogg' ), get_the_date( esc_html_x( 'F j, Y', 'daily archives date format', 'blogg' ) ) );
	} elseif ( is_post_type_archive() ) {
		$title = sprintf( 
		/* translators: %s: Name of archive title */
		esc_html__( 'Archives: %s', 'blogg' ), post_type_archive_title( '', false ) );
	} elseif ( is_tax() ) {
		$tax = get_taxonomy( get_queried_object()->taxonomy );
		/* translators: 1: Taxonomy singular name, 2: Current taxonomy term */
		$title = sprintf( 
		/* translators: %s: Name of title  */
		esc_html__( '%1$s: %2$s', 'blogg' ), $tax->labels->singular_name, single_term_title( '', false ) );
	} else {
		$title = esc_html__( 'Archives', 'blogg' );
	}

	/**
	 * Filter the archive title.
	 * @param string $title Archive title to be displayed.
	 */
	$title = apply_filters( 'get_the_archive_title', $title );

	if ( ! empty( $title ) ) {
		echo $before . $title . $after;  // WPCS: XSS OK.
	}
}
endif;
endif;

/**
 * Displays pagination on the blog and archive pages
 */
if ( ! function_exists( 'blogg_blog_navigation' ) ) :

	function blogg_blog_navigation() {

		the_posts_pagination( array(
			'mid_size'  => 2,
			'prev_text' => '<span class="nav-arrow">&laquo</span><span class="screen-reader-text">' . esc_html_x( 'Previous Posts', 'pagination', 'blogg' ) . '</span>',
			'next_text' => '<span class="screen-reader-text">' . esc_html_x( 'Next Posts', 'pagination', 'blogg' ) . '</span><span class="nav-arrow">&raquo;</span>',
		) );
	}
endif;

/**
 * Displays Single Post Navigation
 */
if ( ! function_exists( 'blogg_post_navigation' ) ) :

	function blogg_post_navigation() {

			if( esc_attr(get_theme_mod( 'blogg_crop_list_featured', true ) || is_customize_preview()) ) {

			the_post_navigation( array(
				'prev_text' => '<span class="nav-link-text">' . esc_html_x( 'Previous Post', 'post navigation', 'blogg' ) . '</span><h5 class="nav-entry-title">%title</h5>',
				'next_text' => '<span class="nav-link-text">' . esc_html_x( 'Next Post', 'post navigation', 'blogg' ) . '</span><h5 class="nav-entry-title">%title</h5>',
			) );
		}
	}
endif;

/**
 * Displays Multi-page Navigation
 */
if ( ! function_exists( 'blogg_multipage_navigation' ) ) :

	function blogg_multipage_navigation() {
		wp_link_pages( array(
		'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'blogg' ),
		'after'  => '</div>',
		'link_before' => '<span class="page-wrap">',
		'link_after' => '</span>',
		) ); 
	}
endif;				