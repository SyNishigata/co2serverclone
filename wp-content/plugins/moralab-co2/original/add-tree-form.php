
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>


<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

<script src="http://www.webzonetechno.com/moralab/assets/js/jquery.min.js"></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">

<!-- Bootstrap core CSS -->
<link href="http://www.webzonetechno.com/moralab/assets/css/bootstrap.min.css" rel="stylesheet">

<!-- Documentation extras -->
<link href="http://www.webzonetechno.com/moralab/assets/css/style.css" rel="stylesheet">
<link href="http://www.webzonetechno.com/moralab/assets/css/responsive.css" rel="stylesheet">
<!--for icon-->
<link href="http://www.webzonetechno.com/moralab/assets/fonts/font-awesome.css" rel="stylesheet">
<link href="http://www.webzonetechno.com/moralab/assets/css/css/screen.css" rel="stylesheet">


        <!--[if lt IE 9]><script src="assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="http://www.webzonetechno.com/moralab/assets/js/ie10-viewport-bug-workaround.js"></script>
<script src="http://www.webzonetechno.com/moralab/assets/js/ie-emulation-modes-warning.js"></script>



<link href="http://www.webzonetechno.com/moralab/assets/datepicker/jquery.datepick.css" rel="stylesheet">
<script src="http://www.webzonetechno.com/moralab/assets/datepicker/jquery.plugin.js"></script>
<script src="http://www.webzonetechno.com/moralab/assets/datepicker/jquery.datepick.js"></script>
<script src="http://maps.googleapis.com/maps/api/js"></script>
<script>
    $(function () {
        $('#popupDatepicker').datepick();
        $('#inlineDatepicker').datepick({onSelect: showDate});
    });

    function showDate(date) {
        alert('The date chosen is ' + date);
    }
</script>


<style>




    .centr{
        margin-top: 70px;
    }

    .no_padding{

    }
</style>
<br />
<div class="row">
    <div class="col-md-12">
        <div class="alert alert-danger" role="alert" style="text-align:center;font-weight:bold"><h4 style="margin:0px">Add New Tree</h4></div>
    </div></div>

<section class="mainContent">  

    <div class="row">

        <div class="col-md-12">

            <div class="col-md-4">
                <div class="panel panel-default" style="height:450px;">
                    <div class="panel-heading"><center><h3 style="margin:0px">Tree data</h3></center></div>
                    <div class="panel-body" style="margin-left:0px;">


                        <form id="signupForm" class="form-horizontal" enctype="multipart/form-data" role="form" id="signupForm" method="post" action="http://www.webzonetechno.com/moralab/tree_add">

                            <input type="hidden" name="sequencial" id="sequencial" />

                            <div class="container" style="margin-left:25px;">
                                <div class="form-group" style="text-align: center;">
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control required" name="special" id="special" placeholder="Type speciat name" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control required" name="location" id="location" placeholder="Type location name" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-2 col-xs-12">
                                        <input type="text" class="form-control" name="latitute" id="latitute" onblur="initialize()" placeholder="Type latitute" required>
                                    </div>
                                    <div class="col-sm-2 col-xs-12">
                                        <input type="text" class="form-control " name="longitute" id="longititute" onblur="initialize()" placeholder="Type longitute" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" name="date" id="popupDatepicker" placeholder="Type date">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control " name="diameter" onblur="myFunction()" id="TreeDiameter" placeholder="Type your tree diameter" required>
                                    </div>
                                    <div class="col-sm-2">
                                        <select class="form-control" name="Units" id="Units" required onchange="myFunction()">
                                            <option value="1">Inches</option>
                                            <option value="2">Centimeters</option>
                                        </select>
                                    </div>
                                </div>
                                <script> var fileindex = 1;
                                    var inc = 0;
                                    var maxImg = 10;</script>
                                
<script type="text/javascript" src="http://www.webzonetechno.com/moralab/scripts/upload_js/ajaxupload.3.5.js" ></script>
<link rel="stylesheet" type="text/css" href="http://www.webzonetechno.com/moralab/scripts/upload_js/styles.css" />

