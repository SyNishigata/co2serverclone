<?php
global $current_user;
get_currentuserinfo();

$query_id = '';
$query_item = '';
$query_action = '';

if ((get_query_var('member')) !== null)
	$query_id = get_query_var('member');
if ((get_query_var('carbon-title')) !== null)
	$query_item = get_query_var('carbon-title');
if ((get_query_var('caction')) !== null)
	$query_action = get_query_var('caction');

$carbon_data = get_carbon_post($query_item, $current_user->ID);

if (!empty($carbon_data)): 
	$title = $carbon_data['post_title'];
else:
	$title = date('Y');
endif;

//$callback_url = get_site_url().'/my-carbon/'.$current_user->user_login.'/'.$title;
$callback_url = get_home_url();
if ($query_action == 'calculator' && is_user_logged_in()):
	wp_redirect(get_home_url().'/my-carbon/'.$current_user->user_login.'/'.date('Y'));
	exit;
elseif ($current_user->user_login == get_query_var('member') || $query_action == 'calculator'):
	get_header(); 
?>
	<div class="content"><div class="container" style="margin-bottom:20px;">

		<!-- Page Title -->
		<div class="panel-heading"><center><h3 style="margin0px">Calculate Your Carbon Gas Emission</h3></center></div>
	    <!-- Carbon Form -->
	    <div class="panel-body">

	    	<div class="row">
	    		<div class="small-6 medium-3 large-3 columns">
	    			<div class="panel-heading" style="border: solid; margin:10px 0;">
					    <div class="" id="dis">
					    	<center><span><h2><strong>Travel</strong></h2></span></center>
					        <center><span class="unit">Tons&nbsp;CO2/Year</span> </center>   
					        <center> <span style="color:red;" class="amount"><h1> <?php echo !empty($carbon_data)? floatval(get_post_meta($carbon_data['ID'], 'total_travel', true)):0;?> </h1></span></center>
					    </div>
					    
					    <div class="" id="andi" style="display: none;">
					    	<center><span><h2><strong>Travel</strong></h2></span></center>
					        <center><span class="unit">Tons&nbsp;CO2/Year</span></center>
					        <center>  <h1><span style="color:red;" class="amount" id="amount"></span></h1></center>
					    </div>
					</div>
	    		</div>
	    		<div class="small-6 medium-3 large-3 columns">
	    			<div class="panel-heading" style="border: solid; margin:10px 0;">
					    <div  id="dishouse">
					    	<center><span><h2><strong>Home</strong></h2></span></center>
					        <center><span class="unit">Tons&nbsp;CO2/Year</span>
					        <span style="color:red;" class="house"><h1> <?php echo !empty($carbon_data)? floatval(get_post_meta($carbon_data['ID'], 'total_house', true)):0;?> </h1></span></center>
					    </div>

					    <div id="andihouse" style="display: none;">
					    	<center><span><h2><strong>Home</strong></h2></span></center>
					        <center><span class="unit">Tons&nbsp;CO2/Year</span>
					        <h1>  <span  style="color:red;"  class="house" id="house"></span></h1></center>
					    </div>
					</div>
	    		</div>
	    		<div class="small-6 medium-3 large-3 columns">
	    			<div class="panel-heading" style="border: solid; margin:10px 0;">
					    <div id="disfood">
					    	<center><span><h2><strong>Food</strong></h2></span></center>
					        <center><span class="unit">Tons&nbsp;CO2/Year</span>
					        <span  style="color:red;"  class="food"><h1> <?php echo !empty($carbon_data)? floatval(get_post_meta($carbon_data['ID'], 'total_food', true)):0;?> </h1></span></center>
					    </div>
					    
					    <div  id="andifood" style="display: none;">
					    	<center><span><h2><strong>Food</strong></h2></span></center>
					        <center><span class="unit">Tons&nbsp;CO2/Year</span>
					        <h1>  <span  style="color:red;"  class="food" id="food"></span></h1></center>
					    </div>
					</div>
	    		</div>
	    		<div class="small-6 medium-3 large-3 columns">
	    			<div class="panel-heading" style="border: solid; margin:10px 0;">
					        <div  id="disgoods">
						    	<center><span><h2><strong>Recycling</strong></h2></span></center>
							    <center><span class="unit">Tons&nbsp;CO2/Year</span>
						        <span  style="color:red;" class="goods"><h1> <?php echo !empty($carbon_data)? floatval(get_post_meta($carbon_data['ID'], 'total_goods', true)):0;?> </h1></span></center>
						    </div>
						   
						    <div  id="andigoods" style="display: none;">
						    	<center><span><h2><strong>Recycling</strong></h2></span></center>
						        <center><span class="unit">Tons&nbsp;CO2/Year</span>
						        <h1><span style="color:red;" class="goods" id="goods"></span></h1></center>
						    </div>
					</div>
	    		</div>
	    	</div>


	    	<div class="row" style="margin:20px auto;">
    			<form enctype="multipart/form-data" id="carbonEmissionForm" method="post" action="">
    				<input type="hidden" name="new" value="<?php echo !empty($carbon_data)? 'false':'true';?>">
    				<input type="hidden" name="post_id" value="<?php echo !empty($carbon_data)? $carbon_data['ID']:'0';?>">
    				<input type="hidden" name="title" value="<?php echo !empty($carbon_data)? $carbon_data['post_title']:'0';?>">
		    		<input name="action" type="hidden" value="save_carbon_usage">
		    		<ul class="tabs" data-tabs id="tabs" style="text-align:center">
				        <li class="tabs-title" style="float:none"><h1 id="tab-title" >Travel</h1></li>
			    	</ul>
		    		<div class="tabs-content" >
							<div class="tabs-panel is-active" id="travel-panel" style="min-height:500px; position:relative">
								<?php get_plugin_template('forms/travel-form'); ?>
								<div class="button" id="next-house" style="bottom:0; position:absolute;">Next</div>
							</div>
							<div class="tabs-panel" id="house-panel" style="min-height:500px; position:relative">
								<?php get_plugin_template('forms/utility-form'); ?>
								<div class="button" id="next-food" style="bottom:0px; position:absolute !important;">Next</div>
							</div>
							<div class="tabs-panel" id="food-panel" style="min-height:500px; position:relative">
								<?php get_plugin_template('forms/food-form'); ?>
								<div class="button" id="next-goods" style="bottom:0; position:absolute;">Next</div>
							</div>
							<div class="tabs-panel" id="goods-panel" style="min-height:500px; position:relative">
								<?php get_plugin_template('forms/recycle-form'); ?>
								<div class="save-item" style="bottom:0; position:absolute;">
									<?php echo is_user_logged_in()? '<a class="button post_submit">Save</a>':'<a href="/login">Login</a>';?>
								</div>
							</div>
					</div>

					
				</form>
			</div>
			<script type="text/javascript">
				//initialize form data
				jQuery(function ($) {
			        common_carbon();
			        common_food();
			        common_goods();
			        common_housing();
			    });


			    jQuery(document).ready(function($){
    				$('#next-house').click(function(){
    					$('#tab-title').text("Home");
    					$('#house-panel').attr("class", "tabs-panel is-active");
        				$('#travel-panel').attr("class", "tabs-panel");
    				});

    				$('#next-food').click(function(){
    					$('#tab-title').text("Food");
    					$('#house-panel').attr("class", "tabs-panel");
    					$('#food-panel').attr("class", "tabs-panel is-active");
    				});

    				$('#next-goods').click(function(){
    					$('#tab-title').text("Goods");
        				$('#food-panel').attr("class", "tabs-panel");
    					$('#goods-panel').attr("class", "tabs-panel is-active");
    				});
				});
			</script>
			<script type="text/javascript">

	            (function($){
	                $("body").on("click", ".post_submit", function(){
	                    var options = {};
	                    options.type = "post";
	                    options.url = "<?php echo admin_url('admin-ajax.php');?>";
	                    options.data = $("#carbonEmissionForm").serialize();
	                    options.dataType = "json";
	                    options.error = function(e){ alert("Server Error : " + e.state() ); };
	                    options.success = function(d){
	                        if(d.result == true){
	                            window.transmission = true;
	                            switch(d.status){
	                                default: 
	                            };
	                            location.href = '<?php echo $callback_url; ?>'
	                        };
	                    };
	                    $.ajax(options);
	                });
	                window.transmission = false;
	                $("form").submit(function(){ window.transmission = true; });
	                window.onbeforeunload = function(){ if(!window.transmission) return ""; };
	            })(jQuery);
	        </script>
		</div>
	</div></div>
	<?php get_footer();
else:
	wp_redirect(get_home_url().'/my-carbon/'.$current_user->ID);
	exit;
endif;