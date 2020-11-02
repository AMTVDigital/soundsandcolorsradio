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


class ProradioElementorSectionCaption extends Widget_Base {
	public function get_name() {
		return 'proradio-elementor-section-caption'; // need to use same ID in the script js
	}
	public function get_title() {
		return esc_html__( 'Section caption', 'proradio-elementor' );
	}
	public function get_icon() {
		return 'proradio-elementor-icons icon-prel-section-caption';
	}
	public function get_categories() {
		return [ 'aaa-proradio' ]; // needs to be registered in _plugin.php
	}

	// Javascript
	public function __construct($data = [], $args = null) {
	  parent::__construct($data, $args);
	  wp_register_script( 'elementor-proradio-section-caption', plugins_url( '/section-caption.js', __FILE__ ), [ 'elementor-frontend' ], '1.0.0', true );
	}
	public function get_script_depends() {
		 return [ 'elementor-proradio-section-caption' ];
	}

	protected function _register_controls() {


		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Content', 'proradio-elementor' ),
			]
		);

			

			
			$this->add_control(
				'caption',
				[
					'label' => esc_html__( 'Caption', 'proradio-elementor' ),
					'type' => Controls_Manager::TEXT,
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
							'max' => 130,
						],
					],
					'devices' => [ 'desktop', 'tablet', 'mobile' ],
					'selectors' => [
						'{{WRAPPER}} .proradio-capfont ' => 'font-size: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .proradio-txtfx ' => 'font-size: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'negative',
				[
					'label' => esc_html__( 'Intro text', 'proradio-elementor' ).': '.esc_html__( 'Negative colors', 'proradio-elementor' ),
					'type' => Controls_Manager::SWITCHER,
				]
			);
			$this->add_control(
				'intro',
				[
					'label' => esc_html__( 'Intro text', 'proradio-elementor' ),
					'type' => Controls_Manager::TEXT,
				]
			);
			$this->add_control(
				'subtitle',
				[
					'label' => esc_html__( 'Subtitle', 'proradio-elementor' ),
					'type' => Controls_Manager::TEXT,
				]
			);
		$this->end_controls_section();




		/**
		 * ============================================
		 * Section 
		 * Intro
		 * ============================================
		 */
		$this->start_controls_section(
			'section_intro',
			[
				'label' => esc_html__( 'Intro effect', 'proradio-elementor' ),
			]
		);	
			
			$this->add_control(
				'fx',
				[
					'label' => esc_html__( 'Effect', "elementor-proradio" ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'multiple' => false,
					'default' => 'oslo',
					'options' =>[
						"oslo" 		=> esc_html__( "Oslo", "elementor-proradio"),
						 "tokyo" 	=> esc_html__( "Tokyo", "elementor-proradio"),
						"london" 	=> esc_html__( "London", "elementor-proradio"),
						"paris" 	=> esc_html__( "Paris", "elementor-proradio"),
						"ibiza" 	=> esc_html__( "Ibiza", "elementor-proradio"),
						"newyork" 	=> esc_html__( "New York", "elementor-proradio")
					]
				]
			);
			$this->add_control(
				'color1',
				[
					'label' => esc_html__( 'Color 1', 'proradio-elementor' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'default' => '#dedede',
				]
			);
			$this->add_control(
				'color2',
				[
					'label' => esc_html__( 'Color 2', 'proradio-elementor' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'default' => '#999999',
				]
			);
			$this->add_control(
				'color3',
				[
					'label' => esc_html__( 'Color 3', 'proradio-elementor' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'default' => '#ff0000',
				]
			);
		$this->end_controls_section();

	}

	/**
	 * Frontend
	 */
	protected function render() {
		$atts = $this->get_settings_for_display();
		echo proradio_template_section_caption( $atts );
	}

	
	protected function _content_template() {}
}