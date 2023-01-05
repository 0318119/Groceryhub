<!DOCTYPE html>
<html lang="en">

<?php 

error_reporting( 0 );
include_once 'includes/dbh.inc.php';
include 'includes/header_inc.php'; 
?>

<style>
    h5 {
        /* text-transform: uppercase; margin: 0; position: absolute; top: 50%; -ms-transform: translateY(-50%); transform: translateY(-50%);     */
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
                    Dashboard!

                </div>
            </div>

        </div>

        <div class="row">
            <div class="no-gutter">


                <!-- MY LIST Slider -->
                <div class="col-md-12" style="padding:5px;">
                    <div class="onStep" data-animation="fadeInUp" data-time="200" style="margin-top:25px; background-color:#efefef;height:50px; border-top: 1px solid green;">
                        <!-- spacer -->
                        <!-- <div class="space-half"></div> -->
                        <h5 class="center" style='text-transform: uppercase; margin-top:15px !important; '  > My List Status 
                            <a href="my_list.php" class="btn-sm btn-success">View Complete My List!</a>
                        </h5>
                    </div>
                    
                    <div id="owl-demo2" class="owl-carousel onStep" data-animation="fadeInLeftBig" data-time="200" style="margin-left:0px !important; margin-top:25px !important;">
                    <?php 
                  
                  if (isset($_SESSION['u_id'])) {
                      $uid = $_SESSION['u_id'];
                      //echo "<div class='list pull-left'>";
                      $sql = "SELECT * FROM grocery_lists INNER JOIN products ON grocery_lists.item_upc = products.item_upc WHERE grocery_lists.user_id = ".$uid." ORDER BY grocery_lists.item_name";

                      $result = mysqli_query($conn, $sql);
                      $queryResults = mysqli_num_rows($result);
                      if ($queryResults > 0) {
                          $num = 0;
                          while ($row = mysqli_fetch_assoc($result)) 
                          {
                              $item_upc = $row['item_upc'];
                              $item_qty = $row['item_quantity'];
                              $item_name = $row['item_name'];
                              $sql6 = "SELECT * FROM product_photos WHERE upc = ".$item_upc;
                              $result6 = mysqli_query($conn, $sql6);
                              $row6 = mysqli_fetch_assoc($result6);
                              $link = $row6['link'];
                              if ($link=="") {
                                  $link = "img/noimageavailable.png";
                              }
                              $num = $num + 1;
                              if ($num > 1) {
                                  $mylinkcss = "";
                              } else {
                                  $mylinkcss = "active";
                              }
                              echo "
                                              <div class='product-cards item ".$mylinkcss."' >
                                                  
                                                      <a href='details.php?upc=".$item_upc."'>";
                                                      if ($row['has_image'] == 1) {
                                                      $filename = "img/".$item_upc."*";
                                                      $fileinfo = glob($filename);
                                                      $fileExt = explode(".", $fileinfo[0]);
                                                      $fileActualExt = $fileExt[1];
                                                      $file = "img/resized".$item_upc.".".$fileActualExt;
                
                                                      echo "<img  id='resultPhoto' class='lazyOwl ' data-src='".$file."' alt='".$item_name."' onerror=this.src='img/noimageavailable.png'>";
                
                                                      } else {
                                                      echo "<img id='resultPhoto' class='lazyOwl ' data-src='".$link."' alt='".$item_name."' onerror=this.src='img/noimageavailable.png'>";
                                                      }
                                                      echo "<span class='owl-text center' style=''>".$item_name."</span>
                                                      </a>
                                                </div>
                                              ";
                                      
                          }   
                          
                      } else {
                        echo "
                        <div class='item'>
                            
                        <span class='center' style='width:200px !important; height:200px !important; '>No items in your list!</span>
                               
                          </div>
                        ";
                         
                      }
                          //echo "";
                  }
                            
                  ?>
                        
                    </div>
                </div>
                <!-- My List Slider end -->
                <!-- Popular Products Slider-->
                <div class="col-md-12" style="padding:5px;">
                    <div class="onStep" data-animation="fadeInUp" data-time="200" style="margin-top:25px; background-color:#efefef;height:50px; border-top: 1px solid green;">
                        <div style="margin-bottom:15px !important;">
                            <!-- spacer -->
                            <div class="space-half"></div>
                            <h5 class="center text-center" style='text-transform: uppercase; margin-top:-15px !important; '>Popular Products You Might Like!</h5>
                        </div>
                    </div>
                    <div id="owl-demo2" class="owl-carousel onStep" data-animation="fadeInLeftBig" data-time="200" style="margin-left: 0px;">
                        <?php 
                  
                  if (isset($_SESSION['u_id'])) {
                      $uid = $_SESSION['u_id'];
                      $sql = "SELECT * FROM products where has_image=1 LIMIT 15";
                      $result = mysqli_query($conn, $sql);
                      $queryResults = mysqli_num_rows($result);
                      if ($queryResults > 0) {
                          $num = 0;
                          $link= "";
                          while ($row = mysqli_fetch_assoc($result)) 
                          {
                              $item_upc = $row['item_upc'];
                              //$item_qty = $row['item_quantity'];
                              $item_name = $row['item_name'];
                              $sql6 = "SELECT * FROM product_photos WHERE upc = ".$item_upc;
                              $result6 = mysqli_query($conn, $sql6);
                              $row6 = mysqli_fetch_assoc($result6);
                              $link = $row6['link'];
                              if ($link=="") {
                                  $link = "img/noimageavailable.png";
                              }
                              $num = $num + 1;
                              if ($num > 1) {
                                  $mylinkcss = "";
                              } else {
                                  $mylinkcss = "active";
                              }
                              echo "
                                              <div class='product-cards item ".$mylinkcss."' style='margin-top:25px !important;'>
                                                  
                                                      <a href='details.php?upc=".$item_upc."'>";
                                                      if ($row['has_image'] == 1) {
                                                    //   $filename = "img/".$item_upc."*";
                                                      $fileinfo = glob($filename);
                                                      $fileExt = explode(".", $fileinfo[0]);
                                                      $fileActualExt = $fileExt[1];
                                                      $file = "img/resized".$item_upc.".".$fileActualExt;

                                                      echo "<img id='resultPhoto' class='lazyOwl' data-src='".$file."' alt='".$item_name."' onerror=this.src='img/noimageavailable.png' style='margin:0 auto;'>";

                                                      } else {
                                                      //echo "<img style='' src='".$link."' alt='".$item_name."'>"; 
                                                      echo "<img id='resultPhoto' class='lazyOwl' data-src='".$link."' alt='".$item_name."' onerror=this.src='img/noimageavailable.png' style='margin:0 auto;'>";
                                                      }
                                                      echo "<span class='owl-text center' style='margin-top:3px;line-height: 12px;'>".$item_name."</span>
                                                      </a>
                                                </div>
                                              ";
                                      
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
                <!-- Popular Products Slider end -->


                <!-- Try Different Recipes Slider-->
                <div class="col-md-12">
                    <div class="onStep" data-animation="fadeInUp" data-time="200" style="margin-top:25px; background-color:#efefef;height:50px; border-top: 1px solid green; text-align:center;">
                        <div style="margin-bottom:15px !important;">
                            <!-- spacer -->
                            <div class="space-half"></div>
                            <h5 style='text-transform: uppercase; margin-top:-15px !important; ' class="center"> Try Different Recipes! </h5>
                        </div>
                    </div>
                    <div id="owl-demo2" class="owl-carousel onStep" data-animation="fadeInLeftBig" data-time="200" style="margin-left:0px !important;">
                        <?php 
                  
                  if (isset($_SESSION['u_id'])) {
                    $uid = $_SESSION['u_id'];
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
                                            <div class='product-cards item ".$mylinkcss."' style='margin-top: 25px;'> 
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
                <!-- Try Different Recipes Slider end -->

                 <!-- MY RECIPES Slider -->
                <div class="col-md-12" style="padding:5px;">
                    <div class="onStep" data-animation="fadeInUp" data-time="200" style="margin-top:25px; background-color:#efefef;height:50px; border-top: 1px solid green;">
                            <div style="margin-bottom:15px !important;">
                                <!-- spacer -->
                                <div class="space-half"></div>
                                <h5 style='text-transform: uppercase; margin-top:-15px !important; ' class="center"> My Recipes List </h5>
                            </div>
                    </div>
                    <div id="owl-demo2" class="owl-carousel onStep" data-animation="fadeInLeftBig" data-time="200" style="">
                    <?php 
                  
                  if (isset($_SESSION['u_id'])) {

                    $uid = $_SESSION['u_id'];
                    $sql = "SELECT * FROM recipes WHERE user_id=".$uid;
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
                                            <div class='product-cards item ".$mylinkcss."' style=' margin-top: 25px;'>
                                                    <a href='recipe_details.php?rid=".$rid."'>
                                                    <img id='resultPhoto' class='lazyOwl center' data-src='".$link."' alt='".$rname."' style='margin:0 auto;' onerror='this.src=img/noimageavailable.png'></a> 
                                                    
                                                    <span class='owl-text center' style='margin-top:3px;line-height: 12px;'>".$rname."</span>
                                                    <span class='center' >
                                                    <a href='recipe_edit.php?rid=".$rid."' class='btn-lg btn-success center' style='color:#fff; display: inline-block;'>Edit</a>
                                                    
                                                    </span>
                                            </div>";
                        } 
                        //<a href='#' class='btn-sm btn-danger center' style='color:#fff;display: inline-block; text-algin:center;'>Delete</a>  
                        
                    } else {
                        echo "
                        <div class='item center'>
                            
                            <span class='center' style='width:200px !important; height:200px !important; '>No items in your list!</span>
                               
                          </div>
                        ";
                       
                    }
                        //echo ""; transform: rotate(270deg) !important;padding: 25px;width:200px;
                }
                            
                  ?>
                        
                    </div>
                </div>
                <!-- MY RECIPES Slider end -->




            </div>
        </div>

    </div>

</section>
<!-- section -->

<!-- Footer Start/End/JS -->
<?php include 'includes/footer_inc.php'?>


</html>