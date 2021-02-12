<?php
/**
 * @package proradio-megafooter
 */


if(!function_exists('proradio_megafooter_register_type')){
	add_action('init', 'proradio_megafooter_register_type');  
	function proradio_megafooter_register_type() {

		$labels = array(
			'name' => esc_html__("Mega Footer","proradio-megafooter"),
			'singular_name' => esc_html__("Mega Footer","proradio-megafooter"),
			'add_new' => esc_html__("Add new","proradio-megafooter"),
			'add_new_item' => esc_html__("Add new Mega Footer","proradio-megafooter"),
			'edit_item' => esc_html__("Edit Mega Footer","proradio-megafooter"),
			'new_item' => esc_html__("New Mega Footer","proradio-megafooter"),
			'all_items' => esc_html__("All Mega Footers","proradio-megafooter"),
			'view_item' => esc_html__("View Mega Footer","proradio-megafooter"),
			'search_items' => esc_html__("Search Mega Footer","proradio-megafooter"),
			'not_found' => esc_html__("No Mega Footer found","proradio-megafooter"),
			'not_found_in_trash' => esc_html__("No Mega Footer found in trash","proradio-megafooter"),
			'menu_name' => esc_html__("Mega Footer","proradio-megafooter")
		);
		$args = array(
			'labels' => $labels,
			'public' => true,
			'has_archive' => false,
			'menu_position' => 110,
			'exclude_from_search' => true,
			'hierarchical' => false,
			'menu_icon' => 'dashicons-editor-insertmore',
			'show_in_nav_menus' => false,
			'supports' => array('title', 'thumbnail','editor', 'page-attributes' )
		);  
		if (function_exists('register_post_type') && function_exists('proradio_megafooter_posttype_name')){
			register_post_type( proradio_megafooter_posttype_name() , $args );
		}

	}
}

/*
 *	Flush rewrite rules
 *	Add Elementor support
 *	=============================================================
 */
if( !function_exists('proradio_megafooter_flush_rewrite_rules') ){
	function proradio_megafooter_flush_rewrite_rules() {
		// Flush rewrite rules
		if( function_exists('proradio_megafooter_register_type') ){
			proradio_megafooter_register_type();
			flush_rewrite_rules();
		} 
		// Check if the custom post type is supported
		$cpt_name = proradio_megafooter_posttype_name();
		$cpt_support = get_option( 'elementor_cpt_support' );
		if( ! $cpt_support ) {
			$cpt_support = [ 'page', 'post', $cpt_name ];
			update_option( 'elementor_cpt_support', $cpt_support ); 
		} else if( ! in_array( $cpt_name, $cpt_support ) ) {
			$cpt_support[] = $cpt_name;
			update_option( 'elementor_cpt_support', $cpt_support );
		}
	}
}


