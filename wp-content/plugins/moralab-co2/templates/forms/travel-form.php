<?php global $carbon_data;

$travel = get_post_meta($carbon_data['ID'], 'travel_data', true);
$makes = get_car_make();

if (!empty($travel['car_make']) && !empty($travel['car_model']) && !empty($travel['car_year'])):
    $models = get_car_model($travel['car_make']);
    $years = get_car_year($travel['car_make'], $travel['car_model']);
endif;
?>

<div class="form-group">

    <div class="input-group">
        <input type="hidden" name="car" id="car" value="<?php echo !empty($carbon_data) ? $travel['car'] : '' ?>">
        <input type="hidden" name="mcycl" id="mcycl" value="<?php echo !empty($carbon_data) ? $travel['mcycl'] : '' ?>">
        <input type="hidden" name="bus" id="bus" value="<?php echo !empty($carbon_data) ? $travel['bus'] : '' ?>">
        <input type="hidden" name="train" id="train" value="<?php echo !empty($carbon_data) ? $travel['train'] : '' ?>">
        <input type="hidden" name="plane" id="plane" value="<?php echo !empty($carbon_data) ? $travel['plane'] : '' ?>">
        <input type="hidden" name="co2_travel" id="co2_travel"
               value="<?php echo !empty($carbon_data) ? $travel['co2_travel'] : '' ?>">
    </div>

    <ul class="tabs" data-tabs id="travel-tabs">
        <li class="tabs-title is-active"><a href="#carpanel" aria-selected="true">Car</a></li>
        <li class="tabs-title"><a href="#bikepanel">Motorcyle</a></li>
        <li class="tabs-title"><a href="#buspanel" onblur="mapInit('busmap', 'bfrom', 'bto', 'bdist')">Bus</a></li>
        <li class="tabs-title"><a href="#trainpanel" onblur="mapInit('trainmap', 'rfrom', 'rto', 'rdist')">Train</a>
        </li>
        <li class="tabs-title"><a href="#planepanel" onblur="mapInit('planemap', 'pfrom', 'pto' , 'pdist')">Plane</a>
        </li>
    </ul>

    <div class="tabs-content home-tabs" data-tabs-content="travel-tabs">
        <div class="tabs-panel is-active" id="carpanel">
            <!-- Car Form -->
            <div class="input-group">
                <span class="input-group-addon"> What is your total year's car mileage? </span>
                <div class="row">
                    <div class="small-7 columns">
                        <input type="text" name="car_miles" onchange="carbon_car()" id="car_miles" class="form-control"
                               value="<?php echo !empty($carbon_data) ? $travel['car_miles'] : '' ?>">
                    </div>
                    <div class="small-5 columns">
                        <select name="car_unit" onchange="carbon_car()" id="car_unit"
                                class="form-control" <?php echo !empty($carbon_data) ? $travel['car_unit'] : '' ?>>
                            <option
                                value="miles" <?php echo (!empty($carbon_data) && $travel['car_unit'] == 'miles') ? 'selected' : '' ?>>
                                miles
                            </option>
                            <option
                                value="km" <?php echo (!empty($carbon_data) && $travel['car_unit'] == 'km') ? 'selected' : '' ?>>
                                km
                            </option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="input-group">
                <span class="input-group-addon"> Need Help Calculating Your Car Mileage? </span>
                <div class="button" id="show_calc_car" helper="off"><strong>Click Here</strong></div>
            </div>

            <div class="input-group" id="car_helper" style="display:none">
                <div class="row">
                    <div class="small-6 columns">
                        <span class="input-group-addon"> Vehicle mileage at last safety/oil check</span>
                        <input type="text" min="0" name="car_last" onchange="carbon_car()" id="car_last"
                               value="<?php echo !empty($carbon_data) ? $travel['car_last'] : '' ?>">
                    </div>
                    <div class="small-6 columns">
                        <span class="input-group-addon"> Enter the date of last check</span>
                        <input type="text" name="car_last_date" onchange="carbon_car()" id="car_last_date"
                               value="<?php echo !empty($carbon_data) ? $travel['car_last_date'] : '' ?>"
                               class="datepick">
                    </div>
                </div>
                <div class="row">
                    <div class="small-6 columns">
                        <span class="input-group-addon"> Current vehicle mileage </span>
                        <input type="text" min="0" name="car_current" onchange="carbon_car()" id="car_current"
                               value="<?php echo !empty($carbon_data) ? $travel['car_current'] : '' ?>">
                    </div>
                    <div class="small-6 columns">
                        <span class="input-group-addon"> Enter the date of current safety/oil check</span>
                        <input type="text" name="car_current_date" onchange="carbon_car()" id="car_current_date"
                               value="<?php echo !empty($carbon_data) ? $travel['car_current_date'] : '' ?>"
                               class="datepick">
                    </div>
                </div>
            </div>

            <div class="input-group">
                <span class="input-group-addon"> Select the fuel type for your car? </span>
                <select name="car_fuel" onchange="carbon_car()" id="car_fuel" class="form-control">
                    <option
                        value="gasoline" <?php echo (!empty($carbon_data) && $travel['car_fuel'] == 'gasoline') ? 'selected' : '' ?>>
                        gasoline
                    </option>
                    <option
                        value="other" <?php echo (!empty($carbon_data) && $travel['car_fuel'] == 'diesel') ? 'selected' : '' ?>>
                        diesel
                    </option>
                </select>
            </div>

            <div class="input-group">
                <span class="input-group-addon"> What is your car's fuel efficiency? </span>
                <input type="text" name="car_efficiency" onchange="carbon_car()" id="car_efficiency"
                       class="form-control" value="<?php echo !empty($carbon_data) ? $travel['car_efficiency'] : '' ?>">
                <div class="row">
                    <div class="small-4 large-4 columns">
                        <select id="car_make" name="car_make" onchange="get_car_models()">
                            <option>Select a Make</option>
                            <?php foreach ($makes as $make) {
                                if ($travel['car_make'] == $make->make) {
                                    $selected = "selected";
                                } else {
                                    $selected = "";
                                }
                                echo '<option value="' . $make->make . '" ' . $selected . '>' . $make->make . '</option>';
                            } ?>
                        </select>
                    </div>
                    <div class="small-4 large-4 columns">
                        <select id="car_model" name="car_model"
                                onchange="get_car_years()" <?php echo (!empty($travel['car_model'])) ? '' : 'disabled'; ?> >
                            <option>Model</option>
                            <?php
                            if (!empty($travel['car_model'])):
                                foreach ($models as $model) {
                                    if ($travel['car_model'] == $model->model) {
                                        $selected = "selected";
                                    } else {
                                        $selected = "";
                                    }
                                    echo '<option value="' . $model->model . '"' . $selected . '>' . $model->model . '</option>';
                                }
                            endif;
                            ?>
                        </select>
                    </div>
                    <div class="small-4 large-4 columns">
                        <select id="car_year" name="car_year"
                                onchange="get_car_efficiency()" <?php echo (!empty($travel['car_year'])) ? '' : 'disabled'; ?> >
                            <option>Year</option>
                            <?php
                            if (!empty($travel['car_year'])):
                                foreach ($years as $year) {
                                    if ($travel['car_year'] == $year->year) {
                                        $selected = "selected";
                                    } else {
                                        $selected = "";
                                    }
                                    echo '<option value="' . $year->year . '"' . $selected . '>' . $year->year . '</option>';
                                }
                            endif;
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <!-- .Car Form -->
        </div>
        <div class="tabs-panel" id="bikepanel">

            <!-- Motorcycle Form -->

            <div class="input-group">
                <span class="input-group-addon"> What is your total year&#39;s motorcycle mileage? </span>
                <input type="text" name="mcycl_miles" onchange="carbon_mcycl()" id="mcycl_miles" class="form-control"
                       value="<?php echo !empty($carbon_data) ? $travel['mcycl_miles'] : '' ?>">
            </div>

            <div class="input-group">
                <span class="input-group-addon"> What is the CC of your motorcycle? </span>
                <select name="mcycl_cc" onchange="carbon_mcycl()" id="mcycl_cc" class="form-control"
                        value="<?php echo !empty($carbon_data) ? $travel['mcycl_cc'] : '' ?>">
                    <option value="125">&lt;125</option>
                    <option value="375">125-500</option>
                    <option value="500">&gt;500</option>
                </select>
            </div>

            <div class="input-group">
                <span class="input-group-addon"> Need Help Calculating Your Motorcycle Mileage? </span>
                <div class="button" id="show_calc_mcycl" helper="off"><strong>Click Here</strong></div>
            </div>

            <div class="input-group" id="mcycl_helper" style="display:none">
                <div class="row">
                    <div class="small-6 columns">
                        <span class="input-group-addon"> Motorcycle mileage at last safety/oil check</span>
                        <input type="text" min="0" name="mcycl_last" onchange="carbon_mcycl()" id="mcycl_last"
                               value="<?php echo !empty($carbon_data) ? $travel['mcycl_last'] : '' ?>">
                    </div>
                    <div class="small-6 columns">
                        <span class="input-group-addon"> Enter the date of last check</span>
                        <input type="text" name="mcycl_last_date" onchange="carbon_mcycl()" id="mcycl_last_date"
                               value="<?php echo !empty($carbon_data) ? $travel['mcycl_last_date'] : '' ?>"
                               class="datepick">
                    </div>
                </div>
                <div class="row">
                    <div class="small-6 columns">
                        <span class="input-group-addon"> Current motorcycle mileage </span>
                        <input type="text" min="0" name="mcycl_current" onchange="carbon_mcycl()" id="mcycl_current"
                               value="<?php echo !empty($carbon_data) ? $travel['mcycl_current'] : '' ?>">
                    </div>
                    <div class="small-6 columns">
                        <span class="input-group-addon"> Enter the date of current safety/oil check</span>
                        <input type="text" name="mcycl_current_date" onchange="carbon_mcycl()" id="mcycl_current_date"
                               value="<?php echo !empty($carbon_data) ? $travel['mcycl_current_date'] : '' ?>"
                               class="datepick">
                    </div>
                </div>
            </div>

            <!-- .Motorcycle Form -->

        </div>
        <div class="tabs-panel" id="buspanel">

            <!-- Bus Form -->
            <span class="input-group-addon"><h3>Bus Routes</h3></span>
            <div class="row">
                <div class="medium-6 large-6 columns">
                    <div class="input-group row">
                        <div class="small-2 columns">
                            <span class="input-group-addon">From</span>
                        </div>
                        <div class="small-10 columns">
                            <input type="text" name="bfrom" id="bfrom" value="">
                        </div>
                    </div>
                    <div class="input-group row">
                        <div class="small-2 columns">
                            <span class="input-group-addon">To</span>
                        </div>
                        <div class="small-10 columns">
                            <input type="text" name="bto" id="bto" value="">
                        </div>
                    </div>
                    <div class="input-group row">
                        <div class="small-4 columns">I make this trip</div>
                        <div class="small-3 columns"><input type="text" name="btrips" id="btrips" value="" length="4">
                        </div>
                        <div class="small-1 columns">per</div>
                        <div class="small-4 columns"><select name="btrip_freq" id="btrip_freq" value="">
                                <option value="week">week</option>
                                <option value="month">month></option>
                                <option value="year">year></option>
                            </select></div>
                    </div>
                    <div class="input-group row">
                        <div class="small-4 columns">School Year Only</div>
                        <div class="small-8 columns"><input type="checkbox" name="bschool" id="bschool" length="4"
                                                            value="1"></div>
                    </div>
                    <div class="input-group row">
                        <div class="button" id="add_bus_route" onclick="carbon_bus()">Add Route</div>
                        <input type="hidden" name="bdist" id="bdist" value="">
                        <input type="hidden" name="bcount" id="bcount"
                               value="<?php echo !empty($carbon_data) ? sizeof($travel['busfrom']) : '0' ?>">
                    </div>

                </div>
                <div class="medium-6 large-6 columns">

                    <div id="busmap"></div>
                </div>
            </div>
            <div class="row">
                <input type="hidden" name="total_bus_trip" id="total_bus_trip"
                       vale="<?php echo !empty($carbon_data) ? $travel['total_bus_trip'] : '0' ?>">
                <div class="routes" id="bus_routes">
                    <?php if (!empty($travel['busfrom'])) {
                        $max = sizeof($travel['busfrom']);
                        for ($i = 0; $i < $max; $i++) { ?>
                            <div id="bus<?php echo $i; ?>">
                                From <?php echo $travel['busfrom'][$i]; ?> to <?php echo $travel['busto'][$i]; ?>,
                                <?php echo $travel['bustrips'][$i]; ?> times per <?php echo $travel['busfreq'][$i]; ?>
                                <?php echo ($travel['bussy'][$i] == '1') ? ' on a school year' : ''; ?>,
                                <?php echo $travel['busmiles'][$i]; ?> miles.
                                <span onclick="remove_bus_route(<?php echo $travel['busmiles'][$i] . ',' . $i; ?>)">[Remove]</span>
                                <input type="hidden" name="busfrom[]" value="<?php echo $travel['busfrom'][$i]; ?>">
                                <input type="hidden" name="busto[]" value="<?php echo $travel['busto'][$i]; ?>">
                                <input type="hidden" name="bustrips[]" value="<?php echo $travel['bustrips'][$i]; ?>">
                                <input type="hidden" name="busfreq[]" value="<?php echo $travel['busfreq'][$i]; ?>">
                                <input type="hidden" name="bussy[]" value="<?php echo $travel['bussy'][$i]; ?>">
                                <input type="hidden" name="busmiles[]" value="<?php echo $travel['busmiles'][$i]; ?>">
                            </div>
                        <?php }
                    } ?>
                </div>
            </div>
            <!-- .Bus Form -->

        </div>
        <div class="tabs-panel" id="trainpanel">

            <!-- Train Form -->
            <span class="input-group-addon"><h3>Train Routes</h3></span>
            <div class="row">
                <div class="medium-6 large-6 columns">
                    <div class="input-group row">
                        <div class="small-2 columns">
                            <span class="input-group-addon">From</span>
                        </div>
                        <div class="small-10 columns">
                            <input type="text" name="rfrom" id="rfrom" value="">
                        </div>
                    </div>
                    <div class="input-group row">
                        <div class="small-2 columns">
                            <span class="input-group-addon">To</span>
                        </div>
                        <div class="small-10 columns">
                            <input type="text" name="rto" id="rto" value="">
                        </div>
                    </div>
                    <div class="input-group row">
                        <div class="small-4 columns">I make this trip</div>
                        <div class="small-3 columns"><input type="text" min="0" name="rtrips" id="rtrips" value=""
                                                            length="4"></div>
                        <div class="small-1 columns">per</div>
                        <div class="small-4 columns"><select name="rfreq" id="rfreq">
                                <option value="week">week</option>
                                <option value="month">month></option>
                                <option value="year">year></option>
                            </select>
                        </div>
                    </div>
                    <div class="input-group row">
                        <div class="small-4 columns">School Year Only</div>
                        <div class="small-8 columns"><input type="checkbox" name="train_sy" id="train_sy" length="4">
                        </div>
                    </div>
                    <div class="input-group row">
                        <div class="button" id="add_train_route" onclick="carbon_train()">Add Route</div>
                        <input type="hidden" name="total_train_trip" id="total_train_trip"
                               value="<?php echo !empty($carbon_data) ? $travel['total_train_trip'] : '0' ?>">
                        <input type="hidden" name="rcount" id="rcount"
                               value="<?php echo !empty($carbon_data) ? sizeof($travel['trainfrom']) : '0' ?>">
                        <input type="hidden" name="rdist" id="rdist" value="">
                    </div>

                </div>
                <div class="medium-6 large-6 columns">

                    <div id="trainmap"></div>
                </div>
            </div>
            <div class="row">
                <div class="routes" id="train_routes">
                    <?php if (!empty($travel['trainfrom'])) {
                        $max = sizeof($travel['trainfrom']);
                        for ($i = 0; $i < $max; $i++) { ?>
                            <div id="train<?php echo $i; ?>">
                                From <?php echo $travel['trainfrom'][$i]; ?> to <?php echo $travel['trainto'][$i]; ?>,
                                <?php echo $travel['traintrips'][$i]; ?> times
                                per <?php echo $travel['trainfreq'][$i]; ?>
                                <?php echo ($travel['trainsy'][$i] == '1') ? ' on a school year' : ''; ?>,
                                <?php echo $travel['trainmiles'][$i]; ?> miles.
                                <span onclick="remove_train_route(<?php echo $travel['trainmiles'][$i] . ',' . $i; ?>)">[Remove]</span>
                                <input type="hidden" name="trainfrom[]" value="<?php echo $travel['trainfrom'][$i]; ?>">
                                <input type="hidden" name="trianto[]" value="<?php echo $travel['trainto'][$i]; ?>">
                                <input type="hidden" name="traintrips[]"
                                       value="<?php echo $travel['traintrips'][$i]; ?>">
                                <input type="hidden" name="trainfreq[]" value="<?php echo $travel['trainfreq'][$i]; ?>">
                                <input type="hidden" name="triansy[]" value="<?php echo $travel['trainsy'][$i]; ?>">
                                <input type="hidden" name="trainmiles[]"
                                       value="<?php echo $travel['trainmiles'][$i]; ?>">
                            </div>
                        <?php }
                    } ?>

                </div>
            </div>
            <!-- .Train Form -->

        </div>
        <div class="tabs-panel" id="planepanel">

            <!-- Plane Form -->
            <span class="input-group-addon"><h3>Flight Routes</h3></span>
            <div class="row">
                <div class="medium-6 large-6 columns">
                    <div class="input-group row">
                        <div class="small-2 columns">
                            <span class="input-group-addon">From</span>
                        </div>
                        <div class="small-10 columns">
                            <input type="text" name="pfrom" id="pfrom" value="">
                        </div>
                    </div>
                    <div class="input-group row">
                        <div class="small-2 columns">
                            <span class="input-group-addon">To</span>
                        </div>
                        <div class="small-10 columns">
                            <input type="text" name="pto" id="pto" value="">
                        </div>
                    </div>
                    <div class="input-group row">
                        <div class="small-9 columns">How often do you make this trip per year?</div>
                        <div class="small-3 columns"><input type="text" name="ptrips" id="ptrips" value="" length="4">
                        </div>
                    </div>
                    <div class="input-group row">
                        <div class="small-3 columns">Roundtrip</div>
                        <div class="small-9 columns"><input type="checkbox" name="plane_rt" id="plane_rt" length="4">
                        </div>
                    </div>
                    <div class="input-group row">
                        <div class="button" id="add_plane_route" onclick="carbon_plane()">Add Route</div>
                        <input type="hidden" name="pdist" id="pdist">
                        <input type="hidden" name="pcount" id="pcount"
                               value="<?php echo !empty($carbon_data) ? sizeof($travel['planefrom']) : '0' ?>">
                        <input type="hidden" name="total_plane_trip" id="total_plane_trip"
                               value="<?php echo !empty($carbon_data) ? $travel['total_plane_trip'] : '0' ?>">
                    </div>

                </div>
                <div class="medium-6 large-6 columns">
                    <div id="planemap"></div>
                </div>
            </div>
            <div class="row">
                <div class="routes" id="plane_routes">
                    <?php if (!empty($travel['planefrom'])) {
                        $max = sizeof($travel['planefrom']);
                        for ($i = 0; $i < $max; $i++) { ?>
                            <div id="plane<?php echo $i; ?>">
                                From <?php echo $travel['planefrom'][$i]; ?> to <?php echo $travel['planeto'][$i]; ?>,
                                <?php echo $travel['planetrips'][$i]; ?> times per year
                                <?php echo ($travel['planert'][$i] == '1') ? ' round trip' : ''; ?>,
                                <?php echo $travel['planemiles'][$i]; ?> miles.
                                <span onclick="remove_plane_route(<?php echo $travel['planemiles'][$i] . ',' . $i; ?>)">[Remove]</span>
                                <input type="hidden" name="planefrom[]" value="<?php echo $travel['planefrom'][$i]; ?>">
                                <input type="hidden" name="planeto[]" value="<?php echo $travel['planeto'][$i]; ?>">
                                <input type="hidden" name="planetrips[]"
                                       value="<?php echo $travel['planetrips'][$i]; ?>">
                                <input type="hidden" name="planert[]" value="<?php echo $travel['planert'][$i]; ?>">
                                <input type="hidden" name="planemiles[]"
                                       value="<?php echo $travel['planemiles'][$i]; ?>">
                            </div>
                        <?php }
                    } ?>
                </div>
            </div>

            <!-- .Plane Form -->

        </div>

    </div>

