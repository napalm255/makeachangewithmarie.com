<?php
/**
 * @package 	WordPress Plugin
 * @subpackage 	CMSMasters Content Composer
 * @version		1.1.1
 * 
 * CMSMasters Custom Shortcodes
 * Created by CMSMasters
 * 
 */


/**
 * Section
 */
function cmsms_row($atts, $content = null) {
    extract(shortcode_atts(array( 
		'data_color' => 				'default', 
		'data_bg_color_custom' => 		'', 
		'data_bg_color' => 				'', 
		'data_bg_img' => 				'', 
		'data_bg_position' => 			'top center', 
		'data_bg_repeat' => 			'no-repeat', 
		'data_bg_attachment' => 		'scroll', 
		'data_bg_size' => 				'auto', 
		'data_bg_parallax' => 			'', 
		'data_bg_parallax_ratio' => 	'0.5', 
		'data_overlay_show' => 			'', 
		'data_color_overlay' => 		'#000000', 
		'data_overlay_opacity' => 		'0', 
		'data_padding_top' => 			'', 
		'data_padding_bottom' => 		'', 
		'data_width' => 				'boxed', 
		'data_padding_left' => 			'', 
		'data_padding_right' => 		'', 
		'data_merge' => 				'', 
		'data_id' => 					'', 
		'data_classes' => 				'' 
    ), $atts));
	
	
	global $prev_out;
	
	
	$unique_id = uniqid();
	
	
	$out_style_start = '<style type="text/css"> ' . "\n";
	
	
	$out_style = '';
	
	
	$out_style_content = '';
	
	
	if ($data_bg_color_custom == 'true' || $data_bg_img != '') {
		$out_style .= '#cmsms_row_' . $unique_id . ' { ';
		
		
		if ($data_bg_color_custom == 'true') {
			$out_style .= "\n\t" . 'background-color: ' . $data_bg_color . '; ';
		}
		
		
		if ($data_bg_img != '') {
			$new_bg_img = explode('|', $data_bg_img);
			
			
			$new_bg_src = wp_get_attachment_image_src($new_bg_img[0], 'full');
			
			
			$out_style .= "\n\t" . 'background-image: url(' . $new_bg_src[0] . '); ' . 
			"\n\t" . 'background-position: ' . $data_bg_position . '; ' . 
			"\n\t" . 'background-repeat: ' . $data_bg_repeat . '; ' . 
			"\n\t" . 'background-attachment: ' . $data_bg_attachment . '; ' . 
			"\n\t" . 'background-size: ' . $data_bg_size . '; ' . 
			(($data_bg_attachment == 'fixed' && preg_match('/Safari/', $_SERVER['HTTP_USER_AGENT'])) ? "\n\t" . 'position: static; ' : '');
		}
		
		
		$out_style .= "\n" . '} ' . "\n\n";
	}
	
	
	if ($data_padding_top != '') {
		$out_style .= '#cmsms_row_' . $unique_id . ' .cmsms_row_outer_parent { ' . 
			"\n\t" . 'padding-top: ' . $data_padding_top . 'px; ' . 
		"\n" . '} ' . "\n\n";
	}
	
	
	if ($data_padding_bottom != '') {
		$out_style .= '#cmsms_row_' . $unique_id . ' .cmsms_row_outer_parent { ' . 
			"\n\t" . 'padding-bottom: ' . $data_padding_bottom . 'px; ' . 
		"\n" . '} ' . "\n\n";
	}
	
	
	if ($data_overlay_show == 'true') {
		$out_style .= '#cmsms_row_' . $unique_id . ' .cmsms_row_overlay { ' . 
			"\n\t" . 'background-color: ' . $data_color_overlay . '; ' . 
			"\n\t" . 'opacity: ' . ((is_numeric($data_overlay_opacity) && $data_overlay_opacity >= 0 && $data_overlay_opacity <= 100) ? $data_overlay_opacity / 100 : 0) . '; ' . 
		"\n" . '} ' . "\n\n";
	}
	
	
	if ($data_width == 'fullwidth') {
		if ($data_padding_left != '') {
			$out_style_content .= '#cmsms_row_' . $unique_id . ' .cmsms_row_inner.cmsms_row_fullwidth { ' . 
				"\n\t" . 'padding-left:' . $data_padding_left . '%; ' . 
			"\n" . '} ' . "\n";
		}
		
		
		if ($data_padding_right != '') {
			$out_style_content .= '#cmsms_row_' . $unique_id . ' .cmsms_row_inner.cmsms_row_fullwidth { ' . 
				"\n\t" . 'padding-right:' . $data_padding_right . '%; ' . 
			"\n" . '} ' . "\n";
		}
	}
	
	
	$out_style_finish = '</style>';
	
	
	$out_start = '<div id="cmsms_row_' . $unique_id . '" class="cmsms_row cmsms_color_scheme_' . $data_color . 
	(($data_classes != '') ? ' ' . $data_classes : '') . 
	'"' . 
	(($data_bg_parallax != '') ? ' data-stellar-background-ratio="' . $data_bg_parallax_ratio . '"' : '') . 
	'>' . "\n" . 
		'<div' . 
		(($data_id != '') ? ' id="' . $data_id . '"' : '') . 
		' class="cmsms_row_outer_parent">' . "\n" . 
			(($data_overlay_show == 'true') ? '<div class="cmsms_row_overlay"></div>' . "\n" : '') . 
			'<div class="cmsms_row_outer">' . "\n";
	
	
	$out_content = $prev_out . 
		'<div class="cmsms_row_inner' . 
		(($data_width == 'fullwidth') ? ' cmsms_row_fullwidth' : '') . 
		'">' . "\n" . 
		'<div class="cmsms_row_margin">' . "\n" . 
			do_shortcode($content) . 
		'</div>' . "\n" . 
	'</div>' . "\n";
	
	
	$out_finish = '</div>' . "\n" . 
		'</div>' . "\n" . 
	'</div>' . "\n";
	
	
	$out = (($out_style != '' || $out_style_content != '') ? $out_style_start . $out_style . $out_style_content . $out_style_finish : '') . 
		$out_start . 
		$out_content . 
		$out_finish;
	
	
	if ($data_merge == 'true') {
		$prev_out = (($out_style_content != '') ? $out_style_start . $out_style_content . $out_style_finish : '') . 
			$out_content;
	} else {
		$prev_out = '';
		
		
		return $out;
	}
}

add_shortcode('cmsms_row', 'cmsms_row');



/**
 * Column
 */
function cmsms_column($atts, $content = null) {
    extract(shortcode_atts(array( 
		'data_width' => 			'1/1', 
		'data_animation' => 		'', 
		'data_animation_delay' => 	'', 
		'data_classes' => 			'' 
    ), $atts));
	
	
	if ($data_width == '1/1') {
		$new_width = 'one_first';
	} elseif ($data_width == '3/4') {
		$new_width = 'three_fourth';
	} elseif ($data_width == '2/3') {
		$new_width = 'two_third';
	} elseif ($data_width == '1/2') {
		$new_width = 'one_half';
	} elseif ($data_width == '1/3') {
		$new_width = 'one_third';
	} elseif ($data_width == '1/4') {
		$new_width = 'one_fourth';
	}
	
	
    return cmsms_divpdel('<div class="cmsms_column ' . $new_width . 
	(($data_classes != '') ? ' ' . $data_classes : '') . 
	'"' . 
	(($data_animation != '') ? ' data-animation="' . $data_animation . '"' : '') . 
	(($data_animation != '' && $data_animation_delay != '') ? ' data-delay="' . $data_animation_delay . '"' : '') . 
	'>' . "\n" . 
		do_shortcode(wpautop($content, false)) . 
	'</div>' . "\n");
}

add_shortcode('cmsms_column', 'cmsms_column');



/**
 * Text Block
 */
function cmsms_text($atts, $content = null) {
    extract(shortcode_atts(array( 
		'animation' => 			'', 
		'animation_delay' => 	'', 
		'classes' => 			'' 
    ), $atts));
	
	
    return cmsms_divpdel('<div class="cmsms_text' . 
	(($classes != '') ? ' ' . $classes : '') . 
	'"' . 
	(($animation != '') ? ' data-animation="' . $animation . '"' : '') . 
	(($animation != '' && $animation_delay != '') ? ' data-delay="' . $animation_delay . '"' : '') . 
	'>' . "\n" . 
		do_shortcode(wpautop($content)) . 
	'</div>' . "\n");
}

add_shortcode('cmsms_text', 'cmsms_text');



/**
 * Notice
 */
function cmsms_notice($atts, $content = null) {
    extract(shortcode_atts(array( 
		'type' => 				'cmsms_notice_success', 
		'icon' => 				'', 
		'close' => 				'', 
		'bg_color' => 			'#ffffff', 
		'bd_color' => 			'#dadada', 
		'color' => 				'#000000', 
		'animation' => 			'', 
		'animation_delay' => 	'', 
		'classes' => 			'' 
    ), $atts));
	
	
	$unique_id = uniqid();
	
	
	$out = '';
	
	
	if ($type == 'cmsms_notice_custom') {
		$out .= '<style type="text/css"> ' . "\n" . 
			'#cmsms_notice_' . $unique_id . ' { ' . 
				"\n\t" . 'background-color:' . $bg_color . '; ' . 
				"\n\t" . 'border-color:' . $bd_color . '; ' . 
				"\n\t" . 'color:' . $color . '; ' . 
			"\n" . '} ' . "\n" . 
			'.cmsms_notice:before {' . "\n" . 
				"\n\t" . 'color:' . $bd_color . '; ' . 
			"\n" . '}' . "\n" . 
		'</style>';
	}
	
	
    $out .= '<div id="cmsms_notice_' . $unique_id . '" class="cmsms_notice ' . $type . 
	(($icon != '') ? ' ' . $icon : '') . 
	(($classes != '') ? ' ' . $classes : '') . 
	'"' . 
	(($animation != '') ? ' data-animation="' . $animation . '"' : '') . 
	(($animation != '' && $animation_delay != '') ? ' data-delay="' . $animation_delay . '"' : '') . 
	'>' . "\n" . 
		(($close != '') ? '<a href="#" class="notice_close cmsms-icon-cancel-3"></a>' : '') . 
		'<div class="notice_icon"></div>' . "\n" . 
		cmsms_divpdel('<div class="notice_content">' . "\n" . 
			do_shortcode(wpautop($content)) . 
		'</div>' . "\n") . 
	'</div>' . "\n";
	
	
	return $out;
}

add_shortcode('cmsms_notice', 'cmsms_notice');



/**
 * Icon Box
 */
function cmsms_icon_box($atts, $content = null) {
    extract(shortcode_atts(array( 
		'title' => 				'', 
		'type' => 				'cmsms_box_heading', 
		'heading_type' => 		'h1', 
		'icon' => 				'cmsms-icon-heart-7', 
		'custom_colors' => 		'', 
		'color' => 				'#ffffff', 
		'button' => 			'', 
		'button_title' => 		__('Button', 'cmsms_content_composer'), 
		'button_link' => 		'#', 
		'button_target' => 		'', 
		'animation' => 			'', 
		'animation_delay' => 	'', 
		'classes' => 			'' 
    ), $atts));
	
	
    $unique_id = uniqid();
	
	
	$out = '';
	
	
	if ($custom_colors == 'true') {
		$out .= '<style type="text/css"> ' . "\n";
		
		if ($type == 'cmsms_box_colored') {
			$out .= '#cmsms_icon_box_' . $unique_id . ' { ' . "\n\t" . 
				'background-color:' . $color . '; ' . "\n" . 
			'} ' . "\n";
		} else {
			if ($type == 'cmsms_box_heading') {
				$out .= '#cmsms_icon_box_' . $unique_id . ' h1:before { ' . "\n\t" . 
					'color:' . $color . '; ' . "\n" . 
				'} ' . "\n";
			} elseif ($type == 'cmsms_box_lefticon') {
				$out .= '#cmsms_icon_box_' . $unique_id . ':before { ' . "\n\t" . 
					'background-color:' . $color . '; ' . "\n" . 
				'} ' . "\n";
			}
			
			if ($button == 'true') {
				$out .= "\n" . '#cmsms_icon_box_' . $unique_id . ' .icon_box_button { ' . "\n\t" . 
					'background-color:' . $color . '; ' . "\n" . 
				'} ' . "\n";
			}
		}
		
		$out .= '</style>';
	}
	
	
    $out .= '<div id="cmsms_icon_box_' . $unique_id . '" class="cmsms_icon_box ' . $type . 
	(($type != 'cmsms_box_heading') ? ' ' . $icon : '') . 
	(($classes != '') ? ' ' . $classes : '') . 
	'"' . 
	(($animation != '') ? ' data-animation="' . $animation . '"' : '') . 
	(($animation != '' && $animation_delay != '') ? ' data-delay="' . $animation_delay . '"' : '') . 
	'>' . "\n" . 
		'<div class="icon_box_inner">' . "\n" . 
			'<' . $heading_type . (($type == 'cmsms_box_heading') ? ' class="' . $icon  . '"' : '') . '>' . $title . '</' . $heading_type . '>' . "\n" . 
			cmsms_divpdel('<div class="icon_box_text">' . "\n" . 
				do_shortcode(wpautop($content)) . 
			'</div>' . "\n");
	
	
	if ($button == 'true') {
		$out .= '<a href="' . $button_link . '" class="cmsms_button icon_box_button"' . 
		(($button_target == 'blank') ? ' target="_blank"' : '') . 
		'>' . $button_title . '</a>' . "\n";
	}
	
	
	$out .= '</div>' . "\n" . 
	'</div>' . "\n";
	
	
	return $out;
}

add_shortcode('cmsms_icon_box', 'cmsms_icon_box');



/**
 * Featured Block
 */
function cmsms_featured_block($atts, $content = null) {
    extract(shortcode_atts(array( 
		'custom_colors' => 		'', 
		'bg_color' => 			'#ffffff', 
		'text_color' => 		'#353535', 
		'button_bg_color' => 	'#fdfdfd', 
		'button_text_color' => 	'#353535', 
		'button' => 			'', 
		'icon' => 				'', 
		'button_title' => 		__('Button', 'cmsms_content_composer'), 
		'button_link' => 		'#', 
		'button_target' => 		'', 
		'animation' => 			'', 
		'animation_delay' => 	'', 
		'classes' => 			'' 
    ), $atts));
	
	
    $unique_id = uniqid();
	
	
	$out = '';
	
	
	if ($custom_colors == 'true') {
		$out .= '<style type="text/css"> ' . "\n" . 
			'#cmsms_fb_' . $unique_id . ' { ' . "\n\t" . 
				'background-color:' . $bg_color . '; ' . "\n" . 
			'} ' . "\n\n" . 
			'#cmsms_fb_' . $unique_id . ', ' . "\n" . 
			'#cmsms_fb_' . $unique_id . ' a, ' . "\n" . 
			'#cmsms_fb_' . $unique_id . ' h1, ' . "\n" . 
			'#cmsms_fb_' . $unique_id . ' h2, ' . "\n" . 
			'#cmsms_fb_' . $unique_id . ' h3, ' . "\n" . 
			'#cmsms_fb_' . $unique_id . ' h4, ' . "\n" . 
			'#cmsms_fb_' . $unique_id . ' h5, ' . "\n" . 
			'#cmsms_fb_' . $unique_id . ' h6 { ' . "\n\t" . 
				'color:' . $text_color . '; ' . "\n" . 
			'} ' . "\n";
		
		
		if ($button == 'true') {
			$out .= "\n" . '#cmsms_fb_' . $unique_id . ' .featured_block_button { ' . "\n\t" . 
				'background-color:' . $button_bg_color . '; ' . "\n\t" . 
				'color:' . $button_text_color . '; ' . "\n" . 
			'} ' . "\n";
		}
		
		
		$out .= '</style>';
	}
	
	
    $out .= '<div id="cmsms_fb_' . $unique_id . '" class="cmsms_featured_block' . 
	(($button == 'true') ? ' featured_block_with_button' : '') . 
	(($classes != '') ? ' ' . $classes : '') . 
	'"' . 
	(($animation != '') ? ' data-animation="' . $animation . '"' : '') . 
	(($animation != '' && $animation_delay != '') ? ' data-delay="' . $animation_delay . '"' : '') . 
	'>' . "\n" . 
		'<div class="featured_block_inner">' . "\n" . 
			cmsms_divpdel('<div class="featured_block_text">' . "\n" . 
				do_shortcode(wpautop($content)) . 
			'</div>' . "\n");
	
	
	if ($button == 'true') {
		$out .= '<div class="featured_block_button_wrap">' . "\n" . 
		'<a href="' . $button_link . '" class="featured_block_button cmsms_button' . 
		(($icon != '') ? ' ' . $icon : '') . '"' . 
		(($button_target == 'blank') ? ' target="_blank"' : '') . 
		'>' . $button_title . '</a>' . "\n" . 
		'</div>' . "\n";
	}
	
	
	$out .= '</div>' . "\n" . 
	'</div>' . "\n";
	
	
	return $out;
}

