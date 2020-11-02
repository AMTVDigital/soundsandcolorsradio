<?php  
/**
 * =================================================
 * Featured audio posts
 * =================================================
 */
$featureds = get_theme_mod( 'qtmplayer_player_podcastfeatured' );
$ids_featured = false;
if ($featureds){
	$ids_featured = str_replace(' ', '', $featureds);
	$args = array (
		'post_type' =>  'post',
		'post__in'=> explode(',',$ids_featured),
		'orderby' => 'post__in',
	);  
	$wp_query = new WP_Query( $args );
	if ( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : $wp_query->the_post();
		$post = $wp_query->post;
		setup_postdata( $post );
		include 'part-post-playlist.php';
	endwhile; endif; 
	wp_reset_postdata();
}