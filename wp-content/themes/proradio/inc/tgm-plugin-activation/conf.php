<?php  
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}




/**
 * Set page builder as theme extension
 */
if( function_exists('vc_set_as_theme') ){
	add_action( 'vc_before_init', 'vc_set_as_theme' );
	vc_set_as_theme();
}



/**
 * This is the list of plugins used by TGM
 * It can be extended by our repository list which can be fetched dynamically.
 */
function proradio_default_plugins_list(){
	return array(
		array(
	        'name'     			 => esc_html__('Server check', 'proradio' ),
	        'slug'     			 => 'proradio-servercheck',
	        'required'           => true,
	        'source'			 => get_template_directory_uri() . '/inc/tgm-plugin-activation/plugins/proradio-servercheck-PR.1.0.4.zip',
	        'version'			 => 'PR.1.0.4'
		),
	);
}