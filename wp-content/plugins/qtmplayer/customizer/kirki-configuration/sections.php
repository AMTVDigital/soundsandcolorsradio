<?php  
/**
 * Create sections using the WordPress Customizer API.
 * @package Kirki
 */
if(!function_exists('qtmplayer_kirki_sections')){
function qtmplayer_kirki_sections( $wp_customize ) {

	/**
	 * Player settings with sub panel ============================================================
	 */
	$wp_customize->add_panel( 'qtmplayer_player_panel', array(
		'title'       => esc_html__( 'Player settings', "qtmplayer" ),
		'priority'    => 60
	));

		$wp_customize->add_section( 'qtmplayer_options_section', array(
			'title'       => esc_html__( 'Player options', 'qtmplayer' ),
			'description' => esc_html__( 'Manage design options', 'qtmplayer' ),
			'panel'          => 'qtmplayer_player_panel', // Not typically needed.
			'priority'       => 0,
		));
		$wp_customize->add_section( 'qtmplayer_colors_section', array(
			'title'       => esc_html__( 'Colors', 'qtmplayer' ),
			'description' => esc_html__( 'Manage player colors', 'qtmplayer' ),
			'panel'          => 'qtmplayer_player_panel', // Not typically needed.
			'priority'       => 1,
		));

		$wp_customize->add_section( 'qtmplayer_radio_section', array(
			'title'       => esc_html__( 'Radio options', 'qtmplayer' ),
			'description' => esc_html__( 'Manage radio channels options', 'qtmplayer' ),
			'panel'          => 'qtmplayer_player_panel', // Not typically needed.
			'priority'       => 10,
		));
		$wp_customize->add_section( 'qtmplayer_podcast_section', array(
		  	'title'       => esc_html__( 'Podcasts', 'qtmplayer' ),
		   'description' => esc_html__( 'Manage podcasts in player', 'qtmplayer' ),
		   'panel'          => 'qtmplayer_player_panel', // Not typically needed.
		   'priority'       => 10,
		));
		$wp_customize->add_section( 'qtmplayer_player_audioposts', array(
		  	'title'       => esc_html__( 'Audio posts', 'qtmplayer' ),
		   'description' => esc_html__( 'Audio posts to load in player', 'qtmplayer' ),
		   'panel'          => 'qtmplayer_player_panel', // Not typically needed.
		   'priority'       => 10,
		));
		$wp_customize->add_section( 'qtmplayer_player_playlist', array(
		  	'title'       => esc_html__( 'Custom playlist', 'qtmplayer' ),
		   'description' => esc_html__( 'Create a custom playlist or the player', 'qtmplayer' ),
		   'panel'          => 'qtmplayer_player_panel', // Not typically needed.
		   'priority'       => 10,
		));
	
}}
add_action( 'customize_register', 'qtmplayer_kirki_sections' );
