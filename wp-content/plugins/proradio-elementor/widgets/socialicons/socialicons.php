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


class ProradioElementorSocialIcons extends Widget_Base {
	public function get_name() {
		return 'proradio-elementor-socialicons'; // need to use same ID in the script js
	}
	public function get_title() {
		return __( 'Social Icons', 'proradio-elementor' );
	}
	public function get_icon() {
		return 'proradio-elementor-icons icon-prel-social';
	}
	public function get_categories() {
		return [ 'proradio-elementor' ]; // needs to be registered in _plugin.php
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'section_icons',
			[
				'label' => __( 'Icons', 'proradio-elementor' ),
			]
		);	
			$this->add_control(
				'text',
				[
					'label' => esc_html__( 'Button label', 'elementor-proradio' ),
					'type' => Controls_Manager::TEXT,
					'default' => esc_html__('Click here', 'elementor-proradio')
				]
			);
			$this->add_control(
				'link',
				[
					'label' => esc_html__( 'Button link', 'elementor-proradio' ),
					'type' => Controls_Manager::TEXT,
				]
			);
			$this->add_control(
				'target',
				[
					'label' => esc_html__( 'Button target', 'elementor-proradio' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'multiple' => false,
					'options' =>[
						'' => esc_html__('Default', 'elementor-proradio'),
						'_blank' => esc_html__('New tab', 'elementor-proradio')
					]
				]
			);
			$this->add_control(
				'style',
				[
					'label' => esc_html__( 'Style', 'elementor-proradio' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'multiple' => false,
					'options' =>[
						"proradio-btn-default" 	=> 	esc_html__( "Default",'proradio-elementor'),
						"proradio-btn-primary" 	=> 	esc_html__( "Primary",'proradio-elementor'),
						"proradio-btn__white" 	=> 	esc_html__( "White",'proradio-elementor'),
						"proradio-btn__bold" 	=> 	esc_html__( "Bold",'proradio-elementor'),
						"proradio-btn__txt" 	=> 	esc_html__( "Text only",'proradio-elementor')
					]
				]
			);
			$this->add_control(
				'alignment',
				[
					'label' => esc_html__( 'Alignment', 'elementor-proradio' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'multiple' => false,
					'options' =>[
						'' => esc_html__( "Default", "proradio"),
						'alignleft' 	=>	esc_html__( "Left", 'proradio-elementor'),
						'alignright'	=>	esc_html__( "Right", 'proradio-elementor'),
						'aligncenter'	=>	esc_html__( "Center", 'proradio-elementor'),
					]
				]
			);
			$this->add_control(
				'icon',
				[
					'label' => esc_html__( 'Icon', 'elementor-proradio' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => false,
					'options' =>[
						false				=> esc_html__( 'No icon', 'proradio-elementor' ),
						'android' 			=> esc_html__( 'Android', 'proradio-elementor' ),
						'amazon' 			=> esc_html__( 'Amazon', 'proradio-elementor' ),
						'beatport' 			=> esc_html__( 'Beatport', 'proradio-elementor' ),
						'blogger' 			=> esc_html__( 'Blogger', 'proradio-elementor' ),
						'facebook' 			=> esc_html__( 'Facebook', 'proradio-elementor' ),
						'flickr' 			=> esc_html__( 'Flickr', 'proradio-elementor' ),
						'instagram' 		=> esc_html__( 'Instagram', 'proradio-elementor' ),
						'itunes' 			=> esc_html__( 'Itunes', 'proradio-elementor' ),
						'juno' 				=> esc_html__( 'Juno', 'proradio-elementor' ),
						'kuvo' 				=> esc_html__( 'Kuvo', 'proradio-elementor' ),
						'linkedin' 			=> esc_html__( 'Linkedin', 'proradio-elementor' ),
						'trackitdown' 		=> esc_html__( 'Trackitdown', 'proradio-elementor' ),
						'spotify' 			=> esc_html__( 'Spotify', 'proradio-elementor' ),
						'soundcloud' 		=> esc_html__( 'Soundcloud', 'proradio-elementor' ),
						'snapchat' 			=> esc_html__( 'Snapchat', 'proradio-elementor' ),
						'skype' 			=> esc_html__( 'Skype', 'proradio-elementor' ),
						'reverbnation' 		=> esc_html__( 'Reverbnation', 'proradio-elementor' ),
						'residentadvisor' 	=> esc_html__( 'Resident Advisor', 'proradio-elementor' ),
						'pinterest' 		=> esc_html__( 'Pinterest', 'proradio-elementor' ),
						'myspace' 			=> esc_html__( 'Myspace', 'proradio-elementor' ),
						'mixcloud' 			=> esc_html__( 'Mixcloud', 'proradio-elementor' ),
						'rss' 				=> esc_html__( 'RSS', 'proradio-elementor' ),
						'twitter' 			=> esc_html__( 'Twitter', 'proradio-elementor' ),
						'vimeo' 			=> esc_html__( 'Vimeo', 'proradio-elementor' ),
						'vk' 				=> esc_html__( 'VK.com', 'proradio-elementor' ),
						'youtube' 			=> esc_html__( 'YouTube', 'proradio-elementor' ),
						'whatsapp' 			=> esc_html__( 'Whatsapp', 'proradio-elementor' ),
					]
				]
			);
		$this->end_controls_section();
	}

	/**
	 * Frontend
	 */
	protected function render() {
		if(function_exists('proradio_template_socialicons_shortcode')){
			echo proradio_template_socialicons_shortcode( $this->get_settings_for_display() );
		}
	}

	
	protected function _content_template() {}
}