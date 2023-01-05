<!DOCTYPE html>
<html lang="en">

<?php 

include_once 'includes/dbh.inc.php';
include 'includes/header.php'; 

?>

<!-- spacer -->
<div class="space-single hidden-sm hidden-xs">
</div>
<div class="space-half"></div>
<!-- spacer end -->

<!-- wrapper -->
<div class="row">
    <div class="col-md-12 col-md-offset-1 col-sm-12 col-sm-offset-1 col-xs-12 col-xs-offset-1 pull-left">

        <!-- row content -->
        <div class="row">

            <!-- left content -->
            <div class="col-md-12">
                <div class="onStep" data-animation="fadeInUp" data-time="300">

                    <h3 class="onStep" data-animation="fadeInRight" data-time="0">My List</h3>
                    <!-- area start -->
                    <div class='create-recipe3' >
    <?php
    
       echo"<div id=resultsHeader>
        <h4 class=searchResults>Select store.</h4>
        </div>";         
        echo "<div class=compareList>";
     
    
        if (isset($_SESSION['u_id'])) {
        $state = $_SESSION['state'];
        $uid = $_SESSION['u_id'];
        $sql = "SELECT * FROM grocery_lists INNER JOIN products ON grocery_lists.item_upc = products.item_upc WHERE grocery_lists.user_id = ".$_SESSION['u_id']." ORDER BY grocery_lists.item_name";
        $i = 0;
        $testArray = array();
        $result = mysqli_query($conn, $sql);
        $queryResults = mysqli_num_rows($result);

    if ($queryResults > 0) {
        
        
///////////////////STORE PRICE TOTALS AREA///////////////////////////////
   
    echo "<div class='storeTileArea'>
     <ul id=storesListUL>";
     $sql8 = "SELECT store_name_id, product_prices.store_name, state, SUM(grocery_lists.item_quantity * product_prices.company_price) FROM grocery_lists LEFT OUTER JOIN product_prices ON grocery_lists.item_upc = product_prices.item_upc WHERE grocery_lists.user_id = ".$_SESSION['u_id']." AND product_prices.state = '$state' GROUP BY store_name ORDER BY SUM(grocery_lists.item_quantity * product_prices.company_price) ASC LIMIT 10";
     $result8 = mysqli_query($conn, $sql8);
     $n = 0;

    
    while ($row8 = mysqli_fetch_assoc($result8)) {
    $priceArray = array();
    $i = 0;
    $store = $row8['store_name'];
    $total = $row8['SUM(grocery_lists.item_quantity * product_prices.company_price)'];
    $storeId = $row8['store_name_id'];
    $state = $row8['state'];
    $filename2 = "img/store_icon/".$storeId."*";
    $fileinfo2 = glob($filename2);
    $fileExt2 = explode(".", $fileinfo2[0]);
    $fileActualExt2 = $fileExt2[1];
    $file2 = "img/store_icon/".$storeId.".".$fileActualExt2;
    if ($total > 0) {

    $sql9 = "SELECT * FROM grocery_lists INNER JOIN products ON grocery_lists.item_upc = products.item_upc WHERE grocery_lists.user_id = ".$_SESSION['u_id']." ORDER BY grocery_lists.item_name";
    $i = 0;
    
    $result9 = mysqli_query($conn, $sql9);
    $queryResults9 = mysqli_num_rows($result9);

    while ($row9 = mysqli_fetch_assoc($result9)) {
    $item_upc = $row9['item_upc'];
    $item_qty = $row9['item_quantity'];
    $item_name = $row9['item_name'];
    
    $sql2 = "SELECT * FROM product_prices WHERE item_upc = ".$item_upc." AND store_name_id = ".$storeId." LIMIT 1";
    $result2 = mysqli_query($conn, $sql2);
    $queryResults2 = mysqli_num_rows($result2);
    if ($queryResults2 > 0) {
    $sql3 = "SELECT * from product_prices WHERE item_upc = $item_upc AND store_name_id = ".$storeId." LIMIT 1";
    $result3 = mysqli_query($conn, $sql3);
    while ($row3 = mysqli_fetch_assoc($result3)) {
    $priceArray[] = $row3['company_price'] * $item_qty;
    $item_price = $row3['company_price'];
    $storeId = $row3['store_name_id'];
    //$n++;
    }
    } else {
    $sql4 = "SELECT * FROM product_prices WHERE item_upc != ".$item_upc." AND store_name_id = ".$storeId." AND MATCH (item_name) AGAINST('$item_name') LIMIT 1";
    $result4 = mysqli_query($conn, $sql4);
    $queryResults4 = mysqli_num_rows($result4);
    if ($queryResults4 > 0) {
    while ($rows = mysqli_fetch_assoc($result4)) {
    $companyPrice = $rows['company_price'];
    $priceArray[] = $rows['company_price'] * $item_qty;
    //$n++;
    }
    }else {
    $priceArray[] = 0;
    //$n++;
    }   
    }
    }
     echo
     "<li>
     <form action='my_list.php' method='get' name='store' class='store' id='store'>
         <input type=radio name=checkedStore id=checkedStore$n>
         <input type=hidden name=storeId id=storeId value='$storeId'>
         <input type=hidden name=store id=store value=".urlencode($store).">
         <button type='submit' class='storeIdButton' value='$storeId'>
             <label for=checkedStore$n>
                 <div class='storePriceTile' "; if (isset($_GET['storeId']) && $_GET['storeId'] == $storeId) {echo" style='border: solid 3px #76BCE8;'";} echo">
                     <div class=storeLogoDiv>
                         <img src=$file2 alt=$store onerror=this.src='img/noimageavailable.png'>
                     </div>";
                     echo"<h2>$".number_format(array_sum($priceArray), 2)."</h2>
                 </div>
             </label>
         </button>
     </form>
     </li>";      
     }
    }
echo"</ul>
</div><br><br>";
 ///////////////// END OF STORE PRICE TOTALS AREA///////////////////////////////

        
 /////////////////LIST AREA/////////////////////////////////
 echo "<div class=cardArea style='float:right;'>";
     while ($row = mysqli_fetch_assoc($result)) {
     $sub_cat = $row['item_subcat'];
     $item_upc = $row['item_upc'];
     $item_qty = $row['item_quantity'];
     $item_name = $row['item_name'];
     $item_brand = $row['item_brand'];
     $sql6 = "SELECT * FROM product_photos WHERE upc = $item_upc";
     $result6 = mysqli_query($conn, $sql6);
     $row6 = mysqli_fetch_assoc($result6);
     if (isset($row6['link'])) {
        $link = $row6['link'];
     } else {
        $link = "";
     }
     

     //My List
     echo "<div class=cardRow>
         <div class='list "; if (isset($_GET[' storeId'])) {echo "pantryWidthOne" ;} else {echo "pantryWidthOne" ;} echo"'>
             <div class='product-container-thumbnail-myList'>
                 <div id=product-photo-thumbnail>
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
                 <div id='listInfo' type='submit' name='item-details'>
                     <div id=product-info-thumbnail>
                         <a id=resultInfo-thumbnail href='details.php?upc=$item_upc'>$item_brand, $item_name</a>
                     </div>
                 </div>";

                 echo "<div id=adjust>";
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
                         <button class=adjustDownBtn uid=".$uid." qty=".$item_qty." id=".$item_upc." type='submit' name=adjustDownBtn>-</button>
                     </form>";  
                    }   
                  echo"<center>
                         <h5 id=resultQty-thumbnail>".$row['item_quantity']."</h5>
                     </center>
                     <form id=adjustUpForm method='POST' action='includes/action.php'>
                         <input type=hidden id=item_to_adjust_u name=item_to_adjust_u value=".$item_upc.">
                         <input type=hidden id=quantityu name=quantityu value=".$item_qty.">
                         <button class=adjustUpBtn uid=".$uid." qty=".$item_qty." id=".$item_upc." type='submit' name=adjustUpBtn>+</button>
                     </form>
                 </div>
             </div>";

             //Store Items Row
             if (isset($_GET['storeId'])) {
             $storeId = $_GET['storeId'];
             $sql2 = "SELECT * FROM product_prices WHERE item_upc = ".$item_upc." AND store_name_id = ".$storeId." LIMIT 1";
             $result2 = mysqli_query($conn, $sql2);
             $queryResults2 = mysqli_num_rows($result2);

             if ($queryResults2 > 0) {
             echo "<div class='stores'>
                 <div class=gotIt>
                     <h4 class=availability>";
                     $sql3 = "SELECT * from product_prices WHERE item_upc = $item_upc AND store_name_id = ".$_GET['storeId']." LIMIT 1";
                     $result3 = mysqli_query($conn, $sql3);
                     while ($row3 = mysqli_fetch_assoc($result3)) {
                     $testArray[] = $row3['company_price'] * $item_qty;
                     $item_price = $row3['company_price'];
                     $measurement = $row3['measurement'];
                     $storeId = $row3['store_name_id'];
                     $i++;
                     if (isset($_GET['storeId']) && $_GET['storeId'] == $storeId) {
                     echo "<p style='margin: 0px 1% 0px 1%; height: 30px; padding: 0px; display: inline-block; text-align:center;'><strong>$".number_format($item_price*$item_qty, 2)."</strong>($$item_price/$measurement) They've got it!
                     <p>";
                    }
                echo"</h4>
                 </div>
             </div>";
                
             }

             } else {
             $sql4 = "SELECT * FROM product_prices WHERE item_upc != ".$item_upc." AND store_name_id = ".$storeId." AND MATCH (item_name) AGAINST ('$item_name') LIMIT 1";
             $result4 = mysqli_query($conn, $sql4);
             $queryResults4 = mysqli_num_rows($result4);
             if ($queryResults4 > 0) {
             $rows = mysqli_fetch_assoc($result4);
             $companyPrice = $rows['company_price'];
             $measurement = $rows['measurement'];
             $GLOBALS['companyPrice'];
             $itemUPC = $rows['item_upc'];
             $itemName = $rows['item_name'];
             $sql5 = "SELECT * FROM product_photos WHERE upc = $itemUPC LIMIT 1";
             $result5 = mysqli_query($conn, $sql5);
             $rows5 = mysqli_fetch_assoc($result5);
             $link2 = $rows5['link'];
             $sql6 = "SELECT * FROM products WHERE item_upc = $itemUPC LIMIT 1";
             $result6 = mysqli_query($conn, $sql6);
             $rows6 = mysqli_fetch_assoc($result6);
             $testArray[] = $rows['company_price'] * $item_qty;
                 $i++;
             echo "<div class='stores'>
                 <div class='product-container-thumbnail-stores'>
                     <div id=product-photo-thumbnail>
                         <a href=details.php?upc=".$itemUPC.">";
                             if ($rows6['has_image'] == 1) {
                             $filename = "img/".$itemUPC."*";
                             $fileinfo = glob($filename);
                             $fileExt = explode(".", $fileinfo[0]);
                             $fileActualExt = $fileExt[1];
                             $file = "img/".$itemUPC.".".$fileActualExt;
                             echo "<img id=resultPhoto-thumbnail src='$file' alt=$itemName onerror=this.src='img/noimageavailable.png'>";
                             } else {
                             echo "<img id=resultPhoto-thumbnail src='$link2' alt=$itemName onerror=this.src='img/noimageavailable.png'>";
                             }
                             echo "</a>
                     </div>
                     <div id='listInfo' type='submit' name='item-details'>
                         <div id=product-info-thumbnail>
                             <a id=resultInfo-thumbnail href='details.php?upc=$itemUPC'>$itemName</a>
                         </div>
                     </div>
                     <form id=myListReplaceItem method='POST' action='includes/action.php'>
                         <p style='margin-top:5px;'>Closest match <strong>$".number_format($companyPrice*$item_qty, 2)."</strong>($$companyPrice/$measurement)</p>
                         <input type=hidden id=oldUPC name=oldUPC value=".$item_upc.">
                         <input type=hidden id=newUPC name=newUPC value=".$itemUPC.">
                         <input type=hidden id=uid name=uid value=".$uid.">
                         <input type=hidden id=quantityReplace name=quantityReplace value=".$item_qty.">
                         <button class=replaceBtn uid=".$uid." qty=".$item_qty." oldUpc=".$item_upc." id=".$itemUPC." type='submit' name=replaceBtn>Replace Item</button>
                     </form>
                 </div>
             </div>";
                 
             } else {
             echo "<div class='stores'>
                 <div class=notGotIt>
                     <h4 class=availability>Nothing similar at ".urldecode($_GET['store']).".</h4>
                 </div>
             </div>";
                 $testArray[] = 0;
                 $i++;
             }
            
                
             }
             }
             echo "
         </div>";

         //Pantry Row
         $sql7 = "SELECT * FROM pantry WHERE user_id = ".$_SESSION['u_id']." AND item_upc = $item_upc AND quantity_remaining > 0 LIMIT 1";
         $result7 = mysqli_query($conn, $sql7);
         $queryResults7 = mysqli_num_rows($result7);
         if ($queryResults7 > 0) {
         while ($rows = mysqli_fetch_assoc($result7)) {
         $date = $rows['date_received'];
         $qty_remaining = $rows['quantity_remaining'];
         $modifier = $rows['modifier'];
         echo "<div class='pantry'>
             <div class='product-container-thumbnail-pantry'>
                 <div id=product-photo-thumbnail>
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
                 <div id='listInfo' type='submit' name='item-details'>
                     <div id=product-info-thumbnail>
                         <a id=resultInfo-thumbnail href='details.php?upc=$item_upc'>$item_brand, $item_name</a>
                     </div>
                 </div>
                 <div id=adjust>
                     <div id=deleteForm>
                         <form id=delete method='POST' action='includes/action.php?dupc=".$item_upc."'>
                             <input type=hidden id=dupc name=dupc value=".$item_upc.">
                             <button class=pantryListDelete uid=".$uid." qty=".$item_qty." id=".$item_upc." type='submit' value=".$item_upc.">&times;</button>
                         </form>
                     </div>
                     <form id=adjustDownForm method='POST' action='includes/action.php'>
                         <input type=hidden id=item_to_adjust_down name=item_to_adjust_down value=".$item_upc.">
                         <input type=hidden id=quantityd name=quantityd value=".$item_qty.">
                         <input type=hidden id=date name=date-d value=".$date.">
                         <button class=pantryAdjustDownBtn date=".$date." uid=".$uid." qty=".$item_qty." id=".$item_upc." type='submit' name=pantryAdjustDownBtn>-</button>
                     </form>
                     <center>
                         <h5 id=resultQty-thumbnail>".ceil($qty_remaining + $modifier)."</h5>
                     </center>
                     <form id=adjustUpForm method='POST' action='includes/action.php'>
                         <input type=hidden id=item_to_adjust_up name=item_to_adjust_up value=".$item_upc.">
                         <input type=hidden id=quantityu name=quantityu value=".$item_qty.">
                         <input type=hidden id=date name=date-u value=".$date.">
                         <button class=pantryAdjustUpBtn date=".$date." uid=".$uid." qty=".$item_qty." id=".$item_upc." type='submit' name=adjustUpBtn>+</button>
                     </form>
                 </div>
             </div>
         </div>";
         }
         }
         echo "
     </div>";
     }
     echo "</div>";
///////////////////END OF LIST AREA////////////////////////




         
 } else if ($queryResults < 1) {
    echo "<br>
    <h4 id=listMessege>Your shopping list is empty.</h4>
    <br>" ;
    } else {
    header("Location: ../index.php");
    exit();
     }
    } echo"</div>
     <br>";
     if (isset($_GET['storeId']) && isset($_GET['store'])) {
     $storeId = $_GET['storeId'];
     $store = $_GET['store'];
     echo "<center><a href=shop.php?storeId=$storeId&storeName=".urlencode($store)."><button class=finalize name=listReceived>Shop at ".urldecode($store)." >></button></a></center>";
     }

     ?>
     </div>
                    <!-- area end -->
                    </div>
                </div>
            </div>
            <!-- left content end -->
        </div>
        <!-- row content end -->
    </div>
</div>
<!-- wrapper end -->

<!-- spacer -->
<div class="space-single"></div></div>
<!-- content right end -->

</div>
</div>
</div>
</section>
<!-- section end -->


<!-- ScrolltoTop -->
<div id="totop">
    <span class="ti-angle-up"></span>
</div>
<!-- ScrolltoTop end -->

</div>
<!-- content wraper end -->
<?php include 'includes/footer.php'?>