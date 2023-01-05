<!DOCTYPE html>
<html lang="en">

<?php 

error_reporting( 0 );
include_once 'includes/dbh.inc.php';
include 'includes/header_inc.php'; 

// if (!isset($_SESSION['u_id'])) { 
//     header("Location: myaccount.php");
//     exit(); 
// }

?>


        <section class="whitepage">
            <div class="container-fluid">
                <div class="row">
                    <!-- <div class="no-gutter"> -->
                    <div id="topbar" style=";">
                        <div class="content-crumb-div" >
                                <a class="fileTrail" href="index.php">Home</a> 
                                <i style="font-size: 1rem;" class="fa fa-arrow-right"></i>
                                <a class="fileTrail" href="recipes.php">Recipes</a>
                                <i style="font-size: 1rem;" class="fa fa-arrow-right"></i> 
                                Create New Recipe!

                        </div>
                    </div>
                    <!-- </div> -->
                </div>
                <div class="row">
                    <div class="no-gutter">


                        <!-- content left -->
                        <div class="col-md-2 onStep" data-animation="fadeInLeft" data-time="0" style="background-color:#F8F7F5 !important; min-height: 800px !important;">

                            <div class="col-md-12 col-xs-10">
                                <!-- spacer -->
                                <!-- <div class="space-half"></div> -->
                                <!-- <div class="space-double hidden-sm hidden-xs"></div> -->
                                <!-- spacer end -->
                                <!-- <div class="subtitle">
                                    <h5 style="color:#333; ">Products Category List</h5>
                                </div> -->
                                <div class="row">
                                        <?php if ($_GET['htype']=='Groceries') { ?>
                                        <div id="groc">
                                        <h5 style="text-transform: capitalize; margin-left:15px;">Product Categories</h5>
                                            <?php

                                            $sql = "SELECT cat_name FROM categories ORDER BY cat_name ASC";

                                            $result = mysqli_query($conn, $sql);
                                            $queryResult = mysqli_num_rows($result);
                                    
                                            if($queryResult > 0) {
                                                while($row = mysqli_fetch_array($result)) {
                                                    echo "<a class='categoryContainer' href='results.php?htype=Groceries&catSelect=".trim($row['cat_name'])."&search='>
                                                    <div class='col-sm-12'>
                                                        <p class='categoryContainer' ><strong>".$row['cat_name']."</strong></p>        
                                                    </div></a>"; //categoryContainer  searchHint2
                                                }
                                            }
                                            ?>  
                                        </div>
                                        <?php } else { ?>
                                        <div id="recip">
                                            <h5 style="color:white;text-transform: uppercase;">Recipe Categories</h5>
                                                <a href='results.php?htype=Recipes&catSelect=&search='>
                                                   <div class='col-sm-4 categoryContainer'>
                                                        <p class='searchHint2'><strong>N/A</strong></p>        
                                                    </div>
                                                </a>
                                            <?php
                                            //$sql = "SELECT cat_name FROM categories ORDER BY cat_name ASC";

                                            //$result = mysqli_query($conn, $sql);
                                            //$queryResult = mysqli_num_rows($result);
                                    
                                            //if($queryResult > 0) {
                                                //while($row = mysqli_fetch_array($result)) {
                                                    //echo "<a href='results.php?htype=Groceries&catSelect=".trim($row['cat_name'])."&search='>
                                                    //<div class='col-sm-4 categoryContainer'>
                                                    //    <p class='searchHint2'><strong>".$row['cat_name']."</strong></p>        
                                                    //</div></a>";
                                                //}
                                            //}
                                            ?>  
                                        </div>
                                        <?php } ?>  
                                    </div>
                            </div>


                        </div>
                        <!-- content left end -->

                        <!-- content right -->
                        <div class="col-md-10" style="">

                            <!-- spacer -->
                            <!-- <div class="space-single hidden-sm hidden-xs"></div> -->
                            <div class="space-half"></div>
                            <!-- spacer end -->

                            <!-- wrapper -->
                            <!-- <div class="row"> -->
                            <!-- <div class="col-md-10 col-md-offset-1 col-sm-11 col-sm-offset-1 col-xs-11 col-xs-offset-1 pull-left"> -->

                            <!-- row content -->
                            <div class="row">

                                <!-- left content -->
                                <div class="col-md-12">
                                    <div class="onStep" data-animation="fadeInUp" data-time="300">

                                        <div style="margin:25px !important;">
                                        <h3 class="center" data-animation="fadeInUp" data-time="300">Create New Recipe!</h3>
                                        </div>
                                        <section>
                                            <div class="wizard" style="margin-left:20px;margin-right:20px;">
                                                <div class="wizard-inner">
                                                    <div class="connecting-line"></div>
                                                    <ul class="nav nav-tabs" role="tablist">

                                                        <li role="presentation" class="active">
                                                            <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="Step 1">
                                                                <span class="round-tab">
                                                                    <i class="fa fa-folder-open"></i>
                                                                </span>
                                                            </a>
                                                        </li>

                                                        <li role="presentation" class="disabled">
                                                            <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="Step 2">
                                                                <span class="round-tab">
                                                                    <i class="fa fa-edit"></i>
                                                                </span>
                                                            </a>
                                                        </li>
                                                        <li role="presentation" class="disabled">
                                                            <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="Step 3">
                                                                <span class="round-tab">
                                                                    <i class="fa fa-list"></i>
                                                                </span>
                                                            </a>
                                                        </li>
                                                        
                                                        <li role="presentation" class="disabled">
                                                            <a href="#complete" data-toggle="tab" aria-controls="complete" role="tab" title="Final Step 4">
                                                                <span class="round-tab">
                                                                    <i class="fa fa-camera-retro"></i>
                                                                </span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <!-- fa fa-cutlery -->
                                                <form role="form">
                                                    <div class="tab-content">
                                                        <div class="tab-pane active" role="tabpanel" id="step1">
                                                            <h5 class="center">STEP 1 <br> <small>Name Your Recipe</small></h5>
                                                            <div class="form-group">
                                                            <label for="rname">Recipe Name</label>
                                                            <input type="text" class="form-control" id="rname" name="rname" aria-describedby="rname" placeholder="Enter Recipe Name" required="required">
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
                                                                           echo '<option name="'.$row['id'].'" value="'.$row['cat_name'].'">'.$row['cat_name'].' - '.$row['isrecipe_desc'].'</option>';
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
                                                                
                                                                ?>
                                                            </div>

                                                            <ul class="list-inline pull-right">
                                                                <li><button type="button" class="btn btn-success next-step">Next Step</button></li>
                                                            </ul>
                                                        </div>
                                                        <div class="tab-pane" role="tabpanel" id="step2">
                                                            <h5 class="center">STEP 2<br> <small>Generate Your Ingredients</small> </h5>
                                                            <div class="col-md-12">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="iname">Ingredient Name</label>
                                                                        <input type="text" class="form-control" id="iname" name="iname" aria-describedby="iname" placeholder="Enter Ingredient Name" >
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="iname">Preferred Exact Ingredient Name</label>
                                                                        <input type="text" class="form-control" id="ingredientsearchinput" name="ingredientsearchinput" aria-describedby="iname" placeholder="Auto Suggestions Comming up when type!" autocomplete="off">
                                                                        <div class='ingredientSearchList'>
                                                                            <ul>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="iqty">Item UPC</label>
                                                                        <input type="text" class="form-control" id="ingredient-upc" name="ingredient-upc" aria-describedby="ingredient-upc" readonly >
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="ingredient-cat">Ingredient Category</label>
                                                                        <input type='text' class="form-control" id=ingredient-cat name=ingredient-cat readonly >
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="iqty">Quantity</label>
                                                                        <input type="text" class="form-control" id="iqty" name="iqty" aria-describedby="iqty" placeholder="Enter Quantity" >
                                                                    </div>
                                                                    
                                                                    <div class="form-group">
                                                                        <label for="measurementSelect">Measurement</label>
                                                                        <select class="form-control form-control-lg" id="measurementSelect" name="measurementSelect" >
                                                                            <option name=count value=count>Count (ct)</option>
                                                                            <option name=ounces value=ounces>Ounces (oz)</option>
                                                                            <option name=pounds value=pounds>Pounds (lb)</option>
                                                                            <option name=flOunces value='fl ounces' ounces>Fuild Ounces (fl oz)</option>
                                                                            <option name=cup value=cup>Cup (c)</option>
                                                                            <option name=quarts value=quarts>Quarts (qt)</option>
                                                                            <option name=gallons value=gallons>Gallons (gl)</option>
                                                                            <option name=grams value=grams>Grams (g)</option>
                                                                        </select>
                                                                    </div>
                                                                    
                                                                    <div class="form-group">
                                                                        <button class='btn btn-danger' id='submitIngredient' type='submit' name='submitIngredient'>Add to Ingredients List</button>
                                                                        <input type="hidden" id="jsonList" name="jsonList" >
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <h5 class="center">Ingredient List</h5>
                                                                    <div id="ilistshow" style="margin:15px;">
                                                                    <table class='table table-striped'><thead><tr><th>S.No.</th><th>Ingredient Name</th><th>Quantity</th><th>Measurement</th><th>Category</th></tr></thead><tbody><tr><td colspan="5">No Ingredient Yet!</td></tr></tbody></table>
                                                                    
                                                                    </div>
                                                                </div>
                                                            </div>


                                                            <ul class="list-inline pull-right">
                                                                <li><button type="button" class="btn btn-danger prev-step">Previous</button></li>
                                                                <li><button type="button" class="btn btn-success next-step">Done with Ingredients, Next Step</button></li>
                                                            </ul>
                                                        </div>
                                                        <div class="tab-pane" role="tabpanel" id="step3">
                                                            <h5 class="center">STEP 3<br> <small>Creating Recipe Steps or Direction</small></h5>
                                                            <div class="col-md-12">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="dstep">Step Number</label>
                                                                        <input type="text" class="form-control" id="dstep" name="dstep" aria-describedby="iname" value="1" readonly>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="dtext">Direction of the Step!</label>
                                                                        <textarea class="form-control" cols="45" rows="8" id='dtext' name='dtext' placeholder='Enter Directions for This Step...' ></textarea>
                                                                    </div>
                                                                    
                                                                    <div class="form-group">
                                                                        <button class='btn btn-danger' id='submitDirections' type='submit' name='submitDirections'>Add to Direction List</button>
                                                                        <!-- <input type="hidden" id="jsonList" name="jsonList" > -->
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <h5 class="center">Direction List</h5>
                                                                    <div id="istepshow" style="margin:15px;">
                                                                    <table class='table table-striped'><thead><tr><th>Step#</th><th>Direction</th></tr></thead><tbody><tr><td colspan="2">No Direction Yet!</td></tr></tbody></table>
                                                                    
                                                                    </div>
                                                                </div>
                                                            </div>


                                                            <ul class="list-inline pull-right">
                                                                <li><button type="button" class="btn btn-danger prev-step">Previous</button></li>
                                                                <li><button type="button" class="btn btn-success next-step">Done with Direction, Next Step</button></li>
                                                            </ul>
                                                        </div>
                                                        <div class="tab-pane" role="tabpanel" id="complete">
                                                            <h5 class="center">FINAL STEP 4<br> <small>Upload Your Video/Image</small></h5><br><br>
                                                            <div class="col-md-12 center">
                                                                <div class="checkbox">
                                                                    <label>
                                                                    <input type="checkbox" id="chkfile" name="chkfile" value="Yes"> Want to Upload Picture Now or Later ?
                                                                    </label>
                                                                </div>
                                                                <div id="myupload" class="form-group" style="display:none;">
                                                                    <label for="mp4file">File input
                                                                    <input type='file' name='haspic' id='haspic' /> </label>
                                                                    
                                                                    <!-- <p class="help-block">Note: *.mp4 with H264 standard for encoding only with 25mb filesize.</p> -->
                                                                    <p class="help-block">Note: standard picture formats only JPG, JPEG, PNG & GIF files are allowed with 5mb filesize.</p>
                                                                </div>
                                                                <div id="recipe_results" class="alert alert-success center" style="width:70%; margin-bottom:50px; display:none; ">  </div>
                                                            </div>
                                                            
                                                            
                                                            

                                                            <ul class="list-inline pull-right">
                                                                <li><button type="button" class="btn btn-danger prev-step">Previous</button></li>
                                                                <li><button type="submit" id="submitRecipe" name="submitRecipe" class="btn btn-success next-step">Save & Create Recipe Now!</button></li>
                                                            </ul>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </form>
                                            </div>
                                        </section>

                                    </div>
                                </div>
                                <!-- left content end -->

                            </div>
                            <!-- row content end -->
                            

                            <!-- spacer -->
                            <!-- <div class="space-single"></div> -->

                        </div>
                        <!-- content right end -->

                    </div>
                </div>
            </div>
        </section>
        <!-- section -->


<!-- Footer Start/End/JS -->
<?php include 'includes/footer_inc.php'?>

</html>