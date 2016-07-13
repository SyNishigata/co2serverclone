<?php 


if (!is_user_logged_in()){
	auth_redirect();
}
global $current_user;
get_currentuserinfo();
$trees = get_total_sequestered();
$carbon_total = get_total_carbon_emitted();

$rankings = carbon_ranking();

$myrank = array_search($current_user->ID, array_column($rankings, 'user_id')) + 1;

$prev = 0;
$next = 0;
$last = count($rankings);
switch($myrank){
	case 1:
	case 2:
		$prev = 0;
		$next = 5;
		break;
	case ($last-1):
	case $last:
		$prev = $last-5;
		$next = $last;
		break;
	default:
		$prev = $myrank - 3;
		$next = $myrank + 2;
		break;
}

add_action('wp_footer', 'graph_script');
get_header(); ?>

<div class="content">
	<div class="container" style="margin-bottom:20px;">
    	<div class="panel-body">
		
        	<!-- First Row -->
        	<div class="row carbon-summary" style="padding-top:100px">   
			
				<!-- Ranking Column -->
        		<div class="small-12 medium-3 large-3 columns" >
        			<div class="section group" style="padding-right:35px">
						<div class="rank-badge" style="background-image:url('<?php echo INCLUDES_URL.'/img/badge-blue.png';?>')">
							<span><?php _e($myrank); ?></span>
						</div>
						<div id="wrapper" style="padding-top:15px; padding-left: 18px">
		        			<div class="button myrank" style="display:inline-block; text-align:center; white-space:nowrap">
								<strong>My Ranking</strong>
							</div>
		        		</div>
					</div>
        		</div>

        		<!-- Title Column -->
				<div class="small-12 medium-6 large-6 columns">
        			<div class="section group" style="position:relative; right:25px">
						<div class="panel-heading"><h2 style="padding-top:50px; white-space:nowrap">
							My Pathway to Carbon Neutrality
						</h2></div>
					</div>
				</div>
				
				<!-- Competition Column -->
        		<div class="small-12 medium-3 large-3 columns">
        			<div class="section group" style="padding-left:45px">
						<div class="competitions-pic" style="padding-top:10px">
							<img src="https://pixabay.com/static/uploads/photo/2015/11/24/22/16/podium-1060918_960_720.png" alt="ccpodium" style="width:450px;height:150px;">
						</div>
						<div id="wrapper" style="text-align:center">
							<div class="button competitions" style="display:inline-block; text-align:center; white-space:nowrap">
								<strong>Competitions</strong>
							</div>
						</div>
					</div>
        		</div>
        	</div> <!-- End First Row -->

			<!-- Second Row -->
        	<div class="row carbon-summary" style="padding-top:30px">

				<!-- Graph Column --> 
				<div class="small-12 medium-4 large-4 columns">
        			<div class="section group"  style="padding-right:20px">
						<a class="expandedgraph" style="color: #0000EE; font-size:12px;">
							<center>Click here for a breakdown of your emissions with tips to reduce them</center>
						</a>
						<div id="data-bar-graph" style="width:100%x; height:200px; margin: 0 auto; margin-left:-15px;"></div>
					</div>
        		</div>
				
				<!-- Emissions Column -->
        		<div class="small-12 medium-4 large-4 columns carbon" style="height:inherit">
        			<div class="section group" style="padding-left:30px">
						<div class="summary">
							<div class="summary-head"><img src="<?php echo INCLUDES_URL.'/img/co2cloud-grey.png';?>" width="150px" height="auto"></div>
							<div class="summary-detail">
								<?php if (floatval($carbon_total) <= 0 || $carbon_total == ''): ?>
										<h3 style="margin:0 0 20px; font-size:18px; font-weight:bold;"><center>Start entering your carbon data to find your carbon deficit.</center></h3>
								<?php elseif (floatval($deficit) > 0): ?>
										<h3 style="margin:0 0 20px; font-size:18px; font-weight:bold;"><center>You still have <br/><?php echo $deficit;?> ton<br/> of CO2 still to sequester.</center></h3>
								<?php else: ?>
										<h3 style="margin:0 0 20px; font-size:18px; font-weight:bold;"><center><strong>Congratulations,<br/>You Are Carbon Neutral!</strong></center></h3>
								<?php endif; ?>
							</div>
			        		<div id="wrapper" style="text-align: center">    
								<div class="button mycarbon" style="display:inline-block"><strong>My Carbon Emissions</strong></div>
							</div>
						</div>
					</div>
        		</div>
				
				<!-- Trees Column -->
        		<div class="small-12 medium-4 large-4 columns carbon">
        			<div class="section group" style="padding-left:30px">
        				<div class="summary">
        					<div class="summary-head"><img src="<?php echo INCLUDES_URL.'/img/plant-tree.png';?>" width="100px" height="auto"></div>
        					<div class="summary-detail">
								<?php 
									$deficit =  floatval($carbon_total) - floatval($trees['total_sequestered']);
									if (floatval($trees['total_sequestered']) < 0 || $trees['total_sequestered']==''): 
								?>
		        				<h3 style="margin:0 0 20px; font-size:18px; font-weight:bold;"><center>Start planting trees to become Carbon Neutral!</center></h3>
								<?php elseif ($deficit > 0):
									//Not Carbon Neutral
									$avg_sequestered = floatval($trees['total_sequestered']) / intval($trees['count']);
									$trees_needed = $deficit / $avg_sequestered;
									if ($trees_needed < 1): 
										$trees_needed = 1;
									endif;
		        				?>
		        				<h3 style="margin:0 0 20px; font-size:18px; font-weight:bold;"><center>You need to plant atleast <br/><?php echo round($trees_needed); ?> trees <br/>to be carbon neutral</center></h3>
								<?php else: // Is Carbon Neutral?>
									<h3 style="margin:0 0 20px; font-size:18px; font-weight:bold;"><center>You have enough trees to sequester all of your carbon footprint!</center></h3>
								<?php endif;?>
		        			</div>
		        			<div id="wrapper" style="text-align:center; white-space:nowrap; padding-right:50px">
								<div class="button planttree" style="display:inline-block; text-align:center"><strong>Plant A Tree</strong></div>
								<div class="button mytree" style="display:inline-block; text-align:center"><strong>My Trees</strong></div>
							</div>
		        		</div>
		        	</div>
        		</div>
    		</div> <!-- End Second Row -->
	    </div>
	</div>
