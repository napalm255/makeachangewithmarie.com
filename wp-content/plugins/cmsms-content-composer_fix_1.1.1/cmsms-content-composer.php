<?php 
/*
Plugin Name: CMSMasters Content Composer
Plugin URI: http://cmsmasters.net/
Description: CMSMasters Content Composer created by <a href="http://cmsmasters.net/" title="CMSMasters">CMSMasters</a> team. Content Composer plugin create custom visual editor with shortcodes & settings integrated to WordPress default content editor for new <a href="http://themeforest.net/user/cmsmasters/portfolio" title="cmsmasters">cmsmasters</a> WordPress themes.
Version: 1.1.1
Author: cmsmasters
Author URI: http://cmsmasters.net/
*/

/*  Copyright 2014 CMSMasters (email : cmsmstrs@gmail.com). All Rights Reserved.
	
	This software is distributed exclusively as appendant 
	to Wordpress themes, created by CMSMasters studio and 
	should be used in strict compliance to the terms, 
	listed in the License Terms & Conditions included 
	in software archive.
	
	If your archive does not include this file, 
	you may find the license text by url 
	http://cmsmasters.net/files/license/cmsms-content-composer/license.txt 
	or contact CMSMasters Studio at email 
	copyright.cmsmasters@gmail.com 
	about this.
	
	Please note, that any usage of this software, that 
	contradicts the license terms is a subject to legal pursue 
	and will result copyright reclaim and damage withdrawal.
*/


define('CMSMS_CONTENT_COMPOSER_PATH', plugin_dir_path(__FILE__));

define('CMSMS_CONTENT_COMPOSER_URL', plugin_dir_url(__FILE__));


require_once(CMSMS_CONTENT_COMPOSER_PATH . 'framework/cmsms-editor-plugin-register.php');

require_once(CMSMS_CONTENT_COMPOSER_PATH . 'framework/cmsms-composer-templates-posttype.php');

require_once(CMSMS_CONTENT_COMPOSER_PATH . 'framework/cmsms-composer-lightbox-functions.php');


require_once(CMSMS_CONTENT_COMPOSER_PATH . 'framework/inc/editor-additions.php');


require_once(CMSMS_CONTENT_COMPOSER_PATH . 'inc/shortcodes.php');


require_once(CMSMS_CONTENT_COMPOSER_PATH . 'inc/project/projects-posttype.php');

require_once(CMSMS_CONTENT_COMPOSER_PATH . 'inc/profile/profiles-posttype.php');


