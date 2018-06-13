/*
 * Sticky menu Settings
 */

jQuery(document).ready(function(){
   var wpAdminBar = jQuery('#wpadminbar');
   if (wpAdminBar.length) {
      jQuery('#sticky-header').sticky({topSpacing:wpAdminBar.height()});
   } else {
      jQuery('#sticky-header').sticky({topSpacing:0});
   }
});