<?php 
global $post;

// determine if page is a new blank post
$new = ((get_query_var('name') == 'plant-a-tree')? true:false);

?>

<div class="container" style="margin:40px auto;">
    <!-- <div class="row">                    -->
        <form class="" enctype="multipart/form-data" id="treeForm" method="post" action="">
            <?php wp_nonce_field('ajax_file_nonce', 'security'); ?>
            <input type="hidden" name="post_id" id="post_id" value="<?php echo !($new)? $post->ID:'0';?>"/> 
            <input type="hidden" name="sequencial" id="sequencial" value="<?php echo !empty($post)? get_post_meta($post->ID, 'sequestered', true):'';?>"/>
            <input type="hidden" name="new" id="new" value="<?php echo $new; ?>"/>
            <input name="action" type="hidden" value="save_tree">
            <div class="large-3 columns">
                <div class="form-group">
                    <div class="row">
                        <div id="preview" style="width:200px; height: 200px; overflow:hidden;">
                            <img class="thumbnail" width="auto" height="auto" src="<?php echo !empty($post) && !empty(get_post_meta($post->ID, 'featured_img', true))? get_post_meta($post->ID, 'featured_img', true):INCLUDES_URL.'/img/img_placeholder.png';?>" id="featured_img" style="display:block;">
                        </div>

                        <label for="image" class="button" style="font-size: 13px; padding: 8px; border-radius: 2px; margin: 10px 0;}">Upload Photo</label>
                        <input type="file" name="image" id="image" class="show-for-sr" >
                        <input type="hidden" name="img_id" id="img_id" value="">
                    </div>
                    <div class="row">
                        <a class="button post_submit" style="border-radius: 2px;">Save Tree</a>
                    </div>
                </div>
            </div>

            <div class="large-5 columns">
                <div class="form-group">
                    <div class="row">
                        <div class="small-3 columns">
                            <label for="treeName" class="text-right middle">Tree Name</label>
                        </div>
                        <div class="small-9 columns">
                            <input type="text" class="form-control required" name="treeName" id="treeName" value="<?php echo !empty($post)? $post->post_title:'';?>" placeholder="Enter a name for this tree" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="small-3 columns">
                            <label for="treeDate" class="text-right middle">Date</label>
                        </div>
                        <div class="small-9 columns">  
                            <input type="text" class="form-control" name="treeBirth" id="treeDate" value="<?php echo !empty($post)? get_post_meta($post->ID, 'treeBirth', true):'';?>" placeholder="MM/DD/YYY">
                        </div>
                    </div>

                    <div class="row">
                        <div class="small-3 columns">
                            <label for="treeDiameter" class="text-right middle">Tree Diameter</label>
                        </div>
                        <div class="small-6 columns">                               
                            <input type="text" class="form-control " name="treeDiameter" onblur="tree_sequestered()" id="treeDiameter" value="<?php echo !empty($post)? get_post_meta($post->ID, 'treeDiameter', true):'';?>" placeholder="Type your tree diameter" >
                        </div>
                        <div class="small-3 columns">
                            <select name="treeUnit" id="treeUnit" value="<?php echo !empty($post)? get_post_meta($post->ID, 'treeUnit', true):'';?>" required onchange="tree_sequestered()" style="height:24.75px;line-height:1;">
                                <option value="1">in.</option>
                                <option value="2">cm.</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="small-3 columns">
                            <label for="location" class="text-right middle">Location</label>
                        </div>
                        <div class="small-9 columns">
                            <input type="text" class="form-control required" name="location" id="location" value="<?php echo !empty($post)? get_post_meta($post->ID, 'location', true):'';?>" placeholder="Type location name" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="small-3 columns">
                            <label for="latitude" class="text-right middle">Lat</label>
                        </div>
                        <div class="small-3 columns">
                            <input type="text" class="form-control" name="latitude" id="latitude" onblur="initialize()" value="<?php echo !empty($post)? get_post_meta($post->ID, 'latitude', true):'';?>" placeholder="Type latitude" >
                        </div>
                        <div class="small-3 columns">
                            <label for="longitude" class="text-right middle">Long</label>
                        </div>
                        <div class="small-3 columns">
                            <input type="text" class="form-control " name="longitude" id="longitude" onblur="initialize()" value="<?php echo !empty($post)? get_post_meta($post->ID, 'longitude', true):'';?>" placeholder="Type longitude" >
                        </div>
                    </div>
                    <div class="row">
                        <!-- Map Placement -->
                        <div id="mapCanvas" style="width:100%;height:200px;"></div>
                        <label for="mapCanvas" style="text-align:center">Zoom and drag marker as close to tree location</label>
                    </div>
                </div>


            </div>
            
            <div class="large-4 columns">
                <div class="chart" style="height:450px;">
                    <div class="panel-heading"><center><h3 style="margin:0px"><b>Projected CO2 stored by this tree</b></h3><p id="demo"></p></center></div>

                    <div class="panel-body">
                        <div class="">
                            <div id="container" style="width:100%; height:200px; margin-left: -10px;margin-top: -16px;"></div>
                        </div>
                    </div>
                </div> 
            </div>
        </form>
    <!-- </div> -->
