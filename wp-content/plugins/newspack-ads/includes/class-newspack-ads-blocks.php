<?php
/**
 * Newspack Ads Block Management
 *
 * @package Newspack
 */

/**
 * Newspack Ads Blocks Management
 */
class Newspack_Ads_Blocks {

	/**
	 * Initialize blocks
	 *
	 * @return void
	 */
	public static function init() {
		require_once NEWSPACK_ADS_ABSPATH . 'src/blocks/ad-unit/view.php';
		add_action( 'enqueue_block_editor_assets', array( __CLASS__, 'enqueue_block_editor_assets' ) );
		add_action( 'wp_head', array( __CLASS__, 'insert_google_ad_manager_header_code' ), 30 );
		add_action( 'wp_footer', array( __CLASS__, 'insert_google_ad_manager_footer_code' ), 30 );
	}

	/**
	 * Enqueue block scripts and styles for editor.
	 */
	public static function enqueue_block_editor_assets() {
		$editor_script = Newspack_Ads::plugin_url( 'dist/editor.js' );
		$editor_style  = Newspack_Ads::plugin_url( 'dist/editor.css' );
		$dependencies  = self::dependencies_from_path( NEWSPACK_ADS_ABSPATH . 'dist/editor.deps.json' );
		wp_enqueue_script(
			'newspack-ads-editor',
			$editor_script,
			$dependencies,
			NEWSPACK_ADS_VERSION,
			true
		);
		wp_enqueue_style(
			'newspack-ads-editor',
			$editor_style,
			array(),
			NEWSPACK_ADS_VERSION
		);
	}

	/**
	 * Parse generated .deps.json file and return array of dependencies to be enqueued.
	 *
	 * @param string $path Path to the generated dependencies file.
	 *
	 * @return array Array of dependencides.
	 */
	public static function dependencies_from_path( $path ) {
		// TODO: use this better approach: https://github.com/Automattic/newspack-blocks/blob/master/class-newspack-blocks.php#L27-L44.
		$dependencies = file_exists( $path )
			// phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents, WordPressVIPMinimum.Performance.FetchingRemoteData.FileGetContentsUnknown
			? json_decode( file_get_contents( $path ) )
			: array();
		$dependencies[] = 'wp-polyfill';
		return $dependencies;
	}

	/**
	 * Utility to assemble the class for a server-side rendered bloc
	 *
	 * @param string $type The block type.
	 * @param array  $attributes Block attributes.
	 *
	 * @return string Class list separated by spaces.
	 */
	public static function block_classes( $type, $attributes = array() ) {
		$align   = isset( $attributes['align'] ) ? $attributes['align'] : 'none';
		$classes = array(
			"wp-block-newspack-blocks-{$type}",
			"align{$align}",
		);
		if ( isset( $attributes['className'] ) ) {
			array_push( $classes, $attributes['className'] );
		}
		return implode( $classes, ' ' );
	}

	/**
	 * Enqueue view scripts and styles for a single block.
	 *
	 * @param string $type The block's type.
	 */
	public static function enqueue_view_assets( $type ) {
		$style_path  = Newspack_Ads::plugin_url( 'dist/{$type}/view' . ( is_rtl() ? '.rtl' : '' ) . '.css' );
		$script_path = Newspack_Ads::plugin_url( 'dist/{$type}/view.js' );
		if ( file_exists( NEWSPACK_ADS_ABSPATH . $style_path ) ) {
			wp_enqueue_style(
				"newspack-blocks-{$type}",
				plugins_url( $style_path, __FILE__ ),
				array(),
				NEWSPACK_ADS_VERSION
			);
		}
		if ( file_exists( NEWSPACK_ADS_ABSPATH . $script_path ) ) {
			$dependencies = self::dependencies_from_path( Newspack_Ads::plugin_url( 'dist/{$type}/view.deps.json' ) );
			wp_enqueue_script(
				"newspack-blocks-{$type}",
				plugins_url( $script_path, __FILE__ ),
				$dependencies,
				array(),
				NEWSPACK_ADS_VERSION
			);
		}

		wp_register_style( "newspack-blocks-{$type}", false ); // phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion
		wp_add_inline_style( "newspack-blocks-{$type}", '.wp-block-newspack-blocks-wp-block-newspack-ads-blocks-ad-unit.aligncenter > div { margin-left: auto; margin-right: auto; }' );
		wp_enqueue_style( "newspack-blocks-{$type}" );
	}

