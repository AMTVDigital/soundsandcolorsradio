<?php  


add_action( 'widgets_init', 'proradio_widget_events_f' );
function proradio_widget_events_f() {
	register_widget( 'proradio_widget_events' );
}
class proradio_widget_events extends WP_Widget {
	function __construct() {
		$widget_ops = array( 'classname' => 'proradio_eventslistwidget', 'description' => esc_attr__('List of events', "proradio-widgets") );
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'proradio_widget_events' );
		parent::__construct( 'proradio_widget_events', esc_attr__('ProRadio Events', "proradio-widgets"), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );
		extract( $instance );
		echo $before_widget;
		if(array_key_exists('title', $instance)) {
			if( $instance['title'] !== '' ){
				echo $before_title.apply_filters("widget_title", $instance['title']).$after_title; 
			}
		}
	

		$queryArray = array(
			'post_type' 		=> 'event',
			'post_status' 		=> 'publish',
			'posts_per_page' 	=>  array_key_exists('number',$instance)? $instance['number'] : 5 ,
			'suppress_filters' 	=> false,
			'paged' 			=> proradio_get_paged(),
			'orderby' 			=> 'meta_value',
			'order'   			=> 'ASC',
			'meta_key' 			=> 'proradio_date',
			'suppress_filters' 	=> false,
		);


		if(array_key_exists('specificid', $instance)) {
			if($instance['specificid'] != ''){
				$posts = explode(',',$instance['specificid']);
				$finalarr = array();
				foreach($posts as $p){
					if(is_numeric($p)){
						$finalarr[] = $p;
					}
				};
				$queryArray['post__in'] = $finalarr;
				$queryArray['post_type'] = 'any';
			}
		}
		

		/**
		 *  For events we reorder by date and eventually hide past events
		 */
		if($instance['hideold'] == '1'){
			$queryArray['meta_query'] = array(
				array(
					'key' 		=> 'proradio_date',
					'value' 	=> date('Y-m-d'),
					'compare' 	=> '>=',
					'type' 		=> 'date'
				 )
			);
		}
		 
		
		$reaktions = array("views", "loveit", "rating");
		foreach($reaktions as $r){
			${$r} = false;
			if(array_key_exists($r, $instance)){
				if($instance[$r] == "1"){ 
					${$r} = true;
				}
			}
		}

		$index = 1;
		$query = new WP_Query($queryArray);

			?>
				<div class="qt-archives-widget">

					<?php
					/**
					 * ============================================================
					 * List template loop
					 * Run the control before the loop to save cpu
					 * ============================================================
					 * 
					 */
					if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();
						$post = $query->post;
						setup_postdata( $post );
						?><div class="proradio-col__post"><?php  
						get_template_part('template-parts/post/post-event--card'); 
						?></div><?php 
						$index++;
					endwhile; endif; 
					?>
				</div>
			<?php 

		if(array_key_exists('archivelink_url', $instance)) {
			if($instance['archivelink_url'] != ''){
				if($instance['archivelink_text']==''){$instance['archivelink_text'] = esc_attr__('See all',"proradio-widgets");};
				echo '<a href="'.esc_url($instance['archivelink_url']).'" class="proradio-btn proradio-btn__s proradio-icon-r">'.esc_attr($instance['archivelink_text']).'<i class="material-icons">chevron_right</i></a>';
			}
		} 
	
		wp_reset_postdata();
		echo $after_widget;
	}

	//Update the widget 
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		//Strip tags from title and name to remove HTML 

		$attarray = array(
				'title',
				'number',
				'specificid',
				'order',
				'hideold',
				'archivelink_text',
				'posttype',
				'archivelink_url',
		);

		if(!is_numeric($new_instance['number'])){
			$new_instance['number'] = 5;
		}

		$new_instance['archivelink_url'] = esc_url($new_instance['archivelink_url']);

		foreach ($attarray as $a){
			$instance[$a] = esc_attr(strip_tags( $new_instance[$a] ));
		}
		return $instance;
	}

	function form ( $instance ) {
		//Set up some default widget settings.
		$defaults = array( 'title' => "",
							'number'=> '5',
							'specificid'=> '',
							'hideold' => false,
							'archivelink_text'=> esc_attr__('See all',"proradio-widgets"),
							'archivelink_url' => ''
							);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		<h2>General options</h2>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php echo esc_attr__('Title:', "proradio-widgets"); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'hideold' ); ?>"><?php echo esc_attr__('Hide past events', "proradio-widgets"); ?> <input type="checkbox" id="<?php echo $this->get_field_id( 'hideold' ); ?>" name="<?php echo $this->get_field_name( 'hideold' ); ?>"  value="1" <?php if($instance['hideold'] == '1'){ echo ' checked= "checked" '; } ?> /></label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'specificid' ); ?>"><?php echo esc_attr__('Add only specific ids (comma separated list)', "proradio-widgets"); ?></label>
			<input id="<?php echo $this->get_field_id( 'specificid' ); ?>" name="<?php echo $this->get_field_name( 'specificid' ); ?>" value="<?php echo $instance['hideold']; ?>" style="width:100%;" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php echo esc_attr__('Quantity:', "proradio-widgets"); ?></label>
			<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" value="<?php echo $instance['number']; ?>" style="width:100%;" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'archivelink_text' ); ?>"><?php echo esc_attr__('Link to archive text:', "proradio-widgets"); ?></label>
			<input id="<?php echo $this->get_field_id( 'archivelink_text' ); ?>" name="<?php echo $this->get_field_name( 'archivelink_text' ); ?>" value="<?php echo $instance['archivelink_text']; ?>" style="width:100%;" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'archivelink_url' ); ?>"><?php echo esc_attr__('Link to archive URL:', "proradio-widgets"); ?></label>
			<input id="<?php echo $this->get_field_id( 'archivelink_url' ); ?>" name="<?php echo $this->get_field_name( 'archivelink_url' ); ?>" value="<?php echo $instance['archivelink_url']; ?>" style="width:100%;" />
		</p>
	<?php
	}
}
?>