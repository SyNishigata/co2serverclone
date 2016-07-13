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
				<div class="small-12 medium-7 large-7 columns">
        			<div class="section group" style="color:black">
						<b>Electricity use dominates the home carbon footprint, but it can be reduced 
						dramatically by using a clean power source.</b>  The chart shows how the same 10,000 
						kilowatts of electricity results in very different carbon emissions, depending on 
						the source of the power (red bars).  You can also see how countries (blue bars) 
						using coal, like India and Australia, have high carbon emissions, while countries 
						using renewable energy, like Iceland and Sweden, have low emissions for the same 
						amount of power.  
						<br><br>
						
						Find out what mix your electricity is made from.  If it is not renewable, lobby 
						and vote for legislation to mandate that the utility switch to clean energy.  If 
						there is an option to pay for a "green rate" within your utility, make sure it goes 
						towards expansion of renewable energy.  
						<br><br>
						
						You can also invest in producing your own renewable energy.  This will most likely 
						be solar, perhaps complemented by batteries.  It is not all or nothing -- you can 
						start with a solar hot water heater, a solar or ground source heat pump, or a 
						solar-powered air conditioner.			
					</div>
				</div>
				<div class="small-12 medium-5 large-5 columns">
					<img src="<?php echo INCLUDES_URL.'/img/tips-home1.png';?>">  
				</div>
			</div>
			
			<!-- Second Row -->
			<div class="row" style="padding-top:20px">   
        		<div class="small-12 medium-7 large-7 columns">
        			<div class="section group" style="color:black">
						<b><u>How to increase efficiency with the power source you have.  </u></b>
						<br><br>
						
						<b>Heating and Cooling:</b>  Temperature control is by far the biggest use.  
						Program your thermostat to turn off when you are not home, when you are asleep,
						or not using part of the house.  Try adjusting the setting one degree at a time.  
						Can you still be comfortable?  A sweater (for heating) or  fans to move the air 
						(for cooling) may be all you need.  Fans don't use much electricity.  A one degree 
						change can cut electricity use by 10%.  
					</div>
				</div>
				<div class="small-12 medium-5 large-5 columns">
					<div class="section group" style="color:black">
						<b>Insulate your roof and walls and seal leaks:</b>  You can do some yourself: 
						caulk gaps, plug holes with expanding foam, add foam strips to external doorways, 
						or block unused chimneys.  Clean your AC filters.  Plant trees for shade. 
						<br><br>
						
						<b>Water Heating:</b>  Turn down your thermostat to 125 F.  Do laundry in cold water. 
						Buy a solar water heater - they pay for themselves.
						<br><br>
					</div>
				</div>
			</div>
			
			<!-- Third Row -->
        	<div class="row" style="padding-top:10px">   
				<div class="small-12 medium-7 large-7 columns">
					<img src="<?php echo INCLUDES_URL.'/img/tips-home2.png';?>">  
				</div>
				<div class="small-12 medium-5 large-5 columns">
        			<div class="section group" style="color:black">
						<b>Lighting:</b>  Switching to CFLs or LEDs cuts electricity used by lights by 80%.  
						Change frequently used lights first.  Mak sure you buy the right fit, shape (to shine 
						where you want), brightness (see a watts-lumens conversion table), warmth (usually 
						2,700 - 3,000 kelvins for home use).   LEDs are dimmable and quick to warm up, but cost 
						more than CFLs. 
						<br><br>
						
						<b>Refrigerator and Freezer:</b>  They are on all the time, make sure they are energy 
						efficient models and not set too cold. 
						<br><br>
						
						<b>Laundry and Dishwashing:</b>  Do full loads on the coldest setting.  Use a 
						clothesline.
						<br><br>
						
						<b>Electronics and Computers:</b>  5%-10% of household power is used by equipment 
						in "stand by" mode.  Turn everything off before you go to bed.  Power strips make 
						it easy to turn several things off at once.  When replacing electronics, consider 
						the wattage.
						<br><br>
						
						<b>Water:</b>  It takes energy to pump and treat water.  Use low flow toilets 
						(or a brick in the tank).  Don't water your plants when it is hot (50% evaporates), 
						or when the weather is wet.			
					</div>
				</div>
			</div>
			
			<!-- Fourth Row -->
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