<?php
/**
 * Sidebar
 *
 * @package kale
 */
?>
<?php 
$kale_sidebar_size = kale_get_option('kale_sidebar_size'); 
$kale_example_content = kale_get_option('kale_example_content'); 
?>
<!-- Sidebar -->
<div class="sidebar sidebar-column <?php if($kale_sidebar_size == 0) { ?> col-md-4 <?php } else { ?> col-md-3 <?php } ?>"> 
    <?php 

    if(is_active_sidebar('sidebar-default-bordered')) { ?><div class="sidebar-default-borders sidebar-block sidebar-borders"><?php dynamic_sidebar('sidebar-default-bordered'); ?></div><?php } 
    
    if(is_active_sidebar('sidebar-default')) { ?><div class="sidebar-default sidebar-block sidebar-no-borders"><?php dynamic_sidebar('sidebar-default'); ?></div><?php } 
    else if($kale_example_content == 1) { kale_example_sidebar(); } 
    ?>
</div>
<!-- /Sidebar -->