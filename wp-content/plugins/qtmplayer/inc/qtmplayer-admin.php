<?php
/**
 * @package  WordPress
 * @subpackage qtmplayer
 */

/**
 * Create options page
 */
add_action('admin_menu', 'qtmplayer_create_optionspage');
if(!function_exists('qtmplayer_create_optionspage')){
	function qtmplayer_create_optionspage() {
		add_options_page('Pro.Radio Music Player', 'Pro.Radio Music Player', 'manage_options', 'qtmplayer_settings', 'qtmplayer_options');
	}
}

/**
 *  Main options page content
 */
if(!function_exists('qtmplayer_options')){
	function qtmplayer_options() {
		?>
		<h2>Pro.Radio Music Player Settings</h2>
		<?php  
		/**
		 *  We check if the use is qualified enough
		 */
		if (!current_user_can('manage_options'))  {
			wp_die( __('You do not have sufficient permissions to access this page.') );
		}

		/**
		 *  Saving options
		 */


		$chackboxes = array(
			"qtmplayer_min" => esc_html__("Load minified javascript to improve performance (disable in case of issues)", "qtmplayer" ),
		
		);

		$textfields = array(
			// "qtmplayer_color" => __("Main Color", "qtmplayer" ),
		);


		if ( ! empty( $_POST ) ) {
			if(!check_admin_referer( 'qtmplayer_save', 'qtmplayer_nonce' )){
				echo 'Invalid request';
			} else {

				foreach($textfields as $varname => $label){
					if(isset($_POST[$varname])){
						update_option($varname, wp_kses($_POST[$varname], array() ));
					}
				}

				foreach($chackboxes as $varname => $label){
					if(isset($_POST[$varname])){
						if($_POST[$varname] == 'on'){
							update_option($varname, 1);
						} 
					} else {
						update_option($varname, 0 );
					}
				}
			}
		}

		/**
		 *  Options page content
		 */
		?>
		<div class="qtmplayer-framework qtmplayer-optionspage">
			<p class="right blue-grey-text lighten-3">V. <?php echo esc_attr(qtmplayer_get_version()); ?></p>
			<h2 class="qtmplayer-modaltitle"><?php echo esc_attr__("Settings", "qtmplayer"); ?></h2>
			<div class="row">
				<form method="post" class="col s12" action="<?php echo esc_url($_SERVER["REQUEST_URI"]); ?>">
					<?php
					foreach($chackboxes as $varname => $label){
					?>
						<p class="row">
							<input id="<?php echo esc_attr($varname); ?>" name="<?php echo esc_attr($varname); ?>"  type="checkbox" <?php if (get_option( $varname)){ ?> checked <?php } ?>>
							<label for="<?php echo esc_attr($varname); ?>"><?php echo esc_attr($label); ?></label>
						</p>
					<?php } ?>
					<?php
					foreach($textfields as $varname => $label){
					?>
						<p class="row">
							<label for="<?php echo esc_attr($varname); ?>"><?php echo esc_attr($label); ?></label>
							<input id="<?php echo esc_attr($varname); ?>" name="<?php echo esc_attr($varname); ?>"  type="text" value="<?php echo esc_attr(get_option( $varname )); ?>">
						</p>
					<?php } ?>
					<?php wp_nonce_field( "qtmplayer_save", "qtmplayer_nonce", true, true ); ?>
					<input type="submit" name="submit" value="Save"  class="button button-primary" />
				</form>
			</div>
			
		</div>
		<?php 
	}
}