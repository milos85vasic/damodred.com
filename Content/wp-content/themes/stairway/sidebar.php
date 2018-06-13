<?php
/**
 * The sidebar template file.
 * @package StairWay
 * @since StairWay 1.0.0
*/
?>
<?php global $stairway_options_db; ?>
<?php if ($stairway_options_db['stairway_display_sidebar'] != 'Hide'){ ?>
<aside id="sidebar">
<?php if ( dynamic_sidebar( 'sidebar-1' ) ) : else : ?>
<?php endif; ?>
</aside> <!-- end of sidebar -->
<?php } ?>