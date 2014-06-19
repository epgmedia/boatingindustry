<?php

/**
 * Class epg_widget_styles
 *
 * @TODO Finish Style 4. Half complete
 */
class EPG_Widget_Styles {

	/**
	 * Contains all instance data
	 * Used by : parse_instance()
	 * @access protected
	 * @var array
	 */
	protected $instance = array();

	/**
	 * Default title of widget
	 * @access protected
	 * @var string
	 */
	protected $instance_title = '';

	/**
	 * Default Title if displaying category. Used in Widget Title
	 * @access protected
	 * @var string
	 */
	protected $category_name = '';

	/**
	 * Title if displaying video and category. Used in Widget Title
	 * @access protected
	 * @var string
	 */
	protected $video_title = '';

	/**
	 * Used to create link and slug for title. Used in Widget Title
	 * @access protected
	 * @var string
	 */
	protected $category_slug = '';

	/**
	 * Determines if custom or standard widget
	 * @access protected
	 * @var bool
	 */
	protected $custom_colors = FALSE;

	/**
	 * Style choice passed from widget.
	 * @access protected
	 * @var string
	 */
	protected $style = '';

	/**
	 * Inline styles for header
	 * @access protected
	 * @var string
	 */
	protected $header_style;

	/**
	 * Inline Styles for body
	 * @access protected
	 * @var string
	 */
	protected $body_style = '';

	/**
	 * Class for header.
	 * @access protected
	 * @var string
	 */
	protected $header_class = '';

	/**
	 * Class for Body container
	 * @access protected
	 * @var string
	 */
	protected $body_class = '';

	/**
	 * CSS color for the header background
	 * @access protected
	 * @var string
	 */
	protected $header_color = '';

	/**
	 * CSS Color for the header text
	 * @access protected
	 * @var string
	 */
	protected $header_text = '';

	/**
	 * Settings padding to 0 if true.
	 * @access protected
	 * @var bool
	 */
	protected $remove_padding = FALSE;

	/**
	 * Pixel border for the widget
	 * @access protected
	 * @var string
	 */
	protected $border_thickness = '';

	/**
	 * Color of pixel border for widget
	 * @access protected
	 * @var string
	 */
	protected $border_color = '';

	/**
	 * Widget container background color
	 * @access protected
	 * @var string
	 */
	protected $instance_background = '';

	/**
	 * Name of the widget area that the widget is displayed in.
	 * @access protected
	 * @var string
	 */
	protected $sidebar_name = '';

	/**
	 * Array of custom styles for the header.
	 * @access protected
	 * @var array
	 */
	protected $custom_header_style_array = array();

	/**
	 * Array of custom styles for the container
	 * @access protected
	 * @var array
	 */
	protected $custom_body_style_array = array();

	/**
	 * CSS styles for the header. Parsed by function after style has been set to generate the inline css for a custom
	 * color widget.
	 * @access protected
	 * @var array
	 */
	protected $header_css = array(
		'Style 1' => 'background-color, color, border-left, border-right, border-top',
		'Style 2' => 'background-color, color',
		'Style 3' => 'background-color, color',
		'Style 4' => 'border-left, border-right, border-top',
		'Style 5' => 'background-color, color, border-top',
		'Style 6' => 'border, background-color, color',
		'Style 7' => 'background-color, color, border-bottom',
	);

	/**
	 * CSS styles for the body of the widget. Parsed by function after the style has been set. Will generate inline CSS
	 * depending on the style of the wiget.
	 * @access protected
	 * @var array
	 */
	protected $container_css = array(
		'Style 1' => 'background-color, border-left, border-right, border-bottom',
		'Style 2' => 'background-color, border-left, border-right, border-bottom',
		'Style 3' => 'background-color, border-left, border-right',
		'Style 4' => 'border-left, border-right, border-bottom',
		'Style 5' => 'background-color, border-bottom',
		'Style 6' => 'background-color, border-left, border-right, border-bottom',
		'Style 7' => 'background-color, border',
	);

