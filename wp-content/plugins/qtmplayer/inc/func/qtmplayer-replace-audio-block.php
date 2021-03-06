<?php 
/**
 * Spare functions to extract audio from contents
 */


function qtmplayer_audio_block( $content ) {
	$player = '';
	if(get_theme_mod( 'qtmplayer_replace_default', '1' ) && is_single()
	){
		ob_start();
		$id = get_the_ID();
		$tracktitle = get_the_title($id);
		$link = get_the_permalink($id);
		$cover = '';
		$thumb = false;
		if( has_post_thumbnail( $id )) {
			$cover = get_the_post_thumbnail_url(null,array(370,370));
			$thumb = get_the_post_thumbnail_url(null,array(70,70));
		}

		// Download or buy
		$buylink =  get_post_meta(  $id, 'qtmplayer_dll', true);
		$ext = pathinfo($buylink, PATHINFO_EXTENSION);
		if( $ext == 'mp3'){
			$buylink = qtmplayer_create_dllink( $buylink );
		}

		
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
						$file = $src;
						$track = array();
						$track['title'] = get_the_title();
						$track['artist'] = get_the_author();
						$track['album'] = '';
						$track['link'] = get_the_permalink();
						$track['price'] = '';
						$track['buylink'] = $buylink; // creare foce download link
						$icon = 'download';

						$track_data = array(
							'img_id' 		=> $id,
							'title'			=> get_the_title(),
							'artist_name'	=> get_the_author(),
							'album'			=> '',
							'buyurl'		=> $buylink,
							'icon'			=> 'download',
							'link'			=> get_the_permalink(),
							'price'			=>	'',
							'file'			=> $src,
						);
						?>
						<div class="qtmplayer__embeddedaudio">
						<?php  
						echo qtmplayer_create_singletrack($track_data);
						?>
						</div>
						<?php  
					}
				}
			}
		}
		$player = ob_get_clean();

		/**
		 * Display the tracklist below the player
		 * @var array
		 */
		$atts = array(
			'id' => $id,
			'title_classes'	=> false,
			'classes' => 'qtmplayer-tracklist__autogenerated qtmplayer-tracklist__autogenerated__before', // additional container classes
			'print' => false // include the echo function
		);
		if(function_exists('qtmplayer_tracklist')) {
			$player .= qtmplayer_tracklist( $atts );
		}
	}
    return $player.$content;
}
// Pro.Radio
// 2020 06 06 
add_filter( 'the_content', 'qtmplayer_audio_block', 1 );










