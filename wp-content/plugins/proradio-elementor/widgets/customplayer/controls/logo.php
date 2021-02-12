<?php  
namespace ProradioElementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\SGroup_Control_Background;

$this->start_controls_section(
	'pr_logo_section',
	[
		'label' => esc_html__( 'Custom logo', 'proradio-elementor' ),
	]
);


// option 1: logo
$this->add_control(
	'pr_logo',
	[
		'label' => esc_html__( 'Logo', 'proradio-elementor' ),
		'type' => \Elementor\Controls_Manager::MEDIA,
		
	]
);

$this->add_control(
	'pr_logo_alignment',
	[
		'label' => esc_html__( 'Alignment', 'elementor-proradio' ),
		'type' => \Elementor\Controls_Manager::SELECT,
		'multiple' => false,
		'options' =>[
			'' => esc_html__( "Default", "proradio"),
			'left' 	=>	esc_html__( "Left", "elementor-proradio"),
			'right'	=>	esc_html__( "Right", "elementor-proradio"),
			'center'	=>	esc_html__( "Center", "elementor-proradio"),
		],
		'selectors' => [
			'{{WRAPPER}} .proradio-customplayer__logo' =>'text-align: {{VALUE}};align-items:  {{VALUE}};justify-content:  {{VALUE}};',
		],
	]
);
$this->add_responsive_control(
	'pr_logo_padding',
	[
		'label' => __( 'Padding', 'kentha-elementor' ),
		'type' => Controls_Manager::DIMENSIONS,
		'size_units' => [ 'px', 'em', '%' ],
		'default' =>[
			'top' => 0,
			'right' => 0,
			'bottom' => 0,
			'left' => 0,
			'isLinked' => false,
			],
		'selectors' => [
			'{{WRAPPER}} .proradio-customplayer__logo' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		],
	]
);

$this->add_responsive_control(
	'pr_logo-size',
	[
		'label' => esc_html__( 'Size', 'elementor-proradio' ),
		'type' => \Elementor\Controls_Manager::SLIDER,
		'range' => [
			'px' => [
				'min' => 20,
				'max' => 1000,
			],
		],
		'devices' => [ 'desktop', 'tablet', 'mobile' ],
		'desktop_default' => [
			'size' => 200,
			'unit' => 'px',
		],
		'tablet_default' => [
			'size' => 200,
			'unit' => 'px',
		],
		'mobile_default' => [
			'size' => 200,
			'unit' => 'px',
		],
		'selectors' => [
			'{{WRAPPER}} .proradio-customplayer__logo  img' => 'max-width: {{SIZE}}{{UNIT}};',
		],
	]
);

$this->add_responsive_control(
	'pr_logo-radius',
	[
		'label' => esc_html__( 'Border radius', 'elementor-proradio' ),
		'type' => \Elementor\Controls_Manager::SLIDER,
		'range' => [
			'px' => [
				'min' => 0,
				'max' => 500,
			],
		],
		'devices' => [ 'desktop', 'tablet', 'mobile' ],
		'desktop_default' => [
			'size' => 5,
			'unit' => 'px',
		],
		'tablet_default' => [
			'size' => 5,
			'unit' => 'px',
		],
		'mobile_default' => [
			'size' => 5,
			'unit' => 'px',
		],
		'selectors' => [
			'{{WRAPPER}} .proradio-customplayer__logo  img' => 'border-radius: {{SIZE}}{{UNIT}};',
		],
	]
);

$this->end_controls_section();
