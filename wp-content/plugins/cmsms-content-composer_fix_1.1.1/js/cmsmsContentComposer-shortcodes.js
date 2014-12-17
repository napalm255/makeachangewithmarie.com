/**
 * @package 	WordPress Plugin
 * @subpackage 	CMSMasters Content Composer
 * @version		1.1.1
 * 
 * Visual Content Composer Schortcodes
 * Created by CMSMasters
 * 
 */


// CMSMasters Custom Shortcodes
var cmsmsShortcodes = { 
	// Text Block
	cmsms_text : { 
		title : 	cmsms_shortcodes.text_title, 
		icon : 		'admin-icon-text', 
		pair : 		true, 
		content : 	'content', 
		visual : 	'<div>{{ data.content }}</div>', 
		multiple : 	false, 
		def : 		"<p>" + cmsms_shortcodes.def_text + "</p>", 
		fields : { 
			// Content
			content : { 
				type : 		'editor', 
				title : 	cmsms_shortcodes.text_field_content_title, 
				descr : 	"", 
				def : 		"<p>" + cmsms_shortcodes.def_text + "</p>", 
				required : 	true, 
				width : 	'full' 
			}, 
			// CSS3 Animation
			animation : { 
				type : 		'select', 
				title : 	cmsms_shortcodes.animation_title, 
				descr : 	cmsms_shortcodes.animation_descr + " <br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.animation_descr_note + "</span>", 
				def : 		'', 
				required : 	false, 
				width : 	'half', 
				choises : 	get_animations() 
			}, 
			// Animation Delay
			animation_delay : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.animation_delay_title, 
				descr : 	cmsms_shortcodes.animation_delay_descr + " <br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.animation_delay_descr_note + "</span>", 
				def : 		'0', 
				required : 	false, 
				width : 	'number', 
				min : 		'0', 
				step : 		'50' 
			}, 
			// Additional Classes
			classes : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.classes_title, 
				descr : 	cmsms_shortcodes.classes_descr, 
				def : 		'', 
				required : 	false, 
				width : 	'half' 
			} 
		} 
	}, 
	
	
	// Heading
	cmsms_heading : { 
		title : 	cmsms_shortcodes.heading_def, 
		icon : 		'admin-icon-heading', 
		pair : 		true, 
		content : 	'content', 
		visual : 	'<{{ data.type }}>{{ data.content }}</{{ data.type }}>', 
		multiple : 	false, 
		def : 		cmsms_shortcodes.heading_def, 
		fields : { 
			// Heading Text
			content : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.heading_field_text_title, 
				descr : 	cmsms_shortcodes.heading_field_text_descr, 
				def : 		cmsms_shortcodes.heading_def, 
				required : 	true, 
				width : 	'half' 
			}, 
			// Heading Type
			type : { 
				type : 		'select', 
				title : 	cmsms_shortcodes.heading_field_type_title, 
				descr : 	cmsms_shortcodes.heading_field_type_descr, 
				def : 		'h1', 
				required : 	true, 
				width : 	'half', 
				choises : { 
							'h1' : 	'H1', 
							'h2' : 	'H2', 
							'h3' : 	'H3', 
							'h4' : 	'H4', 
							'h5' : 	'H5', 
							'h6' : 	'H6' 
				} 
			}, 
			// Google Font
			font_family : { 
				type : 		'select', 
				title : 	cmsms_shortcodes.heading_field_font_title, 
				descr : 	cmsms_shortcodes.heading_field_font_descr, 
				def : 		'', 
				required : 	false, 
				width : 	'half', 
				choises : 	cmsms_composer_fonts() 
			}, 
			// Font Size
			font_size : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.heading_field_font_size_title, 
				descr : 	cmsms_shortcodes.heading_field_font_size_descr + " <br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.size_zero_note + "</span>", 
				def : 		'', 
				required : 	false, 
				width : 	'number', 
				min : 		'0' 
			}, 
			// Line Height
			line_height : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.heading_field_line_hight_title, 
				descr : 	cmsms_shortcodes.heading_field_line_height_descr + " <br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.size_zero_note + "</span>", 
				def : 		'', 
				required : 	false, 
				width : 	'number', 
				min : 		'0' 
			}, 
			// Font Weight
			font_weight : { 
				type : 		'select', 
				title : 	cmsms_shortcodes.heading_field_font_weight_title, 
				descr : 	cmsms_shortcodes.heading_field_font_weight_descr, 
				def : 		'400', 
				required : 	false, 
				width : 	'half', 
				choises : 	cmsms_composer_font_weight() 
			}, 
			// Font Style
			font_style : { 
				type : 		'select', 
				title : 	cmsms_shortcodes.heading_field_font_style_title, 
				descr : 	cmsms_shortcodes.heading_field_font_style_descr, 
				def : 		'normal', 
				required : 	false, 
				width : 	'half', 
				choises : 	cmsms_composer_font_style() 
			}, 
			// Text Align
			text_align : { 
				type : 		'radio', 
				title : 	cmsms_shortcodes.text_align, 
				descr : 	cmsms_shortcodes.heading_field_text_align_descr, 
				def : 		'default', 
				required : 	false, 
				width : 	'half', 
				choises : { 
							'default' : 	cmsms_shortcodes.choice_default, 
							'left' : 		cmsms_shortcodes.choice_left, 
							'center' : 		cmsms_shortcodes.choice_center, 
							'right' : 		cmsms_shortcodes.choice_right 
				} 
			}, 
			// Heading Link
			link : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.heading_field_link_title, 
				descr : 	cmsms_shortcodes.heading_field_link_descr, 
				def : 		'', 
				required : 	false, 
				width : 	'full' 
			}, 
			// Heading Link Target
			target : { 
				type : 		'radio', 
				title : 	cmsms_shortcodes.heading_field_target_title, 
				descr : 	cmsms_shortcodes.heading_field_target_descr, 
				def : 		'self', 
				required : 	false, 
				width : 	'half',  
				choises : { 
							'self' : 	cmsms_shortcodes.link_target_choice_self, 
							'blank' : 	cmsms_shortcodes.link_target_choice_blank 
				} 
			}, 
			// Custom Color
			custom_colors : { 
				type : 		'checkbox', 
				title : 	cmsms_shortcodes.heading_field_custom_color_title, 
				descr : 	cmsms_shortcodes.heading_field_custom_color_descr, 
				def : 		'', 
				required : 	false, 
				width : 	'half',  
				choises : { 
							'true' : 		cmsms_shortcodes.choice_enable 
				} 
			}, 
			// Color
			color : { 
				type : 		'color', 
				title : 	cmsms_shortcodes.heading_field_color_title, 
				descr : 	cmsms_shortcodes.heading_field_color_descr, 
				def : 		'#353535', 
				required : 	false, 
				width : 	'half', 
				depend : 	'custom_colors:true' 
			}, 
			// Color Transparency
			color_transparency : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.heading_field_color_transparency_title, 
				descr : 	cmsms_shortcodes.heading_field_color_transparency_descr, 
				def : 		'100', 
				required : 	false, 
				width : 	'number', 
				min : 		'0', 
				max : 		'100', 
				depend : 	'custom_colors:true' 
			}, 
			// Top Margin
			margin_top : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.heading_field_top_margin_title, 
				descr : 	cmsms_shortcodes.heading_field_top_margin_descr + " <br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.size_note + "</span>", 
				def : 		'0', 
				required : 	false, 
				width : 	'number' 
			}, 
			// Bottom Margin
			margin_bottom : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.heading_field_bottom_margin_title, 
				descr : 	cmsms_shortcodes.heading_field_bottom_margin_descr + " <br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.size_note + "</span>", 
				def : 		'20', 
				required : 	false, 
				width : 	'number' 
			}, 
			// CSS3 Animation
			animation : { 
				type : 		'select', 
				title : 	cmsms_shortcodes.animation_title, 
				descr : 	cmsms_shortcodes.animation_descr + " <br /><span>" + cmsms_shortcodes.note  + ' ' + cmsms_shortcodes.animation_descr_note + "</span>", 
				def : 		'', 
				required : 	false, 
				width : 	'half', 
				choises : 	get_animations() 
			}, 
			// Animation Delay
			animation_delay : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.animation_delay_title, 
				descr : 	cmsms_shortcodes.animation_delay_descr + " <br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.animation_delay_descr_note + "</span>", 
				def : 		'0', 
				required : 	false, 
				width : 	'number', 
				min : 		'0', 
				step : 		'50' 
			}, 
			// Additional Classes
			classes : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.classes_title, 
				descr : 	cmsms_shortcodes.classes_descr, 
				def : 		'', 
				required : 	false, 
				width : 	'half' 
			} 
		} 
	}, 
	
	
	// Audio
	cmsms_audios : { 
		title : 	cmsms_shortcodes.audio_title, 
		icon : 		'admin-icon-audio', 
		pair : 		true, 
		content : 	'audio', 
		visual : 	false, 
		multiple : 	true, 
		def : 		'[cmsms_audio]' + cmsms_shortcodes.media_def + '[/cmsms_audio]', 
		fields : { 
			// Audio
			audio : { 
				type : 		'multiple', 
				title : 	cmsms_shortcodes.audio_title, 
				descr : 	cmsms_shortcodes.audio_field_audio_descr + " <br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.audio_field_audio_descr_note + ' (' + cmsms_shortcodes.more_info + " <a href='http://www.w3schools.com/html/html5_audio.asp' target='_blank'>" + cmsms_shortcodes.click_here + "</a>)</span>", 
				def : 		'[cmsms_audio]' + cmsms_shortcodes.media_def + '[/cmsms_audio]', 
				required : 	true, 
				width : 	'full' 
			}, 
			// Autoplay
			autoplay : { 
				type : 		'checkbox', 
				title : 	cmsms_shortcodes.media_field_autoplay_title, 
				descr : 	cmsms_shortcodes.audio_field_autoplay_descr, 
				def : 		'', 
				required : 	false, 
				width : 	'half', 
				choises : { 
							'true' : 	cmsms_shortcodes.choice_enable 
				} 
			}, 
			// Repeat
			loop : { 
				type : 		'checkbox', 
				title : 	cmsms_shortcodes.media_field_repeat_title, 
				descr : 	cmsms_shortcodes.audio_field_repeat_descr, 
				def : 		'', 
				required : 	false, 
				width : 	'half', 
				choises : { 
							'true' : 	cmsms_shortcodes.choice_enable 
				} 
			}, 
			// Preload
			preload : { 
				type : 		'radio', 
				title : 	cmsms_shortcodes.media_field_preload_title, 
				descr : 	cmsms_shortcodes.audio_field_preload_descr, 
				def : 		'none', 
				required : 	false, 
				width : 	'half', 
				choises : { 
							'none' : 		cmsms_shortcodes.audio_field_preload_choice_none, 
							'auto' : 		cmsms_shortcodes.audio_field_preload_choice_auto, 
							'metadata' : 	cmsms_shortcodes.audio_field_preload_choice_metadata 
				} 
			}, 
			// CSS3 Animation
			animation : { 
				type : 		'select', 
				title : 	cmsms_shortcodes.animation_title, 
				descr : 	cmsms_shortcodes.animation_descr + " <br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.animation_descr_note + "</span>", 
				def : 		'', 
				required : 	false, 
				width : 	'half', 
				choises : 	get_animations() 
			}, 
			// Animation Delay
			animation_delay : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.animation_delay_title, 
				descr : 	cmsms_shortcodes.animation_delay_descr + " <br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.animation_delay_descr_note + "</span>", 
				def : 		'0', 
				required : 	false, 
				width : 	'number', 
				min : 		'0', 
				step : 		'50' 
			}, 
			// Additional Classes
			classes : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.classes_title, 
				descr : 	cmsms_shortcodes.classes_descr, 
				def : 		'', 
				required : 	false, 
				width : 	'half' 
			} 
		} 
	}, 
	
	
	// Blog
	cmsms_blog : { 
		title : 	cmsms_shortcodes.blog_title, 
		icon : 		'admin-icon-blog', 
		pair : 		false, 
		content : 	false, 
		visual : 	false, 
		multiple : 	false, 
		def : 		'', 
		fields : { 
			// Order By
			orderby : { 
				type : 		'select', 
				title : 	cmsms_shortcodes.orderby_title, 
				descr : 	cmsms_shortcodes.blog_field_orderby_descr, 
				def : 		'date', 
				required : 	true, 
				width : 	'half', 
				choises : { 
							'date' : 		cmsms_shortcodes.choice_date, 
							'name' : 		cmsms_shortcodes.name, 
							'id' : 			cmsms_shortcodes.choice_id, 
							'menu_order' : 	cmsms_shortcodes.choice_menu, 
							'popular' : 	cmsms_shortcodes.choice_popular 
				} 
			}, 
			// Order
			order : { 
				type : 		'radio', 
				title : 	cmsms_shortcodes.order_title, 
				descr : 	cmsms_shortcodes.order_descr, 
				def : 		'DESC', 
				required : 	true, 
				width : 	'half', 
				choises : { 
							'ASC' : 	cmsms_shortcodes.choice_asc, 
							'DESC' : 	cmsms_shortcodes.choice_desc 
				} 
			}, 
			// Posts Number
			count : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.blog_field_postsnumber_title, 
				descr : 	cmsms_shortcodes.blog_field_postsnumber_descr + "<br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.blog_field_postsnumber_descr_note + "</span>", 
				def : 		'12', 
				required : 	false, 
				width : 	'number', 
				min : 		'1' 
			}, 
			// Categories
			categories : { 
				type : 		'select_multiple', 
				title : 	cmsms_shortcodes.categories, 
				descr : 	cmsms_shortcodes.blog_field_categories_descr + "<br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.blog_field_categories_descr_note + "</span>", 
				def : 		'', 
				required : 	false, 
				width : 	'half', 
				choises : 	cmsms_composer_categories() 
			}, 
			// Layout
			layout : { 
				type : 		'radio', 
				title : 	cmsms_shortcodes.layout_title, 
				descr : 	cmsms_shortcodes.blog_field_layout_descr, 
				def : 		'standard', 
				required : 	true, 
				width : 	'half', 
				choises : { 
							'standard' : 	cmsms_shortcodes.blog_field_layout_choice_standard, 
							'columns' : 	cmsms_shortcodes.blog_field_layout_choice_columns, 
							'timeline' : 	cmsms_shortcodes.blog_field_layout_choice_timeline 
				} 
			}, 
			// Layout Mode
			layout_mode : { 
				type : 		'radio', 
				title : 	cmsms_shortcodes.blog_field_layout_mode_title, 
				descr : 	cmsms_shortcodes.blog_field_layout_mode_descr, 
				def : 		'grid', 
				required : 	false, 
				width : 	'half', 
				choises : { 
							'grid' : 		cmsms_shortcodes.blog_field_layout_mode_choice_grid, 
							'masonry' : 	cmsms_shortcodes.blog_field_layout_mode_choice_masonry 
				}, 
				depend : 	'layout:columns' 
			}, 
			// Columns Count
			columns : { 
				type : 		'select', 
				title : 	cmsms_shortcodes.columns_count, 
				descr : 	cmsms_shortcodes.blog_field_columns_count_descr + "<br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.blog_field_columns_count_descr_note + "</span>", 
				def : 		'3', 
				required : 	false, 
				width : 	'half', 
				choises : { 
							'2' : 	'2', 
							'3' : 	'3', 
							'4' : 	'4' 
				}, 
				depend : 	'layout:columns' 
			}, 
			// Metadata
			metadata : { 
				type : 		'checkbox', 
				title : 	cmsms_shortcodes.blog_field_metadata_title, 
				descr : 	cmsms_shortcodes.blog_field_metadata_descr, 
				def : 		'date,categories,author,comments,likes,more', 
				required : 	true, 
				width : 	'half', 
				choises : { 
							'date' : 		cmsms_shortcodes.choice_date, 
							'categories' : 	cmsms_shortcodes.choice_categories, 
							'author' : 		cmsms_shortcodes.choice_author, 
							'comments' : 	cmsms_shortcodes.choice_comments, 
							'likes' : 		cmsms_shortcodes.choice_likes, 
							'tags' : 		cmsms_shortcodes.choice_tags, 
							'more' : 		cmsms_shortcodes.choice_more 
				} 
			}, 
			// Filter
			filter : { 
				type : 		'checkbox', 
				title : 	cmsms_shortcodes.filter, 
				descr : 	cmsms_shortcodes.blog_field_filter_descr, 
				def : 		'', 
				required : 	false, 
				width : 	'half', 
				choises : { 
							'true' : 	cmsms_shortcodes.choice_enable 
				}, 
				depend : 	'layout:columns' 
			}, 
			// Filter Button Text
			filter_text : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.filter_text_title, 
				descr : 	cmsms_shortcodes.filter_text_descr + "<br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.filter_text_descr_note + ". <br />" + cmsms_shortcodes.filter_enabled_text_descr_note + "</span>", 
				def : 		'', 
				required : 	false, 
				width : 	'half', 
				depend : 	'layout:columns' 
			}, 
			// Filter 'All Categories' Text
			filter_cats_text : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.filter_cats_text_title, 
				descr : 	cmsms_shortcodes.filter_cats_text_descr + "<br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.filter_cats_text_descr_note + ". <br />" + cmsms_shortcodes.filter_enabled_text_descr_note + "</span>", 
				def : 		'', 
				required : 	false, 
				width : 	'half', 
				depend : 	'layout:columns' 
			}, 
			// Pagination
			pagination : { 
				type : 		'radio', 
				title : 	cmsms_shortcodes.pagination_title, 
				descr : 	cmsms_shortcodes.pagination_descr, 
				def : 		'pagination', 
				required : 	true, 
				width : 	'half', 
				choises : { 
							'pagination' : 	cmsms_shortcodes.pagination_choice_pagination, 
							'more' : 		cmsms_shortcodes.pagination_choice_more, 
							'disabled' : 	cmsms_shortcodes.pagination_choice_disabled 
				} 
			}, 
			// 'Load More' Button Text
			more_text : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.pagination_more_text_title, 
				descr : 	cmsms_shortcodes.pagination_more_text_descr + "<br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.pagination_more_text_descr_note + "</span>", 
				def : 		'', 
				required : 	false, 
				width : 	'half', 
				depend : 	'pagination:more' 
			}, 
			// Additional Classes
			classes : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.classes_title, 
				descr : 	cmsms_shortcodes.classes_descr, 
				def : 		'', 
				required : 	false, 
				width : 	'half' 
			} 
		} 
	}, 
	
	
	// Button
	cmsms_button : { 
		title : 	cmsms_shortcodes.button, 
		icon : 		'admin-icon-button', 
		pair : 		true, 
		content : 	'title', 
		visual : 	'<div><a href="javascript:void(0);" class="cmsms_button {{ data.icon }}">{{ data.title }}</a></div>', 
		multiple : 	false, 
		def : 		"", 
		fields : { 
			// Title
			title : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.title, 
				descr : 	cmsms_shortcodes.button_field_title_descr, 
				def : 		cmsms_shortcodes.button, 
				required : 	true, 
				width : 	'half' 
			}, 
			// Link
			link : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.link, 
				descr : 	cmsms_shortcodes.button_field_link_descr, 
				def : 		'', 
				required : 	true, 
				width : 	'full' 
			}, 
			// Google Font
			font_family : { 
				type : 		'select', 
				title : 	cmsms_shortcodes.heading_field_font_title, 
				descr : 	cmsms_shortcodes.button_field_google_font_descr + " <br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.button_field_google_font_descr_note + "</span>", 
				def : 		'', 
				required : 	false, 
				width : 	'half', 
				choises : 	cmsms_composer_fonts() 
			}, 
			// Font Size
			font_size : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.heading_field_font_size_title, 
				descr : 	cmsms_shortcodes.button_field_font_size_descr + " <br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.button_field_font_size_descr_note + "</span>", 
				def : 		'', 
				required : 	false, 
				width : 	'number', 
				min : 		'0' 
			}, 
			// Line Height
			line_height : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.heading_field_line_hight_title, 
				descr : 	cmsms_shortcodes.button_field_line_height_descr + " <br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.button_field_line_height_descr_note + "</span>", 
				def : 		'', 
				required : 	false, 
				width : 	'number', 
				min : 		'0' 
			}, 
			// Font Weight
			font_weight : { 
				type : 		'select', 
				title : 	cmsms_shortcodes.heading_field_font_weight_title, 
				descr : 	cmsms_shortcodes.button_field_font_weight_descr, 
				def : 		'400', 
				required : 	false, 
				width : 	'half', 
				choises : 	cmsms_composer_font_weight() 
			}, 
			// Font Style
			font_style : { 
				type : 		'select', 
				title : 	cmsms_shortcodes.heading_field_font_style_title, 
				descr : 	cmsms_shortcodes.button_field_font_style_descr, 
				def : 		'normal', 
				required : 	false, 
				width : 	'half', 
				choises : 	cmsms_composer_font_style() 
			}, 
			// Left & Right Paddings
			padding_hor : { 
				type : 		'input', 
				title : 	'Left & Right Paddings', 
				descr : 	cmsms_shortcodes.button_field_paddings_descr + "<br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.button_field_paddings_descr_note + "</span>", 
				def : 		'20', 
				required : 	false, 
				width : 	'number', 
				min : 		'0' 
			}, 
			// Button Position
			text_align : { 
				type : 		'radio', 
				title : 	cmsms_shortcodes.button_field_text_align_title, 
				descr : 	cmsms_shortcodes.button_field_text_align_descr, 
				def : 		'center', 
				required : 	false, 
				width : 	'half', 
				choises : { 
							'left' : 		cmsms_shortcodes.choice_left, 
							'center' : 		cmsms_shortcodes.choice_center, 
							'right' : 		cmsms_shortcodes.choice_right, 
				} 
			}, 
			// Custom Button Colors
			custom_colors : { 
				type : 		'checkbox', 
				title : 	cmsms_shortcodes.button_field_custom_button_colors_title, 
				descr : 	cmsms_shortcodes.button_field_custom_button_colors_descr, 
				def : 		'', 
				required : 	false, 
				width : 	'half',  
				choises : { 
							'true' : 		cmsms_shortcodes.choice_enable 
				} 
			}, 
			// Background Color
			bg_color : { 
				type : 		'color', 
				title : 	cmsms_shortcodes.button_field_bg_color_title, 
				descr : 	cmsms_shortcodes.button_field_bg_color_descr, 
				def : 		'#fdfdfd', 
				required : 	false, 
				width : 	'half', 
				depend : 	'custom_colors:true' 
			}, 
			// Text Color
			text_color : { 
				type : 		'color', 
				title : 	cmsms_shortcodes.button_field_txt_color_title, 
				descr : 	cmsms_shortcodes.button_field_txt_color_descr, 
				def : 		'#353535', 
				required : 	false, 
				width : 	'half', 
				depend : 	'custom_colors:true' 
			}, 
			// Target
			target : { 
				type : 		'radio', 
				title : 	cmsms_shortcodes.button_field_target_title, 
				descr : 	cmsms_shortcodes.button_field_target_descr, 
				def : 		'self', 
				required : 	false, 
				width : 	'half',  
				choises : { 
							'self' : 	cmsms_shortcodes.link_target_choice_self, 
							'blank' : 	cmsms_shortcodes.link_target_choice_blank 
				} 
			}, 
			// Icon
			icon : { 
				type : 		'icon', 
				title : 	cmsms_shortcodes.icon, 
				descr : 	cmsms_shortcodes.button_icon_descr, 
				def : 		'', 
				required : 	false, 
				width : 	'full', 
				choises : 	cmsms_composer_icons() 
			}, 
			// CSS3 Animation
			animation : { 
				type : 		'select', 
				title : 	cmsms_shortcodes.animation_title, 
				descr : 	cmsms_shortcodes.animation_descr + " <br /><span>" + cmsms_shortcodes.note  + ' ' + cmsms_shortcodes.animation_descr_note + "</span>", 
				def : 		'', 
				required : 	false, 
				width : 	'half', 
				choises : 	get_animations() 
			}, 
			// Animation Delay
			animation_delay : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.animation_delay_title, 
				descr : 	cmsms_shortcodes.animation_delay_descr + " <br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.animation_delay_descr_note + "</span>", 
				def : 		'0', 
				required : 	false, 
				width : 	'number', 
				min : 		'0', 
				step : 		'50' 
			}, 
			// Additional Classes
			classes : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.classes_title, 
				descr : 	cmsms_shortcodes.classes_descr, 
				def : 		'', 
				required : 	false, 
				width : 	'half' 
			} 
		} 
	}, 
	
	
	// Clients
	cmsms_clients : { 
		title : 	cmsms_shortcodes.clients_title, 
		icon : 		'admin-icon-clients', 
		pair : 		true, 
		content : 	'clients', 
		visual : 	false, 
		multiple : 	true, 
		def : 		'[cmsms_client]' + cmsms_shortcodes.name + '[/cmsms_client]', 
		fields : { 
			// Clients
			clients : { 
				type : 		'multiple', 
				title : 	cmsms_shortcodes.clients_title, 
				descr : 	cmsms_shortcodes.clients_field_clients_descr, 
				def : 		'[cmsms_client]' + cmsms_shortcodes.name + '[/cmsms_client]', 
				required : 	true, 
				width : 	'half' 
			}, 
			// Columns Count
			columns : { 
				type : 		'select', 
				title : 	cmsms_shortcodes.columns_count, 
				descr : 	cmsms_shortcodes.clients_field_col_count_descr, 
				def : 		'5', 
				required : 	false, 
				width : 	'half', 
				choises : { 
							'1' : 	'1', 
							'2' : 	'2', 
							'3' : 	'3', 
							'4' : 	'4', 
							'5' : 	'5' 
				} 
			}, 
			// Layout
			layout : { 
				type : 		'radio', 
				title : 	cmsms_shortcodes.layout_title, 
				descr : 	cmsms_shortcodes.clients_field_layout_descr, 
				def : 		'grid', 
				required : 	true, 
				width : 	'half', 
				choises : { 
							'grid' : 	cmsms_shortcodes.clients_field_layout_choice_grid, 
							'slider' : 	cmsms_shortcodes.clients_field_layout_choice_slider 
				} 
			}, 
			// Slider Height
			height : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.clients_field_height_title, 
				descr : 	cmsms_shortcodes.clients_field_height_descr + "<br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.clients_field_height_descr_note + "</span>", 
				def : 		'180', 
				required : 	false, 
				width : 	'number', 
				min : 		'0' 
			}, 
			// Clients border
			border : { 
				type : 		'checkbox', 
				title : 	cmsms_shortcodes.clients_field_border_title, 
				descr : 	cmsms_shortcodes.clients_field_border_descr, 
				def : 		'true', 
				required : 	false, 
				width : 	'half', 
				choises : { 
							'true' : 	cmsms_shortcodes.choice_enable 
				} 
			}, 
			// Slider Slideshow
			autoplay : { 
				type : 		'checkbox', 
				title : 	cmsms_shortcodes.clients_field_autoplay_title, 
				descr : 	cmsms_shortcodes.clients_field_autoplay_descr, 
				def : 		'true', 
				required : 	false, 
				width : 	'half', 
				choises : { 
							'true' : 	cmsms_shortcodes.choice_enable 
				}, 
				depend : 	'layout:slider' 
			}, 
			// Slider Slideshow Speed
			speed : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.clients_field_speed_title, 
				descr : 	cmsms_shortcodes.clients_field_speed_descr + "<br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.clients_field_speed_descr_note + "</span>", 
				def : 		'1', 
				required : 	false, 
				width : 	'number', 
				min : 		'1', 
				depend : 	'layout:slider' 
			}, 
			// Slider Slides Control
			slides_control : { 
				type : 		'checkbox', 
				title : 	cmsms_shortcodes.clients_field_slides_control_title, 
				descr : 	cmsms_shortcodes.clients_field_slides_control_descr, 
				def : 		'true', 
				required : 	false, 
				width : 	'half', 
				choises : { 
							'true' : 	cmsms_shortcodes.choice_enable 
				}, 
				depend : 	'layout:slider' 
			}, 
			// Slider Arrow Control
			arrow_control : { 
				type : 		'checkbox', 
				title : 	cmsms_shortcodes.clients_field_arrow_control_title, 
				descr : 	cmsms_shortcodes.clients_field_arrow_control_descr, 
				def : 		'', 
				required : 	false, 
				width : 	'half', 
				choises : { 
							'true' : 	cmsms_shortcodes.choice_enable 
				}, 
				depend : 	'layout:slider' 
			}, 
			// CSS3 Animation
			animation : { 
				type : 		'select', 
				title : 	cmsms_shortcodes.animation_title, 
				descr : 	cmsms_shortcodes.animation_descr + " <br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.animation_descr_note + "</span>", 
				def : 		'', 
				required : 	false, 
				width : 	'half', 
				choises : 	get_animations() 
			}, 
			// Animation Delay
			animation_delay : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.animation_delay_title, 
				descr : 	cmsms_shortcodes.animation_delay_descr + " <br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.animation_delay_descr_note + "</span>", 
				def : 		'0', 
				required : 	false, 
				width : 	'number', 
				min : 		'0', 
				step : 		'50' 
			}, 
			// Additional Classes
			classes : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.classes_title, 
				descr : 	cmsms_shortcodes.classes_descr, 
				def : 		'', 
				required : 	false, 
				width : 	'half' 
			} 
		} 
	}, 
	
	
	// Contact Form
	cmsms_contact_form : { 
		title : 	cmsms_shortcodes.contact_form_title, 
		icon : 		'admin-icon-mail', 
		pair : 		false, 
		content : 	false, 
		visual : 	false, 
		multiple : 	false, 
		def : 		"", 
		fields : { 
			// Contact Form Plugin
			form_plugin : { 
				type : 		'radio', 
				title : 	cmsms_shortcodes.contact_form_field_form_plugin_title, 
				descr : 	cmsms_shortcodes.contact_form_field_form_plugin_descr + " <br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.contact_form_field_form_plugin_descr_note + "</span>", 
				def : 		'cf7', 
				required : 	true, 
				width : 	'half', 
				choises : { 
							'cf7' : 	cmsms_shortcodes.contact_form_cf7, 
							'cfb' : 	cmsms_shortcodes.contact_form_cfb 
				} 
			}, 
			// Contact Form 7 - Form Name
			form_cf7 : { 
				type : 		'select', 
				title : 	cmsms_shortcodes.contact_form_field_cf7_id_title, 
				descr : 	cmsms_shortcodes.contact_form_field_cf7_id_descr, 
				def : 		'', 
				required : 	true, 
				width : 	'half', 
				choises : 	cmsms_composer_cf7_forms(), 
				depend : 	'form_plugin:cf7' 
			}, 
			// CMSMasters Contact Form Builder - Form Name
			form_cfb : { 
				type : 		'select', 
				title : 	cmsms_shortcodes.contact_form_field_cfb_id_title, 
				descr : 	cmsms_shortcodes.contact_form_field_cfb_id_descr, 
				def : 		'', 
				required : 	true, 
				width : 	'half', 
				choises : 	cmsms_composer_cfb_forms(), 
				depend : 	'form_plugin:cfb' 
			}, 
			// CMSMasters Contact Form Builder - Email Address
			email_cfb : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.contact_form_field_cfb_email_title, 
				descr : 	cmsms_shortcodes.contact_form_field_cfb_email_descr + " <br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.contact_form_field_cfb_email_descr_note + "</span>", 
				def : 		'', 
				required : 	true, 
				width : 	'half', 
				depend : 	'form_plugin:cfb' 
			}, 
			// CSS3 Animation
			animation : { 
				type : 		'select', 
				title : 	cmsms_shortcodes.animation_title, 
				descr : 	cmsms_shortcodes.animation_descr + " <br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.animation_descr_note + "</span>", 
				def : 		'', 
				required : 	false, 
				width : 	'half', 
				choises : 	get_animations() 
			}, 
			// Animation Delay
			animation_delay : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.animation_delay_title, 
				descr : 	cmsms_shortcodes.animation_delay_descr + " <br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.animation_delay_descr_note + "</span>", 
				def : 		'0', 
				required : 	false, 
				width : 	'number', 
				min : 		'0', 
				step : 		'50' 
			}, 
			// Additional Classes
			classes : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.classes_title, 
				descr : 	cmsms_shortcodes.classes_descr, 
				def : 		'', 
				required : 	false, 
				width : 	'half' 
			} 
		} 
	}, 
	
	
	// Divider
	cmsms_divider : { 
		title : 	cmsms_shortcodes.divider_title, 
		icon : 		'admin-icon-divider', 
		pair : 		false, 
		content : 	false, 
		visual : 	false, 
		multiple : 	false, 
		def : 		"", 
		fields : { 
			// Divider Type
			type : { 
				type : 		'radio', 
				title : 	cmsms_shortcodes.divider_field_divider_type_title, 
				descr : 	cmsms_shortcodes.divider_field_divider_type_descr, 
				def : 		'solid', 
				required : 	true, 
				width : 	'half', 
				choises : { 
							'solid' : 			cmsms_shortcodes.divider_field_divider_type_choice_solid, 
							'dashed' : 			cmsms_shortcodes.divider_field_divider_type_choice_dashed, 
							'dotted' : 			cmsms_shortcodes.divider_field_divider_type_choice_dotted, 
							'transparent' : 	cmsms_shortcodes.divider_field_divider_type_choice_transparent 
				} 
			}, 
			// Top Margin
			margin_top : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.divider_field_margin_top_title, 
				descr : 	cmsms_shortcodes.divider_field_margin_top_descr + "<br /><span>" + cmsms_shortcodes.note + ' ' +  cmsms_shortcodes.size_note_short + ' ' + cmsms_shortcodes.value_zero + "</span>", 
				def : 		'50', 
				required : 	false, 
				width : 	'number', 
				min : 		'0' 
			}, 
			// Bottom Margin
			margin_bottom : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.divider_field_margin_bottom_title, 
				descr : 	cmsms_shortcodes.divider_field_margin_bottom_descr + "<br /><span>" + cmsms_shortcodes.note + ' ' +  cmsms_shortcodes.size_note_short + ' ' + cmsms_shortcodes.value_zero + "</span>", 
				def : 		'50', 
				required : 	false, 
				width : 	'number', 
				min : 		'0' 
			}, 
			// CSS3 Animation
			animation : { 
				type : 		'select', 
				title : 	cmsms_shortcodes.animation_title, 
				descr : 	cmsms_shortcodes.animation_descr + " <br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.animation_descr_note + "</span>", 
				def : 		'', 
				required : 	false, 
				width : 	'half', 
				choises : 	get_animations() 
			}, 
			// Animation Delay
			animation_delay : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.animation_delay_title, 
				descr : 	cmsms_shortcodes.animation_delay_descr + " <br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.animation_delay_descr_note + "</span>", 
				def : 		'0', 
				required : 	false, 
				width : 	'number', 
				min : 		'0', 
				step : 		'50' 
			}, 
			// Additional Classes
			classes : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.classes_title, 
				descr : 	cmsms_shortcodes.classes_descr, 
				def : 		'', 
				required : 	false, 
				width : 	'half' 
			} 
		} 
	}, 
	
	
	// Embed
	cmsms_embed : { 
		title : 	cmsms_shortcodes.embed_title, 
		icon : 		'admin-icon-embed', 
		pair : 		false, 
		content : 	false, 
		visual : 	false, 
		multiple : 	false, 
		def : 		'', 
		fields : { 
			// Link
			link : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.link, 
				descr : 	cmsms_shortcodes.embed_field_link_descr + "<br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.embed_field_link_descr_note + ' ' + "<a href='http://codex.wordpress.org/Embed_Shortcode#Okay.2C_So_What_Sites_Can_I_Embed_From.3F' target='_blank'>" + cmsms_shortcodes.embed_field_link_descr_note_link + "</a></span>", 
				def : 		'', 
				required : 	true, 
				width : 	'full' 
			}, 
			// Max Width
			width : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.embed_field_maxwidth_title, 
				descr : 	cmsms_shortcodes.embed_field_maxwidth_descr + "<br /><span>" + cmsms_shortcodes.note + ' ' +  cmsms_shortcodes.size_note_short + ' ' + cmsms_shortcodes.embed_field_maxwidth_descr_note + "</span>", 
				def : 		'', 
				required : 	false, 
				width : 	'number', 
				min : 		'0' 
			}, 
			// Max Height
			height : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.embed_field_maxheight_title, 
				descr : 	cmsms_shortcodes.embed_field_maxheight_descr + "<br /><span>" + cmsms_shortcodes.note + ' ' +  cmsms_shortcodes.size_note_short + ' ' + cmsms_shortcodes.embed_field_maxheight_descr_note + "</span>", 
				def : 		'', 
				required : 	false, 
				width : 	'number', 
				min : 		'0' 
			}, 
			// Wrap Video
			wrap : { 
				type : 		'checkbox', 
				title : 	cmsms_shortcodes.embed_field_wrap_title, 
				descr : 	cmsms_shortcodes.embed_field_wrap_descr + "<br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.embed_field_wrap_descr_note + "</span>", 
				def : 		'', 
				required : 	false, 
				width : 	'half', 
				choises : { 
							'true' : 	'Enable' 
				} 
			}, 
			// CSS3 Animation
			animation : { 
				type : 		'select', 
				title : 	cmsms_shortcodes.animation_title, 
				descr : 	cmsms_shortcodes.animation_descr + " <br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.animation_descr_note + "</span>", 
				def : 		'', 
				required : 	false, 
				width : 	'half', 
				choises : 	get_animations() 
			}, 
			// Animation Delay
			animation_delay : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.animation_delay_title, 
				descr : 	cmsms_shortcodes.animation_delay_descr + " <br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.animation_delay_descr_note + "</span>", 
				def : 		'0', 
				required : 	false, 
				width : 	'number', 
				min : 		'0', 
				step : 		'50' 
			}, 
			// Additional Classes
			classes : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.classes_title, 
				descr : 	cmsms_shortcodes.classes_descr, 
				def : 		'', 
				required : 	false, 
				width : 	'half' 
			} 
		} 
	}, 
	
	
	// Featured Block
	cmsms_featured_block : { 
		title : 	cmsms_shortcodes.featured_title, 
		icon : 		'admin-icon-featured-block', 
		pair : 		true, 
		content : 	'content', 
		visual : 	'<div><div>{{ data.content }}</div><div><a href="javascript:void(0);" class="cmsms_button {{ data.icon }}">{{ data.button_title }}</a></div></div>', 
		multiple : 	false, 
		def : 		"<p>" + cmsms_shortcodes.def_text + "</p>", 
		fields : { 
			// Content
			content : { 
				type : 		'editor', 
				title : 	cmsms_shortcodes.featured_field_content_title, 
				descr : 	"", 
				def : 		"<p>" + cmsms_shortcodes.def_text + "</p>", 
				required : 	true, 
				width : 	'full' 
			}, 
			// Custom Block Colors
			custom_colors : { 
				type : 		'checkbox', 
				title : 	cmsms_shortcodes.featured_field_cust_block_color_title, 
				descr : 	cmsms_shortcodes.featured_field_cust_block_color_descr, 
				def : 		'', 
				required : 	false, 
				width : 	'half',  
				choises : { 
							'true' : 		cmsms_shortcodes.choice_enable 
				} 
			}, 
			// Block Background Color
			bg_color : { 
				type : 		'color', 
				title : 	cmsms_shortcodes.featured_field_block_bg_color_title, 
				descr : 	cmsms_shortcodes.featured_field_block_bg_color_descr, 
				def : 		'#ffffff', 
				required : 	false, 
				width : 	'half', 
				depend : 	'custom_colors:true' 
			}, 
			// Block Text Color
			text_color : { 
				type : 		'color', 
				title : 	cmsms_shortcodes.featured_field_block_txt_color_title, 
				descr : 	cmsms_shortcodes.featured_field_block_txt_color_descr, 
				def : 		'#353535', 
				required : 	false, 
				width : 	'half', 
				depend : 	'custom_colors:true' 
			}, 
			// Button Background Color
			button_bg_color : { 
				type : 		'color', 
				title : 	cmsms_shortcodes.featured_field_button_bg_color_title, 
				descr : 	cmsms_shortcodes.featured_field_button_bg_color_descr + "<br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.button_visible_note + "</span>", 
				def : 		'#ff6b6b', 
				required : 	false, 
				width : 	'half', 
				depend : 	'custom_colors:true' 
			}, 
			// Button Text Color
			button_text_color : { 
				type : 		'color', 
				title : 	cmsms_shortcodes.featured_field_button_txt_color_title, 
				descr : 	cmsms_shortcodes.featured_field_button_txt_color_descr + " <br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.button_visible_note + "</span>", 
				def : 		'#ffffff', 
				required : 	false, 
				width : 	'half', 
				depend : 	'custom_colors:true' 
			}, 
			// Button
			button : { 
				type : 		'checkbox', 
				title : 	cmsms_shortcodes.button, 
				descr : 	cmsms_shortcodes.featured_field_button_descr, 
				def : 		'true', 
				required : 	false, 
				width : 	'half',  
				choises : { 
							'true' : 	cmsms_shortcodes.choice_show 
				} 
			}, 
			// Button Title
			button_title : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.featured_field_button_title_title, 
				descr : 	cmsms_shortcodes.featured_field_button_title_descr, 
				def : 		cmsms_shortcodes.button, 
				required : 	true, 
				width : 	'half', 
				depend : 	'button:true' 
			}, 
			// Button Link
			button_link : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.featured_field_button_link_title, 
				descr : 	cmsms_shortcodes.featured_field_button_link_descr, 
				def : 		'', 
				required : 	true, 
				width : 	'full', 
				depend : 	'button:true' 
			}, 
			// Button Target
			button_target : { 
				type : 		'radio', 
				title : 	cmsms_shortcodes.featured_field_button_target_title, 
				descr : 	cmsms_shortcodes.featured_field_button_target_descr, 
				def : 		'self', 
				required : 	false, 
				width : 	'half',  
				choises : { 
							'self' : 	cmsms_shortcodes.link_target_choice_self, 
							'blank' : 	cmsms_shortcodes.link_target_choice_blank 
				}, 
				depend : 	'button:true' 
			}, 
			// Button Icon
			icon : { 
				type : 		'icon', 
				title : 	cmsms_shortcodes.featured_field_button_icon_title, 
				descr : 	cmsms_shortcodes.button_icon_descr, 
				def : 		'', 
				required : 	false, 
				width : 	'full', 
				choises : 	cmsms_composer_icons(), 
				depend : 	'button:true' 
			}, 
			// CSS3 Animation
			animation : { 
				type : 		'select', 
				title : 	cmsms_shortcodes.animation_title, 
				descr : 	cmsms_shortcodes.animation_descr + " <br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.animation_descr_note + "</span>", 
				def : 		'', 
				required : 	false, 
				width : 	'half', 
				choises : 	get_animations() 
			}, 
			// Animation Delay
			animation_delay : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.animation_delay_title, 
				descr : 	cmsms_shortcodes.animation_delay_descr + " <br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.animation_delay_descr_note + "</span>", 
				def : 		'0', 
				required : 	false, 
				width : 	'number', 
				min : 		'0', 
				step : 		'50' 
			}, 
			// Additional Classes
			classes : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.classes_title, 
				descr : 	cmsms_shortcodes.classes_descr, 
				def : 		'', 
				required : 	false, 
				width : 	'half' 
			} 
		} 
	}, 
	
	
	// Gallery
	cmsms_gallery : { 
		title : 	cmsms_shortcodes.gallery_title, 
		icon : 		'admin-icon-gallery', 
		pair : 		true, 
		content : 	'images', 
		visual : 	false, 
		multiple : 	false, 
		def : 		'', 
		fields : { 
			// Images
			images : { 
				type : 		'gallery', 
				title : 	cmsms_shortcodes.gallery_field_images_title, 
				descr : 	cmsms_shortcodes.gallery_field_images_descr, 
				def : 		'', 
				required : 	true, 
				width : 	'full' 
			}, 
			// Layout
			layout : { 
				type : 		'radio', 
				title : 	cmsms_shortcodes.layout_title, 
				descr : 	cmsms_shortcodes.gallery_field_layout_descr + " <br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.gallery_field_layout_descr_note + "</span>", 
				def : 		'hover', 
				required : 	true, 
				width : 	'half', 
				choises : { 
							'hover' : 	cmsms_shortcodes.gallery_field_layout_choice_hover, 
							'slider' : 	cmsms_shortcodes.gallery_field_layout_choice_slider, 
							'gallery' : cmsms_shortcodes.gallery_field_layout_choice_gallery 
				} 
			}, 
			// Image Size Slider
			image_size_slider : { 
				type : 		'select', 
				title : 	cmsms_shortcodes.gallery_field_image_size_slider_title, 
				descr : 	cmsms_shortcodes.gallery_field_image_size_slider_descr, 
				def : 		'full', 
				required : 	false, 
				width : 	'half', 
				choises : 	cmsms_composer_thumbnail_sizes(), 
				depend : 	'layout:slider' 
			}, 
			// Image Size Gallery
			image_size_gallery : { 
				type : 		'select', 
				title : 	cmsms_shortcodes.gallery_field_image_size_title, 
				descr : 	cmsms_shortcodes.gallery_field_image_size_descr, 
				def : 		'full', 
				required : 	false, 
				width : 	'half', 
				choises : 	cmsms_composer_thumbnail_sizes(), 
				depend : 	'layout:gallery' 
			}, 
			// Hover Slider Pause Time
			hover_pause : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.gallery_field_hoversl_pausetime_title, 
				descr : 	cmsms_shortcodes.gallery_field_hoversl_pausetime_descr + " <br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.gallery_field_hoversl_pausetime_descr_note + "</span>", 
				def : 		'5', 
				required : 	false, 
				width : 	'number', 
				min : 		'0', 
				depend : 	'layout:hover' 
			}, 
			// Hover Slider Active Slide
			hover_active : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.gallery_field_hoversl_activesl_title, 
				descr : 	cmsms_shortcodes.gallery_field_hoversl_activesl_descr + "<br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.gallery_field_hoversl_activesl_descr_note + "</span>", 
				def : 		'', 
				required : 	false, 
				width : 	'number', 
				min : 		'1', 
				depend : 	'layout:hover' 
			}, 
			// Hover Slider Pause on Hover
			hover_pause_on_hover : { 
				type : 		'checkbox', 
				title : 	cmsms_shortcodes.gallery_field_hoversl_pause_title, 
				descr : 	cmsms_shortcodes.gallery_field_hoversl_pause_descr, 
				def : 		'', 
				required : 	false, 
				width : 	'half', 
				choises : { 
							'true' : 	cmsms_shortcodes.choice_enable 
				}, 
				depend : 	'layout:hover' 
			}, 
			// Slider Animation Effect
			slider_effect : { 
				type : 		'radio', 
				title : 	cmsms_shortcodes.gallery_field_sl_animeffect_title, 
				descr : 	cmsms_shortcodes.gallery_field_sl_animeffect_descr, 
				def : 		'slide', 
				required : 	true, 
				width : 	'half', 
				choises : { 
							'slide' : 		cmsms_shortcodes.gallery_field_sl_animeffect_choice_slide, 
							'fade' : 		cmsms_shortcodes.gallery_field_sl_animeffect_choice_fade
				}, 
				depend : 	'layout:slider' 
			}, 
			// Slider Autoplay
			slider_autoplay : { 
				type : 		'checkbox', 
				title : 	cmsms_shortcodes.gallery_field_sl_slideshow_title, 
				descr : 	cmsms_shortcodes.gallery_field_sl_slideshow_descr, 
				def : 		'true', 
				required : 	false, 
				width : 	'half', 
				choises : { 
							'true' : 	cmsms_shortcodes.choice_enable 
				}, 
				depend : 	'layout:slider' 
			}, 
			// Slider Slideshow Speed
			slider_slideshow_speed : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.gallery_field_sl_slideshow_speed_title, 
				descr : 	cmsms_shortcodes.gallery_field_sl_slideshow_speed_descr + "<br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.gallery_field_sl_slideshow_speed_descr_note + "</span>", 
				def : 		'7', 
				required : 	false, 
				width : 	'number', 
				min : 		'1', 
				depend : 	'layout:slider' 
			}, 
			// Slider Animation Speed
			slider_animation_speed : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.gallery_field_sl_anim_speed_title, 
				descr : 	cmsms_shortcodes.gallery_field_sl_anim_speed_descr + "<br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.gallery_field_sl_anim_speed_descr_note + "</span>", 
				def : 		'600', 
				required : 	false, 
				width : 	'number', 
				min : 		'0', 
				step : 		'50', 
				depend : 	'layout:slider' 
			},
			// Slider Pause on Hover
			slider_pause_on_hover : { 
				type : 		'checkbox', 
				title : 	cmsms_shortcodes.gallery_field_sl_pause_title, 
				descr : 	cmsms_shortcodes.gallery_field_sl_pause_descr, 
				def : 		'true', 
				required : 	false, 
				width : 	'half', 
				choises : { 
							'true' : 	cmsms_shortcodes.choice_enable 
				}, 
				depend : 	'layout:slider' 
			}, 
			// Slider Rewind
			slider_rewind : { 
				type : 		'checkbox', 
				title : 	cmsms_shortcodes.gallery_field_sl_rewind_title, 
				descr : 	cmsms_shortcodes.gallery_field_sl_rewind_descr, 
				def : 		'true', 
				required : 	false, 
				width : 	'half', 
				choises : { 
							'true' : 	cmsms_shortcodes.choice_enable 
				}, 
				depend : 	'layout:slider' 
			}, 
			// Slider Rewind Speed
			slider_rewind_speed : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.gallery_field_sl_rewind_speed_title, 
				descr : 	cmsms_shortcodes.gallery_field_sl_rewind_speed_descr + "<br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.gallery_field_sl_rewind_speed_descr_note + "</span>", 
				def : 		'1000', 
				required : 	false, 
				width : 	'number', 
				min : 		'0', 
				step : 		'50', 
				depend : 	'layout:slider' 
			},
			// Slider Navigation Control
			slider_nav_control : { 
				type : 		'checkbox', 
				title : 	cmsms_shortcodes.gallery_field_sl_navcontrol_title, 
				descr : 	cmsms_shortcodes.gallery_field_sl_navcontrol_descr, 
				def : 		'true', 
				required : 	false, 
				width : 	'half', 
				choises : { 
							'true' : 	cmsms_shortcodes.choice_enable 
				}, 
				depend : 	'layout:slider' 
			},  
			// Slider Arrow Navigation
			slider_nav_arrow : { 
				type : 		'checkbox', 
				title : 	cmsms_shortcodes.gallery_field_sl_arrownav_title, 
				descr : 	cmsms_shortcodes.gallery_field_sl_arrownav_descr, 
				def : 		'', 
				required : 	false, 
				width : 	'half', 
				choises : { 
							'true' : 	cmsms_shortcodes.choice_enable 
				}, 
				depend : 	'layout:slider' 
			},
			// Image Gallery Columns
			gallery_columns : { 
				type : 		'select', 
				title : 	cmsms_shortcodes.gallery_field_imagegall_columns_title, 
				descr : 	cmsms_shortcodes.gallery_field_imagegall_columns_descr, 
				def : 		'4', 
				required : 	false, 
				width : 	'half', 
				choises : { 
							'4' : 		cmsms_shortcodes.gallery_field_imagegall_columns_choice_four, 
							'3' : 		cmsms_shortcodes.gallery_field_imagegall_columns_choice_three, 
							'2' : 		cmsms_shortcodes.gallery_field_imagegall_columns_choice_two, 
							'1' : 		cmsms_shortcodes.gallery_field_imagegall_columns_choice_one
				}, 
				depend : 	'layout:gallery' 
			}, 
			// Gallery Images Links
			gallery_links : { 
				type : 		'select', 
				title : 	cmsms_shortcodes.gallery_field_imagegall_imglinks_title, 
				descr : 	cmsms_shortcodes.gallery_field_imagegall_imglinks_descr, 
				def : 		'lightbox', 
				required : 	false, 
				width : 	'half', 
				choises : { 
							'lightbox' : 	cmsms_shortcodes.gallery_field_imagegall_imglinks_choice_box, 
							'self' : 		cmsms_shortcodes.gallery_field_imagegall_imglinks_choice_self, 
							'blank' : 		cmsms_shortcodes.gallery_field_imagegall_imglinks_choice_blank, 
							'none' : 		cmsms_shortcodes.gallery_field_imagegall_imglinks_choice_none 
				}, 
				depend : 	'layout:gallery' 
			}, 
			// CSS3 Animation
			animation : { 
				type : 		'select', 
				title : 	cmsms_shortcodes.animation_title, 
				descr : 	cmsms_shortcodes.animation_descr + " <br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.animation_descr_note + "</span>", 
				def : 		'', 
				required : 	false, 
				width : 	'half', 
				choises : 	get_animations() 
			}, 
			// Animation Delay
			animation_delay : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.animation_delay_title, 
				descr : 	cmsms_shortcodes.animation_delay_descr + " <br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.animation_delay_descr_note + "</span>", 
				def : 		'0', 
				required : 	false, 
				width : 	'number', 
				min : 		'0', 
				step : 		'50' 
			}, 
			// Additional Classes
			classes : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.classes_title, 
				descr : 	cmsms_shortcodes.classes_descr, 
				def : 		'', 
				required : 	false, 
				width : 	'half' 
			} 
		} 
	}, 
	
	
	// Google Map Markers
	cmsms_google_map_markers : { 
		title : 	cmsms_shortcodes.map_markers_title, 
		icon : 		'admin-icon-map', 
		pair : 		true, 
		content : 	'markers', 
		visual : 	false, 
		multiple : 	true, 
		def : 		'[cmsms_google_map_marker][/cmsms_google_map_marker]', 
		fields : { 
			// Markers
			markers : { 
				type : 		'multiple', 
				title : 	cmsms_shortcodes.map_markers_field_markers_title, 
				descr : 	cmsms_shortcodes.map_markers_field_markers_descr, 
				def : 		'[cmsms_google_map_marker][/cmsms_google_map_marker]', 
				required : 	true, 
				width : 	'half' 
			}, 
			// Address Type
			address_type : { 
				type : 		'radio', 
				title : 	cmsms_shortcodes.map_markers_field_address_type_title, 
				descr : 	cmsms_shortcodes.map_markers_field_address_type_descr, 
				def : 		'address', 
				required : 	true, 
				width : 	'half', 
				choises : { 
							'address' : 		cmsms_shortcodes.map_markers_field_address_type_choice_address, 
							'coordinates' : 	cmsms_shortcodes.map_markers_field_address_type_choice_coord 
				} 
			}, 
			// Address
			address : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.map_markers_field_address_title, 
				descr : 	cmsms_shortcodes.map_markers_field_address_descr, 
				def : 		'', 
				required : 	true, 
				width : 	'half', 
				depend : 	'address_type:address' 
			}, 
			// Latitude
			latitude : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.map_markers_field_latitude_title, 
				descr : 	cmsms_shortcodes.map_markers_field_latitude_descr + "<br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.value_number + "</span>", 
				def : 		'', 
				required : 	true, 
				width : 	'small', 
				depend : 	'address_type:coordinates' 
			}, 
			// Longitude
			longitude : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.map_markers_field_longitude_title, 
				descr : 	cmsms_shortcodes.map_markers_field_longitude_descr + "<br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.value_number + "</span>", 
				def : 		'', 
				required : 	true, 
				width : 	'small', 
				depend : 	'address_type:coordinates' 
			}, 
			// Type
			type : { 
				type : 		'select', 
				title : 	cmsms_shortcodes.map_markers_field_type_title, 
				descr : 	cmsms_shortcodes.map_markers_field_type_descr, 
				def : 		'ROADMAP', 
				required : 	true, 
				width : 	'half', 
				choises : { 
							'ROADMAP' : 	cmsms_shortcodes.map_markers_field_type_choice_roadmap, 
							'TERRAIN' : 	cmsms_shortcodes.map_markers_field_type_choice_terrain, 
							'HYBRID' : 		cmsms_shortcodes.map_markers_field_type_choice_hybrid, 
							'SATELLITE' : 	cmsms_shortcodes.map_markers_field_type_choice_sattelite 
				} 
			}, 
			// Zoom
			zoom : { 
				type : 		'select', 
				title : 	cmsms_shortcodes.map_markers_field_zoom_title, 
				descr : 	cmsms_shortcodes.map_markers_field_zoom_descr, 
				def : 		'14', 
				required : 	true, 
				width : 	'half', 
				choises : { 
							'1' : 	'1', 
							'2' : 	'2', 
							'3' : 	'3', 
							'4' : 	'4', 
							'5' : 	'5', 
							'6' : 	'6', 
							'7' : 	'7', 
							'8' : 	'8', 
							'9' : 	'9', 
							'10' : 	'10', 
							'11' : 	'11', 
							'12' : 	'12', 
							'13' : 	'13', 
							'14' : 	'14', 
							'15' : 	'15', 
							'16' : 	'16', 
							'17' : 	'17', 
							'18' : 	'18', 
							'19' : 	'19' 
				} 
			}, 
			// Height Type
			height_type : { 
				type : 		'radio', 
				title : 	cmsms_shortcodes.map_markers_field_height_type_title, 
				descr : 	cmsms_shortcodes.map_markers_field_height_type_descr, 
				def : 		'auto', 
				required : 	true, 
				width : 	'half', 
				choises : { 
							'auto' : 	cmsms_shortcodes.map_markers_field_height_type_choice_auto, 
							'fixed' : 	cmsms_shortcodes.map_markers_field_height_type_choice_fixed 
				} 
			}, 
			// Height
			height : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.map_markers_field_height_title, 
				descr : 	cmsms_shortcodes.map_markers_field_height_descr + "<br /><span>" + cmsms_shortcodes.note + ' ' +  cmsms_shortcodes.size_note_short + cmsms_shortcodes.map_markers_field_height_descr_note + "</span>", 
				def : 		'300', 
				required : 	false, 
				width : 	'number', 
				min : 		'0', 
				depend : 	'height_type:fixed' 
			}, 
			// Scrollwheel
			scroll_wheel : { 
				type : 		'checkbox', 
				title : 	cmsms_shortcodes.map_markers_field_scrollwheel_title, 
				descr : 	cmsms_shortcodes.map_markers_field_scrollwheel_descr, 
				def : 		'true', 
				required : 	false, 
				width : 	'half', 
				choises : { 
							'true' : 	'Enable' 
				} 
			}, 
			// Double Click Zoom
			double_click_zoom : { 
				type : 		'checkbox', 
				title : 	cmsms_shortcodes.map_markers_field_doubleclick_zoom_title, 
				descr : 	cmsms_shortcodes.map_markers_field_doubleclick_zoom_descr, 
				def : 		'true', 
				required : 	false, 
				width : 	'half', 
				choises : { 
							'true' : 	cmsms_shortcodes.choice_enable 
				} 
			}, 
			// Pan Control
			pan_control : { 
				type : 		'checkbox', 
				title : 	cmsms_shortcodes.map_markers_field_pan_control_title, 
				descr : 	cmsms_shortcodes.map_markers_field_pan_control_descr, 
				def : 		'true', 
				required : 	false, 
				width : 	'half', 
				choises : { 
							'true' : 	cmsms_shortcodes.choice_enable 
				} 
			}, 
			// Zoom Control
			zoom_control : { 
				type : 		'checkbox', 
				title : 	cmsms_shortcodes.map_markers_field_zoom_control_title, 
				descr : 	cmsms_shortcodes.map_markers_field_zoom_control_descr, 
				def : 		'true', 
				required : 	false, 
				width : 	'half', 
				choises : { 
							'true' : 	cmsms_shortcodes.choice_enable 
				} 
			}, 
			// Map Type Control
			map_type_control : { 
				type : 		'checkbox', 
				title : 	cmsms_shortcodes.map_markers_field_maptype_control_title, 
				descr : 	cmsms_shortcodes.map_markers_field_maptype_control_descr, 
				def : 		'true', 
				required : 	false, 
				width : 	'half', 
				choises : { 
							'true' : 	cmsms_shortcodes.choice_enable 
				} 
			}, 
			// Scale Control
			scale_control : { 
				type : 		'checkbox', 
				title : 	cmsms_shortcodes.map_markers_field_scale_control_title, 
				descr : 	cmsms_shortcodes.map_markers_field_scale_control_descr, 
				def : 		'true', 
				required : 	false, 
				width : 	'half', 
				choises : { 
							'true' : 	cmsms_shortcodes.choice_enable 
				} 
			}, 
			// Street View Control
			street_view_control : { 
				type : 		'checkbox', 
				title : 	cmsms_shortcodes.map_markers_field_strtview_control_title, 
				descr : 	cmsms_shortcodes.map_markers_field_strtview_control_descr + "<br /><span>" + cmsms_shortcodes.note + ' ' +  cmsms_shortcodes.map_markers_field_strtview_control_descr_note + "</span>", 
				def : 		'true', 
				required : 	false, 
				width : 	'half', 
				choises : { 
							'true' : 	cmsms_shortcodes.choice_enable 
				} 
			}, 
			// Overview Map Control
			overview_map_control : { 
				type : 		'checkbox', 
				title : 	cmsms_shortcodes.map_markers_field_overview_map_control_title, 
				descr : 	cmsms_shortcodes.map_markers_field_overview_map_control_descr, 
				def : 		'true', 
				required : 	false, 
				width : 	'half', 
				choises : { 
							'true' : 	cmsms_shortcodes.choice_enable 
				} 
			}, 
			// CSS3 Animation
			animation : { 
				type : 		'select', 
				title : 	cmsms_shortcodes.animation_title, 
				descr : 	cmsms_shortcodes.animation_descr + " <br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.animation_descr_note + "</span>", 
				def : 		'', 
				required : 	false, 
				width : 	'half', 
				choises : 	get_animations() 
			}, 
			// Animation Delay
			animation_delay : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.animation_delay_title, 
				descr : 	cmsms_shortcodes.animation_delay_descr + " <br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.animation_delay_descr_note + "</span>", 
				def : 		'0', 
				required : 	false, 
				width : 	'number', 
				min : 		'0', 
				step : 		'50' 
			}, 
			// Additional Classes
			classes : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.classes_title, 
				descr : 	cmsms_shortcodes.classes_descr, 
				def : 		'', 
				required : 	false, 
				width : 	'half' 
			} 
		} 
	}, 
	
	
	// Icon
	cmsms_simple_icon : { 
		title : 	cmsms_shortcodes.icon, 
		icon : 		'admin-icon-icon', 
		pair : 		true, 
		content : 	'classes', 
		visual : 	'<div><div class="cmsms_simple_icon {{ data.icon }}" style="font-size:{{ data.size }}px; line-height:{{ data.size }}px; text-align:{{ data.text_align }};"></div></div>', 
		multiple : 	false, 
		def : 		"", 
		fields : { 
			// Icon
			icon : { 
				type : 		'icon', 
				title : 	cmsms_shortcodes.icon, 
				descr : 	cmsms_shortcodes.icon_field_icon_descr, 
				def : 		'cmsms-icon-thumbs-up-5', 
				required : 	true, 
				width : 	'full', 
				choises : 	cmsms_composer_icons() 
			}, 
			// Size
			size : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.size, 
				descr : 	cmsms_shortcodes.icon_field_size_descr + " <br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.icon_field_size_descr_note + "</span>", 
				def : 		'40', 
				required : 	true, 
				width : 	'number', 
				min : 		'0' 
			}, 
			// Display
			display : { 
				type : 		'radio', 
				title : 	cmsms_shortcodes.icon_field_display_title, 
				descr : 	cmsms_shortcodes.icon_field_display_descr, 
				def : 		'block', 
				required : 	true, 
				width : 	'half', 
				choises : { 
							'block' : 			cmsms_shortcodes.choice_block, 
							'inline' : 			cmsms_shortcodes.choice_inline, 
							'inline-block' : 	cmsms_shortcodes.choice_inline_block
				} 
			}, 
			// Icon Position
			text_align : { 
				type : 		'radio', 
				title : 	cmsms_shortcodes.icon_field_text_align_title, 
				descr : 	cmsms_shortcodes.icon_field_text_align_descr, 
				def : 		'center', 
				required : 	false, 
				width : 	'half', 
				choises : { 
							'left' : 		cmsms_shortcodes.choice_left, 
							'center' : 		cmsms_shortcodes.choice_center, 
							'right' : 		cmsms_shortcodes.choice_right, 
				}, 
				depend : 	'display:block' 
			}, 
			// Icon Link
			link : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.icon_field_link_title, 
				descr : 	cmsms_shortcodes.icon_field_link_descr, 
				def : 		'', 
				required : 	false, 
				width : 	'full' 
			}, 
			// Icon Link Target
			target : { 
				type : 		'radio', 
				title : 	cmsms_shortcodes.icon_field_target_title, 
				descr : 	cmsms_shortcodes.icon_field_target_descr, 
				def : 		'self', 
				required : 	false, 
				width : 	'half',  
				choises : { 
							'self' : 	cmsms_shortcodes.link_target_choice_self, 
							'blank' : 	cmsms_shortcodes.link_target_choice_blank 
				} 
			}, 
			// Custom Color
			custom_color : { 
				type : 		'checkbox', 
				title : 	cmsms_shortcodes.icon_field_custom_color_title, 
				descr : 	cmsms_shortcodes.icon_field_custom_color_descr, 
				def : 		'', 
				required : 	false, 
				width : 	'half',  
				choises : { 
							'true' : 		cmsms_shortcodes.choice_enable 
				} 
			}, 
			// Color
			color : { 
				type : 		'color', 
				title : 	cmsms_shortcodes.color, 
				descr : 	cmsms_shortcodes.icon_field_color_descr, 
				def : 		'#353535', 
				required : 	false, 
				width : 	'half', 
				depend : 	'custom_color:true' 
			}, 
			// Color Transparency
			color_transparency : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.icon_field_color_transparency_title, 
				descr : 	cmsms_shortcodes.icon_field_color_transparency_descr, 
				def : 		'100', 
				required : 	false, 
				width : 	'number', 
				min : 		'0', 
				max : 		'100', 
				depend : 	'custom_color:true' 
			}, 
			// CSS3 Animation
			animation : { 
				type : 		'select', 
				title : 	cmsms_shortcodes.animation_title, 
				descr : 	cmsms_shortcodes.animation_descr + " <br /><span>" + cmsms_shortcodes.note  + ' ' + cmsms_shortcodes.animation_descr_note + "</span>", 
				def : 		'', 
				required : 	false, 
				width : 	'half', 
				choises : 	get_animations() 
			}, 
			// Animation Delay
			animation_delay : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.animation_delay_title, 
				descr : 	cmsms_shortcodes.animation_delay_descr + " <br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.animation_delay_descr_note + "</span>", 
				def : 		'0', 
				required : 	false, 
				width : 	'number', 
				min : 		'0', 
				step : 		'50' 
			}, 
			// Additional Classes
			classes : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.classes_title, 
				descr : 	cmsms_shortcodes.classes_descr, 
				def : 		'', 
				required : 	false, 
				width : 	'half' 
			} 
		} 
	}, 
	
	
	// Icon Box
	cmsms_icon_box : { 
		title : 	cmsms_shortcodes.icon_title, 
		icon : 		'admin-icon-icon-box', 
		pair : 		true, 
		content : 	'content', 
		visual : 	'<div class="{{ data.type }} {{ data.icon }}"><h2>{{ data.title }}</h2>{{ data.content }}<div class="cl"></div><a href="javascript:void(0);" class="cmsms_button">{{ data.button_title }}</a></div>', 
		multiple : 	false, 
		def : 		"<p>" + cmsms_shortcodes.def_text + "</p>", 
		fields : { 
			// Box Title
			title : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.icon_field_box_title_title, 
				descr : 	cmsms_shortcodes.icon_field_box_title_descr, 
				def : 		cmsms_shortcodes.icon_field_box_title_def, 
				required : 	true, 
				width : 	'half' 
			},  
			// Box Type
			type : { 
				type : 		'select', 
				title : 	cmsms_shortcodes.icon_field_box_type_title, 
				descr : 	cmsms_shortcodes.icon_field_box_type_descr, 
				def : 		'cmsms_box_heading', 
				required : 	true, 
				width : 	'half', 
				choises : { 
							'cmsms_box_heading' : 	cmsms_shortcodes.icon_field_box_type_choice_heading, 
							'cmsms_box_centered' : 	cmsms_shortcodes.icon_field_box_type_choice_centered, 
							'cmsms_box_colored' : 	cmsms_shortcodes.icon_field_box_type_choice_colored, 
							'cmsms_box_lefticon' : 	cmsms_shortcodes.icon_field_box_type_choice_lefticon 
				} 
			}, 
			// Heading Type
			heading_type : { 
				type : 		'select', 
				title : 	cmsms_shortcodes.heading_field_type_title, 
				descr : 	cmsms_shortcodes.heading_field_type_descr, 
				def : 		'h1', 
				required : 	true, 
				width : 	'half', 
				choises : { 
							'h1' : 	'H1', 
							'h2' : 	'H2', 
							'h3' : 	'H3' 
				} 
			}, 
			// Custom Box Color
			custom_colors : { 
				type : 		'checkbox', 
				title : 	cmsms_shortcodes.icon_field_custom_box_color_title, 
				descr : 	cmsms_shortcodes.icon_field_custom_box_color_descr, 
				def : 		'', 
				required : 	false, 
				width : 	'half',  
				choises : { 
							'true' : 		cmsms_shortcodes.choice_enable 
				} 
			}, 
			// Box Color
			color : { 
				type : 		'color', 
				title : 	cmsms_shortcodes.icon_field_box_color_title, 
				descr : 	cmsms_shortcodes.icon_field_box_color_descr + "<br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.icon_field_box_color_descr_note + "</span>", 
				def : 		'#353535', 
				required : 	false, 
				width : 	'half', 
				depend : 	'custom_colors:true' 
			}, 
			// Content
			content : { 
				type : 		'editor', 
				title : 	cmsms_shortcodes.text_field_content_title, 
				descr : 	"", 
				def : 		"<p>" + cmsms_shortcodes.def_text + "</p>", 
				required : 	true, 
				width : 	'full' 
			}, 
			// Button
			button : { 
				type : 		'checkbox', 
				title : 	cmsms_shortcodes.button, 
				descr : 	cmsms_shortcodes.icon_field_button_descr, 
				def : 		'true', 
				required : 	false, 
				width : 	'half',  
				choises : { 
							'true' : 	cmsms_shortcodes.choice_show 
				} 
			}, 
			// Button Title
			button_title : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.icon_field_button_label_title, 
				descr : 	cmsms_shortcodes.icon_field_button_label_descr, 
				def : 		cmsms_shortcodes.button, 
				required : 	true, 
				width : 	'half', 
				depend : 	'button:true' 
			}, 
			// Button Link
			button_link : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.icon_field_button_link_title, 
				descr : 	cmsms_shortcodes.icon_field_button_link_descr, 
				def : 		'', 
				required : 	true, 
				width : 	'full', 
				depend : 	'button:true' 
			}, 
			// Button Target
			button_target : { 
				type : 		'radio', 
				title : 	cmsms_shortcodes.icon_field_button_target_title, 
				descr : 	cmsms_shortcodes.icon_field_button_target_descr, 
				def : 		'self', 
				required : 	false, 
				width : 	'half',  
				choises : { 
							'self' : 	cmsms_shortcodes.link_target_choice_self, 
							'blank' : 	cmsms_shortcodes.link_target_choice_blank 
				}, 
				depend : 	'button:true' 
			}, 
			// Box Icon
			icon : { 
				type : 		'icon', 
				title : 	'Box Icon', 
				descr : 	"Choose icon for your icon box", 
				def : 		'cmsms-icon-heart-7', 
				required : 	false, 
				width : 	'full', 
				choises : 	cmsms_composer_icons() 
			}, 
			// CSS3 Animation
			animation : { 
				type : 		'select', 
				title : 	cmsms_shortcodes.animation_title, 
				descr : 	cmsms_shortcodes.animation_descr + " <br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.animation_descr_note + "</span>", 
				def : 		'', 
				required : 	false, 
				width : 	'half', 
				choises : 	get_animations() 
			}, 
			// Animation Delay
			animation_delay : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.animation_delay_title, 
				descr : 	cmsms_shortcodes.animation_delay_descr + " <br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.animation_delay_descr_note + "</span>", 
				def : 		'0', 
				required : 	false, 
				width : 	'number', 
				min : 		'0', 
				step : 		'50' 
			}, 
			// Additional Classes
			classes : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.classes_title, 
				descr : 	cmsms_shortcodes.classes_descr, 
				def : 		'', 
				required : 	false, 
				width : 	'half' 
			} 
		} 
	}, 
	
	
	// Icon List
	cmsms_icon_list_items : { 
		title : 	cmsms_shortcodes.icon_list_title, 
		icon : 		'admin-icon-list', 
		pair : 		true, 
		content : 	'list', 
		visual : 	false, 
		multiple : 	true, 
		def : 		'[cmsms_icon_list_item title="' + cmsms_shortcodes.title + '"]<p>' + cmsms_shortcodes.def_text + '</p>[/cmsms_icon_list_item]', 
		fields : { 
			// Icon List
			list : { 
				type : 		'multiple', 
				title : 	cmsms_shortcodes.icon_list_title, 
				descr : 	cmsms_shortcodes.icon_list_field_icon_list_descr, 
				def : 		'[cmsms_icon_list_item title="' + cmsms_shortcodes.title + '"]<p>' + cmsms_shortcodes.def_text + '</p>[/cmsms_icon_list_item]', 
				required : 	true, 
				width : 	'half' 
			}, 
			// List Type
			type : { 
				type : 		'radio', 
				title : 	cmsms_shortcodes.icon_list_field_list_type_title, 
				descr : 	cmsms_shortcodes.icon_list_field_list_type_descr, 
				def : 		'block', 
				required : 	true, 
				width : 	'half', 
				choises : { 
							'block' : 	cmsms_shortcodes.icon_list_field_list_type_choice_block, 
							'list' : 	cmsms_shortcodes.icon_list_field_list_type_choice_list 
				} 
			}, 
			// Heading Type
			heading : { 
				type : 		'select', 
				title : 	cmsms_shortcodes.heading_field_type_title, 
				descr : 	cmsms_shortcodes.heading_field_type_descr + "</span>", 
				def : 		'h4', 
				required : 	true, 
				width : 	'half', 
				choises : { 
							'h1' : 	'H1', 
							'h2' : 	'H2', 
							'h3' : 	'H3', 
							'h4' : 	'H4', 
							'h5' : 	'H5', 
							'h6' : 	'H6' 
				}, 
				depend : 	'type:block' 
			}, 
			// List Items Color Type
			items_color_type : { 
				type : 		'radio', 
				title : 	cmsms_shortcodes.icon_list_field_items_color_title, 
				descr : 	cmsms_shortcodes.icon_list_field_items_color_descr, 
				def : 		'border', 
				required : 	true, 
				width : 	'half', 
				choises : { 
							'border' : 	cmsms_shortcodes.icon_list_field_items_color_choice_border, 
							'bg' : 		cmsms_shortcodes.icon_list_field_items_color_choice_bg, 
							'icon' : 	cmsms_shortcodes.icon_list_field_items_color_choice_icon 
				}, 
				depend : 	'type:block' 
			}, 
			// Border Width
			border_width : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.icon_list_field_border_width_title, 
				descr : 	cmsms_shortcodes.icon_list_field_border_width_descr + " <br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.size_note + "</span>", 
				def : 		'10', 
				required : 	true, 
				width : 	'number', 
				min : 		'0', 
				max : 		'20', 
				depend : 	'type:block' 
			}, 
			// Border Radius
			border_radius : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.icon_list_field_border_radius_title, 
				descr : 	cmsms_shortcodes.icon_list_field_border_radius_descr + ' ' + cmsms_shortcodes.value_zero + ". <br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.border_radius_descr_note_1 + " <br />" + cmsms_shortcodes.border_radius_descr_note_2 + " <a href=\"http://www.css3generator.in/border-radius.html\" target=\"_blank\">" + cmsms_shortcodes.border_radius_descr_note_3 + "</a>. <br />" + cmsms_shortcodes.border_radius_descr_note_4 + " <a href=\"http://screencast.com/t/krCXdo0NN\" target=\"_blank\">" + cmsms_shortcodes.border_radius_descr_note_5 + "</a>.</span>", 
				def : 		'50%', 
				required : 	false, 
				depend : 	'type:block' 
			}, 
			// List Items Unifier Width
			unifier_width : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.icon_list_field_items_unifier_title, 
				descr : 	cmsms_shortcodes.icon_list_field_items_unifier_descr + " <br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.size_note_short + ' ' + cmsms_shortcodes.value_zero + "</span>", 
				def : 		'1', 
				required : 	true, 
				width : 	'number', 
				min : 		'0', 
				max : 		'20', 
				depend : 	'type:block' 
			}, 
			// Icon Position
			position : { 
				type : 		'radio', 
				title : 	cmsms_shortcodes.icon_list_field_icon_position_title, 
				descr : 	cmsms_shortcodes.icon_list_field_icon_position_descr + " <br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.icon_list_field_icon_position_descr_note + "</span>", 
				def : 		'left', 
				required : 	false, 
				width : 	'half', 
				choises : { 
							'left' : 	cmsms_shortcodes.position_choice_left_side, 
							'right' : 	cmsms_shortcodes.position_choice_right_side 
				}, 
				depend : 	'type:block' 
			}, 
			// Icon Size
			icon_size : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.icon_list_field_icon_size_title, 
				descr : 	cmsms_shortcodes.icon_list_field_icon_size_descr + " <br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.size_note_short + ' ' + cmsms_shortcodes.value_zero + "</span>", 
				def : 		'30', 
				required : 	true, 
				width : 	'number', 
				min : 		'0' 
			}, 
			// Icon Space
			icon_space : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.icon_list_field_icon_space_title, 
				descr : 	cmsms_shortcodes.icon_list_field_icon_space_descr + " <br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.icon_list_field_icon_space_descr_note + "</span>", 
				def : 		'100', 
				required : 	true, 
				width : 	'number', 
				min : 		'0', 
				depend : 	'type:block' 
			}, 
			// List Item Height
			item_height : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.icon_list_field_item_height_title, 
				descr : 	cmsms_shortcodes.icon_list_field_item_height_descr + " <br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.icon_list_field_item_height_descr_note + "</span>", 
				def : 		'', 
				required : 	true, 
				width : 	'number', 
				min : 		'0', 
				depend : 	'type:list' 
			}, 
			// Default Icon
			icon : { 
				type : 		'icon', 
				title : 	'Default Icon', 
				descr : 	"Choose default icon for your icon list", 
				def : 		'cmsms-icon-thumbs-up-5', 
				required : 	true, 
				width : 	'full', 
				choises : 	cmsms_composer_icons() 
			}, 
			// CSS3 Animation
			animation : { 
				type : 		'select', 
				title : 	cmsms_shortcodes.animation_title, 
				descr : 	cmsms_shortcodes.animation_descr + " <br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.animation_descr_note + "</span>", 
				def : 		'', 
				required : 	false, 
				width : 	'half', 
				choises : 	get_animations() 
			}, 
			// Animation Delay
			animation_delay : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.animation_delay_title, 
				descr : 	cmsms_shortcodes.animation_delay_descr + " <br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.animation_delay_descr_note + "</span>", 
				def : 		'0', 
				required : 	false, 
				width : 	'number', 
				min : 		'0', 
				step : 		'50' 
			}, 
			// Additional Classes
			classes : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.classes_title, 
				descr : 	cmsms_shortcodes.classes_descr, 
				def : 		'', 
				required : 	false, 
				width : 	'half' 
			} 
		} 
	}, 
	
	
	// Image
	cmsms_image : { 
		title : 	cmsms_shortcodes.image_title, 
		icon : 		'admin-icon-image', 
		pair : 		true, 
		content : 	'image', 
		visual : 	'<div><img src="{{ data.image }}" alt="" class="{{ data.align }}" /></div>', 
		multiple : 	false, 
		def : 		cmsms_shortcodes.theme_url + '/framework/admin/inc/img/image.png', 
		fields : { 
			// Image
			image : { 
				type : 			'upload', 
				title : 		cmsms_shortcodes.image_title, 
				descr : 		cmsms_shortcodes.image_field_image_descr, 
				def : 			cmsms_shortcodes.theme_url + '/framework/admin/inc/img/image.png', 
				required : 		true, 
				width : 		'half', 
				frame : 		'post', 
				library : 		'image', 
				multiple : 		false, 
				description : 	false, 
				caption : 		true, 
				align : 		true, 
				link : 			true, 
				size : 			true 
			}, 
			// Image Align
			align : { 
				type : 		'radio', 
				title : 	cmsms_shortcodes.image_field_image_align_title, 
				descr : 	cmsms_shortcodes.image_field_image_align_descr, 
				def : 		'center', 
				required : 	true, 
				width : 	'half', 
				choises : { 
							'left' : 	cmsms_shortcodes.choice_left, 
							'center' : 	cmsms_shortcodes.choice_center, 
							'right' : 	cmsms_shortcodes.choice_right, 
							'none' : 	cmsms_shortcodes.image_field_image_align_choice_none
				}
			}, 
			// Caption
			caption : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.image_field_caption_title, 
				descr : 	cmsms_shortcodes.image_field_caption_descr + " <br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.image_field_caption_descr_note + "</span>", 
				def : 		'', 
				required : 	false, 
				width : 	'half' 
			}, 
			// Image Link
			link : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.image_field_image_link_title, 
				descr : 	cmsms_shortcodes.image_field_image_link_descr + " <br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.image_field_image_link_descr_note + "</span>", 
				def : 		'', 
				required : 	false, 
				width : 	'half' 
			}, 
			// Link Target
			target : { 
				type : 		'checkbox', 
				title : 	cmsms_shortcodes.image_field_link_target_title, 
				descr : 	cmsms_shortcodes.image_field_link_target_descr, 
				def : 		'', 
				required : 	false, 
				width : 	'half', 
				choises : { 
							'true' : 	cmsms_shortcodes.choice_enable 
				}, 
				depend : 	'link:!' 
			}, 
			// Lightbox
			lightbox : { 
				type : 		'checkbox', 
				title : 	cmsms_shortcodes.image_field_link_lightbox_title, 
				descr : 	cmsms_shortcodes.image_field_link_lightbox_descr, 
				def : 		'', 
				required : 	false, 
				width : 	'half', 
				choises : { 
							'true' : 	cmsms_shortcodes.choice_enable 
				}, 
				depend : 	'link:!' 
			}, 
			// CSS3 Animation
			animation : { 
				type : 		'select', 
				title : 	cmsms_shortcodes.animation_title, 
				descr : 	cmsms_shortcodes.animation_descr + " <br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.animation_descr_note + "</span>", 
				def : 		'', 
				required : 	false, 
				width : 	'half', 
				choises : 	get_animations() 
			}, 
			// Animation Delay
			animation_delay : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.animation_delay_title, 
				descr : 	cmsms_shortcodes.animation_delay_descr + " <br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.animation_delay_descr_note + "</span>", 
				def : 		'0', 
				required : 	false, 
				width : 	'number', 
				min : 		'0', 
				step : 		'50' 
			}, 
			// Additional Classes
			classes : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.classes_title, 
				descr : 	cmsms_shortcodes.classes_descr, 
				def : 		'', 
				required : 	false, 
				width : 	'half' 
			} 
		} 
	}, 
	
	
	// Notice
	cmsms_notice : { 
		title : 	cmsms_shortcodes.notice_title, 
		icon : 		'admin-icon-notice', 
		pair : 		true, 
		content : 	'content', 
		visual : 	'<div class="{{ data.type }} {{ data.icon }} {{ data.close }}">{{ data.content }}</div>', 
		multiple : 	false, 
		def : 		"<p>" + cmsms_shortcodes.def_text + "</p>", 
		fields : { 
			// Content
			content : { 
				type : 		'editor', 
				title : 	cmsms_shortcodes.notice_field_content_title, 
				descr : 	"", 
				def : 		"<p>" + cmsms_shortcodes.def_text + "</p>", 
				required : 	true, 
				width : 	'full' 
			}, 
			// Notice Type
			type : { 
				type : 		'select', 
				title : 	cmsms_shortcodes.notice_field_notice_type_title, 
				descr : 	cmsms_shortcodes.notice_field_notice_type_descr, 
				def : 		'cmsms_notice_success', 
				required : 	true, 
				width : 	'half', 
				choises : { 
							'cmsms_notice_success' : 	cmsms_shortcodes.notice_field_notice_type_choice_success, 
							'cmsms_notice_error' : 		cmsms_shortcodes.notice_field_notice_type_choice_error, 
							'cmsms_notice_info' : 		cmsms_shortcodes.notice_field_notice_type_choice_info, 
							'cmsms_notice_warning' : 	cmsms_shortcodes.notice_field_notice_type_choice_warning, 
							'cmsms_notice_download' : 	cmsms_shortcodes.notice_field_notice_type_choice_download, 
							'cmsms_notice_custom' : 	cmsms_shortcodes.notice_field_notice_type_choice_custom 
				} 
			}, 
			// Background Color
			bg_color : { 
				type : 		'color', 
				title : 	cmsms_shortcodes.notice_field_bg_color_title, 
				descr : 	cmsms_shortcodes.notice_field_bg_color_descr, 
				def : 		'#ffffff', 
				required : 	false, 
				width : 	'half', 
				depend : 	'type:cmsms_notice_custom' 
			}, 
			// Border Color
			bd_color : { 
				type : 		'color', 
				title : 	cmsms_shortcodes.notice_field_border_color_title, 
				descr : 	cmsms_shortcodes.notice_field_border_color_descr, 
				def : 		'#dadada', 
				required : 	false, 
				width : 	'half', 
				depend : 	'type:cmsms_notice_custom' 
			}, 
			// Text Color
			color : { 
				type : 		'color', 
				title : 	cmsms_shortcodes.notice_field_txt_color_title, 
				descr : 	cmsms_shortcodes.notice_field_txt_color_descr, 
				def : 		'#000000', 
				required : 	false, 
				width : 	'half', 
				depend : 	'type:cmsms_notice_custom' 
			}, 
			// Close Button
			close : { 
				type : 		'checkbox', 
				title : 	cmsms_shortcodes.notice_field_close_button_title, 
				descr : 	cmsms_shortcodes.notice_field_close_button_descr, 
				def : 		'true', 
				required : 	false, 
				width : 	'half', 
				choises : { 
							'true' : 	'Show' 
				} 
			}, 
			// Notice Icon
			icon : { 
				type : 		'icon', 
				title : 	cmsms_shortcodes.notice_field_notice_icon_title, 
				descr : 	cmsms_shortcodes.notice_field_notice_icon_descr, 
				def : 		'cmsms-icon-check-2', 
				required : 	false, 
				width : 	'full', 
				choises : 	cmsms_composer_icons() 
			}, 
			// CSS3 Animation
			animation : { 
				type : 		'select', 
				title : 	cmsms_shortcodes.animation_title, 
				descr : 	cmsms_shortcodes.animation_descr + " <br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.animation_descr_note + "</span>", 
				def : 		'', 
				required : 	false, 
				width : 	'half', 
				choises : 	get_animations() 
			}, 
			// Animation Delay
			animation_delay : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.animation_delay_title, 
				descr : 	cmsms_shortcodes.animation_delay_descr + " <br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.animation_delay_descr_note + "</span>", 
				def : 		'0', 
				required : 	false, 
				width : 	'number', 
				min : 		'0', 
				step : 		'50' 
			}, 
			// Additional Classes
			classes : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.classes_title, 
				descr : 	cmsms_shortcodes.classes_descr, 
				def : 		'', 
				required : 	false, 
				width : 	'half' 
			} 
		} 
	}, 
	
	
	// Portfolio
	cmsms_portfolio : { 
		title : 	cmsms_shortcodes.portfolio_title, 
		icon : 		'admin-icon-portfolio', 
		pair : 		false, 
		content : 	false, 
		visual : 	false, 
		multiple : 	false, 
		def : 		'', 
		fields : { 
			// Order By
			orderby : { 
				type : 		'select', 
				title : 	cmsms_shortcodes.orderby_title, 
				descr : 	cmsms_shortcodes.portfolio_field_orderby_descr, 
				def : 		'date', 
				required : 	true, 
				width : 	'half', 
				choises : { 
							'date' : 		cmsms_shortcodes.choice_date, 
							'name' : 		cmsms_shortcodes.name, 
							'id' : 			cmsms_shortcodes.choice_id, 
							'menu_order' : 	cmsms_shortcodes.choice_menu, 
							'popular' : 	cmsms_shortcodes.choice_popular 
				} 
			}, 
			// Order
			order : { 
				type : 		'radio', 
				title : 	cmsms_shortcodes.order_title, 
				descr : 	cmsms_shortcodes.order_descr, 
				def : 		'DESC', 
				required : 	true, 
				width : 	'half', 
				choises : { 
							'ASC' : 	cmsms_shortcodes.choice_asc, 
							'DESC' : 	cmsms_shortcodes.choice_desc
				} 
			}, 
			// Projects Number
			count : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.portfolio_field_pj_number_title, 
				descr : 	cmsms_shortcodes.portfolio_field_pj_number_descr + "<br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.portfolio_field_pj_number_descr_note + "</span>", 
				def : 		'10', 
				required : 	false, 
				width : 	'number', 
				min : 		'1' 
			}, 
			// Categories
			categories : { 
				type : 		'select_multiple', 
				title : 	cmsms_shortcodes.categories, 
				descr : 	cmsms_shortcodes.portfolio_field_categories_descr + "<br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.portfolio_field_categories_descr_note + "</span>", 
				def : 		'', 
				required : 	false, 
				width : 	'half', 
				choises : 	cmsms_composer_pj_categories() 
			}, 
			// Layout
			layout : { 
				type : 		'radio', 
				title : 	cmsms_shortcodes.layout_title, 
				descr : 	cmsms_shortcodes.portfolio_field_layout_descr, 
				def : 		'grid', 
				required : 	true, 
				width : 	'half', 
				choises : { 
							'grid' : 	cmsms_shortcodes.portfolio_field_layout_choice_grid, 
							'puzzle' : 	cmsms_shortcodes.portfolio_field_layout_choice_puzzle 
				} 
			}, 
			// Layout Mode
			layout_mode : { 
				type : 		'radio', 
				title : 	cmsms_shortcodes.portfolio_field_layout_mode_title, 
				descr : 	cmsms_shortcodes.portfolio_field_layout_mode_descr, 
				def : 		'perfect', 
				required : 	false, 
				width : 	'half', 
				choises : { 
							'perfect' : 	cmsms_shortcodes.portfolio_field_layout_mode_choice_perfect, 
							'masonry' : 	cmsms_shortcodes.portfolio_field_layout_mode_choice_masonry 
				}, 
				depend : 	'layout:grid' 
			}, 
			// Columns Count
			columns : { 
				type : 		'select', 
				title : 	cmsms_shortcodes.columns_count, 
				descr : 	cmsms_shortcodes.portfolio_field_col_count_descr + "<br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.portfolio_field_col_count_descr_note + "<br />" + cmsms_shortcodes.portfolio_field_col_count_descr_note_custom + "</span>", 
				def : 		'4', 
				required : 	false, 
				width : 	'half', 
				choises : { 
							'1' : 	'1', 
							'2' : 	'2', 
							'3' : 	'3', 
							'4' : 	'4', 
							'5' : 	'5' 
				}, 
				depend : 	'layout:grid' 
			}, 
			// Metadata
			metadata : { 
				type : 		'checkbox', 
				title : 	cmsms_shortcodes.portfolio_field_metadata_title, 
				descr : 	cmsms_shortcodes.portfolio_field_metadata_descr, 
				def : 		'title,categories,rollover', 
				required : 	true, 
				width : 	'half', 
				choises : { 
							'title' : 		cmsms_shortcodes.choice_title, 
							'excerpt' : 	cmsms_shortcodes.choice_excerpt, 
							'categories' : 	cmsms_shortcodes.choice_categories, 
							'comments' : 	cmsms_shortcodes.choice_comments, 
							'likes' : 		cmsms_shortcodes.choice_likes, 
							'rollover' : 	cmsms_shortcodes.choice_rollover 
				} 
			}, 
			// Gap
			gap : { 
				type : 		'radio', 
				title : 	cmsms_shortcodes.portfolio_field_gap_title, 
				descr : 	cmsms_shortcodes.portfolio_field_gap_descr, 
				def : 		'large', 
				required : 	false, 
				width : 	'half', 
				choises : { 
							'large' : 	cmsms_shortcodes.portfolio_field_gap_choice_large, 
							'small' : 	cmsms_shortcodes.portfolio_field_gap_choice_small, 
							'zero' : 	cmsms_shortcodes.portfolio_field_gap_choice_zero 
				} 
			}, 
			// Filter
			filter : { 
				type : 		'checkbox', 
				title : 	cmsms_shortcodes.filter, 
				descr : 	cmsms_shortcodes.portfolio_field_filter_descr, 
				def : 		'true', 
				required : 	false, 
				width : 	'half', 
				choises : { 
							'true' : 	cmsms_shortcodes.choice_enable 
				} 
			}, 
			// Filter Button Text
			filter_text : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.filter_text_title, 
				descr : 	cmsms_shortcodes.filter_text_descr + "<br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.filter_text_descr_note + "</span>", 
				def : 		'', 
				required : 	false, 
				width : 	'half', 
				depend : 	'filter:true' 
			}, 
			// Filter 'All Categories' Text
			filter_cats_text : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.filter_cats_text_title, 
				descr : 	cmsms_shortcodes.filter_cats_text_descr + "<br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.filter_cats_text_descr_note + "</span>", 
				def : 		'', 
				required : 	false, 
				width : 	'half', 
				depend : 	'filter:true' 
			}, 
			// Sorting
			sorting : { 
				type : 		'checkbox', 
				title : 	cmsms_shortcodes.portfolio_field_sorting_title, 
				descr : 	cmsms_shortcodes.portfolio_field_sorting_descr, 
				def : 		'true', 
				required : 	false, 
				width : 	'half', 
				choises : { 
							'true' : 	cmsms_shortcodes.choice_enable 
				}, 
				depend : 	'layout:grid' 
			}, 
			// Sorting By Name Button Text
			sorting_name_text : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.sorting_name_text_title, 
				descr : 	cmsms_shortcodes.sorting_name_text_descr + "<br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.sorting_name_text_descr_note + ". <br />" + cmsms_shortcodes.sorting_enabled_text_descr_note + "</span>", 
				def : 		'', 
				required : 	false, 
				width : 	'half', 
				depend : 	'layout:grid' 
			}, 
			// Sorting By Date Button Text
			sorting_date_text : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.sorting_date_text_title, 
				descr : 	cmsms_shortcodes.sorting_date_text_descr + "<br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.sorting_date_text_descr_note + ". <br />" + cmsms_shortcodes.sorting_enabled_text_descr_note + "</span>", 
				def : 		'', 
				required : 	false, 
				width : 	'half', 
				depend : 	'layout:grid' 
			}, 
			// Pagination
			pagination : { 
				type : 		'radio', 
				title : 	cmsms_shortcodes.pagination_title, 
				descr : 	cmsms_shortcodes.pagination_descr, 
				def : 		'pagination', 
				required : 	false, 
				width : 	'half', 
				choises : { 
							'pagination' : 	cmsms_shortcodes.pagination_choice_pagination, 
							'more' : 		cmsms_shortcodes.pagination_choice_more, 
							'disabled' : 	cmsms_shortcodes.pagination_choice_disabled 
				} 
			}, 
			// 'Load More' Button Text
			more_text : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.pagination_more_text_title, 
				descr : 	cmsms_shortcodes.pagination_more_text_descr + "<br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.pagination_more_text_descr_note + "</span>", 
				def : 		'', 
				required : 	false, 
				width : 	'half', 
				depend : 	'pagination:more' 
			}, 
			// Additional Classes
			classes : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.classes_title, 
				descr : 	cmsms_shortcodes.classes_descr, 
				def : 		'', 
				required : 	false, 
				width : 	'half' 
			} 
		} 
	}, 
	
	
	// Posts Slider
	cmsms_posts_slider : { 
		title : 	cmsms_shortcodes.posts_slider_title, 
		icon : 		'admin-icon-post-slider', 
		pair : 		false, 
		content : 	false, 
		visual : 	false, 
		multiple : 	false, 
		def : 		'', 
		fields : { 
			// Order By
			orderby : { 
				type : 		'select', 
				title : 	cmsms_shortcodes.orderby_title, 
				descr : 	cmsms_shortcodes.posts_slider_field_orderby_descr, 
				def : 		'date', 
				required : 	true, 
				width : 	'half', 
				choises : { 
							'date' : 		cmsms_shortcodes.choice_date, 
							'name' : 		cmsms_shortcodes.name, 
							'id' : 			cmsms_shortcodes.choice_id, 
							'menu_order' : 	cmsms_shortcodes.choice_menu, 
							'popular' : 	cmsms_shortcodes.choice_popular, 
							'rand' : 		cmsms_shortcodes.choice_rand 
				} 
			}, 
			// Order
			order : { 
				type : 		'radio', 
				title : 	cmsms_shortcodes.order_title, 
				descr : 	cmsms_shortcodes.order_descr, 
				def : 		'DESC', 
				required : 	true, 
				width : 	'half', 
				choises : { 
							'ASC' : 	cmsms_shortcodes.choice_asc, 
							'DESC' : 	cmsms_shortcodes.choice_desc 
				} 
			}, 
			// Posts Type
			post_type : { 
				type : 		'radio', 
				title : 	cmsms_shortcodes.posts_slider_field_poststype_title, 
				descr : 	cmsms_shortcodes.posts_slider_field_poststype_descr, 
				def : 		'post', 
				required : 	true, 
				width : 	'half', 
				choises : { 
							'post' : 		cmsms_shortcodes.posts_slider_field_poststype_choice_post, 
							'project' : 	cmsms_shortcodes.posts_slider_field_poststype_choice_project 
				} 
			}, 
			// Posts Categories
			blog_categories : { 
				type : 		'select_multiple', 
				title : 	cmsms_shortcodes.posts_slider_field_postscateg_title, 
				descr : 	cmsms_shortcodes.posts_slider_field_postscateg_descr + "<br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.posts_slider_field_postscateg_descr_note + "</span>", 
				def : 		'', 
				required : 	false, 
				width : 	'half', 
				choises : 	cmsms_composer_categories(), 
				depend : 	'post_type:post' 
			}, 
			// Projects Categories
			portfolio_categories : { 
				type : 		'select_multiple', 
				title : 	cmsms_shortcodes.posts_slider_field_pjcateg_title, 
				descr : 	cmsms_shortcodes.posts_slider_field_pjcateg_descr + "<br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.posts_slider_field_pjcateg_descr_note + "</span>", 
				def : 		'', 
				required : 	false, 
				width : 	'half', 
				choises : 	cmsms_composer_pj_categories(), 
				depend : 	'post_type:project' 
			}, 
			// Columns Count
			columns : { 
				type : 		'select', 
				title : 	cmsms_shortcodes.columns_count, 
				descr : 	cmsms_shortcodes.posts_slider_field_col_count_descr, 
				def : 		'4', 
				required : 	false, 
				width : 	'half', 
				choises : { 
							'1' : 	'1', 
							'2' : 	'2', 
							'3' : 	'3', 
							'4' : 	'4' 
				} 
			}, 
			// Posts Number
			count : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.posts_slider_field_postsnumber_title, 
				descr : 	cmsms_shortcodes.posts_slider_field_postsnumber_descr + "<br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.posts_slider_field_postsnumber_descr_note + "</span>", 
				def : 		'12', 
				required : 	false, 
				width : 	'number', 
				min : 		'1' 
			}, 
			// Pause Time
			pause : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.posts_slider_field_pausetime_title, 
				descr : 	cmsms_shortcodes.posts_slider_field_pausetime_descr + "<br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.posts_slider_field_pausetime_descr_note + "</span>", 
				def : 		'5', 
				required : 	false, 
				width : 	'number', 
				min : 		'0' 
			}, 
			// Posts Metadata
			blog_metadata : { 
				type : 		'checkbox', 
				title : 	cmsms_shortcodes.posts_slider_field_postsmeta_title, 
				descr : 	cmsms_shortcodes.posts_slider_field_postsmeta_descr, 
				def : 		'title,date,categories,comments,likes', 
				required : 	true, 
				width : 	'half', 
				choises : { 
							'title' : 		cmsms_shortcodes.choice_title, 
							'excerpt' : 	cmsms_shortcodes.choice_excerpt, 
							'date' : 		cmsms_shortcodes.choice_date, 
							'categories' : 	cmsms_shortcodes.choice_categories, 
							'author' : 		cmsms_shortcodes.choice_author, 
							'comments' : 	cmsms_shortcodes.choice_comments, 
							'likes' : 		cmsms_shortcodes.choice_likes 
				}, 
				depend : 	'post_type:post' 
			}, 
			// Projects Metadata
			portfolio_metadata : { 
				type : 		'checkbox', 
				title : 	cmsms_shortcodes.posts_slider_field_pjmeta_title, 
				descr : 	cmsms_shortcodes.posts_slider_field_pjmeta_descr, 
				def : 		'title,categories,likes', 
				required : 	true, 
				width : 	'half', 
				choises : { 
							'title' : 		cmsms_shortcodes.choice_title, 
							'excerpt' : 	cmsms_shortcodes.choice_excerpt, 
							'categories' : 	cmsms_shortcodes.choice_categories, 
							'comments' : 	cmsms_shortcodes.choice_comments, 
							'likes' : 		cmsms_shortcodes.choice_likes 
				}, 
				depend : 	'post_type:project' 
			}, 
			// CSS3 Animation
			animation : { 
				type : 		'select', 
				title : 	cmsms_shortcodes.animation_title, 
				descr : 	cmsms_shortcodes.animation_descr + " <br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.animation_descr_note + "</span>", 
				def : 		'', 
				required : 	false, 
				width : 	'half', 
				choises : 	get_animations() 
			}, 
			// Animation Delay
			animation_delay : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.animation_delay_title, 
				descr : 	cmsms_shortcodes.animation_delay_descr + " <br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.animation_delay_descr_note + "</span>", 
				def : 		'0', 
				required : 	false, 
				width : 	'number', 
				min : 		'0', 
				step : 		'50' 
			}, 
			// Additional Classes
			classes : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.classes_title, 
				descr : 	cmsms_shortcodes.classes_descr, 
				def : 		'', 
				required : 	false, 
				width : 	'half' 
			} 
		} 
	}, 
	
	
	// Pricing Table Items
	cmsms_pricing_table_items : { 
		title : 	cmsms_shortcodes.pricing_title, 
		icon : 		'admin-icon-price', 
		pair : 		true, 
		content : 	'offers', 
		visual : 	false, 
		multiple : 	true, 
		def : 		'[cmsms_pricing_table_item currency="$" price="99"]' + cmsms_shortcodes.title + '[/cmsms_pricing_table_item]', 
		fields : { 
			// Offers
			offers : { 
				type : 		'multiple', 
				title : 	cmsms_shortcodes.pricing_field_offers_title, 
				descr : 	cmsms_shortcodes.pricing_field_offers_descr, 
				def : 		'[cmsms_pricing_table_item currency="$" price="99"]' + cmsms_shortcodes.title + '[/cmsms_pricing_table_item]', 
				required : 	true, 
				width : 	'half' 
			}, 
			// Columns Count
			columns : { 
				type : 		'select',   
				title : 	cmsms_shortcodes.columns_count, 
				descr : 	cmsms_shortcodes.pricing_field_col_count_descr, 
				def : 		'4', 
				required : 	false, 
				width : 	'half', 
				choises : { 
							'1' : 	'1', 
							'2' : 	'2', 
							'3' : 	'3', 
							'4' : 	'4' 
				} 
			}, 
			// CSS3 Animation
			animation : { 
				type : 		'select', 
				title : 	cmsms_shortcodes.animation_title, 
				descr : 	cmsms_shortcodes.animation_descr + " <br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.animation_descr_note + "</span>", 
				def : 		'', 
				required : 	false, 
				width : 	'half', 
				choises : 	get_animations() 
			}, 
			// Animation Delay
			animation_delay : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.animation_delay_title, 
				descr : 	cmsms_shortcodes.animation_delay_descr + " <br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.animation_delay_descr_note + "</span>", 
				def : 		'0', 
				required : 	false, 
				width : 	'number', 
				min : 		'0', 
				step : 		'50' 
			}, 
			// Additional Classes
			classes : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.classes_title, 
				descr : 	cmsms_shortcodes.classes_descr, 
				def : 		'', 
				required : 	false, 
				width : 	'half' 
			} 
		} 
	}, 
	
	
	// Profiles
	cmsms_profiles : { 
		title : 	cmsms_shortcodes.profiles_title, 
		icon : 		'admin-icon-profiles', 
		pair : 		false, 
		content : 	false, 
		visual : 	false, 
		multiple : 	false, 
		def : 		'', 
		fields : { 
			// Order By
			orderby : { 
				type : 		'select', 
				title : 	cmsms_shortcodes.orderby_title, 
				descr : 	cmsms_shortcodes.profiles_field_orderby_descr, 
				def : 		'date', 
				required : 	true, 
				width : 	'half', 
				choises : { 
							'date' : 		cmsms_shortcodes.choice_date, 
							'name' : 		cmsms_shortcodes.name, 
							'id' : 			cmsms_shortcodes.choice_id, 
							'menu_order' : 	cmsms_shortcodes.choice_menu, 
							'rand' : 		cmsms_shortcodes.choice_rand 
				} 
			}, 
			// Order
			order : { 
				type : 		'radio', 
				title : 	cmsms_shortcodes.order_title, 
				descr : 	cmsms_shortcodes.order_descr, 
				def : 		'DESC', 
				required : 	true, 
				width : 	'half', 
				choises : { 
							'ASC' : 	cmsms_shortcodes.choice_asc, 
							'DESC' : 	cmsms_shortcodes.choice_desc
				} 
			}, 
			// Profiles Number
			count : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.profiles_field_profiles_number_title, 
				descr : 	cmsms_shortcodes.profiles_field_profiles_number_descr + "<br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.profiles_field_profiles_number_descr_note + "</span>", 
				def : 		'4', 
				required : 	false, 
				width : 	'number', 
				min : 		'1' 
			}, 
			// Categories
			categories : { 
				type : 		'select_multiple', 
				title : 	cmsms_shortcodes.categories, 
				descr : 	cmsms_shortcodes.profiles_field_categories_descr + "<br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.profiles_field_categories_descr_note + "</span>", 
				def : 		'', 
				required : 	false, 
				width : 	'half', 
				choises : 	cmsms_composer_pl_categories() 
			}, 
			// Layout
			layout : { 
				type : 		'radio', 
				title : 	cmsms_shortcodes.layout_title, 
				descr : 	cmsms_shortcodes.profiles_field_layout_descr, 
				def : 		'vertical', 
				required : 	true, 
				width : 	'half', 
				choises : { 
							'vertical' : 	cmsms_shortcodes.choice_vertical, 
							'horizontal' : 	cmsms_shortcodes.choice_horizontal 
				} 
			}, 
			// Columns Count
			columns : { 
				type : 		'select', 
				title : 	cmsms_shortcodes.columns_count, 
				descr : 	cmsms_shortcodes.profiles_field_col_count_descr, 
				def : 		'4', 
				required : 	false, 
				width : 	'half', 
				choises : { 
							'1' : 	'1', 
							'2' : 	'2', 
							'3' : 	'3', 
							'4' : 	'4' 
				}, 
				depend : 	'layout:horizontal' 
			}, 
			// CSS3 Animation
			animation : { 
				type : 		'select', 
				title : 	cmsms_shortcodes.animation_title, 
				descr : 	cmsms_shortcodes.animation_descr + " <br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.animation_descr_note + "</span>", 
				def : 		'', 
				required : 	false, 
				width : 	'half', 
				choises : 	get_animations() 
			}, 
			// Animation Delay
			animation_delay : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.animation_delay_title, 
				descr : 	cmsms_shortcodes.animation_delay_descr + " <br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.animation_delay_descr_note + "</span>", 
				def : 		'0', 
				required : 	false, 
				width : 	'number', 
				min : 		'0', 
				step : 		'50' 
			}, 
			// Additional Classes
			classes : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.classes_title, 
				descr : 	cmsms_shortcodes.classes_descr, 
				def : 		'', 
				required : 	false, 
				width : 	'half' 
			} 
		} 
	}, 
	
	
	// Progress Bars
	cmsms_stats : { 
		title : 	cmsms_shortcodes.prog_bars_title, 
		icon : 		'admin-icon-stats', 
		pair : 		true, 
		content : 	'stats', 
		visual : 	false, 
		multiple : 	true, 
		def : 		'[cmsms_stat progress="50"]' + cmsms_shortcodes.title + '[/cmsms_stat]', 
		fields : { 
			// Progress Bars
			stats : { 
				type : 		'multiple', 
				title : 	cmsms_shortcodes.prog_bars_title, 
				descr : 	cmsms_shortcodes.prog_bars_field_prog_bars_descr, 
				def : 		'[cmsms_stat progress="50"]' + cmsms_shortcodes.title + '[/cmsms_stat]', 
				required : 	true, 
				width : 	'half' 
			}, 
			// Mode
			mode : { 
				type : 		'radio', 
				title : 	cmsms_shortcodes.mode, 
				descr : 	cmsms_shortcodes.prog_bars_field_mode_descr, 
				def : 		'bars', 
				required : 	true, 
				width : 	'half', 
				choises : { 
							'bars' : 		cmsms_shortcodes.prog_bars_field_mode_choice_bars, 
							'counters' : 	cmsms_shortcodes.prog_bars_field_mode_choice_counters 
				} 
			}, 
			// Counters Type
			type : { 
				type : 		'radio', 
				title : 	cmsms_shortcodes.prog_bars_field_counters_type_title, 
				descr : 	cmsms_shortcodes.prog_bars_field_counters_type_descr, 
				def : 		'circles', 
				required : 	false, 
				width : 	'half', 
				choises : { 
							'circles' : 	cmsms_shortcodes.prog_bars_field_counters_type_choice_circ, 
							'numbers' : 	cmsms_shortcodes.prog_bars_field_counters_type_choice_numb 
				}, 
				depend : 	'mode:counters' 
			}, 
			// Numbers Border
			border : { 
				type : 		'checkbox', 
				title : 	cmsms_shortcodes.prog_bars_field_border_title, 
				descr : 	cmsms_shortcodes.prog_bars_field_border_descr, 
				def : 		'true', 
				required : 	false, 
				width : 	'half', 
				choises : { 
							'true' : 	cmsms_shortcodes.choice_enable 
				}, 
				depend : 	'type:numbers' 
			}, 
			// Number per Row
			count : { 
				type : 		'select', 
				title : 	cmsms_shortcodes.prog_bars_field_number_per_row_title, 
				descr : 	cmsms_shortcodes.prog_bars_field_number_per_row_descr + " <br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.prog_bars_field_number_per_row_descr_note + "</span>", 
				def : 		'4', 
				required : 	false, 
				width : 	'half', 
				choises : { 
							'4' : 	'4', 
							'3' : 	'3', 
							'2' : 	'2', 
							'1' : 	'1' 
				}, 
				depend : 	'mode:counters' 
			}, 
			// CSS3 Animation
			animation : { 
				type : 		'select', 
				title : 	cmsms_shortcodes.animation_title, 
				descr : 	cmsms_shortcodes.animation_descr + " <br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.animation_descr_note + "</span>", 
				def : 		'', 
				required : 	false, 
				width : 	'half', 
				choises : 	get_animations() 
			}, 
			// Animation Delay
			animation_delay : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.animation_delay_title, 
				descr : 	cmsms_shortcodes.animation_delay_descr + " <br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.animation_delay_descr_note + "</span>", 
				def : 		'0', 
				required : 	false, 
				width : 	'number', 
				min : 		'0', 
				step : 		'50' 
			}, 
			// Additional Classes
			classes : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.classes_title, 
				descr : 	cmsms_shortcodes.classes_descr, 
				def : 		'', 
				required : 	false, 
				width : 	'half' 
			} 
		} 
	}, 
	
	
	// Quotes
	cmsms_quotes : { 
		title : 	cmsms_shortcodes.quotes_title, 
		icon : 		'admin-icon-quotes', 
		pair : 		true, 
		content : 	'quotes', 
		visual : 	false, 
		multiple : 	true, 
		def : 		'[cmsms_quote name="Name"]' + "<p>" + cmsms_shortcodes.def_text + "</p>" + '[/cmsms_quote]', 
		fields : { 
			// Quotes
			quotes : { 
				type : 		'multiple', 
				title : 	cmsms_shortcodes.quotes_title, 
				descr : 	"Here you can add, edit, remove or sort quotes", 
				def : 		'[cmsms_quote name="Name"]' + "<p>" + cmsms_shortcodes.def_text + "</p>" + '[/cmsms_quote]', 
				required : 	true, 
				width : 	'half' 
			}, 
			// Mode
			mode : { 
				type : 		'radio', 
				title : 	cmsms_shortcodes.mode, 
				descr : 	cmsms_shortcodes.quotes_field_mode_descr, 
				def : 		'grid', 
				required : 	true, 
				width : 	'half', 
				choises : { 
							'grid' : 	cmsms_shortcodes.quotes_field_mode_choice_grid, 
							'slider' : 	cmsms_shortcodes.quotes_field_mode_choice_slider 
				} 
			}, 
			// Columns Count
			columns : { 
				type : 		'select', 
				title : 	cmsms_shortcodes.columns_count, 
				descr : 	cmsms_shortcodes.quotes_field_col_count_descr, 
				def : 		'2', 
				required : 	false, 
				width : 	'half', 
				choises : { 
							'1' : 	'1', 
							'2' : 	'2', 
							'3' : 	'3', 
							'4' : 	'4' 
				}, 
				depend : 	'mode:grid' 
			}, 
			// Pause Time
			speed : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.quotes_field_slideshow_speed_title, 
				descr : 	cmsms_shortcodes.quotes_field_slideshow_speed_descr + " <br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.quotes_field_slideshow_speed_descr_note + "</span>", 
				def : 		'5', 
				required : 	false, 
				width : 	'number', 
				min : 		'0', 
				depend : 	'mode:slider' 
			}, 
			// CSS3 Animation
			animation : { 
				type : 		'select', 
				title : 	cmsms_shortcodes.animation_title, 
				descr : 	cmsms_shortcodes.animation_descr + " <br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.animation_descr_note + "</span>", 
				def : 		'', 
				required : 	false, 
				width : 	'half', 
				choises : 	get_animations() 
			}, 
			// Animation Delay
			animation_delay : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.animation_delay_title, 
				descr : 	cmsms_shortcodes.animation_delay_descr + " <br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.animation_delay_descr_note + "</span>", 
				def : 		'0', 
				required : 	false, 
				width : 	'number', 
				min : 		'0', 
				step : 		'50' 
			}, 
			// Additional Classes
			classes : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.classes_title, 
				descr : 	cmsms_shortcodes.classes_descr, 
				def : 		'', 
				required : 	false, 
				width : 	'half' 
			} 
		} 
	}, 
	
	
	// Sidebar
	cmsms_sidebar : { 
		title : 	cmsms_shortcodes.sidebar_title, 
		icon : 		'admin-icon-sidebar', 
		pair : 		false, 
		content : 	false, 
		visual : 	false, 
		multiple : 	false, 
		def : 		"", 
		fields : { 
			// Sidebar
			sidebar : { 
				type : 		'select', 
				title : 	cmsms_shortcodes.sidebar_title, 
				descr : 	cmsms_shortcodes.sidebar_field_sidebar_descr + "<br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.sidebar_field_sidebar_descr_note + '<a href=\"' + cmsms_shortcodes.admin_url + 'admin.php?page=cmsms-settings&tab=sidebar\" target=\"_blank\">' + ' ' + cmsms_shortcodes.sidebar_field_sidebar_descr_note_link + "</a></span>", 
				def : 		'', 
				required : 	true, 
				width : 	'half', 
				choises : 	cmsms_composer_sidebars() 
			}, 
			// Sidebar Layout
			layout : { 
				type : 		'select', 
				title : 	cmsms_shortcodes.sidebar_field_sidebar_layout_title, 
				descr : 	cmsms_shortcodes.sidebar_field_sidebar_layout_descr + "<br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.sidebar_field_sidebar_layout_descr_note + "</span>", 
				def : 		'', 
				required : 	false, 
				width : 	'half', 
				choises : 	get_layouts() 
			}, 
			// Additional Classes
			classes : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.classes_title, 
				descr : 	cmsms_shortcodes.classes_descr, 
				def : 		'', 
				required : 	false, 
				width : 	'half' 
			} 
		} 
	}, 
	
	
	// Slider
	cmsms_slider : { 
		title : 	cmsms_shortcodes.slider_title, 
		icon : 		'admin-icon-slider', 
		pair : 		false, 
		content : 	false, 
		visual : 	false, 
		multiple : 	false, 
		def : 		"", 
		fields : { 
			// Slider Plugin
			slider_plugin : { 
				type : 		'radio', 
				title : 	cmsms_shortcodes.slider_field_plugin_title, 
				descr : 	cmsms_shortcodes.slider_field_plugin_descr + " <br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.slider_field_plugin_descr_note + "</span>", 
				def : 		'layer', 
				required : 	true, 
				width : 	'half', 
				choises : { 
							'layer' : 	cmsms_shortcodes.slider_layer, 
							'rev' : 	cmsms_shortcodes.slider_rev 
				} 
			}, 
			// Layer Slider Name
			slider_layer : { 
				type : 		'select', 
				title : 	cmsms_shortcodes.slider_field_layer_id_title, 
				descr : 	cmsms_shortcodes.slider_field_layer_id_descr, 
				def : 		'', 
				required : 	true, 
				width : 	'half', 
				choises : 	cmsms_composer_layer_slider(), 
				depend : 	'slider_plugin:layer' 
			}, 
			// Revolution Slider Name
			slider_rev : { 
				type : 		'select', 
				title : 	cmsms_shortcodes.slider_field_rev_id_title, 
				descr : 	cmsms_shortcodes.slider_field_rev_id_descr, 
				def : 		'', 
				required : 	true, 
				width : 	'half', 
				choises : 	cmsms_composer_rev_slider(), 
				depend : 	'slider_plugin:rev' 
			}, 
			// Additional Classes
			classes : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.classes_title, 
				descr : 	cmsms_shortcodes.classes_descr, 
				def : 		'', 
				required : 	false, 
				width : 	'half' 
			} 
		} 
	}, 
	
	
	// Social Sharing
	cmsms_social : { 
		title : 	cmsms_shortcodes.social_sharing_title, 
		icon : 		'admin-icon-social', 
		pair : 		false, 
		content : 	false, 
		visual : 	false, 
		multiple : 	false, 
		def : 		"", 
		fields : { 
			// Facebook Like Button
			facebook : { 
				type : 		'checkbox', 
				title : 	cmsms_shortcodes.social_sharing_field_fb_button_title, 
				descr : 	cmsms_shortcodes.social_sharing_field_fb_button_descr, 
				def : 		'true', 
				required : 	false, 
				width : 	'half', 
				choises : { 
							'true' : 	cmsms_shortcodes.choice_show 
				} 
			}, 
			// Twitter Tweet Button
			twitter : { 
				type : 		'checkbox', 
				title : 	cmsms_shortcodes.social_sharing_field_twitter_button_title, 
				descr : 	cmsms_shortcodes.social_sharing_field_twitter_button_descr, 
				def : 		'true', 
				required : 	false, 
				width : 	'half', 
				choises : { 
							'true' : 	cmsms_shortcodes.choice_show 
				} 
			}, 
			// GooglePlus +1 Button
			google : { 
				type : 		'checkbox', 
				title : 	cmsms_shortcodes.social_sharing_field_googleplus_button_title, 
				descr : 	cmsms_shortcodes.social_sharing_field_googleplus_button_descr, 
				def : 		'true', 
				required : 	false, 
				width : 	'half', 
				choises : { 
							'true' : 	cmsms_shortcodes.choice_show 
				} 
			}, 
			// Pinterest Pin it Button
			pinterest : { 
				type : 		'checkbox', 
				title : 	cmsms_shortcodes.social_sharing_field_pinterest_button_title, 
				descr : 	cmsms_shortcodes.social_sharing_field_pinterest_button_descr, 
				def : 		'true', 
				required : 	false, 
				width : 	'half', 
				choises : { 
							'true' : 	cmsms_shortcodes.choice_show 
				} 
			}, 
			// Buttons Type
			type : { 
				type : 		'radio', 
				title : 	cmsms_shortcodes.social_sharing_field_buttons_type_title, 
				descr : 	cmsms_shortcodes.social_sharing_field_buttons_type_descr, 
				def : 		'horizontal', 
				required : 	false, 
				width : 	'half', 
				choises : { 
							'horizontal' : 	cmsms_shortcodes.choice_horizontal, 
							'vertical' : 	cmsms_shortcodes.choice_vertical 
				} 
			}, 
			// CSS3 Animation
			animation : { 
				type : 		'select', 
				title : 	cmsms_shortcodes.animation_title, 
				descr : 	cmsms_shortcodes.animation_descr + " <br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.animation_descr_note + "</span>", 
				def : 		'', 
				required : 	false, 
				width : 	'half', 
				choises : 	get_animations() 
			}, 
			// Animation Delay
			animation_delay : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.animation_delay_title, 
				descr : 	cmsms_shortcodes.animation_delay_descr + " <br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.animation_delay_descr_note + "</span>", 
				def : 		'0', 
				required : 	false, 
				width : 	'number', 
				min : 		'0', 
				step : 		'50' 
			}, 
			// Additional Classes
			classes : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.classes_title, 
				descr : 	cmsms_shortcodes.classes_descr, 
				def : 		'', 
				required : 	false, 
				width : 	'half' 
			} 
		} 
	}, 
	
	
	// Table
	cmsms_table : { 
		title : 	cmsms_shortcodes.table_title, 
		icon : 		'admin-icon-table', 
		pair : 		true, 
		content : 	'table', 
		visual : 	false, 
		multiple : 	false, 
		def : 		'', 
		fields : { 
			// Table Content
			table : { 
				type : 		'table', 
				title : 	cmsms_shortcodes.table_field_table_content_title, 
				descr : 	cmsms_shortcodes.table_field_table_content_descr, 
				def : 		'[cmsms_tr][cmsms_td][/cmsms_td][cmsms_td][/cmsms_td][cmsms_td][/cmsms_td][/cmsms_tr][cmsms_tr][cmsms_td][/cmsms_td][cmsms_td][/cmsms_td][cmsms_td][/cmsms_td][/cmsms_tr][cmsms_tr][cmsms_td][/cmsms_td][cmsms_td][/cmsms_td][cmsms_td][/cmsms_td][/cmsms_tr]', 
				required : 	true, 
				width : 	'full' 
			}, 
			// Table Caption
			caption : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.table_field_table_caption_title, 
				descr : 	cmsms_shortcodes.table_field_table_caption_descr, 
				def : 		'', 
				required : 	false, 
				width : 	'half' 
			}, 
			// CSS3 Animation
			animation : { 
				type : 		'select', 
				title : 	cmsms_shortcodes.animation_title, 
				descr : 	cmsms_shortcodes.animation_descr + " <br /><span>" + cmsms_shortcodes.note  + ' ' + cmsms_shortcodes.animation_descr_note + "</span>", 
				def : 		'', 
				required : 	false, 
				width : 	'half', 
				choises : 	get_animations() 
			}, 
			// Animation Delay
			animation_delay : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.animation_delay_title, 
				descr : 	cmsms_shortcodes.animation_delay_descr + " <br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.animation_delay_descr_note + "</span>", 
				def : 		'0', 
				required : 	false, 
				width : 	'number', 
				min : 		'0', 
				step : 		'50' 
			}, 
			// Additional Classes
			classes : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.classes_title, 
				descr : 	cmsms_shortcodes.classes_descr, 
				def : 		'', 
				required : 	false, 
				width : 	'half' 
			} 
		} 
	}, 
	
	
	// Tabs
	cmsms_tabs : { 
		title : 	cmsms_shortcodes.tabs_title, 
		icon : 		'admin-icon-tabs', 
		pair : 		true, 
		content : 	'tabs', 
		visual : 	false, 
		multiple : 	true, 
		def : 		'[cmsms_tab title="' + cmsms_shortcodes.title + '"]<p>' + cmsms_shortcodes.def_text + '</p>[/cmsms_tab]', 
		fields : { 
			// Tabs
			tabs : { 
				type : 		'multiple', 
				title : 	cmsms_shortcodes.tabs_title, 
				descr : 	cmsms_shortcodes.tabs_field_tabs_descr, 
				def : 		'[cmsms_tab title="' + cmsms_shortcodes.title + '"]<p>' + cmsms_shortcodes.def_text + '</p>[/cmsms_tab]', 
				required : 	true, 
				width : 	'half' 
			}, 
			// Mode
			mode : { 
				type : 		'radio', 
				title : 	cmsms_shortcodes.mode, 
				descr : 	cmsms_shortcodes.tabs_field_mode_descr, 
				def : 		'tab', 
				required : 	true, 
				width : 	'half', 
				choises : { 
							'tab' : 	cmsms_shortcodes.tabs_field_mode_choice_tabs, 
							'tour' : 	cmsms_shortcodes.tabs_field_mode_choice_tour 
				} 
			}, 
			// Position
			position : { 
				type : 		'radio', 
				title : 	cmsms_shortcodes.tabs_field_position_title, 
				descr : 	cmsms_shortcodes.tabs_field_position_descr, 
				def : 		'left', 
				required : 	false, 
				width : 	'half', 
				choises : { 
							'left' : 	cmsms_shortcodes.position_choice_left_side, 
							'right' : 	cmsms_shortcodes.position_choice_right_side 
				}, 
				depend : 	'mode:tour' 
			}, 
			// Active Tab
			active : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.tabs_field_active_title, 
				descr : 	cmsms_shortcodes.tabs_field_active_descr + " <br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.tabs_field_active_descr_note + "</span>", 
				def : 		'1', 
				required : 	true, 
				width : 	'half' 
			}, 
			// CSS3 Animation
			animation : { 
				type : 		'select', 
				title : 	cmsms_shortcodes.animation_title, 
				descr : 	cmsms_shortcodes.animation_descr + " <br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.animation_descr_note + "</span>", 
				def : 		'', 
				required : 	false, 
				width : 	'half', 
				choises : 	get_animations() 
			}, 
			// Animation Delay
			animation_delay : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.animation_delay_title, 
				descr : 	cmsms_shortcodes.animation_delay_descr + " <br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.animation_delay_descr_note + "</span>", 
				def : 		'0', 
				required : 	false, 
				width : 	'number', 
				min : 		'0', 
				step : 		'50' 
			}, 
			// Additional Classes
			classes : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.classes_title, 
				descr : 	cmsms_shortcodes.classes_descr, 
				def : 		'', 
				required : 	false, 
				width : 	'half' 
			} 
		} 
	}, 
	
	
	// Toggles
	cmsms_toggles : { 
		title : 	cmsms_shortcodes.toggles_title, 
		icon : 		'admin-icon-toggles', 
		pair : 		true, 
		content : 	'toggles', 
		visual : 	false, 
		multiple : 	true, 
		def : 		'[cmsms_toggle title="' + cmsms_shortcodes.title + '"]<p>' + cmsms_shortcodes.def_text + '</p>[/cmsms_toggle]', 
		fields : { 
			// Toggles
			toggles : { 
				type : 		'multiple', 
				title : 	cmsms_shortcodes.toggles_title, 
				descr : 	cmsms_shortcodes.toggles_field_toggles_descr, 
				def : 		'[cmsms_toggle title="' + cmsms_shortcodes.title + '"]<p>' + cmsms_shortcodes.def_text + '</p>[/cmsms_toggle]', 
				required : 	true, 
				width : 	'half' 
			}, 
			// Mode
			mode : { 
				type : 		'radio', 
				title : 	cmsms_shortcodes.mode, 
				descr : 	cmsms_shortcodes.toggles_field_mode_descr, 
				def : 		'toggle', 
				required : 	true, 
				width : 	'half', 
				choises : { 
							'toggle' : 		cmsms_shortcodes.toggles_field_mode_choice_toggles, 
							'accordion' : 	cmsms_shortcodes.toggles_field_mode_choice_accordion 
				} 
			}, 
			// Active Toggle
			active : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.toggles_field_active_title, 
				descr : 	cmsms_shortcodes.toggles_field_active_descr + "<br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.toggles_field_active_descr_note + "</span>", 
				def : 		'', 
				required : 	false, 
				width : 	'half' 
			}, 
			// Sorting
			sort : { 
				type : 		'checkbox', 
				title : 	cmsms_shortcodes.toggles_field_sorting_title, 
				descr : 	cmsms_shortcodes.toggles_field_sorting_descr, 
				def : 		'', 
				required : 	false, 
				width : 	'half',  
				choises : { 
							'true' : 	cmsms_shortcodes.choice_enable 
				} 
			},  
			// CSS3 Animation
			animation : { 
				type : 		'select', 
				title : 	cmsms_shortcodes.animation_title, 
				descr : 	cmsms_shortcodes.animation_descr + " <br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.animation_descr_note + "</span>", 
				def : 		'', 
				required : 	false, 
				width : 	'half', 
				choises : 	get_animations() 
			}, 
			// Animation Delay
			animation_delay : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.animation_delay_title, 
				descr : 	cmsms_shortcodes.animation_delay_descr + " <br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.animation_delay_descr_note + "</span>", 
				def : 		'0', 
				required : 	false, 
				width : 	'number', 
				min : 		'0', 
				step : 		'50' 
			}, 
			// Additional Classes
			classes : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.classes_title, 
				descr : 	cmsms_shortcodes.classes_descr, 
				def : 		'', 
				required : 	false, 
				width : 	'half'
			} 
		} 
	}, 
	
	
	// Twitter Stripe
	cmsms_twitter : { 
		title : 	cmsms_shortcodes.twitter_title, 
		icon : 		'admin-icon-twitter', 
		pair : 		false, 
		content : 	false, 
		visual : 	false, 
		multiple : 	false, 
		def : 		"", 
		fields : { 
			// Twitter Username
			user : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.twitter_field_username_title, 
				descr : 	cmsms_shortcodes.twitter_field_username_descr, 
				def : 		'', 
				required : 	true, 
				width : 	'half' 
			}, 
			// Tweets Number
			count : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.twitter_field_tweets_number_title, 
				descr : 	cmsms_shortcodes.twitter_field_tweets_number_descr + "<br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.value_number + ' ' + cmsms_shortcodes.twitter_field_tweets_number_descr_note + "</span>", 
				def : 		'5', 
				required : 	true, 
				width : 	'number', 
				min : 		'1' 
			}, 
			// Date visibility
			date : { 
				type : 		'checkbox', 
				title : 	cmsms_shortcodes.twitter_field_tweets_date_title, 
				descr : 	cmsms_shortcodes.twitter_field_tweets_date_descr, 
				def : 		'true', 
				required : 	false, 
				width : 	'half', 
				choises : { 
							'true' : 	cmsms_shortcodes.choice_enable 
				} 
			}, 
			// Twitter Controls
			control : { 
				type : 		'checkbox', 
				title : 	cmsms_shortcodes.twitter_field_slider_controls_title, 
				descr : 	cmsms_shortcodes.twitter_field_slider_controls_descr, 
				def : 		'true', 
				required : 	false, 
				width : 	'half', 
				choises : { 
							'true' : 	cmsms_shortcodes.choice_enable 
				} 
			}, 
			// Twitter Autoplay
			autoplay : { 
				type : 		'checkbox', 
				title : 	cmsms_shortcodes.gallery_field_slider_autoplay_title, 
				descr : 	cmsms_shortcodes.twitter_field_slider_autoplay_descr, 
				def : 		'true', 
				required : 	false, 
				width : 	'half', 
				choises : { 
							'true' : 	cmsms_shortcodes.choice_enable 
				} 
			}, 
			// Twitter Speed
			speed : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.twitter_field_slider_speed_title, 
				descr : 	cmsms_shortcodes.twitter_field_slider_speed_descr + "<br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.twitter_field_slider_speed_descr_note + "</span>", 
				def : 		'3', 
				required : 	false, 
				width : 	'small'
			}, 
			// CSS3 Animation
			animation : { 
				type : 		'select', 
				title : 	cmsms_shortcodes.animation_title, 
				descr : 	cmsms_shortcodes.animation_descr + " <br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.animation_descr_note + "</span>", 
				def : 		'', 
				required : 	false, 
				width : 	'half', 
				choises : 	get_animations() 
			}, 
			// Animation Delay
			animation_delay : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.animation_delay_title, 
				descr : 	cmsms_shortcodes.animation_delay_descr + " <br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.animation_delay_descr_note + "</span>", 
				def : 		'0', 
				required : 	false, 
				width : 	'number', 
				min : 		'0', 
				step : 		'50' 
			}, 
			// Additional Classes
			classes : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.classes_title, 
				descr : 	cmsms_shortcodes.classes_descr, 
				def : 		'', 
				required : 	false, 
				width : 	'half' 
			} 
		} 
	}, 
	
	
	// Video
	cmsms_videos : { 
		title : 	cmsms_shortcodes.video_title, 
		icon : 		'admin-icon-video', 
		pair : 		true, 
		content : 	'video', 
		visual : 	false, 
		multiple : 	true, 
		def : 		'[cmsms_video]' + cmsms_shortcodes.media_def + '[/cmsms_video]', 
		fields : { 
			// Video
			video : { 
				type : 		'multiple', 
				title : 	cmsms_shortcodes.video_title, 
				descr : 	cmsms_shortcodes.video_field_video_descr + " <br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.video_field_video_descr_note + ' (' + cmsms_shortcodes.more_info + " <a href='http://www.w3schools.com/html/html5_video.asp' target='_blank'>" + cmsms_shortcodes.click_here + "</a>)</span>", 
				def : 		'[cmsms_video]' + cmsms_shortcodes.media_def + '[/cmsms_video]', 
				required : 	true, 
				width : 	'full' 
			}, 
			// Poster
			poster : { 
				type : 			'upload', 
				title : 		cmsms_shortcodes.video_field_poster_title, 
				descr : 		cmsms_shortcodes.video_field_poster_descr, 
				def : 			'', 
				required : 		false, 
				width : 		'half', 
				frame : 		'post', 
				library : 		'image', 
				multiple : 		false, 
				description : 	false, 
				caption : 		false, 
				align : 		false, 
				link : 			false, 
				size : 			true 
			}, 
			// Max Width
			width : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.video_field_maxwidth_title, 
				descr : 	cmsms_shortcodes.video_field_maxwidth_descr + "<br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.size_note_short + ' ' + cmsms_shortcodes.embed_field_maxwidth_descr_note + "</span>", 
				def : 		'', 
				required : 	false, 
				width : 	'number', 
				min : 		'0' 
			}, 
			// Max Height
			height : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.video_field_maxheight_title, 
				descr : 	cmsms_shortcodes.video_field_maxheight_descr + "<br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.size_note_short + ' ' + cmsms_shortcodes.embed_field_maxheight_descr_note + "</span>", 
				def : 		'', 
				required : 	false, 
				width : 	'number', 
				min : 		'0' 
			}, 
			// Wrap Video
			wrap : { 
				type : 		'checkbox', 
				title : 	cmsms_shortcodes.embed_field_wrap_title, 
				descr : 	cmsms_shortcodes.embed_field_wrap_descr, 
				def : 		'true', 
				required : 	false, 
				width : 	'half', 
				choises : { 
							'true' : 	cmsms_shortcodes.choice_enable 
				} 
			}, 
			// Autoplay
			autoplay : { 
				type : 		'checkbox', 
				title : 	cmsms_shortcodes.media_field_autoplay_title, 
				descr : 	cmsms_shortcodes.video_field_autoplay_descr, 
				def : 		'', 
				required : 	false, 
				width : 	'half', 
				choises : { 
							'true' : 	cmsms_shortcodes.choice_enable 
				} 
			}, 
			// Muted
			muted : { 
				type : 		'checkbox', 
				title : 	cmsms_shortcodes.video_field_muted_title, 
				descr : 	cmsms_shortcodes.video_field_muted_descr, 
				def : 		'', 
				required : 	false, 
				width : 	'half', 
				choises : { 
							'true' : 	cmsms_shortcodes.choice_enable 
				} 
			}, 
			// Repeat
			loop : { 
				type : 		'checkbox', 
				title : 	cmsms_shortcodes.media_field_repeat_title, 
				descr : 	cmsms_shortcodes.video_field_repeat_descr, 
				def : 		'', 
				required : 	false, 
				width : 	'half', 
				choises : { 
							'true' : 	cmsms_shortcodes.choice_enable 
				} 
			}, 
			// Preload
			preload : { 
				type : 		'radio', 
				title : 	cmsms_shortcodes.media_field_preload_title, 
				descr : 	cmsms_shortcodes.video_field_preload_descr, 
				def : 		'none', 
				required : 	false, 
				width : 	'half', 
				choises : { 
							'none' : 		cmsms_shortcodes.video_field_preload_choice_none, 
							'auto' : 		cmsms_shortcodes.video_field_preload_choice_auto, 
							'metadata' : 	cmsms_shortcodes.video_field_preload_choice_metadata 
				} 
			}, 
			// CSS3 Animation
			animation : { 
				type : 		'select', 
				title : 	cmsms_shortcodes.animation_title, 
				descr : 	cmsms_shortcodes.animation_descr + " <br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.animation_descr_note + "</span>", 
				def : 		'', 
				required : 	false, 
				width : 	'half', 
				choises : 	get_animations() 
			}, 
			// Animation Delay
			animation_delay : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.animation_delay_title, 
				descr : 	cmsms_shortcodes.animation_delay_descr + " <br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.animation_delay_descr_note + "</span>", 
				def : 		'0', 
				required : 	false, 
				width : 	'number', 
				min : 		'0', 
				step : 		'50' 
			}, 
			// Additional Classes
			classes : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.classes_title, 
				descr : 	cmsms_shortcodes.classes_descr, 
				def : 		'', 
				required : 	false, 
				width : 	'half' 
			} 
		} 
	}, 
	
	
	// Custom HTML
	cmsms_html : { 
		title : 	cmsms_shortcodes.custom_html_title, 
		icon : 		'admin-icon-html', 
		pair : 		true, 
		content : 	'html', 
		visual : 	false, 
		multiple : 	false, 
		def : 		"", 
		fields : { 
			// HTML Code
			html : { 
				type : 		'textarea', 
				title : 	cmsms_shortcodes.custom_html_field_code_title, 
				descr : 	cmsms_shortcodes.custom_html_field_code_descr, 
				def : 		'', 
				required : 	true, 
				width : 	'full' 
			}, 
			// Additional Classes
			classes : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.classes_title, 
				descr : 	cmsms_shortcodes.classes_descr, 
				def : 		'', 
				required : 	false, 
				width : 	'half' 
			} 
		} 
	}, 
	
	
	// Custom CSS
	cmsms_css : { 
		title : 	cmsms_shortcodes.custom_css_title, 
		icon : 		'admin-icon-css', 
		pair : 		true, 
		content : 	'css', 
		visual : 	false, 
		multiple : 	false, 
		def : 		"", 
		fields : { 
			// CSS Code
			css : { 
				type : 		'textarea', 
				title : 	cmsms_shortcodes.custom_css_field_code_title, 
				descr : 	cmsms_shortcodes.custom_css_field_code_descr, 
				def : 		'', 
				required : 	true, 
				width : 	'full' 
			}, 
			// Additional Classes
			classes : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.classes_title, 
				descr : 	cmsms_shortcodes.classes_descr, 
				def : 		'', 
				required : 	false, 
				width : 	'half' 
			} 
		} 
	}, 
	
	
	// Custom JS
	cmsms_js : { 
		title : 	cmsms_shortcodes.custom_js_title, 
		icon : 		'admin-icon-js', 
		pair : 		true, 
		content : 	'js', 
		visual : 	false, 
		multiple : 	false, 
		def : 		"", 
		fields : { 
			// JavaScript Code
			js : { 
				type : 		'textarea', 
				title : 	cmsms_shortcodes.custom_js_field_code_title, 
				descr : 	cmsms_shortcodes.custom_js_field_code_descr, 
				def : 		'', 
				required : 	true, 
				width : 	'full' 
			}, 
			// Additional Classes
			classes : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.classes_title, 
				descr : 	cmsms_shortcodes.classes_descr, 
				def : 		'', 
				required : 	false, 
				width : 	'half' 
			} 
		} 
	} 
};


