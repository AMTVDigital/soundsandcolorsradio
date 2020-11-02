<?php  
/**
 * Plugin Name: Pro.Radio Ajax
 * Plugin URI: http://pro.radio
 * Author: Pro.Radio
 * Author URI: http://pro.radio
 * Description: Adds page load with ajax to keep music playing across pages
 * Version: PR.3.4.7
*/


/**
 * 	constants
 * 	=============================================
 */
if(!defined('PRORADIO_APL_PLUGIN_ACTIVE')) {
	define('PRORADIO_APL_PLUGIN_ACTIVE', true);
}
if(!defined('PRORADIO_AJAX_BASE_DIR')) {
	define('PRORADIO_AJAX_BASE_DIR', dirname(__FILE__));
}
if(!defined('PRORADIO_AJAX_BASE_URL')) {
	define('PRORADIO_AJAX_BASE_URL', plugin_dir_url(__FILE__));
}

/**
* Returns current plugin version.
* @return string Plugin version. Needs to stay here because of plugin file path
*/
if(!function_exists('proradio_ajax_get_version')){
	function proradio_ajax_get_version() {
		if ( is_admin() ) {
			$plugin_data = get_plugin_data( __FILE__ );
			$plugin_version = $plugin_data['Version'];
		} else {
			$plugin_version = get_file_data( __FILE__ , array('Version'), 'plugin');
		}
		return $plugin_version;
	}
}




/**
 * @since  2.4
 * Output custom javascript
 */
if(!function_exists('proradio_ajax_customscript_output')){
	function proradio_ajax_customscript_output(){
		if(isset($_GET)){
			if(array_key_exists('qt-ajax-pageload-custom', $_GET)){
				if( $_GET['qt-ajax-pageload-custom'] == 'output' ){
					header('Content-Type: application/javascript');
					echo stripslashes( get_option( 'proradio_ajax_customcode' ) );
					die();
				}
			}
		}
	}
	proradio_ajax_customscript_output();
}

/**
 * @since  2.4
 * Output a DIV with the script URL that will be used by the ajax script to load the custom file
 */
if(!function_exists('proradio_ajax_customscript_url')){
	add_action("wp_footer", "proradio_ajax_customscript_url");
	function proradio_ajax_customscript_url(){
		$custom_script_url = home_url( add_query_arg( 'qt-ajax-pageload-custom', 'output'  ));
		?>
		<div id="qt-ajax-customscript-url" class="qt-hidden" data-customscripturl="<?php echo $custom_script_url; ?>"></div>
		<?php  
	}
}



/**
 * 	includes
 * 	=============================================
 */
// Admin
require plugin_dir_path( __FILE__ ) . '/_proradio-ajax-admin.php';

/**
 * 	Enqueue scripts
 * 	=============================================
 */
if(!function_exists('proradio_ajax_enqueue_stuff')){
	add_action( 'wp_enqueue_scripts', 'proradio_ajax_enqueue_stuff' );
	function proradio_ajax_enqueue_stuff(){
		if(is_user_logged_in()){
			if(current_user_can('edit_pages' )){
				wp_enqueue_style('proradio-frontend-admin', PRORADIO_AJAX_BASE_URL.'assets/css/proradio-frontend-admin.css' );
				return;
			}
		}
		wp_enqueue_style('proradio_ajax_style', PRORADIO_AJAX_BASE_URL.'assets/css/proradio-apl-style.css' );
		wp_enqueue_script('proradio_ajax_script', PRORADIO_AJAX_BASE_URL.'assets/js/proradio-ajax-pageload-min.js', array('jquery', 'imagesloaded', 'proradio-main'), '2.4', true );
	}
}


/**
 * 	Admin notification
 * 	=============================================
 */
if(!function_exists('proradio_ajax_admin_notify')){
	add_action( 'wp_footer', 'proradio_ajax_admin_notify' );
	function proradio_ajax_admin_notify(){
		if(is_user_logged_in()){
			if(current_user_can('edit_pages' ) && !get_option( 'proradio_admin_notice' )){
				?>
				<div class="proradio-admin-notice"><h3><?php esc_html_e('AJAX DISABLED', 'qtapl') ?></h3><?php esc_html_e('When logged as admin, the music stops when changing page, to allow the editing functions.', 'qtapl') ?></div>
				<?php
			}
		}
	}
}

