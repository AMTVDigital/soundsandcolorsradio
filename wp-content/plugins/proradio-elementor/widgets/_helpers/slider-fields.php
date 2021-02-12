<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
 * Carousel design fields
*/

namespace ProradioElementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;


add_action('elementor/element/before_section_end', function( $section, $section_id, $args ) {

	if( $section_id == 'proradio_elementor_section_slider_global' ){
		

		$section->add_control(
			'autoplay_timeout',
			[
				'label' => esc_html__( 'Autoplay timeout', 'proradio-elementor' ),
				'description' => esc_html__( '0 = disabled', 'proradio-elementor' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 80000,
				'step' => 1000,
				'default' => 4000
			]
		);

		$section->add_control(
			'pause_on_hover',
			[
				'label' => esc_html__( 'Pause on hover', 'proradio-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'true',
				'return_value' => 'true',
			]
		);
		$section->add_control(
			'loop',
			[
				'label' => esc_html__( 'Loop', 'proradio-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'true',
				'return_value' => 'true',
			]
		);
		
		$section->add_control(
			'nav',
			[
				'label' => esc_html__( 'Arrows', 'proradio-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'proradio-elementor' ),
				'label_off' => esc_html__('Hide', 'proradio-elementor' ),
				'return_value' => 'true',
				'default' => 'true'
			]
		);
		$section->add_control(
			'dots',
			[
				'label' => esc_html__( 'Dots', 'proradio-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'proradio-elementor' ),
				'label_off' => esc_html__('Hide', 'proradio-elementor' ),
				'return_value' => 'true',
				'default' => 'true'
			]
		);
		$section->add_control(
			'fullheight',
			[
				'label' => esc_html__( 'Full height', 'proradio-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'true'
			]
		);
		$section->add_control(
			'fullwidth',
			[
				'label' => esc_html__( 'Full width', 'proradio-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'true'
			]
		);

	}
}, 10, 3 );