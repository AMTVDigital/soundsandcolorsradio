<?php  
/**
 * Create customizer fields for the kirki framework.
 * @package Kirki
 */


qtmplayerKirki_Kirki::add_field( 'qtmplayer_config', array(
	'type'        => 'switch',
	'settings'    => 'qtmplayer_artworks',
	'label'       => esc_html__( 'Fetch player artworks', "qtmplayer" ),
	'section'     => 'qtmplayer_radio_section',
	'description' => esc_html__( 'Attempt to retrieve artworks for the songs', "qtmplayer" ),
	'priority'    => 10,
	'default'     => '1'
));


/* = Options section
=============================================*/
qtmplayerKirki_Kirki::add_field( 'qtmplayer_config', array(
	'type'        => 'select',
	'settings'    => 'qtmplayer_design',
	'label'       => esc_html__( 'Player design', 'proradio' ),
	'section'     => 'qtmplayer_options_section',
	'default'     => 'header',
	'priority'    => 10,
	'multiple'    => 0,
	'choices'     => array(
			'header'   	=> esc_attr__( 'Header', 'proradio' ),
			'footer'   	=> esc_attr__( 'Footer', 'proradio' ),
		)
) );

/**
*	===========================================
*	@since PR.3.3.3
*	===========================================
*/
qtmplayerKirki_Kirki::add_field( 'qtmplayer_config', array(
	'type'        => 'select',
	'settings'    => 'qtmplayer_visibility',
	'label'       => esc_html__( 'Player visibility', 'proradio' ),
	'description' => esc_html__( 'Hide the player bar, leave only alternative player interfaces like header button or custom players', "qtmplayer" ),
	'section'     => 'qtmplayer_options_section',
	'default'     => '',
	'transport'   => 'auto',
	'priority'    => 10,
	'multiple'    => 0,
	'choices'     => array(
			''   => esc_attr__( 'Visible', 'proradio' ),
			'none'   	=> esc_attr__( 'Hidden', 'proradio' ),
		),
	'output'    => array(
		array(
			'element'       => '.proradio-playercontainer--regular #qtmplayer, .proradio-placeholder--regular',
			'property'      => 'display',
			'suffix'      => ' !important'
		),
		array(
			'element'       => '.proradio-playercontainer--regular',
			'property'      => 'opacity', // Meant to not do anything, we need height 0 not visibility because th eplaylist may be still required
			'suffix'      => ' !important; height: 0 !important;'
		),
	),
) );




qtmplayerKirki_Kirki::add_field( 'qtmplayer_config', array(
	'type'        => 'select',
	'settings'    => 'qtmplayer_icon_cart',
	'label'       => esc_html__( 'Show radio or cart icon in player', "qtmplayer" ),
	'section'     => 'qtmplayer_options_section',
	'description' => esc_html__( 'Show icon linked to the single album or radio channel in the player bar', "qtmplayer" ),
	'priority'    => 10,
	'default'     => 'inline-block',
	'choices'     => array(
		'inline-block'   	=> esc_attr__( 'Show', 'proradio' ),
		'none'   	=> esc_attr__( 'Hide', 'proradio' ),
	),
	'transport'   => 'auto',
	'output'    => array(
		array(
			'element'       => '.qtmplayer__cart',
			'property'      => 'display',
			'suffix'      => ' !important'
		),
	),
));


qtmplayerKirki_Kirki::add_field( 'qtmplayer_config', array(
	'type'        => 'select',
	'settings'    => 'qtmplayer_icon_playlist',
	'label'       => esc_html__( 'Playlist open button', "qtmplayer" ),
	'section'     => 'qtmplayer_options_section',
	'description' => esc_html__( 'Show icon to open the playlist from the player bar', "qtmplayer" ),
	'priority'    => 10,
	'default'     => 'inline-block',
	'choices'     => array(
		'inline-block'   	=> esc_attr__( 'Show', 'proradio' ),
		'none'   	=> esc_attr__( 'Hide', 'proradio' ),
	),
	'transport'   => 'auto',
	'output'    => array(
		array(
			'element'       => '.qtmplayer__playlistbtn',
			'property'      => 'display',
			'suffix'      => ' !important;'
		),
	),
));


