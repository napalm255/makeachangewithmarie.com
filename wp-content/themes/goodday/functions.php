<?php
/**
 * @package 	WordPress
 * @subpackage 	GoodDay
 * @version		1.1.0
 * 
 * Main Theme Functions File
 * Created by CMSMasters
 * 
 */


// Current Theme Constants
define('CMSMS_SHORTNAME', 'goodday');
define('CMSMS_FULLNAME', 'GoodDay');



/*** START EDIT THEME PARAMETERS HERE ***/

// Theme Settings System Fonts List
function cmsms_system_fonts_list() {
	$fonts = array( 
		"Arial, Helvetica, 'Nimbus Sans L', sans-serif" => 'Arial', 
		"Calibri, 'AppleGothic', 'MgOpen Modata', sans-serif" => 'Calibri', 
		"'Trebuchet MS', Helvetica, Garuda, sans-serif" => 'Trebuchet MS', 
		"'Comic Sans MS', Monaco, 'TSCu_Comic', cursive" => 'Comic Sans MS', 
		"Georgia, Times, 'Century Schoolbook L', serif" => 'Georgia', 
		"Verdana, Geneva, 'DejaVu Sans', sans-serif" => 'Verdana', 
		"Tahoma, Geneva, Kalimati, sans-serif" => 'Tahoma', 
		"'Lucida Sans Unicode', 'Lucida Grande', Garuda, sans-serif" => 'Lucida Sans', 
		"'Times New Roman', Times, 'Nimbus Roman No9 L', serif" => 'Times New Roman', 
		"'Courier New', Courier, 'Nimbus Mono L', monospace" => 'Courier New', 
	);
	
	
	return $fonts;
}



// Theme Settings Google Fonts List
function cmsms_google_fonts_list() {
	$fonts = array( 
		'' => __('None', 'cmsmasters'), 
		'Roboto:300,300italic,400,400italic,500,500italic,700,700italic' => 'Roboto', 
		'Roboto+Condensed:400,400italic,700,700italic' => 'Roboto Condensed', 
		'Open+Sans:300,300italic,400,400italic,700,700italic' => 'Open Sans', 
		'Open+Sans+Condensed:300,300italic,700' => 'Open Sans Condensed', 
		'Droid+Sans:400,700' => 'Droid Sans', 
		'Droid+Serif:400,400italic,700,700italic' => 'Droid Serif', 
		'PT+Sans:400,400italic,700,700italic' => 'PT Sans', 
		'PT+Sans+Caption:400,700' => 'PT Sans Caption', 
		'PT+Sans+Narrow:400,700' => 'PT Sans Narrow', 
		'PT+Serif:400,400italic,700,700italic' => 'PT Serif', 
		'Ubuntu:400,400italic,700,700italic' => 'Ubuntu', 
		'Ubuntu+Condensed' => 'Ubuntu Condensed', 
		'Headland+One' => 'Headland One', 
		'Source+Sans+Pro:300,300italic,400,400italic,700,700italic' => 'Source Sans Pro', 
		'Lato:400,400italic,700,700italic' => 'Lato', 
		'Cuprum:400,400italic,700,700italic' => 'Cuprum', 
		'Oswald:300,400,700' => 'Oswald', 
		'Yanone+Kaffeesatz:300,400,700' => 'Yanone Kaffeesatz', 
		'Lobster' => 'Lobster', 
		'Lobster+Two:400,400italic,700,700italic' => 'Lobster Two', 
		'Questrial' => 'Questrial', 
		'Raleway:300,400,500,600,700' => 'Raleway', 
		'Dosis:300,400,500,700' => 'Dosis', 
		'Cutive+Mono' => 'Cutive Mono', 
		'Quicksand:300,400,700' => 'Quicksand', 
		'Titillium+Web:300,300italic,400,400italic,600,600italic,700,700italic' => 'Titillium Web', 
		'Montserrat:400,700' => 'Montserrat', 
		'Cookie' => 'Cookie', 
	);
	
	
	return $fonts;
}



