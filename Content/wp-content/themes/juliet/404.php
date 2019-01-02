<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package juliet  
 *
 */
?>
<?php get_header(); ?>

<!-- Two Columns -->
<div class="row two-columns">
    <!-- Main Column -->
    <div class="main-column col-md-12">
        
        <!-- Page Content -->
        <div id="error-404">
            <h1 class="entry-title"><?php esc_html_e('404', 'juliet'); ?></h1>
            <h3><?php esc_html_e('Page Not Found', 'juliet'); ?></h3>
        </div>
        <!-- /Page Content -->
        
    </div>
    <!-- /Main Column -->


</div>
<!-- /Two Columns -->

<hr />

<?php get_footer(); ?>