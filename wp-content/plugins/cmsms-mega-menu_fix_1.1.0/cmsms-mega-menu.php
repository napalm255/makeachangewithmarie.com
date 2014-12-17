<?php 
/*
Plugin Name: CMSMasters Mega Menu
Plugin URI: http://cmsmasters.net/
Description: CMSMasters Mega Menu created by <a href="http://cmsmasters.net/" title="CMSMasters">CMSMasters</a> team. Mega Menu plugin create custom settings integrated to WordPress default Appearance > Menus editor for new <a href="http://themeforest.net/user/cmsmasters/portfolio" title="cmsmasters">cmsmasters</a> WordPress themes.
Version: 1.1.0
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
	http://cmsmasters.net/files/license/cmsms-mega-menu/license.txt 
	or contact CMSMasters Studio at email 
	copyright.cmsmasters@gmail.com 
	about this.
	
	Please note, that any usage of this software, that 
	contradicts the license terms is a subject to legal pursue 
	and will result copyright reclaim and damage withdrawal.
*/


define('CMSMS_MEGA_MENU_URL', plugin_dir_url(__FILE__));


class Cmsms_Mega_Menu { 
	function __construct() { 
		add_action('admin_enqueue_scripts', array($this, 'cmsms_add_custom_admin_menu_header'));
		
		
		add_action('wp_enqueue_scripts', array($this, 'cmsms_add_custom_menu_header'));
		
		
		remove_filter('nav_menu_description', 'strip_tags');
		
		
		add_filter('wp_setup_nav_menu_item', array($this, 'cmsms_add_custom_nav_fields'));
		
		
		add_action('wp_update_nav_menu_item', array($this, 'cmsms_update_custom_nav_fields'), 10, 3);
		
		
		add_filter('wp_edit_nav_menu_walker', array($this, 'cmsms_edit_walker'), 10, 2);
		
		// Load Plugin Local File
		load_plugin_textdomain('cmsms_maga_menu', false, dirname(plugin_basename(__FILE__)) . '/languages/');
	}
	
	
	function cmsms_add_custom_admin_menu_header() {
		if (basename($_SERVER['PHP_SELF']) == 'nav-menus.php') {
			wp_register_style('cmsms-mega-menu', CMSMS_MEGA_MENU_URL . '/admin/css/mega-menu.css', array(), '1.0.0', 'screen');
			
			wp_enqueue_style('cmsms-mega-menu');
			
			
			wp_enqueue_style('wp-color-picker');
			
			
			wp_register_script('cmsms-mega-menu', CMSMS_MEGA_MENU_URL . '/admin/js/mega-menu.js', array('jquery', 'jquery-ui-sortable'), '1.0.0', true);
			
			wp_enqueue_script('cmsms-mega-menu');
			
			
			wp_enqueue_script('wp-color-picker');
		}
	}
	
	
	function cmsms_add_custom_menu_header() {
		if (!is_admin()) {
			wp_register_script('megamenu', CMSMS_MEGA_MENU_URL . '/js/jquery.megaMenu.js', array('jquery'), '1.0.0', true);
			
			wp_enqueue_script('megamenu');
		}
	}
	
	
	function cmsms_add_custom_nav_fields($menu_item) { 
		// Global
		$menu_item->highlight = get_post_meta($menu_item->ID, '_menu_item_highlight', true);
		
		$menu_item->color = get_post_meta($menu_item->ID, '_menu_item_color', true);
		
		// $menu_item->icon = get_post_meta($menu_item->ID, '_menu_item_icon', true);
		
		// $menu_item->hide_text = get_post_meta($menu_item->ID, '_menu_item_hide_text', true); // move from columns to all
		
		// 1 Level
		$menu_item->drop_side = get_post_meta($menu_item->ID, '_menu_item_drop_side', true);
		
		$menu_item->mega = get_post_meta($menu_item->ID, '_menu_item_mega', true);
		
		$menu_item->mega_cols = get_post_meta($menu_item->ID, '_menu_item_mega_cols', true);
		
		$menu_item->mega_cols_full = get_post_meta($menu_item->ID, '_menu_item_mega_cols_full', true);
		
		// 2 Level
		$menu_item->hide_text = get_post_meta($menu_item->ID, '_menu_item_hide_text', true);
		
		// 3 Level
		$menu_item->mega_descr_text = get_post_meta($menu_item->ID, '_menu_item_mega_descr_text', true);
		
		
		return $menu_item;
	}
	
	
	function cmsms_update_custom_nav_fields($menu_id, $menu_item_db_id, $args) { 
		if (isset($_POST['menu-item-highlight'])) {
			if (is_array($_POST['menu-item-highlight'])) {
				$highlight_value = (isset($_POST['menu-item-highlight'][$menu_item_db_id])) ? $_POST['menu-item-highlight'][$menu_item_db_id] : '';
				
				
				update_post_meta($menu_item_db_id, '_menu_item_highlight', $highlight_value);
			}
		} else {
			update_post_meta($menu_item_db_id, '_menu_item_highlight', '');
		}
		
		
		if (isset($_POST['menu-item-color'])) {
			if (is_array($_POST['menu-item-color'])) {
				$color_value = (isset($_POST['menu-item-color'][$menu_item_db_id])) ? $_POST['menu-item-color'][$menu_item_db_id] : '';
				
				
				update_post_meta($menu_item_db_id, '_menu_item_color', $color_value);
			}
		} else {
			update_post_meta($menu_item_db_id, '_menu_item_color', '');
		}
		
		
		// if (isset($_POST['menu-item-icon'])) {
			// if (is_array($_POST['menu-item-icon'])) {
				// $icon_value = (isset($_POST['menu-item-icon'][$menu_item_db_id])) ? $_POST['menu-item-icon'][$menu_item_db_id] : '';
				
				
				// update_post_meta($menu_item_db_id, '_menu_item_icon', $icon_value);
			// }
		// } else {
			// update_post_meta($menu_item_db_id, '_menu_item_icon', '');
		// }
		
		
		if (isset($_POST['menu-item-hide_text'])) {
			if (is_array($_POST['menu-item-hide_text'])) {
				$hide_text_value = (isset($_POST['menu-item-hide_text'][$menu_item_db_id])) ? $_POST['menu-item-hide_text'][$menu_item_db_id] : '';
				
				
				update_post_meta($menu_item_db_id, '_menu_item_hide_text', $hide_text_value);
			}
		} else {
			update_post_meta($menu_item_db_id, '_menu_item_hide_text', '');
		}
		
		
		if (isset($_POST['menu-item-drop_side'])) {
			if (is_array($_POST['menu-item-drop_side'])) {
				$drop_side_value = (isset($_POST['menu-item-drop_side'][$menu_item_db_id])) ? $_POST['menu-item-drop_side'][$menu_item_db_id] : '';
				
				
				update_post_meta($menu_item_db_id, '_menu_item_drop_side', $drop_side_value);
			}
		} else {
			update_post_meta($menu_item_db_id, '_menu_item_drop_side', '');
		}
		
		
		if (isset($_POST['menu-item-mega'])) {
			if (isset($_POST['menu-item-mega']) && is_array($_POST['menu-item-mega'])) {
				$mega_value = (isset($_POST['menu-item-mega'][$menu_item_db_id])) ? $_POST['menu-item-mega'][$menu_item_db_id] : '';
				
				
				update_post_meta($menu_item_db_id, '_menu_item_mega', $mega_value);
			}
		} else {
			update_post_meta($menu_item_db_id, '_menu_item_mega', '');
		}
		
		
		if (isset($_POST['menu-item-mega_cols'])) {
			if (is_array($_POST['menu-item-mega_cols'])) {
				$mega_cols_value = (isset($_POST['menu-item-mega_cols'][$menu_item_db_id])) ? $_POST['menu-item-mega_cols'][$menu_item_db_id] : '';
				
				
				update_post_meta($menu_item_db_id, '_menu_item_mega_cols', $mega_cols_value);
			}
		} else {
			update_post_meta($menu_item_db_id, '_menu_item_mega_cols', '');
		}
		
		
		if (isset($_POST['menu-item-mega_cols_full'])) {
			if (is_array($_POST['menu-item-mega_cols_full'])) {
				$mega_cols_full_value = (isset($_POST['menu-item-mega_cols_full'][$menu_item_db_id])) ? $_POST['menu-item-mega_cols_full'][$menu_item_db_id] : '';
				
				
				update_post_meta($menu_item_db_id, '_menu_item_mega_cols_full', $mega_cols_full_value);
			}
		} else {
			update_post_meta($menu_item_db_id, '_menu_item_mega_cols_full', '');
		}
		
		
		if (isset($_POST['menu-item-mega_descr_text'])) {
			if (is_array($_POST['menu-item-mega_descr_text'])) {
				$mega_descr_text_value = (isset($_POST['menu-item-mega_descr_text'][$menu_item_db_id])) ? $_POST['menu-item-mega_descr_text'][$menu_item_db_id] : '';
				
				
				update_post_meta($menu_item_db_id, '_menu_item_mega_descr_text', $mega_descr_text_value);
			}
		} else {
			update_post_meta($menu_item_db_id, '_menu_item_mega_descr_text', '');
		}
	}
	
	
	function cmsms_edit_walker($walker, $menu_id) { 
		return 'Walker_Cmsms_Nav_Mega_Menu_Edit';
	}
}