// Theme Settings Font Weights List
function cmsms_font_weight_list() {
	$list = array( 
		'normal' => 	'normal', 
		'100' => 		'100', 
		'200' => 		'200', 
		'300' => 		'300', 
		'400' => 		'400', 
		'500' => 		'500', 
		'600' => 		'600', 
		'700' => 		'700', 
		'800' => 		'800', 
		'900' => 		'900', 
		'bold' => 		'bold', 
		'bolder' => 	'bolder', 
		'lighter' => 	'lighter', 
	);
	
	
	return $list;
}



// Theme Settings Font Styles List
function cmsms_font_style_list() {
	$list = array( 
		'normal' => 	'normal', 
		'italic' => 	'italic', 
		'oblique' => 	'oblique', 
		'inherit' => 	'inherit', 
	);
	
	
	return $list;
}



// Theme Settings Text Transforms List
function cmsms_text_transform_list() {
	$list = array( 
		'none' => 'none', 
		'uppercase' => 'uppercase', 
		'lowercase' => 'lowercase', 
		'capitalize' => 'capitalize', 
	);
	
	
	return $list;
}



// Theme Settings Text Decorations List
function cmsms_text_decoration_list() {
	$list = array( 
		'none' => 'none', 
		'underline' => 'underline', 
		'overline' => 'overline', 
		'line-through' => 'line-through', 
	);
	
	
	return $list;
}



// Theme Settings Custom Color Schemes
function cmsms_custom_color_schemes_list() {
	$list = array( 
		'first' => __('Custom 1', 'cmsmasters'), 
		'second' => __('Custom 2', 'cmsmasters'), 
		'third' => __('Custom 3', 'cmsmasters'), 
		'fourth' => __('Custom 4', 'cmsmasters'), 
		'fifth' => __('Custom 5', 'cmsmasters'), 
	);
	
	
	return $list;
}

/*** STOP EDIT THEME PARAMETERS HERE ***/



// Theme Image Thumbnails Size
function cmsms_image_thumbnail_list() {
	$list = array( 
		'small-thumb' => array( 
			'width' => 		55, 
			'height' => 	55, 
			'crop' => 		true 
		), 
		'square-thumb' => array( 
			'width' => 		250, 
			'height' => 	250, 
			'crop' => 		true, 
			'title' => 		__('Square', 'cmsmasters') 
		), 
		'blog-masonry-thumb' => array( 
			'width' => 		580, 
			'height' => 	390, 
			'crop' => 		true, 
			'title' => 		__('Masonry Blog', 'cmsmasters') 
		), 
		'project-thumb' => array( 
			'width' => 		580, 
			'height' => 	460, 
			'crop' => 		true, 
			'title' => 		__('Project', 'cmsmasters') 
		), 
		'project-masonry-thumb' => array( 
			'width' => 		580, 
			'height' => 	9999, 
			'title' => 		__('Masonry Project', 'cmsmasters') 
		), 
		'post-thumbnail' => array( 
			'width' => 		820, 
			'height' => 	490, 
			'crop' => 		true, 
			'title' => 		__('Featured', 'cmsmasters') 
		), 
		'masonry-thumb' => array( 
			'width' => 		820, 
			'height' => 	9999, 
			'title' => 		__('Masonry', 'cmsmasters') 
		), 
		'full-thumb' => array( 
			'width' => 		1160, 
			'height' => 	700, 
			'crop' => 		true, 
			'title' => 		__('Full', 'cmsmasters') 
		), 
		'project-full-thumb' => array( 
			'width' => 		1160, 
			'height' => 	920, 
			'crop' => 		true, 
			'title' => 		__('Project Full', 'cmsmasters') 
		), 
		'full-masonry-thumb' => array( 
			'width' => 		1160, 
			'height' => 	9999, 
			'title' => 		__('Masonry Full', 'cmsmasters') 
		) 
	);
	
	
	return $list;
}



