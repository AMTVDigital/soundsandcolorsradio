<?php
/**
 * @package  WordPress
 * @subpackage qtmplayer
 */


if(!function_exists('qtmplayer_hex2rgba')){
function qtmplayer_hex2rgba($color, $opacity = false) {
	$default = 'rgb(0,0,0)';
	if(empty($color)) {
		return $default; 
	}
	if ($color[0] == '#' ) {
		$color = substr( $color, 1 );
	}
	//Check if color has 6 or 3 characters and get values
	if (strlen($color) == 6) {
			$hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
	} elseif ( strlen( $color ) == 3 ) {
			$hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
	} else {
			return $default;
	}
	//Convert hexadec to rgb
	$rgb =  array_map('hexdec', $hex);
	//Check if opacity is set(rgba or rgb)
	
	if($opacity == false && $opacity != 0){
		$opacity = 1;
	}
	$output = 'rgba('.implode(",",$rgb).','.$opacity.')';
	//Return rgb(a) color string
	return $output;
}}






add_action('wp_head','qtmplayer_css_customizations',1000);

if(!function_exists('qtmplayer_css_customizations')){

	function qtmplayer_css_customizations(){
	ob_start();


	$qtmplayer_bg = get_theme_mod('qtmplayer_bg');
	if ( $qtmplayer_bg ) {
		echo '.qtmplayer__controllayer,.qtmplayer__basic,.qtmplayer__advanced,.qtmplayer-playlist,.qtmplayer__vcontainer,
				.qtmplayer__playlistcontainer,.qtmplayer__notification{ 
				background:  ' . esc_attr( $qtmplayer_bg ) . '; }'; //333333
	}

	$qtmplayer_color_txt = get_theme_mod('qtmplayer_color_txt');
	if ( $qtmplayer_color_txt ) {
		echo '.qtmplayer__controllayer,.qtmplayer__basic,.qtmplayer__advanced,.qtmplayer-playlist,.qtmplayer__vcontainer,
				.qtmplayer__playlistcontainer,.qtmplayer__notification{ 
				color:  ' . esc_attr( $qtmplayer_color_txt ) . '; }'; // f9f9f9
	}

	$qtmplayer_accent_bg = get_theme_mod('qtmplayer_accent_bg');
	if ( $qtmplayer_accent_bg ) {
		echo '.qtmplayer-content-accent,.qtmplayer-btn, .qtmplayer__vfill{ 
				background:  ' . esc_attr( $qtmplayer_accent_bg ) . '; }'; //F90
	}

	$qtmplayer_accent_txt = get_theme_mod('qtmplayer_accent_txt');
	if ( $qtmplayer_accent_txt ) {
		echo '.qtmplayer-content-accent,.qtmplayer-btn, .qtmplayer__vfill{ 
				color:  ' . esc_attr( $qtmplayer_accent_txt ) . '; }'; //ffffff
	}

	$qtmplayer_accent_bg_h = get_theme_mod('qtmplayer_accent_bg_h');
	if ( $qtmplayer_accent_bg_h ) {
		echo '.qtmplayer-content-accent,.qtmplayer-btn, .qtmplayer__vfill{ 
				background:  ' . esc_attr( $qtmplayer_accent_bg_h ) . '; }'; //F60
	}



	$qtmplayer_track_bg = get_theme_mod('qtmplayer_track_bg');
	if ( $qtmplayer_track_bg ) {
		echo '.qtmplayer-buffer,.qtmplayer__vtrack{ 
				background:  ' . esc_attr( $qtmplayer_track_bg ) . '; }'; //rgba(0,0,0,.5)
	}


	$output = ob_get_clean();
	$output = str_replace(array("	","\n","  "), " ", $output);
	$output = str_replace("  ", " ", $output);
	$output = str_replace("  ", " ", $output);
	$output = str_replace(" { ", "{", $output);
	$output = str_replace("} .", "}.", $output);
	$output = str_replace("; }", ";}", $output);
	$output = str_replace(", .", ",.", $output);
	?>

	<!-- PLAYER CUSTOMIZATIONS start ========= -->

	<style>
		<?php  
		echo wp_kses_post( $output );
		?>
	</style>

	<!-- PLAYER CUSTOMIZATIONS END ========= -->
	
	<?php 

	}
}






