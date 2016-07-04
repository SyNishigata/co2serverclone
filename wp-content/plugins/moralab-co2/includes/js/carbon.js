function total_carbon_transport(){
    var car = isNaN(parseFloat(document.getElementById('car').value)) ? 0.0:parseFloat(document.getElementById('car').value);
    var mcycl = isNaN(parseFloat(document.getElementById('mcycl').value)) ? 0.0:parseFloat(document.getElementById('mcycl').value);
    var bus = isNaN(parseFloat(document.getElementById('bus').value)) ? 0.0:parseFloat(document.getElementById('bus').value);
    var train = isNaN(parseFloat(document.getElementById('train').value)) ? 0.0:parseFloat(document.getElementById('train').value);
    var plane = isNaN(parseFloat(document.getElementById('plane').value)) ? 0.0:parseFloat(document.getElementById('plane').value);
    var co2 = car + mcycl + bus + train + plane;

    jQuery('#co2_travel').val(co2.toFixed(2));
    document.getElementById("travel").innerHTML = co2.toFixed(2);
    jQuery("#distravel").hide();
    jQuery("#anditravel").show();
}

function carbon_car(){
    var total_car_carbon = 0.0;
    var miles = isNaN(parseFloat(document.getElementById('car_miles').value)) ? 0.0:parseFloat(document.getElementById('car_miles').value);
    var efficieny = isNaN(parseFloat(document.getElementById('car_efficiency').value)) ? 0.0:parseFloat(document.getElementById('car_efficiency').value);
    var unit = (document.getElementById('car_unit').value); // selectbox
    var fuel = (document.getElementById('car_fuel').value); // selectbox

    var last_check = isNaN(parseFloat(document.getElementById('car_last').value)) ? 0.0:parseFloat(document.getElementById('car_last').value);
    var current_check = isNaN(parseFloat(document.getElementById('car_current').value)) ? 0.0:parseFloat(document.getElementById('car_current').value);
    var last_date =  document.getElementById('car_last_date').value;
    var current_date = document.getElementById('car_current_date').value;

    if (last_check != '' && current_check != '') {
        var msecs = Date.parse(current_date) - Date.parse(last_date);
        num_days = msecs / 86400000;
        console.log(num_days);

        if (!isNaN(num_days)){
            miles = [(current_check - last_check) / num_days] * 365;
            jQuery('#car_miles').val(miles.toFixed(2));
        }
    }

    if (parseFloat(miles) >= 0.0 && parseFloat(efficieny) >= 0.0){
        if (parseFloat(efficieny) == 0.0 ){
            total_car_carbon = 0.00;
        }
        else {
            switch(fuel){
                case 'gasoline':
                    total_car_carbon = (miles/efficieny) * (2307 + 8874);
                    total_car_carbon += miles * 56;
                    total_car_carbon = total_car_carbon * .000001;
                    break;
                default:
                    total_car_carbon = (miles/efficieny) * (2335 + 10153);
                    total_car_carbon += miles * 56;
                    total_car_carbon = total_car_carbon * .000001;
                    break;
            }

            if (unit != 'miles') {
                total_car_carbon = total_car_carbon * 0.621371;
            }
        }

        jQuery('#car').val(total_car_carbon.toFixed(2));
        total_carbon_transport();
    }
    else {
        jQuery('#car').val(0.00);
        total_carbon_transport();
    }
}

