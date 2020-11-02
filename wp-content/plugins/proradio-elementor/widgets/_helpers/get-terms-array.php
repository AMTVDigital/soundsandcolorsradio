<?php
if(!function_exists('proradio_elementor_get_terms_array')) {
function proradio_elementor_get_terms_array($taxonomy = false) {
	$cats = get_terms(array(
		'hide_empty'=>false,
	));
	$result = array();
	if(is_wp_error( $cats ) || 0 === $cats){
		$result = array();
	}
	$current_taxonomy = '';
	foreach ( $cats as $cat )	{
		if( $cat->taxonomy == 'nav_menu'){
			continue;
		}

		if($taxonomy){
			if( $cat->taxonomy !== $taxonomy ){
				continue;
			}
		}

		$result[ $cat->taxonomy.':'.$cat->slug ] = $cat->taxonomy.':'.$cat->slug ;
	}
	asort($result);
	return $result;
}}
