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
 * 	PART 1: CHECK FOR TRAKLIST META FIELD
 *
 * 	PART 2: IF TRACKLIST, CHECK FOR THE PODCAST MAIN URL
 * 	1. 	Check for audio block
 *  2. 	Check for audio shortcode
 *  3. 	Check for post meta audio_file
 *  4. 	Check for post meta enclosure
 *
 * 	PART 3: IF THERE IS BOTH TRACKLIST AND FILE URL, DO THE TRACKLIST
 *  
 *
 * ==========================================================================
 * 
 * 
 */



if(!function_exists( 'qtmplayer_tracklist' )) {
	function qtmplayer_tracklist( $atts = array() ){
		
		ob_start();
	
		extract( shortcode_atts( array(
			'id' 			=> false, // the post id
			'classes' 		=> '', // additional classes for the tracklist container
			'title_classes'	=> '', // additional classes for the tracklist title
			'print' 		=> false,
			'content'		=> false // optionally pass the content where we look for the audio
		), $atts ) );

		/**
		 * PART 1: CHECK FOR TRAKLIST META FIELD
		 * =============================================================
		 */
		
		$tracklist = get_post_meta( $id, 'qtmplayer_tracklist', true );
		if(!$tracklist || $tracklist == '') {
			return;
		}
		$qtmplayer_tracklist_title = get_post_meta( $id, 'qtmplayer_tracklist_title', true );
		

		/**
		 * PART 2: IF TRACKLIST, CHECK FOR THE PODCAST MAIN URL
		 * =============================================================
		 */

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

		/**
		 * 
		 * Now we want to extract the first track of the page
		 * and populate an array of parameters ($track).
		 *
		 * We will first check for the Audio embed which is faster,
		 * and eventually after check for gutenberg block.
		 * 
		 */
		
		$file = false;
		// 0. Check if is the featured file of a podcast
		// For retro compatibility with existing proradio podcasts
		$buylink =  get_post_meta(  $id, 'qtmplayer_dll', true);
		$_podcast_resourceurl = esc_url( get_post_meta( $id, '_podcast_resourceurl' ,true ) );
		if( $_podcast_resourceurl ){
			$file = $_podcast_resourceurl;
		}


		// 1. Check for Audio shortcode
		if( false == $file ){
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

		// If we have the track data let's create the player
				
		if($tracklist){ 
			if($tracklist[0]['title'] != ''){

				// Output start
				$item_classes = array(
					'qtmplayer-tracklist',
					$classes
				);
				$item_classes = implode(' ', $item_classes);


				// Output start
				$title_classes = array(
					'qtmplayer-tracklist__title',
					$title_classes
				);
				$title_classes = implode(' ', $title_classes);

				/**
				 * OUTPUT START
				 * ====================================================
				 */
				
				?>
				<div class="<?php echo esc_attr( $item_classes ); ?>">
					<div class="qtmplayer-tracklist__content">
						<?php  
						if( $qtmplayer_tracklist_title ){
							/**
							 * TITLE (PARAMETER)
							 */
							?>
							<h5 class="<?php echo esc_attr( $title_classes ); ?>"><?php echo wp_strip_all_tags( $qtmplayer_tracklist_title, true ); ?></h5>
							<?php
						}
						?>
						<ul>
							<?php  
							foreach ($tracklist as $item){
								if($item['title'] != '' && $item['cue'] !== ''){
									$cue = date( "H:i:s", strtotime($item['cue']));
									?>
									<li><a data-qttrackurl="<?php echo esc_url($file); ?>" data-qtplayercue="<?php echo esc_attr($cue); ?>"><i class="material-icons">fast_forward</i></a> <?php echo esc_html($cue); ?> - <strong><?php echo esc_html($item['artist'].' - '.$item['title']); ?></strong></li>
									<?php
							}	}
							?>
						</ul>
					</div>
				</div>	
				<?php
			}
		}
		
		if( true == $print ){
			echo ob_get_clean();
		} else {
			return ob_get_clean();
		}
		
	}
}