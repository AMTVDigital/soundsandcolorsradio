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


class ProradioElementor3dHeader extends Widget_Base {
	public function get_name() {
		return 'proradio-elementor-3dheader'; // need to use same ID in the script js
	}
	public function get_title() {
		return esc_html__( '3D Header', 'elementor-proradio' );
	}
	public function get_icon() {
		return 'proradio-elementor-icons icon-prel-3d-header';
	}
	public function get_categories() {
		return [ 'aaa-proradio' ]; // needs to be registered in _plugin.php
	}

	// Javascript
	public function __construct($data = [], $args = null) {
	  parent::__construct($data, $args);
	  wp_register_script( 'elementor-proradio-3d-header', plugins_url( '/3d-header.js', __FILE__ ), [ 'elementor-frontend' ], '1.0.0', true );
	}
	public function get_script_depends() {
		 return [ 'elementor-proradio-3d-header' ];
	}

	protected function _register_controls() {


		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Content', 'elementor-proradio' ),
			]
		);

			$this->add_control(
				'intro',
				[
					'label' => esc_html__( 'Intro text', 'elementor-proradio' ),
					'type' => Controls_Manager::TEXT,
				]
			);
			$this->add_control(
				'caption',
				[
					'label' => esc_html__( 'Caption', 'elementor-proradio' ),
					'type' => Controls_Manager::TEXT,
				]
			);
			$this->add_responsive_control(
				'proradio-captionsize',
				[
					'label' => esc_html__( 'Caption size', 'elementor-proradio' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 20,
							'max' => 130,
						],
					],
					'devices' => [ 'desktop', 'tablet', 'mobile' ],
					'selectors' => [
						'{{WRAPPER}} .proradio-capfont ' => 'font-size: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .proradio-txtfx ' => 'font-size: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'content',
				[
					'label' => esc_html__( 'Content', 'elementor-proradio' ),
					'type' => Controls_Manager::WYSIWYG,
				]
			);
			$this->add_control(
				'subtitle',
				[
					'label' => esc_html__( 'Subtitle', 'elementor-proradio' ),
					'type' => Controls_Manager::TEXT,
				]
			);

			$this->add_control(
				'negative',
				[
					'label' => esc_html__( 'Use negative colors', 'elementor-proradio' ),
					'type' => Controls_Manager::SWITCHER,
				]
			);
		$this->end_controls_section();

		/**
		 * ============================================
		 * Section 
		 * Countdown
		 * ============================================
		 */
		$this->start_controls_section(
			'section_countdown',
			[
				'label' => esc_html__( 'Countdown', 'elementor-proradio' ),
			]
		);

			$this->add_control(
				'include_by_id',
				[
					'label' => esc_html__( 'Event countdown', 'elementor-proradio' ),
					'type' => \Elementor\Controls_Manager::SELECT2,
'label_block' => true,
					'multiple' => false,
					'options' => elementor_proradio_autocomplete('event')
				]
			);
		$this->end_controls_section();



		/**
		 * ============================================
		 * Section 
		 * Intro
		 * ============================================
		 */
		$this->start_controls_section(
			'section_intro',
			[
				'label' => esc_html__( 'Intro effect', 'elementor-proradio' ),
			]
		);
			$this->add_control(
				'fx',
				[
					'label' => esc_html__( 'Effect', "elementor-proradio" ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'multiple' => false,
					'default' => 'oslo',
					'options' =>[
						"oslo" => esc_html__( "Oslo", "elementor-proradio"),
						 "tokyo" => esc_html__( "Tokyo", "elementor-proradio"),
						"london" => esc_html__( "London", "elementor-proradio"),
						"paris" => esc_html__( "Paris", "elementor-proradio"),
						"ibiza" => esc_html__( "Ibiza", "elementor-proradio"),
						"newyork" => esc_html__( "New York", "elementor-proradio")
					]
				]
			);
			$this->add_control(
				'color1',
				[
					'label' => esc_html__( 'Color 1', 'elementor-proradio' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'default' => '#dedede',
				]
			);
			$this->add_control(
				'color2',
				[
					'label' => esc_html__( 'Color 2', 'elementor-proradio' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'default' => '#999999',
				]
			);
			$this->add_control(
				'color3',
				[
					'label' => esc_html__( 'Color 3', 'elementor-proradio' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'default' => '#ff0000',
				]
			);
		$this->end_controls_section();


		/**
		 * ============================================
		 * Section 
		 * Background
		 * ============================================
		 */
		
		$this->start_controls_section(
			'item_background',
			[
				'label' => esc_html__( 'Background', 'elementor-proradio' ),
			]
		);

			$this->add_control(
				'bgimg',
				[
					'label' => esc_html__( 'Choose Image', 'elementor-proradio' ),
					'type' => \Elementor\Controls_Manager::MEDIA,
					'default' => [
						'url' => \Elementor\Utils::get_placeholder_image_src(),
					]
				]
			);
			$this->add_control(
				'bgimg2',
				[	
					'label' => esc_html__( 'Choose Image', 'elementor-proradio' ),
					'type' => \Elementor\Controls_Manager::MEDIA,
					'default' => [
						'url' => \Elementor\Utils::get_placeholder_image_src(),
					]
				]
			);
			$this->add_control(
				'bordercolor',
				[
					'label' => esc_html__( 'Border color', 'elementor-proradio' ),
					'type' => \Elementor\Controls_Manager::COLOR
				]
			);
			$this->add_control(
				'bgcolor',
				[
					'label' => esc_html__( 'Background color', 'elementor-proradio' ),
					'type' => \Elementor\Controls_Manager::COLOR
				]
			);
		$this->end_controls_section();


		/**
		 * ============================================
		 * Section 
		 * Button
		 * ============================================
		 */
		
		$this->start_controls_section(
			'section_background',
			[
				'label' => esc_html__( 'Button', 'elementor-proradio' ),
			]
		);

			$this->add_control(
				'playradio',
				[
					'label' => esc_html__( 'Play radio channel', 'proradio-elementor' ),
					'type' => Controls_Manager::SWITCHER,
					'return_value' => '1',
					'default' => '0',
				]
			);

			$this->add_control(
				'radio_id',
				[
					'label' => esc_html__( 'Play a radio channel on click', 'elementor-proradio' ),
					'type' => \Elementor\Controls_Manager::SELECT2,
					'label_block' => true,
					'multiple' => false,
					'options' => elementor_proradio_autocomplete('radiochannel'),
					'condition' => [
						'playradio' => '1',
					],
				]
			);

			$this->add_control(
				'link',
				[
					'label' => esc_html__( 'Button link', 'elementor-proradio' ),
					'type' => Controls_Manager::TEXT,
					'condition' => [
						'playradio' => '0',
					],
				]
			);
			$this->add_control(
				'linktext',
				[
					'label' => esc_html__( 'Button label', 'elementor-proradio' ),
					'type' => Controls_Manager::TEXT,
				]
			);
		$this->end_controls_section();
	}

	/**
	 * Frontend
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$bgimg = $settings['bgimg']['id'];
		$bgimg2 = $settings['bgimg2']['id'];

		$shortcode = do_shortcode( shortcode_unautop( '[qt-3d-header radio_id="'.$settings['radio_id'].'" link="'.$settings['link'].'" linktext="'.$settings['linktext'].'" negative="'.$settings['negative'].'" bgcolor="'.$settings['bgcolor'].'" bordercolor="'.$settings['bordercolor'].'" bgimg="'.$bgimg.'" bgimg2="'.$bgimg2.'" fx="'.$settings['fx'].'" color2="'.$settings['color2'].'" color3="'.$settings['color3'].'" color1="'.$settings['color1'].'" intro="'.$settings['intro'].'" caption="'.esc_attr($settings['caption']).'"  subtitle="'.esc_attr($settings['subtitle']).'"  include_by_id="'.$settings['include_by_id'].'"]'.wp_kses_post( $settings['content'] ).'[/qt-3d-header]' ));
		?>
		<div class="elementor-shortcode"><?php echo $shortcode; ?></div>
		<?php
	}

	
	protected function _content_template() {}
}