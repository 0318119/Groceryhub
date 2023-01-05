
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
                    <div id="topbar" style=";">
                        <div class="content-crumb-div">
                        <a class="fileTrail" href="index.php">Home</a>
                        <i style="font-size: 1rem;" class="fa fa-arrow-right"></i>
                        Past Purchases!

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
                                <div class="col-md-12">
                                    <div class="onStep" data-animation="fadeInUp" data-time="300">
                                        <div style="margin:25px !important;">
                                        <h3 class="onStep" data-animation="fadeInRight" data-time="0">Past Purchases & Lists!</h3>
                                        </div>
<div class="pantry-area">
<?php
if (isset($_SESSION['u_id'])) {


////////////////////Display remaining products with a quantity of Zero (0) to confirm they are gone////////////
    $sql = "SELECT DISTINCT date_received FROM past_purchases WHERE past_purchases.user_id = ".$_SESSION['u_id']." ORDER BY date_received DESC";
    $result = mysqli_query($conn, $sql);
    $queryResults = mysqli_num_rows($result);

    if ($queryResults > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
    $date = $row['date_received'];
        
   $sql4 = "SELECT company_id, store_name, SUM(item_quantity * item_price) FROM past_purchases LEFT OUTER JOIN store_names ON past_purchases.company_id = store_names.store_name_id WHERE user_id = ".$_SESSION['u_id']." AND date_received = '$date'";
    $result4 = mysqli_query($conn, $sql4);
    $queryResults4 = mysqli_num_rows($result4);  
    $row4 = mysqli_fetch_assoc($result4);
    $priceTotal = $row4['SUM(item_quantity * item_price)'];
    $company = $row4['store_name'];
    

////////////Display a section for each shopping list//
echo "<section class='pastPurchases'>
<h5 style='width:100%; color:#555; margin:15px;'>$date Total:$".number_format($priceTotal, 2)." $company<p class='downUpArrow' style='float:right;'>&#9499</p></h5>
<div class='cardArea' style='display:none;'>";
    
//////////Display products and quantities in each shopping list////////////
    $sql5 = "SELECT * FROM past_purchases LEFT OUTER JOIN products ON past_purchases.item_upc = products.item_upc WHERE past_purchases.user_id = ".$_SESSION['u_id']." AND date_received = '$date' ORDER BY item_name ASC";
    $result5 = mysqli_query($conn, $sql5);
    $queryResults5 = mysqli_num_rows($result5);

    if ($queryResults5 > 0) {
    while ($row5 = mysqli_fetch_assoc($result5)) {
    $item_upc = $row5['item_upc'];
    $item_name = $row5['item_name'];
    $uid = $_SESSION['u_id'];
    $received = date('Y-m-d',(strtotime($row5['date_received'])));
    $today = date('Y-m-d');
    $diff = date_diff(date_create($received), date_create($today));
    $numDiff = $diff->format('%a');
    $sql6 = "SELECT * FROM product_photos WHERE upc = $item_upc";
    $result6 = mysqli_query($conn, $sql6);
    $row6 = mysqli_fetch_assoc($result6);
    $link = $row6['link'];

    echo "<div class=product-cards >";
        if ($row5['has_image'] == 1) {
        $filename = "img/".$item_upc."*";
        $fileinfo = glob($filename);
        $fileExt = explode(".", $fileinfo[0]);
        $fileActualExt = $fileExt[1];
        $fileResized = "img/resized_".$item_upc.".".$fileActualExt;

        echo "<div id=product-photo>
                <a href=details.php?upc=".$item_upc.">
                <img id=resultPhoto src=$fileResized alt=$item_name onerror=this.src='img/noimageavailable.png' style='margin-top: -32px; !important;'>
                </a>
                </div>";
                } else {
        echo "<div id=product-photo>
                <a href=details.php?upc=".$item_upc.">
                <img id=resultPhoto src='$link' alt='$item_name' onerror=this.src='img/noimageavailable.png' style='margin-top: -32px; !important;'>
                </a>
                </div>";
                }
        echo "<div id=product-info-past-purch>
                <a href=details.php?upc=".$row5['item_upc']." class=productAnchor>
                <h4 id=resultName href=details.php name=details>".$row5['item_brand'].", ".$row5['item_name']."</h4>
                <h4 id=resultName href=details.php name=details>$".$row5['item_price']."ea</h4>
                <h4 id=resultName href=details.php name=details>Quantity:".$row5['item_quantity']."</h4>
                </a>
            </div>
        </div>";
        }  
    }
echo"</div>
</section>";
    }
} else if ($queryResults < 1) {
    echo "<br>
        <h4 id=listMessege>You have no past purchases</h4>
        <br>";
        exit();
    } else {
    header("Location: index.php");
    exit();
    }
}


?>
</div>

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