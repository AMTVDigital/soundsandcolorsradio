<?php
/**
 * =================================================
 * QtMplayer custom playlist
 * =================================================
 * @since 1.9.0
 * @var array
 */
$playlist = get_theme_mod( 'qtmplayer_custom_playlist' );
if($playlist){
	if( is_array( $playlist )){
		$n = 1;
		foreach($playlist as $track){
			$track_index = str_pad($n, 2 , "0", STR_PAD_LEFT);
			$neededEvents = array('title','artist','album','buylink','link', 'sample', 'art','icon', 'price');
			unset($thumb);
			foreach($neededEvents as $ne){
				if(!array_key_exists($ne,$track)){
					$track[$ne] = '';
				}
			}
			switch ($track['icon']){
				case "download": 
					$icon = 'file_download';
					break;
				case "cart": 
				default:
					$icon = 'add_shopping_cart';
			}


			// Get the sample URL
			$file = false;
			if( array_key_exists('sample',  $track)) {
				if( $track['sample'] !== '' ) {
					$file = wp_get_attachment_url( $track['sample'] );
					$price = $track['price'];
					$track_data = array(
						'img_id' 		=> ($track['art'] != '' ) ? $track['art'] : false,
						'title'			=> $track['title'],
						'artist_name'	=> $track['artist'],
						'album'			=> $track['album'],
						'buyurl'		=> $track['buylink'],
						'icon'			=> $icon,
						'link'			=> $track['link'],
						'price'			=> ($track['price'] != '' ) ? $track['price'] : '',
						'file'			=> $file,
					);
					qtmplayer_create_track( $track_data ); 
				}
			}
			$n = $n + 1;
		}
	}
}


/**
 * =================================================
 * END OF QtMplayer custom playlist
 * =================================================
 */