<?php
/**
 * Custom Theme Styles
 */

/**
 * Admin
 *
 */
function epg_admin_enqueue_styles() {
	wp_enqueue_style( 'admin_css', SNOTHEMEURI . '/inc/css/admin-style.css' );
	wp_enqueue_style( 'farb_css', SNOTHEMEURI . '/tools/farbtastic/farbtastic.css' );
	wp_enqueue_script( 'farbtastic', SNOTHEMEURI . '/tools/farbtastic/farbtastic.js', array('jquery'), '', FALSE );
}
add_action('admin_enqueue_scripts', 'epg_admin_enqueue_styles');

function sno_admin_scripts() {
	wp_enqueue_script( 'media-upload' );
	wp_enqueue_script( 'thickbox' );
	wp_register_script( 'sno-upload', get_bloginfo( 'template_url' ) . '/tools/sno-script.js', array( 'jquery', 'media-upload', 'thickbox' ) );
	wp_enqueue_script( 'sno-upload' );
	wp_enqueue_script( 'jquery.js' );
}

function sno_admin_styles() {
	wp_enqueue_style( 'thickbox' );
}

if ( isset( $_GET['page'] ) && $_GET['page'] == 'theme-options' ) {
	add_action( 'admin_print_scripts', 'sno_admin_scripts' );
	add_action( 'admin_print_styles', 'sno_admin_styles' );
}



add_action('login_head', 'add_favicon');
add_action('admin_head', 'add_favicon');
function add_favicon() {
	$favicon = get_theme_mod( 'favicon' );
	echo '<link rel="shortcut icon" href="' . $favicon . '" />';
}

/**
 * Front-End
 */