class Walker_Cmsms_Nav_Mega_Menu_Edit extends Walker_Nav_Menu { 
	function start_lvl( &$output, $depth = 0, $args = array() ) {}
	
	
	function end_lvl( &$output, $depth = 0, $args = array() ) {}
	
	
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		global $_wp_nav_menu_max_depth;
		$_wp_nav_menu_max_depth = $depth > $_wp_nav_menu_max_depth ? $depth : $_wp_nav_menu_max_depth;

		ob_start();
		$item_id = esc_attr( $item->ID );
		$removed_args = array(
			'action',
			'customlink-tab',
			'edit-menu-item',
			'menu-item',
			'page-tab',
			'_wpnonce',
		);

		$original_title = '';
		if ( 'taxonomy' == $item->type ) {
			$original_title = get_term_field( 'name', $item->object_id, $item->object, 'raw' );
			if ( is_wp_error( $original_title ) )
				$original_title = false;
		} elseif ( 'post_type' == $item->type ) {
			$original_object = get_post( $item->object_id );
			$original_title = get_the_title( $original_object->ID );
		}

		$classes = array(
			'menu-item menu-item-depth-' . $depth,
			'menu-item-' . esc_attr( $item->object ),
			'menu-item-edit-' . ( ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? 'active' : 'inactive'),
		);

