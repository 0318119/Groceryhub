<!DOCTYPE html>
<html lang="en">

<?php 

error_reporting( 0 );
include_once 'includes/dbh.inc.php';
include 'includes/header_inc.php'; 
?>


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
            <!-- </div> -->
        </div>
        <div class="row">
            <div class="no-gutter">


                <!-- content left halfbg-->
                <div class="col-md-6 " style="padding:5px;">
                    <!-- spacer -->
                    <div class="space-half"></div>
                    <!-- spacer end -->
                    <div class="row" >
                        <div class="col-md-12 col-sm-12" >
                            <div class="onStep" data-animation="fadeInUp" data-time="200">
                                    <div style="margin-bottom:15px !important;">
                                        <h5 style='text-transform: uppercase;'>Popular Products You Might Like! </h5>
                                    </div>
                            </div>
                            <div id="owl-demo1" class="owl-carousel owl-demo1 onStep" data-animation="fadeInLeftBig" data-time="200">
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
                                              <div class='item ".$mylinkcss."'>
                                                  
                                                      <a href='details.php?upc=".$item_upc."'>";
                                                      if ($row['has_image'] == 1) {
                                                      $filename = "img/".$item_upc."*";
                                                      $fileinfo = glob($filename);
                                                      $fileExt = explode(".", $fileinfo[0]);
                                                      $fileActualExt = $fileExt[1];
                                                      $file = "img/resized".$item_upc.".".$fileActualExt;

                                                      echo "<img class='lazyOwl' data-src='".$file."' alt='".$item_name."' onerror=this.src='img/noimageavailable.png'>";

                                                      } else {
                                                      //echo "<img style='' src='".$link."' alt='".$item_name."'>"; 
                                                      echo "<img class='lazyOwl' data-src='".$link."' alt='".$item_name."' onerror=this.src='img/noimageavailable.png'>";
                                                      }
                                                      echo "<span class='owl-text'>".$item_name."</span>
                                                      </a>
                                                </div>
                                              ";
                                      
                          }   
                          
                      } else {
                          echo "<br>
                              <h4 id='listMessege'>Start adding some items to your list!</h4>
                              <br>";
                      }
                          //echo "";
                  }
                            
                  ?>
                            </div>    
                        </div>
                    </div>
                    <!-- spacer -->
                    <div class="space-half"></div>
                    <!-- spacer end -->
                    <div class="row" >
                        <div class="col-md-12 col-sm-12" >
                            <div class="onStep" data-animation="fadeInUp" data-time="200">
                                    <div style="margin-bottom:15px !important;">
                                        <h5 style='text-transform: uppercase;'> Try Different Recipes! </h5>
                                    </div>
                            </div>
                            <div id="owl-demo2" class="owl-carousel owl-demo2 onStep" data-animation="fadeInLeftBig" data-time="200">
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
                                            <div class='item ".$mylinkcss."'> 
                                                    <a href='recipe_details.php?rid=".$rid."'>";
                                                    echo "<img class='lazyOwl center' data-src='".$link."' alt='".$rname."'>"; 
                                                    echo "<span class='owl-text'>".$rname."</span>
                                                    </a>
                                            </div>";
                        }   
                        
                    } else {
                        echo "<br>
                            <h4 id='listMessege'>Start adding some items to your list!</h4>
                            <br>";
                    }
                        //echo "";
                }
                            
                  ?>
                            </div>
                        </div>
                    </div>
                    
                    <!-- spacer -->
                    <div class="space-half"></div>
                    <!-- spacer end -->
                </div>
                <!-- content left end -->

                <!-- content right -->
                <div class="col-md-6" style="padding:5px;">

                    <!-- spacer -->
                    <div class="space-half"></div>
                    <!-- <div class="space-double hidden-sm hidden-xs"></div> -->
                    <!-- spacer end -->
                    <div class="row" >
                        <div class="col-md-12 col-sm-12 col-xs-12" >
                            <div class="onStep" data-animation="fadeInUp" data-time="200">
                                <div style="margin-bottom:15px !important;">
                                    <h5 style='text-transform: uppercase;'> My List Status 
                                    <a href="my_list.php" class="btn-sm btn-success">View Complete My List!</a>
                                    </h5>
                                </div>
                            </div>
                            <div id="owl-demo1" class="owl-carousel owl-demo1 onStep" data-animation="fadeInRightBig" data-time="200">
                <?php 
                  
                  if (isset($_SESSION['u_id'])) {
                      $uid = $_SESSION['u_id'];
                      //echo "<div class='list pull-left'>";
                      $sql = "SELECT * FROM grocery_lists INNER JOIN products ON grocery_lists.item_upc = products.item_upc WHERE grocery_lists.user_id = ".$uid." ORDER BY grocery_lists.item_name 
                      LIMIT 5";
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
                                              <div class='item ".$mylinkcss."'>
                                                  
                                                      <a href='details.php?upc=".$item_upc."'>";
                                                      if ($row['has_image'] == 1) {
                                                      $filename = "img/".$item_upc."*";
                                                      $fileinfo = glob($filename);
                                                      $fileExt = explode(".", $fileinfo[0]);
                                                      $fileActualExt = $fileExt[1];
                                                      $file = "img/resized".$item_upc.".".$fileActualExt;

                                                      echo "<img class='lazyOwl' data-src='".$file."' alt='".$item_name."' onerror=this.src='img/noimageavailable.png'>";

                                                      } else {
                                                      //echo "<img style='' src='".$link."' alt='".$item_name."'>"; 
                                                      echo "<img class='lazyOwl' data-src='".$link."' alt='".$item_name."' onerror=this.src='img/noimageavailable.png'>";
                                                      }
                                                      echo "<span class='owl-text'>".$item_name."</span>
                                                      </a>
                                                  </div>
                                              ";
                                      
                          }   
                          
                      } else {
                          echo "<br>
                              <h4 id='listMessege'>Start adding some items to your list!</h4>
                              <br>";
                      }
                          //echo "";
                  }
                            
                  ?>
                                <!-- <div class="item">
                                    <img class="lazyOwl" data-src="img/noimageavailable.png" alt="Lazy Owl Image">
                                    <span class="owl-text">Trader Joe's, Fruit Sauce Crushers, Apple</span>
                                </div> -->
                                
                        </div>
                        </div>
                    </div>
                    <!-- row content end --><!---------SLIDER END-------------->
                    <!---------SLIDER START-------------->
                    <!-- spacer -->
                    <div class="space-half"></div>
                    <!-- <div class="space-double hidden-sm hidden-xs"></div> -->
                    <!-- spacer end -->
                    <div class="row" >
                        <div class="col-md-12 col-sm-12 col-xs-12" >
                            <div class="onStep" data-animation="fadeInUp" data-time="200">
                                <div style="margin-bottom:15px !important;">
                                    <h5 style='text-transform: uppercase;'> My Recipes List </h5>
                                </div>
                            </div>
                            <div id="owl-demo2" class="owl-carousel owl-demo onStep" data-animation="fadeInRightBig" data-time="200">
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
                                            <div class='item ".$mylinkcss."'> 
                                                    <a href='recipe_details.php?rid=".$rid."'>";
                                                    echo "<img class='lazyOwl center' data-src='".$link."' alt='".$rname."' onerror=this.src='img/noimageavailable.png'>"; 
                                                    echo "<span class='owl-text center' style=>".$rname."
                                                    </a></span><span class='center'>
                                                    <a href='#' class='btn-sm btn-success center' style='color:#fff; display: inline-block;'>Edit</a>
                                                    <a href='#' class='btn-sm btn-danger center' style='color:#fff;display: inline-block; text-algin:center;'>Delete</a>
                                                    </span>
                                            </div>";
                        }   
                        
                    } else {
                        echo "<br>
                            <h4 id='listMessege'>Start adding some items to your list!</h4>
                            <br>";
                    }
                        //echo "";
                }
                            
                  ?>
                                <!-- <div class="item">
                                    <img class="lazyOwl" data-src="img/noimageavailable.png" alt="Lazy Owl Image">
                                    <span class="owl-text">Trader Joe's, Fruit Sauce Crushers, Apple</span>
                                </div> -->
                                
                        </div>
                        </div>
                        <!---------SLIDER END-------------->

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