<?php  
/**
 * Plugin Name: Pro.Radio Music Player
 * Description: Music player
 * Plugin URI: http://pro.radio
 * Author: Pro.Radio
 * Author URI: http://pro.radio
 * Version: PR.3.4.5
 * Text Domain: qtmplayer
 * Domain Path: /languages
*/

/**
 * @package  WordPress
 * @subpackage qtmplayer
 */

/**
 *
 *	The plugin textdomain
 * 
 */
if(!function_exists('qtmplayer_td')){
function qtmplayer_td() {
  load_plugin_textdomain( 'qtmplayer', FALSE, basename( dirname( __FILE__ ) ) . '/languages' );
}}
add_action( 'plugins_loaded', 'qtmplayer_td' );

/**
* Returns current plugin version.
* @return string Plugin version. Needs to stay here because of plugin file path
*/
if(!function_exists('qtmplayer_get_version')){
function qtmplayer_get_version() {
	if ( is_admin() ) {
		$plugin_data = get_plugin_data( __FILE__ );
		$plugin_version = $plugin_data['Version'];
	} else {
		$plugin_version = get_file_data( __FILE__ , array('Version'), 'plugin');
	}
	return $plugin_version;
}}

/**
* Flash URL
* @return string Plugin version. Needs to stay here because of plugin file path
*/
if(!function_exists('qtmplayer_flashurl')){
function qtmplayer_flashurl() {
 	return plugins_url( '/assets/soundmanager/swf/' , __FILE__ );
}}



/**
 * 	Enqueue scripts
 * 	=============================================
 */
if(!function_exists('qtmplayer_scripts')){
function qtmplayer_scripts(){
	$deps = array('jquery','jquery-migrate',  'proradio-main');
	$ver = qtmplayer_get_version();
	wp_enqueue_style( "qtmplayer-socicon",plugins_url('/assets/css/qtmplayer.css'	, __FILE__ ), false, $ver, "all" );
	
	
	wp_register_script( 'qtmplayer-waveform', plugins_url('/assets/js/qtmplayer-waveform.js' , __FILE__ ), $deps, $ver, true );
	// Localize the script for ajax calls
	wp_localize_script('qtmplayer-waveform', 'ajax_var', array(
	    'url' => admin_url('admin-ajax.php'),
	    'nonce' => wp_create_nonce('ajax-nonce')
	));
	wp_enqueue_script('qtmplayer-waveform');  $deps[] = 'qtmplayer-waveform';



	// Scripts


	if('1' === get_option( 'qtmplayer_min' )){
		wp_enqueue_script( 'qtmplayer', plugins_url('/assets/js/qtmplayer-min.js' , __FILE__ ), $deps, $ver, true ); $deps[] = 'qtmplayer';	
	} else {
		wp_enqueue_script( 'jquery-marquee', plugins_url('/assets/components/jquery.marquee.js' , __FILE__ ), $deps, $ver, true );  $deps[] = 'jquery-marquee';
		wp_enqueue_script( 'raphael', plugins_url('/assets/components/raphael/raphael.min.js' , __FILE__ ), $deps, $ver, true ); $deps[] = 'raphael';
		wp_enqueue_script( 'soundmanager2', plugins_url('/assets/soundmanager/script/soundmanager2-nodebug-jsmin.js'	, __FILE__ ), $deps, $ver, true ); $deps[] = 'soundmanager2';
		wp_enqueue_script( 'qtmplayer-smpo', plugins_url('/assets/js/qtmplayer-smpo.js'	, __FILE__ ), $deps, $ver, true ); $deps[] = 'qtmplayer-smpo';
		// wp_enqueue_script( 'qtmplayer-webapiplayer', plugins_url('/assets/js/qtmplayer-webapiplayer.js'	, __FILE__ ), $deps, $ver, true ); $deps[] = 'qtmplayer-webapiplayer';
		wp_enqueue_script( 'qtmplayer-radiofeed', plugins_url('/assets/js/qtmplayer-radiofeed.js' , __FILE__ ), $deps, $ver, true ); $deps[] = 'qtmplayer-radiofeed';	
		wp_enqueue_script( 'qtmplayer', plugins_url('/assets/js/qtmplayer.js' , __FILE__ ), $deps, $ver, true ); $deps[] = 'qtmplayer';	
	}




}}
add_action("wp_enqueue_scripts",'qtmplayer_scripts');



/**
 * 	includes
 * 	=============================================
 */
