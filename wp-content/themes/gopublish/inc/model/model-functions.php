<?php

/**
 * Model
 */

function custom_search_join( $join ) {
	if ( is_search() && isset( $_GET['s'] ) ) {
		global $wpdb;
		$join = " LEFT JOIN $wpdb->postmeta ON $wpdb->posts.ID = $wpdb->postmeta.post_id ";
	}

	return ( $join );
}

add_filter( 'posts_join', 'custom_search_join' );

function custom_search_groupby( $groupby ) {
	if ( is_search() && isset( $_GET['s'] ) ) {
		global $wpdb;
		$groupby = " $wpdb->posts.ID ";
	}

	return ( $groupby );
}

add_filter( 'posts_groupby', 'custom_search_groupby' );

function custom_search_where( $where ) {
	if ( is_search() && isset( $_GET['s'] ) ) {
		global $wpdb;
		$customs = array( 'writer', 'caption', 'videographer' );
		$query   = '';
		$var_q   = stripslashes( $_GET['s'] );
		if ( $_GET['sentence'] ) {
			$search_terms = array( $var_q );
		} else {
			preg_match_all( '/".*?("|$)|((?<=[\\s",+])|^)[^\\s",+]+/', $var_q, $matches );
			$search_terms = array_map( create_function( '$a', 'return trim($a, "\\"\'\\n\\r ");' ), $matches[0] );
		}
		$n         = ( $_GET['exact'] ) ? '' : '%';
		$searchand = '';
		foreach ( (array) $search_terms as $term ) {
			$term   = addslashes_gpc( $term );
			$query .= "{$searchand}(";
			$query .= "($wpdb->posts.post_title LIKE '{$n}{$term}{$n}')";
			$query .= " OR ($wpdb->posts.post_content LIKE '{$n}{$term}{$n}')";
			foreach ( $customs as $custom ) {
				$query .= ' OR (';
				$query .= "($wpdb->postmeta.meta_key = '$custom')";
				$query .= " AND ($wpdb->postmeta.meta_value LIKE '{$n}{$term}{$n}')";
				$query .= ')';
			}
			$query .= ')';
			$searchand = ' AND ';
		}
		$term = $wpdb->escape( $var_q );
		if ( ! $_GET['sentence'] && Count( $search_terms ) > 1 && $search_terms[0] != $var_q ) {
			$search .= " OR ($wpdb->posts.post_title LIKE '{$n}{$term}{$n}')";
			$search .= " OR ($wpdb->posts.post_content LIKE '{$n}{$term}{$n}')";
		}
		if ( ! empty( $query ) ) {
			$where = " AND ({$query}) AND ($wpdb->posts.post_status = 'publish') ";
		}
	}

	return ( $where );
}

add_filter( 'posts_where', 'custom_search_where' );