<script type="text/javascript" >
    
    $(function()
    {
        var btnUpload=$('#upload');
        var status=$('#status');
        
        
        new AjaxUpload(btnUpload, 
        {
            action: 'http://www.webzonetechno.com/moralab/upload-api/upload-api.php', 
            name: 'uploadfile',
            data : { 'fileindex':fileindex },
            onSubmit: function(file, ext)
            {
                if (! (ext && /^(jpg|png|jpeg|gif)$/.test(ext)))
        { 
                    alert('Only JPG, PNG or GIF files are allowed');  
                    return false;
                }
                if(inc == maxImg)
                {
                    alert('You have upload maximum upload limit');  
                    return false;
                }
                status.show();
            },
            onComplete: function(file,response)
            {
                status.hide();
                if(response!="error")               
                {
                    generator(response); 
                } 
                else
                {
                    alert('fail...');
                }
            }
        });
    });
    
     function generator(response)
    {
          var str = '';
          if(fileindex == 1)
          {
              str = str+'<span id="delete_avatar_'+inc+'" style="margin-top:30px; "><div class="upload_image1" style="width:100px; margin-right:10px; float:left;"><img class="img-thumbnail" width="90" height="100" src="http://www.webzonetechno.com/moralab/uploads/thumb/'+response+'" border="0" >';
              str = str+'<input type="hidden" id="image_'+inc+'"  name="image[]" value="'+response+'"/></div><div style="color: red;cursor: pointer;float: left;font-size: 21px;font-weight: bold;margin-left: -25px;  margin-top: -11px; padding-top:0;" onclick="delete_avatar('+inc+')">X</div></span>'; 
              $('.image_content_area').append(str);
              inc++;
          }
          else if(fileindex == 2)
          {
               //alert('ee');
             // BW will work 
             $('#foto_box').html("<img src='http://www.webzonetechno.com/moralab/uploads/thumb/"+response+"'>");
             $('#logo_input').html( "<input type='hidden' name='logo' id='logo' value='"+response+"'>");
            
          }
          
    }
</script>





                                <div class="col-sm-4" style="">
                                    <script> var fileindex = 1;
                                        var inc = 0;
                                        var maxImg = 10;</script>
                                                                        <div class="">
                                        <div class="col-sm-12">
                                            <div class="img_uBtn" style="margin-left: 40px;">
                                                <div id="upload" class="upload2"><span>Upload Photos</span></div><span id="status" style="display:none"> <img src="http://www.webzonetechno.com/moralab/scripts/upload_js/loading.gif" /> </span> 
                                            </div>
                                            <div class="" style="clear: both;"></div> 
                                                                                            <div class="image_content_area " style="display:none;">
                                                    <!--                                                                ------------------------------------------>
                                                                     
                                                    <!--                                                                ------------------------------------------>
                                                </div>
                                        
                                        
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>





            <div class="col-md-4">


                <div class="panel panel-default"  style="height:450px;">
                    <div class="panel-heading" style="height:60px;"><center><h3 style="margin-top:-2px;">Location</h3></center><center><span style="  margin-top: -5;margin-left: -14px">Zoom and drag marker as close to tree location</span></center></div>
                    <div class="panel-body">
                        <div id="mapCanvas" style="height:360px;width:100%;margin-right: 0px;margin-top: 0px;"></div>
                    </div>

                </div>





            </div>


            <div class="col-md-4">


                <div class="panel panel-default"  style="height:450px;">
                    <div class="panel-heading"><center><h6 style="margin:0px"><b>Projected CO2 stored by this tree</b></h6><p id="demo"></p></center></div>

                    <div class="panel-body">
                        <div class="">
                            <div id="container" style="width:100%; height:300px; margin-left: -10px;margin-top: -16px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="mainContent" style="margin-top:-30px;padding:0;"> 

    <div class="row">

        <div class="col-md-12">
            <div class="panel panel-default" style="margin-left: 10px;margin-right: 10px;">

                <div class="panel-body">
                    <div class="image_content_area ">
                        <!--                                                                ------------------------------------------>
                                         
                        <!--                                                                ------------------------------------------>
                    </div> 

                </div>

            </div>
        </div>

    </div>
</section>

<section class="mainContent" style="margin-top:-30px;padding:0;"> 
    <div class="row">
        <div class="col-md-4">

        </div>
        <div class="col-md-1"> 
            <div class="form-group">
                <div class="col-sm-offset-1 col-sm-4">
                    <button type="submit" class="btn btn-primary btn-info" id="sbButton">Save tree</button>
                </div>
            </div>

        </div>
        <div class="col-md-2"> <div class="form-group">
                <div class="col-sm-offset-1 col-sm-4">
                    <a href="http://www.webzonetechno.com/moralab/grap"><button type="button" class="btn btn-primary btn-info" id="sbButton">Cancel and return to main page</button></a>
                </div>
            </div></div> 
        <div class="col-md-5"></div>

    </div>
</section>
</form>
</div>

<script>

    function initialize()
    {

        var geocoder = new google.maps.Geocoder();
        var LAT = document.getElementById("latitute").value;
        //alert(LAT);
        var LON = document.getElementById("longititute").value;
        var latLng = new google.maps.LatLng(LAT, LON);
        var map = new google.maps.Map(document.getElementById('mapCanvas'),
                {zoom: 2, center: latLng, streetViewControl: false, mapTypeId: google.maps.MapTypeId.ROADMAP});
        var marker = new google.maps.Marker({position: latLng, map: map, draggable: true});

        //fill the boxes with the coordenates
        google.maps.event.addListener(marker, 'dragend', function (event)
        {
            document.getElementById("latitute").value = Math.round(this.getPosition().lat() * 100000) / 100000;
            document.getElementById("longititute").value = Math.round(this.getPosition().lng() * 100000) / 100000;

            //centers map on marker
            var latLng = marker.getPosition(); // returns LatLng object
            map.setCenter(latLng); // setCenter takes a LatLng object
        });
    }

    // Onload handler to fire off the app.
    google.maps.event.addDomListener(window, 'load', initialize);
