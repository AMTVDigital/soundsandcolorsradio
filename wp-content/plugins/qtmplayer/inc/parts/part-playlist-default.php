<?php  
/**
 * Default podcast extraction
 * @since 1.0.0
 */
$releases_amount = intval( get_theme_mod( 'qtmplayer_player_audiopostamount', '1' ) );
if ($releases_amount !== 0){
	$args = array(
		'post_type' => 'post',
		'post_status' => 'publish',
		'orderby' => array ( 'date' => 'DESC'),
		'suppress_filters' => false,
		'posts_per_page' => $releases_amount, // @since 1.9.0
		'paged' => 1,
		'tax_query' => array(
			array(                
				'taxonomy' => 'post_format',
				'field' => 'slug',
				'terms' => array( 
					'post-format-audio',
				),
				'operator' => 'IN'
			)
		),
	);
	if( $ids_featured ){
		$args['post__not_in'] = explode(',',$ids_featured);
	}
	$wp_query = new WP_Query( $args );
	if ( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : $wp_query->the_post();
		$post = $wp_query->post;
		setup_postdata( $post );
		include 'part-post-playlist.php';
	endwhile; 
	endif; 
	
	wp_reset_postdata();
}