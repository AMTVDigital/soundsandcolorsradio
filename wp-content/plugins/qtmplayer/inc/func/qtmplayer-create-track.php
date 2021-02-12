<?php  
/**
 * @package qtmplayer
 * @since 2019 12 21
 */

/**
 * [qtmplayer_create_singletrack outputs the correct HTML to add a track player anywhere]
 * @param  [type] $attr [array of data for the player]
 */
if(!function_exists('qtmplayer_create_track')){
function qtmplayer_create_track( $track ) {
	ob_start();
	extract( 
		shortcode_atts( 
			array(
				'img_id' 		=> false,
				'title'			=> '',
				'artist_name'	=> '',
				'album'			=> '',
				'buyurl'		=> '',
				'icon'			=> 'open_in_browser',
				'link'			=> false,
				'file'			=> false,
				'price'			=> false,
				'type'			=> "track",
				'servertype'	=> false,
				'radiochannel' 	=> '',
				'host' 			=> false,
				'port' 			=> false,
				'protocol' 		=> false,
				'icecasturl' 	=> false,
				'icecastmountpoint' => false,
				'icecastchannel'=> false,
				'radiodotco' 	=> false,
				'airtime' 		=> false,
				'radionomy' 	=> false,
				'live365' 		=> false,
				'radioking'		=> false,
				'azuracast'		=> false,
				'securesystems'	=> false,
				'radiojar'		=> false,
				'textfeed' 		=> false,
				'channel' 		=> false,
				'useproxy' 		=> false,
				), 
			$track 
		) 
	);
	switch ($icon){
		case "radio": 
			$icon = 'radio';
			break;
		case "download": 
			$icon = 'file_download';
			break;
		case "cart": 
			$icon = 'add_shopping_cart';
			break;
		default:
			$icon = '';
	}

	/**
	 * Find icon and cover
	 * @var string
	 */
	$pic = '';
	$thumbnail_url  = false;
	if($img_id){
		// Attachment ID
		if( is_attachment($img_id) ){
			$tinythumb = false;
			$tinythumb = wp_get_attachment_image_src($img_id,'post-thumbnail');
			$pic = wp_get_attachment_image_src($img_id,'medium');
			$pic = $pic[0];
			$thumbnail_url = $tinythumb[0];
		// Featured image
		} else {
			if( has_post_thumbnail( $img_id )) {
				$pic = get_the_post_thumbnail_url(null, array(370,370)); 
				$tinythumb = get_the_post_thumbnail_url(null, array(70,70));
				$thumbnail_url = $tinythumb;
			} else if ( wp_get_attachment_image_src($img_id, array(370,370) ) ){
				$pic = wp_get_attachment_image_src($img_id, array(370,370) );
				$pic = $pic[0];
				$tinythumb = wp_get_attachment_image_src($img_id, array(70,70) );
				$thumbnail_url = $tinythumb[0];
			}
		}
	}

	/**
	 * [$data array passed to create the data attributes]
	 */
	$data = [
		'cover' 			=> $pic,
		'file' 				=> $file,
		'title'				=> $title,
		'artist'			=> $artist_name,
		'album'				=> $album,
		'link'				=> $link,
		'buylink'			=> $buyurl,
		'price'				=> $price,
		'icon'				=> $icon,
		'type'				=> $type,
		'servertype'		=> $servertype,
		'radiochannel' 		=> $radiochannel,
		'host' 				=> $host,
		'port' 				=> $port,
		'protocol' 			=> $protocol,
		'icecasturl' 		=> $icecasturl,
		'icecastmountpoint' => $icecastmountpoint,
		'icecastchannel' 	=> $icecastchannel,
		'radiodotco' 		=> $radiodotco,
		'airtime' 			=> $airtime,
		'radionomy' 		=> $radionomy,
		'live365' 			=> $live365,
		'radioking' 		=> $radioking,
		'azuracast' 		=> $azuracast,
		'securesystems' 	=> $securesystems,
		'radiojar'			=> $radiojar,
		'textfeed' 			=> $textfeed,
		'channel' 			=> $channel,
		'useproxy' 			=> $useproxy,
	];
	
	?>
	<li class="qtmplayer-trackitem">
		<?php if( $thumbnail_url ){ ?><img src="<?php echo esc_url($thumbnail_url); ?>" alt="cover"><?php } ?>
		<span <?php qtmplayer_create_track_data( $data ); ?> class="qtmplayer-play qtmplayer-link-sec qtmplayer-play-btn"><i class='material-icons'>play_arrow</i></span>
		<p>
			<span class="qtmplayer-tit"><?php echo esc_html( $title ); ?></span>
			<span class="qtmplayer-art"><?php echo esc_html( $artist_name ); ?></span>
		</p>
	</li>
	<?php  
	echo ob_get_clean();
}
}
?>