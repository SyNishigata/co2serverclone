<!-- <div class="panel-heading">
    <div  id="dishouse">
        <center><span class="unit">Tons&nbsp;CO2/Year</span>
        <span style="color:red;" class="house"><h1> 0 </h1></span></center>
    </div>

    <div id="andihouse" style="display: none;">
        <center><span class="unit">Tons&nbsp;CO2/Year</span>
        <h1>  <span  style="color:red;"  class="house" id="house"></span></h1></center>
    </div>
</div> -->
<?php global $carbon_data; ?>
<div><label><h2>How much do you use at home: </h2></label></div>


<div class="form-group">
    <span class="input-group-addon electricity"><i class="fa fa-bolt"></i> Electricity (Kw/yr) </span>
    <input type="text" name="electricity" onchange="common_housing()" id="electricity1" class="form-control" placeholder="Electricity (Kw/yr)" value="<?php echo !empty($carbon_data)? get_post_meta($carbon_data['ID'], 'electricity', true):'';?>">
    <input type="hidden" name="new_electricity" id="electricity" value="">                  
</div>

<div>
    <span class="input-group-addon gas"><i class="fa fa-fire"> Gas </i></span>
    <div class="row">
        <div class="small-6 columns">
            <div class="input-group">
                <input type="text" name="gas" onchange="common_housing()" id="gas1" class="form-control" placeholder="gas" value="<?php echo !empty($carbon_data)? get_post_meta($carbon_data['ID'], 'gas', true):'';?>">
                <input type="hidden" name="new_gas" id="gas" value="">  
            </div>                
        </div>

        <div class="small-6 columns">
            <div class="input-group">
                <select name="term_year" onchange="common_housing()" id="term_value" class="form-control"> value="<?php echo !empty($carbon_data)? get_post_meta($carbon_data['ID'], 'term_year', true):'';?>"  
                    <option length="5" value="term1" > therms/year </option>
                    <option length="5" value="term2" selected> cub.ft/Year </option>
                </select>
            </div>
        </div>
    </div>
</div>
<div class="form-group">
    <div class="input-group">
        <span class="input-group-addon fuels"><i class="fa fa-battery-three-quarters"></i> Fuels </span>
        <input type="text" name="fuels" onchange="common_housing()" id="fuels1" class="form-control" placeholder="fuels" value="<?php echo !empty($carbon_data)? get_post_meta($carbon_data['ID'], 'fuels', true):'';?>">
        <input type="hidden" name="new_fuels" id="fuels" value="">                  
    </div>
</div>
<div class="form-group">
    <div class="input-group">
        <span class="input-group-addon water_used"><i class="fa fa-tint"></i> Water </span>
        <input type="text" name="water_used" onchange="common_housing()" id="water_used1" class="form-control" placeholder="water used" value="<?php echo !empty($carbon_data)? get_post_meta($carbon_data['ID'], 'water_used', true):'';?>">
        <input type="hidden" name="new_water_used" id="water_used" value="">                  
        <input type="hidden" name="total_house" id="total_house" value="">
    </div>

</div>