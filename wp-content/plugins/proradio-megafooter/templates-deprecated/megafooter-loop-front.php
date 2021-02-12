<?php  
/**
 * @package proradio-megafooter
 */

?>
<div id="proradio-megafooter" class="proradio-megafooter__container">
	<?php 
	/**
	 * Loop
	 */
	while ( $wp_query->have_posts() ) : $wp_query->the_post();
		$post = $wp_query->post;
		setup_postdata( $post );
		?>
		<div id='proradio-megafooter-item-<?php echo get_the_ID(); ?>' <?php post_class( 'proradio-megafooter__item' ); ?> >
			<div class="proradio-megafooter__itemcontent">
				<?php  
				echo get_the_content( get_the_ID() );
				?>
			</div>
		</div>
		<?php
	endwhile;
	?>
</div>