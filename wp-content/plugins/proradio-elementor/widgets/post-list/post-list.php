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


class ProradioElementorPostListLarge extends Widget_Base {
	public function get_name() {
		return 'proradio-elementor-post-list-large'; // need to use same ID in the script js
	}
	public function get_title() {
		return esc_html__( 'Post list large', 'proradio-elementor' );
	}
	public function get_icon() {
		return 'proradio-elementor-icons icon-prel-post-list-large';
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
				'tax_filter',
				[
					'label' => esc_html__( 'Category filters', 'proradio-elementor' ),
					'type' => \Elementor\Controls_Manager::SELECT2,
'label_block' => true,
					'multiple' => true,
					'options' => proradio_elementor_get_terms_array('category')
				]
			);
		
			$this->add_control(
				'e_loadmore',
				[
					'label' => esc_html__( "Load more button", "proradio" ),
					'type' => Controls_Manager::SWITCHER,
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
		if(function_exists('proradio_template_post_list')){
			echo proradio_template_post_list( $atts );
		}
	}
	protected function _content_template() {}
}