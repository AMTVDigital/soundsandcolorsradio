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


class ProradioElementorPostHero extends Widget_Base {
	public function get_name() {
		return 'proradio-elementor-post-list'; // need to use same ID in the script js
	}
	public function get_title() {
		return esc_html__( 'Post hero', 'proradio-elementor' );
	}
	public function get_icon() {
		return 'proradio-elementor-icons icon-prel-post-hero';
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
		
			$this->add_responsive_control(
				'proradio-captionsize',
				[
					'label' => esc_html__( 'Caption size', 'elementor-proradio' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 12,
							'max' => 110,
						],
					],
					'devices' => [ 'desktop', 'tablet', 'mobile' ],
					'selectors' => [
						'{{WRAPPER}} .proradio-post__title  ' => 'font-size: {{SIZE}}{{UNIT}};',
					],
				]
			);


			$this->add_responsive_control(
				'proradio-sliderheigh',
				[
					'label' => esc_html__( 'Height', 'elementor-proradio' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 180,
							'max' => 1200,
						],
					],
					'devices' => [ 'desktop', 'tablet', 'mobile' ],
					'desktop_default' => [
						'size' => 470,
						'unit' => 'px',
					],
					'tablet_default' => [
						'size' => 360,
						'unit' => 'px',
					],
					'mobile_default' => [
						'size' => 380,
						'unit' => 'px',
					],
					'selectors' => [
						'#proradio-body .proradio-master {{WRAPPER}} .proradio-post__hero, #proradio-body .proradio-master {{WRAPPER}} .proradio-post__hero .proradio-post__header ' => 'min-height: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'proradio-margin-bottom',
				[
					'label' => esc_html__( 'Bottom margin', 'elementor-proradio' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 70,
						],
					],
					'devices' => [ 'desktop', 'tablet', 'mobile' ],
					'desktop_default' => [
						'size' => 40,
						'unit' => 'px',
					],
					'tablet_default' => [
						'size' => 30,
						'unit' => 'px',
					],
					'mobile_default' => [
						'size' => 20,
						'unit' => 'px',
					],
					'selectors' => [
						'#proradio-body .proradio-master {{WRAPPER}} .proradio-post__hero ' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					],
				]
			);


			// vertical padding
			$this->add_responsive_control(
				'proradio-slider-pad-v',
				[
					'label' => esc_html__( 'Vertical padding', 'elementor-proradio' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 300,
						],
					],
					'devices' => [ 'desktop', 'tablet', 'mobile' ],
					'desktop_default' => [
						'size' => 50,
						'unit' => 'px',
					],
					'tablet_default' => [
						'size' => 40,
						'unit' => 'px',
					],
					'mobile_default' => [
						'size' => 30,
						'unit' => 'px',
					],
					'selectors' => [
						'#proradio-body .proradio-master  {{WRAPPER}} .proradio-post__hero__caption ' => 'padding-top: {{SIZE}}{{UNIT}};padding-bottom: {{SIZE}}{{UNIT}};',
					],
				]
			);
			// vertical padding
			$this->add_responsive_control(
				'proradio-slider-pad-h',
				[
					'label' => esc_html__( 'Horizontal padding', 'elementor-proradio' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 140,
						],
					],
					'devices' => [ 'desktop', 'tablet', 'mobile' ],
					'desktop_default' => [
						'size' => 40,
						'unit' => 'px',
					],
					'tablet_default' => [
						'size' => 30,
						'unit' => 'px',
					],
					'mobile_default' => [
						'size' => 20,
						'unit' => 'px',
					],
					'selectors' => [
						'#proradio-body .proradio-master  {{WRAPPER}} .proradio-post__hero__caption' => 'padding-left: {{SIZE}}{{UNIT}};padding-right: {{SIZE}}{{UNIT}};',
					],
				]
			);


		$this->add_control(
			'e_loadmore',
			[
				'label' => esc_html__( "Load more button", "proradio" ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => '1',
					'default' => '0',
			]
		);


		$this->add_control(
			'proradio_post_excerpt',
			[
				'label' => esc_html__( "Show excerpt", "proradio" ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => '1',
				'default' => '1',
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
		if(function_exists('proradio_template_post_hero')){
			echo proradio_template_post_hero( $atts );
		}
	}
	protected function _content_template() {}
}