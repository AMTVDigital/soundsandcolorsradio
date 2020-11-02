<?php
/**
 * @package proradio-reaktions
 * @author Pro.Radio
 * 
 */

add_shortcode( 'proradio_reaktions-loveit-link', 'proradio_reaktions_loveit_link_sc' );
add_shortcode( 'proradio_reaktions-loveit-count', 'proradio_reaktions_loveit_count' );
add_shortcode( 'proradio_reaktions-loveit-raw', 'proradio_reaktions_loveit_count_raw' );


/**
 *
 * 
 * [proradio_reaktions_loveit_count_raw Display heart and number] *
 * 
 */
function proradio_reaktions_loveit_count_raw(){
	ob_start();
	if(get_option('proradio_reaktions_love', 1)){
		$id = get_the_id();
		echo proradio_reaktions_loveit_link();
	}
	return ob_get_clean();
}


/**
 *
 * 
 * [proradio_reaktions_loveit_link Creates LOVE button]
 * @return [html] [LOVE action button]
 *
 * 
 */

function proradio_reaktions_loveit_link( $class = false ){
	if(get_option('proradio_reaktions_love', 1)){
		$id = get_the_ID();
		ob_start();
		$vote_count = get_post_meta($id, "proradio_reaktions_votes_count", true);
		?>
		<a data-ttgreaktions-lovelink class="proradio_reaktions-link <?php if(proradio_reaktions_hasAlreadyVoted($id)) { ?>proradio-reaktions-btn-disabled <?php } ?><?php  echo esc_attr($class); ?>" data-post_id="<?php echo esc_attr($id); ?>" href="#">
	        <span class="qtli"><i class="reakticons-heart<?php if(proradio_reaktions_hasAlreadyVoted($id)) { ?>-full<?php } ?>"></i></span><span class="qtli count"><?php echo esc_attr($vote_count); ?></span>
	    </a>
		<?php
		return ob_get_clean();
	}
}
function proradio_reaktions_loveit_link_sc(  ){
	return proradio_reaktions_loveit_link('proradio-reaktions-btn-love proradio-reaktions-btn');
}


/**
 *
 * 
 * [proradio_reaktions_loveit_count Display number of LOVE]
 * @return [int] [Views count number]
 *
 * 
 */
function proradio_reaktions_loveit_count($class){
	if(get_option('proradio_reaktions_love', 1)){
		ob_start();
		$post_id =get_the_id();
		$number = get_post_meta($post_id, "proradio_reaktions_votes_count", true);
		if("" === $number) {
			$number = 0;
		}
		?>
		<span class="proradio-reaktions-btn proradio-reaktions-viewscounter proradio-reaktions-readonly <?php  echo esc_attr($class); ?>">
			<i class="reakticons-heart"></i> <?php echo esc_attr($number ); ?> <?php if($number !== '1') { echo esc_attr__("Likes", "proradio-reaktions" ); } else { echo esc_attr__("Like", "proradio-reaktions" ); } ?>
		</span>
		<?php
		return ob_get_clean();
	}
}