function carbon_mcycl(){
    var total_mcycl_carbon = 0.0;
    var miles = isNaN(parseFloat(document.getElementById('mcycl_miles').value)) ? 0.0:parseFloat(document.getElementById('mcycl_miles').value);
    var cc = (document.getElementById('mcycl_cc').value); // selectbox

    var last_check = isNaN(parseFloat(document.getElementById('mcycl_last').value)) ? 0.0:parseFloat(document.getElementById('mcycl_last').value);
    var current_check = isNaN(parseFloat(document.getElementById('mcycl_current').value)) ? 0.0:parseFloat(document.getElementById('mcycl_current').value);
    var last_date =  document.getElementById('mcycl_last_date').value;
    var current_date = document.getElementById('mcycl_current_date').value;

    if (last_check != '' && current_check != '') {
        var msecs = Date.parse(current_date) - Date.parse(last_date);
        num_days = msecs / 86400000;
        console.log(num_days);

        if (!isNaN(num_days)){
            miles = [(current_check - last_check) / num_days] * 365;
            jQuery('#mcycl_miles').val(miles.toFixed(2));
        }
    }

    if (miles >= 0.0){
        switch(cc){
            case '125':
                total_mcycl_carbon = (miles * 136.794) * .000001;
                break;
            case '375':
                total_mcycl_carbon = (miles * 166.084) * .000001;
                break;
            default:
                total_mcycl_carbon = (miles * 229.802) * .000001;
                break;
        }

        jQuery('#mcycl').val(total_mcycl_carbon.toFixed(2));
        total_carbon_transport();
    }
    else {
            jQuery('#mcycl').val(0.00);
        total_carbon_transport();
    }

}


function carbon_bus(){
    var route_miles = 0.0;
    var total_distance = isNaN(parseFloat(document.getElementById('total_bus_trip').value))? 0.0:parseFloat(document.getElementById('total_bus_trip').value);
    var from = document.getElementById('bfrom').value;
    var to = document.getElementById('bto').value;
    var trips = isNaN(parseInt(document.getElementById('btrips').value))? 0: parseInt(document.getElementById('btrips').value);
    var tripf = (document.getElementById('btrip_freq').value);
    var rt = (document.getElementById('bschool').checked);
    var dist = isNaN(parseFloat(document.getElementById('bdist').value))? 0.0:parseFloat(document.getElementById('bdist').value);
    var count = isNaN(parseInt(document.getElementById('bcount').value))? 0: parseInt(document.getElementById('bcount').value);
    switch(tripf){
        case 'week':
            if (!rt){ route_miles = dist * trips * 52; }
            else{ route_miles = dist * trips * 40; }
            break;
        case 'month':
            if (!rt){ route_miles = dist * trips * 12; }
            else{ route_miles = dist * trips * 8; }
            break;
        default:
            route_miles = dist * trips;     
    }
    
    console.log(route_miles);
    total_distance = total_distance + route_miles;
    carbon_bus_total = total_distance * 1.26 * 300 * 0.000001;
    // TODO: update total distance and carbon distance
    jQuery('#total_bus_trip').val(total_distance.toFixed(2));
    jQuery('#bus').val(carbon_bus_total.toFixed(2));
    total_carbon_transport();
    // Add data to view log and add input fields
    var segment_display = "From " + from + " to " + to + ", " + trips + " times per " + tripf;
    if (rt) { 
        segment_display += " on a school year";
    }
    segment_display += ', ' + route_miles.toFixed(2) + ' miles.  <span onclick="remove_bus_route(' + route_miles.toFixed(2) +  ', ' + count + ')">[Remove]</span>';

    var segment_inputs = '<input type="hidden" name="busfrom[]" value="' + from + '">';
    segment_inputs += '<input type="hidden" name="busto[]" value="' + to + '">';
    segment_inputs += '<input type="hidden" name="bustrips[]" value="' + trips + '">';
    segment_inputs += '<input type="hidden" name="busfreq[]" value="' + tripf + '">';
    segment_inputs += '<input type="hidden" name="bussy[]" value="' + rt + '">';
    segment_inputs += '<input type="hidden" name="busmiles[]" value="' + route_miles.toFixed(2) + '">';

    var segment = '<div id="bus' + count + '"><hr/>' + segment_display + segment_inputs + '</div>';

    count += 1;

    // empty search fields;
    jQuery("#bfrom").val();
    jQuery("#bto").val();
    jQuery("#btrips").val();
    jQuery("#btripf").val('week');


    jQuery('#bcount').val(count);
    jQuery("#bus_routes").append(segment);
}

