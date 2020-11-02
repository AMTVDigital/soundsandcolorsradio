<?php

/**
 * returns just the URL of the download
 */


function qtmplayer_downloadlink($post_id){
	return qtmplayer_create_dllink( get_post_meta( $post_id, 'qtmplayer_dll', true) );
}