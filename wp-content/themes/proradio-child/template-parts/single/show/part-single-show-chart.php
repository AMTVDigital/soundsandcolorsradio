<?php  
/**
 * Music charts
 */
$chartcategory = get_post_meta( get_the_ID(), 'show_chartcategory', true );
if($chartcategory != ''){

	?>
	<div class="proradio-container">
		<h3 class="proradio-element-caption proradio-caption proradio-anim" data-qtwaypoints data-qtwaypoints-offset="30"><span><?php echo get_the_title().' ' .esc_attr__("charts","proradio"); ?></span></h3>
		<hr class="proradio-spacer-s">
		<?php 
		if( shortcode_exists('qt-chart') ){
			echo do_shortcode('[qt-chart number="3" chartcategory="'.$chartcategory.'"]' );
		}
		?>
		<hr class="proradio-spacer-m">
	</div>
	<?php 
}  

?>