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


class ProradioElementorSpacer extends Widget_Base {
	public function get_name() {
		return 'proradio-elementor-spacer'; // need to use same ID in the script js
	}
	public function get_title() {
		return __( 'Responsive spacer', 'proradio-elementor' );
	}
	public function get_icon() {
		return 'proradio-elementor-icons icon-prel-spacer';
	}
	public function get_categories() {
		return [ 'proradio-elementor' ]; // needs to be registered in _plugin.php
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'section_settings',
			[
				'label' => esc_html__( 'Settings', 'proradio-elementor' ),
			]
		);	
			$this->add_control(
				'size',
				[
					'label' => esc_html__( 'Size', 'proradio-elementor' ),
					'description'=> esc_html__( 'The visual size depends on the screen size. Perfect for responsive design.', 'proradio-elementor' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => 'm',
					'options' =>[
						"xxs" => esc_html__( "XXS", 'proradio-elementor' ),
						"xs" => esc_html__( "XS", 'proradio-elementor' ),
						"s" =>	esc_html__( "S", 'proradio-elementor' ),
						"m" =>	esc_html__( "M", 'proradio-elementor' ),
						"l" =>	esc_html__( "L", 'proradio-elementor' ),
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
		if(function_exists('proradio_spacer')){
			echo proradio_spacer( $atts );
		}
	}

	
	protected function _content_template() {}
}