<?php

define('INCLUDES_URL', ML_PLUGIN_URL.'/includes');
// add_filter( 'template_include', 'portfolio_page_template', 99 );

// function portfolio_page_template( $template ) {

// 	if ( is_page( 'my-trees' )  ) {
// 		$template = INCLUDES_PATH . '/latlong-finder.php' ;
// 	}

// 	return $template;
// }

add_action('admin_menu', 'co2_admin_menu');
add_action('init', 'tree_register');
add_action('init', 'emission_register');

function get_plugin_template($template) {
	include TEMPL_PATH . '/'.$template.'.php';
}

/* Register Script Headers */
function add_header_scripts(){
	wp_enqueue_style( 'foundation', INCLUDES_URL.'/css/foundation.min.css', false, null );
	wp_enqueue_style( 'moralab', INCLUDES_URL.'/css/moralab.css', false, null );
	//wp_enqueue_script( 'jquery-v1-12', INCLUDES_URL.'/js/jquery-1.12.0.min.js', false, null );	
	//wp_enqueue_script( 'jquery-foundation', INCLUDES_URL.'/js/vendor/jquery.min.js', false, null );	
	wp_enqueue_script( 'foundation-js', INCLUDES_URL.'/js/foundation.min.js', false, null );
	wp_enqueue_script( 'highcharts-js', INCLUDES_URL.'/js/highcharts.js', false, null );
	//wp_enqueue_script( 'google-map-js', 'http://maps.googleapis.com/maps/api/js', false, null );
	wp_enqueue_script( 'google-map-js', 'http://maps.googleapis.com/maps/api/js?key=AIzaSyC7vypkjCVKS6DD_mAaRrMm0aljfF-EhQE&v=3.exp&libraries=places', false, null );
	wp_enqueue_script( 'jquery-ui-1-1-1-4-js', INCLUDES_URL.'/js/jquery-ui-v-1.11.4.js', false, null);
	//wp_enqueue_script( 'what-input', INCLUDES_URL.'/js/vendor/what-input.min.js', false, null );	

	// ajax
	//wp_localize_script( 'co2', 'co2ajax', array('ajaxurl' => admin_url( 'admin-ajax.php' )));

}

function add_footer_scripts() {
	wp_enqueue_script( 'foundation-app', INCLUDES_URL.'/js/app.js', false, null );
    wp_enqueue_script('co2', INCLUDES_URL.'/js/co2.js', false, null);
    wp_enqueue_script( 'carbon-js', INCLUDES_URL.'/js/carbon.js', false, null );
}


/* Register Post Type tree */
function tree_register() {
 
	$labels = array(
		'menu_name' => _x('CO2', 'co2'),
		'name' => _x('My Trees', 'co2'),
		'singular_name' => _x('Tree Item', 'co2'),
		'add_new' => _x('Add New Tree', 'Tree item'),
		'edit_item' => __('Edit Tree Item'),
		'new_item' => __('New Tree Item'),
		'view_item' => __('View Tree Item'),
		'search_items' => __('Search Tree'),
		'not_found' =>  __('Nothing found'),
		'not_found_in_trash' => __('Nothing found in Trash'),
		'archive' => __('My Trees')
	);
 
	$args = array(
		'labels' => $labels,
		'public' => false,
		'has_archive' => true,
		'publicly_queryable' => true,
		'show_ui' => false,
		'query_var' => true,
		'menu_icon' => 'dashicons-palmtree',
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title','editor', 'thumbnail'),
		'rewrite' => array('slug' => 'my-trees', 'with_front'=>false )
	  ); 
 
	register_post_type( 'tree' , $args);
	register_taxonomy("tree-types", array("tree"), array("hierarchical" => true, "label" => "Tree Types", "singular_label" => "tree-type", "rewrite" => true));
	flush_rewrite_rules(false);
}

