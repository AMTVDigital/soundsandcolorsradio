<?php 
/**
 * Adding custom icon to icon control in Elementor
 */
function icons2go_elementor( $tabs = array() ) {
	$families = t2gicons_families();
	foreach($families as $family => $details ){

		if(get_option($details['options_name']) == '1') {
			$tabid = 'icons2go-custom-icons'.$family;
			$tabs[$tabid] = array(
				'name'          => $tabid,
				'label'         => $details['label'],
				'labelIcon'     => 'fas fa-user',
				'prefix'        => '',
				'displayPrefix' => '',
				'url'           => $details['url'],
				'icons'         => $details['classes'],
				'ver'           => '1.0.0',
			);
		}
	}
	return $tabs;
}

add_filter( 'elementor/icons_manager/additional_tabs', 'icons2go_elementor' );
