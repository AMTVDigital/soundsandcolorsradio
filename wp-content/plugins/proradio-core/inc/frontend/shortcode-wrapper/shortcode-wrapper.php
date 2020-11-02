<?php  
/**
 *
 *	shortcode-wrapper.php
 *	Author: Pro.Radio
 *	This component is a wrapper for shortcodes
 *	so the themes can customize those aspetcs without editing the engine of the backend
 *	and adding maintainability to the software.
 * 
 */

if(!function_exists('proradio_core_custom_shortcode')){
function proradio_core_custom_shortcode ( $shortcode , $function ){
	add_shortcode($shortcode , $function);
}}