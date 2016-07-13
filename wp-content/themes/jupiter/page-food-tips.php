<?php 
if (!is_user_logged_in()){
	auth_redirect();
}
get_header(); ?>

<div class="tips-content">
	<div class="tips-container" style="margin-bottom:20px;">
		<!-- Header --> 
		<div class="panel-heading" style="padding-top:15px">
			<center><h1 style="margin0px"><b>Tips For Reducing Your Food Carbon Emissions</b></h1></center>
		</div>
    	<div class="tips-panel-body">
        	<!-- First Row -->
        	<div class="row" style="padding-top:10px">   
				<div class="small-12 medium-6 large-6 columns">
        			<div class="section group" style="color:black">
						<b>Almost half the carbon used to produce and deliver food is wasted.</b>  23% is 
						wasted in the supply chain, and consumers waste 20%.  You can cut your carbon 
						"foodprint" with no change in diet by shopping for, serving and ordering realistic 
						quantities, and by using leftovers in place of other meals.  Better planning and 
						measuring of how much food to buy and prepare will also save you money.
						<br><br>

						<b>You can make small improvements by targeting stages on the food life cycle that 
						are feasible for you.</b>  60% of the carbon from food is created after production 
						and we can target each stage in the life cycle with small changes that will add up 
						to a big difference.  Buy unprocessed food with less packaging.  Buy local (or grow) 
						foods that are in-season.  Minimize car trips to stores and restaurants.  Cook with 
						efficient appliances.  Eat out less.  Compost and recycle waste from food.            
					</div>
				</div>
				<div class="small-12 medium-6 large-6 columns" style="padding-left:125px">
					<img style="width:75%;height:75%" src="<?php echo INCLUDES_URL.'/img/tips-food1.png';?>">   
				</div>
			</div>
			
			<!-- Second Row -->
			<div class="row" style="padding-top:15px">   
				<div class="small-12 medium-5 large-5 columns">
					<img src="<?php echo INCLUDES_URL.'/img/tips-food2.png';?>">   
				</div>
        		<div class="small-12 medium-7 large-7 columns" style="padding-left:100px">
        			<div class="section group" style="color:black">
						<b>Calories from beef, lamb, and cheese produce the most carbon.</b>
						<br><br>
						
						Why?  Eating meat is less efficient than eating vegetables, because the animals 
						only convert a small portion of the energy from the plants they eat into meat.  The 
						digestive systems of cows and sheep release large quantities of methane as a 
						by-product of digestion, and more methane is released as their manure decomposes.  
						<br><br>
						
						Vegans, produce the least carbon, followed by vegetarians.  However, a diet very 
						low in red meat and cheese results in similar carbon reductions and is good for 
						your health too. 
					</div>
				</div>
			</div>
			
			<!-- Third Row -->
			<div class="row" style="padding-top:15px">
				<div id="wrapper" style="text-align: center; padding-top: 15px">
					<div class="button tipsreturn" style="display:inline-block; text-align:center"><strong>Return to Graph</strong></div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
jQuery(function ($) {
	
    $(".tipsreturn").on("click", function(){
     	window.location = "<?php echo get_home_url().'/expanded-graph'?>";
    });
});
</script>