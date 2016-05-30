<!-- <div class="panel-heading">
    <div id="disfood">
        <center><span class="unit">Tons&nbsp;CO2/Year</span>
        <span  style="color:red;"  class="food"><h1> 0 </h1></span></center>
    </div>
    
    <div  id="andifood" style="display: none;">
        <center><span class="unit">Tons&nbsp;CO2/Year</span>
        <h1>  <span  style="color:red;"  class="food" id="food"></span></h1></center>
    </div>
</div> -->
<?php global $carbon_data; ?>

<div><label><h2>Calories you eat per day: </h2></label></div>

<div class="input-group">
    <span class="input-group-addon beef"><i class="fa fa-food"></i> Beef </span>

    <input type="text" name="beef" onchange="common_food()" id="beef1" placeholder="beef" class="form-control" value="<?php echo !empty($carbon_data)? get_post_meta($carbon_data['ID'], 'beef', true):'';?>">
    <input type="hidden" name="new_beef" id="beef" value="">                  
</div>

<div class="form-group">
    <div class="input-group">
        <span class="input-group-addon poultry"><i class="fa fa-food"></i> Poultry </span>

        <input type="text" name="poultry" onchange="common_food()" id="poultry1" placeholder="poultry" class="form-control" value="<?php echo !empty($carbon_data)? get_post_meta($carbon_data['ID'], 'poultry', true):'';?>">
        <input type="hidden" name="new_poultry" id="poultry" value="">                  
    </div>


</div>

<div class="form-group">
    <div class="input-group">
        <span class="input-group-addon fish"><i class="fa fa-food"></i> Fish </span>

        <input type="text" name="fish" onchange="common_food()" id="fish1" placeholder="fish" class="form-control" value="<?php echo !empty($carbon_data)? get_post_meta($carbon_data['ID'], 'fish', true):'';?>">
        <input type="hidden" name="new_fish" id="fish" value="">                  
    </div>


</div>

<div class="form-group">
    <div class="input-group">
        <span class="input-group-addon dairy"><i class="fa fa-food"></i> Dairy </span>

        <input type="text" name="dairy" onchange="common_food()" id="dairy1" placeholder="dairy" class="form-control" value="<?php echo !empty($carbon_data)? get_post_meta($carbon_data['ID'], 'dairy', true):'';?>">
        <input type="hidden" name="new_dairy" id="dairy" value="">                  
    </div>


</div>

<div class="form-group">
    <div class="input-group">
        <span class="input-group-addon vegetables"><i class="fa fa-food"></i> Vegetables </span>

        <input type="text" name="vegetables" onchange="common_food()" id="vegetables1" placeholder="vegetables" class="form-control" value="<?php echo !empty($carbon_data)? get_post_meta($carbon_data['ID'], 'vegetables', true):'';?>">
        <input type="hidden" name="new_vegetables" id="vegetables" value="">                  
    </div>


</div>


<div class="form-group">
    <div class="input-group">
        <span class="input-group-addon bakery"><i class="fa fa-food"></i> Bakery </span>

        <input type="text" name="bakery" onchange="common_food()" id="bakery1" placeholder="bakery" class="form-control" value="<?php echo !empty($carbon_data)? get_post_meta($carbon_data['ID'], 'bakery', true):'';?>">
        <input type="hidden" name="new_bakery" id="bakery" value="">                  
    </div>

</div>


<div class="form-group">
    <div class="input-group">
        <span class="input-group-addon drinks"><i class="fa fa-coffee"></i> Drinks </span>
        <input type="text" name="drinks" onchange="common_food()" id="drinks1" placeholder="drinks" class="form-control" value="<?php echo !empty($carbon_data)? get_post_meta($carbon_data['ID'], 'drinks', true):'';?>">
        <input type="hidden" name="new_drinks" id="drinks" value="">                  
        <input type="hidden" name="total_food" id="total_food" value="<?php echo !empty($carbon_data)? get_post_meta($carbon_data['ID'], 'total_food', true):'';?>">                  
    </div>


</div>