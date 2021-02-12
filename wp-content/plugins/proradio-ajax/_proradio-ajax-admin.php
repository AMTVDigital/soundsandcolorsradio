<?php
/**
 * @author ProRadio
 * Creates admin settings page
 */

if(!function_exists('proradio_ajax_codemirror_enqueue_scripts')){
	if(isset($_GET)){
		if(isset($_GET['page'])){
			if($_GET['page'] === 'proradio-ajax-settings'){
				add_action('admin_enqueue_scripts', 'proradio_ajax_codemirror_enqueue_scripts');
			}
		}
	}
	
	function proradio_ajax_codemirror_enqueue_scripts($hook) {
	  	$cm_settings['codeEditor'] = wp_enqueue_code_editor(array('type' => 'text/css'));
		wp_enqueue_script('jquery','jquery-migrate','wp-theme-plugin-editor');
	  	wp_localize_script('jquery', 'cm_settings', $cm_settings);
	  	wp_enqueue_script('wp-theme-plugin-editor');
	  	wp_enqueue_style('wp-codemirror');
	    wp_enqueue_script('proradio-admin',  PRORADIO_AJAX_BASE_URL.'assets/js/proradio-admin.js', array('jquery', 'wp-codemirror'));
	}
}

/**
 * Create options page
 */

if(!function_exists('proradio_ajax_create_optionspage')){
	add_action('admin_menu', 'proradio_ajax_create_optionspage');
	function proradio_ajax_create_optionspage() {
		$settings_page = add_options_page('Ajax Page Load', 'Ajax Page Load', 'manage_options', 'proradio-ajax-settings', 'proradio_ajax_options');
		add_action( 'load-' . $settings_page, 'proradio_ajax_load_admin_js' );
	}
}

 // This function is only called when our plugin's page loads!
if(!function_exists('proradio_ajax_load_admin_js')){
	function proradio_ajax_load_admin_js(){
	    // Unfortunately we can't just enqueue our scripts here - it's too early. So register against the proper action hook to do it
	    add_action( 'admin_enqueue_scripts', 'proradio_ajax_codemirror_enqueue_scripts' );
	}
}

/**
 *  Main options page content
 */
if(!function_exists('proradio_ajax_options')){
	function proradio_ajax_options() {

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
			"proradio_ajax_preloader" => esc_html__("Enable preloader", "qt-ajax-pageload" ),
			"proradio_ajax_changeloader" => esc_html__("Enable page change preloader", "qt-ajax-pageload" ),
			"proradio_admin_notice" => esc_html__("Disable admin notification", "qt-ajax-pageload" ),
		);


		$dropdown = array(
			"proradio_ajax_version" => array(
				'label' => esc_html__("Template", "qt-ajax-pageload" ),
				'options' => array(
					'v1' => esc_html__('Spinner', 'qt-ajax-pageload'),
					'v2' => esc_html__('Loading bar', 'qt-ajax-pageload'),
					'v3' => esc_html__('Fast', 'qt-ajax-pageload'),
				),
			),
		);

		$colors = array(
			"proradio_ajax_bgcolor" => esc_html__("Background color", "qt-ajax-pageload" ),
			"proradio_ajax_tcolor" => esc_html__("Spinner and text color", "qt-ajax-pageload" )
		);


		$textfields = array(
			// "proradio_ajax_timeout_revote" => __("Time before adding new love (minutes)", "qt-ajax-pageload" ),
		);

		$textarea = array(
			"proradio_ajax_customcode" => __("Reload script", "qt-ajax-pageload" ),
		);


		if ( ! empty( $_POST ) ) {
			if(!check_admin_referer( 'proradio_ajax_save', 'proradio_ajax_nonce' )){
				echo 'Invalid request';
			} else {


				foreach($dropdown as $varname => $label){
					if(isset($_POST[$varname])){
						update_option($varname, wp_kses($_POST[$varname], array() ));
					}
				}


				foreach($textfields as $varname => $label){
					if(isset($_POST[$varname])){
						update_option($varname, wp_kses($_POST[$varname], array() ));
					}
				}
				foreach($colors as $varname => $label){
					if(isset($_POST[$varname])){
						update_option($varname, wp_kses($_POST[$varname], array() ));
					}
				}
				foreach($textarea as $varname => $label){
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
		<div class="qt_ajax_pageload-framework qt_ajax_pageload-optionspage">
			<h1>Ajax Page Load Settings</h1>
			<p class="right blue-grey-text lighten-3">V. <?php echo esc_attr(proradio_ajax_get_version()); ?></p>
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
							<label for="<?php echo esc_attr($varname); ?>"><?php echo esc_attr($label); ?></label><br>
							<input id="<?php echo esc_attr($varname); ?>" name="<?php echo esc_attr($varname); ?>"  type="text" value="<?php echo esc_attr(get_option( $varname, 120)); ?>">
						</p>

					<?php } ?>

					<?php
					foreach($colors as $varname => $label){
					?>
						<p class="row">
							<label for="<?php echo esc_attr($varname); ?>"><?php echo esc_attr($label); ?></label><br>
							<input id="<?php echo esc_attr($varname); ?>" name="<?php echo esc_attr($varname); ?>"  type="color" value="<?php echo esc_attr(get_option( $varname, 120)); ?>">
						</p>

					<?php } ?>



					<?php
					/**
					 * Dropdowns
					 * @var [type]
					 */
					foreach($dropdown as $varname => $vars){
						?>
						<p class="row">
							<label for="<?php echo esc_attr($varname); ?>"><?php echo esc_attr($vars['label']); ?></label><br>
							<select id="<?php echo esc_attr($varname); ?>" name="<?php echo esc_attr($varname); ?>">
								<?php  
								foreach( $vars['options'] as $option => $oplabel ){
									$selected = '';
									if( get_option( $varname ) == $option ){
										$selected = 'selected="selected"';
									}
									?>
									<option value="<?php echo esc_attr( $option ); ?>" <?php echo esc_attr( $selected ); ?>><?php echo esc_html__( $oplabel ); ?></option>
									<?php 
								}
								?>
							</select>
						</p>

					<?php } ?>


					<?php
					foreach($textarea as $varname => $label){
					?><hr>
						<p class="row"><label for="<?php echo esc_attr($varname); ?>"><?php echo esc_attr($label); ?></label></p>
						<p>Example: </p>
						<pre>console.log('reloaded');</pre>
						<textarea id="proradio-ajax-textarea" style="width: 70%;height:500px;" id="<?php echo esc_attr($varname); ?>" name="<?php echo esc_attr($varname); ?>"><?php echo stripslashes(get_option( $varname)); ?></textarea>
						

					<?php } ?>
					<?php wp_nonce_field( "proradio_ajax_save", "proradio_ajax_nonce", true, true ); ?>
					<p><input type="submit" name="submit" value="Save"  class="button button-primary" /></p>
				</form>
			</div>
			
		</div>
		<?php 
	}
}