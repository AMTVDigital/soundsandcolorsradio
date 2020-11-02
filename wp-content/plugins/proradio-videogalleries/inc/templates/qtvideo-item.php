<?php  
global $post;
$url = get_the_permalink();
if( $showpreview ){
	$url = get_post_meta( $post->ID, '_videolove_url_key', true );
}
?>
<div class="proradio-videogalleries__item">
	<a href="<?php echo esc_url( $url ); ?>" class="qt-disableembedding">
		<?php  
		if( has_post_thumbnail()){
			the_post_thumbnail( 'medium' );
		}
		?>
		<div class="proradio-videogalleries__item__t">
			<?php if($showtitle){ ?>
			<h4 class="proradio-videogalleries__item__t_cap"><?php the_title(); ?></h4>
			<?php } ?>
			<?php  
			if($showtags && is_array($termsArray)){
			    foreach($termsArray as $tar){
			      ?><span class="trm"><?php echo esc_html( $tar->name ); ?></span><?php 
			    }
			}
			?>
		</div>
	</a>
</div>