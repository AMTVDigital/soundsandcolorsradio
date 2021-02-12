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


class ProradioElementorGallery extends Widget_Base {
	public function get_name() {
		return 'proradio-elementor-gallery'; // need to use same ID in the script js
	}
	public function get_title() {
		return esc_html__( 'ProRadio Gallery', 'proradio-elementor' );
	}
	public function get_icon() {
		return 'proradio-elementor-icons icon-prel-gallery';
	}
	public function get_categories() {
		return [ 'aaa-proradio' ]; // needs to be registered in _plugin.php
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'section_button',
			[
				'label' => esc_html__( 'Gallery', 'proradio-elementor' ),
			]
		);	
			$this->add_control(
				'thumbsize',
				[
					'label' => esc_html__( 'Image size', 'proradio-elementor' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'multiple' => false,
					'default' => 'm',
					'options' =>[
						'proradio-squared-s' => esc_html__( "Squared small", "proradioelementor"),
						'proradio-squared-m' => esc_html__( "Squared medium", "proradioelementor"),
						'thumbnail' => esc_html__( "Thumbnail", "proradioelementor"),
						'medium' => esc_html__( "Medium", "proradioelementor"),
						'large' => esc_html__( "Large", "proradioelementor"),
					]
				]
			);
			$this->add_control(
				'linksize',
				[
					'label' => esc_html__( 'Linked size', 'proradio-elementor' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'multiple' => false,
					'default' => 'large',
					'options' =>[
						'medium' => esc_html__( "Medium", "proradioelementor"),
						'large' => esc_html__( "Large", "proradioelementor"),
						'full' => esc_html__( "Full", "proradioelementor")
					]
				]
			);
			$this->add_control(
				'gallery',
				[
					'label' => esc_html__( 'Add Images', 'proradio-elementor' ),
					'type' => \Elementor\Controls_Manager::GALLERY,
				]
			);
		$this->end_controls_section();
	}

	/**
	 * Frontend
	 */
	protected function render() {
		$atts = $this->get_settings_for_display();
		if(function_exists('proradio_short_gallery')){
			echo proradio_short_gallery( $atts );
		}
	}
	protected function _content_template() {}
}