// CMSMasters Custom Shortcodes WooCommerce Extension
if (cmsms_composer_products() === 'true') {
	cmsmsShortcodes.cmsms_products = {
		title : 	cmsms_shortcodes.products_title, 
		icon : 		'admin-icon-shop', 
		pair : 		false, 
		content : 	false, 
		visual : 	false, 
		multiple : 	false, 
		def : 		'', 
		fields : { 
			// Products Shortcode Choise
			products_shortcode : { 
				type : 		'radio', 
				title : 	cmsms_shortcodes.products_shortcode_title, 
				descr : 	cmsms_shortcodes.products_shortcode_descr, 
				def : 		'recent_products', 
				required : 	true, 
				width : 	'half', 
				choises : { 
							'recent_products' : 		cmsms_shortcodes.choice_recent_products, 
							'featured_products' : 		cmsms_shortcodes.choice_featured_products, 
							'sale_products' : 			cmsms_shortcodes.choice_sale_products, 
							'best_selling_products' : 	cmsms_shortcodes.choice_best_selling_products, 
							'top_rated_products' : 		cmsms_shortcodes.choice_top_rated_products 
				} 
			}, 
			// Order By
			orderby : { 
				type : 		'select', 
				title : 	cmsms_shortcodes.orderby_title, 
				descr : 	cmsms_shortcodes.products_field_orderby_descr + "<br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.products_field_orderby_descr_note + ' ' + cmsms_shortcodes.choice_best_selling_products + ' and ' + cmsms_shortcodes.choice_top_rated_products + "</span>", 
				def : 		'date', 
				required : 	true, 
				width : 	'half', 
				choises : { 
							'date' : 		cmsms_shortcodes.choice_date, 
							'name' : 		cmsms_shortcodes.name, 
							'id' : 			cmsms_shortcodes.choice_id 
				} 
			}, 
			// Order
			order : { 
				type : 		'radio', 
				title : 	cmsms_shortcodes.order_title, 
				descr : 	cmsms_shortcodes.order_descr + "<br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.products_field_orderby_descr_note + ' ' + cmsms_shortcodes.choice_best_selling_products + ' and ' + cmsms_shortcodes.choice_top_rated_products + "</span>",  
				def : 		'DESC', 
				required : 	true, 
				width : 	'half', 
				choises : { 
							'ASC' : 	cmsms_shortcodes.choice_asc, 
							'DESC' : 	cmsms_shortcodes.choice_desc
				} 
			}, 
			// Products Number
			count : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.products_field_prod_number_title, 
				descr : 	cmsms_shortcodes.products_field_prod_number_descr, 
				def : 		'10', 
				required : 	true, 
				width : 	'number', 
				min : 		'1' 
			}, 
			// Columns Count
			columns : { 
				type : 		'select', 
				title : 	cmsms_shortcodes.columns_count, 
				descr : 	cmsms_shortcodes.products_field_col_count_descr, 
				def : 		'4', 
				required : 	true, 
				width : 	'half', 
				choises : { 
							'1' : 	'1', 
							'2' : 	'2', 
							'3' : 	'3', 
							'4' : 	'4' 
				} 
			}, 
			// Additional Classes
			classes : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.classes_title, 
				descr : 	cmsms_shortcodes.classes_descr, 
				def : 		'', 
				required : 	false, 
				width : 	'half' 
			} 
		} 
	};
	
	
	cmsmsShortcodes.cmsms_selected_products = {
		title : 	cmsms_shortcodes.selected_products_title, 
		icon : 		'admin-icon-product', 
		pair : 		false, 
		content : 	false, 
		visual : 	false, 
		multiple : 	false, 
		def : 		'', 
		fields : { 
			// Order By
			orderby : { 
				type : 		'select', 
				title : 	cmsms_shortcodes.orderby_title, 
				descr : 	cmsms_shortcodes.products_field_orderby_descr, 
				def : 		'date', 
				required : 	true, 
				width : 	'half', 
				choises : { 
							'date' : 		cmsms_shortcodes.choice_date, 
							'name' : 		cmsms_shortcodes.name, 
							'id' : 			cmsms_shortcodes.choice_id 
				} 
			}, 
			// Order
			order : { 
				type : 		'radio', 
				title : 	cmsms_shortcodes.order_title, 
				descr : 	cmsms_shortcodes.order_descr, 
				def : 		'DESC', 
				required : 	true, 
				width : 	'half', 
				choises : { 
							'ASC' : 	cmsms_shortcodes.choice_asc, 
							'DESC' : 	cmsms_shortcodes.choice_desc
				} 
			}, 
			// IDs
			ids : { 
				type : 		'select_multiple', 
				title : 	cmsms_shortcodes.selected_products_field_ids, 
				descr : 	cmsms_shortcodes.selected_products_field_ids_descr + "<br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.selected_products_field_ids_descr_note + "</span>", 
				def : 		'', 
				required : 	true, 
				width : 	'half', 
				choises : 	cmsms_composer_product_ids() 
			}, 
			// Columns Count
			columns : { 
				type : 		'select', 
				title : 	cmsms_shortcodes.columns_count, 
				descr : 	cmsms_shortcodes.products_field_col_count_descr, 
				def : 		'4', 
				required : 	true, 
				width : 	'half', 
				choises : { 
							'1' : 	'1', 
							'2' : 	'2', 
							'3' : 	'3', 
							'4' : 	'4' 
				} 
			}, 
			// Additional Classes
			classes : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.classes_title, 
				descr : 	cmsms_shortcodes.classes_descr, 
				def : 		'', 
				required : 	false, 
				width : 	'half' 
			} 
		} 
	};
}


