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
use Elementor\SGroup_Control_Background;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

require_once( __DIR__ . '/customplayer-function.php' );

class ProradioElementorCustomPlayer extends Widget_Base {
	public function get_name() {
		return 'proradio-elementor-customplayer'; // need to use same ID in the script js
	}
	public function get_title() {
		return esc_html__( 'Custom Player', 'proradio-elementor' );
	}
	public function get_icon() {
		return 'proradio-elementor-icons icon-prel-radio-card';
	}
	public function get_categories() {
		return [ 'aaa-proradio' ]; // needs to be registered in _plugin.php
	}

	public function __construct($data = [], $args = null) {
      parent::__construct($data, $args);
      wp_register_script( 'proradio-elementor-customplayer', plugins_url( '/customplayer.js', __FILE__ ), [ 'elementor-frontend' ], '1.0.0', true );
   	}
 	public function get_script_depends() {
	     return [ 'proradio-elementor-customplayer' ];
	}

	// Controls
	protected function _register_controls() {
		require( __DIR__ . '/controls/container.php' );
		require( __DIR__ . '/controls/positioning.php' );
		require( __DIR__ . '/controls/logo.php' );
		require( __DIR__ . '/controls/button.php' );
		require( __DIR__ . '/controls/player.php' );
		require( __DIR__ . '/controls/current-show.php' );
		
	}
	/**
	 * Frontend
	 */
	protected function render() {
		$atts = $this->get_settings_for_display();
		if(function_exists('proradio_elementor_customplayer')){
			echo proradio_elementor_customplayer( $atts );
		}
	}
	protected function _content_template() {}
}