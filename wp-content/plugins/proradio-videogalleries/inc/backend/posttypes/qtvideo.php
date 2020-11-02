<?php
/**
 * @package Qt VideoGalleries
 * @version  2.0
 */

/* = Adding specific filters to the video editor
=============================================================*/

if(!function_exists('proradio_videogalleries_register_type')){ 
	add_action('init', 'proradio_videogalleries_register_type'); 
	function proradio_videogalleries_register_type() {
		$name = 'video';
		$labels = array(
			'name' => __('Video','videolove' ).'s',
			'singular_name' => __('video','videolove' ),
			'add_new' => 'Add New ',
			'add_new_item' => 'Add New '.__('video','videolove' ),
			'edit_item' => 'Edit '.__('video','videolove' ),
			'new_item' => 'New '.__('video','videolove' ),
			'all_items' => 'All '.__('video','videolove' ).'s',
			'view_item' => 'View '.__('video','videolove' ),
			'search_items' => 'Search '.__('video','videolove' ).'s',
			'not_found' =>  'No '.$name.' found',
			'not_found_in_trash' => 'No '.$name.'s found in Trash', 
			'parent_item_colon' => '',
			'menu_name' => __('Video','videolove' ).'s'
		);	
		$args = array(
			'labels' => $labels,
			'singular_label' => __('video'),
			'public' => true,
			'show_ui' => true,
			'capability_type' => 'page',
			'has_archive' => true,
			'publicly_queryable' => true,
			'rewrite' => true,
			'menu_position' => 48,
			'query_var' => true,
			'exclude_from_search' => false,
			'can_export' => true,
			'hierarchical' => false,
			'page-attributes' => true,
			'menu_icon' => 'dashicons-video-alt',
			'supports' => array('title', 'thumbnail','editor', 'page-attributes','comments', 'revisions' )

		);  
		register_post_type( 'qtvideo' , $args );	
		$labels = array(
			'name' => __( 'Filters','videolove' ),
			'singular_name' => __( 'Filters','videolove' ),
			'search_items' =>  __( 'Search by filter','videolove' ),
			'popular_items' => __( 'Popular filters','videolove' ),
			'all_items' => __( 'All filters','videolove' ),
			'parent_item' => null,
			'parent_item_colon' => null,
			'edit_item' => __( 'Edit filter','videolove' ), 
			'update_item' => __( 'Update filter','videolove' ),
			'add_new_item' => __( 'Add filter','videolove' ),
			'new_item_name' => __( 'New filter','videolove' ),
			'separate_items_with_commas' => __( 'Separate filters with commas','videolove' ),
			'add_or_remove_items' => __( 'Add or remove filters','videolove' ),
			'choose_from_most_used' => __( 'Choose from the most used filters','videolove' ),
			'menu_name' => __( 'Filters','videolove' ),
		); 

		$args = array(
			'hierarchical' => false,
			'labels' => $labels,
			'show_ui' => true,
			'update_count_callback' => '_update_post_term_count',
			'query_var' => true,
			'rewrite' => array( 'slug' => 'filter' ),
		);
		register_taxonomy( 'vdl_filters', 'qtvideo', $args );
	}
}




