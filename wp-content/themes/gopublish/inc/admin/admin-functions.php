<?php


/**
 * Remove some unneeded menu bar items
 */
add_action( 'wp_before_admin_bar_render', 'remove_admin_bar_links' );
function remove_admin_bar_links() {
	global $wp_admin_bar;
	$wp_admin_bar->remove_menu('wp-logo');
	$wp_admin_bar->remove_menu('updates');
	$wp_admin_bar->remove_menu('comments');
}

/**
 * Add some new menu bar items
 */
// Add EPG Media menu links
add_action('admin_bar_menu', 'add_admin_bar_link', 50);
function add_admin_bar_link($wp_admin_bar) {
	$id = 'epg-media-link';
	$wp_admin_bar->add_menu( array(
			'id' => $id,
			'title' => __( 'EPG Media, LLC' ),
			'href' => __('http://www.epgmediallc.com'),

		) );
	$wp_admin_bar->add_menu( array(
			'parent' => $id,
			'id' => 'epg-media-time-off',
			'title' => __( 'Time Off Request' ),
			'href' => __('http://www.epgmediallc.com/time-off-request/'),
		) );
	$wp_admin_bar->add_menu( array(
			'parent' => $id,
			'id' => 'epg-media-support',
			'title' => __( 'IT Request' ),
			'href' => __('http://www.epgmediallc.com/it-request/'),
		) );

}


/****** Add Thumbnails in Manage Posts/Pages List ******/
if ( !function_exists('AddThumbColumn') && function_exists('add_theme_support') ) {

	// for post and page
	add_theme_support('post-thumbnails', array( 'post', 'page' ) );

	function AddThumbColumn($cols) {

		$cols['thumbnail'] = __('Featured Image');

		return $cols;
	}

	function AddThumbValue($column_name, $post_id) {

		$width = (int) 35;
		$height = (int) 35;

		if ( 'thumbnail' == $column_name ) {
			// thumbnail of WP 2.9
			$thumbnail_id = get_post_meta( $post_id, '_thumbnail_id', true );
			// image from gallery
			$attachments = get_children( array('post_parent' => $post_id, 'post_type' => 'attachment', 'post_mime_type' => 'image') );
			if ($thumbnail_id)
				$thumb = wp_get_attachment_image( $thumbnail_id, array($width, $height), true );
			elseif ($attachments) {
				foreach ( $attachments as $attachment_id => $attachment ) {
					$thumb = wp_get_attachment_image( $attachment_id, array($width, $height), true );
				}
			}
			if ( isset($thumb) && $thumb ) {
				echo $thumb;
			} else {
				echo __('None');
			}
		}
	}

	// for posts
	add_filter( 'manage_posts_columns', 'AddThumbColumn' );
	add_action( 'manage_posts_custom_column', 'AddThumbValue', 10, 2 );

	// for pages
	add_filter( 'manage_pages_columns', 'AddThumbColumn' );
	add_action( 'manage_pages_custom_column', 'AddThumbValue', 10, 2 );
}


/** White label the admin login  */


/**
 * Replaces the login header logo URL
 *
 * @param $url
 */
function namespace_login_headerurl( $url ) {
	$url = home_url( '/' );
	return $url;
}

/**
 * Replaces the login header logo title
 *
 * @param $title
 */
function namespace_login_headertitle( $title ) {
	$title = get_bloginfo( 'name' );
	return $title;
}

/**
 * Set the styles
 */
function namespace_login_style() {
	$image_uri = SNOTHEMEURI;
	$imageUrl = $image_uri . '/images/logo.png';
	echo <<< STYLESHEET
<style>
	body {
		background: #ffffff url('$image_uri/images/bggradient4.png') repeat-x;
		color: #202020;
		font-size: 12px;
		font-family: Arial, Tahoma, Verdana, sans-serif;
		margin: 0 auto 0;
		padding: 0;
	}
    .login h1 a {
        background-image: url( $imageUrl ) !important;
        width: 320px !important;
        height: 200px !important;
        background-size: 320px 200px !important;
    }
</style>
STYLESHEET;
}
// While labeling admin area
add_filter( 'login_headerurl', 'namespace_login_headerurl' );
add_filter( 'login_headertitle', 'namespace_login_headertitle' );
add_action( 'login_head', 'namespace_login_style' );