function remove_bus_route(miles, id){

    var total_distance = isNaN(parseFloat(document.getElementById('total_bus_trip').value))?0.0:parseFloat(document.getElementById('total_bus_trip').value);

    total_distance = total_distance - parseFloat(miles);
    carbon_bus_total = total_distance * 1.26 * 300 * 0.000001;
    jQuery('#total_bus_trip').val(total_distance.toFixed(2));
    jQuery('#bus').val(carbon_bus_total.toFixed(2));
    total_carbon_transport();

    jQuery('#bus'+id).remove();
}

function carbon_train(){
    var route_miles = 0.0;
    var total_distance = isNaN(parseFloat(document.getElementById('total_train_trip').value))? 0.0:parseFloat(document.getElementById('total_train_trip').value);
    var from = document.getElementById('rfrom').value;
    var to = document.getElementById('rto').value;
    var trips = isNaN(parseInt(document.getElementById('rtrips').value))? 0: parseInt(document.getElementById('rtrips').value);
    var freq = (document.getElementById('rfreq').value);
    var rt = (document.getElementById('train_sy').checked);
    var dist = isNaN(parseFloat(document.getElementById('rdist').value))? 0.0:parseFloat(document.getElementById('rdist').value);
    var count = isNaN(parseInt(document.getElementById('rcount').value))? 0: parseInt(document.getElementById('rcount').value);
    
    switch(freq){
        case 'week':
            if (!rt){ route_miles = dist * trips * 52; }
            else{ route_miles = dist * trips * 40; }
            break;
        case 'month':
            if (!rt){ route_miles = dist * trips * 12; }
            else{ route_miles = dist * trips * 8; }
            break;
        default:
            route_miles = dist * trips;     
    }


    //console.log(route_miles);
    total_distance = total_distance + route_miles;
    carbon_plane_total = total_distance * 185 * 1.26 * 0.000001;
    // TODO: update total distance and carbon distance
    jQuery('#total_train_trip').val(total_distance.toFixed(2));
    jQuery('#train').val(carbon_plane_total.toFixed(2));
    total_carbon_transport();
    // Add data to view log and add input fields
    var segment_display = "From " + from + " to " + to + ", " + trips + " times per " + freq;
    if (rt) { 
        segment_display += " on a school year";
    }
    segment_display += ', ' + route_miles.toFixed(2) + ' miles.  <span onclick="remove_train_route(' + route_miles.toFixed(2) +  ', ' + count + ')">[Remove]</span>';

    var segment_inputs = '<input type="hidden" name="trainfrom[]" value="' + from + '">';
    segment_inputs += '<input type="hidden" name="trainto[]" value="' + to + '">';
    segment_inputs += '<input type="hidden" name="traintrips[]" value="' + trips + '">';
    segment_inputs += '<input type="hidden" name="trainfreq[]" value="' + freq + '">';
    segment_inputs += '<input type="hidden" name="trainsy[]" value="' + rt + '">';
    segment_inputs += '<input type="hidden" name="trainmiles[]" value="' + route_miles.toFixed(2) + '">';

    var segment = '<div id="train' + count + '">' + segment_display + segment_inputs + '</div>';

    count += 1;

    // empty search fields;
    jQuery("#rfrom").val();
    jQuery("#rto").val();
    jQuery("#rtrips").val();
    //jQuery("#train_rt").val('proundtrip');


    jQuery('#rcount').val(count);
    jQuery("#train_routes").append(segment);

}

function remove_train_route(miles, id){

    var total_distance = isNaN(parseFloat(document.getElementById('total_train_trip').value))?0.0:parseFloat(document.getElementById('total_train_trip').value);

    total_distance = total_distance - parseFloat(miles);
    carbon_train_total = total_distance * 185 * 1.26 * 0.000001;
    jQuery('#total_train_trip').val(total_distance.toFixed(2));
    jQuery('#train').val(carbon_train_total.toFixed(2));
    total_carbon_transport();

    jQuery('#train'+id).remove();

}


