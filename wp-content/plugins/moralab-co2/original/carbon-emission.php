
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





<style>
    .heightof{
        height: 140px;

    }
    .nomargin{
        margin-top:-20px;
    }
    .samewidth{

    }
    .small_width{
        width:100px;
    }
</style>
<br><br>

<div class="row">
    <center>
        <div class="panel panel-default">
            <div class="panel-heading" ><h3 style="margin:0px">Your consumption</h3></div>
            <div class="panel-body">
                <form action="http://www.webzonetechno.com/moralab/welcome/carbon" method="post" class="form-inline" >
                    <div class="form-group">
                        <label for="exampleInputEmail2">Year</label>
                        <input type="text" name="year" value="2016" onblur="getdate()" class="form-control" id="date_save" placeholder="search year">
                    </div>
                    <input type="submit" class="btn btn-default" name="search2" value="search">
                </form>
            </div>
        </div>
    </center>
</div>

<div class="row">
    <div class="col-md-12">

        <div class="col-md-3">

            <div class="panel panel-default heightof">
                <div class="panel-heading"><h3 style="margin:0px">Total Travel</h3></div>
                <div class="panel-body">

                                            <div class="" id="dis">
                            <center><span class="unit">Tons&nbsp;CO2/Year</span> </center>   

                            <center> <span style="color:red;" class="amount"><h1> 0.11</h1></span></center>

                        </div>
                    
                    <div class="" id="andi" style="display: none;">
                        <center><span class="unit">Tons&nbsp;CO2/Year</span></center>
                        <center>  <h1><span style="color:red;" class="amount" id="amount"></span></h1></center>
                    </div>


                </div>
            </div>

            <div class="panel panel-default nomargin">
                <div class="panel-heading">
                    <h3 class="panel-title">Distance travel per year:</h3>
                </div>
                <div class="panel-body">
                    <!----------first form starte here------------>
                    <form  action="http://www.webzonetechno.com/moralab/welcome/carbon_insert" method="POST" id="myForm">
                        <input type="hidden" name="search" value="">
                        <input type="hidden" name="pre_year" value="">

                        <div class="form-group " style="width:340px;">
                            <div class="input-group">
                                <span class="input-group-addon"></span>
                                <select name="unit_conversion" onchange="common_carbon()" id="unit_value" class="form-control selectWidth">                
                                    <option value="mile" >Miles</option>
                                    <option value="km" selected>Kilometer</option>
                                </select>
                            </div>
                        </div>
                        
                        
                        <div class="form-group">
                            <div class="input-group" >
                                <span class="input-group-addon miles"><i class="fa fa-car"></i></span>
                                <input type="text" name="miles_year" id="miles_year1" onchange="common_carbon()" class="form-control" value="1000" placeholder="Miles per year">
                                 <input type="hidden" name="year" id="year">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="input-group" >
                                <span class="input-group-addon miles"><i class="fa fa-car"></i></span>
                                <input type="text" name="miles_gallon" id="miles_gallon1" onchange="common_carbon()" class="form-control" value="10000" placeholder="Miles per gallon">
                                <input type="hidden" name="new_gallon" id="miles_gallon" value="0.09">
                               
                            </div>
                        </div>

                        <div class="form-group " style="width:340px;">
                            <div class="input-group">
                                <span class="input-group-addon"></span>
                                <select name="diesel" onchange="common_carbon()" id="option_value" class="form-control selectWidth">                
                                    <option value="diesel" >Diesel</option>
                                    <option value="gasolin" selected>Gasolin</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group ">
                            <div class="input-group">
                                <span class="input-group-addon bus"><i class="fa fa-bus"></i></span>
                                <input type="text" name="bus" id="bus1" onchange="common_carbon()" class="form-control" value="30" placeholder="Bus">
                                <input type="hidden" name="new_bus" id="bus"  value="0.02">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon transit"><i class="fa fa-train"></i></span>
                                <input type="text" name="transit_rail" onchange="common_carbon()" id="transit_rail1" class="form-control" value="" placeholder="Rail">
                                <input type="hidden" name="new_transit" id="transit_rail" value="2.05"/>
                            </div>

                        </div>



                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon flown"><i class="fa fa-plane"></i></span>
                                <input type="text" name="miles_flown" onchange="common_carbon()" id="miles_flown1" class="form-control" value="" placeholder="Plain">
                                <input type="hidden" name="new_miles_flown" id="miles_flown" value="4.01">
                                <input type="hidden" name="total_carbon" id="total_carbon" value="0.11">
                            </div>
                        </div>



                </div>
            </div>

        </div>


        <!----------first form End here------------>


        <!----------SECOND form End here------------>
        <div class="col-md-3">

            <div class="panel panel-default heightof">
                <div class="panel-heading"><h3 style="margin:0px">Total Housing</h3></div>
                <div class="panel-body">
                                            <div  id="dishouse">
                            <center><span class="unit">Tons&nbsp;CO2/Year</span>


                                <span style="color:red;" class="house"><h1> 0.47</h1></span></center>


                        </div>
                    
                    <div  id="andihouse" style="display: none;">

                        <center><span class="unit">Tons&nbsp;CO2/Year</span>

                            <h1>  <span  style="color:red;"  class="house" id="house"></span></h1></center>


                    </div>



                </div>
            </div>

            <div class="panel panel-default nomargin">
                <div class="panel-heading">
                    <h3 class="panel-title">How much you use at home:</h3>
                </div>
                <div class="panel-body">

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon electricity"><i class="fa fa-car"></i></span>
                            <input type="text" name="electricity" onchange="common_housing()" id="electricity1" class="form-control" placeholder="Electricity (Kw/yr)" value="35">
                            <input type="hidden" name="new_electricity" id="electricity" value="0.45">                  
                        </div>
                    </div>

                    <div class="form-inline">

                        <div class="input-group" style="width:140px;">
                            <span class="input-group-addon gas"><i class="fa fa-car"></i></span>
                            <input type="text" name="gas" onchange="common_housing()" id="gas1" class="form-control" placeholder="gas" value="4">
                            <input type="hidden" name="new_gas" id="gas" value="0.02">                  
                        </div>

                        <div class="input-group" style="width:47%;">
                            <select name="term_year" onchange="common_housing()" id="term_value" class="form-control selectWidth">  


                                <option length="5" value="term1" > therms/year</option>
                                <option length="5" value="term2" selected>cub.ft/Year</option>
                            </select>



                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon fuels"><i class="fa fa-car"></i></span>
                            <input type="text" name="fuels" onchange="common_housing()" id="fuels1" class="form-control" placeholder="fuels" value="">
                            <input type="hidden" name="new_fuels" id="fuels" value="0.68">                  
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon water_used"><i class="fa fa-bus"></i></span>
                            <input type="text" name="water_used" onchange="common_housing()" id="water_used1" class="form-control" placeholder="water used" value="">
                            <input type="hidden" name="new_water_used" id="water_used" value="1.17">                  
                            <input type="hidden" name="total_house" id="total_house" value="0.47">
                        </div>

                    </div>


                </div>
            </div>

        </div>
        <!----------SECOND form End here------------>



        <!----------third form start here------------>
        <div class="col-md-3">

            <div class="panel panel-default heightof">
                <div class="panel-heading"><h3 style="margin:0px">Total Food</h3></div>
                <div class="panel-body">
                                            <div id="disfood">

                            <center><span class="unit">Tons&nbsp;CO2/Year</span>

                                <span  style="color:red;"  class="food"><h1> 0.55</h1></span></center>


                        </div>
                    
                    <div  id="andifood" style="display: none;">
                        <center><span class="unit">Tons&nbsp;CO2/Year</span>


                            <h1>  <span  style="color:red;"  class="food" id="food"></span></h1></center>


                    </div>

                </div>
            </div>

            <div class="panel panel-default nomargin">
                <div class="panel-heading">
                    <h3 class="panel-title">Calories you eat per day:</h3>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon beef"><i class="fa fa-bus"></i></span>

                            <input type="text" name="beef" onchange="common_food()" id="beef1" placeholder="beef" class="form-control" value="247"><span style="background-color:white;border-color:white;" class="input-group-addon">247</span>
                            <input type="hidden" name="new_beef" id="beef" value="0.55">                  
                        </div>


                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon poultry"><i class="fa fa-bus"></i></span>

                            <input type="text" name="poultry" onchange="common_food()" id="poultry1" placeholder="poultry" class="form-control" value=""><span style="background-color:white;border-color:white;" class="input-group-addon">165</span>
                            <input type="hidden" name="new_poultry" id="poultry" value="0.00">                  
                        </div>


                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon fish"><i class="fa fa-bus"></i></span>

                            <input type="text" name="fish" onchange="common_food()" id="fish1" placeholder="fish" class="form-control" value=""><span style="background-color:white;border-color:white;" class="input-group-addon">73</span>
                            <input type="hidden" name="new_fish" id="fish" value="0.00">                  
                        </div>


                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon dairy"><i class="fa fa-bus"></i></span>

                            <input type="text" name="dairy" onchange="common_food()" id="dairy1" placeholder="dairy" class="form-control" value=""><span style="background-color:white;border-color:white;" class="input-group-addon">286</span>
                            <input type="hidden" name="new_dairy" id="dairy" value="0.00">                  
                        </div>


                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon vegetables"><i class="fa fa-bus"></i></span>

                            <input type="text" name="vegetables" onchange="common_food()" id="vegetables1" placeholder="vegetables" class="form-control" value=""><span style="background-color:white;border-color:white;" class="input-group-addon">271</span>
                            <input type="hidden" name="new_vegetables" id="vegetables" value="0.00">                  
                        </div>


                    </div>


                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon bakery"><i class="fa fa-bus"></i></span>

                            <input type="text" name="bakery" onchange="common_food()" id="bakery1" placeholder="bakery" class="form-control" value=""><span style="background-color:white;border-color:white;" class="input-group-addon">669</span>
                            <input type="hidden" name="new_bakery" id="bakery" value="0.00">                  
                        </div>


                    </div>



                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon drinks"><i class="fa fa-bus"></i></span>

                            <input type="text" name="drinks" onchange="common_food()" id="drinks1" placeholder="drinks" class="form-control" value=""><span style="background-color:white;border-color:white;" class="input-group-addon">776</span>
                            <input type="hidden" name="new_drinks" id="drinks" value="0.00">                  
                            <input type="hidden" name="total_food" id="total_food" value="0.55">                  

                        </div>


                    </div>


                </div>
            </div>

        </div>
        <!----------third form End here------------>


        <!----------fourth form start here------------>
        <div class="col-md-3">

            <div class="panel panel-default heightof">
                <div class="panel-heading"><h3>Total shopping</h3></div>
                <div class="panel-body">
                                            <div  id="disgoods">

                            <center><span class="unit">Tons&nbsp;CO2/Year</span>


                                <span  style="color:red;"  class="goods"><h1> 0.74</h1></span></center>

                        </div>
                    
                    <div  id="andigoods" style="display: none;">

                        <center><span class="unit">Tons&nbsp;CO2/Year</span>

                            <h1><span  style="color:red;"  class="goods" id="goods"></span></h1></center>


                    </div>

                </div>
            </div>

            <div class="panel panel-default nomargin">
                <div class="panel-heading">
                    <h3 class="panel-title">How much you spend on this per month:</h3>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon cloth"><i class="fa fa-bus"></i></span>

                            <input type="text" name="cloth" onchange="common_goods()" id="cloth1" placeholder="cloth" class="form-control" value="">
                            <input type="hidden" name="new_cloth" id="cloth" value="0.09">                  
                        </div>

                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon furniture"><i class="fa fa-bus"></i></span>

                            <input type="text" name="furniture" onchange="common_goods()" id="furniture1" placeholder="furniture" class="form-control" value="100">
                            <input type="hidden" name="new_furniture" id="furniture" value="0.74">                  
                        </div>

                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon health_care"><i class="fa fa-bus"></i></span>

                            <input type="text" name="health_care" onchange="common_goods()" id="health_care1" placeholder="health_care" class="form-control" value="">
                            <input type="hidden" name="new_health_care" id="health_care" value="4.74">                  
                        </div>

                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon vehicle"><i class="fa fa-bus"></i></span>

                            <input type="text" name="vehicle" onchange="common_goods()" id="vehicle1" placeholder="vehicle" class="form-control" value="">
                            <input type="hidden" name="new_vehicle" id="vehicle" value="2.60">                  
                        </div>

                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon house_maintance"><i class="fa fa-bus"></i></span>

                            <input type="text" name="house_maintance" onchange="common_goods()" id="house_maintance1" placeholder="house maintance" class="form-control" value="">
                            <input type="hidden" name="new_house_maintance" id="house_maintance" value="0.00">                  
                            <input type="hidden" name="total_goods" id="total_goods" value="0.74">                  


                        </div>

                    </div>

                </div>
            </div>

        </div>
        <div class="row">

            <div class="col-md-12">
                <div class="col-md-3"></div>
                <div class="col-md-3">   
                    <a href="http://www.webzonetechno.com/moralab/grap"><button type="button" class="btn btn-info phone_number">Cancel and return to main page</button></a>
                    <!--<input type="submit" name="update" value="Cancel and return to main page" class="btn btn-info " >      --->                             
                </div>
                <div class="col-md-2">                                    
                    <input type="button" name="create_new" class="btn btn-info " value="Save" onclick="submit_form()">                                   
                </div>
            </div>
        </div>
        <br><br><br><br><br><br>
    </div>

    <!----------fourth form End here------------>

</div>   
</div>








<script>
    function submit_form() {
        var get_year = (document.getElementById('date_save').value);
        $('#year').val(get_year);
        document.getElementById("myForm").submit();
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
<script>

</script>



<script src="http://www.webzonetechno.com/moralab/assets/js/bootstrap.min.js"></script> 
<script src="http://www.webzonetechno.com/moralab/assets/js/jquery.touchSwipe.min.js"></script>
<script src="http://www.webzonetechno.com/moralab/assets/js/jquery.js"></script>
<script src="http://www.webzonetechno.com/moralab/assets/js/jquery.validate.js"></script>
<script src="http://www.webzonetechno.com/moralab/assets/js/highcharts.js"></script>
<script src="http://www.webzonetechno.com/moralab/assets/js/exporting.js"></script>
<script src="http://www.webzonetechno.com/moralab/scripts/carbon.js"></script>

