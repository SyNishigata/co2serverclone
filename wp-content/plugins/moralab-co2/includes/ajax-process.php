<?php
// create ajax call

class co2_ajax_process{
	public function __construct() {
		// save tree
		add_action('wp_ajax_save_tree', Array($this, 'save_tree'));
		add_action('wp_ajax_nopriv_save_tree', Array($this, 'save_tree'));

		// delete tree
		add_action('wp_ajax_delete_tree', Array($this, 'delete_tree'));
		add_action('wp_ajax_nopriv_delete_tree', Array($this, 'delete_tree'));

		// save carbon emission data
		add_action('wp_ajax_save_carbon_usage', Array($this, 'save_carbon_usage'));
		add_action('wp_ajax_nopriv_save_carbon_usage', Array($this, 'save_carbon_usage'));

		// image uploaded
		add_action("wp_ajax_nopriv_image_uploader", Array($this, "image_uploader"));
		add_action("wp_ajax_image_uploader", Array($this, "image_uploader"));

		// get car model
		add_action("wp_ajax_nopriv_car_models", Array($this, "car_models"));
		add_action("wp_ajax_car_models", Array($this, "car_models"));

		// get car year
		add_action("wp_ajax_nopriv_car_years", Array($this, "car_years"));
		add_action("wp_ajax_car_years", Array($this, "car_years"));

		// get car efficiency
		add_action("wp_ajax_nopriv_car_efficiency", Array($this, "car_efficiency"));
		add_action("wp_ajax_car_efficiency", Array($this, "car_efficiency"));
	}

	public function save_tree() {
		global  $wpdb, $current_user;
      	get_currentuserinfo();

		$tree = array(
			'treeName' 		=> $_POST['treeName'],
			'location' 		=> $_POST['location'],
			'latitude' 		=> $_POST['latitude'],
			'longitude' 	=> $_POST['longitude'],
			'treeBirth' 	=> $_POST['treeBirth'],
			'treeDiameter'	=> $_POST['treeDiameter'],
			'treeUnit' 		=> $_POST['treeUnit'],
			'sequestered' 	=> $_POST['sequestered'],
			'tree_photos'		=> $_POST['tree_photos']
		);

		$args = array(
			'post_title'	=> $tree['treeName'],
			'post_content'	=> ''
		);

		if (!$_POST['new']):
			$args['ID'] = $_POST['post_id'];
			$post_id = wp_update_post($args);
		else: // a new post
			$args['post_type'] = 'tree';	
			$args['post_name'] = time();
			$args['post_status'] = 'publish';
			$args['post_author'] = $current_user->ID;
			$post_id = wp_insert_post($args);
		endif;

		// add or update tree post
		//$post_id = isset($id)? wp_update_post($args) : wp_insert_post($args);

		// Add tree meta data

		if( (int)$post_id > 0 ){
			update_post_meta($post_id, 'location', $tree['location']);
			update_post_meta($post_id, 'latitude', $tree['latitude']);
			update_post_meta($post_id, 'longitude', $tree['longitude']);
			update_post_meta($post_id, 'treeBirth', $tree['treeBirth']);
			update_post_meta($post_id, 'treeDiameter', $tree['treeDiameter']);
			update_post_meta($post_id, 'treeUnit', $tree['treeUnit']);
			update_post_meta($post_id, 'sequestered', $tree['sequestered']);
			update_post_meta($post_id, 'tree_photos', $tree['tree_photos']);


 			// update user's carbon score
			$this->update_user_carbon_score_meta($current_user->ID);
		}

		die(
			json_encode(
				Array(
					'result' => ( (int) $post_id > 0 ? true : false)
					, 'permalink' => get_permalink($post_id)
					, 'post' => $_POST['treeName']
				)
			)
		);
	}

	public function delete_tree(){
		global  $current_user;
      		get_currentuserinfo();
		$id = $_POST['ID'];

		if (intval($id) > 0){
			wp_delete_post( $id, true);
			$this->update_user_carbon_score_meta($current_user->ID);
		}
		die(
			json_encode(
				Array(
					'result' => 0
				)
			)
		);
	}

