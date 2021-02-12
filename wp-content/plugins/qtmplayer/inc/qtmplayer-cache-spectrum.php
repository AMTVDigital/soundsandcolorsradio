<?php  
/**
 * @package  WordPress
 * @subpackage qtmplayer
 * 
 * 1. Store the peak data in database
 * 2. Retrieve peaks data via ajax
 */

/* = Set custom post type label
=======================================================================*/
if(!function_exists('qtmplayer_peaks_posttype')){
	function qtmplayer_peaks_posttype(){
		return 'qtmplayer_peaks';
	}
}

/* = Create a custom post type to store values
=======================================================================*/
if(!function_exists('qtmplayer_peaks_register_type')){
	add_action( 'init', 'qtmplayer_peaks_register_type' );
	function qtmplayer_peaks_register_type(){

		$action = 'qtmplayer-store-peaks';
		$labels = array(
			'name' => esc_html__("Peaks","proradio"),
		);
		$view_in_admin = false;
		$args = array(
			'labels' => $labels,
			'public' => false,
			'publicly_queryable' => false,
			'query_var' => false,
			'rewrite' => false,
			'capability_type' => 'post',
			'has_archive' => false,
			'hierarchical' => false,
			'page-attributes' => false,
			'show_in_nav_menus' => false,
			'show_ui' => $view_in_admin, 
			'show_in_menu' => $view_in_admin, 
			'show_in_admin_bar' => $view_in_admin,//false,
		); 
		register_post_type( qtmplayer_peaks_posttype() , $args );
	}
	function qtmplayer_peaks_flush() {
	    qtmplayer_peaks_register_type();
	    flush_rewrite_rules();
	}
	register_activation_hook( __FILE__, 'qtmplayer_peaks_flush' );
}


/* = Store the peak data
=======================================================================*/
if(!function_exists('qtmplayer_store_peaks')){
	
	// Link action from javascript ajax call
	$action = 'qtmplayer-store-peaks';
	add_action('wp_ajax_'.$action, 'qtmplayer_store_peaks'); // qtmplayer-waveform.js
	add_action('wp_ajax_nopriv_'.$action, 'qtmplayer_store_peaks');
	
	// function to store the data
	function qtmplayer_store_peaks(){
		ob_clean();
	    $nonce = $_POST['nonce'];
	    if ( ! wp_verify_nonce( $nonce, 'ajax-nonce' ) || !array_key_exists('peaks',$_POST) || !array_key_exists('url',$_POST) ){
	        die();
	    } 
	    $title =  base64_encode( $_POST['url'] );
	   	$data = get_page_by_title($title, OBJECT, qtmplayer_peaks_posttype());
	   	if( !$data ){
	   		echo 'No duplicates found, adding item';
		    $songdata = [
		    	'url' => $_POST['url'],
		    	'peaks' => $_POST['peaks'],
		    ];
		    $postarr = [
		    	'post_type' => qtmplayer_peaks_posttype(),
		    	'post_status' => 'publish',
		    	'comment_status' => 'closed',
		    	'ping_status' => 'closed',
		    	'post_title' =>  base64_encode( $_POST['url'] ),
		    	'post_content' =>  json_encode( $songdata ),
		    ];
		   	$post_ID = wp_insert_post($postarr);
		} else {
			echo 'Already existing';
		}
	    
	    die();
	}
}



/* = Store the peak data
=======================================================================*/
if(!function_exists('qtmplayer_get_peaks')){
	// Link action from javascript ajax call
	$action = 'qtmplayer-get-peaks';
	add_action('wp_ajax_'.$action, 'qtmplayer_get_peaks'); // qtmplayer-waveform.js
	add_action('wp_ajax_nopriv_'.$action, 'qtmplayer_get_peaks');
	// function to store the data
	function qtmplayer_get_peaks(){
		ob_clean();
	    $nonce = $_POST['nonce'];
	    if ( ! wp_verify_nonce( $nonce, 'ajax-nonce' ) || !array_key_exists('url',$_POST) ){
	        die();
	    } 
	    $title =  base64_encode( $_POST['url'] );
	   	$data = get_page_by_title($title, OBJECT, qtmplayer_peaks_posttype());
	   	if( $data ){
	   		$songdata = $data->post_content;
	   		$content_array = json_decode( $songdata, true );
	   		$peaks = $content_array['peaks'];
	   		echo( json_encode( $peaks ) );
	   	}
	    die();
	}
}


