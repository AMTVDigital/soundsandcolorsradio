<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
*/
// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * ======================================================
 * Feed link
 * ======================================================
 */

if(!function_exists('proradio_archive_feed_link')){
function proradio_archive_feed_link( $term_id = false, $taxonomy = false ) {
	if( false === $term_id || false === $taxonomy ){
		if( is_archive() ) {
			global $wp_query;
			$taxonomy = $wp_query->get_queried_object();
			return get_term_feed_link( $taxonomy->term_id, $taxonomy->taxonomy );
		}
		return;
	} else {
		return get_term_feed_link( $term_id, $taxonomy );
	}
}}