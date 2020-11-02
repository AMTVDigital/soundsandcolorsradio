<?php

/* = custom post type release
===================================================*/

if(!function_exists('proradio_radiochannel_register_type')){
	add_action('init', 'proradio_radiochannel_register_type');  
	function proradio_radiochannel_register_type() {	
		$labelsradio = array(
			'name' => esc_html__("Radio channels","proradio"),
			'singular_name' => esc_html__("Radio channel","proradio"),
			'add_new' => esc_html__('Add new channel',"proradio"),
			'add_new_item' => esc_html__("Add new radio channel","proradio"),
			'edit_item' => esc_html__("Edit radio channel","proradio"),
			'new_item' => esc_html__("New radio channel","proradio"),
			'all_items' => esc_html__('All radio channels',"proradio"),
			'view_item' => esc_html__("View radio channel","proradio"),
			'search_items' => esc_html__("Search radio channels","proradio"),
			'not_found' =>  esc_html__("No radio channels found","proradio"),
			'not_found_in_trash' => esc_html__("No radio channels found in Trash","proradio"), 
			'parent_item_colon' => '',
			'menu_name' => esc_html__("Radio channels","proradio")
		);
		$args = array(
			'labels' => $labelsradio,
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true, 
			'show_in_menu' => true, 
			'query_var' => true,
			'rewrite' 	=> array( 'slug' => sanitize_title_with_dashes( get_theme_mod('slug_radiochannel', 'radiochannel') ) ),
			'capability_type' => 'page',
			'has_archive' => true,
			'hierarchical' => false,
			'menu_position' => 50,
			'page-attributes' => true,
			'show_in_nav_menus' => true,
			'show_in_admin_bar' => true,
			'show_in_menu' => true,
			'show_in_rest' => true,
			'menu_icon' => 'dashicons-media-audio',
			'supports' => array('title', 'thumbnail','editor', 'page-attributes' )
		); 
		if(function_exists('proradio_core_posttype')){
			proradio_core_posttype( "radiochannel" , $args );
		}

		/* ============= create custom taxonomy for the shows ==========================*/
		$labels = array(
			'name' => esc_html__( 'Genres',"proradio" ),
			'singular_name' => esc_html__( 'Genre',"proradio" ),
			'search_items' =>  esc_html__( 'Search by genre',"proradio" ),
			'popular_items' => esc_html__( 'Popular genres',"proradio" ),
			'all_items' => esc_html__( 'All shows',"proradio" ),
			'parent_item' => null,
			'parent_item_colon' => null,
			'edit_item' => esc_html__( 'Edit genre',"proradio" ), 
			'update_item' => esc_html__( 'Update genre',"proradio" ),
			'add_new_item' => esc_html__( 'Add New genre',"proradio" ),
			'new_item_name' => esc_html__( 'New genre Name',"proradio" ),
			'separate_items_with_commas' => esc_html__( 'Separate genres with commas',"proradio" ),
			'add_or_remove_items' => esc_html__( 'Add or remove genres',"proradio" ),
			'choose_from_most_used' => esc_html__( 'Choose from the most used genres',"proradio" ),
			'menu_name' => esc_html__( 'Genres',"proradio" )
		); 
		$args = array(
			'hierarchical' => false,
			'labels' => $labels,
			'show_ui' => true,
			'update_count_callback' => '_update_post_term_count',
			'query_var' => true,
			'show_in_rest' => true,
			'rewrite' => array( 'slug' => 'radio-genre' )
		);
		if(function_exists('proradio_core_custom_taxonomy')){
			register_taxonomy('radio-genre','radiochannel', $args );
		}
	}
}

