<?php
/**
 * @package proradio-reaktions
 * @author Pro.Radio
 * 
 */

add_shortcode( 'proradio_reaktions-sharescount', 'proradio_reaktions_sharescount');
add_shortcode( 'proradio_reaktions-sharescount-raw', 'proradio_reaktions_sharescount_raw');


/**
 * 
 * Reading time calculation
 * =============================================
 */
if(!function_exists('proradio_reaktions_sharesnumber')) {
function proradio_reaktions_sharesnumber($id = null){
	$id = get_the_id();
	$url = get_the_permalink( $id );

	// return $id;// test
	
	return 99999999; //'MANCA QUESTO PEZZO MA PARE NON POSSIBILE';

	function get_shares($url) {    
	  $json_string = file_get_contents("http://www.linkedin.com/countserv/count/share?url=$url&format=json");
	  $json = json_decode($json_string, true);
	  return intval( $json['count'] );
	}
	function get_tweets($url) {

	    $json_string = file_get_contents('http://urls.api.twitter.com/1/urls/count.json?url=' . $url);
	    $json = json_decode($json_string, true);

	    return intval( $json['count'] );
	}

	function get_likes($url) {
	    $json_string = file_get_contents('http://graph.facebook.com/?ids=' . $url);
	    $json = json_decode($json_string, true);
	    return intval( $json[$url]['shares'] );
	}

	function get_plusones($url) {

	    $curl = curl_init();
	    curl_setopt($curl, CURLOPT_URL, "https://clients6.google.com/rpc");
	    curl_setopt($curl, CURLOPT_POST, 1);
	    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

	    curl_setopt($curl, CURLOPT_POSTFIELDS, '[{"method":"pos.plusones.get","id":"p","params":{"nolog":true,"id":"' . $url . '","source":"widget","userId":"@viewer","groupId":"@self"},"jsonrpc":"2.0","key":"p","apiVersion":"v1"}]');
	    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
	    $curl_results = curl_exec ($curl);
	    curl_close ($curl);

	    $json = json_decode($curl_results, true);

	    return intval( $json[0]['result']['metadata']['globalCounts']['count'] );
	}
	function total($url){
	    return get_tweets($url);/* + get_shares($url) + get_likes($url) + get_plusones($url);*/ 
	}



	return total($url);
}}


/**
 *
 * 
 * [proradio_reaktions_loveit_count_raw Display heart and number] *
 * 
 */
function proradio_reaktions_sharescount_raw(){
	ob_start();
	if(get_option('proradio_reaktions_sharescount', 1)){
		$number = proradio_reaktions_sharesnumber();
		if($number > 0){
			?><i class="reakticons-share"></i> <?php echo esc_attr($number );
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
function proradio_reaktions_sharescount($class = false){
	if(get_option('proradio_reaktions_views', 1)){
		$rtime = proradio_reaktions_sharesnumber();
		if(($rtime && $rtime > 0)){
			?>
			<span class="proradio-reaktions-btn proradio-reaktions-sharescounter proradio-reaktions-readonly <?php  echo esc_attr($class); ?>">
				<i class="reakticons-share"></i> <?php echo esc_attr($number );?>
			</span>
			<?php
		} 
	}
}


