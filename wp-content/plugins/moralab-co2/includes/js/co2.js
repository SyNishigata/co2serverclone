function save_trees(){
	jQuery( document ).on('click', '.post_submit', function() {
        var formdata = jQuery("#treeForm").serialize();
        jQuery.ajax({
            url: co2ajax.ajaxurl,
            type: 'post',
            data: formdata,
            success: function(response){
                jQuery('#tree-save').html(response);
            }
        });
        return false;
    })
}

/* create the bar graph */
function get_bar_graph(id, data) {

    if (data == null){
        data = [{name: '', data: [0, 0],color: colors['green']}, 
                {name: '', data: [0,0],color:colors['blue']}
               ];
    }

    // var data = [{name: 'your tree #1', data: [0, 1],color: colors['tree']}, 
    //              {name: 'your tree #1', data: [0,10.6],color:colors['tree']},
    //              {name: 'driving', data: [2,0],color:colors['travel']},
    //              {name: 'train', data: [2,0],color:colors['travel']},
    //              {name: 'natural gas', data: [2,0],color:colors['utility']},
    //              {name: 'electricity', data: [2,0],color:colors['utility']},
    //              {name: 'dairy', data: [2,0],color:colors['food']},
    //              {name: 'meat', data: [2,0],color:colors['food']},
    //              {name: 'furniture & appliances', data: [5,0],color:colors['goods']},
    //              {name: 'clothing', data: [3,0],color:colors['goods']}];

	jQuery(id).highcharts({

		chart: {type: 'column',marginRight: 0},
		legend: {enabled: false},
		title: {text: '',style: {display: 'none'}},
        credits: false,
		xAxis:{categories: ['Your<br>emitted<br>CO2','CO2<br>sequestered<br>by your trees<br>']},
		yAxis: {allowDecimals: false,min: 0,title: {text: ' Tonnes of CO2'}},
		tooltip: {backgroundColor: "rgba(255,255,255,1)",formatter: function () {return this.y + ' tons of CO2 by '+ this.series.name},hideDelay: 1},
		plotOptions: {column: {stacking: 'normal',borderWidth: .9},
		              series: {pointWidth: 55}
		             },
        series: data
    });

}

// Begin Sy's Edits

/* Sy's Edits: Function to create the expanded bar graph */
function get_expanded_bar_graph(id, data) {

    if (data == null){
        data = [{name: '', data: [0, 0],color: colors['green']}, 
                {name: '', data: [0,0],color:colors['blue']}
               ];
    }
	
	/**
	 * Sand-Signika theme for Highcharts JS
	 * @author Torstein Honsi
	 */

	// Load the fonts
	Highcharts.createElement('link', {
	   href: 'https://fonts.googleapis.com/css?family=Signika:400,700',
	   rel: 'stylesheet',
	   type: 'text/css'
	}, null, document.getElementsByTagName('head')[0]);

	// Add the background image to the container
	Highcharts.wrap(Highcharts.Chart.prototype, 'getContainer', function (proceed) {
	   proceed.call(this);
	   this.container.style.background = 'url(http://www.highcharts.com/samples/graphics/sand.png)';
	});


	Highcharts.theme = {
	   colors: ["#81ba6a", "#9aebf6", "#69d8d6", "#15a6a9", '#166c96'],   // Colors for the data columns
	   chart: {
		  backgroundColor: null,
		  style: {
			 fontFamily: "Signika, serif"
		  }
	   },
	   title: {
		  style: {
			 color: 'black',
			 fontSize: '16px',
			 fontWeight: 'bold'
		  }
	   },
	   subtitle: {
		  style: {
			 color: 'black'
		  }
	   },
	   tooltip: {
		  borderWidth: 0
	   },
	   legend: {
		  itemStyle: {
			 fontWeight: 'bold',
			 fontSize: '13px'
		  }
	   },
	   xAxis: {
		  labels: {
			 style: {
				color: '#6e6e70'
			 }
		  }
	   },
	   yAxis: {
		  labels: {
			 style: {
				color: '#6e6e70'
			 }
		  }
	   },
	   plotOptions: {
		  series: {
			 shadow: true
		  },
		  candlestick: {
			 lineColor: '#404048'
		  },
		  map: {
			 shadow: false
		  }
	   },

	   // Highstock specific
	   navigator: {
		  xAxis: {
			 gridLineColor: '#D0D0D8'
		  }
	   },
	   rangeSelector: {
		  buttonTheme: {
			 fill: 'white',
			 stroke: '#C0C0C8',
			 'stroke-width': 1,
			 states: {
				select: {
				   fill: '#D0D0D8'
				}
			 }
		  }
	   },
	   scrollbar: {
		  trackBorderColor: '#C0C0C8'
	   },

	   // General
	   background2: '#E0E0E8'

	};

	// Apply the theme
	Highcharts.setOptions(Highcharts.theme);
	
	jQuery(id).highcharts({
		chart: {type: 'column'},
		legend: {enabled: false},
		title: {text: 'My CO2 Emissions'},
        credits: false,
		xAxis:{categories: ['Travel', 'Home', 'Food', 'Waste']},
		yAxis: {allowDecimals: false,min: 0,title: {text: ' Tons of CO2'}},
		tooltip: {
			backgroundColor: "rgba(255,255,255,1)",
			formatter: 
				function () {
					var firstLine = "Your " + this.series.name + " Emissions:" + "<br>";
					var secondLine = this.y + " tons of CO2 emitted" + "<br>";
					var tips = "";
					var learnMore = '<span style="color:blue">Click this column to learn more!</span>';
					switch(this.x){
						case 'Travel':
							tips = "<b>Quick Tips:" + "<br>" + 
								"-Drive less" + "<br>" + "-Fly Less" + "<br>";
							break;
						case 'Home':
							tips = "<b>Quick Tips:" + "<br>" + "-Use low-carbon energy" + 
								"<br>" + "-Generate your own low-carbon electricity" + "<br>";
							break;
						case 'Food':
							tips = "<b>Quick Tips:" + "<br>" + 
								"-Eat less red meat" + "<br>" + "-Cut waste" + "<br>";
							break;
						case 'Waste':
							tips = "<b>Quick Tips:" + "<br>" + 
								"-Buy fewer things" + "<br>" + "-Recycle your trash" + "<br>";
							break;
					}
					return firstLine + secondLine + tips + learnMore;
				},
			hideDelay: 1
		},
		plotOptions: {
			column: {
				pointWidth: 60,
				borderWidth: 0,
				pointPadding: 0.2
			},
			series: {
				stacking: 'normal',
				cursor: 'pointer',
				point: {
					events: {
						click: function(){
							switch(this.x){
							case 0:
								location.href = 'http://localhost/co2serverclone/travel-tips';
								break;
							case 1:
								location.href = 'http://localhost/co2serverclone/home-tips';
								break;
							case 2:
								location.href = 'http://localhost/co2serverclone/food-tips';
								break;
							case 3:
								location.href = 'http://localhost/co2serverclone/waste-tips';
								break;
							}
						}
					}
				}
			}
		},
        series: data
    });
}

