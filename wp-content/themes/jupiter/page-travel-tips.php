<?php 
if (!is_user_logged_in()){
	auth_redirect();
}
get_header(); ?>

<div class="tips-content">
	<div class="tips-container" style="margin-bottom:20px;">
		<!-- Header --> 
		<div class="panel-heading" style="padding-top:15px">
			<center><h1 style="margin0px"><b>Tips For Reducing Your Travel Carbon Emissions</b></h1></center>
		</div>
    	<div class="tips-panel-body">
        	<!-- First Row -->
        	<div class="row" style="padding-top:10px">   
        		<div class="small-12 medium-12 large-12 columns">
        			<div class="section group" style="color:black">
						<b>Increase the occupancy of a vehicle.</b> Carpooling splits up the carbon footprint of the 
						ride, and maybe the cost of gas and parking too.  The carbon savings are big when you 
						are on the same schedule as others for work, school or teams.  For social events, 
						carpooling extends the fun and may provide a designated sober driver.  After the 
						initial effort so set up a carpool for kids, you will save time when it is not your 
						turn.  Public transport has even higher occupancy, and you can read or work during the trip.       
					</div>
				</div>
			</div>
			
			<!-- Second Row -->
			<div class="row" style="padding-top:15px">   
        		<div class="small-12 medium-5 large-5 columns">
        			<div class="section group" style="color:black">
						<b>Switch to a low carbon vehicle. </b> Hybrid 
						cars, or electric cars where the electricity 
						is at least partially renewable, produce a 
						fraction of the carbon for the same 
						distance.  Get the smallest car that works 
						for you - for those that need more space 
						only occasionally, a hitch-mounted cargo 
						rack is cheaper and more fuel efficient 
						than a bigger car.  Newer cars often have 
						better mileage.  See the chart to compare 
						the carbon footprints of different types of 
						cars, including the carbon emitted during 
						manufacturing the car and indirect fuel 
						emissions from producing the fuel. 
					</div>
				</div>
				<div class="small-12 medium-7 large-7 columns">
        			<div class="section group">
						<img src="<?php echo INCLUDES_URL.'/img/tips-travel1.png';?>">
						<div style="text-align:right">
							<a href="http://www.shrinkthatfootprint.com" class="tipslink" style="color:#0000EE">
								shrinkthatfootprint.com
							</a> 
						</div>
					</div>
				</div>
			</div>
			
			<!-- Third Row -->
			<div class="row" style="padding-top:15px">   
        		<div class="small-12 medium-5 large-5 columns">
					<div class="section group" style="color:black">
						<b>Make your existing vehicle efficient.</b>
						<br>
						Speeding and rapid acceleration use 33% more 
						fuel.  Use websites and apps to avoid getting 
						stuck in traffic.  Remove excess weight from 
						your car.  Maintain the motor. 
						<br><br>
						
						<b>Choose alternatives to driving.</b>
						<br>
						Biking and walking are the lowest carbon and good for your 
						health.  In some places these can be combined 
						with public transport.   
						<br><br>
						
						<b>Live, work and play close by.</b>
						<br>
						People in urban areas travel shorter distances and use public 
						transport more.  Try to make choices that will 
						reduce your regular travel distances.  
					</div>
				</div>
				<div class="small-12 medium-7 large-7 columns">
					<div class="section group" style="color:black">
						<b>What about flying?</b>
						Flying is fairly efficient in terms of 
						CO2e/mile, unless you travel in business class and split 
						your emissions with fewer people.  However, the distance 
						covered in a single long trip results in so much carbon 
						emissions that the same 1.5 tons of CO2e would get you: 
						<br>
						<img src="<?php echo INCLUDES_URL.'/img/tips-travel2.png';?>">
						<br>
						The only solutions are to fly less and to purchase carbon 
						offsets.  Combine trips, stay close to home for leisure 
						trips, and replace business travel with videoconferencing.  
						If you must fly, take the most direct route and fly 
						economy. 
					</div>
				</div>
			</div>
		</div>
	</div>
</div>