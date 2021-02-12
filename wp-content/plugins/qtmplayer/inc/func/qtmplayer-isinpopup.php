<?php  
/**
*	===========================================
*	@since 3.3.3	
* 	Tells us if the player is being loaded in popup for design purposes
*	===========================================
*/
if(!function_exists('qtmplayer_is_in_popup')){
	function qtmplayer_is_in_popup(){
		if(isset($_GET)){
			if( isset( $_GET['proradio-popup'] ) ){
				return true;
			}
		}
	}
}