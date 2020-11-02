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
use Elementor\SGroup_Control_Background;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class ProradioElementorRadioCard extends Widget_Base {
	public function get_name() {
		return 'proradio-elementor-radiocard'; // need to use same ID in the script js
	}
	public function get_title() {
		return esc_html__( 'Radio card', 'proradio-elementor' );
	}
	public function get_icon() {
		return 'proradio-elementor-icons icon-prel-radio-card';
	}
	public function get_categories() {
		return [ 'aaa-proradio' ]; // needs to be registered in _plugin.php
	}

	// Controls
	protected function _register_controls() {
		$this->start_controls_section(
			'proradio_elementor_query',
			[
				'label' => esc_html__( 'Settings', 'proradio-elementor' ),
			]
		);
			$this->add_control(
				'include_by_id',
				[
					'label' => esc_html__( 'Choose radio', 'proradio-elementor' ),
					'type' => \Elementor\Controls_Manager::SELECT2,
					'label_block' => true,
					'multiple' => false,
					'options' => elementor_proradio_autocomplete('radiochannel')
				]
			);


			$this->add_responsive_control(
				'proradio-height',
				[
					'label' => esc_html__( 'Height', 'elementor-proradio' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 240,
							'max' => 650,
						],
					],
					'devices' => [ 'desktop', 'tablet', 'mobile' ],
					'desktop_default' => [
						'size' => 370,
						'unit' => 'px',
					],
					'tablet_default' => [
						'size' => 322,
						'unit' => 'px',
					],
					'mobile_default' => [
						'size' => 280,
						'unit' => 'px',
					],
					'selectors' => [
						'{{WRAPPER}} .proradio-post__card--radio ' => 'min-height: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_group_control(
				\Elementor\Group_Control_Background::get_type(),
				[
					'name' => 'card-background',
					'label' => esc_html__( 'Background', 'plugin-domain' ),
					'types' => [ 'classic', 'gradient' ],
					'selector' => '{{WRAPPER}}  .proradio-bgimg',
				]
			);
		$this->end_controls_section();
	}
	/**
	 * Frontend
	 */
	protected function render() {
		$atts = $this->get_settings_for_display();
		if(function_exists('proradio_radiocard_shortcode')){
			echo proradio_radiocard_shortcode( $atts );
		}
	}
	protected function _content_template() {}
}