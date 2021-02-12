<?php
/**
 * @package proradio-reaktions
 * @author Pro.Radio
 * 
 */

add_shortcode( 'proradio_reaktions-shareball', 'proradio_reaktions_shareball');

function proradio_reaktions_shareball(  $atts = array() ){
	ob_start();
	$id = get_the_ID();
	/*
	 *	Defaults
	 * 	All parameters can be bypassed by same attribute in the shortcode
	 */
	extract( shortcode_atts( array(
		'class' => '',
		// Global parameters
		'el_id'					=> uniqid( 'ttg-shareball' ), // 
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
	<div id="proradio-reaktionsShareBall" class="proradio-reaktions-shareball <?php echo esc_html( $class ); ?>">
	  	<div class="proradio-reaktions-shareball__menu-btn proradio-reaktions-accent" 
	  	data-proradio-reaktions-activates="parent">
			<i class="material-icons proradio-reaktions-share">share</i>
			<i class="material-icons proradio-reaktions-close">close</i>
	  	</div>
	  	<div class="proradio-reaktions-shareball__icons-wrapper">
		    <div class="proradio-reaktions-shareball__icons">
				<a class="proradio-reaktions-shareball__pinterest qt-popupwindow " href="<?php echo esc_url( $pinterest_url ); ?>" target="_blank"><i class="qt-socicon-pinterest"></i></a>
				<a class="proradio-reaktions-shareball__facebook qt-popupwindow " href="<?php echo esc_url( $facebook_url ); ?>" target="_blank"><i class="qt-socicon-facebook"></i></a>
				<a class="proradio-reaktions-shareball__twitter qt-popupwindow " href="<?php echo esc_url( $twitter_url ); ?>" target="_blank"><i class="qt-socicon-twitter"></i></a>
				<a class="proradio-reaktions-shareball__linkedin qt-popupwindow " href="<?php echo esc_url( $linkedin_url ); ?>" target="_blank"><i class="qt-socicon-linkedin"></i></a>
				<a class="proradio-reaktions-shareball__whatsapp qt-popupwindow " href="https://wa.me/?text=<?php echo urlencode( get_the_title().' - ' ).get_the_permalink(); ?>"><i class="qt-socicon-whatsapp"></i></a>
				<a class="proradio-reaktions-shareball__tumblr qt-popupwindow " href="<?php echo esc_url( $tumblr_url ); ?>" target="_blank"><i class="qt-socicon-tumblr"></i></a>

			    <?php
			    $voteclasses = 'proradio-reaktions-shareball__like';
			    if(proradio_reaktions_hasAlreadyVoted($id)) {
			    	$voteclasses .= ' proradio-reaktions-btn-disabled';
			    }
			    echo proradio_reaktions_loveit_link($voteclasses);
			    ?>


				<a class="proradio-reaktions-shareball__email " href="mailto:info@example.com?&subject=<?php echo get_the_title(); ?>&body=<?php echo esc_url( get_the_permalink() ); ?>" target="_blank"><i class="material-icons">email</i></a>
		    </div>
	  	</div>
	</div>
	<?php 
	return ob_get_clean();
}


/**
 *  Visual Composer integration
 */
add_action( 'vc_before_init', 'proradio_reaktions_shareball_vc' );
if(!function_exists('proradio_reaktions_shareball_vc')){
function proradio_reaktions_shareball_vc() {
  vc_map( array(
	 "name" => esc_html__( "Share Ball", "proradio-reaktions" ),
	 "base" => "proradio_reaktions-shareball",
	 "icon" => proradio_reaktions_plugin_get_url(). '/assets/css/img/shareball.png',
	 "description" => esc_html__( "Sharing ball", "proradio-reaktions" ),
	 "params" => array(
		array(
		   "type" => "textfield",
		   "heading" => esc_html__( "Class", "proradio-reaktions" ),
		   "param_name" => "class",
		   'value' => '',
		   'description' => esc_html__( "Add an extra class for CSS styling", "proradio-reaktions" )
		)
	 )
  ) );
}}
