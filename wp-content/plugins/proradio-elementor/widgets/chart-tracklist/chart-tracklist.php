<?php
/**
 * @source  https://developers.elementor.com/elementor-controls/
 * @author  Pro.Radio
 * @package  Elementor Proradio
 * @version  PR.2.0.7
 */


namespace ProradioElementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class ProradioElementorChartTracklist extends Widget_Base {
	public function get_name() {
		return 'proradio-elementor-chart-tracklist'; // need to use same ID in the script js
	}
	public function get_title() {
		return esc_html__( 'Chart tracklist', 'proradio-elementor' );
	}
	public function get_icon() {
		return 'proradio-elementor-icons icon-prel-chart-tracklist';
	}
	public function get_categories() {
		return [ 'aaa-proradio' ]; // needs to be registered in _plugin.php
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'section_settings',
			[
				'label' => esc_html__( 'Settings', 'proradio-elementor' ),
			]
		);	

			$this->add_control(
				'chart_id',
				[
					'label' => esc_html__( 'Select chart', 'proradio-elementor' ),
					'type' => \Elementor\Controls_Manager::SELECT2,
					'label_block' => true,
					'description' => esc_html__( "If not specified, use the first result", "proradioelementor" ),
					'multiple' => false,
					'options' => elementor_proradio_autocomplete('chart')
				]
			);

			$this->add_responsive_control(
				'pr-captionsize',
				[
					'label' => esc_html__( 'Caption size', 'elementor-proradio' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 12,
							'max' => 30,
						],
					],
					'devices' => [ 'desktop', 'tablet', 'mobile' ],
					'selectors' => [
						'{{WRAPPER}} .proradio-titles .proradio-cutme-t  ' => 'font-size: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'number',
				[
					'label' => esc_html__( "Number of tracks to display", "proradio" ),
					'description' => esc_html__( "If smaller than the chart tracks, a button to the chart page will appear.", "proradioelementor" ),
					'type' => Controls_Manager::TEXT,
					'default' => 100
				]
			);

			$this->add_control(
				'showtitle',
				[
					'label' => esc_html__( "Show chart title", "proradio" ),
					'type' => Controls_Manager::SWITCHER,
				]
			);
			
			$this->add_control(
				'showthumbnail',
				[
					'label' => esc_html__( "Display featured image", "proradio" ),
					'type' => Controls_Manager::SWITCHER,
				]
			);
	

			$this->add_control(
				'show_link',
				[
					'label' => esc_html__( 'Display link to single chart', 'proradio-elementor' ),
					'type' => Controls_Manager::SWITCHER,
					'return_value' => 'yes',
					'default' => 'yes',
				]
			);

			$this->add_control(
				'chartstyle',
				[
					'label' => esc_html__( 'Chart style', 'proradio-elementor' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => "chart-normal",
					'options' =>[
						"chart-normal" => esc_html__( "Default", "proradioelementor"),
						"chart-small" => esc_html__( "Compact", "proradioelementor")
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
		if(function_exists('proradio_chart_tracklist')){
			echo proradio_chart_tracklist( $atts );
		}
	}
	protected function _content_template() {}
}