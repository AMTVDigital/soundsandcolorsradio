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


class ProradioElementorPostGrid extends Widget_Base {
	public function get_name() {
		return 'proradio-elementor-post-grid'; // need to use same ID in the script js
	}
	public function get_title() {
		return esc_html__( 'Post or pages grid', 'proradio-elementor' );
	}
	public function get_icon() {
		return 'proradio-elementor-icons icon-prel-post-grid';
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
				'cols_l',
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
				'cols_m',
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
				'post_type',
				[
					'label' => esc_html__( 'Post type', 'proradio-elementor' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'multiple' => false,
					'options' =>[
						"post" => esc_html__( "Posts", 'proradio' ),
						"podcast" => esc_html__( "Podcast", 'proradio' ),
						'event' => esc_html__( "Events", 'proradio' ),
						// 'shows' => esc_html__( "Shows", 'proradio' ),
						// 'place' =>esc_html__( "Places", 'proradio' ),
						'members' => esc_html__( "Team members", 'proradio' ),
						'chart' => esc_html__( "Charts", 'proradio' ),
					]
				]
			);


			$this->add_control(
				'hideold',
				[
					'label' => esc_html__( 'Hide past events', 'plugin-domain' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => esc_html__( 'Hide', 'your-plugin' ),
					'label_off' => esc_html__( 'Show', 'your-plugin' ),
					'return_value' => 'true',
					'default' => false,
					'condition' => [
						'post_type' => 'event'
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

		if(function_exists('proradio_template_post_grid')){
			echo proradio_template_post_grid( $atts );
		}
	}
	protected function _content_template() {}
}