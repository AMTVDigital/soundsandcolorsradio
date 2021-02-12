<?php  
/**
 *
 *	Posttypes.php
 *	Author: Pro.Radio
 *	This component is a wrapper for custom types and taxonomies,
 *	so the themes can customize those aspetcs without editing the engine of the backend
 *	and adding maintainability to the software.
 * 
 */


if(!function_exists('proradio_core_posttype')) {
	function proradio_core_posttype( $id = '', $args = array() ) {
		register_post_type($id, $args);
	}
}



if(!function_exists('proradio_core_custom_taxonomy')) {
	function proradio_core_custom_taxonomy( $taxonomy = '', $object_type = '' , $args = '') {
		register_taxonomy( $taxonomy, $object_type, $args );
	}
}



