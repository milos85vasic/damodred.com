<?php
/**
* The file for displaying the search form
*
* @package GalleryWP WordPress Theme
* @copyright Copyright (C) 2018 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*/
?>

<form role="search" method="get" class="gallerywp-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
<label>
    <span class="screen-reader-text"><?php echo esc_html_x( 'Search for:', 'label', 'gallerywp' ); ?></span>
    <input type="search" class="gallerywp-search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'gallerywp' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
</label>
<input type="submit" class="gallerywp-search-submit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'gallerywp' ); ?>" />
</form>