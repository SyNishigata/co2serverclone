<?php 

class co2_trees extends WP_Widget {

function __construct() {
	parent::__construct(
		// Base ID of your widget
		'co2_trees', 

		// Widget name will appear in UI
		__('CO2 Trees', 'co2_trees_domain'), 

		// Widget description
		array( 'description' => __( 'Display User\'s Trees', 'co2_trees_domain' ), ) 
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

		if (is_user_logged_in()): ?>
			<div class="section group">
				<div class="th-trees">
					<ul class="small-block-grid-2 medium-block-grid-3 large-block-grid-4">
					  <?php get_users_trees_short(); ?>
					</ul>
				</div>
				<div class="new-tree-button">
					<a href="<?php echo get_home_url().'/my-trees/plant-a-tree';?>" class="button">Plant A Tree</a>
				</div>
			<div><?php
		else : ?>
			<p><a href="<?php echo get_home_url();?>/login">Login or Create an Account</a> to View Your Trees</p><?php
		endif;
		echo $args['after_widget'];
	}
			
	// Widget Backend 
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( 'New title', 'ml_trees_domain' );
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
