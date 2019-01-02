<?php $juliet_example_content = juliet_get_option('juliet_example_content');  ?>
<!-- Sidebar -->
<div class="sidebar-column col-md-3">
    
    <?php 
    
    if(is_front_page()) { 
        if(is_active_sidebar('sidebar-frontpage')) { ?><div class="sidebar-frontpage sidebar"><?php dynamic_sidebar('sidebar-frontpage'); ?></div><?php } 
    }
    
    if(is_single()) {
        if(is_active_sidebar('sidebar-single')) { ?><div class="sidebar-single sidebar"><?php dynamic_sidebar('sidebar-single'); ?></div><?php } 
    }
    
    if(is_page()) {
        if(is_active_sidebar('sidebar-page')) { ?><div class="sidebar-page sidebar"><?php dynamic_sidebar('sidebar-page'); ?></div><?php } 
    }
    
    if(is_active_sidebar('sidebar-default')) { ?><div class="sidebar-default sidebar"><?php dynamic_sidebar('sidebar-default'); ?></div><?php } 
	else if($juliet_example_content == 1) { juliet_example_sidebar(); } 
    
    ?>
    
    
</div>
<!-- /Sidebar -->