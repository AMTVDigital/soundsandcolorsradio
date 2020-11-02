<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @subpackage Player
 * @version 1.3.3
 */
?>
<div id="proradio-playercontainer" class="proradio-playercontainer proradio-playercontainer--footer">
	<?php 
	if(function_exists('qtmplayer_interface')){ 
		qtmplayer_interface(); 
	} 
	?>
</div>