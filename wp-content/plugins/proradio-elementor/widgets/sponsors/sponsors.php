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


class ProradioElementorSponsors extends Widget_Base {
	public function get_name() {
		return 'proradio-elementor-sponsors'; // need to use same ID in the script js
	}
	public function get_title() {
		return esc_html__( 'Sponsors carousel', 'proradio-elementor' );
	}
	public function get_icon() {
		return 'proradio-elementor-icons icon-prel-sponsor-carousel';
	}
	public function get_categories() {
		return [ 'aaa-proradio' ]; // needs to be registered in _plugin.php
	}
	public function __construct($data = [], $args = null) {
      parent::__construct($data, $args);
      wp_register_script( 'proradio-elementor-logo-carousel', plugins_url( '/carousel.js', __FILE__ ), [ 'elementor-frontend' ], '1.0.0', true );
   	}
 	public function get_script_depends() {
	     return [ 'proradio-elementor-logo-carousel' ];
	}
	protected function _register_controls() {


		/**
		 * ======================================
		 * Section:
		 * Carousel parameters
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
		
	}
	/**
	 * Frontend
	 */
	protected function render() {
		$atts = $this->get_settings_for_display();
		if(function_exists('proradio_sponsors_shortcode')){
			echo proradio_sponsors_shortcode( $atts );
		}
	}
	protected function _content_template() {}
}