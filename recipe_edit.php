<!DOCTYPE html>
<html lang="en">

<?php 

error_reporting( 0 );
include_once 'includes/dbh.inc.php';
include 'includes/header_inc.php'; 

if ( isset($_GET['rid']) ) {
    $rid = $_GET['rid'];
    $rid = mysqli_real_escape_string($conn, $_GET['rid']);
    echo '<script>window.rid="'.$rid.'";</script>';
    if (isset($_SESSION['u_id'])) {
    $uid = mysqli_real_escape_string($conn, $_SESSION['u_id']);
    $permissions_level = mysqli_real_escape_string($conn, $_SESSION['perms']);  
    }
    
    //$sql = "SELECT * FROM products LEFT OUTER JOIN product_photos ON products.item_upc = product_photos.upc WHERE products.item_upc=$item_upc LIMIT 1";
    $sql = "SELECT * FROM recipes WHERE recipe_id=".$rid." LIMIT 1";
    //echo "<h1>".$sql."</h1>";
    $results = mysqli_query($conn, $sql);
    $queryResults = mysqli_num_rows($results);
    if ($queryResults > 0) {
        $row = mysqli_fetch_array($results);
            $rname = $row['recipe_name'];
            $rcate = $row['rcate'];
            $ralergy = $row['ralergy'];
            $rcreator = $row['user_id'];
            $rdate = $row['datetime'];
    }
}


?>
<style>
#ilistshow th, td {
    font-size:11px;
}
.btn-sm {
    font-size:10px;
    margin:0px !important;
    padding:3px !important;
}
td.vcenter {
        vertical-align: middle !important;
        text-align: center !important;
    }

</style>

