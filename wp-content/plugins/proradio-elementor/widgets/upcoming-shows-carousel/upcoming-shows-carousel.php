<?php
/**
 * @source  https://developers.elementor.com/elementor-controls/
 * @author  Pro.Radio
 * @package  Elementor Proradio
 * @version  1.0.0
 */


namespace ProradioElementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class ProradioElementorUpcomingShowsCarousel extends Widget_Base {
	public function get_name() {
		return 'proradio-elementor-upcoming-shows-carousel'; // need to use same ID in the script js
	}
	public function get_title() {
		return esc_html__( 'Upcoming shows carousel', 'proradio-elementor' );
	}
	public function get_icon() {
		return 'proradio-elementor-icons icon-prel-shows-carousel';
	}
	public function get_categories() {
		return [ 'aaa-proradio' ]; // needs to be registered in _plugin.php
	}
	// Javascript
	public function __construct($data = [], $args = null) {
      parent::__construct($data, $args);
      wp_register_script( 'proradio-elementor-upcoming-shows-carousel', plugins_url( '/upcoming-shows-carousel.js', __FILE__ ), [ 'elementor-frontend' ], '1.0.0', true );
   	}
 	public function get_script_depends() {
	     return [ 'proradio-elementor-upcoming-shows-carousel' ];
	}
	protected function _register_controls() {
		/**
		 * ======================================
		 * Section:
		 * Slider parameters
		 * ======================================
		 */
		$this->start_controls_section(
			'proradio_elementor_section_carousel_global',
			[
				'label' => esc_html__( 'Settings', 'proradio-elementor' ),
			]
		);
		// Important::::::::::::::::::::::::::::::::::::
		// Fields added by carousel-fields.php
		// :::::::::::::::::::::::::::::::::::::::::::::
		$this->end_controls_section();

		/**
		 * ======================================
		 * Section:
		 * Query parameters
		 * ======================================
		 */
		
		$this->start_controls_section(
			'proradio_elementor_query',
			[
				'label' => esc_html__( 'Filters', 'proradio-elementor' ),
			]
		);
			$this->add_control(
				'quantity',
				[
					'label' => esc_html__( 'Max items', 'proradio-elementor' ),
					'type' => Controls_Manager::NUMBER,
					'min' => 3,
					'max' => 16,
					'step' => 1,
					'default' => 9,
				]
			);
			$this->add_control(
				'schedulefilter',
				[
					'label' => esc_html__( 'Schedule filters', 'proradio-elementor' ),
					'type' => \Elementor\Controls_Manager::SELECT2,
					'label_block' => true,
					'options' => proradio_elementor_get_terms_array( 'schedulefilter' )
				]
			);
			// Important::::::::::::::::::::::::::::::::::::
			// Fields added by query-fields.php
			// :::::::::::::::::::::::::::::::::::::::::::::
		$this->end_controls_section();
	}
	/**
	 * Frontend
	 */
	protected function render() {
		$atts = $this->get_settings_for_display();
		if(array_key_exists('schedulefilter', $atts)){
			if(is_array($atts['schedulefilter'])) {
				$atts['schedulefilter'] = implode(',', $atts['schedulefilter']);
			}
		}
		if(function_exists('proradio_upcoming_shows_carousel')){
			echo proradio_upcoming_shows_carousel( $atts );
		}
	}
	protected function _content_template() {}
}