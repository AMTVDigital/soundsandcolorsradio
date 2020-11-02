<?php  
/**
 * Create sections using the WordPress Customizer API.
 * @package Kirki
 */
if(!function_exists('proradio_megafooter_kirki_sections')){
	add_action( 'customize_register', 'proradio_megafooter_kirki_sections' );
	function proradio_megafooter_kirki_sections( $wp_customize ) {
		$wp_customize->add_section( 'proradio_megafooter_options_section', array(
			'title'       => esc_html__( 'MegaFooter options', 'qtmplayer' ),
			'priority'       => 90,
		));
	}
}