add_shortcode('cmsms_featured_block', 'cmsms_featured_block');



/**
 * Special Heading
 */
function cmsms_custom_heading($atts, $content = null) {
    extract(shortcode_atts(array( 
		'type' => 					'h1', 
		'font_family' => 			'', 
		'font_size' => 				'', 
		'line_height' => 			'', 
		'font_weight' => 			'400', 
		'font_style' => 			'normal', 
		'text_align' => 			'default', 
		'link' => 					'', 
		'target' => 				'', 
		'margin_top' => 			'0', 
		'margin_bottom' => 			'0', 
		'custom_colors' => 			'', 
		'color' => 					'#353535', 
		'color_transparency' => 	'100', 
		'animation' => 				'', 
		'animation_delay' => 		'', 
		'classes' => 				'' 
    ), $atts));
	
	
	$unique_id = uniqid();
	
	
	if ($font_family != '') {
		$font_family_array = str_replace('+', ' ', explode(':', $font_family));
		
		$font_family_name = "'" . $font_family_array[0] . "'";
		
		
		wp_enqueue_style('cmsms-google-font-' . $unique_id, (is_ssl() ? 'https' : 'http') . '://fonts.googleapis.com/css?family=' . $font_family);
	}
	
	
	$out = '<style type="text/css"> ' . "\n" . 
		'#cmsms_heading_' . $unique_id . ', ' . 
		'#cmsms_heading_' . $unique_id . ' a { ' . 
			(($custom_colors == 'true') ? "\n\t" . cmsms_color_css('color', $color . '|' . $color_transparency) : '') . 
			(($font_family != '') ? "\n\t" . 'font-family:' . $font_family_name . '; ' : '') . 
			(($font_size != '' && $font_size != '0') ? "\n\t" . 'font-size:' . $font_size . 'px; ' : '') . 
			(($line_height != '' && $line_height != '0') ? "\n\t" . 'line-height:' . $line_height . 'px; ' : '') . 
			(($text_align != 'default') ? "\n\t" . 'text-align:' . $text_align . '; ' : '') . 
			"\n\t" . 'font-weight:' . $font_weight . '; ' . 
			"\n\t" . 'font-style:' . $font_style . '; ' . 
			"\n\t" . 'margin-top:' . $margin_top . 'px; ' . 
			"\n\t" . 'margin-bottom:' . $margin_bottom . 'px; ' . 
		"\n" . '} ' . "\n" . 
	'</style>';
	
	
	$out .= '<' . $type . ' id="cmsms_heading_' . $unique_id . '" class="cmsms_heading' . 
	(($classes != '') ? ' ' . $classes : '') . 
	'"' . 
	(($animation != '') ? ' data-animation="' . $animation . '"' : '') . 
	(($animation != '' && $animation_delay != '') ? ' data-delay="' . $animation_delay . '"' : '') . 
	'>' . 
		(($link != '') ? '<a href="' . $link . '"' . (($target == 'blank') ? ' target="_blank"' : '') . '>' : '') . 
			$content . 
		(($link != '') ? '</a>' : '') . 
	'</' . $type . '>';
	
	
	return $out;
}

add_shortcode('cmsms_heading', 'cmsms_custom_heading');



/**
 * Dropcap
 */
function cmsms_dropcap($atts, $content = null) {
    extract(shortcode_atts(array( 
		'type' => 		'dropcap1', 
		'classes' => 	'' 
    ), $atts));
	
	
	$out = '<div " class="cmsms_dropcap ' . $type . 
	(($classes != '') ? ' ' . $classes : '') . 
	'">' . $content . '</div>';
	
	
	return $out;
}

add_shortcode('cmsms_dropcap', 'cmsms_dropcap');



/**
 * Toggles
 */
function cmsms_toggles($atts, $content = null) {
    extract(shortcode_atts(array( 
		'mode' => 				'toggle', 
		'active' => 			'', 
		'sort' => 				'', 
		'animation' => 			'', 
		'animation_delay' => 	'', 
		'classes' => 			'' 
    ), $atts));
	
	
	global $sort_toggles, 
		$toggle_active, 
		$toggle_counter;
	
	
	$sort_toggles = array();
	
	$toggle_active = (int) $active;
	
	$toggle_counter = 0;
	
	$toggles_filter = '';
	
	$toggles = do_shortcode($content);
	
	
	if ($sort == 'true') {
		$toggles_filter = '<div class="cmsms_toggles_filter">' . "\n\t" . 
			'<a href="#" data-key="all" title="' . __('All', 'cmsms_content_composer') . '" class="current_filter">' . __('All', 'cmsms_content_composer') . '</a>' . "\n";
		
		foreach ($sort_toggles as $sort_toggle_key => $sort_toggle_value) {
			$toggles_filter .= "\t" . ' / <a href="#" data-key="' . $sort_toggle_key . '" title="' . $sort_toggle_value . '">' . $sort_toggle_value . '</a>' . "\n";
		}
		
		$toggles_filter .= '</div>';
	}
	
	
	return '<div class="cmsms_toggles toggles_mode_' . $mode . 
	(($classes != '') ? ' ' . $classes : '') . 
	'"' . 
	(($animation != '') ? ' data-animation="' . $animation . '"' : '') . 
	(($animation != '' && $animation_delay != '') ? ' data-delay="' . $animation_delay . '"' : '') . 
	'>' . 
		$toggles_filter . "\n" . 
		$toggles . 
	'</div>';
}

add_shortcode('cmsms_toggles', 'cmsms_toggles');

/**
 * Single Toggle
 */
function cmsms_toggle($atts, $content = null) {
    extract(shortcode_atts(array( 
		'title' => 		__('Title', 'cmsms_content_composer'), 
		'tags' => 		'', 
		'classes' => 	'' 
    ), $atts));
	
	
	global $sort_toggles, 
		$toggle_active, 
		$toggle_counter;
	
	
	$toggle_counter++;
	
	
	$toggle_tags = explode(',', $tags);
	
	
	foreach ($toggle_tags as $toggle_tag) {
		if ($toggle_tag != '') {
			$sort_toggles[generateSlug(trim($toggle_tag), 30)] = trim($toggle_tag);
		}
	}
	
	
	$out = '<div class="cmsms_toggle_wrap' . 
	(($toggle_active == $toggle_counter) ? ' current_toggle' : '') . 
	(($classes != '') ? ' ' . $classes : '') . 
	'" data-tags="all ';
	
	
	$tgl_tag_str = '';
	
	
	foreach ($toggle_tags as $tgl_tag) {
		$tgl_tag_str .= generateSlug(trim($tgl_tag), 30) . ' ';
	}
	
	
	$out .= substr($tgl_tag_str, 0, strlen($tgl_tag_str) - 1);
	
	
	$out .= '">' . "\n" . 
		'<div class="cmsms_toggle_title">' . "\n" . 
			'<span class="cmsms_toggle_plus">' . "\n" . 
				'<span class="cmsms_toggle_plus_hor"></span>' . "\n" . 
				'<span class="cmsms_toggle_plus_vert"></span>' . "\n" . 
			'</span>' . "\n" . 
			'<a href="#">' . $title . '</a>' . "\n" . 
		'</div>' . "\n" . 
		'<div class="cmsms_toggle">' . "\n" . 
			cmsms_divpdel('<div class="cmsms_toggle_inner">' . "\n" . 
				do_shortcode(wpautop($content)) . 
			'</div>' . "\n") . 
		'</div>' . "\n" . 
	'</div>';
	
	
	return $out;
}

add_shortcode('cmsms_toggle', 'cmsms_toggle');



/**
 * Tabs
 */
function cmsms_tabs($atts, $content = null) {
    extract(shortcode_atts(array( 
		'mode' => 				'tab', 
		'position' => 			'left', 
		'active' => 			'1', 
		'animation' => 			'', 
		'animation_delay' => 	'', 
		'classes' => 			'' 
    ), $atts));
	
	
	global $style_tab, 
		$out_tabs, 
		$tabs_mode, 
		$tab_active, 
		$tab_counter;
	
	
	$style_tab = '';
	
	$out_tabs = '';
	
	$tabs_mode = $mode;
	
	$tab_active = (int) $active;
	
	$tab_counter = 0;
	
	
	$tabs = do_shortcode($content);
	
	
	$out = (($style_tab != '') ? '<style type="text/css"> ' . $style_tab . '</style> ' . "\n" : '') . 
	'<div class="cmsms_tabs tabs_mode_' . $mode . 
	(($mode == 'tour') ? ' ' . 'tabs_pos_' . $position : '') . 
	(($classes != '') ? ' ' . $classes : '') . 
	'"' . 
	(($animation != '') ? ' data-animation="' . $animation . '"' : '') . 
	(($animation != '' && $animation_delay != '') ? ' data-delay="' . $animation_delay . '"' : '') . 
	'>' . "\n" . 
		'<ul class="cmsms_tabs_list">' . "\n" . 
			$out_tabs . 
		'</ul>' . "\n" . 
		'<div class="cmsms_tabs_wrap">' . "\n" . 
			$tabs . 
		'</div>' . "\n" . 
	'</div>';
	
	
	return $out;
}

add_shortcode('cmsms_tabs', 'cmsms_tabs');

/**
 * Single Tab
 */
function cmsms_tab($atts, $content = null) {
    extract(shortcode_atts(array( 
		'title' => 			__('Title', 'cmsms_content_composer'), 
		'custom_colors' => 	'', 
		'bg_color' => 		'#ffffff', 
		'icon' => 			'', 
		'classes' => 		'' 
    ), $atts));
	
	
	$unique_id = uniqid();
	
	
	global $style_tab, 
		$out_tabs, 
		$tabs_mode, 
		$tab_active, 
		$tab_counter;
	
	
	$tab_counter++;
	
	if ($custom_colors == 'true') { 
		$style_tab .= "\n" . '#cmsms_tabs_list_item_' . $unique_id . ' a:hover,' . 
		'#cmsms_tabs_list_item_' . $unique_id . '.current_tab a { ' . 
			"\n\t" . 'background-color:' . $bg_color . '; ' . 
			"\n\t" . 'border-color:' . $bg_color . '; ' . 
		"\n" . '} ' . "\n";
	}
	
	
	$out_tabs .= '<li id="cmsms_tabs_list_item_' . $unique_id . '" class="cmsms_tabs_list_item' . 
	(($tab_active == $tab_counter) ? ' current_tab' : '') . 
	'">' . "\n" . 
		'<a href="#"' . 
		(($icon != '') ? ' class="' . $icon . '"' : '') . 
		'>' . "\n" . 
			'<span>' . $title . '</span>' . "\n" . 
		'</a>' . "\n" . 
	'</li>';
	
	
	return '<div id="cmsms_tab_' . $unique_id . '" class="cmsms_tab' . 
	(($tab_active == $tab_counter) ? ' active_tab' : '') . 
	(($classes != '') ? ' ' . $classes : '') . 
	'">' . "\n" . 
		cmsms_divpdel('<div class="cmsms_tab_inner">' . "\n" . 
			do_shortcode(wpautop($content)) . 
		'</div>' . "\n") . 
	'</div>';
}

add_shortcode('cmsms_tab', 'cmsms_tab');



/**
 * Icon List Items
 */
function cmsms_icon_list_items($atts, $content = null) {
    extract(shortcode_atts(array( 
		'type' => 				'block', 
		'heading' => 			'h4', 
		'items_color_type' => 	'border', 
		'border_width' => 		'10', 
		'border_radius' => 		'50%', 
		'unifier_width' => 		'0', 
		'position' => 			'left', 
		'icon_size' => 			'0', 
		'icon_space' => 		'100', 
		'item_height' => 		'', 
		'icon' => 				'cmsms-icon-thumbs-up-5', 
		'animation' => 			'', 
		'animation_delay' => 	'', 
		'classes' => 			'' 
    ), $atts));
	
	
	global $style_item, 
		$out_inner, 
		$list_type, 
		$list_heading, 
		$list_items_color_type, 
		$list_icon_size, 
		$list_icon_space, 
		$list_icon;
	
	
	$unique_id = uniqid();
	
	
	$list_type = $type;
	
	$list_heading = $heading;
	
	$list_items_color_type = $items_color_type;
	
	$list_icon_size = $icon_size;
	
	$list_icon_space = $icon_space;
	
	$list_icon = $icon;
	
	$style_item = '';
	
	$out_inner = '';
	
	
	if ($list_type == 'block') {
		if ($position == 'left') {
			$style_item .= "\n" . '#cmsms_icon_list_items_' . $unique_id . '.cmsms_icon_list_items .cmsms_icon_list_item:before { ' . 
				"\n\t" . 'left:' . (((int) $icon_space / 2) - (((int) $unifier_width != 0) ? ($unifier_width / 2) : 0)) . 'px; ' . 
			"\n" . '} ' . "\n";
		} else {
			$style_item .= '#cmsms_icon_list_items_' . $unique_id . '.cmsms_icon_list_pos_right .cmsms_icon_list_item:before { ' . 
				"\n\t" . 'left:auto; ' . 
				"\n\t" . 'right:' . (((int) $icon_space / 2) - (((int) $unifier_width != 0) ? ($unifier_width / 2) : 0)) . 'px; ' . 
			"\n" . '} ' . "\n";
		}
		
		
		$style_item .= '#cmsms_icon_list_items_' . $unique_id . '.cmsms_icon_list_type_block .cmsms_icon_list_item:before { ' . 
			"\n\t" . 'width:' . $unifier_width . 'px; ' . 
		"\n" . '} ' . "\n\n" . 
		'#cmsms_icon_list_items_' . $unique_id . ' .cmsms_icon_list_icon { ' . 
			"\n\t" . 'border-width:' . $border_width . 'px; ' . 
			"\n\t" . 'width:' . $icon_space . 'px; ' . 
			"\n\t" . 'height:' . $icon_space . 'px; ' . 
			"\n\t" . '-webkit-border-radius:' . $border_radius . '; ' . 
			"\n\t" . '-moz-border-radius:' . $border_radius . '; ' . 
			"\n\t" . 'border-radius:' . $border_radius . '; ' . 
		"\n" . '} ' . "\n\n" . 
		'#cmsms_icon_list_items_' . $unique_id . ' .cmsms_icon_list_icon:before { ' . 
			"\n\t" . 'font-size:' . $icon_size . 'px; ' . 
			"\n\t" . 'line-height:' . ((int) $icon_space - ((int) $border_width * 2)) . 'px; ' . 
		"\n" . '} ' . "\n";
	} else {
		$style_item .= '#cmsms_icon_list_items_' . $unique_id . ' { ' . 
			"\n\t" . 'padding-left:' . ((int) $icon_size + 20) . 'px; ' . 
		"\n" . '} ' . "\n\n" . 
		'#cmsms_icon_list_items_' . $unique_id . ' .cmsms_icon_list_item:before { ' . 
			"\n\t" . 'font-size:' . $icon_size . 'px; ' . 
			"\n\t" . 'left:-' . ((int) $icon_size + 20) . 'px; ' . 
		"\n" . '} ' . "\n";
		
		
		if ($item_height != '') {
			$style_item .= '#cmsms_icon_list_items_' . $unique_id . ' .cmsms_icon_list_item { ' . 
				"\n\t" . 'line-height:' . $item_height . 'px; ' . 
			"\n" . '} ' . "\n\n" . 
			'#cmsms_icon_list_items_' . $unique_id . ' .cmsms_icon_list_item:before { ' . 
				"\n\t" . 'line-height:' . ((int) $item_height - 2) . 'px; ' . 
			"\n" . '} ' . "\n";
		}
	}
	
	
	do_shortcode($content);
	
	
	$out = '<style type="text/css"> ' . $style_item . '</style> ' . "\n" . 
	'<ul id="cmsms_icon_list_items_' . $unique_id . '" class="cmsms_icon_list_items cmsms_icon_list_type_' . $type . ' cmsms_icon_list_pos_' . $position . ' cmsms_color_type_' . $items_color_type . 
	(($classes != '') ? ' ' . $classes : '') . 
	'"' . 
	(($animation != '') ? ' data-animation="' . $animation . '"' : '') . 
	(($animation != '' && $animation_delay != '') ? ' data-delay="' . $animation_delay . '"' : '') . 
	'>' . 
		$out_inner . 
	'</ul>';
	
	
	return $out;
}

add_shortcode('cmsms_icon_list_items', 'cmsms_icon_list_items');

/**
 * Single Icon List Item
 */
