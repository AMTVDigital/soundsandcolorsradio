<?php  
if (!function_exists('proradio_elementor_customplayer')){
function proradio_elementor_customplayer($atts){
	
	extract( shortcode_atts( array(
		'pr_display_radio_name'    => false,
		'pr_display_song_title'  => false,
		'pr_display_song_title_scroll' => false,
		'pr_display_song_artwork'  => false,
		'pr_artwork_alignment' => false,
		'schedulefilter'  => false,
		'pr_display_song'  => false,
		'pr_display_show' => false,
		'pr_image_display'  => false,
		'display_button' => '1',
		'playradio' => "1",
		'text' => 'Radio',
		'pr_logo' => false,
		'pr_btn_position' => '1',

		//  current show
		'pr_currentshow__enable' => false,
		'pr_currentshow__art' => false,
		'pr_currentshow__refresh' => false,
		'pr_currentshow__title' => false,
		'pr_currentshow__subtitle' => false,
		'pr_currentshow__time' => false,
		'pr_currentshow__art_size' => 'proradio-squared-s'
		
	), $atts ) );
	

	ob_start();

	?>
	<div class="proradio-customplayer">

		<div class="proradio-customplayer__cont">

			<?php  
			/**
			*	===========================================
			*	Button Position 1
			*	===========================================
			*/
			if($display_button && '1' == $pr_btn_position){
				?>
				<div class="proradio-customplayer__button">
					<?php  echo proradio_template_button($atts); ?>
				</div>
				<?php  
			}


			/**
			*	===========================================
			*	Logo
			*	===========================================
			*/
			if($pr_logo){
				$thumb = $pr_logo['url'];
				if($thumb){
					?>
					<div class="proradio-customplayer__logo">
						<img src="<?php echo esc_url($thumb); ?>"  alt="<?php esc_attr_e('logo','proradio-elementor'); ?>">
					</div>
					<?php
				}
			}


			/**
			*	===========================================
			*	Button Position 2
			*	===========================================
			*/
			if($display_button && '2' == $pr_btn_position){
				?>
				<div class="proradio-customplayer__button">
					<?php  echo proradio_template_button($atts); ?>
				</div>
				<?php  
			}

			/**
			*	===========================================
			*	Song info
			*	===========================================
			*/
			if($pr_display_song_artwork || $pr_display_song_title){ 
				?>
				<div class="proradio-customplayer__info">
					<?php
					if($pr_display_song_artwork){ 
						?>
						<a href="#" class="proradio-customplayer__art">
							<img src="#">
						</a>
						<?php
					} 
					if($pr_display_song_title){
						echo proradio_short_radiofeed(array(
							'title' => '',
							'tag' => 'p',
							'align' => $pr_artwork_alignment,
							'class' => 'proradio-customplayer__song',
							'marquee' => $pr_display_song_title_scroll
						));
					} 
					?>
				</div>
				<?php
			}


			/**
			*	===========================================
			*	Current show info
			*	===========================================
			*/
			if($pr_currentshow__enable){ 
				require( __DIR__ . '/customplayer-function-currentshow.php' );
			}


			/**
			*	===========================================
			*	Button Position 3
			*	===========================================
			*/
			if($display_button && '3' == $pr_btn_position){
				?>
				<div class="proradio-customplayer__button">
					<?php  echo proradio_template_button($atts); ?>
				</div>
				<?php  
			}
			
			?>
		</div>
	</div>
	<?php
	return ob_get_clean();
}}
?>