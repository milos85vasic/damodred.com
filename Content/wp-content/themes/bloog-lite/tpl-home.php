<?php
/**
 * Template Name: Home Page
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Bloog Lite
 */

get_header(); ?>
<?php
$bloog_layout_home = get_theme_mod('homepage_layout_setting','fullwidth-home');
?>
<div class="bloog-wrapper">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

            <?php
            $bloog_arr_category = '';
            for($i=1; $i<=4; $i++){
                $bloog_cat_home = get_theme_mod('home_post_display_cat_'.$i);

                if(!empty($bloog_cat_home)){
                    $bloog_arr_category = $bloog_arr_category.$bloog_cat_home.',';
                }
            }
            ?>
            <?php

            if(!empty($bloog_arr_category)){
                if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
                elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
                else { $paged = 1; }
                $bloog_home_args = array(
                    'post_type' => 'post',
                    'cat' => $bloog_arr_category,
                    'posts_per_page' =>6,
                    'post_status' => 'publish',
                    'order' => 'DESC',
                    'paged' => $paged
                    );
                $bloog_home_posts = new WP_Query($bloog_home_args);

                if($bloog_home_posts -> have_posts()){
                    $i=0;
                    while($bloog_home_posts -> have_posts()){
                        $bloog_home_posts -> the_post();
                        if($i%3==1 && $bloog_layout_home!='gridview-home') { echo '<div class="half clearfix">'; }
                        get_template_part( 'template-parts/content', $bloog_layout_home );
                        $i++;
                        if($i%3==0 && $bloog_layout_home!='gridview-home') { echo '</div>'; }
                    }
                    ?>
                    <div class="home_pagination_link">
                        <div class="older_pagination_home"><?php next_posts_link('Older Entries', $bloog_home_posts->max_num_pages ); ?></div>
                        <div class="new_pagination_home"><?php previous_posts_link('Newer Entries'); ?> </div>

                    </div>
                    <?php
                } ?>

                <?php
            }else {
                ?>
                <?php if ( current_user_can( 'edit_theme_options' ) ) { ?>
                    <h2 class="home_page_error_text"><?php echo __('Please choose cagetories to display posts in home page','bloog-lite')?></h2>
                    <?php
                } 
            }
            ?>
        </main><!-- #main -->
    </div><!-- #primary -->
    <?php if( $bloog_layout_home == 'fullwidth-sidebar-home'){ 
        get_sidebar();
    } ?>
</div> <!-- end of bloog-wrapper -->

<?php get_footer();