function cmsms_icon_list_item($atts, $content = null) {
    extract(shortcode_atts(array( 
		'title' => 			__('Title', 'cmsms_content_composer'), 
		'custom_colors' => 	'', 
		'color' => 			'#ffffff', 
		'icon' => 			'', 
		'classes' => 		'' 
    ), $atts));
	
	
	global $style_item, 
		$out_inner, 
		$list_type, 
		$list_heading, 
		$list_items_color_type, 
		$list_icon_size, 
		$list_icon_space, 
		$list_icon;
	
	
	$unique_id = uniqid();
	
	
	$list_type = ($list_type != 'list') ? 'block' : 'list';
	
	
	$icon = ($icon != '') ? $icon : $list_icon;
	
	
	if ($list_type == 'block') {
		if ($list_items_color_type == 'border') {
			if ($custom_colors == 'true') {
				$style_item .= "\n" . '.cmsms_icon_list_items.cmsms_color_type_border #cmsms_icon_list_item_' . $unique_id . ' .cmsms_icon_list_icon { ' . 
					"\n\t" . 'border-color:' . $color . '; ' . 
				"\n" . '} ' . "\n";
			}
			
			
			$style_item .= "\n" . '.cmsms_icon_list_items.cmsms_color_type_border #cmsms_icon_list_item_' . $unique_id . ':hover .cmsms_icon_list_icon { ' . 
				"\n\t" . 'border-color:transparent; ' . 
			"\n" . '} ' . "\n";
		} elseif ($list_items_color_type == 'bg') {
			if ($custom_colors == 'true') {
				$style_item .= "\n" . '.cmsms_icon_list_items.cmsms_color_type_bg #cmsms_icon_list_item_' . $unique_id . ' .cmsms_icon_list_icon { ' . 
					"\n\t" . 'background-color:' . $color . '; ' . 
				"\n" . '} ' . "\n";
			}
			
			
			$style_item .= "\n" . '.cmsms_icon_list_items.cmsms_color_type_bg #cmsms_icon_list_item_' . $unique_id . ':hover .cmsms_icon_list_icon { ' . 
				"\n\t" . 'border-color:transparent; ' . 
			"\n" . '} ' . "\n";
		} elseif ($list_items_color_type == 'icon') {
			if ($custom_colors == 'true') {
				$style_item .= "\n" . '.cmsms_icon_list_items.cmsms_color_type_icon #cmsms_icon_list_item_' . $unique_id . ' .cmsms_icon_list_icon:before { ' . 
					"\n\t" . 'color:' . $color . '; ' . 
				"\n" . '} ' . "\n\n" . 
				'.cmsms_icon_list_items.cmsms_color_type_icon #cmsms_icon_list_item_' . $unique_id . ':hover .cmsms_icon_list_icon { ' . 
					"\n\t" . 'background-color:' . $color . '; ' . 
				"\n" . '} ' . "\n";
			}
			
			
			$style_item .= "\n" . '.cmsms_icon_list_items.cmsms_color_type_icon #cmsms_icon_list_item_' . $unique_id . ':hover .cmsms_icon_list_icon:before { ' . 
				"\n\t" . 'color:inherit; ' . 
			"\n" . '} ' . "\n";
		}
		
		
		$out_inner .= '<li id="cmsms_icon_list_item_' . $unique_id . '" class="cmsms_icon_list_item' . 
		(($classes != '') ? ' ' . $classes : '') . 
		'">' . "\n" . 
			'<div class="cmsms_icon_list_item_inner">' . "\n" . 
				'<div class="cmsms_icon_list_icon_wrap">' . "\n" . 
					'<span class="cmsms_icon_list_icon ' . $icon . '"></span>' . "\n" . 
				'</div>' . "\n" . 
				'<div class="cmsms_icon_list_item_content">' . "\n" . 
					'<' . $list_heading . ' class="cmsms_icon_list_item_title">' . $title . '</' . $list_heading . '>' . "\n" . 
					cmsms_divpdel('<div class="cmsms_icon_list_item_text">' . "\n" . 
						do_shortcode(wpautop($content)) . 
					'</div>' . "\n") . 
				'</div>' . "\n" . 
			'</div>' . "\n" . 
		'</li>';
	} else {
		if ($custom_colors == 'true') {
			$style_item .= "\n" . '.cmsms_icon_list_items #cmsms_icon_list_item_' . $unique_id . ':before { ' . 
				"\n\t" . 'color:' . $color . '; ' . 
			"\n" . '} ' . "\n";
		}
		
		
		$out_inner .= '<li id="cmsms_icon_list_item_' . $unique_id . '" class="cmsms_icon_list_item ' . $icon . 
		(($classes != '') ? ' ' . $classes : '') . 
		'">' . $title . '</li>';
	}
}

add_shortcode('cmsms_icon_list_item', 'cmsms_icon_list_item');



/**
 * Progress Bars
 */
function cmsms_stats($atts, $content = null) {
    extract(shortcode_atts(array( 
		'mode' => 				'bars', 
		'type' => 				'circles', 
		'border' => 			'', 
		'count' => 				'4', 
		'animation' => 			'', 
		'animation_delay' => 	'', 
		'classes' => 			'' 
    ), $atts));
	
	
	if ($mode == 'counters') {
		wp_enqueue_script('easePieChart');
	}
	
	
	global $style_stats, 
		$stats_mode, 
		$stats_type, 
		$stats_count;
	
	
	$style_stats = '';
	
	$stats_mode = $mode;
	
	$stats_type = $type;
	
	
	if ($count == 4) {
		$stats_count = ' one_fourth';
	} elseif ($count == 3) {
		$stats_count = ' one_third';
	} elseif ($count == 2) {
		$stats_count = ' one_half';
	} else {
		$stats_count = ' one_first';
	}
	
	
	$stats = do_shortcode($content);
	
	
	$style = '<style type="text/css"> ' . $style_stats . '</style> ' . "\n";
	
	
	return $style . 
	'<div class="cmsms_stats stats_mode_' . $mode . ' stats_type_' . $type . 
	(($classes != '') ? ' ' . $classes : '') . 
	(($border == '') ? ' stats_noborder' : '') . 
	'"' . 
	(($animation != '') ? ' data-animation="' . $animation . '"' : '') . 
	(($animation != '' && $animation_delay != '') ? ' data-delay="' . $animation_delay . '"' : '') . 
	'>' . 
		$stats . 
	'</div>';
}

add_shortcode('cmsms_stats', 'cmsms_stats');

/**
 * Single Progress Bar
 */
function cmsms_stat($atts, $content = null) {
    extract(shortcode_atts(array( 
		'progress' => 		'0', 
		'custom_colors' => 	'', 
		'bg_color' => 		'#404040', 
		'color' => 			'#ffffff', 
		'icon' => 			'', 
		'value' => 			'', 
		'value_prefix' => 	'', 
		'value_suffix' => 	'', 
		'classes' => 		'' 
    ), $atts));
	
	
	$unique_id = uniqid();
	
	
	global $style_stats, 
		$stats_mode, 
		$stats_type, 
		$stats_count;
	
	
	if ($stats_mode == 'bars') {
		$style_stats .= "\n" . '.cmsms_stats.shortcode_animated #cmsms_stat_' . $unique_id . '.cmsms_stat { ' . 
			"\n\t" . 'width:' . $progress . '%; ' . 
		"\n" . '} ' . "\n\n";
		if ($custom_colors == 'true') { 
			$style_stats .= '#cmsms_stat_' . $unique_id . ' .cmsms_stat_inner { ' . 
				"\n\t" . 'background-color:' . $bg_color . '; ' . 
				"\n\t" . 'color:' . $color . '; ' . 
			"\n" . '} ' . "\n";
		} 
	}
	
	
	if ($stats_mode == 'counters' && $stats_type == 'numbers' && $custom_colors == 'true') {
		$style_stats .= "\n" . '#cmsms_stat_' . $unique_id . ' .cmsms_stat_counter { ' . 
			"\n\t" . 'color:' . $bg_color . '; ' . 
		"\n" . '} ' . "\n";
	}
	
	
	return '<div class="cmsms_stat_wrap' . (($stats_mode == 'counters') ? $stats_count : '') . '">' . "\n" . 
		'<div id="cmsms_stat_' . $unique_id . '" class="cmsms_stat' . 
		(($classes != '') ? ' ' . $classes : '') . 
		(($content != '' && $icon != '') ? ' stat_has_titleicon' : '') . '"' . 
		' data-percent="' . (($stats_type == 'circles') ? $progress : $value) . '"' . 
		(($stats_mode == 'counters' && $stats_type == 'circles' && $custom_colors == 'true') ? ' data-bar-color="' . $bg_color . '"' : '') . 
		'>' . "\n" . 
			'<div class="cmsms_stat_inner' . 
			(($icon != '') ? ' ' . $icon : '') . 
			'">' . "\n" . 
				(($content != '' && ($stats_mode == 'bars' || ($stats_mode == 'counters' && $stats_type == 'circles'))) ? '<span class="cmsms_stat_title">' . $content . '</span>' . "\n" : '') . 
				'<span class="cmsms_stat_counter_wrap">' . "\n" . 
					(($stats_mode == 'counters' && $stats_type == 'numbers') ? '<span class="cmsms_stat_prefix">' . $value_prefix . '</span>' : '') . 
					'<span class="cmsms_stat_counter">' . (($stats_mode == 'bars') ? $progress : '0') . '</span>' . 
					(($stats_mode == 'bars' || ($stats_mode == 'counters' && $stats_type == 'circles')) ? '<span class="cmsms_stat_units">%</span>' . "\n" : '') . 
					(($stats_mode == 'counters' && $stats_type == 'numbers') ? '<span class="cmsms_stat_suffix">' . $value_suffix . '</span>' . "\n" : '') . 
				'</span>' . "\n" . 
				(($stats_mode == 'counters' && $stats_type == 'numbers' && $content != '') ? '<span class="cmsms_stat_title">' . $content . '</span>' . "\n" : '') . 
			'</div>' . "\n" . 
		'</div>' . "\n" . 
	'</div>';
}

add_shortcode('cmsms_stat', 'cmsms_stat');



/**
 * Embed
 */
function cmsms_embed($atts, $content = null) {
    extract(shortcode_atts(array( 
		'link' => 				'', 
		'width' => 				'', 
		'height' => 			'', 
		'wrap' => 				'', 
		'animation' => 			'', 
		'animation_delay' => 	'', 
		'classes' => 			'' 
    ), $atts));
	
	
	global $wp_embed;
	
	
    $shcd_out = '';
	
	
	if ($wrap != '') {
		$shcd_out .= '[cmsms_video_wrap' . 
		(($width != '') ? ' width="' . $width . '"' : '') . 
		(($animation != '') ? ' animation="' . $animation . '"' : '') . 
		(($animation != '' && $animation_delay != '') ? ' data-delay="' . $animation_delay . '"' : '') . 
		(($classes != '') ? ' classes="' . $classes . '"' : '') . 
		']';
	} else {
		$shcd_out .= '<div class="cmsms_embed_wrap' . 
		(($classes != '') ? ' ' . $classes : '') . 
		'"' . 
		(($animation != '') ? ' data-animation="' . $animation . '"' : '') . 
		(($animation != '' && $animation_delay != '') ? ' data-delay="' . $animation_delay . '"' : '') . 
		'>' . "\n";
	}
	
	
	$shcd_out .= $wp_embed->run_shortcode('[embed' . 
	(($width != '') ? ' width="' . $width . '"' : '') . 
	(($height != '') ? ' height="' . $height . '"' : '') . 
	']' . $link . '[/embed]');
	
	
	if ($wrap != '') {
		$shcd_out .= '[/cmsms_video_wrap]';
	} else {
		$shcd_out .= '</div>';
	}
	
	
	$out = do_shortcode($shcd_out);
	
	
	return $out;
}

add_shortcode('cmsms_embed', 'cmsms_embed');



/**
 * Videos
 */
function cmsms_videos($atts, $content = null) {
    extract(shortcode_atts(array( 
		'poster' => 			'', 
		'width' => 				'', 
		'height' => 			'', 
		'wrap' => 				'', 
		'autoplay' => 			'', 
		'loop' => 				'', 
		'preload' => 			'none', 
		'animation' => 			'', 
		'animation_delay' => 	'', 
		'classes' => 			'' 
    ), $atts));
	
	
	$out = '';
	
	
	$attrs = array( 
		'preload' => $preload 
	);
	
	
	if ($poster != '') {
		$newPosterArray = explode('|', $poster);
		
		
		$newPoster = wp_get_attachment_image_src($newPosterArray[0], 'full');
		
		
		$attrs['poster'] = $newPoster[0];
	}
	
	
	if ($width != '') {
		$attrs['width'] = $width;
	}
	
	
	if ($height != '') {
		$attrs['height'] = $height;
	}
	
	
	if ($autoplay != '') {
		$attrs['autoplay'] = 'on';
	}
	
	
	if ($loop != '') {
		$attrs['loop'] = 'on';
	}
	
	
	$content = str_replace('[/cmsms_video][cmsms_video]', ',', $content);
	
	$content = str_replace('[cmsms_video]', '', $content);
	
	$content = str_replace('[/cmsms_video]', '', $content);
	
	
	$newContentArray = explode(',', $content);
	
	
	foreach ($newContentArray as $newContentItem) {
		$newContentItemArray = explode('|', $newContentItem);
		
		
		if (count($newContentItemArray) > 1) {
			$newContentItemVal = $newContentItemArray[1];
		} else {
			$newContentItemVal = $newContentItemArray[0];
		}
		
		
		$attrs[substr(strrchr($newContentItemVal, '.'), 1)] = $newContentItemVal;
	}
	
	
	if ($wrap != '') {
		$out .= '[cmsms_video_wrap' . 
		(($width != '') ? ' width="' . $width . '"' : '') . 
		(($animation != '') ? ' animation="' . $animation . '"' : '') . 
		(($animation != '' && $animation_delay != '') ? ' data-delay="' . $animation_delay . '"' : '') . 
		(($classes != '') ? ' classes="' . $classes . '"' : '') . 
		']';
	} else {
		$out .= '<div class="cmsms_video' . 
		(($classes != '') ? ' ' . $classes : '') . 
		'"' . 
		(($animation != '') ? ' data-animation="' . $animation . '"' : '') . 
		(($animation != '' && $animation_delay != '') ? ' data-delay="' . $animation_delay . '"' : '') . 
		'>' . "\n";
	}
	
	
	$out .= wp_video_shortcode($attrs);
	
	
	if ($wrap != '') {
		$out .= '[/cmsms_video_wrap]';
	} else {
		$out .= '</div>';
	}
	
	
	$out = do_shortcode($out);
	
	
	return $out;
}

add_shortcode('cmsms_videos', 'cmsms_videos');



/**
 * Video Wrap
 */
function cmsms_video_wrap($atts, $content = null) {
    extract(shortcode_atts(array( 
		'width' => 				'', 
		'animation' => 			'', 
		'animation_delay' => 	'', 
		'classes' => 			'' 
    ), $atts));
	
	
	$unique_id = uniqid();
	
	
	$out = '';
	
	
	if ($width != '') {
		$out .= '<style type="text/css"> ' . "\n" . 
			'#cmsms_video_wrap_' . $unique_id . ' { ' . 
				"\n\t" . 'max-width:' . $width . 'px; ' . 
			"\n" . '} ' . "\n" . 
		'</style>';
	}
	
	
    $out .= cmsms_divpdel('<div id="cmsms_video_wrap_' . $unique_id . '" class="cmsms_video_wrap' . 
	(($classes != '') ? ' ' . $classes : '') . 
	'"' . 
	(($animation != '') ? ' data-animation="' . $animation . '"' : '') . 
	(($animation != '' && $animation_delay != '') ? ' data-delay="' . $animation_delay . '"' : '') . 
	'>' . "\n" . 
		do_shortcode(wpautop($content)) . 
	'</div>' . "\n");
	
	
	return $out;
}

add_shortcode('cmsms_video_wrap', 'cmsms_video_wrap');



/**
 * Audio
 */
function cmsms_audios($atts, $content = null) {
    extract(shortcode_atts(array( 
		'autoplay' => 			'', 
		'loop' => 				'', 
		'preload' => 			'none', 
		'animation' => 			'', 
		'animation_delay' => 	'', 
		'classes' => 			'' 
    ), $atts));
	
	
	$attrs = array( 
		'preload' => $preload 
	);
	
	
	if ($autoplay != '') {
		$attrs['autoplay'] = 'on';
	}
	
	
	if ($loop != '') {
		$attrs['loop'] = 'on';
	}
	
	
	$content = str_replace('[/cmsms_audio][cmsms_audio]', ',', $content);
	
	$content = str_replace('[cmsms_audio]', '', $content);
	
	$content = str_replace('[/cmsms_audio]', '', $content);
	
	
	$newContentArray = explode(',', $content);
	
	
	foreach ($newContentArray as $newContentItem) {
		$newContentItemArray = explode('|', $newContentItem);
		
		
		if (count($newContentItemArray) > 1) {
			$newContentItemVal = $newContentItemArray[1];
		} else {
			$newContentItemVal = $newContentItemArray[0];
		}
		
		
		$attrs[substr(strrchr($newContentItemVal, '.'), 1)] = $newContentItemVal;
	}
	
	
	return '<div class="cmsms_audio' . 
	(($classes != '') ? ' ' . $classes : '') . 
	'"' . 
	(($animation != '') ? ' data-animation="' . $animation . '"' : '') . 
	(($animation != '' && $animation_delay != '') ? ' data-delay="' . $animation_delay . '"' : '') . 
	'>' . "\n" . 
		wp_audio_shortcode($attrs) . 
	'</div>';
}

