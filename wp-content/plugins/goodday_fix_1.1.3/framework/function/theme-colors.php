<?php
/**
 * @package 	WordPress
 * @subpackage 	GoodDay
 * @version 	1.1.3
 * 
 * Theme Color Schemes Rules
 * Created by CMSMasters
 * 
 */


function cmsms_theme_colors() {
	$cmsms_option = cmsms_get_global_options();
	
	
	$cmsms_color_schemes = cmsms_color_schemes_list();
	
	
	unset($cmsms_color_schemes['header']);
	
	unset($cmsms_color_schemes['header_top']);
	
	
	$custom_css = "/**
 * @package 	WordPress
 * @subpackage 	GoodDay
 * @version 	1.1.3
 * 
 * Theme Color Schemes Rules
 * Created by CMSMasters
 * 
 */

";
	
	
	foreach ($cmsms_color_schemes as $scheme => $title) {
		$rule = (($scheme != 'default') ? "html .cmsms_color_scheme_{$scheme} " : '');
		
		
		$cmsms_link = explode('|', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_link']);
		
		$cmsms_bg = explode('|', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_bg']);
		
		$cmsms_alt = explode('|', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_alternate']);
		
		$cmsms_bd = explode('|', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_border']);
		
		
		$custom_css .= "
/***************** Start {$title} Color Scheme Rules ******************/

	/* Start Main Content Font Color */
	" . (($scheme == 'default') ? "body," : '') . (($scheme != 'default') ? ".cmsms_color_scheme_{$scheme}," : '') . "
	{$rule}.header_top_outer .meta_wrap,
	{$rule}.footer_inner, 
	{$rule}.tweet_time:before,
	{$rule}input[type=text],
	{$rule}input[type=number],
	{$rule}input[type=email],
	{$rule}input[type=password],
	{$rule}input[type=submit],
	{$rule}textarea,
	{$rule}select,
	{$rule}option,
	{$rule}.contact_widget_email:before,
	{$rule}.contact_widget_phone:before,
	{$rule}.adress_wrap:before,
	{$rule}.profiles.opened-article .profile .cmsms_profile_header .cmsms_profile_subtitle, 
	{$rule}.cmsms_pricing_table .cmsms_period, 
	{$rule}.cmsms_stats.stats_mode_counters.stats_type_numbers .cmsms_stat_wrap .cmsms_stat .cmsms_stat_inner .cmsms_stat_title, 
	{$rule}.cmsms_breadcrumbs .cmsms_breadcrumbs_inner, 
	{$rule}.cmsms_breadcrumbs .cmsms_breadcrumbs_inner a, 
	{$rule}.widget_nav_menu li a:before, 
	{$rule}.about_author .about_author_inner .social_wrap .social_wrap_inner ul li a {
		" . cmsms_color_css('color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_color']) . "
	}
	
	{$rule}input::-webkit-input-placeholder {
		" . cmsms_color_css('color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_color']) . "
	}
	{$rule}input:-moz-placeholder {
		" . cmsms_color_css('color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_color']) . "
	}
	
	{$rule}.cmsms_toggles .cmsms_toggle_wrap .cmsms_toggle_title > .cmsms_toggle_plus .cmsms_toggle_plus_hor,
	{$rule}.cmsms_toggles .cmsms_toggle_wrap .cmsms_toggle_title > .cmsms_toggle_plus .cmsms_toggle_plus_vert {
		" . cmsms_color_css('background-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_color']) . "
	}
	/* Finish Main Content Font Color */
	
	
	/* Start Primary Color */
	{$rule}a,
	{$rule}h1 a:hover,
	{$rule}h2 a:hover,
	{$rule}h3 a:hover,
	{$rule}h4 a:hover,
	{$rule}h5 a:hover,
	{$rule}h6 a:hover,
	{$rule}.color_2,
	{$rule}#navigation ul li a,
	{$rule}#navigation > li.menu-item-mega li:hover > a,
	{$rule}#navigation > li.menu-item-mega li.current-menu-ancestor > a,
	{$rule}#navigation > li.menu-item-mega > div.menu-item-mega-container li > a:hover,
	{$rule}#navigation > li.menu-item-mega > div.menu-item-mega-container li.current-menu-item > a,
	{$rule}#navigation > li.menu-item-mega > div.menu-item-mega-container > ul > li > a[href]:hover,
	{$rule}#navigation > li.menu-item-mega > div.menu-item-mega-container > ul li li:hover > a,
	{$rule}.header_top_outer nav > div > ul > li a,
	{$rule}.header_top_outer .meta_wrap a,
	{$rule}.footer_inner a,
	{$rule}.cmsms_icon_list_items.cmsms_color_type_icon .cmsms_icon_list_icon:before,
	{$rule}.post .cmsms_post_date .cmsms_day_mon,
	{$rule}.cmsmsLike:hover:before,
	{$rule}.cmsmsLike.active:before,
	{$rule}.project .cmsms_project_comments:hover:before, 
	{$rule}.cmsms_posts_slider .project .cmsms_slider_project_comments:hover:before, 
	{$rule}.profile .cmsms_profile_comments:hover:before, 
	{$rule}.post.cmsms_masonry_type .cmsms_post_cont .cmsms_post_footer .cmsms_post_meta_info .cmsmsLike:hover:before,
	{$rule}.post.cmsms_masonry_type .cmsms_post_cont .cmsms_post_footer .cmsms_post_meta_info .cmsmsLike.active:before,
	{$rule}.post .cmsms_post_cont .cmsms_post_footer .cmsms_post_meta_info .cmsms_post_comments:hover:before,
	{$rule}.post.cmsms_masonry_type .cmsms_post_cont .cmsms_post_footer .cmsms_post_meta_info .cmsms_post_comments:hover:before,
	{$rule}.post.cmsms_masonry_type.format-aside .cmsms_post_cont .cmsms_post_footer .cmsms_post_meta_info .cmsms_post_comments:hover:before,
	{$rule}.post.cmsms_masonry_type.format-aside .cmsms_post_cont .cmsms_post_footer .cmsms_post_meta_info a.cmsmsLike:hover:before,
	{$rule}.post.cmsms_masonry_type.format-aside .cmsms_post_cont .cmsms_post_footer .cmsms_post_meta_info a.cmsmsLike.active:before,
	{$rule}.cmsms_post_comments:hover:before, 
	{$rule}.cmsms_search_post_comments:hover:before, 
	{$rule}.post.format-link .cmsms_post_header .cmsms_post_title a,
	{$rule}.post_nav a:hover,
	{$rule}.img_placeholder_small:hover,
	{$rule}.related_posts .related_posts_content .related_posts_content_tab .rel_post_content figure.alignleft .img_placeholder:hover, 
	{$rule}.profiles.opened-article .profile .profile_sidebar .profile_social_icons .profile_social_icons_list li a:hover, 
	{$rule}.cmsms_posts_slider .post .cmsms_slider_post_cont .cmsms_slider_post_footer .cmsms_slider_post_meta_info .cmsmsLike:hover:before, 
	{$rule}.cmsms_posts_slider .post .cmsms_slider_post_cont .cmsms_slider_post_footer .cmsms_slider_post_meta_info .cmsmsLike.active:before,
	{$rule}.cmsms_posts_slider .post .cmsms_slider_post_cont .cmsms_slider_post_footer .cmsms_slider_post_meta_info .cmsms_slider_post_comments:hover:before, 
	{$rule}.cmsms_posts_slider .post .cmsms_slider_post_cont .cmsms_slider_post_header .cmsms_slider_post_title a:hover, 
	{$rule}.pl_social_list li a:hover,
	{$rule}q:before,
	{$rule}blockquote:before,
	{$rule}.cmsms_breadcrumbs .cmsms_breadcrumbs_inner a:hover, 
	{$rule}.post_comments .commentlist > li.bypostauthor .fn:before, 
	{$rule}.cmsms_sitemap_wrap .cmsms_sitemap > li > a:hover, 
	{$rule}.cmsms_sitemap_wrap .cmsms_sitemap > li > ul > li > a:hover, 
	{$rule}.cmsms_sitemap_wrap .cmsms_sitemap_category > li > a:hover, 
	{$rule}.about_author .about_author_inner .social_wrap .social_wrap_inner ul li a:hover {
		" . cmsms_color_css('color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_link']) . "
	}
	
	{$rule}.cmsms_table tr.cmsms_table_row_header td,
	{$rule}.cmsms_table tr.cmsms_table_row_header th,
	{$rule}.cmsms_icon_box.cmsms_box_colored,
	{$rule}.cmsms_icon_box.cmsms_box_lefticon:before,
	{$rule}.cmsms_toggles .cmsms_toggle_wrap .cmsms_toggle_title:hover > .cmsms_toggle_plus,
	{$rule}.cmsms_toggles .cmsms_toggle_wrap.current_toggle .cmsms_toggle_title .cmsms_toggle_plus,
	{$rule}.cmsms_tabs .cmsms_tabs_list .cmsms_tabs_list_item.current_tab > a,
	{$rule}.cmsms_tabs .cmsms_tabs_list .cmsms_tabs_list_item > a:hover,
	{$rule}.cmsms_icon_list_items.cmsms_color_type_bg .cmsms_icon_list_item .cmsms_icon_list_icon,
	{$rule}.cmsms_icon_list_items.cmsms_color_type_icon .cmsms_icon_list_item:hover .cmsms_icon_list_icon,
	{$rule}.cmsms_stats.stats_mode_bars .cmsms_stat_wrap .cmsms_stat .cmsms_stat_inner,
	{$rule}.cmsms_button,
	{$rule}.button:hover,
	{$rule}.cmsms_paypal_donations > form:hover + .button, 
	{$rule}.current > .button,
	{$rule}.button.current,
	{$rule}input[type=submit]:hover,
	{$rule}input[type=button]:hover,
	{$rule}button:hover,
	{$rule}.comment-reply-link:hover,
	{$rule}#cancel-comment-reply-link:hover,
	{$rule}.post.cmsms_default_type.format-aside .cmsms_post_cont,
	{$rule}.post.cmsms_timeline_type.format-aside .cmsms_post_cont,
	{$rule}.opened-article .post.format-aside .cmsms_post_cont,
	{$rule}.related_posts > ul li > a:hover,
	{$rule}.related_posts > ul li > a.current,
	{$rule}.post.cmsms_masonry_type.format-aside .cmsms_post_cont .cmsms_post_content, 
	{$rule}.cmsms_posts_slider .post.format-aside .cmsms_slider_post_cont .cmsms_slider_post_content,  
	{$rule}.cmsms_wrap_pagination ul li .page-numbers:hover, 
	{$rule}.cmsms_dropcap.type2, 
	{$rule}.cmsms_wrap_pagination ul li .page-numbers.current, 
	{$rule}.cmsms_post_format_img.cmsms-icon-attach-6, 
	{$rule}.responsive_nav {
		" . cmsms_color_css('background-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_link']) . "
	}
	
	{$rule}.cmsms_table tr.cmsms_table_row_header td,
	{$rule}.cmsms_table tr.cmsms_table_row_header th,
	{$rule}.cmsms_table tr.cmsms_table_row_header td:first-child,
	{$rule}.cmsms_table tr.cmsms_table_row_header th:first-child,
	{$rule}.cmsms_table tr.cmsms_table_row_header td:last-child,
	{$rule}.cmsms_table tr.cmsms_table_row_header th:last-child,
	{$rule}.cmsms_toggles .cmsms_toggle_wrap .cmsms_toggle_title:hover > .cmsms_toggle_plus,
	{$rule}.cmsms_toggles .cmsms_toggle_wrap.current_toggle .cmsms_toggle_title .cmsms_toggle_plus,
	{$rule}.cmsms_tabs .cmsms_tabs_list .cmsms_tabs_list_item.current_tab > a,
	{$rule}.cmsms_tabs .cmsms_tabs_list .cmsms_tabs_list_item > a:hover,
	{$rule}.cmsms_tabs .cmsms_tabs_list .cmsms_tabs_list_item.current_tab:first-child > a,
	{$rule}.cmsms_tabs .cmsms_tabs_list .cmsms_tabs_list_item:first-child > a:hover,
	{$rule}.cmsms_tabs.tabs_mode_tour .cmsms_tabs_list .cmsms_tabs_list_item.current_tab > a,
	{$rule}.cmsms_tabs.tabs_mode_tour .cmsms_tabs_list .cmsms_tabs_list_item > a:hover,
	{$rule}.cmsms_tabs.tabs_mode_tour .cmsms_tabs_list .cmsms_tabs_list_item.current_tab:first-child > a,
	{$rule}.cmsms_tabs.tabs_mode_tour .cmsms_tabs_list .cmsms_tabs_list_item:first-child > a:hover,
	{$rule}.cmsms_icon_list_items.cmsms_color_type_border .cmsms_icon_list_item .cmsms_icon_list_icon,
	{$rule}.related_posts > ul li > a:hover,
	{$rule}.related_posts > ul li > a.current,
	{$rule}.related_posts > ul li:first-child > a:hover,
	{$rule}.related_posts > ul li:first-child > a.current {
		" . cmsms_color_css('border-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_link']) . "
	}
	
	@media only screen and (max-width: 540px) {
		{$rule}.cmsms_tabs .cmsms_tabs_list .cmsms_tabs_list_item.current_tab > a, 
		{$rule}.cmsms_tabs .cmsms_tabs_list .cmsms_tabs_list_item > a:hover, 
		{$rule}.related_posts > ul li > a.current, 
		{$rule}.related_posts > ul li > a:hover {
			" . cmsms_color_css('border-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_link']) . "
		}
	}
	/* Finish Primary Color */
	
	
	/* Start Highlight Color */
	{$rule}a:hover,
	{$rule}#navigation > li li.menu-item-highlight > a,
	{$rule}#navigation > li li.menu-item-highlight > a:hover,
	{$rule}#navigation > li li.menu-item-highlight:hover > a,
	{$rule}#navigation > li.menu-item-mega > div.menu-item-mega-container li.menu-item-highlight > a,
	{$rule}#navigation > li.menu-item-mega > div.menu-item-mega-container li.menu-item-highlight > a:hover,
	{$rule}#navigation > li.menu-item-mega > div.menu-item-mega-container li.menu-item-highlight:hover > a,
	{$rule}#navigation > li.menu-item-mega > div.menu-item-mega-container li.menu-item-highlight:hover > a:hover,
	{$rule}.footer_inner a:hover,
	{$rule}.footer_inner nav > div > ul > li:hover > a,
	{$rule}.footer_inner nav > div > ul > li.current-menu-item > a,
	{$rule}.footer_inner nav > div > ul > li.current-menu-ancestor > a,
	{$rule}.cmsms_toggles .cmsms_toggles_filter > a.current_filter,
	{$rule}.widget_nav_menu ul li.current-menu-item a,
	{$rule}.img_placeholder_small,
	{$rule}.wpcf7 form.wpcf7-form span.wpcf7-list-item input[type=\"checkbox\"] + span.wpcf7-list-item-label:after,
	{$rule}.cmsms-form-builder .check_parent input[type=\"checkbox\"]+label:after, 
	{$rule}.pl_social_list li a, 
	{$rule}.post_nav a {
		" . cmsms_color_css('color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_hover']) . "
	}
	
	{$rule}.owl-buttons .owl-prev:hover,
	{$rule}.owl-buttons .owl-next:hover,
	{$rule}.owl-page:hover, 
	{$rule}.owl-page.active, 
	{$rule}.cmsms_quotes_slider .owl-buttons > div:hover .cmsms_next_arrow, 
	{$rule}.cmsms_quotes_slider .owl-buttons > div:hover .cmsms_prev_arrow, 
	{$rule}.widget_custom_latest_projects_entries .owl-buttons > div:hover .cmsms_next_arrow,
	{$rule}.widget_custom_popular_projects_entries .owl-buttons > div:hover .cmsms_next_arrow,
	{$rule}.widget_custom_latest_projects_entries .owl-buttons > div:hover .cmsms_prev_arrow,
	{$rule}.widget_custom_popular_projects_entries .owl-buttons > div:hover .cmsms_prev_arrow,
	{$rule}.cmsms_clients_slider .owl-buttons > div:hover .cmsms_next_arrow,
	{$rule}.cmsms_clients_slider .owl-buttons > div:hover .cmsms_prev_arrow,
	{$rule}.cmsms-form-builder .check_parent input[type=\"radio\"]+label:after,
	{$rule}.wpcf7 form.wpcf7-form span.wpcf7-list-item input[type=\"radio\"] + span.wpcf7-list-item-label:after,
	{$rule}.header_mid_outer .header_mid_inner #navigation > li.menu-item-highlight > a > span.nav_bg_clr,
	{$rule}.header_bot_inner #navigation > li.menu-item-highlight > a > span.nav_bg_clr {
		" . cmsms_color_css('background-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_hover']) . "
	}
	
	{$rule}.widget_custom_latest_projects_entries .owl-buttons > div:hover .cmsms_next_arrow:after,
	{$rule}.widget_custom_popular_projects_entries .owl-buttons > div:hover .cmsms_next_arrow:after,
	{$rule}.widget_custom_latest_projects_entries .owl-buttons > div:hover .cmsms_prev_arrow:after,
	{$rule}.widget_custom_popular_projects_entries .owl-buttons > div:hover .cmsms_prev_arrow:after,
	{$rule}.widget_custom_latest_projects_entries .owl-buttons > div:hover .cmsms_next_arrow:before,
	{$rule}.widget_custom_popular_projects_entries .owl-buttons > div:hover .cmsms_next_arrow:before,
	{$rule}.widget_custom_latest_projects_entries .owl-buttons > div:hover .cmsms_prev_arrow:before,
	{$rule}.widget_custom_popular_projects_entries .owl-buttons > div:hover .cmsms_prev_arrow:before,
	{$rule}.cmsms_clients_slider .owl-buttons > div:hover .cmsms_next_arrow:after,
	{$rule}.cmsms_clients_slider .owl-buttons > div:hover .cmsms_prev_arrow:after,
	{$rule}.cmsms_clients_slider .owl-buttons > div:hover .cmsms_next_arrow:before,
	{$rule}.cmsms_clients_slider .owl-buttons > div:hover .cmsms_prev_arrow:before,
	{$rule}.cmsms_quotes_slider .owl-buttons > div:hover .cmsms_next_arrow:after,
	{$rule}.cmsms_quotes_slider .owl-buttons > div:hover .cmsms_prev_arrow:after,
	{$rule}.cmsms_quotes_slider .owl-buttons > div:hover .cmsms_next_arrow:before,
	{$rule}.cmsms_quotes_slider .owl-buttons > div:hover .cmsms_prev_arrow:before {
		" . cmsms_color_css('border-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_hover']) . "
	}
	/* Finish Highlight Color */
	
	
	/* Start Headings Color */
	{$rule}h1,
	{$rule}h2,
	{$rule}h3,
	{$rule}h4,
	{$rule}h5,
	{$rule}h6,
	{$rule}h1 a,
	{$rule}h2 a,
	{$rule}h3 a,
	{$rule}h4 a,
	{$rule}h5 a,
	{$rule}h6 a,
	{$rule}#navigation ul li:hover > a,
	{$rule}#navigation ul li.current-menu-item > a,
	{$rule}#navigation ul li.current-menu-ancestor > a,
	{$rule}#navigation > li.menu-item-mega li li > a:hover,
	{$rule}#navigation > li.menu-item-mega > ul > li > a,
	{$rule}#navigation > li.menu-item-mega > ul > li:hover > a,
	{$rule}#navigation > li.menu-item-mega > div.menu-item-mega-container li:hover > a,
	{$rule}#navigation > li.menu-item-mega > div.menu-item-mega-container > ul > li > a,
	{$rule}#navigation > li.menu-item-mega > div.menu-item-mega-container > ul > li > a:hover,
	{$rule}#navigation > li.menu-item-mega > div.menu-item-mega-container > ul li li:hover > a:hover,
	{$rule}.header_top_outer nav > div > ul > li:hover > a,
	{$rule}.header_top_outer nav > div > ul > li.current-menu-item > a,
	{$rule}.header_top_outer nav > div > ul > li.current-menu-ancestor > a,
	{$rule}.header_top_outer nav > div > ul > li ul li:hover > a,
	{$rule}.header_top_outer nav > div > ul > li ul li.current-menu-item > a,
	{$rule}.header_top_outer nav > div > ul > li ul li.current-menu-ancestor > a,
	{$rule}.header_top_outer .meta_wrap a:hover,
	{$rule}#navigation > li > a,
	{$rule}.header_mid_outer .header_mid_inner .search_wrap .search_bar_wrap button[type=submit][class^=\"cmsms-icon-\"],
	{$rule}.header_mid_outer .header_mid_inner .search_wrap .search_bar_wrap button[type=submit][class*=\" cmsms-icon-\"],
	{$rule}.header_mid_outer .header_mid_inner .search_wrap .search_but,
	{$rule}.search_bar_wrap button[type=submit][class^=\"cmsms-icon-\"],
	{$rule}.search_bar_wrap button[type=submit][class*=\" cmsms-icon-\"],
	" . (($scheme == 'default') ? "#slide_top:hover," : '') . "
	{$rule}.cmsms_notice .notice_close,
	{$rule}.cmsms_icon_box.cmsms_box_colored .icon_box_button,
	{$rule}.cmsms_icon_box.cmsms_box_colored .icon_box_button:hover,
	{$rule}.cmsms_icon_box.cmsms_box_centered:before,
	{$rule}.cmsms_featured_block .featured_block_inner .featured_block_button,
	{$rule}.cmsms_toggles .cmsms_toggle_wrap .cmsms_toggle_title > a,
	{$rule}.cmsms_tabs .cmsms_tabs_list .cmsms_tabs_list_item > a,
	{$rule}.post .cmsms_post_date .cmsms_year,
	{$rule}.post .cmsms_post_cont_info,
	{$rule}.cmsms_search_post_cont_info,
	{$rule}.cmsms_posts_slider .post .cmsms_slider_post_cont_info,
	{$rule}.cmsmsLike,
	{$rule}.cmsmsLike:hover,
	{$rule}.opened-article .post .cmsms_post_footer .cmsms_post_meta_info .cmsms_post_date,
	{$rule}.cmsms_search_post_date,
	{$rule}.cmsms_post_comments,
	{$rule}.cmsms_post_comments:hover,
	{$rule}.cmsms_search_post_comments,
	{$rule}.post.format-chat .cmsms_post_cont .cmsms_chat .cmsms_chat_item .cmsms_chat_author_time .cmsms_chat_author,
	{$rule}.cmsms_posts_slider .post.format-chat .cmsms_slider_post_cont .cmsms_slider_post_chat .cmsms_chat_item .cmsms_chat_author_time .cmsms_chat_author,
	{$rule}.related_posts > ul li > a,
	{$rule}.related_posts .related_posts_content .related_posts_content_tab .rel_post_content figure.alignleft .img_placeholder,
	{$rule}.post.cmsms_masonry_type .cmsms_post_cont .cmsms_post_footer .cmsms_post_meta_info .cmsms_post_date,
	{$rule}.post.cmsms_masonry_type.format-aside .cmsms_post_cont .cmsms_post_footer .cmsms_post_meta_info .cmsms_post_date,
	{$rule}.post.cmsms_masonry_type.format-status .cmsms_post_cont .cmsms_post_footer .cmsms_post_meta_info .cmsms_post_date,
	{$rule}.post.cmsms_masonry_type .cmsms_post_cont .cmsms_post_footer .cmsms_post_meta_info .cmsmsLike,
	{$rule}.post.cmsms_masonry_type .cmsms_post_cont .cmsms_post_footer .cmsms_post_meta_info .cmsms_post_comments, 
	{$rule}.post.format-link .cmsms_post_header .cmsms_post_title a:hover,
	{$rule}.post.format-aside .cmsms_post_cont .cmsms_post_footer .cmsms_post_cont_info a,
	{$rule}.post.format-aside .cmsms_post_cont .cmsms_post_footer .cmsms_post_meta_info a.cmsmsLike:hover:before,
	{$rule}.post.format-aside .cmsms_post_cont .cmsms_post_footer .cmsms_post_meta_info a.cmsmsLike.active:before,
	{$rule}.post.format-aside .cmsms_post_cont .cmsms_post_footer .cmsms_post_meta_info .cmsms_post_comments:hover:before,
	{$rule}.project .cmsms_project_cont_info, 
	{$rule}.project .cmsmsLike, 
	{$rule}.project .cmsms_project_comments, 
	{$rule}.cmsms_posts_slider .project .cmsms_slider_project_cont_info, 
	{$rule}.cmsms_posts_slider .project .cmsmsLike, 
	{$rule}.cmsms_posts_slider .project .cmsms_slider_project_comments, 
	{$rule}.profile .cmsms_profile_comments, 
	{$rule}.cmsms_img_rollover_wrap .img_placeholder:before, 
	{$rule}#wp-calendar thead th,
	{$rule}.profiles.opened-article .profile .profile_sidebar .profile_social_icons .profile_social_icons_list li a, 
	{$rule}.cmsms_posts_slider .post .cmsms_slider_post_cont .cmsms_slider_post_footer .cmsms_slider_post_meta_info .cmsms_slider_post_date, 
	{$rule}.cmsms_posts_slider .post .cmsms_slider_post_cont .cmsms_slider_post_footer .cmsms_slider_post_meta_info .cmsmsLike, 
	{$rule}.cmsms_posts_slider .post .cmsms_slider_post_cont .cmsms_slider_post_footer .cmsms_slider_post_meta_info .cmsms_slider_post_comments, 
	{$rule}.cmsms_posts_slider .post .cmsms_slider_post_cont .cmsms_slider_post_header .cmsms_slider_post_title, 
	{$rule}#header .logo, 
	{$rule}.cmsms_pricing_table .cmsms_pricing_item .cmsms_price_wrap .cmsms_currency, 
	{$rule}.cmsms_pricing_table .cmsms_pricing_item .cmsms_price_wrap .cmsms_price, 
	{$rule}.cmsms_pricing_table .cmsms_pricing_item .cmsms_price_wrap .cmsms_coins,
	{$rule}.cmsms_posts_slider .post .cmsms_slider_post_cont .cmsms_slider_post_header .cmsms_slider_post_title a, 
	{$rule}.cmsms_sitemap_wrap .cmsms_sitemap > li > a, 
	{$rule}.cmsms_sitemap_wrap .cmsms_sitemap > li > ul > li > a, 
	{$rule}.cmsms_sitemap_wrap .cmsms_sitemap > li > ul > li > ul li a:before, 
	{$rule}.cmsms_sitemap_wrap .cmsms_sitemap_category > li > a, 
	{$rule}.cmsms_sitemap_wrap .cmsms_sitemap_category > li > ul li a:before, 
	{$rule}.cmsms_sitemap_wrap .cmsms_sitemap_archive > li a:before {
		" . cmsms_color_css('color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_heading']) . "
	}
	
	{$rule}.header_top_outer nav > div > ul > li > a > span.cmsms_count,
	{$rule}#navigation > li:hover > a,
	{$rule}#navigation > li.current-menu-item > a,
	{$rule}#navigation > li.current-menu-ancestor > a,
	{$rule}.header_mid_outer .header_mid_inner #navigation > li > a > span.nav_bg_clr,
	{$rule}.header_bot_inner #navigation > li > a > span.nav_bg_clr,
	{$rule}.cmsms_icon_list_items .cmsms_icon_list_item .cmsms_icon_list_icon,
	{$rule}.cmsms_stats.stats_mode_counters.stats_type_circles .cmsms_stat_wrap .cmsms_stat .cmsms_stat_inner,
	{$rule}.cmsms_post_format_img,
	{$rule}.cmsms_search .cmsms_search_post .cmsms_search_post_number, 
	{$rule}.cmsms_slider_post_format_img,
	{$rule}.button,
	{$rule}.cmsms_paypal_donations > .button, 
	{$rule}input[type=submit],
	{$rule}input[type=button],
	{$rule}button,
	{$rule}.comment-reply-link,
	{$rule}#cancel-comment-reply-link,
	{$rule}.post.format-quote .cmsms_quote_content,
	{$rule}.post.cmsms_default_type.format-status .cmsms_post_cont,
	{$rule}.post.cmsms_timeline_type.format-status .cmsms_post_cont,
	{$rule}.opened-article .post.format-status .cmsms_post_cont,
	{$rule}.cmsms_prev_arrow,
	{$rule}.cmsms_next_arrow,
	{$rule}.post.cmsms_masonry_type.format-status .cmsms_post_cont .cmsms_post_content, 
	{$rule}.cmsms_posts_slider .post.format-status .cmsms_slider_post_cont .cmsms_slider_post_content, 
	{$rule}.cmsms_wrap_pagination ul li .page-numbers, 
	{$rule}.owl-carousel .owl-controls .owl-pagination .owl-page:hover, 
	{$rule}.owl-carousel .owl-controls .owl-pagination .owl-page.active, 
	{$rule}.cmsms_posts_slider .post.format-quote .cmsms_slider_post_cont .cmsms_slider_post_quote_content, 
	{$rule}.responsive_nav:hover, 
	{$rule}.responsive_nav.active {
		" . cmsms_color_css('background-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_heading']) . "
	}
	
	{$rule}input[type=text]:focus,
	{$rule}input[type=email]:focus,
	{$rule}input[type=password]:focus,
	{$rule}textarea:focus,
	{$rule}select:focus,
	{$rule}#navigation > li:hover > a,
	{$rule}#navigation > li.current-menu-item > a,
	{$rule}#navigation > li.current-menu-ancestor > a,
	{$rule}.cmsms_prev_arrow:before,
	{$rule}.cmsms_next_arrow:before,
	{$rule}.cmsms_prev_arrow:after,
	{$rule}.cmsms_next_arrow:after,
	{$rule}.cmsms_prev_arrow span:before,
	{$rule}.cmsms_next_arrow span:before,
	{$rule}.cmsms_prev_arrow span:after,
	{$rule}.cmsms_next_arrow span:after, 
	{$rule}.cmsms_posts_slider .owl-controls .owl-buttons .owl-prev:hover, 
	{$rule}.cmsms_posts_slider .owl-controls .owl-buttons .owl-next:hover {
		" . cmsms_color_css('border-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_heading']) . "
	}
	
	{$rule}.post.format-quote .cmsms_quote_content:before, 
	{$rule}.cmsms_posts_slider .post.format-quote .cmsms_slider_post_cont .cmsms_slider_post_quote_content:before {
		" . cmsms_color_css('border-' . (is_rtl() ? 'left' : 'right') . '-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_heading']) . "
	}
	/* Finish Headings Color */
	
	
	/* Start Main Background Color */
	{$rule}.cmsms_table tr.cmsms_table_row_header td,
	{$rule}.cmsms_table tr.cmsms_table_row_header th,
	{$rule}#navigation > li:hover > a,
	{$rule}#navigation > li.current-menu-item > a,
	{$rule}#navigation > li.current-menu-ancestor > a,
	{$rule}.header_top_outer nav > div > ul > li > a > span.cmsms_count,
	{$rule}.header_mid_outer .header_mid_inner #navigation > li:hover > a,
	{$rule}.header_mid_outer .header_mid_inner #navigation > li.current-menu-item > a,
	{$rule}.header_mid_outer .header_mid_inner #navigation > li.current-menu-ancestor > a,
	{$rule}.header_mid_outer .header_mid_inner #navigation > li.menu-item-highlight > a,
	{$rule}.header_bot_inner #navigation > li.menu-item-highlight > a,
	" . (($scheme == 'default') ? "#slide_top," : '') . "
	{$rule}.cmsms_icon_box.cmsms_box_lefticon:before,
	{$rule}.cmsms_icon_box.cmsms_box_colored,
	{$rule}.cmsms_icon_box.cmsms_box_colored a:hover,
	{$rule}.cmsms_icon_box.cmsms_box_colored h1,
	{$rule}.cmsms_icon_box.cmsms_box_colored h2,
	{$rule}.cmsms_icon_box.cmsms_box_colored h3,
	{$rule}.cmsms_icon_box.cmsms_box_colored h4,
	{$rule}.cmsms_icon_box.cmsms_box_colored h5,
	{$rule}.cmsms_icon_box.cmsms_box_colored h6,
	{$rule}.cmsms_tabs .cmsms_tabs_list .cmsms_tabs_list_item.current_tab > a,
	{$rule}.cmsms_tabs .cmsms_tabs_list .cmsms_tabs_list_item > a:hover,
	{$rule}.cmsms_icon_list_items.cmsms_color_type_border .cmsms_icon_list_item .cmsms_icon_list_icon:before,
	{$rule}.cmsms_stats.stats_mode_bars .cmsms_stat_wrap .cmsms_stat .cmsms_stat_inner,
	{$rule}.cmsms_stats.stats_mode_counters.stats_type_circles .cmsms_stat_wrap .cmsms_stat .cmsms_stat_inner,
	{$rule}.cmsms_button,
	{$rule}.cmsms_button:hover,
	{$rule}.button,
	{$rule}.button:hover,
	{$rule}input[type=submit],
	{$rule}input[type=submit]:hover,
	{$rule}input[type=button],
	{$rule}input[type=button]:hover,
	{$rule}button,
	{$rule}button:hover,
	{$rule}.cmsms_post_format_img,
	{$rule}.cmsms_search .cmsms_search_post .cmsms_search_post_number, 
	{$rule}.cmsms_slider_post_format_img,
	{$rule}.post.format-quote .cmsms_quote_content,
	{$rule}.post.format-aside .cmsms_post_cont .cmsms_post_content,
	{$rule}.post.format-aside .cmsms_post_cont .cmsms_post_footer .cmsms_post_cont_info,
	{$rule}.post.format-aside .cmsms_post_cont .cmsms_post_footer .cmsms_post_cont_info a:hover,
	{$rule}.post.format-aside .cmsms_post_cont .cmsms_post_footer .cmsms_post_meta_info a,
	{$rule}.post.format-aside .cmsms_post_cont .cmsms_post_footer .cmsms_post_meta_info .cmsms_post_date,
	{$rule}.post.format-status .cmsms_post_cont .cmsms_post_content,
	{$rule}.post.format-status .cmsms_post_cont .cmsms_post_footer .cmsms_post_cont_info,
	{$rule}.post.format-status .cmsms_post_cont .cmsms_post_footer .cmsms_post_cont_info a:hover,
	{$rule}.post.format-status .cmsms_post_cont .cmsms_post_footer .cmsms_post_meta_info a,
	{$rule}.post.format-status .cmsms_post_cont .cmsms_post_footer .cmsms_post_meta_info .cmsms_post_date,
	{$rule}.related_posts > ul li > a:hover,
	{$rule}.related_posts > ul li > a.current, 
	{$rule}.cmsms_wrap_pagination ul li .page-numbers, 
	{$rule}.cmsms_posts_slider .post.format-quote .cmsms_slider_post_cont .cmsms_slider_post_quote_content,
	{$rule}.cmsms_posts_slider .post.format-status .cmsms_slider_post_cont .cmsms_slider_post_content,
	{$rule}.cmsms_posts_slider .post.format-aside .cmsms_slider_post_cont .cmsms_slider_post_content, 
	{$rule}.cmsms_dropcap.type2, 
	{$rule}.responsive_nav:before,
	{$rule}.comment-reply-link,
	{$rule}.comment-reply-link:hover,
	{$rule}#cancel-comment-reply-link,
	{$rule}#cancel-comment-reply-link:hover {
		" . cmsms_color_css('color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_bg']) . "
	}
	
	" . (($scheme == 'default') ? "body," : '') . (($scheme != 'default') ? ".cmsms_color_scheme_{$scheme}," : '') . "
	{$rule}input[type=text]:focus,
	{$rule}input[type=number]:focus,
	{$rule}input[type=email]:focus,
	{$rule}input[type=password]:focus,
	{$rule}textarea:focus,
	{$rule}select:focus,
	{$rule}#navigation ul,
	{$rule}#navigation > li.menu-item-mega li:hover > a,
	{$rule}#navigation > li.menu-item-mega li.current-menu-ancestor > a,
	{$rule}#navigation > li.menu-item-mega > div.menu-item-mega-container,
	{$rule}.header_top_outer,
	{$rule}.header_mid_outer,
	{$rule}.header_bot_outer,
	{$rule}.header_mid_outer .header_mid_inner .search_wrap.search_opened .search_but,
	" . (($scheme == 'default') ? ".middle_inner," : '') . "
	" . (($scheme != 'default') ? "{$rule}.bottom_bg," : '') . "
	{$rule}.footer_bg,
	" . (($scheme == 'default') ? "#slide_top:hover," : '') . "
	" . (($scheme != 'default') ? "{$rule}.headline_outer," : '') . "
	{$rule}.cmsms_notice .notice_close,
	{$rule}.cmsms_icon_box.cmsms_box_colored .icon_box_button,
	{$rule}.cmsms_toggles .cmsms_toggle_wrap .cmsms_toggle_title > .cmsms_toggle_plus,
	{$rule}.cmsms_toggles .cmsms_toggle_wrap .cmsms_toggle_title:hover > .cmsms_toggle_plus .cmsms_toggle_plus_hor,
	{$rule}.cmsms_toggles .cmsms_toggle_wrap .cmsms_toggle_title:hover > .cmsms_toggle_plus .cmsms_toggle_plus_vert,
	{$rule}.cmsms_toggles .cmsms_toggle_wrap.current_toggle .cmsms_toggle_title .cmsms_toggle_plus .cmsms_toggle_plus_hor,
	{$rule}.cmsms_toggles .cmsms_toggle_wrap.current_toggle .cmsms_toggle_title .cmsms_toggle_plus .cmsms_toggle_plus_vert,
	{$rule}.cmsms_wrap_pagination ul li .page-numbers .cmsms_prev_arrow, 
	{$rule}.cmsms_wrap_pagination ul li .page-numbers .cmsms_next_arrow, 
	{$rule}.post.cmsms_timeline_type .cmsms_post_info .cmsms_post_date, 
	{$rule}.portfolio .project .project_outer, 
	{$rule}.cmsms_posts_slider .project .slider_project_outer, 
	{$rule}.cmsms_img_rollover_wrap .cmsms_img_rollover .cmsms_image_link, 
	{$rule}.cmsms_img_rollover_wrap .cmsms_img_rollover .cmsms_open_link, 
	{$rule}.owl-buttons .owl-prev, 
	{$rule}.owl-buttons .owl-next, 
	{$rule}.owl-prev:hover .cmsms_prev_arrow, 
	{$rule}.owl-next:hover .cmsms_next_arrow, 
	{$rule}.owl-page, 
	{$rule}.cmsms_quotes_slider .owl-buttons > div:hover, 
	{$rule}.cmsms_pricing_table .cmsms_pricing_item.pricing_best, 
	{$rule}.cmsms_clients_slider .owl-buttons > div:hover,
	{$rule}.cmsms_clients_item:hover,
	{$rule}.widget_custom_latest_projects_entries .owl-buttons > div:hover,
	{$rule}.widget_custom_popular_projects_entries .owl-buttons > div:hover,
	{$rule}.cmsms_toggles.toggles_mode_accordion .cmsms_toggle_wrap.current_toggle,
	{$rule}.owl-carousel .owl-controls .owl-pagination .owl-page, 
	{$rule}.cmsms_breadcrumbs {
		" . cmsms_color_css('background-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_bg']) . "
	}
	
	{$rule}#navigation > li.menu-item-has-children > a:before,
	{$rule}.header_mid_outer .header_mid_inner #navigation > li.menu-item-has-children > a > span.nav_bg_clr:before {
		" . cmsms_color_css('border-bottom-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_bg']) . "
	}
	
	{$rule}.owl-prev:hover .cmsms_prev_arrow:after,
	{$rule}.owl-next:hover .cmsms_next_arrow:after,
	{$rule}.owl-prev:hover .cmsms_prev_arrow:before,
	{$rule}.owl-next:hover .cmsms_next_arrow:before,
	{$rule}.cmsms_wrap_pagination ul li .page-numbers .cmsms_prev_arrow:before,
	{$rule}.cmsms_wrap_pagination ul li .page-numbers .cmsms_next_arrow:before,
	{$rule}.cmsms_wrap_pagination ul li .page-numbers .cmsms_prev_arrow:after,
	{$rule}.cmsms_wrap_pagination ul li .page-numbers .cmsms_next_arrow:after,
	{$rule}.cmsms_wrap_pagination ul li .page-numbers .cmsms_prev_arrow span:before,
	{$rule}.cmsms_wrap_pagination ul li .page-numbers .cmsms_next_arrow span:before,
	{$rule}.cmsms_wrap_pagination ul li .page-numbers .cmsms_prev_arrow span:after,
	{$rule}.cmsms_wrap_pagination ul li .page-numbers .cmsms_next_arrow span:after {
		" . cmsms_color_css('border-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_bg']) . "
	}
	/* Finish Main Background Color */
	
	
	/* Start Alternate Background Color */
	{$rule}.cmsms_icon_box.cmsms_box_colored a,
	{$rule}.cmsms_icon_list_items.cmsms_color_type_icon .cmsms_icon_list_icon_wrap,
	{$rule}.current > .button,
	{$rule}.button.current {
		" . cmsms_color_css('color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_alternate']) . "
	}
	
	{$rule}input[type=text],
	{$rule}input[type=number],
	{$rule}input[type=email],
	{$rule}input[type=password],
	{$rule}textarea,
	{$rule}select,
	{$rule}option,
	{$rule}.cmsms_table tr.cmsms_table_row_footer td,
	{$rule}.cmsms_table tr.cmsms_table_row_footer th,
	{$rule}#navigation ul li:hover > a,
	{$rule}#navigation ul li.current-menu-item > a,
	{$rule}#navigation ul li.current-menu-ancestor > a,
	{$rule}#navigation > li.menu-item-mega li li > a:hover,
	{$rule}.header_top_outer nav > div > ul > li ul,
	{$rule}.search_bar_wrap,
	{$rule}.search_bar_wrap input[type=text],
	{$rule}.search_bar_wrap input[type=text]:focus,
	" . (($scheme == 'default') ? "{$rule}.headline_outer," : '') . "
	" . (($scheme == 'default') ? "{$rule}.bottom_bg," : '') . "
	{$rule}.cmsms_featured_block,
	{$rule}.widget_nav_menu ul li a:hover,
	{$rule}.widget_nav_menu ul li.current-menu-item > a,
	{$rule}.quote_grid,
	{$rule}.cmsms_icon_list_items.cmsms_color_type_icon .cmsms_icon_list_icon,
	{$rule}.cmsms_pricing_item,
	{$rule}.cmsms_clients_item,
	{$rule}.wpcf7 form.wpcf7-form span.wpcf7-list-item input[type=\"checkbox\"] + span.wpcf7-list-item-label:before, 
	{$rule}.cmsms-form-builder .check_parent input[type=\"checkbox\"]+label:before,
	{$rule}.wpcf7 form.wpcf7-form span.wpcf7-list-item input[type=\"radio\"] + span.wpcf7-list-item-label:before, 
	{$rule}.cmsms-form-builder .check_parent input[type=\"radio\"]+label:before,
	{$rule}.post .cmsms_post_cont, 
	{$rule}.post.cmsms_default_type.format-chat .cmsms_post_cont, 
	{$rule}.post.cmsms_default_type.format-audio .cmsms_post_cont, 
	{$rule}.post.cmsms_default_type.format-link .cmsms_post_cont, 
	{$rule}.post.cmsms_default_type.format-quote .cmsms_quote_info, 
	{$rule}.post .wp-caption, 
	{$rule}.related_posts_content, 
	{$rule}.about_author .about_author_inner,
	{$rule}.post_nav, 
	{$rule}.post_comments .commentlist .comment-body, 
	{$rule}.portfolio .project .project_outer .project_inner, 
	{$rule}.cmsms_posts_slider .project .slider_project_outer .slider_project_inner, 
	{$rule}.cmsms_img.with_caption,
	{$rule}.related_posts > ul li > a,
	{$rule}.cmsms_tabs.tabs_mode_tab .cmsms_tabs_wrap,
	{$rule}.cmsms_tabs .cmsms_tabs_list .cmsms_tabs_list_item > a,
	{$rule}.cmsms_toggles.toggles_mode_accordion .cmsms_toggle_wrap,
	{$rule}.cmsms_profile.vertical .format-profile .pl_img .pl_noimg,
	{$rule}.cmsms_posts_slider .post .cmsms_slider_post_cont, 
	{$rule}.tweet_list li,
	{$rule}.quote_content, 
	{$rule}code {
		" . cmsms_color_css('background-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_alternate']) . "
	}
	
	{$rule}.post.cmsms_default_type .cmsms_post_cont {
		background-color:transparent;
	}
	
	{$rule}.quote_content:after {
		" . cmsms_color_css('border-top-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_alternate']) . "
	}
	
	{$rule}.header_top_outer nav > div > ul > li.menu-item-has-children > a:before {
		" . cmsms_color_css('border-bottom-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_alternate']) . "
	}
	/* Finish Alternate Background Color */
	
	
	/* Start Borders Color */
	{$rule}#navigation > li.menu-item-mega > div.menu-item-mega-container > ul:after,
	{$rule}.content_wrap:before,
	{$rule}.cmsms_featured_block .featured_block_inner .featured_block_button,
	{$rule}.post.format-chat .cmsms_post_cont .cmsms_chat .cmsms_chat_item:before,
	{$rule}.cmsms_posts_slider .post.format-chat .cmsms_slider_post_cont .cmsms_slider_post_chat .cmsms_chat_item:before,
	{$rule}.post_comments .commentlist .comment-body:before, 
	{$rule}.blog.timeline:before, 
	{$rule}.cmsms_profile.vertical .format-profile:before,
	{$rule}.cmsms_icon_list_items.cmsms_icon_list_type_block .cmsms_icon_list_item:before,
	{$rule}.post.cmsms_timeline_type:before, 
	{$rule}.cmsms_sitemap_wrap .cmsms_sitemap > li:before {
		" . cmsms_color_css('background-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_border']) . "
	}
	
	@media only screen and (max-width: 950px) {
		{$rule}.content_wrap .sidebar:before {
			" . cmsms_color_css('background-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_border']) . "
		}
	}
	
	{$rule}input[type=text],
	{$rule}input[type=email],
	{$rule}input[type=password],
	{$rule}textarea,
	{$rule}select,
	{$rule}option,
	{$rule}#navigation ul,
	{$rule}#navigation > li.menu-item-mega > div.menu-item-mega-container,
	{$rule}.header_mid_outer .header_mid_inner .search_wrap.search_opened .search_but,
	{$rule}.search_bar_wrap,
	" . (($scheme == 'default') ? "#slide_top:hover," : '') . "
	{$rule}.headline_outer,
	{$rule}.cmsms_notice .notice_close,
	{$rule}.cmsms_toggles .cmsms_toggle_wrap .cmsms_toggle_title > .cmsms_toggle_plus,
	{$rule}.cmsms_toggles.toggles_mode_accordion .cmsms_toggle_wrap,
	{$rule}.cmsms_tabs.tabs_mode_tab .cmsms_tabs_wrap,
	{$rule}.cmsms_tabs.tabs_mode_tour .cmsms_tabs_list .cmsms_tabs_list_item > a,
	{$rule}.cmsms_icon_list_items.cmsms_icon_list_type_block .cmsms_icon_list_item,
	{$rule}.cmsms_icon_list_items.cmsms_color_type_bg .cmsms_icon_list_icon,
	{$rule}.cmsms_icon_list_items.cmsms_color_type_icon .cmsms_icon_list_icon,
	{$rule}.cmsms_stats.stats_mode_counters.stats_type_numbers .cmsms_stat_wrap .cmsms_stat,
	{$rule}.post.format-quote .cmsms_quote_info,
	{$rule}.post.cmsms_default_type.format-audio .cmsms_post_cont,
	{$rule}.post.cmsms_default_type.format-link .cmsms_post_cont,
	{$rule}.post.cmsms_default_type.format-chat .cmsms_post_cont,
	{$rule}.post.cmsms_timeline_type .cmsms_post_cont,
	{$rule}.opened-article .post.format-chat .cmsms_post_cont,
	{$rule}.post_nav,
	{$rule}.about_author .about_author_inner,
	{$rule}.related_posts > ul li > a,
	{$rule}.related_posts > ul li:first-child > a,
	{$rule}.related_posts .related_posts_content,
	{$rule}.related_posts .related_posts_content .related_posts_content_tab .rel_post_content figure.alignleft,
	{$rule}.post_comments .commentlist .comment-body,
	{$rule}.comment-body + .comment-respond,
	{$rule}.post.cmsms_masonry_type .cmsms_post_cont, 
	{$rule}.cmsms_posts_slider .post .cmsms_slider_post_cont, 
	{$rule}.quote_content, 
	{$rule}.quote_grid, 
	{$rule}.portfolio.large_gap .project .project_outer,
	{$rule}.cmsms_posts_slider .project .slider_project_outer,
	{$rule}.cmsms_img.with_caption,
	{$rule}.cmsms_quotes_slider .owl-buttons > div,
	{$rule}.cmsms_clients_slider .owl-page,
	{$rule}.cmsms_clients_slider .owl-wrapper-outer,
	{$rule}.cmsms_pricing_table .cmsms_pricing_item,
	{$rule}.cmsms_clients_slider .owl-buttons > div,
	{$rule}.tweet_list li,
	{$rule}.cmsms_tabs.lpr .cmsms_tabs_wrap,
	{$rule}.img_placeholder_small,
	{$rule}.widget_custom_popular_projects_entries .img_placeholder,
	{$rule}.widget_custom_latest_projects_entries .img_placeholder,
	{$rule}.widget_custom_latest_projects_entries .owl-buttons > div,
	{$rule}.widget_custom_popular_projects_entries .owl-buttons > div,
	{$rule}.wpcf7 form.wpcf7-form span.wpcf7-list-item input[type=\"checkbox\"] + span.wpcf7-list-item-label:before, 
	{$rule}.cmsms-form-builder .check_parent input[type=\"checkbox\"]+label:before,
	{$rule}.wpcf7 form.wpcf7-form span.wpcf7-list-item input[type=\"radio\"] + span.wpcf7-list-item-label:before, 
	{$rule}.cmsms-form-builder .check_parent input[type=\"radio\"]+label:before,
	{$rule}.cmsms_quotes_slider .quote_content, 
	{$rule}.wp-caption, 
	{$rule}.cmsms_profile.vertical .format-profile .pl_img .pl_noimg, 
	{$rule}.cmsms_posts_slider .owl-controls .owl-buttons .owl-prev, 
	{$rule}.cmsms_posts_slider .owl-controls .owl-buttons .owl-next, 
	{$rule}code {
		" . cmsms_color_css('border-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_border']) . "
	}
	
	{$rule}.cmsms_table tr:first-child td,
	{$rule}#navigation ul li,
	{$rule}#navigation > li.menu-item-mega > div.menu-item-mega-container li li li:first-child,
	{$rule}.bottom_bg,
	{$rule}.cmsms_tabs .cmsms_tabs_list .cmsms_tabs_list_item > a,
	{$rule}.cmsms_tabs.tabs_mode_tour .cmsms_tabs_list .cmsms_tabs_list_item:first-child > a,
	{$rule}.widget_nav_menu ul li a,
	{$rule}.post .cmsms_post_cont .cmsms_post_footer,
	{$rule}.cmsms_search .cmsms_search_post .cmsms_search_post_cont .cmsms_search_post_footer, 
	{$rule}.opened-article .post .cmsms_post_footer, 
	{$rule}.post.cmsms_timeline_type.format-chat .cmsms_post_cont .cmsms_post_footer, 
	{$rule}.post.cmsms_timeline_type.format-quote .cmsms_post_cont .cmsms_post_footer, 
	{$rule}.portfolio .project .project_outer .project_inner, 
	{$rule}.cmsms_posts_slider .project .slider_project_outer .slider_project_inner, 
	{$rule}.portfolio.opened-article .project .project_sidebar .project_details .project_details_item, 
	{$rule}.portfolio.opened-article .project .project_sidebar .project_features .project_features_item, 
	{$rule}.profiles.opened-article .profile .profile_sidebar .profile_details .profile_details_item,
	{$rule}.profiles.opened-article .profile .profile_sidebar .profile_features .profile_features_item,
	{$rule}.cmsms_pricing_item .cmsms_price_wrap:after, 
	{$rule}.cmsms_pricing_item .cmsms_price_wrap:before, 
	{$rule}.cmsms_profile.horizontal .pl_social_list, 
	{$rule}.tweet_list li:first-child, 
	{$rule}.quote_content:before, 
	{$rule}.cmsms_clients_grid .cmsms_clients_item, 
	{$rule}.cmsms_posts_slider .post .cmsms_slider_post_cont .cmsms_slider_post_footer {
		" . cmsms_color_css('border-top-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_border']) . "
	}
	
	@media only screen and (max-width: 1024px) {
		{$rule}.quote_grid.quote_four .quotes_list .cmsms_quote {
			" . cmsms_color_css('border-top-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_border']) . "
		}
	}
	
	@media only screen and (max-width: 767px) {
		{$rule}.cmsms_clients_grid .cmsms_clients_item:first-child, 
		{$rule}.quote_grid.quote_four .quotes_list .cmsms_quote, 
		{$rule}.quote_grid.quote_three .quotes_list .cmsms_quote, 
		{$rule}.quote_grid.quote_two .quotes_list .cmsms_quote {
			" . cmsms_color_css('border-top-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_border']) . "
		}
		
		{$rule}.cmsms_clients_grid .cmsms_clients_item {
			" . cmsms_color_css('border-left-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_border']) . "
		}
		
		{$rule}.cmsms_clients_grid .cmsms_clients_item {
			" . cmsms_color_css('border-right-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_border']) . "
		}
	}
	
	{$rule}.cmsms_table tr td,
	{$rule}.cmsms_table tr th,
	{$rule}.header_mid_outer,
	{$rule}.header_bot_outer,
	{$rule}.cmsms_tabs .cmsms_tabs_list .cmsms_tabs_list_item > a,
	{$rule}hr,
	{$rule}.cmsms_divider,
	{$rule}.post.cmsms_default_type .cmsms_post_cont,
	{$rule}.post.cmsms_default_type.format-link .cmsms_post_cont .cmsms_post_header,
	{$rule}.opened-article .post, 
	{$rule}.cmsms_post_filter_wrap, 
	{$rule}.cmsms_project_filter_wrap, 
	{$rule}.sidebar .widget,
	{$rule}.quote_grid .quotes_list,
	{$rule}.portfolio.opened-article .project .cmsms_project_header, 
	{$rule}.profiles.opened-article .profile .cmsms_profile_header, 
	{$rule}.cmsms_widget_divider, 
	{$rule}.cmsms_clients_grid .cmsms_clients_item, 
	{$rule}.cmsms_breadcrumbs, 
	{$rule}.cmsms_search .cmsms_search_post .cmsms_search_post_cont {
		" . cmsms_color_css('border-bottom-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_border']) . "
	}
	
	{$rule}.cmsms_pricing_table .cmsms_pricing_item:first-child, 
	{$rule}.cmsms_pricing_table .cmsms_pricing_item.pricing_best, 
	{$rule}.quote_grid.quote_three:before, 
	{$rule}.quote_grid.quote_four:after, 
	{$rule}.quote_grid.quote_four:before, 
	{$rule}.quote_grid.quote_three:before, 
	{$rule}.quote_vert, 
	{$rule}.cmsms_table tr td:first-child, 
	{$rule}.cmsms_table tr th:first-child, 
	{$rule}#navigation > li:first-child > a,
	{$rule}.footer_inner nav > div > ul > li,
	{$rule}.cmsms_tabs .cmsms_tabs_list .cmsms_tabs_list_item:first-child > a,
	{$rule}.cmsms_stats.stats_mode_counters.stats_type_numbers .cmsms_stat_wrap.one_fourth:nth-child(4n+1) .cmsms_stat,
	{$rule}.cmsms_stats.stats_mode_counters.stats_type_numbers .cmsms_stat_wrap.one_third:nth-child(3n+1) .cmsms_stat,
	{$rule}.cmsms_stats.stats_mode_counters.stats_type_numbers .cmsms_stat_wrap.one_half:nth-child(2n+1) .cmsms_stat,
	{$rule}.cmsms_stats.stats_mode_counters.stats_type_numbers .cmsms_stat_wrap.one_first .cmsms_stat {
		" . cmsms_color_css('border-' . (is_rtl() ? 'right' : 'left') . '-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_border']) . "
	}
	
	@media only screen and (max-width: 1024px) {
		{$rule}.cmsms_stats.stats_type_numbers .cmsms_stat_wrap.one_fourth:nth-child(2n+1) .cmsms_stat {
			" . cmsms_color_css('border-' . (is_rtl() ? 'right' : 'left') . '-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_border']) . "
		}
	}
	
	@media only screen and (max-width: 767px) {
		{$rule}.cmsms_stats.stats_type_numbers.stats_mode_counters .cmsms_stat_wrap.one_third .cmsms_stat, 
		{$rule}.cmsms_stats.stats_type_numbers.stats_mode_counters .cmsms_stat_wrap.one_third.one_third:nth-child(3n+1) .cmsms_stat,
		{$rule}.cmsms_stats.stats_type_numbers.stats_mode_counters .cmsms_stat_wrap.one_third.one_third:nth-child(3n) .cmsms_stat, 
		{$rule}.cmsms_stats.stats_type_numbers.stats_mode_counters .cmsms_stat_wrap.one_third.one_third:last-child .cmsms_stat {
			" . cmsms_color_css('border-' . (is_rtl() ? 'right' : 'left') . '-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_border']) . "
		}
	}
	
	@media only screen and (max-width: 540px) {
		{$rule}.cmsms_stats.stats_type_numbers.stats_mode_counters .cmsms_stat_wrap.one_fourth .cmsms_stat, 
		{$rule}.cmsms_stats.stats_type_numbers.stats_mode_counters .cmsms_stat_wrap.one_fourth:nth-child(n) .cmsms_stat, 
		{$rule}.cmsms_stats.stats_type_numbers.stats_mode_counters .cmsms_stat_wrap.one_third .cmsms_stat, 
		{$rule}.cmsms_stats.stats_type_numbers.stats_mode_counters .cmsms_stat_wrap.one_fourth:nth-child(n) .cmsms_stat, 
		{$rule}.cmsms_stats.stats_type_numbers.stats_mode_counters .cmsms_stat_wrap.one_half .cmsms_stat, 
		{$rule}.cmsms_stats.stats_type_numbers.stats_mode_counters .cmsms_stat_wrap.one_half:nth-child(n) .cmsms_stat, 
		{$rule}.cmsms_tabs .cmsms_tabs_list .cmsms_tabs_list_item > a, 
		{$rule}.related_posts > ul li > a {
			" . cmsms_color_css('border-' . (is_rtl() ? 'right' : 'left') . '-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_border']) . "
		}
	}
	
	{$rule}.cmsms_clients_grid .cmsms_clients_item:last-child,
	{$rule}.cmsms_clients_grid.clients_two .cmsms_clients_item:nth-child(2n),
	{$rule}.cmsms_clients_grid.clients_three .cmsms_clients_item:nth-child(3n),
	{$rule}.cmsms_clients_grid.clients_four .cmsms_clients_item:nth-child(4n),
	{$rule}.cmsms_clients_grid.clients_five .cmsms_clients_item:nth-child(5n),
	{$rule}.cmsms_clients_grid.clients_one .cmsms_clients_item:last-child,
	{$rule}.cmsms_clients_grid.clients_one .cmsms_clients_item,
	{$rule}.cmsms_table tr td:last-child,
	{$rule}.cmsms_tabs .cmsms_tabs_list .cmsms_tabs_list_item > a,
	{$rule}.cmsms_tabs .cmsms_tabs_list .cmsms_tabs_list_item:first-child > a,
	{$rule}.cmsms_table tr th:last-child,
	{$rule}#navigation > li > a {
		" . cmsms_color_css('border-' . (is_rtl() ? 'left' : 'right') . '-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_border']) . "
	}
	
	{$rule}.cmsms_clients_item {
		-webkit-box-shadow:-1px 0 0 rgba(" . hex2rgb($cmsms_bd[0]) . ", " . ((int) $cmsms_bd[1] / 100) . ");
		-moz-box-shadow:-1px 0 0 rgba(" . hex2rgb($cmsms_bd[0]) . ", " . ((int) $cmsms_bd[1] / 100) . ");
		box-shadow:-1px 0 0 rgba(" . hex2rgb($cmsms_bd[0]) . ", " . ((int) $cmsms_bd[1] / 100) . ");
	}
	/* Finish Borders Color */
	
	
	/* Start Custom Rules */
	{$rule}::selection {
		" . cmsms_color_css('background', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_link']) . "
		" . cmsms_color_css('color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_bg']) . ";
	}
	
	{$rule}::-moz-selection {
		" . cmsms_color_css('background', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_link']) . "
		" . cmsms_color_css('color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_bg']) . "
	}
	
	{$rule}.cmsms_img_rollover_wrap:hover .cmsms_img_rollover {
		background-color:rgba(" . hex2rgb($cmsms_link[0]) . ", 0.8);
	}
	
	{$rule}.cmsms_notice .notice_close:hover {
		color:#dd0000;
	}
	
	{$rule}.portfolio.small_gap .project .project_outer {
		-webkit-box-shadow:0 0 0 1px rgba(" . hex2rgb($cmsms_bd[0]) . ", " . ((int) $cmsms_bd[1] / 100) . ");
		-moz-box-shadow:0 0 0 1px rgba(" . hex2rgb($cmsms_bd[0]) . ", " . ((int) $cmsms_bd[1] / 100) . ");
		box-shadow:0 0 0 1px rgba(" . hex2rgb($cmsms_bd[0]) . ", " . ((int) $cmsms_bd[1] / 100) . ");
	}
	";
	
	
	if ($scheme == 'default') {
	$cmsms_def_heading = explode('|', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_heading']);
	
	$cmsms_def_bg = explode('|', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_bg']);
	
	
	$custom_css .= "
	#slide_top {
		background-color:rgba(" . hex2rgb($cmsms_def_heading[0]) . ", 0.5);
		border-color:rgba(" . hex2rgb($cmsms_def_bg[0]) . ", 0.15);
	}
	";
	}
	
	
	$custom_css .= "
	{$rule}.footer_bg {
		-webkit-box-shadow:inset 0 1px 0 0 rgba(" . hex2rgb($cmsms_bd[0]) . ", " . ((int) $cmsms_bd[1] / 100) . ");
		-moz-box-shadow:inset 0 1px 0 0 rgba(" . hex2rgb($cmsms_bd[0]) . ", " . ((int) $cmsms_bd[1] / 100) . ");
		box-shadow:inset 0 1px 0 0 rgba(" . hex2rgb($cmsms_bd[0]) . ", " . ((int) $cmsms_bd[1] / 100) . ");
	}
	/* Finish Custom Rules */

/***************** Finish {$title} Color Scheme Rules ******************/


";


		if (class_exists('woocommerce')) {
			$custom_css .= "
/***************** Start {$title} WooCommerce Color Scheme Rules ******************/

	/* Start Main Content Font Color */
	{$rule}.cmsms_products .product .product_outer .product_inner .cmsms_product_cat, 
	{$rule}.cmsms_products .product .product_outer .product_inner .cmsms_product_cat a, 
	{$rule}.cmsms_products .product .product_outer .product_inner .cmsms_product_info .price del, 
	{$rule}.cmsms_products .product .product_outer .product_inner .cmsms_product_footer > a, 
	{$rule}.cmsms_single_product .cmsms_product_right_column .price del, 
	{$rule}.checkout #order_review .shop_table td.product-name, 
	{$rule}.checkout #order_review .shop_table td.product-name *, 
	{$rule}.shop_table.order_details td.product-name, 
	{$rule}.shop_table.order_details td.product-name *, 
	{$rule}.cmsms_dynamic_cart .cmsms_dynamic_cart_button, 
	{$rule}.widget_shopping_cart_content .cart_list li .quantity, 
	{$rule}.product_list_widget li del .amount, 
	{$rule}.buttons_added input, 
	{$rule}.buttons_added input:hover {
		" . cmsms_color_css('color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_color']) . "
	}
	/* Finish Main Content Font Color */
	
	
	/* Start Primary Color */
	{$rule}.cmsms_products .product .product_outer .product_inner .cmsms_product_cat a:hover, 
	{$rule}.cmsms_products .product .product_outer .product_inner .cmsms_product_info .price, 
	{$rule}.cmsms_products .product .product_outer .product_inner .cmsms_product_footer > a:hover, 
	{$rule}.cmsms_products .product .product_outer .product_inner .cmsms_product_footer > a:hover:before, 
	{$rule}.cmsms_products .product .product_outer .product_inner .cmsms_product_footer > a.cmsms_add_to_cart_button.loading, 
	{$rule}.cmsms_products .product .product_outer .product_inner .cmsms_product_footer > a.cmsms_add_to_cart_button.loading:before, 
	{$rule}.cmsms_single_product .cmsms_product_right_column .price, 
	{$rule}.required, 
	{$rule}.shop_table .product-name a:hover, 
	{$rule}.shop_table td.product-subtotal, 
	{$rule}.cart_totals table tr.cart-subtotal td, 
	{$rule}.cart_totals table tr.order-total td, 
	{$rule}.checkout #order_review .shop_table tr.order-total th, 
	{$rule}.checkout #order_review .shop_table tr.order-total td, 
	{$rule}.shop_table.order_details td.product-name a:hover, 
	{$rule}.shop_table.order_details tfoot tr:last-child th, 
	{$rule}.shop_table.order_details tfoot tr:last-child td, 
	{$rule}.cmsms_dynamic_cart .cmsms_dynamic_cart_button:hover, 
	{$rule}.cmsms_dynamic_cart:hover .cmsms_dynamic_cart_button, 
	{$rule}.widget_shopping_cart_content .cart_list li a:hover, 
	{$rule}.widget_shopping_cart_content .cart_list li .quantity .amount, 
	{$rule}.widget_shopping_cart_content .total .amount, 
	{$rule}.product_list_widget li > a:hover, 
	{$rule}.product_list_widget li .amount {
		" . cmsms_color_css('color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_link']) . "
	}
	
	{$rule}.onsale, 
	{$rule}.cmsms_single_product .cmsms_product_right_column .cart .single_add_to_cart_button, 
	{$rule}.widget_shopping_cart_content .buttons .button, 
	{$rule}.widget_shopping_cart_content .buttons .button.checkout:hover, 
	{$rule}.widget_price_filter .price_slider_wrapper .price_slider_amount .button, 
	{$rule}.shop_table td.actions .button, 
	{$rule}.shop_table td.actions .button[name=update_cart]:hover {
		" . cmsms_color_css('background-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_link']) . "
	}
	/* Finish Primary Color */
	
	
	/* Start Highlight Color */
	{$rule}#shipping_method input[type=\"checkbox\"] + label:after, 
	{$rule}#ship-to-different-address input[type=\"checkbox\"] + label:after, 
	{$rule}.payment_methods input[type=\"checkbox\"]+label:after {
		" . cmsms_color_css('color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_hover']) . "
	}

	{$rule}#shipping_method input[type=\"radio\"]+label:after, 
	{$rule}#ship-to-different-address input[type=\"radio\"]+label:after, 
	{$rule}.payment_methods input[type=\"radio\"]+label:after, 
	{$rule}.cmsms_single_product .cmsms_product_right_column .cart .single_add_to_cart_button:hover {
		" . cmsms_color_css('background-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_hover']) . "
	}
	/* Finish Highlight Color */
	
	
	/* Start Headings Color */
	{$rule}.cmsms_single_product .cmsms_product_right_column .product_meta strong, 
	{$rule}.cmsms_single_product .cmsms_woo_tabs .shop_attributes th, 
	{$rule}.shop_table thead th, 
	{$rule}.shop_table td.product-remove .remove, 
	{$rule}.shop_table td.product-name, 
	{$rule}.shop_table td.product-name a, 
	{$rule}.cart_totals table tr.cart-subtotal th, 
	{$rule}.cart_totals table tr.order-total th, 
	{$rule}.shipping_calculator > h2 a, 
	{$rule}.shipping_calculator > h2 a:hover, 
	{$rule}.checkout #order_review .shop_table tr.cart-subtotal th, 
	{$rule}.checkout #order_review .shop_table tr.cart-subtotal td, 
	{$rule}ul.order_details li > span, 
	{$rule}.shop_table.order_details tfoot tr:first-child th, 
	{$rule}.shop_table.order_details tfoot tr:first-child td, 
	{$rule}.widget_shopping_cart_content .cart_list li a, 
	{$rule}.widget_shopping_cart_content .total strong, 
	{$rule}.cmsms_added_product_info .cmsms_added_product_info_text, 
	{$rule}.product_list_widget li > a {
		" . cmsms_color_css('color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_heading']) . "
	}
	
	{$rule}.out-of-stock, 
	{$rule}.widget_shopping_cart_content .buttons .button:hover, 
	{$rule}.widget_shopping_cart_content .buttons .button.checkout, 
	{$rule}.widget_price_filter .price_slider_wrapper .price_slider_amount .button:hover, 
	{$rule}.shop_table td.actions .button:hover, 
	{$rule}.shop_table td.actions .button[name=update_cart] {
		" . cmsms_color_css('background-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_heading']) . "
	}
	
	{$rule}.cmsms_single_product .cmsms_product_left_column .cmsms_hover_slider .cmsms_hover_slider_thumbs li .cmsms_hover_slider_thumb:hover, 
	{$rule}.cmsms_single_product .cmsms_product_left_column .cmsms_hover_slider .cmsms_hover_slider_thumbs li.hovered_item .cmsms_hover_slider_thumb {
		" . cmsms_color_css('border-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_heading']) . "
	}
	/* Finish Headings Color */
	
	
	/* Start Main Background Color */
	{$rule}.onsale, 
	{$rule}.out-of-stock {
		" . cmsms_color_css('color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_bg']) . "
	}
	
	{$rule}.buttons_added, 
	{$rule}.woocommerce-message, 
	{$rule}.woocommerce-info, 
	{$rule}.checkout #order_review #payment, 
	{$rule}.cmsms_dynamic_cart .widget_shopping_cart_content, 
	{$rule}.cmsms_added_product_info, 
	{$rule}.widget_price_filter .price_slider_wrapper .price_slider {
		" . cmsms_color_css('background-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_bg']) . "
	}
	
	{$rule}.cmsms_dynamic_cart .widget_shopping_cart_content:after, 
	{$rule}.cmsms_added_product_info:after {
		" . cmsms_color_css('border-' . (is_rtl() ? 'right' : 'left') . '-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_bg']) . "
	}
	/* Finish Main Background Color */
	
	
	/* Start Alternate Background Color */
	{$rule}.cmsms_products .product .product_outer .product_inner .cmsms_product_footer > a:hover, 
	{$rule}.buttons_added .minus:hover, 
	{$rule}.buttons_added .plus:hover, 
	{$rule}.shop_table thead th, 
	{$rule}.shop_table td.product-remove .remove, 
	{$rule}.shop_table td.actions, 
	{$rule}.cart_totals table tr.cart-subtotal th, 
	{$rule}.cart_totals table tr.cart-subtotal td, 
	{$rule}.cart_totals table tr.order-total th, 
	{$rule}.cart_totals table tr.order-total td, 
	{$rule}#shipping_method input[type=\"checkbox\"]+label:before,
	{$rule}#shipping_method input[type=\"radio\"]+label:before, 
	{$rule}#ship-to-different-address input[type=\"checkbox\"]+label:before,
	{$rule}#ship-to-different-address input[type=\"radio\"]+label:before, 
	{$rule}.payment_methods input[type=\"checkbox\"]+label:before,
	{$rule}.payment_methods input[type=\"radio\"]+label:before, 
	{$rule}.checkout #order_review .shop_table tr.cart-subtotal th, 
	{$rule}.checkout #order_review .shop_table tr.cart-subtotal td, 
	{$rule}.checkout #order_review .shop_table tr.order-total th, 
	{$rule}.checkout #order_review .shop_table tr.order-total td, 
	{$rule}.checkout #order_review #payment .payment_methods .payment_box, 
	{$rule}ul.order_details li > span, 
	{$rule}.shop_table.order_details tfoot tr:first-child th, 
	{$rule}.shop_table.order_details tfoot tr:last-child th, 
	{$rule}.shop_table.order_details tfoot tr:first-child td, 
	{$rule}.shop_table.order_details tfoot tr:last-child td, 
	{$rule}.cmsms_dynamic_cart .cmsms_dynamic_cart_button, 
	{$rule}.widget_price_filter .price_slider_wrapper .price_slider .ui-slider-range {
		" . cmsms_color_css('background-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_alternate']) . "
	}
	
	{$rule}.checkout #order_review #payment .payment_methods .payment_box:after {
		" . cmsms_color_css('border-bottom-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_alternate']) . "
	}
	/* Finish Alternate Background Color */
	
	
	/* Start Borders Color */
	{$rule}.cmsms_star_rating .cmsms_star, 
	{$rule}.comment-form-rating .stars > span, 
	{$rule}.comment-form-rating .stars > span a:hover, 
	{$rule}.comment-form-rating .stars > span a.active, 
	{$rule}.cmsms_products .product .product_outer .product_inner .cmsms_product_footer > a:before {
		" . cmsms_color_css('color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_border']) . "
	}
	
	{$rule}.widget_price_filter .price_slider_wrapper .price_slider .ui-slider-handle {
		" . cmsms_color_css('background-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_border']) . "
	}
	
	{$rule}.cmsms_products .product .product_outer .product_inner, 
	{$rule}.cmsms_products .product .product_outer .product_inner .cmsms_product_footer, 
	{$rule}.cmsms_products .product .product_outer .product_inner .cmsms_product_footer > a.cmsms_add_to_cart_button + .cmsms_details_button, 	
	{$rule}.cmsms_products .product .product_outer .product_inner .cmsms_product_footer > a.added_to_cart + .cmsms_details_button, 
	{$rule}.cmsms_single_product .cmsms_product_left_column .cmsms_hover_slider .cmsms_hover_slider_items, 
	{$rule}.cmsms_single_product .cmsms_product_left_column .cmsms_hover_slider .cmsms_hover_slider_thumbs .cmsms_hover_slider_thumb, 
	{$rule}.cmsms_single_product .cmsms_product_left_column > figure, 
	{$rule}.cmsms_single_product .cmsms_woo_tabs .shop_attributes th, 
	{$rule}.cmsms_single_product .cmsms_woo_tabs .shop_attributes td, 
	{$rule}.cmsms_single_product .cmsms_woo_tabs #reviews #comments .commentlist, 
	{$rule}.cmsms_single_product .cmsms_woo_tabs #reviews #comments .commentlist .comment .comment_container .comment-text, 
	{$rule}.woocommerce-message, 
	{$rule}.woocommerce-info, 
	{$rule}.shop_table, 
	{$rule}.shop_table th, 
	{$rule}.shop_table td, 
	{$rule}.shop_table td.product-remove .remove, 
	{$rule}.shop_table td.product-thumbnail img, 
	{$rule}.cart_totals table, 
	{$rule}.cart_totals table tr th, 
	{$rule}.cart_totals table tr td, 
	{$rule}#shipping_method input[type=\"checkbox\"]+label:before,
	{$rule}#shipping_method input[type=\"radio\"]+label:before, 
	{$rule}#ship-to-different-address input[type=\"checkbox\"]+label:before,
	{$rule}#ship-to-different-address input[type=\"radio\"]+label:before, 
	{$rule}.payment_methods input[type=\"checkbox\"]+label:before,
	{$rule}.payment_methods input[type=\"radio\"]+label:before, 
	{$rule}.checkout #order_review #payment, 
	{$rule}.checkout #order_review #payment .payment_methods .payment_box, 
	{$rule}ul.order_details, 
	{$rule}ul.order_details li, 
	{$rule}ul.order_details li > span, 
	{$rule}.cmsms_dynamic_cart .cmsms_dynamic_cart_button, 
	{$rule}.cmsms_dynamic_cart .widget_shopping_cart_content, 
	{$rule}.cmsms_added_product_info, 
	{$rule}.widget_shopping_cart_content .cart_list li, 
	{$rule}.cmsms_added_product_info .cmsms_added_product_info_img, 
	{$rule}.widget_price_filter .price_slider_wrapper .price_slider, 
	{$rule}.product_list_widget li, 
	{$rule}.product_list_widget li img, 
	{$rule}.buttons_added {
		" . cmsms_color_css('border-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_border']) . "
	}
	
	{$rule}.checkout #order_review #payment .payment_methods .payment_box:before {
		" . cmsms_color_css('border-bottom-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_border']) . "
	}
	
	{$rule}.cmsms_dynamic_cart .widget_shopping_cart_content:before, 
	{$rule}.cmsms_added_product_info:before {
		" . cmsms_color_css('border-' . (is_rtl() ? 'right' : 'left') . '-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_border']) . "
	}
	/* Finish Borders Color */

/***************** Finish {$title} WooCommerce Color Scheme Rules ******************/


";
		}
	}
	
	
	$cmsms_header_bg = explode('|', $cmsms_option[CMSMS_SHORTNAME . '_header_bg']);
	
	$cmsms_header_dropdown_bg = explode('|', $cmsms_option[CMSMS_SHORTNAME . '_header_dropdown_bg']);
	
	
	$cmsms_header_top_bd = explode('|', $cmsms_option[CMSMS_SHORTNAME . '_header_top_border']);
	
	$cmsms_header_top_dropdown_bg = explode('|', $cmsms_option[CMSMS_SHORTNAME . '_header_top_dropdown_bg']);
	
	
	$custom_css .= "
/***************** Start Header Color Scheme Rules ******************/

	/* Start Header Content Color */
	.header_mid,
	.header_bot, 
	.header_mid_inner .social_wrap a {
		" . cmsms_color_css('color', $cmsms_option[CMSMS_SHORTNAME . '_header_color']) . "
	}
	/* Finish Header Content Color */
	
	
	/* Start Header Primary Color */
	.header_mid a,
	.header_mid h1 a:hover,
	.header_mid h2 a:hover,
	.header_mid h3 a:hover,
	.header_mid h4 a:hover,
	.header_mid h5 a:hover,
	.header_mid h6 a:hover,
	.header_mid .color_2,
	.header_bot a,
	.header_bot h1 a:hover,
	.header_bot h2 a:hover,
	.header_bot h3 a:hover,
	.header_bot h4 a:hover,
	.header_bot h5 a:hover,
	.header_bot h6 a:hover,
	.header_bot .color_2,
	.header_mid h1,
	.header_mid h2,
	.header_mid h3,
	.header_mid h4,
	.header_mid h5,
	.header_mid h6,
	.header_mid h1 a,
	.header_mid h2 a,
	.header_mid h3 a,
	.header_mid h4 a,
	.header_mid h5 a,
	.header_mid h6 a,
	.header_bot h1,
	.header_bot h2,
	.header_bot h3,
	.header_bot h4,
	.header_bot h5,
	.header_bot h6,
	.header_bot h1 a,
	.header_bot h2 a,
	.header_bot h3 a,
	.header_bot h4 a,
	.header_bot h5 a,
	.header_bot h6 a,
	#navigation > li > a,
	.header_mid_outer .header_mid_inner .search_wrap .search_bar_wrap button[type=submit][class^=\"cmsms-icon-\"],
	.header_mid_outer .header_mid_inner .search_wrap .search_bar_wrap button[type=submit][class*=\" cmsms-icon-\"],
	.header_mid_outer .header_mid_inner .search_wrap .search_but,
	.header_mid .search_bar_wrap button[type=submit][class^=\"cmsms-icon-\"],
	.header_mid .search_bar_wrap button[type=submit][class*=\" cmsms-icon-\"],
	.header_bot .search_bar_wrap button[type=submit][class^=\"cmsms-icon-\"],
	.header_bot .search_bar_wrap button[type=submit][class*=\" cmsms-icon-\"], 
	.header_mid_inner .social_wrap a:hover {
		" . cmsms_color_css('color', $cmsms_option[CMSMS_SHORTNAME . '_header_link']) . "
	}
	
	@media only screen and (max-width: 1024px) {
		html #page #header nav #navigation li a, 
		html #page #header nav #navigation li a span {
			" . cmsms_color_css('color', $cmsms_option[CMSMS_SHORTNAME . '_header_link']) . "
		}
	}
	
	.header_mid .cmsms_button,
	.header_mid .button:hover,
	.header_bot .cmsms_button,
	.header_bot .button:hover,
	.header_mid .button,
	.header_bot .button {
		" . cmsms_color_css('background-color', $cmsms_option[CMSMS_SHORTNAME . '_header_link']) . "
	}
	
	.header_mid input[type=text]:focus,
	.header_mid input[type=email]:focus,
	.header_mid input[type=password]:focus,
	.header_mid textarea:focus,
	.header_top input[type=text]:focus,
	.header_top input[type=email]:focus,
	.header_top input[type=password]:focus,
	.header_top textarea:focus,
	#navigation > li:hover > a,
	#navigation > li.current-menu-item > a,
	#navigation > li.current-menu-ancestor > a {
		" . cmsms_color_css('border-color', $cmsms_option[CMSMS_SHORTNAME . '_header_link']) . "
	}
	/* Finish Header Primary Color */
	
	
	/* Start Header Rollover Color */
	.header_mid a:hover,
	.header_bot a:hover,
	#navigation > li:hover > a,
	#navigation > li.current-menu-item > a,
	#navigation > li.current-menu-ancestor > a,
	.header_mid_outer .header_mid_inner #navigation > li:hover > a,
	.header_mid_outer .header_mid_inner #navigation > li.current-menu-item > a,
	.header_mid_outer .header_mid_inner #navigation > li.current-menu-ancestor > a,
	.header_mid_outer .header_mid_inner #navigation > li.menu-item-highlight > a,
	.header_bot_inner #navigation > li.menu-item-highlight > a {
		" . cmsms_color_css('color', $cmsms_option[CMSMS_SHORTNAME . '_header_hover']) . "
	}
	
	@media only screen and (max-width: 1024px) {
		html #page #header nav #navigation li > a:hover,
		html #page #header nav #navigation li.current-menu-item > a, 
		html #page #header nav #navigation li > a:hover span,
		html #page #header nav #navigation li.current-menu-item > a span {
			" . cmsms_color_css('color', $cmsms_option[CMSMS_SHORTNAME . '_header_hover']) . "
		}
	}
	/* Finish Header Rollover Color */
	
	
	/* Start Header Background Color */
	.header_mid .cmsms_button,
	.header_mid .cmsms_button:hover, 
	.header_bot .cmsms_button,
	.header_bot .cmsms_button:hover {
		" . cmsms_color_css('color', $cmsms_option[CMSMS_SHORTNAME . '_header_bg']) . "
	}
	
	.header_mid input[type=text]:focus,
	.header_mid input[type=number]:focus,
	.header_mid input[type=email]:focus,
	.header_mid input[type=password]:focus,
	.header_mid textarea:focus,
	.header_bot input[type=text]:focus,
	.header_bot input[type=number]:focus,
	.header_bot input[type=email]:focus,
	.header_bot input[type=password]:focus,
	.header_bot textarea:focus,
	.header_mid_outer,
	.header_bot_outer,
	.header_mid_outer .header_mid_inner .search_wrap.search_opened .search_but {
		" . cmsms_color_css('background-color', $cmsms_option[CMSMS_SHORTNAME . '_header_bg']) . "
	}
	/* Finish Header Background Color */
	
	
	/* Start Header Rollover Background Color */
	#navigation > li:hover > a,
	#navigation > li.current-menu-item > a,
	#navigation > li.current-menu-ancestor > a,
	.header_mid_outer .header_mid_inner #navigation > li > a > span.nav_bg_clr,
	.header_bot_inner #navigation > li > a > span.nav_bg_clr,
	.header_mid_outer .header_mid_inner #navigation > li.menu-item-highlight > a > span.nav_bg_clr,
	.header_bot_inner #navigation > li.menu-item-highlight > a > span.nav_bg_clr {
		" . cmsms_color_css('background-color', $cmsms_option[CMSMS_SHORTNAME . '_header_hover_bg']) . "
	}
	
	@media only screen and (max-width: 1024px) {
		html #page #header nav #navigation li > a:hover,
		html #page #header nav #navigation li.current-menu-item > a {
			" . cmsms_color_css('background-color', $cmsms_option[CMSMS_SHORTNAME . '_header_hover_bg']) . "
		}
	}
	/* Finish Header Rollover Background Color */
	
	
	/* Start Header Borders Color */
	.header_mid input[type=text],
	.header_mid input[type=number],
	.header_mid input[type=email],
	.header_mid input[type=password],
	.header_mid input[type=submit],
	.header_mid button,
	.header_mid textarea,
	.header_mid select,
	.header_mid option,
	.header_bot input[type=text],
	.header_bot input[type=number],
	.header_bot input[type=email],
	.header_bot input[type=password],
	.header_bot input[type=submit],
	.header_bot button,
	.header_bot textarea,
	.header_bot select,
	.header_bot option,
	.header_mid_outer .header_mid_inner .search_wrap.search_opened .search_but,
	.header_mid .search_bar_wrap,
	.header_bot .search_bar_wrap, 
	html #page #header .header_mid nav #navigation li a, 
	html #page #header .header_bot nav #navigation li a {
		" . cmsms_color_css('border-color', $cmsms_option[CMSMS_SHORTNAME . '_header_border']) . "
	}
	
	.header_mid_outer,
	.header_bot_outer,
	.header_mid hr,
	.header_mid .cmsms_divider,
	.header_bot hr,
	.header_bot .cmsms_divider {
		" . cmsms_color_css('border-bottom-color', $cmsms_option[CMSMS_SHORTNAME . '_header_border']) . "
	}
	
	#navigation > li:first-child > a {
		" . cmsms_color_css('border-' . (is_rtl() ? 'right' : 'left') . '-color', $cmsms_option[CMSMS_SHORTNAME . '_header_border']) . "
	}
	
	#navigation > li > a {
		" . cmsms_color_css('border-' . (is_rtl() ? 'left' : 'right') . '-color', $cmsms_option[CMSMS_SHORTNAME . '_header_border']) . "
	}
	/* Finish Header Borders Color */
	
	
	/* Start Header Dropdown Link Color */
	#navigation ul li a,
	.header_mid .button,
	.header_mid .button:hover, 
	.header_bot .button,
	.header_bot .button:hover {
		" . cmsms_color_css('color', $cmsms_option[CMSMS_SHORTNAME . '_header_dropdown_link']) . "
	}
	/* Finish Header Dropdown Link Color */
	
	
	/* Start Header Dropdown Rollover Color */
	#navigation > li.menu-item-mega li:hover > a,
	#navigation > li.menu-item-mega li.current-menu-ancestor > a,
	#navigation > li.menu-item-mega > div.menu-item-mega-container li > a:hover,
	#navigation > li.menu-item-mega > div.menu-item-mega-container li.current-menu-item > a,
	#navigation > li.menu-item-mega > div.menu-item-mega-container > ul > li > a[href]:hover,
	#navigation > li.menu-item-mega > div.menu-item-mega-container > ul li li:hover > a,
	#navigation ul li:hover > a,
	#navigation ul li.current-menu-item > a,
	#navigation ul li.current-menu-ancestor > a,
	#navigation > li.menu-item-mega li li > a:hover,
	#navigation > li.menu-item-mega > ul > li > a,
	#navigation > li.menu-item-mega > ul > li:hover > a,
	#navigation > li.menu-item-mega > div.menu-item-mega-container li:hover > a,
	#navigation > li.menu-item-mega > div.menu-item-mega-container > ul > li > a,
	#navigation > li.menu-item-mega > div.menu-item-mega-container > ul > li > a:hover,
	#navigation > li.menu-item-mega > div.menu-item-mega-container > ul li li:hover > a:hover,
	#navigation > li li.menu-item-highlight > a,
	#navigation > li li.menu-item-highlight > a:hover,
	#navigation > li li.menu-item-highlight:hover > a,
	#navigation > li.menu-item-mega > div.menu-item-mega-container li.menu-item-highlight > a,
	#navigation > li.menu-item-mega > div.menu-item-mega-container li.menu-item-highlight > a:hover,
	#navigation > li.menu-item-mega > div.menu-item-mega-container li.menu-item-highlight:hover > a,
	#navigation > li.menu-item-mega > div.menu-item-mega-container li.menu-item-highlight:hover > a:hover {
		" . cmsms_color_css('color', $cmsms_option[CMSMS_SHORTNAME . '_header_dropdown_hover']) . "
	}
	/* Finish Header Dropdown Rollover Color */
	
	
	/* Start Header Dropdown Background Color */
	.header_mid input[type=text],
	.header_mid input[type=number],
	.header_mid input[type=email],
	.header_mid input[type=password],
	.header_mid input[type=submit],
	.header_mid button,
	.header_mid textarea,
	.header_mid select,
	.header_mid option,
	.header_bot input[type=text],
	.header_bot input[type=number],
	.header_bot input[type=email],
	.header_bot input[type=password],
	.header_bot input[type=submit],
	.header_bot button,
	.header_bot textarea,
	.header_bot select,
	.header_bot option,
	#navigation ul,
	#navigation > li.menu-item-mega > div.menu-item-mega-container,
	#navigation > li.menu-item-mega li:hover > a {
		" . cmsms_color_css('background-color', $cmsms_option[CMSMS_SHORTNAME . '_header_dropdown_bg']) . "
	}
	
	#navigation > li.menu-item-has-children > a:before,
	.header_mid_outer .header_mid_inner #navigation > li.menu-item-has-children > a > span.nav_bg_clr:before {
		" . cmsms_color_css('border-bottom-color', $cmsms_option[CMSMS_SHORTNAME . '_header_dropdown_bg']) . "
	}
	/* Finish Header Dropdown Background Color */
	
	
	/* Start Header Dropdown Rollover Background Color */
	#navigation ul li:hover > a,
	#navigation ul li.current-menu-item > a,
	#navigation ul li.current-menu-ancestor > a,
	#navigation > li.menu-item-mega li li:hover > a:hover,
	#navigation > li.menu-item-mega li li.current-menu-item > a,
	.header_mid .search_bar_wrap,
	.header_mid .search_bar_wrap input[type=text],
	.header_mid .search_bar_wrap input[type=text]:focus,
	.header_bot .search_bar_wrap,
	.header_bot .search_bar_wrap input[type=text],
	.header_bot .search_bar_wrap input[type=text]:focus {
		" . cmsms_color_css('background-color', $cmsms_option[CMSMS_SHORTNAME . '_header_dropdown_hover_bg']) . "
	}
	
	@media only screen and (max-width: 1024px) {
		html #page #header nav #navigation .sub-menu {
			" . cmsms_color_css('background-color', $cmsms_option[CMSMS_SHORTNAME . '_header_dropdown_hover_bg']) . "
		}
	}
	/* Finish Header Dropdown Rollover Background Color */
	
	
	/* Start Header Dropdown Borders Color */
	#navigation > li.menu-item-mega > div.menu-item-mega-container > ul:after {
		" . cmsms_color_css('background-color', $cmsms_option[CMSMS_SHORTNAME . '_header_dropdown_border']) . "
	}
	
	#navigation ul,
	#navigation > li.menu-item-mega > div.menu-item-mega-container {
		" . cmsms_color_css('border-color', $cmsms_option[CMSMS_SHORTNAME . '_header_dropdown_border']) . "
	}
	
	#navigation ul li,
	#navigation > li.menu-item-mega > div.menu-item-mega-container li li li:first-child {
		" . cmsms_color_css('border-top-color', $cmsms_option[CMSMS_SHORTNAME . '_header_dropdown_border']) . "
	}
	/* Finish Header Dropdown Borders Color */
	
	
	/* Start Header Custom Rules */
	.header_mid ::selection,
	.header_bot ::selection {
		" . cmsms_color_css('background', $cmsms_option[CMSMS_SHORTNAME . '_header_link']) . "
		" . cmsms_color_css('color', $cmsms_option[CMSMS_SHORTNAME . '_header_bg']) . "
	}
	
	.header_mid ::-moz-selection,
	.header_bot ::-moz-selection {
		" . cmsms_color_css('background', $cmsms_option[CMSMS_SHORTNAME . '_header_link']) . "
		" . cmsms_color_css('color', $cmsms_option[CMSMS_SHORTNAME . '_header_bg']) . "
	}
	
	#page.fixed_header .header_mid_outer,
	#page.fixed_header .header_bot_outer {
		background-color:rgba(" . hex2rgb($cmsms_header_bg[0]) . ", " . ((int) $cmsms_header_bg[1] / 100) . ");
	}
	";
	
	
	if ($cmsms_option[CMSMS_SHORTNAME . '_header_dropdown_shadow']) {
	$custom_css .= "
	#navigation ul,
	#navigation > li.menu-item-mega > div.menu-item-mega-container {
		-webkit-box-shadow:0 5px 15px 0 rgba(" . hex2rgb($cmsms_header_dropdown_bg[0]) . ', ' . ((int) $cmsms_option[CMSMS_SHORTNAME . '_header_dropdown_shadow_opacity'] / 100) . ");
		-moz-box-shadow:0 5px 15px 0 rgba(" . hex2rgb($cmsms_header_dropdown_bg[0]) . ', ' . ((int) $cmsms_option[CMSMS_SHORTNAME . '_header_dropdown_shadow_opacity'] / 100) . ");
		box-shadow:0 5px 15px 0 rgba(" . hex2rgb($cmsms_header_dropdown_bg[0]) . ', ' . ((int) $cmsms_option[CMSMS_SHORTNAME . '_header_dropdown_shadow_opacity'] / 100) . ");
	}
	";
	}
	
	
	$custom_css .= "
	/* Finish Header Custom Rules */

/***************** Finish Header Color Scheme Rules ******************/



/***************** Start Header Top Color Scheme Rules ******************/

	/* Start Header Top Content Color */
	.header_top,
	.header_top_outer .meta_wrap, 
	.header_top_inner .social_wrap a {
		" . cmsms_color_css('color', $cmsms_option[CMSMS_SHORTNAME . '_header_top_color']) . "
	}
	/* Finish Header Top Content Color */
	
	
	/* Start Header Top Primary Color */
	.header_top a,
	.header_top .color_2,
	.header_top_outer nav > div > ul > li a,
	.header_top_outer .meta_wrap a,
	.header_top h1,
	.header_top h2,
	.header_top h3,
	.header_top h4,
	.header_top h5,
	.header_top h6,
	.header_top h1 a,
	.header_top h2 a,
	.header_top h3 a,
	.header_top h4 a,
	.header_top h5 a,
	.header_top h6 a,
	.header_top h1 a:hover,
	.header_top h2 a:hover,
	.header_top h3 a:hover,
	.header_top h4 a:hover,
	.header_top h5 a:hover,
	.header_top h6 a:hover,
	.header_top .search_bar_wrap button[type=submit][class^=\"cmsms-icon-\"],
	.header_top .search_bar_wrap button[type=submit][class*=\" cmsms-icon-\"] {
		" . cmsms_color_css('color', $cmsms_option[CMSMS_SHORTNAME . '_header_top_link']) . "
	}
	
	@media only screen and (max-width: 1024px) {
		html #page #header .header_top .header_top_outer .header_top_inner .header_top_right .nav_wrap nav #top_line_nav li > a {
			" . cmsms_color_css('color', $cmsms_option[CMSMS_SHORTNAME . '_header_top_link']) . "
		}
	}
	
	.header_top .cmsms_button,
	.header_top .button:hover,
	.header_top_outer nav > div > ul > li > a > span.cmsms_count,
	.header_top .button {
		" . cmsms_color_css('background-color', $cmsms_option[CMSMS_SHORTNAME . '_header_top_link']) . "
	}
	
	.header_top input[type=text]:focus,
	.header_top input[type=number]:focus,
	.header_top input[type=email]:focus,
	.header_top input[type=password]:focus,
	.header_top textarea:focus {
		" . cmsms_color_css('border-color', $cmsms_option[CMSMS_SHORTNAME . '_header_top_link']) . "
	}
	/* Finish Header Top Primary Color */
	
	
	/* Start Header Top Rollover Color */
	.header_top a:hover,
	.header_top_outer nav > div > ul > li:hover > a,
	.header_top_outer nav > div > ul > li.current-menu-item > a,
	.header_top_outer nav > div > ul > li.current-menu-ancestor > a,
	.header_top_outer .meta_wrap a:hover, 
	.header_top_inner .social_wrap a:hover {
		" . cmsms_color_css('color', $cmsms_option[CMSMS_SHORTNAME . '_header_top_hover']) . "
	}
	
	@media only screen and (max-width: 1024px) {
		html #page #header .header_top .header_top_outer .header_top_inner .header_top_right .nav_wrap nav #top_line_nav li > a:hover, 
		html #page #header .header_top .header_top_outer .header_top_inner .header_top_right .nav_wrap nav #top_line_nav li.current-menu-item > a {
			" . cmsms_color_css('color', $cmsms_option[CMSMS_SHORTNAME . '_header_top_hover']) . "
		}
	}
	
	.header_top_but .cmsms_top_arrow, 
	.header_top_but .cmsms_bot_arrow {
		" . cmsms_color_css('background-color', $cmsms_option[CMSMS_SHORTNAME . '_header_top_hover']) . "
	}
	
	.header_top_but .cmsms_top_arrow:before, 
	.header_top_but .cmsms_top_arrow:after, 
	.header_top_but .cmsms_top_arrow span:before, 
	.header_top_but .cmsms_top_arrow span:after, 
	.header_top_but .cmsms_bot_arrow:before, 
	.header_top_but .cmsms_bot_arrow:after, 
	.header_top_but .cmsms_bot_arrow span:before, 
	.header_top_but .cmsms_bot_arrow span:after {
		" . cmsms_color_css('border-color', $cmsms_option[CMSMS_SHORTNAME . '_header_top_hover']) . "
	}
	/* Finish Header Top Rollover Color */
	
	
	/* Start Header Top Background Color */
	.header_top_outer nav > div > ul > li > a > span.cmsms_count,
	.header_top .cmsms_button,
	.header_top .cmsms_button:hover {
		" . cmsms_color_css('color', $cmsms_option[CMSMS_SHORTNAME . '_header_top_bg']) . "
	}
	
	.header_top,
	.header_top input[type=text]:focus,
	.header_top input[type=number]:focus,
	.header_top input[type=email]:focus,
	.header_top input[type=password]:focus,
	.header_top textarea:focus,
	.header_top_outer {
		" . cmsms_color_css('background-color', $cmsms_option[CMSMS_SHORTNAME . '_header_top_bg']) . "
	}
	/* Finish Header Top Background Color */
	
	
	/* Start Header Top Borders Color */
	.header_top input[type=text],
	.header_top input[type=number],
	.header_top input[type=email],
	.header_top input[type=password],
	.header_top input[type=submit],
	.header_top button,
	.header_top textarea,
	.header_top select,
	.header_top option,
	.header_top .search_bar_wrap {
		" . cmsms_color_css('border-color', $cmsms_option[CMSMS_SHORTNAME . '_header_top_border']) . "
	}
	
	.header_top hr,
	.header_top .cmsms_divider {
		" . cmsms_color_css('border-bottom-color', $cmsms_option[CMSMS_SHORTNAME . '_header_top_border']) . "
	}
	
	@media only screen and (max-width: 1024px) {
		html #page #header .header_top .header_top_outer .header_top_inner .header_top_left, 
		html #page #header .header_top .header_top_outer .header_top_inner .header_top_right {
			" . cmsms_color_css('border-bottom-color', $cmsms_option[CMSMS_SHORTNAME . '_header_top_border']) . "
		}
		
		html #page #header .header_top .header_top_outer .header_top_inner .header_top_right .nav_wrap nav #top_line_nav li > a {
			" . cmsms_color_css('border-top-color', $cmsms_option[CMSMS_SHORTNAME . '_header_top_border']) . "
		}
	}
	/* Finish Header Top Borders Color */
	
	
	/* Start Header Top Dropdown Link Color */
	.header_top_outer nav > div > ul > li a,
	.header_top_outer nav > div > ul > li ul li > a,
	.header_top .button,
	.header_top .button:hover, 
	html #page #header .header_top .header_top_outer .header_top_inner .header_top_right .nav_wrap .responsive_top_nav:hover, 
	html #page #header .header_top .header_top_outer .header_top_inner .header_top_right .nav_wrap .responsive_top_nav.active {
		" . cmsms_color_css('color', $cmsms_option[CMSMS_SHORTNAME . '_header_top_dropdown_link']) . "
	}
	
	html #page #header .header_top .header_top_outer .header_top_inner .header_top_right .nav_wrap .responsive_top_nav {
		" . cmsms_color_css('background-color', $cmsms_option[CMSMS_SHORTNAME . '_header_top_dropdown_link']) . "
	}
	/* Finish Header Top Dropdown Link Color */
	
	
	/* Start Header Top Dropdown Rollover Color */
	.header_top_outer nav > div > ul > li ul li:hover > a,
	.header_top_outer nav > div > ul > li ul li.current-menu-item > a,
	.header_top_outer nav > div > ul > li ul li.current-menu-ancestor > a, 
	html #page #header .header_top .header_top_outer .header_top_inner .header_top_right .nav_wrap .responsive_top_nav {
		" . cmsms_color_css('color', $cmsms_option[CMSMS_SHORTNAME . '_header_top_dropdown_hover']) . "
	}
	/* Finish Header Top Dropdown Rollover Color */
	
	
	/* Start Header Top Dropdown Background Color */
	.header_top input[type=text],
	.header_top input[type=number],
	.header_top input[type=email],
	.header_top input[type=password],
	.header_top input[type=submit],
	.header_top button,
	.header_top textarea,
	.header_top select,
	.header_top option,
	.header_top_outer nav > div > ul > li ul,
	.header_top .search_bar_wrap,
	.header_top .search_bar_wrap input[type=text],
	.header_top .search_bar_wrap input[type=text]:focus {
		" . cmsms_color_css('background-color', $cmsms_option[CMSMS_SHORTNAME . '_header_top_dropdown_bg']) . "
	}
	/* Finish Header Top Dropdown Background Color */
	
	
	/* Start Header Top Dropdown Border Color */
	
	.header_top_outer nav > div > ul > li.menu-item-has-children > a:before {
		" . cmsms_color_css('border-bottom-color', $cmsms_option[CMSMS_SHORTNAME . '_header_top_dropdown_border']) . "
	}
	
	html #page #header .header_top .header_top_outer .header_top_inner .header_top_right .nav_wrap .responsive_top_nav:hover, 
	html #page #header .header_top .header_top_outer .header_top_inner .header_top_right .nav_wrap .responsive_top_nav.active {
		" . cmsms_color_css('background-color', $cmsms_option[CMSMS_SHORTNAME . '_header_top_dropdown_border']) . "
	}
	/* Finish Header Top Dropdown Border Color */
	
	
	/* Start Header Top Custom Rules */
	.header_top ::selection {
		" . cmsms_color_css('background', $cmsms_option[CMSMS_SHORTNAME . '_header_top_link']) . "
		" . cmsms_color_css('color', $cmsms_option[CMSMS_SHORTNAME . '_header_top_bg']) . "
	}
	
	.header_top ::-moz-selection {
		" . cmsms_color_css('background', $cmsms_option[CMSMS_SHORTNAME . '_header_top_link']) . "
		" . cmsms_color_css('color', $cmsms_option[CMSMS_SHORTNAME . '_header_top_bg']) . "
	}
	
	.header_top_outer {
		-webkit-box-shadow:inset 0 -1px 0 0 rgba(" . hex2rgb($cmsms_header_top_bd[0]) . ', ' . ((int) $cmsms_header_top_bd[1] / 100) . ");
		-moz-box-shadow:inset 0 -1px 0 0 rgba(" . hex2rgb($cmsms_header_top_bd[0]) . ', ' . ((int) $cmsms_header_top_bd[1] / 100) . ");
		box-shadow:inset 0 -1px 0 0 rgba(" . hex2rgb($cmsms_header_top_bd[0]) . ', ' . ((int) $cmsms_header_top_bd[1] / 100) . ");
	}
	";
	
	
	if ($cmsms_option[CMSMS_SHORTNAME . '_header_top_dropdown_shadow']) {
	$custom_css .= "
	.header_top_outer nav > div > ul > li ul {
		-webkit-box-shadow:0 0 2px 0 rgba(0, 0, 0, rgba(" . hex2rgb($cmsms_header_top_dropdown_bg[0]) . ', ' . ((int) $cmsms_option[CMSMS_SHORTNAME . '_header_top_dropdown_shadow_opacity'] / 100) . ");
		-moz-box-shadow:0 0 2px 0 rgba(0, 0, 0, rgba(" . hex2rgb($cmsms_header_top_dropdown_bg[0]) . ', ' . ((int) $cmsms_option[CMSMS_SHORTNAME . '_header_top_dropdown_shadow_opacity'] / 100) . ");
		box-shadow:0 0 2px 0 rgba(0, 0, 0, rgba(" . hex2rgb($cmsms_header_top_dropdown_bg[0]) . ', ' . ((int) $cmsms_option[CMSMS_SHORTNAME . '_header_top_dropdown_shadow_opacity'] / 100) . ");
	}
	";
	}
	
	
	$custom_css .= "
	/* Finish Header Top Custom Rules */

/***************** Finish Header Top Color Scheme Rules ******************/

";
	
	
	return $custom_css;
}