// Theme Settings All Color Schemes List
function cmsms_all_color_schemes_list() {
	$list = array( 
		'default' => 		__('Default', 'cmsmasters'), 
		'header' => 		__('Header', 'cmsmasters'), 
		'header_top' => 	__('Header Top', 'cmsmasters'), 
		'footer' => 		__('Footer', 'cmsmasters') 
	);
	
	
	$out = array_merge($list, cmsms_custom_color_schemes_list());
	
	
	return $out;
}



// Theme Settings Color Schemes List
function cmsms_color_schemes_list() {
	$list = cmsms_all_color_schemes_list();
	
	
	unset($list['header']);
	
	unset($list['header_top']);
	
	
	$out = array_merge($list, cmsms_custom_color_schemes_list());
	
	
	return $out;
}



// Theme Settings Color Schemes Default Colors
function cmsms_color_schemes_defaults() {
	$list = array( 
		'default' => array( // content default color scheme
			'color' => 		'#707070|100', 
			'link' => 		'#ff6b6b|100', 
			'hover' => 		'#3d3d3d|100', 
			'heading' => 	'#3d3d3d|100', 
			'bg' => 		'#ffffff|100', 
			'alternate' => 	'#fdfdfd|100', 
			'border' => 	'#dadada|100' 
		), 
		'header' => array( // Header color scheme
			'color' => 				'#707070|100', 
			'link' => 				'#3d3d3d|100', 
			'hover' => 				'#ffffff|100', 
			'bg' => 				'#ffffff|95', 
			'hover_bg' => 			'#3d3d3d|100', 
			'border' => 			'#ebebeb|100', 
			'dropdown_link' => 		'#9e9e9e|100', 
			'dropdown_hover' => 	'#3d3d3d|100', 
			'dropdown_bg' => 		'#ffffff|100', 
			'dropdown_hover_bg' => 	'#fbfbfb|100', 
			'dropdown_border' => 	'#ebebeb|100' 
		), 
		'header_top' => array( // Header Top color scheme
			'color' => 				'#9c9c9c|100', 
			'link' => 				'#838383|100', 
			'hover' => 				'#ffffff|100', 
			'bg' => 				'#3d3d3d|100', 
			'border' => 			'#333333|100', 
			'dropdown_link' => 		'#838383|100', 
			'dropdown_hover' => 	'#ffffff|100', 
			'dropdown_bg' => 		'#3d3d3d|100', 
			'dropdown_border' => 	'#333333|100' 
		), 
		'footer' => array( // Footer color scheme
			'color' => 		'#707070|100', 
			'link' => 		'#cacaca|100', 
			'hover' => 		'#ff6b6b|100', 
			'heading' => 	'#ffffff|100', 
			'bg' => 		'#3d3d3d|100', 
			'alternate' => 	'#414141|100', 
			'border' => 	'#5a5a5a|100' 
		), 
		'first' => array( // custom color scheme 1
			'color' => 		'#707070|100', 
			'link' => 		'#cacaca|100', 
			'hover' => 		'#ff6b6b|100', 
			'heading' => 	'#ffffff|100', 
			'bg' => 		'#3d3d3d|100', 
			'alternate' => 	'#414141|100', 
			'border' => 	'#5a5a5a|100' 
		), 
		'second' => array( // custom color scheme 2
			'color' => 		'#3d3d3d|100', 
			'link' => 		'#9e9e9e|100', 
			'hover' => 		'#3d3d3d|100', 
			'heading' => 	'#3d3d3d|100', 
			'bg' => 		'#ffffff|100', 
			'alternate' => 	'#fbfbfb|100', 
			'border' => 	'#ebebeb|100' 
		), 
		'third' => array( // custom color scheme 3
			'color' => 		'#9c9c9c|100', 
			'link' => 		'#838383|100', 
			'hover' => 		'#ffffff|100', 
			'heading' => 	'#ffffff|100', 
			'bg' => 		'#3d3d3d|100', 
			'alternate' => 	'#1f1f1f|100', 
			'border' => 	'#333333|100' 
		), 
		'fourth' => array( // custom color scheme 4
			'color' => 		'#707070|100', 
			'link' => 		'#ff6b6b|100', 
			'hover' => 		'#3d3d3d|100', 
			'heading' => 	'#3d3d3d|100', 
			'bg' => 		'#ffffff|100', 
			'alternate' => 	'#fdfdfd|100', 
			'border' => 	'#dadada|100' 
		), 
		'fifth' => array( // custom color scheme 5
			'color' => 		'#707070|100', 
			'link' => 		'#ff6b6b|100', 
			'hover' => 		'#3d3d3d|100', 
			'heading' => 	'#3d3d3d|100', 
			'bg' => 		'#ffffff|100', 
			'alternate' => 	'#fdfdfd|100', 
			'border' => 	'#dadada|100' 
		) 
	);
	
	
	return $list;
}



