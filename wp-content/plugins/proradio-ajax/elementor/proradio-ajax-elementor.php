<?php  

/**
 * Load scripts and styles globally
 */

add_action( 'wp_enqueue_scripts', 'proradio_ajax_elementor_scripts'  );
function proradio_ajax_elementor_scripts(){
	if(is_user_logged_in()){
		if(current_user_can('edit_pages' )){
			return;
		}
	}
	$elementorFrontend = new \Elementor\Frontend();
	$elementorFrontend->enqueue_scripts();
	$elementorFrontend->enqueue_styles();
}


