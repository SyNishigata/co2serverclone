<?php 

class co2_graph extends WP_Widget {

function __construct() {
	parent::__construct(
		// Base ID of your widget
		'c02_graph', 

		// Widget name will appear in UI
		__('CO2 Chart', 'co2_graph_domain'), 

		// Widget description
		array( 'description' => __( 'User\'s Consumption and Tree Chart', 'co2_graph_domain' ), ) 
		);
	}

	// Creating widget front-end
	// This is where the action happens
	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );
		// before and after widget arguments are defined by themes
		echo $args['before_widget'];
		if ( ! empty( $title ) )
			echo $args['before_title'] . $title . $args['after_title'];

		add_action('wp_footer', 'graph_widget_script');


		if (is_user_logged_in()): 
			global $current_user;
	      	get_currentuserinfo(); ?>

			<div class="section group">
				<div class="row" style="margin-top:15px; left:-20px;">
					<div class="small-12 column" style="max-height:250px;">
						<div id="data-bar-graph-widget" style="width:100%; height: 200px; margin: 0 auto; margin-left:-15px;"></div>
					</div>
				</div>
			</div><?php 

		else: ?>
			<a href="<?php get_home_url().'/login';?>">Login or Create</a> an account to find where you rank in sequestering your carbon emission.<?php
		endif;
		echo $args['after_widget'];
	}
			
	// Widget Backend 
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( 'New title', 'ml_graph_domain' );
		}
		// Widget admin form
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<?php 
	}
		
	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		return $instance;
	}
} // Class wpb_widget ends here