// CMSMasters Custom Shortcodes PayPal Donations Extension
if (cmsms_composer_paypal_donations() === 'true') {
	cmsmsShortcodes.cmsms_paypal_donations = {
		title : 	cmsms_shortcodes.paypal_donations_title, 
		icon : 		'admin-icon-donate', 
		pair : 		false, 
		content : 	false, 
		visual : 	false, 
		multiple : 	false, 
		def : 		'', 
		fields : { 
			// Amount
			amount : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.paypal_donations_field_amount_title, 
				descr : 	cmsms_shortcodes.paypal_donations_field_amount_descr + "<br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.paypal_donations_field_amount_descr_note + "</span>", 
				def : 		'', 
				required : 	false, 
				width : 	'number', 
				min : 		'0' 
			}, 
			// Purpose
			purpose : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.paypal_donations_field_purpose_title, 
				descr : 	cmsms_shortcodes.paypal_donations_field_purpose_descr + "<br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.paypal_donations_field_purpose_descr_note + "</span>", 
				def : 		'', 
				required : 	false, 
				width : 	'half' 
			}, 
			// Reference
			reference : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.paypal_donations_field_reference_title, 
				descr : 	cmsms_shortcodes.paypal_donations_field_reference_descr + "<br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.paypal_donations_field_reference_descr_note + "</span>", 
				def : 		'', 
				required : 	false, 
				width : 	'half' 
			}, 
			// Button Text
			button_text : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.paypal_donations_field_button_text_title, 
				descr : 	cmsms_shortcodes.paypal_donations_field_button_text_descr + "<br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.paypal_donations_field_button_text_descr_note + "</span>", 
				def : 		'Donation', 
				required : 	false, 
				width : 	'half' 
			}, 
			// Additional Classes
			classes : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.classes_title, 
				descr : 	cmsms_shortcodes.classes_descr, 
				def : 		'', 
				required : 	false, 
				width : 	'half' 
			} 
		} 
	};
}


