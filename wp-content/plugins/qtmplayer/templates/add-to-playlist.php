<?php
/**
 * @package  WordPress
 * @subpackage qtmplayer
 */


/**
 * This function displays an icon that will create the "add to playlist" link
 */

if(!function_exists( 'qtmplayer_add_to_playlist' )) {
	function qtmplayer_add_to_playlist( $atts = array() ){
		ob_start();
	
		extract( shortcode_atts( array(
			'id' 		=> 	false,
			'classes' 	=>	'material-icons',
			'icon'		=> 'playlist_add'
		), $atts ) );

		if( false == $id ) {
			$id = get_the_ID();
		}
		
		?>
			<i data-notificate="#qtadded"  data-qtmplayer-addrelease="<?php echo esc_url(  add_query_arg( 'qt_json', '1',  get_the_permalink( $id ) ) ); ?>" class="<?php echo esc_html( $classes ); ?>"><?php echo esc_html( $icon ); ?></i>
		<?php
		$output = ob_get_clean();
		return $output;
	}
}