
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
                        <div class="content-crumb-div" >
                                <a class="fileTrail" href="index.php">Home</a>   
                                <i style="font-size: 1rem;" class="fa fa-arrow-right"></i> 
                                My Shop!
                                
                        </div>
                    </div>
                    <!-- </div> -->
                </div>
                <div class="row">
                    <div class="no-gutter">
                            <div class="space-half"></div>
                            <!-- spacer end -->

                            
                            

                                <!-- left content -->
                                <div class="col-md-12">
                                    <div class="onStep" data-animation="fadeInUp" data-time="300">

                                        <!-- <div style="margin:25px !important;">My Shop</div> -->

                                        <div class='create-recipe3' style="">
    <?php
    
                
    echo "<div class='shop-compareList'>";
            if (isset($_SESSION['u_id']) && isset($_GET['storeId']) && isset($_GET['storeName']) && isset($_SESSION['state'])) {
        $uid = $_SESSION['u_id'];
        $storeId = $_GET['storeId'];
        $storeName = $_GET['storeName'];
        $state = $_SESSION['state'];
        $sql = "SELECT * FROM ((grocery_lists INNER JOIN product_prices ON grocery_lists.item_upc = product_prices.item_upc) INNER JOIN products ON grocery_lists.item_upc = products.item_upc) WHERE grocery_lists.user_id = '$uid' AND product_prices.store_name_id = '$storeId' AND product_prices.state = '$state' ORDER BY products.item_name";
        $result = mysqli_query($conn, $sql);
        $queryResults = mysqli_num_rows($result);
        echo "<div id='' class='text-center'>
                <h4 class='text-center'>Shopping at <strong style='color:red;'>".urldecode($storeName)."</strong></h4>";
        if ($queryResults > 0) {
            $sql3 = "SELECT store_name_id, product_prices.store_name, state, SUM(grocery_lists.item_quantity * product_prices.company_price) FROM grocery_lists LEFT OUTER JOIN product_prices ON grocery_lists.item_upc = product_prices.item_upc WHERE grocery_lists.user_id = ".$_SESSION['u_id']." AND product_prices.state = '$state' AND product_prices.store_name_id = '$storeId' GROUP BY store_name ORDER BY SUM(grocery_lists.item_quantity * product_prices.company_price) LIMIT 1";
            $result3 = mysqli_query($conn, $sql3);
            while ($row3 = mysqli_fetch_assoc($result3)) { 
                $storeName = $row3['store_name'];
                $total = $row3['SUM(grocery_lists.item_quantity * product_prices.company_price)'];
                $storeId = $row3['store_name_id'];
                $state = $row3['state'];
            if ($total > 0) {
                if ($state == $_SESSION['state']) {
            echo
            "<h4 class='text-center' style='font-size:20px;display: block;'>Total: $$total<h4>";
                    }
                }
            }                
        echo"<br></div>";           

            echo "<br><p class='text-center'>On your List</p>";
///////////////////////Start of In List//////////////////////
            echo "<div class=cardArea>
            ";
                
            while ($row = mysqli_fetch_assoc($result)) {
                $item_upc = $row['item_upc'];
                $item_qty = $row['item_quantity'];
                $item_name = $row['item_name'];
                $item_brand = $row['item_brand'];
                $item_price = $row['company_price'];
                $inCart = $row['in_cart'];
                $measurement = $row['measurement'];
                $sql6 = "SELECT * FROM product_photos WHERE upc = $item_upc";
                    $result6 = mysqli_query($conn, $sql6);
                    $row6 = mysqli_fetch_assoc($result6);
                    $link = $row6['link'];
        if ($inCart < 1) {
                //My List
        echo "
            <div class=cardRow>
                <div class='list pantryWidthOne'>
                    <div class='product-container-thumbnail-myList' style='height:120px !important;'>
                    
                        <div id=product-photo-thumbnail>
                            <div class=shopCheckOff>
                            <form method='GET' class=check name=check action='includes/action.php'>
                            <input type=hidden id=uid name=uid value=".$_SESSION['u_id'].">
                            <input type=hidden id=list_upc_check name=list_upc_check value=$item_upc>
                            <input type=hidden id=storeId name=storeId value=$storeId>
                            <input type=hidden id=storeName name=storeName value='$storeName'>
                            <button type=submit style='margin:0px; padding:0px; height:24px; width:24px; border-radius:none;'><input type=checkbox class=check style='text-align:center; height:20px; width:20px; margin:0px; padding:0px; border-radius:none;'></button>
                            </form>
                            </div>
                            <a href=details.php?upc=".$item_upc.">";
                            if ($row['has_image'] == 1) {
                            $filename = "img/".$item_upc."*";
                            $fileinfo = glob($filename);
                            $fileExt = explode(".", $fileinfo[0]);
                            $fileActualExt = $fileExt[1];
                            $file = "img/".$item_upc.".".$fileActualExt;    
                            echo "<img id=resultPhoto-thumbnail src='$file' alt=$item_name onerror=this.src='img/noimageavailable.png'>";
                                } else {
                            echo "<img id=resultPhoto-thumbnail src='$link' alt=$item_name onerror=this.src='img/noimageavailable.png'>"; 
                                }
                            echo "</a>
                        </div>
                        <div id='listInfo' style='width:60%;' type='submit' name='item-details'>
                            <div id=product-info-thumbnail style='width:95%;'>
                                <a id=resultInfo-thumbnail style='width:95%;' href='details.php?upc=$item_upc'>$item_brand, $item_name
                                <br>
                                <br>
                                <p style='color:red;' ><strong>$".$item_price*$item_qty."</strong>($$item_price/$measurement)</p>
                                </a>   
                            </div>
                        </div>
                        <div class=controlsBox>
                            <div id=adjust>";
                                if ($item_qty <= 1) {
                                echo"<div id=deleteForm>
                                    <form id=delete method='POST' action='includes/action.php?dupc=".$item_upc."'>
                                        <input type=hidden id=dupc name=dupc value=".$item_upc.">
                                        <input type=hidden id=storeId name=storeId value=$storeId>
                                        <input type=hidden id=storeName name=storeName value=$storeName>
                                        <button class=listDelete uid=".$uid." qty=".$item_qty." id=".$item_upc." type='submit' value=".$item_upc.">&times;</button>
                                    </form>
                                </div>";
                            } else {
                                echo"<form id=adjustDownForm method='POST' action='includes/action.php'>
                                    <input type=hidden id=shop_item_to_adjust_d name=shop_item_to_adjust_d value=".$item_upc.">
                                    <input type=hidden id=quantity name=quantity value=".$item_qty.">
                                    <input type=hidden id=storeId name=storeId value=$storeId>
                                    <input type=hidden id=storeName name=storeName value=$storeName>
                                    <button class=shopAdjustDownBtn uid=".$uid." qty=".$item_qty." id=".$item_upc." type='submit' name=shopAdjustDownBtn>-</button>
                                </form>";
                            }
                               echo"<center><h5 id=resultQty-thumbnail>".$row['item_quantity']."</h5></center>
                                <form id=adjustUpForm method='POST' action='includes/action.php'>
                                    <input type=hidden id=shop_item_to_adjust_u name=shop_item_to_adjust_u value=".$item_upc.">
                                    <input type=hidden id=storeId name=storeId value=$storeId>
                                    <input type=hidden id=storeName name=storeName value=$storeName>
                                    <input type=hidden id=quantity name=quantity value=".$item_qty.">
                                    <button class=shopAdjustUpBtn uid=".$uid." qty=".$item_qty." id=".$item_upc." type='submit' name=shopAdjustUpBtn>+</button>
                                </form>
                            </div>
                            </div>
                    </div>
                    
                </div>
            </div>";
            }
            }
                
        echo "</div>";
////////////////////End of In List///////////////////////////
        
        echo "<br><br>";
            
////////////////////Start of In cart/////////////////////////
        
            $sql = "SELECT * FROM ((grocery_lists INNER JOIN product_prices ON grocery_lists.item_upc = product_prices.item_upc) INNER JOIN products ON grocery_lists.item_upc = products.item_upc) WHERE grocery_lists.user_id = '$uid' AND product_prices.store_name_id = '$storeId' AND product_prices.state = '$state' ORDER BY products.item_name";
            $result = mysqli_query($conn, $sql);
            $queryResults = mysqli_num_rows($result);
            
            echo "<div class=cardArea>
            <p class='text-center'>In your Cart";
            while ($row = mysqli_fetch_assoc($result)) {
                $item_upc = $row['item_upc'];
                $item_qty = $row['item_quantity'];
                $item_name = $row['item_name'];
                $item_brand = $row['item_brand'];
                $item_price = $row['company_price'];
                $inCart = $row['in_cart'];
                $measurement = $row['measurement'];
                $sql6 = "SELECT * FROM product_photos WHERE upc = $item_upc";
                    $result6 = mysqli_query($conn, $sql6);
                    $row6 = mysqli_fetch_assoc($result6);
                    $link = $row6['link'];
        if ($inCart > 0) {
                //My Cart

        echo "
            <div class=cardRow>
                <div class='list pantryWidthOne'>
                    <div class='product-container-thumbnail-myList' style='height:120px !important;'>
                    
                        <div id=product-photo-thumbnail>
                            <div class=shopCheckOff>
                            <form method='GET' class='uncheck' name='uncheck' action='includes/action.php'>
                                <input type=hidden id=uid name=uid value=".$_SESSION['u_id'].">
                                <input type=hidden id=list_upc_uncheck name=list_upc_uncheck value=$item_upc>
                                <input type=hidden id=storeId name=storeId value=$storeId>
                                <input type=hidden id=storeName name=storeName value=$storeName>
                                <button type=submit style='margin:0px; padding:0px; height:24px; width:24px; border-radius:none;'><input type=checkbox class=uncheck style='text-align:center; height:20px; width:20px; margin:0px; padding:0px; border-radius:none;' checked></button>
                            </form>
                            </div>
                            <a href=details.php?upc=".$item_upc.">";
                            if ($row['has_image'] == 1) {
                            $filename = "img/".$item_upc."*";
                            $fileinfo = glob($filename);
                            $fileExt = explode(".", $fileinfo[0]);
                            $fileActualExt = $fileExt[1];
                            $file = "img/".$item_upc.".".$fileActualExt;    
                            echo "<img id=resultPhoto-thumbnail src='$file' alt=$item_name onerror=this.src='img/noimageavailable.png'>";
                                } else {
                            echo "<img id=resultPhoto-thumbnail src='$link' alt=$item_name onerror=this.src='img/noimageavailable.png'>"; 
                                }
                            echo "</a>
                        </div>
                        <div id='listInfo' style='width:60%;' type='submit' name='item-details'>
                            <div id=product-info-thumbnail style='width:95%;'>
                                <a id=resultInfo-thumbnail style='width:95%;' href='details.php?upc=$item_upc'>$item_brand, $item_name
                                <br>
                                <br>
                                <p style='color:red;'><strong>$".$item_price*$item_qty."</strong>($$item_price/$measurement)</p>
                                </a>   
                            </div>
                        </div>
                            <div class=controlsBox>
                            <div id=adjust>";
                            if ($item_qty <= 1) {
                                echo"<div id=deleteForm>
                                    <form id=delete method='POST' action='includes/action.php?dupc=".$item_upc."'>
                                        <input type=hidden id=dupc name=dupc value=".$item_upc.">
                                        <input type=hidden id=storeId name=storeId value=$storeId>
                                        <input type=hidden id=storeName name=storeName value=$storeName>
                                        <button class=listDelete uid=".$uid." qty=".$item_qty." id=".$item_upc." type='submit' value=".$item_upc.">&times;</button>
                                    </form>
                                </div>";
                            } else {
                                echo"<form id=adjustDownForm method='POST' action='includes/action.php'>
                                    <input type=hidden id=shop_item_to_adjust_d name=shop_item_to_adjust_d value=".$item_upc.">
                                    <input type=hidden id=quantity name=quantity value=".$item_qty.">
                                    <input type=hidden id=storeId name=storeId value=$storeId>
                                    <input type=hidden id=storeName name=storeName value=$storeName>
                                    <button class=shopAdjustDownBtn uid=".$uid." qty=".$item_qty." id=".$item_upc." type='submit' name=shopAdjustDownBtn>-</button>
                                </form>";
                            }
                               echo"<center><h5 id=resultQty-thumbnail>".$row['item_quantity']."</h5></center>
                                <form id=adjustUpForm method='POST' action='includes/action.php'>
                                    <input type=hidden id=shop_item_to_adjust_u name=shop_item_to_adjust_u value=".$item_upc.">
                                    <input type=hidden id=storeId name=storeId value=$storeId>
                                    <input type=hidden id=storeName name=storeName value=$storeName>
                                    <input type=hidden id=quantity name=quantity value=".$item_qty.">
                                    <button class=shopAdjustUpBtn uid=".$uid." qty=".$item_qty." id=".$item_upc." type='submit' name=shopAdjustUpBtn>+</button>
                                </form>
                            </div>
                            </div>
                    </div>
                    
                </div>
            </div>";
            
            
///////////////////Price Confirmation Modal////////////////////////////////////
            
            if (isset($_GET['upc']) && isset($_GET['storeId']) && isset($_GET['storeName'])) {
                if ($_GET['upc'] == $item_upc && $_GET['storeId'] == $storeId && $_GET['storeName'] == $storeName) {
                echo "<div id='modal-background' style='z-index:1101;'>
                        <div id='price-modal'>
                            <div id='priceModalFormAreaYes'>
                                <h4 id=details-upc>$item_brand, $item_name</h4><hr>
                                <h4 id=details-upc>Is the regular price $$item_price/$measurement?</h4><br><br>
                                <form method='GET' action='includes/action.php'>
                                    <input type=hidden class='detailsInput' id='storeName' name='storeName' value='$storeName'>
                                    <input type=hidden class='detailsInput' id='storeState' name='storeState' value=".$_SESSION['state'].">
                                    <input type=hidden pattern=[0-9]* min=0.00 max=100.00 step=0.01 class='detailsInput' id='priceEntry' name='priceEntry' value='$item_price' oninput=this.value=parseInt(this.value.replace('.',''))/100>
                                    <input type=hidden id='itemUPC' name='itemUPC' value=$item_upc>
                                    <input type=hidden id='itemName' name='itemName' value='$item_name'>
                                    <input type=hidden id='measureSelct' name='measureSelect' value='$measurement'> 
                                    <button class='btn btn-sm btn-success' name='priceConfirmYes' id='priceConfirmYes' type='submit'>Yes</button>
                                </form>
                                <button class='btn btn-sm btn-danger' name='priceConfirmNo' id='priceConfirmNo' type='submit'>No</button>
                            </div>
                            
                            <div id='priceModalFormAreaNo'>
                                <h4 id=details-upc>$item_brand, $item_name</h4><hr>
                                <h4 id=details-upc>Please Enter The Correct Price</h4>
                                <form method='GET' action='includes/action.php'>
                                    <input type=hidden class='detailsInput' id='storeName' name='storeName' value='$storeName'>
                                    <input type=hidden class='detailsInput' id='storeState' name='storeState' value=".$_SESSION['state'].">
                                    
                                    <input type=number autofocus='autofocus' pattern=[0-9]* min=0.00 max=100.00 step=0.01 class='detailsInput' id='priceEntry' name='priceEntry' placeholder='$' oninput=this.value=parseInt(this.value.replace('.',''))/100>
                                    <input type=hidden id='itemUPC' name='itemUPC' value=$item_upc>
                                    <input type=hidden id='itemName' name='itemName' value='$item_name'>
                                    
                                    <select class='detailsInput' id='measureSelct' name='measureSelect'>
                                    <option name='EA' value=ea>ea</option>
                                    <option name='LB' value=lb>lb</option>
                                    </select>
                                    <br>
                                    <button class='btn btn-sm btn-warning' name='priceSubmitShop' id='priceSubmitShop' type='submit'>Submit</button>
                                    <br>
                                </form>
                            </div>
                        </div>
                    </div>";
                }  
            }
            
            }
            }          
////////////////////End of in cart/////////////////////////

    } else if ($queryResults < 1) {
        echo "<br>
            <h4 id=listMessege>Items in your grocery list will appear here. Start adding some items to your list!</h4>
            <br>";
    } else {
        header("Location: ../index.php");
        exit();
    }
}
echo"</div>";
echo"<br>
    <form method='POST' action='includes/action.php'>
        <input type=hidden name=storeId value=".$_GET['storeId'].">
        <button class=finalize name=listReceived>Shopping Complete, Add These Items To My Pantry</button>
    </form>";
?>
</div>

                                        </div>
                                </div>
                                <!-- left content end -->

                              

                            
                            <!-- row content end -->
                            

                            <!-- spacer -->
                            <!-- <div class="space-single"></div> -->

                       

                    </div>
                </div>
            </div>
        </section>
        <!-- section -->


<!-- Footer Start/End/JS -->
<?php include 'includes/footer_inc.php'?>

</html>