/* Register Post Type Emission */
function emission_register() {
 
	$labels = array(
		'name' => _x('Carbon Calculator', 'post type general name'),
		'singular_name' => _x('Emission Item', 'post type singular name'),
		'add_new' => _x('Add New', 'Emission item'),
		'add_new_item' => __('Add New Emission Item'),
		'edit_item' => __('Edit Emission Item'),
		'new_item' => __('New Emission Item'),
		'view_item' => __('View Emission Item'),
		'search_items' => __('Search Emission'),
		'not_found' =>  __('Nothing found'),
		'not_found_in_trash' => __('Nothing found in Trash'),
		'parent_item_colon' => '',
		'menu_name' => 'Emissions'
	);
 
	$args = array(
		'labels' => $labels,
		'public' => false,
		'publicly_queryable' => true,
		'has_archive' => true,
		'show_ui' => true,
		'query_var' => true,
		'menu_icon' => '',
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title','editor', 'thumbnail'),
		'rewrite' => array('slug' => 'emissions', 'with_front'=>false )
	  ); 
 
	register_post_type( 'emission' , $args );
	flush_rewrite_rules(false); // needed for archive templating
}

/* Create Admin Menu Items */
function co2_admin_menu() {
	// Remove CO2 Post Types From Dashboard 
    remove_menu_page('edit.php?post_type=tree');
    remove_menu_page('edit.php?post_type=emission');

    // Add CO2 Menu and Sub Menus
    //add_menu_page ( 'CO2 Settings', 'CO2 Settings', administrator, 'co2-menu', 'init_settings_template', 'dashicons-palmtree', 50 );
    //add_submenu_page( 'co2-menu', 'Trees', 'Trees', 'manage_options', 'edit-tags.php?taxonomy=tree-types&post_type=tree');
}

function graph_widget_script() {
	echo "<script>
			jQuery(function ($) {
				var chart_id = '#data-bar-graph-widget';
				var data = " . json_encode( get_chart_data() ) . ";
   				get_bar_graph(chart_id, data);
			});
		</script>";
}

function graph_script() {
	?><script>
			jQuery(function ($) {
				var chart_id = '#data-bar-graph';
				var data = <?php echo json_encode(get_chart_data()); ?>;
   				get_bar_graph(chart_id, data);
			});
		</script><?php
}

// Begin Sy's Edits:

/* Sy's Edits: Added a new function for the expanded graph */
function expanded_graph_script() {
	?><script>
			jQuery(function ($) {
				var chart_id = '#expanded-data-bar-graph';
				var data = <?php echo json_encode(get_expanded_chart_data()); ?>;
   				get_expanded_bar_graph(chart_id, data);
			});
		</script><?php
}

//End Sy's Edits

function tree_sequestered() {
	echo "<script>
			jQuery(function ($) {
   				tree_sequestered();
			});
		</script>";
}

// retrieves all tree posts by user in detail
function co2_get_users_trees(){

	if ( is_user_logged_in() ):

	    global $current_user;
	    get_currentuserinfo();
	    $author_query = array('post_type' => 'tree','author' => $current_user->ID);
	    $author_posts = new WP_Query($author_query);

	    if ($author_posts->have_posts()):
		    while($author_posts->have_posts()) : $author_posts->the_post();
		    ?>

		    	<!-- <li class="grid-th">
			        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" alt="<?php the_title(); ?>">
			        	<img class="th" src="<?php //echo INCLUDES_URL.'/img/tree-default.png'; ?>">
			        </a>
		        </li> -->

		        <div class="medium-6 columns">
					<div class="media-object">
						<div class="media-object-section">
							<div id="preview" style="width:150px; height: 150px; overflow:hidden">
								<a href="<?php echo get_permalink($post->ID);?>"><img src="<?php echo !empty(get_post_meta(get_the_ID(), 'img_url', true)) ? get_post_meta(get_the_ID(), 'img_url', true):INCLUDES_URL.'/img/tree-long.png'; ?>" class="thumbnail" width="100%" height="100%" alt="image for article"></a>
							</div>
						</div>
						<div class="media-object-section">
							<h3 style="margin:10px 0;"><?php the_title(); ?></h3>
							<div><strong>Tree Diameter: </strong><?php echo get_post_meta(get_the_ID(), 'treeDiameter', true); ?> <?php echo get_post_meta(get_the_ID(), 'treeUnit', true)==1? 'in':'cm';?></div>
							<div><strong>Total Sequestered: </strong><?php echo get_post_meta(get_the_ID(), 'sequestered', true);?></div>
							<div><strong>Date Planted: </strong><?php echo get_post_meta(get_the_ID(), 'treeBirth', true);?></div>
							<p><span><a href="<?php echo get_permalink($post->ID);?>">Edit</a></span></p>
						</div>
					</div>
				</div>
		    <?php           
		    endwhile;
		 else:
		 	echo "You have not planted any trees. Plant a tree to sequester your carbon emission!";
		 endif;

	else : ?>

	   <p><a href="<?php echo get_site_url();?>/login">Login or Create an Account</a> to View Your Trees</p>

	<?php endif;


}

