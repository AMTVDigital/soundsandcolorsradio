<?php  
/**
 * Create customizer fields for the kirki framework.
 * @package Kirki
 */


/**
 * MegaFooter plugin integration
 */
if( function_exists( 'proradio_megafooter_posttype_name' ) ){
	if(!function_exists('proradio_customizer_dropdown_mega_footer')){
		function proradio_customizer_dropdown_mega_footer(){
			$posts = Kirki_Helper::get_posts( array( 'posts_per_page' => -1,'post_type' => proradio_megafooter_posttype_name() ) );
			$posts[0] =  esc_html__('Chose', 'proradio');
			ksort($posts);
			return $posts;
		}
	}
	Kirki::add_field( 'proradio_megafooter_config', array(
		'type'        => 'repeater',
		'label'       => esc_attr__( 'Mega footer', 'qtmplayer' ),
		'section'     => 'proradio_megafooter_options_section',
		'priority'    => 10,
		'row_label' => array(
			'type'  => 'field',
			'value' => esc_attr__('Mega footer', 'proradio' ),
			'field' => 'title',
		),
		'button_label' => esc_attr__('Add footer', 'proradio' ),
		'settings'     => 'proradio_megafooters',
		'fields' => array(
			'mega_footers' => array(
				'type'        => 'select',
				'choices' 	  =>  proradio_customizer_dropdown_mega_footer()
			)
		)
	));
}
