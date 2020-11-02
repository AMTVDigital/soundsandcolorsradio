<?php
/**
 * Plugin Name: Pro.Radio Video Galleries
 * Plugin URI: https://pro.radio/
 * Author: Pro.Radio
 * Author URI: https://pro.radio/
 * Description: Create a filterable video gallery
 * Version: PR.2.2
 * Domain Path: /languages
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 *	For theme to check if is active
 */
function proradio_videogalleries_active() {
	return true;
}

/**
* Returns current plugin version.
* @return string Plugin version
*/
function proradio_videogalleries_plugin_get_version() {
	$plugin_data = get_file_data(__FILE__, [
	    'Version' => 'Version'
	], 'plugin');
	$plugin_version = $plugin_data['Version'];
	return $plugin_version;
}

function proradio_videogalleries_plugin_url() {
	return plugins_url( '' , __FILE__ );
}

/**
 *	Local templates directory
 */
function proradio_videogalleries_local_template_path() {
	return plugin_dir_path(__FILE__).'inc/templates/';
}




/**
 *	The plugin textdomain
 */
if(!function_exists( 'proradio_videogalleries_load_plugin_textdomain' ) ){
	add_action( 'plugins_loaded', 'proradio_videogalleries_load_plugin_textdomain' );
	function proradio_videogalleries_load_plugin_textdomain() {
		load_plugin_textdomain( 'proradio-videogalleries', FALSE, basename( dirname( __FILE__ ) ) . '/languages' );
	}
}


/**
 *	Scripts and styles register
 */
if(!function_exists( 'proradio_videogalleries_register_scripts' ) ){
	add_action("init",'proradio_videogalleries_register_scripts');
	function proradio_videogalleries_register_scripts(){
		wp_register_style(	'proradio-videogalleries', plugins_url( 'assets/css/proradio-videogalleries.css' , __FILE__ ), false, proradio_videogalleries_plugin_get_version());
		$deps = array('jquery');
		wp_register_script(	'proradio-videogalleries',plugins_url( 'assets/script/proradio-videogalleries.js' , __FILE__ ),$deps, proradio_videogalleries_plugin_get_version(), true);
	}
}


/**
 *	Scripts and styles enqueue
 */
if(!function_exists( 'proradio_videogalleries_enqueue_scripts' ) ){
	add_action("wp_enqueue_scripts",'proradio_videogalleries_enqueue_scripts');
	function proradio_videogalleries_enqueue_scripts(){
		wp_enqueue_style( 'proradio-videogalleries');
		wp_enqueue_script( 'proradio-videogalleries' );
	}
}



/**
 * Register new post type and flush rewrite rules upon plugin actvation
 */
include plugin_dir_path( __FILE__ ) . '/inc/backend/posttypes/qtvideo.php';
if(function_exists( 'proradio_videogalleries_register_type' ) ){
	register_activation_hook( __FILE__, 'proradio_videogalleries_register_type' );
	register_activation_hook( __FILE__, 'proradio_videogalleries_type_flush' );
	function proradio_videogalleries_type_flush() {
	    flush_rewrite_rules();
	}
}

/* = Custom fields (Metabox)
=============================================================*/
include plugin_dir_path( __FILE__ ) . '/inc/backend/posttypes/add_meta_box.php';


/**
 * Shortcode inclusion
 */
include plugin_dir_path( __FILE__ ) . '/inc/shortcodes/shortcode-qtvideo.php';






