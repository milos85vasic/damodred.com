<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Fotografo
 */

?>

	</div><!-- #content -->

</div><!-- #page -->

<?php wp_footer(); ?>
<script>
(function( $ ) {
    "use strict"; 
    // javascript code here. i.e.: $(document).ready( function(){} ); 
	 $( "#menu-toogle" ).click(function() {
		$( ".nav-panel" ).toggleClass( "active" );
	});
})(jQuery);
</script>
</body>
</html>
