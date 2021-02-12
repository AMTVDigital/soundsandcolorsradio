<?php  
/**
*	===========================================
*	Position
*	===========================================
*/
namespace ProradioElementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\SGroup_Control_Background;
$this->start_controls_section(
	'pr_pos_section',
	[
		'label' => esc_html__( 'Position', 'proradio-elementor' ),
	]
);
	$this->add_control(
		'pr_positioning',
		[
			'label' => esc_html__( 'Positioning', 'elementor-proradio' ),
			'type' => \Elementor\Controls_Manager::SELECT,
			'multiple' => false,
			'options' =>[
				'' => esc_html__('Relative', 'elementor-proradio'),
				'absolute' => esc_html__('Absolute', 'elementor-proradio'),
				'fixed' => esc_html__('Fixed', 'elementor-proradio')
			],
			'selectors' => [
				'{{WRAPPER}} .proradio-customplayer ' => 'position: {{VALUE}};',
			],
		]
	);




	$this->add_responsive_control(
		'pr_positioning_top',
		[
			'label' => esc_html__( 'Top', 'elementor-proradio' ),
			'type' => \Elementor\Controls_Manager::SLIDER,
			'range' => [
				'px' => [
					'min' => 0,
					'max' => 3000,
				],
			],
			'devices' => [ 'desktop', 'tablet', 'mobile' ],
			'selectors' => [
				'{{WRAPPER}} .proradio-customplayer' => 'top: {{SIZE}}{{UNIT}};',
			],
		]
	);

	$this->add_responsive_control(
		'pr_positioning_bottom',
		[
			'label' => esc_html__( 'Bottom', 'elementor-proradio' ),
			'type' => \Elementor\Controls_Manager::SLIDER,
			'range' => [
				'px' => [
					'min' => 0,
					'max' => 3000,
				],
			],
			'devices' => [ 'desktop', 'tablet', 'mobile' ],
			'selectors' => [
				'{{WRAPPER}} .proradio-customplayer' => 'bottom: {{SIZE}}{{UNIT}};',
			],
		]
	);

	$this->add_responsive_control(
		'pr_positioning_right',
		[
			'label' => esc_html__( 'Right', 'elementor-proradio' ),
			'type' => \Elementor\Controls_Manager::SLIDER,
			'range' => [
				'px' => [
					'min' => 0,
					'max' => 3000,
				],
			],
			'devices' => [ 'desktop', 'tablet', 'mobile' ],
			'selectors' => [
				'{{WRAPPER}} .proradio-customplayer' => 'right: {{SIZE}}{{UNIT}};',
			],
		]
	);

	$this->add_responsive_control(
		'pr_positioning_left',
		[
			'label' => esc_html__( 'Left', 'elementor-proradio' ),
			'type' => \Elementor\Controls_Manager::SLIDER,
			'range' => [
				'px' => [
					'min' => 0,
					'max' => 3000,
				],
			],
			'devices' => [ 'desktop', 'tablet', 'mobile' ],
			'selectors' => [
				'{{WRAPPER}} .proradio-customplayer' => 'left: {{SIZE}}{{UNIT}};',
			],
		]
	);

	$this->end_controls_section();