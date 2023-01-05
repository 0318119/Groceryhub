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
                        <div class="content-crumb-div" >
                                <a class="fileTrail" href="index.php">Home</a> 
                                <i style="font-size: 1rem;" class="fa fa-arrow-right"></i> 
                                
                                
                                    <a class="fileTrail" href="#">Recipes</a> 
                                   
                                <i style="font-size: 1rem;" class="fa fa-arrow-right"></i> 
                                All Recipes!
                                
                        </div>
                    </div>
                    <!-- </div> -->
                </div>
                <div class="row">
                    <div class="no-gutter">


                        

                        <!-- content right -->
                        <div class="col-md-12" style="">

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
                                <div class="col-md-10">
                                    <div class="onStep float-right" data-animation="fadeInUp" data-time="300" style="margin-left:15px;">

                                        <div class="product-area">
                                        <?php
                                        
                                        echo "<div id=resultsHeader>
                                                <h5 id='searchResults'>Browse our selection of recipes and add your favorite ones to your Cookbook!</h5>
                                            </div>";
                                            
                                        if (isset($_SESSION['u_id'])) {   
                                            $sql = "SELECT * FROM recipes LIMIT 20";
                                            $result = mysqli_query($conn, $sql);//execute query
                                            $queryResult = mysqli_num_rows($result);//total number of rows
                                            if ($queryResult > 0) {
                                                while ($row = mysqli_fetch_array($result)) {
                                                            $rid = $row['recipe_id'];
                                                            $rname = $row['recipe_name'];
                                                            //$rname = $row['haspic'];
                                                echo "
                                                        <form class='product-cards' method='POST' action='includes/action.php' value=".$rid.">
                                                                <div id=''>
                                                                <a href=recipe_details.php?rid=".$rid.">
                                                                <img id='resultPhoto' src='img/recipes/".$row['haspic']."' alt='".$row['haspic']."' onerror=this.src='img/noimageavailable.png' class='' style=''>
                                                                </a>
                                                                </div>
                                                                <div id='product-info'>
                                                                    <a href=recipe_details.php?rid=".$rid.">
                                                                    <h5 id='resultName'>".$rname."</h5>
                                                                    </a>
                                                                </div>
                                                                    <input type=hidden id=".$rid." name='rid' class='rid' value=".$rid.">
                                                                    <button class='btn btn-success center' id='".$rid."' type='submit' name='rsubmit' value='".$rid."' style='bottom: 10px; justify-content: flex-end; display: flex;'>Add To Meal Plan</button>
                                                        </form>";
                                                
                                                }
                                            }

                                        
                                        }
                                        ?>
                                        </div><!--Closes product-area-->

                                    </div>
                                </div>
                                <!-- left content end -->

                                <!-- right content -->
                                <div class="col-md-2" id="mobile-sidebar">
                                    <aside class="onStep" data-animation="fadeInUp" data-time="600">

                                        <!-- widget -->
                                        <!-- <div style="margin:25px !important;">List Quick View</div> -->
                                        <h5 style="text-transform: capitalize; margin-left:0px;">List Quick View</h5>
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
                                                                        <a id=resultInfo-thumbnail href='details.php?upc=$item_upc'>".$row['item_name']."</a>   
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
                                                                    echo"<h5 id=resultQty-thumbnail>".$row['item_quantity']."</h5>
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