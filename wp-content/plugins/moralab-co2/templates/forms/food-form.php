<?php global $carbon_data; 

$food = get_post_meta($carbon_data['ID'], 'food_data', true);

?>


<div class="form-group">

	<!-- Sy's Edits:  Commented out old 'veggies' radio button interaction and then edited it -->
    <div class="input-group">
	<!--
        <span class="input-group-addon beef"> Are you a vegetarian? </span>
        <div style="display:inline; padding-left: 10px"><input type="radio" name="veggies" onchange="carbon_food()" id="veggies" placeholder="veggies" value="1" <?php echo ($food['veggies'] == '1') ? 'checked':'';?>> Yes </div>
        <div style="display:inline; padding-left: 10px"><input type="radio" name="veggies" onchange="carbon_food()" id="veggies" placeholder="veggies" value="0" <?php echo ($food['veggies'] == '0') ? 'checked':'';?>> No  </div>
    -->
		<span style="font-weight:bold; font-size:150%"> Are you a vegetarian? </span>
        <div style="display:inline; padding-left: 10px"><input type="radio" name="veggies" onchange="carbon_veggies()" id="veggiesyes" placeholder="veggies" value="1" <?php echo ($food['veggies'] == '1') ? 'checked':'';?>> Yes </div>
        <div style="display:inline; padding-left: 10px"><input type="radio" name="veggies" onchange="carbon_veggies()" id="veggiesno" placeholder="veggies" value="0" <?php echo ($food['veggies'] == '0') ? 'checked':'';?>> No  </div>
   
	</div>
	<!-- End Sy's Edits -->
	
	<!-- Sy's Edits:  -Added an outer div (id=hiddenfoodinput), so food input is hidden by default 
					  -Added extra divs (row and columns) so every food type can be on the same row 
					  -Made food type labels and inputs centered instead of left-aligned -->
	<div hidden id="hiddenfoodinput">
		<div><p>How many servings do you eat?</p></div>

		<div class="row">
			<div class="small-2 columns">
				<div class="input-group" style="text-align: center">
					<span class="input-group-addon lamb"> Lamb </span>
					<input style="text-align: center" type="text" min="0" name="lamb" onchange="carbon_food()" id="lamb" class="form-control" value="<?php echo !empty($carbon_data)? $food['lamb']:'';?>">
				</div>
			</div>
			<div class="small-2 columns">
				<div class="input-group" style="text-align: center">
					<span class="input-group-addon beef"> Beef </span>
					<input style="text-align: center" type="text" min="0" name="beef" onchange="carbon_food()" id="beef" class="form-control" value="<?php echo !empty($carbon_data)? $food['beef']:'';?>">
				</div>
			</div>
			<div class="small-2 columns">
				<div class="input-group" style="text-align: center">
					<span class="input-group-addon pork"> Pork </span>
					<input style="text-align: center" type="text" min="0" name="pork" onchange="carbon_food()" id="pork" class="form-control" value="<?php echo !empty($carbon_data)? $food['pork']:'';?>">
				</div>
			</div>
			<div class="small-2 columns">
				<div class="input-group" style="text-align: center">
					<span class="input-group-addon fish"> Fish </span>
					<input style="text-align: center" type="text" min="0" name="fish" onchange="carbon_food()" id="fish" class="form-control" value="<?php echo !empty($carbon_data)? $food['fish']:'';?>">
				</div>
			</div>
			<div class="small-2 columns">
				<div class="input-group" style="text-align: center">
					<span class="input-group-addon poultry"> Poultry </span>
					<input style="text-align: center" type="text" min="0" name="poultry" onchange="carbon_food()" id="poultry" class="form-control" value="<?php echo !empty($carbon_data)? $food['poultry']:'';?>">
				</div>
			</div>
		</div>
		
		<div class="input-group">               
			<input type="hidden" name="co2_food" id="co2_food" value="<?php echo !empty($carbon_data)? $food['co2_food']:'';?>">
		</div>
		
	</div>
	<!-- End Sy's Edits -->

</div>

<!-- Sy's Edits:  Added a function that makes sure the food sections are not hidden when a user returns to edit their emissions -->
<script>
jQuery(function ($) {
	
	// If the 'veggiesno' is checked, then show the food sections.  Otherwise would be hidden when a user returns.
	$(document).ready(function() {
		if(jQuery('#veggiesno').is(':checked')) {
			jQuery('#hiddenfoodinput').show();
		}
	});
	
});
</script>
<!-- End Sy's Edits -->