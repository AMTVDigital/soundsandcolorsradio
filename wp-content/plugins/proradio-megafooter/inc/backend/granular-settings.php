<?php
/**
 * @package proradio-megafooter
 */



/*
 *	Change mega footer settings for single pages
 *	=============================================================
 */
if(!function_exists("proradio_megafooter_granularsettings")){
	add_action('init', 'proradio_megafooter_granularsettings');
	function proradio_megafooter_granularsettings() {
		$proradio_megafooter_list = proradio_megafooter_list();
		$settings = array (
			array (
				'label' =>  esc_html__('Custom MegaFooter',"proradio-megafooter"),
				'id' =>  'proradio-megafooter-granular',
				'default' => "0",
				'type' 	=> 'select',
				'options' => array_merge(
					array(
						array(
							'label' => esc_attr__( 'Hide',"proradio-megafooter" ),
							'value' => 'hide'
						),
					),
					$proradio_megafooter_list
				),
			)
		);
		if(function_exists('custom_meta_box_field')){
			$settingsbox = new Custom_Add_Meta_Box('proradio_megafooter_specialfields', esc_html__('MegaFooter settings', 'proradio-megafooter') , $settings, 'page', true );
		}
	}
}
