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


class ProradioElementorEventList extends Widget_Base {
	public function get_name() {
		return 'proradio-elementor-event-list'; // need to use same ID in the script js
	}
	public function get_title() {
		return esc_html__( 'Events list', 'proradio-elementor' );
	}
	public function get_icon() {
		return 'proradio-elementor-icons icon-prel-events-list';
	}
	public function get_categories() {
		return [ 'aaa-proradio' ]; // needs to be registered in _plugin.php
	}

	// Javascript
	public function __construct($data = [], $args = null) {
	  parent::__construct($data, $args);
	  wp_register_script( 'proradio-elementor-event-list', plugins_url( '/event-list.js', __FILE__ ), [ 'elementor-frontend' ], '1.0.0', true );
	}
	public function get_script_depends() {
		 return [ 'proradio-elementor-event-list' ];
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'proradio_elementor_section_query_events',
			[
				'label' => esc_html__( 'Query', 'proradio-elementor' ),
			]
		);	

			$this->add_control(
				'e_loadmore',
				[
					'label' => esc_html__( "Load more button", "proradio" ),
					'type' => Controls_Manager::SWITCHER,
				]
			);
			
			$this->add_control(
				'include_by_id',
				[
					'label' => esc_html__( 'Specific items by title', 'elementor-proradio' ),
					'type' => \Elementor\Controls_Manager::SELECT2,
'label_block' => true,
					'multiple' => true,
					'options' => elementor_proradio_autocomplete('event')
				]
			);
			$this->add_control(
				'items_per_page',
				[
					'label' => esc_html__( 'Max items', 'proradio-elementor' ),
					'type' => Controls_Manager::NUMBER,
					'min' => 1,
					'max' => 20,
					'step' => 1,
					'default' => 5
				]
			);
			$this->add_control(
				'tax_filter',
				[
					'label' => esc_html__( 'Category filters', 'proradio-elementor' ),
					'type' => \Elementor\Controls_Manager::SELECT2,
'label_block' => true,
					'multiple' => true,
					'options' => proradio_elementor_get_terms_array('eventtype')
				]
			);
			$this->add_control(
				'hideold',
				[
					'label' => esc_html__( 'Hide old events', 'proradio-elementor' ),
					'type' => Controls_Manager::SWITCHER,
					'return_value' => 'true'
				]
			);
			
		$this->end_controls_section();
	}

	/**
	 * Frontend
	 */
	protected function render() {
		$atts = $this->get_settings_for_display();
		if(array_key_exists('tax_filter', $atts)){
			if(is_array($atts['tax_filter'])) {
				$atts['tax_filter'] = implode(',', $atts['tax_filter']);
			}
		}
		if(function_exists('proradio_events_shortcode')){
			echo proradio_events_shortcode( $atts );
		}
	}
	protected function _content_template() {}
}