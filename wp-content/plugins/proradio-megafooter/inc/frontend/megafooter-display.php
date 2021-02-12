<?php
/**
 * @package proradio-megafooter
 */

if(!function_exists('proradio_megafooter_display')){
	// add_action('wp_footer', 'proradio_megafooter_display');
	function proradio_megafooter_display(){


		if( !function_exists('proradio_megafooter_posttype_name')){
			return;
		}

		if ( get_post_type( get_the_ID() ) === proradio_megafooter_posttype_name() ) {
			return;
		}

		if ( isset( $_GET['vc_editable'] ) && 'true' === $_GET['vc_editable'] ) {
			// return;
		}

		// 
		// 
		// Check if the actual post has a special footer selected
		// 
		// 
		wp_reset_postdata();

		// global $post;

		$granular_footer = get_post_meta( $post->ID,  'proradio-megafooter-granular', true );
		if( $granular_footer == 'hide' ){
			return; // stop all, no footers here
		}

		if($granular_footer && $granular_footer != 'hide'){
			// Display a specific footer
			$args = array(
			  'p'         => intval($granular_footer), // ID of a page, post, or custom type
			  'post_type' => proradio_megafooter_posttype_name()
			);
			$idarr = $granular_footer;
		} else {
			// get the list of footers from the customizer
			$proradio_megafooters = get_theme_mod( 'proradio_megafooters' );
			if($proradio_megafooters){
				$idarr = [];
				foreach( $proradio_megafooters as $footer => $val ){
					if( $val && !empty($val) && '' !=  $val['mega_footers']){
						$idarr[] = $val['mega_footers'];
					}
				}

				if(count($idarr) > 0){
					$quantity = count($idarr);
					$args = array(
						'post__in'=> $idarr,
						'post_type' =>  proradio_megafooter_posttype_name(),
						'orderby' => 'post__in',
						'posts_per_page' => intval($quantity),
						'ignore_sticky_posts' => 1
					);  
				}
			}

		}
		if(!$args){
			return;
		} 
		

		global $wp_query;
		$wp_query = new WP_Query( $args );
		if ( $wp_query->have_posts() ) { 
			?>
			<div id="proradio-megafooter" class="proradio-megafooter__container">
				<?php 
				while ( $wp_query->have_posts() ) : $wp_query->the_post();
					
					$post = $wp_query->post;
					setup_postdata( $post );

					?>
					<div id='proradio-megafooter-item-<?php echo $post->ID; ?>' <?php post_class( 'proradio-megafooter__item' ); ?> >
						<div class="proradio-megafooter__itemcontent">
							<?php
							echo apply_filters('the_content', get_the_content( $post->ID ) );
							?>
						</div>
					</div>
					<?php
					wp_reset_postdata();
				endwhile;
				?>
			</div>
			<?php
			
		}
		wp_reset_query();
		return;
	}
}

