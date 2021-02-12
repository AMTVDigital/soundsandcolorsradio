<?php  
namespace ProradioElementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\SGroup_Control_Background;

$this->start_controls_section(
	'pr_player',
	[
		'label' => esc_html__( 'Song information', 'proradio-elementor' ),
	]
);

	
	$this->add_control(
		'pr_display_song_title',
		[
			'label' => esc_html__( 'Display song title', 'proradio-elementor' ),
			'type' => Controls_Manager::SWITCHER,
			'return_value' => '1',
		]
	);

	$this->add_group_control(
		Group_Control_Typography::get_type(),
		[
			'name' => 'pr_display_song_title_typo',
			'label' => esc_html__( 'Song typography', 'erplayer' ),
			'scheme' => Scheme_Typography::TYPOGRAPHY_1,
			'selector' => '{{WRAPPER}} .proradio-customplayer__song ',
			'exclude' => [],
			'condition' => [
				'pr_display_song_title' => '1',
			],
		]
	);

	$this->add_responsive_control(
		'pr_title_padding',
		[
			'label' => __( 'Song title padding', 'kentha-elementor' ),
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
				'{{WRAPPER}} .proradio-customplayer__song' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]
	);

	$this->add_control(
		'pr_title_color',
		[
			'label' => esc_html__( 'Song title color', 'elementor-proradio' ),
			'type' => \Elementor\Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .proradio-customplayer__song' => 'color: {{VALUE}} !important;',
			],
		]
	);

	$this->add_control(
		'pr_display_song_title_scroll',
		[
			'label' => esc_html__( 'Scroll text', 'proradio-elementor' ),
			'type' => Controls_Manager::SWITCHER,
			'return_value' => '1',
			'default' => '1',
			'condition' => [
				'pr_display_song_title' => '1',
			],
		]
	);


	$this->add_control(
		'pr_display_song_artwork',
		[
			'label' => esc_html__( 'Display song artwork (or radio logo)', 'proradio-elementor' ),
			'type' => Controls_Manager::SWITCHER,
			'return_value' => '1',
		]
	);

	$this->add_responsive_control(
		'pr_artwork-size',
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
				'size' => 50,
				'unit' => 'px',
			],
			'tablet_default' => [
				'size' => 50,
				'unit' => 'px',
			],
			'mobile_default' => [
				'size' => 50,
				'unit' => 'px',
			],
			'selectors' => [
				'{{WRAPPER}} .proradio-customplayer__art, {{WRAPPER}} .proradio-customplayer__art img  ' => 'max-width: {{SIZE}}{{UNIT}};height: auto;',


				// '{{WRAPPER}} .proradio-customplayer__song' => 'width: calc(100% - {{SIZE}}{{UNIT}} );'
			],

			'condition' => [
				'pr_display_song_artwork' => '1',
			],
		]
	);

	$this->add_responsive_control(
		'pr_artwork-radius',
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
				'{{WRAPPER}} .proradio-customplayer__art img  ' => 'border-radius: {{SIZE}}{{UNIT}};',
			],
			'condition' => [
				'pr_display_song_artwork' => '1',
			],
		]
	);


	$this->add_control(
		'pr_artwork-display-as',
		[
			'label' => esc_html__( 'Display as', 'elementor-proradio' ),
			'type' => \Elementor\Controls_Manager::SELECT,
			'multiple' => false,
			'default' => 'row',
			'options' =>[
				'row' => esc_html__( "Row", "proradio"),
				'column' 	=>	esc_html__( "Column", "elementor-proradio"),
			],
			'selectors' => [
				'{{WRAPPER}} .proradio-customplayer__info  ' => 'flex-direction: {{VALUE}};',
			],
		]
	);

	$this->add_control(
		'pr_artwork_alignment',
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
				'{{WRAPPER}} .proradio-customplayer__info  ' => 'text-align: {{VALUE}};',
				'{{WRAPPER}} .proradio-customplayer__info  ' =>'align-items:  {{VALUE}};justify-content:  {{VALUE}};',
			],
		]
	);

$this->end_controls_section();