</div>

<script type="text/javascript">
    var busmap, trainmap, planemap;
    var cityMarkers = [];
    var flightMarkers = [];
    var flightPath;

    function mapInit(map_canvas, from, to, dist) {
        var map = map_canvas;
        var origin_place_id = null;
        var destination_place_id = null;
        var directionsDisplay;
        var directionsService = new google.maps.DirectionsService;
        var geocoder;
        var autoOptions = {};
        var distanceInput = dist;
        if (map_canvas == 'planemap') {
            autoOptions = {
                types: ['(cities)']
            };
        }


        for (var i = 0; i < cityMarkers.length; i++) {
            cityMarkers[i].setMap(null);
        }
        cityMarkers = [];

        for (var i = 0; i < flightMarkers.length; i++) {
            flightMarkers[i].setMap(null);
        }
        flightMarkers = [];

        var inputFrom = document.getElementById(from);
        var from_autocomplete = new google.maps.places.Autocomplete(inputFrom, autoOptions);
        var inputTo = document.getElementById(to);
        var dest_autocomplete = new google.maps.places.Autocomplete(inputTo, autoOptions);
        geocoder = new google.maps.Geocoder();
        directionsDisplay = new google.maps.DirectionsRenderer;

        var center_map = new google.maps.LatLng(41.850033, -87.6500523);
        if (map_canvas == 'busmap') {
            busmap = new google.maps.Map(document.getElementById(map_canvas),
                {
                    zoom: 2,
                    zoomControl: true,
                    streetViewControl: false,
                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                    center: center_map
                });
            directionsDisplay.setMap(busmap);
            from_autocomplete.bindTo('bounds', busmap);
            dest_autocomplete.bindTo('bounds', busmap);
        }
        else if (map_canvas == 'trainmap') {
            trainmap = new google.maps.Map(document.getElementById(map_canvas),
                {
                    zoom: 2,
                    zoomControl: true,
                    streetViewControl: false,
                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                    center: center_map
                });
            directionsDisplay.setMap(trainmap);
            from_autocomplete.bindTo('bounds', trainmap);
            dest_autocomplete.bindTo('bounds', trainmap);
        }
        else {
            planemap = new google.maps.Map(document.getElementById(map_canvas),
                {
                    zoom: 2,
                    zoomControl: true,
                    streetViewControl: false,
                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                    center: center_map
                });
            directionsDisplay.setMap(planemap);
            from_autocomplete.bindTo('bounds', planemap);
            dest_autocomplete.bindTo('bounds', planemap);
            //route(planemap, inputFrom.value, inputTo.value, directionsService, directionsDisplay, distanceInput);
        }

        function expandViewportToFitPlace(map, place) {
            if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
            }
            else {

                map.setCenter(place.geometry.location);
                map.setZoom(17);
            }
        }

        from_autocomplete.addListener('place_changed', function () {
            var place = from_autocomplete.getPlace();
            if (!place.geometry) {
                return;
            }
            var markers;

            switch (map_canvas) {
                case 'busmap':

                    var marker = new google.maps.Marker({
                        map: busmap,
                        position: place.geometry.location
                    });
                    cityMarkers.push(marker);
                    expandViewportToFitPlace(busmap, place);
                    break;
                case 'trainmap':
                    var marker = new google.maps.Marker({
                        map: trainmap,
                        position: place.geometry.location
                    });
                    cityMarkers.push(marker);
                    expandViewportToFitPlace(trainmap, place);
                    break;
                default:
                    var marker = new google.maps.Marker({
                        map: planemap,
                        position: place.geometry.location
                    });
                    flightMarkers.push(marker);
                    expandViewportToFitPlace(planemap, place);
                    break;
            }

            // If the place has a geometry, store its place ID and route if we have
            // the other place ID
            origin_place_id = place.place_id;

            if (!isNaN(inputTo.value)) {
                var request = {
                    location: center_map,
                    radius: '25',
                    query: inputTo.value
                };

                var service = new google.maps.places.PlacesService(map);
                service.textSearch(request, function (results, status) {
                    if (status == google.maps.places.PlacesServiceStatus.OK) {
                        destination_place_id = results[0].place_id;
                    }
                });
            }

            route(map, origin_place_id, destination_place_id,
                directionsService, directionsDisplay, distanceInput);
        });

        dest_autocomplete.addListener('place_changed', function () {
            var place = dest_autocomplete.getPlace();
            if (!place.geometry) {
                return;
            }
            var markers;
            switch (map_canvas) {
                case 'busmap':
                    var marker = new google.maps.Marker({
                        map: busmap,
                        position: place.geometry.location
                    });

                    cityMarkers.push(marker);
                    expandViewportToFitPlace(busmap, place);
                    break;
                case 'trainmap':
                    var marker = new google.maps.Marker({
                        map: trainmap,
                        position: place.geometry.location
                    });
                    cityMarkers.push(marker);
                    markers = cityMarkers;
                    expandViewportToFitPlace(trainmap, place);
                    break;
                default:
                    var marker = new google.maps.Marker({
                        map: planemap,
                        position: place.geometry.location
                    });
                    flightMarkers.push(marker);
                    expandViewportToFitPlace(planemap, place);
                    break;
            }

            // If the place has a geometry, store its place ID and route if we have
            // the other place ID
            destination_place_id = place.place_id;

            if (!isNaN(inputFrom.value)) {
                var request = {
                    location: center_map,
                    radius: '25',
                    query: inputTo.value
                };

                var service = new google.maps.places.PlacesService(map);
                service.textSearch(request, function (results, status) {
                    if (status == google.maps.places.PlacesServiceStatus.OK) {
                        origin_place_id = results[0].place_id;
                    }
                });
            }

            route(map, origin_place_id, destination_place_id,
                directionsService, directionsDisplay, distanceInput);
        });

        function route(map, origin_place_id, destination_place_id, directionsService, directionsDisplay, distance) {
            if (!origin_place_id || !destination_place_id) {
                return;
            }
            var distanceInput = document.getElementById(distance);
            var travelMode = google.maps.DirectionsTravelMode.TRANSIT;

            if (map == 'busmap' || map == 'trainmap') {
                for (var i = 0; i < cityMarkers.length; i++) {
                    cityMarkers[i].setMap(null);
                }
                cityMarkers = [];

                var request = {
                    origin: {'placeId': origin_place_id},
                    destination: {'placeId': destination_place_id},
                    travelMode: travelMode
                };

                directionsService.route(request, function (response, status) {

                    if (status == google.maps.DirectionsStatus.OK) {
                        directionsDisplay.setDirections(response);
                        distanceInput.value = response.routes[0].legs[0].distance.value / 1000;
                    } else {
                        request.travelMode = google.maps.TravelMode.DRIVING;
                        directionsService.route(request, function (response, status) {
                            directionsDisplay.setDirections(response);
                            distanceInput.value = response.routes[0].legs[0].distance.value / 1000;
                        });
                    }
                });
            }

            else {
                var pointA = [];
                var pointB = [];
                var bounds = new google.maps.LatLngBounds();

                if (flightMarkers.length > 1) {
                    for (var i = 0; i < flightMarkers.length; i++) {
                        flightMarkers[i].setMap(null);
                    }
                    flightMarkers = [];
                }

                geocoder.geocode({placeId: origin_place_id}, function (results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        pointA[0] = parseFloat(results[0].geometry.location.lat());
                        pointA[1] = parseFloat(results[0].geometry.location.lng());

                        planemap.setCenter(results[0].geometry.location);
                        var marker = new google.maps.Marker({
                            map: planemap,
                            position: results[0].geometry.location
                        });
                        flightMarkers.push(marker);

                        geocoder.geocode({placeId: destination_place_id}, function (results, status) {
                            if (status == google.maps.GeocoderStatus.OK) {
                                pointB[0] = parseFloat(results[0].geometry.location.lat());
                                pointB[1] = parseFloat(results[0].geometry.location.lng());
                                planemap.setCenter(results[0].geometry.location);
                                var marker = new google.maps.Marker({
                                    map: planemap,
                                    position: results[0].geometry.location
                                });
                                flightMarkers.push(marker);

                                var a = new google.maps.LatLng(pointA[0], pointA[1]);
                                var b = new google.maps.LatLng(pointB[0], pointB[1]);

                                // planemap.setCenter(google.maps.geometry.spherical.interpolate(a, b, 0.5));
                                // map.setZoom(2);
                                var dist_between_points = google.maps.geometry.spherical.computeDistanceBetween(a, b);
                                var dist_in_miles = 0.000621371 * dist_between_points;
                                distanceInput.value = dist_in_miles;
                                console.log(dist_in_miles);

                                if (flightPath != null) {
                                    flightPath.setMap(null);
                                }

                                flightPath = new google.maps.Polyline({
                                    path: [a, b],
                                    geodesic: false,
                                    strokeColor: '#FF0000',
                                    strokeOpacity: 1.0,
                                    strokeWeight: 2
                                });

                                bounds.extend(a);
                                bounds.extend(b);
                                planemap.fitBounds(bounds);
                                flightPath.setMap(planemap);
                            }
                        });
                    } else {
                        console.log("Error Point A: " + status);
                    }
                });
            }
        }
    }

    function get_car_models() {
        var make = jQuery('#car_make').val();

        var data = new FormData();
        // for (var i = 0; i < files.length; i++) {
        //     var file = files[i];
        //     formdata.append('tree-image', file, file.name);
        // }
        data.append('make', make);
        data.append('action', 'car_models');

        jQuery.ajax({
            url: "<?php echo admin_url('admin-ajax.php');?>",
            type: 'POST',
            data: data,
            dataType: "json",
            contentType: false,
            processData: false,
            success: function (data) {
                //console.log(data.car_models);
                var models = JSON.parse(data.car_models);

                var options = "<option>Select A Model</option>";
                for (i = 0; i < models.length; i++) {
                    options += '<option value="' + models[i].model + '">' + models[i].model + '</option>';
                }

                var model_html = document.getElementById('car_model');
                document.getElementById('car_year').disabled = true;

                model_html.disabled = false;
                model_html.innerHTML = options;

            },
            error: function (e) {
                alert("Server Error : " + e.state());
            }
        });

    }

    function get_car_years() {
        var model = jQuery('#car_model').val();
        var make = jQuery('#car_make').val();

        var data = new FormData();
        // for (var i = 0; i < files.length; i++) {
        //     var file = files[i];
        //     formdata.append('tree-image', file, file.name);
        // }
        data.append('make', make);
        data.append('model', model);
        data.append('action', 'car_years');

        jQuery.ajax({
            url: "<?php echo admin_url('admin-ajax.php');?>",
            type: 'POST',
            data: data,
            dataType: "json",
            contentType: false,
            processData: false,
            success: function (data) {
                //console.log(data.car_models);
                var years = JSON.parse(data.car_years);

                var options = "<option>Select A Year</option>";
                for (i = 0; i < years.length; i++) {
                    options += '<option value="' + years[i].year + '">' + years[i].year + '</option>';
                }

                var year_html = document.getElementById('car_year');

                year_html.disabled = false;
                year_html.innerHTML = options;

            },
            error: function (e) {
                alert("Server Error : " + e.state());
            }
        });

    }

    function get_car_efficiency() {
        var model = jQuery('#car_model').val();
        var make = jQuery('#car_make').val();
        var year = jQuery('#car_year').val();

        var data = new FormData();
        // for (var i = 0; i < files.length; i++) {
        //     var file = files[i];
        //     formdata.append('tree-image', file, file.name);
        // }
        data.append('make', make);
        data.append('model', model);
        data.append('year', year);
        data.append('action', 'car_efficiency');

        jQuery.ajax({
            url: "<?php echo admin_url('admin-ajax.php');?>",
            type: 'POST',
            data: data,
            dataType: "json",
            contentType: false,
            processData: false,
            success: function (data) {
                //console.log(data.car_models);
                var car = JSON.parse(data.car);

                var unit = jQuery('#car_unit').val();

                if (unit == 'miles') {
                    jQuery('#car_efficiency').val(car.mpg);
                }
                else {
                    jQuery('#car_efficiency').val(car.kpg);
                }

                carbon_car();
            },
            error: function (e) {
                alert("Server Error : " + e.state());
            }
        });


    }

    jQuery(function ($) {
        mapInit('busmap', 'bfrom', 'bto', 'bdist');
        mapInit('trainmap', 'rfrom', 'rto', 'rdist');
        mapInit('planemap', 'pfrom', 'pto', 'pdist');
    });
</script>