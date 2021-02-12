<?php  
/**
 * @package ReAktions
 * 
 */


/**
 * Share
 */
if(!function_exists('proradio_reaktions_post_share')){
function proradio_reaktions_post_share()
{
	ob_clean();
	// Check for nonce security
	$nonce = $_POST['nonce'];
  
	if ( ! wp_verify_nonce( $nonce, 'ajax-nonce' ) ){
		die ( 'Illegal token.');
	}
	
	if(isset($_POST['post_share'])){
		// Retrieve user IP address
		$ip = $_SERVER['REMOTE_ADDR'];
		$post_id = $_POST['post_id'];
		// Get voters'IPs for the current post
		$meta_IP = get_post_meta($post_id, "proradio_reaktions_shared_IP");
		$voted_IP = $meta_IP[0];
		if(!is_array($voted_IP)){
			$voted_IP = array();
		}
		// Get votes count for the current post
		$meta_count = get_post_meta($post_id, "proradio_reaktions_shares_count", true);
		if(!$meta_count){
			$meta_count = 1;
		}
		// Use has already voted ?
		if(!proradio_reaktions_hasAlreadyShared($post_id)){
			$voted_IP[$ip] = time();
			// Save IP and increase shares count
			// Display count (ie jQuery return value)
			
			update_post_meta($post_id, "proradio_reaktions_shared_IP", $voted_IP);
			update_post_meta($post_id, "proradio_reaktions_shares_count", ++$meta_count);
			echo $meta_count;
		} else {
		    echo "already";
		}
	} else {
		echo 'Nan';
	}
	wp_die();
}}

if(!function_exists('proradio_reaktions_hasAlreadyShared')){
function proradio_reaktions_hasAlreadyShared($post_id){
	// Retrieve post votes IPs
	$revote_limit = proradio_reaktions_get_time_before_revote();
	if( $revote_limit == 0){
		return false;
	}
	$meta_IP = get_post_meta($post_id, "proradio_reaktions_shared_IP");
	if(array_key_exists(0,  $meta_IP)) {
		$voted_IP = $meta_IP[0];
		if(!is_array($voted_IP)){
			$voted_IP = array();
		}
		$ip = $_SERVER['REMOTE_ADDR'];
		if(in_array($ip, array_keys($voted_IP)))
		{
			$time = $voted_IP[$ip];
			$now = time();
			// Compare between current time and vote time
			if(round(($now - $time) / 60) >  $revote_limit){
				return false;
			}
			return true;
		}
	}
	return false;
}}
/**
 * Love
 */
if(!function_exists('proradio_reaktions_post_like')){
	function proradio_reaktions_post_like(){
		ob_clean();
		// Check for nonce security
		$nonce = $_POST['nonce'];
		if ( ! wp_verify_nonce( $nonce, 'ajax-nonce' ) ){
			die ( 'Illegal token.');
		}
		if(isset($_POST['post_like'])){
			// Retrieve user IP address
			$ip = $_SERVER['REMOTE_ADDR'];
			$post_id = $_POST['post_id'];
			// Get voters'IPs for the current post
			$meta_IP = get_post_meta($post_id, "proradio_reaktions_voted_IP");
			$voted_IP = $meta_IP[0];
			if(!is_array($voted_IP))
				$voted_IP = array();
			$meta_count = get_post_meta($post_id, "proradio_reaktions_votes_count", true);
			if(!proradio_reaktions_hasAlreadyVoted($post_id)){
				$voted_IP[$ip] = time();
				update_post_meta($post_id, "proradio_reaktions_voted_IP", $voted_IP);
				update_post_meta($post_id, "proradio_reaktions_votes_count", ++$meta_count);
				echo $meta_count;
			}else{
				echo "already";
			}
		}
		wp_die();
	}
}

if(!function_exists('proradio_reaktions_hasAlreadyVoted')){
	function proradio_reaktions_hasAlreadyVoted($post_id){
		// Retrieve post votes IPs
		$revote_limit = proradio_reaktions_get_time_before_revote();
		if( $revote_limit == 0){
			return false;
		}
		$meta_IP = get_post_meta($post_id, "proradio_reaktions_voted_IP");
		if(array_key_exists(0,  $meta_IP)) {
			$voted_IP = $meta_IP[0];
			if(!is_array($voted_IP)){
				$voted_IP = array();
			}
			$ip = $_SERVER['REMOTE_ADDR'];
			if(in_array($ip, array_keys($voted_IP))){
				$time = $voted_IP[$ip];
				$now = time();
				// Compare between current time and vote time
				if(round(($now - $time) / 60) >  $revote_limit){
					return false;
				}	 
				return true;
			}
		}
		return false;
	}
}