qtmplayerKirki_Kirki::add_field( 'qtmplayer_config', array(
	'type'        => 'select',
	'settings'    => 'qtmplayer_arrows',
	'label'       => esc_html__( 'Back and forward buttons', "qtmplayer" ),
	'section'     => 'qtmplayer_options_section',
	'description' => esc_html__( 'Display back and forward buttons in the player', "qtmplayer" ),
	'priority'    => 10,
	'default'     => 'inline-block',
	'choices'     => array(
		'inline-block'  => esc_attr__( 'Show', 'proradio' ),
		'none'   		=> esc_attr__( 'Hide', 'proradio' ),
	),
	'transport'   	=> 'auto',
	'output'    	=> array(
		array(
			'element'	=> '.qtmplayer__actions .qtmplayer__prev, .qtmplayer__actions .qtmplayer__next',
			'property'	=> 'display',
			'suffix'	=> ' !important;'
		),
	),
));




qtmplayerKirki_Kirki::add_field( 'qtmplayer_config', array(
	'type'        => 'switch',
	'settings'    => 'qtmplayer_cover_desktop',
	'label'       => esc_html__( 'Show cover in desktop', "qtmplayer" ),
	'section'     => 'qtmplayer_options_section',
	'description' => esc_html__( 'Show or hide track cover in desktop mode', "qtmplayer" ),
	'priority'    => 10,
	'default'     => '1'
));
qtmplayerKirki_Kirki::add_field( 'qtmplayer_config', array(
	'type'        => 'switch',
	'settings'    => 'qtmplayer_replace_default',
	'label'       => esc_html__( 'Custom player in post contents', "qtmplayer" ),
	'section'     => 'qtmplayer_options_section',
	'description' => esc_html__( 'Replace default audio block with the custom player', "qtmplayer" ),
	'priority'    => 10,
	'default'     => '1'
));


/* = Colors section
=============================================*/

qtmplayerKirki_Kirki::add_field( 'qtmplayer_config', array(
	'type'        => 'color',
	'settings'    => 'qtmplayer_bg',
	'label'       => esc_html__( 'Background color', "qtmplayer" ),
	'section'     => 'qtmplayer_colors_section',
	'priority'    => 0,
));
qtmplayerKirki_Kirki::add_field( 'qtmplayer_config', array(
	'type'        => 'color',
	'settings'    => 'qtmplayer_color_txt',
	'label'       => esc_html__( 'Text color', "qtmplayer" ),
	'section'     => 'qtmplayer_colors_section',
	'priority'    => 0,
));
qtmplayerKirki_Kirki::add_field( 'qtmplayer_config', array(
	'type'        => 'color',
	'settings'    => 'qtmplayer_accent_bg',
	'label'       => esc_html__( 'Accent background color', "qtmplayer" ),
	'section'     => 'qtmplayer_colors_section',
	'priority'    => 0,
));
qtmplayerKirki_Kirki::add_field( 'qtmplayer_config', array(
	'type'        => 'color',
	'settings'    => 'qtmplayer_accent_txt',
	'label'       => esc_html__( 'Text color on accent', "qtmplayer" ),
	'section'     => 'qtmplayer_colors_section',
	'priority'    => 0,
));
qtmplayerKirki_Kirki::add_field( 'qtmplayer_config', array(
	'type'        => 'color',
	'settings'    => 'qtmplayer_accent_bg_h',
	'label'       => esc_html__( 'Accent hover background color ', "qtmplayer" ),
	'section'     => 'qtmplayer_colors_section',
	'priority'    => 0,
));

qtmplayerKirki_Kirki::add_field( 'qtmplayer_config', array(
	'type'        => 'color',
	'settings'    => 'qtmplayer_track_bg',
	'label'       => esc_html__( 'Track background', "qtmplayer" ),
	'section'     => 'qtmplayer_colors_section',
	'priority'    => 0,
	'choices'     => [
		'alpha' => true,
	],
));


