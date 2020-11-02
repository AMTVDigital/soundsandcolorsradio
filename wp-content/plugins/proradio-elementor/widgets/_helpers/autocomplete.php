<?php 
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
 * Used by shortcodes autocomplete
*/

if(!function_exists('elementor_proradio_autocomplete')) {
function elementor_proradio_autocomplete( $post_type = 'post' ) {
	$posts = get_posts( array(
		'posts_per_page' 	=> -1,
		'post_type'			=> $post_type,
	));
	$result = array();
	foreach ( $posts as $post )	{
		$result[$post->ID] = $post->post_title;
	}
	return $result;
}}