/**
 *
 *      Rating ===============================================================================
 *
 *
 * 
 */
function ttg_rating_submit() {
	ob_clean();
	if(!isset($_POST)){
		wp_die ( 'No data');
	}
	if(!array_key_exists('post_id', $_POST) || !array_key_exists('nonce', $_POST)){
		wp_die("Missing some data");    
	} 
	$nonce = $_POST['nonce'];
	$new_rating_value = $_POST['ttg_rating_submit'];
	if ( !wp_verify_nonce( $nonce, 'ajax-nonce' ) ) {
		wp_die ( 'Illegal token.');
	}
	//echo '14|avg=4.00';
	$post_id = (int)$_POST['post_id'];
	$old_rating_amount = get_post_meta ($post_id, "ttg_rating_amount", true);
	$old_rating_average = get_post_meta ($post_id, "ttg_rating_average", true);
	$new_rating_amount = $old_rating_amount + 1;
	// check if user has already voted
	// 
	// Get voters'IPs for the current post
	$ip = $_SERVER['REMOTE_ADDR'];
	$meta_IP = get_post_meta($post_id, "proradio_reaktions_rated_IP");
	$voted_IP = $meta_IP[0];
	if(!is_array($voted_IP)){
		$voted_IP = array();
	}
	if(true === proradio_reaktions_hasAlreadyRated($post_id)) {
		echo esc_attr__("novote", "proradio-reaktions");
		wp_die();
	}
	$voted_IP[$ip] = time();
	// Save IP and increase votes count
	update_post_meta($post_id, "proradio_reaktions_rated_IP", $voted_IP);

	if(false == $old_rating_average || 0 == $old_rating_average){
		$old_rating_average = 5;
	}
	/**
	 * Calculate average rating value
	 */
	$new_rating_average = (($old_rating_amount * $old_rating_average) + $new_rating_value) / $new_rating_amount;
	update_post_meta($post_id, "ttg_rating_average", $new_rating_average);
	update_post_meta($post_id, "ttg_rating_amount", $new_rating_amount);

	echo $new_rating_amount.'|avg='.$new_rating_average;
	wp_die();
}



if(!function_exists('proradio_reaktions_hasAlreadyRated')){
function proradio_reaktions_hasAlreadyRated($post_id)
{
	$revote_limit = proradio_reaktions_get_time_before_revote();
	if( $revote_limit == 0){
		return false;
	}
	// Retrieve post votes IPs
	$meta_IP = get_post_meta($post_id, "proradio_reaktions_rated_IP");
	if(array_key_exists(0,  $meta_IP)) {
		$voted_IP = $meta_IP[0];
		if(!is_array($voted_IP)){
			$voted_IP = array();
		}
		// Retrieve current user IP
		$ip = $_SERVER['REMOTE_ADDR'];
		// If user has already voted
		if(in_array($ip, array_keys($voted_IP))){
			$time = $voted_IP[$ip];
			$now = time();
			// Compare between current time and vote time
			if(round(($now - $time) / 60) >  $revote_limit)
				return false;
			return true;
		}
	}
	 
	return false;
}}


/**
 *      Page views ===============================================================================
 */

/* Page views */
function ttg_post_views() {
	ob_clean();
	if(!isset($_POST)){
		wp_die ( 'No data');
	}
	if(!array_key_exists('post_id', $_POST) || !array_key_exists('nonce', $_POST)){
		wp_die("Missing some data");    
	} 
	$nonce = $_POST['nonce'];
	if ( ! wp_verify_nonce( $nonce, 'ajax-nonce' ) ) {
		wp_die ( 'Illegal token.');
	}
	if(!is_numeric($_POST['post_id'])){
		return false;
	}
	$post_id = $_POST['post_id'];
	$meta_count = get_post_meta ($post_id, "proradio_reaktions_views", true) + 1;
	update_post_meta($post_id, "proradio_reaktions_views", $meta_count);
	echo $meta_count;
	wp_die();
}