class Cmsms_Content_Composer { 
	function __construct() { 
		global $pagenow;
		
		
		add_action('widgets_init', array($this, 'cmsms_content_composer_widgets_init'), 1);
		
		
		if (is_admin()) {
			add_action('admin_enqueue_scripts', array($this, 'cmsms_composer_enqueue_scripts'));
			
			
			add_action('save_post', array($this, 'save_custom_composer_meta'));
			
			
			if ( 
				$pagenow == 'post-new.php' || 
				($pagenow == 'post.php' && isset($_GET['post']) && get_post_type($_GET['post']) != 'attachment') 
			) {
				add_action('admin_print_footer_scripts', array($this, 'cmsms_composer_init'));
				
				
				add_action('edit_form_after_title', array($this, 'add_composer_button'));
				
				
				add_action('add_meta_boxes', array($this, 'add_custom_composer_meta_box'), 1);
			}
		}
		
		// Load Plugin Local File
		load_plugin_textdomain('cmsms_content_composer', false, dirname(plugin_basename(__FILE__)) . '/languages/');
	}
	
	
	function cmsms_composer_enqueue_scripts($hook) {
		global $pagenow;
		
		
		wp_register_style('cmsms-admin-styles', CMSMS_CONTENT_COMPOSER_URL . 'framework/css/cmsms-admin.css', array(), '1.0.0', 'screen');
		
		wp_enqueue_style('cmsms-admin-styles');
		
		
		wp_register_style('cmsms_content_composer_css', CMSMS_CONTENT_COMPOSER_URL . 'css/jquery.cmsmsContentComposer.css', array(), '1.0.0', 'screen');
		
		wp_register_style('cmsms_composer_lightbox_css', CMSMS_CONTENT_COMPOSER_URL . 'css/jquery.cmsmsComposerLightbox.css', array(), '1.0.0', 'screen');
		
		wp_register_style('cmsms_content_composer_css_rtl', CMSMS_CONTENT_COMPOSER_URL . 'css/jquery.cmsmsContentComposer-rtl.css', array(), '1.0.0', 'screen');
		
		wp_register_style('cmsms_composer_lightbox_css_rtl', CMSMS_CONTENT_COMPOSER_URL . 'css/jquery.cmsmsComposerLightbox-rtl.css', array(), '1.0.0', 'screen');
		
		
		wp_register_script('cmsms_composer_shortcodes_js', CMSMS_CONTENT_COMPOSER_URL . 'js/cmsmsContentComposer-shortcodes.js', '', '1.0.0', true);
		
		wp_localize_script('cmsms_composer_shortcodes_js', 'cmsms_shortcodes', array( 
			'admin_url' => 										admin_url(), 
			'theme_url' => 										get_template_directory_uri(), 
			'def_text' =>										__('Click here to change this text', 'cmsms_content_composer'), 
			'note' =>											__('Note:', 'cmsms_content_composer'),
			'title' =>											__('Title', 'cmsms_content_composer'),
			'content' =>										__('Content', 'cmsms_content_composer'),
			'icon' =>											__('Icon', 'cmsms_content_composer'),
			'size' =>											__('Size', 'cmsms_content_composer'),
			'button' =>											__('Button', 'cmsms_content_composer'),
			'link' =>											__('Link', 'cmsms_content_composer'),
			'color' =>											__('Color', 'cmsms_content_composer'),
			'mode' =>											__('Mode', 'cmsms_content_composer'),
			'name' => 											__('Name', 'cmsms_content_composer'),
			'text_align' =>										__('Text Align', 'cmsms_content_composer'),
			'orderby_title' =>									__('Order By', 'cmsms_content_composer'),
			'order_title' =>									__('Order', 'cmsms_content_composer'),
			'order_descr' =>									__("Designates the ascending or descending order of the 'order by' parameter", 'cmsms_content_composer'),
			'categories' =>										__('Categories', 'cmsms_content_composer'),
			'layout_title' =>									__('Layout', 'cmsms_content_composer'),
			'click_here' => 									__('click here', 'cmsms_content_composer'),
			'more_info' => 										__('for more information', 'cmsms_content_composer'),
			'columns_count' =>									__('Columns Count', 'cmsms_content_composer'),
			'value_number' => 									__('number', 'cmsms_content_composer'),
			'value_zero' => 									__('(0 if empty)', 'cmsms_content_composer'),
			'choice_default' => 								__('Default', 'cmsms_content_composer'),
			'choice_block' =>									__('Block', 'cmsms_content_composer'),
			'choice_inline' =>									__('Inline', 'cmsms_content_composer'),
			'choice_inline_block' =>							__('Inline-Block', 'cmsms_content_composer'),
			'choice_left' => 									__('Left', 'cmsms_content_composer'),
			'choice_right' => 									__('Right', 'cmsms_content_composer'),
			'choice_center' => 									__('Center', 'cmsms_content_composer'),
			'choice_enable' => 									__('Enable', 'cmsms_content_composer'),
			'choice_show' => 									__('Show', 'cmsms_content_composer'),
			'choice_date' => 									__('Date', 'cmsms_content_composer'),
			'choice_id' => 										__('ID', 'cmsms_content_composer'),
			'choice_menu' => 									__('Menu Order', 'cmsms_content_composer'),
			'choice_popular' => 								__('Popular', 'cmsms_content_composer'),
			'choice_rand' => 									__('Random', 'cmsms_content_composer'),
			'choice_asc' => 									__('ASC', 'cmsms_content_composer'),
			'choice_desc' => 									__('DESC', 'cmsms_content_composer'),
			'choice_categories' => 								__('Categories', 'cmsms_content_composer'),
			'choice_comments' => 								__('Comments', 'cmsms_content_composer'),
			'choice_likes' => 									__('Likes', 'cmsms_content_composer'),
			'choice_author' => 									__('Author', 'cmsms_content_composer'),
			'choice_tags' => 									__('Tags', 'cmsms_content_composer'),
			'choice_title' => 									__('Title', 'cmsms_content_composer'),
			'choice_excerpt' => 								__('Excerpt', 'cmsms_content_composer'),
			'choice_rollover' => 								__('Image Rollover', 'cmsms_content_composer'),
			'choice_more' => 									__("'Read More' button", 'cmsms_content_composer'),
			'choice_vertical' => 								__('Vertical', 'cmsms_content_composer'),
			'choice_horizontal' => 								__('Horizontal', 'cmsms_content_composer'),
			'position_choice_left_side' =>						__('Left side', 'cmsms_content_composer'),
			'position_choice_right_side' =>						__('Right side', 'cmsms_content_composer'),
			'button_icon_descr' =>								__('Choose icon for your button', 'cmsms_content_composer'),
			'filter' =>											__('Filter', 'cmsms_content_composer'),
			'filter_text_title' =>								__('Filter Button Text', 'cmsms_content_composer'),
			'filter_text_descr' =>								__('Enter filter button custom title', 'cmsms_content_composer'),
			'filter_text_descr_note' =>							__('if empty, default filter button title will be used', 'cmsms_content_composer'),
			'filter_enabled_text_descr_note' =>					__('This option works only if filter enabled', 'cmsms_content_composer'),
			'filter_cats_text_title' =>							__("Filter 'All Categories' Text", 'cmsms_content_composer'),
			'filter_cats_text_descr' =>							__("Enter filter 'All Categories' custom text", 'cmsms_content_composer'),
			'filter_cats_text_descr_note' =>					__("if empty, default filter 'All Categories' text will be used", 'cmsms_content_composer'),
			'sorting_name_text_title' =>						__('Sorting By Name Button Text', 'cmsms_content_composer'),
			'sorting_name_text_descr' =>						__('Enter sorting by name button custom title', 'cmsms_content_composer'),
			'sorting_name_text_descr_note' =>					__('if empty, default sorting by name button title will be used', 'cmsms_content_composer'),
			'sorting_date_text_title' =>						__('Sorting By Date Button Text', 'cmsms_content_composer'),
			'sorting_date_text_descr' =>						__('Enter sorting by date button custom title', 'cmsms_content_composer'),
			'sorting_date_text_descr_note' =>					__('if empty, default sorting by date button title will be used', 'cmsms_content_composer'),
			'sorting_enabled_text_descr_note' =>				__('This option works only if sorting enabled', 'cmsms_content_composer'),
			'pagination_choice_pagination' =>					__('Pagination', 'cmsms_content_composer'),
			'pagination_choice_more' =>							__("'Load More' button", 'cmsms_content_composer'),
			'pagination_choice_disabled' =>						__('Disable additional posts', 'cmsms_content_composer'),
			'pagination_title' =>								__('Pagination', 'cmsms_content_composer'),
			'pagination_descr' =>								__('Choose your method of viewing additional posts', 'cmsms_content_composer'),
			'pagination_more_text_title' =>						__("'Load More' Button Text", 'cmsms_content_composer'),
			'pagination_more_text_descr' =>						__("Enter 'Load More' button custom title", 'cmsms_content_composer'),
			'pagination_more_text_descr_note' =>				__("if empty, default 'Load More' button title will be used", 'cmsms_content_composer'),
			'animation_title' => 								__('Animation', 'cmsms_content_composer'), 
			'animation_descr' =>								__('Shortcode animation effect when a user scrolls to its position for the first time.', 'cmsms_content_composer'), 
			'animation_descr_note' =>							__('This option works only in modern browsers', 'cmsms_content_composer'), 
			'animation_delay_title' => 							__('Animation Delay', 'cmsms_content_composer'), 
			'animation_delay_descr' =>							__('Delay before shortcode animation starts', 'cmsms_content_composer'), 
			'animation_delay_descr_note' =>						__('number, in milliseconds (1 second = 1000 milliseconds)', 'cmsms_content_composer'),
			'classes_title' => 									__('Additional Classes', 'cmsms_content_composer'), 
			'classes_descr' =>									__('You can add additional CSS classes (separated by spaces) to the shortcode, if you wish to style content elements differently', 'cmsms_content_composer'),
			'size_note' =>										__('number, in pixels (default value if empty)', 'cmsms_content_composer'),
			'size_zero_note' =>									__('number, in pixels (default value if empty or 0)', 'cmsms_content_composer'),
			'size_note_percentage' =>							__('number, percentage (default value if empty)', 'cmsms_content_composer'),
			'size_note_short' =>								__('number, in pixels', 'cmsms_content_composer'),
			'button_visible_note' =>							__('This option works only if button is visible.', 'cmsms_content_composer'),
			'link_target_choice_self' =>						__('Open link in a SAME tab/window', 'cmsms_content_composer'),
			'link_target_choice_blank' =>						__('Open link in a NEW tab/window', 'cmsms_content_composer'),
			'border_radius_descr_note_1' =>						__('You can set any border radius rule here.', 'cmsms_content_composer'),
			'border_radius_descr_note_2' =>						__('For creating correct rule please use', 'cmsms_content_composer'),
			'border_radius_descr_note_3' =>						__('border radius generator', 'cmsms_content_composer'),
			'border_radius_descr_note_4' =>						__('But copy only value of the first rule, for example like', 'cmsms_content_composer'),
			'border_radius_descr_note_5' =>						__('on this screenshot', 'cmsms_content_composer'),
			'text_title' => 									__('Text Block', 'cmsms_content_composer'), 
			'text_field_content_title' => 						__('Content', 'cmsms_content_composer'), 
			'heading_def' =>									__('Heading', 'cmsms_content_composer'),
			'heading_field_text_title' =>						__('Heading Text', 'cmsms_content_composer'),
			'heading_field_text_descr' =>						__('Enter your special heading text', 'cmsms_content_composer'),
			'heading_field_type_title' =>						__('Heading Type', 'cmsms_content_composer'),
			'heading_field_type_descr' =>						__('Choose type of your heading tag', 'cmsms_content_composer'),
			'heading_field_font_title' =>						__('Google Font', 'cmsms_content_composer'),
			'heading_field_font_descr' =>						__('Choose Google font for your custom heading', 'cmsms_content_composer'),
			'heading_field_font_size_title' =>					__('Font Size', 'cmsms_content_composer'),
			'heading_field_font_size_descr' =>					__('Enter font size for your custom heading', 'cmsms_content_composer'),
			'heading_field_line_hight_title' =>					__('Line Height', 'cmsms_content_composer'),
			'heading_field_line_height_descr' =>				__('Enter line height for your custom heading', 'cmsms_content_composer'),
			'heading_field_font_weight_title' =>				__('Font Weight', 'cmsms_content_composer'),
			'heading_field_font_weight_descr' =>				__('Choose font weight for your custom heading', 'cmsms_content_composer'),
			'heading_field_font_style_title' =>					__('Font Style', 'cmsms_content_composer'),
			'heading_field_font_style_descr' =>					__('Choose font style for your custom heading', 'cmsms_content_composer'),
			'heading_field_text_align_descr' =>					__('Choose text align for your custom heading', 'cmsms_content_composer'),
			'heading_field_link_title' =>						__('Heading Link', 'cmsms_content_composer'),
			'heading_field_link_descr' =>						__('Enter heading link here', 'cmsms_content_composer'),
			'heading_field_target_title' =>						__('Heading Link Target', 'cmsms_content_composer'),
			'heading_field_target_descr' =>						__('Choose heading link target type', 'cmsms_content_composer'),
			'heading_field_custom_color_title' =>				__('Custom Heading Color', 'cmsms_content_composer'),
			'heading_field_custom_color_descr' =>				__('If not checked, heading will use color of parent section color scheme', 'cmsms_content_composer'),
			'heading_field_color_title' =>						__('Heading Color', 'cmsms_content_composer'),
			'heading_field_color_descr' =>						__('Choose your custom heading color', 'cmsms_content_composer'),
			'heading_field_color_transparency_title' =>			__('Heading Color Transparency', 'cmsms_content_composer'),
			'heading_field_color_transparency_descr' =>			__('Choose your custom heading color transparency', 'cmsms_content_composer'),
			'heading_field_top_margin_title' =>					__('Top Margin', 'cmsms_content_composer'),
			'heading_field_top_margin_descr' =>					__('Enter your custom heading top margin', 'cmsms_content_composer'),
			'heading_field_bottom_margin_title' =>				__('Bottom Margin', 'cmsms_content_composer'),
			'heading_field_bottom_margin_descr' =>				__('Enter your custom heading bottom margin', 'cmsms_content_composer'),
			'dropcap_title' =>									__('Dropcap', 'cmsms_content_composer'), 
			'dropcap_field_text_title' =>						__('Dropcap Letter', 'cmsms_content_composer'),
			'dropcap_field_text_descr' =>						__('Enter your special heading text', 'cmsms_content_composer'),
			'dropcap_field_type_title' =>						__('Heading Type', 'cmsms_content_composer'),
			'dropcap_field_type_descr' =>						__('Choose type of your heading tag', 'cmsms_content_composer'),
			'dropcap_field_type_1' =>							__('Default Dropcap', 'cmsms_content_composer'),
			'dropcap_field_type_2' =>							__('Styled Dropcap', 'cmsms_content_composer'),
			'icon_title' =>										__('Icon Box', 'cmsms_content_composer'),
			'icon_field_box_title_title' =>						__('Box Title', 'cmsms_content_composer'),
			'icon_field_box_title_descr' =>						__('Enter box title here', 'cmsms_content_composer'),
			'icon_field_box_title_def' =>						__('Enter box title', 'cmsms_content_composer'),
			'icon_field_box_type_title' =>						__('Box Type', 'cmsms_content_composer'),
			'icon_field_box_type_descr' =>						__('Choose type of your icon box', 'cmsms_content_composer'),
			'icon_field_box_type_choice_heading' =>				__('Heading Icon Box', 'cmsms_content_composer'),
			'icon_field_box_type_choice_centered' =>			__('Centered Box', 'cmsms_content_composer'),
			'icon_field_box_type_choice_colored' =>				__('Centered Colored Box', 'cmsms_content_composer'),
			'icon_field_box_type_choice_lefticon' =>			__('Floated Icon Box', 'cmsms_content_composer'),
			'icon_field_custom_box_color_title' =>				__('Custom Box Color', 'cmsms_content_composer'),
			'icon_field_custom_box_color_descr' =>				__('If not checked, icon box will use parent section color scheme colors', 'cmsms_content_composer'),
			'icon_field_box_color_title' =>						__('Box Color', 'cmsms_content_composer'),
			'icon_field_box_color_descr' =>						__('Choose your custom box color. ', 'cmsms_content_composer'),
			'icon_field_box_color_descr_note' =>				__('Depending on the box type color will be applied to box background, icon color or button background ', 'cmsms_content_composer'),			
			'icon_field_button_descr' =>						__('If checked, button will be shown', 'cmsms_content_composer'),
			'icon_field_button_label_title' =>					__('Button Label', 'cmsms_content_composer'),
			'icon_field_button_label_descr' =>					__('Enter button label here', 'cmsms_content_composer'),			
			'icon_field_button_link_title' =>					__('Button Link', 'cmsms_content_composer'),
			'icon_field_button_link_descr' =>					__('Enter button link here', 'cmsms_content_composer'),
			'icon_field_button_target_title' =>					__('Button Target', 'cmsms_content_composer'),
			'icon_field_button_target_descr' =>					__('Choose button link target type', 'cmsms_content_composer'),
			'featured_title' =>									__('Featured Block', 'cmsms_content_composer'),
			'featured_field_content_title' =>					__('Content', 'cmsms_content_composer'),
			'featured_field_cust_block_color_title' =>			__('Custom Block Colors', 'cmsms_content_composer'),
			'featured_field_cust_block_color_descr' =>			__('If not checked, featured block will use parent section color scheme colors', 'cmsms_content_composer'),
			'featured_field_block_bg_color_title' =>			__('Block Background Color', 'cmsms_content_composer'),
			'featured_field_block_bg_color_descr' =>			__('Choose your custom block background color', 'cmsms_content_composer'),
			'featured_field_block_txt_color_title' =>			__('Block Text Color', 'cmsms_content_composer'),
			'featured_field_block_txt_color_descr' =>			__('Choose your custom block text color', 'cmsms_content_composer'),
			'featured_field_button_bg_color_title' =>			__('Button Background Color', 'cmsms_content_composer'),
			'featured_field_button_bg_color_descr' =>			__('Choose your custom button background color.', 'cmsms_content_composer'),			
			'featured_field_button_txt_color_title' =>			__('Button Title Color', 'cmsms_content_composer'),
			'featured_field_button_txt_color_descr' =>			__('Choose your custom button text color.', 'cmsms_content_composer'),			
			'featured_field_button_descr' =>					__('If checked, button will be shown', 'cmsms_content_composer'),
			'featured_field_button_title_title' =>				__('Button Title', 'cmsms_content_composer'),
			'featured_field_button_title_descr' =>				__('Enter button title here', 'cmsms_content_composer'),			
			'featured_field_button_link_title' =>				__('Button Link', 'cmsms_content_composer'),
			'featured_field_button_link_descr' =>				__('Enter button link here', 'cmsms_content_composer'),
			'featured_field_button_target_title' =>				__('Button Target', 'cmsms_content_composer'),
			'featured_field_button_target_descr' =>				__('Choose button link target type', 'cmsms_content_composer'),
			'featured_field_button_icon_title' =>				__('Button Icon', 'cmsms_content_composer'),
			'icon_field_icon_descr' =>							__('Choose icon for your shortcode', 'cmsms_content_composer'),
			'icon_field_size_descr' =>							__('Choose custom size for your icon', 'cmsms_content_composer'),
			'icon_field_size_descr_note' =>						__("number, in pixels ('40' - if empty)", 'cmsms_content_composer'),
			'icon_field_display_title' =>						__('Display', 'cmsms_content_composer'),
			'icon_field_display_descr' =>						__('Choose display type for your icon', 'cmsms_content_composer'),
			'icon_field_text_align_title' =>					__('Icon Position', 'cmsms_content_composer'),
			'icon_field_text_align_descr' =>					__('Choose horizontal position for your icon', 'cmsms_content_composer'),
			'icon_field_link_title' =>							__('Icon Link', 'cmsms_content_composer'),
			'icon_field_link_descr' =>							__('Enter icon link here', 'cmsms_content_composer'),
			'icon_field_target_title' =>						__('Icon Link Target', 'cmsms_content_composer'),
			'icon_field_target_descr' =>						__('Choose icon link target type', 'cmsms_content_composer'),
			'icon_field_custom_color_title' =>					__('Custom Icon Color', 'cmsms_content_composer'),
			'icon_field_custom_color_descr' =>					__('If not checked, icon will use color of parent section color scheme', 'cmsms_content_composer'),
			'icon_field_color_descr' =>							__('Choose your custom icon color', 'cmsms_content_composer'),
			'icon_field_color_transparency_title' =>			__('Icon Color Transparency', 'cmsms_content_composer'),
			'icon_field_color_transparency_descr' =>			__('Choose your custom icon color transparency', 'cmsms_content_composer'),
			'button_field_title_descr' =>						__('Enter button title here', 'cmsms_content_composer'),
			'button_field_link_descr' =>						__('Enter button link here', 'cmsms_content_composer'),
			'button_field_google_font_descr' =>					__('Choose custom Google font for your button', 'cmsms_content_composer'),
			'button_field_google_font_descr_note' =>			__('if empty, theme default button title font will be used', 'cmsms_content_composer'),
			'button_field_font_size_descr' =>					__('Choose custom font size for your button title', 'cmsms_content_composer'),
			'button_field_font_size_descr_note' =>				__('if empty, theme default button title font size will be used', 'cmsms_content_composer'),
			'button_field_line_height_descr' =>					__('Choose custom line height for your button title', 'cmsms_content_composer'),
			'button_field_line_height_descr_note' =>			__('if empty, theme default button title line height will be used', 'cmsms_content_composer'),
			'button_field_font_weight_descr' =>					__('Set font weight value for your button title', 'cmsms_content_composer'),
			'button_field_font_style_descr' =>					__('Choose font style for your button title', 'cmsms_content_composer'),
			'button_field_paddings_descr' =>					__('Set right/left paddings for your button (to make it wider or narrower)', 'cmsms_content_composer'),
			'button_field_paddings_descr_note' =>				__('if empty, theme default button paddings will be used', 'cmsms_content_composer'),
			'button_field_text_align_title' =>					__('Button Position', 'cmsms_content_composer'),
			'button_field_text_align_descr' =>					__('Choose horizontal position for your button', 'cmsms_content_composer'),
			'button_field_custom_button_colors_title' =>		__('Custom Button Colors', 'cmsms_content_composer'),
			'button_field_custom_button_colors_descr' =>		__('If not checked, button will use parent section color scheme colors', 'cmsms_content_composer'),
			'button_field_bg_color_title' =>					__('Background Color', 'cmsms_content_composer'),
			'button_field_bg_color_descr' =>					__('Choose your custom button background color', 'cmsms_content_composer'),
			'button_field_txt_color_title' =>					__('Text Color', 'cmsms_content_composer'),
			'button_field_txt_color_descr' =>					__('Choose your custom button text color', 'cmsms_content_composer'),
			'button_field_target_title' =>						__('Target', 'cmsms_content_composer'),
			'button_field_target_descr' =>						__('Choose button link target type', 'cmsms_content_composer'),
			'notice_title' =>									__('Notice', 'cmsms_content_composer'),
			'notice_field_content_title' =>						__('Notice Text', 'cmsms_content_composer'),
			'notice_field_notice_type_title' =>					__('Notice Type', 'cmsms_content_composer'),
			'notice_field_notice_type_descr' =>					__('Choose type of your notice', 'cmsms_content_composer'),
			'notice_field_notice_type_choice_success' =>		__('Success', 'cmsms_content_composer'),
			'notice_field_notice_type_choice_error' =>			__('Error', 'cmsms_content_composer'),
			'notice_field_notice_type_choice_info' =>			__('Info', 'cmsms_content_composer'),
			'notice_field_notice_type_choice_warning' =>		__('Warning', 'cmsms_content_composer'),
			'notice_field_notice_type_choice_download' =>		__('Download', 'cmsms_content_composer'),
			'notice_field_notice_type_choice_custom' =>			__('Custom', 'cmsms_content_composer'),
			'notice_field_bg_color_title' =>					__('Background Color', 'cmsms_content_composer'),
			'notice_field_bg_color_descr' =>					__('Choose background color for your custom notice', 'cmsms_content_composer'),
			'notice_field_border_color_title' =>				__('Border Color', 'cmsms_content_composer'),
			'notice_field_border_color_descr' =>				__('Choose border color for your custom notice', 'cmsms_content_composer'),
			'notice_field_txt_color_title' =>					__('Text Color', 'cmsms_content_composer'),
			'notice_field_txt_color_descr' =>					__('Choose text color for your custom notice', 'cmsms_content_composer'),
			'notice_field_close_button_title' =>				__('Close Button', 'cmsms_content_composer'),
			'notice_field_close_button_descr' =>				__('If checked, notice close button will be shown', 'cmsms_content_composer'),
			'notice_field_notice_icon_title' =>					__('Notice Icon', 'cmsms_content_composer'),
			'notice_field_notice_icon_descr' =>					__('Choose icon for your notice', 'cmsms_content_composer'),
			'toggles_title' =>									__('Toggles / Accordion', 'cmsms_content_composer'),
			'toggles_field_toggles_descr' =>					__('Here you can add, edit, remove or sort toggles', 'cmsms_content_composer'),
			'toggles_field_mode_descr' =>						__('Should only one toggle be active at a time or can multiple toggles be open at the same time?', 'cmsms_content_composer'),
			'toggles_field_mode_choice_toggles' =>				__('Toggles mode', 'cmsms_content_composer'),
			'toggles_field_mode_choice_accordion' =>			__('Accordion mode', 'cmsms_content_composer'),
			'toggles_field_active_title' =>						__('Active Toggle', 'cmsms_content_composer'),
			'toggles_field_active_descr' =>						__('Enter the number of the toggle that should be open initially.', 'cmsms_content_composer'),
			'toggles_field_active_descr_note' =>				__('If empty all toggles should be close on page load', 'cmsms_content_composer'),
			'toggles_field_sorting_title' =>					__('Sorting', 'cmsms_content_composer'),
			'toggles_field_sorting_descr' =>					__('If checked, toggles sorting will be shown', 'cmsms_content_composer'),
			'tabs_title' =>										__('Tabs / Tour', 'cmsms_content_composer'),
			'tabs_field_tabs_descr' =>							__('Here you can add, edit, remove or sort tabs', 'cmsms_content_composer'),
			'tabs_field_mode_descr' =>							__('How should the tabs be displayed, top or side?', 'cmsms_content_composer'),
			'tabs_field_mode_choice_tabs' =>					__('Tabs mode', 'cmsms_content_composer'),
			'tabs_field_mode_choice_tour' =>					__('Tour mode', 'cmsms_content_composer'),
			'tabs_field_position_title' =>						__('Position', 'cmsms_content_composer'),
			'tabs_field_position_descr' =>						__('Choose tour tabs position', 'cmsms_content_composer'),
			'tabs_field_active_title' =>						__('Active Tab', 'cmsms_content_composer'),
			'tabs_field_active_descr' =>						__('Enter the number of the tab that should be open initially.', 'cmsms_content_composer'),
			'tabs_field_active_descr_note' =>					__('If empty first tab should be open on page load', 'cmsms_content_composer'),
			'icon_list_title' =>								__('Icon List', 'cmsms_content_composer'),
			'icon_list_field_icon_list_descr' =>				__('Here you can add, edit, remove or sort your icon list', 'cmsms_content_composer'),
			'icon_list_field_list_type_title' =>				__('List Type', 'cmsms_content_composer'),
			'icon_list_field_list_type_descr' =>				__('Choose icon list type', 'cmsms_content_composer'),
			'icon_list_field_list_type_choice_block' =>			__('Icon blocks with content', 'cmsms_content_composer'),
			'icon_list_field_list_type_choice_list' =>			__('Just list with icons', 'cmsms_content_composer'),
			'icon_list_field_items_color_title' =>				__('List Items Color Type', 'cmsms_content_composer'),
			'icon_list_field_items_color_descr' =>				__('Choose list items color type.', 'cmsms_content_composer'),
			'icon_list_field_items_color_choice_border' =>		__('Apply a custom color as the color of icon border', 'cmsms_content_composer'),
			'icon_list_field_items_color_choice_bg' =>			__('Apply a custom color as the color of icon background', 'cmsms_content_composer'),
			'icon_list_field_items_color_choice_icon' =>		__('Apply a custom color as the color of icon', 'cmsms_content_composer'),
			'icon_list_field_border_width_title' =>				__('Border Width', 'cmsms_content_composer'),
			'icon_list_field_border_width_descr' =>				__('Enter icon border width.', 'cmsms_content_composer'),
			'icon_list_field_border_radius_title' =>			__('Border Radius', 'cmsms_content_composer'),
			'icon_list_field_border_radius_descr' =>			__('Enter icon border radius', 'cmsms_content_composer'),
			'icon_list_field_items_unifier_title' =>			__('List Items Unifier Width', 'cmsms_content_composer'),
			'icon_list_field_items_unifier_descr' =>			__('Enter list items unifier width.', 'cmsms_content_composer'),
			'icon_list_field_icon_position_title' =>			__('Icon Position', 'cmsms_content_composer'),
			'icon_list_field_icon_position_descr' =>			__('Choose icon position.', 'cmsms_content_composer'),
			'icon_list_field_icon_position_descr_note' =>		__('This option works only for icon blocks.', 'cmsms_content_composer'),
			'icon_list_field_icon_size_title' =>				__('Icon Size', 'cmsms_content_composer'),
			'icon_list_field_icon_size_descr' =>				__('Enter icon / bullet / number size.', 'cmsms_content_composer'),
			'icon_list_field_icon_space_title' =>				__("Icon Space", 'cmsms_content_composer'),
			'icon_list_field_icon_space_descr' =>				__("Enter icon space size.", 'cmsms_content_composer'),
			'icon_list_field_icon_space_descr_note' =>			__("number, in pixels (if empty - '100')", 'cmsms_content_composer'),
			'icon_list_field_item_height_title' =>				__("List Item Height", 'cmsms_content_composer'),
			'icon_list_field_item_height_descr' =>				__("Enter list item line height.", 'cmsms_content_composer'),
			'icon_list_field_item_height_descr_note' =>			__("number, in pixels (if empty - default line height)", 'cmsms_content_composer'),
			'prog_bars_title' =>								__('Progress Bars', 'cmsms_content_composer'),
			'prog_bars_field_prog_bars_descr' =>				__('Here you can add, edit, remove or sort progress bars', 'cmsms_content_composer'),
			'prog_bars_field_mode_descr' =>						__('Choose mode of your progress bars', 'cmsms_content_composer'),
			'prog_bars_field_mode_choice_bars' =>				__('Bars', 'cmsms_content_composer'),
			'prog_bars_field_mode_choice_counters' =>			__('Counters', 'cmsms_content_composer'),
			'prog_bars_field_counters_type_title' =>			__('Counters Type', 'cmsms_content_composer'),
			'prog_bars_field_counters_type_descr' =>			__('Choose type of counters', 'cmsms_content_composer'),
			'prog_bars_field_counters_type_choice_circ' =>		__('Circles', 'cmsms_content_composer'),
			'prog_bars_field_counters_type_choice_numb' =>		__('Numbers', 'cmsms_content_composer'),
			'prog_bars_field_border_title' =>					__('Border', 'cmsms_content_composer'),
			'prog_bars_field_border_descr' =>					__('If checked, show border', 'cmsms_content_composer'),
			'prog_bars_field_number_per_row_title' =>			__('Number per Row', 'cmsms_content_composer'),
			'prog_bars_field_number_per_row_descr' =>			__('Choose number of progress bars per row.', 'cmsms_content_composer'),
			'prog_bars_field_number_per_row_descr_note' =>		__('This option works only for progress bars with type counters', 'cmsms_content_composer'),
			'image_title' =>									__('Image', 'cmsms_content_composer'),
			'image_field_image_descr' =>						__('Choose your image', 'cmsms_content_composer'),
			'image_field_image_align_title' =>					__('Image Alignment', 'cmsms_content_composer'),
			'image_field_image_align_descr' =>					__('Choose image special align here', 'cmsms_content_composer'),
			'image_field_image_align_choice_none' =>			__('No special alignment', 'cmsms_content_composer'),
			'image_field_caption_title' =>						__('Caption', 'cmsms_content_composer'),
			'image_field_caption_descr' =>						__('Enter caption text for this image.', 'cmsms_content_composer'),
			'image_field_caption_descr_note' =>					__('No caption if empty', 'cmsms_content_composer'),
			'image_field_image_link_title' =>					__('Image Link', 'cmsms_content_composer'),
			'image_field_image_link_descr' =>					__('Enter the link for this image.', 'cmsms_content_composer'),
			'image_field_image_link_descr_note' =>				__('No link if empty', 'cmsms_content_composer'),
			'image_field_link_target_title' =>					__('Link Target', 'cmsms_content_composer'),
			'image_field_link_target_descr' =>					__('Open link in a new tab/window?', 'cmsms_content_composer'),
			'image_field_link_lightbox_title' =>				__('Lightbox', 'cmsms_content_composer'),
			'image_field_link_lightbox_descr' =>				__('Open image link in lightbox?', 'cmsms_content_composer'),
			'gallery_title' =>									__('Gallery', 'cmsms_content_composer'),
			'gallery_field_images_title' =>						__('Images', 'cmsms_content_composer'),
			'gallery_field_images_descr' =>						__('Choose images for your gallery shortcode', 'cmsms_content_composer'),
			'gallery_field_image_size_slider_title' =>			__('Gallery Big Preview Image Size', 'cmsms_content_composer'),
			'gallery_field_image_size_slider_descr' =>			__('Choose image size for the Big Preview Image', 'cmsms_content_composer'),
			'gallery_field_image_size_title' =>					__('Gallery Preview Image Size', 'cmsms_content_composer'),
			'gallery_field_image_size_descr' =>					__('Choose image size for the preview thumbnails', 'cmsms_content_composer'),
			'gallery_field_layout_descr' =>						__('Choose your gallery shortcode layout', 'cmsms_content_composer'),
			'gallery_field_layout_descr_note' =>				__('For Hover Slider it is recommended that you use images with min size of 820&#215;490 or larger, but with the same image ratio', 'cmsms_content_composer'),
			'gallery_field_layout_choice_hover' =>				__('Hover Slider', 'cmsms_content_composer'),
			'gallery_field_layout_choice_slider' =>				__('Slider', 'cmsms_content_composer'),
			'gallery_field_layout_choice_gallery' =>			__('Image Gallery', 'cmsms_content_composer'),
			'gallery_field_hoversl_pausetime_title' =>			__('Pause Time', 'cmsms_content_composer'),
			'gallery_field_hoversl_pausetime_descr' =>			__('Enter your hover slider pause time', 'cmsms_content_composer'),
			'gallery_field_hoversl_pausetime_descr_note' =>		__("if '0' - autoslide disabled, if empty - '5' (in seconds)", 'cmsms_content_composer'),
			'gallery_field_hoversl_activesl_title' =>			__('Active Slide', 'cmsms_content_composer'),
			'gallery_field_hoversl_activesl_descr' =>			__('Enter your hover slider active slide', 'cmsms_content_composer'),
			'gallery_field_hoversl_activesl_descr_note' =>		__('if empty - 1 (number)', 'cmsms_content_composer'),
			'gallery_field_hoversl_pause_title' =>				__('Pause on Hover', 'cmsms_content_composer'),
			'gallery_field_hoversl_pause_descr' =>				__('If checked the slider will pause on mouseover', 'cmsms_content_composer'),
			'gallery_field_sl_animeffect_title' =>				__('Animation Effect', 'cmsms_content_composer'),
			'gallery_field_sl_animeffect_descr' =>				__('Choose your slider animation effect', 'cmsms_content_composer'),
			'gallery_field_sl_animeffect_choice_slide' =>		__('Slide', 'cmsms_content_composer'),
			'gallery_field_sl_animeffect_choice_fade' =>		__('Fade', 'cmsms_content_composer'),
			'gallery_field_sl_slideshow_title' =>				__('Autoplay', 'cmsms_content_composer'),
			'gallery_field_sl_slideshow_descr' =>				__('Animate slider automatically', 'cmsms_content_composer'),
			'gallery_field_sl_slideshow_speed_title' =>			__('Slideshow Speed', 'cmsms_content_composer'),
			'gallery_field_sl_slideshow_speed_descr' =>			__('Set time during which each slide will be shown', 'cmsms_content_composer'),
			'gallery_field_sl_slideshow_speed_descr_note' =>	__("if empty - '7' (in seconds)", 'cmsms_content_composer'),
			'gallery_field_sl_anim_speed_title' =>				__('Animation Speed', 'cmsms_content_composer'),
			'gallery_field_sl_anim_speed_descr' =>				__('Set transition animations speed', 'cmsms_content_composer'),
			'gallery_field_sl_anim_speed_descr_note' =>			__("if empty - '600' (in milliseconds, 1 second = 1000 milliseconds)", 'cmsms_content_composer'),
			'gallery_field_sl_pause_title' =>					__('Pause on Hover', 'cmsms_content_composer'),
			'gallery_field_sl_pause_descr' =>					__('Pause slideshow on mouseover', 'cmsms_content_composer'),
			'gallery_field_sl_rewind_title' =>					__('Rewind', 'cmsms_content_composer'),
			'gallery_field_sl_rewind_descr' =>					__('Slide to first when you click next on last slide', 'cmsms_content_composer'),
			'gallery_field_sl_rewind_speed_title' =>			__('Rewind speed', 'cmsms_content_composer'),
			'gallery_field_sl_rewind_speed_descr' =>			__('Speed of sliding to the first slide', 'cmsms_content_composer'),
			'gallery_field_sl_rewind_speed_descr_note' =>		__("if empty - '1000' (in milliseconds, 1 second = 1000 milliseconds)", 'cmsms_content_composer'),
			'gallery_field_sl_navcontrol_title' =>				__('Navigation Control', 'cmsms_content_composer'),
			'gallery_field_sl_navcontrol_descr' =>				__('Navigation for paging control of each slide', 'cmsms_content_composer'),
			'gallery_field_sl_arrownav_title' =>				__('Arrow Navigation', 'cmsms_content_composer'),
			'gallery_field_sl_arrownav_descr' =>				__('Slider arrow navigation', 'cmsms_content_composer'),
			'gallery_field_imagegall_columns_title' =>			__('Gallery Columns', 'cmsms_content_composer'),
			'gallery_field_imagegall_columns_descr' =>			__('Choose your image gallery columns count', 'cmsms_content_composer'),
			'gallery_field_imagegall_columns_choice_four' =>	__('4 Columns', 'cmsms_content_composer'),
			'gallery_field_imagegall_columns_choice_three' =>	__('3 Columns', 'cmsms_content_composer'),
			'gallery_field_imagegall_columns_choice_two' =>		__('2 Columns', 'cmsms_content_composer'),
			'gallery_field_imagegall_columns_choice_one' =>		__('1 Column', 'cmsms_content_composer'),
			'gallery_field_imagegall_imglinks_title' =>			__('Images Links', 'cmsms_content_composer'),
			'gallery_field_imagegall_imglinks_descr' =>			__('Gallery images links type', 'cmsms_content_composer'),
			'gallery_field_imagegall_imglinks_choice_box' =>	__('Open images in lightbox', 'cmsms_content_composer'),
			'gallery_field_imagegall_imglinks_choice_self' =>	__('Open images in current browser tab/window', 'cmsms_content_composer'),
			'gallery_field_imagegall_imglinks_choice_blank' =>	__('Open images in a new browser tab/window', 'cmsms_content_composer'),
			'gallery_field_imagegall_imglinks_choice_none' =>	__('Disable links on images', 'cmsms_content_composer'),
			'blog_title' =>										__('Blog', 'cmsms_content_composer'),			
			'blog_field_orderby_descr' =>						__('Choose your blog posts order by parameter', 'cmsms_content_composer'),			
			'blog_field_postsnumber_title' =>					__('Posts Number', 'cmsms_content_composer'),
			'blog_field_postsnumber_descr' =>					__('Enter the number of posts to be shown per page', 'cmsms_content_composer'),
			'blog_field_postsnumber_descr_note' =>				__('number, if empty - show all posts', 'cmsms_content_composer'),			
			'blog_field_categories_descr' =>					__('Show posts associated with certain categories', 'cmsms_content_composer'),
			'blog_field_categories_descr_note' =>				__("If you don't choose any post categories, all your posts will be shown", 'cmsms_content_composer'),
			'blog_field_layout_descr' =>						__('Choose layout type for your blog posts', 'cmsms_content_composer'),
			'blog_field_layout_choice_standard' =>				__('Standard', 'cmsms_content_composer'),
			'blog_field_layout_choice_columns' =>				__('Columns', 'cmsms_content_composer'),
			'blog_field_layout_choice_timeline' =>				__('Timeline', 'cmsms_content_composer'),
			'blog_field_layout_mode_title' =>					__('Layout Mode', 'cmsms_content_composer'),
			'blog_field_layout_mode_descr' =>					__('Choose columns layout mode for your blog posts', 'cmsms_content_composer'),
			'blog_field_layout_mode_choice_grid' =>				__('Grid', 'cmsms_content_composer'),
			'blog_field_layout_mode_choice_masonry' =>			__('Masonry', 'cmsms_content_composer'),
			'blog_field_columns_count_descr' =>					__('Choose number of posts per row', 'cmsms_content_composer'),
			'blog_field_columns_count_descr_note' =>			__('4 columns will be shown for pages with a fullwidth layout only. For pages with a sidebar enabled, maximum columns amount is 3.', 'cmsms_content_composer'),
			'blog_field_metadata_title' =>						__('Metadata', 'cmsms_content_composer'),
			'blog_field_metadata_descr' =>						__('Choose blog posts metadata that you want to show', 'cmsms_content_composer'),
			'blog_field_filter_descr' =>						__('If checked, enable blog posts category filter', 'cmsms_content_composer'),
			'portfolio_title' =>								__('Portfolio', 'cmsms_content_composer'),			
			'portfolio_field_orderby_descr' =>					__('Choose your portfolio projects order by parameter', 'cmsms_content_composer'),			
			'portfolio_field_pj_number_title' =>				__('Projects Number', 'cmsms_content_composer'),
			'portfolio_field_pj_number_descr' =>				__('Enter the number of projects for showing per page', 'cmsms_content_composer'),
			'portfolio_field_pj_number_descr_note' =>			__('number, if empty - show all projects', 'cmsms_content_composer'),			
			'portfolio_field_categories_descr' =>				__('Show projects associated with certain categories.', 'cmsms_content_composer'),
			'portfolio_field_categories_descr_note' =>			__("If you don't choose any project categories, all your projects will be shown", 'cmsms_content_composer'),			
			'portfolio_field_layout_descr' =>					__('Choose layout type for your portfolio projects', 'cmsms_content_composer'),
			'portfolio_field_layout_choice_grid' =>				__('Projects Grid', 'cmsms_content_composer'),
			'portfolio_field_layout_choice_puzzle' =>			__('Masonry Puzzle', 'cmsms_content_composer'),
			'portfolio_field_layout_mode_title' =>				__('Layout Mode', 'cmsms_content_composer'),
			'portfolio_field_layout_mode_descr' =>				__('Choose grid layout mode for your portfolio projects', 'cmsms_content_composer'),
			'portfolio_field_layout_mode_choice_perfect' =>		__('Perfect grid', 'cmsms_content_composer'),
			'portfolio_field_layout_mode_choice_masonry' =>		__('Masonry grid', 'cmsms_content_composer'),			
			'portfolio_field_col_count_descr' =>				__('Choose number of projects per row', 'cmsms_content_composer'),
			'portfolio_field_col_count_descr_note' =>			__('4 and 5 columns will be shown for pages with a fullwidth layout only. For pages with a sidebar enabled, maximum columns amount is 3.', 'cmsms_content_composer'),
			'portfolio_field_col_count_descr_note_custom' =>	__('And 5 columns will be shown only if custom content width is set and when content area width is 1350px or more.'),
			'portfolio_field_metadata_title' =>					__('Metadata', 'cmsms_content_composer'),
			'portfolio_field_metadata_descr' =>					__('Choose portfolio projects metadata that you want to show', 'cmsms_content_composer'),
			'portfolio_field_gap_title' =>						__('Gap', 'cmsms_content_composer'),
			'portfolio_field_gap_descr' =>						__('Choose the gap between portfolio projects', 'cmsms_content_composer'),
			'portfolio_field_gap_choice_large' =>				__('Large gap', 'cmsms_content_composer'),
			'portfolio_field_gap_choice_small' =>				__('1 Pixel gap', 'cmsms_content_composer'),
			'portfolio_field_gap_choice_zero' =>				__('No gap', 'cmsms_content_composer'),
			'portfolio_field_filter_descr' =>					__('If checked, enable portfolio projects category filter', 'cmsms_content_composer'),
			'portfolio_field_sorting_title' =>					__('Sorting', 'cmsms_content_composer'),
			'portfolio_field_sorting_descr' =>					__('If checked, enable portfolio projects date & name sorting', 'cmsms_content_composer'),
			'posts_slider_title' =>								__('Posts Slider', 'cmsms_content_composer'),			
			'posts_slider_field_orderby_descr' =>				__('Choose your blog posts order by parameter', 'cmsms_content_composer'),
			'posts_slider_field_poststype_title' =>				__('Posts Type', 'cmsms_content_composer'),
			'posts_slider_field_poststype_descr' =>				__('Choose shortcodes posts type', 'cmsms_content_composer'),
			'posts_slider_field_poststype_choice_post' =>		__('Blog posts', 'cmsms_content_composer'),
			'posts_slider_field_poststype_choice_project' =>	__('Portfolio projects', 'cmsms_content_composer'),
			'posts_slider_field_postscateg_title' =>			__('Posts Categories', 'cmsms_content_composer'),
			'posts_slider_field_postscateg_descr' =>			__('Show posts associated with certain categories.', 'cmsms_content_composer'),
			'posts_slider_field_postscateg_descr_note' =>		__("If you don't choose any post categories, all your posts will be shown", 'cmsms_content_composer'),
			'posts_slider_field_pjcateg_title' =>				__('Projects Categories', 'cmsms_content_composer'),
			'posts_slider_field_pjcateg_descr' =>				__('Show projects associated with certain categories.', 'cmsms_content_composer'),
			'posts_slider_field_pjcateg_descr_note' =>			__("If you don't choose any project categories, all your projects will be shown", 'cmsms_content_composer'),			
			'posts_slider_field_col_count_descr' =>				__('Choose number of posts per row', 'cmsms_content_composer'),
			'posts_slider_field_postsnumber_title' =>			__('Posts Number', 'cmsms_content_composer'),
			'posts_slider_field_postsnumber_descr' =>			__('Enter the number of posts for showing per page', 'cmsms_content_composer'),
			'posts_slider_field_postsnumber_descr_note' =>		__('number, if empty - show all posts', 'cmsms_content_composer'),
			'posts_slider_field_pausetime_title' =>				__('Pause Time', 'cmsms_content_composer'),
			'posts_slider_field_pausetime_descr' =>				__('Enter your posts slider pause time', 'cmsms_content_composer'),
			'posts_slider_field_pausetime_descr_note' =>		__("if '0' - autoslide disabled, if empty - '5' (in seconds)", 'cmsms_content_composer'),
			'posts_slider_field_postsmeta_title' =>				__('Posts Metadata', 'cmsms_content_composer'),
			'posts_slider_field_postsmeta_descr' =>				__('Choose blog posts metadata that you want to show', 'cmsms_content_composer'),
			'posts_slider_field_pjmeta_title' =>				__('Projects Metadata', 'cmsms_content_composer'),
			'posts_slider_field_pjmeta_descr' =>				__('Choose portfolio projects metadata that you want to show', 'cmsms_content_composer'),
			'profiles_title' =>									__('Profiles', 'cmsms_content_composer'),
			'profiles_field_orderby_descr' =>					__('Choose your profiles order by parameter', 'cmsms_content_composer'),
			'profiles_field_profiles_number_title' =>			__('Profiles Number', 'cmsms_content_composer'),
			'profiles_field_profiles_number_descr' =>			__('Enter the number of profiles to show per page', 'cmsms_content_composer'),
			'profiles_field_profiles_number_descr_note' =>		__('number, if empty - show all profiles', 'cmsms_content_composer'),
			'profiles_field_categories_descr' =>				__('Show profiles associated with certain categories', 'cmsms_content_composer'),
			'profiles_field_categories_descr_note' =>			__("If you don't choose any profile categories, all your profiles will be shown", 'cmsms_content_composer'),
			'profiles_field_layout_descr' =>					__('Choose your profiles layout', 'cmsms_content_composer'),
			'profiles_field_col_count_descr' =>					__('Choose number of profiles per row', 'cmsms_content_composer'),
			'quotes_title' =>									__('Quotes', 'cmsms_content_composer'),
			'quotes_field_quotes_descr' =>						__('Here you can add, edit, remove or sort quotes', 'cmsms_content_composer'),
			'quotes_field_mode_descr' =>						__('Choose your quotes visibility mode', 'cmsms_content_composer'),
			'quotes_field_mode_choice_grid' =>					__('Grid mode', 'cmsms_content_composer'),
			'quotes_field_mode_choice_slider' =>				__('Slider mode', 'cmsms_content_composer'),			
			'quotes_field_col_count_descr' =>					__('Choose number of quotes per row', 'cmsms_content_composer'),
			'quotes_field_slideshow_speed_title' =>				__('Pause Time', 'cmsms_content_composer'),
			'quotes_field_slideshow_speed_descr' =>				__('Time before next quote will appear', 'cmsms_content_composer'),
			'quotes_field_slideshow_speed_descr_note' =>		__("if '0' - autoslide disabled", 'cmsms_content_composer'),
			'embed_title' =>									__('Embed', 'cmsms_content_composer'),			
			'embed_field_link_descr' =>							__('Enter your embed link.', 'cmsms_content_composer'),
			'embed_field_link_descr_note' =>					__('This field support links from', 'cmsms_content_composer'),
			'embed_field_link_descr_note_link' =>				__('such services', 'cmsms_content_composer'),
			'embed_field_maxwidth_title' =>						__('Max Width', 'cmsms_content_composer'),
			'embed_field_maxwidth_descr' =>						__('Defines max width of the embed', 'cmsms_content_composer'),
			'embed_field_maxwidth_descr_note' =>				__("('Media file width' if empty)", 'cmsms_content_composer'),
			'embed_field_maxheight_title' =>					__('Max Height', 'cmsms_content_composer'),
			'embed_field_maxheight_descr' =>					__('Defines max height of the embed', 'cmsms_content_composer'),
			'embed_field_maxheight_descr_note' =>				__("('Media file height' if empty)", 'cmsms_content_composer'),
			'embed_field_wrap_title' =>							__('Wrap Video', 'cmsms_content_composer'),
			'embed_field_wrap_descr' =>							__('Wrap video into container to ignore default video height/max-height and set a 16:9 proportion instead.', 'cmsms_content_composer'),
			'embed_field_wrap_descr_note' =>					__('Recommended only for video embeds', 'cmsms_content_composer'),			
			'media_def' =>										__('Enter your link here', 'cmsms_content_composer'),
			'media_field_autoplay_title' =>						__('Autoplay', 'cmsms_content_composer'),
			'media_field_repeat_title' =>						__('Repeat', 'cmsms_content_composer'),
			'media_field_preload_title' =>						__('Preload', 'cmsms_content_composer'),
			'video_title' =>									__('Video', 'cmsms_content_composer'),
			'video_field_video_descr' =>						__('Here you can add, edit, remove or sort video links', 'cmsms_content_composer'),
			'video_field_video_descr_note' =>					__('Please add video in several formats for your shortcode to work properly in all browsers', 'cmsms_content_composer'),
			'video_field_poster_title' =>						__('Poster', 'cmsms_content_composer'),
			'video_field_poster_descr' =>						__('Defines image to show as placeholder before the media plays', 'cmsms_content_composer'),
			'video_field_maxwidth_title' =>						__('Max Width', 'cmsms_content_composer'),
			'video_field_maxwidth_descr' =>						__('Defines max width of the media', 'cmsms_content_composer'),
			'video_field_maxheight_title' =>					__('Max Height', 'cmsms_content_composer'),
			'video_field_maxheight_descr' =>					__('Defines max height of the media', 'cmsms_content_composer'),			
			'video_field_autoplay_descr' =>						__('If checked, video will play as soon as the video is ready', 'cmsms_content_composer'),
			'video_field_muted_title' =>						__('Muted', 'cmsms_content_composer'),
			'video_field_muted_descr' =>						__('If checked, video will play without the sound', 'cmsms_content_composer'),			
			'video_field_repeat_descr' =>						__('If checked, video will be repeated from the beginning after finishing', 'cmsms_content_composer'),			
			'video_field_preload_descr' =>						__('Specifies if and how the video should be loaded when the page loads', 'cmsms_content_composer'),
			'video_field_preload_choice_none' =>				__('None - the video should not be loaded when the page loads', 'cmsms_content_composer'),
			'video_field_preload_choice_auto' =>				__('Auto - the video should be loaded entirely when the page loads', 'cmsms_content_composer'),
			'video_field_preload_choice_metadata' =>			__('Metadata - only metadata should be loaded when the page loads', 'cmsms_content_composer'),
			'audio_title' =>									__('Audio', 'cmsms_content_composer'),
			'audio_field_audio_descr' =>						__('Here you can add, edit, remove or sort audio links', 'cmsms_content_composer'),
			'audio_field_audio_descr_note' =>					__('Please add audio in several formats for your shortcode to work properly in all browsers', 'cmsms_content_composer'),
			'audio_field_autoplay_descr' =>						__('If checked, audio will play as soon as the audio is ready', 'cmsms_content_composer'),
			'audio_field_repeat_descr' =>						__('If checked, audio will be repeated from the beginning after finishing', 'cmsms_content_composer'),
			'audio_field_preload_descr' =>						__('Specifies if and how the audio should be loaded when the page loads', 'cmsms_content_composer'),
			'audio_field_preload_choice_none' =>				__('None - the audio should not be loaded when the page loads', 'cmsms_content_composer'),
			'audio_field_preload_choice_auto' =>				__('Auto - the audio should be loaded entirely when the page loads', 'cmsms_content_composer'),
			'audio_field_preload_choice_metadata' =>			__('Metadata - only metadata should be loaded when the page loads', 'cmsms_content_composer'),
			'clients_title' =>									__('Clients', 'cmsms_content_composer'),
			'clients_field_clients_descr' =>					__('Here you can add, edit, remove or sort your clients', 'cmsms_content_composer'),			
			'clients_field_col_count_descr' =>					__('Choose number of clients per row', 'cmsms_content_composer'),			
			'clients_field_layout_descr' =>						__('Choose your clients shortcode layout', 'cmsms_content_composer'),
			'clients_field_layout_choice_slider' =>				__('Slider', 'cmsms_content_composer'),
			'clients_field_layout_choice_grid' =>				__('Grid', 'cmsms_content_composer'),
			'clients_field_height_title' =>						__('Height', 'cmsms_content_composer'),
			'clients_field_height_descr' =>						__('Client items height', 'cmsms_content_composer'),
			'clients_field_height_descr_note' =>				__('number, in pixels (default value is 180)', 'cmsms_content_composer'),
			'clients_field_border_title' =>						__('Border', 'cmsms_content_composer'),
			'clients_field_border_descr' =>						__('If checked, show clients border', 'cmsms_content_composer'),
			'clients_field_autoplay_title' =>					__('Autoplay', 'cmsms_content_composer'),
			'clients_field_autoplay_descr' =>					__('Animate slider automatically', 'cmsms_content_composer'),
			'clients_field_speed_title' =>						__('Speed', 'cmsms_content_composer'),
			'clients_field_speed_descr' =>						__('Slide speed in seconds', 'cmsms_content_composer'),
			'clients_field_speed_descr_note' =>					__('If empty - 1 (in seconds)', 'cmsms_content_composer'),
			'clients_field_animeffect_title' =>					__('Animation Effect', 'cmsms_content_composer'),
			'clients_field_animeffect_descr' =>					__('Choose your slider animation effect', 'cmsms_content_composer'),
			'clients_field_slides_control_title' =>				__('Slides Control', 'cmsms_content_composer'),
			'clients_field_slides_control_descr' =>				__('If checked, enable slider slides control', 'cmsms_content_composer'),
			'clients_field_arrow_control_title' =>				__('Arrow Control', 'cmsms_content_composer'),
			'clients_field_arrow_control_descr' =>				__('If checked, enable slider arrow control', 'cmsms_content_composer'),
			'pricing_title' =>									__('Pricing Table', 'cmsms_content_composer'),
			'pricing_field_offers_title' =>						__('Offers', 'cmsms_content_composer'),
			'pricing_field_offers_descr' =>						__('Here you can add, edit, remove or sort pricing table offers', 'cmsms_content_composer'),			
			'pricing_field_col_count_descr' =>					__('Choose number of pricing table offers per row', 'cmsms_content_composer'),
			'table_title' =>									__('Table', 'cmsms_content_composer'),
			'table_field_table_content_title' =>				__('Table Content', 'cmsms_content_composer'),
			'table_field_table_content_descr' =>				__('Build your table and fill it with data', 'cmsms_content_composer'),
			'table_field_table_caption_title' =>				__('Table Caption', 'cmsms_content_composer'),
			'table_field_table_caption_descr' =>				__('Add a short caption for your table so that visitors know what this data is about', 'cmsms_content_composer'),
			'map_markers_title' =>								__('Google Map', 'cmsms_content_composer'),
			'map_markers_field_markers_title' =>				__('Markers', 'cmsms_content_composer'),
			'map_markers_field_markers_descr' =>				__('Here you can add, edit, remove or sort Google map markers', 'cmsms_content_composer'),
			'map_markers_field_address_type_title' =>			__('Address Type', 'cmsms_content_composer'),
			'map_markers_field_address_type_descr' =>			__('Choose Google map address type', 'cmsms_content_composer'),
			'map_markers_field_address_type_choice_address' =>	__('address', 'cmsms_content_composer'),
			'map_markers_field_address_type_choice_coord' =>	__('coordinates', 'cmsms_content_composer'),
			'map_markers_field_address_title' =>				__('Address', 'cmsms_content_composer'),
			'map_markers_field_address_descr' =>				__('Enter address to centre your map at', 'cmsms_content_composer'),
			'map_markers_field_latitude_title' =>				__('Latitude', 'cmsms_content_composer'),
			'map_markers_field_latitude_descr' =>				__('Enter latitude to centre your map', 'cmsms_content_composer'),
			'map_markers_field_longitude_title' =>				__('Longitude', 'cmsms_content_composer'),
			'map_markers_field_longitude_descr' =>				__('Enter longitude to centre your map', 'cmsms_content_composer'),
			'map_markers_field_type_title' =>					__('Type', 'cmsms_content_composer'),
			'map_markers_field_type_descr' =>					__('Choose Google map type', 'cmsms_content_composer'),
			'map_markers_field_type_choice_roadmap' =>			__('Roadmap', 'cmsms_content_composer'),
			'map_markers_field_type_choice_terrain' =>			__('Terrain', 'cmsms_content_composer'),
			'map_markers_field_type_choice_hybrid' =>			__('Hybrid', 'cmsms_content_composer'),
			'map_markers_field_type_choice_sattelite' =>		__('Satellite', 'cmsms_content_composer'),
			'map_markers_field_zoom_title' =>					__('Zoom', 'cmsms_content_composer'),
			'map_markers_field_zoom_descr' =>					__('Choose Google map zoom', 'cmsms_content_composer'),
			'map_markers_field_height_type_title' =>			__('Height Type', 'cmsms_content_composer'),
			'map_markers_field_height_type_descr' =>			__('Choose Google map height type', 'cmsms_content_composer'),
			'map_markers_field_height_type_choice_auto' =>		__('Auto', 'cmsms_content_composer'),
			'map_markers_field_height_type_choice_fixed' =>		__('Fixed', 'cmsms_content_composer'),
			'map_markers_field_height_title' =>					__('Height', 'cmsms_content_composer'),
			'map_markers_field_height_descr' =>					__('Choose Google map height', 'cmsms_content_composer'),
			'map_markers_field_height_descr_note' =>			__('(if empty - 300)', 'cmsms_content_composer'),
			'map_markers_field_scrollwheel_title' =>			__('Scrollwheel', 'cmsms_content_composer'),
			'map_markers_field_scrollwheel_descr' =>			__('If checked, enable scrollwheel zooming on the map', 'cmsms_content_composer'),
			'map_markers_field_doubleclick_zoom_title' =>		__('Double Click Zoom', 'cmsms_content_composer'),
			'map_markers_field_doubleclick_zoom_descr' =>		__('If checked, enable zoom and centre on double click', 'cmsms_content_composer'),
			'map_markers_field_pan_control_title' =>			__('Pan Control', 'cmsms_content_composer'),
			'map_markers_field_pan_control_descr' =>			__('If checked, enable state of the pan control', 'cmsms_content_composer'),
			'map_markers_field_zoom_control_title' =>			__('Zoom Control', 'cmsms_content_composer'),
			'map_markers_field_zoom_control_descr' =>			__('If checked, enable state of the zoom control', 'cmsms_content_composer'),
			'map_markers_field_maptype_control_title' =>		__('Map Type Control', 'cmsms_content_composer'),
			'map_markers_field_maptype_control_descr' =>		__('If checked, enable state of the map type control', 'cmsms_content_composer'),
			'map_markers_field_scale_control_title' =>			__('Scale Control', 'cmsms_content_composer'),
			'map_markers_field_scale_control_descr' =>			__('If checked, enable state of the scale control', 'cmsms_content_composer'),
			'map_markers_field_strtview_control_title' =>		__('Street View Control', 'cmsms_content_composer'),
			'map_markers_field_strtview_control_descr' =>		__('If checked, enable state of the Street View Pegman control.', 'cmsms_content_composer'),
			'map_markers_field_strtview_control_descr_note' =>	__('This control is part of the default UI, and should be set to false when displaying a map type on which the Street View road overlay should not appear (e.g. a non-Earth map type)', 'cmsms_content_composer'),
			'map_markers_field_overview_map_control_title' =>	__('Overview Map Control', 'cmsms_content_composer'),
			'map_markers_field_overview_map_control_descr' =>	__('If checked, enable state of the overview map control', 'cmsms_content_composer'),
			'divider_title' =>									__('Divider', 'cmsms_content_composer'),
			'divider_field_divider_type_title' =>				__('Divider Type', 'cmsms_content_composer'),
			'divider_field_divider_type_descr' =>				__('Choose type of your divider', 'cmsms_content_composer'),
			'divider_field_divider_type_choice_solid' =>		__('Solid Line', 'cmsms_content_composer'),
			'divider_field_divider_type_choice_dashed' =>		__('Dashed Line', 'cmsms_content_composer'),
			'divider_field_divider_type_choice_dotted' =>		__('Dotted Line', 'cmsms_content_composer'),
			'divider_field_divider_type_choice_transparent' =>	__('Transparent Line', 'cmsms_content_composer'),
			'divider_field_margin_top_title' =>					__('Top Margin', 'cmsms_content_composer'),
			'divider_field_margin_top_descr' =>					__('Enter divider top margin', 'cmsms_content_composer'),
			'divider_field_margin_bottom_title' =>				__('Bottom Margin', 'cmsms_content_composer'),
			'divider_field_margin_bottom_descr' =>				__('Enter divider bottom margin', 'cmsms_content_composer'),
			'contact_form_title' =>								__('Contact Form', 'cmsms_content_composer'),
			'contact_form_cfb' =>								__('CMSMasters Contact Form Builder', 'cmsms_content_composer'),
			'contact_form_cf7' =>								__('Contact Form 7', 'cmsms_content_composer'),
			'contact_form_field_form_plugin_title' =>			__('Contact Form Plugin', 'cmsms_content_composer'),
			'contact_form_field_form_plugin_descr' =>			__('Choose one of supported contact form plugins', 'cmsms_content_composer'),
			'contact_form_field_form_plugin_descr_note' =>		__('Please make sure that the Contact Form plugin you have chosen is currently installed and activated.', 'cmsms_content_composer'),
			'contact_form_field_cf7_id_title' =>				__('Contact Form 7 - Form Name', 'cmsms_content_composer'),
			'contact_form_field_cf7_id_descr' =>				__('Choose your form name from Contact Form 7 plugin', 'cmsms_content_composer'),
			'contact_form_field_cfb_id_title' =>				__('CMSMasters Contact Form Builder - Form Name', 'cmsms_content_composer'),
			'contact_form_field_cfb_id_descr' =>				__('Choose your form name from CMSMasters Contact Form Builder plugin', 'cmsms_content_composer'),
			'contact_form_field_cfb_email_title' =>				__('CMSMasters Contact Form Builder - Email Address', 'cmsms_content_composer'),
			'contact_form_field_cfb_email_descr' =>				__('Enter email address for your CMSMasters Contact Form Builder plugin form', 'cmsms_content_composer'),
			'contact_form_field_cfb_email_descr_note' =>		__('You can enter multiple email addresses separated by commas', 'cmsms_content_composer'),
			'slider_title' =>									__('Slider', 'cmsms_content_composer'),
			'slider_layer' =>									__('Layer Slider', 'cmsms_content_composer'),
			'slider_rev' =>										__('Revolution Slider', 'cmsms_content_composer'),
			'slider_field_plugin_title' =>						__('Slider Plugin', 'cmsms_content_composer'),
			'slider_field_plugin_descr' =>						__('Choose one of supported slider plugins', 'cmsms_content_composer'),
			'slider_field_plugin_descr_note' =>					__('Please make sure that the Slider plugin you have chosen is currently installed and activated.', 'cmsms_content_composer'),
			'slider_field_layer_id_title' =>					__('Layer Slider Name', 'cmsms_content_composer'),
			'slider_field_layer_id_descr' =>					__('Choose your slider name from Layer Slider plugin', 'cmsms_content_composer'),
			'slider_field_rev_id_title' =>						__('Revolution Slider Name', 'cmsms_content_composer'),
			'slider_field_rev_id_descr' =>						__('Choose your slider name from Revolution Slider plugin', 'cmsms_content_composer'),
			'twitter_title' =>									__('Twitter Stripe', 'cmsms_content_composer'),
			'twitter_field_username_title' =>					__('Twitter Username', 'cmsms_content_composer'),
			'twitter_field_username_descr' =>					__('Enter your Twitter username', 'cmsms_content_composer'),
			'twitter_field_tweets_number_title' =>				__('Tweets Number', 'cmsms_content_composer'),
			'twitter_field_tweets_number_descr' =>				__("Enter the number of latest tweets you'd like to display", 'cmsms_content_composer'),
			'twitter_field_tweets_number_descr_note' =>			__('(5 - if empty)', 'cmsms_content_composer'),
			'twitter_field_tweets_date_title' =>				__('Date visibility', 'cmsms_content_composer'),
			'twitter_field_tweets_date_descr' =>				__('Show or hide tweet date', 'cmsms_content_composer'),
			'twitter_field_slider_controls_title' =>			__('Slider Controls', 'cmsms_content_composer'),
			'twitter_field_slider_controls_descr' =>			__('If checked, enable tweets slider controls', 'cmsms_content_composer'),
			'gallery_field_slider_autoplay_title' =>			__('Autoplay', 'cmsms_content_composer'),
			'twitter_field_slider_autoplay_descr' =>			__('Animate next tweet automatically', 'cmsms_content_composer'),
			'twitter_field_slider_speed_title' =>				__('Pause Time', 'cmsms_content_composer'),
			'twitter_field_slider_speed_descr' =>				__('Time before next slide will appear', 'cmsms_content_composer'),
			'twitter_field_slider_speed_descr_note' =>			__('If empty - 3', 'cmsms_content_composer'),
			'social_sharing_title' =>							__('Social Sharing', 'cmsms_content_composer'),
			'social_sharing_field_fb_button_title' =>			__('Facebook Like Button', 'cmsms_content_composer'),
			'social_sharing_field_fb_button_descr' =>			__("If checked, show Facebook 'Like' button", 'cmsms_content_composer'),
			'social_sharing_field_twitter_button_title' =>		__('Twitter Tweet Button', 'cmsms_content_composer'),
			'social_sharing_field_twitter_button_descr' =>		__("If checked, show Twitter 'Tweet' button", 'cmsms_content_composer'),
			'social_sharing_field_googleplus_button_title' =>	__('Google+ Button', 'cmsms_content_composer'),
			'social_sharing_field_googleplus_button_descr' =>	__("If checked, show Google Plus '+1' button", 'cmsms_content_composer'),
			'social_sharing_field_pinterest_button_title' =>	__('Pinterest Pin It Button', 'cmsms_content_composer'),
			'social_sharing_field_pinterest_button_descr' =>	__("If checked, show Pinterest 'Pin it' button", 'cmsms_content_composer'),
			'social_sharing_field_buttons_type_title' =>		__('Buttons Type', 'cmsms_content_composer'),
			'social_sharing_field_buttons_type_descr' =>		__('Choose your social buttons type', 'cmsms_content_composer'),			
			'sidebar_title' =>									__('Sidebar', 'cmsms_content_composer'),
			'sidebar_field_sidebar_descr' =>					__('Choose one of already existing sidebars here', 'cmsms_content_composer'),
			'sidebar_field_sidebar_descr_note' =>				__('or, you can create your own sidebar', 'cmsms_content_composer'),
			'sidebar_field_sidebar_descr_note_link' =>			__('here', 'cmsms_content_composer'),
			'sidebar_field_sidebar_layout_title' =>				__('Sidebar Layout', 'cmsms_content_composer'),
			'sidebar_field_sidebar_layout_descr' =>				__('Choose layout for this sidebar here', 'cmsms_content_composer'),
			'sidebar_field_sidebar_layout_descr_note' =>		__('we recommend to use this option for horizontal sidebars', 'cmsms_content_composer'),
			'custom_html_title' =>								__('Custom HTML', 'cmsms_content_composer'),
			'custom_html_field_code_title' =>					__('HTML Code', 'cmsms_content_composer'),
			'custom_html_field_code_descr' =>					__('Enter here your custom HTML code', 'cmsms_content_composer'),
			'custom_js_title' =>								__('Custom JS', 'cmsms_content_composer'),
			'custom_js_field_code_title' =>						__('JavaScript Code', 'cmsms_content_composer'),
			'custom_js_field_code_descr' =>						__('Enter here your custom JavaScript code', 'cmsms_content_composer'),
			'custom_css_title' =>								__('Custom CSS', 'cmsms_content_composer'),
			'custom_css_field_code_title' =>					__('CSS Code', 'cmsms_content_composer'),
			'custom_css_field_code_descr' =>					__('Enter here your custom CSS code', 'cmsms_content_composer'),
			'toggle_title' =>									__('Toggle', 'cmsms_content_composer'),
			'toggle_field_title_descr' =>						__('Enter this toggle title', 'cmsms_content_composer'),
			'toggle_field_content_descr' =>						__('Enter this toggle content', 'cmsms_content_composer'),
			'toggle_field_toggle_tags_title' =>					__('Toggle Tags', 'cmsms_content_composer'),
			'toggle_field_toggle_tags_descr' =>					__('Enter additional toggle tags separated with commas.', 'cmsms_content_composer'),
			'toggle_field_toggle_tags_descr_note' =>			__('Only for toggles with enabled sorting.', 'cmsms_content_composer'),
			'tab_title' =>										__('Tab', 'cmsms_content_composer'),
			'tab_field_title_descr' =>							__('Enter this tab title', 'cmsms_content_composer'),
			'tab_field_content_descr' =>						__('Enter this tab content', 'cmsms_content_composer'),
			'tab_field_tab_selector_color_title' =>				__('Custom Tab Selector Color', 'cmsms_content_composer'),
			'tab_field_tab_selector_color_descr' =>				__('If not checked, tab selector will use parent section color scheme colors', 'cmsms_content_composer'),
			'tab_field_tab_color_title' =>						__('Tab Color', 'cmsms_content_composer'),
			'tab_field_tab_color_descr' =>						__('Choose tab selector background color on mouseover', 'cmsms_content_composer'),
			'tab_field_icon_descr' =>							__('Choose icon for this tab', 'cmsms_content_composer'),
			'icon_list_item_title' =>							__('List Item', 'cmsms_content_composer'),
			'icon_list_item_field_title_descr' =>				__('Enter this list item title', 'cmsms_content_composer'),
			'icon_list_item_field_content_descr' =>				__('Enter this list item content.', 'cmsms_content_composer'),
			'icon_list_item_field_content_descr_note' =>		__('This option works only for icon blocks', 'cmsms_content_composer'),
			'icon_list_item_field_item_color_title' =>			__('Custom List Item Color', 'cmsms_content_composer'),
			'icon_list_item_field_item_color_descr' =>			__('If not checked, icon list item will use parent section color scheme colors', 'cmsms_content_composer'),
			'icon_list_item_field_color_descr' =>				__('Choose list item icon background color.', 'cmsms_content_composer'),
			'icon_list_item_field_icon_descr' =>				__('Choose icon for this list item', 'cmsms_content_composer'),
			'prog_bar_title' =>									__('Progress Bar', 'cmsms_content_composer'),
			'prog_bar_field_title_descr' =>						__('Enter this progress bar title', 'cmsms_content_composer'),
			'prog_bar_field_progress_title' =>					__('Progress', 'cmsms_content_composer'),
			'prog_bar_field_progress_descr' =>					__('Choose this bar progress.', 'cmsms_content_composer'),
			'prog_bar_field_progress_descr_note' =>				__('Only for progress bar with mode', 'cmsms_content_composer'),
			'prog_bar_field_progress_descr_note_bars' =>		__('bars', 'cmsms_content_composer'),
			'prog_bar_field_progress_descr_note_mode' =>		__('or mode', 'cmsms_content_composer'),
			'prog_bar_field_progress_descr_note_counters' =>	__('counters', 'cmsms_content_composer'),
			'prog_bar_field_progress_descr_note_count_type' =>	__('& counters type', 'cmsms_content_composer'),
			'prog_bar_field_progress_descr_note_circles' =>		__('circles', 'cmsms_content_composer'),
			'prog_bar_field_progress_descr_note_percentage' =>	__('(percentage)', 'cmsms_content_composer'),
			'prog_bar_field_custom_bar_color_title' =>			__('Custom Progress Bar Color', 'cmsms_content_composer'),
			'prog_bar_field_custom_bar_color_descr' =>			__('If not checked, progress bar will use parent section color scheme colors', 'cmsms_content_composer'),
			'prog_bar_field_bar_color_title' =>					__('Bar Color', 'cmsms_content_composer'),
			'prog_bar_field_bar_color_descr' =>					__('Choose color for this progress bar', 'cmsms_content_composer'),
			'prog_bar_field_counter_value_title' =>				__('Counter Value', 'cmsms_content_composer'),
			'prog_bar_field_counter_value_descr' =>				__('Enter counter value number.', 'cmsms_content_composer'),
			'prog_bar_field_counter_value_descr_note' =>		__('numbers', 'cmsms_content_composer'),
			'prog_bar_field_counter_value_prefix_title' =>		__('Counter Value Prefix', 'cmsms_content_composer'),
			'prog_bar_field_counter_value_suffix_title' =>		__('Counter Value Suffix', 'cmsms_content_composer'),
			'prog_bar_field_icon_descr' =>						__('Choose icon for your progress bar', 'cmsms_content_composer'),
			'quote_title' =>									__('Quote', 'cmsms_content_composer'),
			'quote_field_image_title' =>						__('Image', 'cmsms_content_composer'),
			'quote_field_image_descr' =>						__('Choose this quote author image', 'cmsms_content_composer'),
			'quote_field_name_descr' =>							__('Enter this team quote author name', 'cmsms_content_composer'),
			'quote_field_subtitle_title' =>						__('Subtitle', 'cmsms_content_composer'),
			'quote_field_subtitle_descr' =>						__('Enter this quote subtitle', 'cmsms_content_composer'),
			'quote_field_quote_title' =>						__('Quote', 'cmsms_content_composer'),
			'quote_field_quote_descr' =>						__('Enter this quote text', 'cmsms_content_composer'),
			'quote_field_link_title' =>							__('Website Link', 'cmsms_content_composer'),
			'quote_field_link_descr' =>							__('Enter the link of quote author website', 'cmsms_content_composer'),
			'quote_field_website_name_title' =>					__('Website Name', 'cmsms_content_composer'),
			'quote_field_website_name_descr' =>					__('Enter quote author website name', 'cmsms_content_composer'),
			'video_link_title' =>								__('Video', 'cmsms_content_composer'),
			'video_link_field_video_link_title' =>				__('Video Link', 'cmsms_content_composer'),
			'video_link_field_video_link_descr' =>				__('Choose your video file here', 'cmsms_content_composer'),
			'audio_link_title' =>								__('Audio', 'cmsms_content_composer'),
			'audio_link_field_audio_link_title' =>				__('Audio Link', 'cmsms_content_composer'),
			'audio_link_field_audio_link_descr' =>				__('Enter audio file link here', 'cmsms_content_composer'),
			'client_title' =>									__('Client', 'cmsms_content_composer'),
			'client_field_name_descr' =>						__('Enter this client name', 'cmsms_content_composer'),
			'client_field_logo_title' =>						__('Logo', 'cmsms_content_composer'),
			'client_field_logo_descr' =>						__('Choose this client logo', 'cmsms_content_composer'),			
			'client_field_link_descr' =>						__('Enter this client website link', 'cmsms_content_composer'),
			'pricing_offer_title' =>							__('Pricing Table Offer', 'cmsms_content_composer'),
			'pricing_offer_field_title_descr' =>				__('Enter this pricing table offer title', 'cmsms_content_composer'),
			'pricing_offer_field_price_title' =>				__('Price', 'cmsms_content_composer'),
			'pricing_offer_field_price_descr' =>				__('Enter this pricing table offer price', 'cmsms_content_composer'),
			'pricing_offer_field_coins_title' =>				__('Coins', 'cmsms_content_composer'),
			'pricing_offer_field_coins_descr' =>				__('Enter this pricing table offer price coins', 'cmsms_content_composer'),
			'pricing_offer_field_currency_title' =>				__('Currency', 'cmsms_content_composer'),
			'pricing_offer_field_currency_descr' =>				__('Enter this pricing table offer currency', 'cmsms_content_composer'),
			'pricing_offer_field_period_title' =>				__('Period', 'cmsms_content_composer'),
			'pricing_offer_field_period_descr' =>				__('Enter this pricing table offer period', 'cmsms_content_composer'),
			'pricing_offer_field_offer_color_title' =>			__('Custom Offer Color', 'cmsms_content_composer'),
			'pricing_offer_field_offer_color_descr' =>			__('If not checked, pricing table offer will use parent section color scheme colors', 'cmsms_content_composer'),
			'pricing_offer_field_color_descr' =>				__('Choose color for this pricing table offer', 'cmsms_content_composer'),
			'pricing_offer_field_features_title' =>				__('Features', 'cmsms_content_composer'),
			'pricing_offer_field_features_descr' =>				__('Add pricing table offer features', 'cmsms_content_composer'),
			'pricing_offer_field_button_text_title' =>			__('Button Text', 'cmsms_content_composer'),
			'pricing_offer_field_button_text_descr' =>			__('Enter this pricing table offer button text', 'cmsms_content_composer'),
			'pricing_offer_field_button_link_title' =>			__('Button Link', 'cmsms_content_composer'),
			'pricing_offer_field_button_link_descr' =>			__('Enter this pricing table offer button link', 'cmsms_content_composer'),
			'pricing_offer_field_best_offer_title' =>			__('Best Offer', 'cmsms_content_composer'),
			'pricing_offer_field_best_offer_descr' =>			__('If checked, this pricing table offer will be highlighted', 'cmsms_content_composer'),
			'pricing_offer_field_best_offer_custom_bg_title' =>	__('Custom Best Offer Background Color', 'cmsms_content_composer'),
			'pricing_offer_field_best_offer_custom_bg_descr' =>	__('If not checked, pricing table best offer will use parent section color scheme colors', 'cmsms_content_composer'),
			'pricing_offer_field_best_offer_bg_title' =>		__('Best Offer Background Color', 'cmsms_content_composer'),
			'pricing_offer_field_best_offer_bg_descr' =>		__('Choose color for this pricing table best offer', 'cmsms_content_composer'),
			'map_marker_title' =>								__('Google Map Marker', 'cmsms_content_composer'),
			'map_marker_field_address_type_title' =>			__('Address Type', 'cmsms_content_composer'),		
			'map_marker_field_address_type_descr' =>			__('Choose Google map marker address type', 'cmsms_content_composer'),
			'map_marker_field_address_descr' =>					__('Enter address to centre this map marker at', 'cmsms_content_composer'),
			'map_marker_field_latitude_descr' =>				__('Enter latitude to center your map marker', 'cmsms_content_composer'),
			'map_marker_field_longitude_descr' =>				__('Enter longitude to center your map marker', 'cmsms_content_composer'),
			'map_marker_field_popup_html_title' =>				__('Popup HTML', 'cmsms_content_composer'),
			'map_marker_field_popup_html_descr' =>				__('Enter the content for this marker information popup', 'cmsms_content_composer'),
			'map_marker_field_popup_visibility_title' =>		__('Popup Visibility', 'cmsms_content_composer'),
			'map_marker_field_popup_visibility_descr' =>		__('If checked, this marker information popup will be shown', 'cmsms_content_composer'),
			'dropcap_title' =>									__('Dropcap', 'cmsms_content_composer'),
			'dropcap_field_content_descr' =>					__('Enter the character/symbol for this dropcap', 'cmsms_content_composer'),
			'dropcap_field_type_title' =>						__('Type', 'cmsms_content_composer'),
			'dropcap_field_type_descr' =>						__('Choose this dropcap type', 'cmsms_content_composer'),
			'dropcap_field_type_choice_one' =>					__('Type 1', 'cmsms_content_composer'),
			'dropcap_field_type_choice_two' =>					__('Type 2', 'cmsms_content_composer'),
			'item_title' =>										__('Feature', 'cmsms_content_composer'),
			'item_field_title_descr' =>							__('Enter the title for this link', 'cmsms_content_composer'),			
			'item_field_link_descr' =>							__('Enter your link here', 'cmsms_content_composer'),
			'item_field_icon_descr' =>							__('Choose icon for this link', 'cmsms_content_composer'),
			'column_title' =>									__('Column', 'cmsms_content_composer'),
			'column_field_animation_descr' =>					__('Column animation effect when a user scrolls to its position for the first time.', 'cmsms_content_composer'),
			'column_field_animation_delay_descr' =>				__('Delay before column animation starts', 'cmsms_content_composer'), 
			'column_field_classes_descr' =>						__('You can add additional CSS classes (separated by spaces) to the column, if you wish to style content elements differently', 'cmsms_content_composer'),
			'row_title' =>										__('Section', 'cmsms_content_composer'),
			'row_button' =>										__('New Section', 'cmsms_content_composer'),
			'row_field_color_scheme_title' =>					__('Color Scheme', 'cmsms_content_composer'),
			'row_field_color_scheme_descr' =>					__('Choose a color scheme to be used for section', 'cmsms_content_composer'),
			'row_field_custom_bg_color_title' =>				__('Custom Background Color', 'cmsms_content_composer'),
			'row_field_custom_bg_color_descr' =>				__('If not checked, section background color will match background color for this section color scheme', 'cmsms_content_composer'),
			'row_field_bg_color_title' =>						__('Background Color', 'cmsms_content_composer'),
			'row_field_bg_color_descr' =>						__('Choose background color for this section', 'cmsms_content_composer'),
			'row_field_bg_image_title' =>						__('Background Image', 'cmsms_content_composer'),
			'row_field_bg_image_descr' =>						__('Choose background image for this section', 'cmsms_content_composer'),
			'row_field_bg_position_title' =>					__('Background Position', 'cmsms_content_composer'),
			'row_field_bg_position_descr' =>					__('Select background position for this section', 'cmsms_content_composer'),
			'row_field_bg_position_choice_vert_top' =>			__('Vertical: top', 'cmsms_content_composer'),
			'row_field_bg_position_choice_vert_center' =>		__('Vertical: center', 'cmsms_content_composer'),
			'row_field_bg_position_choice_vert_bottom' =>		__('Vertical: bottom', 'cmsms_content_composer'),
			'row_field_bg_position_choice_horiz_left' =>		__('Horizontal: left', 'cmsms_content_composer'),
			'row_field_bg_position_choice_horiz_center' =>		__('Horizontal: center', 'cmsms_content_composer'),
			'row_field_bg_position_choice_horiz_right' =>		__('Horizontal: right', 'cmsms_content_composer'),
			'row_field_bg_repeat_title' =>						__('Background Repeat', 'cmsms_content_composer'),
			'row_field_bg_repeat_descr' =>						__('Choose background repeat for this section', 'cmsms_content_composer'),
			'row_field_bg_repeat_choice_none' =>				__('No Repeat', 'cmsms_content_composer'),
			'row_field_bg_repeat_choice_horiz' =>				__('Repeat Horizontally', 'cmsms_content_composer'),
			'row_field_bg_repeat_choice_vert' =>				__('Repeat Vertically', 'cmsms_content_composer'),
			'row_field_bg_repeat_choice_repeat' =>				__('Repeat', 'cmsms_content_composer'),
			'row_field_bg_attachement_title' =>					__('Background Attachment', 'cmsms_content_composer'),
			'row_field_bg_attachement_descr' =>					__('Choose background attachment for this section', 'cmsms_content_composer'),
			'row_field_bg_attachement_choice_scroll' =>			__('Scroll', 'cmsms_content_composer'),
			'row_field_bg_attachement_choice_fixed' =>			__('Fixed', 'cmsms_content_composer'),
			'row_field_bg_size_title' =>						__('Background Size', 'cmsms_content_composer'),
			'row_field_bg_size_descr' =>						__('Choose background size for this section', 'cmsms_content_composer'),
			'row_field_bg_size_descr_auto' =>					__('image is added in its actual size regardless of the section dimensions', 'cmsms_content_composer'),
			'row_field_bg_size_descr_cover' =>					__('image is resized to cover the whole section area', 'cmsms_content_composer'),
			'row_field_bg_size_descr_contain' =>				__('image is resized to fit into the section area', 'cmsms_content_composer'),
			'row_field_bg_size_choice_auto' =>					__('Auto', 'cmsms_content_composer'),
			'row_field_bg_size_choice_cover' =>					__('Cover', 'cmsms_content_composer'),
			'row_field_bg_size_choice_contain' =>				__('Contain', 'cmsms_content_composer'),
			'row_field_bg_parallax_title' =>					__('Background Parallax', 'cmsms_content_composer'),
			'row_field_bg_parallax_descr' =>					__('If checked, background image parallax effect will be enabled', 'cmsms_content_composer'),
			'row_field_bg_parallax_ratio_title' =>				__('Background Parallax Ratio', 'cmsms_content_composer'),
			'row_field_bg_parallax_ratio_descr' =>				__('Background image reposition step on scroll', 'cmsms_content_composer'),
			'row_field_color_overlay_visibility_title' =>		__('Color Overlay Visibility', 'cmsms_content_composer'),
			'row_field_color_overlay_visibility_descr' =>		__('If checked, section color overlay will be shown over the section background', 'cmsms_content_composer'),
			'row_field_color_overlay_title' =>					__('Color Overlay', 'cmsms_content_composer'),
			'row_field_color_overlay_descr' =>					__('Choose color overlay for this section', 'cmsms_content_composer'),
			'row_field_overlay_opacity_title' =>				__('Overlay Opacity', 'cmsms_content_composer'),
			'row_field_overlay_opacity_descr' =>				__('Choose color overlay opacity for this section', 'cmsms_content_composer'),
			'row_field_overlay_opacity_descr_note' =>			__('percentage', 'cmsms_content_composer'),
			'row_field_top_padding_title' =>					__('Top Padding', 'cmsms_content_composer'),
			'row_field_top_padding_descr' =>					__('Enter section top padding', 'cmsms_content_composer'),
			'row_field_bottom_padding_title' =>					__('Bottom Padding', 'cmsms_content_composer'),
			'row_field_bottom_padding_descr' =>					__('Enter section bottom padding', 'cmsms_content_composer'),
			'row_field_content_width_title' =>					__('Content Width', 'cmsms_content_composer'),
			'row_field_content_width_descr' =>					__('Choose content width type for this section', 'cmsms_content_composer'),
			'row_field_content_width_choice_boxed' =>			__('Boxed', 'cmsms_content_composer'),
			'row_field_content_width_choice_custom' =>			__('Custom', 'cmsms_content_composer'),
			'row_field_left_custom_padding_title' =>			__('Left Custom Padding', 'cmsms_content_composer'),
			'row_field_left_custom_padding_descr' =>			__('Enter section left padding', 'cmsms_content_composer'),
			'row_field_right_custom_padding_title' =>			__('Right Custom Padding', 'cmsms_content_composer'),
			'row_field_right_custom_padding_descr' =>			__('Enter section right padding', 'cmsms_content_composer'),
			'row_field_merge_title' =>							__('Merge with the Next Section', 'cmsms_content_composer'), 
			'row_field_merge_descr' =>							__('If enabled, values for all the settings that are located below, will be imported from the following section. In this case there is NO NEED to apply settings for this section, they will not take effect.', 'cmsms_content_composer'),
			'row_field_merge_descr_note' =>						__('Please make sure to enable this ONLY if both are true: <br />1. Another section is present below current section. <br />2. This option is disabled for the section below.', 'cmsms_content_composer'), 
			'row_field_section_id_title' =>						__('Section ID', 'cmsms_content_composer'),
			'row_field_section_id_descr' =>						__("Apply a custom 'id' attribute to the section, so that you could apply a unique style via CSS. This option is also helpful if you want to use anchor links (build one-page navigation) to scroll to this section when a link is clicked.", 'cmsms_content_composer'),
			'row_field_section_id_descr_note' =>				__("Use this option with caution and make sure: <br />1. That you use only allowed characters (a-z). No special characters can be used. <br />2. Please don't use the following id values: page, main, header, middle, bottom, footer.", 'cmsms_content_composer'),
			'row_field_classes_descr' =>						__('You can add additional CSS classes (separated by spaces) to the section, if you wish to style content elements differently', 'cmsms_content_composer'), 
			'products_title' =>									__('Products', 'cmsms_content_composer'), 
			'products_shortcode_title' =>						__('WooCommerce Shortcode', 'cmsms_content_composer'), 
			'products_shortcode_descr' =>						__('Choose a WooCommerce shortcode to use', 'cmsms_content_composer'), 
			'choice_recent_products' =>							__('Recent Products', 'cmsms_content_composer'), 
			'choice_featured_products' =>						__('Featured Products', 'cmsms_content_composer'), 
			'choice_product_categories' =>						__('Product Categories', 'cmsms_content_composer'), 
			'choice_sale_products' =>							__('Sale Products', 'cmsms_content_composer'), 
			'choice_best_selling_products' =>					__('Best Selling Products', 'cmsms_content_composer'), 
			'choice_top_rated_products' =>						__('Top Rated Products', 'cmsms_content_composer'), 
			'products_field_orderby_descr' =>					__("Choose your products 'order by' parameter", 'cmsms_content_composer'), 
			'products_field_orderby_descr_note' =>				__("Sorting will not be applied for", 'cmsms_content_composer'), 
			'products_field_prod_number_title' =>				__('Number of Products', 'cmsms_content_composer'), 
			'products_field_prod_number_descr' =>				__('Enter the number of products for showing per page', 'cmsms_content_composer'), 
			'products_field_col_count_descr' =>					__('Choose number of products per row', 'cmsms_content_composer'), 
			'selected_products_title' =>						__('Selected Products', 'cmsms_content_composer'), 
			'selected_products_field_ids' =>					__('Products', 'cmsms_content_composer'), 
			'selected_products_field_ids_descr' =>				__('Choose products to be shown', 'cmsms_content_composer'), 
			'selected_products_field_ids_descr_note' =>			__('All products will be shown if empty', 'cmsms_content_composer'), 
			'paypal_donations_title' =>							__('PayPal Donations', 'cmsms_content_composer'), 
			'paypal_donations_field_amount_title' =>			__('Donation Amount', 'cmsms_content_composer'), 
			'paypal_donations_field_amount_descr' =>			__('Enter donation amount', 'cmsms_content_composer'), 
			'paypal_donations_field_amount_descr_note' =>		__('If empty, no fixed donation amount will be set', 'cmsms_content_composer'), 
			'paypal_donations_field_purpose_title' =>			__('Donation Purpose', 'cmsms_content_composer'), 
			'paypal_donations_field_purpose_descr' =>			__('Enter donation purpose', 'cmsms_content_composer'), 
			'paypal_donations_field_purpose_descr_note' =>		__('If empty, a Donator will be able to enter any purpose', 'cmsms_content_composer'), 
			'paypal_donations_field_reference_title' =>			__('Donation Reference', 'cmsms_content_composer'), 
			'paypal_donations_field_reference_descr' =>			__('Enter reference for the donation', 'cmsms_content_composer'), 
			'paypal_donations_field_reference_descr_note' =>	__('If empty, no reference will be shown', 'cmsms_content_composer'), 
			'paypal_donations_field_button_text_title' =>		__('Button Text', 'cmsms_content_composer'), 
			'paypal_donations_field_button_text_descr' =>		__('Enter button text', 'cmsms_content_composer'), 
			'paypal_donations_field_reference_descr_note' =>	__('If empty, no text will be shown', 'cmsms_content_composer'), 
		));
		
		
		wp_register_script('cmsms_content_composer_js', CMSMS_CONTENT_COMPOSER_URL . 'js/jquery.cmsmsContentComposer.js', array('jquery'), '1.0.0', true);
		
		wp_localize_script('cmsms_content_composer_js', 'cmsms_composer', array( 
			'remove_section' => 	__('Remove Section', 'cmsms_content_composer'), 
			'clone_section' => 		__('Clone Section', 'cmsms_content_composer'), 
			'edit_section' => 		__('Edit Section', 'cmsms_content_composer'), 
			'edit_column' => 		__('Edit Column', 'cmsms_content_composer'), 
			'add_shortcode' => 		__('Add Shortcode', 'cmsms_content_composer'), 
			'remove_shortcode' => 	__('Remove Shortcode', 'cmsms_content_composer'), 
			'clone_shortcode' => 	__('Clone Shortcode', 'cmsms_content_composer'), 
			'edit_shortcode' => 	__('Edit Shortcode', 'cmsms_content_composer'), 
			'delete_all' => 		__("Do you really want delete all content?\nAll data will be lost!", 'cmsms_content_composer'), 
			'delete_el' => 			__("Do you really want delete this element?\nAll data from this element will be lost!", 'cmsms_content_composer'), 
			'delete_tmpl' => 		__("Do you really want delete this template?\nAll data from this template will be lost!", 'cmsms_content_composer'), 
			'invalid_tmpl_name' => 	__("Error! Enter valid template name. Minimum 3 character.\nAllowed characters: letters, numbers, whitespace", 'cmsms_content_composer'), 
			'new_tmpl_name' => 		__("Enter the name for new template", 'cmsms_content_composer'), 
			'error_on_page' => 		__("Error on page!\nPlease reload page and try again", 'cmsms_content_composer') 
		));
		
		
		wp_register_script('cmsms_composer_lightbox_js', CMSMS_CONTENT_COMPOSER_URL . 'js/jquery.cmsmsComposerLightbox.js', array('jquery'), '1.0.0', true);
		
		wp_localize_script('cmsms_composer_lightbox_js', 'cmsms_lightbox', array( 
			'cancel' => 				__('Cancel', 'cmsms_content_composer'), 
			'update' => 				__('Update', 'cmsms_content_composer'), 
			'remove' => 				__('Remove', 'cmsms_content_composer'), 
			'deselect' => 				__('Deselect', 'cmsms_content_composer'), 
			'add_media' => 				__('Add Media', 'cmsms_content_composer'), 
			'shcd_settings' => 			__('Shortcode Settings', 'cmsms_content_composer'), 
			'shcd_choose' => 			__('Choose Shortcode', 'cmsms_content_composer'), 
			'choose_image' => 			__('Choose Image', 'cmsms_content_composer'), 
			'choose_video' => 			__('Choose Video', 'cmsms_content_composer'), 
			'choose_audio' => 			__('Choose Audio', 'cmsms_content_composer'), 
			'insert_image' => 			__('Insert Image', 'cmsms_content_composer'), 
			'insert_video' => 			__('Insert Video', 'cmsms_content_composer'), 
			'insert_audio' => 			__('Insert Audio', 'cmsms_content_composer'), 
			'create_gallery' => 		__('Create Gallery', 'cmsms_content_composer'), 
			'edit_gallery' => 			__('Edit Gallery', 'cmsms_content_composer'), 
			'create_edit_gallery' => 	__('Create/Edit Gallery', 'cmsms_content_composer'), 
			'insert_gallery' => 		__('Insert Gallery', 'cmsms_content_composer'), 
			'find_icons' => 			__('Find icons', 'cmsms_content_composer'), 
			'add_table_col' => 			__('Add Table Column', 'cmsms_content_composer'), 
			'add_table_row' => 			__('Add Table Row', 'cmsms_content_composer'), 
			'text_align_left' => 		__('Text Align Left', 'cmsms_content_composer'), 
			'text_align_right' => 		__('Text Align Right', 'cmsms_content_composer'), 
			'text_align_center' => 		__('Text Align Center', 'cmsms_content_composer'), 
			'default_row' => 			__('Default Row', 'cmsms_content_composer'), 
			'header_row' => 			__('Header Row', 'cmsms_content_composer'), 
			'footer_row' => 			__('Footer Row', 'cmsms_content_composer'), 
			'delete_row' => 			__('Delete Row', 'cmsms_content_composer'), 
			'delete_col' => 			__('Delete Column', 'cmsms_content_composer'), 
			'error_on_page' => 			__("Error on page!\nReload page and try again.", 'cmsms_content_composer') 
		));
		
		
		if ( 
			($hook == 'post.php') || 
			($hook == 'post-new.php') 
		) {
			wp_enqueue_style('cmsms_content_composer_css');
			
			wp_enqueue_style('cmsms_composer_lightbox_css');
			
			
			if (is_rtl()) {
				wp_enqueue_style('cmsms_content_composer_css_rtl');
			
				wp_enqueue_style('cmsms_composer_lightbox_css_rtl');
			}
			
			
			wp_enqueue_script('jquery-ui-draggable');
			wp_enqueue_script('jquery-ui-droppable');
			wp_enqueue_script('jquery-ui-sortable');
			wp_enqueue_script('jquery-ui-selectable');
			
			
			if ( 
				$pagenow == 'post-new.php' || 
				($pagenow == 'post.php' && isset($_GET['post']) && get_post_type($_GET['post']) != 'attachment') 
			) {
				wp_enqueue_script('cmsms_composer_shortcodes_js');
				
				
				wp_enqueue_script('cmsms_content_composer_js');
				
				wp_enqueue_script('cmsms_composer_lightbox_js');
			}
		}
	}
	
	
	function cmsms_composer_init() {
		if (wp_script_is('cmsms_content_composer_js', 'queue') && wp_script_is('cmsms_composer_lightbox_js', 'queue')) {
			echo "
<script type=\"text/javascript\">
	var cmsmsContentComposer = jQuery('#cmsms_composer_content').cmsmsContentComposer().data('cmsmsContentComposer'), 
		cmsmsComposerLightbox = jQuery('#cmsms_composer_content').cmsmsComposerLightbox().data('cmsmsComposerLightbox');
</script>
";
		}
	}
	
	
	function add_composer_button() {
		echo '<a href="#" id="cmsms_content_composer_button" class="button button-primary button-large admin-icon-composer" data-editor="' . __('Default Editor', 'cmsms_content_composer') . '" data-composer="' . __('Content Composer', 'cmsms_content_composer') . '">' . __('Content Composer', 'cmsms_content_composer') . '</a>';
	}
	
	
	function show_cmsms_composer_meta_box() {
		global $post;
		
		
		$admin_post_object = $post;
		
		
		$composer_show = get_post_meta($post->ID, 'cmsms_composer_show', true);
		$composer_fullscreen = get_post_meta($post->ID, 'cmsms_composer_fullscreen', true);
		$composer_begin = get_post_meta($post->ID, 'cmsms_composer_begin', true);
		$composer_confirm = get_post_meta($post->ID, 'cmsms_composer_confirm', true);
		
		
		$option_query = new WP_Query(array( 
			'orderby' => 'name', 
			'order' => 'ASC', 
			'post_type' => 'content_template', 
			'posts_per_page' => -1 
		));
		
		
		echo '<input type="hidden" name="custom_composer_meta_box_nonce" value="' . wp_create_nonce(basename(__FILE__)) . '" />' . 
		'<div class="cmsms_composer_container">' . 
			'<div class="cmsms_composer_buttons_container">' . 
				'<div class="cmsms_composer_buttons_container_wrap"></div>' . 
				'<div class="cmsms_composer_templates_container_wrap">' . 
					'<a href="#" class="cmsms_composer_fullscreen admin-icon-fullscreen" title="' . __('Expand Content Composer', 'cmsms_content_composer') . '"></a>' . 
					'<a href="#" class="cmsms_clear_content admin-icon-clear" title="' . __('Clear Composer Content', 'cmsms_content_composer') . '"></a>' . 
					'<a href="#" class="button cmsms_preview_trigger">' . __('Preview Changes', 'cmsms_content_composer') . '</a>' . 
					'<a href="#" class="button button-primary cmsms_update_trigger">' . __('Update', 'cmsms_content_composer') . '</a>' . 
					'<label for="cmsms_composer_begin" class="cmsms_composer_begin">' . 
						'<input type="checkbox" id="cmsms_composer_begin" name="cmsms_composer_begin" value="true"' . (($composer_begin === 'true') ? ' checked="checked"' : '') . ' />' . 
						__('Add elements to the top', 'cmsms_content_composer') . 
					'</label>' . 
					'<label for="cmsms_composer_confirm" class="cmsms_composer_confirm">' . 
						'<input type="checkbox" id="cmsms_composer_confirm" name="cmsms_composer_confirm" value="true"' . (($composer_confirm === 'true') ? ' checked="checked"' : '') . ' />' . 
						__("Don't confirm element deleting!", 'cmsms_content_composer') . 
					'</label>' . 
					'<div class="cmsms_pattern_list">' . 
					'<a class="cmsms_pattern_list_button button admin-icon-paste">' . __('Templates', 'cmsms_content_composer') . '</a>' . 
						'<ul>' . 
							'<li>' . 
								'<a href="#" class="button button-primary button-large cmsms_pattern_save_all">' . __('Save All as Template', 'cmsms_content_composer') . '</a>' . 
								'<span>' . __('Choose Template:', 'cmsms_content_composer') . '</span>' . 
							'</li>';
					
					
					if ($option_query->have_posts()) : 
						while ($option_query->have_posts() ) : $option_query->the_post();
							echo '<li>' . 
								'<a href="#" class="cmsms_pattern_paste" title="' . __('Load Selected Template', 'cmsms_content_composer') . '" data-id="' . get_the_ID() . '">' . get_the_title() . '</a>' . 
								'<a href="#" class="cmsms_pattern_delete admin-icon-delete" title="' . __('Delete Selected Template', 'cmsms_content_composer') . '" data-id="' . get_the_ID() . '"></a>' . 
							'</li>';
						endwhile;
					endif;
					
					
					echo '</ul>' . 
					'</div>' . 
					'<a href="#" class="cmsms_pattern_save admin-icon-save" title="' . __('Add New Template', 'cmsms_content_composer') . '"></a>' . 
				'</div>' . 
			'</div>' . 
			'<div id="cmsms_composer_content" class="cmsms_composer_content deactivated"></div>' . 
			'<input type="hidden" id="cmsms_composer_show" name="cmsms_composer_show" value="' . (($composer_show === 'true') ? 'true' : 'false') . '" />' . 
			'<input type="hidden" id="cmsms_composer_fullscreen" name="cmsms_composer_fullscreen" value="' . (($composer_fullscreen === 'true') ? 'true' : 'false') . '" />' . 
			'<div id="cmsms_composer_message_saved_all" class="cmsms_message updated">' . 
				'<p>' . __('All content was saved as template successfully.', 'cmsms_content_composer') . '</p>' . 
			'</div>' . 
			'<div id="cmsms_composer_message_saved" class="cmsms_message updated">' . 
				'<p>' . __('Selected sections was saved as template successfully.', 'cmsms_content_composer') . '</p>' . 
			'</div>' . 
			'<div id="cmsms_composer_message_added" class="cmsms_message updated">' . 
				'<p>' . __('Template was loaded to composer successfully.', 'cmsms_content_composer') . '</p>' . 
			'</div>' . 
			'<div id="cmsms_composer_message_deleted" class="cmsms_message error">' . 
				'<p>' . __('Template was deleted successfully.', 'cmsms_content_composer') . '</p>' . 
			'</div>' . 
			'<input type="hidden" id="cmsms_composer_url" name="cmsms_composer_url" value="' . CMSMS_CONTENT_COMPOSER_URL . 'framework/inc/cmsms-composer-templates-operator.php" />' . 
		'</div>';
		
		
		wp_reset_query();
		
		
		$post = $admin_post_object;
	}
	
	
	function add_custom_composer_meta_box() {
		add_meta_box( 
			'cmsms_composer_meta_box', 
			__('Visual Content Composer', 'cmsms_content_composer'), 
			array($this, 'show_cmsms_composer_meta_box'), 
			'', 
			'normal', 
			'high' 
		);
	}
	
	
	function save_custom_composer_meta($post_id) {
		if ( 
			!isset($_POST['custom_composer_meta_box_nonce']) || 
			!wp_verify_nonce($_POST['custom_composer_meta_box_nonce'], basename(__FILE__)) 
		) {
			return $post_id;
		}
		
		
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return $post_id;
		}
		
		
		if ($_POST['post_type'] == 'page') {
			if (!current_user_can('edit_page', $post_id)) {
				return $post_id;
			}
		} elseif (!current_user_can('edit_post', $post_id)) {
			return $post_id;
		}
		
		
		$composer_meta_fields = array( 
			'cmsms_composer_show', 
			'cmsms_composer_fullscreen', 
			'cmsms_composer_begin', 
			'cmsms_composer_confirm' 
		);
		
		
		foreach ($composer_meta_fields as $field) {
			$old = get_post_meta($post_id, $field, true);
			
			
			if (isset($_POST[$field])) {
				$new = $_POST[$field];
			} else {
				$new = '';
			}
			
			
			if (isset($new) && $new !== $old) {
				update_post_meta($post_id, $field, $new);
			} elseif (isset($old) && $new === '') {
				delete_post_meta($post_id, $field, $old);
			}
		}
	}
	
	
	function cmsms_content_composer_widgets_init() {
		if (!is_blog_installed()) {
			return;
		}
		
		
		if (class_exists('WP_Widget_Custom_Latest_Projects')) {
			register_widget('WP_Widget_Custom_Latest_Projects');
		}
		
		
		if (class_exists('WP_Widget_Custom_Popular_Projects')) {
			register_widget('WP_Widget_Custom_Popular_Projects');
		}
	}
}


new Cmsms_Content_Composer();

