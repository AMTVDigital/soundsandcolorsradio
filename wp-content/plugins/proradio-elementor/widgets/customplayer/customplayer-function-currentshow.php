<?php  

if(function_exists('proradio_extract_schedule_days')){
	$schedulefilter = ( isset( $schedulefilter ) )? str_replace('schedulefilter:', '', $schedulefilter) : false;
	$return_only_today = true;
	$data_extraction 	= proradio_extract_schedule_days( $schedulefilter, $return_only_today ); // $schedulefilter, $today []
	if(!$data_extraction){ 
		return esc_html__( 'Sorry, there is no show schedules at this moment.', 'proradio' );
	}
	if( 0 == count(  $data_extraction[ 'posts' ] )){
		return esc_html__( 'Sorry, there is no show schedules at this moment.', 'proradio' );
	}
	$schedules 		= $data_extraction[ 'posts' ];
	$current_day_id = $data_extraction[ 'current_day_id' ];
	// Today's shows
	$shows 			= $schedules[0]->shows;
	if( !is_array($shows) ){
		return esc_html__( 'Sorry, there is no show schedules at this moment.', 'proradio' );
	}
	if( 0 == count($shows) ){
		return esc_html__( 'Sorry, there is no show schedules at this moment.', 'proradio' );
	}
	
	$now = current_time("H:i");
	$found = false;
	$time_format = get_theme_mod('QT_timing_settings', '12');
	
	$quantity =1;
	ob_start();
	$container_classes = array('proradio-owl-carousel-container');
	$counter = 0;

		foreach( $schedules as $schedule ){
			$shows = $schedule->shows;
			$post_title = $schedule->post_title;
			if( $counter < $quantity ){
				foreach( $shows as $show ){
					remove_query_arg('event');
					$show['day'] = $post_title;
					$show_id = $show['show_id'][0];
					$show_time =$show['show_time'];
					$show_time_end =$show['show_time_end'];
				

					if($show_time_d === "24:00"){
						$show_time_d === "00:00";
					}
					if($show_time_end_d === "24:00"){
						$show_time_end_d === "00:00";
					}
					// 12 hours format
					if(get_theme_mod('QT_timing_settings', '12') == '12'){
						$show_time_d = date("g:i a", strtotime($show_time_d));
						$show_time_end_d = date("g:i a", strtotime($show_time_end_d));
					}
					

					/**
					 * Show or hide current show in the upcoming list
					 * @since 1.3.4
					 */
			
					if( $now < $show_time_end && $counter < $quantity ){
						global $post;
						$post = get_post($show_id); 
						if(is_object($post)):
							$counter = $counter+1;
							setup_postdata($post);
							
							?>
							<div class="proradio-customplayer__show" <?php if($pr_currentshow__refresh){ ?>data-proradio-autorefresh <?php } ?>>
								<?php

								// cover
								if($pr_currentshow__art && has_post_thumbnail()){ 
									?>
									<a href="<?php the_permalink(); ?>" class="proradio-customplayer__showart">
										<?php the_post_thumbnail( $pr_currentshow__art_size ); ?>
									</a>
									<?php
								} 

								?>
								

								<?php  
								if($$pr_currentshow__title || $pr_currentshow__subtitle || $pr_currentshow__time  ){
									?>
									<div class="proradio-customplayer__showcontents">
									<?php

										// title
										if($pr_currentshow__title){
											?>
											<h4 class="proradio-customplayer__showtitle proradio-cutme-t">
												<?php  the_title(); ?>
											</h4>
											<?php
										}

										// subtitle
										if($pr_currentshow__subtitle){
											$sub =  get_post_meta( $post->ID, 'subtitle2',true );

											if($sub){
												?>
												<h5 class="proradio-customplayer__subtitle proradio-cutme-t">
													<?php echo esc_html($sub); ?>
												</h5>
												<?php 
											}
										}


										// Show time
										if( $pr_currentshow__time ){ 
											$string = '';
											if( $show_time_d ){
												$string .= $show_time_d;
												if( $show_time_end_d ){
													$string .= ' - ';
												}
											}
											if( $show_time_end_d ){
												$string .= $show_time_end_d;
											}
											?>
											<h6 class="proradio-customplayer__time proradio-itemmetas">
												<i class='material-icons'>access_time</i><?php echo esc_html( $string ); ?>
											</h6>
										<?php 
										}
									 ?>
									</div>
									<?php  
								}
								?>
							</div>
							<?php
						endif;
					}
					remove_query_arg('event');
					set_query_var( 'event', false);
				}
			}
		}
	echo ob_get_clean();
}
wp_reset_postdata();
?>