	/**
	 * Array used to generate classes and other variables used by the class to display the widget.
	 * @access protected
	 * @var array
	 */
	protected $styles_array = array(
		'Style 1' => '1',
		'Style 2' => '2',
		'Style 3' => '3',
		'Style 4' => '4',
		'Style 5' => '5',
		'Style 6' => '6',
		'Style 7' => '7',
	);

	/**
	 * Constructor.
	 * Generates the complete widget. Input instance with required variables. Variables required are in the
	 * parse_instance() function.
	 *
	 * @param array $instance Settings to generate widget style
	 * @access public
	 */
	public function __construct( $instance ) {
		$this->parse_instance( $instance );

		$this->header_class = 'widget' . $this->styles_array[$this->style];
		$this->body_class   = 'widgetbody' . $this->styles_array[$this->style];

		if ( $this->custom_colors === TRUE ) {
			$this->set_custom_colors();
		}
		$this->get_the_element();
	}

	/**
	 * Data Functions
	 * These functions handle preparing the data to be used by display functions.
	 */

	/**
	 * Parse Instance
	 * Runs through and parses the $instance variable. Will push the values from that variable into various
	 * class specific variables.
	 *
	 * Requires the $instance to be set in the Constructor.
	 *
	 * @param Array $instance
	 * @access protected
	 */
	protected function parse_instance( $instance ) {
		/**
		 * Set all of the instance variables
		 */
		$this->instance            = $instance;
		$this->style               = $this->instance['widget-style'];
		$this->instance_title      = $this->instance['title'];
		$this->header_color        = $this->instance['header-color'];
		$this->header_text         = $this->instance['header-text'];
		$this->remove_padding      = $this->instance['remove-padding'];
		$this->border_thickness    = $this->instance['border-thickness'];
		$this->border_color        = $this->instance['widget-border'];
		$this->instance_background = $this->instance['widget-background'];
		$this->sidebar_name        = $this->instance['sidebarname'];
		$this->custom_colors       = $this->instance['custom_colors'];
		$this->category_slug       = $this->instance['category_slug'];
		$this->category_name       = $this->instance['category_name'];
		$this->video_title         = $this->instance['video_title'];
	}

	/**
	 * Set Custom Colors
	 *
	 * Sets the custom widget colors if necessary.
	 * @access protected
	 */
	protected function set_custom_colors() {
		/**
		 * Header Array
		 */
		$this->custom_header_style_array = array(
			'background-color' => $this->header_color . '!important',
			'color'            => $this->header_text . '!important',
			'border'           => $this->border_thickness . ' solid ' . $this->border_color . '!important',
			'border-left'      => $this->border_thickness . ' solid ' . $this->border_color . '!important',
			'border-right'     => $this->border_thickness . ' solid ' . $this->border_color . '!important',
			'border-top'       => $this->border_thickness . ' solid ' . $this->border_color . '!important',
			'border-bottom'    => $this->border_thickness . ' solid ' . $this->border_color . '!important',
			'padding'          => '0 !important',
		);
		/**
		 * Container Array
		 */
		$this->custom_body_style_array = array(
			'background-color' => $this->instance_background . '!important',
			'border'           => $this->border_thickness . ' solid ' . $this->border_color . '!important',
			'border-left'      => $this->border_thickness . ' solid ' . $this->border_color . '!important',
			'border-right'     => $this->border_thickness . ' solid ' . $this->border_color . '!important',
			'border-top'       => $this->border_thickness . ' solid ' . $this->border_color . '!important',
			'border-bottom'    => $this->border_thickness . ' solid ' . $this->border_color . '!important',
			'padding'          => '0 !important',
		);
		/**
		 * Set the css class
		 */
		$this->header_style = $this->build_css(
			$this->style,
			$this->header_css,
			$this->custom_header_style_array
		);
		$this->body_style   = $this->build_css(
			$this->style,
			$this->container_css,
			$this->custom_body_style_array,
			FALSE,
			$this->remove_padding
		);
	}