add_shortcode('cmsms_audios', 'cmsms_audios');



/**
 * Table
 */
function cmsms_table($atts, $content = null) {
    extract(shortcode_atts(array( 
		'caption' => 			'', 
		'animation' => 			'', 
		'animation_delay' => 	'', 
		'classes' => 			'' 
    ), $atts));
	
	
	return '<table class="cmsms_table' . 
	(($classes != '') ? ' ' . $classes : '') . 
	'"' . 
	(($animation != '') ? ' data-animation="' . $animation . '"' : '') . 
	(($animation != '' && $animation_delay != '') ? ' data-delay="' . $animation_delay . '"' : '') . 
	'>' . 
		do_shortcode($content) . 
	'</table>';
}

add_shortcode('cmsms_table', 'cmsms_table');

/**
 * Table Row
 */
function cmsms_tr($atts, $content = null) {
    extract(shortcode_atts(array( 
		'type' => 	'' 
    ), $atts));
	
	
	$out = '';
	
	
	if ($type == 'header') {
		$out .= '<thead>';
	} else if ($type == 'footer') {
		$out .= '<tfoot>';
	}
	
	
	$out .= '<tr' . 
		(($type != '') ? ' class="cmsms_table_row_' . $type . '"' : '') . 
	'>' . 
		do_shortcode($content) . 
	'</tr>';
	
	
	if ($type == 'header') {
		$out .= '</thead>';
	} else if ($type == 'footer') {
		$out .= '</tfoot>';
	}
	
	
	return $out;
}

add_shortcode('cmsms_tr', 'cmsms_tr');

/**
 * Table Cell
 */
function cmsms_td($atts, $content = null) {
    extract(shortcode_atts(array( 
		'type' => 	'', 
		'align' => 	'' 
    ), $atts));
	
	
	return '<' . (($type == 'header') ? 'th' : 'td') . 
	(($align != '') ? ' class="cmsms_table_cell_align' . $align . '"' : '') . 
	'>' . 
		do_shortcode($content) . 
	'</' . (($type == 'header') ? 'th' : 'td') . '>';
}

add_shortcode('cmsms_td', 'cmsms_td');



/**
 * Divider
 */
function cmsms_divider($atts, $content = null) {
    extract(shortcode_atts(array( 
		'type' => 			'solid', 
		'margin_top' => 	'0', 
		'margin_bottom' => 	'0', 
		'classes' => 		'' 
    ), $atts));
	
	
	$unique_id = uniqid();
	
	
	$out = '<style type="text/css"> ' . "\n" . 
		'#cmsms_divider_' . $unique_id . ' { ' . 
			"\n\t" . 'padding-top:' . $margin_top . 'px; ' . 
			"\n\t" . 'margin-bottom:' . $margin_bottom . 'px; ' . 
		"\n" . '} ' . "\n" . 
	'</style>';
	
	
    $out .= '<div id="cmsms_divider_' . $unique_id . '" class="' . 
	(($type == 'transparent') ? 'cl' : 'cmsms_divider ' . $type) . 
	(($classes != '') ? ' ' . $classes : '') . 
	'"></div>';
	
	
	return $out;
}

add_shortcode('cmsms_divider', 'cmsms_divider');



/**
 * Contact Form
 */
function cmsms_contact_form($atts, $content = null) {
    extract(shortcode_atts(array( 
		'form_plugin' => 		'', 
		'form_cf7' => 			'', 
		'form_cfb' => 			'', 
		'email_cfb' => 			'', 
		'animation' => 			'', 
		'animation_delay' => 	'', 
		'classes' => 			'' 
    ), $atts));
	
	
    $out = '<div class="cmsms_contact_form' . 
	(($classes != '') ? ' ' . $classes : '') . 
	'"' . 
	(($animation != '') ? ' data-animation="' . $animation . '"' : '') . 
	(($animation != '' && $animation_delay != '') ? ' data-delay="' . $animation_delay . '"' : '') . 
	'>';
	
	
	if ($form_plugin == 'cf7' && $form_cf7 != '') {
		$cf7_array = explode('{|}', $form_cf7);
		
		
		$out .= do_shortcode('[contact-form-7 id="' . $cf7_array[0] . '" title="' . stripslashes($cf7_array[1]) . '"]');
	} elseif ($form_plugin == 'cfb' && $form_cfb != '' && $email_cfb != '') {
		$out .= do_shortcode('[cmsms_contact_form_sc formname="' . $form_cfb . '" email="' . $email_cfb . '"]');
	}
	
	
	$out .= '</div>';
	
	
	return $out;
}

add_shortcode('cmsms_contact_form', 'cmsms_contact_form');



/**
 * Slider
 */
function cmsms_slider($atts, $content = null) {
    extract(shortcode_atts(array( 
		'slider_plugin' => 		'', 
		'slider_layer' => 		'', 
		'slider_rev' => 		'', 
		'classes' => 			'' 
    ), $atts));
	
	
    $out = '<div class="cmsms_slider' . 
	(($classes != '') ? ' ' . $classes : '') . 
	'">';
	
	
	if ($slider_plugin == 'layer' && $slider_layer != '') {
		$out .= do_shortcode('[layerslider id="' . $slider_layer . '"]');
	} elseif ($slider_plugin == 'rev' && $slider_rev != '') {
		$out .= do_shortcode('[rev_slider ' . $slider_rev . ']');
	}
	
	
	$out .= '</div>';
	
	
	return $out;
}

add_shortcode('cmsms_slider', 'cmsms_slider');



/**
 * Clients
 */
function cmsms_clients($atts, $content = null) {
    extract(shortcode_atts(array( 
		'columns' => 			'5', 
		'layout' => 			'', 
		'height' => 			'180', 
		'border' => 			'', 
		'autoplay' => 			'', 
		'speed' => 				'1', 
		'slides_control' => 	'', 
		'arrow_control' => 		'', 
		'animation' => 			'', 
		'animation_delay' => 	'', 
		'classes' => 			'' 
    ), $atts));
	
	
	$unique_id = uniqid();
	
	$clients_col = '';
	
	global $client_out;
	
	$client_out = '';
	
	if ($columns == 1) {
		$clients_col = 'clients_one';
	} elseif ($columns == 2) {
		$clients_col = 'clients_two';
	} elseif ($columns == 3) {
		$clients_col = 'clients_three';
	} elseif ($columns == 4) {
		$clients_col = 'clients_four';
	} elseif ($columns == 5) {
		$clients_col = 'clients_five';
	}
	
	
	do_shortcode($content);
	
	$out = '<style type="text/css"> ' . "\n" . 
		'#cmsms_clients_' . $unique_id . ' .cmsms_clients_item { ' . 
			'height:' . $height . 'px; ' .  
			'line-height:' . $height . 'px; ' .  
		'} ' . "\n" . 
		'#cmsms_clients_' . $unique_id . ' .cmsms_clients_item a { ' . 
			'line-height:' . $height . 'px; ' .  
		'} ' . "\n" . 
	'</style>' . "\n";
	
	
	if ($layout == 'slider') {
		$out .= '<script type="text/javascript">' . 
			'jQuery(document).ready(function () { ' . 
				'jQuery("#cmsms_clients_' . $unique_id . '").owlCarousel( { ' . 
					'singleItem : false, ' . 
					'items : ' . $columns . ', ' . 
					'itemsDesktopSmall : [768,2], ' . 
					'itemsTablet: [540,1], ' . 
					'slideSpeed : ' . ($speed * 1000) . ', ' . 
					'paginationSpeed : 	' . ($speed * 1000) . ', ' . 
					(($autoplay != 'true') ? 'autoPlay : false, ' : 'autoPlay : true,') . 
					'stopOnHover: true, ' . 
					(($slides_control != 'true') ? 'pagination: false, ' : '') . 
					(($arrow_control == 'true') ? 'navigation : true, ' : '') . 
					'navigationText : 	[ ' . 
						'"<span class=\"cmsms_prev_arrow\"></span>", ' . 
						'"<span class=\"cmsms_next_arrow\"></span>" ' . 
					'] ' . 
				'} );' . 
			'} );' . 
		'</script>' . "\n" . 
		'<div class="cmsms_clients_slider_wrap"' . 
		(($animation != '') ? ' data-animation="' . $animation . '"' : '') . 
		(($animation != '' && $animation_delay != '') ? ' data-delay="' . $animation_delay . '"' : '') . 
		'>' . "\n" . 
			'<div id="cmsms_clients_' . $unique_id . '" class="cmsms_clients_slider owl-carousel' . 
			(($classes != '') ? ' ' . $classes : '') . 
			(($border == '') ? ' clients_noborder' : '') . 
			'"' . 
			'>' . "\n" . 
			$client_out . 
			'</div>' . "\n" . 
		'</div>' . "\n";
	} else {
		$out .= '<div class="cmsms_clients_grid_wrap"' . 
		(($animation != '') ? ' data-animation="' . $animation . '"' : '') . 
		(($animation != '' && $animation_delay != '') ? ' data-delay="' . $animation_delay . '"' : '') . 
		'>' . "\n" . 
		'<div id="cmsms_clients_' . $unique_id . '" class="cmsms_clients_grid' . ' ' . $clients_col . 
		(($classes != '') ? ' ' . $classes : '') . 
		(($border == '') ? ' clients_noborder' : '') . 
		'">' . "\n" . 
		'<div class="cmsms_clients_items slides">' . "\n" . 
			$client_out . 
		'</div>' . "\n" . 
		'</div>' . "\n" . 
		'</div>' . "\n";
	}
	
	return $out;
}

add_shortcode('cmsms_clients', 'cmsms_clients');

/**
 * Single Client
 */
function cmsms_client($atts, $content = null) {
    extract(shortcode_atts(array( 
		'logo' => 		'', 
		'link' => 		'', 
		'classes' => 	'' 
    ), $atts));
	
	
	global $client_out;
	
	
	$counter = 0;
	
	if ($content == null) {
		$content = __('Name', 'cmsms_content_composer');
	}
	
	
	if ($logo != '') {
		$client_logo = wp_get_attachment_image_src($logo, 'full');
		
		if ($link != '') {
			$client_out .= '<div class="cmsms_clients_item item' . 
			(($classes != '') ? ' ' . $classes : '') . 
			'">' . "\n" . 
				'<a href="' . (($link != '') ? '' . $link : '') . '" target="_blank">' .  
					'<img src="' . $client_logo[0] . '" alt="' . $content . '" title="' . $content . '" />' . 
				'</a>' . "\n" . 
			'</div>' . "\n";
		} else {
			$client_out .= '<div class="cmsms_clients_item item' . 
			(($classes != '') ? ' ' . $classes : '') . 
			'">' . "\n" . 
				'<img src="' . $client_logo[0] . '" alt="' . $content . '" title="' . $content . '" />' . "\n" .
			'</div>' . "\n";
		}
	}
}

add_shortcode('cmsms_client', 'cmsms_client');



/**
 * Button
 */
function cmsms_button($atts, $content = null) {
    extract(shortcode_atts(array( 
		'link' => 				'#', 
		'font_family' => 		'', 
		'font_size' => 			'', 
		'line_height' => 		'', 
		'font_weight' => 		'', 
		'font_style' => 		'', 
		'padding_hor' => 		'', 
		'text_align' => 		'center', 
		'custom_colors' => 		'', 
		'bg_color' => 			'#353535', 
		'text_color' => 		'#ffffff', 
		'target' => 			'', 
		'icon' => 				'', 
		'animation' => 			'', 
		'animation_delay' => 	'', 
		'classes' => 			'' 
    ), $atts));
	
	
    $unique_id = uniqid();
	
	
	if ($content == null) {
		$content = __('Button', 'cmsms_content_composer');
	}
	
	
	if ($font_family != '') {
		$font_family_array = explode(':', $font_family);
		
		$font_family_name = "'" . $font_family_array[0] . "'";
		
		
		wp_enqueue_style('cmsms-google-font-' . $unique_id, (is_ssl() ? 'https' : 'http') . '://fonts.googleapis.com/css?family=' . $font_family);
	}
	
	
	$out = '<style type="text/css">' . "\n" . 
		'#cmsms_button_' . $unique_id . ' { ' . 
			"\n\t" . 'text-align:' . $text_align . '; ' . 
		"\n" . '} ' . "\n\n" . 
		'#cmsms_button_' . $unique_id . ' a:before { ' . 
			"\n\t" . 'margin-right:.5em; ' . 
			"\n\t" . 'margin-left:0; ' . 
			"\n\t" . 'vertical-align:baseline; ' . 
		"\n" . '} ' . "\n\n" . 
		'#cmsms_button_' . $unique_id . ' a { ' . 
			(($custom_colors == 'true') ? "\n\t" . 'background-color:' . $bg_color . '; ' : '') . 
			(($custom_colors == 'true') ? "\n\t" . 'color:' . $text_color . '; ' : '') . 
			(($font_family != '') ? "\n\t" . 'font-family:' . str_replace('+', ' ', $font_family_name) . '; ' : '') . 
			(($font_size != '') ? "\n\t" . 'font-size:' . $font_size . 'px; ' : '') . 
			(($line_height != '') ? "\n\t" . 'line-height:' . $line_height . 'px; ' : '') . 
			(($font_weight != '') ? "\n\t" . 'font-weight:' . $font_weight . '; ' : '') . 
			(($font_style != '') ? "\n\t" . 'font-style:' . $font_style . '; ' : '') . 
			(($padding_hor != '') ? "\n\t" . 'padding-right:' . $padding_hor . 'px; ' : '') . 
			(($padding_hor != '') ? "\n\t" . 'padding-left:' . $padding_hor . 'px; ' : '') . 
		"\n" . '} ' . "\n" . 
	'</style>' . "\n" . 
	'<div id="cmsms_button_' . $unique_id . '" class="button_wrap">' . 
		'<a href="' . $link . '" class="cmsms_button' . 
		(($icon != '') ? ' ' . $icon : '') . 
		(($classes != '') ? ' ' . $classes : '') . 
		'"' . 
		(($animation != '') ? ' data-animation="' . $animation . '"' : '') . 
		(($animation != '' && $animation_delay != '') ? ' data-delay="' . $animation_delay . '"' : '') . 
		(($target == 'blank') ? ' target="_blank"' : '') . 
		'>' . $content . '</a>' . 
	'</div>' . "\n";
	
	
	return $out;
}

add_shortcode('cmsms_button', 'cmsms_button');



/**
 * Icon
 */
function cmsms_simple_icon($atts, $content = null) {
    extract(shortcode_atts(array( 
		'icon' => 					'', 
		'size' => 					'40', 
		'display' => 				'block', 
		'text_align' => 			'', 
		'link' => 					'', 
		'target' => 				'', 
		'custom_color' => 			'', 
		'color' => 					'#353535', 
		'color_transparency' => 	'100', 
		'animation' => 				'', 
		'animation_delay' => 		'' 
    ), $atts));
	
	
    $unique_id = uniqid();
	
	
	$out = '<style type="text/css"> ' . "\n" . 
		'#cmsms_icon_' . $unique_id . ' { ' . 
			(($text_align != '') ? "\n\t" . 'text-align:' . $text_align . '; ' : '') . 
			(($display != '') ? "\n\t" . 'display:' . $display . '; ' : '') . 
		'} ' . "\n\n" . 
		'#cmsms_icon_' . $unique_id . ' span { ' . 
			(($custom_color == 'true') ? "\n\t" . cmsms_color_css('color', $color . '|' . $color_transparency) : '') . 
			(($size != '') ? "\n\t" . 'font-size:' . $size . 'px; ' : '') . 
			(($size != '') ? "\n\t" . 'line-height:' . $size . 'px; ' : '') . 
			(($text_align != '') ? "\n\t" . 'text-align:' . $text_align . '; ' : '') . 
		'} ' . "\n" . 
	'</style>' . "\n";
	
	
    $out .= '<div id="cmsms_icon_' . $unique_id . '" class="icon_wrap">' . 
		(($link != '') ? '<a href="' . $link . '"' . (($target == 'blank') ? ' target="_blank"' : '') . '>' : '') . 
			'<span id="cmsms_icon_' . $unique_id . '" class="cmsms_simple_icon' . 
			(($icon != '') ? ' ' . $icon : '') . 
			(($content != '') ? ' ' . $content : '') . 
			'"' . 
			(($animation != '') ? ' data-animation="' . $animation . '"' : '') . 
			(($animation != '' && $animation_delay != '') ? ' data-delay="' . $animation_delay . '"' : '') . 
			'></span>' . 
		(($link != '') ? '</a>' : '') . 
	'</div>' . "\n";
	
	
	return $out;
}

add_shortcode('cmsms_simple_icon', 'cmsms_simple_icon');



/**
 * Image
 */