	/**
	 * Google Ad Manager header code
	 */
	public static function insert_google_ad_manager_header_code() {
		if ( ! newspack_ads_should_show_ads() ) {
			return;
		}

		$is_amp = function_exists( 'is_amp_endpoint' ) && is_amp_endpoint();
		if ( $is_amp ) {
			return;
		}
		ob_start();
		?>
		<script async src="https://securepubads.g.doubleclick.net/tag/js/gpt.js"></script>
		<script>
			window.googletag = window.googletag || {cmd: []};
		</script>
		<?php
		$code = ob_get_clean();
		echo $code; //phpcs:ignore
	}

	/**
	 * Google Ad Manager footer code
	 */
	public static function insert_google_ad_manager_footer_code() {
		if ( ! newspack_ads_should_show_ads() ) {
			return;
		}

		$is_amp = function_exists( 'is_amp_endpoint' ) && is_amp_endpoint();
		if ( $is_amp ) {
			return;
		}

		$network_code = Newspack_Ads_Model::get_network_code( 'google_ad_manager' );

		$prepared_unit_data = [];
		foreach ( Newspack_Ads_Model::$ad_ids as $unique_id => $ad_unit ) {
			$ad_targeting = apply_filters( 'newspack_ads_ad_targeting', [], $ad_unit );

			if ( $ad_unit['responsive'] ) {
				foreach ( $ad_unit['sizes'] as $size ) {
					$container_id = esc_attr( 'div-gpt-' . $ad_unit['code'] . '-' . $unique_id . '-' . absint( $size[0] ) . 'x' . absint( $size[1] ) );

					$prepared_unit_data[ $container_id ] = [
						'name'      => esc_attr( $ad_unit['name'] ),
						'code'      => esc_attr( $ad_unit['code'] ),
						'sizes'     => [ $size ],
						'targeting' => $ad_targeting,
					];
				}
			} else {
				$container_id = esc_attr( 'div-gpt-ad-' . $unique_id . '-0' );

				$prepared_unit_data[ $container_id ] = [
					'name'      => esc_attr( $ad_unit['name'] ),
					'code'      => esc_attr( $ad_unit['code'] ),
					'sizes'     => $ad_unit['sizes'],
					'targeting' => $ad_targeting,
				];
			}
		}

		$ad_config = [
			'network_code'         => esc_attr( $network_code ),
			'disable_initial_load' => (bool) apply_filters( 'newspack_ads_disable_gtag_initial_load', false ),
		];

		ob_start();
		?>
		<script>
			googletag.cmd.push(function() {
				var ad_config        = <?php echo wp_json_encode( $ad_config ); ?>;
				var all_ad_units     = <?php echo wp_json_encode( $prepared_unit_data ); ?>;
				var defined_ad_units = {};

				for ( var container_id in all_ad_units ) {
					var ad_unit = all_ad_units[ container_id ];

					// Only set up ad units that are present on the page.
					if ( ! document.querySelector( '#' + container_id ) ) {
						continue;
					}

					defined_ad_units[ container_id ] = googletag.defineSlot(
						'/' + ad_config['network_code'] + '/' + ad_unit['code'],
						ad_unit['sizes'],
						container_id
					).addService( googletag.pubads() );

					for ( var target_key in ad_unit['targeting'] ) {
						defined_ad_units[ container_id ].setTargeting( target_key, ad_unit['targeting'][ target_key ] );
					}
				}

				if ( ad_config['disable_initial_load'] ) {
					googletag.pubads().disableInitialLoad();
				}
				googletag.pubads().enableSingleRequest();
				googletag.pubads().enableLazyLoad( {
					fetchMarginPercent: 500,   // Fetch slots within 5 viewports.
					renderMarginPercent: 200,  // Render slots within 2 viewports.
					mobileScaling: 2.0         // Double the above values on mobile.
				} );
				googletag.enableServices();

				for ( var container_id in defined_ad_units ) {
					googletag.display( container_id );
				}
			} );
		</script>
		<?php
		$code = ob_get_clean();
		echo $code; // phpcs:ignore
	}
}
Newspack_Ads_Blocks::init();
