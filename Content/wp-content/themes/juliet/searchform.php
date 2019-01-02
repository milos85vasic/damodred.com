<?php
/**
 * The template for displaying the search form
 *
 * @package juliet
 */
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url( '/' )); ?>">
    <input type="search" class="search-field form-control" value="<?php echo get_search_query() ?>" name="s" />
</form>