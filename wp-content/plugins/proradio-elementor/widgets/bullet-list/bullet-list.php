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


class ProradioElementorBulletList extends Widget_Base {
	public function get_name() {
		return 'proradio-elementor-bullet-list'; // need to use same ID in the script js
	}
	public function get_title() {
		return esc_html__( 'Bullet list', 'proradio-elementor' );
	}
	public function get_icon() {
		return 'proradio-elementor-icons icon-prel-bullet-list';
	}
	public function get_categories() {
		return [ 'aaa-proradio' ]; // needs to be registered in _plugin.php
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'section_button',
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
			$this->add_control(
				'items',
				[
					'label' => esc_html__( 'List', 'proradio-elementor' ),
					'show_label' => false,
					'type' => \Elementor\Controls_Manager::REPEATER,
					'fields' => $repeater->get_controls()
				]
			);
		$this->end_controls_section();
	}

	/**
	 * Frontend
	 */
	protected function render() {
		$atts = $this->get_settings_for_display();
		if(function_exists('proradio_herolist')){
			echo proradio_herolist( $atts );
		}
	}
	protected function _content_template() {}
}