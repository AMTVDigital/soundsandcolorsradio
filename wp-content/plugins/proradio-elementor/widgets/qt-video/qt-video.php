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


class ProradioElementorQtVideo extends Widget_Base {
	public function get_name() {
		return 'proradio-elementor-qtvideo'; // need to use same ID in the script js
	}
	public function get_title() {
		return esc_html__( 'Video Gallery', 'proradio-elementor' );
	}
	public function get_icon() {
		return 'proradio-elementor-icons icon-prel-video-gallery';
	}
	public function get_categories() {
		return [ 'aaa-proradio' ]; // needs to be registered in _plugin.php
	}

	// Controls
	protected function _register_controls() {
		$this->start_controls_section(
			'proradio_elementor_settings',
			[
				'label' => esc_html__( 'Settings', 'proradio-elementor' ),
			]
		);
			$this->add_control(
				'columns',
				[
					'label' => esc_html__( 'Columns', 'proradio-elementor' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => 4,
					'options' =>[
						1 => esc_html__( "1", "proradioelementor"),
						2 => esc_html__( "2", "proradioelementor"),
						3 => esc_html__( "3", "proradioelementor"),
						4 => esc_html__( "4", "proradioelementor"),
					]
				]
			);

			$this->add_control(
				'showfilters',
				[
					'label' => esc_html__( "Show filters", "proradio" ),
					'type' => Controls_Manager::SWITCHER,
					'value' => 1,
					'default' => 1,
				]
			);

			$this->add_control(
				'showtitle',
				[
					'label' => esc_html__( "Show title", "proradio" ),
					'type' => Controls_Manager::SWITCHER,
					'value' => 1,
					'default' => 1,
				]
			);

			$this->add_control(
				'showtags',
				[
					'label' => esc_html__( "Show tags", "proradio" ),
					'type' => Controls_Manager::SWITCHER,
					'value' => 1,
					'default' => 1,
				]
			);
			$this->add_control(
				'showpreview',
				[
					'label' => esc_html__( "Open in lightbox", "proradio" ),
					'type' => Controls_Manager::SWITCHER,
					'value' => 1,
					'default' => 0,
				]
			);

			$this->add_control(
				'quantity',
				[
					'label' => esc_html__( "Quantity", "proradio" ),
					'type' => Controls_Manager::NUMBER,
				]
			);
		
		$this->end_controls_section();
	}
	/**
	 * Frontend
	 */
	protected function render() {
		$atts = $this->get_settings_for_display();
		if(function_exists('proradio_videogalleries_sc')){
			echo do_shortcode('[proradio-videogalleries columns="'.$atts['columns'].'" showfilters="'.$atts['showfilters'].'" showtitle="'.$atts['showtitle'].'" showtags="'.$atts['showtags'].'" quantity="'.$atts['quantity'].'" showpreview="'.$atts['showpreview'].'"]');
		}
	}
	protected function _content_template() {}
}