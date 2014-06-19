<?php
/**
 * Theme Constants and Values
 */


/**
 * Supports
 */
add_theme_support( 'post-thumbnails' );
add_theme_support( 'nav-menus' );

/**
 * Options
 */
add_option( 'home_left_column', '280', '', 'yes' );
add_option( 'home_center_column', '280', '', 'yes' );
add_option( 'home_right_column', '300', '', 'yes' );
add_option( 'home_narrow_column', '160', '', 'yes' );
add_option( 'home_wide_column', '400', '', 'yes' );
add_option( 'home_full_width_column', '590', '', 'yes' );
add_option( 'non_home_right_column', '300', '', 'yes' );
add_option( 'bsno', 'bsno837625', '', 'yes' );
update_option( 'bsno', 'bsno837625b', '', 'yes' );
add_option( 'bussno', 'bussno379657', '', 'yes' );
update_option( 'bussno', 'bussno379657b', '', 'yes' );

/**
 * Image sizes
 */
add_image_size( 'topstories', 608, 300, true );
add_image_size( 'widesliderimage', 938, 300, true );
add_image_size( 'home400', 400, 9999 );
add_image_size( 'permalink', 298, 9999 );
add_image_size( 'home280', 278, 9999 );
add_image_size( 'archive', 200, 9999 );
add_image_size( 'home160', 158, 9999 );
add_image_size( 'homefeature', 158, 110, true );
add_image_size( 'home120', 120, 9999 );
add_image_size( 'ae', 60, 90, true );
add_image_size( 'homethumb', 70, 70, true );
add_image_size( 'videothumb', 90, 60, true );

add_filter( 'post_thumbnail_html', 'my_post_image_html', 10, 3 );

/**
 * Set that content width
 */
if ( ! isset( $content_width ) ) {
	$content_width = 590;
}
