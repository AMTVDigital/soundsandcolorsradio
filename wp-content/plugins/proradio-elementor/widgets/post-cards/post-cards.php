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


class ProradioElementorPostCards extends Widget_Base {
	public function get_name() {
		return 'proradio-elementor-post-cards'; // need to use same ID in the script js
	}
	public function get_title() {
		return esc_html__( 'Blog cards', 'proradio-elementor' );
	}
	public function get_icon() {
		return 'proradio-elementor-icons icon-prel-post-glass-cards';
	}
	public function get_categories() {
		return [ 'aaa-proradio' ]; // needs to be registered in _plugin.php
	}
	protected function _register_controls() {
		$this->start_controls_section(
			'proradio_elementor_section_query_global',
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
				'columns',
				[
					'label' => esc_html__( 'Columns', 'proradio-elementor' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => 3,
					'options' =>[
						1 => esc_html__( "1", "proradioelementor"),
						2 => esc_html__( "2", "proradioelementor"),
						3 => esc_html__( "3", "proradioelementor"),
						4 => esc_html__( "4", "proradioelementor"),
					]
				]
			);
			$this->add_control(
				'columnst',
				[
					'label' => esc_html__( 'Columns tablet', 'proradio-elementor' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => 2,
					'options' =>[
						1 => esc_html__( "1", "proradioelementor"),
						2 => esc_html__( "2", "proradioelementor"),
						3 => esc_html__( "3", "proradioelementor"),
						4 => esc_html__( "4", "proradioelementor"),
					]
				]
			);
			$this->add_control(
				'tax_filter',
				[
					'label' => esc_html__( 'Category filters', 'proradio-elementor' ),
					'type' => \Elementor\Controls_Manager::SELECT2,
'label_block' => true,
					'multiple' => true,
					'options' => proradio_elementor_get_terms_array('category')
				]
			);
		// Fields added by query-fields.php
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
		if(function_exists('proradio_template_post_cards')){
			echo proradio_template_post_cards( $atts );
		}
	}
	protected function _content_template() {}
}