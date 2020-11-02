<?php  
/**
* Plugin Name: Pro.Radio Chartvote
* Plugin URI: http://pro.radio
* Author: Pro.Radio
* Author URI: http://pro.radio
* Description: Adds a vote button to tracks in charts
* Version: PR.3.0.1
* Text Domain: proradio-chartvote
* Domain Path: /languages
* @package proradio-chartvote
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 *
 *	For theme to check if is active
 * 
 */
function qt_chartvote_active() {
	return true;
}

/**
* Returns current plugin version.
* @return string Plugin version
*/
if(!function_exists('qt_chartvote_plugin_get_version')){
function qt_chartvote_plugin_get_version() {
	$plugin_data = get_file_data(__FILE__, [
	    'Version' => 'Version'
	], 'plugin');
	$plugin_version = $plugin_data['Version'];
	return $plugin_version;
}}

$timebeforerevote = 120; // = 2 hours

/**
 * 	language files
 * 	=============================================
 */
if(!function_exists('qt_chartvote_load_text_domain')){
function qt_chartvote_load_text_domain() {
	load_plugin_textdomain( 'proradio-chartvote', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}}
add_action( 'init', 'qt_chartvote_load_text_domain' );

/**
 * 	includes
 * 	=============================================
 */
require plugin_dir_path( __FILE__ ) . '/includes/frontend/chartvote-shortcode.php';
require plugin_dir_path( __FILE__ ) . '/includes/backend/chartvote-functions.php';

/**
 * 	hooks
 * 	=============================================
 */
add_action('wp_ajax_nopriv_track-vote', 'qt_chartvote_track_vote');
add_action('wp_ajax_track-vote', 'qt_chartvote_track_vote');

/**
 * 	Enqueue scripts
 * 	=============================================
 */
if(!function_exists('qt_chartvote_enqueue_stuff')){
function qt_chartvote_enqueue_stuff(){
	wp_enqueue_script('jquery-cookie', plugins_url('assets/js/jquery.cookie.js'	, __FILE__ ) , array('jquery'), qt_chartvote_plugin_get_version(), true ) ;
	wp_enqueue_style('proradio-chartvote', plugin_dir_url(__FILE__).'assets/css/proradio-chartvote.css' );
	// wp_enqueue_style( $handle = "dripicons",  plugins_url('assets/dripicons/webfont.css'	, __FILE__ ), false, qt_chartvote_plugin_get_version(), "all" );
	wp_enqueue_script('proradio-chartvote', plugins_url('assets/js/proradio-chartvote-script.js'	, __FILE__ ) , array('jquery','jquery-cookie'), qt_chartvote_plugin_get_version(), true );
	
	wp_localize_script('proradio-chartvote', 'chartvote_ajax_var', array(
	    'url' => admin_url('admin-ajax.php'),
	    'nonce' => wp_create_nonce('chartvote-nonce')
	));
}}

add_action( 'wp_enqueue_scripts', 'qt_chartvote_enqueue_stuff', -9999999999 );
