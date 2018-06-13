<?php
/**
 * Headerdata of Theme options.
 * @package StairWay
 * @since StairWay 1.0.0
*/  

// additional js and css
if(	!is_admin()){
function stairway_fonts_include () {
global $stairway_options_db;
// Google Fonts
$bodyfont = $stairway_options_db['stairway_body_google_fonts'];
$headingfont = $stairway_options_db['stairway_headings_google_fonts'];
$descriptionfont = $stairway_options_db['stairway_description_google_fonts'];
$headlinefont = $stairway_options_db['stairway_headline_google_fonts'];
$headlineboxfont = $stairway_options_db['stairway_headline_box_google_fonts'];
$postentryfont = $stairway_options_db['stairway_postentry_google_fonts'];
$sidebarfont = $stairway_options_db['stairway_sidebar_google_fonts'];
$menufont = $stairway_options_db['stairway_menu_google_fonts'];
$topmenufont = $stairway_options_db['stairway_top_menu_google_fonts'];

$fonturl = "//fonts.googleapis.com/css?family=";

$bodyfonturl = $fonturl.$bodyfont;
$headingfonturl = $fonturl.$headingfont;
$descriptionfonturl = $fonturl.$descriptionfont;
$headlinefonturl = $fonturl.$headlinefont;
$headlineboxfonturl = $fonturl.$headlineboxfont;
$postentryfonturl = $fonturl.$postentryfont;
$sidebarfonturl = $fonturl.$sidebarfont;
$menufonturl = $fonturl.$menufont;
$topmenufonturl = $fonturl.$topmenufont;
	// Google Fonts
     if ($bodyfont != 'default' && $bodyfont != ''){
      wp_enqueue_style('stairway-google-font1', $bodyfonturl); 
		 }
     if ($headingfont != 'default' && $headingfont != ''){
      wp_enqueue_style('stairway-google-font2', $headingfonturl);
		 }
     if ($descriptionfont != 'default' && $descriptionfont != ''){
      wp_enqueue_style('stairway-google-font3', $descriptionfonturl);
		 }
     if ($headlinefont != 'default' && $headlinefont != ''){
      wp_enqueue_style('stairway-google-font4', $headlinefonturl); 
		 }
     if ($postentryfont != 'default' && $postentryfont != ''){
      wp_enqueue_style('stairway-google-font5', $postentryfonturl); 
		 }
     if ($sidebarfont != 'default' && $sidebarfont != ''){
      wp_enqueue_style('stairway-google-font6', $sidebarfonturl);
		 }
     if ($menufont != 'default' && $menufont != ''){
      wp_enqueue_style('stairway-google-font8', $menufonturl);
		 }
     if ($topmenufont != 'default' && $topmenufont != ''){
      wp_enqueue_style('stairway-google-font9', $topmenufonturl);
		 }
     if ($headlineboxfont != 'default' && $headlineboxfont != ''){
      wp_enqueue_style('stairway-google-font10', $headlineboxfonturl); 
		 }
}
add_action( 'wp_enqueue_scripts', 'stairway_fonts_include' );
}

// additional css
function stairway_css_include () {
global $stairway_options_db;
	if ($stairway_options_db['stairway_css'] == 'Green (default)' ){
			wp_enqueue_style('stairway-style', get_stylesheet_uri());
		}
    
    if ($stairway_options_db['stairway_css'] == 'Purple' ){
			wp_enqueue_style('stairway-style-purple', get_template_directory_uri().'/css/purple.css');
		}

		if ($stairway_options_db['stairway_css'] == 'Red' ){
			wp_enqueue_style('stairway-style-red', get_template_directory_uri().'/css/red.css');
		}
}
add_action( 'wp_enqueue_scripts', 'stairway_css_include' );

// Display sidebar
function stairway_display_sidebar() {
global $stairway_options_db;
    $display_sidebar = $stairway_options_db['stairway_display_sidebar']; 
		if ($display_sidebar == 'Hide') { ?>
		<?php _e('#wrapper .container #main-content { width: 100%; }', 'stairway'); ?>
<?php } 
}