function carbon_plane(){
    var route_miles = 0.0;
    var total_distance = isNaN(parseFloat(document.getElementById('total_plane_trip').value)) ? 0.0:parseFloat(document.getElementById('total_plane_trip').value);
    var from = document.getElementById('pfrom').value;
    var to = document.getElementById('pto').value;
    var trips = isNaN(parseInt(document.getElementById('ptrips').value))? 0: parseInt(document.getElementById('ptrips').value);
    var rt = (document.getElementById('plane_rt').checked);
    var dist = isNaN(parseFloat(document.getElementById('pdist').value))? 0.0:parseFloat(document.getElementById('pdist').value);
    var count = isNaN(parseInt(document.getElementById('pcount').value))? 0: parseInt(document.getElementById('pcount').value);

    if (!rt){
        route_miles = dist * trips;
    }
    else {
        route_miles = dist * trips * 2;
    }


    //console.log(route_miles);
    total_distance = total_distance + route_miles;
    carbon_plane_total = total_distance.toFixed(2) * 223 * 2 * 0.000001;
    // TODO: update total distance and carbon distance
    jQuery('#total_plane_trip').val(total_distance.toFixed(2));
    jQuery('#plane').val(carbon_plane_total.toFixed(2));
    total_carbon_transport();
    // Add data to view log and add input fields
    var segment_display = "From " + from + " to " + to + ", " + trips + " times per year";
    if (rt) { 
        segment_display += " roundtrip";
    }
    segment_display += ', ' + route_miles.toFixed(2) + ' miles.  <span onclick="remove_plane_route(' + route_miles.toFixed(2) +  ', ' + count + ')">[Remove]</span>';

    var segment_inputs = '<input type="hidden" name="planefrom[]" value="' + from + '">';
    segment_inputs += '<input type="hidden" name="planeto[]" value="' + to + '">';
    segment_inputs += '<input type="hidden" name="planetrips[]" value="' + trips + '">';
    segment_inputs += '<input type="hidden" name="planert[]" value="' + rt + '">';
    segment_inputs += '<input type="hidden" name="planemiles[]" value="' + route_miles.toFixed(2) + '">';

    var segment = '<div id="plane' + count + '">' + segment_display + segment_inputs + '</div>';

    count += 1;

    // empty search fields;
    jQuery("#pfrom").val();
    jQuery("#pto").val();
    jQuery("#ptrips").val();
    //jQuery("#plane_rt").val(false);


    jQuery('#pcount').val(count);
    jQuery("#plane_routes").append(segment);

}

function remove_plane_route(miles, id){

    var total_distance = isNaN(parseFloat(document.getElementById('total_plane_trip').value))?0.0:parseFloat(document.getElementById('total_plane_trip').value);

    total_distance = total_distance - parseFloat(miles);
    carbon_plane_total = total_distance * 223 * 2 * 0.000001;
    jQuery('#total_plane_trip').val(total_distance.toFixed(2));
    jQuery('#plane').val(carbon_plane_total.toFixed(2));
    total_carbon_transport();

    jQuery('#plane'+id).remove();


}



function total_carbon_housing(){
    var household_members = isNaN(parseInt(document.getElementById('household').value)) ? 1:parseInt(document.getElementById('household').value);
    var total_electric = isNaN(parseFloat(document.getElementById('electric').value)) ? 0.0:parseFloat(document.getElementById('electric').value);
    var total_natural_gas = isNaN(parseFloat(document.getElementById('natural_gas').value)) ? 0.0:parseFloat(document.getElementById('natural_gas').value);
    var total_propane_fuel = isNaN(parseFloat(document.getElementById('propane_fuel').value)) ? 0.0:parseFloat(document.getElementById('propane_fuel').value);
    var total_water = isNaN(parseFloat(document.getElementById('water').value)) ? 0.0:parseFloat(document.getElementById('water').value);

    var total = (total_electric + total_water + total_natural_gas + total_propane_fuel) / household_members;

    jQuery('#co2_house').val(total.toFixed(2));
    document.getElementById("house").innerHTML = total.toFixed(2);
    jQuery('#dishouse').hide();
    jQuery('#andihouse').show();
}

