<?php
/**
 * @package  WordPress
 * @subpackage qtmplayer
 */

/* = This is used to serve json contents
=======================================================================*/
if(!function_exists('qtmplayer_get_json_data')){
function qtmplayer_get_json_data(){
	$tracks = array();
	if(have_posts()): while ( have_posts() ) : the_post();
		global $post;
		if(is_object($post)){

			$thumb = '';
			if(has_post_thumbnail()){
				$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail');
				$thumb = $thumb['0']; 
			}
			$track_repeatable = get_post_meta(get_the_id(), 'track_repeatable', true);

			if(is_array( $track_repeatable )){
				foreach($track_repeatable as $tr){ 
					if($tr['releasetrack_mp3_demo'] == ''){
						continue;
					}
					$icon = 'add_shopping_cart';
					if(array_key_exists('icon_type', $tr)){
						if( $tr['icon_type'] == 'download' ){
							$icon = 'file_download';
						}
					}
					$releasetrack_buyurl ='';
					$releasetrack_mp3_demo ='';
					$releasetrack_artist_name ='';
					$releasetrack_track_title ='';
					$price = '';
					if(array_key_exists('releasetrack_buyurl', $tr)) {
						$releasetrack_buyurl = $tr['releasetrack_buyurl'];
					}
					if(array_key_exists('releasetrack_mp3_demo', $tr)) {
						$releasetrack_mp3_demo = $tr['releasetrack_mp3_demo'];
					}
					if(array_key_exists('releasetrack_artist_name', $tr)) {
						$releasetrack_artist_name = $tr['releasetrack_artist_name'];
					}
					if(array_key_exists('releasetrack_track_title', $tr)) {
						$releasetrack_track_title = $tr['releasetrack_track_title'];
					}
					if(array_key_exists('price', $tr)) {
						if ($tr['price'] !== 'undefined') {
							$price = $tr['price'];
						}
					}
					$tracks[] = array(
						'cover'		=> esc_url($thumb),
						'album' 	=> esc_attr(get_the_title()),
						'link' 		=> esc_attr(get_the_permalink()),
						'buylink' 	=> esc_attr($releasetrack_buyurl),
						'title' 	=> esc_attr($releasetrack_track_title),
						'icon' 		=> esc_attr($icon),
						'file' 		=> esc_attr($releasetrack_mp3_demo),
						'artist' 	=> esc_attr($releasetrack_artist_name),
						'price' 	=> esc_attr($price),
					);
				}
			}
			
			/**
			 * Special playlist created from WP playlist
			 * Extract songs from embedded playlist
			 */
		
			
			$id = $post->ID;

			// Download or buy
			$buylink =  get_post_meta(  $id, 'qtmplayer_dll', true);
			$ext = pathinfo($buylink, PATHINFO_EXTENSION);
			if( $ext == 'mp3'){
				$buylink  = qtmplayer_create_dllink( $buylink );
			}
			




			if ( has_shortcode( $post->post_content, 'playlist' ) ) { 
				$pattern = get_shortcode_regex();
				preg_match_all('/'.$pattern.'/s', get_the_content(), $matches);
				$lm_shortcode = array_keys($matches[2],'playlist'); // lista di tutti gli ID di shortcodes di tipo playlist. Se ne ho 1 torna 0
				if (count($lm_shortcode) > 0) {
				    foreach($lm_shortcode as $sc) {
						$string_data =  $matches[3][$sc];
						$array_param = shortcode_parse_atts($string_data);
				      	if(array_key_exists("ids",$array_param)){
				      		$ids_array = explode(',', $array_param['ids']);
				      		foreach($ids_array as $audio_id){
				      			$metadata = wp_get_attachment_metadata($audio_id);
				      			$artist = '';
				      			if(array_key_exists('artist', $metadata)){
				      				$artist = $metadata['artist'];
				      			}
				      			$tracks[] = array(
									'cover'		=> esc_url($thumb),
									'album' 	=> '',//esc_attr(get_the_title()),
									'link' 		=> get_the_permalink(),
									'buylink' 	=> $buylink,
									'title' 	=> esc_attr(stripslashes(get_the_title($audio_id))),
									'icon' 		=> 'add_shopping_cart',
									'file' 		=> wp_get_attachment_url($audio_id),
									'artist' 	=> esc_attr($artist),
								);
				      		}
				      	}
				      	$active = '';
				    }	   
				}
			}


			
			// Single audio, embedded block or custom fields form plugins
			if( count( $tracks ) == 0 ){
				$file = false;
				$content = $post->post_content;

				$track = array();
				$track['title'] =  get_the_title( $id );
				$track['artist'] = get_the_author_meta( 'display_name' , get_post_field ( 'post_author', $id ) ); 
				$track['album'] = '';
				$track['link'] = get_the_permalink( $id );
				$track['price'] = '';
				$track['buylink'] =  trim( $buylink );
				$track['cover'] = '';
				$track['icon'] = 'download';
				if( has_post_thumbnail( $id ) ) {
					$track['cover'] = get_the_post_thumbnail_url( null, array( 370,370 ) );
				}


				// 1. Check for Audio shortcode
				if(function_exists('parse_blocks')){
					$blocks = parse_blocks( $content );
					foreach ($blocks as $block){
						$audio = false;
						if($block['blockName'] == 'core/audio'){
							$audio = $block[ 'innerHTML' ];
							if( $audio ){
								$dom = new domDocument;
								libxml_use_internal_errors(true);
								$xpath = new DOMXPath(@$dom::loadHTML($audio));
								$src = $xpath->evaluate("string(//audio/@src)");
								if( $src ) {
									$track['sourcetype'] = 'parse_blocks';
									$file = $src;
								}
							}
						}
					}
				}

				// 2. Check for an audio block (Gutenberg block)
				if( false == $file ){
					$pattern = get_shortcode_regex();
					preg_match_all('/'.$pattern.'/s', $content, $matches);
					$shortcodes = array_keys($matches[2],'audio');
					if (count($shortcodes) > 0) {
						$file = $matches[0][0];
						$track['sourcetype'] = 'shortcode';
					}
				}


				// 3. Check for stored audio_file post meta
				if( false == $file ){
					$audio_file = get_post_meta( $id, 'audio_file', true );
					if( $audio_file ) {
						$arr = explode('.mp3', $audio_file);
						$file = $arr[0].'.mp3';
						$track['sourcetype'] = 'meta audio_file';
					}
				}

				// 4. Check for stored enclosure post meta
				if( false == $file ){
					$audio_file = get_post_meta( $id, 'enclosure', true );
					if( $audio_file ) {
						$file = $audio_file;

						// Since 1.2
						// Podctrac compatibility change
						$arr = explode("pts/redirect.mp3/", $file );
						if( count( $arr) > 1 ){
							$file = $arr[1];
						}
						// podtrac end
						
						$arr = explode('.mp3', $file);
						$file = $arr[0].'.mp3';
						$track['sourcetype'] = 'meta enclosure';

						// remove redirects
						$arr = explode('http', $file);
						if( count($arr) > 2) {
							$file = 'http'.urldecode($arr[2]);
						}
					}

				}

				// SINCE 2020 03 26
				// powerpress compatibility
				// Find any field called enclosure something
				// For compatibility with PowerPress
				if( false == $file ){
					$all_metas = get_post_meta( $id ) ;
					$key = preg_grep('/enclosure/', array_keys($all_metas));
					if( $key ){
						$value = $all_metas[current( $key )];
						if( is_array($value) && count($value) > 0 ){
							$file_val = $value[0];
							$arr2= explode("\n", $file_val );
							if( count( $arr2) > 1 ){
								$file_val = $arr2[0]; // should do the trick
							}
							if (strpos($file_val, '.mp3') !== false) {
							    $file = $file_val;
							}
						}
					}
				}



				if( $file ){
					$track['file'] = $file;
					$tracks[] = $track;
				}
			}
		}
	endwhile; endif; 
	die( json_encode($tracks));
}}
if(isset($_GET['qt_json'])){
	add_action('get_header','qtmplayer_get_json_data');
}



/**
 * Force track download
 */

if(isset($_GET['qtmplayer_download'])){

	$file_url = trim( urldecode( $_GET['qtmplayer_download'] ) );
	header('Content-Type: application/octet-stream');
	header("Content-Transfer-Encoding: Binary"); 
	header("Content-disposition: attachment; filename=\"" . basename($file_url) . "\""); 
	readfile($file_url); // do the double-download-dance (dirty but worky)
}