<section class="whitepage">
<!-- style="margin-bottom:-60px;" -->
    <div class="container-fluid" style="margin-bottom:0px;">
        <div class="row">
            <!-- <div class="no-gutter"> -->
            <div id="topbar" style=";">
                <div class="content-crumb-div">
                    <a class="fileTrail" href="index.php">Home</a>
                    <i style="font-size: 1rem;" class="fa fa-arrow-right"></i>
                    Recipe Editor! 

                </div>
            </div>
            
        </div>
        <div class="row">
            <div class="no-gutter">
            
                <!-- content left halfbg-->
                <div class="col-md-2 " style="">
                <form id="frmStep1" role="form">
                    <div class="onStep" data-animation="fadeInUp" data-time="200">
                            <div style="margin-bottom:15px !important;">
                                <!-- spacer -->
                                <div class="space-half"></div>
                                <h5 class="center" style='text-transform: uppercase;'>Step 1 <br> <small>Add/Edit Your Ingredients</small></h5>
                            </div>
                    </div>
                    <div id="" class="onStep" data-animation="fadeInLeftBig" data-time="200" style="margin: 25px;">
                    
                        <div class="form-group">
                            <label for="rname">Recipe Name</label>
                            <input type="text" class="form-control" id="rname" name="rname" aria-describedby="rname" placeholder="Enter Recipe Name" required="required" value="<?php echo $rname; ?>">
                        </div> 
                        <div class="form-group">
                                <label for="rcate">Recipe Category</label>
                                <select class="form-control form-control-lg" id="rcate" name="rcate" required="required" >
                                    <option name="0" value="0">Select Any</option>
                                    <?php 
                                    $sqlcat = "SELECT * FROM categories WHERE isrecipe=1 ORDER BY cat_name ASC";

                                    $resultcat = mysqli_query($conn, $sqlcat);
                                    $queryResultcat = mysqli_num_rows($resultcat);

                                    if($queryResultcat > 0) {
                                        while($row = mysqli_fetch_array($resultcat)) {
                                            if ( $row['cat_name'] == $rcate ) {
                                                echo '<option name="'.$row['id'].'" value="'.$row['cat_name'].'" selected="selected">'.$row['cat_name'].' - '.$row['isrecipe_desc'].'</option>';
                                            } else {
                                                echo '<option name="'.$row['id'].'" value="'.$row['cat_name'].'">'.$row['cat_name'].' - '.$row['isrecipe_desc'].'</option>';
                                            }
                                            
                                        }
                                    }
                                    ?>
                                </select>
                        </div>
                        <div class="form-group">
                                <label for="ralergy">Allergies & Restrictions (optional)</label>
                                <?php 
                                $sqla = "SELECT * FROM recipe_allergies ORDER BY allergy_name ASC";

                                $resulta = mysqli_query($conn, $sqla);
                                $queryResulta = mysqli_num_rows($resulta);

                                if($queryResulta > 0) {
                                    while($rowa = mysqli_fetch_array($resulta)) {
                                        $HiddenProducts = explode(',',$ralergy);
                                        if (in_array($rowa['id'], $HiddenProducts)) {
                                            echo '
                                            <div class="custom-checkbox" style="margin-left:15px;">
                                                <div class="form-check">
                                                    <label>
                                                        <input type="checkbox" name="ralergy[]" value="'.$rowa['id'].'" checked> <span class="label-text">'.$rowa['allergy_name'].'</span>
                                                    </label>
                                                </div>
                                                
                                            </div>';
                                        } else {

                                        echo '
                                        <div class="custom-checkbox" style="margin-left:15px;">
                                            <div class="form-check">
                                                <label>
                                                    <input type="checkbox" name="ralergy[]" value="'.$rowa['id'].'" > <span class="label-text">'.$rowa['allergy_name'].'</span>
                                                </label>
                                            </div>
                                            
                                        </div>
                                    
                                        ';
                                        }
                                    }
                                }
                                
                                ?>
                        </div>
                    </div>
                    <div class="center">
                        <Button class="btn btn-lg btn-success center onStep" data-animation="fadeInRightBig" data-time="200">Update</Button>
                        <div class="alert alert-success" id="success-alert1" style="display:none;margin-top:15px;"></div>
                        <div class="alert alert-danger" id="error-alert1" style="display:none;margin-top:15px;"></div>
                    </div>
                </form>
                </div>
                <!-- First Slider end -->

                <!-- Second Slider-->
                <div class="col-md-4 " style="padding:5px;">
                    <div class="onStep" data-animation="fadeInUp" data-time="200">
                            <div style="margin-bottom:15px !important;">
                                <!-- spacer -->
                                <div class="space-half"></div>
                                <h5 style='text-transform: uppercase;' class="center"> Step 2 <br> <small>Add/Edit Your Ingredients</small>
                                <br>
                                <button id="add_ing" data-rid="<?php echo $rid; ?>" type="submit" class="btn btn-success btn-rounded center" style="width:auto; margin-top:10px; height:auto;" value=""><span class="glyphicon glyphicon-plus" style="display: inline-block;margin-top:-5px;"></span> Add Ingredient </button>

                                </h5>
                                <div class="alert alert-success" id="success-alert" style="display:none;margin-top:15px;">
                                    <button type="button" class="close" data-dismiss="alert">x</button>
                                    <strong>Success! </strong> Ingredient have updated to your Recipe!
                                </div>
                                
                            </div>
                    </div>
                    <div id="step_2_now" class="onStep" data-animation="fadeInLeftBig" data-time="200" style="margin: 25px;">
                    <?php 
                    $myid = $rid;
                  include 'recipe_step_2.php'; 
                  
                            
                  ?>                        
                    </div>
                    
                    
                </div>
                <!-- Second Slider end -->

                <!-- Third Slider -->
                <div class="col-md-3" style="padding:5px;">
                    <div class="onStep" data-animation="fadeInUp" data-time="200">
                        <!-- spacer -->
                        <div class="space-half"></div>
                        <h5 style='text-transform: uppercase;' class="center"> Step 3 
                        <br> <small>Creating/Editing Recipe Steps or Direction</small>
                        <br>
                                <button id="add_step" data-rid="<?php echo $rid; ?>" type="submit" class="btn btn-success btn-rounded center" style="width:auto; margin-top:10px; height:auto;" value=""><span class="glyphicon glyphicon-plus" style="display: inline-block;margin-top:-5px;"></span> Add New Step! </button>

                                </h5>
                                <div class="alert alert-success" id="success-alert2" style="display:none;margin-top:15px;">
                                    <button type="button" class="close" data-dismiss="alert">x</button>
                                    <strong>Success! </strong> Direction Step have updated to your Recipe!
                                </div>
                        </h5>
                    </div>
                    <div id="step_3_now" class="onStep" data-animation="fadeInLeftBig" data-time="200" style="margin: 25px;">
                    <?php 
                    $myyid = $rid;
                  include 'recipe_step_3.php'; 
                  
                            
                  ?>                        
                    </div>
                </div>
                <!-- Third Slider end -->

                 <!-- Fourth Slider -->
                <div class="col-md-3" style="padding:5px;">
                    <div class="onStep" data-animation="fadeInUp" data-time="200">
                            <div style="margin-bottom:15px !important;">
                                <!-- spacer -->
                                <div class="space-half"></div>
                                <h5 style='text-transform: uppercase;' class="center"> Step 4 <br> <small>Upload Your Video/Image</small></h5>
                                <div class="alert alert-success" id="success-alert3" style="display:none;margin-top:15px;">
                                    <button type="button" class="close" data-dismiss="alert">x</button>
                                    <strong>Success! </strong> Recipe Media have updated to your Recipe!
                                </div>
                                
                            </div>
                    </div>
                    <div id="step_4_now" class="onStep" data-animation="fadeInLeftBig" data-time="200" style="margin: 25px;">
                    <?php 
                    $myyidd = $rid;
                  include 'recipe_step_4.php'; 
                  
                            
                  ?>      
                        
                    </div>
                </div>
                <!-- Fourth Slider end -->
            
            </div>
        </div>
        
    </div>
</section>
<!-- section -->


