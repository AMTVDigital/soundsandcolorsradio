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


class ProradioElementorUpcomingShowsSlider extends Widget_Base {
	public function get_name() {
		return 'proradio-elementor-upcoming-shows-slider'; // need to use same ID in the script js
	}
	public function get_title() {
		return esc_html__( 'Upcoming shows slider', 'proradio-elementor' );
	}
	public function get_icon() {
		return 'proradio-elementor-icons icon-prel-shows-slider';
	}
	public function get_categories() {
		return [ 'aaa-proradio' ]; // needs to be registered in _plugin.php
	}
	// Javascript
	public function __construct($data = [], $args = null) {
      parent::__construct($data, $args);
      wp_register_script( 'proradio-elementor-upcoming-shows-slider', plugins_url( '/upcoming-shows-slider.js', __FILE__ ), [ 'elementor-frontend' ], '1.0.0', true );
   	}
 	public function get_script_depends() {
	     return [ 'proradio-elementor-upcoming-shows-slider' ];
	}


	protected function _register_controls() {


		/**
		 * ======================================
		 * Section:
		 * Slider parameters
		 * ======================================
		 */
		$this->start_controls_section(
			'proradio_elementor_section_slider_global',
			[
				'label' => esc_html__( 'Settings', 'proradio-elementor' ),
			]
		);

			$this->add_responsive_control(
				'proradio-captionsize',
				[
					'label' => esc_html__( 'Caption size', 'elementor-proradio' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 20,
							'max' => 90,
						],
					],
					'devices' => [ 'desktop', 'tablet', 'mobile' ],
					'desktop_default' => [
						'size' => 45,
						'unit' => 'px',
					],
					'tablet_default' => [
						'size' => 37,
						'unit' => 'px',
					],
					'mobile_default' => [
						'size' => 27,
						'unit' => 'px',
					],
					'selectors' => [
						'{{WRAPPER}} .proradio-post__title  ' => 'font-size: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'proradio-sliderheigh',
				[
					'label' => esc_html__( 'Height', 'elementor-proradio' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 250,
							'max' => 1200,
						],
					],
					'devices' => [ 'desktop', 'tablet', 'mobile' ],
					'desktop_default' => [
						'size' => 470,
						'unit' => 'px',
					],
					'tablet_default' => [
						'size' => 360,
						'unit' => 'px',
					],
					'mobile_default' => [
						'size' => 380,
						'unit' => 'px',
					],
					'selectors' => [
						'#proradio-body .proradio-master {{WRAPPER}} .proradio-slider__item ' => 'min-height: {{SIZE}}{{UNIT}};',
					],
				]
			);


			// vertical padding
			$this->add_responsive_control(
				'proradio-slider-pad-v',
				[
					'label' => esc_html__( 'Vertical padding', 'elementor-proradio' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 300,
						],
					],
					'devices' => [ 'desktop', 'tablet', 'mobile' ],
					'desktop_default' => [
						'size' => 50,
						'unit' => 'px',
					],
					'tablet_default' => [
						'size' => 40,
						'unit' => 'px',
					],
					'mobile_default' => [
						'size' => 30,
						'unit' => 'px',
					],
					'selectors' => [
						'#proradio-body .proradio-master  {{WRAPPER}} .proradio-slider__c .proradio-container ' => 'padding-top: {{SIZE}}{{UNIT}};padding-bottom: {{SIZE}}{{UNIT}};',
					],
				]
			);
			// vertical padding
			$this->add_responsive_control(
				'proradio-slider-pad-h',
				[
					'label' => esc_html__( 'Horizontal padding', 'elementor-proradio' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 140,
						],
					],
					'devices' => [ 'desktop', 'tablet', 'mobile' ],
					'desktop_default' => [
						'size' => 40,
						'unit' => 'px',
					],
					'tablet_default' => [
						'size' => 30,
						'unit' => 'px',
					],
					'mobile_default' => [
						'size' => 20,
						'unit' => 'px',
					],
					'selectors' => [
						'#proradio-body .proradio-master  {{WRAPPER}} .proradio-slider .owl-dots ' => 'padding-left: {{SIZE}}{{UNIT}} !important;padding-right: {{SIZE}}{{UNIT}} !important;',
						'#proradio-body .proradio-master  {{WRAPPER}} .proradio-slider__c .proradio-container ' => 'padding-left: {{SIZE}}{{UNIT}};padding-right: {{SIZE}}{{UNIT}};',
					],
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
					'max' => 6,
					'step' => 1,
					'default' => 5,
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
		if(function_exists('proradio_upcoming_shows_slider')){
			echo proradio_upcoming_shows_slider( $atts );
		}
	}
	protected function _content_template() {}
}