// CMSMasters Custom Multiple Fields Shortcodes
var cmsmsMultipleShortcodes = { 
	// Audio Link
	cmsms_audio : { 
		title : 	cmsms_shortcodes.audio_link_title, 
		pair : 		true, 
		content : 	'link', 
		visual : 	'<span class="cmsms_multiple_text">{{ data.link }}</span>', 
		def : 		"", 
		fields : { 
			// Audio Link
			link : { 
				type : 			'upload', 
				title : 		cmsms_shortcodes.audio_link_field_audio_link_title, 
				descr : 		cmsms_shortcodes.audio_link_field_audio_link_descr, 
				def : 			'', 
				required : 		true, 
				width : 		'full', 
				frame : 		'select', 
				library : 		'audio', 
				multiple : 		false, 
				description : 	false, 
				caption : 		false, 
				align : 		false, 
				link : 			false, 
				size : 			false 
			} 
		} 
	}, 
	
	
	// Client
	cmsms_client : { 
		title : 	cmsms_shortcodes.client_title, 
		pair : 		true, 
		content : 	'name', 
		visual : 	'<span class="cmsms_multiple_text">{{ data.name }}</span>', 
		def : 		"", 
		fields : { 
			// Name
			name : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.name, 
				descr : 	cmsms_shortcodes.client_field_name_descr, 
				def : 		'', 
				required : 	true, 
				width : 	'half' 
			}, 
			// Logo
			logo : { 
				type : 			'upload', 
				title : 		cmsms_shortcodes.client_field_logo_title, 
				descr : 		cmsms_shortcodes.client_field_logo_descr, 
				def : 			'', 
				required : 		true, 
				width : 		'half', 
				frame : 		'post', 
				library : 		'image', 
				multiple : 		false, 
				description : 	false, 
				caption : 		false, 
				align : 		false, 
				link : 			false, 
				size : 			false 
			}, 
			// Link
			link : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.link, 
				descr : 	cmsms_shortcodes.client_field_link_descr, 
				def : 		'', 
				required : 	false, 
				width : 	'full' 
			}, 
			// Additional Classes
			classes : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.classes_title, 
				descr : 	cmsms_shortcodes.classes_descr, 
				def : 		'', 
				required : 	false, 
				width : 	'half' 
			} 
		} 
	}, 
	
	
	// Google Map Marker
	cmsms_google_map_marker : { 
		title : 	cmsms_shortcodes.map_marker_title, 
		pair : 		true, 
		content : 	'html', 
		visual : 	'<span class="cmsms_multiple_text"><span class="cmsms_multiple_hide_empty">{{ data.address }}</span><span class="cmsms_multiple_hide_empty">{{ data.latitude }} {{ data.longitude }}</span></span>', 
		def : 		"", 
		fields : { 
			// Address Type
			address_type : { 
				type : 		'radio', 
				title : 	cmsms_shortcodes.map_marker_field_address_type_title, 
				descr : 	cmsms_shortcodes.map_marker_field_address_type_descr, 
				def : 		'address', 
				required : 	true, 
				width : 	'half', 
				choises : { 
							'address' : 		cmsms_shortcodes.map_markers_field_address_type_choice_address, 
							'coordinates' : 	cmsms_shortcodes.map_markers_field_address_type_choice_coord 
				} 
			}, 
			// Address
			address : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.map_markers_field_address_title, 
				descr : 	cmsms_shortcodes.map_marker_field_address_descr, 
				def : 		'', 
				required : 	true, 
				width : 	'half', 
				depend : 	'address_type:address' 
			}, 
			// Latitude
			latitude : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.map_markers_field_latitude_title, 
				descr : 	cmsms_shortcodes.map_marker_field_latitude_descr + "<br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.value_number + "</span>", 
				def : 		'', 
				required : 	true, 
				width : 	'small', 
				depend : 	'address_type:coordinates' 
			}, 
			// Longitude
			longitude : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.map_markers_field_longitude_title, 
				descr : 	cmsms_shortcodes.map_marker_field_longitude_descr + "<br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.value_number + "</span>", 
				def : 		'', 
				required : 	true, 
				width : 	'small', 
				depend : 	'address_type:coordinates' 
			}, 
			// Popup HTML
			html : { 
				type : 		'textarea', 
				title : 	cmsms_shortcodes.map_marker_field_popup_html_title, 
				descr : 	cmsms_shortcodes.map_marker_field_popup_html_descr, 
				def : 		'', 
				required : 	false, 
				width : 	'half' 
			}, 
			// Popup Visibility
			popup : { 
				type : 		'checkbox', 
				title : 	cmsms_shortcodes.map_marker_field_popup_visibility_title, 
				descr : 	cmsms_shortcodes.map_marker_field_popup_visibility_descr, 
				def : 		'', 
				required : 	false, 
				width : 	'half', 
				choises : { 
							'true' : 	cmsms_shortcodes.choice_show 
				} 
			} 
		} 
	}, 
	
	
	// Icon List Item
	cmsms_icon_list_item : { 
		title : 	cmsms_shortcodes.icon_list_item_title, 
		pair : 		true, 
		content : 	'content', 
		visual : 	'<span class="cmsms_multiple_text {{ data.icon }}">{{ data.title }}</span>', 
		def : 		"", 
		fields : { 
			// Title
			title : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.title, 
				descr : 	cmsms_shortcodes.icon_list_item_field_title_descr, 
				def : 		'', 
				required : 	true, 
				width : 	'half' 
			}, 
			// Content
			content : { 
				type : 		'editor', 
				title : 	cmsms_shortcodes.content, 
				descr : 	cmsms_shortcodes.icon_list_item_field_content_descr + "<br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.icon_list_item_field_content_descr_note + "</span>", 
				def : 		"<p>" + cmsms_shortcodes.def_text + "</p>", 
				required : 	false, 
				width : 	'full' 
			}, 
			// Custom List Item Color
			custom_colors : { 
				type : 		'checkbox', 
				title : 	cmsms_shortcodes.icon_list_item_field_item_color_title, 
				descr : 	cmsms_shortcodes.icon_list_item_field_item_color_descr, 
				def : 		'', 
				required : 	false, 
				width : 	'half',  
				choises : { 
							'true' : 		cmsms_shortcodes.choice_enable 
				} 
			}, 
			// Color
			color : { 
				type : 		'color', 
				title : 	cmsms_shortcodes.color, 
				descr : 	cmsms_shortcodes.icon_list_item_field_color_descr + "<br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.icon_list_item_field_content_descr_note + "</span>", 
				def : 		'#353535', 
				required : 	false, 
				width : 	'half', 
				depend : 	'custom_colors:true' 
			}, 
			// Icon
			icon : { 
				type : 		'icon', 
				title : 	cmsms_shortcodes.icon, 
				descr : 	cmsms_shortcodes.icon_list_item_field_icon_descr, 
				def : 		'', 
				required : 	false, 
				width : 	'full', 
				choises : 	cmsms_composer_icons() 
			}, 
			// Additional Classes
			classes : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.classes_title, 
				descr : 	cmsms_shortcodes.classes_descr, 
				def : 		'', 
				required : 	false, 
				width : 	'half' 
			} 
		} 
	}, 
	
	
	// Pricing Table Offer
	cmsms_pricing_table_item : { 
		title : 	cmsms_shortcodes.pricing_offer_title, 
		pair : 		true, 
		content : 	'title', 
		visual : 	'<span class="cmsms_multiple_text">{{ data.title }} &nbsp; {{ data.currency }}{{ data.price }}<sup class="cmsms_multiple_hide_empty">{{ data.coins }}</sup></span>', 
		def : 		"", 
		fields : { 
			// Title
			title : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.title, 
				descr : 	cmsms_shortcodes.pricing_offer_field_title_descr, 
				def : 		'', 
				required : 	true, 
				width : 	'half' 
			}, 
			// Price
			price : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.pricing_offer_field_price_title, 
				descr : 	cmsms_shortcodes.pricing_offer_field_price_descr, 
				def : 		'', 
				required : 	true, 
				width : 	'small' 
			}, 
			// Coins
			coins : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.pricing_offer_field_coins_title, 
				descr : 	cmsms_shortcodes.pricing_offer_field_coins_descr, 
				def : 		'', 
				required : 	false, 
				width : 	'small' 
			}, 
			// Currency
			currency : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.pricing_offer_field_currency_title, 
				descr : 	cmsms_shortcodes.pricing_offer_field_currency_descr, 
				def : 		'', 
				required : 	true, 
				width : 	'small' 
			}, 
			// Period
			period : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.pricing_offer_field_period_title, 
				descr : 	cmsms_shortcodes.pricing_offer_field_period_descr, 
				def : 		'', 
				required : 	false, 
				width : 	'small' 
			}, 
			// Custom Offer Color
			custom_colors : { 
				type : 		'checkbox', 
				title : 	cmsms_shortcodes.pricing_offer_field_offer_color_title, 
				descr : 	cmsms_shortcodes.pricing_offer_field_offer_color_descr, 
				def : 		'', 
				required : 	false, 
				width : 	'half',  
				choises : { 
							'true' : 	cmsms_shortcodes.choice_enable 
				} 
			}, 
			// Color
			color : { 
				type : 		'color', 
				title : 	cmsms_shortcodes.color, 
				descr : 	cmsms_shortcodes.pricing_offer_field_color_descr, 
				def : 		'#353535', 
				required : 	false, 
				width : 	'half', 
				depend : 	'custom_colors:true' 
			}, 
			// Features
			features : { 
				type : 		'link', 
				title : 	cmsms_shortcodes.pricing_offer_field_features_title, 
				descr : 	cmsms_shortcodes.pricing_offer_field_features_descr, 
				def : 		"", 
				required : 	false, 
				width : 	'full' 
			}, 
			// Button Text
			button_text : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.pricing_offer_field_button_text_title, 
				descr : 	cmsms_shortcodes.pricing_offer_field_button_text_descr, 
				def : 		'', 
				required : 	true, 
				width : 	'small' 
			}, 
			// Button Link
			button_link : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.pricing_offer_field_button_link_title, 
				descr : 	cmsms_shortcodes.pricing_offer_field_button_link_descr, 
				def : 		'', 
				required : 	true, 
				width : 	'half' 
			}, 
			// Best Offer
			best : { 
				type : 		'checkbox', 
				title : 	cmsms_shortcodes.pricing_offer_field_best_offer_title, 
				descr : 	cmsms_shortcodes.pricing_offer_field_best_offer_descr, 
				def : 		'', 
				required : 	false, 
				width : 	'half', 
				choises : { 
							'true' : 	cmsms_shortcodes.choice_enable
				} 
			}, 
			// Best Offer
			best_custom_bg : { 
				type : 		'checkbox', 
				title : 	cmsms_shortcodes.pricing_offer_field_best_offer_custom_bg_title, 
				descr : 	cmsms_shortcodes.pricing_offer_field_best_offer_custom_bg_descr, 
				def : 		'', 
				required : 	false, 
				width : 	'half', 
				choises : { 
							'true' : 	cmsms_shortcodes.choice_enable
				}, 
				depend : 	'best:true' 
			}, 
			// Best offer Color
			best_color : { 
				type : 		'color', 
				title : 	cmsms_shortcodes.pricing_offer_field_best_offer_bg_title, 
				descr : 	cmsms_shortcodes.pricing_offer_field_best_offer_bg_descr, 
				def : 		'#ffffff', 
				required : 	false, 
				width : 	'half', 
				depend : 	'best_custom_bg:true' 
			}, 
			// CSS3 Animation
			animation : { 
				type : 		'select', 
				title : 	cmsms_shortcodes.animation_title, 
				descr : 	cmsms_shortcodes.animation_descr + " <br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.animation_descr_note + "</span>", 
				def : 		'', 
				required : 	false, 
				width : 	'half', 
				choises : 	get_animations() 
			}, 
			// Animation Delay
			animation_delay : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.animation_delay_title, 
				descr : 	cmsms_shortcodes.animation_delay_descr + " <br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.animation_delay_descr_note + "</span>", 
				def : 		'0', 
				required : 	false, 
				width : 	'number', 
				min : 		'0', 
				step : 		'50' 
			}, 
			// Additional Classes
			classes : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.classes_title, 
				descr : 	cmsms_shortcodes.classes_descr, 
				def : 		'', 
				required : 	false, 
				width : 	'half' 
			} 
		} 
	}, 
	
	
	// Progress Bar
	cmsms_stat : { 
		title : 	cmsms_shortcodes.prog_bar_title, 
		pair : 		true, 
		content : 	'title', 
		visual : 	'<span class="cmsms_multiple_text {{ data.icon }}">{{ data.title }}</span>', 
		def : 		"", 
		fields : { 
			// Title
			title : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.title, 
				descr : 	cmsms_shortcodes.prog_bar_field_title_descr, 
				def : 		'', 
				required : 	true, 
				width : 	'half' 
			}, 
			// Progress
			progress : { 
				type : 		'select', 
				title : 	cmsms_shortcodes.prog_bar_field_progress_title, 
				descr : 	cmsms_shortcodes.prog_bar_field_progress_descr + "<br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.prog_bar_field_progress_descr_note + ' ' + "<strong>" + cmsms_shortcodes.prog_bar_field_progress_descr_note_bars + "</strong>" + ' ' +  cmsms_shortcodes.prog_bar_field_progress_descr_note_mode + ' ' + "<strong>" + cmsms_shortcodes.prog_bar_field_progress_descr_note_counters + "</strong>" + ' ' + cmsms_shortcodes.prog_bar_field_progress_descr_note_count_type + ' ' + "<strong>" + cmsms_shortcodes.prog_bar_field_progress_descr_note_circles + "</strong>" + ' ' + cmsms_shortcodes.prog_bar_field_progress_descr_note_percentage + "</span>", 
				def : 		'0', 
				required : 	true, 
				width : 	'small', 
				choises : 	get_percentage() 
			}, 
			// Custom Progress Bar Color
			custom_colors : { 
				type : 		'checkbox', 
				title : 	cmsms_shortcodes.prog_bar_field_custom_bar_color_title, 
				descr : 	cmsms_shortcodes.prog_bar_field_custom_bar_color_descr, 
				def : 		'', 
				required : 	false, 
				width : 	'half',  
				choises : { 
							'true' : 	cmsms_shortcodes.choice_enable 
				} 
			}, 
			// Bar Color
			bg_color : { 
				type : 		'color', 
				title : 	cmsms_shortcodes.prog_bar_field_bar_color_title, 
				descr : 	cmsms_shortcodes.prog_bar_field_bar_color_descr, 
				def : 		'#353535', 
				required : 	false, 
				width : 	'half', 
				depend : 	'custom_colors:true' 
			}, 
			// Counter Value
			value : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.prog_bar_field_counter_value_title, 
				descr : 	cmsms_shortcodes.prog_bar_field_counter_value_descr + "<br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.prog_bar_field_progress_descr_note + ' ' + "<strong>" + cmsms_shortcodes.prog_bar_field_progress_descr_note_counters + "</strong>" + ' ' + cmsms_shortcodes.prog_bar_field_progress_descr_note_count_type + ' ' + "<strong>" + cmsms_shortcodes.prog_bar_field_counter_value_descr_note + "</strong>" + ' ' + cmsms_shortcodes.value_zero + "</span>", 
				def : 		'', 
				required : 	false, 
				width : 	'small' 
			}, 
			// Counter Value Prefix
			value_prefix : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.prog_bar_field_counter_value_prefix_title, 
				descr : 	cmsms_shortcodes.prog_bar_field_counter_value_descr + "<br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.prog_bar_field_progress_descr_note + ' ' + "<strong>" + cmsms_shortcodes.prog_bar_field_progress_descr_note_counters + "</strong>" + ' ' + cmsms_shortcodes.prog_bar_field_progress_descr_note_count_type + ' ' + "<strong>" + cmsms_shortcodes.prog_bar_field_counter_value_descr_note + "</strong>" + "</span>", 
				def : 		'', 
				required : 	false, 
				width : 	'small' 
			}, 
			// Counter Value Suffix
			value_suffix : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.prog_bar_field_counter_value_suffix_title, 
				descr : 	cmsms_shortcodes.prog_bar_field_counter_value_descr + "<br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.prog_bar_field_progress_descr_note + ' ' + "<strong>" + cmsms_shortcodes.prog_bar_field_progress_descr_note_counters + "</strong>" + ' ' + cmsms_shortcodes.prog_bar_field_progress_descr_note_count_type + ' ' + "<strong>" + cmsms_shortcodes.prog_bar_field_counter_value_descr_note + "</strong>" + "</span>", 
				def : 		'', 
				required : 	false, 
				width : 	'small' 
			}, 
			// Icon
			icon : { 
				type : 		'icon', 
				title : 	cmsms_shortcodes.icon, 
				descr : 	cmsms_shortcodes.prog_bar_field_icon_descr, 
				def : 		'', 
				required : 	false, 
				width : 	'full', 
				choises : 	cmsms_composer_icons() 
			}, 
			// Additional Classes
			classes : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.classes_title, 
				descr : 	cmsms_shortcodes.classes_descr, 
				def : 		'', 
				required : 	false, 
				width : 	'half' 
			} 
		} 
	}, 
	
	
	// Quote
	cmsms_quote : { 
		title : 	cmsms_shortcodes.quote_title, 
		pair : 		true, 
		content : 	'content', 
		visual : 	'<span class="cmsms_multiple_text">Quote by: {{ data.name }}</span>', 
		def : 		"", 
		fields : { 
			// Image
			image : { 
				type : 			'upload', 
				title : 		cmsms_shortcodes.quote_field_image_title, 
				descr : 		cmsms_shortcodes.quote_field_image_descr, 
				def : 			'', 
				required : 		false, 
				width : 		'half', 
				frame : 		'post', 
				library : 		'image', 
				multiple : 		false, 
				description : 	true, 
				caption : 		true, 
				align : 		false, 
				link : 			false, 
				size : 			true 
			}, 
			// Name
			name : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.name, 
				descr : 	cmsms_shortcodes.quote_field_name_descr, 
				def : 		'', 
				required : 	true, 
				width : 	'half' 
			}, 
			// Subtitle
			subtitle : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.quote_field_subtitle_title, 
				descr : 	cmsms_shortcodes.quote_field_subtitle_descr, 
				def : 		'', 
				required : 	false, 
				width : 	'half' 
			}, 
			// Quote
			content : { 
				type : 		'editor', 
				title : 	cmsms_shortcodes.quote_field_quote_title, 
				descr : 	cmsms_shortcodes.quote_field_quote_descr, 
				def : 		"<p>" + cmsms_shortcodes.def_text + "</p>", 
				required : 	true, 
				width : 	'full' 
			},
			// Website Link
			link : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.quote_field_link_title, 
				descr : 	cmsms_shortcodes.quote_field_link_descr, 
				def : 		"", 
				required : 	false, 
				width : 	'full' 
			}, 
			// Website Name
			website : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.quote_field_website_name_title, 
				descr : 	cmsms_shortcodes.quote_field_website_name_descr, 
				def : 		"", 
				required : 	false, 
				width : 	'half' 
			}, 
			// Additional Classes
			classes : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.classes_title, 
				descr : 	cmsms_shortcodes.classes_descr, 
				def : 		'', 
				required : 	false, 
				width : 	'half' 
			} 
		} 
	}, 
	
	
	// Tab
	cmsms_tab : { 
		title : 	cmsms_shortcodes.tab_title, 
		pair : 		true, 
		content : 	'content', 
		visual : 	'<span class="cmsms_multiple_text {{ data.icon }}">{{ data.title }}</span>', 
		def : 		"", 
		fields : { 
			// Title
			title : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.title, 
				descr : 	cmsms_shortcodes.tab_field_title_descr, 
				def : 		'', 
				required : 	true, 
				width : 	'half' 
			}, 
			// Content
			content : { 
				type : 		'editor', 
				title : 	cmsms_shortcodes.content, 
				descr : 	cmsms_shortcodes.tab_field_content_descr, 
				def : 		"<p>" + cmsms_shortcodes.def_text + "</p>", 
				required : 	true, 
				width : 	'full' 
			}, 
			// Custom Tab Selector Color
			custom_colors : { 
				type : 		'checkbox', 
				title : 	cmsms_shortcodes.tab_field_tab_selector_color_title, 
				descr : 	cmsms_shortcodes.tab_field_tab_selector_color_descr, 
				def : 		'', 
				required : 	false, 
				width : 	'half',  
				choises : { 
							'true' : cmsms_shortcodes.choice_enable 
				} 
			}, 
			// Tab Color
			bg_color : { 
				type : 		'color', 
				title : 	cmsms_shortcodes.tab_field_tab_color_title, 
				descr : 	cmsms_shortcodes.tab_field_tab_color_descr, 
				def : 		'#353535', 
				required : 	false, 
				width : 	'half', 
				depend : 	'custom_colors:true' 
			}, 
			// Icon
			icon : { 
				type : 		'icon', 
				title : 	cmsms_shortcodes.icon, 
				descr : 	cmsms_shortcodes.tab_field_icon_descr, 
				def : 		'', 
				required : 	false, 
				width : 	'full', 
				choises : 	cmsms_composer_icons() 
			}, 
			// Additional Classes
			classes : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.classes_title, 
				descr : 	cmsms_shortcodes.classes_descr, 
				def : 		'', 
				required : 	false, 
				width : 	'half' 
			} 
		} 
	}, 
	
	
	// Toggle
	cmsms_toggle : { 
		title : 	cmsms_shortcodes.toggle_title, 
		pair : 		true, 
		content : 	'content', 
		visual : 	'<span class="cmsms_multiple_text">{{ data.title }}</span>', 
		def : 		"", 
		fields : { 
			// Title
			title : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.title, 
				descr : 	cmsms_shortcodes.toggle_field_title_descr, 
				def : 		'', 
				required : 	true, 
				width : 	'half' 
			}, 
			// Content
			content : { 
				type : 		'editor', 
				title : 	cmsms_shortcodes.content, 
				descr : 	cmsms_shortcodes.toggle_field_title_descr, 
				def : 		"<p>" + cmsms_shortcodes.def_text + "</p>", 
				required : 	true, 
				width : 	'full' 
			}, 
			// Toggle Tags
			tags : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.toggle_field_toggle_tags_title, 
				descr : 	cmsms_shortcodes.toggle_field_toggle_tags_descr + "<br /><span>" + cmsms_shortcodes.note + ' ' +  cmsms_shortcodes.toggle_field_toggle_tags_descr_note + "</span>", 
				def : 		'', 
				required : 	false, 
				width : 	'half' 
			}, 
			// Additional Classes
			classes : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.classes_title, 
				descr : 	cmsms_shortcodes.classes_descr, 
				def : 		'', 
				required : 	false, 
				width : 	'half' 
			} 
		} 
	}, 
	
	
	// Video Link
	cmsms_video : { 
		title : 	cmsms_shortcodes.video_link_title, 
		pair : 		true, 
		content : 	'link', 
		visual : 	'<span class="cmsms_multiple_text">{{ data.link }}</span>', 
		def : 		"", 
		fields : { 
			// Video Link
			link : { 
				type : 			'upload', 
				title : 		cmsms_shortcodes.video_link_field_video_link_title, 
				descr : 		cmsms_shortcodes.video_link_field_video_link_descr, 
				def : 			'', 
				required : 		true, 
				width : 		'full', 
				frame : 		'select', 
				library : 		'video', 
				multiple : 		false, 
				description : 	false, 
				caption : 		false, 
				align : 		false, 
				link : 			false, 
				size : 			false 
			} 
		} 
	} 
};


