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


class ProradioElementorSchedule extends Widget_Base {
	public function get_name() {
		return 'proradio-elementor-schedule'; // need to use same ID in the script js
	}
	public function get_title() {
		return esc_html__( 'Schedule', 'proradio-elementor' );
	}
	public function get_icon() {
		return 'proradio-elementor-icons icon-prel-schedule';
	}
	public function get_categories() {
		return [ 'aaa-proradio' ]; // needs to be registered in _plugin.php
	}
	// Javascript
	public function __construct($data = [], $args = null) {
      parent::__construct($data, $args);
      wp_register_script( 'proradio-elementor-schedule', plugins_url( '/schedule.js', __FILE__ ), [ 'elementor-frontend' ], '1.0.0', true );
   	}
 	public function get_script_depends() {
	     return [ 'proradio-elementor-schedule' ];
	}
	// Controls
	protected function _register_controls() {
		$this->start_controls_section(
			'proradio_elementor_query',
			[
				'label' => esc_html__( 'Filters', 'proradio-elementor' ),
			]
		);
			$this->add_control(
				'schedulefilter',
				[
					'label' => esc_html__( 'Schedule filters', 'proradio-elementor' ),
					'type' => \Elementor\Controls_Manager::SELECT2,
					'label_block' => true,
					'options' => proradio_elementor_get_terms_array( 'schedulefilter' )
				]
			);
		$this->end_controls_section();
	}
	/**
	 * Frontend
	 */
	protected function render() {
		$atts = $this->get_settings_for_display();
		if(array_key_exists('schedulefilter', $atts)){
			if(is_array($atts['schedulefilter'])) {
				$atts['schedulefilter'] = implode(',', $atts['schedulefilter']);
			}
		}
		if(function_exists('proradio_showgrid')){
			echo proradio_showgrid( $atts );
		}
	}
	protected function _content_template() {}
}