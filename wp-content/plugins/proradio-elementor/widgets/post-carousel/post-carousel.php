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


class ProradioElementorPostCarousel extends Widget_Base {
	public function get_name() {
		return 'proradio-elementor-post-carousel'; // need to use same ID in the script js
	}
	public function get_title() {
		return esc_html__( 'Post carousel', 'proradio-elementor' );
	}
	public function get_icon() {
		return 'proradio-elementor-icons icon-prel-post-carouse';
	}
	public function get_categories() {
		return [ 'aaa-proradio' ]; // needs to be registered in _plugin.php
	}
	public function __construct($data = [], $args = null) {
      parent::__construct($data, $args);
      wp_register_script( 'proradio-elementor-post-carousel', plugins_url( '/post-carousel.js', __FILE__ ), [ 'elementor-frontend' ], '1.0.0', true );
   	}
 	public function get_script_depends() {
	     return [ 'proradio-elementor-post-carousel' ];
	}
	protected function _register_controls() {


		/**
		 * ======================================
		 * Section:
		 * Carousel parameters
		 * ======================================
		 */
		$this->start_controls_section(
			'proradio_elementor_section_carousel_global',
			[
				'label' => esc_html__( 'Settings', 'proradio-elementor' ),
			]
		);
		// Important::::::::::::::::::::::::::::::::::::
		// Fields added by carousel-fields.php
		// :::::::::::::::::::::::::::::::::::::::::::::
		$this->end_controls_section();



		/**
		 * ======================================
		 * Section:
		 * Query parameters
		 * ======================================
		 */
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
						"post" => esc_html__( "Post", 'proradio' ),
						"chart" => esc_html__( "Chart", 'proradio' ),
						"podcast" => esc_html__( "Podcast", 'proradio' ),
						'event' => esc_html__( "Event", 'proradio' ),
						'shows' => esc_html__( "Shows", 'proradio' ),
						'place' =>esc_html__( "Place", 'proradio' ),
						'members' => esc_html__( "Team member", 'proradio' ),
						'product' => esc_html__( "Product", 'proradio' ),
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
					'options' => proradio_elementor_get_terms_array()
				]
			);
		// Important::::::::::::::::::::::::::::::::::::
		// Fields added by query-fields.php
		// :::::::::::::::::::::::::::::::::::::::::::::
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
		if(function_exists('proradio_template_post_carousel')){
			echo proradio_template_post_carousel( $atts );
		}
	}
	protected function _content_template() {}
}