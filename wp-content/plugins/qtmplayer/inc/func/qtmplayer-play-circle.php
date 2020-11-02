<?php
/**
 * @package  WordPress
 * @subpackage qtmplayer
 */


/**
 *
 * 
 * ==========================================================================
 * This function will produce the circular player for the first enclosed audio
 * ==========================================================================
 * 
 * 	1. 	Check for audio block
 *  2. 	Check for audio shortcode
 *  3. 	Check for post meta audio_file
 *  4. 	Check for post meta enclosure
 *
 * ==========================================================================
 * 
 * 
 */



if(!function_exists( 'qtmplayer_play_circle' )) {
	function qtmplayer_play_circle( $atts = array() ){
		
		ob_start();
	
		extract( shortcode_atts( array(
			'file'		=> false,
			'id' 		=> false, // the post id
			'content' 	=> false,
			'classes' 	=> '', // additional classes for the play circle
		), $atts ) );


		$track = array();

		// Post common data:
		if( false == $id ) {
			$id = get_the_ID();
		}
		if( false == $content ) {
			$content = get_post_field('post_content', $id);
		}

		// Download or buy
		$buylink =  get_post_meta(  $id, 'qtmplayer_dll', true);
		$ext = pathinfo($buylink, PATHINFO_EXTENSION);
		if( $ext == 'mp3'){
			$buylink = qtmplayer_create_dllink( $buylink );
		}
		
		$track['title'] =  get_the_title( $id );
		$track['artist'] = get_the_author_meta( 'display_name' , get_post_field ( 'post_author', $id ) ); 
		$track['album'] = '';
		$track['link'] = get_the_permalink( $id );
		$track['price'] = '';
		$track['buylink'] = $buylink;
		$track['cover'] = '';
		$track['icon'] = 'download';
		if( has_post_thumbnail( $id ) ) {
			$track['cover'] = get_the_post_thumbnail_url( null, array( 370,370 ) );
		}

		// Output start
		$item_classes = array(  
			'qtmplayer-donutcontainer',
			$classes
		);
		$item_classes = implode(' ', $item_classes);

		/**
		 * 
		 * Now we want to extract the first track of the page
		 * and populate an array of parameters ($track).
		 *
		 * We will first check for the Audio embed which is faster,
		 * and eventually after check for gutenberg block.
		 * 
		 */
		
		/**
		 * First check if is a radio channel
		 */

		if( false == $file && 'radiochannel' == get_post_type( $id )){

			$file = get_post_meta( $id, 'mp3_stream_url', true );
			if( $file ){
				
				$minilogo_id = get_post_meta( $id, 'qt_player_icon', true );
				$subtitle = get_post_meta($id, 'qt_radio_subtitle',true);
				$cover = '';
				if( $minilogo_id ){
					$cover = wp_get_attachment_image_src( $minilogo_id, 'medium' );
				}
				if( $cover ){
					$cover = $cover[0];
				}
				$track_data = array(
					'cover'					=> $cover,
					'img_id' 				=> $minilogo_id,
					'title'					=> get_the_title( $id ),
					'artist_name'			=> $subtitle,
					'album'					=> '',
					'buyurl'				=> get_the_permalink( $id ),
					'icon'					=> 'radio',
					'link'					=> get_the_permalink( $id ),
					'price'					=> '',
					'file'					=> $file,
					'type'					=> "radio",
					'radiochannel' 			=> '',
					'servertype'			=> get_post_meta( $id, 'proradio_servertype',true ),
					'host' 					=> get_post_meta( $id, 'qtradiofeedHost',true ),
					'port' 					=> get_post_meta( $id, 'qtradiofeedPort',true ),
					'protocol' 				=> get_post_meta( $id, 'qtradiofeedProtocol',true ),
					'icecasturl' 			=> get_post_meta( $id, 'qticecasturl',true ),
					'icecastmountpoint' 	=> get_post_meta( $id, 'qticecastMountpoint',true ),
					'icecastchannel' 		=> get_post_meta( $id, 'qticecastChannel',true ),
					'radiodotco'			=> get_post_meta( $id, 'qtradiodotco',true ),
					'airtime' 				=> get_post_meta( $id, 'qtairtime',true ),
					'radionomy' 			=> get_post_meta( $id, 'qtradionomy',true ),
					'live365' 				=> get_post_meta( $id, 'qtlive365',true ),
					'textfeed' 				=> get_post_meta( $id, 'qttextfeed',true ),
					'channel' 				=> get_post_meta( $id, 'qtradiofeedChannel',true ),
					'useproxy' 				=> get_post_meta( $id, 'proradio-useproxy', true ),
				);
				?>
				<div class="<?php echo esc_attr( $item_classes ); ?>">
					<div class="qtmplayer-trackitem qtmplayer-donut">
						<span <?php qtmplayer_create_track_data( $track_data ); ?> class="qtmplayer-play qtmplayer-link-sec qtmplayer-play-btn qtmplayer-play-v2">
							<i class="material-icons">play_arrow</i>
						</span>
					</div>
				</div>
				<?php
				return ob_get_clean();
			}
		}

		if( false == $file){
			$_podcast_resourceurl = esc_url( get_post_meta( $id, '_podcast_resourceurl' ,true ) );
			if( $_podcast_resourceurl ){
				$file = $_podcast_resourceurl;
			}
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
							$file = $src;
						}
					}
				}
			}
		}

		// 2. Check for an audio block
		if( false == $file ){
			$pattern = get_shortcode_regex();
			preg_match_all('/'.$pattern.'/s', $content, $matches);
			$shortcodes = array_keys($matches[2],'audio');
			if (count($shortcodes) > 0) {
				$file = $matches[0][0];
			}
		}


		// 3. Check for stored audio_file post meta
		if( false == $file ){
			$audio_file = get_post_meta( $id, 'audio_file', true );
			if( $audio_file ) {
				$file = $audio_file;
			}
			// need to add processing here
			$arr2= explode("\n", $file );
			if( count( $arr2) > 1 ){
				$file = $arr2[0]; // should do the trick
			}
		}

		// SINCE 2020 03 26
		// powerpress compatibility
		// Find any field called enclosure something
		// For compatibility with PowerPress
		if( false == $file ){
			if($link==''){
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
				$file = trim( $arr[0].'.mp3' );
				// remove redirects
				$arr = explode('http', $file);
				if( count($arr) > 2) {
					$file = 'http'.urldecode($arr[2]);
				}
			}
		}

		

		$data = [
			'cover' 	=> $track['cover'],
			'file' 		=> $file,
			'title'		=> $track['title'],
			'artist'	=> $track['artist'],
			'album'		=> $track['album'],
			'link'		=> $track['link'],
			'buylink'	=> $track['buylink'],
			'price'		=> $track['price'],
			'icon'		=> $track['icon']
		];

		// If we have the track data let's create the player
		if( $file ){
			?>
			<div class="<?php echo esc_attr( $item_classes ); ?>">
				<div class="qtmplayer-trackitem qtmplayer-donut">
					<span <?php qtmplayer_create_track_data( $data ); ?> class="qtmplayer-play qtmplayer-link-sec qtmplayer-play-btn qtmplayer-play-v2">
						<i class="material-icons">play_arrow</i>
					</span>
				</div>
			</div>
			<?php
		} 
		
		return ob_get_clean();
		
		// return $output;
	}
}