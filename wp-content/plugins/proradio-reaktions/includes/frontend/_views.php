<?php
/**
 * @package proradio-reaktions
 * @author Pro.Radio
 * 
 */

add_shortcode( 'proradio_reaktions-views', 'proradio_reaktions_viewsdisplay');
add_shortcode( 'proradio_reaktions-views-raw', 'proradio_reaktions_viewscount_raw');

/**
 *
 * 
 * [proradio_reaktions_loveit_count_raw Display heart and number] *
 * 
 */
function proradio_reaktions_viewscount_raw(){
	ob_start();
	if(get_option('proradio_reaktions_views', 1)){
		$number = (int)get_post_meta(get_the_id(), "proradio_reaktions_views", true);
		if($number > 0){
			?><i class="reakticons-eye"></i><?php echo esc_attr($number );
		}
	} 
	return ob_get_clean();
}

/**
 *
 * 
 * [proradio_reaktions_viewscount Display number of views without HTML]
 * @return [int] [Views count number]
 *
 * 
 */
function proradio_reaktions_viewsread(){
	$id = get_the_ID();
	return get_post_meta(get_the_ID(), "proradio_reaktions_views", true);
}

/**
 *
 * 
 * [proradio_reaktions_viewsdisplay Display number of views]
 * @return [html] [Views count]
 *
 * 
 */
function proradio_reaktions_viewsdisplay($class = false){
	if(get_option('proradio_reaktions_views', 1)){
		$views = proradio_reaktions_viewsread();
		if(($views && $views > 0)){
			?>
			<span class="proradio-reaktions-btn proradio-reaktions-viewscounter proradio-reaktions-readonly <?php  echo esc_attr($class); ?>"><i class="reakticons-eye"></i>
				<span class="proradio-reaktions-Views-Amount" data-single="<?php echo esc_attr__("View", 'proradio-reaktions' ); ?>" data-multi="<?php echo esc_attr__("Views", 'proradio-reaktions' ); ?>">
					<?php echo sprintf( _n( '%s View', '%s Views', $views, 'proradio-reaktions' ), $views ); ?>
				</span>
			</span>
			<?php
		} 
	}
}


/**================================================================================================
 *
 *	Call functions update
 * 
 ================================================================================================*/

/**
 *
 * 
 * [proradio_reaktions_viewscount Updates number of views, needs to be hooked to enqueue_script]
 *
 * 
 */
add_action( 'wp_footer', 'proradio_reaktions_viewscount' );

/**
 *
 * 
 * [proradio_reaktions_viewscount Updates number of views without PHP to avoid cache]
 * @return [int] [Views count number]
 *
 * 
 */
function proradio_reaktions_viewscount($content){ // views update
	if(get_option('proradio_reaktions_views', 1)){
		if(!is_admin() ){
			if(is_singular() || is_home() || is_page()  || is_single() ){
				$id = get_the_ID();
				if(is_numeric($id)){
					$content = $content.$ajax_refresh_tag = '<a class="ttg-reactions-viewconuterajax" data-id="'.esc_js( $id ).'"></a>';
				}
			}
		}
	}
	echo $content;
}


