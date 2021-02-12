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


class ProradioElementorRadiofeed extends Widget_Base {
	public function get_name() {
		return 'proradio-elementor-radiofeed'; // need to use same ID in the script js
	}
	public function get_title() {
		return esc_html__( 'Radio feed titles', 'proradio-elementor' );
	}
	public function get_icon() {
		return 'proradio-elementor-icons icon-prel-radio-feed';
	}
	public function get_categories() {
		return [ 'aaa-proradio' ]; // needs to be registered in _plugin.php
	}

	// Javascript
	public function __construct($data = [], $args = null) {
      parent::__construct($data, $args);
      wp_register_script( 'proradio-elementor-radiofeed', plugins_url( '/radiofeed.js', __FILE__ ), [ 'elementor-frontend' ], '1.0.0', true );
   	}
 	public function get_script_depends() {
	     return [ 'proradio-elementor-radiofeed' ];
	}


	protected function _register_controls() {
		$this->start_controls_section(
			'section_button',
			[
				'label' => esc_html__( 'Settings', 'proradio-elementor' ),
			]
		);
			$this->add_control(
				'intro',
				[
					'label' => esc_html__( 'Important Note', 'proradio-elementor' ),
					'raw' => __( '<h2><strong>This text becomes visible only after playing a radio stream with valid song feed details.</strong></h2>', 'proradio-elementor' ),
					'type' => Controls_Manager::RAW_HTML,
				]
			);


			$this->add_control(
				'proradio-txt',
				[
					'label' => esc_html__( 'Text color', 'elementor-proradio' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .proradio-now_on_air_text' => 'color: {{VALUE}} !important;',
					]
				]
			);
			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'proradio-txt-typo',
					'label' => __( 'Typography','vice-elementor'),
					'scheme' => Scheme_Typography::TYPOGRAPHY_1,
					'selector' => '{{WRAPPER}} .proradio-now_on_air_text'
				]
			);

			$this->add_control(
				'title',
				[
					'label' => esc_html__( 'Title', 'proradio-elementor' ),
					'default' => esc_html__( 'Now playing:', 'proradio-elementor' ),
					'description' => esc_html__( 'Label for the song title', 'proradio-elementor' ),
					'type' => Controls_Manager::TEXT,
				]
			);
			
			$this->add_control(
				'tag',
				[
					'label' 	=> esc_html__( 'Container tag', 'proradio-elementor' ),
					'type' 		=> \Elementor\Controls_Manager::SELECT,
					'default' 	=> 'p',
					'options' 	=>[
						'' 			=> esc_html__('No container', 'proradio-elementor'), 
						'h1' 		=> esc_html__('Heading 1', 'proradio-elementor'), 
						'h2' 		=> esc_html__('Heading 2', 'proradio-elementor'), 
						"h3" 		=> esc_html__('Heading 3', 'proradio-elementor'), 
						"h4" 		=> esc_html__('Heading 4', 'proradio-elementor'), 
						"h5" 		=> esc_html__('Heading 5', 'proradio-elementor'), 
						"h6" 		=> esc_html__('Heading 6', 'proradio-elementor'), 
						"p" 		=> esc_html__('Paragraph', 'proradio-elementor'), 
					]
				]
			);
			$this->add_control(
				'align',
				[
					'label' 	=> esc_html__( 'Align', 'proradio-elementor' ),
					'type' 		=> \Elementor\Controls_Manager::SELECT,
					'default' => 'center',
					'options' =>[
						'center'	=> esc_html__('center', 'proradio' ),
						'left'		=> esc_html__('left', 'proradio' ),
						'right'		=> esc_html__('right', 'proradio' ),
						'inline'	=> esc_html__('inline', 'proradio' ),
					]
				]
			);
			

			
		$this->end_controls_section();
	}

	/**
	 * Frontend
	 */
	protected function render() {
		if(function_exists('proradio_short_radiofeed')){
			echo proradio_short_radiofeed( $this->get_settings_for_display() );
		}
	}
	
	protected function _content_template() {}
}