		$title = $item->title;

		if ( ! empty( $item->_invalid ) ) {
			$classes[] = 'menu-item-invalid';
			$title = sprintf( __( '%s (Invalid)' ), $item->title );
		} elseif ( isset( $item->post_status ) && 'draft' == $item->post_status ) {
			$classes[] = 'pending';
			$title = sprintf( __('%s (Pending)'), $item->title );
		}

		$title = ( ! isset( $item->label ) || '' == $item->label ) ? $title : $item->label;

		$submenu_text = '';
		if ( 0 == $depth )
			$submenu_text = 'style="display: none;"';

		$highlight_class = '';
		if ( $item->highlight == 'highlight')
			$highlight_class = ' cmsms_highlight';

		$drop_side_text = '';
		if ( 0 == $depth && $item->drop_side == 'right')
			$drop_side_text = 'style="display: inline;"';

		$mega_menu_text = '';
		if ( 0 == $depth && $item->mega == 'mega')
			$mega_menu_text = 'style="display: inline;"';

		$hide_text_class = '';
		if ( 1 == $depth && $item->mega == 'mega' && $item->hide_text == 'hide')
			$hide_text_class = ' cmsms_hide_text';

		?>
		<li id="menu-item-<?php echo $item_id; ?>" class="<?php echo implode(' ', $classes ); ?>">
			<dl class="menu-item-bar">
				<dt class="menu-item-handle">
					<span class="item-title"><span class="menu-item-title<?php echo $highlight_class . $hide_text_class; ?>"><?php echo esc_html( $title ); ?></span> <span class="is-submenu" <?php echo $submenu_text; ?>><?php _e( 'sub item' ); ?></span><span class="is-mega-menu" <?php echo $mega_menu_text; ?>><?php _e( 'mega menu', 'cmsms_maga_menu' ); ?></span><span class="is-column"><?php _e( 'column', 'cmsms_maga_menu' ); ?></span><span class="is-mega-descr-text"><?php _e( 'text block', 'cmsms_maga_menu' ); ?></span><span class="is-drop-side-right dashicons dashicons-arrow-left-alt" <?php echo $drop_side_text; ?>></span></span>
					<span class="item-controls">
						<span class="item-type"><?php echo esc_html( $item->type_label ); ?></span>
						<span class="item-order hide-if-js">
							<a href="<?php
								echo wp_nonce_url(
									add_query_arg(
										array(
											'action' => 'move-up-menu-item',
											'menu-item' => $item_id,
										),
										remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
									),
									'move-menu_item'
								);
							?>" class="item-move-up"><abbr title="<?php esc_attr_e('Move up'); ?>">&#8593;</abbr></a>
							|
							<a href="<?php
								echo wp_nonce_url(
									add_query_arg(
										array(
											'action' => 'move-down-menu-item',
											'menu-item' => $item_id,
										),
										remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
									),
									'move-menu_item'
								);
							?>" class="item-move-down"><abbr title="<?php esc_attr_e('Move down'); ?>">&#8595;</abbr></a>
						</span>
						<a class="item-edit" id="edit-<?php echo $item_id; ?>" title="<?php esc_attr_e('Edit Menu Item'); ?>" href="<?php
							echo ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? admin_url( 'nav-menus.php' ) : add_query_arg( 'edit-menu-item', $item_id, remove_query_arg( $removed_args, admin_url( 'nav-menus.php#menu-item-settings-' . $item_id ) ) );
						?>"><?php _e( 'Edit Menu Item' ); ?></a>
					</span>
				</dt>
			</dl>

