<?php 

// require_once( plugin_dir_path( __FILE__ ) . 'ml-trees.php' );
// require_once( plugin_dir_path( __FILE__ ) . 'ml-status.php' );
// require_once( plugin_dir_path( __FILE__ ) . 'ml-graph.php' );

require_once( WIDGETS_PATH . '/co2-trees.php' );
require_once( WIDGETS_PATH . '/co2-status.php' );
require_once( WIDGETS_PATH . '/co2-graph.php' );

// Register and load the widget
function co2_load_widget() {
	register_widget( 'co2_trees' );
	register_widget( 'co2_status' );
	register_widget( 'co2_graph' );
}
add_action( 'widgets_init', 'co2_load_widget' );