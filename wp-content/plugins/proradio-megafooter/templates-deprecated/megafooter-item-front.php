<?php  
/**
 * @package proradio-megafooter
 */
?>
<div id='proradio-megafooter-item-<?php echo get_the_ID(); ?>' <?php post_class( 'proradio-megafooter__item' ); ?> >
	<div class="proradio-megafooter__itemcontent">
		<?php  
		echo get_the_content( get_the_ID() );
		?>
	</div>
</div>

