<?php

/*
 *	Design settings for single post to override customizer defaults
 *	=============================================================
 */
if(!function_exists("qtmplayer_custom_post_fields_settings")){
	add_action('init', 'qtmplayer_custom_post_fields_settings');  
	function qtmplayer_custom_post_fields_settings() {
		$settings = array (
			array (
				'label' =>  esc_html__( 'Download or Buy link', 'qtmplayer' ),
				'desk'	=> esc_html__( 'MP3 url or any purchase link', 'qtmplayer' ),
				'id' =>  'qtmplayer_dll',
				'type' 	=> 'text',
			)
		);
		if(function_exists('custom_meta_box_field')){
			$settingsbox = new Custom_Add_Meta_Box('qtmplayer_post_special_fields', 'Player settings', $settings, 'post', true );
		}


		// Audio post only
		$podcast_tracklist_fields = array(
			array (
				'label' =>  esc_html__( 'Tracklist title', 'qtmplayer' ),
				'desk'	=> esc_html__( 'Optional title of the tracklist', 'qtmplayer' ),
				'id' =>  'qtmplayer_tracklist_title',
				'type' 	=> 'text',
			),
			array( // Repeatable & Sortable Text inputs
				'label'	=>  esc_attr__( 'Podcast tracklist', 'qtmplayer' ), // <label>
				'desc'	=>  esc_attr__( 'Add tracks information', 'qtmplayer' ), // description
				'id'	=> 'qtmplayer_tracklist', // field id and name
				'type'	=> 'repeatable', // type of field
				'sanitizer' => array( // array of sanitizers with matching kets to next array
					'title' => 'sanitize_text_field',
					'artist' => 'sanitize_text_field',
				),
				'repeatable_fields' => array ( // array of fields to be repeated
					'title' => array(
						'label' => esc_html__( 'Cue title', 'qtmplayer' ),
						'id' => 'title',
						'type' => 'text'
					),
					'artist' => array(
						'label' => esc_html__( 'Cue subtitle', 'qtmplayer' ),
						'id' => 'artist',
						'type' => 'text'
					),
					'time' => array(
						'label' =>  esc_attr__( 'Time (HH:MM:SS)', 'qtmplayer' ),
						'desc'	=>  esc_attr__( 'Hours, minutes and seconds', 'qtmplayer' ), // description
						'id' => 'cue',
						'type' => 'timecue'
					)
				)
			)
		);
		if(function_exists('custom_meta_box_field')){
			$podcast_tab_tracklist = new Custom_Add_Meta_Box( 'qtmplayer_tracklist', esc_attr__('Podcast tracklist', 'qtmplayer'), $podcast_tracklist_fields, 'post', true );
			$podcast_tab_tracklist = new Custom_Add_Meta_Box( 'qtmplayer_tracklist', esc_attr__('Podcast tracklist', 'qtmplayer'), $podcast_tracklist_fields, 'podcast', true );
		}
	}
}

