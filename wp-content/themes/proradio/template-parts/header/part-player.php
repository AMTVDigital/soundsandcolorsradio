<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @subpackage Player
 * @version 1.0.0
 */
?>
<div id="proradio-playercontainer" class="proradio-playercontainer">
	<?php 
	if(function_exists('qtmplayer_interface')){ 
		qtmplayer_interface(); 
	} 
	?>
</div>