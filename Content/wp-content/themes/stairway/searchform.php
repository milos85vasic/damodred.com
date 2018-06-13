<?php
/**
 * The searchform template file.
 * @package StairWay
 * @since StairWay 1.0.0
*/
?>
<form id="searchform" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
  <div class="searchform-wrapper"><input type="text" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" id="s" placeholder="<?php esc_attr_e( 'Search here...', 'stairway' ); ?>" />
  <input type="image" src="<?php echo get_template_directory_uri(); ?>/images/empty.gif" class="send" name="searchsubmit" alt="send" /></div>
</form>