// Short Info list of All trees from current user
function get_users_trees_short(){

	if ( is_user_logged_in() ):

	    global $current_user;
	    get_currentuserinfo();
	    $author_query = array('post_type' => 'tree','author' => $current_user->ID);
	    $author_posts = new WP_Query($author_query);

	    if ($author_posts->have_posts()):
		    while($author_posts->have_posts()) : $author_posts->the_post();
		    ?>

		    	<li class="grid-th" style="width:75px;height:75px;overflow:hidden;">
			        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" alt="<?php the_title(); ?>">
			        	<img class="thumbnail" width="75" height="75" src="<?php echo !empty(get_post_meta(get_the_ID(), 'img_url', true))? get_post_meta(get_the_ID(), 'img_url', true):INCLUDES_URL.'/img/tree-default.png'; ?>">
			        </a>
		        </li>
		    <?php           
		    endwhile;
		 else:?>
		 	 <p>You have not planted any trees. <a href="<?php echo get_home_url()?>/my-trees/plant-a-tree">Plant a tree</a> to sequester your carbon emission!</p>
		 <?php endif;

	else : ?>

	   <p><a href="<?php echo get_home_url();?>/login">Login or Create an Account</a> to View Your Trees</p>

	<?php endif;


}

function get_chart_data(){
	global $current_user;
	get_currentuserinfo();

	$colors =  array(
		'tree' => 'green'
		, 'travel' => 'rgb(160,180,210)'
		, 'home' =>'rgb(220,220,200)'
		, 'food' => 'rgb(190,220,100)'
		, 'recycle' =>'rgb(250,160,80)'
		);


	$tree_args = array('post_type' => 'tree','author' => $current_user->ID);

	$trees = get_posts( $tree_args );

	$data = array();

	foreach( $trees as $tree ) {
		$tdata = array(
			"name" => $tree->post_title
			, "data" => [0, floatval(get_post_meta( $tree->ID, 'sequestered', true ))]
			, "color" => $colors['tree']
		);
		array_push($data, $tdata);
	}

	$co2_args = array('post_type' => 'emission','author' => $current_user->ID, 'post_title' => date('Y'));


	$emissions = get_posts( $co2_args );
	foreach( $emissions as $emission ) {
		$travel = get_post_meta( $emission->ID, 'travel_data', true );
		$home = get_post_meta( $emission->ID, 'home_data', true );
		$food = get_post_meta( $emission->ID, 'food_data', true );
		$recycle = get_post_meta( $emission->ID, 'recycle_data', true );

		array_push($data, array(
			"name" => 'travel'
			, "data" => [floatval($travel['co2_travel']), 0]
			, "color" => $colors['travel']
		));
		array_push($data, array(
			"name" => 'home'
			, "data" => [floatval($home['co2_house']), 0]
			, "color" => $colors['home']
		));
		array_push($data, array(
			"name" => 'food'
			, "data" => [floatval($food['co2_food']), 0]
			, "color" => $colors['food']
		));
		array_push($data, array(
			"name" => 'recycle'
			, "data" => [floatval($recycle['co2_recycle']), 0]
			, "color" => $colors['recycle']
		));

	}

	return $data;
}

// Begin Sy's Edits 
	
