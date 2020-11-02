<?php  
/**
 * @package proradio-reaktions
 * @author Pro.Radio
 * 
 */
include(plugin_dir_path( __FILE__ ) . '_headers-facebook.php');
include(plugin_dir_path( __FILE__ ) . '_love.php');
include(plugin_dir_path( __FILE__ ) . '_rate.php');
include(plugin_dir_path( __FILE__ ) . '_views.php');
include(plugin_dir_path( __FILE__ ) . '_share.php');
include(plugin_dir_path( __FILE__ ) . '_readingtime.php');
include(plugin_dir_path( __FILE__ ) . '_commentscount.php');
include(plugin_dir_path( __FILE__ ) . '_shareball.php');
include(plugin_dir_path( __FILE__ ) . '_sharebox.php');
include(plugin_dir_path( __FILE__ ) . '_sharebox-fullpage.php');
// include(plugin_dir_path( __FILE__ ) . '_sharescount.php');


/**================================================================================================
 *
 *	Main functions to display contents and shortcodes
 * 
 ================================================================================================*/


add_shortcode( 'proradio_reaktions-full', 'proradio_reaktions_full');
function proradio_reaktions_full(){
	ob_start();
	?>
	<div class="proradio-reaktions-all">
		<div class="proradio-reaktions-col1">
			<?php 
			echo proradio_reaktions_loveit_link();
			echo proradio_reaktions_social();
			?>
		</div>
		<div class="proradio-reaktions-col2">
			<?php  
			echo proradio_reaktions_viewsdisplay();
			echo proradio_reaktions_ratingcount();

			if(wp_is_mobile()){
			?>
			<hr class="qt-spacer-s qt-clearfix show-on-small ">
			<?php
			}
			echo do_shortcode('[proradio_reaktions-rating]');			
			?>
		</div>
	</div>
	<?php  
	return ob_get_clean();
}




add_shortcode( 'proradio_reaktions-buttons', 'proradio_reaktions_buttons');
function proradio_reaktions_buttons(){
	ob_start();
	?>
	<div class="proradio-reaktions-buttons-row">
		<?php 
		echo proradio_reaktions_loveit_link_sc();
		echo proradio_reaktions_social();
		?>
	</div>
	<?php  
	return ob_get_clean();
}








