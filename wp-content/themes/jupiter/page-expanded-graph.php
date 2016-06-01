<?php // template for the 'expanded-graph' page 

if (!is_user_logged_in()){
	auth_redirect();
}
global $current_user;
get_currentuserinfo();
$trees = get_total_sequestered();
$carbon_total = get_total_carbon_emitted();

add_action('wp_footer', 'expanded_graph_script');
get_header(); ?>

<div class="content">
	<div class="container" style="margin-bottom:20px;">
		<!-- Title Header -->
    	<div class="panel-heading"><center><h1 style="margin0px">My Carbon Emissions Breakdown</h1></center></div>

    	<div class="panel-body">
        	
        	<div class="row carbon-summary">   
        		<div class="small-12 medium-12 large-12 columns">
        			<div class="section group">
						<div class="section-title">
							<h2><?php //_e('My Carbon Emission', 'moralabs-plugins');?></h2>
						</div>
						<div id="expanded-data-bar-graph" style="width:100%x; height:100%x; margin: 0 auto; margin-left:-15px;"></div>
					</div>
        		</div>
        	</div>
			
			<div class="row carbon-summary">
				<div id="wrapper" style="text-align: center; padding-top: 15px">
					<div class="button expandedreturn" style="display:inline-block; text-align:center"><strong>Return to Pathways</strong></div>
				</div>
			</div>
			
	    </div>
		
	</div>
</div>


<script>
jQuery(function ($) {
    $('#mk-page-introduce').hide();
	
	$(".expandedgraph").on("click", function(){
     	window.location = "<?php echo get_home_url().'/my-carbon/expanded-graph'?>";
    });

    $(".expandedreturn").on("click", function(){
     	window.location = "<?php echo get_home_url().'/my-carbon'?>";
    });
});
</script>

<?php get_footer(); ?>