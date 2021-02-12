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


class ProradioElementorAppIcons extends Widget_Base {
	public function get_name() {
		return 'proradio-elementor-qt-appicons'; // need to use same ID in the script js
	}
	public function get_title() {
		return __( 'Streaming App Icons', 'proradio-elementor' );
	}
	public function get_icon() {
		return 'proradio-elementor-icons icon-prel-streaming-app-icons';
	}
	public function get_categories() {
		return [ 'aaa-proradio' ]; // needs to be registered in _plugin.php
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'section_icons',
			[
				'label' => __( 'Icons', 'proradio-elementor' ),
			]
		);
			$this->add_control(
				'app_blackberry',
				[
					'label' => esc_html__( 'Blackberry', 'proradio-elementor' ),
					'type' => Controls_Manager::TEXT,
				]
			);
			$this->add_control(
				'app_itunes',
				[
					'label' => esc_html__( 'iTunes', 'proradio-elementor' ),
					'type' => Controls_Manager::TEXT,
				]
			);
			$this->add_control(
				'app_winphone',
				[
					'label' => esc_html__( 'Windows', 'proradio-elementor' ),
					'type' => Controls_Manager::TEXT,
				]
			);
			$this->add_control(
				'app_winamp',
				[
					'label' => esc_html__( 'WinAmp', 'proradio-elementor' ),
					'type' => Controls_Manager::TEXT,
				]
			);
			$this->add_control(
				'app_tunein',
				[
					'label' => esc_html__( 'TuneIn', 'proradio-elementor' ),
					'type' => Controls_Manager::TEXT,
				]
			);
			$this->add_control(
				'app_mediaplayer',
				[
					'label' => esc_html__( 'Media Player', 'proradio-elementor' ),
					'type' => Controls_Manager::TEXT,
				]
			);
			$this->add_control(
				'app_android',
				[
					'label' => esc_html__( 'Android', 'proradio-elementor' ),
					'type' => Controls_Manager::TEXT,
				]
			);
			$this->add_control(
				'app_iphone',
				[
					'label' => esc_html__( 'iPhone', 'proradio-elementor' ),
					'type' => Controls_Manager::TEXT,
				]
			);
		$this->end_controls_section();
	}

	/**
	 * Frontend
	 */
	protected function render() {
		if(function_exists('proradio_appicons')){
			echo proradio_appicons( $this->get_settings_for_display() );
		}
	}

	
	protected function _content_template() {}
}