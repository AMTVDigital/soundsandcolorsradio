<?php
/**
 * @author QantumThemes
 * Creates admin settings page
 */

/**
 * Create options page
 */
add_action('admin_menu', 'proradio_servercheck_create_optionspage');
if(!function_exists('proradio_servercheck_create_optionspage')){
	function proradio_servercheck_create_optionspage() {
		add_options_page('ProRadio Server Check', 'ProRadio Server Check', 'manage_options', 'proradio_servercheck_settings', 'proradio_servercheck_options');
	}
}

/**
 *  Main options page content
 */

function proradio_servercheck_isCurl(){
    return function_exists('curl_version');
}






if(!function_exists('proradio_servercheck_options')){
	function proradio_servercheck_options() {
		?>
		<div class="proradio-servercheck">
			<h1>Test server requirements</h1>
			<p>Official WordPress requirements <a href="https://make.wordpress.org/hosting/handbook/handbook/server-environment/" target="_blank"> are available here.</a></p>
			<p>If your server doesn't meet the requirements, please request support to your hosting provider</p>

			<?php 
			/**
			 * The results will be cached every 60 seconds to prevent abuses
			 * @var [type]
			 */
			
			//delete_transient( 'proradio_servercheck_result' );

			$cached = get_transient( 'proradio_servercheck_result' );
			if($cached){
				echo '<h4>Cached results</h4>';
				echo wp_kses_post( $cached );
				return;
			} else {
				ob_start();

				$errors = 0;
				$has_curl = proradio_servercheck_isCurl();

				require plugin_dir_path( __FILE__ ) . '/modules/modules-test.php';
				require plugin_dir_path( __FILE__ ) . '/modules/settings-test.php';
				require plugin_dir_path( __FILE__ ) . '/modules/get-test.php';
				require plugin_dir_path( __FILE__ ) . '/modules/post-test.php';

				$page =  ob_get_clean();
				set_transient( 'proradio_servercheck_result', wp_kses_post($page), 20 ) ;
				echo wp_kses_post($page);
				
			} // not cached
			?>
		</div>
		<?php  
		return;
	}
}