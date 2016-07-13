<?php 
if (!is_user_logged_in()){
	auth_redirect();
}
get_header(); ?>

<div class="tips-content">
	<div class="tips-container" style="margin-bottom:20px;">
		<!-- Header --> 
		<div class="panel-heading" style="padding-top:15px">
			<center><h1 style="margin0px"><b>Tips For Reducing Your Carbon Emissions</b></h1></center>
		</div>
    	<div class="tips-panel-body">
        	<!-- First Row -->
        	<div class="row" style="padding-top:10px">   
        		<div class="small-12 medium-5 large-5 columns">
        			<div class="section group" style="color:black">
						<img src="<?php echo INCLUDES_URL.'/img/tips-general1.png';?>">   
					</div>
				</div>
				<div class="small-12 medium-7 large-7 columns">
        			<div class="section group" style="color:black">
						<b>You can have a high quality of life with low carbon emissions. </b>
						The size the average carbon footprint in wealthy countries varies dramatically
						with the source of energy used for electricity and the quality of public 
						transportation infrastructure.  The blur bars in chart to the left show 
						the range among the 20 nations with the highest total emissions.  You can 
						lobby your government and vote to change these factors.  Individual footprints a
						lso depend on personal habits that you can start to change right now.  
						<br><br>
						
						<b>The people responsible for Climate Change are the ones with the power to solve it. </b>
						China and the USA, along with a few other countries dominate global CO2 emissions due to 
						their large populations, their high rates of per capita emissions, or both.  The chart 
						on the left shows each countries' share of global carbon emissions next to their 
						names.  The poorest countries will suffer the most from Climate Change, but their 
						emissions do not play a significant role.  It is those with high emissions that have
						the leverage to reverse Climate Change.  
						<br><br>
						
						<b>Be part of a new model for development. </b> Most of the world's poor countries have very 
						low average carbon footprints because of their low standard of living.  Wealthy people 
						in these countries have high personal carbon emissions.  We need to create an alternative,
						low carbon path for them to follow as they develop and their quality of life improves.          
					</div>
				</div>
			</div>
			
			<!-- Second Row -->
			<div class="row" style="padding-top:15px">   
        		<div class="small-12 medium-5 large-5 columns">
        			<div class="section group" style="color:black">
						<b>A few areas dominate personal emissions.  </b>
						The chart shows how over half of the 19 tons 
						of CO2 equivalent emissions per person in the 
						USA is from driving, electricity, natural gas 
						(for heating), and food from cows.  Calculate 
						your carbon and choose your target areas.  
						<br><br>
					
						<b>Some changes are easy and come with extra benefits. </b> 
						Look through the strategies and start with the easiest 
						for you.  Reduce your carbon footprint while at the same 
						time you save money, save time and improve your health. 
					</div>
				</div>
				<div class="small-12 medium-7 large-7 columns">
					<img src="<?php echo INCLUDES_URL.'/img/tips-general2.png';?>">   
					<div style="text-align:right">
						<a href="http://www.shrinkthatfootprint.com" class="tipslink" style="color:#0000EE">
							shrinkthatfootprint.com
						</a> 
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