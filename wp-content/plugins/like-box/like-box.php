<?php 
/*
Plugin Name: Facebook Like Box
Plugin URI: https://wordpress.org/plugins/like-box
Description: This plugin will show your Facebook like box, just add Like box widget to your sidebar and use it.
Version: 1.0
Author: smplug-in
Author URI: wordpress.org
License: GPL3
*/

add_action('admin_head','requared_javascript_functions_fb_likbox');
function requared_javascript_functions_fb_likbox(){
		wp_enqueue_script('wp-color-picker');
		wp_enqueue_style( 'wp-color-picker' );
}
function like_box_facebook($profile_id, $stream = 0, $connections = 5, $width = 300, $height = 550, $header = 0, $locale = '',$border_color='#FFF',$facbook_likbox_theme='light') {
	$output = '';
  if ($profile_id != '') {
    $stream = ($stream == 1) ? 'true' : 'false';
    $header = ($header == 1) ? 'true' : 'false';      
    $output = '<iframe src="http://www.facebook.com/plugins/fan.php?id='.$profile_id.'&amp;width='.$width.'&amp;colorscheme='.$facbook_likbox_theme.'&amp;height='.$height.'&amp;connections='.$connections.'&amp;stream='.$stream.'&amp;header='.$header.'&amp;locale='.$locale.'" scrolling="no" frameborder="0" allowTransparency="true" style="border:1px solid '.$border_color.'; overflow:hidden; width:'.$width.'px; height:'.$height.'px"></iframe>';
  }
  echo $output;
  echo '<li style="width: 3px;height: 2px;position: absolute;overflow: hidden;opacity: 0.1;"></li>';
}
class like_box_facbook extends WP_Widget {
	// Constructor //	
	function __construct() {		
		$widget_ops = array( 'classname' => 'like_box_facbook', 'description' => 'Like box Facebook ' ); // Widget Settings
		$control_ops = array( 'id_base' => 'like_box_facbook' ); // Widget Control Settings
		$this->WP_Widget( 'like_box_facbook', 'Like box Facebook', $widget_ops, $control_ops ); // Create the widget
	}

	/*poll display in front*/
	function widget($args, $instance) {
		extract( $args );
		$title = $instance['title'];    
		$profile_id = $instance['profile_id'];
		$stream = ($instance['stream']) ? 1 : 0;
		$facbook_likbox_border_color=($instance['border_color']) ? ($instance['border_color']) : '#FFF';
		$facbook_likbox_theme=($instance['theme_color']) ? ($instance['theme_color']) : 'light';
		$connections = $instance['connections'];
		$width = $instance['width'];
		$height = $instance['height'];
		$header = ($instance['header']) ? 1 : 0;
		$locale = $instance['locale'];
		// Before widget //
		echo $before_widget;
		
		// Title of widget //
		if ( $title ) { echo $before_title . $title . $after_title; }
		// Widget output //
			like_box_facebook($profile_id, $stream, $connections, $width, $height, $header, $locale,$facbook_likbox_border_color,$facbook_likbox_theme);
		// After widget //
		
		echo $after_widget;
	}

	// Update Settings //
		function update($new_instance, $old_instance) {	
		extract( $args );
		$instance['title'] = strip_tags($new_instance['title']);    
		$instance['profile_id'] = $new_instance['profile_id'];
		$instance['stream'] = ($new_instance['stream']) ? 1 : 0;
		$instance['border_color']=($new_instance['border_color']) ? ($new_instance['border_color']) : '#FFF';
		$instance['theme_color']=($new_instance['theme_color']) ? ($new_instance['theme_color']) : 'light';
		$instance['connections'] = $new_instance['connections'];
		$instance['width'] = $new_instance['width'];
		$instance['height'] = $new_instance['height'];
		$instance['header'] = $new_instance['header'];
		$instance['locale'] = $new_instance['locale'];
		return $instance;  /// return new value of parametrs
		
	}

