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
	
	<!-- Sy's Edits:  Added an outer div, so food input is hidden by default -->
	<div hidden id="hiddenfoodinput">
	
		<div><p>How many servings do you eat?</p></div>

		<div class="input-group">
			<span class="input-group-addon lamb"> Lamb </span>
			<input type="text" min="0" name="lamb" onchange="carbon_food()" id="lamb" class="form-control" value="<?php echo !empty($carbon_data)? $food['lamb']:'';?>">
		</div>

		<div class="input-group">
			<span class="input-group-addon beef"> Beef </span>
			<input type="text" min="0" name="beef" onchange="carbon_food()" id="beef" class="form-control" value="<?php echo !empty($carbon_data)? $food['beef']:'';?>">
		</div>

		<div class="input-group">
			<span class="input-group-addon pork"> Pork </span>
			<input type="text" min="0" name="pork" onchange="carbon_food()" id="pork" class="form-control" value="<?php echo !empty($carbon_data)? $food['pork']:'';?>">
		</div>

		<div class="input-group">
			<span class="input-group-addon fish"> Fish </span>
			<input type="text" min="0" name="fish" onchange="carbon_food()" id="fish" class="form-control" value="<?php echo !empty($carbon_data)? $food['fish']:'';?>">
		</div>

		<div class="input-group">
			<span class="input-group-addon poultry"> Poultry </span>
			<input type="text" min="0" name="poultry" onchange="carbon_food()" id="poultry" class="form-control" value="<?php echo !empty($carbon_data)? $food['poultry']:'';?>">
		</div>

		<div class="input-group">               
			<input type="hidden" name="co2_food" id="co2_food" value="<?php echo !empty($carbon_data)? $food['co2_food']:'';?>">
		</div>
		
	</div>
	<!-- End Sy's Edits -->

</div>