</div>


<script>
jQuery(function ($) {
    $('#mk-page-introduce').hide();
	
	$(".expandedgraph").on("click", function(){
     	window.location = "<?php echo get_home_url().'/my-carbon/expanded-graph'?>";
    });
	
	$(".competitions").on("click", function(){
     	window.location = "<?php echo get_home_url().'/my-carbon/competitions'?>";
    });

    $(".myrank").on("click", function(){
     	window.location = "<?php echo get_home_url().'/my-carbon/ranking'?>";
    });

    $(".mycarbon").on("click", function(){
     	window.location = "<?php echo get_home_url().'/my-carbon/'.$current_user->user_login.'/'.date('Y')?>";
    });

    $(".planttree").on("click", function(){
     	window.location = "<?php echo get_home_url().'/my-trees/plant-a-tree'?>";
    });

    $(".mytree").on("click", function(){
     	window.location = "<?php echo get_home_url().'/my-trees'?>";
    });

    $('#prev').click(function(){
			var max = 5;
			var last_index = parseInt($(this).attr("data-prev"));
			var first_index = last_index - max + 1;

			var update_list = '';
			var members = <?php echo json_encode($rankings); ?>;

			if (last_index >= 0){
				if (first_index < 0 ){
					first_index = 0;
					last_index = max;
				}

				$('div#next').attr("data-next", last_index + 1);
				$('div#prev').attr("data-prev", first_index );
				
				for (i = 0; i < max; i++) { 
				    var rank = members[first_index]["rank"];
				    var avatar = members[first_index]["avatar"];
				    var name = members[first_index]["user_login"];
				    var deficit = members[first_index]["meta_value"];
				    update_list = update_list + '<div class="avatar-list"><div class="avatar">' + rank + '<img src="'+ 
				    	avatar + '" width="100" height="100"></div><div class="name"><center>' + 
				    	name + '</center></div><div class="sequestered"><center>' + 
				    	deficit * (-1) + '<br/>ton deficit</center></div></div>';
				    first_index++;
				}
				
				$('div#members').html(update_list);
			}
		});

		$('#next').click(function(){
			var max = 5;
			var first_index = parseInt($(this).attr("data-next"));
			
			var members = <?php echo json_encode($rankings); ?>;
			var update_list = '';

			if (first_index < members.length){
				if ((first_index + max) > members.length){
					first_index = members.length - max ;
				}

				$('#prev').attr("data-prev", first_index-1);
				$(this).attr("data-next", first_index + max);


				for (i = 0; i < max; i++) { 
				    var rank = members[first_index]["rank"];
				    var avatar = members[first_index]["avatar"];
				    var name = members[first_index]["user_login"];
				    var deficit = members[first_index]["meta_value"];
				    update_list = update_list + '<div class="avatar-list"><div class="avatar">' + rank +  '<img src="'+ 
				    	avatar + '" width="100" height="100"></div><div class="name"><center>' + 
				    	name + '</center></div><div class="sequestered"><center>' + 
				    	deficit * (-1) + '<br/>ton deficit</center></div></div>';
				    first_index++;
				}
				
				$('div#members').html(update_list);
			}
		});
});
</script>
<?php get_footer(); ?>