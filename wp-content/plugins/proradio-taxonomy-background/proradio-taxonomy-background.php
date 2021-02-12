<?php  
/**
 * Plugin Name: Pro.Radio Taxonomy Background
 * Description: Adds background image to taxonomies
 * Plugin URI: http://pro.radio
 * Author: Pro.Radio
 * Author URI: http://pro.radio
 * Version: PR.1.0.1 
 * Text Domain: proradio-taxonomy-background
 * Domain Path: /languages
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
// Just let the theme know the plugin is active
function proradio_taxonomy_background_active(){
	return true;
}

/**
 * 	includes
 * 	=============================================
 */

include(plugin_dir_path( __FILE__ ) . '/inc/background.php');
include(plugin_dir_path( __FILE__ ) . '/inc/customizations-frontend.php');