// isNaN() ? 0.0:

function carbon_electric() {

    var total_carbon_electric = 0.0;
    var watts = isNaN(parseFloat(document.getElementById('watts').value)) ? 0.0:parseFloat(document.getElementById('watts').value);
    var low_watts = isNaN(parseFloat(document.getElementById('low_watts').value)) ? 0.0:parseFloat(document.getElementById('low_watts').value);
    var high_watts = isNaN(parseFloat(document.getElementById('high_watts').value)) ? 0.0:parseFloat(document.getElementById('high_watts').value);


    // calculate watts if helper is set
    if (low_watts != '' || high_watts !=''){
        watts = (low_watts + high_watts) * 6;
        jQuery('#watts').val(watts.toFixed(2));
    }
    
    // TODO: Update Data
    total_carbon_electric = watts * 835 * 1.09 * 0.000001;

    jQuery('#electric').val(total_carbon_electric.toFixed(2));
    total_carbon_housing();
}

function carbon_natural_gas() {
    // total carbon usage
    var total_carbon_natural_gas = parseFloat(document.getElementById('natural_gas').value);

    // calculation variables
    var units = isNaN(document.getElementById('gas_unit').value) ? 'ccf':(document.getElementById('gas_unit').value);
    var natural_gas = isNaN(parseFloat(document.getElementById('ngas_usage').value)) ? 0.0:parseFloat(document.getElementById('ngas_usage').value);
    var low_ngas = isNaN(parseFloat(document.getElementById('low_ngas').value)) ? 0.0:parseFloat(document.getElementById('low_ngas').value);
    var high_ngas = isNaN(parseFloat(document.getElementById('high_ngas').value)) ? 0.0:parseFloat(document.getElementById('high_ngas').value);

    if ( (low_watts > 0.0 ) || (high_watts > 0.0) ){
        switch(units){
            case 'mcf':
                natural_gas += (low_ngas + high_ngas) * 6 * 0.1;
                jQuery("#ngas_usage").val(natural_gas.toFixed(2));
                break;
            case 'btu':
                natural_gas += (low_ngas + high_ngas) * 6 * 102800;
                jQuery("#ngas_usage").val(natural_gas.toFixed(2));
                break;
            case 'therms':
                natural_gas += (low_ngas + high_ngas) * 6 * 1.028;
                jQuery("#ngas_usage").val(natural_gas.toFixed(2));
                break;
            case 'kwh':
                natural_gas += (low_ngas + high_ngas) * 6 * 29.31;
                jQuery("#ngas_usage").val(natural_gas.toFixed(2));
                break;          
            default:
                natural_gas += (low_ngas + high_ngas) * 6;
                jQuery("#ngas_usage").val(natural_gas.toFixed(2));
                break;
        };
    }
    total_carbon_natural_gas = (natural_gas / 100) * 54.7 * 1.14 * 0.000001;
    jQuery('#natural_gas').val(total_carbon_natural_gas.toFixed(2));
    total_carbon_housing();
}

function carbon_propane_fuel() {
    var gallons = isNaN(parseFloat(document.getElementById('fuel_gallon').value)) ? 0.0:parseFloat(document.getElementById('fuel_gallon').value);

    var cooking = (document.getElementById('cooking').checked);
    var drying = (document.getElementById('drying').checked);
    var water_heat = (document.getElementById('water_heat').checked);

    if (cooking == true){ gallons += 50; }
    if (drying == true) { gallons += 100; }
    if (water_heat == true) { gallons += 350; }

    if (gallons > 0){
        total_carbon_propane_fuel = gallons * 8362 * 0.000001;
    }
    jQuery('#fuel_gallon').val(gallons.toFixed(2));
    jQuery('#propane_fuel').val(total_carbon_propane_fuel.toFixed(2));
    total_carbon_housing();
}