			<div class="menu-item-settings" id="menu-item-settings-<?php echo $item_id; ?>">
				<?php if( 'custom' == $item->type ) : ?>
					<p class="field-url description description-wide">
						<label for="edit-menu-item-url-<?php echo $item_id; ?>">
							<?php _e( 'URL' ); ?><br />
							<input type="text" id="edit-menu-item-url-<?php echo $item_id; ?>" class="widefat code edit-menu-item-url" name="menu-item-url[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->url ); ?>" />
						</label>
					</p>
				<?php endif; ?>
				<p class="description description-thin">
					<label for="edit-menu-item-title-<?php echo $item_id; ?>">
						<?php _e( 'Navigation Label' ); ?><br />
						<input type="text" id="edit-menu-item-title-<?php echo $item_id; ?>" class="widefat edit-menu-item-title" name="menu-item-title[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->title ); ?>" />
					</label>
				</p>
				<p class="description description-thin">
					<label for="edit-menu-item-attr-title-<?php echo $item_id; ?>">
						<?php _e( 'Title Attribute' ); ?><br />
						<input type="text" id="edit-menu-item-attr-title-<?php echo $item_id; ?>" class="widefat edit-menu-item-attr-title" name="menu-item-attr-title[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->post_excerpt ); ?>" />
					</label>
				</p>
				<p class="field-link-target description">
					<label for="edit-menu-item-target-<?php echo $item_id; ?>">
						<input type="checkbox" id="edit-menu-item-target-<?php echo $item_id; ?>" value="_blank" name="menu-item-target[<?php echo $item_id; ?>]"<?php checked( $item->target, '_blank' ); ?> />
						<?php _e( 'Open link in a new window/tab' ); ?>
					</label>
				</p>
				<p class="field-css-classes description description-thin">
					<label for="edit-menu-item-classes-<?php echo $item_id; ?>">
						<?php _e( 'CSS Classes (optional)' ); ?><br />
						<input type="text" id="edit-menu-item-classes-<?php echo $item_id; ?>" class="widefat code edit-menu-item-classes" name="menu-item-classes[<?php echo $item_id; ?>]" value="<?php echo esc_attr( implode(' ', $item->classes ) ); ?>" />
					</label>
				</p>
				<p class="field-xfn description description-thin">
					<label for="edit-menu-item-xfn-<?php echo $item_id; ?>">
						<?php _e( 'Link Relationship (XFN)' ); ?><br />
						<input type="text" id="edit-menu-item-xfn-<?php echo $item_id; ?>" class="widefat code edit-menu-item-xfn" name="menu-item-xfn[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->xfn ); ?>" />
					</label>
				</p>
				<p class="field-description description description-wide">
					<label for="edit-menu-item-description-<?php echo $item_id; ?>">
						<?php _e( 'Description' ); ?><br />
						<textarea id="edit-menu-item-description-<?php echo $item_id; ?>" class="widefat edit-menu-item-description" rows="3" cols="20" name="menu-item-description[<?php echo $item_id; ?>]"><?php echo $item->post_content; ?></textarea>
						<span class="description"><?php _e('The description will be displayed in the menu if the current theme supports it.'); ?></span>
					</label>
				</p>
				<p class="field-highlight description description-wide">
					<label for="edit-menu-item-highlight-<?php echo $item_id; ?>">
						<input type="checkbox" id="edit-menu-item-highlight-<?php echo $item_id; ?>" class="menu-item-highlight" value="highlight" name="menu-item-highlight[<?php echo $item_id; ?>]"<?php checked( $item->highlight, 'highlight' ); ?> />
						<?php _e( 'Highlight this menu item', 'cmsms_maga_menu' ); ?>
					</label>
				</p>
				<p class="field-color description description-wide">
					<label for="edit-menu-item-color-<?php echo $item_id; ?>">
						<?php _e( 'Menu Item Color', 'cmsms_maga_menu' ); ?><br />
						<input type="text" id="edit-menu-item-color-<?php echo $item_id; ?>" class="menu-item-color my-color-field" value="<?php echo esc_attr( $item->color ); ?>" name="menu-item-color[<?php echo $item_id; ?>]" data-default-color="" />
					</label>
				</p>
				<p class="field-hide_text description description-wide">
					<label for="edit-menu-item-hide_text-<?php echo $item_id; ?>">
						<input type="checkbox" id="edit-menu-item-hide_text-<?php echo $item_id; ?>" class="menu-item-hide_text" value="hide" name="menu-item-hide_text[<?php echo $item_id; ?>]"<?php checked( $item->hide_text, 'hide' ); ?> />
						<?php _e( 'Hide this column title', 'cmsms_maga_menu' ); ?>
					</label>
				</p>
				<p class="field-drop_side description description-wide">
					<label for="edit-menu-item-drop_side-<?php echo $item_id; ?>">
						<input type="checkbox" id="edit-menu-item-drop_side-<?php echo $item_id; ?>" class="menu-item-drop_side" value="right" name="menu-item-drop_side[<?php echo $item_id; ?>]"<?php checked( $item->drop_side, 'right' ); ?> />
						<?php _e( 'Align drop-down menus to the Right Side', 'cmsms_maga_menu' ); ?>
					</label>
				</p>
				<p class="field-mega description description-wide">
					<label for="edit-menu-item-mega-<?php echo $item_id; ?>">
						<input type="checkbox" id="edit-menu-item-mega-<?php echo $item_id; ?>" class="menu-item-mega" value="mega" name="menu-item-mega[<?php echo $item_id; ?>]"<?php checked( $item->mega, 'mega' ); ?> />
						<?php _e( 'Use as Mega Menu', 'cmsms_maga_menu' ); ?>
					</label>
				</p>
				<p class="field-mega_cols description description-wide">
					<label for="edit-menu-item-mega_cols-<?php echo $item_id; ?>">
						<?php _e( 'Mega Menu Columns Count', 'cmsms_maga_menu' ); ?><br />
						<select id="edit-menu-item-mega_cols-<?php echo $item_id; ?>" class="widefat edit-menu-item-mega_cols" name="menu-item-mega_cols[<?php echo $item_id; ?>]">
							<option value="two"<?php selected( $item->mega_cols, 'two' ); ?>><?php _e( '2 Columns', 'cmsms_maga_menu' ); ?></option>
							<option value="three"<?php selected( $item->mega_cols, 'three' ); ?>><?php _e( '3 Columns', 'cmsms_maga_menu' ); ?></option>
							<option value="four"<?php selected( $item->mega_cols, 'four' ); ?>><?php _e( '4 Columns', 'cmsms_maga_menu' ); ?></option>
							<option value="five"<?php selected( $item->mega_cols, 'five' ); ?>><?php _e( '5 Columns', 'cmsms_maga_menu' ); ?></option>
						</select>
					</label>
				</p>
				<p class="field-mega_cols_full description description-wide">
					<label for="edit-menu-item-mega_cols_full-<?php echo $item_id; ?>">
						<input type="checkbox" id="edit-menu-item-mega_cols_full-<?php echo $item_id; ?>" class="menu-item-mega_cols_full" value="fullwidth" name="menu-item-mega_cols_full[<?php echo $item_id; ?>]"<?php checked( $item->mega_cols_full, 'fullwidth' ); ?> />
						<?php _e( 'Stretch Mega Menu columns on full width', 'cmsms_maga_menu' ); ?>
					</label>
				</p>
				<p class="field-mega_descr_text description description-wide">
					<label for="edit-menu-item-mega_descr_text-<?php echo $item_id; ?>">
						<input type="checkbox" id="edit-menu-item-mega_descr_text-<?php echo $item_id; ?>" class="menu-item-mega_descr_text" value="description" name="menu-item-mega_descr_text[<?php echo $item_id; ?>]"<?php checked( $item->mega_descr_text, 'description' ); ?> />
						<?php echo __( 'Use the description field to create a Text Block.', 'cmsms_maga_menu' ) . '<br />' . __( "Note: Don't remove the navigation label text, otherwise wordpress will delete the item", 'cmsms_maga_menu' ); ?>
					</label>
				</p>