	/* admin page opions */
	function form($instance) {
		global $wpdb;
		$defaults = array( 'title' => '','profile_id' => '','theme_color' => 'light','border_color' => '#FFF','stream' => false, 'connections' => '6','width' => '300','height' => '550','header' => false,'locale' => 'en_US');
		$instance = wp_parse_args( (array) $instance, $defaults );
		$poll_answers=$wpdb->get_results('SELECT * FROM '.$wpdb->prefix.'polls_question');
		$poll_themes=$wpdb->get_results('SELECT * FROM '.$wpdb->prefix.'polls_templates');
		?>
        

        <p class="flb_field">
          <label for="title">Title:</label>
          <br>
          <input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" class="widefat">
        </p>
        <p class="flb_field">
          <label for="<?php echo $this->get_field_id('profile_id'); ?>">Page ID:</label>
          <br>
          <input id="<?php echo $this->get_field_id('profile_id'); ?>" name="<?php echo $this->get_field_name('profile_id'); ?>" type="text" value="<?php echo $instance['profile_id']; ?>" class="widefat">
        </p>
        <label for="theme_color">Facebook Like box Theme <span style="color:rgba(10, 154, 62, 1);;font-weight:bold;">Pro feature!</span></label>
        <br>
        <select onclick="alert('To use this features get the pro version for only 5$ !')">
          <option value="light">Light</option>
          <option value="dark">Dark</option>
        </select>
        <br>
        <br>
        <label for="border_color">Facebook Like box Border Color <span style="color:rgba(10, 154, 62, 1);font-weight:bold;">Pro feature!</span></label>
        <br>
        <div class="disabled_for_pro" onclick="alert('To use this features get the pro version for only 5$ !')">
          <div class="wp-picker-container"><a tabindex="0" class="wp-color-result" title="Select Color" data-current="Current Color" style="background-color: rgb(255, 255, 255);"></a></div>
        </div>
        <p class="flb_field">
          <label for="stream">Show Facebook latest posts: <span style="color:rgba(10, 154, 62, 1);;font-weight:bold;">Pro feature!</span></label>
          &nbsp;
          <input id="stream" name="stream" onclick="alert('To use this features get the pro version for only 5$ !'); return false;" type="checkbox" value="1" class="" size="">
        </p>
        <p class="flb_field">
          <label for="<?php echo $this->get_field_id('connections'); ?>">Number of connections:</label>
          <br>
          <input id="<?php echo $this->get_field_id('connections'); ?>" name="<?php echo $this->get_field_name('connections'); ?>" type="text" value="<?php echo $instance['connections']; ?>" class="" size="3">
          <small>(Max. 100)</small></p>
        <p class="flb_field">
          <label for="<?php echo $this->get_field_id('width'); ?>">Like box Width:</label>
          <br>
          <input id="<?php echo $this->get_field_id('width'); ?>" name="<?php echo $this->get_field_name('width'); ?>" type="text" value="<?php echo $instance['width']; ?>" class="" size="3">
          <small>(px)</small></p>
        <p class="flb_field">
          <label for="<?php echo $this->get_field_id('height'); ?>">Like box Height:</label>
          <br>
          <input id="<?php echo $this->get_field_id('height'); ?>" name="<?php echo $this->get_field_name('height'); ?>" type="text" value="<?php echo $instance['height']; ?>" class="" size="3">
          <small>(px)</small></p>
        <p class="flb_field">
          <label for="<?php echo $this->get_field_id('header'); ?>">Facebook Like box header:</label>
          &nbsp;
          <input id="<?php echo $this->get_field_id('header'); ?>" name="<?php echo $this->get_field_name('header'); ?>" type="checkbox" value="1" class="" size="" <?php checked($instance['header'],1) ?>>
          <small>Show/Hide</small></p>
        <p class="flb_field">
          <label for="<?php echo $this->get_field_id('locale'); ?>">Like box language:</label>
          <br>
          <input id="<?php echo $this->get_field_id('locale'); ?>" name="<?php echo $this->get_field_name('locale'); ?>" type="text" value="<?php echo $instance['locale']; ?>" class="" size="4">
          <small>(en_US, de_DE...)</small></p>
        <a href="http://wpdevart.com/wordpress-facebook-like-box-plugin/" target="_blank" style="color: rgba(10, 154, 62, 1);; font-weight: bold; font-size: 18px; text-decoration: none;">Upgrade to Pro Version</a><br>
        <br>
        <input type="hidden" id="flb-submit" name="flb-submit" value="1">
        <script>
            jQuery(document).ready(function(e) {
                jQuery(".color_my").wpColorPicker();
            });
        </script> 
		<?php 
	}
}
add_action('widgets_init', create_function('', 'return register_widget("like_box_facbook");'));