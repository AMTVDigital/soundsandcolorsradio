<?php


/**
 * Adds a box to the main column on the Post and Page edit screens.
 */
function videolove_add_meta_box() {

	$screens = array( 'qtvideo' );

	foreach ( $screens as $screen ) {

		add_meta_box(
			'videolove_sectionid',
			__( 'Video URL', 'videolove' ),
			'videolove_meta_box_callback',
			$screen
		);
	}
}
add_action( 'add_meta_boxes', 'videolove_add_meta_box' );

/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function videolove_meta_box_callback( $post ) {

	// Add an nonce field so we can check for it later.
	wp_nonce_field( 'videolove_meta_box', 'videolove_meta_box_nonce' );

	/*
	 * Use get_post_meta() to retrieve an existing value
	 * from the database and use the value for the form.
	 */
	$value = get_post_meta( $post->ID, '_videolove_url_key', true );

	echo '<label for="videolove_url">';
	_e( 'Your video URL', 'videolove' );
	echo '</label> ';
	echo '<input type="text" id="videolove_url" name="videolove_url" value="' . esc_attr( $value ) . '" size="25" />';
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function videolove_save_meta_box_data( $post_id ) {

	/*
	 * We need to verify this came from our screen and with proper authorization,
	 * because the save_post action can be triggered at other times.
	 */

	// Check if our nonce is set.
	if ( ! isset( $_POST['videolove_meta_box_nonce'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['videolove_meta_box_nonce'], 'videolove_meta_box' ) ) {
		return;
	}

	// If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Check the user's permissions.
	if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return;
		}

	} else {

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
	}

	/* OK, it's safe for us to save the data now. */
	
	// Make sure that it is set.
	if ( ! isset( $_POST['videolove_url'] ) ) {
		return;
	}

	// Sanitize user input.
	$my_data = sanitize_text_field( $_POST['videolove_url'] );

	// Update the meta field in the database.
	update_post_meta( $post_id, '_videolove_url_key', $my_data );
}
add_action( 'save_post', 'videolove_save_meta_box_data' );
