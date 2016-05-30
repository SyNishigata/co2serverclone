<?php 

	if ( is_user_logged_in() ):
		global $wp_post_types;
		
		get_header();


		global $current_user;
	    get_currentuserinfo();
	    $author_query = array('post_type' => 'tree','author' => $current_user->ID);
	    $author_posts = new WP_Query($author_query);
		
		$obj = $wp_post_types['tree'];


		//Create array of latlng locations
		$locations = Array();
		if ($author_posts->have_posts()):
			while($author_posts->have_posts()) : $author_posts->the_post();
			array_push($locations, array(
				"lat" => floatVal(get_post_meta(get_the_ID(), 'latitude', true)),
				"lng" => floatVal(get_post_meta(get_the_ID(), 'longitude', true)),
				));
			endwhile;
		endif;

		//get_plugin_template('tree-item-template');?>
		<div class="content">
			<div class="container">
				<!-- <div class="row">
					<a class="button pull-right" href="<?php //echo get_home_url().'/my-trees/plant-a-tree';?>">Add Tree</a>
				</div>
				<div class="row"> -->
					  <!-- <li class="grid-th"><img class="th" src="http://www.trees4life.ca/wp-content/uploads/2012/07/Tree-icon.png"></li> -->
					<!--  <?php //co2_get_users_trees(); ?>
				 </div> -->

        		<!-- Trees -->
        		<div class="section group">
					<div class="row">
						<div class="section-title">
							<center><h2><?php _e('My Trees', 'moralabs-plugins');?></h2></center>
						</div>
					</div>

					<div class="row">
						<div id="map" style="max-width: 800px; height: 350px"></div>
						<hr/>
					</div>

					<div class="row">
						<ul class="small-block-grid-2 medium-block-grid-3 large-block-grid-4" style="margin-left:0;">
						  <!-- <li class="grid-th"><img class="th" src="http://www.trees4life.ca/wp-content/uploads/2012/07/Tree-icon.png"></li> -->


					    	<?php if ($author_posts->have_posts()):
						    	while($author_posts->have_posts()) : $author_posts->the_post();
						    ?>

					    	<li class="grid-th" style="width:75px;height:75px;overflow:hidden;">
						        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" alt="<?php the_title(); ?>">
						        	<img class="thumbnail" width="75" height="75" src="<?php echo !empty(get_post_meta(get_the_ID(), 'tree_photos', true))? get_post_meta(get_the_ID(), 'tree_photos', true)[0]:INCLUDES_URL.'/img/tree-default.png'; ?>">
						        </a>
					        </li>
							<?php           
							    endwhile;
							 else:?>
							 	 <p>You have not planted any trees. <a href="<?php echo get_home_url()?>/my-trees/plant-a-tree">Plant a tree</a> to sequester your carbon emission!</p>
							<?php endif; ?>
						</ul>
					</div>
										<div class="row in-line">
						<div><a class="button carbon_summary" style="border-radius: 2px;">My Carbon Summary</a></div>
						<div><a class="button plant_tree" style="border-radius: 2px;">Plant A Tree</a></div>
					</div>
				</div><!-- .Trees -->
    		</div>
		</div>

	<script>
	
			(function($){
		$(".carbon_summary").on("click", function(){
            window.location = '<?php echo get_site_url().'/my-carbon'; ?>';
        });
		$(".plant_tree").on("click", function(){
            window.location = '<?php echo get_site_url().'/my-trees/plant-a-tree'; ?>';
        });
		})(jQuery);
		
		function initMap() {
	        var locations = <?php echo json_encode($locations); ?>;

	        var map = new google.maps.Map(document.getElementById('map'), {
	          zoom: 1,
	          center: {lat: 0, lng: 0}
	        });

	        var marker, i;

	        var image = 'https://cdn1.iconfinder.com/data/icons/map-objects/154/map-object-tree-park-forest-point-place-32.png';
	        for (i=0; i < locations.length; i++){

		        marker = new google.maps.Marker({
		          position: locations[i],
		          map: map,
		        });
		    }
	    }

	  	google.maps.event.addDomListener(window, 'load', initMap);
	  	
	  	jQuery('#mk-page-introduce').hide();
	</script>

	<?php get_footer();

	else:
		wp_redirect( get_home_url() );
		exit;
	endif;