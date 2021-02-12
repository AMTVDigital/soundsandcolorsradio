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


class ProradioElementorEventCountdown extends Widget_Base {
	public function get_name() {
		return 'proradio-elementor-event-countdown'; // need to use same ID in the script js
	}
	public function get_title() {
		return esc_html__( 'Countdown', 'proradio-elementor' );
	}
	public function get_icon() {
		return 'proradio-elementor-icons icon-prel-countdown';
	}
	public function get_categories() {
		return [ 'aaa-proradio' ]; // needs to be registered in _plugin.php
	}

	// Javascript
	public function __construct($data = [], $args = null) {
	  parent::__construct($data, $args);
	  wp_register_script( 'proradio-elementor-event-countdown', plugins_url( '/event-countdown.js', __FILE__ ), [ 'elementor-frontend' ], '1.0.0', true );
	}
	public function get_script_depends() {
		 return [ 'proradio-elementor-event-countdown' ];
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'proradio_elementor_section_query_events',
			[
				'label' => esc_html__( 'Query', 'proradio-elementor' ),
			]
		);	
			$this->add_control(
				'include_by_id',
				[
					'label' => esc_html__( 'Specific items by title', 'proradio-elementor' ),
					'type' => \Elementor\Controls_Manager::SELECT2,
					'label_block' => true,
					'multiple' => true,
					'options' => elementor_proradio_autocomplete('event')
				]
			);

			$this->add_control(
				'size',
				[
					'label' => esc_html__( 'Size', "elementor-proradio" ),
					'type' => \Elementor\Controls_Manager::NUMBER,
					'min' => 1,
					'max' => 10,
					'default' => 3
				]
			);


			$this->add_control(
				'align',
				[
					'label' => esc_html__( 'Align', "elementor-proradio" ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => 'center',
					'options' =>[
						'center'	=>esc_html__('center', 'proradio' ),
						'left'		=>esc_html__('left', 'proradio' ),
						'right'		=>esc_html__('right', 'proradio' ),
						'inline'	=>esc_html__('inline', 'proradio' ),
					]
				]
			);

			$this->add_control(
				'labels',
				[
					'label' 	=> esc_html__( 'Labels', "elementor-proradio" ),
					'type' 		=> \Elementor\Controls_Manager::SELECT,
					'default' 	=> false,
					'options' 	=>[
						false 		=> esc_html__('Hidden', 'proradio' ),
						'full' 		=> esc_html__('Full', 'proradio' ),
						'inline' 	=> esc_html__('Inline', 'proradio' ),
					]
				]
			);

			$this->add_control(
				'show_ms',
				[
					'label' 	=> esc_html__( 'Show milliseconds', 'proradio-elementor' ),
					'type' 		=> Controls_Manager::SWITCHER,
					'return_value' => 'true',
				]
			);

			$this->add_control(
				'style',
				[
					'label' 	=> esc_html__( 'Style', "proradioelementor" ),
					'type' 		=> \Elementor\Controls_Manager::SELECT,
					'default' 	=> 'default',
					'options' 	=> [
						'default' 	=> esc_html__('Default', 'proradio-elementor' ),
						'bricks' 	=> esc_html__('Bricks', 'proradio-elementor' ),
						'boxed' 	=> esc_html__('Boxed', 'proradio-elementor' ) 	
					]
				]
			);

			$this->add_control(
				'color_text',
				[
					'label' => esc_html__( 'Text color', 'proradio-elementor' ),
					'type' => \Elementor\Controls_Manager::COLOR
				]
			);
			$this->add_control(
				'color_border',
				[
					'label' => esc_html__( 'Border color', 'proradio-elementor' ),
					'type' => \Elementor\Controls_Manager::COLOR
				]
			);
			$this->add_control(
				'color_bg',
				[
					'label' => esc_html__( 'Countdown Background', 'proradio-elementor' ),
					'type' => \Elementor\Controls_Manager::COLOR
				]
			);
			$this->add_control(
				'color_bgn',
				[
					'label' => esc_html__( 'Numbers background', 'proradio-elementor' ),
					'type' => \Elementor\Controls_Manager::COLOR
				]
			);
		$this->end_controls_section();
	}

	/**
	 * Frontend
	 */
	protected function render() {
		$atts = $this->get_settings_for_display();
		if(function_exists('proradio_countdown_shortcode')){
			echo proradio_countdown_shortcode( $atts );
		}
	}
	protected function _content_template() {}
}