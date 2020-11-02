<?php  


/**
 * ==================================================================
 * 1. Extract track from Audio shortcode
 * ==================================================================
 */

$content = get_the_content();

// Post common data:
$id = $post->ID;
$tracktitle = get_the_title();
$artist = get_the_author_meta('display_name');
$link = get_the_permalink();
$cover = '';
$thumb = false;


$track_found = false;

// Download or buy
$buylink =  get_post_meta(  $id, 'qtmplayer_dll', true);
$ext = pathinfo($buylink, PATHINFO_EXTENSION);
if( $ext == 'mp3'){
	$buylink = qtmplayer_create_dllink( $buylink );
}


if( has_post_thumbnail( $id )) {
	$cover = get_the_post_thumbnail_url(null,array(370,370));
	$thumb = get_the_post_thumbnail_url(null,array(70,70));
}

if ( has_shortcode($content, 'audio') ) { 
	$pattern = get_shortcode_regex();
	preg_match_all('/'.$pattern.'/s', $content, $matches);
	$lm_shortcode = array_keys($matches[2],'audio'); // lista di tutti gli ID di shortcodes di tipo playlist. Se ne ho 1 torna 0
	ob_start();
	if (count($lm_shortcode) > 0) {
		foreach($lm_shortcode as $sc) {
			$string_data =  $matches[3][$sc];
			$array_param = shortcode_parse_atts($string_data);
			if(array_key_exists(0, $array_param)){
				$file = $array_param[0];
			}
			if(array_key_exists('mp3', $array_param)){
				$file = $array_param['mp3'];
			}
			if(array_key_exists('aac', $array_param)){
				$file = $array_param['aac'];
			}
			$track_data = array(
				'img_id' 		=> $id,
				'title'			=> $tracktitle,
				'artist_name'	=> $artist,
				'album'			=> $tracktitle,
				'buyurl'		=> $buylink,
				// 'icon'			=> $icon,
				'link'			=> $link,
				'price'			=>	'',
				'file'			=> $file,
			);
			qtmplayer_create_track( $track_data ); 
			// $track_found = true;
		}
	}
	echo  ob_get_clean();
}

/**
 * ==================================================================
 * 2. Extract track from Audio block
 * ==================================================================
 */

if( function_exists( 'parse_blocks' ) && !$track_found ){
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
					$track_data = array(
						'img_id' 		=> $id,
						'title'			=> $tracktitle,
						'artist_name'	=> $artist,
						'album'			=> '',
						'buyurl'		=> $buylink,
						// 'icon'			=> $icon,
						'link'			=> $link,
						'price'			=>	'',
						'file'			=> $src,
					);
					qtmplayer_create_track( $track_data ); 
					$track_found = true;
				}
			}
		}
	}
}


// 3 not set

// 4. Check for stored enclosure post meta
if( false == $track_found ){
	$file = false;
	$audio_file = get_post_meta( $id, 'enclosure', true );
	// Since 1.2
	// Podctrac compatibility change
	$arr = explode("pts/redirect.mp3/", $audio_file );
	if( count( $arr) > 1 ){
		$audio_file = $arr[1];
	}
	// poidtrac end
	$arr = explode('.mp3', $audio_file);

	$file = trim( $arr[0].'.mp3' );
	// remove redirects
	$arr = explode('http', $file);
	if( count($arr) > 2) {
		$file = 'http'.urldecode($arr[2]);
	}
	if( $file ){
		$track_data = array(
			'img_id' 		=> $id,
			'title'			=> $tracktitle,
			'artist_name'	=> $artist,
			'album'			=> '',
			'buyurl'		=> $buylink,
			'icon'			=> 'download',
			'link'			=> $link,
			'price'			=>	'',
			'file'			=> $file,
		);
		qtmplayer_create_track( $track_data ); 
	}
	
}













