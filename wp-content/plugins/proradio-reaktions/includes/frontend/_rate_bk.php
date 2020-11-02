<?php
/**
 * @package proradio-reaktions
 * @author Pro.Radio
 * 
 */

add_shortcode( 'proradio_reaktions-rating', 'proradio_reaktions_rating');
add_shortcode( 'proradio_reaktions-rating-count', 'proradio_reaktions_ratingcount');
add_shortcode( 'proradio_reaktions-rating-raw', 'proradio_reaktions_ratingcount_raw');


/**
 *
 * 
 * [proradio_reaktions_loveit_count_raw Display heart and number] *
 * 
 */
function proradio_reaktions_ratingcount_raw(){
	ob_start();
	if(get_option( "proradio_reaktions_ratings", 1 )){
		$number = (int)get_post_meta(get_the_id(), "ttg_rating_average", true);
		if($number > 0){
			?><i class="reakticons-star-two"></i> <?php echo esc_attr($number ); ?> <?php
		}
	}
	return ob_get_clean();
}


/**
 *
 * 
 * [proradio_reaktions_rating add star rating]
 *
 * 
 */
function proradio_reaktions_rating($class = false) {
	ob_start();
	if(get_option( "proradio_reaktions_ratings", 1 )){
		?>
			<form data-postid="<?php echo get_the_id(); ?>" class="proradio-reaktions proradio-reaktions-rating <?php  echo esc_attr($class); ?>">
				<span class=""
				<div class="proradio-reaktions-stars">
					<input type="radio" name="proradio-reaktions-star" class="proradio-reaktions-star-1" value="1" id="proradio-reaktions-star-1" /><label class="proradio-reaktions-star-1" for="proradio-reaktions-star-1">1</label>
					<input type="radio" name="proradio-reaktions-star" class="proradio-reaktions-star-2" value="2" id="proradio-reaktions-star-2" /><label class="proradio-reaktions-star-2" for="proradio-reaktions-star-2">2</label>
					<input type="radio" name="proradio-reaktions-star" class="proradio-reaktions-star-3" value="3" id="proradio-reaktions-star-3" /><label class="proradio-reaktions-star-3" for="proradio-reaktions-star-3">3</label>
					<input type="radio" name="proradio-reaktions-star" class="proradio-reaktions-star-4" value="4" id="proradio-reaktions-star-4" /><label class="proradio-reaktions-star-4" for="proradio-reaktions-star-4">4</label>
					<input type="radio" name="proradio-reaktions-star" class="proradio-reaktions-star-5" value="5" id="proradio-reaktions-star-5" /><label class="proradio-reaktions-star-5" for="proradio-reaktions-star-5">5</label>
					<span></span>
				</div>
			</form>
		<?php  
		return ob_get_clean();
	}
}




/**
 *
 * 
 * [proradio_reaktions_rating add star rating]
 *
 * 
 */
function proradio_reaktions_ratingcount($class = false) {
	if(get_option( "proradio_reaktions_ratings", 1 )){
		ob_start();

		$avg = round(get_post_meta(get_the_id(), "ttg_rating_average", true), 2);
		if($avg == 0){ 
			$class .= 'ttg-noratings'; 
		}
		?>
		<span class="ttg-Ratings-Avg proradio-reaktions proradio-reaktions-btn proradio-reaktions-readonly <?php  echo esc_attr($class); ?>">
			<i class="reakticons-star-two"></i> <?php echo round(esc_attr($avg), 2); ?>
		</span>
		<?php  
	
		
		$ratings = get_post_meta(get_the_id(), "ttg_rating_amount", true);
		if(($ratings && $ratings > 0)){
			?>
			<span data-none="<?php echo esc_attr__('No ratings yet', 'proradio-reaktions' ); ?>" data-novote="<?php echo esc_attr__('Already voted!', 'proradio-reaktions' ); ?>" data-single="<?php echo esc_attr__('Rating', 'proradio-reaktions' ); ?>" data-multi="<?php echo esc_attr__('Ratings', 'proradio-reaktions' ); ?>" class="proradio-reaktions ttg-Ratings-Amount proradio-reaktions-btn proradio-reaktions-readonly <?php  echo esc_attr($class); ?>">
			<?php
				echo sprintf( _n( 'On %s Rating', 'On %s Ratings', $ratings, 'proradio-reaktions' ), $ratings );
			?>
			</span>
			<?php
		}
		return ob_get_clean();
	}
}

