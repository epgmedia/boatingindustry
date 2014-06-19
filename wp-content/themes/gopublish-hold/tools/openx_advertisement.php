<?php
/*
Plugin Name: Godengo Ad Serving
Description: This plugin/widget allows you to place OpenX ad-serving widget in one of your columns.
Author: School Newspapers Online
Author URI: http://www.schoolnewspapersonline.com/
Version: 1.0
*/

add_action('widgets_init', create_function('', "register_widget('sno_openx');"));
class sno_openx extends WP_Widget {

	function sno_openx() {
		$widget_ops = array( 'classname' => 'Godengo Ad Serving', 'description' => 'Use this widget to add an OpenX zone in one of the columns on your site.' );
		$control_ops = array( 'width' => 200, 'height' => 250, 'id_base' => 'openx' );
		$this->WP_Widget( 'openx', 'Godengo Ad Serving', $widget_ops, $control_ops );
	}

	function widget($args, $instance) {
		extract($args);
		
		echo $before_widget.'<div class="rightad">';
				
				echo $before_title . $after_title;

			
			if(!empty($instance['openx_code'])) { ?>
			
			<?php echo $instance['openx_code']; ?>

			<?php }
				
		echo '</div>'.$after_widget;
	}

	function update($new_instance, $old_instance) {
		return $new_instance;
	}

	function form($instance) { ?>

		<?php global $registered_sidebar; $sidebarname = $registered_sidebar['name']; ?>
		<?php if (($sidebarname == "Home Sidebar")  || ($sidebarname == "Non-Home Sidebar") || ($sidebarname == "Sports Center Sidebar")) { $sidebarsize = "300px wide by 250px tall"; } ?>
		<?php if ($sidebarname == "Home Narrow Column") { $sidebarsize = "160px wide by 600px tall"; } ?>
		<?php if ($sidebarname == "Home Wide Column") { $sidebarsize = "custom 400px wide"; } ?>
		<?php if ($sidebarname == "Home Full Width Column") { $sidebarsize = "custom 590px wide"; } ?>
		<?php if (($sidebarname == "Home Bottom Left") || ($sidebarname == "Home Bottom Right")) { $sidebarsize = "custom 280px wide"; } ?>
		<?php if (empty($sidebarname)) { ?>
			<p>Please click the refresh button on your browser to see the options for this widget.</p>
		<?php } else { ?>
		<p>To use this rotating ad widget, you must be signed up for the <a href="http://www.schoolnewspapersonline.com/add-on-features/ad-serving/" target="_blank">Ad-Serving add-on</a>.</p><p>Use your OpenX Ad-Serving account to generate a <strong><?php echo $sidebarsize; ?> Zone</strong> and paste the Invocation Code here.</p><p>If you move this widget to a different column, you must change the Invocation Code to reflect the appropriate size settings.</p>

		<p>
		<label for="<?php echo $this->get_field_id('openx_code'); ?>"><?php _e('OpenX Invocation Code'); ?>:</label><br />

		<textarea id="<?php echo $this->get_field_id('openx_code'); ?>" name="<?php echo $this->get_field_name('openx_code'); ?>" style="width: 95%;" rows="6"><?php echo $instance['openx_code']; ?></textarea>
		</p>
		<?php } ?>	
	<?php 
	}
}
?>