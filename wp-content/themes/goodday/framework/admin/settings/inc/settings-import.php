<?php
/**
 * @package 	WordPress
 * @subpackage 	GoodDay
 * @version		1.0.0
 * 
 * Theme Settings Importer
 * Created by CMSMasters
 * 
 */


$parse_uri = explode('wp-content', $_SERVER['SCRIPT_FILENAME']);

require_once($parse_uri[0] . 'wp-load.php');


if (isset($_POST['settings'])) {
	$settings = json_decode(base64_decode($_POST['settings']), true);
	
	
	$custom_css = '';
	
	
	foreach ($settings as $name => $value) {
		update_option($name, $value);
	}
	
	
	$custom_css .= cmsms_theme_fonts();
	
	$custom_css .= cmsms_theme_colors();
	
	
	cmsms_write_styles($custom_css);
}