/* Sy's Edits: Added a new function to get the expanded chart data */
function get_expanded_chart_data(){
	global $current_user;
	get_currentuserinfo();

	$data = array();

	$co2_args = array('post_type' => 'emission','author' => $current_user->ID, 'post_title' => date('Y'));

	$emissions = get_posts( $co2_args );
	foreach( $emissions as $emission ) {
		$travel = get_post_meta( $emission->ID, 'travel_data', true );
		$home = get_post_meta( $emission->ID, 'home_data', true );
		$food = get_post_meta( $emission->ID, 'food_data', true );
		$recycle = get_post_meta( $emission->ID, 'recycle_data', true );

		// Adding travel data to array
		array_push($data, array(
			"name" => 'Car'
			, "data" => [floatval($travel['car']), 0, 0, 0]
		));
		array_push($data, array(
			"name" => 'Motorcycle'
			, "data" => [floatval($travel['mcycl']), 0, 0, 0]
		));
		array_push($data, array(
			"name" => 'Bus'
			, "data" => [floatval($travel['bus']), 0, 0, 0]
		));
		array_push($data, array(
			"name" => 'Train'
			, "data" => [floatval($travel['train']), 0, 0, 0]
		));
		array_push($data, array(
			"name" => 'Plane'
			, "data" => [floatval($travel['plane']), 0, 0, 0]
		));
		
		// Adding home data to array
		array_push($data, array(
			"name" => 'Electric'
			, "data" => [0, floatval($home['electric']) / floatval($home['household']), 0, 0]
		));
		array_push($data, array(
			"name" => 'Natural Gas'
			, "data" => [0, floatval($home['natural_gas']) / floatval($home['household']), 0, 0]
		));
		array_push($data, array(
			"name" => 'Propane Fuel'
			, "data" => [0, floatval($home['propane_fuel']) / floatval($home['household']), 0, 0]
		));
		array_push($data, array(
			"name" => 'Water'
			, "data" => [0, floatval($home['water']) / floatval($home['household']), 0, 0]
		));
		
		// Adding food data to array
		//***************FIX THIS: WHAT IS 'GENERAL DIET' SUPPOSED TO BE CALLED? (THE 0.9 padding)*************
		array_push($data, array(
			"name" => 'Lamb'
			, "data" => [0, 0, floatval($food['lamb'])*0.11*52*3.92*0.001, 0]
		));
		array_push($data, array(
			"name" => 'Beef'
			, "data" => [0, 0, floatval($food['beef'])*0.11*52*27*0.001, 0]
		));
		array_push($data, array(
			"name" => 'Pork'
			, "data" => [0, 0, floatval($food['pork'])*0.11*52*12.1*0.001, 0]
		));
		array_push($data, array(
			"name" => 'Fish'
			, "data" => [0, 0, floatval($food['fish'])*0.11*52*11.9*0.001, 0]
		));
		array_push($data, array(
			"name" => 'Poultry'
			, "data" => [0, 0, floatval($food['poultry'])*0.11*52*6.9*0.001, 0]
		));
		array_push($data, array(
			"name" => 'General Diet'
			, "data" => [0, 0, 0.9, 0]
		));
		
		// Adding recycle data to array
		array_push($data, array(
			"name" => 'Waste'
			, "data" => [0, 0, 0, floatval($recycle['co2_recycle'])]
		));
	}
	return $data;
}

// End Sy's Edits

function get_total_sequestered(){
	global $current_user;
	get_currentuserinfo();
	$args = array('post_type' => 'tree','author' => $current_user->ID);

	$posts = get_posts( $args );
	$num = 0;
	$sequestered = 0;
	foreach( $posts as $post ) {
	    $tree = floatval(get_post_meta( $post->ID, 'sequestered', true ));
	    $sequestered += $tree;
	    $num += 1;
	}

	$tree = array('total_sequestered' => $sequestered, 'count' => $num);

	return $tree;
}

