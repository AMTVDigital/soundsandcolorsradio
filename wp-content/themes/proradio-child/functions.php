<?php  
/**
 * ProRadio Child theme
 * custom functions.php file
 */

/**
 * Add parent and child stylesheets
 */
add_action( 'wp_enqueue_scripts', 'proradio_child_enqueue_styles' );
if(!function_exists('proradio_child_enqueue_styles')) {
function proradio_child_enqueue_styles() {
    wp_enqueue_style( 'proradio-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'proradio-child-style', get_stylesheet_uri() );
}}

/**
 * Upon activation flush the rewrite rules to avoid 404 on custom post types
 */
add_action( 'after_switch_theme', 'proradio_child_rewrite_flush_child' );
if(!function_exists('proradio_child_rewrite_flush_child')) {
function proradio_child_rewrite_flush_child() {
    flush_rewrite_rules();
}}	


/**
 * Setup proradio Child Theme's textdomain.
 *
 * Declare textdomain for this child theme.
 * Translations can be filed in the /languages/ directory.
 */
function proradio_child_theme_setup() {
	load_child_theme_textdomain( 'proradio-child',  get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'proradio_child_theme_setup' );