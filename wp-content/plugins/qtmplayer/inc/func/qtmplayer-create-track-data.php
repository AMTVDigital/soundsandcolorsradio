<?php  
/**
 * @package qtmplayer
 * @since 2019 12 29
 */

/**
 * [qtmplayer_create_track_data outputs the data attributes used by the player]
 */
if(!function_exists('qtmplayer_create_track_data')){
	function qtmplayer_create_track_data( $data = array() ) {
		ob_start();
		if( count($data) == 0) { return; }
		$data = array_filter( $data );
		foreach( $data as $key => $val ){
			?>
			data-testme="1" data-qtmplayer-<?php echo esc_html( $key ); ?>="<?php echo esc_attr( $val ); ?>"
			<?php 
		}
		echo ob_get_clean();
		return;
	}
}