// CMSMasters Editor Shortcodes
cmsmsEditorShortcodes = { 
	// Dropcap
	cmsms_dropcap : { 
		title : 	cmsms_shortcodes.dropcap_title, 
		icon : 		'admin-icon-dropcap', 
		pair : 		true, 
		content : 	'content', 
		visual : 	'<div>{{ data.content }}</div>', 
		multiple : 	false, 
		def : 		"A", 
		fields : { 
			// Content
			content : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.content, 
				descr : 	cmsms_shortcodes.dropcap_field_content_descr, 
				def : 		'A', 
				required : 	true, 
				width : 	'small' 
			}, 
			// Type
			type : { 
				type : 		'radio', 
				title : 	cmsms_shortcodes.dropcap_field_type_title, 
				descr : 	cmsms_shortcodes.dropcap_field_type_descr, 
				def : 		'type1', 
				required : 	true, 
				width : 	'half', 
				choises : { 
							'type1' : 	cmsms_shortcodes.dropcap_field_type_choice_one, 
							'type2' : 	cmsms_shortcodes.dropcap_field_type_choice_two 
				} 
			}, 
			// Additional Classes
			classes : { 
				type : 		'input', 
				title : 	cmsms_shortcodes.classes_title, 
				descr : 	cmsms_shortcodes.classes_descr, 
				def : 		'', 
				required : 	false, 
				width : 	'half' 
			} 
		} 
	} 
};