/* = Fields
===================================================*/
function proradio_radiochannel_capabilities(){
	
	$radio_details = array(

		
		array(
			'label' => esc_html__('MP3 Stream URL', 'proradio' ),
			'id'    => 'mp3_stream_url',
			'type'  => 'text'
			),
		array(
			'label' => esc_html__('MP3 Stream URL mobile', 'proradio' ),
			'desc'	=> esc_html__('The player will automatically stream this URL if opening from a mobile browser. Recommended: 64 or 96Kbps', 'proradio'),
			'id'    => 'mp3_stream_url_mobile',
			'type'  => 'text'
			),
		array(
			'label' => esc_html__('Radio subtitle', 'proradio' ),
			'id'    => 'qt_radio_subtitle',
			'type'  => 'text'
			),
		array(
			'label' => esc_html__('Radio logo', 'proradio' ),
			'id'    => 'qt_radio_logo',
			'type'  => 'image'
			),
		array(
			'label' => esc_html__('Player icon', 'proradio' ).' '.esc_html__('(600 x 600 px)', 'proradio'),
			'id'    => 'qt_player_icon',
			'type'  => 'image'
			),

		array(
			'label' => esc_html__('Server type',		 'proradio' ),
			'id'    => 'proradio_servertype',
			'type' 	=> 'select',
			'default' => false,
			'options' => array (
				array(
					'label' => esc_html__( 'Metadata',		 'proradio' ), 
					'value' => 'type-auto' 
				),	
				array(
					'label' => esc_html__( 'SHOUTcast',		 'proradio' ), 
					'value' => 'type-shoutcast' 
				),	
				array(
					'label' => esc_html__( 'IceCast', "proradio" ), 
					'value' => 'type-icecast' ,	
				),
				array(
					'label' => esc_html__( 'Radio.co', "proradio" ), 
					'value' => 'type-radiodotco' ,	
				),
				array(
					'label' => esc_html__( 'AirTime', "proradio" ), 
					'value' => 'type-airtime' 
				),
				array(
					'label' => esc_html__( 'Radionomy', "proradio" ), 
					'value' => 'type-radionomy' ,	
				),
				array(
					'label' => esc_html__( 'Live365', "proradio" ), 
					'value' => 'type-live365' ,	
				),
				array(
					'label' => esc_html__( 'Plain text (author - title)', "proradio" ), 
					'value' => 'type-text' ,	
				)
			)//options
		),
		array(
			'label' => esc_html__('SHOUTCast XMl Feed HOST', 'proradio' ),
			'id'    => 'qtradiofeedHost',
			'type'  => 'text',
			'condition' => array(
				array(
					'field' => 'proradio_servertype',
					'value'	=> 'type-shoutcast'
				)
			)
			),
		array(
			'label' => esc_html__('SHOUTCast XMl Feed PORT', 'proradio' ),
			'id'    => 'qtradiofeedPort',
			'type'  => 'text',
			'condition' => array(
				array(
					'field' => 'proradio_servertype',
					'value'	=> 'type-shoutcast'
				)
			)
			),
		array(
			'label' => esc_html__('SHOUTCast Channel (default 1)', 'proradio' ),
			'id'    => 'qtradiofeedChannel',
			'type'  => 'text',
			'condition' => array(
				array(
					'field' => 'proradio_servertype',
					'value'	=> 'type-shoutcast'
				)
			)
			),
		array(
			'label' => esc_html__('SHOUTCast protocol',		 'proradio' ),
			'id'    => 'qtradiofeedProtocol',
			'desc'	=> esc_html__('Force HTTPS protocol if your radio has https on non-443 port. Ask your streaming provider for the right settings.', 'proradio'),
			'type' 	=> 'select',
			'default' => "http",
			'condition' => array(
				array(
					'field' => 'proradio_servertype',
					'value'	=> 'type-shoutcast'
				)
			),
			'options' => array (
				array('label' => esc_html__( 'Automatic (uses https when port is 443)', "proradio" ), 'value' => 'http' ),	
				array('label' => esc_html__( 'Force HTTPS', "proradio" ), 'value' => 'https' ),	
			)
		),
		array(
			'label' => esc_html__('IceCast json URL', 'proradio' ),
			'id'    => 'qticecasturl',
			'type'  => 'text',
			'desc' 	=> esc_html__('Important! Needs to be in your same protocol of the website! If your site is in https you have to put the URL with https and your icecast server needs to support this', 'proradio' ),
			'condition' => array(
				array(
					'field' => 'proradio_servertype',
					'value'	=> 'type-icecast'
				)
			)
			),
		array(
			'label' => esc_html__('IceCast mountpoint (including "/")', 'proradio' ),
			'id'    => 'qticecastMountpoint',
			'type'  => 'text',
			'condition' => array(
				array(
					'field' => 'proradio_servertype',
					'value'	=> 'type-icecast'
				)
			)
			),
		array(
			'label' => esc_html__('IceCast channel',		 'proradio' ),
			'desc'  =>  esc_html__( 'only for Icecast radios with multi-channel feed', 'proradio' ),
			'id'    => 'qticecastChannel',
			'type'  => 'text',
			'condition' => array(
				array(
					'field' => 'proradio_servertype',
					'value'	=> 'type-icecast'
				)
			)
			),
		array(
			'label' => esc_html__('Radio.co radio ID', 'proradio' ),
			'id'    => 'qtradiodotco',
			'type'  => 'text',
			'desc' 	=>  esc_html__( 'For Radio.co users, find the ID in the streaming URL, example: https://streamer.radio.co/[YOUR ID]/listen#.mp3', 'proradio' ),
			'condition' => array(
				array(
					'field' => 'proradio_servertype',
					'value'	=> 'type-radiodotco'
				)
			),
			),
		array(
			'label' => esc_html__( 'Airtime Pro', 'proradio' ),
			'id'    => 'qtairtime',
			'type'  => 'text',
			'desc' 	=> esc_html__( 'For AirTime Pro users add your API url (http://[YOUR ID].airtime.pro/api/live-info-v2)', 'proradio' ),
			'condition' => array(
				array(
					'field' => 'proradio_servertype',
					'value'	=> 'type-airtime'
				)
			),
			),
		array(
			'label' => esc_html__('Radionomy', 'proradio' ),
			'id'    => 'qtradionomy',
			'type'  => 'text',
			'desc' 	=>  esc_html__('Please build the URL using your radionomy UID and API Key <BR> (http://api.radionomy.com/currentsong.cfm?radiouid=[USER ID HERE]&apikey=[API KEY HERE]&callmeback=yes&type=xml&cover=yes)','proradio' ),
			'condition' => array(
				array(
					'field' => 'proradio_servertype',
					'value'	=> 'type-radionomy'
				)
			),
			),
		array(
			'label' => esc_html__('Plain text', 'proradio' ),
			'id'    => 'qttextfeed',
			'type'  => 'text',
			'desc' 	=> esc_html__('If you have a URL displaying a plain text as ARTIST NAME - SONG TITLE add the URL in this field.','proradio' ),
			'condition' => array(
				array(
					'field' => 'proradio_servertype',
					'value'	=> 'type-text'
				)
			),
			),
		array(
			'label' => esc_html__('Live365 ID',  'proradio' ),
			'id'    => 'qtlive365',
			'type'  => 'text',
			'desc' => esc_html__('Alphanumeric ID only, not the full URL. Example: for the channel http://player.live365.com/x12345?l input only x12345',  'proradio' ),
			'condition' => array(
				array(
					'field' => 'proradio_servertype',
					'value'	=> 'type-live365'
				)
			),
			),
		array(
			'label' => esc_html__('Exclude from playlist', 'proradio'),
			'id'    => 'qt-excludefromplaylist',
			'type'  => 'checkbox',
			'desc' 	=> esc_html__('Do  not include this radio channel in the default playlist.', 'proradio'),
			),
		array(
			'label' => esc_html__('Use proxy', 'proradio'),
			'id'    => 'proradio-useproxy',
			'type'  => 'checkbox',
			'desc' 	=> esc_html__('Try to fix wrong CORS policies on your server settings. May be CPU intensive for your hosting.','proradio' ),
			),
	);
	if (class_exists('Custom_Add_Meta_Box')){
		$proradio_radiochannel_metas = new Custom_Add_Meta_Box( 'proradio_radiochannel_metas', esc_html__('Radio channel details','proradio'), $radio_details, 'radiochannel', true );
	}


	
}

add_action('wp_loaded', 'proradio_radiochannel_capabilities');  
