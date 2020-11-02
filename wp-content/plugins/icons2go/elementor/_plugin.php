<?php
namespace ElementorIcons2Go;

 
/**
 * Class Plugin
 *
 * Main Plugin class
 * @since 1.0.0
 */
class Plugin {
 
	/**
	 * Instance
	 *
	 * @since 1.0.0
	 * @access private
	 * @static
	 *
	 * @var Plugin The single instance of the class.
	 */
	private static $_instance = null;
 
	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.2.0
	 * @access public
	 *
	 * @return Plugin An instance of the class.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
					 
		return self::$_instance;
	}
 
	/**
	 * widget_scripts
	 *
	 * Load required plugin core files.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function widget_scripts() {
		// wp_register_script( 'awesomesauce', plugins_url( '/assets/js/awesomesauce.js', __FILE__ ), [ 'jquery' ], filemtime( __FILE__ ), true );
	}


	/**
	 * Include Widgets files
	 * Load widgets files
	 */
	private function include_widgets_files() {
		require_once( __DIR__ . '/widgets/icons2go/icons2go.php' );
	}
 
	/**
	 * Register Widgets
	 * Register new Elementor widgets.
	 */
	public function register_widgets() {
		// Register Widgets
		$this->include_widgets_files();
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\ElementorIcons2Go() );
	}

	public function add_elementor_widget_categories( $elements_manager ) {
		\Elementor\Plugin::instance()->elements_manager->add_category(
			'Icons2Go',
			[
				'title' => __( 'Icons2Go', 'icons2go' ),
				'icon' => 'fa fa-plug',
			]
		);
	}
 
	/**
	 *  Plugin class constructor
	 *
	 * Register plugin action hooks and filters
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function __construct() {
 		//Add category
		add_action( 'elementor/elements/categories_registered', [ $this, 'add_elementor_widget_categories' ], 0 );
		// Register widget scripts
		add_action( 'elementor/frontend/after_register_scripts', [ $this, 'widget_scripts' ] );
		// Register widgets
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'register_widgets' ] );
	}
}
 
// Instantiate Plugin Class
Plugin::instance();