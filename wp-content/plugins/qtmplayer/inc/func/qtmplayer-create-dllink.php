<?php

/**
 * Creates a special URL to force the download of the linked file
 */

function qtmplayer_create_dllink($link){
	$link_a = explode('.', $link);
	if(count($link_a) > 1){
		if(end( $link_a ) == 'mp3' || end( $link_a ) == 'wav' || end( $link_a ) == 'aac' || end( $link_a ) == 'zip'){
			
			$link  = add_query_arg(
			 	array(
			 		'qtmplayer_download' => urlencode( $link ),
			 		'_noajax' => '1'
			 	),
			 	 home_url( '/' )
			);
		}
	}
	return $link;
}