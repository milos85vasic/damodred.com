<?php
/**
 * Frontpage - Featured Posts
 *
 * @package juliet
 */
?>
<?php 
$juliet_frontpage_featured_posts_show = juliet_get_option('juliet_frontpage_featured_posts_show');
if($juliet_frontpage_featured_posts_show == 1) { 
    global $post;
    $juliet_frontpage_featured_posts_heading = juliet_get_option('juliet_frontpage_featured_posts_heading');
    $juliet_frontpage_featured_posts_post_1 = juliet_get_option('juliet_frontpage_featured_posts_post_1');
    $juliet_frontpage_featured_posts_post_2 = juliet_get_option('juliet_frontpage_featured_posts_post_2');
    $juliet_frontpage_featured_posts_post_3 = juliet_get_option('juliet_frontpage_featured_posts_post_3'); 
    $juliet_frontpage_featured_posts_post_4 = juliet_get_option('juliet_frontpage_featured_posts_post_4'); 
    $juliet_entry = 'juliet-featured'; ?>
    
    <!-- Frontpage Featured Posts -->
    <div class="frontpage-featured-posts">
        <h2><?php echo esc_html($juliet_frontpage_featured_posts_heading); ?></h2>
        <div class="row" data-fluid=".entry-summary,.entry-title">
            <div class="col-sm-6 col-md-3">
                <?php 
				if($juliet_frontpage_featured_posts_post_1 != '') {
					$post = get_post($juliet_frontpage_featured_posts_post_1); 
					if($post) {
						setup_postdata($post); 
						include(locate_template('parts/entry-alt.php'));
						wp_reset_postdata(); 
					}
				}
                ?>
            </div>
            <div class="col-sm-6 col-md-3">
                <?php 
				if($juliet_frontpage_featured_posts_post_2 != '') {
					$post = get_post($juliet_frontpage_featured_posts_post_2); 
					if($post) { 
						setup_postdata($post); 
						include(locate_template('parts/entry-alt.php'));
						wp_reset_postdata(); 
					}
				}
                ?>
            </div>
            <div class="col-sm-6 col-md-3">
                <?php 
				if($juliet_frontpage_featured_posts_post_3 != '') {
					$post = get_post($juliet_frontpage_featured_posts_post_3); 
					if($post) {
						setup_postdata($post); 
						include(locate_template('parts/entry-alt.php'));
						wp_reset_postdata(); 
					}
				}
                ?>
            </div>
            <div class="col-sm-6 col-md-3">
                <?php 
				if($juliet_frontpage_featured_posts_post_4 != '') {
					$post = get_post($juliet_frontpage_featured_posts_post_4); 
					if($post){
						setup_postdata($post); 
						include(locate_template('parts/entry-alt.php'));
						wp_reset_postdata(); 
					}
				}
                ?>
                
            </div>
        </div>
    </div>
    <!-- /Frontpage Featured Posts -->
    
<?php } ?>