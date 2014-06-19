<?php
/*
Plugin Name: GoPublish eNews and Updates
Description: This plugin/widget allows you to place an eNews and Updates widget in your sidebar.
Author: School Newspapers Online
Author URI: http://www.schoolnewspapersonline.com/
Version: 1.1
*/

add_action( 'widgets_init', create_function( '', "register_widget('eNews_Updates');" ) );

class eNews_Updates extends WP_Widget {

	function eNews_Updates() {
		$widget_ops  = array(
			'classname' => 'enews-widget',
			'description' => 'Displays eNews &amp; Updates signup form'
		);
		$control_ops = array(
			'width' => 500,
			'height' => 250,
			'id_base' => 'enews'
		);
		$this->WP_Widget( 'enews', 'GoPublish eNews and Updates', $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );

		$instance['sidebarname'] = $args['name'];
		$sidebarname = $args['name'];

		$side_bar_photo = array(
			'Non-Home Sidebar'   => get_option( 'non_home_right_column' ),
			'Home Main Column'   => get_option( 'home_right_column' ),
			'Home Bottom Left'   => get_option( 'home_left_column' ),
			'Home Bottom Narrow' => get_option( 'home_narrow_column' ),
			'Home Bottom Right'  => get_option( 'home_center_column' ),
			'Home Bottom Wide'   => get_option( 'home_wide_column' ),
			'Home Sidebar'       => get_option( 'home_right_column' ),
			'Ads Sidebar'        => get_option( 'home_narrow_column' ),
		);

		if ( array_key_exists( $sidebarname, $side_bar_photo ) ) {
			$instance['photowidth'] = $side_bar_photo[$sidebarname];
		}

		?>
		<div class="widgetwrap">
			<?php $customcolors = $instance['custom-colors'];

			include( TEMPLATEPATH . "/widgetstyles.php" );

			echo wpautop( $instance['text'] );

			$feedburner = get_theme_mod( 'feedburner-code' );

			if ( ! empty( $feedburner ) ) { ?>
			<form id="subscribe" action="http://feedburner.google.com/fb/a/mailverify" method="post"
				  target="popupwindow"
				  onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?uri=<?php echo $feedburner; ?>', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">
				<input type="text" value="Enter your email address..." id="subbox"
					   onfocus="if (this.value == 'Enter your email address...') {this.value = '';}"
					   onblur="if (this.value == '') {this.value = 'Enter your email address...';}" name="email" />
				<input type="hidden" value="<?php echo $feedburner; ?>" name="uri" />
				<input type="hidden" name="loc" value="en_US" />
				<input type="submit" value="GO" id="subbutton" />
			</form>
			<?php } ?>

			</div>

			<div
				<?php if ($customcolors == TRUE) { ?>style="background-color:<?php echo $instance['header-color']; ?> !important;"
				<?php } ?>class="widgetfooter<?php if ( $instance['widget-style'] == "Style 3" ) { ?>3<?php } else { ?>1<?php } ?>">
			</div>

		</div>
	<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance                      = $old_instance;
		$instance['title']             = $new_instance['title'];
		$instance['text']              = $new_instance['text'];
		$instance['widget-style']      = $new_instance['widget-style'];
		$instance['custom-colors']     = ( isset( $new_instance['custom-colors'] ) ? TRUE : FALSE );
		$instance['header-color']      = $new_instance['header-color'];
		$instance['header-text']       = $new_instance['header-text'];
		$instance['widget-border']     = $new_instance['widget-border'];
		$instance['widget-background'] = $new_instance['widget-background'];
		$instance['border-thickness']  = $new_instance['border-thickness'];
		$instance['sidebarname']       = $new_instance['sidebarname'];

		return $instance;
	}

