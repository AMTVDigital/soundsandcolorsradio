<?php  
/**
 * Plugin Name: Pro.Radio ReAktions
 * Plugin URI: http://pro.radio
 * Author: Pro.Radio
 * Author URI: http://pro.radio
 * Description: Adds ratings, views, love and sharing, all in one.
 * Text Domain: proradio-reaktions
 * Domain Path: /languages
 * Version: PR.4.0.7
 * 
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
/**
 * Functions list:
 *
 * 	Shortcodes
 *	[proradio_reaktions-social Creates social sharing functions] -> returns HTML
 *	[proradio_reaktions-loveit-link --- proradio_reaktions_loveit_link Creates LOVE button] -> returns HTML
 *	[proradio_reaktions-loveit-count --- proradio_reaktions_loveit_count show number of loveit]
 *	[proradio_reaktions-rating --- 'proradio_reaktions_rating() Display the rating]
 *	[proradio_reaktions-views --- proradio_reaktions_viewsdisplay() Display number of views] -> returns HTML
 *	[proradio_reaktions-readingtime-raw]
 *	[proradio_reaktions-readingtime]
 *	[proradio_reaktions-full --- proradio_reaktions_full() All the stuff]
 *
 * 	Helpers:
 *	[proradio_reaktions_viewsread Display number of views without] -> returns INTEGER
 *	[proradio_reaktions_loveit_count Display number of LOVE] -> returns INTEGER
 *
 *
 *
 *	ADD FAKE REAKTIONS:
 *	IF YOU WANT TO KICKSTART THE COUNTS IN THE QUICK WAY, PUT THIS IN A TEMPLATE FOR THE POSTS LOOP:
 *	
 *	if ( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : $wp_query->the_post();
		$post = $wp_query->post;
		setup_postdata( $post );
		// echo $post->ID;
		update_post_meta($post->ID, 'proradio_reaktions_views', rand(50, 100) );
		update_post_meta($post->ID, 'ttg_rating_amount', 4);
		update_post_meta($post->ID, 'ttg_rating_average', rand ( 3, 5 ));
		update_post_meta($post->ID, 'proradio_reaktions_votes_count', rand ( 90 , 200 ));

		get_template_part ('template-parts/post/post');
	endwhile; else: ?>
		<h3><?php esc_html_e("Sorry, nothing here","firwl")?></h3>
	<?php endif;
 *
 * 
 */

// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}


function proradio_reaktions_active(){
	return true;
}



function proradio_reaktions_get_time_before_revote(){
	return get_option("proradio_reaktions_timeout_revote", '120'); // seconds
}



/**
* Returns current plugin version.
* @return string Plugin version. Needs to stay here because of plugin file path
*/
function proradio_reaktions_plugin_get_version() {
	if ( is_admin() ) {
		$plugin_data = get_plugin_data( __FILE__ );
		$plugin_version = $plugin_data['Version'];
	} else {
		$plugin_version = get_file_data( __FILE__ , array('Version'), 'plugin');
	}
	return $plugin_version;
}



/**
* Returns current plugin url for css and img.
*/
function proradio_reaktions_plugin_get_url() {
	return plugin_dir_url(__FILE__);
}


/**
 * 	language files
 * 	=============================================
 */
if(!function_exists('proradio_reaktions_load_text_domain')){
function proradio_reaktions_load_text_domain() {
	load_plugin_textdomain( 'proradio-reaktions', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}}
add_action( 'init', 'proradio_reaktions_load_text_domain' );

/**
 * 	includes
 * 	=============================================
 */
include(plugin_dir_path( __FILE__ ) . '/includes/backend/settings.php');
include(plugin_dir_path( __FILE__ ) . '/includes/frontend/functions.php');
include(plugin_dir_path( __FILE__ ) . '/includes/ajax/ajax-love.php');


/**
 * 	hooks
 * 	=============================================
 */

if( get_option('proradio_reaktions_love', 1) ) {
	add_action('wp_ajax_nopriv_post-like', 'proradio_reaktions_post_like');
	add_action('wp_ajax_post-like', 'proradio_reaktions_post_like');
}
if( get_option('proradio_reaktions_views', 1) ) {
	add_action( 'wp_ajax_ttg_post_views', 'ttg_post_views' );
	add_action( 'wp_ajax_nopriv_ttg_post_views', 'ttg_post_views' );
}
if( get_option('proradio_reaktions_ratings', 1) ) {
	add_action( 'wp_ajax_ttg_rating_submit', 'ttg_rating_submit' );
	add_action( 'wp_ajax_nopriv_ttg_rating_submit', 'ttg_rating_submit' );
}
if( get_option('proradio_reaktions_love', 1) ) {
	add_action('wp_ajax_nopriv_ttg_share_submit', 'proradio_reaktions_post_share');
	add_action('wp_ajax_ttg_share_submit', 'proradio_reaktions_post_share');
}


/**
 * 	Enqueue styles
 * 	=============================================
 */
if(!function_exists('proradio_reaktions_enqueue_styles')){
function proradio_reaktions_enqueue_styles(){
	wp_enqueue_style('proradio-reaktions-style', plugin_dir_url(__FILE__).'assets/css/style.css' );
	wp_enqueue_style('reakticons', plugin_dir_url(__FILE__).'assets/reakticons/styles.css', false, '2' );
	wp_enqueue_style('qt-socicon', plugin_dir_url(__FILE__).'assets/qt-socicon/styles.css', false, '2' );
}}
add_action( 'wp_head', 'proradio_reaktions_enqueue_styles', 0 );

/**
 * 	Enqueue scripts
 * 	=============================================
 */
if(!function_exists('proradio_reaktions_lenqueue_stuff')){
function proradio_reaktions_lenqueue_stuff(){
	// scripts
	// wp_enqueue_script('popup', plugin_dir_url(__FILE__).'js/popup/popup.js', array('jquery'), '1.0', true );
	// ajax stuff
	wp_register_script('proradio_reaktions_script', plugin_dir_url(__FILE__).'js/proradio-reaktions.js', array('jquery', 'proradio-main' ),  proradio_reaktions_plugin_get_version(), true );
	wp_localize_script('proradio_reaktions_script', 'ajax_var', array(
	    'url' => admin_url('admin-ajax.php'),
	    'nonce' => wp_create_nonce('ajax-nonce')
	));
	wp_enqueue_script('proradio_reaktions_script');
}}

add_action( 'wp_enqueue_scripts', 'proradio_reaktions_lenqueue_stuff' );

