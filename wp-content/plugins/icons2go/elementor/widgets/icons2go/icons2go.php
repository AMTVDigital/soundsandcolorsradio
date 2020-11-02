<?php
/**
 * @source  https://developers.elementor.com/elementor-controls/
 * @author  ProRadio
 * @package  Elementor Proradio
 * @version  1.0.0
 */


namespace ElementorIcons2Go\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Icons_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class ElementorIcons2Go extends Widget_Base {
	public function get_name() {
		return 'icons2go-icon'; // need to use same ID in the script js
	}
	public function get_title() {
		return __( 'Icon Icons2Go', 'icons2go' );
	}
	public function get_icon() {
		return 'eicon-star';
	}
	public function get_categories() {
		return [ 'ProRadio' ]; // needs to be registered in _plugin.php
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'section_icons',
			[
				'label' => __( 'Icons', 'icons2go' ),
			]
		);

			$this->add_control(
				'elementor_icon', // https://crocoblock.com/how-to-add-custom-icons-to-elementor-and-jet-plugins/
				[
					'label' => esc_html__( 'Icon', 't2gicons' ),
					'type' => Controls_Manager::ICONS,
				]
			);

			$this->add_control(
				'link', // https://crocoblock.com/how-to-add-custom-icons-to-elementor-and-jet-plugins/
				[
					'label' => esc_html__( 'Link URL', 't2gicons' ),
					'type' => Controls_Manager::TEXT,
				]
			);

			$this->add_control(
				'target',
				[
					'label' => esc_html__( 'Link target', 't2gicons' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'options' =>[
						'_self' => esc_html__('Default', 't2gicons'),
						'_blank' => esc_html__('New tab', 't2gicons')
					]
				]
			);
			$this->add_control(
				'align',
				[
					'label' => esc_html__( 'Alignment', 't2gicons' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => 'center',
					'options' =>[
						'left' 	=>	esc_html__( "Left", "t2gicons"),
						'right'	=>	esc_html__( "Right", "t2gicons"),
						'center'	=>	esc_html__( "Center", "t2gicons"),
					]
				]
			);
			$sizes = [
				"10"=>"10","20"=>'20','30'=>"30",'40'=>"40",'50'=>"50",'60'=>"60",'70'=>"70",'80'=>"80",'90'=>"90",'100'=>"100",'110'=>"110",'120'=>"120",'120'=>"130",'140'=>"140",'150'=>"150",'160'=>"160",
				'170'=>"170",'180'=>"180",'190'=>"190",'200'=>"200"
			];
			$this->add_control(
				'fontsize',
				[
					'label' => esc_html__( 'Icon size', 't2gicons' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'options' => $sizes,
					'default' => '100',
				]
			);

			$this->add_control(
				'size',
				[
					'label' => esc_html__( 'Container size', 't2gicons' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'options' => $sizes,
					'default' => '200',

				]
			);

			$colors = [
						 "default" => esc_attr__("Default", "t2gicons"),
						"red" => esc_attr__("Red", "t2gicons"),
						"pink" => esc_attr__("Pink", "t2gicons"),
						"purple" => esc_attr__("Purple", "t2gicons"),
						"deep-purple" => esc_attr__("Deep purple", "t2gicons"),
						"indigo" => esc_attr__("Indigo", "t2gicons"),
						"blue" => esc_attr__("Blue", "t2gicons"),
						"light-blue" => esc_attr__("Light-blue", "t2gicons"),
						"teal" => esc_attr__("Teal", "t2gicons"),
						"green" => esc_attr__("Green", "t2gicons"),
						"light-green" => esc_attr__("Light-green", "t2gicons"),
						"lime" => esc_attr__("Lime", "t2gicons"),
						"yellow" => esc_attr__("Yellow", "t2gicons"),
						"amber" => esc_attr__("Amber", "t2gicons"),
						"orange" => esc_attr__("Orange", "t2gicons"),
						"deep-orange" => esc_attr__("Deep-orange", "t2gicons"),
						"brown" => esc_attr__("Brown", "t2gicons"),
						"grey" => esc_attr__("Grey", "t2gicons"),
						"blue-grey" => esc_attr__("Blue-grey", "t2gicons"),
						"black" => esc_attr__("Black", "t2gicons"),
						"white" => esc_attr__("White", "t2gicons"),
					];
			$this->add_control(
				'bgcolor',
				[
					'label' => esc_html__( 'Background color', 't2gicons' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => 'blue',
					'options' => $colors
				]
			);
			$this->add_control(
				'color',
				[
					'label' => esc_html__( 'Icon color', 't2gicons' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => 'white',
					'options' => $colors
				]
			);
			$this->add_control(
				'shape',
				[
					'label' => esc_html__( 'Icon color', 't2gicons' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => 'rsquare',
					'options' => [
						"none" => esc_attr__("No background", "t2gicons"),
						"circle" => esc_attr__("Circle", "t2gicons"), 
						"square" => esc_attr__("Square", "t2gicons"),
						"rsquare" => esc_attr__("Rounded square", "t2gicons"),
						"rhombus" => esc_attr__("Rhombus", "t2gicons"), 
						"circle-border" => esc_attr__("Circle border", "t2gicons"), 
						"square-border" => esc_attr__("Square border", "t2gicons"), 
						"rsquare-border" => esc_attr__("Rounded square border", "t2gicons"), 
						"rhombus-border" => esc_attr__("Rhombus border", "t2gicons"), 
					]
				]
			);


		$this->end_controls_section();
	}

	/**
	 * Frontend
	 */
	protected function render() {
		$args = $this->get_settings_for_display() ;
		if( function_exists( 't2gicons_shortcode' ) ){
			echo t2gicons_shortcode( $args );
		}
	}

	
	protected function _content_template() {}
}