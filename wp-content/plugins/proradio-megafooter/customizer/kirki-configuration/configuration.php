<?php  
/**
 * Configuration for the Kirki Customizer.
 * @package Kirki
 */


Kirki::add_config( 'proradio_megafooter_config', array(
	'capability'    => 'edit_theme_options',
	'option_type'   => 'theme_mod'
) );



if(!function_exists('proradio_megafooter_kirki_configuration')){
	add_filter( 'kirki/config', 'proradio_megafooter_kirki_configuration' );
	function proradio_megafooter_kirki_configuration( $config ) {
		return wp_parse_args( array (
			'disable_loader' => true
		), $config );
	}
}