				<p class="field-move hide-if-no-js description description-wide">
					<label>
						<span><?php _e( 'Move' ); ?></span>
						<a href="#" class="menus-move-up"><?php _e( 'Up one' ); ?></a>
						<a href="#" class="menus-move-down"><?php _e( 'Down one' ); ?></a>
						<a href="#" class="menus-move-left"></a>
						<a href="#" class="menus-move-right"></a>
						<a href="#" class="menus-move-top"><?php _e( 'To the top' ); ?></a>
					</label>
				</p>

				<div class="menu-item-actions description-wide submitbox">
					<?php if( 'custom' != $item->type && $original_title !== false ) : ?>
						<p class="link-to-original">
							<?php printf( __('Original: %s'), '<a href="' . esc_attr( $item->url ) . '">' . esc_html( $original_title ) . '</a>' ); ?>
						</p>
					<?php endif; ?>
					<a class="item-delete submitdelete deletion" id="delete-<?php echo $item_id; ?>" href="<?php
					echo wp_nonce_url(
						add_query_arg(
							array(
								'action' => 'delete-menu-item',
								'menu-item' => $item_id,
							),
							admin_url( 'nav-menus.php' )
						),
						'delete-menu_item_' . $item_id
					); ?>"><?php _e( 'Remove' ); ?></a> <span class="meta-sep hide-if-no-js"> | </span> <a class="item-cancel submitcancel hide-if-no-js" id="cancel-<?php echo $item_id; ?>" href="<?php echo esc_url( add_query_arg( array( 'edit-menu-item' => $item_id, 'cancel' => time() ), admin_url( 'nav-menus.php' ) ) );
						?>#menu-item-settings-<?php echo $item_id; ?>"><?php _e('Cancel'); ?></a>
				</div>