// End Sy's Edits

function tree_sequestered() {

        var AccumulatedCO2 = 0.0;
        var TreeDiameter = document.getElementById("treeDiameter").value;
        var Results = [];
        var CO2 = "";
        var d = new Date();
        var YearPlanted = d.getFullYear();
        var YearOfCalculation = d.getFullYear();

//--start--adjust for the units of the tree diameter selected by the user
        var UnitSelected = document.getElementById('treeUnit').options[document.getElementById('treeUnit').selectedIndex].value;
        if (UnitSelected == 1) {
            var TreeDiameter = TreeDiameter / 0.393701;
        } else {
            var TreeDiameter = TreeDiameter;
        }
//--end--adjust for the units of the tree diameter selected by the user


        for (i = 0; i <= 85; i++) {
            YearOfCalculation = i + YearPlanted;
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
                Results[i] = Math.round(AccumulatedCO2 * 10.0) / 10.0;

            } else {
                Results[i] = 0;
            }

        }
        var tones_value = (AccumulatedCO2 / 1000.0);
        var sequestered = isNaN(parseFloat(tones_value)) ? 0.0:parseFloat(tones_value);
        //alert(AccumulatedCO2);
        //alert(tones_value);
        jQuery('#sequestered').val(sequestered.toFixed(2));
        document.getElementById("demo").innerHTML = "This tree will sequester " + (sequestered.toFixed(2)) + " tonnes of CO2 over its life time";
        setTimeout(function () {

// generates a variable with the data to be plotted in the x-y chart
            var Results1 = Results;


            jQuery('#container').highcharts({
                chart: {type: 'scatter', zoomType: 'x', width:'340', height: '200'},
                title: {text: ''},
                credits: false,
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


/* LatLong Finder */
// function latlong_find(lat, long){
// 	var geocoder = new google.maps.Geocoder();

// 	var LAT = document.getElementById("latbox").value;
// 	var LON = document.getElementById("lngbox").value;
// 	var latLng = new google.maps.LatLng(LAT, LON);
// 	var map = new google.maps.Map(document.getElementById('mapCanvas'), 
// 	{zoom: 2, center: latLng, streetViewControl:false, mapTypeId: google.maps.MapTypeId.ROADMAP});
// 	var marker = new google.maps.Marker({position: latLng, map: map, draggable: true});

// 	//fill the boxes with the coordenates
// 	google.maps.event.addListener(marker, 'dragend', function (event) {
// 		document.getElementById("latbox").value =  Math.round(this.getPosition().lat()*100000)/100000;
// 		document.getElementById("lngbox").value = Math.round(this.getPosition().lng()*100000)/100000;
// 		//centers map on marker
// 		var latLng = marker.getPosition(); // returns LatLng object
// 		map.setCenter(latLng); // setCenter takes a LatLng object
// 	}); 
// }


/* get the distance between two points */
// function distanceCalc {
// var directionDisplay;
// var directionsService = new google.maps.DirectionsService();
		
// function bus_initialize() {
// 	var inputFrom = document.getElementById('From');
// 	var autocomplete = new google.maps.places.Autocomplete(inputFrom);

// 	var inputTo = document.getElementById('To');
// 	var autocomplete = new google.maps.places.Autocomplete(inputTo);

// 	directionsDisplay = new google.maps.DirectionsRenderer();

// 	var map = new google.maps.Map(document.getElementById("map-canvas"), 
// 	{zoom:2, mapTypeId: google.maps.MapTypeId.ROADMAP, center: new google.maps.LatLng(32, -102),});
// 	directionsDisplay.setMap(map);
// }

// function calcRoute() {
// 	var From = document.getElementById("From").value;			
// 	var To = document.getElementById("To").value;
// 	var distanceInput = document.getElementById("distance");
	
// 	var request = {
// 		origin:From, 
// 		destination:To,
// 		travelMode: google.maps.DirectionsTravelMode.DRIVING
// 	};
	
// 	directionsService.route(request, function(response, status) {
// 		if (status == google.maps.DirectionsStatus.OK) {
// 			directionsDisplay.setDirections(response);
// 			distanceInput.value = response.routes[0].legs[0].distance.value / 1000;
// 		}
// 	});
// }
//}