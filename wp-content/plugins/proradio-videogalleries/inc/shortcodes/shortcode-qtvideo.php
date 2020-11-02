<?php
/**
 * @package Qt VideoGalleries
 * @version  2.0
 */


if( !function_exists( 'proradio_videogalleries_sc ') ){
	function proradio_videogalleries_sc( $atts ){
		/**
		* Shortcode atts
		*/
		extract( shortcode_atts( array(
			'columns'		=> 4,
			'showfilters' 	=> 1,
			'showtitle' 	=> 1,
			'showtags'		=> 1,
			'quantity'		=> -1,
			'showpreview' 	=> 0
		), $atts ) );
		ob_start();
		include (  proradio_videogalleries_local_template_path() . 'qtvideo-grid.php' );
		return ob_get_clean();
	}
	add_shortcode( 'proradio-videogalleries', 'proradio_videogalleries_sc' );
	// retro compatibility
	add_shortcode( 'videolove', 'proradio_videogalleries_sc' );
}