// CMSMasters Item Shortcode
cmsmsLinkShortcode = { 
	title : 	cmsms_shortcodes.item_title, 
	content : 	false, 
	fields : { 
		// Title
		title : { 
			type : 		'input', 
			title : 	cmsms_shortcodes.title, 
			descr : 	cmsms_shortcodes.item_field_title_descr, 
			def : 		'', 
			required : 	true, 
			width : 	'half' 
		}, 
		// Link
		link : { 
			type : 		'input', 
			title : 	cmsms_shortcodes.link, 
			descr : 	cmsms_shortcodes.item_field_link_descr, 
			def : 		'', 
			required : 	false, 
			width : 	'full' 
		}, 
		// Icon
		icon : { 
			type : 		'icon', 
			title : 	cmsms_shortcodes.icon, 
			descr : 	cmsms_shortcodes.item_field_icon_descr, 
			def : 		'', 
			required : 	false, 
			width : 	'full', 
			choises : 	cmsms_composer_icons() 
		} 
	} 
};


// CMSMasters Column Shortcode
cmsmsColumn = { 
	title : 	cmsms_shortcodes.column_title, 
	content : 	false, 
	fields : { 
		// CSS3 Animation
		animation : { 
			type : 		'select', 
			title : 	cmsms_shortcodes.animation_title, 
			descr : 	cmsms_shortcodes.column_field_animation_descr + "<br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.animation_descr_note + "</span>", 
			def : 		'', 
			required : 	false, 
			width : 	'half', 
			choises : 	get_animations() 
		}, 
		// Animation Delay
		animation_delay : { 
			type : 		'input', 
			title : 	cmsms_shortcodes.animation_delay_title, 
			descr : 	cmsms_shortcodes.column_field_animation_delay_descr + " <br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.animation_delay_descr_note + "</span>", 
			def : 		'0', 
			required : 	false, 
			width : 	'number', 
			min : 		'0', 
			step : 		'50' 
		}, 
		// Additional Classes
		classes : { 
			type : 		'input', 
			title : 	cmsms_shortcodes.classes_title, 
			descr : 	cmsms_shortcodes.column_field_classes_descr, 
			def : 		'', 
			required : 	false, 
			width : 	'half' 
		} 
	} 
};


