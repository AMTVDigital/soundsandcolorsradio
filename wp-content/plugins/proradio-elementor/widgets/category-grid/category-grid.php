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


class ProradioElementorCategoryGrid extends Widget_Base {
	public function get_name() {
		return 'proradio-elementor-category-grid'; // need to use same ID in the script js
	}
	public function get_title() {
		return esc_html__( 'Category Grid', 'proradio-elementor' );
	}
	public function get_icon() {
		return 'proradio-elementor-icons icon-prel-categories';
	}
	public function get_categories() {
		return [ 'aaa-proradio' ]; // needs to be registered in _plugin.php
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'section_button',
			[
				'label' => esc_html__( 'Settings', 'proradio-elementor' ),
			]
		);	

			$this->add_control(
				'amount',
				[
					'label' => esc_html__( 'Amount', 'proradio-elementor' ),
					'type' => Controls_Manager::TEXT,
					'default' => '12'
				]
			);
			
			$this->add_control(
				'cols_l',
				[
					'label' => esc_html__( 'Columns desktop', 'proradio-elementor' ),
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
				'cols_m',
				[
					'label' => esc_html__( 'Columns tablet', 'proradio-elementor' ),
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
				'taxonomy',
				[
					'label' => esc_html__( 'Taxonomy', 'proradio-elementor' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'description' => esc_html__('Please install the plugin QT Taxonomy Background to set the images of each term', 'proradio-elementor'),
					'default' => 'category',
					'options' =>[
						'category' => esc_html__( "Category", "proradioelementor"),
						"post_tag" => esc_html__( "Post tag","proradioelementor"),
						"product_cat" => esc_html__( "WooCommerce categories","proradioelementor"),
						"product_tag" => esc_html__( "WooCommerce tags","proradioelementor"),
						"eventtype" => esc_html__( "Event types","proradioelementor"),
						"chartcategory" => esc_html__( "Chart category","proradioelementor"),
						"membertype" => esc_html__( "Member type","proradioelementor"),
						"podcastfilter" => esc_html__( "Podcast filter","proradioelementor"),
						"genre" => esc_html__( "Shows genre","proradioelementor"),
					]
				]
			);

			$this->add_control(
				'include',
				[
					'label' => esc_html__( 'Include by id, comma separated', 'proradio-elementor' ),
					'type' => Controls_Manager::TEXT,
				]
			);

			$this->add_control(
				'exclude',
				[
					'label' => esc_html__( 'Exclude by id, comma separated', 'proradio-elementor' ),
					'type' => Controls_Manager::TEXT,
				]
			);

			$this->add_control(
				'child_of',
				[
					'label' => esc_html__( 'Only sub-categories of this specific category (Numeric ID)', 'proradio-elementor' ),
					'type' => Controls_Manager::TEXT,
				]
			);
			
		$this->end_controls_section();
	}

	/**
	 * Frontend
	 */
	protected function render() {
		$atts = $this->get_settings_for_display();
		if(function_exists('proradio_template_category_grid')){
			echo proradio_template_category_grid( $atts );
		}
	}
	protected function _content_template() {}
}