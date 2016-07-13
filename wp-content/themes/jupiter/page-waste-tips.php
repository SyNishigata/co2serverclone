<?php 
if (!is_user_logged_in()){
	auth_redirect();
}
get_header(); ?>

<div class="tips-content">
	<div class="tips-container" style="margin-bottom:20px;">
		<!-- Header --> 
		<div class="panel-heading" style="padding-top:15px">
			<center><h1 style="margin0px"><b>Tips For Reducing Your Waste Carbon Emissions</b></h1></center>
		</div>
    	<div class="tips-panel-body">
			<!-- First Row -->
			<div class="row" style="padding-top:15px">   
        		<div class="small-12 medium-7 large-7 columns">
        			<div class="section group" style="color:black">
						<b>Globally, one fourth of all green house gas emissions are associated with making 
						stuff.</b>  10% is for construction and 15% is for physical products.  Many of these 
						products end up in a landfill when they could have been reused or recycled.  When you 
						avoid buying a new product, you save on emissions from sourcing virgin materials, from 
						manufacturing and from distribution.  
						<br><br>
						
						<b>Buy quality, not quantity.</b>  Say "no" to junk, even if it is a deal.  Buy 
						something that will last and that can be repaired.  Enjoy less clutter and spend 
						less time cleaning.  
						<br><br>
						
						<b>Choose low carbon designs.</b>  If a product uses energy, look for efficiency.  
						For example, a laptop or tablet computer uses less energy than a desktop.  Choose 
						sleek designs that make spare use of materials.  Support designs that incorporate 
						reclaimed materials or recycled content.  Pick products made out of materials that 
						don't require high carbon processing like clay and wood over carbon intensive 
						materials like metal, glass and stone.
					</div>
				</div>
				<div class="small-12 medium-5 large-5 columns">
					<img src="<?php echo INCLUDES_URL.'/img/tips-waste1.png';?>">   
				</div>
			</div>
			
			<!-- Second Row -->
			<div class="row" style="padding-top:15px">   
				<div class="small-12 medium-7 large-7 columns">
					<img src="<?php echo INCLUDES_URL.'/img/tips-waste2.png';?>">   
				</div>
        		<div class="small-12 medium-5 large-5 columns">
        			<div class="section group" style="color:black">				
						<b>Buy used goods.</b>  You can look online to find exactly what you want.  You 
						will get better stuff for the same budget, and produce less carbon.  The next time 
						you need furniture, sports equipment, or a costume, give it a try.  
						<br><br>		
						
						<b>Recycle.</b>  When a product is made of recycled paper, aluminum, plastic or 
						glass, carbon emissions are much lower than if it is made of virgin materials.  
						Landfill emissions are also avoided. 
						<br><br>
						
						<b>Share or rent products you don't need all the time. </b>
						<br><br>

						<b>Upcycle.</b>  Use old materials to make new things.  An old quilt can become a 
						shopping bag; a wooden palette can become a bookcase.  Let your creativity flow. 
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