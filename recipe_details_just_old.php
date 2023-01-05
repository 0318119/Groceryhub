
<!DOCTYPE html>
<html lang="en">

<?php 

error_reporting( 0 );
include_once 'includes/dbh.inc.php';
include 'includes/header_inc.php'; 


?>



        <section class="whitepage">
            <div class="container-fluid">
                <div class="row">
                    <!-- <div class="no-gutter"> -->
                    <div id="topbar" style="">
                    <?php 

                    if(isset($_GET['rid'])) {
                        $rid = mysqli_real_escape_string($conn, $_GET['rid']);
                        echo '<script>window.upc="'.$rid.'";</script>';
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
                                //echo "<h4 class=searchResults><a href='results.php?catSelect=" . htmlspecialchars($item_cat) . "&subCatSelect=&search='>$item_cat</a> / <a href='results.php?catSelect=" . htmlspecialchars($item_cat) . "&subCatSelect=" . htmlspecialchars($item_sub_cat) . "&search='>$item_sub_cat</a> / $item_name</h4><br><br>";
                    ?>
                        <div class="content-crumb-div" >
                                <a class="fileTrail" href="index.php">Home</a> 
                                <i style="font-size: 1rem;" class="fa fa-arrow-right"></i> 
                                <a class="fileTrail" href="recipes.php">Recipes</a>
                                <i style="font-size: 1rem;" class="fa fa-arrow-right"></i> 
                                <a class="fileTrail" href="<?php echo "results.php?htype=Recipes&catSelect=" . htmlspecialchars($rcate) . "&subCatSelect=&search=" ?>"><?php echo $rcate; ?></a>
                                <i style="font-size: 1rem;" class="fa fa-arrow-right"></i> 
                                <?php echo $rname; ?>

                        </div>
                    
                    </div>
                    <!-- </div> -->
                </div>
                <div class="row">
                    <div class="no-gutter">
                        <!-- Left Area -->
                        <div class="col-md-2 onStep hidden-xs" data-animation="fadeInLeft" data-time="0" style="background-color:#F8F7F5 !important; height: 1400px !important;">
                            <div class="col-md-12">
                                <!-- spacer -->
                                <!-- <div class="space-half"></div> -->
                                <!-- <div class="space-double hidden-sm hidden-xs"></div> -->
                                <!-- spacer end -->
                                <!-- <div class="subtitle">
                                    <h5 style="color:#333; ">Products Category List</h5>
                                </div> -->
                                <div class="row">
                                        
                                        
                                        <div id="recip">
                                            <h5 style="margin-top:15px; text-transform: capitalize; margin-left:15px; position:relative;">Recipe Categories</h5>
                                            <br>
                                            <?php

                                            $sql88 = "SELECT cat_name, isrecipe_desc FROM categories WHERE isrecipe=1 ORDER BY cat_name ASC";

                                            $result88 = mysqli_query($conn, $sql88);
                                            $queryResult88 = mysqli_num_rows($result88);
                                    
                                            if($queryResult88 > 0) {
                                                while($row88 = mysqli_fetch_array($result88)) {
                                                    echo "<a class='categoryContainer' href='results.php?htype=Recipes&catSelect=".trim($row88['cat_name'])."&search='>
                                                    <div class='col-sm-12'>
                                                        <p class='categoryContainer' ><strong>".$row88['cat_name']."</strong> <span class='badge bg-primary' style='font-size:8px; padding:5px;margin:5px; display:inline-block;'>".$row88['isrecipe_desc']."</span> </p>        
                                                    </div></a>"; //categoryContainer  searchHint2
                                                }
                                            }
                                            ?>  
                                            
                                            
                                            <div class="space-half"></div>
                                            <!-- spacer end -->
                                            <h5 style="text-transform: capitalize; margin-left:15px;  position:relative;">Allergies & Restrictions  </h5>
                                            
                                            <?php

                                            $sql99 = "SELECT * FROM recipe_allergies ORDER BY allergy_name ASC";

                                            $result99 = mysqli_query($conn, $sql99);
                                            $queryResult99 = mysqli_num_rows($result99);

                                            if($queryResult99 > 0) {
                                                while($row99 = mysqli_fetch_array($result99)) {
                                                    
                                                    echo '
                                                    <form>
                                                        <div class="custom-checkbox" style="margin-left:15px;">
                                                        <div class="form-check">
                                                            <label>
                                                                <input type="checkbox" name="alergy[]" value="'.$row99['id'].'"> <span class="label-text">'.$row99['allergy_name'].'</span>
                                                            </label>
                                                        </div>
                                                        
                                                        </div>
                                                    </form>
                                                    
                                                    ';


                                                }
                                            }
                                            ?>  

                                            


                                        </div>
                                      
                                    </div>
                            </div>
                        </div>
                        
                        <!-- Recipe Details Coming  -->
                        <div class="col-md-8 col-sm-12">
                            <div class="col-md-6 onStep" data-animation="fadeInLeft" data-time="0" style="background-color:#fff !important; ">
                                <div class="col-md-12 col-sm-12">
                                    <?php 
                                    //------------------------------------------------------------------------------------------------
                            echo '
                            <div class="col-md-12">
                                <div id="gallery">
                                <div id="panel">';

                            echo '<div id="myCarousel" class="carousel slide" data-ride="carousel" >
                            <!-- Wrapper for slides -->
                            <div class="carousel-inner" role="listbox" style="max-height:400px !important;">';
                                $myactive = true;
                                if ($row['hasvid']!="") { 
                                    echo '
                                    <div class="item active" data-slide-number="0">
                                        <div class="embed-responsive embed-responsive-16by9">
                                            <video controls autoplay>
                                                <source src="img/recipes/'.$row['hasvid'].'" type="video/mp4">
                                            </video>
                                        </div>
                                    </div>';  
                                } else {
                                    $myactive = false;
                                }

                                if ($row['haspic'] != "") {
                                    $filename = "img/recipes/".$row['haspic'];
                                    if ($myactive == false) {
                                        echo '<div class="item active" data-slide-number="1">';
                                    } else {
                                        echo '<div class="item" data-slide-number="1">';
                                    }
                                
                                echo "<img class='img-responsive center recimg' src='".$filename."' alt='".$row['haspic']."' style=''/>
                                        </div>";
                                
                                } else {
                                    if ($myactive == false) {
                                        echo '<div class="item active">';
                                    } else {
                                        echo '<div class="item">';
                                    }
                                echo "<img src='' alt='error' onerror=this.src='img/noimageavailable.png' />
                                        </div>"; 
                                }

                                
                                    
                                            
                           echo '
                            
                            </div>
                            <!-- Carousel Navigation -->
                            <div id="carousel-thumbs" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <div class="row mx-0">
                                            <div id="carousel-selector-0" class="thumb col-4 col-sm-2 px-1 py-2 selected" data-target="#myCarousel" data-slide-to="0">
                                            <img src="https://source.unsplash.com/Pn6iimgM-wo/600x400/" class="img-fluid" alt="...">
                                            </div>
                                            <div id="carousel-selector-1" class="thumb col-4 col-sm-2 px-1 py-2" data-target="#myCarousel" data-slide-to="1">
                                            <img src="https://source.unsplash.com/tXqVe7oO-go/600x400/" class="img-fluid" alt="...">
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                            <!-- Controls -->
                            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                            </a>
                            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                            </a>
                            
                            </div>
                            
                            ';


                                
                                    
                                //echo '<div class="top-right">';
                                
                                
                            // echo '</div>';
                            //    <!-- <img class="img-responsive" id="largeImage" src="http://placekitten.com/400/252" /> -->
                            //         <!-- <div id="description">First image description</div> -->

                                echo '
                                </div>';
                              
                                echo '</div>
                                </div>
                                <!-- spacer -->
                                <div class="space-half"></div>
                                <!-- spacer end -->
                                ';
                                //Code to upload a photo for the product if none exists
                            if ($row['haspic'] == "champaa") {
                            echo "
                            <div class=details-divs id=contributePhoto>

                              <form method='POST' action='' enctype='multipart/form-data'>
                              <div class='col-md-12 text-center'>
                              <h5 style='text-transform: capitalize;'>Contribute Photo</h5>
                              <input class='detailsInput' id=myFileInput' type='file' name='file' accept=image/* capture='camera'>
                              <input type='hidden' name='pupc' value='".$item_upc."'>
                              <button class='btn btn-danger' type='submit' name='submitPhoto' id='submitPhoto' style='margin:25px;'>Upload Photo</button>
                              </div>
                              </form>
                              </div>
                              ";  
                              
                          } 
                                    
                                    ?>
                                </div>
                            </div>
                            <div class="col-md-6" style="">
                                <div class="onStep" data-animation="fadeInUp" data-time="300">

                                    <div style="margin:25px !important;">
                                        <?php 
                                        if (isset($ralergy)) {
                                            
                                            $array = explode(',', $ralergy); //split string into array seperated by ', '
                                            foreach($array as $value) //loop over values
                                            {
                                                //echo ; //print value
                                            $sql33 = "SELECT * FROM recipe_allergies WHERE id = ".$value;
                                            $results33 = mysqli_query($conn, $sql33);
                                            $queryResult33 = mysqli_num_rows($results33);
                                            if ($queryResult33 > 0) {
                                                $row33 = mysqli_fetch_array($results33);
                                                echo "<span class='badge bg-primary' style='font-size:9px; padding:7px;margin:5px; display:inline-block;background-color: #333; color:#fff;'>".$row33["allergy_name"] . PHP_EOL."</span>";
                                            } else {
                                                echo "<span class='badge bg-primary' style='font-size:9px; padding:7px;margin:5px; display:inline-block;background-color: #333; color:#fff;'> No Alergy/Restriction</span>";
                                            }
                                                
                                            }

                                            //echo "<h6 style='color:#306706;' id='detailsName' name='detailsName'>".$ralergy."</h6>" ;
                                        }
                                        echo "<h1 id='detailsName' name='detailsName' style='text-transform: capitalize;'>".$rname."</h1>" ;
                                        $mmdate = date_create($rdate);
                                        echo "<span class='badge bg-primary' style='font-size:10px; padding:5px;margin:5px; display:inline-block;background-color: orange; color:#000;'>".date_format($mmdate, 'l jS F Y')."</span>";
                                        
                                        ?>
                                    </div>
                                    <?php 

                                    //--------------------Follow / Unfollow -------------------------------------------
                                    if (isset($_SESSION['u_id'])) {
                                        

                                    $sql333 = "SELECT COUNT(recipe_id) AS ucount FROM recipes WHERE user_id = ".$rcreator;
                                    $results333 = mysqli_query($conn, $sql333);
                                    $queryResult333 = mysqli_num_rows($results333);
                                    $row333 = mysqli_fetch_array($results333);

                                    $sql3 = "SELECT * FROM users WHERE user_id = ".$rcreator." LIMIT 1";
                                    $results3 = mysqli_query($conn, $sql3);
                                    $queryResult3 = mysqli_num_rows($results3);
                                    if ($queryResult3 > 0) {
                                        $row3 = mysqli_fetch_array($results3);
                                        $rcreator_name = $row3['user_first'].' '.$row3['user_last'];
                                        
                                        echo "<div class='col-md-6'>";
                                        echo "<button class='btn btn-rounded btn-main' rcreator='".$rcreator."' id='creatorid' type='submit' style='width:90%; margin-top:10px; height:45px;margin-left: 50px; '>".$rcreator_name."<small class='badge' style='background-color:maroon;'>".$row333['ucount']."</small> Recipes</button></div>";
                                        
                                        $follower  = $_SESSION['u_id'];
                                        $following = $row3['user_id'];
                                        
                                        $sql4 = "SELECT * FROM `users_follow` WHERE `follower` = '$follower' AND `following` = '$following'";
                                        $results4 = mysqli_query($conn, $sql4);
                                        $queryResult4 = mysqli_num_rows($results4);

                                        //$user_follow = dbquery("  ");
                                        //$check_status = dbrows($user_follow);

                                        
                                        $sub = false; //Boolean var which states if subscribed or not

                                        if ( $queryResult4 > 0 ){ //Pseudo code
                                            $sub = true; //If row is found, they are subscribed, so set $sub to true
                                        }

                                        if($sub == true){
                                            $subscribe_status = "Follow";
                                            $subscribe_text = "Unfollow";
                                        }

                                        else{
                                            $subscribe_status = "Unfollow";
                                            $subscribe_text = "Follow";
                                        }

                                        echo "<div class='col-md-6 center'>";
                                        echo"
                                        <form method='POST' action='includes/action.php' style='margin-left:-20px;'>
                                        <input type=hidden id='rid' name='rid' value='".$_GET['rid']."' >";
                                        
                                        if (isset($_SESSION['u_id']) && $_SESSION['u_id'] != $following) { 
                                            echo '
                                            <form action="" method="post">
                                            <input name="action" type="hidden" value="'.$subscribe_status.'" />
                                            <input name="follower" type="hidden" value="'.$follower.'" />
                                            <input name="following" type="hidden" value="'.$following.'" />
                                            
                                            <button type="submit" class="btn btn-info btn-rounded" style="width:55%; margin-top:10px; height:45px;margin-left: 50px; margin-right:15px;" value="'.$subscribe_text.'"><span class="glyphicon glyphicon-plus" style="white-space:nowrap;display: inline-block;margin-top:-5px;"></span> '.$subscribe_text.' <small class="badge" style="background-color:maroon;">'.$rcreator_name.'</small> </button>
                                            
                                            </form>';
                                            } 

                                        
                                        //echo '<button type="button" class="btn btn-info btn-rounded" style="width:55%; margin-top:10px; height:45px;margin-left: 50px; margin-right:15px;"><span class="glyphicon glyphicon-plus" style="white-space:nowrap;display: inline-block;margin-top:-5px;"></span> Follow </button>';
                                        
                                        //echo "<button class='btn btn-primary btn-rounded btn-sm center' rcreator='".$rcreator."' id='".$rcreator."' type='submit' style='width:75%; margin-top:10px; height:45px;margin-left: 50px; margin-right:15px;'>Follow this Creator!</button>";
                                        echo "</div>";
                                    } 
                                    echo "</form>";

                                    }    
                                    //-----------------------follow / unfollow button end ------------------------------- 
                                    //--------------------------------------------------------------------
                                    //--------------------------------------------------------------------
                                    $select_rating=mysqli_query($conn, "SELECT * FROM rating_reviews WHERE item_upc='".$_GET['rid']."' AND isrecipe=1");
                                    $ratingtot=mysqli_num_rows($select_rating);

                                    if ($ratingtot == 0) {
                                    
                                        echo '
                                        <div class="space-single"></div>
                                        <div class="row" style="margin-top:-60px !important;">
                                            <div class="center">';
                                            if (isset($_SESSION['u_id'])) {  //myModal
                                            //echo '<span class="heading" style="margin-top:-15px;"><button class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter">Add User Rating</button></span>';
                                            echo '<span class="heading" style="margin-top:15px;"><button type="submit" class="btn btn-success" id="mytest" >Add User Rating</button></span>';
                                            }
                                            echo '<p><span class="badge" style="white-space:nowrap !important;display: inline-block; margin-top:-5px;">0</span> reviews. Be the first to review and rate our product.</p>
                                            </div>
                                        </div>
                                        ';
                                    } else {

                                        if ($ratingtot == 1) {
                                            $row333=mysqli_fetch_array($select_rating);
                                            $tot_p_rating=($row333['rating']/$ratingtot); //$tot_p_rating
                                            $newstar = $tot_p_rating;
                                        } else {
                                            while($row333=mysqli_fetch_array($select_rating))
                                            { 
                                                $phpar[]=$row333['rating']; 
                                            }
                                            $tot_p_rating=(array_sum($phpar)/$ratingtot); //$tot_p_rating
                                            $tot_p_rating = round($tot_p_rating,0);
                                            $newstar = round($tot_p_rating,0);
                                        }

                                        

                                        //--------------------------------------------------------------------
                                        //--------------------------------------------------------------------
                                        

                                        echo '
                                        <div class="space-single"></div>
                                        <div class="center" style="margin-top:-45px !important;">';
                                        
                                            
                                        
                                    
                                    if ($newstar == 1) {
                                        echo '
                                        <span class="fa fa-star checked" style="white-space:nowrap !important;display: inline-block; margin-top:-20px;font-size:32px;"></span>
                                        <span class="fa fa-star " style="white-space:nowrap !important;display: inline-block;font-size:32px;"></span>
                                        <span class="fa fa-star " style="white-space:nowrap !important;display: inline-block;font-size:32px;"></span>
                                        <span class="fa fa-star " style="white-space:nowrap !important;display: inline-block;font-size:32px;"></span>
                                        <span class="fa fa-star" style="white-space:nowrap !important;display: inline-block;font-size:32px;"></span>
                                        ';
                                    }
                                    if ($newstar == 2) {
                                        echo '
                                        <span class="fa fa-star checked" style="white-space:nowrap !important;display: inline-block; margin-top:-20px;font-size:32px;"></span>
                                        <span class="fa fa-star checked" style="white-space:nowrap !important;display: inline-block;font-size:32px;"></span>
                                        <span class="fa fa-star " style="white-space:nowrap !important;display: inline-block;font-size:32px;"></span>
                                        <span class="fa fa-star " style="white-space:nowrap !important;display: inline-block;font-size:32px;"></span>
                                        <span class="fa fa-star" style="white-space:nowrap !important;display: inline-block;font-size:32px;"></span>
                                        ';
                                    }
                                    if ($newstar == 3) {
                                        echo '
                                        <span class="fa fa-star checked" style="white-space:nowrap !important;display: inline-block; margin-top:-20px;font-size:32px;"></span>
                                        <span class="fa fa-star checked" style="white-space:nowrap !important;display: inline-block;font-size:32px;"></span>
                                        <span class="fa fa-star checked" style="white-space:nowrap !important;display: inline-block;font-size:32px;"></span>
                                        <span class="fa fa-star " style="white-space:nowrap !important;display: inline-block;font-size:32px;"></span>
                                        <span class="fa fa-star" style="white-space:nowrap !important;display: inline-block;font-size:32px;"></span>
                                        ';
                                    }
                                    if ($newstar == 4) {
                                        echo '
                                        <span class="fa fa-star checked" style="white-space:nowrap !important;display: inline-block; margin-top:-20px;font-size:32px;"></span>
                                        <span class="fa fa-star checked" style="white-space:nowrap !important;display: inline-block;font-size:32px;"></span>
                                        <span class="fa fa-star checked" style="white-space:nowrap !important;display: inline-block;font-size:32px;"></span>
                                        <span class="fa fa-star checked" style="white-space:nowrap !important;display: inline-block;font-size:32px;"></span>
                                        <span class="fa fa-star" style="white-space:nowrap !important;display: inline-block;font-size:32px;"></span>
                                        ';
                                    }
                                    if ($newstar == 5) {
                                        echo '
                                        <span class="fa fa-star checked" style="white-space:nowrap !important;display: inline-block; margin-top:-20px; font-size:32px;"></span>
                                        <span class="fa fa-star checked" style="white-space:nowrap !important;display: inline-block;font-size:32px;"></span>
                                        <span class="fa fa-star checked" style="white-space:nowrap !important;display: inline-block; font-size:32px;"></span>
                                        <span class="fa fa-star checked" style="white-space:nowrap !important;display: inline-block; font-size:32px;"></span>
                                        <span class="fa fa-star checked" style="white-space:nowrap !important;display: inline-block;font-size:32px;"></span>
                                        ';
                                    }
                                

                                echo '<p><span class="badge" style="white-space:nowrap !important;display: inline-block; margin-top:-5px;">'.$tot_p_rating.'</span> average based on '.$ratingtot.' reviews.</p>';
                                if (isset($_SESSION['u_id'])) {
                                    //echo '<span class="heading" style="margin-top:15px;"><button class="btn btn-success" data-toggle="modal" data-target="#myModal">Add User Rating</button></span>';
                                    echo '<span class="heading" style="margin-top:15px;"><button type="submit" class="btn btn-success" id="mytest" >Add User Rating</button></span>';
                                    }
                                echo '</div>';
                                    }
                                    echo '
                                    <ul class="social" style="margin:15px;">
                                        <li class="fb active"><a href="http://www.facebook.com/sharer.php?u='.curPageURL().'" target="_blank" data-toggle="tooltip" data-placement="top" title="Share on Facebook!"><i class="fa fa-facebook-f"></i></a></li>
                                        <li class="ld active"><a href="http://www.linkedin.com/shareArticle?mini=true&url='.curPageURL().'" target="_blank" data-toggle="tooltip" data-placement="bottom" title="Share on Linkedin!"><i class="fa fa-linkedin"></i></a></li>
                                        <li class="tw active"><a href="http://twitter.com/share?url='.curPageURL().'&text='.$row['item_name'].'&hashtags=groceryhub" target="_blank" data-toggle="tooltip" data-placement="top" title="Share on Twitter!"><i class="fa fa-twitter"></i></a></li>
                                    </ul>
                                  ';
                                
                                //----------modal was here------------------------
                                //style="z-index:99999 !important;"
                                

                                    ?>
                                    <!-- <hr style="margin-bottom:5px; margin-left:15px;width:95%;"> -->
                                    <!-- previously pricing here -->
                            
                                    

                                    </div>
                                </div>
                         <!-- Recipe Tabs Comming Alone here -->
                            <div class="row" >
                                <div class="col-md-12 col-sm-12 onStep" data-animation="fadeInLeft" data-time="0" style="margin-top:-20px !important;">
                                <section >
                                
                                <?php 
                                    echo '
                                        <div class="col-md-12 col-sm-12 col-xs-12" >
                                            <ul id="pdetailss" class="nav nav-tabs nav-justified" style="">
                                                <li class="active"><a href="#a" data-toggle="tab">Recipe Ingredients</a></li>
                                                <li><a href="#b" data-toggle="tab">Cooking Directions</a></li>
                                                <li><a href="#c" data-toggle="tab">Recipe Nutrition Facts</a></li>
                                                <li><a href="#d" data-toggle="tab">Reviews</a></li>
                                            </ul>
                                    
                                        <div class="tab-content">
                                            <div class="tab-pane fade in active" id="a">';
                                           

                                            //if (isset($_SESSION['u_id'])) {
                                                $sql5 = "SELECT * FROM recipe_ingredients WHERE recipe_id = ".$rid;
                                                $results5 = mysqli_query($conn, $sql5);
                                                $queryResults5 = mysqli_num_rows($results5);

                                                if ($queryResults5 > 0) {
                                                echo "
                                                <table class='table table-striped'>";

                                                    while ($row5 = mysqli_fetch_array($results5)) {
                                                        $ingredient_name = $row5['ingredient_name'];
                                                        $preferred_upc = $row5['preferred_upc'];
                                                        $preferred_item = $row5['preferred_item'];
                                                        $ingredient_cat = $row5['ingredient_cat'];
                                                        $ingredient_qty = $row5['ingredient_qty'];
                                                        $measurement_type = $row5['measurement_type'];

                                                        echo "
                                                        <tr>
                                                        <td>".$ingredient_name."<br><small>".$ingredient_qty." ".$measurement_type."</small></td>
                                                        <td>".$preferred_item."<br>(".$preferred_upc.")</td>
                                                        <td>".$ingredient_cat."</td>
                                                        </tr>
                                                        ";
                                                    }
                                                } else {
                                                    echo "<tr><td colspan='2'>No ingredients currently available for this item.</td></tr>";      
                                                }
                                            echo "</table>";
                                            
                                            echo '  
                                            <div class="pp"> 
                                                <div class="progress-bar"></div>
                                            </div>
                                            <br>';

                                            echo"<button id='champakalibtn' type=submit class='btn btn-success btn-lg btn-block' uid=".$uid." id=".$item_upc." style='width:99% !important;' onClick='clickmee(".$rid.", ".$uid.");'>Add To List</button>";
                                            echo '<div id="adlistResult" class="alert alert-success center" style="margin-top:10px; display:none;"></div>';
                                              //  }  //if user end
                                            echo '
                                            </div>
                                            ';
                                                //Contribute Price
                                                                                                         
                                    echo '  
                                            <div class="tab-pane fade in" id="b">';
                                            $sql6 = "SELECT * FROM recipe_directions WHERE recipe_id = ".$rid;
                                                $results6 = mysqli_query($conn, $sql6);
                                                $queryResults6 = mysqli_num_rows($results6);

                                                if ($queryResults6 > 0) {
                                                echo "
                                                <table class='table table-striped'>";

                                                    while ($row6 = mysqli_fetch_array($results6)) {
                                                        $directions_step = $row6['directions_step'];
                                                        $directions_text = $row6['directions_text'];

                                                        echo "
                                                        <tr>
                                                        <td style='width:25px; font-size:24px;'>".$directions_step."</td>
                                                        <td>".$directions_text."</td>
                                                        </tr>
                                                        ";
                                                    }
                                                } else {
                                                    echo "<tr><td colspan='2'>No Recipe Direction currently available for this item.</td></tr>";      
                                                }
                                            echo "</table>";

                                    echo '  </div>
                                            <div class="tab-pane fade in" id="c">
                                                <p>No Nutrition Facts currently available for this item.</p>
                                            </div>
                                            <div class="tab-pane fade in" id="d">
                                                <!-- responsive nowrap table -->
                                                <table class="datatable-init responsive table" id="recipe_rating_table" name="recipe_rating_table" style="width:100%;">
                                                    <thead>
                                                        <tr>
                                                            <th>Date</th>
                                                            <th>User</th>
                                                            <th>Rating</th>
                                                            <th>Review</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                                                            

                                                    </tbody>
                                                </table>
                                            
                                            </div>

                                            ';
                                            

                                    echo "
                                            
                                        </div>
                                        </div>
                                        ";

                                            
                                    ?>

                                </section>
                            
                                </div>

                            </div> 
                            <!-- end tabs -->
                            <!-- Creator Recipes Comming Alone here -->
                            <div class="row" id="creatorarea">
                                <!--Slider-->
                                <div class="col-md-12">
                                    <div class="onStep center " data-animation="fadeInUp" data-time="200" style="margin:15px; background-color:#efefef;height:50px; border-top: 1px solid green; text-align:center !important;">
                                        <div style="margin-bottom:10px !important;">
                                            <!-- spacer -->
                                            <!-- <div class="space-half"></div> -->
                                            <h5 style='text-transform: uppercase; margin-left:15px;' > Creator's Recipes! </h5>
                                        </div>
                                    </div>
                                    <div id="owl-demo2" class="owl-carousel onStep" data-animation="fadeInLeftBig" data-time="200" style="">
                                        <?php 
                                
                                if (isset( $rcreator )) {
                                    $uid = $rcreator;
                                    $sql = "SELECT * FROM recipes WHERE user_id !=".$uid;
                                    $result = mysqli_query($conn, $sql);//execute query
                                    $queryResult = mysqli_num_rows($result);//total number of rows
                                    if ($queryResult > 0) {
                                        $num = 0;
                                        $link = "";
                                        while ($row = mysqli_fetch_array($result)) {
                                                    $rid = $row['recipe_id'];
                                                    $rname = $row['recipe_name'];
                                                    $link = $row['haspic'];
                                                    //$rname = $row['haspic'];
                                            if ($link=="") {
                                                $link = "img/noimageavailable.png";
                                            } else {
                                                $link = "img/recipes/".$link;
                                            }
                                            $num = $num + 1;
                                            if ($num > 1) {
                                                $mylinkcss = "";
                                            } else {
                                                $mylinkcss = "active";
                                            }
                                            echo "
                                                            <div class='product-cards item ".$mylinkcss."'> 
                                                                    <a href='recipe_details.php?rid=".$rid."'>";
                                                                    echo "<img id='resultPhoto' class='lazyOwl center-block' data-src='".$link."' alt='".$rname."' style=''>"; 
                                                                    echo "<span class='owl-text center' style='margin-top:2px;line-height: 12px;'>".$rname."</span>
                                                                    </a>
                                                            </div>";
                                        }   
                                        
                                    } else {
                                        echo "
                                        <div class='item ".$mylinkcss."'>
                                            
                                        <span class='center' style='width:200px !important; height:200px !important; '>No items in your list!</span>
                                            
                                        </div>
                                        ";
                                        
                                    }
                                        //echo "";
                                }
                                            
                                ?>
                                    </div>

                                </div>
                                <!-- Second Slider end -->
                            </div> <!-- creator's Recipes End -->
                        </div> <!-- middle column end -->
                       
                
                        
                        
                        <!-- Right Area Start -->
                        <!-- right content -->
                        <div class="col-md-2 hidden-xs" id="mobile-sidebar">
                            <aside class="onStep" data-animation="fadeInUp" data-time="600">

                                <!-- widget -->
                                <!-- <div style="margin:25px !important;">List Quick View</div> -->
                                <h5 style="text-transform: capitalize; margin-top:25px; position:relative !important;">List Quick View</h5>
                                <div class="space-single devider-widget" style="margin-top:-25px !important;">
                                </div>
                                <form method='POST' action='my_list.php'>
                                    <button class='btn btn-rounded btn-yellow' style="width:75%;">Review List</button>
                                </form>

                                <div id="myList" class="recent">


                                <?php 
            
                                if (isset($_SESSION['u_id'])) {
                                    $uid = $_SESSION['u_id'];
                                    echo "<div class='list pull-left'>";
                                    $sql = "SELECT * FROM grocery_lists INNER JOIN products ON grocery_lists.item_upc = products.item_upc WHERE grocery_lists.user_id = ".$uid." ORDER BY grocery_lists.item_name";
                                    $result = mysqli_query($conn, $sql);
                                    $queryResults = mysqli_num_rows($result);
                                    if ($queryResults > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $item_upc = $row['item_upc'];
                                            $item_qty = $row['item_quantity'];
                                            $item_name = $row['item_name'];
                                            $sql6 = "SELECT * FROM product_photos WHERE upc = $item_upc";
                                            $result6 = mysqli_query($conn, $sql6);
                                            $row6 = mysqli_fetch_assoc($result6);
                                            $link = $row6['link'];
                                            echo "<div class='product-container-thumbnail'>
                                                    <div id=product-photo-thumbnail>
                                                        <a href=details.php?upc=".$item_upc.">";
                                                        if ($row['has_image'] == 1) {
                                                        $filename = "img/".$item_upc."*";
                                                        $fileinfo = glob($filename);
                                                        $fileExt = explode(".", $fileinfo[0]);
                                                        $fileActualExt = $fileExt[1];
                                                        $file = "img/resized".$item_upc.".".$fileActualExt;
                                                        
                                                        echo "<img id=resultPhoto-thumbnail src=$file alt=$item_name onerror=this.src='img/noimageavailable.png'>";
                                                        } else {
                                                        echo "<img id=resultPhoto-thumbnail src='$link' alt=$item_name onerror=this.src='img/noimageavailable.png'>"; 
                                                        }
                                                        echo "</a>
                                                        </div>
                                                        <div id='listInfo' type='submit' name='item-details'>
                                                            <div id=product-info-thumbnail>
                                                                <a id=resultInfo-thumbnail href='details.php?upc=$item_upc'><span style='line-height: 1 !important; margin-top:-18px;'>".$row['item_name']."</span></a>   
                                                            </div>
                                                        </div>
                                                        <div id=adjust>";
                                                    if ($item_qty <= 1) {
                                                            echo"<div id=deleteForm>
                                                            <form id=delete method='POST' action='includes/action.php?dupc=".$item_upc."'>
                                                                <input type=hidden id=dupc name=dupc value=".$item_upc.">
                                                                <button class=listDelete uid=".$uid." qty=".$item_qty." id=".$item_upc." type='submit' value=".$item_upc.">&times;</button>
                                                            </form>
                                                            </div>";
                                                            } else {
                                                            echo "<form id=adjustDownForm method='POST' action='includes/action.php'>
                                                                <input type=hidden id=item_to_adjust_d name=item_to_adjust_d value=".$item_upc.">
                                                                <input type=hidden id=quantityd name=quantityd value=".$item_qty.">
                                                                <button class='adjustDownBtn' uid=".$uid." qty=".$item_qty." id=".$item_upc." type='submit' name='adjustDownBtn'>-</button>
                                                            </form>";  
                                                            }
                                                            echo"<h5 id='resultQty-thumbnail'>".$row['item_quantity']."</h5>
                                                            <form id=adjustUpForm method='POST' action='includes/action.php'>
                                                                <input type=hidden id=item_to_adjust_u name=item_to_adjust_u value=".$item_upc.">
                                                                <input type=hidden id=quantityu name=quantityu value=".$item_qty.">
                                                                <button class='adjustUpBtn' uid=".$uid." qty=".$item_qty." id=".$item_upc." type='submit' name='adjustUpBtn'>+</button>
                                                            </form>
                                                        </div>
                                                </div>";
                                            }   
                                        
                                    } else {
                                        echo "<br>
                                            <h4 id='listMessege'>Items in your grocery list will appear here. Start adding some items to your list!</h4>
                                            <br>";
                                    }
                                        echo "</div>";
                                }
                                
                                ?>


                                </div>
                                <!-- widget end -->
                            </aside>
                        </div>
                        <!-- right content end -->
                    </div>
                    
                    <!-- Right Area -->
                        
                </div>
                
                   
                
                
            </div>
        </section>
        <!-- section -->