function cmsms_image($atts, $content = null) {
    extract(shortcode_atts(array( 
		'align' => 				'', 
		'caption' => 			'', 
		'link' => 				'', 
		'target' => 			'', 
		'lightbox' => 			'', 
		'animation' => 			'', 
		'animation_delay' => 	'', 
		'classes' => 			'' 
    ), $atts));
	
	
	if ($align == 'left') {
		$img_align = ' cmsms_image_l';
	} elseif ($align == 'right') {
		$img_align = ' cmsms_image_r';
	} elseif ($align == 'center') {
		$img_align = ' cmsms_image_c';
	} else {
		$img_align = ' cmsms_image_n';
	}
	
	
	$out = '';
	
	
	if ($content != null) {
		$new_image_thumb = explode('|', $content);
		
		
		if (!isset($new_image_thumb[2]) || $new_image_thumb[2] == '') {
			$new_image_size = 'full';
		} else {
			$new_image_size = $new_image_thumb[2];
		}
		
		
		if (is_numeric($new_image_thumb[0])) {
			$new_image = wp_get_attachment_image_src($new_image_thumb[0], $new_image_size);
			
			
			$out .= (($align == 'center') ? '<div class="aligncenter">' . "\n" : '');
			
			
			if ($link != '') {
				$out .= '<div class="cmsms_img ' . $img_align . 
				(($caption != '') ? ' with_caption' : '') . 
				(($classes != '') ? ' ' . $classes : '') . 
				'"' . 
				(($animation != '') ? ' data-animation="' . $animation . '"' : '') . 
				(($animation != '' && $animation_delay != '') ? ' data-delay="' . $animation_delay . '"' : '') . 
				'>' . "\n" . 
					'<a href="' . $link . '"' . 
					(($lightbox == 'true') ? ' rel="ilightbox"' : '') . 
					(($target == 'true') ? ' target="_blank"' : '') . 
					'>' . 
						'<img src="' . $new_image[0] . '" alt="' . 
						(($caption != '') ? ' ' . $caption : '') . 
						'" />' . 
					'</a>' . "\n" . 
					(($caption != '') ? '<p class="cmsms_img_caption">' . $caption . '</p>' : '') . 
				'</div>' . "\n";
			} else {
				$out .= '<div class="cmsms_img ' . $img_align . 
				(($caption != '') ? ' with_caption' : '') . 
				(($classes != '') ? ' ' . $classes : '') . 
				'"' . 
				(($animation != '') ? ' data-animation="' . $animation . '"' : '') . 
				(($animation != '' && $animation_delay != '') ? ' data-delay="' . $animation_delay . '"' : '') . 
				'>' . "\n" . 
					'<img src="' . $new_image[0] . '" alt="' . 
					(($caption != '') ? ' ' . $caption : '') . 
					'" />' . "\n" . 
					(($caption != '') ? '<p class="cmsms_img_caption">' . $caption . '</p>' : '') . 
				'</div>' . "\n";
			}
			
			
			$out .= (($align == 'center') ? '</div>' . "\n" : '');
		}
	}
	
	
	return $out;
}

add_shortcode('cmsms_image', 'cmsms_image');



/**
 * Gallery
 */
function cmsms_gallery($atts, $content = null) { 
    extract(shortcode_atts(array( 
		'layout' => 				'', 
		'image_size_slider' => 		'', 
		'image_size_gallery' => 	'', 
		'hover_pause' => 			'5', 
		'hover_active' => 			'1', 
		'hover_pause_on_hover' => 	'true', 
		'slider_effect' => 			'', 
		'slider_autoplay' => 		'', 
		'slider_slideshow_speed' => '7', 
		'slider_animation_speed' => '600', 
		'slider_pause_on_hover' => 	'', 
		'slider_rewind' => 			'', 
		'slider_rewind_speed' => 	'1000', 
		'slider_nav_control' => 	'', 
		'slider_nav_arrow' => 		'', 
		'gallery_columns' => 		'', 
		'gallery_links' => 			'', 
		'animation' => 				'', 
		'animation_delay' => 		'', 
		'classes' => 				'' 
    ), $atts));
	
	
	if ($gallery_columns == '4') {
		$new_gallery_col = 'one_fourth';
	} elseif ($gallery_columns == '3') {
		$new_gallery_col = 'one_third';
	} elseif ($gallery_columns == '2') {
		$new_gallery_col = 'one_half';
	} else {
		$new_gallery_col = 'one_first';
	}
	
	
	$images = explode(',', do_shortcode($content));
	
	$unique_id = uniqid();
	
	$out = '';
	
	if ($layout == 'slider') {
		if ($image_size_slider == 'thumbnail' || $image_size_slider == 'medium' || $image_size_slider == 'large' || $image_size_slider == 'full') {
			$slider_size = get_option($image_size_slider . '_size_w');
		} else {
			$slider_size_array = cmsms_image_thumbnail_list();
			
			$slider_size = $slider_size_array[$image_size_slider]['width'];
		}
	} elseif ($layout == 'gallery') {
		if ($image_size_gallery == 'thumbnail' || $image_size_gallery == 'medium' || $image_size_gallery == 'large' || $image_size_gallery == 'full') {
			$slider_size = get_option($image_size_gallery . '_size_w');
		} else {
			$slider_size_array = cmsms_image_thumbnail_list();
			
			$slider_size = $slider_size_array[$image_size_gallery]['width'];
		}
	}
	
	if ($content != null) {
		if ($layout == 'hover') {
			$out .= '<script type="text/javascript">' . 
					'jQuery(document).ready(function () { ' . 
						'jQuery("#cmsms_hover_slider_' . $unique_id . '").cmsmsHoverSlider( { ' . 
							'sliderBlock : "#cmsms_hover_slider_' . $unique_id . '", ' . 
							'sliderItems : ".cmsms_hover_slider_items", ' . 
							'thumbWidth : "100", ' . 
							'thumbHeight : "60", ' . 
							'activeSlide : ' . $hover_active . ', ' . 
							'pauseTime : ' . ($hover_pause * 1000) . ', ' . 
							'pauseOnHover : ' . $hover_pause_on_hover . ' ' . 
						'} );' . 
					'} );' . 
				'</script>' . 
			'<div id="cmsms_hover_slider_' . $unique_id . '" class="cmsms_hover_slider' . 
			(($classes != '') ? ' ' . $classes : '') . 
			'"' . 
			(($animation != '') ? ' data-animation="' . $animation . '"' : '') . 
			(($animation != '' && $animation_delay != '') ? ' data-delay="' . $animation_delay . '"' : '') . 
			'>' . "\n" . 
			'<ul class="cmsms_hover_slider_items">' . "\n";
			
			
			foreach ($images as $image) { 
				$out .= '<li>' . 
					'<figure class="cmsms_hover_slider_full_img">' . 
						wp_get_attachment_image($image, 'post-thumbnail') . 
					'</figure>' . 
				'</li>';
			}
			
			$out .= '</ul>' . "\n" . 
			'</div>' . "\n";
		} elseif ($layout == 'slider') {
			$out .= '<div class="content_slider_wrap" style="max-width:' . $slider_size . 'px;"' . 
			(($animation != '') ? ' data-animation="' . $animation . '"' : '') . 
			(($animation != '' && $animation_delay != '') ? ' data-delay="' . $animation_delay . '"' : '') . 
			'>' . "\n" . 
				'<script type="text/javascript">' . 
					'jQuery(document).ready(function () { ' . 
						'jQuery("#cmsms_slider_' . $unique_id . '.content_slider").owlCarousel( { ' . 
							'singleItem : true, ' . 
							(($slider_effect == 'slide') ? 'transitionStyle: false, ' : 'transitionStyle: "fade", ') . 
							(($slider_rewind != 'true') ? 'rewindNav: false, ' : '') . 
							'rewindSpeed : ' . $slider_rewind_speed . ', ' . 
							'slideSpeed : ' . $slider_animation_speed . ', ' . 
							'autoHeight : true, ' . 
							'paginationSpeed : 	' . $slider_animation_speed . ', ' . 
							(($slider_autoplay != 'true') ? 'autoPlay : false, ' : 'autoPlay : ' . ($slider_slideshow_speed * 1000) . ',') . 
							(($slider_pause_on_hover == 'true') ? 'stopOnHover: true, ' : '') . 
							(($slider_nav_control != 'true') ? 'pagination: false, ' : '') . 
							(($slider_nav_arrow == 'true') ? 'navigation : true, ' : '') . 
							'navigationText : 	[ ' . 
								'"<span class=\"cmsms_prev_arrow\"></span>", ' . 
								'"<span class=\"cmsms_next_arrow\"></span>" ' . 
							'] ' . 
						'} );' . 
					'} );' . 
				'</script>' . "\n" . 
				'<div id="cmsms_slider_' . $unique_id . '" class="content_slider owl-carousel' . 
				(($classes != '') ? ' ' . $classes : '') . 
				'">' . "\n";
			
			
			foreach ($images as $image) { 
				$out .= '<div class="item">' . 
					wp_get_attachment_image($image, $image_size_slider) . 
				'</div>';
			}
			
			$out .= '</div>' . "\n" . 
			'</div>' . "\n";
		} else {
			$out .= '<div class="cmsms_gallery' .  
			(($classes != '') ? ' ' . $classes : '') . 
			'"' . 
			(($animation != '') ? ' data-animation="' . $animation . '"' : '') . 
			(($animation != '' && $animation_delay != '') ? ' data-delay="' . $animation_delay . '"' : '') . 
			'>' . "\n" . 
			'<ul>' . "\n";
			
			if ($gallery_links == 'none') {
				foreach ($images as $image) { 
					$out .= '<li class="' . $new_gallery_col . '">' . 
						'<figure>' . 
							wp_get_attachment_image($image, $image_size_gallery) . 
						'</figure>' . 
					'</li>';
				}
			} else {
				foreach ($images as $image) { 
					$image_src = wp_get_attachment_image_src($image, 'full');
					
					$out .= '<li class="' . $new_gallery_col . '">' . "\n" . 
						'<figure>' . 
							'<a'. (($gallery_links == 'blank') ? ' target="_blank"' : '') . ' href="' . $image_src[0] . '"' . (($gallery_links == 'lightbox') ? ' rel="ilightbox[' . $unique_id . ']"' : '') . '>' . 
								wp_get_attachment_image($image, $image_size_gallery) . 
							'</a>' . 
						'</figure>' . 
					'</li>' . "\n";
				}
			}
			
			$out .= '</ul>' . "\n" . 
			'</div>' . "\n";
		}
		
		return $out;
	}
}

add_shortcode('cmsms_gallery', 'cmsms_gallery');



/**
 * Quotes
 */
function cmsms_quotes($atts, $content = null) {
    extract(shortcode_atts(array( 
		'mode' => 				'', 
		'columns' => 			'2', 
		'speed' => 				'10', 
		'animation' => 			'', 
		'animation_delay' => 	'', 
		'classes' => 			'' 
    ), $atts));
	
	
	if ($columns == '4') {
		$new_columns = 'quote_four';
	} elseif ($columns == '3') {
		$new_columns = 'quote_three';
	} elseif ($columns == '2') {
		$new_columns = 'quote_two';
	} else {
		$new_columns = 'quote_one';
	}
	
	
	global $quote_out,
		$quote_mode,
		$quote_counter,
		$column_count;
	
	
	$column_count = $columns;
	
	$unique_id = uniqid();
	
	$quote_mode = $mode;
	
	$quote_out = '';
	
	$quotes_out = '';
	
	$quote_counter = 0;
	
	
	do_shortcode($content);
	
	
	if ($quote_mode == 'slider') {
		$quotes_out .= '<div class="cmsms_quotes_slider_wrap"' . 
		(($animation != '') ? ' data-animation="' . $animation . '"' : '') . 
		(($animation != '' && $animation_delay != '') ? ' data-delay="' . $animation_delay . '"' : '') . 
		'>' . "\n" . 
			'<script type="text/javascript">' . 
				'jQuery(document).ready(function () { ' . 
					'jQuery("#cmsms_quotes_slider_' . $unique_id . '").owlCarousel( { ' . 
						'singleItem : true, ' . 
						(($speed == 0) ? 'autoPlay : false, ' : 'autoPlay : ' . ($speed * 1000) . ',') . 
						'stopOnHover: true, ' . 
						'pagination: false, ' . 
						'navigation : true, ' . 
						'navigationText : 	[ ' . 
							'"<span class=\"cmsms_prev_arrow\"></span>", ' . 
							'"<span class=\"cmsms_next_arrow\"></span>" ' . 
						'] ' . 
					'} );' . 
				'} );' . 
			'</script>' . "\n" . 
			'<div id="cmsms_quotes_slider_' . $unique_id . '" class="cmsms_quotes_slider owl-carousel' . 
			(($classes != '') ? ' ' . $classes : '') . 
			'">' . "\n" . 
				$quote_out . 
			'</div>' . "\n" . 
		'</div>';
	} else {
		$quotes_out .= '<div class="quote_grid' . ' ' . $new_columns . 
		(($classes != '') ? ' ' . $classes : '') . 
		'"' . 
		(($animation != '') ? ' data-animation="' . $animation . '"' : '') . 
		(($animation != '' && $animation_delay != '') ? ' data-delay="' . $animation_delay . '"' : '') . 
		'>' . "\n" . 
		'<div class="quote_vert"></div>' . 
			'<div class="quotes_list">' . "\n" . 
				$quote_out . 
			'</div>' . "\n" . 
		'</div>';
	}
	
	
	return $quotes_out;
}

add_shortcode('cmsms_quotes', 'cmsms_quotes');

/**
 * Single Quote
 */
function cmsms_quote($atts, $content = null) {
    extract(shortcode_atts(array( 
		'image' => 		'', 
		'name' => 		'', 
		'subtitle' => 	'', 
		'link' => 		'', 
		'website' => 	'', 
		'classes' => 	'' 
    ), $atts));
	
	
	global $quote_out,
		$quote_mode,
		$quote_counter,
		$column_count;
	
	
	$quote_counter++;
	
	
	if ($content == null || $content == "<br />\n") {
		$content = __('Enter quote text here', 'cmsms_content_composer');
	}
	
	
	if ($quote_mode == 'slider') {
		$quote_out .= '<div class="cmsms_quote' . 
		(($classes != '') ? ' ' . $classes : '') . 
		'">' . "\n" . 
			'<article class="cmsms_quote_inner">' . "\n" . 
				cmsms_divpdel('<div class="quote_content">' . "\n" . 
					do_shortcode(wpautop($content)) . 
				'</div>' . "\n") . 
				(($image != '') ? '<figure class="quote_image">' . wp_get_attachment_image($image, 'thumbnail') . '</figure>' . "\n": '') . 
				'<div class="wrap_quote_title">' . 
				(($name != '') ? '<h6 class="quote_title">' . $name . '</h6>' . "\n": '') . 
				(($subtitle != '') ? '<span class="quote_subtitle">' . $subtitle . '</span>' . "\n": '');
				
				if ($subtitle != '' && ($link != '' || $website != '')) {
					$quote_out .= ' - ';
				}
				
				if ($link != '' && $website != '') {
					$quote_out .= '<a class="quote_link" target="_blank" href="' . $link . '">' . $website . '</a>' . "\n";
				} elseif ($link == '' && $website != '') {
					$quote_out .= '<span class="quote_site">' . $website . '</span>' . "\n";
				} elseif ($link != '' && $website == '') {
					$quote_out .= '<a class="quote_link" target="_blank" href="' . $link . '">' . $link . '</a>' . "\n";
				}
				
			$quote_out .= '</div>' . "\n" . 
			'</article>' . "\n" . 
		'</div>' . "\n";
	} else {
		$quote_out .= '<div class="cmsms_quote' . 
		(($classes != '') ? ' ' . $classes : '') . 
		'">' . "\n" . 
			'<article class="cmsms_quote_inner">' . "\n" . 
				(($image != '') ? ' <figure class="quote_image">' . wp_get_attachment_image($image, 'thumbnail') . '</figure>' . "\n": '') . 
				'<div class="quote_content_wrap">' . "\n" . 
				cmsms_divpdel('<div class="quote_content">' . "\n" . 
					do_shortcode(wpautop($content)) . 
				'</div>' . "\n") . 
				(($name != '') ? '<h6 class="quote_title">' . $name . '</h6>' . "\n": '') . 
				(($subtitle != '') ? '<span class="quote_subtitle">' . $subtitle . '</span>' . "\n": '');
				
				if ($link != '' || $website != '') {
					$quote_out .= ' - ';
				}
				
				if ($link != '' && $website != '') {
					$quote_out .= '<a class="quote_link" target="_blank" href="' . $link . '">' . $website . '</a>' . "\n";
				} elseif ($link == '' && $website != '') {
					$quote_out .= '<span class="quote_site">' . $website . '</span>' . "\n";
				} elseif ($link != '' && $website == '') {
					$quote_out .= '<a class="quote_link" target="_blank" href="' . $link . '">' . $link . '</a>' . "\n";
				}
				
				$quote_out .= '</div>' . "\n" . 
			'</article>' . "\n" . 
		'</div>' . "\n";
		
		
		if (($quote_counter % $column_count) == 0) {
			$quote_out .= '</div><div class="quotes_list">' . "\n";
		}
	}
}