add_action(
	'wp_enqueue_scripts', function () {

		/**
		 * Styles
		 */
		$fileName = auto_version_css( '/style.css' );
		wp_register_style( 'SNO-Styles', SNOTHEMEURI . $fileName );
		wp_enqueue_style( 'SNO-Styles' );

		$custom_styles = custom_css_from_php( SNOTHEMEPATH . '/customstyles.php', SNOTHEMEURI );
		wp_register_style( 'custom-styles', $custom_styles );
		wp_enqueue_style( 'custom-styles' );

		$mobile_styles = custom_css_from_php( SNOINCPATH . '/css/mobile.php', SNOTHEMEURI . '/inc/css' );
		wp_register_style( 'mobile-styles', $mobile_styles );
		wp_enqueue_style( 'mobile-styles' );

		wp_enqueue_style( 'farbtastic' );

		wp_enqueue_style( 'thickbox' );

		wp_register_style( 'Slick-Styles', SNOTHEMEURI . '/inc/slick/slick.css' );
		wp_enqueue_style( 'Slick-Styles' );

		/**
		 * Scripts
		 */
		wp_enqueue_script( 'jquery' );
		/*wp_enqueue_script(
			'jquery-cycle',
			SNOTHEMEURI . '/inc/js/jquery.cycle.all.min.js',
			array( 'jquery' ),
			'',
			FALSE
		);*/
		wp_enqueue_script(
			'slick',
			SNOTHEMEURI . '/inc/slick/slick.min.js',
			array( 'jquery' ),
			'',
			TRUE
		);
		wp_enqueue_script(
			'homepage-slider',
			SNOTHEMEURI . '/inc/js/featured-slider.js',
			array( 'jquery', 'slick' ),
			'',
			TRUE
		);
		wp_enqueue_script(
			'jcarousel',
			SNOTHEMEURI . '/inc/js/jcarousellite_1.0.1c4.js',
			array( 'jquery' ),
			'',
			FALSE
		);
		wp_enqueue_script(
			'toggle-menu',
			SNOTHEMEURI . '/inc/js/togglemenu.js',
			array( 'jquery' ),
			'',
			FALSE
		);
		wp_enqueue_script(
			'google-ads',
			SNOTHEMEURI . '/inc/js/google-ads.js',
			array( 'jquery' ),
			'',
			FALSE
		);

		$page_tag_array = array(
			'placementTag' => 'BIM_ROS',
			'divTag'       => 'div-gpt-ad-1398366141837'
		);

		$sww_uri = strtolower($_SERVER["REQUEST_URI"]);
		if ( strpos( $sww_uri,'/top-100/' ) !== false )  {

			$page_tag_array['placementTag'] = "BIM_T100";
			$page_tag_array['divTag'] = "div-gpt-ad-1398366494877";

		}
		if (
			strpos( $sww_uri,'/mdce/' ) !== false ||
			strpos( $sww_uri,'/category/marine-dealer-conference/' ) !== false
		) {

			$page_tag_array['placementTag'] = 'BIM_MDCE';
			$page_tag_array['divTag'] = "div-gpt-ad-1398366605405";

		}
		wp_localize_script( 'google-ads', 'pageTag', $page_tag_array );

		wp_enqueue_script(
			'farbtastic',
			SNOTHEMEURI . '/tools/farbtastic/farbtastic.js',
			array('jquery'),
			'',
			FALSE
		);
		wp_enqueue_script( 'thickbox' );

		wp_enqueue_script(
			'local-script',
			SNOTHEMEURI . '/inc/js/my-script.js',
			array( 'jquery',/* 'jquery-cycle',*/ 'jcarousel' ),
			'',
			TRUE
		);
		$system_js_array = array(
			'scroll_style'         => get_theme_mod('sports-scroll-style'),
			'is_scroll_visible'    => get_theme_mod('sports-scrollbox-visible'),
			'scroll_speed'         => get_theme_mod('sports-speed'),
			'scroll_transition'    => get_theme_mod('sports-transition'),
			'scroll_number'        => get_theme_mod('sports-scrollbox-number'),
			'bscroll_style'        => get_theme_mod('breaking-scroll-style'),
			'bis_scroll_visible'   => get_theme_mod('breaking-visible'),
			'bscroll_speed'        => get_theme_mod('breakingnews-speed'),
			'bscroll_transition'   => get_theme_mod('breakingnews-transition'),
			'bscroll_number'       => get_theme_mod('breaking-scroll-number'),
			'slideshow_transition' => get_theme_mod('top-stories-transition'),
			'slideshow_speed'      => get_theme_mod('top-stories-trans-speed'),
			'slideshow_automate'   => get_theme_mod('top-stories-automate'),
			'slideshow_timeout'    => get_theme_mod('top-stories-speed')
		);
		wp_localize_script( 'local-script', 'snoData', $system_js_array );

	}
);

/**
 * CSS Auto Versioning
 *
 * Given a file, i.e. /css/base.css, replaces it with a string containing the
 * file's mtime, i.e. /css/base.1221534296.css.
 *
 * @param string  $file The file to be loaded.  Must be an absolute path (i.e.
 *                      starting with slash).
 *
 * @return string $newFileName Returns new stylesheet directory if completed,
 *      otherwise will return the current stylesheet or root stylesheet, depending
 *      on conditions.
 */
