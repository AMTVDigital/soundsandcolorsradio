<?php





/**
 * =================================================
 * Kentha preload podcast
 * =================================================
 * @since 1.9.0
 * @var array
 * Featured releases by ID
 */
$featureds = get_theme_mod( 'qtmplayer_player_podcastfeatured' );
$ids_featured = false;
if ($featureds){
	$ids_featured = str_replace(' ', '', $featureds);
	$args = array (
		'post_type' =>  'podcast',
		'post__in'=> explode(',',$ids_featured),
		'orderby' => 'post__in',
	);  
	$wp_query = new WP_Query( $args );
	if ( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : $wp_query->the_post();
		$post = $wp_query->post;
		setup_postdata( $post );
		$resource_url = get_post_meta(  $post->ID, '_podcast_resourceurl', true );
		if($resource_url !=''){   
			$regex_mp3 = "/.mp3/";
			if (preg_match ( $regex_mp3 , $resource_url ) ) {
				$subtitle = get_post_meta( $post->ID, '_podcast_artist', true );
				$track_data = array(
					'img_id' 				=> $post->ID,
					'title'					=> $post->post_title,
					'artist_name'			=> get_post_meta( $post->ID, '_podcast_artist', true ),
					'album'					=> '',
					'icon'					=> 'download',
					'link'					=> get_the_permalink( $post->ID ),
					'file'					=> trim( $resource_url ),
				);
				qtmplayer_create_track( $track_data );
			}
		}
	endwhile; endif; 
	wp_reset_postdata();
}

/**
 * Default release extraction
 * @since 1.0.0
 */
$releases_amount = intval( get_theme_mod( 'qtmplayer_player_podcastamount', '1' ) );
if ($releases_amount !== 0){
	$args = array(
		'post_type' => 'podcast',
		'ignore_sticky_posts' => 1,
		'post_status' => 'publish',
		'orderby' => array ( 'menu_order' => 'ASC', 'date' => 'DESC'),
		'suppress_filters' => false,
		'posts_per_page' => $releases_amount, // @since 1.9.0
		'paged' => 1,
		'meta_query' => array(
			'relation' => 'OR', /* <-- here */
			array(
				'key' => '_podcast_resourceurl',
				'value' => '.mp3',
				'compare' => 'LIKE'
			),
			array(
				'key' => '_podcast_resourceurl',
				'value' => array( 0, 9999999999 ),
		        'compare' => 'BETWEEN',
		        'type' => 'NUMERIC',
			)
		)
	);

	/**
	 * Remove featured IDS from the result to avoid duplicates
	 * @since 1.9.0
	 */
	if( $ids_featured ){
		$args['post__not_in'] = explode(',',$ids_featured);
	}
	$wp_query = new WP_Query( $args );

	if ( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : $wp_query->the_post();
		$post = $wp_query->post;
		setup_postdata( $post );
		

		$_podcast_resourceurl = get_post_meta( intval($post->ID), '_podcast_resourceurl' ,true );
		if(is_numeric($_podcast_resourceurl)){
			$_podcast_resourceurl = wp_get_attachment_url( intval( $_podcast_resourceurl ) );
		} 
		
		if( $_podcast_resourceurl ){
			$_podcast_resourceurl = esc_url($_podcast_resourceurl );
			$file = $_podcast_resourceurl;
		}


		if($_podcast_resourceurl !=''){   
			$regex_mp3 = "/.mp3/";
			if (preg_match ( $regex_mp3 , $_podcast_resourceurl ) ) {
				$subtitle = get_post_meta( $post->ID, '_podcast_artist', true );
				$track_data = array(
					'img_id' 				=> $post->ID,
					'title'					=> $post->post_title,
					'artist_name'			=> get_post_meta( $post->ID, '_podcast_artist', true ),
					'album'					=> '',
					'icon'					=> 'download',
					'link'					=> get_the_permalink( $post->ID ),
					'file'					=> trim( $_podcast_resourceurl ),
				);
				qtmplayer_create_track( $track_data );
			}
		}
	endwhile; endif; 
	wp_reset_postdata();
}


/**
 * =================================================
 * END OF Kentha preload podcast
 * =================================================
 */

?>