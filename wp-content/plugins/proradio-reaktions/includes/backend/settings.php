<?php
/**
 * @package proradio-reaktions
 * @author Pro.Radio
 * Creates admin settings page
 */




/**
 * Create options page
 */
add_action('admin_menu', 'proradio_reaktions_create_optionspage');
if(!function_exists('proradio_reaktions_create_optionspage')){
	function proradio_reaktions_create_optionspage() {
		add_options_page('ReAktions', 'ReAktions', 'manage_options', 'proradio_reaktions_settings', 'proradio_reaktions_options');
	}
}

/**
 *  Main options page content
 */
if(!function_exists('proradio_reaktions_options')){
	function proradio_reaktions_options() {
		?>
		<h2>Themes2Go ReAktions Settings</h2>
		<?php  
		/**
		 *  We check if the use is qualified enough
		 */
		if (!current_user_can('manage_options'))  {
			wp_die( esc_html__('You do not have sufficient permissions to access this page.') );
		}

		/**
		 *  Saving options
		 */
		
		$chackboxes = array(
			"proradio_reaktions_open_graph_headers" => esc_html__("Enable Open Graph header metas", "proradio-reaktions" ),
			"proradio_reaktions_facebook" => esc_html__("Enable Facebook share", "proradio-reaktions" ),
			"proradio_reaktions_twitter" => esc_html__("Enable Twitter share", "proradio-reaktions" ),
			"proradio_reaktions_pinterest" => esc_html__("Enable Pinterest share", "proradio-reaktions" ),
			"proradio_reaktions_tumblr" => esc_html__("Enable Tumblr share", "proradio-reaktions" ),
			"proradio_reaktions_whatsapp" => esc_html__("Enable WhatsApp share", "proradio-reaktions" ),
			"proradio_reaktions_email" => esc_html__("Enable Email share", "proradio-reaktions" ),
			"proradio_reaktions_linkedin" => esc_html__("Enable Linkedin share", "proradio-reaktions" ),
			"proradio_reaktions_love" => esc_html__("Enable love action", "proradio-reaktions" ),
			"proradio_reaktions_ratings" => esc_html__("Enable stars rating", "proradio-reaktions" ),
			"proradio_reaktions_views" => esc_html__("Enable views count", "proradio-reaktions" ),
			"proradio_reaktions_readingtime" => esc_html__("Enable reading time", "proradio-reaktions" ),
			"proradio_reaktions_commentscount" => esc_html__("Enable comments count", "proradio-reaktions" ),
			"proradio_reaktions_shareball" => esc_html__("Share Ball in single posts", "proradio-reaktions" )
		);

		$textfields = array(
			"proradio_reaktions_timeout_revote" => esc_html__("Time before adding new love (minutes)", "proradio-reaktions" ),
		);


		if ( ! empty( $_POST ) ) {
			if(!check_admin_referer( 'proradio_reaktions_save', 'proradio_reaktions_nonce' )){
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
		<div class="proradio_reaktions-framework proradio_reaktions-optionspage">
			<p class="right blue-grey-text lighten-3">V. <?php echo esc_attr(proradio_reaktions_plugin_get_version()); ?></p>
			<h2 class="proradio_reaktions-modaltitle"><?php echo esc_attr__("Settings", "proradio-reaktions"); ?></h2>
			<div class="row">
				<form method="post" class="col s12" action="<?php echo esc_url($_SERVER["REQUEST_URI"]); ?>">
					<?php
					foreach($chackboxes as $varname => $label){
					?>
						<p class="row">
							<input id="<?php echo esc_attr($varname); ?>" name="<?php echo esc_attr($varname); ?>"  type="checkbox" <?php if (get_option( $varname, 1)){ ?> checked <?php } ?>>
							<label for="<?php echo esc_attr($varname); ?>"><?php echo esc_attr($label); ?></label>
						</p>
					<?php } ?>
					<?php
					foreach($textfields as $varname => $label){
					?>
						<p class="row">
							<label for="<?php echo esc_attr($varname); ?>"><?php echo esc_attr($label); ?></label>
							<input id="<?php echo esc_attr($varname); ?>" name="<?php echo esc_attr($varname); ?>"  type="text" value="<?php echo esc_attr(get_option( $varname, 120)); ?>">
						</p>
					<?php } ?>
					<?php wp_nonce_field( "proradio_reaktions_save", "proradio_reaktions_nonce", true, true ); ?>
					<input type="submit" name="submit" value="Save"  class="button button-primary" />
				</form>
			</div>
			<div class="row">
			<h2>Shortcodes</h2>
			<pre>
 *	[proradio_reaktions_social Creates social sharing functions] -> returns HTML
 *	[proradio_reaktions-loveit-link --- proradio_reaktions_loveit_link Creates LOVE button] -> returns HTML
 *	[proradio_reaktions-loveit-count --- proradio_reaktions_loveit_count show number of loveit]
 *	[proradio_reaktions-rating --- 'proradio_reaktions_rating() Display the rating]
 *	[proradio_reaktions-views --- proradio_reaktions_viewsdisplay() Display number of views] -> returns HTML
 *	[proradio_reaktions-readingtime --- proradio_reaktions_readingtime() Display nestimated reading time in min-sec] -> returns HTML
 *	[proradio_reaktions-full --- proradio_reaktions_full() All the stuff]
 *
 * 	Helpers:
 *	[proradio_reaktions_viewsread Display number of views without] -> returns INTEGER
 *	[proradio_reaktions_loveit_count Display number of LOVE] -> returns INTEGER
			 </pre>
			 </div>
		</div>
		<?php 
	}
}