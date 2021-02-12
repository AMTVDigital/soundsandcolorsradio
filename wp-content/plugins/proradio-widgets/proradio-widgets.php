<?php  
/**
 * Plugin Name: Pro.Radio Widgets
 * Description: Adds custom widgets to Wordpress
 * Plugin URI: http://pro.radio
 * Author: Pro.Radio
 * Author URI: http://pro.radio
 * Version: PR.1.0.4
 * Text Domain: proradio-widgets
 * Domain Path: /languages
 */


/**
 *
 *	The plugin textdomain
 * 	=============================================
 */
if(!function_exists('proradio_widgets_load_plugin_textdomain')){
function proradio_widgets_load_plugin_textdomain() {
	load_plugin_textdomain( 'proradio-widgets', FALSE, plugin_dir_path( __FILE__ ) . 'languages' );
}}
add_action( 'plugins_loaded', 'proradio_widgets_load_plugin_textdomain' );




/**
 * 
 * Reading time calculation
 * =============================================
 */
if(!function_exists('proradio_widgets_readintime')) {
function proradio_widgets_readintime($id = null){
	$id = get_the_id();
	$content = get_post_field('post_content', $id);
	$word = str_word_count(strip_tags($content));

	//words read per minute
	$wpm = 240;
	//words read per second
	$wps = $wpm/60;
	$secs_to_read = ceil($word/$wps);
	return gmdate("i's''", $secs_to_read);
}}

/**
 * 
 * Icon by post format
 * =============================================
 * 
 */


/*  Icon by post format // material icons
=============================================*/
if ( ! function_exists( 'proradio_widgets_format_icon_class' ) ) {
function proradio_widgets_format_icon_class ( $id = false) {
	if ( false === $id ) {
		return;
	} else {
		$format = get_post_format( $id );
		if ( false === $format ) {
			$format = 'post';
		}
		switch ($format){
			case "video":
				echo 'videocam';
				break;
			case "audio":
				echo 'audiotrack';
				break;
			case "gallery":
				echo 'photo_library';
				break;
			case "image":
				echo 'photo_camera';
				break;
			case "link":
				echo 'insert_link';
				break;
			case "chat":
				echo 'chat';
				break;
			case "quote":
				echo 'format_quote';
				break;
			case "aside":
				echo 'insert_comment';
				break;
			case "post": 
			case "aside":
			default:
				echo 'format_align_left';
			break;
		}
	}
}}

/**
 * 	includes
 * 	=============================================
 */
include ( plugin_dir_path( __FILE__ ) . 'widgets/widget-archives-list.php');
include ( plugin_dir_path( __FILE__ ) . 'widgets/widget-archives-card.php');
include ( plugin_dir_path( __FILE__ ) . 'widgets/widget-archives-events.php');
include ( plugin_dir_path( __FILE__ ) . 'widgets/widget-chart.php');
include ( plugin_dir_path( __FILE__ ) . 'widgets/widget-upcomingshows.php');
include ( plugin_dir_path( __FILE__ ) . 'widgets/widget-onair.php');

