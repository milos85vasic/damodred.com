<?php
/**
 * Displays the searchform
 *
 * @package Theme Freesia
 * @subpackage Excellent
 * @since Excellent 1.0
 */
?>
<form class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
	<?php
		$excellent_settings = excellent_get_theme_options();
		$excellent_search_form = $excellent_settings['excellent_search_text'];
		if($excellent_search_form !='Search &hellip;'): ?>
	<input type="search" name="s" class="search-field" placeholder="<?php echo esc_attr($excellent_search_form); ?>" autocomplete="off" />
	<button type="submit" class="search-submit"><i class="fa fa-search"></i></button>
	<?php else: ?>
	<input type="search" name="s" class="search-field" placeholder="<?php esc_attr_e( 'Search &hellip;', 'excellent' ); ?>" autocomplete="off">
	<button type="submit" class="search-submit"><i class="fa fa-search"></i></button>
	<?php endif; ?>
</form> <!-- end .search-form -->