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


class ProradioElementorCaption extends Widget_Base {
	public function get_name() {
		return 'proradio-elementor-qt-caption'; // need to use same ID in the script js
	}
	public function get_title() {
		return esc_html__( 'Caption', 'proradio-elementor' );
	}
	public function get_icon() {
		return 'proradio-elementor-icons icon-prel-caption';
	}
	public function get_categories() {
		return [ 'aaa-proradio' ]; // needs to be registered in _plugin.php
	}
	public function __construct($data = [], $args = null) {
      parent::__construct($data, $args);
      wp_register_script( 'proradio-elementor-qt-caption', plugins_url( '/caption.js', __FILE__ ), [ 'elementor-frontend' ], '1.0.0', true );
   	}
 	public function get_script_depends() {
	     return [ 'proradio-elementor-qt-caption' ];
	}
	protected function _register_controls() {
		$this->start_controls_section(
			'section_icons',
			[
				'label' => esc_html__( 'Caption', 'proradio-elementor' ),
			]
		);
			
			
			$this->add_control(
				'title',
				[
					'label' => esc_html__( 'Caption', 'proradio-elementor' ),
					'type' => Controls_Manager::TEXT
				]
			);
			
			$this->add_control(
				'size',
				[
					'label' => esc_html__( 'Size', 'proradio-elementor' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'multiple' => false,
					'default' => 'm',
					'options' =>[
						"xs" => esc_html__( "XS", 'proradio-elementor' ),
						"s" =>	esc_html__( "S", 'proradio-elementor' ),
						"m" =>	esc_html__( "M", 'proradio-elementor' ),
						"l" =>	esc_html__( "L", 'proradio-elementor' ),
						"xl" =>	esc_html__( "XL", 'proradio-elementor' ),
						"xxl" =>	esc_html__( "XXL", 'proradio-elementor' ),
						"xxxl" =>	esc_html__( "XXXL", 'proradio-elementor')
					]
				]
			);
			$this->add_control(
				'alignment',
				[
					'label' => esc_html__( 'Alignment', 'proradio-elementor' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'multiple' => false,
					'default' => 'left',
					'options' =>[
						'left' 	=>	esc_html__( "Left", "proradioelementor"),
						'center'	=>	esc_html__( "Center", "proradioelementor"),
					]
				]
			);
			$this->add_control(
				'cssclass',
				[
					'label' => esc_html__( 'CSS Class', 'proradio-elementor' ),
					'type' => Controls_Manager::TEXT,
				]
			);
			$this->add_control(
				'anim',
				[
					'label' => esc_html__( 'Animation', 'proradio-elementor' ),
					'type' => Controls_Manager::SWITCHER,
				]
			);
			$this->add_control(
				'negative',
				[
					'label' => esc_html__( 'Negative colors', 'proradio-elementor' ),
					'type' => Controls_Manager::SWITCHER,
				]
			);

			$this->add_control(
				'cap-color-test',
				[
					'label' => esc_html__( 'Text color', 'proradio-elementor' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .proradio-caption span' => 'color: {{VALUE}} !important;',
					]
				]
			);
			$this->add_control(
				'cap-color-decor',
				[
					'label' => esc_html__( 'Decoration color', 'proradio-elementor' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .proradio-caption::before' => 'border-color: {{VALUE}};',
						'{{WRAPPER}} .proradio-caption span::after'=> 'background-color: {{VALUE}};',
					]
					
				]
			);
		$this->end_controls_section();
	}

	/**
	 * Frontend
	 */
	protected function render() {
		if(function_exists('proradio_template_caption')){
			echo proradio_template_caption( $this->get_settings_for_display() );
		}
	}
	
	protected function _content_template() {}
}