	function form( $instance ) {
		global $registered_sidebar;
		//global $wp_registered_sidebars;

		$defaults = array(
			'title' => 'Email Updates',
			'text' => 'Enter your email address below to receive our daily email updates',
			'widget-style' => get_theme_mod( 'widget-style' ),
			'header-color' => get_theme_mod( 'accentcolor-header' ),
			'header-text' => '#ffffff',
			'widget-border' => '#aaaaaa',
			'widget-background' => '#eeeeee',
			'border-thickness' => '1px',
			'custom-colors' => FALSE,
			'sidebarname' => '',
		);

		if ( isset( $registered_sidebar['name'] ) ) {
			$instance['sidebarname'] = $registered_sidebar['name'];
		}

		$instance = wp_parse_args( $instance, $defaults );


		?>

		<div class="epg-widget-options-left">

			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( "Title" ); ?>:</label><br />
				<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>"
					   name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>"
					   style="width:95%;" />
			</p>

			<p>
				<label for="<?php echo $this->get_field_id( 'text' ); ?>"><?php _e( 'Text To Show' ); ?>:</label><br />
				<textarea id="<?php echo $this->get_field_id( 'text' ); ?>"
						  name="<?php echo $this->get_field_name( 'text' ); ?>" style="width: 95%;"
						  rows="6"><?php echo $instance['text']; ?></textarea>
			</p>

			<input type="hidden" id="<?php echo $this->get_field_id( 'sidebarname' ); ?>"
				   name="<?php echo $this->get_field_name( 'sidebarname' ); ?>"
				   value="<?php echo $instance['sidebarname']; ?>" />

		</div>
		<div class="epg-widget-options">
			<p style="font-weight:bold;text-decoration:underline;">Widget Appearance</p>

			<p>
				<select id="<?php echo $this->get_field_id( 'widget-style' ); ?>"
						name="<?php echo $this->get_field_name( 'widget-style' ); ?>">
					<option
						value="Style 1" <?php if ( 'Style 1' == $instance['widget-style'] ) {
						echo 'selected="selected"';
					} ?>>
						Style 1
					</option>
					<option
						value="Style 2" <?php if ( 'Style 2' == $instance['widget-style'] ) {
						echo 'selected="selected"';
					} ?>>
						Style 2
					</option>
					<option
						value="Style 3" <?php if ( 'Style 3' == $instance['widget-style'] ) {
						echo 'selected="selected"';
					} ?>>
						Style 3
					</option>
					<option
						value="Style 4" <?php if ( 'Style 4' == $instance['widget-style'] ) {
						echo 'selected="selected"';
					} ?>>
						Style 4
					</option>
					<option
						value="Style 5" <?php if ( 'Style 5' == $instance['widget-style'] ) {
						echo 'selected="selected"';
					} ?>>
						Style 5
					</option>
					<option
						value="Style 6" <?php if ( 'Style 6' == $instance['widget-style'] ) {
						echo 'selected="selected"';
					} ?>>
						Style 6
					</option>
					<option
						value="Style 7" <?php if ( 'Style 7' == $instance['widget-style'] ) {
						echo 'selected="selected"';
					} ?>>
						Style 7
					</option>
				</select>
				<label for="<?php echo $this->get_field_id( 'widget-style' ); ?>">Widget Style</label>
			</p>

			<p>
				<input class="checkbox" type="checkbox" <?php if ( $instance['custom-colors'] === TRUE ) {
					echo 'checked';
				} ?>
					   id="<?php echo $this->get_field_id( 'custom-colors' ); ?>"
					   name="<?php echo $this->get_field_name( 'custom-colors' ); ?>" />
				<label for="<?php echo $this->get_field_id( 'custom-colors' ); ?>">Turn on Custom Widget Colors</label>
			</p>

			<p>Save this widget to make the color selector active.</p>
			<?php $number = $this->number; ?>

			<p>
				<input class="colorwellenews<?php echo $number; ?>"
					   id="<?php echo $this->get_field_id( 'header-color' ); ?>"
					   name="<?php echo $this->get_field_name( 'header-color' ); ?>" type="text" maxlength="7" size="7"
					   value="<?php echo $instance['header-color']; ?>" /> Header Bar <br />
				<input class="colorwellenews<?php echo $number; ?>"
					   id="<?php echo $this->get_field_id( 'header-text' ); ?>"
					   name="<?php echo $this->get_field_name( 'header-text' ); ?>" type="text" maxlength="7" size="7"
					   value="<?php echo $instance['header-text']; ?>" /> Header Bar Text<br />
				<input class="colorwellenews<?php echo $number; ?>"
					   id="<?php echo $this->get_field_id( 'widget-border' ); ?>"
					   name="<?php echo $this->get_field_name( 'widget-border' ); ?>" type="text" maxlength="7" size="7"
					   value="<?php echo $instance['widget-border']; ?>" /> Border<br />
				<input class="colorwellenews<?php echo $number; ?>"
					   id="<?php echo $this->get_field_id( 'widget-background' ); ?>"
					   name="<?php echo $this->get_field_name( 'widget-background' ); ?>" type="text" maxlength="7"
					   size="7" value="<?php echo $instance['widget-background']; ?>" /> Background
			</p>
			<script type="text/javascript">
				/*
				jQuery(document).ready(function ($) {

					var f = $.farbtastic('#snocolorpickerenews<?php echo $number; ?>');
					var p = $('#snocolorpickerenews<?php echo $number; ?>').css('opacity', 0.25);
					var selected;
					$('.colorwellenews<?php echo $number; ?>')
						.each(function () {
							f.linkTo(this);
							$(this).css('opacity', 0.75);
						})
						.focus(function () {
							if (selected) {
								$(selected).css('opacity', 0.75).removeClass('colorwell-selected');
							}
							f.linkTo(this);
							p.css('opacity', 1);
							$(selected = this).css('opacity', 1).addClass('colorwell-selected');
						});
					var e = $('#snocolorpickerenews<?php echo $number; ?>');
					e.hide();
					e.farbtastic(".colorwellenews<?php echo $number; ?>");

					$(".colorwellenews<?php echo $number; ?>").click(function () {
						e.slideDown()
					});

				});
				*/
			</script>
			<div id="snocolorpickerenews<?php echo $number; ?>"></div>
			<p>
				<select id="<?php echo $this->get_field_id( 'border-thickness' ); ?>"
						name="<?php echo $this->get_field_name( 'border-thickness' ); ?>">
					<option
						value="0" <?php if ( '0' == $instance['border-thickness'] ) {
						echo 'selected="selected"';
					} ?>>0
					</option>
					<option
						value="1px" <?php if ( '1px' == $instance['border-thickness'] ) {
						echo 'selected="selected"';
					} ?>>1px
					</option>
					<option
						value="2px" <?php if ( '2px' == $instance['border-thickness'] ) {
						echo 'selected="selected"';
					} ?>>2px
					</option>
					<option
						value="3px" <?php if ( '3px' == $instance['border-thickness'] ) {
						echo 'selected="selected"';
					} ?>>3px
					</option>
					<option
						value="4px" <?php if ( '4px' == $instance['border-thickness'] ) {
						echo 'selected="selected"';
					} ?>>4px
					</option>
					<option
						value="5px" <?php if ( '5px' == $instance['border-thickness'] ) {
						echo 'selected="selected"';
					} ?>>5px
					</option>
					<option
						value="6px" <?php if ( '6px' == $instance['border-thickness'] ) {
						echo 'selected="selected"';
					} ?>>6px
					</option>
					<option
						value="7px" <?php if ( '7px' == $instance['border-thickness'] ) {
						echo 'selected="selected"';
					} ?>>7px
					</option>
					<option
						value="8px" <?php if ( '8px' == $instance['border-thickness'] ) {
						echo 'selected="selected"';
					} ?>>8px
					</option>
					<option
						value="9px" <?php if ( '9px' == $instance['border-thickness'] ) {
						echo 'selected="selected"';
					} ?>>9px
					</option>
					<option
						value="10px" <?php if ( '10px' == $instance['border-thickness'] ) {
						echo 'selected="selected"';
					} ?>>
						10px
					</option>
				</select>
				<label for="<?php echo $this->get_field_id( 'border-thickness' ); ?>"> Border Thickness</label>

		</div>
		<div style="clear:both"></div>


	<?php
	}
}

?>