<?php
/**
 * View
 */

function my_post_image_html( $html, $post_id, $post_image_id ) {
	global $post;

	$customlink = get_post_meta( $post->ID, 'customlink', true );
	$click      = get_post_meta( $post->ID, 'click_tracker_code', true );
	if ( is_single() ) {
		$photolink = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
		$html      = '<a id="single_image" href="' . $photolink[0] . '" title="' . esc_attr( get_post_field( 'post_title', $post_id ) ) . '">' . $html . '</a>';

		return $html;
	}
	if ( $customlink ) {
		$photolink = $customlink . $click;
		$target    = 'target="_blank" ';
	} else {
		$photolink = get_permalink( $post_id );
		$target    = '';
	}
	$html = '<a ' . $target . 'href="' . $photolink . '" title="' . esc_attr( get_post_field( 'post_title', $post_id ) ) . '">' . $html . '</a>';

	return $html;
}

// turns a category ID to a Name
function cat_id_to_name( $id ) {
	foreach ( (array) ( get_categories() ) as $category ) {
		if ( $id == $category->cat_ID ) {
			return $category->cat_name;
			break;
		}
	}
}

// turns a category ID to a Slug
function cat_id_to_slug( $id ) {
	foreach ( (array) ( get_categories() ) as $category ) {
		if ( $id == $category->cat_ID ) {
			return $category->category_nicename;
			break;
		}
	}
}

// turns a page ID to a Name
function page_id_to_name( $id ) {
	global $page;
	if ( $id == $page->page_ID ) {
		return $page->page_name;
	}
}

function the_content_limit( $max_char, $more_link_text = '(more...)', $stripteaser = 0, $more_file = '' ) {
	$content = get_the_content( $more_link_text, $stripteaser, $more_file );
	$content = apply_filters( 'the_content', $content );
	$content = str_replace( ']]>', ']]&gt;', $content );
	$content = strip_tags( $content );

	if ( ( strlen( $content ) > $max_char ) && ( $espacio = strpos( $content, ' ', $max_char ) ) ) {
		$content = substr( $content, 0, $espacio );
		echo '<p>';
		echo $content;
		echo '...';
		echo '&nbsp;<a href="';
		the_permalink();
		echo '">' . $more_link_text . '</a>';
		echo '</p>';
	} else {
		echo '<p>';
		echo $content;
		echo '</p>';
	}
}

function snowriter() {
	global $post;
	$writer   = get_post_meta( $post->ID, 'writer', true );
	$jobtitle = get_post_meta( $post->ID, 'jobtitle', true );
	if ( $writer != '' ) {
		$args          = array( 'meta_key' => 'name', 'meta_value' => $writer, 'numberposts' => 1 );
		$queried_posts = get_posts( $args );

		if ( $queried_posts ) {
			foreach ( $queried_posts as $queried_post ) {
				$thePostID = $queried_post->ID;
				$link      = get_permalink( $thePostID );
				echo '<a href="' . $link . '">' . $writer . '</a>';
				if ( $jobtitle ) {
					echo ', ' . $jobtitle;
				}
				echo '<br />';
			}
		} else {
			echo $writer;
			if ( $jobtitle ) {
				echo ', ' . $jobtitle;
			}
			echo '<br />';
		}
	} else {
		the_author();
		echo '<br />';
	}
}

function epg_video_feature( $video, $videographer = NULL ) {

	$height_pattern = "/height=\"[0-9]*\"/";
	$width_pattern  = "/width=\"[0-9]*\"/";
	$video  = preg_replace( $height_pattern, "height='400'", $video );
	$video  = preg_replace( $width_pattern, "width='590'", $video );
	$container_open  = '<div style="margin-bottom:15px">';
	$container_close = '</div>';
	if ( $videographer !== NULL ) {
		$video_credit_open  = '<p class="photocredit">';
		$credit             = 'Video Credit: ' . $videographer;
		$video_credit_close = '</p>';

		$credit = $video_credit_open . $credit . $video_credit_close;
	}

	$video_feature = array(
		'container_open'     => $container_open,
		'video'              => $video,
		'video_credit_open'  => $video_credit_open,
		'credit'             => $credit,
		'video_credit_close' => $video_credit_close,
		'container_close'    => $container_close
	);

	return $video_feature;
}

function get_epg_video_feature( $video, $videographer = NULL ) {
	$video_feature = epg_video_feature( $video, $videographer );

	echo implode('', $video_feature);
}