function get_total_carbon_emitted(){
	global $current_user;
	get_currentuserinfo();
	$args = array('post_type' => 'emission','author' => $current_user->ID, 'post_title' => date('Y'));

	$posts = get_posts( $args );
	$total_carbon = 0;
	foreach( $posts as $post ) {
		$total_carbon = floatval(get_post_meta( $post->ID, 'total_emissions', true ));
	}
	return $total_carbon;

}

function get_carbon_post($title, $author_id){
	global $wpdb;
	return $wpdb->get_row("SELECT * FROM wp_posts WHERE post_title = '" . $title . "' AND post_author= '" .$author_id. "'", 'ARRAY_A');
}

function get_car_make() {
	global $wpdb;
	$make = $wpdb->get_results("SELECT DISTINCT make FROM wp_carbon_car");
	return $make;
}


function get_car_model($make){
	global $wpdb;
	$models = $wpdb->get_results("SELECT DISTINCT model FROM wp_carbon_car WHERE make='". $make."'");
	return $models;
}

function get_car_year($make, $model){
	global $wpdb;
	$years = $wpdb->get_results("SELECT DISTINCT year FROM wp_carbon_car WHERE make='". $make."' AND model='" . $model . "'");
	return $years;
}

function get_tree_species(){
	global $wpdb;
	$trees = $wpdb->get_results("SELECT * FROM wp_carbon_trees WHERE Common_Name IS NOT NULL");
	return $trees;
}


// get list of ranking by users
function carbon_ranking(){
	// get all user's metadata
	global $wpdb, $current_user;
	get_currentuserinfo();
	//$rankings = $wpdb->get_results("SELECT user_id, meta_value FROM wp_usermeta WHERE meta_key='carbon_score' ORDER BY meta_value DESC", 'ARRAY_A');
	$rankings = $wpdb->get_results("SELECT wp_usermeta.user_id, wp_usermeta.meta_value, wp_users.user_login FROM wp_usermeta, wp_users WHERE wp_usermeta.meta_key='carbon_score' AND wp_usermeta.user_id=wp_users.ID ORDER BY wp_usermeta.meta_value * 1 DESC", 'ARRAY_A');
	//$rank = array_search($current_user->ID, array_column($rankings, 'user_id'));

	$user_rank = 1;
	foreach ($rankings as $rank => $avatar){
		$id = intval($rankings[$rank]['user_id']);
		$rankings[$rank]['avatar'] = get_avatar($id, 100);
		$rankings[$rank]['rank'] = $user_rank++;
	}

	return $rankings;
}

if (!function_exists(get_avatar_url)) {
function get_avatar_url( $id_or_email, $args = null ) {
	$args = get_avatar_data( $id_or_email, $args );
	return $args['url'];
}
}

add_filter('single_template', 'post_template');

function post_template($single) {
    global $post;

	/* Checks for single template by post type */
	if ($post->post_type == "tree"){
	    if(file_exists(TEMPL_PATH. '/tree-single-template.php'))
	        return TEMPL_PATH . '/tree-single-template.php';
	    	exit;
	}
	elseif ($post->post_type == "emissions"){
	    if(file_exists(TEMPL_PATH. '/carbon-tab-template.php'))
	        return TEMPL_PATH . '/carbon-tab-template.php';
	    	exit;
	}
	else {
		return $single;
		exit;
	}
	
}

function carbon_post_archive_template( $archive_template ) {
     global $post;

     if ( is_post_type_archive ( 'emission' ) ) {
          return TEMPL_PATH . '/carbon-template.php';
     }
     return $archive_template;
}

add_filter( 'archive_template', 'carbon_post_archive_template' );

function tree_post_archive_template( $archive_template ) {
     global $post;

     if ( is_post_type_archive ( 'tree' ) ) {
          return TEMPL_PATH . '/tree-archive-template.php';
     }
     return $archive_template;
}

add_filter( 'archive_template', 'tree_post_archive_template' );


function carbon_emission_form( $atts ) {
	include  TEMPL_PATH . '/carbon-form.php';
}

function carbon_tree_data_form( $atts ) {
	add_action('wp_footer', 'tree_sequestered');
	include TEMPL_PATH . '/tree-form.php';
}