</script>



<script>
    function myFunction() {
        var AccumulatedCO2 = 0;
        var TreeDiameter = document.getElementById("TreeDiameter").value;
        var Results = [];
        var CO2 = "";
        var d = new Date();
        var YearPlanted = d.getFullYear();
        var YearOfCalculation = d.getFullYear();

//--start--adjust for the units of the tree diameter selected by the user
        var UnitSelected = document.getElementById('Units').options[document.getElementById('Units').selectedIndex].value;
        if (UnitSelected == 1) {
            var TreeDiameter = TreeDiameter / 0.393701;
        } else {
            var TreeDiameter = TreeDiameter;
        }
//--end--adjust for the units of the tree diameter selected by the user


        for (i = 0; i <= 85; i++) {
            YearOfCalculation = i + 2015;
            if (YearOfCalculation >= YearPlanted) {

                //Body mass (kg dry above groung matter) from Chave et al (2001):
                BodyMass = 0.0998 * (Math.pow(TreeDiameter, 2.5445));

                //Growth Rate (kg dry above groung matter/ plant /yr) from Niklas & Enquist (2001):
                GrowthRate = 0.208 * (Math.pow(BodyMass, 0.763));

                //dK/dy Above ground, this is the rate of production at each year assuming log decline:
                dKdY = (Math.exp(1 - (((GrowthRate * Math.exp(1)) * (YearOfCalculation - YearPlanted)) / BodyMass)) / Math.exp(1)) * (GrowthRate * Math.exp(1));

                //Adding Below ground Using Cairns et al (1997) factor of 24% of above ground biomass:
                dKdYT = dKdY * 1.24;

                //Carbon content Using Kirby & Potvin (2007) factor of 47% of total dry weight:
                Carbon = dKdYT * 0.47;

                //CO2 sequestration.Conversion of Carbon in treee to CO2:
                CO2 = Carbon * 3.6663;

                //adds CO2 over the years:
                AccumulatedCO2 = AccumulatedCO2 + CO2;

//Generates data.frame that includes year:
                Results[i] = Math.round(AccumulatedCO2 * 10) / 10;

            } else {
                Results[i] = 0;
            }

        }
        var tones_value = (AccumulatedCO2 / 1000);
        //alert(AccumulatedCO2);
        //alert(tones_value);
        $('#sequencial').val(parseInt(tones_value));
        document.getElementById("demo").innerHTML = "This tree will sequester " + parseInt(tones_value) + " tones of CO2 over its life time";
        setTimeout(function () {

// generates a variable with the data to be plotted in the x-y chart
            var Results1 = Results;


            $('#container').highcharts({
                chart: {type: 'scatter', zoomType: 'x'},
                title: {text: ''},
                tooltip: {headerFormat: '<b></b>', pointFormat: "It will sequester {point.y}kg by {point.x:%Y}", hideDelay: 1},
                xAxis: {type: 'datetime', },
                yAxis: {title: {text: 'CO2 sequestered (kg)'}, min: 0},
                legend: {enabled: false},
                plotOptions:
                        {
                            area: {
                                fillColor:
                                        {
                                            linearGradient: {x1: 0, y1: 0, x2: 0, y2: 1},
                                            stops: [[0, Highcharts.getOptions().colors[0]], [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]]
                                        },
                                marker: {radius: 2},
                                lineWidth: 1,
                                states: {hover: {lineWidth: 1}},
                                threshold: null
                            }
                        },
                series: [{
                        type: 'area',
                        name: 'Cummulative CO2 stored',
                        pointInterval: 365 * 24 * 3600000,
                        pointStart: Date.UTC(2015, 0, 1),
                        data: Results1
                    }]
            });

        }, 1);

    }

</script>






<script>

    function delete_avatar(image_id)
    {

        //alert(image_id);
        $('#delete_avatar_' + image_id).remove();
    }
</script>



<script>

    $().ready(function () {
        // validate the comment form when it is submitted


        // validate signup form on keyup and submit
        $("#signupForm").validate({
            rules: {
                firstname: "required",
                lastname: "required",
                email: "required",
                password: {
                    required: true,
                    minlength: 6
                },
                confirm_password: {
                    required: true,
                    minlength: 6,
                    equalTo: "#password"
                },
            }

        });




    });
</script>




<script src="http://www.webzonetechno.com/moralab/assets/js/bootstrap.min.js"></script> 
<script src="http://www.webzonetechno.com/moralab/assets/js/jquery.touchSwipe.min.js"></script>
<script src="http://www.webzonetechno.com/moralab/assets/js/jquery.js"></script>
<script src="http://www.webzonetechno.com/moralab/assets/js/jquery.validate.js"></script>
<script src="http://www.webzonetechno.com/moralab/assets/js/highcharts.js"></script>
<script src="http://www.webzonetechno.com/moralab/assets/js/exporting.js"></script>
<script src="http://www.webzonetechno.com/moralab/scripts/carbon.js"></script>