	public function save_carbon_usage() {
		global  $wpdb, $current_user;
      	get_currentuserinfo();

		$travel = array(
			'car' 				=> $_POST['car'],
			'mcycl' 			=> $_POST['mcycl'],
			'bus' 				=> $_POST['bus'],
			'train' 			=> $_POST['train'],
			'plane' 			=> $_POST['plane'],
			'co2_travel' 		=> $_POST['co2_travel'],
			'miles_flown' 		=> $_POST['miles_flown'],
			'total_travel' 		=> $_POST['total_travel'],
			'car_miles'			=> $_POST['car_miles'],
			'car_unit'			=> $_POST['car_unit'],
			'car_efficiency'	=> $_POST['car_efficiency'],
			'car_make'			=> $_POST['car_make'],
			'car_model'			=> $_POST['car_model'],
			'car_year'			=> $_POST['car_year'],
			'car_last' 			=> $_POST['car_last'],
			'car_last_date'		=> $_POST['car_last_date'],
			'car_current'		=> $_POST['car_current'],
			'car_current_date'	=> $_POST['car_current_date'],
			'car_fuel'			=> $_POST['car_fuel'],
			'mcycl_miles'	=> $_POST['mcycl_miles'],
			'mcycl_cc'	=> $_POST['mcycl_cc'],
			'mcycl_last'	=> $_POST['mcycl_last'],
			'mcycl_last_date'	=> $_POST['mcycl_last_date'],
			'mcycl_current'	=> $_POST['mcycl_current'],
			'mcycl_current_date'	=> $_POST['mcycl_current_date'],
			'busfrom'	=> $_POST['busfrom'],
			'busto'	=> $_POST['busto'],
			'bustrips'	=> $_POST['bustrips'],
			'busfreq'	=> $_POST['busfreq'],
			'bussy'	=> $_POST['bussy'],
			'busmiles'	=> $_POST['busmiles'],
			'total_bus_trip'	=> $_POST['total_bus_trip'],
			'trainfrom'	=> $_POST['trainfrom'],
			'trainto'	=> $_POST['trainto'],
			'traintrips'	=> $_POST['traintrips'],
			'trainfreq'	=> $_POST['trainfreq'],
			'trainsy'	=> $_POST['trainsy'],
			'trainmiles'	=> $_POST['trainmiles'],
			'total_train_trip'	=> $_POST['total_train_trip'],
			'planefrom'	=> $_POST['planefrom'],
			'planeto'	=> $_POST['[planeto]'],
			'planetrips'	=> $_POST['planetrips'],
			'planert'	=> $_POST['planert'],
			'planemiles'	=> $_POST['planemiles'],
			'total_plane_trip'	=> $_POST['total_plane_trip'],
		);
	
		$home = array(
			'co2_house'			=> $_POST['co2_house'],
			'electric' 	=> $_POST['electric'],
			'natural_gas' 			=> $_POST['natural_gas'],
			'propane_fuel' 	=> $_POST['propane_fuel'],
			'water' 	=> $_POST['water'],
			'household' 	=> $_POST['household'],
			'watts' 	=> $_POST['watts'],
			'low_watts' 	=> $_POST['low_watts'],
			'high_watts' 	=> $_POST['high_watts'],
			'ngas_usage' 	=> $_POST['ngas_usage'],
			'gas_unit' 	=> $_POST['gas_unit'],
			'low_ngas' 	=> $_POST['low_ngas'],
			'high_ngas' 	=> $_POST['high_ngas'],
			'fuel_gallon' 	=> $_POST['fuel_gallon'],
			'cooking' 	=> $_POST['cooking'],
			'drying' 	=> $_POST['drying'],
			'water_heat' 	=> $_POST['water_heat'],
			'water_usage' 	=> $_POST['water_usage'],
			'water_unit' 	=> $_POST['water_unit'],
			'low_water' 	=> $_POST['low_water'],
			'high_water' 	=> $_POST['high_water'],
		);

		$food = array(
			'veggies' 	=> $_POST['veggies'],
			'lamb' 		=> $_POST['lamb'],
			'beef' 		=> $_POST['beef'],
			'pork'		=> $_POST['pork'],
			'fish' 		=> $_POST['fish'],
			'poultry' 	=> $_POST['poultry'],
			'co2_food' 	=> $_POST['co2_food']
		);

		$recycle = array(
			'recycling'	=> $_POST['recycling'],
			'compost' 	=> $_POST['compost'],
			'co2_recycle' 	=> $_POST['co2_recycle']
			);

		$args = array(
			'post_author'  => $current_user->ID,
			'post_content' => ''
		);

		$id = $_POST['post_id'];
		$post_id = 0;
		if ($_POST['new'] == 'false'):
			$args['ID'] = $id;
			$args['post_title'] = $_POST['title'];
			$post_id = wp_update_post($args);
		else:
			$args['post_status'] = 'publish';
			$args['post_type']	 = 'emission';
			$args['post_title']  = date('Y');
			$args['post_name'] 	 = time();
			$post_id = wp_insert_post($args);
		endif;

		//$post_id = isset($id)? wp_update_post($args) : wp_insert_post($args);

		// Update Meta Datas
		if ( (int)$post_id > 0 ) {
			// Travel Info
			update_post_meta($post_id, 'travel_data', $travel);
			update_post_meta($post_id, 'home_data', $home);
			update_post_meta($post_id, 'food_data', $food);
			update_post_meta($post_id, 'recycle_data', $recycle);

			$total_emissions = $travel['co2_travel'] + $home['co2_house'] + $food['co2_food'] + $recycle['co2_recycle'];
			update_post_meta($post_id, 'total_emissions', $total_emissions);

			error_log($_POST['title']);
			if ( !empty($_POST['title']) && $_POST['title'] == date('Y')):
				$this->update_user_carbon_score_meta($current_user->ID);
			endif;
		}

		die(
			json_encode(
				Array(
					'result' => ( (int) $post_id > 0 ? true : false)
				)
			)
		);
	}

