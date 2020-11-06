<?php

 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
 
/**
 * Main Icons2Go Builder Class
 *
 * The init class that runs the Icons2Go Builder plugin.
 * Intended To make sure that the plugin's minimum requirements are met.
 *
 * You should only modify the constants to match your plugin's needs.
 *
 * Any custom code should go inside Plugin Class in the plugin.php file.
 * @since 1.0.0
 */
final class Elementor_Icons2go {
 
	/**
	 * Plugin Version
	 */
	const VERSION = '1.0.0';
 
	/**
	 * Minimum Elementor Version
	 */
	const MINIMUM_ELEMENTOR_VERSION = '2.0.0';
 
	/**
	 * Minimum PHP Version
	 */
	const MINIMUM_PHP_VERSION = '7.0';
 
	/**
	 * Constructor
	 */
	public function __construct() {
		// Load translation
		add_action( 'init', array( $this, 'i18n' ) );
		// Init Plugin
		add_action( 'plugins_loaded', array( $this, 'init' ) );
	}
 
	/**
	 * Load Textdomain
	 */
	public function i18n() {
		load_plugin_textdomain( 'icons2go' );
	}
 
	/**
	 * Initialize the plugin
	 */
	public function init() {
 
		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_missing_main_plugin' ) );
			return;
		}
 
		// Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_minimum_elementor_version' ) );
			return;
		}
 
		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_minimum_php_version' ) );
			return;
		}
 
		// Once we get here, We have passed all validation checks so we can safely include our plugin
		require_once( '_plugin.php' );
	}
 
	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_missing_main_plugin() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}
 
		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'icons2go' ),
			'<strong>' . esc_html__( 'Icons2Go', 'icons2go' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'icons2go' ) . '</strong>'
		);
 
		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}
 
	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_minimum_elementor_version() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}
 
		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'icons2go' ),
			'<strong>' . esc_html__( 'Icons2Go', 'icons2go' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'icons2go' ) . '</strong>',
			self::MINIMUM_ELEMENTOR_VERSION
		);
 
		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}
 
	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_minimum_php_version() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}
 
		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'icons2go' ),
			'<strong>' . esc_html__( 'Icons2Go', 'icons2go' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'icons2go' ) . '</strong>',
			self::MINIMUM_PHP_VERSION
		);
 
		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}
}
 
// Instantiate elementor-proradio.
new Elementor_Icons2go();