add_shortcode('cmsms_quote', 'cmsms_quote');



/**
 * Pricing Table Items
 */
function cmsms_pricing_table_items($atts, $content = null) {
    extract(shortcode_atts(array( 
		'columns' => 			'4', 
		'animation' => 			'', 
		'animation_delay' => 	'', 
		'classes' => 			'' 
    ), $atts));
	
	
	global $price_out,
		$price_columns,
		$style_pricing;
	
	
	$out = '';
	
	$price_out = '';
	
	
	if ($columns == '4') {
		$price_columns = 'pricing_four';
	} elseif ($columns == '3') {
		$price_columns = 'pricing_three';
	} elseif ($columns == '2') {
		$price_columns = 'pricing_two';
	} else {
		$price_columns = 'pricing_one';
	}
	
	
	do_shortcode($content);
	
	
	$out .= (($style_pricing != '') ? '<style type="text/css">' . "\n" . $style_pricing . '</style> ' . "\n" : '');
	
	$out .= '<div class="cmsms_pricing_table' . ' ' . $price_columns . 
	(($classes != '') ? ' ' . $classes : '') . 
	'"' . 
	(($animation != '') ? ' data-animation="' . $animation . '"' : '') . 
	(($animation != '' && $animation_delay != '') ? ' data-delay="' . $animation_delay . '"' : '') . 
	'>' . "\n" . 
		$price_out . 
	'</div>' . "\n";
	
	return $out;
}

add_shortcode('cmsms_pricing_table_items', 'cmsms_pricing_table_items');

/**
 * Single Pricing Table Items
 */
function cmsms_pricing_table_item($atts, $content = null) {
    extract(shortcode_atts(array(  
		'price' => 			'100', 
		'coins' => 			'', 
		'currency' => 		'$', 
		'period' => 		'', 
		'custom_colors' => 	'', 
		'color' => 			'', 
		'features' => 		'', 
		'button_text' => 	__('Button', 'cmsms_content_composer'), 
		'button_link' => 	'#', 
		'best' => 			'', 
		'best_custom_bg' => '', 
		'best_color' => 	'', 
		'animation' => 		'', 
		'classes' => 		'' 
    ), $atts));
	
	
	$unique_id = uniqid();
	
	
	$feature_array = explode('||', $features);
	
	
	global $price_out,
		$price_columns,
		$style_pricing;
	
	
	if ($custom_colors == 'true') { 
		$style_pricing .= '#cmsms_pricing_item_' . $unique_id . ' .pricing_title { ' . 
			"\n\t" . 'color:' . $color . '; ' . 
		"\n" . '} ' . "\n" . 
		'#cmsms_pricing_item_' . $unique_id . ' .cmsms_button { ' . 
			"\n\t" . 'background-color:' . $color . '; ' . 
		"\n" . '} ' . "\n";
	}
	
	if ($best_custom_bg == 'true') { 
		$style_pricing .= '#cmsms_pricing_item_' . $unique_id . ' { ' . 
			"\n\t" . 'background-color:' . $best_color . '; ' . 
		"\n" . '} ' . "\n";
	}
	
	$price_out .= '<div id="cmsms_pricing_item_' . $unique_id . '" class="cmsms_pricing_item' . 
	(($best == 'true') ? ' pricing_best' : '') . 
	(($classes != '') ? ' ' . $classes : '') . 
	'"' . 
	(($animation != '') ? ' data-animation="' . $animation . '"' : '') . 
	(($animation != '' && $animation_delay != '') ? ' data-delay="' . $animation_delay . '"' : '') . 
	'>' . "\n" . 
		'<h1 class="pricing_title">' . $content . '</h1>' . "\n" . 
		'<div class="cmsms_price_wrap">' . "\n" . 
		'<span class="cmsms_currency">' . $currency . '</span>' . "\n" . 
		'<span class="cmsms_price">' . $price . '</span>' . "\n" . 
		(($coins != '') ? '<span class="cmsms_coins">.' . $coins . '</span>' . "\n" : '') . 
		(($period != '') ? '<br /><span class="cmsms_period">' . $period . '</span>' . "\n" : '') . 
		'</div>' . "\n";
			
		if (!empty($feature_array)) {
			$price_out .= '<ul class="feature_list">' . "\n";
		}
		
		foreach ($feature_array as $feature) { 
			$feature_atts = explode('|', $feature);
			
			
			$feature_atts = preg_replace('/^title\{([^\}]*)\}/','$1', $feature_atts);
			
			$feature_atts = preg_replace('/^link\{([^\}]*)\}/','$1', $feature_atts);
			
			$feature_atts = preg_replace('/^icon\{([^\}]*)\}/','$1', $feature_atts);
			 
			$price_out .= '<li>' . 
			((isset($feature_atts[2]) && $feature_atts[2] != '') ? '<span class="feature_icon ' . $feature_atts[2] . '">' : '') . 
			((isset($feature_atts[1]) && $feature_atts[1] != '') ? '<a href="' . $feature_atts[1] . '" class="feature_link">' : '') . 
			$feature_atts[0] . 
			((isset($feature_atts[1]) && $feature_atts[1] != '') ? '</a>' : '') . 
			((isset($feature_atts[2]) && $feature_atts[2] != '') ? '</span>' : '') . 
			'</li>' . "\n";
		}
		
		if (!empty($feature_array)) { 
			$price_out .= '</ul>' . "\n";
		}
		
		$price_out .= (($button_text != '') ? '<a href="' . $button_link . '" class="cmsms_button">' . $button_text . '</a>' . "\n" : '') . 
	'</div>' . "\n";
	
}

add_shortcode('cmsms_pricing_table_item', 'cmsms_pricing_table_item');



/**
 * Google Map Markers
 */
function cmsms_google_map_markers($atts, $content = null) {
    extract(shortcode_atts(array( 
		'address_type' => 			'', 
		'address' => 				'', 
		'latitude' => 				'', 
		'longitude' => 				'', 
		'type' => 					'', 
		'zoom' => 					'14', 
		'height_type' => 			'', 
		'height' => 				'300', 
		'scroll_wheel' => 			'', 
		'double_click_zoom' => 		'', 
		'pan_control' => 			'', 
		'zoom_control' => 			'', 
		'map_type_control' => 		'', 
		'scale_control' => 			'', 
		'street_view_control' => 	'', 
		'overview_map_control' => 	'', 
		'animation' => 				'', 
		'animation_delay' => 		'', 
		'classes' => 				'' 
    ), $atts));
	
	
	global $map_out;
	
	
	$map_out = '';
	
	
	do_shortcode($content);
	
	
	wp_enqueue_script('gMapAPI');
	wp_enqueue_script('gMap');
	
	
	$unique_id = uniqid();
	
	
	$maps_out = (($height_type == 'fixed') ? '<style type="text/css">' . "\n" . 
		'#google_map_' . $unique_id . '{' . "\n\t" . 
			'height: ' . $height . 'px;' . "\n" . 
		'}' . "\n" . 
	'</style>' . "\n" : '') . 
    '<script type="text/javascript">' . 
        'jQuery(document).ready(function () { ' . 
            'jQuery("#google_map_' . $unique_id . '").gMap( { ';
				if ($address_type == 'address') {
					$maps_out .= 'address: "' . $address . '", ' ;
				} else {
					$maps_out .= 'markers: {' . 
						(($latitude != '') ? 'latitude: ' . $latitude  . ', ' : '') . 
						(($longitude != '') ? 'latitude: ' . $longitude  . ' ' : '') . 
					'},';
				}
				$maps_out .= 'maptype: "' . $type . '", ' . 
				'zoom: ' . $zoom . ', ' . 
				(($scroll_wheel == 'true') ? 'scrollwheel: ' . $scroll_wheel  . ', ' : '') . 
				(($double_click_zoom == 'true') ? 'doubleClickZoom: ' . $double_click_zoom  . ', ' : '') . 
				'controls: {' . 
					(($pan_control == 'true') ? 'panControl: ' . $pan_control  . ', ' : '') . 
					(($zoom_control == 'true') ? 'zoomControl: ' . $zoom_control  . ', ' : '') . 
					(($map_type_control == 'true') ? 'mapTypeControl: ' . $map_type_control  . ', ' : '') . 
					(($scale_control == 'true') ? 'scaleControl: ' . $scale_control  . ', ' : '') . 
					(($street_view_control == 'true') ? 'streetViewControl: ' . $street_view_control  . ', ' : '') . 
					(($overview_map_control == 'true') ? 'overviewMapControl: ' . $overview_map_control  . ', ' : '') . 
				'},';
				$maps_out .= 'markers: [' . 
					$map_out . 
				']';
			$maps_out .= ' } );' . 
        ' } );' . 
    '</script>' . "\n" . 
	cmsms_divpdel((($height_type != 'fixed') ? '<div class="resizable_block">' . "\n" : '') . 
		'<div id="google_map_' . $unique_id . '" class="google_map' . 
		(($classes != '') ? ' ' . $classes : '') . 
		'"' . 
		(($animation != '') ? ' data-animation="' . $animation . '"' : '') . 
		(($animation != '' && $animation_delay != '') ? ' data-delay="' . $animation_delay . '"' : '') . 
		'></div>' . "\n" . 
	(($height_type != 'fixed') ? '</div>' . "\n" : ''));
	
	
	return $maps_out;
}

add_shortcode('cmsms_google_map_markers', 'cmsms_google_map_markers');

/**
 * Google Map Marker
 */
function cmsms_google_map_marker($atts, $content = null) {
    extract(shortcode_atts(array( 
		'address_type' => 	'', 
		'address' => 		'', 
		'latitude' => 		'', 
		'longitude' => 		'', 
		'popup' => 			''
    ), $atts));
	
	
	global $map_out;
	
	
	$map_out .= '{';
	if ($address_type == 'address') { 
		$map_out .= 'address: "' . $address . '",'; 
	} elseif  ($address_type == 'coordinates') { 
		$map_out .= 'latitude: ' . $latitude . ',' . 
		'longitude: ' . $longitude . ',';
	} 
	
	$map_out .= (($content != '') ? 'html: "' . $content . '",' : '') . 
	(($popup == 'true') ? 'popup: true' : '');
	$map_out .= '},';
}

add_shortcode('cmsms_google_map_marker', 'cmsms_google_map_marker');



/**
 * Social Sharing
 */
function cmsms_social($atts, $content = null) {
    extract(shortcode_atts(array( 
		'facebook' => 			'', 
		'twitter' => 			'', 
		'google' => 			'', 
		'pinterest' => 			'', 
		'type' => 				'', 
		'animation' => 			'', 
		'animation_delay' => 	'', 
		'classes' => 			'' 
    ), $atts));
	
	
	$out = '';
	
	if ($facebook == 'true' || $twitter == 'true' || $google == 'true' || $pinterest == 'true') {
		$out .= '<div class="cmsms_sharing' . 
		(($type == 'vertical') ? ' social_vertical' : '') . 
		(($classes != '') ? ' ' . $classes : '') . 
		'"' . 
		(($animation != '') ? ' data-animation="' . $animation . '"' : '') . 
		(($animation != '' && $animation_delay != '') ? ' data-delay="' . $animation_delay . '"' : '') . 
		'>' . "\n";
		
		if ($twitter == 'true') {
			$out .= '<div class="share_wrap">' . "\n" . 
				'<a href="https://twitter.com/share" class="twitter-share-button" data-lang="en">' . __('Tweet', 'cmsms_content_composer') . '</a>' . "\n" . 
				'<script type="text/javascript">
					!function (d, s, id) { 
						var js = undefined, 
							fjs = d.getElementsByTagName(s)[0];
						
						if (d.getElementById(id)) { 
							d.getElementById(id).parentNode.removeChild(d.getElementById(id));
						}
						
						js = d.createElement(s);
						js.id = id;
						js.src = "//platform.twitter.com/widgets.js";
						
						fjs.parentNode.insertBefore(js, fjs);
					} (document, "script", "twitter-wjs");
				</script>' . 
			'</div>' . "\n";
		}
		
		if ($google == 'true') {
			$out .= '<div class="share_wrap">' . "\n" . 
				'<div class="g-plusone" data-size="medium"></div>
				<script type="text/javascript">
					(function () { 
						var po = document.createElement("script"), 
							s = document.getElementsByTagName("script")[0];
						
						po.type = "text/javascript";
						po.async = true;
						po.src = "https://apis.google.com/js/plusone.js";
						
						s.parentNode.insertBefore(po, s);
					} )();
				</script>' . 
			'</div>' . "\n";
		}
		
		if ($pinterest == 'true') {
			$out .= '<div class="share_wrap">' . "\n" . 
				'<a href="http://pinterest.com/pin/create/button/?url=url_text&media=http%3A%2F%2Ftext&description=descr_text" class="pin-it-button" count-layout="horizontal">
					<img border="0" src="//assets.pinterest.com/images/PinExt.png" title="' . __('Pin It', 'cmsms_content_composer') . '" />
				</a>
				<script type="text/javascript">
					(function (d, s, id) { 
						var js = undefined, 
							fjs = d.getElementsByTagName(s)[0];
						
						if (d.getElementById(id)) { 
							d.getElementById(id).parentNode.removeChild(d.getElementById(id));
						}
						
						js = d.createElement(s);
						js.id = id;
						js.src = "//assets.pinterest.com/js/pinit.js";
						
						fjs.parentNode.insertBefore(js, fjs);
					} (document, "script", "pinterest-wjs"));
				</script>' . 
			'</div>' . "\n";
		}
		
		if ($facebook == 'true') {
			$out .= '<div class="share_wrap">' . "\n" . 
				'<div class="fb-like" data-send="false" data-layout="button_count" data-width="200" data-show-faces="false" data-font="arial"></div>
				<script type="text/javascript">
					(function (d, s, id) { 
						var js = undefined, 
							fjs = d.getElementsByTagName(s)[0];
						
						if (d.getElementById(id)) { 
							d.getElementById(id).parentNode.removeChild(d.getElementById(id));
						}
						
						js = d.createElement(s);
						js.id = id;
						js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
						
						fjs.parentNode.insertBefore(js, fjs);
					} (document, "script", "facebook-jssdk"));
				</script>' . "\n" . 
			'</div>' . "\n";
		}
		
		$out .= '<div class="cl"></div>' . "\n" . 
		'</div>' . "\n";
	}
	
	return $out;
}

add_shortcode('cmsms_social', 'cmsms_social');



/**
 * Custom HTML
 */
function cmsms_html($atts, $content = null) {
    extract(shortcode_atts(array( 
		'classes' => 	'' 
    ), $atts));
	
	
	$out = '';
	
	
	if ($content != null ) {
		$out .= cmsms_divpdel('<div class="custom_html' . 
		(($classes != '') ? ' ' . $classes : '') . 
		'">' . "\n" . 
		wpautop($content) . 
		'</div>' . "\n");
	}
	
	
	return $out;
}

add_shortcode('cmsms_html', 'cmsms_html');



/**
 * Custom JS
 */
function cmsms_js($atts, $content = null) {
    extract(shortcode_atts(array( 
		'classes' => 	'' 
    ), $atts));
	
	
	$out = '';
	
	
	if ($content != null ) {
		$out .= '<div class="custom_js' . 
		(($classes != '') ? ' ' . $classes : '') . 
		'">' . "\n" . 
		'<script type="javascript">' . "\n" . 
			str_replace('<br />', '', $content) . 
		'</script>' . "\n" . 
		'</div>' . "\n";
	}
	
	
	return $out;
}


add_shortcode('cmsms_js', 'cmsms_js');



/**
 * Custom CSS
 */
function cmsms_css($atts, $content = null) {
    extract(shortcode_atts(array( 
		'classes' => 	'' 
    ), $atts));
	
	
	$out = '';
	
	
	if ($content != null ) {
		$out .= '<div class="custom_css' . 
		(($classes != '') ? ' ' . $classes : '') . 
		'">' . "\n" . 
		'<style type="text/css">' . "\n" . 
			str_replace('<br />', '', $content) . 
		'</style>' . "\n" . 
		'</div>' . "\n";
	}
	
	
	return $out;
}


add_shortcode('cmsms_css', 'cmsms_css');



/**
 * Sidebar
 */
