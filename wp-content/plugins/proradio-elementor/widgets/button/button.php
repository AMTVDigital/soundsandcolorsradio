<?php
/**
 * @source  https://developers.elementor.com/elementor-controls/
 * @author  Pro.Radio
 * @package  Elementor Proradio
 * @version  2.0.1
 */


namespace ProradioElementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Control_Dimensions;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class ProradioElementorButton extends Widget_Base {
	public function get_name() {
		return 'proradio-elementor-button'; // need to use same ID in the script js
	}
	public function get_title() {
		return esc_html__( 'Button', 'elementor-proradio' );
	}
	public function get_icon() {
		return 'proradio-elementor-icons icon-prel-button';
	}
	public function get_categories() {
		return [ 'aaa-proradio' ]; // needs to be registered in _plugin.php
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'section_button',
			[
				'label' => esc_html__( 'Button', 'elementor-proradio' ),
			]
		);
			
			$this->add_control(
				'text',
				[
					'label' => esc_html__( 'Button label', 'elementor-proradio' ),
					'type' => Controls_Manager::TEXT,
				]
			);

			$this->add_control(
				'playradio',
				[
					'label' => esc_html__( 'Play radio channel', 'proradio-elementor' ),
					'type' => Controls_Manager::SWITCHER,
					'return_value' => '1',
					// 'default' => '0',
				]
			);

			$this->add_control(
				'radio_id',
				[
					'label' => esc_html__( 'Play a radio channel on click', 'elementor-proradio' ),
					'type' => \Elementor\Controls_Manager::SELECT2,
					'label_block' => true,
					'multiple' => false,
					'options' => elementor_proradio_autocomplete('radiochannel'),
					'condition' => [
						'playradio' => '1',
					],
				]
			);


			// $this->add_control(
			// 	'proradio_showicon',
			// 	[
			// 		'label' => esc_html__( 'Add icon', 'proradio-elementor' ),
			// 		'type' => Controls_Manager::SWITCHER,
			// 		'return_value' => '1',
			// 		'default' => false,
			// 		'condition' => [
			// 			'playradio' => '1',
			// 		],
			// 	]
			// );



			