// CMSMasters Framework Directories Constants
define('CMSMS_FRAMEWORK', get_template_directory() . '/framework');
define('CMSMS_ADMIN', CMSMS_FRAMEWORK . '/admin');
define('CMSMS_SETTINGS', CMSMS_ADMIN . '/settings');
define('CMSMS_OPTIONS', CMSMS_ADMIN . '/options');
define('CMSMS_ADMIN_INC', CMSMS_ADMIN . '/inc');
define('CMSMS_CLASS', CMSMS_FRAMEWORK . '/class');
define('CMSMS_FUNCTION', CMSMS_FRAMEWORK . '/function');



// Load Framework Parts
require_once(CMSMS_SETTINGS . '/cmsms-theme-settings.php');

require_once(CMSMS_OPTIONS . '/cmsms-theme-options.php');

require_once(CMSMS_ADMIN_INC . '/admin-scripts.php');

require_once(CMSMS_ADMIN_INC . '/plugin-activator.php');

require_once(CMSMS_CLASS . '/twitteroauth.php');

require_once(CMSMS_CLASS . '/widgets.php');

require_once(CMSMS_FUNCTION . '/breadcrumbs.php');

require_once(CMSMS_FUNCTION . '/likes.php');

require_once(CMSMS_FUNCTION . '/pagination.php');

require_once(CMSMS_FUNCTION . '/single-comment.php');

require_once(CMSMS_FUNCTION . '/theme-functions.php');

require_once(CMSMS_FUNCTION . '/theme-colors.php');

require_once(CMSMS_FUNCTION . '/theme-fonts.php');

require_once(CMSMS_FUNCTION . '/template-functions.php');

require_once(CMSMS_FUNCTION . '/template-functions-post.php');

require_once(CMSMS_FUNCTION . '/template-functions-project.php');

require_once(CMSMS_FUNCTION . '/template-functions-profile.php');

require_once(CMSMS_FUNCTION . '/template-functions-shortcodes.php');

require_once(CMSMS_FUNCTION . '/template-functions-widgets.php');


// Woocommerce functions
if (class_exists('woocommerce')) {
	require_once(get_template_directory() . '/woocommerce/cmsms-woo-functions.php');
}



// Load Theme Local File
$locale = get_locale();

load_theme_textdomain('cmsmasters', CMSMS_FRAMEWORK . '/languages');

$locale_file = CMSMS_FRAMEWORK . '/languages/' . $locale . '.php';

if (is_readable($locale_file)) {
    require_once($locale_file);
}



// Framework Activation & Data Import
function cmsms_theme_activation() {
	if (get_option('cmsms_active_theme') != CMSMS_SHORTNAME) {
		add_option('cmsms_active_theme', CMSMS_SHORTNAME, '', 'yes');
		
		
		cmsms_add_global_options();
		
		
		$custom_css = '';
		
		$custom_css .= cmsms_theme_fonts();
		
		$custom_css .= cmsms_theme_colors();
		
		
		cmsms_write_styles($custom_css);
		
		
		wp_redirect(admin_url('admin.php?page=cmsms-settings&upgraded=true'));
	}
}

add_action('after_switch_theme', 'cmsms_theme_activation');



// Framework Deactivation
function cmsms_theme_deactivation() {
	delete_option('cmsms_active_theme');
}

add_action('switch_theme', 'cmsms_theme_deactivation');

