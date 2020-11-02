<?php
/**
 * @package proradio-reaktions
 * @author Pro.Radio
 * 
 */

add_shortcode( 'proradio_reaktions-commentscount', 'proradio_reaktions_commentscount');
add_shortcode( 'proradio_reaktions-commentscount-raw', 'proradio_reaktions_commentscount_raw');




/**
 * 
 * Reading time calculation
 * =============================================
 */
if(!function_exists('proradio_reaktions_comnumber')) {
function proradio_reaktions_comnumber($id = null){
	$id = get_the_id();
	$comments_count = wp_count_comments( $id );
	$comments_count = $comments_count->approved;
	return $comments_count;
}}


/**
 *
 * 
 * [proradio_reaktions_loveit_count_raw Display heart and number] *
 * 
 */
function proradio_reaktions_commentscount_raw(){
	ob_start();
	if(get_option('proradio_reaktions_commentscount', 1)){
		$number = proradio_reaktions_comnumber();
		if($number > 0){
			?><i class="reakticons-comment"></i><?php echo esc_attr($number );
		}
	} 
	return ob_get_clean();
}


/**
 *
 * 
 * [proradio_reaktions_viewsdisplay Display number of views]
 * @return [html] [Views count]
 *
 * 
 */
function proradio_reaktions_commentscount($class = false){
	if(get_option('proradio_reaktions_views', 1)){
		$rtime = proradio_reaktions_comnumber();
		if(($rtime && $rtime > 0)){
			?>
			<span class="proradio-reaktions-btn proradio-reaktions-commentscounter proradio-reaktions-readonly <?php  echo esc_attr($class); ?>">
				<i class="reakticons-comment"></i> <?php echo esc_attr($number );?>
			</span>
			<?php
		} 
	}
}


