<?php
/**
 * @package proradio-reaktions
 * @author Pro.Radio
 * 
 */

if(!function_exists('proradio_reaktions_headers')) {

	add_action('wp_head', 'proradio_reaktions_headers');
	function proradio_reaktions_headers(){
		
		if(!get_option( 'proradio_reaktions_open_graph_headers', 1 )){
			return;
		}
		
		if ( is_front_page() || is_home() ) {
			$type = 'website';
			$title = get_bloginfo('name');
			$excerpt = get_bloginfo('description');
			$permalink = get_bloginfo('url');
		} else {
			$type = 'article';
			$permalink = wp_guess_url(); //add_query_arg( $wp->query_vars, home_url( $wp->request ) );
			$title = get_the_title();
			$thumbnail =  get_the_post_thumbnail_url( null, 'medium' );
			if( has_excerpt() ){
				ob_start();
				the_excerpt();
				$excerpt = ob_get_clean();
			}
		}

		?>
		<meta property="og:type"		content="<?php echo esc_attr( $type ); ?>" />
		<meta property="og:url"			content="<?php echo esc_attr( $permalink ); ?>" />
		<meta property="og:title"		content="<?php echo esc_attr( $title ); ?>" />
		<meta property="og:description"	content="<?php echo esc_attr( $thumbnail ); ?>" />
		<?php  
		if(has_post_thumbnail()){
			?><meta property="og:image" content="<?php echo get_the_post_thumbnail_url( null, 'medium' ) ?>" /><?php
		}
	}
}