function cmsms_sidebar($atts, $content = null) { 
    extract(shortcode_atts(array( 
		'sidebar' => 	'', 
		'layout' => 	'', 
		'classes' => 	'' 
    ), $atts));
	
	
	$layout_sidebar = '';
	
	$out = '';
	
	
	if ($layout == '') {
		$layout_sidebar = 'sidebar_layout_11';
	} elseif ($layout == '1212') {
		$layout_sidebar = 'sidebar_layout_1212';
	} elseif ($layout == '1323') {
		$layout_sidebar = 'sidebar_layout_1323';
	} elseif ($layout == '2313') {
		$layout_sidebar = 'sidebar_layout_2313';
	} elseif ($layout == '1434') {
		$layout_sidebar = 'sidebar_layout_1434';
	} elseif ($layout == '3414') {
		$layout_sidebar = 'sidebar_layout_3414';
	} elseif ($layout == '131313') {
		$layout_sidebar = 'sidebar_layout_131313';
	} elseif ($layout == '121414') {
		$layout_sidebar = 'sidebar_layout_121414';
	} elseif ($layout == '141214') {
		$layout_sidebar = 'sidebar_layout_141214';
	} elseif ($layout == '141412') {
		$layout_sidebar = 'sidebar_layout_141412';
	} elseif ($layout == '14141414') {
		$layout_sidebar = 'sidebar_layout_14141414';
	}
	
	if(!function_exists('get_dynamic_sidebar')){
		function get_dynamic_sidebar($sidebar = 1) {
			$sidebar_contents = '';
			
			ob_start();
			
			dynamic_sidebar($sidebar);
			
			$sidebar_contents = ob_get_clean();
			
			return $sidebar_contents;
		}
	}
	
	if ($sidebar != '') {
		$out = '<div class="cmsms_sidebar ' . $layout_sidebar . 
		(($classes != '') ? ' ' . $classes : '') . 
		'">' . 
		get_dynamic_sidebar($sidebar);
		
		$out .= '<div class="cl"></div>' . "\n" . 
		'</div>';
	}
	
	
	return $out;
}

add_shortcode('cmsms_sidebar', 'cmsms_sidebar');



/**
 * Twitter Stripe
 */
function cmsms_twitter($atts, $content = null) { 
    extract(shortcode_atts(array( 
		'user' => 				'', 
		'count' => 				'', 
		'date' => 				'', 
		'control' => 			'', 
		'autoplay' => 			'', 
		'speed' => 				'1', 
		'animation' => 			'', 
		'animation_delay' => 	'', 
		'classes' => 			'' 
    ), $atts));
	
	
	$out = '';
	
	
	$unique_id = uniqid();
	
	
	if ($user != '') {
		$out .= '<script type="text/javascript">' . 
					'jQuery(document).ready(function () { ' . 
						'jQuery("#cmsms_twitter_' . $unique_id . '").owlCarousel( { ' . 
							'singleItem : true, ' . 
							'transitionStyle: "fade", ' . 
							'stopOnHover: true, ' . 
							'pagination: false, ' . 
							(($control == 'true') ? 'navigation : true, ' : '') . 
							(($autoplay != 'true') ? 'autoPlay : false, ' : 'autoPlay : ' . ($speed * 1000) . ',') . 
							'navigationText : 	[ ' . 
								'"<span class=\"cmsms_prev_arrow\"></span>", ' . 
								'"<span class=\"cmsms_next_arrow\"></span>" ' . 
							'] ' . 
						'} );' . 
					'} );' . 
				'</script>' . "\n" . 
		'<div class="cmsms-icon-twitter-bird-1 twr_icon"></div>' . "\n" . 
		'<div id="cmsms_twitter_' . $unique_id . '" class="owl-carousel cmsms_twitter' . 
		(($classes != '') ? ' ' . $classes : '') . 
		'"' . 
		(($animation != '') ? ' data-animation="' . $animation . '"' : '') . 
		(($animation != '' && $animation_delay != '') ? ' data-delay="' . $animation_delay . '"' : '') . 
		'>' . "\n";
		
			$tweets = cmsms_get_tweets($user, $count);
			
			if ($tweets != '') {
				foreach ($tweets as $t) {
					$out .= '<div class="cmsms_twitter_item">' . "\n" . 
						(($date == 'true') ? '<abbr title="" class="published">' . human_time_diff( $t['time'], current_time('timestamp') ) . ' ' . __('ago', 'cmsms_content_composer') . '</abbr>' : '') . 
						'<span class="cmsms_twitter_item_content">' . "\n" . $t['text'] . '</span>' . "\n" . 
					'</div>' . "\n";
				}
			} else {
				echo '<div class="cmsms_notice cmsms_notice_error cmsms-icon-cancel-6">' . "\n" . 
					'<div class="notice_content">' . "\n" . 
						'<p>' . __('Please add your Twitter API keys', 'cmsmasters') . ', ' . '<a target="_blank" href="http://docs.cmsmasters.net/admin2/twitter-functionality/">' . __('read more how', 'cmsmasters') . '</a></p>' . "\n" . 
					'</div>' . "\n" . 
				'</div>' . "\n";
			}
		
		$out .= '</div>' . "\n";
	}
	
	
	return $out;
}

add_shortcode('cmsms_twitter', 'cmsms_twitter');



/**
 * Posts Slider
 */
