<?php
/**
 * 
 * @package qtmplayer
 * @package 
 *
 * 
 * 
 */

$quantity = 0;
$args = array(
	'post_type' => 'radiochannel',
	'post_status' => 'publish',
);
$wp_query = new WP_Query( $args );
$quantity = $quantity + $wp_query->found_posts;

$args = array(
	'post_type' => 'radiochannel',
	'ignore_sticky_posts' => 1,
	'post_status' => 'publish',
	'orderby' => array ( 'menu_order' => 'ASC', 'date' => 'DESC'),
	'suppress_filters' => false,
	'posts_per_page' => -1,
	'paged' => 1,
	'meta_query' => array(
		'relation' => 'OR',
		array(
			'key' => 'qt-excludefromplaylist',
			'compare' => 'NOT EXISTS'
		),
		array(
			'key' => 'qt-excludefromplaylist',
			'value' => false,
			'compare' => '='
		)
	)
);
$wp_query = new WP_Query( $args );
if ( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : $wp_query->the_post();
	$post = $wp_query->post;
	setup_postdata( $post );
	
	/**
	 * Radio item loaded in the playlist
	 */
						
	$id = $post->ID;
	$file = get_post_meta( $id, 'mp3_stream_url', true );

	/**
	 * @since 3.0.8
	 * Automatically use an alternative URL if wordpress detects a mobile browser
	 */
	$file_mobile = get_post_meta( $id, 'mp3_stream_url_mobile', true );
	if( $file_mobile && wp_is_mobile() ){
		$file = $file_mobile;
	}

	
	if( $file ){
		$minilogo_id = get_post_meta( $id, 'qt_player_icon', true );
		$subtitle = get_post_meta($id, 'qt_radio_subtitle',true);
		$excludefromplaylist = get_post_meta($id, 'qt-excludefromplaylist',true);

		
		$cover = '';
		if( $minilogo_id ){
			$tinythumb = wp_get_attachment_image_src( $minilogo_id, 'thumbnail' );
			$cover = wp_get_attachment_image_src( $minilogo_id, 'medium' );
		}
		$track_data = array(
			'img_id' 				=> $minilogo_id,
			'title'					=> $post->post_title,
			'artist_name'			=> $subtitle,
			'album'					=> '',
			'buyurl'				=> get_the_permalink( $post->ID ),
			'icon'					=> 'radio',
			'link'					=> get_the_permalink( $post->ID ),
			'price'					=> '',
			'file'					=> trim( $file ),
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
			'radioking' 			=> get_post_meta( $id, 'qtradioking',true ),
			'azuracast' 			=> get_post_meta( $id, 'qtazuracast',true ),
			'textfeed' 				=> get_post_meta( $id, 'qttextfeed',true ),
			'channel' 				=> get_post_meta( $id, 'qtradiofeedChannel',true ),
			'useproxy' 				=> get_post_meta( $id, 'proradio-useproxy', true ),
		);
		qtmplayer_create_track( $track_data );
	}
	wp_reset_postdata();
endwhile; endif;
wp_reset_postdata();


