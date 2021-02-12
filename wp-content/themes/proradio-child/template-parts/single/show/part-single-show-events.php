<?php  
/**
 * Music charts
 */
$eventtype = get_post_meta( get_the_ID(), 'show_eventslist', true );
if($eventtype != ''){

	?>
	<div class="proradio-container">
		<hr class="proradio-spacer-m">
		<h3 class="proradio-element-caption proradio-caption proradio-anim" data-qtwaypoints data-qtwaypoints-offset="30"><span><?php echo get_the_title().' ' .esc_attr__("events","proradio"); ?></span></h3>
		<hr class="proradio-spacer-s">
		<?php 
		if( shortcode_exists('qt-events') ){
			echo do_shortcode('[qt-events items_per_page="1" e_loadmore="true" tax_filter="eventtype:'.$eventtype.'" hideold="true"]' );
		}
		?>
	</div>
	<?php 
}  

?>