function carbon_water() {

    var total_carbon_water = 0.0;
    var water_usage = isNaN(parseFloat(document.getElementById('water_usage').value)) ? 0.0:parseFloat(document.getElementById('water_usage').value);

    var units = (document.getElementById('water_unit').value);
    var low_water = isNaN(parseFloat(document.getElementById('low_water').value)) ? 0.0:parseFloat(document.getElementById('low_water').value);
    var high_water = isNaN(parseFloat(document.getElementById('high_water').value)) ? 0.0:parseFloat(document.getElementById('high_water').value);

    if (low_water > 0 || high_water > 0 ){
        water_usage = (low_water + high_water) * 6;
        jQuery('#water_usage').val(water_usage.toFixed(2));
    }


    //if (water_usage > 0){
        switch(units){
            case 'tgals':
                total_carbon_water = water_usage * 1000 * 4.082 * 0.000001;
                break;
            default:
                total_carbon_water = water_usage * 4.082 * 0.000001;
                break;
        }
    //}


    jQuery('#water').val(total_carbon_water.toFixed(2));
    total_carbon_housing();
}

function carbon_food(){
    var food = 0.0;
    var lamb = isNaN(parseFloat(document.getElementById('lamb').value)) ? 0.0:parseFloat(document.getElementById('lamb').value)*0.11*52;
    var beef = isNaN(parseFloat(document.getElementById('beef').value)) ? 0.0:parseFloat(document.getElementById('beef').value)*0.11*52;
    var pork = isNaN(parseFloat(document.getElementById('pork').value)) ? 0.0:parseFloat(document.getElementById('pork').value)*0.11*52;
    var fish = isNaN(parseFloat(document.getElementById('fish').value)) ? 0.0:parseFloat(document.getElementById('fish').value)*0.11*52;
    var poultry = isNaN(parseFloat(document.getElementById('poultry').value)) ? 0.0:parseFloat(document.getElementById('poultry').value)*0.11*52;
	// Begin Sy's Edits: Commented out this variable because I changed 'veggies' to 'veggiesyes' and 'veggiesno'
	// var veggies = (document.getElementById('veggies').value);
	// End Sy's Edits
	
    food = 0.9 + (lamb*3.92*0.001) + (beef*27*0.001) + (pork*12.1*0.001) + (fish*11.9*0.001) + (poultry*6.9*0.001);
    jQuery('#co2_food').val(food.toFixed(2));
    document.getElementById("food").innerHTML = food.toFixed(2);
    jQuery('#disfood').hide();
    jQuery('#andifood').show();
}

// Begin Sy's Edits

/* Function for the 'veggies' radio button selection */
function carbon_veggies(){
	var food = 0.9;

	/* If vegetarian is checked, then hide all the other food inputs and
	 * reset all of their values to 0
	 */
	if(jQuery('#veggiesyes').is(':checked')) {
		jQuery('#lamb').val("0");
		jQuery('#beef').val("0");
		jQuery('#pork').val("0");
		jQuery('#fish').val("0");
		jQuery('#poultry').val("0");
		
		jQuery('#hiddenfoodinput').hide();

	}
	
	/* If vegetarian is not checked, then show all the other food inputs */
	if(jQuery('#veggiesno').is(':checked')) {
		jQuery('#hiddenfoodinput').show();
	}

    jQuery('#co2_food').val(food.toFixed(2));
    document.getElementById("food").innerHTML = food.toFixed(2);
    jQuery('#disfood').hide();
    jQuery('#andifood').show();
}

// End Sy's Edits


function carbon_recycle(){
    var co2_recycle = 1.2;

    var recyling = (document.getElementById('recycling').value);
    var compost = (document.getElementById('compost').value);

    if (recyling == 'a'){
        co2_recycle += 0;
    }
    else if (recyling == 'b'){
        co2_recycle -= 0.2;
    }
    else {
        co2_recycle -= 0.5;
    }


    if (compost == 'a'){
        co2_recycle += 0;
    }
    else if (compost == 'b'){
        co2_recycle -= 0.1;
    }
    else {
        co2_recycle -= 0.3;
    }


    jQuery('#co2_recycle').val(co2_recycle.toFixed(2));
    document.getElementById("recycle").innerHTML = co2_recycle.toFixed(2);
    jQuery('#disrecycle').hide();
    jQuery('#andirecycle').show();
}