</div>


<script type="text/javascript">
    jQuery(function ($) {
        $(":file").change(function () {
            if (this.files && this.files[0]) {
                // Upload Image
                upload_image();

                // get local image path to display on screen
                var reader = new FileReader();
                reader.onload = imageIsLoaded;
                reader.readAsDataURL(this.files[0]);
            }
        });
    });

    function imageIsLoaded(e) {
        // var files = document.getElementById("treeImage").files;
        // var file = {'name':files[0].name, 'type':files[0].type, 'size':files[0].size}   

        jQuery('#featured_img').attr('src', e.target.result);
        jQuery('#img_id').attr('value', '0');
    }

    function upload_image(){

        //var formdata = new FormData();
        //var files = document.getElementById("tree-image");


        var imgInput = document.getElementById('image');
        var file = imgInput.files[0];
        var formdata = new FormData();
        // for (var i = 0; i < files.length; i++) {
        //     var file = files[i];
        //     formdata.append('tree-image', file, file.name);
        // }
        formdata.append('file', file);
        formdata.append('action', 'image_uploader');

        jQuery.ajax({
            url: "<?php echo admin_url('admin-ajax.php');?>",
            type: 'POST',
            data: formdata,
            dataType: "json",
            contentType:false,
            processData:false,
            success: function(data){
                var name = data.file;
                console.log(data.file);
            },
            error: function(e){ alert("Server Error : " + e.state() ); }
        });

    }
</script>

<script>
  function initialize() 
    {
        var geocoder = new google.maps.Geocoder();


        var LAT = document.getElementById("latitude").value;
        var LON = document.getElementById("longitude").value;

        var latLng = new google.maps.LatLng(LAT, LON);

        var zoom_level = 6;
        if (LAT != null && LON !=null){
            zoom_level = 1;
        }
        var map = new google.maps.Map(document.getElementById('mapCanvas'), 
        {zoom: zoom_level, center: latLng, streetViewControl:false, mapTypeId: google.maps.MapTypeId.ROADMAP});
        var marker = new google.maps.Marker({position: latLng, map: map, draggable: true});

        //fill the boxes with the coordenates
        google.maps.event.addListener(marker, 'dragend', function (event) 
        {
            document.getElementById("latitude").value =  Math.round(this.getPosition().lat()*100000)/100000;
            document.getElementById("longitude").value = Math.round(this.getPosition().lng()*100000)/100000;

            //centers map on marker
            var latLng = marker.getPosition(); // returns LatLng object
            map.setCenter(latLng); // setCenter takes a LatLng object
        }); 
     }

  // Onload handler to fire off the app.
  google.maps.event.addDomListener(window, 'load', initialize);
</script>

<script>
    jQuery(function ($) {
        tree_sequestered();

        $( "#treeDate" ).datepicker();

    });
</script>

<script type="text/javascript">
    (function($){
        $("body").on("click", ".post_submit", function(){
            var options = {};
            options.type = "post";
            options.url = "<?php echo admin_url('admin-ajax.php');?>";
            options.data = $('#treeForm').serialize();
            options.dataType = "json";
            options.error = function(e){ alert("Server Error : " + e.state() ); };
            options.success = function(d){
                if(d.result == true){
                    window.transmission = true;
                    switch(d.status){
                        default:
                    };
                    console.log(d.post);
                    location.href = "<?php echo get_site_url().'/my-trees'; ?>"

                };
            };
            $.ajax(options);
        });
        window.transmission = false;
        $("form").submit(function(){ window.transmission = true; });
        window.onbeforeunload = function(){ if(!window.transmission) return ""; };
    })(jQuery);
</script>