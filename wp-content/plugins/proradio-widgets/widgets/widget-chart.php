<?php


add_action( 'widgets_init', 'proradio_widgets_chart_widget' );
function proradio_widgets_chart_widget() {
	register_widget( 'proradio_widgets_chart_widget' );
}

class proradio_widgets_chart_widget extends WP_Widget {
	/**
	 * [__construct]
	 * =============================================
	 */
	public function __construct() {
		$widget_ops = array( 'classname' => 'proradio_widget', 'description' => esc_attr__('Display tracks from a music chart', "proradio-widgets") );
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'proradio_widget-widget' );
		parent::__construct( 'proradio_widget-widget', esc_attr__('ProRadio Charts', "proradio-widgets"), $widget_ops, $control_ops );
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
			<?php echo do_shortcode('[qt-chart number="'.$number.'" chartstyle="chart-small" chartcategory="'.$chartcategory.'" showtitle="'.$showtitle.'" showthumbnail="'.$showthumbnail.'"]' ); ?>
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
		//Strip tags from title and name to remove HTML 
		$attarray = array(
			'title',
			'chartid',
			'chartcategory',
			'number',
			'showtitle',
			'showthumbnail'
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
		$defaults = array (
				'title' => "Chart",
				'chartid' => false,
				'number' => 5,
				'chartcategory' => '',
				'showtitle' => 0,
				'showthumbnail' => 0
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
		?>
		<div class="proradio-widgets-admin">
		 	<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e('Title', "proradio-widgets"); ?></label>
				<input style="width:100%;" type="text" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'chartid' ) ); ?>"><?php esc_html_e('Chart ID', "proradio-widgets"); ?></label>
				<input style="width:100%;" type="text"  id="<?php echo esc_attr( $this->get_field_id( 'chartid' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'chartid' ) ); ?>" value="<?php echo esc_attr( $instance['chartid'] ); ?>"  />
				<small><?php esc_html_e("If no ID is specified, the latest chart will be used", "proradio-widgets") ?></small>
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'chartcategory' )); ?>"><?php esc_html_e('Category filter', "proradio-widgets"); ?></label>
				<input style="width:100%;" type="text"  id="<?php echo esc_attr( $this->get_field_id( 'chartcategory' )); ?>" name="<?php echo esc_attr( $this->get_field_name( 'chartcategory' )); ?>" value="<?php echo esc_attr( $instance['chartcategory']); ?>" />
				<small><?php esc_html_e("Specify a chart category SLUG. If the ID is empty, the widget will automatically extract the latest chart from this chart category.", "proradio-widgets") ?></small>
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'number' )); ?>"><?php esc_html_e('Track amount', "proradio-widgets"); ?></label>
				<input style="width:100%;" type="text" id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" value="<?php echo esc_attr( $instance['number']); ?>"/>
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'showtitle' )); ?>"><?php esc_html_e('Display the chart title', "proradio-widgets"); ?></label><br />			
				<?php esc_html_e("Display","proradio-widgets"); ?>  <input type="radio" name="<?php echo esc_attr( $this->get_field_name( 'showtitle' )); ?>" value="1" <?php if($instance['showtitle'] == '1'){ echo ' checked= "checked" '; } ?> />  
				<?php esc_html_e("Hide","proradio-widgets"); ?>  <input type="radio" name="<?php echo esc_attr( $this->get_field_name( 'showtitle' )); ?>" value="0" <?php if($instance['showtitle'] !== '1'){ echo ' checked= "checked" '; } ?> />  
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'showthumbnail' )); ?>"><?php esc_html_e('Display the thumbnail', "proradio-widgets"); ?></label><br />			
				<?php esc_html_e("Display","proradio-widgets"); ?>  <input type="radio" name="<?php echo esc_attr( $this->get_field_name( 'showthumbnail' )); ?>" value="1" <?php if($instance['showthumbnail'] == '1'){ echo ' checked= "checked" '; } ?> />  
				<?php esc_html_e("Hide","proradio-widgets"); ?>  <input type="radio" name="<?php echo esc_attr( $this->get_field_name( 'showthumbnail' )); ?>" value="0" <?php if($instance['showthumbnail'] !== '1'){ echo ' checked= "checked" '; } ?> />  
			</p>
		</div>
	<?php
	}
}