jQuery("#show_calc_car").on("click", function(){
    if (jQuery(this).attr("helper") == "off"){
        jQuery(this).attr("helper", "on");
        jQuery("#car_helper").show();
    }
    else {
        jQuery(this).attr("helper", "off");
        jQuery("#car_helper").hide();
    }
});

jQuery("#show_calc_mcycl").on("click", function(){
    if (jQuery(this).attr("helper") == "off"){
        jQuery(this).attr("helper", "on");
        jQuery("#mcycl_helper").show();
    }
    else {
        jQuery(this).attr("helper", "off");
        jQuery("#mcycl_helper").hide();
    }
});



jQuery("#show_calc_electric").on("click", function(){
    if (jQuery(this).attr("helper") == "off"){
        jQuery(this).attr("helper", "on");
        jQuery("#electric_helper").show();
    }
    else {
        jQuery(this).attr("helper", "off");
        jQuery("#electric_helper").hide();
    }
});

jQuery("#show_gas_help").on("click", function(){
    if (jQuery(this).attr("helper") == "off"){
        jQuery(this).attr("helper", "on");
        jQuery("#gas_helper").show();
    }
    else {
        jQuery(this).attr("helper", "off");
        jQuery("#gas_helper").hide();
    }
});

jQuery("#show_propane_help").on("click", function(){
    if (jQuery(this).attr("helper") == "off"){
        jQuery(this).attr("helper", "on");
        jQuery("#propane_helper").show();
    }
    else {
        jQuery(this).attr("helper", "off");
        jQuery("#propane_helper").hide();
    }
    
});

jQuery("#show_water_help").on("click", function(){
    if (jQuery(this).attr("helper") == "off"){
        jQuery(this).attr("helper", "on");
        jQuery("#water_helper").show();
    }
    else {
        jQuery(this).attr("helper", "off");
        jQuery("#water_helper").hide();
    }
    
});


// Begin Sy's Edits

/* Sy's Edits: Edited this function */
jQuery("div.donext").on("click", function(){
	/* Sy's Edits: If the next button is clicked when on Travel Form, then it will switch between 
	 *             the travel tabs instead of going straight to the Home Form. 
	 */
    if (jQuery(this).hasClass("fromtravel")) {
        //jQuery('#example-tabs div a')[1].click();    //old interaction
		
		var activeTravelTab = jQuery('#travel-tabs .is-active').text();
		switch(activeTravelTab){
			case "Car": 		jQuery('#travel-tabs li')[1].click();
								break;
								
			case "Motorcyle": 	jQuery('#travel-tabs li')[2].click();
								break;
								
			case "Bus": 		jQuery('#travel-tabs li')[3].click();
								break;
								
			case "Train": 		jQuery('#travel-tabs li')[4].click();
								break;
								
			default: 			jQuery('#example-tabs div a')[1].click();
								break;
		}
    }
	/* Sy's Edits: If the next button is clicked when on Home Form, then it will switch between 
	 *             the home tabs instead of going straight to the Food Form. 
	 */
    else if (jQuery(this).hasClass("fromhome")) {
        //jQuery('#example-tabs div a')[2].click();     //old interaction
		
		var activeHomeTab = jQuery('#home-tabs .is-active').text();
		switch(activeHomeTab){
			case "Electric": 	jQuery('#home-tabs li')[1].click();
								break;
								
			case "Gas": 		jQuery('#home-tabs li')[2].click();
								break;
								
			case "Fuel": 		jQuery('#home-tabs li')[3].click();
								break;
								
			default: 			jQuery('#example-tabs div a')[2].click();
								break;
		}
    }
    else {
        jQuery('#example-tabs div a')[3].click();
    }
});

// End Sy's Edits

jQuery( ".datepick" ).datepicker();