/**
 * 	Admin notification
 * 	=============================================
 */
if(!function_exists('proradio_ajax_preloader_html')){
	add_action( 'wp_footer', 'proradio_ajax_preloader_html' );
	function proradio_ajax_preloader_html(){
		if(is_user_logged_in()){
			if(current_user_can('edit_pages' )){
				return;
			}
		}
		$classes = ['proradio-ajax-preloader'];
		

		$preloader = get_option( 'proradio_ajax_preloader' );
		if( $preloader ){
			$classes[] = 'proradio-ajax-visible';
			$classes[] = 'proradio-preloader-enabled';
		}

		$changeloader = get_option( 'proradio_ajax_changeloader' );
		if( $changeloader ){
			$classes[] = 'proradio-changeloader';
		}

		$version = get_option( 'proradio_ajax_version' );
		if( $version ){
			$classes[] = 'proradio-ajax-preloader--'.$version;
		}


		

		$classes = implode(' ', $classes);


		?>
		<div id="proradio-ajax-mask" class="<?php echo esc_attr( $classes ); ?>" style="<?php  ?>"><span id="proradio-ajax-num" class="proradio-ajax-preloader__num">0%</span>
			<div id="proradio-ajax-progress" class="proradio-ajax-preloader__progress"></div>
			<div class="proradio-ajax-preloader__progress proradio-ajax-preloader__progress--hold"></div>
			<div class="proradio-ajax-preloader__icon">
				<div class="spinner"></div>
			</div>
		</div>
		<style>
			<?php  
			$bgcolor = get_option( 'proradio_ajax_bgcolor' );
			if( $bgcolor ){
				echo "#proradio-ajax-mask.proradio-ajax-preloader--v1{background-color:".esc_attr($bgcolor)."; }";
				echo ".proradio-ajax-preloader--v2::after, .proradio-ajax-preloader--v2::before{background-color:".esc_attr($bgcolor)."; }";

			}

			$tcolor = get_option( 'proradio_ajax_tcolor' );
			if( $tcolor ){
				echo "#proradio-ajax-mask .spinner{ border-color:".esc_attr($tcolor)."; border-bottom-color: transparent;  }";
				echo "#proradio-ajax-num {color:".esc_attr($tcolor).";}";

				echo "#proradio-ajax-progress{background-color:".esc_attr($tcolor).";}";

			}

		?>
		</style>
		<?php



		




	}
}


/**
 * 	Skip ajax pageload custom field
 * 	=============================================
 */

if(!function_exists("proradio_ajax_add_special_fields")){
	add_action('init', 'proradio_ajax_add_special_fields',0,999);  
	function proradio_ajax_add_special_fields() {
	    $proradio_ajax_settings = array (
	    	array (
				'label' => esc_attr__('Disable ajax loading',"qt-ajax-pageload"),
				'desc' 	=> esc_attr__('Load this page without ajax (music stops, provide better plugins compatibility)',"qt-ajax-pageload"),
				'id' 	=> 'proradio_ajax_skip',
				'type' 	=> 'checkbox'
			)        
	    );
	    if(post_type_exists('page')){
	        if(function_exists('custom_meta_box_field')){
	            $main_box = new Custom_Add_Meta_Box('proradio_ajax_settings', 'Ajax loading settings', $proradio_ajax_settings, 'page', true );
	        }
	    }
	}
}



/* Add user agent to body for css classes fix
=============================================*/
if ( ! function_exists( 'proradio_ajax_class_names' ) ) {
	add_filter( 'body_class','proradio_ajax_class_names' );
	function proradio_ajax_class_names( $classes ) {
		if( is_singular() || is_page() ) {
			if( get_post_meta( get_the_ID(), 'proradio_ajax_skip', true ) ){
				$classes[] = "proradio-ajax-skip";
			}
		} 
		return $classes;
	}
}

/* Pass WooCommerce endpoint URLs to javascript
=============================================*/
require plugin_dir_path( __FILE__ ) . '/_woocommerce-support.php';

/* Elementor support
=============================================*/
require plugin_dir_path( __FILE__ ) . '/elementor/proradio-ajax-elementor.php';

