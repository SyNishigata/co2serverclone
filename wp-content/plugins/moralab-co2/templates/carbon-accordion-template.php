<?php
global $current_user;
get_currentuserinfo();

$query_id = get_query_var('member');
$query_item = get_query_var('carbon-title');


if ($current_user->ID == get_query_var('member') || get_query_var('caction') == 'calculator'):
	get_header(); ?>

	<div class="content"><div class="container" style="margin-bottom:20px;">

		<!-- Page Title -->
		<div class="panel-heading"><center><h3 style="margin:0px">Calculate Your Carbon Gas Emission</h3></center></div>
	    
	    <!-- Carbon Form -->
	    <div class="panel-body">

		 	<form enctype="multipart/form-data" id="carbonEmissionForm" method="post" action="">
			 	<div class="title"><h1>Carbon Calculator</h1></div>	
				<ul class="accordion" data-accordion>
				  <li class="accordion-item is-active" data-accordion-item>
				    <a class="accordion-title">Travel</a>
				    <div class="accordion-content" data-tab-content>
				      <?php get_plugin_template('forms/travel-form'); ?>
				    </div>
				  </li>
				  <!-- ... -->
				  <li class="accordion-item" data-accordion-item>
				    <a class="accordion-title">Utility</a>
				    <div class="accordion-content" data-tab-content>
				    	<?php get_plugin_template('forms/utility-form'); ?>
				    </div>
				  </li>
				  <li class="accordion-item" data-accordion-item>
				    <a class="accordion-title">Food</a>
				    <div class="accordion-content" data-tab-content>
				    	<?php get_plugin_template('forms/food-form'); ?>
				    </div>
				  </li>
				  <!-- ... -->
				  <li class="accordion-item" data-accordion-item>
				    <a class="accordion-title">Shopping</a>
				    <div class="accordion-content" data-tab-content>
				    	<?php get_plugin_template('forms/shopping-form'); ?>
				    </div>
				  </li>
				  <!-- ... -->
				</ul>

				<!-- Parameters -->
                <div class="form-group">
                    <input name="action" type="hidden" value="save_carbon_usage">
                </div><!-- /.form-group -->

                <!-- Submit Button -->
                <div class="form-group">
                    <div class="col-md-12" align="center">
                        <a class='button btn-primary post_submit'>Save</a>
                    </div>
                </div><!-- .button -->

			</form>

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
	                            location.href = '<?php echo home_url();?>'
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
	</div>
	<?php get_footer();
else:
	wp_redirect(get_home_url().'/my-carbon/'.$current_user->ID);
	exit;
endif;