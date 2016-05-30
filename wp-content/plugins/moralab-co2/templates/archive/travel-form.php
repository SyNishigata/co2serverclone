<!-- <div class="panel-heading">
    <div class="" id="dis">
        <center><span class="unit">Tons&nbsp;CO2/Year</span> </center>   
        <center> <span style="color:red;" class="amount"><h1> 0 </h1></span></center>
    </div>
    
    <div class="" id="andi" style="display: none;">
        <center><span class="unit">Tons&nbsp;CO2/Year</span></center>
        <center>  <h1><span style="color:red;" class="amount" id="amount"></span></h1></center>
    </div>
</div> -->

<?php global $carbon_data; ?>
<div><label><h2>Distance traveled per year: </h2></label></div>

<div class="form-group ">
    <label> </label>
    <select name="unit_conversion" onchange="common_carbon()" id="unit_value" class="form-select" value="<?php echo !empty($carbon_data)? get_post_meta($carbon_data['ID'], 'unit_conversion', true):'';?>">                
        <option value="mile">Miles</option>
        <option value="km">Kilometer</option>
    </select>
</div>
    
<div class="form-group">
    <span><i class="fa fa-car"></i> Distance Driven </span>
    <input type="text" name="miles_year" id="miles_year1" onchange="common_carbon()" class="form-control" value="<?php echo !empty($carbon_data)? floatval(get_post_meta($carbon_data['ID'], 'miles_year', true)):'';?>">
    <input type="hidden" name="year" id="year"></span>
</div>

<div class="form-group">
    <div>
        <span class="input-group-addon miles"><i class="fa fa-car"></i> Fuel </span>
        <input type="text" name="miles_gallon" id="miles_gallon1" onchange="common_carbon()" class="form-control" value="<?php echo !empty($carbon_data)? get_post_meta($carbon_data['ID'], 'miles_gallon', true):'';?>">
        <input type="hidden" name="new_gallon" id="miles_gallon" value="">
    </div>
    <div class="">
        <span class="input-group-addon miles"> Fuel Type </span>
        <select name="diesel" onchange="common_carbon()" id="option_value" class="form-control form-select" value="<?php echo !empty($carbon_data)? get_post_meta($carbon_data['ID'], 'diesel', true):'';?>">                
            <option value="diesel" >Diesel</option>
            <option value="gasolin" selected>Gasoline</option>
        </select>
    </div>
</div>

<div class="form-group ">
    <span class="input-group-addon bus"><i class="fa fa-bus"></i> Bus </span>
    <input type="text" name="bus" id="bus1" onchange="common_carbon()" class="form-control" value="<?php echo !empty($carbon_data)? get_post_meta($carbon_data['ID'], 'bus', true):'';?>" placeholder="Enter distance rode per year">
    <input type="hidden" name="new_bus" id="bus"  value="">
</div>

<div class="form-group">
    <span class="input-group-addon transit"><i class="fa fa-train"></i> Rail </span>
    <input type="text" name="transit_rail" onchange="common_carbon()" id="transit_rail1" class="form-control" value="<?php echo !empty($carbon_data)? get_post_meta($carbon_data['transit_rail'], 'miles_gallon', true):'';?>" placeholder="Enter distance rode per year">
    <input type="hidden" name="new_transit" id="transit_rail" value=""/>
</div>

<div class="form-group">
    <span class="input-group-addon flown"><i class="fa fa-plane"></i> Plane </span>
    <input type="text" name="miles_flown" onchange="common_carbon()" id="miles_flown1" class="form-control" value="<?php echo !empty($carbon_data)? get_post_meta($carbon_data['ID'], 'miles_flown', true):'';?>" plane="Enter distance flown per year">
    <input type="hidden" name="new_miles_flown" id="miles_flown" value="">
    <input type="hidden" name="total_carbon" id="total_carbon" value="<?php echo !empty($carbon_data)? get_post_meta($carbon_data['ID'], 'total_carbon', true):'';?>">
</div>