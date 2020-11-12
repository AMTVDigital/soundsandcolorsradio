<?php  
$podcastfilter = get_post_meta( get_the_ID(), 'show_podcastfilter', true );
if($podcastfilter != ''){
	if( $podcastfilter !=='all' ){ $podcastfilter = 'podcastfilter:'.$podcastfilter;}
	?>
	<!-- ======================= RELATED NEWS ======================= -->
	<div class="proradio-section">
		<div class="proradio-container">
			<h3 class="proradio-element-caption proradio-caption proradio-anim" data-qtwaypoints data-qtwaypoints-offset="30"><span><?php echo esc_attr__("Show episodes","proradio"); ?></span></h3>
			<hr class="proradio-spacer-s">
			<?php 
			if(shortcode_exists('qt-post-grid' )){
				echo do_shortcode('[qt-post-grid post_type="podcast" items_per_page="3" e_loadmore="true" tax_filter="'.$podcastfilter.'" cols_l="3" cols_m="3"]' );
			}
			?>
		</div>
	</div>
	<!-- ======================= RELATED NEWS END ======================= -->
	<?php 
}