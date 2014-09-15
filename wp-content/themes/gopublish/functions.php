<?php



/**
 * Constants
 *
 */

/** Directory Constants */

// Theme Directory
define( 'SNOTHEMEPATH', get_template_directory() );

// Theme URL
define( 'SNOTHEMEURI',  get_template_directory_uri() );

// Path to includes Directory
define( 'SNOINCPATH', SNOTHEMEPATH . '/inc' );

// Set max number of post revisions to hold
if (!defined('WP_POST_REVISIONS')) {
	define('WP_POST_REVISIONS', 5);
}

// Use generated CSS
define( 'VERSIONCSS', FALSE );

// Settings and Constants
require_once( SNOINCPATH . '/theme-constants.php' );

// Functions
require_once( SNOINCPATH . '/theme-functions.php' );

// Templates
include( SNOTHEMEPATH . '/tools/theme-options.php' );
include( SNOTHEMEPATH . '/tools/enews.php' );
include( SNOTHEMEPATH . '/tools/snotext.php' );
include( SNOTHEMEPATH . '/tools/videoembed.php' );
include( SNOTHEMEPATH . '/tools/advertisement.php' );
include( SNOTHEMEPATH . '/tools/categorywidget.php' );
include( SNOTHEMEPATH . '/tools/productshowcase.php' );
include( SNOTHEMEPATH . '/tools/pagewidget.php' );
include( SNOTHEMEPATH . '/class-widget-styles.php' );
//include( SNOTHEMEPATH . '/tools/audio.php' );
//include( SNOTHEMEPATH . '/tools/video.php' );