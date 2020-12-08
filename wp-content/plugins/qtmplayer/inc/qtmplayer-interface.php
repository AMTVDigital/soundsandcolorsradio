<?php
/**
 * @package  WordPress
 * @subpackage qtmplayer
 */

if(!function_exists('qtmplayer_interface')){
function qtmplayer_interface(){
	$musicplayerapi = site_url( '/?qtmplayer_json_data=' );
	$smflash = qtmplayer_flashurl();
	$color = get_theme_mod( 'qtmplayer_color_accent', '#03a9f4' ); // Get color from the options
	$data_analyzer = get_option( 'qtmplayer_basicplayer' );
	
	if(wp_is_mobile()){
		$data_analyzer = 0;
	}
	
	$autoplay = get_option( 'qtmplayer_autoplay' );
	/**
	 * Since 1.8.3 check if I have channels or releases
	 */
	$quantity = 0;
	$args = array(
		'post_type' => 'radiochannel',
		'post_status' => 'publish',
	);
	$wp_query = new WP_Query( $args );
	$quantity = $quantity + $wp_query->found_posts;

	$args = array(
		'post_type' => 'release',
		'post_status' => 'publish',
	);
	$wp_query = new WP_Query( $args );
	$quantity = $quantity + $wp_query->found_posts;


	/**
	 * Radio settings
	 * @since  
	 */
	$data_get_artwork = get_theme_mod( 'qtmplayer_artworks', '1' ); ;
	
	


	/**
	 * Classes
	 * @var $classes array of classes
	 */
	$classes = array('');
	if( !get_theme_mod( 'qtmplayer_cover_desktop', '1' ) ){
		$classes[] = 'qtmplayer__nocover';
	}

	if( $quantity == 0 ) {
		$classes[] = 'qtmplayer-hidden';
	}

	if(isset($_GET)){
		if(isset($_GET['proradio-popup'])){
			$classes[] = 'qtmplayer--popup';
		}
	}


	$classes =implode(' ', $classes );


	/**
	 * New Chrome policy: autoplay is disabled
	 * @var string
	 */
	// $autoplay = '';
	



	$qtmplayer_design = get_theme_mod( 'qtmplayer_design', 'header' );
	$qtmplayer_design_class = 'qtmplayer__container--'.$qtmplayer_design;


	?>
	<div id="qtmplayer-container" class="qtmplayer__container <?php echo esc_attr( $qtmplayer_design_class ); ?>">
		<div id="qtmplayer" class="qtmplayer qtmplayer-scrollbarstyle <?php echo esc_attr( $classes ); ?>" data-artwork="<?php echo esc_attr($data_get_artwork); ?>"  data-showplayer="<?php  echo esc_attr(get_option( 'qtmplayer_showplayer' )); ?>" data-analyzer="<?php echo esc_attr($data_analyzer); ?>" data-autoplay="<?php if( function_exists('proradio_ajax_is_active') && !wp_is_mobile() ){  echo esc_attr( $autoplay ); } ?>" data-hiquality="<?php  echo esc_attr(get_option( 'qtmplayer_hiquality' )); ?>" data-qtmplayer-api="<?php echo esc_attr($musicplayerapi); ?>" data-qtmplayer-smflash="<?php echo esc_attr($smflash); ?>">
			<?php  
			include	'parts/qtmplayer-interface__controls.php';
			include	'parts/qtmplayer-interface__playlist.php';
			?>
		</div>
		<?php 
		if(get_option( 'qtmplayer_basicplayer' )){ 
			?>
			<div id="qtmplayerWF"  class="qtmplayer__waveform">
				<canvas></canvas>
			</div>
			<div id="qtmplayerFFT" data-color="<?php esc_attr_e($color); ?>" class="qtmplayer__waves"></div>
			<?php 
		}
		?>
	</div>
	<?php

}}
