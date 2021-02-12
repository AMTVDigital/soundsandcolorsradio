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


class ProradioElementorCF7 extends Widget_Base {
	public function get_name() {
		return 'proradio-elementor-qt-cf7'; // need to use same ID in the script js
	}
	public function get_title() {
		return esc_html__( 'Contact Form 7', 'proradio-elementor' );
	}
	public function get_icon() {
		return 'proradio-elementor-icons icon-prel-cf7';
	}
	public function get_categories() {
		return [ 'aaa-proradio' ]; // needs to be registered in _plugin.php
	}
	// public function __construct($data = [], $args = null) {
 //      parent::__construct($data, $args);
 //      wp_register_script( 'proradio-elementor-qt-caption', plugins_url( '/caption.js', __FILE__ ), [ 'elementor-frontend' ], '1.0.0', true );
 //   	}
 // 	public function get_script_depends() {
	//      return [ 'proradio-elementor-qt-caption' ];
	// }

	protected function _register_controls() {
		$this->start_controls_section(
			'section_settings_form',
			[
				'label' => esc_html__( 'Settings', 'proradio-elementor' ),
			]
		);
			
			$this->add_control(
				'form_id',
				[
					'label' => esc_html__( 'Form', 'proradio-elementor' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'multiple' => false,
					'options' => elementor_proradio_autocomplete('wpcf7_contact_form')
				]
			);
			
		$this->end_controls_section();
	}

	/**
	 * Frontend
	 */
	protected function render() {
		$atts = $this->get_settings_for_display();
		echo do_shortcode('[contact-form-7 id="'.$atts['form_id'].'"]');
	}
	
	protected function _content_template() {}
}