<?php  
namespace ProradioElementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\SGroup_Control_Background;

/**
*	===========================================
*	Container
*	===========================================
*/
$this->start_controls_section(
	'pr_container_style',
	[
		'label' => esc_html__( 'Styling', 'proradio-elementor' ),
	]
);
	

	$this->add_control(
		'pr_customplayer_layout',
		[
			'label' => esc_html__( 'Global layout', 'elementor-proradio' ),
			'type' => \Elementor\Controls_Manager::SELECT,
			'multiple' => false,
			'default' => 'row',
			'options' =>[
				'row' => esc_html__( "Horizontal bar", "proradio"),
				'column' 	=>	esc_html__( "Vertical card", "elementor-proradio"),
			],
			'selectors' => [
				'{{WRAPPER}} .proradio-customplayer .proradio-customplayer__cont  ' => 'flex-direction: {{VALUE}};',
			],
		]
	);



	$this->add_responsive_control(
		'pr_height',
		[
			'label' => esc_html__( 'Height', 'elementor-proradio' ),
			'type' => \Elementor\Controls_Manager::SLIDER,
			'range' => [
				'px' => [
					'min' => 40,
					'max' => 1000,
				],
			],
			'devices' => [ 'desktop', 'tablet', 'mobile' ],
			'desktop_default' => [
				'size' => 80,
				'unit' => 'px',
			],
			'tablet_default' => [
				'size' => 80,
				'unit' => 'px',
			],
			'mobile_default' => [
				'size' => 80,
				'unit' => 'px',
			],
			'selectors' => [
				'{{WRAPPER}} .proradio-customplayer ' => 'height: {{SIZE}}{{UNIT}};',
			],
		]
	);
	$this->add_responsive_control(
		'pr_width',
		[
			'label' => esc_html__( 'Width', 'elementor-proradio' ),
			'type' => \Elementor\Controls_Manager::SLIDER,
			'range' => [
				'px' => [
					'min' => 50,
					'max' => 3000,
				],
			],
			'devices' => [ 'desktop', 'tablet', 'mobile' ],
			'desktop_default' => [
				'size' => 500,
				'unit' => 'px',
			],
			'tablet_default' => [
				'size' => 400,
				'unit' => 'px',
			],
			'mobile_default' => [
				'size' => 240,
				'unit' => 'px',
			],
			'selectors' => [
				'{{WRAPPER}} .proradio-customplayer ' => 'width: {{SIZE}}{{UNIT}};',
			],
		]
	);
	$this->add_responsive_control(
		'pr_maxwidth',
		[
			'label' => esc_html__( 'Max width', 'elementor-proradio' ),
			'type' => \Elementor\Controls_Manager::SLIDER,
			'range' => [
				'%' => [
					'min' => 10,
					'max' => 100,
				],
			],
			'devices' => [ 'desktop', 'tablet', 'mobile' ],
			'desktop_default' => [
				'size' => 100,
				'unit' => '%',
			],
			'tablet_default' => [
				'size' => 100,
				'unit' => '%',
			],
			'mobile_default' => [
				'size' => 100,
				'unit' => '%',
			],
			'selectors' => [
				'{{WRAPPER}} .proradio-customplayer ' => 'max-width: {{SIZE}}{{UNIT}};',
			],
		]
	);

	$this->add_group_control(
		\Elementor\Group_Control_Background::get_type(),
		[
			'name' => 'pr_customplayer_bg',
			'label' => esc_html__( 'Background', 'plugin-domain' ),
			'types' => [ 'classic', 'gradient' ],
			'selector' => '{{WRAPPER}}  .proradio-customplayer',
		]
	);

	$this->add_control(
		'pr_customplayer_tcolor',
		[
			'label' => esc_html__( 'Text color', 'elementor-proradio' ),
			'type' => \Elementor\Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .proradio-customplayer *' => 'color: {{VALUE}};',
			]
		]
	);

	$this->add_responsive_control(
		'pr_padding',
		[
			'label' => __( 'Padding', 'kentha-elementor' ),
			'type' => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'default' =>[
				'top' => 14,
				'right' => 14,
				'bottom' => 14,
				'left' => 14,
				'isLinked' => true,
				],
			'selectors' => [
				'{{WRAPPER}} .proradio-customplayer' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]
	);

	$this->add_responsive_control(
		'pr_radius',
		[
			'label' => esc_html__( 'Border-radius', 'elementor-proradio' ),
			'type' => \Elementor\Controls_Manager::SLIDER,
			'range' => [
				'px' => [
					'min' => 0,
					'max' => 150,
				],
			],
			'devices' => [ 'desktop', 'tablet', 'mobile' ],
			'selectors' => [
				'{{WRAPPER}} .proradio-customplayer' => 'border-radius: {{SIZE}}{{UNIT}};',
			],
		]
	);

	$this->add_group_control(
		\Elementor\Group_Control_Border::get_type(),
		[
			'name' => 'border',
			'label' => esc_html__( 'Border', 'elementor-proradio' ),
			'selector' => '{{WRAPPER}} .proradio-customplayer',
		]
	);

	$this->add_group_control(
		\Elementor\Group_Control_Box_Shadow::get_type(),
		[
			'name' => 'box_shadow',
			'label' => __( 'Box Shadow', 'elementor-proradio' ),
			'selector' => '{{WRAPPER}} .proradio-customplayer',
		]
	);
	$this->end_controls_section();