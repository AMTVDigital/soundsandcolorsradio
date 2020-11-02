<?php
/**
 * @package WordPress
 * @subpackage proradio
 * @subpackage kirki
 * @version 1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}


Kirki::add_field( 'proradio_config', array(
	'type'        => 'switch',
	'settings'    => 'proradio_header_sticky',
	'label'       => esc_html__( 'Sticky menu', "proradio" ),
	'section'     => 'proradio_header_section',
	'description' => esc_html__( 'On scroll, stick the menu', "proradio" ),
	'priority'    => 0,
	'default'     => '0'
));

Kirki::add_field( 'proradio_config', array(
	'type'        => 'switch',
	'settings'    => 'proradio_header_transp',
	'label'       => esc_html__( 'Transparent menu', "proradio" ),
	'section'     => 'proradio_header_section',
	'description' => esc_html__( 'Default color will be white with transparency enabled', "proradio" ),
	'priority'    => 0,
	'default'     => '0'
));

// Transparent menu colors

Kirki::add_field( 'proradio_config', array(
	'type'        => 'color',
	'settings'    => 'proradio_menu_scroll_bg',
	'label'       => esc_html__( 'Background color when scrolled', "proradio" ),
	'section'     => 'proradio_header_section',
	'priority'    => 10,
	'transport'   => 'auto',
	'active_callback' => [
		[
			'setting'  => 'proradio_header_transp',
			'operator' => '==',
			'value'    => true,
		]
	],
	'output'    => array(
		array(
			'element'       => '.proradio-scrolled #proradio-menu.proradio-menu.proradio-paper',
			'property'      => 'background-color',
		),
	),
));

Kirki::add_field( 'proradio_config', array(
	'type'        => 'color',
	'settings'    => 'proradio_menu_scroll_t',
	'label'       => esc_html__( 'Text when scrolled', "proradio" ),
	'section'     => 'proradio_header_section',
	'priority'    => 10,
	'transport'   => 'auto',
	'active_callback' => [
		[
			'setting'  => 'proradio_header_transp',
			'operator' => '==',
			'value'    => true,
		]
	],
	'output'    => array(
		array(
			'element'       => '.proradio-scrolled #proradio-menu.proradio-menu.proradio-paper',
			'property'      => 'color',
		),
	),
));


// Menu colors
Kirki::add_field( 'proradio_config', array(
	'type'        => 'color',
	'settings'    => 'proradio_menu_bg',
	'label'       => esc_html__( 'Main menu background color', "proradio" ),
	'section'     => 'proradio_header_section',
	'transport'		=> 'refresh',
	'priority'    => 10,
	'transport'   => 'auto',
	'active_callback' => [
		[
			'setting'  => 'proradio_header_transp',
			'operator' => '==',
			'value'    => '0',
		]
	],
	'output'    => array(
		array(
			'element'       => '.proradio-menu.proradio-paper, .proradio-headerbar__content.proradio-paper, .proradio-menu-horizontal .proradio-menubar > li > ul li a',
			'property'      => 'background-color',
		),
	),
));


Kirki::add_field( 'proradio_config', array(
	'type'        => 'image',
	'settings'    => 'proradio_logo_header',
	'label'       => esc_html__( 'Logo header opaque', "proradio" ),
	'section'     => 'proradio_header_section',
	'description' => esc_html__( 'Max height: 100px', "proradio" ),
	'priority'    => 10
));
Kirki::add_field( 'proradio_config', array(
	'type'        => 'image',
	'settings'    => 'proradio_logo_header_transparent',
	'label'       => esc_html__( 'Logo header transparent', "proradio" ),
	'section'     => 'proradio_header_section',
	'description' => esc_html__( 'Max height: 100px', "proradio" ),
	'priority'    => 10
));






// Colors 
// ======================================================

Kirki::add_field( 'proradio_config', array(
	'type'        => 'color',
	'settings'    => 'proradio_menu_t',
	'label'       => esc_html__( 'Opaque menu links color', "proradio" ),
	'section'     => 'proradio_header_section',
	'priority'    => 10,
	'transport'   => 'auto',
	'output'    => array(
		array(
			'element'       => '.proradio-menu, .proradio-menu-horizontal .proradio-menubar > li > ul li, .proradio-menubtns .proradio-btn',
			'property'      => 'color',
		),
	),
));
Kirki::add_field( 'proradio_config', array(
	'type'        => 'color',
	'settings'    => 'proradio_menu_l',
	'label'       => esc_html__( 'Sub menu links color', "proradio" ),
	'section'     => 'proradio_header_section',
	'priority'    => 10,
	'transport'   => 'auto',
	'output'    => array(
		array(
			'element'       => '.proradio-menu a, .proradio-menu-horizontal .proradio-menubar > li > ul li a',
			'property'      => 'color',
		),
	),
));

Kirki::add_field( 'proradio_config', array(
	'type'        => 'color',
	'settings'    => 'proradio_menu_lh',
	'label'       => esc_html__( 'Main menu links hover color', "proradio" ),
	'section'     => 'proradio_header_section',
	'priority'    => 10,
	'transport'   => 'auto',
	'output'    => array(
		array(
			'element'       => '.proradio-menu a:hover, .proradio-menu-horizontal .proradio-menubar > li > ul li a:hover,  .proradio-menubar > li:hover > a > span',
			'property'      => 'color',
		),
		array(
			'element'       => '.proradio-menu-horizontal .proradio-menubar > li > a::after',
			'property'      => 'border-color',
		),

	),
));


Kirki::add_field( 'proradio_config', array(
	'type'        => 'color',
	'settings'    => 'submenu_bg_col',
	'label'       => esc_html__( 'Sub menu background', "proradio" ),
	'section'     => 'proradio_header_section',
	'priority'    => 10,
	'transport'   => 'auto',
	'output'    => array(
		array(
			'element'       => '.proradio-menu-horizontal .proradio-menu-horizontal_c .proradio-menubar > li ul li',
			'property'      => 'background-color',
		),

	),
));

Kirki::add_field( 'proradio_config', array(
	'type'        => 'color',
	'settings'    => 'submenu_bg_h',
	'label'       => esc_html__( 'Sub menu background', "proradio" ).' - '.esc_html__( 'hover', "proradio" ),
	'section'     => 'proradio_header_section',
	'priority'    => 10,
	'transport'   => 'auto',
	'default'		=> '',
	'output'    => array(
		array(
			'element'       => '.proradio-menu-horizontal .proradio-menubar > li > ul li a',
			'property'      => 'background-image',
			'value_pattern' =>'linear-gradient(45deg, $ 0%, $ 100%) !important;',
		),

	),
));
Kirki::add_field( 'proradio_config', array(
	'type'        => 'color',
	'settings'    => 'submenu_bg_h_t',
	'label'       => esc_html__( 'Sub menu links color', "proradio" ).' - '.esc_html__( 'hover', "proradio" ),
	'section'     => 'proradio_header_section',
	'priority'    => 10,
	'transport'   => 'auto',
	'default'		=> '',
	'output'    => array(
		array(
			'element'       => '.proradio-menu-horizontal .proradio-menubar > li ul li:hover > a',
			'property'      => 'color',
		),

	),
));









Kirki::add_field( 'proradio_config', [
	'type'        => 'slider',
	'settings'    => 'menu_size',
	'label'       => esc_html__( 'Menu font size', 'proradio' ),
	'section'     => 'proradio_header_section',
	'default'     => 12,
	'transport'   => 'auto',
	'choices'     => [
		'min'  => 12,
		'max'  => 22,
		'step' => 1,
	],
	'output'    => array(
		array(
			'element'       => '.proradio-menu-horizontal li a, .proradio-menu-horizontal .proradio-menubar > li ul li a',
			'property'      => 'font-size',
			'value_pattern' => esc_attr( ' $px' ),
			'media_query' => '@media (min-width: 1201px)'
		),
	),
] );

Kirki::add_field( 'proradio_config', [
	'type'        => 'slider',
	'settings'    => 'menu_height',
	'label'       => esc_html__( 'Logo and menu height', 'proradio' ),
	'section'     => 'proradio_header_section',
	'default'     => 100,
	'transport'   => 'auto',
	'choices'     => [
		'min'  => 40,
		'max'  => 200,
		'step' => 2,
	],
	'output'    => array(
		array(
			'element'       => '.proradio-unscrolled .proradio-menu__cont',
			'property'      => 'min-height',
			'value_pattern' => esc_attr( ' $px; ' ),
			'media_query' => '@media (min-width: 1201px)'
		),
		array(
			'element'       => '.proradio-unscrolled .proradio-menu__logo, .proradio-unscrolled .proradio-logolink',
			'property'      => 'height',
			'value_pattern' => esc_attr( ' $px;' ),
			'media_query' => '@media (min-width: 1201px)'
		),
		array(
			'element'       => '.proradio-unscrolled .proradio-menu__logo, .proradio-unscrolled .proradio-logolink',
			'property'      => 'line-height',
			'value_pattern' => esc_attr( ' $px;' ),
			'media_query' => '@media (min-width: 1201px)'
		),
		array(
			'element'       => '.proradio-unscrolled .proradio-menu__logo img',
			'property'      => 'max-height',
			'value_pattern' => esc_attr( ' $px; ' ),
			'media_query' => '@media (min-width: 1201px)'
		),		
	),
] );

Kirki::add_field( 'proradio_config', [
	'type'        => 'slider',
	'settings'    => 'menu_height_scrolled',
	'label'       => esc_html__( 'Logo and menu height scrolled', 'proradio' ),
	'section'     => 'proradio_header_section',
	'default'     => 40,
	'transport'   => 'auto',
	'choices'     => [
		'min'  => 40,
		'max'  => 160,
		'step' => 1,
	],
	'output'    => array(
		array(
			'element'       => '.proradio-menu__cont',
			'property'      => 'min-height',
			'value_pattern' => esc_attr( ' $px; ' ),
			'media_query' => '@media (min-width: 1201px)'
		),
		array(
			'element'       => '.proradio-menu__logo, .proradio-logolink',
			'property'      => 'height',
			'value_pattern' => esc_attr( ' $px;' ),
			'media_query' => '@media (min-width: 1201px)'
		),
		array(
			'element'       => '.proradio-menu__logo, .proradio-logolink',
			'property'      => 'line-height',
			'value_pattern' => esc_attr( ' $px;' ),
			'media_query' => '@media (min-width: 1201px)'
		),
		array(
			'element'       => '.proradio-menu__logo img',
			'property'      => 'max-height',
			'value_pattern' => esc_attr( ' $px; ' ),
			'media_query' => '@media (min-width: 1201px)'
		),		
	),
] );
Kirki::add_field( 'proradio_config', [
	'type'        => 'slider',
	'settings'    => 'logo_margin',
	'label'       => esc_html__( 'Logo margin', 'proradio' ),
	'section'     => 'proradio_header_section',
	'default'     => 0,
	'transport'   => 'auto',
	'choices'     => [
		'min'  => 0,
		'max'  => 20,
		'step' => 1,
	],
	'output'    => array(
		array(
			'element'       => '.proradio-menu__logo',
			'property'      => 'margin-left',
			'value_pattern' => esc_attr( ' $px;' ),
			'media_query' => '@media (min-width: 1201px)'
		),
	),
] );

Kirki::add_field( 'proradio_config', [
	'type'        => 'slider',
	'settings'    => 'menu_padding',
	'label'       => esc_html__( 'Menu vertical padding', 'proradio' ),
	'section'     => 'proradio_header_section',
	'default'     => 0,
	'transport'   => 'auto',
	'choices'     => [
		'min'  => 0,
		'max'  => 20,
		'step' => 1,
	],
	'output'    => array(
		array(
			'element'       => '.proradio-menu__cont',
			'property'      => 'padding-top',
			'value_pattern' => esc_attr( ' $px;' ),
			'media_query' => '@media (min-width: 1201px)'
		),	
		array(
			'element'       => '.proradio-menu__cont',
			'property'      => 'padding-bottom',
			'value_pattern' => esc_attr( ' $px;' ),
			'media_query' => '@media (min-width: 1201px)'
		),	
	),
] );


Kirki::add_field( 'proradio_config', array(
	'type'        => 'image',
	'settings'    => 'proradio_logo_header_mob',
	'label'       => esc_html__( 'Logo header mobile', "proradio" ),
	'description' => esc_html__( 'Max height: 50px', "proradio" ),
	'section'     => 'proradio_header_section',
	'priority'    => 10
));


if ( function_exists('WC') ){
	Kirki::add_field( 'proradio_config', array(
		'type'        => 'switch',
		'settings'    => 'proradio_wc_cart',
		'label'       => esc_html__( 'Display shopping cart for WooCommerce', "proradio" ),
		'section'     => 'proradio_header_section',
		'description' => esc_html__( 'If using WooCommerce, will add the cart icon and total to the header.', "proradio" ),
		'priority'    => 10,
		'default'     => '0'
	));
}

Kirki::add_field( 'proradio_config', array(
	'type'        => 'toggle',
	'settings'    => 'proradio_play_header',
	'label'       => esc_html__( 'Play button', "proradio" ),
	'section'     => 'proradio_header_section',
	'description' => esc_html__( 'Add a play/pause switch to the header', "proradio" ),
	'priority'    => 10,
	'default'     => '0'
));
Kirki::add_field( 'proradio_config', array(
	'type'        => 'text',
	'settings'    => 'proradio_play_label',
	'label'       => esc_html__( 'Play button text', "proradio" ),
	'section'     => 'proradio_header_section',
	'priority'    => 10,
	'active_callback' => [
		[
			'setting'  => 'proradio_play_header',
			'operator' => '==',
			'value'    => true,
		]
	],
));

Kirki::add_field( 'proradio_config', array(
	'type'        => 'toggle',
	'settings'    => 'proradio_vol_header',
	'label'       => esc_html__( 'Volume control', "proradio" ),
	'description' => esc_html__( 'Display the volume in the menu, will not appear in the player bar.', "proradio" ),
	'section'     => 'proradio_header_section',
	'description' => esc_html__( 'Desktop only.', "proradio" ),
	'priority'    => 10,
	'default'     => '0'
));





Kirki::add_field( 'proradio_config', array(
	'type'        => 'switch',
	'settings'    => 'proradio_search_header',
	'label'       => esc_html__( 'Display search', "proradio" ),
	'section'     => 'proradio_header_section',
	'description' => esc_html__( 'Add the search icon to the header bar', "proradio" ),
	'priority'    => 10,
	'default'     => '0'
));

Kirki::add_field( 'proradio_config', array(
	'type'        => 'switch',
	'settings'    => 'proradio_header_parallax',
	'label'       => esc_html__( 'Parallax effect', "proradio" ),
	'section'     => 'proradio_header_section',
	'description' => esc_html__( 'Enable effect on scroll for archive and default headers', "proradio" ),
	'priority'    => 10,
	'default'     => '0'
));



