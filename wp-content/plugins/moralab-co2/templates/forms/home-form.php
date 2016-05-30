<?php global $carbon_data; 

$home = get_post_meta($carbon_data['ID'], 'home_data', true);

?>

<div class="form-group">

    <div class="input-group">
        <input type="hidden" name="electric" id="electric" value="<?php echo !empty($carbon_data) ? $home['electric']:'';?>">     
        <input type="hidden" name="natural_gas" id="natural_gas" value="<?php echo !empty($carbon_data) ? $home['natural_gas']:'';?>">                  
        <input type="hidden" name="propane_fuel" id="propane_fuel" value="<?php echo !empty($carbon_data) ? $home['propane_fuel']:'';?>">                  
        <input type="hidden" name="water" id="water" value="<?php echo !empty($carbon_data) ? $home['water']:'';?>">   
        <input type="hidden" name="co2_house" id="co2_house" value="<?php echo !empty($carbon_data) ? $home['co2_house']:'';?>">                  
    </div>

    <ul class="tabs" data-tabs id="home-tabs">
        <li class="tabs-title is-active"><a href="#electricpanel" aria-selected="true">Electric</a></li>
        <li class="tabs-title"><a href="#gaspanel">Gas</a></li>
        <li class="tabs-title"><a href="#fuelpanel">Fuel</a></li>
        <li class="tabs-title"><a href="#waterpanel">Water</a></li>
    </ul>

    <div class="tabs-content home-tabs" data-tabs-content="home-tabs">
        <div class="tabs-panel is-active" id="electricpanel">
            <!-- Electric Form -->
            <div class="input-group">
                <span class="input-group-addon electricity"> How many people are in your household? </span>
                <input type="text" name="household" onchange="carbon_electric()" id="household" class="form-control" value="<?php echo !empty($carbon_data) ? $home['household']:'1';?>">
            </div>
            <div class="input-group">
                <span class="input-group-addon electricity"> What is your yearly electricity usage in kWh? </span>
                <input type="text" name="watts" onchange="carbon_electric()" id="watts" class="form-control" value="<?php echo !empty($carbon_data) ? $home['watts']:'';?>">
            </div>

            <div class="input-group">
                <span class="input-group-addon electricity"> Need Help Calculating Your Electric Usage? </span>
                <div class="button" id="show_calc_electric" helper="off"><strong>Click Here</strong></div>
            </div>

            <div class="input-group" id="electric_helper" style="display:none">
                <p> From your electricity bill, pick the lowest and highest months of the consumption over the last year. If you have solar panels, use "Net kWh."</p>
                <span class="input-group-addon electricity"> Enter the kWh from your lowest monthly bill?</span>
                <input type="text" name="low_watts" onchange="carbon_electric()" id="low_watts" value="<?php echo !empty($carbon_data) ? $home['low_watts']:'';?>">
            
                <span class="input-group-addon electricity"> Enter the kWh from your highest monthly bill? </span>
                <input type="text" name="high_watts" onchange="carbon_electric()" id="high_watts" value="<?php echo !empty($carbon_data) ? $home['high_watts']:'';?>">
            </div>
            <!-- .Electric Form -->
        </div>
        <div class="tabs-panel" id="gaspanel">

            <!-- Natural Gas Form -->

            <div class="input-group">
                <span class="input-group-addon electricity"> What is your yearly gas usage? </span>
                <div class="" style="display:inline">
                    <input type="text" name="ngas_usage" onchange="carbon_natural_gas()" id="ngas_usage" value="<?php echo !empty($carbon_data) ? $home['ngas_usage']:'';?>">
                    
                    <select name="gas_unit" id="gas_unit" onchange="carbon_natural_gas()">
                        <option> Select a unit measurement</option>
                        <option value="ccf" <?php echo (!empty($carbon_data) && $home['gas_unit'] == 'ccf') ? 'selected':'';?>>100 cubic feet (CcF)</option>
                        <option value="mcf" <?php echo (!empty($carbon_data) && $home['gas_unit'] == 'mcf') ? 'selected':'';?>>1000 cubic feet (McF)</option>
                        <option value="btu" <?php echo (!empty($carbon_data) && $home['gas_unit'] == 'btu') ? 'selected':'';?>>British Termal Units (Btu)</option>
                        <option value="therms" <?php echo (!empty($carbon_data) && $home['gas_unit'] == 'therms') ? 'selected':'';?>>Therms</option>
                        <option value="kwh" <?php echo (!empty($carbon_data) && $home['gas_unit'] == 'kwh') ? 'selected':'';?>>kWh</option>
                    </select>
                </div>
            </div>

            <div class="input-group">
                <span class="input-group-addon electricity"> Need Help Calculating Your Natural Gas Usage? </span>
                <div class="button" id="show_gas_help" helper="off"><strong>Click Here</strong></div>
            </div>

            <div class="input-group" id="gas_helper" style="display:none">
                <p> From your gas bill, pick the lowest and highest months of consumption over the last year. Don't forget to select a unit measurement from the option above.</p>
                <span class="input-group-addon electricity"> Lowest Month </span>
                <input type="text" name="low_ngas" onchange="carbon_natural_gas()" id="low_ngas" value="<?php echo !empty($carbon_data) ? $home['low_ngas']:'';?>">
            
                <span class="input-group-addon electricity"> Highest Month </span>
                <input type="text" name="high_ngas" onchange="carbon_natural_gas()" id="high_ngas" value="<?php echo !empty($carbon_data) ? $home['high_ngas']:'';?>">
            </div>

            <!-- .Natural Gas Form -->

        </div>
        <div class="tabs-panel" id="fuelpanel">

            <!-- Propane Fuel Form -->

            <div class="input-group">
                <span class="input-group-addon electricity">Total gallons of propane or other fuels used in a year? </span>
                <input type="text" name="fuel_gallon" onchange="carbon_propane_fuel()" id="fuel_gallon" value="<?php echo !empty($carbon_data) ? $home['fuel_gallon']:'';?>">
            </div>

            <div class="input-group">
                <span class="input-group-addon electricity"> Need Help Calculating Your Propane or Other Fuels Usage? </span>
                <div class="button" id="show_propane_help" helper="off"><strong>Click Here</strong></div>
            </div>

            <div class="input-group" id="propane_helper" style="display:none">
                <p> Do you use propane or other fuels for: </p>
                <div class="input-group">
                    <input type="checkbox" name="cooking" onchange="carbon_propane_fuel()" id="cooking" value="1" <?php echo (!empty($carbon_data) && $home['cooking']=='1' )? 'checked':'';?>>
                    <label for="cooking" class="input-group-addon"> Cooking </label>

                </div>
                <div class="input-group">
                    <input type="checkbox" name="drying" onchange="carbon_propane_fuel()" id="drying" placeholder="" value="1" <?php echo (!empty($carbon_data) && $home['drying']=='1' )? 'checked':'';?>>
                    <label for="drying" class="input-group-addon"> Drying </label>
                </div>
                <div class="input-group">
                    <input type="checkbox" name="water_heat" onchange="carbon_propane_fuel()" id="water_heat" placeholder="" value="1" <?php echo (!empty($carbon_data) && $home['water_heat']=='1' )? 'checked':'';?>>
                    <label for="water_heat" class="input-group-addon"> Water Heating </label>
                </div>
            </div>

            <!-- .Propane Fuel Form -->

        </div>
        <div class="tabs-panel" id="waterpanel">

            <!-- Water Form -->
            <div class="input-group">
                <span class="input-group-addon">Total gallons of water consumed in a year? </span>
                <input type="text" name="water_usage" onchange="carbon_water()" id="water_usage" value="<?php echo !empty($carbon_data) ? $home['water_usage']:'';?>">
                <select name="water_unit" id="water_unit" onchange="carbon_water()">
                    <option value="gals" <?php echo (!empty($carbon_data) && $home['water_unit'] == 'gals') ? 'selected':'';?>>Gallons</option>
                    <option value="tgals" <?php echo (!empty($carbon_data) && $home['water_unit'] == 'tgals') ? 'selected':'';?>>Thousand Gallons</option>
                </select>
            </div>

            <div class="input-group">
                <span class="input-group-addon"> Need Help Calculating Your Natural Gas Usage? </span>
                <div class="button" id="show_water_help" helper="off"><strong>Click Here</strong></div>
            </div>

            <div class="input-group" id="water_helper" style="display:none">
                <p> From your water bill, pick the lowest and highest months of consumption over the last year. Don't forget to select a unit measurement from the option above.</p>
                <span class="input-group-addon"> Enter total amount of water consumed from your lowest water bill? </span>
                <input type="text" name="low_water" onchange="carbon_water()" id="low_water" value="<?php echo !empty($carbon_data) ? $home['low_water']:'';?>">
            
                <span class="input-group-addon"> Enter total amount of water consumed from your highest water bill? </span>
                <input type="text" name="high_water" onchange="carbon_water()" id="high_water" value="<?php echo !empty($carbon_data) ? $home['high_water']:'';?>">
            </div>

            <!-- .Water Form -->

        </div>
</div>

</div>