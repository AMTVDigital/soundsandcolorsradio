<?php  
/**
 * Configuration for the Kirki Customizer.
 * @package Kirki
 */


Kirki::add_config( 'qtmplayer_config', array(
	'capability'    => 'edit_theme_options',
	'option_type'   => 'theme_mod'
) );



if(!function_exists('qtmplayer_kirki_configuration')){
function qtmplayer_kirki_configuration( $config ) {
	return wp_parse_args( array (
		'disable_loader' => true
	), $config );
}}

add_filter( 'kirki/config', 'qtmplayer_kirki_configuration' );