// Display Breadcrumb Navigation - headline width
function stairway_display_breadcrumb_headline() {
global $stairway_options_db;
    $display_breadcrumb = $stairway_options_db['stairway_display_breadcrumb']; 
		if ($display_breadcrumb == 'Hide' || !function_exists( 'bcn_display' )) { ?>
		<?php _e('#wrapper .content-headline h1 { width: 100%; }', 'stairway'); ?>
<?php } 
}

// Title Box width
function stairway_get_page_title_width() {
global $stairway_options_db;
    $page_title_width = $stairway_options_db['stairway_page_title_width']; 
		if ($page_title_width != '' && $page_title_width != '50%') { ?>
		<?php _e('#wrapper #wrapper-header .title-box { width: ', 'stairway'); ?><?php echo $page_title_width ?><?php _e(';}', 'stairway'); ?>
<?php } 
}

// Menu Box width
function stairway_get_header_menu_width() {
global $stairway_options_db;
    $header_menu_width = $stairway_options_db['stairway_header_menu_width']; 
		if ($header_menu_width != '' && $header_menu_width != '50%') { ?>
		<?php _e('#wrapper #wrapper-header .menu-box { width: ', 'stairway'); ?><?php echo $header_menu_width ?><?php _e(';}', 'stairway'); ?>
<?php } 
}

// Homepage Header Image
function stairway_get_homepage_header_image() {
    $homepage_header_image = get_header_image();
		if ($homepage_header_image != '') { ?>
		<?php _e('#wrapper #wrapper-header .header-image { background-image: url(', 'stairway'); ?><?php esc_url(header_image()); ?><?php _e('); height: ', 'stairway'); ?><?php echo get_custom_header()->height; ?><?php _e('px; }', 'stairway'); ?>
<?php } else { ?> 
<?php _e('#wrapper #wrapper-header .header-image { display: none; }', 'stairway'); ?>
<?php } 
}

// Homepage Header Image Size
function stairway_get_header_image_size() {
global $stairway_options_db;
    $header_image_size = $stairway_options_db['stairway_header_image_size']; 
		if ($header_image_size != '' && $header_image_size != 'Cover') { ?>
		<?php _e('#wrapper #wrapper-header .header-image{ background-size: auto; }', 'stairway'); ?>
<?php } 
}

// FONTS
// Body font
function stairway_get_body_font() {
global $stairway_options_db;
    $bodyfont = $stairway_options_db['stairway_body_google_fonts'];
    if ($bodyfont != 'default' && $bodyfont != '') { ?>
    <?php _e('html body, #wrapper blockquote, #wrapper q, #wrapper .container #comments .comment, #wrapper .container #comments .comment time, #wrapper .container #commentform .form-allowed-tags, #wrapper .container #commentform p, #wrapper input, #wrapper button, #wrapper select { font-family: "', 'stairway'); ?><?php echo $bodyfont ?><?php _e('", Arial, Helvetica, sans-serif; }', 'stairway'); ?>
<?php } 
}

// Site title font
function stairway_get_headings_google_fonts() {
global $stairway_options_db;
    $headingfont = $stairway_options_db['stairway_headings_google_fonts']; 
		if ($headingfont != 'default' && $headingfont != '') { ?>
		<?php _e('#wrapper #wrapper-header .site-title { font-family: "', 'stairway'); ?><?php echo $headingfont ?><?php _e('", Arial, Helvetica, sans-serif; }', 'stairway'); ?>
<?php } 
}

// Site description font
function stairway_get_description_font() {
global $stairway_options_db;
    $descriptionfont = $stairway_options_db['stairway_description_google_fonts'];
    if ($descriptionfont != 'default' && $descriptionfont != '') { ?>
    <?php _e('#wrapper #wrapper-header .header-description h1 {font-family: "', 'stairway'); ?><?php echo $descriptionfont ?><?php _e('", Arial, Helvetica, sans-serif; }', 'stairway'); ?>
<?php } 
}

// Page/post headlines font
function stairway_get_headlines_font() {
global $stairway_options_db;
    $headlinefont = $stairway_options_db['stairway_headline_google_fonts'];
    if ($headlinefont != 'default' && $headlinefont != '') { ?>
		<?php _e('#wrapper h1, #wrapper h2, #wrapper h3, #wrapper h4, #wrapper h5, #wrapper h6, #wrapper .container .navigation .section-heading { font-family: "', 'stairway'); ?><?php echo $headlinefont ?><?php _e('", Arial, Helvetica, sans-serif; }', 'stairway'); ?>
<?php } 
}

