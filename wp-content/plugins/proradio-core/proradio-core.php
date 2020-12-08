<?php
/**
 * Plugin Name: Pro.Radio Core
 * Plugin URI: http://pro.radio
 * Author: Pro.Radio
 * Author URI: http://pro.radio
 * Description: Adds custom type and custom fields capabilities
 * Text Domain: proradio-core
 * Domain Path: /languages
 * Version: PR.4.0.5
*/


/**
 *
 *	For theme to check if is active
 * 
 */
if(!function_exists('proradio_core_active')){
	function proradio_core_active() {
		return true;
	}
}

/**
 *
 *	The plugin textdomain
 * 
 */
if(!function_exists('proradio_core_load_plugin_textdomain')){
function proradio_core_load_plugin_textdomain() {
	load_plugin_textdomain( 'proradio-core', FALSE, basename( dirname( __FILE__ ) ) . '/languages' );
}}

add_action( 'plugins_loaded', 'proradio_core_load_plugin_textdomain' );

/**
 *
 *	Metaboxes component
 * 
 */
if(!function_exists('custom_meta_box_field')){
	require	plugin_dir_path( __FILE__ ) . '/inc/backend/metaboxes/meta_box.php';
}


/**
 *
 *	Custom types component
 * 
 */
require	plugin_dir_path( __FILE__ ) . '/inc/backend/posttypes/posttypes.php';


/**
 *
 *	Custom shortcodes component
 * 
 */
require	plugin_dir_path( __FILE__ ) . '/inc/frontend/shortcode-wrapper/shortcode-wrapper.php';


/*
*	Scripts and styles Backend
*	
*/
if(!function_exists("proradio_core_loader_backend")){
function proradio_core_loader_backend(){
	wp_enqueue_style( 'qtExtensionSuiteStyle',plugins_url( '/assets/style.admin.css' , __FILE__ ),false);
}}
add_action("admin_enqueue_scripts",'proradio_core_loader_backend');


/*
*
*	We add some columns with featured images in the post archive so is easier 
*
*/
if (function_exists( 'add_theme_support' )){
    add_filter('manage_posts_columns', 'proradio_core_posts_columns', 5);
    add_action('manage_posts_custom_column', 'proradio_core_posts_custom_columns', 5, 2);    
}
function proradio_core_posts_columns($defaults){
    $defaults['wps_post_thumbs'] = __('Thumbs',"proradio-core");
    $defaults['wps_post_id'] = __('Post ID',"proradio-core");
    return $defaults;
}
function proradio_core_posts_custom_columns($column_name, $id){
	if($column_name === 'wps_post_thumbs'){
        echo the_post_thumbnail( "thumbnail" );
    }
    if($column_name === 'wps_post_id'){
        echo get_the_ID();
    }
}



add_filter('style_loader_tag', 'proradio_core_remove_type_attr', 9999, 2);
add_filter('script_loader_tag', 'proradio_core_remove_type_attr', 9999, 2);


function proradio_core_remove_type_attr($tag, $handle) {
    return preg_replace( "/type=['\"]text\/(javascript|css)['\"]/", '', $tag );
}


	

