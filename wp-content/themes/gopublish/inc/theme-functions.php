<?php
/**
 * Additional theme functionality.
 *
 */

/**
 * Included files from other directories
 *
 * Broken apart into several files to make it easier to troubleshoot.
 */

// Stylesheets and Scripts
require_once( SNOINCPATH . '/theme-styles.php' );

// Sidebars
require_once( SNOINCPATH . '/theme-sidebars.php' );

/** Admin Junk */
require_once( SNOINCPATH . '/admin/admin-functions.php' );

/** Model - Building Data */
require_once( SNOINCPATH . '/model/model-functions.php' );

/** Display functions */
require_once( SNOINCPATH . '/view/view-functions.php' );

/** Include tablecloth template and files */
require_once( SNOINCPATH . '/tablecloth/table-cloth-functions.php' );

/**
 * How to use hook.
 *
 * add_action('pre_widget_load', 'pre_widget_load_callback');
 *
 * function pre_widget_load_callback() {
 *     Run this
 * }
 *
 */
/**
 * Hook to run before each widget instance
 */
function pre_widget_load() {
	do_action( 'pre_widget_load' );
}


/**
 * Hook for running functions after < head >
 */
function after_header() {
	do_action( 'after_header', '' );
}