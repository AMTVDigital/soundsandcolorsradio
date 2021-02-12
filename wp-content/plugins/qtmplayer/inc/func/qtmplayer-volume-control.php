<?php
/**
 * @package  WordPress
 * @subpackage qtmplayer
 */



if(!function_exists('qtmplayer_volume_control')){
	function qtmplayer_volume_control( $classes = array() ){
		$classes[] = '';
		$classes = implode(' ', $classes );
		?>
		<div class="qtmplayer__volume qtmplayer-content-primary-light <?php echo esc_attr( $classes ); ?>">
			<i data-qtmplayer-vicon class="material-icons">volume_up</i>
			<div class="qtmplayer__vcontainer">
				<div data-qtmplayer-vcontrol class="qtmplayer__vcontrol">
					<span data-qtmplayer-vtrack class="qtmplayer__vtrack"></span>
					<span data-qtmplayer-vfill class="qtmplayer__vfill"></span>
					<span data-qtmplayer-vball class="qtmplayer-track-minicue qtmplayer__vball"></span>
				</div>
			</div>
		</div>
		<?php 
	}

}