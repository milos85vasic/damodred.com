<?php
/**
* The main template file.
* 
* @package juliet
*/
?>
<?php get_header(); ?>

<?php 
$show_sidebar = false;
if(is_front_page() && !is_paged() ) {
    $juliet_frontpage_blog_feed_sidebar = juliet_get_option('juliet_frontpage_blog_feed_sidebar');
    if($juliet_frontpage_blog_feed_sidebar == 1)    $show_sidebar = true;  
} else {
    $juliet_blog_feed_sidebar = juliet_get_option('juliet_blog_feed_sidebar');
    if($juliet_blog_feed_sidebar == 1) $show_sidebar = true;
}
?>

<?php 
if($show_sidebar) { ?>
<div class="row two-columns">
    <div class="main-column col-md-9"><?php get_template_part('parts/feed'); ?></div>
    <?php get_sidebar(); ?>
</div>
<?php } else { ?>
<div class="row one-column">
    <div class="main-column col-md-12"><?php get_template_part('parts/feed'); ?></div>
</div>
<?php } ?>

<?php get_footer(); ?>