				<input class="menu-item-data-db-id" type="hidden" name="menu-item-db-id[<?php echo $item_id; ?>]" value="<?php echo $item_id; ?>" />
				<input class="menu-item-data-object-id" type="hidden" name="menu-item-object-id[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->object_id ); ?>" />
				<input class="menu-item-data-object" type="hidden" name="menu-item-object[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->object ); ?>" />
				<input class="menu-item-data-parent-id" type="hidden" name="menu-item-parent-id[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->menu_item_parent ); ?>" />
				<input class="menu-item-data-position" type="hidden" name="menu-item-position[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->menu_order ); ?>" />
				<input class="menu-item-data-type" type="hidden" name="menu-item-type[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->type ); ?>" />
			</div><!-- .menu-item-settings-->
			<ul class="menu-item-transport"></ul>
		<?php
		$output .= ob_get_clean();
	}
}


class Walker_Cmsms_Nav_Mega_Menu extends Walker_Nav_Menu { 
	var $cols_count;
	
	
	var $col_number;
	
	
	function start_lvl(&$output, $depth = 0, $args = array()) { 
		$indent = str_repeat("\t", $depth);
		
		$output .= "\n$indent<ul class=\"sub-menu\">\n";
	}
	
	
	function end_lvl(&$output, $depth = 0, $args = array()) { 
		$indent = str_repeat("\t", $depth);
		
		$output .= "$indent</ul>\n";
	}
	
	
	function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) { 
		$indent = ($depth) ? str_repeat("\t", $depth) : '';
		
		
		$class_names = $value = '';
		
		
		if ($depth == 0) {
			if (!empty($item->mega) && !empty($item->mega_cols)) {
				if ($item->mega_cols == 'two') {
					$this->cols_count = 2;
				} elseif ($item->mega_cols == 'three') {
					$this->cols_count = 3;
				} elseif ($item->mega_cols == 'four') {
					$this->cols_count = 4;
				} elseif ($item->mega_cols == 'five') {
					$this->cols_count = 5;
				}
				
				
				$this->col_number = NULL;
			} else {
				$this->cols_count = NULL;
				
				$this->col_number = NULL;
			}
		} elseif ($depth == 1) {
			if ($this->cols_count != NULL) {
				if ($this->col_number != NULL) {
					$this->col_number++;
				} else {
					$this->col_number = 1;
				}
			}
		}
		
		
		$classes = empty($item->classes) ? array() : (array) $item->classes;
		
		$classes[] = 'menu-item-' . $item->ID;
		
		
		if (!empty($item->highlight)) {
			$classes[] = 'menu-item-highlight';
		}
		
		
		if ($depth == 0 && !empty($item->drop_side)) {
			$classes[] = 'menu-item-dropdown-right';
		}
		
		
		if ($depth == 0 && !empty($item->mega)) {
			$classes[] = 'menu-item-mega';
		}
		
		
		if ($depth == 0 && !empty($item->mega) && !empty($item->mega_cols)) {
			$classes[] = 'menu-item-mega-cols-' . $item->mega_cols;
		}
		
		
		if ($depth == 0 && !empty($item->mega) && !empty($item->mega_cols_full)) {
			$classes[] = 'menu-item-mega-fullwidth';
		}
		
		
		if ($depth > 1 && !empty($item->mega_descr_text)) {
			$classes[] = 'menu-item-mega-description';
		}
		
		
		$class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
		
		$class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';
		
		
		$id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
		
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';
		
		
		if ($depth == 1 && $this->col_number != NULL && $this->cols_count != NULL) {
			if ($this->col_number > $this->cols_count) {
				$this->col_number = 1;
				
				
				$this->end_lvl($output, $depth, $args);
				
				$this->start_lvl($output, $depth, $args);
			}
		}
		
		
		$output .= $indent . '<li' . $id . $value . $class_names .'>';
		
		
		$atts = array();
		
		$atts['title'] = !empty($item->attr_title) ? $item->attr_title : '';
		
		$atts['target'] = !empty($item->target) ? $item->target : '';
		
		$atts['rel'] = !empty($item->xfn) ? $item->xfn : '';
		
		$atts['href'] = !empty($item->url) ? $item->url : '';
		
		
		if ($depth > 0 && !empty($item->highlight)) {
			$atts['style'] = !empty($item->color) ? 'color:' . $item->color . ';' : '';
		}
		
		
		$atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args);
		
		
		$attributes = '';
		
		
		foreach ($atts as $attr => $value) {
			if (!empty($value)) {
				$value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
				
				
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}
		
		
		$item_output = $args->before . 
			'<a' . $attributes . '>' . 
				(($depth == 0) ? '<span class="nav_bg_clr"' . (!empty($item->color) ? ' style="background-color:' . $item->color . ';"' : '') . '></span>' : '') . 
				$args->link_before . 
					apply_filters('the_title', $item->title, $item->ID) . 
				$args->link_after . 
			'</a>' . 
		$args->after;
		
		
		if ($this->cols_count != NULL && $depth == 1 && !empty($item->hide_text)) {
			$item_output = '';
		}
		
		
		if ($this->cols_count != NULL && $depth > 1 && !empty($item->mega_descr_text)) {
			if (!empty($item->description)) {
				$item_output = '<span class="menu-item-mega-description-container">' . str_replace("\n", "<br />", $item->post_content) . '</span>';
			} else {
				$item_output = '';
			}
		}
		
		
		$output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
		
		
		if ($depth == 0 && $this->cols_count != NULL) {
			$output .= "\n$indent<div class=\"menu-item-mega-container\">";
		}
	}
	
	
	function end_el(&$output, $item, $depth = 0, $args = array()) { 
		$indent = ($depth) ? str_repeat("\t", $depth) : '';
		
		
		if ($depth == 0 && $this->cols_count != NULL) {
			$output .= "$indent</div>\n";
		}
		
		
		$output .= "$indent</li>\n";
	}
}


new Cmsms_Mega_Menu();