<?php 

// --------------------------------------------- 

?>

<!-- Footer Start/End/JS -->
<?php include 'includes/footer_inc.php'?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap.min.css">
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap.min.js"></script>



<script>
    function changeThis(id) {
        //console.log(id);
      var cname=document.getElementById(id).className;
      var ab=document.getElementById(id+"_hidden").value;
      //document.getElementById(cname+"rating").innerHTML=ab;
      document.getElementById("phprating").value =ab;
      console.log(ab);

      for(var i=ab;i>=1;i--)
      {
         document.getElementById(cname+i).src="img/star2.png";
      }
      var id=parseInt(ab)+1;
      for(var j=id;j<=5;j++)
      {
         document.getElementById(cname+j).src="img/star1.png";
      }
    }
    $('#mytest').click(function (e) { 
     e.preventDefault();
     //console.log("hello");
     //alert("hello");
        $.confirm({
        title: 'Rate It!',
        content: '<form method="post" action="">' +
                    '<div class="form-group"> ' +
                    '<div class="divRating" >' +
                        '<input type="hidden" id="php1_hidden" value="1">' +
                        '<img src="img/star1.png" onmouseover="changeThis(this.id);" id="php1" class="php">' +
                        '<input type="hidden" id="php2_hidden" value="2">' +
                        '<img src="img/star1.png" onmouseover="changeThis(this.id);" id="php2" class="php">' +
                        '<input type="hidden" id="php3_hidden" value="3">' +
                        '<img src="img/star1.png" onmouseover="changeThis(this.id);" id="php3" class="php">' +
                        '<input type="hidden" id="php4_hidden" value="4">' +
                        '<img src="img/star1.png" onmouseover="changeThis(this.id);" id="php4" class="php">' +
                        '<input type="hidden" id="php5_hidden" value="5">' +
                        '<img  src="img/star1.png" onmouseover="changeThis(this.id);" id="php5" class="php">' +
                    '</div>' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label for="pwd">Your Review About Recipe:</label>' +
                    '<textarea class="form-control" id="review" name="review" rows="3" maxlength="100"></textarea>' +
                    '<div style="font-size:9px;">Max <span id="txtleft" style="font-size:11px; color:red; margin:0px; padding:0px;white-space: nowrap !important;display: inline-block;">150</span> Characters Limit. </div>' +
                    '<input type="hidden" name="phprating" id="phprating" value="" >' +
                    '<input type="hidden" name="upc" id="upc" value="<?php echo $_GET["rid"]; ?>">' +
                    '<input type="hidden" name="uid" id="uid" value="<?php echo $_SESSION['u_id']; ?>">' +
                    '<input type="hidden" name="isrecipe" id="isrecipe" value="1">' +
                    '</div>' +
                    '' +
                    '<div id="ratresult" class="alert alert-success pull-right" style="padding:3px; margin:3px; font-size:10px; display:none;"></div>' +
                '</form>',
                
        buttons: {
            formSubmit: {
                text: 'Submit',
                btnClass: 'btn-blue',
                action: function () {
                    var upc = $('#upc').val();
                    var isrecipe = $('#isrecipe').val();
                    var uid = $('#uid').val();
                    var review = $('#review').val(); 
                    var phprating = $('#phprating').val(); 
                    console.log(upc +' | '+uid+' | '+phprating);
                    $.ajax({
                        url: 'includes/action.php',
                        method: 'POST',
                        data: {
                        'review': review,
                        'upc': upc,
                        'isrecipe': isrecipe,
                        'uid': uid,
                        'prorating': phprating
                        },
                        success: function (response) {
                        console.log(response);
                        if ( response == "true") {
                            $("#ratresult").html("Rating Successfully Submited!");
                            $("#ratresult").fadeIn();
                            setTimeout(function() {
                            //$("#successMessage").hide('blind', {}, 500)
                            location.reload(true);
                        }, 3000);
                            return false;
                        }
                        $("#ratresult").html(response);
                        $("#ratresult").fadeIn();
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

 
    $(document).ready(function () {


        $('#myCarousel').carousel({
            interval: false
        });
        
        $('#carousel-thumbs').carousel({
            interval: false
            console.log("champoooooooo");
        });

        // handles the carousel thumbnails
        // https://stackoverflow.com/questions/25752187/bootstrap-carousel-with-thumbnails-multiple-carousel
        $('[id^=carousel-selector-]').click(function() {
            var id_selector = $(this).attr('id');
            var id = parseInt( id_selector.substr(id_selector.lastIndexOf('-') + 1) );
            $('#myCarousel').carousel(id);
        });
        // Only display 3 items in nav on mobile.
        if ($(window).width() < 575) {
            $('#carousel-thumbs .row div:nth-child(4)').each(function() {
                var rowBoundary = $(this);
                $('<div class="row mx-0">').insertAfter(rowBoundary.parent()).append(rowBoundary.nextAll().addBack());
            });
            $('#carousel-thumbs .carousel-item .row:nth-child(even)').each(function() {
                var boundary = $(this);
                $('<div class="carousel-item">').insertAfter(boundary.parent()).append(boundary.nextAll().addBack());
            });
        }
        // Hide slide arrows if too few items.
        if ($('#carousel-thumbs .carousel-item').length < 2) {
            $('#carousel-thumbs [class^=carousel-control-]').remove();
            $('.machine-carousel-container #carousel-thumbs').css('padding','0 5px');
        }
        // when the carousel slides, auto update
        $('#myCarousel').on('slide.bs.carousel', function(e) {
            var id = parseInt( $(e.relatedTarget).attr('data-slide-number') );
            $('[id^=carousel-selector-]').removeClass('selected');
            $('[id=carousel-selector-'+id+']').addClass('selected');
        });
        // when user swipes, go next or previous
        $('#myCarousel').swipe({
            fallbackToMouseEvents: true,
            swipeLeft: function(e) {
                $('#myCarousel').carousel('next');
            },
            swipeRight: function(e) {
                $('#myCarousel').carousel('prev');
            },
            allowPageScroll: 'vertical',
            preventDefaultEvents: false,
            threshold: 75
        });
        

        $('#myCarousel .carousel-item img').on('click', function(e) {
        var src = $(e.target).attr('data-remote');
        if (src) $(this).ekkoLightbox();
        });




        console.log(window.upc);
    $('#recipe_rating_table').DataTable({
    "autoWidth": false,
    "bSort": false,
    "destroy": true,
    "responsive": true,
    "pagingType": "simple_numbers",
    "bLengthChange": false,
    "pageLength": 10,
    "dom": '<"pull-right"tf><"pull-right"ti><"pull-right"l>tp',
    "bInfo": true,
    "searching": false,
    "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
    "lengthMenu": true,
    "ajax": "includes/action.php?review_upc="+window.upc,
    "columns": [
        { "width": "10%" },
        { "width": "15%" },
        { "width": "10%" },
        { "width": "55%" }
    ]
    
    });
    $.fn.dataTable.ext.errMode = function (settings, helpPage, message) {
    };

    $("#creatorid").click(function() {
        $('html,body').animate({
            scrollTop: $("#creatorarea").offset().top - 500},
            'slowest');
    });
 
    });

    function clickmee(chuk, chak){
        $('#champakalibtn').prop('disabled', true);

        $.ajax({
            url: 'includes/action.php',
            method: 'POST',
            data: {
            'rec_rid': chuk,
            'rec_uid': chak
            },
            success: function (response) {
            console.log(response);

            $("#step_2_now").fadeOut(100);
            if ( response == "true") {
                $('#adlistResult').html("All Ingredients Successfully added into your Shopping List!");
                $("#adlistResult").fadeTo(2000, 500).slideUp();
                
                return false;
            } else {
                alert(response);
            }
            return false;

            //location.reload(true);
            }
        });

       

        $('.progress-bar').animate(
            {width:'100%'}, 
            {duration:3000}      
        );
        //$('.progress-bar').html("Processing Now...");
        //wait(3000);  //7 seconds in milliseconds
        //$('.progress-bar').html("Processed All Ingredients Successfully.....").fadeIn();
    }
    function wait(ms){
        var start = new Date().getTime();
        var end = start;
        while(end < start + ms) {
            end = new Date().getTime();
        }
    }
</script>
<style>
    /* .carousel-control .icon-prev, 
.carousel-control .icon-next {
    font-size: 100px;
} */
.glyphicon-chevron-right, .glyphicon-chevron-left {
    font-size: 10px !important;
}

.carousel-control.left {
    background-image: linear-gradient(to right,rgba(0,0,0,0) 0,rgba(0,0,0,0) 100%);
}
.carousel-control.right {
    background-image: linear-gradient(to right,rgba(0,0,0,0) 0,rgba(0,0,0,0) 100%);
}
.carousel-control {
    color: black;
}

.carousel-control:focus, .carousel-control:hover {
    color: black;
}

h5 {
        text-transform: uppercase; margin: 0; position: absolute; top: 50%; -ms-transform: translateY(-50%); transform: translateY(-50%); 
        
    }
    .progress-bar { 
    height:30px;
    background:#449D44; 
    width:0px;
    text-align:center;
    border: 1px solid gray;
    color: #232323;
    align: center;
}

.pp{
  height:30px;
  width : 100%;
  background-color: #efefef;
  border: 1px solid gray;
}
</style>
</html>