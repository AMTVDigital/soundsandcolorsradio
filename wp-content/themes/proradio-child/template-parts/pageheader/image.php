<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @version 1.0.0
 */

/**
 * ======================================================
 * This file adds the background image to archive headers.
 * ------------------------------------------------------
 * There are 3 cases:
 * ------------------------------------------------------
 * - Category image
 * - Page featured (for archive templates)
 * - Default customizer picture
 * ======================================================
 */

$header_image = false;

/**
 * ======================================================
 * 1. CUSTOMIZER FEATURED IMAGE
 * ------------------------------------------------------
 * Get the featured image from the customizer
 * ======================================================
 */
if( function_exists('proradio_core_active') ){
	$proradio_header_bgimg = get_theme_mod('proradio_header_bgimg', false);
	if ( $proradio_header_bgimg ){
		$header_image = wp_get_attachment_image_src( $proradio_header_bgimg, 'full' );
	}
}


/**
 * ======================================================
 * 2. CATEGORY COVER
 * ------------------------------------------------------
 * If is a category, priority to the category picture
 * ======================================================
 */
if ( is_tax() || is_category() ){

	$tax = get_queried_object();
	$image_id =  get_term_meta( $tax->term_id , 'proradio_taxonomy_img_id', true );
	if( $image_id ){
		$header_image = wp_get_attachment_image_src ( $image_id, 'video-thumbnail' ); 
	}
}


/**
 * ======================================================
 * 3. PAGE FEATURED IMAGE
 * ------------------------------------------------------
 * Otherwise, check for the featured image in case of an archive page
 * ======================================================
 */
if( is_page() || is_single() ){
	$id = get_the_ID();
	if ( has_post_thumbnail( $id ) ){
		$image_id = get_post_thumbnail_id( $id );
		$header_image = wp_get_attachment_image_src( $image_id, 'video-thumbnail' );
	}
}


/**
 * ======================================================
 * 4. USER FEATURED IMAGE
 * ------------------------------------------------------
 * Users may upload custom pictures
 * ======================================================
 */
if( is_author() ){
	$image_id = get_user_meta (  get_the_author_meta('ID') , 'ttg_authorbox_imgid', true );
	if ( $image_id ) { $header_image = wp_get_attachment_image_src( $image_id, 'video-thumbnail' );    } 
}



if( false !== $header_image ){
	$img = $header_image; 
	$proradio_header_parallax = get_theme_mod( 'proradio_header_parallax' );
	if($proradio_header_parallax){
		?>
		<div class="proradio-bgimg proradio-bgimg__parallax <?php 
			if( get_theme_mod( 'proradio_header_duotone', '0' ) ){ ?> proradio-duotone <?php 
			} ?>" data-proradio-parallax>
			<img data-stellar-ratio="0.9" src="<?php echo esc_url( $img[0] ); ?>" alt="<?php esc_attr_e('Background', 'proradio'); ?>">
		</div>
		<?php
	} else {
		?>
		<div class="proradio-bgimg <?php 
			if( get_theme_mod( 'proradio_header_duotone', '0' ) ){ ?> proradio-duotone <?php 
			} ?>">
			<img src="<?php echo esc_url( $img[0] ); ?>" alt="<?php esc_attr_e('Background', 'proradio'); ?>">
		</div>
		<?php
	}
	
}




