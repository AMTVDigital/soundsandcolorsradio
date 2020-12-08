<?php
namespace ProradioElementor;

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
	 * enqueue_styles
	 *
	 * Load custom styling.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function enqueue_styles() {
		wp_enqueue_style( 'proradio-elementor-admin', plugins_url( '/assets/css/admin.css', __FILE__ ) );
		wp_enqueue_style( 'proradio-elementor-admin-icons', plugins_url( '/assets/font/proradio-for-elementor/styles.css', __FILE__ ) );

		wp_enqueue_style(
			'elementor-editor-dark-mode',
			ELEMENTOR_ASSETS_URL . 'css/editor-dark-mode.css',
			[
				'elementor-editor',
			]
		);
	}


 
	/**
	 * Include Widgets files
	 *
	 * Load widgets files
	 *
	 * @since 1.2.0
	 * @access private
	 */
	private function include_widgets_files() {
		require_once( __DIR__ . '/widgets/_helpers/autocomplete.php' );
		require_once( __DIR__ . '/widgets/_helpers/converter.php' );
		require_once( __DIR__ . '/widgets/_helpers/get-terms-array.php' );
		require_once( __DIR__ . '/widgets/_helpers/query-fields.php' );
		require_once( __DIR__ . '/widgets/_helpers/carousel-fields.php' );
		require_once( __DIR__ . '/widgets/_helpers/slider-fields.php' );
		require_once( __DIR__ . '/widgets/3d-header/3d-header.php' );
		require_once( __DIR__ . '/widgets/pricing-table/pricing-table.php' );
		require_once( __DIR__ . '/widgets/appicons/appicons.php' );
		require_once( __DIR__ . '/widgets/socialicons/socialicons.php' );
		require_once( __DIR__ . '/widgets/sponsors/sponsors.php' );
		require_once( __DIR__ . '/widgets/button/button.php' );
		require_once( __DIR__ . '/widgets/caption/caption.php' );
		require_once( __DIR__ . '/widgets/spacer/spacer.php' );
		require_once( __DIR__ . '/widgets/section-caption/section-caption.php' );
		require_once( __DIR__ . '/widgets/cards-horizontal/cards-horizontal.php' );
		require_once( __DIR__ . '/widgets/cards/cards.php' );
		require_once( __DIR__ . '/widgets/bullet-list/bullet-list.php' );
		require_once( __DIR__ . '/widgets/gallery/gallery.php' );
		require_once( __DIR__ . '/widgets/category-grid/category-grid.php' );
		require_once( __DIR__ . '/widgets/chart-tracklist/chart-tracklist.php' );
		require_once( __DIR__ . '/widgets/post-inline/post-inline.php' );
		require_once( __DIR__ . '/widgets/post-list/post-list.php' );
		require_once( __DIR__ . '/widgets/post-list-horizontal/post-list-horizontal.php' );
		require_once( __DIR__ . '/widgets/post-cards/post-cards.php' );
		require_once( __DIR__ . '/widgets/post-grid/post-grid.php' );
		require_once( __DIR__ . '/widgets/post-hero/post-hero.php' );
		require_once( __DIR__ . '/widgets/post-mosaic/post-mosaic.php' );
		require_once( __DIR__ . '/widgets/post-carousel/post-carousel.php' );
		require_once( __DIR__ . '/widgets/post-slider/post-slider.php' );
		require_once( __DIR__ . '/widgets/event-list/event-list.php' );
		require_once( __DIR__ . '/widgets/event-featured/event-featured.php' );
		require_once( __DIR__ . '/widgets/event-countdown/event-countdown.php' );
		require_once( __DIR__ . '/widgets/radiofeed/radiofeed.php' );
		require_once( __DIR__ . '/widgets/artwork/artwork.php' );
		require_once( __DIR__ . '/widgets/onair/onair.php' );
		require_once( __DIR__ . '/widgets/upcoming-shows-carousel/upcoming-shows-carousel.php' );
		require_once( __DIR__ . '/widgets/upcoming-shows-slider/upcoming-shows-slider.php' );
		require_once( __DIR__ . '/widgets/schedule/schedule.php' );
		require_once( __DIR__ . '/widgets/radiocard/radiocard.php' );
		require_once( __DIR__ . '/widgets/qt-video/qt-video.php' );
		require_once( __DIR__ . '/widgets/cf7/cf7.php' );
	}
 
	/**
	 * Register Widgets
	 *
	 * Register new Elementor widgets.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function register_widgets() {
		// Register Widgets
		$this->include_widgets_files();
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\ProradioElementor3dHeader() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\ProradioElementorPricingTable() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\ProradioElementorAppIcons() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\ProradioElementorSocialIcons() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\ProradioElementorButton() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\ProradioElementorCaption() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\ProradioElementorSpacer() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\ProradioElementorSponsors() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\ProradioElementorSectionCaption() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\ProradioElementorCardsHorizontal() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\ProradioElementorCards() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\ProradioElementorBulletList() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\ProradioElementorGallery() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\ProradioElementorCategoryGrid() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\ProradioElementorChartTracklist() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\ProradioElementorPostInline() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\ProradioElementorPostListLarge() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\ProradioElementorPostListHorizontal() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\ProradioElementorPostCards() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\ProradioElementorPostGrid() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\ProradioElementorPostHero() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\ProradioElementorPostCarousel() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\ProradioElementorPostMosaic() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\ProradioElementorPostSlider() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\ProradioElementorEventList() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\ProradioElementorEventFeatured() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\ProradioElementorEventCountdown() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\ProradioElementorRadiofeed() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\ProradioElementorArtwork() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\ProradioElementorOnair() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\ProradioElementorUpcomingShowsCarousel() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\ProradioElementorUpcomingShowsSlider() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\ProradioElementorSchedule() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\ProradioElementorRadioCard() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\ProradioElementorRadioCard() );
		if(function_exists('proradio_videogalleries_active')){
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\ProradioElementorQtVideo() );
		}
		// Contact form 7
		if(defined('WPCF7_VERSION')){
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\ProradioElementorCF7() );
		}
	}

	public function add_elementor_widget_categories($elements_manager ) {
		\Elementor\Plugin::instance()->elements_manager->add_category(
			'ProRadio',
			[
				'title' => esc_html__( 'ProRadio ', 'plugin-name' ),
				'icon' => 'fa fa-plug',
			]
		);
	}

	public function order_elementor_widget_categories(\Elementor\Elements_Manager $elements_manager ) {
		$category_prefix = 'aaa-';
		$elements_manager->add_category(
			$category_prefix . 'proradio',
			[
				'title' => esc_html__( 'ProRadio ', 'plugin-name' ),
				'icon' => 'fa fa-plug',
			]
		);
		//hack into the private $categories member, and reorder it so our stuff is at the top
		$reorder_cats = function() use($category_prefix){
			uksort($this->categories, function($keyOne, $keyTwo) use($category_prefix){
				if(substr($keyOne, 0, 4) == $category_prefix){
					return -1;
				}
				if(substr($keyTwo, 0, 4) == $category_prefix){
					return 1;
				}
				return 0;
			});

		};
		$reorder_cats->call($elements_manager);
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
		add_action( 'elementor/elements/categories_registered', [ $this, 'order_elementor_widget_categories' ], 0 );
		// Register widget scripts
		add_action( 'elementor/frontend/after_register_scripts', [ $this, 'widget_scripts' ] );
		// Register widgets
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'register_widgets' ] );
		// custom styling
		add_action('elementor/editor/before_enqueue_scripts', [ $this, 'enqueue_styles' ] );
	}
}
 
// Instantiate Plugin Class
Plugin::instance();

