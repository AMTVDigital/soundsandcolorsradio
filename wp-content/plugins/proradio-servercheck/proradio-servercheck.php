<?php  
/*
Plugin Name: Pro.Radio Server Check
Plugin URI: http://pro.radio
Description: Verify the server status and theme compatibility
Version: PR.1.0.6
Author: QantumThemes
Author URI: http://pro.radio
Text Domain: proradio-servercheck
Domain Path: /languages
*/

/**
 *
 *	The plugin textdomain
 * 
 */
if(!function_exists('proradio_servercheck_td')){
function proradio_servercheck_td() {
  load_plugin_textdomain( 'proradio-servercheck', FALSE, basename( dirname( __FILE__ ) ) . '/languages' );
}}
add_action( 'plugins_loaded', 'proradio_servercheck_td' );

/**
* Returns current plugin version.
* @return string Plugin version. Needs to stay here because of plugin file path
*/
if(!function_exists('proradio_servercheck_get_version')){
function proradio_servercheck_get_version() {
	if ( is_admin() ) {
		$plugin_data = get_plugin_data( __FILE__ );
		$plugin_version = $plugin_data['Version'];
	} else {
		$plugin_version = get_file_data( __FILE__ , array('Version'), 'plugin');
	}
	return $plugin_version;
}}



/**
 * 	includes
 * 	=============================================
 */
include ( plugin_dir_path( __FILE__ ) . 'inc/servercheck-admin.php');


/**
 * 	includes
 * 	=============================================
 */
if(!function_exists('proradio_servercheck_scripts')){
	add_action("admin_enqueue_scripts",'proradio_servercheck_scripts');
	function proradio_servercheck_scripts(){
		wp_enqueue_style(	'proradio_servercheck_style',plugins_url( 'assets/css/proradio-servercheck-style.css' , __FILE__ ), false, proradio_servercheck_get_version());
	}
}
















