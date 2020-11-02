<?php
/**
 * @package proradio-reaktions
 * @author Pro.Radio
 * 
 */


if(!function_exists('proradio_reaktions_sharebox_fullpage_sc')){
	add_shortcode( 'proradio_reaktions-sharebox-fp', 'proradio_reaktions_sharebox_fullpage_sc');
	function proradio_reaktions_sharebox_fullpage_sc( $atts ){
		extract( shortcode_atts( array(
			'class' => '',
			'btnclass' => '',
			'label' => false,
			'id' =>  get_the_ID()
		), $atts ) );
		$share_count = get_post_meta($id, "proradio_reaktions_shares_count", true); // Ajax see ajax-love.php
		// Url query
		$parameters = [
			'id' => $id,
			'reaktions-share-fullpage' => $id,
			'noajax' => '1',
			'label' => esc_attr( $label ),
			'btnclass' => esc_attr( $btnclass ),
			'secure' => wp_create_nonce( 'reaktions' )
		];
		$finalUrl = add_query_arg( $parameters, get_the_permalink($id) );
		// js parameters
		$atts_array = [
			'id' => $id,
			'shared' => get_the_permalink($id),
			'title' => esc_attr(get_the_title($id)),
			'finalUrl' => $finalUrl
		];
		$jsonatts = json_encode($atts_array);
		?>
		<a data-ttgreaktions-shareboxfull="<?php echo esc_attr( $jsonatts ); ?>" href="#nojax" class="proradio_reaktions-link <?php echo esc_attr( $class ); ?>">
			<span class="qtli"><i class="reakticons-share"></i></span><span class="count"><?php echo esc_attr($share_count); ?></span>
		</a>
		<?php
	}
}


if(!function_exists('proradio_reaktions_sharebox_fullpage')){
	if(isset($_GET)){
		if(isset($_GET['reaktions-share-fullpage'])){
			add_action('get_header','proradio_reaktions_sharebox_fullpage');
		}
	}
	function proradio_reaktions_sharebox_fullpage(  $atts = array() ){
		ob_start();

		if( !wp_verify_nonce( $_GET['secure'], 'reaktions'  ) ){
			esc_html_e('Error: invalid security control', 'proradio-reaktions');
			echo ob_get_clean();
			die();
		}
		$id = $_GET['reaktions-share-fullpage'];
		$title = get_the_title($id);
		$url = get_the_permalink($id);
		if ( has_post_thumbnail($id) ) {
			$thumbnail_id = get_post_thumbnail_id( $id );
			$thumbnail    = $thumbnail_id ? current( wp_get_attachment_image_src( $thumbnail_id, 'large', true ) ) : '';
		} else {
			$thumbnail = null;
		}


		$twitter_url = 'http://twitter.com/share?text=' . $title . '&url=' .$url . '';
		$facebook_url = 'https://www.facebook.com/sharer/sharer.php?u=' .$url . '&title=' . $title . '';
		$linkedin_url = 'https://www.linkedin.com/shareArticle?mini=true&url=' . $url . '&title=' . $title . '';
		$pinterest_url = 'https://pinterest.com/pin/create/button/?&url=' . $url . '&description=' . $title . '&media=' . esc_url( $thumbnail ) . '';
		$tumblr_url = 'https://tumblr.com/share/link?url=' . $url . '&name=' . $title . '';


		$btnclass = ($_GET['btnclass'])? $_GET['btnclass'] : ''; // shortcode att
		$label = ($_GET['label'])? $_GET['label'] : '';

		?>
		<div class="proradio-reaktions-sharebox proradio-reaktions-sharebox--fp">
			<div class="proradio-reaktions-sharebox--fp__c">
				<?php if( $label ){ ?>
					<h4><span><?php echo esc_html($label); ?></span></h4>
				<?php } ?>
				<?php if( $title ){ ?>
					<h1>"<?php echo esc_html($title); ?>"</h1>
				<?php } ?>
				<a class="proradio-reaktions-sbtn___pinterest qt-popupwindow <?php echo esc_attr($btnclass); ?>" href="<?php echo esc_url( $pinterest_url ); ?>" target="_blank"><i class="qt-socicon-pinterest"></i></a>
				<a class="proradio-reaktions-sbtn___facebook qt-popupwindow <?php echo esc_attr($btnclass); ?>" href="<?php echo esc_url( $facebook_url ); ?>" target="_blank"><i class="qt-socicon-facebook"></i></a>
				<a class="proradio-reaktions-sbtn___twitter qt-popupwindow <?php echo esc_attr($btnclass); ?>" href="<?php echo esc_url( $twitter_url ); ?>" target="_blank"><i class="qt-socicon-twitter"></i></a>
				<a class="proradio-reaktions-sbtn___linkedin qt-popupwindow <?php echo esc_attr($btnclass); ?>" href="<?php echo esc_url( $linkedin_url ); ?>" target="_blank"><i class="qt-socicon-linkedin"></i></a>
				<a class="proradio-reaktions-sbtn___whatsapp qt-popupwindow <?php echo esc_attr($btnclass); ?>" href="https://wa.me/?text=<?php echo urlencode( $title.' - ' ).$url; ?>" ><i class="qt-socicon-whatsapp"></i></a>
				<a class="proradio-reaktions-sbtn___tumblr qt-popupwindow <?php echo esc_attr($btnclass); ?>" href="<?php echo esc_url( $tumblr_url ); ?>" target="_blank"><i class="qt-socicon-tumblr"></i></a>
				<a class="proradio_reaktions-link proradio-reaktions-sbtn___like  <?php echo esc_attr($btnclass); ?> <?php if(proradio_reaktions_hasAlreadyVoted($id)) { ?>proradio-reaktions-btn-disabled <?php } ?>" data-post_id="<?php echo esc_attr($id); ?>" href="#"><span class="qtli"><i class="reakticons-heart"></i></span></a>
				<a class="proradio-reaktions-sbtn___email qt-popupwindow <?php echo esc_attr($btnclass); ?>" href="mailto:info@example.com?&subject=<?php echo get_the_title(); ?>&body=<?php echo esc_url( get_the_permalink() ); ?>" target="_blank"><i class="material-icons">email</i></a>
			</div>
		</div>
		<?php 
		echo ob_get_clean();
		die();
	}
}