			$this->add_control(
				'link',
				[
					'label' => esc_html__( 'Button link', 'elementor-proradio' ),
					'type' => Controls_Manager::TEXT,
					'condition' => [
						'playradio!' => '1',
					],
				]
			);

			

			
			$this->add_control(
				'target',
				[
					'label' => esc_html__( 'Button target', 'elementor-proradio' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'multiple' => false,
					'condition' => [
						'playradio!' => '1',
					],
					'options' =>[
						'' => esc_html__('Default', 'elementor-proradio'),
						'_blank' => esc_html__('New tab', 'elementor-proradio'),
						'popup' => esc_html__('Popup', 'elementor-proradio')
					]
				]
			);

			$this->add_responsive_control(
				'popup_w',
				[
					'label' => __( 'Popup width', 'elementor-proradio' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 180,
							'max' => 1600,
						],
					],
					'default' => [
						'unit' => 'px',
						'size' => 300,
					],
					'devices' => [ 'desktop' ],
			
					'conditions' => [
						'relation' => 'and',
						'terms' => [
							[
								'name' => 'target',
								'operator' => '==',
								'value' => 'popup'
							],
							[
								'name' => 'playradio',
								'operator' => '!=',
								'value' => '1'
							]
						]
					]
				]
			);
			$this->add_responsive_control(
				'popup_h',
				[
					'label' => __( 'Popup height', 'elementor-proradio' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 180,
							'max' => 1600,
						],
					],
					'default' => [
						'unit' => 'px',
						'size' => 300,
					],
					'devices' => [ 'desktop' ],
					'conditions' => [
						'relation' => 'and',
						'terms' => [
							[
								'name' => 'target',
								'operator' => '==',
								'value' => 'popup'
							],
							[
								'name' => 'playradio',
								'operator' => '!=',
								'value' => '1'
							]
						]
					]
				]
			);

			$this->add_control(
				'style',
				[
					'label' => esc_html__( 'Style', 'elementor-proradio' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'multiple' => false,
					'options' =>[
						"proradio-btn-default" 	=> 	esc_html__( "Default","elementor-proradio"),
						"proradio-btn-primary" 	=> 	esc_html__( "Primary","elementor-proradio"),
						"proradio-btn__white" 	=> 	esc_html__( "White","elementor-proradio"),
						"proradio-btn__bold" 	=> 	esc_html__( "Bold","elementor-proradio"),
						"proradio-btn__txt" 	=> 	esc_html__( "Text only","elementor-proradio")
					]
				]
			);

			$this->add_control(
				'alignment',
				[
					'label' => esc_html__( 'Alignment', 'elementor-proradio' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'multiple' => false,
					'options' =>[
						'' => esc_html__( "Default", "proradio"),
						'alignleft' 	=>	esc_html__( "Left", "elementor-proradio"),
						'alignright'	=>	esc_html__( "Right", "elementor-proradio"),
						'aligncenter'	=>	esc_html__( "Center", "elementor-proradio"),
					]
				]
			);
			$this->add_control(
				'css_class',
				[
					'label' => esc_html__( 'CSS Class', 'elementor-proradio' ),
					'type' => Controls_Manager::TEXT,
				]
			);
		$this->end_controls_section();








		$this->start_controls_section(
			'proradio_section_button_design',
			[
				'label' => esc_html__( 'Design', 'elementor-proradio' ),
			]
		);

			$this->add_responsive_control(
				'btn-size',
				[
					'label' => esc_html__( 'Size', 'elementor-proradio' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 32,
						],
					],
					'devices' => [ 'desktop', 'tablet', 'mobile' ],
					'selectors' => [
						'{{WRAPPER}} .proradio-btn' => 'font-size: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'btn-padding',
				[
					'label' => esc_html__( 'Padding', 'elementor-proradio' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 32,
						],
					],
					'devices' => [ 'desktop', 'tablet', 'mobile' ],
					'selectors' => [
						'{{WRAPPER}} .proradio-btn' => 'padding: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'btn-radius',
				[
					'label' => esc_html__( 'Border-radius', 'elementor-proradio' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'devices' => [ 'desktop', 'tablet', 'mobile' ],
					'selectors' => [
						'{{WRAPPER}} .proradio-btn' => 'border-radius: {{SIZE}}{{UNIT}};',
					],
				]
			);
		$this->end_controls_section();

		/**
		 * Colors
		 */
		$this->start_controls_section(
			'section_button_col',
			[
				'label' => esc_html__( 'Colors', 'elementor-proradio' ),
			]
		);
			$this->add_control(
				'proradio-btn-bg',
				[
					'label' => esc_html__( 'Background', 'elementor-proradio' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .proradio-btn' => 'background-color: {{VALUE}} !important;',
					],
				]
			);
			$this->add_control(
				'proradio-btn-txt',
				[
					'label' => esc_html__( 'Text color', 'elementor-proradio' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .proradio-btn' => 'color: {{VALUE}} !important;',
					]
				]
			);

			$this->add_control(
				'proradio-btn-icon',
				[
					'label' => esc_html__( 'Icon color', 'elementor-proradio' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} i' => 'color: {{VALUE}} !important;',
					],
					'condition' => [
						'proradio_showicon' => '1',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Border::get_type(),
				[
					'name' => 'border',
					'label' => __( 'Border', 'plugin-domain' ),
					'selector' => '{{WRAPPER}} .proradio-btn',
				]
			);

			

		$this->end_controls_section();

		/**
		 * Colors hover
		 */
		$this->start_controls_section(
			'section_button_col_h',
			[
				'label' => esc_html__( 'Colors hover', 'elementor-proradio' ),
			]
		);
			$this->add_control(
				'proradio-btn-bgh',
				[
					'label' => esc_html__( 'Background hover', 'elementor-proradio' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .proradio-btn:hover' => 'background-color: {{VALUE}} !important;',
					]
				]
			);
			$this->add_control(
				'proradio-btn-bch',
				[
					'label' => esc_html__( 'Border hover', 'elementor-proradio' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .proradio-btn:hover' => 'border-color: {{VALUE}} !important;',
					]
				]
			);
			$this->add_control(
				'proradio-btn-txthov',
				[
					'label' => esc_html__( 'Text color hover', 'elementor-proradio' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .proradio-btn:hover' => 'color: {{VALUE}} !important;',
					]
				]
			);
			$this->add_control(
				'proradio-btn-iconh',
				[
					'label' => esc_html__( 'Icon color hover', 'elementor-proradio' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .proradio-btn:hover .proradio-btn__icon ' => 'color: {{VALUE}} !important;',
					],
					'condition' => [
						'proradio_showicon' => '1',
					],
				]
			);

		$this->end_controls_section();

	}

	/**
	 * Frontend
	 */
	protected function render() {
		if(function_exists('proradio_template_button')){
			echo proradio_template_button( $this->get_settings_for_display() );
		}
	}
	
	protected function _content_template() {}
}