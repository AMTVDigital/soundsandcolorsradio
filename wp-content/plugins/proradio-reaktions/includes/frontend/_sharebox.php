<?php
/**
 * @package proradio-reaktions
 * @author Pro.Radio
 * 
 */

add_shortcode( 'proradio_reaktions-sharebox', 'proradio_reaktions_sharebox');

function proradio_reaktions_sharebox(  $atts = array() ){
	ob_start();
	$id = get_the_ID();
	

	/*
	 *	Defaults
	 * 	All parameters can be bypassed by same attribute in the shortcode
	 */
	extract( shortcode_atts( array(

		'class' => '',
		'classbtn' => '',
		// Global parameters
		'el_id'					=> uniqid( 'ttg-sharebox' ), // 
		'el_class'				=> '',
		'grid_id'				=> false // required for compatibility with WPBakery Page Builder
	), $atts ) );


	$vote_count = get_post_meta($id, "proradio_reaktions_votes_count", true);

	// Get the featured image.
	if ( has_post_thumbnail() ) {
		$thumbnail_id = get_post_thumbnail_id( get_the_ID() );
		$thumbnail    = $thumbnail_id ? current( wp_get_attachment_image_src( $thumbnail_id, 'large', true ) ) : '';
	} else {
		$thumbnail = null;
	}
	// Generate the Twitter URL.
	$twitter_url = 'http://twitter.com/share?text=' . get_the_title() . '&url=' . get_the_permalink() . '';
	// Generate the Facebook URL.
	$facebook_url = 'https://www.facebook.com/sharer/sharer.php?u=' . get_the_permalink() . '&title=' . get_the_title() . '';
	// Generate the LinkedIn URL.
	$linkedin_url = 'https://www.linkedin.com/shareArticle?mini=true&url=' . get_the_permalink() . '&title=' . get_the_title() . '';
	// Generate the Pinterest URL.
	$pinterest_url = 'https://pinterest.com/pin/create/button/?&url=' . get_the_permalink() . '&description=' . get_the_title() . '&media=' . esc_url( $thumbnail ) . '';
	// Generate the Tumblr URL.
	$tumblr_url = 'https://tumblr.com/share/link?url=' . get_the_permalink() . '&name=' . get_the_title() . '';

	
	?>
	<div class="proradio-reaktions-sharebox <?php echo esc_html( $class ); ?>">
		<a class="proradio-reaktions-sbtn___pinterest qt-popupwindow <?php echo esc_html( $classbtn ); ?>" href="<?php echo esc_url( $pinterest_url ); ?>" target="_blank"><i class="qt-socicon-pinterest"></i></a>
		<a class="proradio-reaktions-sbtn___facebook qt-popupwindow <?php echo esc_html( $classbtn ); ?>" href="<?php echo esc_url( $facebook_url ); ?>" target="_blank"><i class="qt-socicon-facebook"></i></a>
		<a class="proradio-reaktions-sbtn___twitter qt-popupwindow <?php echo esc_html( $classbtn ); ?>" href="<?php echo esc_url( $twitter_url ); ?>" target="_blank"><i class="qt-socicon-twitter"></i></a>
		<a class="proradio-reaktions-sbtn___linkedin qt-popupwindow <?php echo esc_html( $classbtn ); ?>" href="<?php echo esc_url( $linkedin_url ); ?>" target="_blank"><i class="qt-socicon-linkedin"></i></a>
		<a class="proradio-reaktions-sbtn___whatsapp qt-popupwindow <?php echo esc_html( $classbtn ); ?>" href="https://wa.me/?text=<?php echo urlencode( get_the_title().' - ' ).get_the_permalink(); ?>" ><i class="qt-socicon-whatsapp"></i></a>
		<a class="proradio-reaktions-sbtn___tumblr qt-popupwindow <?php echo esc_html( $classbtn ); ?>" href="<?php echo esc_url( $tumblr_url ); ?>" target="_blank"><i class="qt-socicon-tumblr"></i></a>
		<a class="proradio_reaktions-link proradio-reaktions-sbtn___like <?php if(proradio_reaktions_hasAlreadyVoted($id)) { ?>proradio-reaktions-btn-disabled <?php } ?><?php echo esc_html( $classbtn ); ?>" data-post_id="<?php echo esc_attr($id); ?>" href="#"><span class="qtli"><i class="reakticons-heart"></i></span></a>
		<a class="proradio-reaktions-sbtn___email qt-popupwindow <?php echo esc_html( $classbtn ); ?>" href="mailto:info@example.com?&subject=<?php echo get_the_title(); ?>&body=<?php echo esc_url( get_the_permalink() ); ?>" target="_blank"><i class="material-icons">email</i></a>
	</div>
	<?php 
	return ob_get_clean();
}