	/**
	 * Get the element
	 * Displays the header and container open.
	 *
	 * @access protected
	 */
	protected function get_the_element() {
		$header    = $this->get_header();
		$container = $this->before_container( $this->body_class, $this->body_style );
		/*
		 * Clean up and echo.
		 */
		echo wp_kses_post( $header );
		echo wp_kses_post( $container );
	}

	/**
	 * Gets the Header
	 * Gathers together the pieces of the header and returns them as a string.
	 *
	 * @access protected
	 *
	 * @return string
	 */
	protected function get_header() {
		$string  = $this->before_header( $this->header_class, $this->header_style );
		$string .= $this->epg_widget_title();
		$string .= $this->after_header();

		return $string;
	}

	/**
	 * Before Header Hook
	 * Returns the data to be printed before the header text is displayed. Do not output directly. Pass to string
	 * so it can feed through functions.
	 *
	 * @param null   $tag_class
	 * @param null   $inline_style
	 * @param string $tag
	 *
	 * @access protected
	 *
	 * @return string
	 */
	protected function before_header( $tag_class = NULL, $inline_style = NULL, $tag = '<h4>' ) {
		$header = substr( $tag, 0, -1 );
		if ( isset( $tag_class ) ) {
			$header .= ' class="' . $tag_class. '"';
		}
		if ( isset( $inline_style ) ) {
			$header .= ' style="' . $this->header_style . '" ';
		}
		$header .= '>';

		return $header;
	}

	/**
	 * Generates the Title
	 * Looks through slug, text, and custom colors to generate the header text.
	 *
	 * @access protected
	 *
	 * @return string
	 */
	protected function epg_widget_title() {
		if ( $this->category_slug !== NULL ) {
			$title   = '<a style="color:' . $this->header_text . ';" href="' . $this->category_slug . '">';
			$title_text = $this->category_name;
			if ( isset($this->video_title) ) {
				$title_text = $this->video_title;
			}
			$title .= $title_text;
			$title .= '</a>';
		} else {
			$title = $this->instance_title;
		}

		return $title;
	}

	/**
	 * After Header Hook
	 * Outputs data after Header Text. Can be a tag or other data. Set to string to be passed through function. Do
	 * not output or echo directly or it could cause issues.
	 *
	 * @param string $tag Tag to close header.
	 *
	 * @access protected
	 *
	 * @return string
	 */
	protected function after_header( $tag = '</h4>' ) {

		return $tag;
	}

	/**
	 * Before Container Hook
	 * Returns the data to be printed before the container is displayed. Do not output directly. Pass to string
	 * so it can feed through functions.
	 *
	 * @param null   $tag_class
	 * @param null   $inline_style
	 * @param string $tag
	 *
	 * @access protected
	 *
	 * @return string
	 */
	protected function before_container( $tag_class = NULL, $inline_style = NULL, $tag = '<div>' ) {
		$container = substr( $tag, 0, -1 );
		if ( isset( $tag_class ) ) {
			$container .= ' class="' . $tag_class . '"';
		}
		if ( isset( $inline_style ) ) {
			$container .= ' style="' . $inline_style . '" ';
		}
		$container .= '">';

		return $container;
	}

	/**
	 * Generates Inline CSS
	 *
	 * @param string $style
	 * @param array  $css_styles
	 * @param array  $css_array
	 * @param bool   $print
	 * @param bool   $padding
	 *
	 * @access protected
	 *
	 * @return string
	 */
	protected function build_css( $style, $css_styles, $css_array, $print = FALSE, $padding = FALSE ){
		$css = $css_styles[$style];
		if ( $padding === TRUE ) {
			$css .= ', padding';
		}
		$css_tags   = explode( ', ', $css );
		$css_string = '';
		foreach ( $css_tags as $css_tag ) {
			$css_string .= $css_tag . ': ' . $css_array[$css_tag] . ';';
		}
		if ( $print === TRUE ) {
			$css_string = 'style="' . $css_string . '"';
		}

		return $css_string;
	}

}