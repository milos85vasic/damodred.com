<?php
/**
 * Changelog
 */

$bloog_lite = wp_get_theme( 'bloog-lite' );
?>
<div class="featured-section changelog">
<?php
	WP_Filesystem();
	global $wp_filesystem;
	$bloog_lite_changelog       = $wp_filesystem->get_contents( get_template_directory() . '/readme.txt' );
	$changelog_start = strpos($bloog_lite_changelog,'== Changelog ==');
	$bloog_lite_changelog_before = substr($bloog_lite_changelog,0,($changelog_start+15));
	$bloog_lite_changelog = str_replace($bloog_lite_changelog_before,'',$bloog_lite_changelog);
	$bloog_lite_changelog = str_replace('**','<br/>**',$bloog_lite_changelog);
	$bloog_lite_changelog = str_replace('= 1.0','<br/><br/>= 1.0',$bloog_lite_changelog);
	echo $bloog_lite_changelog;
	echo '<hr />';
	?>
</div>