function auto_version_css( $file ) {
	// turns function on and off.
	if ( ! VERSIONCSS ) {
		return $file;
	}
	clearstatcache();
	$update_option     = $file . '_stylesheet_modified_time';
	$lastModifiedTime  = get_option( $update_option, "Time Not Set" );
	$currentStylesheet = get_option( $file, 'Stylesheet Not Set' );

	$modifiedTime = filemtime( SNOTHEMEPATH . $file );
	/*
	 * Checks what the last modified time was
	 * Checks:
	 * 1. Equal modified time           AND
	 * 2. Stylesheet option is set      AND
	 * 3. A time has been set to query  AND
	 * 4. The new stylesheet exists
	 *
	 * If it's all true, returns the modified file.
	 */
	if ( $lastModifiedTime == $modifiedTime
		&& $currentStylesheet !== "Stylesheet Not Set"
		&& $lastModifiedTime !== "Time Not Set"
		&& file_exists( SNOTHEMEPATH . $currentStylesheet )
	) {
		return $currentStylesheet;
	}
	$stylesheet = $file;
	/*
	 * Running the function
	 * If all of those aren't met, it's time to create a new stylesheet
	 *
	 * First we write the new file name
	 * Create a var to hold base directory info
	 *
	 * Then, we check if everything is writable. If it is, we continue.
	 * Otherwise, we return the un-cached file.
	 *
	 */
	// style.css
	$newStylesheetName = substr( strrchr( $stylesheet, "/" ), 1 );
	// style.timestamp.css
	$newFileName = substr( $newStylesheetName, 0, - 4 ) . '.' . $modifiedTime . '.css';
	// "/css/" from "/css/style.css"
	$newStyleSheetDirectory = substr( $stylesheet, 0, ( strlen( $stylesheet ) - strlen( $newStylesheetName ) ) );
	/*
	 * Add new file location.
	 * Full directory location of new file.
	 * /dir/user/www/etc/etc/wp-content/etc/etc/style.css
	 */
	$newStyleSheet = SNOTHEMEPATH . $newStyleSheetDirectory . $newFileName;
	/*
	 * Add file to folder
	 * If it's not writable or files, it'll return the base stylesheet.
	 * If we can't write, then chances are it wasn't written before.
	 */
	if ( is_writable( SNOTHEMEPATH . $newStyleSheetDirectory ) ) {
		// check if the file was created
		if ( ! $handle = fopen( $newStyleSheet, 'w' ) ) {
			return $file;
		}
		$oldStylesheet = file_get_contents( SNOTHEMEPATH . $stylesheet ); // data
		// Write data to new stylesheet.
		if ( fwrite( $handle, $oldStylesheet ) === false ) {
			return $file;
		}
		// Success, wrote data to file new stylesheet;
		fclose( $handle );
	} else {
		return $file;
	}
	/*
	 * Update Database
	 * Everything worked and now it's time to update the database and return the new file
	 * and then delete the old file.
	 */

	$newFileName = $newStyleSheetDirectory . $newFileName;
	update_option( $update_option, $modifiedTime );
	update_option( $file, $newFileName );
	// And delete the old stylesheet
	if ( $currentStylesheet !== "Stylesheet Not Set" ) {
		unlink( SNOTHEMEPATH . $currentStylesheet );
	}
	if ( ! file_exists( SNOTHEMEPATH . $newFileName ) ) {
		return $stylesheet;
	}

	return $newFileName;
}

/**
 * Convert PHP file to CSS.
 *
 * Takes PHP file and writes a CSS file, returning the CSS string.
 *
 * @param        $php_file      string Full path to php file
 * @param string $url_to_folder string Full URL to folder, minus trailing slash.
 *
 * @return bool|string
 */
function custom_css_from_php( $php_file, $url_to_folder = '' ) {
	$css_file = substr( $php_file, 0, -4) . ".css";

	/** Parse the file */
	// Run through to set values
	ob_start(); // start output buffer
	include( $php_file );
	$parsed_css = ob_get_contents(); // get contents of buffer
	ob_end_clean();

	/** Check for changes */
	if ( file_exists( $css_file ) && md5( $parsed_css ) == md5_file( $css_file ) ) {
		$css_file_parts = explode( '/', $css_file );

		return $url_to_folder . '/' . end( $css_file_parts );
	}

	/** Found changes, create a new file */

	// Create new CSS file
	if ( is_writable( dirname( $php_file ) ) ) {
		// check if the file was created
		if ( ! $handle = fopen( $css_file, 'w' ) ) {
			return FALSE;
		}
		// Write data to new stylesheet.
		if ( fwrite( $handle, $parsed_css ) === false ) {
			return FALSE;
		}
		// Success, wrote data to file new stylesheet;
		fclose( $handle );
	} else {
		$css_file_parts = explode( '/', $css_file );

		return $url_to_folder . '/' . end( $css_file_parts );
	}

	/** Return location of CSS file */
	$css_file_parts = explode( '/', $css_file );

	return $url_to_folder . '/' . end( $css_file_parts );

}