// CMSMasters Row Shortcode
cmsmsRow = { 
	button :	cmsms_shortcodes.row_button, 
	title :		cmsms_shortcodes.row_title, 
	icon : 		'admin-icon-row', 
	content : 	false, 
	fields : { 
		// Content Width
		width : { 
			type : 		'radio', 
			title : 	cmsms_shortcodes.row_field_content_width_title, 
			descr : 	cmsms_shortcodes.row_field_content_width_descr, 
			def : 		'boxed', 
			required : 	false, 
			width : 	'half', 
			choises : { 
						'boxed' : 		cmsms_shortcodes.row_field_content_width_choice_boxed, 
						'fullwidth' : 	cmsms_shortcodes.row_field_content_width_choice_custom 
			} 
		}, 
		// Left Custom Padding
		padding_left : { 
			type : 		'input', 
			title : 	cmsms_shortcodes.row_field_left_custom_padding_title, 
			descr : 	cmsms_shortcodes.row_field_left_custom_padding_descr + "<br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.size_note_percentage + "</span>", 
			def : 		'3', 
			required : 	false, 
			width : 	'number', 
			min : 		'0', 
			max : 		'100', 
			depend : 	'width:fullwidth' 
		}, 
		// Right Custom Padding
		padding_right : { 
			type : 		'input', 
			title : 	cmsms_shortcodes.row_field_right_custom_padding_title, 
			descr : 	cmsms_shortcodes.row_field_right_custom_padding_descr + "<br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.size_note_percentage + "</span>", 
			def : 		'3', 
			required : 	false, 
			width : 	'number', 
			min : 		'0', 
			max : 		'100', 
			depend : 	'width:fullwidth' 
		}, 
		// Merge with the Next Section
		merge : { 
			type : 		'checkbox', 
			title : 	cmsms_shortcodes.row_field_merge_title, 
			descr : 	cmsms_shortcodes.row_field_merge_descr + "<br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.row_field_merge_descr_note + "</span>", 
			def : 		'', 
			required : 	false, 
			width : 	'half', 
			choises : { 
						'true' : 	cmsms_shortcodes.choice_enable 
			} 
		}, 
		// Color Scheme
		color : { 
			type : 		'select', 
			title : 	cmsms_shortcodes.row_field_color_scheme_title, 
			descr : 	cmsms_shortcodes.row_field_color_scheme_descr, 
			def : 		'default', 
			required : 	false, 
			width : 	'half', 
			choises : 	cmsms_composer_colors() 
		}, 
		// Custom Background Color
		bg_color_custom : { 
			type : 		'checkbox', 
			title : 	cmsms_shortcodes.row_field_custom_bg_color_title, 
			descr : 	cmsms_shortcodes.row_field_custom_bg_color_descr, 
			def : 		'', 
			required : 	false, 
			width : 	'half', 
			choises : { 
						'true' : 	cmsms_shortcodes.choice_enable 
			}
		}, 
		// Background Color
		bg_color : { 
			type : 		'color', 
			title : 	cmsms_shortcodes.row_field_bg_color_title, 
			descr : 	cmsms_shortcodes.row_field_bg_color_descr, 
			def : 		'#ffffff', 
			required : 	false, 
			width : 	'half', 
			depend : 	'bg_color_custom:true' 
		}, 
		// Background Image
		bg_img : { 
			type : 			'upload', 
			title : 		cmsms_shortcodes.row_field_bg_image_title, 
			descr : 		cmsms_shortcodes.row_field_bg_image_descr, 
			def : 			'', 
			required : 		false, 
			width : 		'half', 
			frame : 		'post', 
			library : 		'image', 
			multiple : 		false, 
			description : 	false, 
			caption : 		false, 
			align : 		false, 
			link : 			false, 
			size : 			true 
		}, 
		// Background Position
		bg_position : { 
			type : 		'select', 
			title : 	cmsms_shortcodes.row_field_bg_position_title, 
			descr : 	cmsms_shortcodes.row_field_bg_position_descr, 
			def : 		'top center', 
			required : 	false, 
			width : 	'half', 
			choises : { 
						'top left' : 		cmsms_shortcodes.row_field_bg_position_choice_vert_top + ' - ' + cmsms_shortcodes.row_field_bg_position_choice_horiz_left, 
						'top center' : 		cmsms_shortcodes.row_field_bg_position_choice_vert_top + ' - ' + cmsms_shortcodes.row_field_bg_position_choice_horiz_center, 
						'top right' : 		cmsms_shortcodes.row_field_bg_position_choice_vert_top + ' - ' + cmsms_shortcodes.row_field_bg_position_choice_horiz_right, 
						'center left' : 	cmsms_shortcodes.row_field_bg_position_choice_vert_center + ' - ' + cmsms_shortcodes.row_field_bg_position_choice_horiz_left, 
						'center center' : 	cmsms_shortcodes.row_field_bg_position_choice_vert_center + ' - ' + cmsms_shortcodes.row_field_bg_position_choice_horiz_center, 
						'center right' : 	cmsms_shortcodes.row_field_bg_position_choice_vert_center + ' - ' + cmsms_shortcodes.row_field_bg_position_choice_horiz_right, 
						'bottom left' : 	cmsms_shortcodes.row_field_bg_position_choice_vert_bottom + ' - ' + cmsms_shortcodes.row_field_bg_position_choice_horiz_left, 
						'bottom center' : 	cmsms_shortcodes.row_field_bg_position_choice_vert_bottom + ' - ' + cmsms_shortcodes.row_field_bg_position_choice_horiz_center, 
						'bottom right' : 	cmsms_shortcodes.row_field_bg_position_choice_vert_bottom + ' - ' + cmsms_shortcodes.row_field_bg_position_choice_horiz_right 
			}, 
			depend : 	'bg_img:!' 
		}, 
		// Background Repeat
		bg_repeat : { 
			type : 		'radio', 
			title : 	cmsms_shortcodes.row_field_bg_repeat_title, 
			descr : 	cmsms_shortcodes.row_field_bg_repeat_descr, 
			def : 		'no-repeat', 
			required : 	false, 
			width : 	'half', 
			choises : { 
						'no-repeat' : 	cmsms_shortcodes.row_field_bg_repeat_choice_none, 
						'repeat-x' : 	cmsms_shortcodes.row_field_bg_repeat_choice_horiz, 
						'repeat-y' : 	cmsms_shortcodes.row_field_bg_repeat_choice_vert, 
						'repeat' : 		cmsms_shortcodes.row_field_bg_repeat_choice_repeat 
			}, 
			depend : 	'bg_img:!' 
		}, 
		// Background Attachment
		bg_attachment : { 
			type : 		'radio', 
			title : 	cmsms_shortcodes.row_field_bg_attachement_title, 
			descr : 	cmsms_shortcodes.row_field_bg_attachement_descr, 
			def : 		'scroll', 
			required : 	false, 
			width : 	'half', 
			choises : { 
						'scroll' : 	cmsms_shortcodes.row_field_bg_attachement_choice_scroll, 
						'fixed' : 	cmsms_shortcodes.row_field_bg_attachement_choice_fixed 
			}, 
			depend : 	'bg_img:!' 
		}, 
		// Background Size
		bg_size : { 
			type : 		'radio', 
			title : 	cmsms_shortcodes.row_field_bg_size_title, 
			descr : 	cmsms_shortcodes.row_field_bg_size_descr + "<br /><span>" + cmsms_shortcodes.row_field_bg_size_choice_auto + ': ' + cmsms_shortcodes.row_field_bg_size_descr_auto + "<br />" + cmsms_shortcodes.row_field_bg_size_choice_cover + ': ' + cmsms_shortcodes.row_field_bg_size_descr_cover + "<br />" + cmsms_shortcodes.row_field_bg_size_choice_contain + ': ' + cmsms_shortcodes.row_field_bg_size_descr_contain + "</span>", 
			def : 		'cover', 
			required : 	false, 
			width : 	'half', 
			choises : { 
						'auto' : 		cmsms_shortcodes.row_field_bg_size_choice_auto, 
						'cover' : 		cmsms_shortcodes.row_field_bg_size_choice_cover, 
						'contain' : 	cmsms_shortcodes.row_field_bg_size_choice_contain 
			}, 
			depend : 	'bg_img:!' 
		}, 
		// Background Parallax
		bg_parallax : { 
			type : 		'checkbox', 
			title : 	cmsms_shortcodes.row_field_bg_parallax_title, 
			descr : 	cmsms_shortcodes.row_field_bg_parallax_descr, 
			def : 		'', 
			required : 	false, 
			width : 	'half', 
			choises : { 
						'true' : 	cmsms_shortcodes.choice_enable 
			}, 
			depend : 	'bg_img:!' 
		}, 
		// Background Parallax Ratio
		bg_parallax_ratio : { 
			type : 		'input', 
			title : 	cmsms_shortcodes.row_field_bg_parallax_ratio_title, 
			descr : 	cmsms_shortcodes.row_field_bg_parallax_ratio_descr, 
			def : 		'0.5', 
			required : 	false, 
			width : 	'number', 
			min : 		'0.05', 
			max : 		'1', 
			step : 		'0.05', 
			depend : 	'bg_img:!' 
		}, 
		// Color Overlay Visibility
		overlay_show : { 
			type : 		'checkbox', 
			title : 	cmsms_shortcodes.row_field_color_overlay_visibility_title, 
			descr : 	cmsms_shortcodes.row_field_color_overlay_visibility_descr, 
			def : 		'', 
			required : 	false, 
			width : 	'half', 
			choises : { 
						'true' : 	cmsms_shortcodes.choice_enable 
			}
		}, 
		// Color Overlay
		color_overlay : { 
			type : 		'color', 
			title : 	cmsms_shortcodes.row_field_color_overlay_title, 
			descr : 	cmsms_shortcodes.row_field_color_overlay_descr, 
			def : 		'#000000', 
			required : 	false, 
			width : 	'half', 
			depend : 	'overlay_show:true' 
		}, 
		// Overlay Opacity
		overlay_opacity : { 
			type : 		'select', 
			title : 	cmsms_shortcodes.row_field_overlay_opacity_title, 
			descr : 	cmsms_shortcodes.row_field_overlay_opacity_descr + "<br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.row_field_overlay_opacity_descr_note + "</span>", 
			def : 		'50', 
			required : 	false, 
			width : 	'small', 
			choises : 	get_percentage(), 
			depend : 	'overlay_show:true' 
		}, 
		// Top Padding
		padding_top : { 
			type : 		'input', 
			title : 	cmsms_shortcodes.row_field_top_padding_title, 
			descr : 	cmsms_shortcodes.row_field_top_padding_descr + "<br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.size_note_short + ' ' + cmsms_shortcodes.value_zero + "</span>", 
			def : 		'0', 
			required : 	false, 
			width : 	'number', 
			min : 		'0' 
		}, 
		// Bottom Padding
		padding_bottom : { 
			type : 		'input', 
			title : 	cmsms_shortcodes.row_field_bottom_padding_title, 
			descr : 	cmsms_shortcodes.row_field_bottom_padding_descr + "<br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.size_note_short + ' ' + cmsms_shortcodes.value_zero + "</span>", 
			def : 		'50', 
			required : 	false, 
			width : 	'number', 
			min : 		'0' 
		}, 
		// Section ID
		id : { 
			type : 		'input', 
			title : 	cmsms_shortcodes.row_field_section_id_title, 
			descr : 	cmsms_shortcodes.row_field_section_id_descr + "<br /><span>" + cmsms_shortcodes.note + ' ' + cmsms_shortcodes.row_field_section_id_descr_note + "<span>", 
			def : 		'', 
			required : 	false, 
			width : 	'small' 
		}, 
		// Additional Classes
		classes : { 
			type : 		'input', 
			title : 	cmsms_shortcodes.classes_title, 
			descr : 	cmsms_shortcodes.row_field_classes_descr, 
			def : 		'', 
			required : 	false, 
			width : 	'half' 
		} 
	} 
};


