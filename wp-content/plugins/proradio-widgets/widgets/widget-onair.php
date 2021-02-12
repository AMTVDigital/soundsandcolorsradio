<?php


add_action( 'widgets_init', 'proradio_widgets_onair_widget' );
function proradio_widgets_onair_widget() {
	register_widget( 'proradio_widgets_onair_widget' );
}

class proradio_widgets_onair_widget extends WP_Widget {
	/**
	 * [__construct]
	 * =============================================
	 */
	public function __construct() {
		$widget_ops = array( 'classname' => 'proradio_widgets', 'description' => esc_attr__('Display the current show', "proradio-widgets") );
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'proradio_widgets-onair' );
		parent::__construct( 'proradio_widgets-onair', esc_attr__('ProRadio on-air', "proradio-widgets"), $widget_ops, $control_ops );
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
							if($show_time_end == "00:00"){
								$show_time_end = "24:00";
							}
							set_query_var( 'event', $show );

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
									set_query_var( 'is_widget', true );
									get_template_part( 'template-parts/post/post-proradio_shows' );
								endif;
							}
							remove_query_arg('event');
							set_query_var( 'event', false);
						}
					}
				}
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
			'schedulefilter'
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
			'title' => esc_attr__('Current show', "proradio-widgets"),
			'schedulefilter' => '',
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		<h2><?php echo esc_attr__("Options", "proradio-widgets"); ?></h2>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php echo esc_attr__('Title', "proradio-widgets"); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'schedulefilter' ); ?>"><?php echo esc_attr__('Schedule filter (slug)', "proradio-widgets"); ?></label>
			<input id="<?php echo $this->get_field_id( 'schedulefilter' ); ?>" name="<?php echo $this->get_field_name( 'schedulefilter' ); ?>" value="<?php echo $instance['schedulefilter']; ?>" style="width:100%;" />
		</p>
	<?php
	}
}
