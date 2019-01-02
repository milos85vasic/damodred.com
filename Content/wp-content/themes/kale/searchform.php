<?php
/**
 * The template for displaying the search form
 *
 * @package kale
 */
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <div class="form-group">
    	<input type="search" class="search-field form-control" value="<?php echo get_search_query(); ?>" name="s" />
    </div>
    <div class="form-actions">
    	<button type="submit" class="btn btn-default"><?php esc_html_e( 'Search', 'kale' ); ?></button>
    </div>
</form>

<span class="search-trigger"><i class="fa fa-search"></i></span>