// StairWay Posts Widgets headlines font
function stairway_get_headline_box_google_fonts() {
global $stairway_options_db;
    $headline_box_google_fonts = $stairway_options_db['stairway_headline_box_google_fonts']; 
		if ($headline_box_google_fonts != 'default' && $headline_box_google_fonts != '') { ?>
		<?php _e('#wrapper .container #main-content section .entry-headline { font-family: "', 'stairway'); ?><?php echo $headline_box_google_fonts ?><?php _e('", Arial, Helvetica, sans-serif; }', 'stairway'); ?>
<?php } 
}

// Post entry font
function stairway_get_postentry_font() {
global $stairway_options_db;
    $postentryfont = $stairway_options_db['stairway_postentry_google_fonts']; 
		if ($postentryfont != 'default' && $postentryfont != '') { ?>
		<?php _e('#wrapper #main-content .post-entry .post-entry-headline, #wrapper #main-content .slides li, #wrapper #main-content .home-list-posts ul li, #wrapper #main-content .home-thumbnail-posts .thumbnail-hover { font-family: "', 'stairway'); ?><?php echo $postentryfont ?><?php _e('", Arial, Helvetica, sans-serif; }', 'stairway'); ?>
<?php } 
}

// Sidebar and Footer widget headlines font
function stairway_get_sidebar_widget_font() {
global $stairway_options_db;
    $sidebarfont = $stairway_options_db['stairway_sidebar_google_fonts'];
    if ($sidebarfont != 'default' && $sidebarfont != '') { ?>
		<?php _e('#wrapper .container #sidebar .sidebar-widget .sidebar-headline, #wrapper #wrapper-footer #footer .footer-widget .footer-headline { font-family: "', 'stairway'); ?><?php echo $sidebarfont ?><?php _e('", Arial, Helvetica, sans-serif; }', 'stairway'); ?>
<?php } 
}

// Main Header menu font
function stairway_get_menu_font() {
global $stairway_options_db;
    $menufont = $stairway_options_db['stairway_menu_google_fonts']; 
		if ($menufont != 'default' && $menufont != '') { ?>
		<?php _e('#wrapper #wrapper-header .menu-box ul li { font-family: "', 'stairway'); ?><?php echo $menufont ?><?php _e('", Arial, Helvetica, sans-serif; }', 'stairway'); ?>
<?php } 
}

// Top Header menu font
function stairway_get_top_menu_font() {
global $stairway_options_db;
    $topmenufont = $stairway_options_db['stairway_top_menu_google_fonts']; 
		if ($topmenufont != 'default' && $topmenufont != '') { ?>
		<?php _e('#wrapper #wrapper-header .top-navigation ul li { font-family: "', 'stairway'); ?><?php echo $topmenufont ?><?php _e('", Arial, Helvetica, sans-serif; }', 'stairway'); ?>
<?php } 
}

// User defined CSS.
function stairway_get_own_css() {
global $stairway_options_db;
    $own_css = $stairway_options_db['stairway_own_css']; 
		if ($own_css != '') { ?>
		<?php echo esc_attr($own_css); ?>
<?php } 
}

// Display custom CSS.
function stairway_custom_styles() { ?>
<?php echo ("<style type='text/css'>"); ?>
<?php stairway_get_own_css(); ?>
<?php stairway_display_sidebar(); ?>
<?php stairway_display_breadcrumb_headline(); ?>
<?php stairway_get_page_title_width(); ?>
<?php stairway_get_header_menu_width(); ?>
<?php stairway_get_homepage_header_image(); ?>
<?php stairway_get_header_image_size(); ?>
<?php stairway_get_body_font(); ?>
<?php stairway_get_headings_google_fonts(); ?>
<?php stairway_get_description_font(); ?>
<?php stairway_get_headlines_font(); ?>
<?php stairway_get_headline_box_google_fonts(); ?>
<?php stairway_get_postentry_font(); ?>
<?php stairway_get_sidebar_widget_font(); ?>
<?php stairway_get_menu_font(); ?>
<?php stairway_get_top_menu_font(); ?>
<?php echo ("</style>"); ?>
<?php
} 
add_action('wp_enqueue_scripts', 'stairway_custom_styles');	?>