/* = Player section // Audio Posts
=============================================*/
qtmplayerKirki_Kirki::add_field( 'qtmplayer_config', array(
	'type'     => 'text',
	'settings' => 'qtmplayer_player_audiopostfeatured',
	'label'    => esc_html__( 'Feature Audio Posts', 'qtmplayer' ),
	'section'  => 'qtmplayer_player_audioposts',
	'description'  => esc_attr__( 'Add one or more posts with audio format by ID, comma separated', 'qtmplayer' ).' (34,56,92)',
	'priority' => 10,
));
qtmplayerKirki_Kirki::add_field( 'qtmplayer_config', array(
	'type'        => 'slider',
	'settings'    => 'qtmplayer_player_audiopostamount',
	'label'       => esc_attr__( 'Max audio posts preload amount', 'qtmplayer' ),
	'section'     => 'qtmplayer_player_audioposts',
	'default'     => '1',
	'priority'    => 10,
	'description'  => esc_attr__( 'Amount of posts with "audio" format to be preloaded. MP3 Only.', 'qtmplayer' ),
	'choices'     => array(
		'min'  => '0',
		'max'  => '30',
		'step' => '1',
	),
));


/* = Player section // Podcasts
=============================================*/
qtmplayerKirki_Kirki::add_field( 'qtmplayer_config', array(
	'type'     => 'text',
	'settings' => 'qtmplayer_player_podcastfeatured',
	'label'    => __( 'Featured podcasts by ID [ONLY MP3 PODCASTS]', 'qtmplayer' ),
	'section'  => 'qtmplayer_podcast_section',
	'description'  => esc_attr__( 'Add one or more podcasts to the player by ID, comma separated (34,56,92).', 'qtmplayer' ),
	'priority' => 10,
));
qtmplayerKirki_Kirki::add_field( 'qtmplayer_config', array(
	'type'        => 'slider',
	'settings'    => 'qtmplayer_player_podcastamount',
	'label'       => esc_attr__( 'Max podcast preload amount [ONLY MP3 PODCASTS]', 'qtmplayer' ),
	'section'     => 'qtmplayer_podcast_section',
	'default'     => '1',
	'priority'    => 10,
	'description'  => esc_attr__( 'A large number of items may slow down your website.', 'qtmplayer' ),
	'choices'     => array(
		'min'  => '0',
		'max'  => '30',
		'step' => '1',
	),
));


/* = Player section // Custom playlist
=============================================*/
qtmplayerKirki_Kirki::add_field( 'qtmplayer_config', array(
	'type'        => 'repeater',
	'label'       => esc_attr__( 'Custom playlist tracks', 'qtmplayer' ),
	'section'     => 'qtmplayer_player_playlist',
	'priority'    => 10,
	'row_label' => array(
		'type'  => 'field',
		'value' => esc_attr__('Track', 'qtmplayer' ),
		'field' => 'title',
	),
	'button_label' => esc_attr__('Add new track', 'qtmplayer' ),
	'settings'     => 'qtmplayer_custom_playlist',
	'fields' => array(
		'title' => array(
			'type'        => 'text',
			'label'       => esc_attr__( 'Title', 'qtmplayer' ),
		),
		'artist' => array(
			'type'        => 'text',
			'label'       => esc_attr__( 'Artist', 'qtmplayer' ),
		),
		'album' => array(
			'type'        => 'text',
			'label'       => esc_attr__( 'Album name', 'qtmplayer' ),
		),
		'buylink' => array(
			'type'        => 'text',
			'label'       => esc_attr__( 'Purchase or download link or WooCommerce ID', 'qtmplayer' ),
		),
		'price' => array(
			'type'        => 'text',
			'label'       => esc_attr__( 'Price', 'qtmplayer' ),
		),
		'icon' => array(
			'type'        => 'radio',
			'label'       => esc_attr__( 'Icon', 'qtmplayer' ),
			'default'     => 'download',
			'choices'     => array(
				'download'   => esc_attr__( 'download', 'qtmplayer' ),
				'cart' => esc_attr__( 'cart', 'qtmplayer' ),
			),
		),
		'link' => array(
			'type'        => 'text',
			'label'       => esc_attr__( 'Album link', 'qtmplayer' ),
		),
		'sample' => array(
			'type'        => 'upload',
			'label'       => esc_attr__( 'Track mp3', 'qtmplayer' ),
			'mime_type'	  => array('audio/mpeg','audio/mpeg','audio/mpg','audio/x-mpeg','audio/mp3','application/force-download','application/octet-stream')
		),
		'art' => array(
			'type'        => 'image',
			'label'       => esc_attr__( 'Artwork cover', 'qtmplayer' ),
			'choices'     => array(
				'save_as' => 'id',
			),
		),
	)
) );



