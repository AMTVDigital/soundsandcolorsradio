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


class ProradioElementorPostInline extends Widget_Base {
	public function get_name() {
		return 'proradio-elementor-post-inline'; // need to use same ID in the script js
	}
	public function get_title() {
		return esc_html__( 'Post inline', 'proradio-elementor' );
	}
	public function get_icon() {
		return 'proradio-elementor-icons icon-prel-post-list';
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
				'post_type',
				[
					'label' => esc_html__( 'Post type', 'proradio-elementor' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'multiple' => false,
					'options' =>[
						"post" => esc_html__( "Posts", 'proradio' ),
						"podcast" => esc_html__( "Podcast", 'proradio' ),
						'event' => esc_html__( "Events", 'proradio' ),
						'members' => esc_html__( "Team members", 'proradio' ),
						'chart' => esc_html__( "Charts", 'proradio' ),
					]
				]
			);


			
			$this->add_responsive_control(
				'proradio-captionsize',
				[
					'label' => esc_html__( 'Caption size', 'elementor-proradio' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 12,
							'max' => 60,
						],
					],
					'devices' => [ 'desktop', 'tablet', 'mobile' ],
					'selectors' => [
						'{{WRAPPER}} .proradio-post__title  ' => 'font-size: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'tax_filter',
				[
					'label' => esc_html__( 'Category filters', 'proradio-elementor' ),
					'type' => \Elementor\Controls_Manager::SELECT2,
					'label_block' => true,
					'multiple' => true,
					'options' => proradio_elementor_get_terms_array()
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
		if(function_exists('proradio_template_post_inline')){
			echo proradio_template_post_inline( $atts );
		}
	}
	protected function _content_template() {}
}