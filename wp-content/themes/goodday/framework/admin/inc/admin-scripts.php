<?php
/**
 * @package 	WordPress
 * @subpackage 	GoodDay
 * @version 	1.0.0
 * 
 * Admin Panel Scripts & Styles
 * Created by CMSMasters
 * 
 */


function cmsmasters_admin_register($hook) {
	$screen = get_current_screen();
	
	
	wp_register_style('admin-icons-font', get_template_directory_uri() . '/framework/admin/inc/css/admin-icons-font.css', array(), '1.0.0', 'screen');
	
	wp_register_style('theme-icons', get_template_directory_uri() . '/css/fontello.css', array(), '1.0.0', 'screen');
	
	
	wp_register_script('cmsms-uploader-js', get_template_directory_uri() . '/framework/admin/inc/js/jquery.cmsmsUploader.js', array('jquery'), '1.0.0', true);
	
	
	wp_enqueue_style('admin-icons-font');
	
	
	wp_enqueue_script('cmsms-uploader-js');
	
	
	if ( 
		$hook == 'post.php' || 
		$hook == 'post-new.php' 
	) {
		wp_enqueue_style('theme-icons');
	}
	
	
	if ($screen->id == 'theme-settings_page_cmsms-settings-style') {
		cmsms_composer_icons();
		
		
		wp_enqueue_style('theme-icons');
	}
	
	
	wp_register_style('widgets-styles', get_template_directory_uri() . '/framework/admin/inc/css/widgets-styles.css', array(), '1.0.0', 'screen');
	
	
	wp_register_script('widgets-scripts', get_template_directory_uri() . '/framework/admin/inc/js/widgets-scripts.js', array('jquery'), '1.0.0', true);
	
	
	if ($hook == 'widgets.php') {
		wp_enqueue_style('theme-icons');
		
		wp_enqueue_style('widgets-styles');
		
		
		wp_enqueue_script('widgets-scripts');
	}
}

add_action('admin_enqueue_scripts', 'cmsmasters_admin_register');