<!-- Footer Start/End/JS -->
<?php include 'includes/footer_inc.php'?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css"> -->

<script>
    jQuery( document ).ready(function() {

        //Edit Step1
        
        $('#frmStep1').submit(function (e) {
            e.preventDefault();
            e.stopImmediatePropagation();
        alert("step1 submited! > "+window.rid);
        
        var rname = $('#rname').val();
        var rcate = $( "#rcate option:selected" ).val(); //text()
        var ralergy = new Array();
        $('input[name="ralergy[]"]:checked').each(function(){
            ralergy.push($(this).val());
        });

        $.ajax({
            url: "includes/action.php",
            method: 'POST',
            data: {
            'rname': rname,
            'rcate': rcate,
            'ralergy': ralergy,
            'rid': window.rid,
            'submitStep1': 'true'
            
            },
            //data: { "cid": cid, "asset_name": asset_name, "asset_desc": asset_desc, "datetime1": datetime1, "datetime2": datetime2, "haspic": haspic },

            success: function (response)
            {
                if (response=='true') {
                    //console.log(jsonSensor);
                    var seconds = 6;

                    $("#recipe_results").fadeIn();
                    setInterval(function () {
                        seconds--;
                        $("#success-alert1").html("<br>Recipe Successfully Updated! <br>After <strong>"+seconds+ "</strong> seconds the page will reload!");
                        $("#success-alert1").fadeIn();
                        
                        if (seconds == 0) {
                            window.location.reload();
                            //window.location = "recipe_details.php?rid="+response.insertrecipe;
                            console.log("Countdown Finished!");
                        }
                    }, 1000);
                    
                } else {
                $("#error-alert1").html(response);
                $("#error-alert1").fadeIn();
                }
            }
        });
        //ajax end

        });

        //-----------------------------------
        //--Add Routine Ingredients----------
        //-----------------------------------
        $('#add_ing').click(function (e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            //alert("hello");
            var rid = $(this).attr("data-rid");
            //data-rid
            $.confirm({
                title: 'Add Ingredients! ('+rid+')',
                content: '<form method="post" action="">' + 
                            '<div class="form-group">' +
                                '<label for="iname">Ingredient Name</label>' +
                                '<input type="text" class="form-control" id="iname" name="iname" aria-describedby="iname" placeholder="Enter Ingredient Name" >' +
                            '</div>' +
                            '<div class="form-group">' +
                                '<label for="iname">Preferred Exact Ingredient Name</label>' +
                                '<input type="text" class="form-control" id="ingredientsearchinput" name="ingredientsearchinput" aria-describedby="iname" placeholder="Auto Suggestions Comming up when type!" autocomplete="off">' +
                                '<div class="ingredientSearchList">' +
                                    '<ul>' +
                                    '</ul>' +
                                '</div>' +
                            '</div>' +
                            '<div class="form-group">' +
                                '<label for="iqty">Item UPC</label>' +
                                '<input type="text" class="form-control" id="ingredient-upc" name="ingredient-upc" aria-describedby="ingredient-upc" readonly >' +
                            '</div>' +
                            '<div class="form-group">' +
                                '<label for="ingredient-cat">Ingredient Category</label>' +
                                '<input type="text" class="form-control" id=ingredient-catt name=ingredient-cat readonly >' +
                            '</div>' +
                            '<div class="form-group">' +
                                '<label for="iqty">Quantity</label>' +
                                '<input type="text" class="form-control" id="iqty" name="iqty" aria-describedby="iqty" placeholder="Enter Quantity" >' +
                            '</div>' +
                            '<div class="form-group">' +
                                '<label for="iname">Measurement</label>' +
                                '<select class="form-control form-control-lg" id="measurementSelectt" name="measurementSelect" >' +
                                    '<option name=count value=count>Count (ct)</option>' +
                                    '<option name=ounces value=ounces>Ounces (oz)</option>' +
                                    '<option name=pounds value=pounds>Pounds (lb)</option>' +
                                    '<option name=flOunces value="fl ounces" ounces>Fuild Ounces (fl oz)</option>' +
                                    '<option name=cup value=cup>Cup (c)</option>' +
                                    '<option name=quarts value=quarts>Quarts (qt)</option>' +
                                    '<option name=gallons value=gallons>Gallons (gl)</option>' +
                                    '<option name=grams value=grams>Grams (g)</option>' +
                                '</select>' +
                            '</div>' +
                            '<div class="form-group">' +
                                //'<button class="btn btn-danger" id="submitIngredient" type="submit" name="submitIngredient">Add to Ingredients List</button>' +
                                '<input type="hidden" id="rid" name="rid" value="'+rid+'" >' +
                            '</div>' +
                            '<div id="addresult" class="alert alert-success pull-right" style="padding:3px; margin:3px; font-size:10px; display:none;"></div>' +
                        '</form>',
                        
                buttons: {
                    formSubmit: {
                        text: 'Submit',
                        btnClass: 'btn-blue',
                        action: function () {
                            var submitIng = "Yes";
                            var iname = $('#iname').val();
                            var ingredientsearchinput = $('#ingredientsearchinput').val();
                            var ingredientupc = $('#ingredient-upc').val();
                            var ingredientcat = $('#ingredient-catt').val(); 
                            var iqty = $('#iqty').val(); 
                            var measurementSelect = $('#measurementSelectt').val(); 
                            var rid = $('#rid').val(); 
                            console.log(rid +' | '+ingredientsearchinput);

                            $.ajax({
                                url: 'includes/action.php',
                                method: 'POST',
                                data: {
                                'iname': iname,
                                'ingredientsearchinput': ingredientsearchinput,
                                'ingredientupc': ingredientupc,
                                'ingredientcat': ingredientcat,
                                'iqty': iqty,
                                'measurementSelect': measurementSelect,
                                'rid': rid,
                                'submitIng': submitIng
                                
                                },
                                success: function (response) {
                                console.log(response);
                                $("#step_2_now").fadeOut(100);
                                if ( response == "true") {
                                    // $("#ratresult").html("Ingredient Successfully Submited!");
                                    // $("#ratresult").fadeIn();
                                    $("#success-alert").fadeTo(2000, 500).slideUp(500, function() {
                                        $("#success-alert").slideUp(500);
                                    });
                                    
                                    setTimeout(function() {
                                    //$("#successMessage").hide('blind', {}, 500)
                                        $("#step_2_now").load("recipe_step_2.php?rid="+window.rid).fadeIn(500);
                                    }, 2000);
                                    return false;
                                } else {
                                    alert(response);
                                }
                                // $("#ratresult").html(response);
                                // $("#ratresult").fadeIn();
                                return false;

                                //location.reload(true);
                                }
                            });
                            //var name = this.$content.find('.name').val();
                            //if(!name){
                                //$.alert('provide a valid name');
                                //return false;
                            //}
                            //$.alert('Your name is ' + name);
                        }
                    },
                    cancel: function () {
                        //close
                    },
                },
                onContentReady: function () {
                    // bind to events
                    var jc = this;
                    this.$content.find('form').on('submit', function (e) {
                        // if the user submits the form by pressing enter in the field. $$formSubmit
                        e.preventDefault();
                        jc.$formSubmit.trigger('click'); // reference the button and click it
                        });
                    }
            });
        });

        //-----------------------------------
        //--Add Routine Steps----------------
        //-----------------------------------
        $('#add_step').click(function (e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            //alert("hello");
            var rid = $(this).attr("data-rid");
            var hid_laststep = $('#hid_laststep').val();
            hid_laststep = (hid_laststep * 1) + 1;
            //data-rid
            $.confirm({
                title: 'Add New Direction Step! ',
                columnClass: 'large',
                content: '<form method="post" action="">' + 
                            '<div class="form-group">' + 
                                '<label for="dstep">Step Number</label>' + 
                                '<input type="text" class="form-control" id="dstep" name="dstep" aria-describedby="iname" value="'+hid_laststep+'" readonly>' + 
                            '</div>' + 
                            '<div class="form-group">' + 
                                '<label for="dtext">Direction of the Step!</label>' + 
                                '<textarea class="form-control" cols="45" rows="8" id="dtext" name="dtext" placeholder="Enter Directions for This Step..." ></textarea>' + 
                            '</div>' +
                            '<div class="form-group">' +
                                '<input type="hidden" id="ridd" name="ridd" value="'+rid+'" >' +
                            '</div>' +
                            '<div id="addresult" class="alert alert-success pull-right" style="padding:3px; margin:3px; font-size:10px; display:none;"></div>' +
                        '</form>',
                        
                buttons: {
                    formSubmit: {
                        text: 'Submit',
                        btnClass: 'btn-blue',
                        action: function () {
                            var submitIng = "Yes";
                            var dstep = $('#dstep').val();
                            var dtext = $('#dtext').val();
                            var rid = $('#ridd').val(); 
                            //console.log(rid +' | '+ingredientsearchinput);

                            $.ajax({
                                url: 'includes/action.php',
                                method: 'POST',
                                data: {
                                'dstep': dstep,
                                'dtext': dtext,
                                'rid': rid,
                                'submitStep': submitIng
                                },
                                success: function (response) {
                                console.log(response);
                                $("#step_3_now").fadeOut(100);
                                if ( response == "true") {
                                    // $("#ratresult").html("Ingredient Successfully Submited!");
                                    // $("#ratresult").fadeIn();
                                    $("#success-alert2").fadeTo(2000, 500).slideUp(500, function() {
                                        $("#success-alert2").slideUp(500);
                                    });
                                    
                                    setTimeout(function() {
                                    //$("#successMessage").hide('blind', {}, 500)
                                        $("#step_3_now").load("recipe_step_3.php?rid="+window.rid).fadeIn(500);
                                    }, 2000);
                                    return false;
                                } else {
                                    alert(response);
                                }
                                // $("#ratresult").html(response);
                                // $("#ratresult").fadeIn();
                                return false;

                                //location.reload(true);
                                }
                            });
                            //var name = this.$content.find('.name').val();
                            //if(!name){
                                //$.alert('provide a valid name');
                                //return false;
                            //}
                            //$.alert('Your name is ' + name);
                        }
                    },
                    cancel: function () {
                        //close
                    },
                },
                onContentReady: function () {
                    // bind to events
                    var jc = this;
                    this.$content.find('form').on('submit', function (e) {
                        // if the user submits the form by pressing enter in the field. $$formSubmit
                        e.preventDefault();
                        jc.$formSubmit.trigger('click'); // reference the button and click it
                        });
                    }
            });
        });

        //---------- Upload Video ----------------------------
        $('#uploadVideo').click(function (e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            //alert("hello");
            var rid = $(this).attr("data-rid");
            // var hid_laststep = $('#hid_laststep').val();
            // hid_laststep = (hid_laststep * 1) + 1;
            //data-rid
            $.confirm({
                title: 'Update Recipe Video! ('+rid+')',
                columnClass: 'medium',
                content: '<form method="post" action="">' + 
                            '<div class="form-group">' + 
                                '<label for="dstep">Note:</label>' + 
                                '<p class="help-block">standard video format only <span style="color:red;">.MP4/.MOV</span> files are allowed with <span style="color:red;">100mb</span> filesize.<br>Old video will be removed when uploading new one!</p>' +
                            '</div>' + 
                            '<div class="form-group">' + 
                                '<label for="mp4file">File input' +
                                '<input type="file" name="hasvid" id="hasvid" /> </label>' +
                            '</div>' +
                            '<div class="form-group">' +
                                '<input type="hidden" id="riddd" name="riddd" value="'+rid+'" >' +
                            '</div>' +
                            '<div id="vidresult" class="alert alert-warning pull-right" style="padding:3px; margin:3px; font-size:10px; display:none;"></div>' +
                        '</form>',
                        
                buttons: {
                    formSubmit: {
                        text: 'Upload Video Now',
                        btnClass: 'btn-blue',
                        action: function () {
                            var hasvid = $('#hasvid')[0].files[0];
                            var rid = $('#riddd').val(); 
                            if(!hasvid){
                                $.alert('You must choose Video!');
                                $('#vidresult').html('You must choose Video!').fadeIn();
                                return false;
                            }
                            //console.log(rid +' | '+ingredientsearchinput);
                            console.log("submit event");
                            var jform = new FormData();
                            jform.append('ridoften',$('#riddd').val());
                            jform.append('file',$('#hasvid').get(0).files[0]); // Here's the important bit


                            $.ajax({
                                url: 'includes/action.php',
                                type: "POST",
                                data: jform,
                                mimeTypes:"multipart/form-data",
                                contentType: false,
                                cache: false,
                                processData: false,
                                
                                // method: 'POST',
                                // processData: false,
                                // contentType: false,
                                // data: {
                                // 'hasvid': hasvid,
                                // 'rid': rid
                                // },
                                success: function (response) {
                                console.log(response);
                                
                                if (response.indexOf("has been uploaded") >= 0) {

                                    //alert(response);
                                    $("#step_4_now").fadeOut(100);
                                    $("#success-alert3").fadeTo(2000, 500).slideUp(500, function() {
                                        $("#success-alert3").slideUp(500);
                                    });
                                    
                                    setTimeout(function() {
                                    //$("#successMessage").hide('blind', {}, 500)
                                        $("#step_4_now").load("recipe_step_4.php?rid="+window.rid).fadeIn(500);
                                    }, 2000);
                                    return false;
                                } else {
                                    //alert(response);
                                    $("#error-alert33").html(response);
                                    $("#error-alert33").fadeIn();
                                    return false;
                                }
                                
                                //$("#vidresult").html(response);
                                // $("#ratresult").fadeIn();
                                return false;

                                //location.reload(true);
                                }
                            });
                            //var name = this.$content.find('.name').val();
                            //if(!name){
                                //$.alert('provide a valid name');
                                //return false;
                            //}
                            //$.alert('Your name is ' + name);
                        }
                    },
                    cancel: function () {
                        //close
                    },
                },
                onContentReady: function () {
                    // bind to events
                    var jc = this;
                    this.$content.find('form').on('submit', function (e) {
                        // if the user submits the form by pressing enter in the field. $$formSubmit
                        e.preventDefault();
                        jc.$formSubmit.trigger('click'); // reference the button and click it
                        });
                    }
            });
        });

        //---------- Upload Picture ----------------------------
        $('#uploadPicture').click(function (e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            //alert("hello");
            var rid = $(this).attr("data-rid");
            // var hid_laststep = $('#hid_laststep').val();
            // hid_laststep = (hid_laststep * 1) + 1;
            //data-rid
            $.confirm({
                title: 'Update Recipe Picture! ('+rid+')',
                columnClass: 'medium',
                content: '<form method="post" action="">' + 
                            '<div class="form-group">' + 
                                '<label for="dstep">Note:</label>' + 
                                '<p class="help-block">standard picture format only <span style="color:red;">.JPG / .JPEG / .PNG / .GIF</span> files are allowed with <span style="color:red;">600KB</span> filesize.<br>Old picture will be removed when uploading new one!</p>' +
                            '</div>' + 
                            '<div class="form-group">' + 
                                '<label for="haspic">File input' +
                                '<input type="file" name="haspic" id="haspic" required/> </label>' +
                            '</div>' +
                            '<div class="form-group">' +
                                '<input type="hidden" id="riddd" name="riddd" value="'+rid+'" >' +
                            '</div>' +
                            '<div id="picresulterr" class="alert alert-danger pull-right" style="padding:3px; margin:3px; font-size:10px; display:none;"></div>' +
                        '</form>',
                        
                buttons: {
                    formSubmit: {
                        text: 'Upload Picture Now',
                        btnClass: 'btn-blue',
                        action: function () {
                            var haspic = $('#haspic')[0].files[0];
                            var rid = $('#riddd').val(); 
                            if(!haspic){
                                $.alert('You must choose file!');
                                return false;
                            }
                            //console.log(rid +' | '+ingredientsearchinput);
                            console.log("submit event");
                            var jform = new FormData();
                            jform.append('ridoftenPic',$('#riddd').val());
                            jform.append('file',$('#haspic').get(0).files[0]); // Here's the important bit


                            $.ajax({
                                url: 'includes/action.php',
                                type: "POST",
                                data: jform,
                                mimeTypes:"multipart/form-data",
                                contentType: false,
                                cache: false,
                                processData: false,
                                
                                // method: 'POST',
                                // processData: false,
                                // contentType: false,
                                // data: {
                                // 'hasvid': hasvid,
                                // 'rid': rid
                                // },
                                success: function (response) {
                                console.log(response);
                                
                                //if ( response ) {
                                if (response.indexOf("has been uploaded") >= 0) {

                                    //alert(response);
                                    
                                    $("#success-alert3").fadeTo(2000, 500).slideUp(500, function() {
                                         $("#success-alert3").slideUp(500);
                                     });
                                    
                                    $("#step_4_now").fadeOut(100);
                                    setTimeout(function() {
                                        $("#step_4_now").load("recipe_step_4.php?rid="+window.rid).fadeIn(500);
                                    }, 2000);
                                    return false;

                                } else {
                                   // alert(response);
                                    $("#error-alert3").html(response);
                                    $("#error-alert3").fadeIn();

                                    //$("#picresulterr").fadeIn();
                                    return false

                                }
                                // $("#picresult").html(response);
                                //     $("#picresult").fadeIn();
                                return false;

                                //location.reload(true);
                                }
                            });
                            //var name = this.$content.find('.name').val();
                            //if(!name){
                                //$.alert('provide a valid name');
                                //return false;
                            //}
                            //$.alert('Your name is ' + name);
                        }
                    },
                    cancel: function () {
                        //close
                    },
                },
                onContentReady: function () {
                    // bind to events
                    var jc = this;
                    this.$content.find('form').on('submit', function (e) {
                        // if the user submits the form by pressing enter in the field. $$formSubmit
                        e.preventDefault();
                        jc.$formSubmit.trigger('click'); // reference the button and click it
                        });
                    }
            });
        });
        // $("#pushmee").click(function(e) {
        //     e.preventDefault();
        //     e.stopImmediatePropagation();
        //     $("#step_2_now").load("recipe_step_2.php?rid="+window.rid);
        // })
        // Text Editor Call------------------
        

    });

    //-----------------------------------
    //--Add to List Routine-------------------
    //-----------------------------------
    // function addtoList(iupc, iqty, iuid) {
    //     //alert(ingred);
    //     //var ingnam = $(this).attr("data-ingnam");
    //     //var ingnam =$(this).attr("ingnam");


    //     return;
    //     $.ajax({
    //         url: 'includes/action.php',
    //         method: 'POST',
    //         data: {
    //         'rec_upc': iupc,
    //         'rec_qty': iqty,
    //         'rec_uid': iuid
    //         },
    //         success: function (response) {
    //         console.log(response);
    //         $("#step_2_now").fadeOut(100);
    //         if ( response == "true") {
    //             $("#success-alert").fadeTo(2000, 500).slideUp(500, function() {
    //                 $("#success-alert").slideUp(500);
    //             });
                
    //             setTimeout(function() {
    //                 $("#step_2_now").load("recipe_step_2.php?rid="+window.rid).fadeIn(500);
    //             }, 2000);
    //             return false;
    //         } else {
    //             alert(response);
    //         }
    //         return false;

    //         //location.reload(true);
    //         }
    //     });

    //     $.confirm({
    //         title: 'Delete Ingredient ? ID: '+iupc,
    //         content: 'This dialog will automatically trigger \'cancel\' in 5 seconds if you don\'t respond.',
    //         autoClose: 'cancelAction|5000',
    //         buttons: {
    //             deleteUser: {
    //                 text: 'delete user',
    //                 action: function () {
    //                     //$.alert('Deleted the user!');
    //                     var ingideleteid = iupc;
    //                     console.log('DelID: '+iupc);                        
    //                     //var name = this.$content.find('.name').val();
    //                     //if(!name){
    //                         //$.alert('provide a valid name');
    //                         //return false;
    //                     //}
    //                     //$.alert('Your name is ' + name);
    //                 }
    //             },
    //             cancelAction: function () {
    //                 $.alert('action is canceled');
    //             }
    //         }
    //     });
    // }
    //-----------------------------------
    //--Delete Routine-------------------
    //-----------------------------------
    function deleteMe(ingred) {
        //alert(ingred);
        //var ingnam = $(this).attr("data-ingnam");
        //var ingnam =$(this).attr("ingnam");
        $.confirm({
            title: 'Delete Ingredient ? ID: '+ingred,
            content: 'This dialog will automatically trigger \'cancel\' in 5 seconds if you don\'t respond.',
            autoClose: 'cancelAction|5000',
            buttons: {
                deleteUser: {
                    text: 'delete user',
                    action: function () {
                        //$.alert('Deleted the user!');
                        var ingideleteid = ingred;
                        console.log('DelID: '+ingred);

                        $.ajax({
                            url: 'includes/action.php',
                            method: 'POST',
                            data: {
                            'ingideleteid': ingideleteid                           
                            },
                            success: function (response) {
                            console.log(response);
                            $("#step_2_now").fadeOut(100);
                            if ( response == "true") {
                                $("#success-alert").fadeTo(2000, 500).slideUp(500, function() {
                                    $("#success-alert").slideUp(500);
                                });
                                
                                setTimeout(function() {
                                    $("#step_2_now").load("recipe_step_2.php?rid="+window.rid).fadeIn(500);
                                }, 2000);
                                return false;
                            } else {
                                alert(response);
                            }
                            return false;

                            //location.reload(true);
                            }
                        });
                        //var name = this.$content.find('.name').val();
                        //if(!name){
                            //$.alert('provide a valid name');
                            //return false;
                        //}
                        //$.alert('Your name is ' + name);
                    }
                },
                cancelAction: function () {
                    $.alert('action is canceled');
                }
            }
        });
    }

    function deleteMeStep(disteps) {
        //alert(ingred);
        //var ingnam = $(this).attr("data-ingnam");
        //var ingnam =$(this).attr("ingnam");
        $.confirm({
            title: 'Delete Direction Step ? ID: '+disteps,
            content: 'This dialog will automatically trigger \'cancel\' in 5 seconds if you don\'t respond.',
            autoClose: 'cancelAction|5000',
            buttons: {
                deleteUser: {
                    text: 'Delete Direction Step',
                    action: function () {
                        //$.alert('Deleted the user!');
                        var directiondelid = disteps;
                        console.log('DelID: '+disteps);

                        $.ajax({
                            url: 'includes/action.php',
                            method: 'POST',
                            data: {
                            'directiondelid': directiondelid                           
                            },
                            success: function (response) {
                            console.log(response);
                            $("#step_3_now").fadeOut(100);
                            if ( response == "true") {
                                $("#success-alert2").fadeTo(2000, 500).slideUp(500, function() {
                                    $("#success-alert2").slideUp(500);
                                });
                                
                                setTimeout(function() {
                                    $("#step_3_now").load("recipe_step_3.php?rid="+window.rid).fadeIn(500);
                                }, 2000);
                                return false;
                            } else {
                                alert(response);
                            }
                            return false;

                            //location.reload(true);
                            }
                        });
                        //var name = this.$content.find('.name').val();
                        //if(!name){
                            //$.alert('provide a valid name');
                            //return false;
                        //}
                        //$.alert('Your name is ' + name);
                    }
                },
                cancelAction: function () {
                    $.alert('action is canceled');
                }
            }
        });
    }
    //-----------------------------------
    //--Edit Routine----------------------
    //-----------------------------------
    function editMe(ingred) {
            //return alert(ingred);   // The function returns the product of p1 and p2
            // e.preventDefault();
            // e.stopImmediatePropagation();
            //alert("hello");
            $.confirm({
                title: 'Edit Ingredients!',
                content: 'url:includes/edit_recipe_inc.php?rid='+ingred,
                onContentReady: function () {
                    var self = this;
                    this.setContentPrepend('<div*</div>');
                    setTimeout(function () {
                        self.setContentAppend('<div>*</div>');
                    }, 2000);
                },
                        
                buttons: {
                    formSubmit: {
                        text: 'Submit',
                        btnClass: 'btn-blue',
                        action: function () {
                            var submitIng = "Yes";
                            var iname = $('#iname').val();
                            var ingredientsearchinput = $('#ingredientsearchinput').val();
                            var ingredientupc = $('#ingredient-upc').val();
                            var ingredientcat = $('#ingredient-catt').val(); 
                            var iqty = $('#iqty').val(); 
                            var measurementSelect = $('#measurementSelectt').val(); 
                            var ingredient_hid = $('#ingredient_hid').val(); 
                            console.log(rid +' | '+ingredientsearchinput);
                            $.ajax({
                                url: 'includes/action.php',
                                method: 'POST',
                                data: {
                                'iname': iname,
                                'ingredientsearchinput': ingredientsearchinput,
                                'ingredientupc': ingredientupc,
                                'ingredientcat': ingredientcat,
                                'iqty': iqty,
                                'measurementSelect': measurementSelect,
                                'ingredient_hid': ingredient_hid,
                                'submitIng': submitIng
                                
                                },
                                success: function (response) {
                                console.log(response);
                                $("#step_2_now").fadeOut(100);
                                if ( response == "true") {
                                    // $("#ratresult").html("Ingredient Successfully Submited!");
                                    // $("#ratresult").fadeIn();
                                    $("#success-alert").fadeTo(2000, 500).slideUp(500, function() {
                                        $("#success-alert").slideUp(500);
                                    });
                                    
                                    setTimeout(function() {
                                    //$("#successMessage").hide('blind', {}, 500)
                                        $("#step_2_now").load("recipe_step_2.php?rid="+window.rid).fadeIn(500);
                                    }, 1000);
                                    return false;
                                } else {
                                    alert(response);
                                }
                                // $("#ratresult").html(response);
                                // $("#ratresult").fadeIn();
                                return false;

                                //location.reload(true);
                                }
                            });
                            //var name = this.$content.find('.name').val();
                            //if(!name){
                                //$.alert('provide a valid name');
                                //return false;
                            //}
                            //$.alert('Your name is ' + name);
                        }
                    },
                    cancel: function () {
                        //close
                    },
                },
                onContentReady: function () {
                    // bind to events
                    var jc = this;
                    this.$content.find('form').on('submit', function (e) {
                        // if the user submits the form by pressing enter in the field. $$formSubmit
                        e.preventDefault();
                        jc.$formSubmit.trigger('click'); // reference the button and click it
                        });
                    }
            });
    }
    //------------------------------------------------------
    function editMeStep(disteps) {
            //return alert(ingred);   // The function returns the product of p1 and p2
            // e.preventDefault();
            // e.stopImmediatePropagation();
            //alert("hello");
            $.confirm({
                title: 'Edit Direction Steps!'+disteps,
                content: 'url:includes/edit_dirstep_inc.php?did='+disteps,
                columnClass: 'large',
                onContentReady: function () {
                    var self = this;
                    this.setContentPrepend('<div*</div>');
                    setTimeout(function () {
                        self.setContentAppend('<div>*</div>');
                    }, 2000);
                },

                buttons: {
                    formSubmit: {
                        text: 'Submit',
                        btnClass: 'btn-blue',
                        action: function () {
                            var submitIng = "Yes";
                            var dstep = $('#dstep').val();
                            var dtext = $('#dtext').val();
                            var directions_hid = $('#directions_hid').val(); 
                            //console.log(rid +' | '+ingredientsearchinput);
                            $.ajax({
                                url: 'includes/action.php',
                                method: 'POST',
                                data: {
                                'dstep': dstep,
                                'dtext': dtext,
                                'directions_hid': directions_hid,
                                'submitStep': submitIng
                                
                                },
                                success: function (response) {
                                console.log(response);
                                $("#step_3_now").fadeOut(100);
                                if ( response == "true") {
                                    // $("#ratresult").html("Ingredient Successfully Submited!");
                                    // $("#ratresult").fadeIn();
                                    $("#success-alert2").fadeTo(2000, 500).slideUp(500, function() {
                                        $("#success-alert2").slideUp(500);
                                    });
                                    
                                    setTimeout(function() {
                                    //$("#successMessage").hide('blind', {}, 500)
                                        $("#step_3_now").load("recipe_step_3.php?rid="+window.rid).fadeIn(500);
                                    }, 1000);
                                    return false;
                                } else {
                                    alert(response);
                                }
                                // $("#ratresult").html(response);
                                // $("#ratresult").fadeIn();
                                return false;

                                //location.reload(true);
                                }
                            });
                            //var name = this.$content.find('.name').val();
                            //if(!name){
                                //$.alert('provide a valid name');
                                //return false;
                            //}
                            //$.alert('Your name is ' + name);
                        }
                    },
                    cancel: function () {
                        //close
                    },
                },
                onContentReady: function () {
                    // bind to events
                    var jc = this;
                    this.$content.find('form').on('submit', function (e) {
                        // if the user submits the form by pressing enter in the field. $$formSubmit
                        e.preventDefault();
                        jc.$formSubmit.trigger('click'); // reference the button and click it
                        });
                    }
            });
    }

</script>

</html>