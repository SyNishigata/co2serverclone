<?php 

class co2_status extends WP_Widget {

function __construct() {
	parent::__construct(
		// Base ID of your widget
		'co2_status', 

		// Widget name will appear in UI
		__('CO2 Summary and Rank', 'co2_status_domain'), 

		// Widget description
		array( 'description' => __( 'Display User\'s CO2 Status and Ranking', 'co2_status_domain' ), ) 
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

		global $current_user;
      	get_currentuserinfo();		
		if ( is_user_logged_in() ): 
			$congrats = (get_total_sequestered() > get_total_carbon_emitted())? 'Congratulations You Are Carbon Neutral!': 'Plant More Trees To Become Carbon Netural!';
			
			$trees = get_total_sequestered();

			$rankings = carbon_ranking();
						$rank = array_search($current_user->ID, array_column($rankings, 'user_id')) + 1;
						$ends = array('th','st','nd','rd','th','th','th','th','th','th');
			if (($rank %100) >= 11 && ($rank%100) <= 13)
			   $ordinal_rank = $rank. 'th';
			else
			   $ordinal_rank = $rank. $ends[$rank % 10];

			?>


			<div class="section group">
				<div class="section-title">
					<h2><?php _e('Where Do I Rank?', 'moralabs-plugins');?></h2>
				</div>
				<div class="summary">
					<h3><center><?php if ($trees['total_sequestered'] > get_total_carbon_emitted()) echo $congrats; ?></center></h3>
					<div><strong>You are the <?php echo $ordinal_rank; ?> most carbon neutral person.</strong></div>
					<?php if ($trees['total_sequestered'] < get_total_carbon_emitted()): ?>
						<span>You still have <?php echo get_total_carbon_emitted() - $trees['total_sequestered'];?> co2 tonnes still to sequester.</span>
					<?php endif; ?>
					<div><span><strong>Total Carbon Emitted:</strong> <?php echo get_total_carbon_emitted(); ?> tonnes of co2.</span></div>
					<div><span><strong>Total Cabron Sequestered by Trees:</strong> <?php echo $trees['total_sequestered']; ?> tonnes of co2.</span></div>
				</div>
				
			</div><?php 
		else: ?>
			<p><a href="<?php echo get_home_url();?>/login">Login or Create an Account</a> to find out where you rank.</p><?php 
		endif;

		echo $args['after_widget'];
	}
			
	// Widget Backend 
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( 'New title', 'ml_status_domain' );
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
