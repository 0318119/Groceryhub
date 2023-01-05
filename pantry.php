
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
                                <?php if ( ($_GET['htype'] == 'Groceries') ) { ?>
                                    <a class="fileTrail" href="#">Groceries</a> 
                                <?php } else { ?>
                                    <a class="fileTrail" href="#">Recipes</a> 
                                    <?php } ?>
                                <i style="font-size: 1rem;" class="fa fa-arrow-right"></i> 
                                Pantry!
                                <!-- <i style="font-size: 1rem;" class="fa fa-arrow-right"></i>  -->
                        </div>
                    </div>
                    <!-- </div> -->
                </div>
                <div class="row">
                    <div class="no-gutter">


                        <!-- content left -->
                        <div class="col-md-2 onStep hidden-xs" data-animation="fadeInLeft" data-time="0" style="background-color:#F8F7F5 !important; min-height: 800px !important;">

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

                            <div class="pantry-area" style="margin-left:25px;">
                            <?php
                            echo "<div style='width:96%; margin: 0px 2%;'>
                                <div id='resultsHeader'>
                                    <h4 class='searchResults'>Your Pantry</h4>
                                </div>
                                <form method='POST' action='pantry-add.php?upc='>
                                    <button class='btn btn-warning' style='width:auto; height:30px;'>Missing something? Add item to your Pantry</button>
                                </form>
                                </div>";
                            
                            
                            
                            ///////Algorithm to calculate remaining quantity of products in pantry//////
                            if (isset($_SESSION['u_id'])) {
                                $sql = "SELECT * FROM pantry WHERE user_id = ".$_SESSION['u_id']."";
                                $result = mysqli_query($conn, $sql);
                                $queryResults = mysqli_num_rows($result);
                                
                                if ($queryResults > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $item_upc = $row['item_upc'];
                                        $item_qty = $row['item_quantity'];
                                        $uid = $_SESSION['u_id'];
                                        //$household = $_SESSION['household_size'];
                                        $received = date('Y-m-d',(strtotime($row['date_received'])));
                                        $depleted = date('Y-m-d',(strtotime($row['date_depleted'])));
                                        $date_updated = date('Y-m-d',(strtotime($row['date_updated'])));
                                        $today = date('Y-m-d');
                                        $diff = date_diff(date_create($date_updated), date_create($today));
                                        $numDiff = $diff->format('%a');
                                        $sql2 = "SELECT AVG(avg_daily_consumption) FROM pantry WHERE user_id = $uid AND item_upc = $item_upc";
                                        $result2 = mysqli_query($conn, $sql2);
                                        $queryResults2 = mysqli_num_rows($result2);
                                        while ($row2 = mysqli_fetch_assoc($result2)) {
                                            $dailyConsumption = $row2['AVG(avg_daily_consumption)'];

                                            if((($numDiff/86400) > 1) || $date_updated = NULL) {
                                                $sql3 = "UPDATE pantry SET quantity_remaining = (quantity_remaining - ($dailyConsumption * ($numDiff/86400))), date_updated = CURDATE() WHERE user_id = '$uid' AND item_upc = '$item_upc' AND quantity_remaining > 0";
                                                $result3 = mysqli_query($conn, $sql3);
                                                
                                            }
                                        
                                            }
                                        }
                                    }
                                }

                        ////////////////////Display remaining products with a quantity of Zero (0) to confirm they are gone////////////
                            if (isset($_SESSION['u_id'])) {
                                    $sql5 = "SELECT * FROM pantry LEFT OUTER JOIN products ON pantry.item_upc = products.item_upc WHERE pantry.user_id = ".$_SESSION['u_id']." AND quantity_remaining <= 0 ORDER BY date_received DESC, item_name ASC";
                                    $result5 = mysqli_query($conn, $sql5);
                                    $queryResults5 = mysqli_num_rows($result5);

                                    if ($queryResults5 > 0) {
                                echo"<section class='pastPurchases'>
                                    <h4 style='width:100%; color:#555; margin:15px;'>Items we think you may have run out of<p class='downUpArrow' style='float:right;'></p></h4>";
                                    while ($row5 = mysqli_fetch_assoc($result5)) {
                                        $item_upc = $row5['item_upc'];
                                        $item_qty = $row5['item_quantity'];
                                        $qty_remaining = $row5['quantity_remaining'];
                                        $modifier = $row5['modifier'];
                                        $item_name = $row5['item_name'];
                                        $date = $row5['date_received'];
                                        $uid = $_SESSION['u_id'];
                                        $received = date('Y-m-d',(strtotime($row5['date_received'])));
                                        $today = date('Y-m-d');
                                        $diff = date_diff(date_create($received), date_create($today));
                                        $numDiff = $diff->format('%a');
                                        $sql6 = "SELECT * FROM product_photos WHERE upc = $item_upc";
                                        $result6 = mysqli_query($conn, $sql6);
                                        $row6 = mysqli_fetch_assoc($result6);
                                            $link = $row6['link'];
                                    echo "<section class='product-cards'>";
                                            if ($row5['has_image'] == 1) {
                                            $filename = "img/".$item_upc."*";
                                            $fileinfo = glob($filename);
                                            $fileExt = explode(".", $fileinfo[0]);
                                            $fileActualExt = $fileExt[1];
                                            $fileResized = "img/resized_".$item_upc.".".$fileActualExt;

                                        echo "<div id='product-photo'>
                                                <a href=details.php?upc=".$item_upc.">
                                                <img id='resultPhoto' src='$fileResized' alt='$item_name' onerror=this.src='img/noimageavailable.png' style='margin-top: -30px; !important;'>
                                                </a>
                                                </div>";
                                                } else {
                                        echo "<div id='product-photo'>
                                                <a href=details.php?upc=".$item_upc.">
                                                <img id='resultPhoto' src='$link' alt='$item_name' onerror=this.src='img/noimageavailable.png' style='margin-top: -30px; !important;'>
                                                </a>
                                                </div>";
                                                }
                                        echo "<div id='product-info'>
                                                <a href=details.php?upc=".$row5['item_upc']." class='productAnchor'>
                                                <p id='resultName' href=details.php name=details>".$row5['item_brand'].", ".$row5['item_name']."</p>
                                                <p id='resultName' href=details.php name=details>".$numDiff." days old</p>
                                                </a>
                                            </div>


                                            <div style=' position:static; margin-top:105px;'>
                                                <div id='deleteForm' style='float:left !important; left:5px !important; top:260px; position:absolute !important; width:20px; bottom:0px !important;'>
                                                    
                                                </div>

                                        <div id='adjust' style='width:130px; margin:auto;'>";
                                            if ($qty_remaining <= 1) {
                                                echo"<form id='delete' method='POST' action='includes/action.php?dupc=".$item_upc."'>
                                                    <input type=hidden id=dupc name=pdupc value=".$item_upc.">
                                                    <button class='pantryListDelete' uid=".$uid." qty=".$item_qty." id=".$item_upc." date=".$date." type='submit' value=".$item_upc.">&times;</button>
                                                    </form>";
                                                } else {
                                                echo"<form id='adjustDownForm' method='POST' action='includes/action.php'>
                                                    <input type=hidden id=pantry_item_to_adjust_down name=pantry_item_to_adjust_down value=".$item_upc.">
                                                    <input type=hidden id=quantityd name=quantityd value=".$qty_remaining.">
                                                    <input type=hidden id=date name=date value=".$date.">
                                                    <input type=hidden id=today name=today value=".$today.">
                                                    <button class='pantryAdjustDownBtn' date=".$date." uid=".$uid." today=".$today." qty=".$qty_remaining." id=".$item_upc." type='submit' name='pantryAdjustDownBtn'>-</button>
                                                    </form>";
                                            }

                                            echo"<center><h5 id='resultQty-thumbnail'>".ceil($qty_remaining)."</h5></center>
                                                <form id=adjustUpForm method='POST' action='includes/action.php'>
                                                    <input type=hidden id=pantry_item_to_adjust_up name=pantry_item_to_adjust_up value=".$item_upc.">
                                                    <input type=hidden id=quantityu name=quantityu value=".$qty_remaining.">
                                                    <input type=hidden id=date name=date value=".$date.">
                                                    <button class=adjustUpBtn date=".$date." uid=".$uid." qty=".$qty_remaining." id=".$item_upc." type='submit' name=adjustUpBtn>+</button>
                                                </form>
                                            </div>
                                        </div>
                                    </section>";
                                    }
                                echo "</section>";
                                }
                                }
                            

                            
                            ///////////Display remaining products and quantities in pantry////////////
                            if (isset($_SESSION['u_id'])) {
                                    $sql5 = "SELECT * FROM pantry LEFT OUTER JOIN products ON pantry.item_upc = products.item_upc WHERE pantry.user_id = ".$_SESSION['u_id']." AND quantity_remaining > 0 AND pantry.`item_upc` = products.`item_upc` ORDER BY date_received DESC, item_name ASC";
                                    $result5 = mysqli_query($conn, $sql5);
                                    $queryResults5 = mysqli_num_rows($result5);

//echo $sql5;

                                    if ($queryResults5 > 0) {
                                    echo"<section class='pastPurchases'>
                                    <h4 style='width:100%; color:#555; margin:15px;'>[$queryResults5] Items you still have at home<p class='downUpArrow' style='float:right;'></p></h4>";
                                    while ($row5 = mysqli_fetch_assoc($result5)) {

                                        $item_upc = $row5['item_upc'];
                                        $item_qty = $row5['item_quantity'];
                                        $qty_remaining = $row5['quantity_remaining'];
                                        $modifier = $row5['modifier'];
                                        $item_name = $row5['item_name'];
                                        $date = $row5['date_received'];
                                        $uid = $_SESSION['u_id'];
                                        $received = date('Y-m-d',(strtotime($row5['date_received'])));
                                        $today = date('Y-m-d');
                                        $diff = date_diff(date_create($received), date_create($today));
                                        $numDiff = $diff->format('%a');
                                        $sql6 = "SELECT * FROM product_photos WHERE upc = $item_upc";
                                        //$result6 = mysqli_query($conn, $sql6);
                                        //$row6 = mysqli_fetch_assoc($result6);
                                            //$link = $row6['link'];
                                            $link = "";
                                    echo "<section class='product-cards'>";
                                            if ($row5['has_image'] == 1) {
                                            $filename = "img/".$item_upc."*";
                                            $fileinfo = glob($filename);
                                            $fileExt = explode(".", $fileinfo[0]);
                                            $fileActualExt = $fileExt[1];
                                            $fileResized = "img/resized_".$item_upc.".".$fileActualExt;

                                        echo "<div id='product-photo'>
                                                <a href=details.php?upc=".$item_upc.">
                                                <img id=resultPhoto src='$fileResized' alt='$item_name' onerror=this.src='img/noimageavailable.png' style='margin-top: -30px; !important;'>
                                                </a>
                                                </div>";
                                                } else {
                                        echo "<div id='product-photo'>
                                                <a href=details.php?upc=".$item_upc.">
                                                <img id=resultPhoto src='$link' alt='$item_name' onerror=this.src='img/noimageavailable.png' style='margin-top: -30px; !important;'>
                                                </a>
                                                </div>";
                                                }
                                        echo "<div id='product-info'>
                                                <a href=details.php?upc=".$row5['item_upc']." class=productAnchor>
                                                <p id='resultName' href=details.php name=details>".$row5['item_brand'].", ".$row5['item_name']."</p>
                                                <p id=resultName href=details.php name=details>".$numDiff." days old</p>
                                                </a>
                                            </div>


                                            <div style=' position:static; margin-top:105px;'>";
                                            /* <div id=deleteForm style='float:left !important; left:5px !important; top:260px; position:absolute !important; width:20px; bottom:0px !important;'>
                                                    <form id=delete method='POST' action='includes/action.php?dupc=".$item_upc."'>
                                                        <input type=hidden id=dupc name=dupc value=".$item_upc.">
                                                        <button class=pantryListDelete uid=".$uid." qty=".$item_qty." id=".$item_upc." type='submit' value=".$item_upc.">&times;</button>
                                                    </form>
                                                </div>*/

                                        echo "<div id='adjust' style='width:130px; margin:auto;'>";
                                                if ($qty_remaining <= 1) {
                                                echo"<form id=delete method='POST' action='includes/action.php?dupc=".$item_upc."'>
                                                    <input type=hidden id=dupc name=pdupc value=".$item_upc.">
                                                    <button class=pantryListDelete uid=".$uid." qty=".$item_qty." id=".$item_upc." date=".$date." type='submit' value=".$item_upc.">&times;</button>
                                                    </form>";
                                                } else {
                                                echo"<form id=adjustDownForm method='POST' action='includes/action.php'>
                                                    <input type=hidden id=pantry_item_to_adjust_down name=pantry_item_to_adjust_down value=".$item_upc.">
                                                    <input type=hidden id=quantityd name=quantityd value=".$qty_remaining.">
                                                    <input type=hidden id=date name=date value=".$date.">
                                                    <input type=hidden id=today name=today value=".$today.">
                                                    <button class=pantryAdjustDownBtn date=".$date." uid=".$uid." today=".$today." qty=".$qty_remaining." id=".$item_upc." type='submit' name=pantryAdjustDownBtn>-</button>
                                                    </form>";
                                                }
                                                echo"<center><h5 id=resultQty-thumbnail>".ceil($qty_remaining)."</h5></center>
                                                    <form id=adjustUpForm method='POST' action='includes/action.php'>
                                                        <input type=hidden id=pantry_item_to_adjust_up name=pantry_item_to_adjust_up value=".$item_upc.">
                                                        <input type=hidden id=quantityu name=quantityu value=".$qty_remaining.">
                                                        <input type=hidden id=date name=date value=".$date.">
                                                        <button class=adjustUpBtn date=".$date." uid=".$uid." qty=".$qty_remaining." id=".$item_upc." type='submit' name=adjustUpBtn>+</button>
                                                    </form>
                                                </div>

                                            </div>
                                        </section>";
                                    }
                                //exit();
                                echo "</section>";
                                } else if ($queryResults5 < 1) {
                                    echo "<br>
                                        <h4 id=listMessege>Your pantry is empty.</h4>
                                        <br>";
                                        //exit();
                                } else {
                                    header("Location: index.php");
                                    exit();
                                }
                                }

                        ?>
                        </div>   

                                

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