include ( plugin_dir_path( __FILE__ ) . 'inc/func/qtmplayer-volume-control.php');
include ( plugin_dir_path( __FILE__ ) . 'inc/func/qtmplayer-mp3streamtitle.php');
include ( plugin_dir_path( __FILE__ ) . 'inc/func/qtmplayer-playlist-open.php');
include ( plugin_dir_path( __FILE__ ) . 'inc/func/qtmplayer-playlist-close.php');
include ( plugin_dir_path( __FILE__ ) . 'inc/func/qtmplayer-create-track-data.php');
include ( plugin_dir_path( __FILE__ ) . 'inc/func/qtmplayer-create-track.php');
include ( plugin_dir_path( __FILE__ ) . 'inc/func/qtmplayer-create-singletrack.php');
include ( plugin_dir_path( __FILE__ ) . 'inc/func/qtmplayer-replace-audio.php');
include ( plugin_dir_path( __FILE__ ) . 'inc/func/qtmplayer-replace-audio-block.php');
include ( plugin_dir_path( __FILE__ ) . 'inc/func/qtmplayer-create-dllink.php');
include ( plugin_dir_path( __FILE__ ) . 'inc/func/qtmplayer-downloadlink.php');
include ( plugin_dir_path( __FILE__ ) . 'inc/func/qtmplayer-play-circle.php');
include ( plugin_dir_path( __FILE__ ) . 'inc/func/qtmplayer-play-button.php');
include ( plugin_dir_path( __FILE__ ) . 'inc/func/qtmplayer-isinpopup.php'); // since 3.3.3


include ( plugin_dir_path( __FILE__ ) . 'inc/qtmplayer-interface.php');
include ( plugin_dir_path( __FILE__ ) . 'inc/qtmplayer-json.php');
include ( plugin_dir_path( __FILE__ ) . 'inc/qtmplayer-customizations.php');
include ( plugin_dir_path( __FILE__ ) . 'inc/qtmplayer-cache-spectrum.php');





include ( plugin_dir_path( __FILE__ ) . 'inc/qtmplayer-customfields.php');


// Templates functions
include ( plugin_dir_path( __FILE__ ) . 'templates/add-to-playlist.php');
include ( plugin_dir_path( __FILE__ ) . 'templates/qtmplayer-tracklist.php');


// Admin interface
include ( plugin_dir_path( __FILE__ ) . 'inc/qtmplayer-admin.php');

/**
 * 	customizer
 * 	=============================================
 */
if ( function_exists( 'Kirki' ) ) {
	require_once	plugin_dir_path( __FILE__ ) . '/customizer/kirki-config-class/class-kirki2-kirki.php';
	require_once	plugin_dir_path( __FILE__ ) . '/customizer/kirki-configuration/sections.php';
	require_once	plugin_dir_path( __FILE__ ) . '/customizer/kirki-configuration/fields.php';
	require_once	plugin_dir_path( __FILE__ ) . '/customizer/kirki-configuration/configuration.php'; 
} else {
	require_once	plugin_dir_path( __FILE__ ) . '/customizer/kirki-config-class/kirki-installer.php';
}


/* Radio proxy
=============================================*/
if( !function_exists('qtmplayer_proxy')){
	add_action('init', 'qtmplayer_proxy', 1);
	function qtmplayer_proxy(){
		if(isset($_GET)){
			if(array_key_exists('qtproxycall',$_GET) && !array_key_exists('icymetadata', $_GET) ){
				$url = $_GET['qtproxycall'];
				$data = wp_remote_get( $url );
				if ( is_array( $data ) ) {
					echo $data['body'];
				}
				die();
			}

			/**
			 * 
			 * Icy metadata
			 * 
			 */
			if( array_key_exists('qtproxycall',$_GET ) && array_key_exists('icymetadata', $_GET) ){
				// die('iCy MEtadata');
				$url = $_GET[ 'qtproxycall' ];
				die( qtmplayer_getMp3StreamTitle($_GET[ 'qtproxycall' ]) );
			}
		}
	}
}


if( !function_exists('qtmplayer_add_proxy_param')){
	add_action("wp_footer", "qtmplayer_add_proxy_param");
	function qtmplayer_add_proxy_param(){
		?>
		<div id="qtmplayer-radiofeed-proxyurl" class="qt-hidden" data-proxyurl="<?php echo site_url(); ?>"></div>
		<?php  
	}
}





// Add a body class to hide the player
// Not used for Pro.Radio
if(!function_exists('qtmplayer_manage_body_class')){
	add_filter( 'body_class', 'qtmplayer_manage_body_class' );
	function qtmplayer_manage_body_class($classes){
		if(get_theme_mod( 'qtmplayer_replace_default', '1' )){
			$classes[] = 'qtmplayer__hide-audioblock';
		}
		// since PR.3.3.3
		$classes[] = 'qtmplayer-visibility--'.get_theme_mod( 'qtmplayer_visibility', '' );
		return $classes;
	}

}