// CSS3 Animations List
function get_animations() { 
	return { 
		'' : 					'None', 
		'bounceIn' : 			'Bounce In', 
		'bounceInUp' : 			'Bounce In Up', 
		'bounceInDown' : 		'Bounce In Down', 
		'bounceInLeft' : 		'Bounce In Left', 
		'bounceInRight' : 		'Bounce In Right', 
		'fadeIn' : 				'Fade In', 
		'fadeInUp' : 			'Fade In Up', 
		'fadeInUpBig' : 		'Fade In Up Big', 
		'fadeInDown' : 			'Fade In Down', 
		'fadeInDownBig' : 		'Fade In Down Big', 
		'fadeInLeft' : 			'Fade In Left', 
		'fadeInLeftBig' : 		'Fade In Left Big', 
		'fadeInRight' : 		'Fade In Right', 
		'fadeInRightBig' : 		'Fade In Right Big', 
		'flipInX' : 			'Flip In X', 
		'flipInY' : 			'Flip In Y', 
		'rotateIn' : 			'Rotate In', 
		'rotateInUpLeft' : 		'Rotate In Up Left', 
		'rotateInUpRight' : 	'Rotate In Up Right', 
		'rotateInDownLeft' : 	'Rotate In Down Left', 
		'rotateInDownRight' : 	'Rotate In Down Right', 
		'slideInDown' : 		'Slide In Down', 
		'slideInLeft' : 		'Slide In Left', 
		'slideInRight' : 		'Slide In Right', 
		'rollIn' : 				'Roll In', 
		'bounce' : 				'Bounce', 
		'flash' : 				'Flash', 
		'pulse' : 				'Pulse', 
		'shake' : 				'Shake', 
		'swing' : 				'Swing', 
		'tada' : 				'Tada', 
		'wobble' : 				'Wobble', 
		'flip' : 				'Flip', 
		'lightSpeedIn' : 		'Light Speed In' 
	};
}


// Sidebar Layouts List
function get_layouts() { 
	return { 
		'' : 			'1/1', 
		'1212' : 		'1/2 + 1/2', 
		'1323' : 		'1/3 + 2/3', 
		'2313' : 		'2/3 + 1/3', 
		'1434' : 		'1/4 + 3/4', 
		'3414' : 		'3/4 + 1/4', 
		'131313' : 		'1/3 + 1/3 + 1/3', 
		'121414' : 		'1/2 + 1/4 + 1/4', 
		'141214' : 		'1/4 + 1/2 + 1/4', 
		'141412' : 		'1/4 + 1/4 + 1/2', 
		'14141414' : 	'1/4 + 1/4 + 1/4 + 1/4' 
	};
}


// Percentage List
function get_percentage() { 
	return { 
		'0' : 		'0', 
		'1' : 		'1', 
		'2' : 		'2', 
		'3' : 		'3', 
		'4' : 		'4', 
		'5' : 		'5', 
		'6' : 		'6', 
		'7' : 		'7', 
		'8' : 		'8', 
		'9' : 		'9', 
		'10' : 		'10', 
		'11' : 		'11', 
		'12' : 		'12', 
		'13' : 		'13', 
		'14' : 		'14', 
		'15' : 		'15', 
		'16' : 		'16', 
		'17' : 		'17', 
		'18' : 		'18', 
		'19' : 		'19', 
		'20' : 		'20', 
		'21' : 		'21', 
		'22' : 		'22', 
		'23' : 		'23', 
		'24' : 		'24', 
		'25' : 		'25', 
		'26' : 		'26', 
		'27' : 		'27', 
		'28' : 		'28', 
		'29' : 		'29', 
		'30' : 		'30', 
		'31' : 		'31', 
		'32' : 		'32', 
		'33' : 		'33', 
		'34' : 		'34', 
		'35' : 		'35', 
		'36' : 		'36', 
		'37' : 		'37', 
		'38' : 		'38', 
		'39' : 		'39', 
		'40' : 		'40', 
		'41' : 		'41', 
		'42' : 		'42', 
		'43' : 		'43', 
		'44' : 		'44', 
		'45' : 		'45', 
		'46' : 		'46', 
		'47' : 		'47', 
		'48' : 		'48', 
		'49' : 		'49', 
		'50' : 		'50', 
		'51' : 		'51', 
		'52' : 		'52', 
		'53' : 		'53', 
		'54' : 		'54', 
		'55' : 		'55', 
		'56' : 		'56', 
		'57' : 		'57', 
		'58' : 		'58', 
		'59' : 		'59', 
		'60' : 		'60', 
		'61' : 		'61', 
		'62' : 		'62', 
		'63' : 		'63', 
		'64' : 		'64', 
		'65' : 		'65', 
		'66' : 		'66', 
		'67' : 		'67', 
		'68' : 		'68', 
		'69' : 		'69', 
		'70' : 		'70', 
		'71' : 		'71', 
		'72' : 		'72', 
		'73' : 		'73', 
		'74' : 		'74', 
		'75' : 		'75', 
		'76' : 		'76', 
		'77' : 		'77', 
		'78' : 		'78', 
		'79' : 		'79', 
		'80' : 		'80', 
		'81' : 		'81', 
		'82' : 		'82', 
		'83' : 		'83', 
		'84' : 		'84', 
		'85' : 		'85', 
		'86' : 		'86', 
		'87' : 		'87', 
		'88' : 		'88', 
		'89' : 		'89', 
		'90' : 		'90', 
		'91' : 		'91', 
		'92' : 		'92', 
		'93' : 		'93', 
		'94' : 		'94', 
		'95' : 		'95', 
		'96' : 		'96', 
		'97' : 		'97', 
		'98' : 		'98', 
		'99' : 		'99', 
		'100' : 	'100' 
	};
}