function cmsms_posts_slider($atts, $content = null) { 
    extract(shortcode_atts(array( 
		'orderby' => 				'', 
		'order' => 					'', 
		'post_type' => 				'', 
		'blog_categories' => 		'', 
		'portfolio_categories' => 	'', 
		'columns' => 				'', 
		'count' => 					'', 
		'pause' => 					'', 
		'speed' => 					'', 
		'blog_metadata' => 			'', 
		'portfolio_metadata' => 	'', 
		'animation' => 				'', 
		'animation_delay' => 		'', 
		'classes' => 				'' 
    ), $atts));
	
	
	$unique_id = uniqid();
	
	
	global $cmsms_post_metadata;
	
	$cmsms_post_metadata = $blog_metadata;
	
	
	global $cmsms_project_metadata;
	
	$cmsms_project_metadata = $portfolio_metadata;
	
	
    $args = array( 
		'post_type' => 				$post_type,
		'ignore_sticky_posts' => 	1, 
		'orderby' => 				$orderby, 
		'order' => 					$order, 
		'posts_per_page' => 		$count 
	);
	
	
	if ($post_type == 'post' && $blog_categories != '') {
		$args['category_name'] = $blog_categories;
	} elseif ($post_type == 'project' && $portfolio_categories != '') {
		$cat_array = explode(",", $portfolio_categories);
		
		$args['tax_query'] = array(
			array( 
				'taxonomy' => 	'pj-categs', 
				'field' => 		'slug', 
				'terms' => 		$cat_array 
			)
		);
	}
	
	
	$query = new WP_Query($args);
	
	
	if ($query->have_posts()) : 
		
		$out = "<div class=\"cmsms_posts_slider" . 
			(($classes != '') ? ' ' . $classes : '') . 
		"\" " . 
			(($animation != '') ? ' data-animation="' . $animation . '"' : '') . 
			(($animation != '' && $animation_delay != '') ? ' data-delay="' . $animation_delay . '"' : '') . 
		">
			<script type=\"text/javascript\">
				jQuery(document).ready(function () { 
					var container = jQuery('.cmsms_slider_{$unique_id}');
						containerWidth = container.width(), 
						firstPost = container.find('article'), 
						postMinWidth = Number(firstPost.css('minWidth').replace('px', '')), 
						postThreeColumns = (postMinWidth * 4) - 1;
						postTwoColumns = (postMinWidth * 3) - 1;
						postOneColumns = (postMinWidth * 2) - 1; 
					
					
					jQuery('.cmsms_slider_{$unique_id}').owlCarousel( {
						items : {$columns}, 
						itemsDesktop : false,
						itemsDesktopSmall : [postThreeColumns," . (($columns > 3) ? '3' : $columns) . "], 
						itemsTablet : [postTwoColumns," . (($columns > 2) ? '2' : $columns) . "], 
						itemsMobile : [postOneColumns,1], 
						transitionStyle : false, 
						rewindNav : true, 
						slideSpeed : 200, 
						paginationSpeed : 800, 
						rewindSpeed : 1000, " . 
						(($pause == '0') ? 'autoPlay : false, ' : 'autoPlay : ' . ($pause * 1000) . ', ') . 
						"stopOnHover : true, 
						autoHeight : true, 
						addClassActive : true, 
						responsiveBaseWidth : '.cmsms_slider_{$unique_id}', 
						pagination : false, 
						navigation : true, 
						navigationText : [ " . 
							'"<span class=\"cmsms_prev_arrow\"></span>", ' . 
							'"<span class=\"cmsms_next_arrow\"></span>" ' . 
						"] 
					} );
				} );
			</script>
			<div id=\"cmsms_owl_carousel_{$unique_id}\" class=\"" . 
				'cmsms_owl_slider ' . 
				'cmsms_slider_' . $unique_id . '">';
				
				
				while ($query->have_posts()) : $query->the_post();
					
					if ($post_type == 'post') {
						if (get_post_format() != '') {
							$out .= '<div>' . 
								load_template_part('framework/postType/posts-slider/blog/' . get_post_format()) . 
							'</div>';
						} else {
							$out .= '<div>' . 
								load_template_part('framework/postType/posts-slider/blog/standard') . 
							'</div>';
						}
					} elseif ($post_type == 'project') {
						if (get_post_format() != '') {
							$out .= '<div>' . 
								load_template_part('framework/postType/posts-slider/portfolio/' . get_post_format()) . 
							'</div>';
						} else {
							$out .= '<div>' . 
								load_template_part('framework/postType/posts-slider/portfolio/standard') . 
							'</div>';
						}
					}
					
				endwhile;
				
				
			$out .= '</div>' . 
		'</div>';
	
	endif;
	
	
	wp_reset_postdata();
	
	wp_reset_query();
	
	
	return $out;
}

add_shortcode('cmsms_posts_slider', 'cmsms_posts_slider');



/**
 * Blog
 */
function cmsms_blog($atts, $content = null) {
	extract(shortcode_atts(array( 
		'orderby' => 			'date', 
		'order' => 				'DESC', 
		'count' => 				'12', 
		'categories' => 		'', 
		'layout' => 			'standard', 
		'layout_mode' => 		'', 
		'columns' => 			'', 
		'metadata' => 			'', 
		'filter' => 			'', 
		'filter_text' => 		'', 
		'filter_cats_text' => 	'', 
		'pagination' => 		'pagination', 
		'more_text' => 			'', 
		'classes' => 			'' 
	), $atts));
	
	
	$unique_id = uniqid();
	
	
	global $cmsms_metadata;
	
	
	$cmsms_metadata = $metadata;
	
	
	$more_text = ($more_text != '') ? $more_text : __('Load More Posts', 'cmsmasters');
	
	
	$filter_text = ($filter_text != '') ? $filter_text : __('Filter', 'cmsmasters');
	
	
	$filter_cats_text = ($filter_cats_text != '') ? $filter_cats_text : __('All Categories', 'cmsmasters');
	
	
	$out = "<div class=\"cmsms_wrap_blog entry-summary\" id=\"blog_{$unique_id}\" data-meta=\"{$metadata}\">";
	
	
	if ( 
		$layout != 'standard' || 
		($layout == 'standard' && $pagination == 'more') 
	) {
		wp_enqueue_style('isotope');
		
		
		wp_enqueue_script('isotope');
		
		wp_enqueue_script('isotopeMode');
		
		
		$out .= "<script type=\"text/javascript\">
jQuery(document).ready(function () {
	(function ($) {
		if ($('#blog_{$unique_id}').find('article').length == '0') {
			return false;
		}
		
	
		startBlog( 
			'" . $unique_id . "', 
			'" . $layout . "', 
			'" . $layout_mode . "', 
			'" . CMSMS_CONTENT_COMPOSER_URL . "', 
			'" . $orderby . "', 
			'" . $order . "', 
			'" . $count . "', 
			'" . $categories . "' 
		);
	} )(jQuery);
} );
</script>
";

		if ($filter !== '') {
			$out .= "<div class=\"cmsms_post_filter_wrap\">
				<div class=\"cmsms_post_filter\">
					<span class=\"cmsms_post_filter_loader\"></span>
					<div class=\"cmsms_post_filter_block\">
						<a class=\"cmsms_post_filter_but cmsms-icon-menu button\">
							<span>" . $filter_text . "</span>
						</a>
						<ul class=\"cmsms_post_filter_list\">
							<li class=\"current\">
								<a class=\"button\" data-filter=\"article.post\"  title=\"" . $filter_cats_text . "\" href=\"javascript:void(0);\">
									<span>" . $filter_cats_text . "</span>
								</a>
							</li>";
							
							
							$cat_args = array( 
								'orderby' => 	'name' 
							);
							
							
							if ($categories != '') {
								$cat_array = explode(',', $categories);
								
								
								for ($i = 0; $i < count($cat_array); $i++) {
									$idObj = get_category_by_slug($cat_array[$i]);
									
									$cat_array[$i] = $idObj->term_id;
								}
							} else {
								$cat_array = $categories;
							}
							
							
							if (count($cat_array) == 1 && $categories != '') {
								$cat_args['child_of'] = $categories;
							} elseif (count($cat_array) > 1) {
								$cat_args['include'] = $cat_array;
							}
							
							
							$post_categs = get_terms('category', $cat_args);
							
							
							if (is_array($post_categs) && !empty($post_categs)) {
								foreach ($post_categs as $post_categ) {
									$out .= "<li>
										<a class=\"button\" href=\"#\" data-filter=\"article.post[data-category~='{$post_categ->slug}']\" title=\"{$post_categ->name}\">
											<span>{$post_categ->name}</span>
										</a>
									</li>";
								}
							}
							
						$out .= "</ul>
					</div>
				</div>
			</div>";
		}
	}
	
	$out .= '<div class="blog ' . 
		$layout . 
		(($layout_mode !== '') ? ' ' . $layout_mode : '') . 
		(($columns !== '') ? ' cmsms_' . $columns : '') . 
		(($classes !== '') ? ' ' . $classes : '') . 
	'">';
	
	
	$orderby = ($orderby == 'popular') ? 'meta_value_num' : $orderby;
	
	
	$args = array( 
		'post_type' => 				'post', 
		'orderby' => 				$orderby, 
		'order' => 					$order, 
		'posts_per_page' => 		$count, 
		'category_name' => 			$categories, 
		'ignore_sticky_posts' => 	true 
	);
	
	
	if ($pagination == 'pagination') {
		if (get_query_var('paged')) { 
			$paged = get_query_var('paged'); 
		} elseif (get_query_var('page')) { 
			$paged = get_query_var('page'); 
		} else { 
			$paged = 1; 
		}
		
		
		$args['paged'] = $paged;
	}
	
	
	if ($orderby == 'meta_value_num') {
		$args['meta_key'] = 'cmsms_likes';
	}
	
	
	$query = new WP_Query($args);
	
	
	if ($query->have_posts()) : 
		while ($query->have_posts()) : $query->the_post();
			if ($layout == 'columns') {
				if (get_post_format() != '') {
					$out .= load_template_part('framework/postType/blog/page/masonry/' . get_post_format());
				} else {
					$out .= load_template_part('framework/postType/blog/page/masonry/standard');
				}
			} elseif ($layout == 'timeline') {
				if (get_post_format() != '') {
					$out .= load_template_part('framework/postType/blog/page/timeline/' . get_post_format());
				} else {
					$out .= load_template_part('framework/postType/blog/page/timeline/standard');
				}
			} else {
				if (get_post_format() != '') {
					$out .= load_template_part('framework/postType/blog/page/default/' . get_post_format());
				} else {
					$out .= load_template_part('framework/postType/blog/page/default/standard');
				}
			}
		endwhile;
		
		
		if ($pagination == 'more') {
			wp_enqueue_style('mediaelement');
			
			wp_enqueue_style('wp-mediaelement');
			
			
			wp_enqueue_script('mediaelement');
			
			wp_enqueue_script('wp-mediaelement');
		}
	endif;
	
	
	$out .= '</div>';
	
	
	if ($pagination !== 'disabled') {
		$out .= '<div class="cmsms_wrap_more_posts">';
		
			if ($pagination == 'pagination' && $query->max_num_pages > 1) {
				$out .= pagination($query->max_num_pages);
			} elseif ($pagination == 'more' && $query->found_posts > $count) {
				$out .= "<div class=\"cmsms_wrap_post_loader\">
					<a href=\"javascript:void(0);\" class=\"cmsms_button cmsms_post_loader\">
						<span>" . $more_text . "</span>
					</a>
				</div>";
			}
		
		$out .= '</div>';
	}
	
	$out .= '</div>';
	
	
	wp_reset_postdata();
	
	wp_reset_query();
	
	
	return $out;
}

add_shortcode('cmsms_blog', 'cmsms_blog');



/**
 * Portfolio
 */
function cmsms_portfolio($atts, $content = null) {
	extract(shortcode_atts(array( 
		'orderby' => 			'date', 
		'order' => 				'DESC', 
		'count' => 				'12', 
		'categories' => 		'', 
		'layout' => 			'grid', 
		'layout_mode' => 		'perfect', 
		'columns' => 			'4', 
		'metadata' => 			'', 
		'gap' => 				'large', 
		'filter' => 			'', 
		'filter_text' => 		'', 
		'filter_cats_text' => 	'', 
		'sorting' => 			'', 
		'sorting_name_text' => 	'', 
		'sorting_date_text' => 	'', 
		'pagination' => 		'pagination', 
		'more_text' => 			'', 
		'classes' => 			'' 
	), $atts));
	
	
	$unique_id = uniqid();
	
	
	global $cmsms_pj_metadata;
	
	
	$cmsms_pj_metadata = $metadata;
	
	
	global $cmsms_pj_layout_mode;
	
	
	$cmsms_pj_layout_mode = $layout_mode;
	
	
	$more_text = ($more_text != '') ? $more_text : __('Load More Projects', 'cmsmasters');
	
	$filter_text = ($filter_text != '') ? $filter_text : __('Filter', 'cmsmasters');
	
	$filter_cats_text = ($filter_cats_text != '') ? $filter_cats_text : __('All Categories', 'cmsmasters');
	
	$sorting_name_text = ($sorting_name_text != '') ? $sorting_name_text : __('Name', 'cmsmasters');
	
	$sorting_date_text = ($sorting_date_text != '') ? $sorting_date_text : __('Date', 'cmsmasters');
	
	
	$out = "<div class=\"cmsms_wrap_portfolio entry-summary\" id=\"portfolio_{$unique_id}\" data-meta=\"{$metadata}\">";
	
	
	wp_enqueue_style('isotope');
	
	
	wp_enqueue_script('isotope');
	
	wp_enqueue_script('isotopeMode');
	
	
$out .= "<script type=\"text/javascript\">
jQuery(document).ready(function () {
	(function ($) {
		if ($('#portfolio_{$unique_id}').find('article').length == '0') {
			return false;
		}
		
	
		startPortfolio( 
			'" . $unique_id . "', 
			'" . $layout . "', 
			'" . $layout_mode . "', 
			'" . CMSMS_CONTENT_COMPOSER_URL . "', 
			'" . $orderby . "', 
			'" . $order . "', 
			'" . $count . "', 
			'" . $categories . "' 
		);
	} )(jQuery);
} );
</script>
";
	
	
	if ($filter != '' || $sorting != '') {
		$out .= "<div class=\"cmsms_project_filter_wrap\">
			<div class=\"cmsms_project_filter\">
				<span class=\"cmsms_project_filter_loader\"></span>";
				
				if ($sorting != '') {
					$out .= "<div class=\"cmsms_project_sort_block\">
						<a href=\"#\" name=\"project_name\" title=\"" . $sorting_name_text . "\" class=\"button cmsms_project_sort_but" . (($orderby == 'name') ? " current" . (($order == 'DESC') ? " reversed" : "") : "") . "\">
							<span>" . $sorting_name_text . "</span>
						</a>
						<a href=\"#\" name=\"project_date\" title=\"" . $sorting_date_text . "\" class=\"button cmsms_project_sort_but" . (($orderby == 'date') ? " current" . (($order == 'DESC') ? " reversed" : "") : "") . "\">
							<span>" . $sorting_date_text . "</span>
						</a>
					</div>";
				}
				
				
				if ($filter != '') {
					$out .= "<div class=\"cmsms_project_filter_block\">
						<a class=\"cmsms_project_filter_but cmsms-icon-menu button\">
							<span>" . $filter_text . "</span>
						</a>
						<ul class=\"cmsms_project_filter_list\">
							<li class=\"current\">
								<a class=\"button\" data-filter=\"article.project\"  title=\"" . $filter_cats_text . "\" href=\"javascript:void(0);\">
									<span>" . $filter_cats_text . "</span>
								</a>
							</li>";
							
							
							if ($categories != '') {
								$cat_array = explode(',', $categories);
								
								
								for ($i = 0; $i < count($cat_array); $i++) {
									$idObj = get_term_by('slug', $cat_array[$i], 'pj-categs');
									
									$cat_array[$i] = $idObj->term_id;
								}
							} else {
								$cat_array = $categories;
							}
							
							
							$cat_args = array( 
								'orderby' => 	'name', 
								'include' => 	$cat_array 
							);
							
							
							$project_categs = get_terms('pj-categs', $cat_args);
							
							
							if (is_array($project_categs) && !empty($project_categs)) {
								foreach ($project_categs as $project_categ) {
									$out .= "<li>
										<a class=\"button\" href=\"#\" data-filter=\"article.project[data-category~='{$project_categ->slug}']\" title=\"{$project_categ->name}\">
											<span>{$project_categ->name}</span>
										</a>
									</li>";
								}
							}
						
						$out .= "</ul>
					</div>";
				}
				
			$out .= "</div>
		</div>";
	}
	
	$out .= '<div class="portfolio ' . $layout . ' ' . $gap . '_gap ' . $layout_mode . 
		(($layout != 'puzzle') ? ' cmsms_' . $columns : '') . 
		(($classes != '') ? ' ' . $classes : '') . 
	'">';
	
	
	$orderby = ($orderby == 'popular') ? 'meta_value_num' : $orderby;
	
	
	$args = array( 
		'post_type' => 			'project', 
		'orderby' => 			$orderby, 
		'order' => 				$order, 
		'posts_per_page' => 	$count 
	);
	
	if ($layout == 'puzzle') {
		$args['ignore_sticky_posts'] = 1;
	}
	
	if ($categories != '') {
		$cat_array = explode(",", $categories);
		
		$args['tax_query'] = array( 
			array( 
				'taxonomy' => 'pj-categs', 
				'field' => 'slug', 
				'terms' => $cat_array 
			)
		);
	}
	
	
	if ($pagination == 'pagination') {
		if (get_query_var('paged')) { 
			$paged = get_query_var('paged'); 
		} elseif (get_query_var('page')) { 
			$paged = get_query_var('page'); 
		} else { 
			$paged = 1; 
		}
		
		
		$args['paged'] = $paged;
	}
	
	
	if ($orderby == 'meta_value_num') {
		$args['meta_key'] = 'cmsms_likes';
	}
	
	
	$query = new WP_Query($args);
	
	
	if ($query->have_posts()) : 
		while ($query->have_posts()) : $query->the_post();
			if ($layout == 'puzzle') {
				if (get_post_format() != '') {
					$out .= load_template_part('framework/postType/portfolio/page/puzzle/' . get_post_format());
				} else {
					$out .= load_template_part('framework/postType/portfolio/page/puzzle/standard');
				}
			} else {
				if (get_post_format() != '') {
					$out .= load_template_part('framework/postType/portfolio/page/grid/' . get_post_format());
				} else {
					$out .= load_template_part('framework/postType/portfolio/page/grid/standard');
				}
			}
		endwhile;
		
		
		if ($pagination == 'more') {
			wp_enqueue_style('mediaelement');
			
			wp_enqueue_style('wp-mediaelement');
			
			
			wp_enqueue_script('mediaelement');
			
			wp_enqueue_script('wp-mediaelement');
		}
	endif;
	
	
	$out .= '</div>';
	
	
	if ($pagination !== 'disabled') {
		$out .= '<div class="cmsms_wrap_more_projects">';
		
			if ($pagination == 'pagination' && $query->max_num_pages > 1) {
				$out .= pagination($query->max_num_pages);
			} elseif ($pagination == 'more' && $query->found_posts > $count) {
				$out .= "<div class=\"cmsms_wrap_project_loader\">
					<a href=\"javascript:void(0);\" class=\"cmsms_button cmsms_project_loader\">
						<span>" . $more_text . "</span>
					</a>
				</div>";
			}
		
		$out .= '</div>';
	}
	
	$out .= '</div>';
	
	
	wp_reset_postdata();
	
	wp_reset_query();
	
	
	return $out;
}

add_shortcode('cmsms_portfolio', 'cmsms_portfolio');



/**
 * Profiles
 */
function cmsms_profiles($atts, $content = null) { 
    extract(shortcode_atts(array( 
		'orderby' => 			'', 
		'order' => 				'', 
		'count' => 				'', 
		'categories' => 		'', 
		'layout' => 			'', 
		'columns' => 			'', 
		'animation' => 			'', 
		'animation_delay' => 	'', 
		'classes' => 			'' 
    ), $atts));
	
	
	$out = '';
	
	$columns_num = '';
	
	$counter = 0;
	
	$img_size = '';
	
	
	if ($columns == 1) {
		$columns_num = 'one_first';
	} elseif ($columns == 2) {
		$columns_num = 'one_half';
	} elseif ($columns == 3) {
		$columns_num = 'one_third';
	} elseif ($columns == 4) {
		$columns_num = 'one_fourth';
	} 
	
    $query = array( 
		'posts_per_page' => $count, 
		'post_status' => 'publish', 
		'ignore_sticky_posts' => 1, 
		'post_type' => 'profile', 
		'orderby' => $orderby, 
		'order' => $order 
	);
	
	if ($categories != '') {
		$cat_array = explode(",", $categories);
		
		$query['tax_query'] = array( 
			array( 
				'taxonomy' => 'pl-categs', 
				'field' => 'slug', 
				'terms' => $cat_array 
			)
		);
	}
	
	$profile_query = new WP_Query($query);
	
	
	if ($layout == 'vertical') {
		$img_size = 'square-thumb';
	} else {
		$img_size = 'blog-masonry-thumb';
	}
	
	
	$out .= '<div class="cmsms_profile ' . $layout . 
		(($classes != '') ? ' ' . $classes : '') . 
		'"' . 
		(($animation != '') ? ' data-animation="' . $animation . '"' : '') . 
		(($animation != '' && $animation_delay != '') ? ' data-delay="' . $animation_delay . '"' : '') . 
		'>' . "\n";
	
	if ($profile_query->have_posts()) :
        while ($profile_query->have_posts()) : $profile_query->the_post();
			
			$cmsms_profile_social = get_post_meta(get_the_ID(), 'cmsms_profile_social', true);
			
			$cmsms_profile_subtitle = get_post_meta(get_the_ID(), 'cmsms_profile_subtitle', true);
			
			$counter++;
			
			
			$out .= '<article class="' . $columns_num . 
				(($counter%2 == 0) ? ' profile_even' : '') . 
				' format-profile">' . "\n";
				
				if ($layout == 'vertical') {
					$out .= '<div class="pl_content">' . "\n" . 
						'<h1 class="entry-title">' . 
							'<a href="' . get_permalink() . '">' . cmsms_title(get_the_ID(), false) . '</a>' . 
						'</h1>' . "\n";
						
						if ($cmsms_profile_subtitle != '') {
							$out .= '<h5 class="pl_subtitle">' . $cmsms_profile_subtitle . '</h5>' . "\n";
						}
						
						$out .= '<div class="entry-content">' . "\n" . 
							get_the_excerpt() . 
						'</div>' . "\n";
						
					$out .= '</div>' . "\n";
					
					if (has_post_thumbnail()) {
						$out .=  '<div class="pl_img">' . "\n" . 
							'<figure>' . 
								'<a href="' . get_permalink() . '">' . 
									get_the_post_thumbnail(get_the_ID(), $img_size, array( 
										'alt' => cmsms_title(get_the_ID(), false), 
										'title' => cmsms_title(get_the_ID(), false) 
									)) . 
								'</a>' . 
							'</figure>' . "\n" . 
						'</div>' . "\n";
					} else {
						$out .=  '<div class="pl_img"><a href="' . get_permalink() . '"><div class="pl_noimg cmsms-icon-user-1"></div></a></div>' . "\n";
					}
					
					$out .= '<div class="pl_social">' . "\n";
				
					if ($cmsms_profile_social != '') {
						$out .= '<ul class="pl_social_list">' . "\n";
						
						foreach ($cmsms_profile_social as $social_icons) {
							$social_icon = explode('|', str_replace(' ', '', $social_icons));
							
							
							$out .= '<li>' . "\n\t" . 
								'<a href="' . $social_icon[1] . '" class="' . $social_icon[0] . '" title="' . $social_icon[2] . '"' . (($social_icon[3] == 'true') ? ' target="_blank"' : '') . '></a>' . "\r" . 
							'</li>' . "\n";
						}
						$out .= '</ul>' . "\n";
					}
					
					$out .= '</div>' . "\n";
				} elseif ($layout == 'horizontal') {
					if (has_post_thumbnail()) {
						$out .=  '<div class="pl_img">' . "\n" . 
							'<figure>' . 
								'<a href="' . get_permalink() . '">' . 
									get_the_post_thumbnail(get_the_ID(), $img_size, array( 
										'alt' => cmsms_title(get_the_ID(), false), 
										'title' => cmsms_title(get_the_ID(), false) 
									)) . 
								'</a>' . 
							'</figure>' . "\n" . 
						'</div>' . "\n";
					}
					
					$out .= '<div class="pl_content">' . "\n" . 
						'<h2 class="entry-title">' . 
							'<a href="' . get_permalink() . '">' . cmsms_title(get_the_ID(), false) . '</a>' . 
						'</h2>' . "\n";
						
						if ($cmsms_profile_subtitle != '') {
							$out .= '<h5 class="pl_subtitle">' . $cmsms_profile_subtitle . '</h5>' . "\n";
						}
						
						$out .= '<div class="entry-content">' . "\n" . 
							get_the_excerpt() . 
						'</div>' . "\n";
						
					$out .= '</div>' . "\n" ;
				
					if ($cmsms_profile_social != '') {
						$out .= '<div class="pl_social">' . "\n" . 
						'<ul class="pl_social_list">' . "\n";
						
						foreach ($cmsms_profile_social as $social_icons) {
							$social_icon = explode('|', str_replace(' ', '', $social_icons));
							
							
							$out .= '<li>' . "\n\t" . 
								'<a href="' . $social_icon[1] . '" class="' . $social_icon[0] . '" title="' . $social_icon[2] . '"' . (($social_icon[3] == 'true') ? ' target="_blank"' : '') . '></a>' . "\r" . 
							'</li>' . "\n";
						}
						$out .= '</ul>' . "\n" . 
						'</div>' . "\n";
					}
				}
				
				$out .= '<div class="cl"></div>' . "\n" . 
			'</article>' . "\n";
			
		endwhile;
    endif;
	
	
	$out .= '</div>' . "\n";
	
	
	wp_reset_postdata();
	
	wp_reset_query();
	
	
	return $out;
}

add_shortcode('cmsms_profiles', 'cmsms_profiles');



/* ==================== Start WooCommerce Shortcodes ==================== */

/**
 * Products
 */
function cmsms_products($atts, $content = null) {
    extract(shortcode_atts(array( 
		'products_shortcode' => 	'recent_products', 
		'orderby' => 				'date', 
		'order' => 					'DESC', 
		'count' => 					'10', 
		'columns' => 				'4', 
		'classes' => 				'' 
    ), $atts));
	
	
    $out = '<div class="cmsms_products_shortcode' . ' cmsms_' . $products_shortcode . 
	(($classes != '') ? ' ' . $classes : '') . 
	'">';
	
	
	$out .= do_shortcode('[' . $products_shortcode . ' ' . (($products_shortcode != 'best_selling_products' && $products_shortcode != 'top_rated_products') ? 'orderby="' . $orderby . '" order="' . $order . '" ' : '') . 'per_page="' . $count . '" columns="' . $columns . '"]');
	
	
	$out .= '</div>';
	
	
	return $out;
}

add_shortcode('cmsms_products', 'cmsms_products');



/**
 * Selected Products
 */
function cmsms_selected_products($atts, $content = null) {
    extract(shortcode_atts(array( 
		'orderby' => 				'date', 
		'order' => 					'DESC', 
		'ids' => 					'', 
		'columns' => 				'4', 
		'classes' => 				'' 
    ), $atts));
	
	
    $out = '<div class="cmsms_selected_products_shortcode' . 
	(($classes != '') ? ' ' . $classes : '') . 
	'">';
	
	
	$out .= do_shortcode('[products orderby="' . $orderby . '" order="' . $order . '" columns="' . $columns . '" ids="' . $ids . '"]');
	
	
	$out .= '</div>';
	
	
	return $out;
}

add_shortcode('cmsms_selected_products', 'cmsms_selected_products');

/* ==================== Finish WooCommerce Shortcodes ==================== */



/* ==================== Start PayPal Donations Shortcode ==================== */

/**
 * PayPal Donations
 */
function cmsms_paypal_donations($atts, $content = null) {
    extract(shortcode_atts(array( 
		'amount' => 		'', 
		'purpose' => 		'', 
		'reference' => 		'', 
		'button_text' => 	'', 
		'classes' => 		'' 
    ), $atts));
	
	
    $out = '<div class="cmsms_paypal_donations' . 
	(($classes != '') ? ' ' . $classes : '') . 
	'">';
	
	
	$out .= do_shortcode('[paypal-donation' . 
		($amount != '' ? ' amount="' . $amount . '"' : '') . 
		($purpose != '' ? ' purpose="' . $purpose . '"' : '') . 
		($reference != '' ? ' reference="' . $reference . '"' : '') . 
	']');
	
	
	$out .= '<span class="button">' . $button_text . '</span>' . 
	'</div>';
	
	
	return $out;
}

add_shortcode('cmsms_paypal_donations', 'cmsms_paypal_donations');

/* ==================== Finish PayPal Donations Shortcode ==================== */

