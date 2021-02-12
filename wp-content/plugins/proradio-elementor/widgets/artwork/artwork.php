<?php
/**
 * @source  https://developers.elementor.com/elementor-controls/
 * @author  Pro.Radio
 * @package  Elementor Proradio
 * @version  PR.2.1.2 
 */


namespace ProradioElementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class ProradioElementorArtwork extends Widget_Base {
	public function get_name() {
		return 'proradio-elementor-artwork'; // need to use same ID in the script js
	}
	public function get_title() {
		return esc_html__( 'Song artwork', 'elementor-proradio' );
	}
	public function get_icon() {
		return 'proradio-elementor-icons icon-prel-shows-onair';
	}
	public function get_categories() {
		return [ 'aaa-proradio' ]; // needs to be registered in _plugin.php
	}

	public function __construct($data = [], $args = null) {
      parent::__construct($data, $args);
      wp_register_script( 'proradio-elementor-artwork', plugins_url( '/artwork.js', __FILE__ ), [ 'elementor-frontend' ], '1.0.0', true );
   	}
 	public function get_script_depends() {
	     return [ 'proradio-elementor-artwork' ];
	}
	protected function _register_controls() {
		$this->start_controls_section(
			'section_settings',
			[
				'label' => esc_html__( 'Settings', 'elementor-proradio' ),
			]
		);
			$this->add_responsive_control(
				'proradio-size',
				[
					'label' => esc_html__( 'Size', 'elementor-proradio' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 20,
							'max' => 1000,
						],
					],
					'devices' => [ 'desktop', 'tablet', 'mobile' ],
					'desktop_default' => [
						'size' => 200,
						'unit' => 'px',
					],
					'tablet_default' => [
						'size' => 200,
						'unit' => 'px',
					],
					'mobile_default' => [
						'size' => 200,
						'unit' => 'px',
					],
					'selectors' => [
						'{{WRAPPER}} .proradio-elementor--artwork__img img  ' => 'max-width: {{SIZE}}{{UNIT}};height: auto;',
					],
				]
			);

			$this->add_responsive_control(
				'proradio-radius',
				[
					'label' => esc_html__( 'Border radius', 'elementor-proradio' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 500,
						],
					],
					'devices' => [ 'desktop', 'tablet', 'mobile' ],
					'desktop_default' => [
						'size' => 5,
						'unit' => 'px',
					],
					'tablet_default' => [
						'size' => 5,
						'unit' => 'px',
					],
					'mobile_default' => [
						'size' => 5,
						'unit' => 'px',
					],
					'selectors' => [
						'{{WRAPPER}} .proradio-elementor--artwork__img img  ' => 'border-radius: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'proradio-alignment',
				[
					'label' => esc_html__( 'Alignment', 'elementor-proradio' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'multiple' => false,
					'options' =>[
						'' => esc_html__( "Default", "proradio"),
						'left' 	=>	esc_html__( "Left", "elementor-proradio"),
						'right'	=>	esc_html__( "Right", "elementor-proradio"),
						'center'	=>	esc_html__( "Center", "elementor-proradio"),
					]
				]
			);			
		$this->end_controls_section();
	}

	/**
	 * Frontend
	 */
	protected function render() {
		$atts = $this->get_settings_for_display();
		?>
		<div class="proradio-elementor proradio-hidden proradio-elementor--artwork proradio-text-<?php echo esc_attr($atts[ 'proradio-alignment' ]) ?>">
			<a class="proradio-inline proradio-elementor--artwork__img " href="#">
				<img src="#">
			</a>
		</div>
		<?php
	}
	
	protected function _content_template() {}
}