	function update_user_carbon_score_meta($user_id){
		$args = array('post_type' => 'tree','author' => $user_id);
		$posts = get_posts( $args );

		$sequestered = 0;
		if (count($posts > 0)):
			foreach( $posts as $post ) {
			    $tree = floatval(get_post_meta( $post->ID, 'sequestered', true ));
			    $sequestered += $tree;
			}
		endif;

		$args = array('post_type' => 'emission','author' => $user_id, 'post_title' => date('Y'));
		$posts = get_posts( $args );
		$total_carbon = 0;
		foreach( $posts as $post ) {
			$total_carbon = floatval(get_post_meta( $post->ID, 'total_emissions', true ));
		}

		$carbon_score = $sequestered - $total_carbon;
		error_log ($user_id.':'.$carbon_score);
		update_user_meta( $user_id, 'carbon_score', $carbon_score, $prev_value );
	}

	public function image_uploader(){

		// Set Featured Image
		require_once ABSPATH.'wp-admin/includes/file.php';
		require_once ABSPATH.'wp-admin/includes/image.php';
		//require_once ABSPATH.'wp-admin/includes/media.php';

		
		//$fileName = $_FILES['file']['name'];

		$file = wp_handle_upload($_FILES['file'], array('test_form'=>false));
		// $attachment = array(
		// 	'post_title' => $_FILES['file']['name']
		// 	, 'post_mime_type' => $file['type']
		// 	, 'post_content' => ''
		// 	, 'post_status' => 'inherit'
		// );


		//error_log($file['file']);
		//error_log($file['url']);

		//$attach_id = wp_insert_attachment($args, $file['file']);
		//$attach_data = wp_generate_attachment_metadata( $attach_id, $file['file'] );
		// wp_update_attachment_metadata( $attach_id, $attach_data );

		// $existing_uploaded_image = (int) get_post_meta($post_id,'featured_img', true);
  //       if(is_numeric($existing_uploaded_image)):
  //           wp_delete_attachment($existing_uploaded_image);
  //       endif;

  //       $url = wp_get_attachment_image_src($img_id);
		// $url = $url[0];

  //       update_post_meta($post_id, 'featured_img', $url);

		die(
			json_encode(
				Array(
					'result' => 0
					, 'img_url' => $file['url']
				)
			)
		);
	}

	public function car_models(){
		$make = $_POST['make'];
		global $wpdb;
		$models = $wpdb->get_results("SELECT DISTINCT model FROM wp_carbon_car WHERE make='". $make."'");

		die(
			json_encode(
				Array(
					'result' => 0,
					'car_models' => json_encode($models)
				)
			)
		);

	}

	public function car_years(){
		$make = $_POST['make'];
		$model = $_POST['model'];
		global $wpdb;
		$years = $wpdb->get_results("SELECT DISTINCT year FROM wp_carbon_car WHERE make='". $make."' AND model='" . $model . "'");

		die(
			json_encode(
				Array(
					'result' => 0,
					'car_years' => json_encode($years)
				)
			)
		);

	}

	public function car_efficiency(){
		$make = $_POST['make'];
		$model = $_POST['model'];
		$year = $_POST['year'];
		global $wpdb;
		$car = $wpdb->get_row("SELECT * FROM wp_carbon_car WHERE make='". $make."' AND model='" . $model . "' AND year='" . $year ."'");

		die(
			json_encode(
				Array(
					'result' => 0,
					'car' => json_encode($car)
				)
			)
		);

	}

}

new co2_ajax_process;