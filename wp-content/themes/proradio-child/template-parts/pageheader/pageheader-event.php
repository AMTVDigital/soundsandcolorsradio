<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
 */

$related_show = get_field('related_show');
// Design override
$hide = get_post_meta($post->ID, 'proradio_page_header_hide', true); // see custom-types/page/page.php
$title = proradio_get_title();

$now =  current_time("Y-m-d").'T'.current_time("H:i");
$date = get_post_meta($post->ID, 'proradio_date',true);
$time = get_post_meta($post->ID, 'proradio_time',true);
if($time == '' || !$time){
	$time = '00:00';
}


$day = '';
$monthyear = '';
if($date && $date != ''){
	$day = date( "d", strtotime( $date ));
	$monthyear=esc_attr(date_i18n("M Y",strtotime($date)));
}



$location = get_post_meta($post->ID, 'proradio_location',true);
$address = get_post_meta($post->ID, 'proradio_address',true);
if('1' != $hide){
	?>
	<div class="proradio-pageheader proradio-pageheader--animate proradio-pageheader__event proradio-primary">
		<div class="proradio-pageheader__contents proradio-negative">
			<div class="proradio-container">
				<p class="proradio-meta proradio-small proradio-p-catz">
        <?php if( $related_show ): ?>

             <?php foreach( $related_show as $related_show ): ?>
             <p class="proradio-meta proradio-small proradio-p-catz">
									
		
                   <a href="<?php echo get_permalink( $related_show->ID ); ?>">
                     <?php echo get_the_title( $related_show->ID ); ?>
                   </a>
                </p>
             <?php endforeach; ?>

      <?php endif; ?>
				</p>
				<h1 class="proradio-pagecaption"  data-proradio-text="<?php echo esc_attr( get_the_title() ); ?>"><?php the_title(); ?></h1>
				<p class="proradio-meta proradio-small">
					<span class="proradio-meta__dets">
						<?php
						if( $date && $date !== ''){ 
							echo '<i class="material-icons">today</i> '.esc_html(date_i18n( get_option("date_format", "d M Y"), strtotime( $date )));
						}
						if ($location && $location !== ''){
							?><i class="material-icons">my_location</i><?php echo esc_html( $location );
						}
						?>
					</span>
				</p>
				<hr class="proradio-spacer-xs">
				<?php  
				/**
				 * ======================================================
				 * Mouse scroll icon
				 * ======================================================
				 */
				get_template_part( 'template-parts/pageheader/part-decoration' ); 
				?>
			</div>
			<?php  
			/**
			 * ======================================================
			 * Mouse scroll icon
			 * ======================================================
			 */
			get_template_part( 'template-parts/misc/mousescroll' ); 
			?>
		</div>
		<?php 
		/**
		 * ======================================================
		 * Background image
		 * ======================================================
		 */
		get_template_part( 'template-parts/pageheader/image' ); 

		?>
	</div>
	<?php  
	/**
	 * ======================================================
	 * Shareball
	 * ======================================================
	 */
	get_template_part( 'template-parts/shared/shareball' ); 
	?>
	<?php  
} // hide end
