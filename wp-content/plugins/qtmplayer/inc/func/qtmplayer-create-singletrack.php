<?php  
/**
 * @package qtmplayer
 * @since 2019 12 21
 */

/**
 * [qtmplayer_create_singletrack outputs the correct HTML to add a track player anywhere]
 * @param  [type] $attr [array of data for the player]
 */
function qtmplayer_create_singletrack( $track ) {
	ob_start();

	// open the playlist
	qtmplayse_playlist_open();

	// add the track
	qtmplayer_create_track( $track ); 

	// Close the playlist
	qtmplayse_playlist_close();

	return ob_get_clean();
}
?>