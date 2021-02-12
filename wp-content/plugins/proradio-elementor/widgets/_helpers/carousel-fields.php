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

	if( $section_id == 'proradio_elementor_section_carousel_global' ){
		$section->add_control(
			'items_per_row_desktop',
			[
				'label' => esc_html__( 'Items per row', 'proradio-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'multiple' => false,
				'default' => '3',
				'options' =>[
					'1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6'
				]
			]
		);
		$section->add_control(
			'items_per_row_tablet',
			[
				'label' => esc_html__( 'Items per row tablet', 'proradio-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'multiple' => false,
				'default' => '2',
				'options' =>[
					'1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6'
				]
			]
		);

		$section->add_control(
			'items_per_row_mobile',
			[
				'label' => esc_html__( 'Items per row mobile', 'proradio-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'multiple' => false,
				'default' => '1',
				'options' =>[
					'1'=>'1','2'=>'2','3'=>'3','4'=>'4'
				]
			]
		);

		$section->add_control(
			'gap',
			[
				'label' => esc_html__( 'Gap', 'proradio-elementor' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 30,
				'step' => 1,
				'default' => 15
			]
		);
		$section->add_control(
			'proradio-items-padding',
			[
				'label' => esc_html__( 'Padding', 'proradio-elementor' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 40,
				'step' => 1,
				'selectors' => [
					'{{WRAPPER}} .proradio-owl-carousel-container ' => 'margin: -{{SIZE}}px !important;',
					'{{WRAPPER}} .owl-item ' => 'padding: {{SIZE}}px;',
				],
			]
		);
		$section->add_control(
			'proradio-border-radius',
			[
				'label' => esc_html__( 'Border radius', 'proradio-elementor' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 30,
				'step' => 1,
				'selectors' => [
					'{{WRAPPER}} .proradio-post, {{WRAPPER}} .proradio-bgimg, {{WRAPPER}} .proradio-post__header' => 'border-radius: {{SIZE}}px;',
				],
			]
		);

		$section->add_control(
			'autoplay_timeout',
			[
				'label' => esc_html__( 'Autoplay timeout', 'proradio-elementor' ),
				'description' => esc_html__( '0 = disabled', 'proradio-elementor' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 60000,
				'step' => 1000,
				'default' => 4000
			]
		);

		$section->add_control(
			'pause_on_hover',
			[
				'label' => esc_html__( 'Pause on hover', 'proradio-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'true',
			]
		);
		$section->add_control(
			'loop',
			[
				'label' => esc_html__( 'Loop', 'proradio-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'true',
			]
		);
		$section->add_control(
			'center',
			[
				'label' => esc_html__( 'Center', 'proradio-elementor' ),
				'type' => Controls_Manager::SWITCHER,
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

	}
}, 10, 3 );