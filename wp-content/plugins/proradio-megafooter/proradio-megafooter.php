<?php
/**
* Plugin Name: Pro.Radio MegaFooter
* Plugin URI: https://pro.radio/
* Author: Pro.Radio
* Author URI: https://pro.radio/
* Description: Add mega footer capabilities using Page Builder
* Version: PR.1.0.6
* Text Domain: proradio-megafooter
* Domain Path: /languages
* 
* @package proradio-megafooter
*/



if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 *
 *	For theme to check if is active
 * 
 */
if(!function_exists('proradio_megafooter_is_active')){
function proradio_megafooter_is_active() {
	return true;
}}

/**
 *
 *	Assets URL
 * 
 */
if(!function_exists('proradio_megafooter_assets_url')){
function proradio_megafooter_assets_url() {
	return plugins_url('assets/' , __FILE__);
}}


/**
 *
 *	Base dir path for files inclusion
 * 
 */
if(!function_exists('proradio_megafooter_plugin_dir_path')){
function proradio_megafooter_plugin_dir_path() {
	return plugin_dir_path( __FILE__ );
}}

/**
 *
 *	MegaFooter custom type name
 * 
 */
if(!function_exists('proradio_megafooter_posttype_name')){
function proradio_megafooter_posttype_name() {
	return 'proradio-megafooter';
}}



/**
 *
 *	For theme to check if is active
 * 
 */
if(!function_exists('proradio_megafooter_active')){
function proradio_megafooter_active() {
	return true;
}}

/**
* Returns current plugin version.
* @return string Plugin version
*/
if(!function_exists('proradio_megafooter_plugin_get_version')){
function proradio_megafooter_plugin_get_version() {
	$plugin_data = get_file_data(__FILE__, [
	    'Version' => 'Version'
	], 'plugin');
	$plugin_version = $plugin_data['Version'];
	return $plugin_version;
}}

/**
 *
 *	The plugin textdomain
 * 
 */
if(!function_exists('proradio_megafooter_load_plugin_textdomain')){
function proradio_megafooter_load_plugin_textdomain() {
	load_plugin_textdomain( 'proradio-megafooter', FALSE, basename( dirname( __FILE__ ) ) . '/languages' );
}}
add_action( 'plugins_loaded', 'proradio_megafooter_load_plugin_textdomain' );



/**
 *
 *	Scripts and styles register (enqueue is below)
 * 
 */
add_action("init",'proradio_megafooter_register_scripts');
function proradio_megafooter_register_scripts(){
	/**
	 * Styles registration
	 */
	wp_register_style('proradio-megafooter-style',plugins_url( 'assets/css/proradio-megafooter.css' , __FILE__ ), false, proradio_megafooter_plugin_get_version());

}


/**
 *
 *	Scripts and styles enqueue
 * 
 */

if(!function_exists('proradio_megafooter_enqueue_scripts')){
	add_action("wp_enqueue_scripts",'proradio_megafooter_enqueue_scripts');
	function proradio_megafooter_enqueue_scripts(){
		wp_enqueue_script( 'proradio-megafooter-script' );
	}
}



if(!function_exists('proradio_megafooter_enqueue_style')){
	add_action('wp_head','proradio_megafooter_enqueue_style',1000);
	function proradio_megafooter_enqueue_style(){
		?>
		<!-- MEGA FOOTER CUSTOMIZATIONS START ========= -->
		<style>
		<?php  echo wp_kses_post( proradio_megafooter_vc_customcss() ); ?>
		</style>
		<!-- MEGA FOOTER CUSTOMIZATIONS END ========= -->
		<?php
	}
}


/**
 *
 *	Helpers and functions
 * 
 */
require plugin_dir_path( __FILE__ ) . '/inc/helpers.php';
require plugin_dir_path( __FILE__ ) . '/inc/backend/custom-post-type.php';
// Flush rewrite rules upon plugin activation
// Enable Elementor
if(function_exists('proradio_megafooter_flush_rewrite_rules')){
	register_deactivation_hook( __FILE__, 'proradio_megafooter_flush_rewrite_rules' );
	register_activation_hook( __FILE__, 'proradio_megafooter_flush_rewrite_rules' );
}

require plugin_dir_path( __FILE__ ) . '/inc/backend/granular-settings.php';
require plugin_dir_path( __FILE__ ) . '/inc/frontend/megafooter-display.php';



/**
 * 	customizer
 * 	=============================================
 */
if ( ! function_exists( 'Kirki' ) ) {
	// Install kirki if is missing
	require_once	plugin_dir_path( __FILE__ ) . '/customizer/kirki-config-class/kirki-installer.php';
} else {
	require_once	plugin_dir_path( __FILE__ ) . '/customizer/kirki-config-class/kirki-config.php';
	require_once	plugin_dir_path( __FILE__ ) . '/customizer/kirki-configuration/sections.php';
	require_once	plugin_dir_path( __FILE__ ) . '/customizer/kirki-configuration/fields.php';
	require_once	plugin_dir_path( __FILE__ ) . '/customizer/kirki-configuration/configuration.php'; 
}






