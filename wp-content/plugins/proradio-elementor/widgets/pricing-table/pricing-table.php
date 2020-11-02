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
use Elementor\Icons_Manager;
use Elementor\SGroup_Control_Background;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class ProradioElementorPricingTable extends Widget_Base {
	public function get_name() {
		return 'proradio-elementor-pricing-table'; // need to use same ID in the script js
	}
	public function get_title() {
		return esc_html__( 'Pricing table', 'proradio-elementor' );
	}
	public function get_icon() {
		return 'proradio-elementor-icons icon-prel-pricing-tables';
	}
	public function get_categories() {
		return [ 'aaa-proradio' ]; // needs to be registered in _plugin.php
	}

	protected function _register_controls() {

		/**
		 * ==================================
		 * General settings
		 * ==================================
		 */
		$this->start_controls_section(
			'section_settings',
			[
				'label' => esc_html__( 'General settings', 'proradio-elementor' ),
			]
		);
			// general
			

			

			$this->add_control(
				'elementor_icon',// https://crocoblock.com/how-to-add-custom-icons-to-elementor-and-jet-plugins/
				[
					'label' => esc_html__( 'Icon', 'proradio-elementor' ),
					'type' => Controls_Manager::ICONS,
				]
			);

			$this->add_control(
				'title',
				[
					'label' => esc_html__( 'Title', 'proradio-elementor' ),
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
			$this->add_control(
				'footertext',
				[
					'label' => esc_html__( 'Footer text', 'proradio-elementor' ),
					'type' => Controls_Manager::TEXT,
				]
			);
			$this->add_control(
				'featured',
				[
					'label' => esc_html__( 'Featured', 'proradio-elementor' ),
					'type' => Controls_Manager::SWITCHER,
					'return_value' => 'true',
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Background::get_type(),
				[
					'name' => 'card-background',
					'label' => esc_html__( 'Background', 'plugin-domain' ),
					'types' => [ 'classic', 'gradient' ],
					'selector' => '{{WRAPPER}}  .proradio-gradaccent, {{WRAPPER}} .proradio-gradprimary',
				]
			);
		$this->end_controls_section();

		/**
		 * ==================================
		 * Price
		 * ==================================
		 */
		$this->start_controls_section(
			'section_price',
			[
				'label' => esc_html__( 'Price settings', 'proradio-elementor' ),
			]
		);
			$this->add_control(
				'price',
				[
					'label' => esc_html__( 'Price', 'proradio-elementor' ),
					'type' => Controls_Manager::TEXT,
				]
			);
			$this->add_control(
				'cents',
				[
					'label' => esc_html__( 'Cents', 'proradio-elementor' ),
					'type' => Controls_Manager::TEXT,
				]
			);
			$this->add_control(
				'coin',
				[
					'label' => esc_html__( 'Coin symbol', 'proradio-elementor' ),
					'type' => Controls_Manager::TEXT,
				]
			);
			$this->add_control(
				'details',
				[
					'label' => esc_html__( 'Details', 'proradio-elementor' ),
					'type' => Controls_Manager::TEXT,
				]
			);
			
		$this->end_controls_section();


		/**
		 * ==================================
		 * FEATURES
		 * ==================================
		 */
		$this->start_controls_section(
			'section_items',
			[
				'label' => esc_html__( 'Items', 'proradio-elementor' ),
			]
		);
			$repeater = new \Elementor\Repeater();
			$repeater->add_control(
				'text',
				[
					'label' => esc_html__( 'Text', 'proradio-elementor' ),
					'show_label' => false,
					'label_block' => true,
					'placeholder' => esc_html__( 'Your list item', 'proradio-elementor' ),
					'type' => Controls_Manager::TEXT,
				]
			);
			$repeater->add_control(
				'icon',
				[
					'label' => esc_html__( 'Icon', 'proradio-elementor' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'options' =>[
						false => esc_html__( "Default","proradioelementor"),
						"check" =>			esc_html__( "check","proradioelementor") ,
						"close"=>			esc_html__( "close","proradioelementor"),
						"add"=>			esc_html__( "add","proradioelementor"),
						"chevron_right"=>			esc_html__( "chevron_right","proradioelementor"),
						
					],
				]
			);
			$repeater->add_control(
				'status',
				[
					'label' => esc_html__( 'Status', 'proradio-elementor' ),
					'description' 	=> esc_html__('Is this feature included in the plan?', 'proradio-elementor'),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'return_value' => 'true',
				]
			);
			$this->add_control(
				'items',
				[
					'label' => esc_html__( 'List', 'proradio-elementor' ),
					'show_label' => false,
					'prevent_empty' => false,
					'type' => \Elementor\Controls_Manager::REPEATER,
					'fields' => $repeater->get_controls()
				]
			);
		$this->end_controls_section();

		/**
		 * ==================================
		 * Button
		 * ==================================
		 */

		$this->start_controls_section(
			'section_button',
			[
				'label' => esc_html__( 'Button', 'proradio-elementor' ),
			]
		);
			$this->add_control(
				'btntext',
				[
					'label' => esc_html__( 'Button label', 'elementor-proradio' ),
					'type' => Controls_Manager::TEXT,
					'default' => esc_html__('Click here', 'elementor-proradio')
				]
			);
			$this->add_control(
				'btnlink',
				[
					'label' => esc_html__( 'Button link', 'elementor-proradio' ),
					'type' => Controls_Manager::TEXT,
				]
			);
			$this->add_control(
				'target',
				[
					'label' => esc_html__( 'Button target', 'elementor-proradio' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'options' =>[
						'_self' => esc_html__('Default', 'elementor-proradio'),
						'_blank' => esc_html__('New tab', 'elementor-proradio')
					]
				]
			);
		$this->end_controls_section();



	}

	/**
	 * Frontend
	 */
	protected function render() {
		$atts = $this->get_settings_for_display();
		if(function_exists('proradio_pricingtable')){
			echo proradio_pricingtable( $atts );
		}
	}
	
	protected function _content_template() {

	}
}









