<!-- <div class="panel-heading">
    <div  id="disgoods">
	    <center><span class="unit">Tons&nbsp;CO2/Year</span>
        <span  style="color:red;"  class="goods"><h1> 0 </h1></span></center>
    </div>
   
    <div  id="andigoods" style="display: none;">
        <center><span class="unit">Tons&nbsp;CO2/Year</span>
        <h1><span  style="color:red;"  class="goods" id="goods"></span></h1></center>
    </div>
</div> -->

<?php global $carbon_data; ?>

<div><label><h2>How much do you spend per month: </h2></label></div>

<div class="form-group">
    <span class="input-group-addon cloth"><i class="fa fa-shopping-bag"></i> Clothes </span>

    <input type="text" name="cloth" onchange="common_goods()" id="cloth1" placeholder="cloth" class="form-control" value="<?php echo !empty($carbon_data)? get_post_meta($carbon_data['ID'], 'cloth', true):'';?>">
    <input type="hidden" name="new_cloth" id="cloth" value="">                  
</div>

<div class="form-group">
    <span class="input-group-addon furniture"><i class="fa fa-bed"></i> Furniture </span>
    <input type="text" name="furniture" onchange="common_goods()" id="furniture1" placeholder="furniture" class="form-control" value="<?php echo !empty($carbon_data)? get_post_meta($carbon_data['ID'], 'furniture', true):'';?>">
    <input type="hidden" name="new_furniture" id="furniture" value="">                  
</div>

<div class="form-group">
    <span class="input-group-addon health_care"><i class="fa fa-heartbeat"></i> Health Care</span>
    <input type="text" name="health_care" onchange="common_goods()" id="health_care1" placeholder="health_care" class="form-control" value="<?php echo !empty($carbon_data)? get_post_meta($carbon_data['ID'], 'health_care', true):'';?>">
    <input type="hidden" name="new_health_care" id="health_care" value="">                  
</div>

<div class="form-group">
    <span class="input-group-addon vehicle"><i class="fa fa-car"></i> Vehicle </span>
    <input type="text" name="vehicle" onchange="common_goods()" id="vehicle1" placeholder="vehicle" class="form-control" value="<?php echo !empty($carbon_data)? get_post_meta($carbon_data['ID'], 'vehicle', true):'';?>">
    <input type="hidden" name="new_vehicle" id="vehicle" value="">                  

</div>

<div class="form-group">
    <span class="input-group-addon house_maintance"><i class="fa fa-wrench"></i> Home Maintenance </span>
    <input type="text" name="house_maintance" onchange="common_goods()" id="house_maintance1" placeholder="house maintance" class="form-control" value="<?php echo !empty($carbon_data)? get_post_meta($carbon_data['ID'], 'house_maintance', true):'';?>">
    <input type="hidden" name="new_house_maintance" id="house_maintance" value="">                  
    <input type="hidden" name="total_goods" id="total_goods" value="<?php echo !empty($carbon_data)? get_post_meta($carbon_data['ID'], 'total_goods', true):'';?>">                  
</div>
