<?php
/**
*	===========================================
*	Version 1.0.1
*	Changed show extraction method
*	===========================================

get_template_part( 'template-parts/post/post-inline--show' );
*/

add_action( 'widgets_init', 'proradio_widgets_upcoming_widget' );
function proradio_widgets_upcoming_widget() {
	register_widget( 'proradio_widgets_Upcoming_widget' );
}

class proradio_widgets_Upcoming_widget extends WP_Widget {
	/**
	 * [__construct]
	 * =============================================
	 */
	public function __construct() {
		$widget_ops = array( 'classname' => 'proradio_widgets', 'description' => esc_attr__('Display a list of upcoming shows, filterable by schedulefilter', "proradio-widgets") );
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'proradio_widgets-widget' );
		parent::__construct( 'proradio_widgets-widget', esc_attr__('ProRadio Upcoming shows', "proradio-widgets"), $widget_ops, $control_ops );
	}
	/**
	 * [widget]
	 * =============================================
	 */
	public function widget( $args, $instance ) {
		extract( $args );
		extract( $instance );

		echo $before_widget;
		if($title){
			echo $before_title.apply_filters("widget_title", $title, "proradio_widget-widget").$after_title; 
		}
		?>
		<div class="qt-widget-chart">
			<?php  
			/**
			 * Data extraction
			 * @var $schedulefilter = text flag of the parameter taxonomy
			 * @var $today = return only current day
			 */
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
				
				// Security limit
				if( $quantity > 12 ){
					$quantity = 12;
				}
				
				$container_classes = array('proradio-owl-carousel-container');
				$counter = 0;
				/*
				@since 1.0.1
				[$fix_current_day_show] if is the first day of the loop this means we will ignore time from day 2 and extract from 00:00				
				*/

				$counter = 0;
				$avoid_duplicated_show = 0;
				$skip_first = false;
				if(!$showcurrent){
					$quantity = $quantity + 1;
					$skip_first = true;
				}

				foreach( $schedules as $schedule ){
					global $post;
					if( $counter < $quantity ){
						$shows = $schedule->shows;
						$post_title = $schedule->post_title;
						foreach( $shows as $show ){
							if( $counter < $quantity ){
								$print = false;
								remove_query_arg('event');
								set_query_var( 'event', false);
								$show['day'] = $post_title;
								$show_time = $show['show_time'];
								$show_time_end = $show['show_time_end'];
								$show_id = $show['show_id'][0];
								if($show_time_end == "00:00"){
									$show_time_end = "24:00";
								}
								// current day: use time comparison
								if( $schedule->ID == $current_day_id  ){
									// cross midnight shows fix
									// @since 1.5.3
									$show_time_end_comparison = $show_time_end;
									if( $show_time_end < $show_time && $now > $show_time){
										$show_time_end_comparison   = "24:00";
									}
									if( $now < $show_time_end_comparison ){
										$print = true;
									}
								} else {
									$print = true;
								}
								$current_show_hash = $show_id.$show_time.$show_time_end;
								if(true == $print && $avoid_duplicated_show != $current_show_hash){
									$post = get_post($show_id); 
									if( is_object($post) ):
										set_query_var( 'event', $show );
										setup_postdata($post);
										$avoid_duplicated_show = $current_show_hash;
										if( $skip_first == true ){
											$skip_first = false;
										} else {
											get_template_part( 'template-parts/post/post-inline--show' );
										}
										$counter = $counter + 1;
									endif;
								}
							}
						}
						set_query_var( 'event', false);
						
					}
				}
				$counter = 0;
			}
			wp_reset_postdata();
			?>
		</div>
		<?php
		echo $after_widget;
	}

	/**
	 * [update save the parameters]
	 * =============================================
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$attarray = array(
			'title',
			'schedulefilter',
			'quantity',
			'showcurrent'
		);
		foreach ($attarray as $a){
			$instance[$a] = strip_tags( $new_instance[$a] );
		}
		return $instance;
	}

	/**
	 * [form widget parameters form]
	 * =============================================
	 */
	public function form( $instance ) {
		$defaults = array( 
			'title' => esc_attr__('Upcoming shows', "proradio-widgets"),
			'schedulefilter' => '',
			'quantity' => 5,
			'showcurrent' => false
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		<h2><?php echo esc_attr__("Options", "proradio-widgets"); ?></h2>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php echo esc_attr__('Title', "proradio-widgets"); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'quantity' ); ?>"><?php echo esc_attr__('Quanity', "proradio-widgets"); ?></label>
			<input type="number" id="<?php echo $this->get_field_id( 'quantity' ); ?>" name="<?php echo $this->get_field_name( 'quantity' ); ?>" value="<?php echo $instance['quantity']; ?>" style="width:100%;" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'schedulefilter' ); ?>"><?php echo esc_attr__('Schedule filter (slug)', "proradio-widgets"); ?></label>
			<input id="<?php echo $this->get_field_id( 'schedulefilter' ); ?>" name="<?php echo $this->get_field_name( 'schedulefilter' ); ?>" value="<?php echo $instance['schedulefilter']; ?>" style="width:100%;" />
		</p>
		<p>
			<input type="checkbox" id="<?php echo $this->get_field_id( 'showcurrent' ); ?>" name="<?php echo $this->get_field_name( 'showcurrent' ); ?>"   <?php if( $instance['showcurrent'] ){ echo 'checked="checked"'; } ?>  />
			<label for="<?php echo $this->get_field_id( 'showcurrent' ); ?>"><?php echo esc_attr__('Include current show:', "proradio-widgets"); ?></label>
		</p>
	<?php
	}
}
