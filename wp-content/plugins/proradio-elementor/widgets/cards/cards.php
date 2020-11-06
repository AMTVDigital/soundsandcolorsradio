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


class ProradioElementorCards extends Widget_Base {
	public function get_name() {
		return 'proradio-elementor-cards'; // need to use same ID in the script js
	}
	public function get_title() {
		return esc_html__( 'Card', 'proradio-elementor' );
	}
	public function get_icon() {
		return 'proradio-elementor-icons icon-prel-custom-card';
	}
	public function get_categories() {
		return [ 'aaa-proradio' ]; // needs to be registered in _plugin.php
	}
	protected function _register_controls() {


		/**
		 * ===========================
		 * SECTION
		 * Content
		 * ===========================
		 */
		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Content', 'proradio-elementor' ),
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
			
		$this->end_controls_section();

		/**
		 * ===========================
		 * SECTION
		 * Button
		 * ===========================
		 */
		$this->start_controls_section(
			'section_button',
			[
				'label' => esc_html__( 'Button', 'proradio-elementor' ),
			]
		);
			$this->add_control(
				'btntxt',
				[
					'label' => esc_html__( 'Button label', 'proradio-elementor' ),
					'type' => Controls_Manager::TEXT,
					'default' => esc_html__('Click here', 'proradio-elementor')
				]
			);
			$this->add_control(
				'btnlink',
				[
					'label' => esc_html__( 'Button link', 'proradio-elementor' ),
					'type' => Controls_Manager::TEXT,
				]
			);
			$this->add_control(
				'target',
				[
					'label' => esc_html__( 'Button target', 'proradio-elementor' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'multiple' => false,
					'options' =>[
						'' => esc_html__('Default', 'proradio-elementor'),
						'_blank' => esc_html__('New tab', 'proradio-elementor')
					]
				]
			);
			$this->add_control(
				'btnstyle',
				[
					'label' => esc_html__( 'Style', 'proradio-elementor' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'multiple' => false,
					'options' =>[
						"proradio-btn-default" 	=> 	esc_html__( "Default","proradioelementor"),
						"proradio-btn-primary" 	=> 	esc_html__( "Primary","proradioelementor"),
						"proradio-btn__white" 	=> 	esc_html__( "White","proradioelementor"),
						"proradio-btn__bold" 	=> 	esc_html__( "Bold","proradioelementor"),
						"proradio-btn__txt" 	=> 	esc_html__( "Text only","proradioelementor")
					]
				]
			);
		$this->end_controls_section();

		/**
		 * ===========================
		 * SECTION
		 * Background
		 * ===========================
		 */

		$this->start_controls_section(
			'section_design',
			[
				'label' => esc_html__( 'Design', 'proradio-elementor' ),
			]
		);			
			$this->add_control(
				'featured',
				[
					'label' => esc_html__( 'Featured', 'proradio-elementor' ),
					'type' => Controls_Manager::SWITCHER,
				]
			);
			$this->add_control(
				'format',
				[
					'label' => esc_html__( 'Format', 'proradio-elementor' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => 'def',
					'options' =>[
						'def' 	=>	esc_html__( "Default", "proradioelementor"),
						'sky'	=>	esc_html__( "Taller", "proradioelementor"),
					]
				]
			);
			$this->add_control(
				'order',
				[
					'label' => esc_html__( 'Order', 'proradio-elementor' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => false,
					'options' =>[
						false => esc_html__( "Image + Text","proradio"),
						"text-image" =>	esc_html__( "Text + Image","proradio")
					],
					'condition' => [
						'format' => 'sky',
					],
				]
			);
			$this->add_control(
				'img',
				[
					'label' => esc_html__( 'Image', 'proradio-elementor' ),
					'type' => \Elementor\Controls_Manager::MEDIA,
					"description"	=> esc_html__( "Squared, 370px", "proradioelementor"),
					'default' => [
						'url' => \Elementor\Utils::get_placeholder_image_src(),
					]
				]
			);
			$this->add_control(
				'bg',
				[
					'label' => esc_html__( 'Backgorund image', 'proradio-elementor' ),
					'type' => \Elementor\Controls_Manager::MEDIA,
					'default' => [
						'url' => \Elementor\Utils::get_placeholder_image_src(),
					]
				]
			);
			$this->add_control(
				'bgo',
				[
					'label' => esc_html__( 'Background opacity', 'proradio-elementor' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => false,
					'options' =>[
						false 	=>	esc_html__( "Full", "proradioelementor"),
						'half'	=>	esc_html__( "Half", "proradioelementor"),
						'low'	=>	esc_html__( "Low", "proradioelementor"),
					]
				]
			);
			
			
		$this->end_controls_section();
	}

	/**
	 * Frontend
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		$settings['img'] = $settings['img']['id'];
		$settings['bg'] = $settings['bg']['id'];
		if(function_exists('proradio_cards')){
			echo proradio_cards( $settings );
		}
	}
	
	protected function _content_template() {}
}