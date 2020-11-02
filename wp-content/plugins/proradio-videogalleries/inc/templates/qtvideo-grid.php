<?php  


/**
 * [$args Query arguments]
 * @var array
 */
$args = array(
	'post_type' 			=> 'qtvideo',
	'post_status' 			=> 'publish',
	'suppress_filters' 		=> false,
	'ignore_sticky_posts' 	=> 1,
	'posts_per_page' 		=> $quantity,
	'paged' 				=> 1,
	'orderby' 				=> array ('menu_order' => 'ASC', 'date' => 'DESC')
);

/**
 * [$wp_query execution of the query]
 * @var WP_Query
 */
$wp_query = new WP_Query( $args );


$cols_class = '4';
if($columns){
	$cols_class = 12 / intval($columns);
}



?>
<div class="proradio-videogalleries">
	<?php  
	if($showfilters){
	?>
	<div class="proradio-videogalleries__filters">
		<a href="#" data-videogalleries-filter="all"><?php echo esc_html( 'All', 'proradio-videogalleries' ); ?></a>
		<?php  
		/**
		 * Create list of filters to click
		 */
		$filters = array();
		if ( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : $wp_query->the_post();
			$post = $wp_query->post;
			setup_postdata( $post );
			$termsArray = get_the_terms( $post->ID, 'vdl_filters' );
	        if(is_array($termsArray)){
	        	foreach($termsArray as $term){
	        		$filters[ $term->term_id ] = $term->name;
	        	}
	        }
		endwhile; endif; 
		$filters = array_unique($filters);
		wp_reset_postdata();

		// Output the filters
		foreach ($filters as $key => $value) {
			?>
			<a href="#" data-videogalleries-filter="<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $value ); ?></a>
			<?php
		}


		?>
	</div>
	<?php 
	}
	?>

	<div id="proradio-videogalleries-masonry" class="proradio-videogalleries-masonry proradio-videogalleries-row">
		<?php  
		if ( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : $wp_query->the_post();
			$post = $wp_query->post;
			setup_postdata( $post );

			/**
			 * Create filterable data
			 */
			
			$fiters = array();
			$termsArray = get_the_terms( $post->ID, 'vdl_filters' );
			if(is_array( $termsArray )){
				foreach($termsArray as $term){
					$fiters[] = '{'.$term->term_id.'}';
				}
			}
			$fiters_html = implode(',', $fiters);

			?>
				<div data-videogallery-filterids="<?php echo esc_attr($fiters_html); ?>" class="proradio-videogalleries-masonry-item proradio-videogalleries-col proradio-videogalleries-s12 proradio-videogalleries-m4 proradio-videogalleries-l<?php echo esc_attr( $cols_class ); ?> ">
					<?php  
					include (  proradio_videogalleries_local_template_path() . 'qtvideo-item.php' );
					?>
				</div>
			<?php  
		endwhile; else: ?>
			<h3><?php esc_html_e("Sorry, nothing here","proradio"); ?></h3>
		<?php endif;
		wp_reset_postdata();
		?>
	</div>
</div>