<!DOCTYPE html>
<html lang="en">

<?php 

include_once 'includes/dbh.inc.php';
include 'includes/header.php'; 

function curPageURL() {
    $pageURL = 'http';
    if(isset($_SERVER["HTTPS"]))
    if ($_SERVER["HTTPS"] == "on") {
        $pageURL .= "s";
    }
    $pageURL .= "://";
    if ($_SERVER["SERVER_PORT"] != "80") {
        $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
    } else {
        $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
    }
    return $pageURL;
}

?>

<!-- spacer -->
<div class="space-single hidden-sm hidden-xs">
</div>
<div class="space-half">
</div>
<!-- spacer end -->

<!-- wrapper -->
<div class="row">
    <!-- <div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1 pull-left"> -->
    <?php 
    if(isMobile()){
        // Do something for only mobile users
        echo '<div class="col-sm-12 col-xs-12 pull-left" style="">';
    }
    else {
        // Do something for only desktop users
        echo '<div class="col-md-11 col-md-offset-1 col-sm-12 col-xs-12 col-xs-offset-1 pull-left" style="">';
    }
    ?>
    
        <?php 

        if(isset($_GET['upc'])) {
            $item_upc = mysqli_real_escape_string($conn, $_GET['upc']);
            echo '<script>window.upc="'.$item_upc.'";</script>';
            if (isset($_SESSION['u_id'])) {
            $uid = mysqli_real_escape_string($conn, $_SESSION['u_id']);
            $permissions_level = mysqli_real_escape_string($conn, $_SESSION['perms']);  
            }
            
            $sql = "SELECT * FROM products LEFT OUTER JOIN product_photos ON products.item_upc = product_photos.upc WHERE products.item_upc=$item_upc LIMIT 1";
            $results = mysqli_query($conn, $sql);
            $queryResults = mysqli_num_rows($results);
            if ($queryResults > 0) {
              $row = mysqli_fetch_array($results);
                //while ($row = mysqli_fetch_array($results)) {
                    $item_upc = $row['item_upc'];
                    $item_name = $row['item_name'];
                    $link = $row['link'];
                    $item_cat = $row['item_cat'];
                    $item_sub_cat = $row['item_subcat'];
                    $link1 = $row['link1'];
                    $link2 = $row['link2'];
                    $link3 = $row['link3'];
                    $link4 = $row['link4'];
                    $link5 = $row['link5'];
                    //echo "<h4 class=searchResults><a href='results.php?catSelect=" . htmlspecialchars($item_cat) . "&subCatSelect=&search='>$item_cat</a> / <a href='results.php?catSelect=" . htmlspecialchars($item_cat) . "&subCatSelect=" . htmlspecialchars($item_sub_cat) . "&search='>$item_sub_cat</a> / $item_name</h4><br><br>";
        ?>
        <ul class="custom-breadcrumb">
            <li class="darkest-crumb"><a href="index.php">Home</a></li>
            <li class="darker-crumb"><a href="<?php echo "results.php?catSelect=" . htmlspecialchars($item_cat) . "&subCatSelect=&search=" ?>"><?php echo $item_cat; ?></a></li>
            <?php if ($item_sub_cat!='') { ?>
            <li class="dark-crumb"><a href="<?php echo "results.php?catSelect=" . htmlspecialchars($item_cat) . "&subCatSelect=" . htmlspecialchars($item_sub_cat) . "&search=" ?>"><?php echo $item_sub_cat; ?></a></li>
            <?php } ?>

            <li class="faded-crumb" aria-current="page"><?php echo $item_name; ?></li>
        </ul>
        <!-- row content -->
        <div class="row">

            <!-- left content -->
            <div class="col-md-9">
                <div class="onStep" data-animation="fadeInUp" data-time="300">

                    <!-- article -->
                    <article style="padding:15px;">
                        <?php 
                    
                            
                        //   echo "<h4 class=searchResults><a href='results.php?catSelect=" . htmlspecialchars($item_cat) . "&subCatSelect=&search='>$item_cat</a> / <a href='results.php?catSelect=" . htmlspecialchars($item_cat) . "&subCatSelect=" . htmlspecialchars($item_sub_cat) . "&search='>$item_sub_cat</a> / $item_name</h4><br><br>";
                          echo "<div class='details-divs'>
                          <center><h1 id='detailsName' name='detailsName'>".$row['item_name']."</center></h1>
                          </div>";

// <!-- Facebook -->
// <a href="http://www.facebook.com/sharer.php?u=http://www.example.com" target="_blank">Share to FaceBook</a>

// <!-- Twitter -->
// <a href="http://twitter.com/share?url=http://www.example.com&text=Simple Share Buttons&hashtags=simplesharebuttons" target="_blank">Twitter</a>

// <!-- Google+ -->
// <a href="https://plus.google.com/share?url=http://www.example.com" target="_blank">Google+</a>

// <!-- Digg -->
// <a href="http://www.digg.com/submit?url=http://www.example.com" target="_blank">Digg</a>

// <!-- Reddit -->
// <a href="http://reddit.com/submit?url=http://www.example.com&title=Simple Share Buttons" target="_blank">Reddit</a>

// <!-- LinkedIn -->
// <a href="http://www.linkedin.com/shareArticle?mini=true&url=http://www.example.com" target="_blank">LinkedIn</a>

// <!-- Pinterest -->
// <a href="javascript:void((function()%7Bvar%20e=document.createElement('script');e.setAttribute('type','text/javascript');e.setAttribute('charset','UTF-8');e.setAttribute('src','http://assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e)%7D)());">Pinterest</a>

// <!-- StumbleUpon-->
// <a href="http://www.stumbleupon.com/submit?url=http://www.example.com&title=Simple Share Buttons" target="_blank">StumbleUpon</a>

// <!-- Email -->
// <a href="mailto:?Subject=Simple Share Buttons&Body=I%20saw%20this%20and%20thought%20of%20you!%20 http://www.example.com">Email</a>

                          echo '
                            <ul class="social">
                                <li class="fb active"><a href="http://www.facebook.com/sharer.php?u='.curPageURL().'" target="_blank" data-toggle="tooltip" data-placement="top" title="Share on Facebook!"><i class="fa fa-facebook-f"></i></a></li>
                                <li class="ld active"><a href="http://www.linkedin.com/shareArticle?mini=true&url='.curPageURL().'" target="_blank" data-toggle="tooltip" data-placement="bottom" title="Share on Linkedin!"><i class="fa fa-linkedin"></i></a></li>
                                <li class="tw active"><a href="http://twitter.com/share?url='.curPageURL().'&text='.$row['item_name'].'&hashtags=groceryhub" target="_blank" data-toggle="tooltip" data-placement="top" title="Share on Twitter!"><i class="fa fa-twitter"></i></a></li>
                            </ul>
                          ';
                          //<li class="yt active"><a href="https://www.instagram.com/logo.chemist/" target="_blank"><i class="fa fa-instagram"></i></a></li>
                          //------------------------------------------------------------------------------------------------
                          echo '
                          <div class="col-md-12">
                            <div id="gallery">
                            <div id="panel">';
                            if ($row['has_image'] == 1) {
                                $filename = "img/".$item_upc."*";
                                $fileinfo = glob($filename);
                                $fileExt = explode(".", $fileinfo[0]);
                                $fileActualExt = $fileExt[1];
                                $file = "img/".$item_upc.".".$fileActualExt;
                                $fileResized = "img/resized_".$item_upc.".".$fileActualExt;
                            echo "<img id='largeImage' class='img-responsive' src=$file alt=$item_name onerror=this.src='img/noimageavailable.png' />";
                                } else {
                            echo "<img id='largeImage' class='img-responsive' src='$link' alt=$item_name onerror=this.src='img/noimageavailable.png' />"; 
                                }
                                //--------------------------------------------------------------------
                                //--------------------------------------------------------------------
                                $select_rating=mysqli_query($conn, "SELECT * FROM rating_reviews WHERE item_upc='".$item_upc."'");
                                $ratingtot=mysqli_num_rows($select_rating);

                                if ($ratingtot == 0) {

                                
                                
                                    echo '
                                    <div class="top-left">';
                                    if (isset($_SESSION['u_id'])) {
                                    echo '<span class="heading" style="margin-top:-15px;"><button class="btn btn-main" data-toggle="modal" data-target="#myModal">Add User Rating</button></span>';
                                    }
                                    echo '<p><span class="badge" style="white-space:nowrap !important;display: inline-block; margin-top:-5px;">0</span> reviews. Be the first to review and rate our product.</p>
                                    </div>
                                    ';
                                } else {

                                    while($row333=mysqli_fetch_array($select_rating))
                                    { 
                                        $phpar[]=$row333['rating']; 
                                    }
                                    $tot_p_rating=(array_sum($phpar)/$ratingtot); //$tot_p_rating

                                    //--------------------------------------------------------------------
                                    //--------------------------------------------------------------------
                                    $newstar = round($tot_p_rating);

                                    echo '
                                    <div class="top-left">';
                                    if (isset($_SESSION['u_id'])) {
                                        echo '<span class="heading" style="margin-top:-15px;"><button class="btn btn-main" data-toggle="modal" data-target="#myModal">Add User Rating</button></span>';
                                        }
                                        
                                    
                                
                                if ($newstar == 1) {
                                    echo '
                                    <span class="fa fa-star checked" style="white-space:nowrap !important;display: inline-block; margin-top:-20px;"></span>
                                    <span class="fa fa-star " style="white-space:nowrap !important;display: inline-block;"></span>
                                    <span class="fa fa-star " style="white-space:nowrap !important;display: inline-block;"></span>
                                    <span class="fa fa-star " style="white-space:nowrap !important;display: inline-block;"></span>
                                    <span class="fa fa-star" style="white-space:nowrap !important;display: inline-block;"></span>
                                    ';
                                }
                                if ($newstar == 2) {
                                    echo '
                                    <span class="fa fa-star checked" style="white-space:nowrap !important;display: inline-block; margin-top:-20px;"></span>
                                    <span class="fa fa-star checked" style="white-space:nowrap !important;display: inline-block;"></span>
                                    <span class="fa fa-star " style="white-space:nowrap !important;display: inline-block;"></span>
                                    <span class="fa fa-star " style="white-space:nowrap !important;display: inline-block;"></span>
                                    <span class="fa fa-star" style="white-space:nowrap !important;display: inline-block;"></span>
                                    ';
                                }
                                if ($newstar == 3) {
                                    echo '
                                    <span class="fa fa-star checked" style="white-space:nowrap !important;display: inline-block; margin-top:-20px;"></span>
                                    <span class="fa fa-star checked" style="white-space:nowrap !important;display: inline-block;"></span>
                                    <span class="fa fa-star checked" style="white-space:nowrap !important;display: inline-block;"></span>
                                    <span class="fa fa-star " style="white-space:nowrap !important;display: inline-block;"></span>
                                    <span class="fa fa-star" style="white-space:nowrap !important;display: inline-block;"></span>
                                    ';
                                }
                                if ($newstar == 4) {
                                    echo '
                                    <span class="fa fa-star checked" style="white-space:nowrap !important;display: inline-block; margin-top:-20px;"></span>
                                    <span class="fa fa-star checked" style="white-space:nowrap !important;display: inline-block;"></span>
                                    <span class="fa fa-star checked" style="white-space:nowrap !important;display: inline-block;"></span>
                                    <span class="fa fa-star checked" style="white-space:nowrap !important;display: inline-block;"></span>
                                    <span class="fa fa-star" style="white-space:nowrap !important;display: inline-block;"></span>
                                    ';
                                }
                                if ($newstar == 5) {
                                    echo '
                                    <span class="fa fa-star checked" style="white-space:nowrap !important;display: inline-block; margin-top:-20px;"></span>
                                    <span class="fa fa-star checked" style="white-space:nowrap !important;display: inline-block;"></span>
                                    <span class="fa fa-star checked" style="white-space:nowrap !important;display: inline-block;"></span>
                                    <span class="fa fa-star checked" style="white-space:nowrap !important;display: inline-block;"></span>
                                    <span class="fa fa-star checked" style="white-space:nowrap !important;display: inline-block;"></span>
                                    ';
                                }
                            

                            echo '<p><span class="badge" style="white-space:nowrap !important;display: inline-block; margin-top:-5px;">'.round($tot_p_rating,2).'</span> average based on '.$ratingtot.' reviews.</p>

                                  </div>';
                                }

                            
                            
                            // -- Rating App -------------------------------
                            echo '
                            <div id="myModal" class="modal" role="dialog">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                        <div class="modal-header-success">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h5 class="modal-title">Give Your Rating with Review!</h5>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="">
                                                <div class="form-group">
                                                <label for="rating">Rate It!</label>
                                                <div class="divRating">
                                                    <input type="hidden" id="php1_hidden" value="1">
                                                    <img src="img/star1.png" onmouseover="change(this.id);" id="php1" class="php">
                                                    <input type="hidden" id="php2_hidden" value="2">
                                                    <img src="img/star1.png" onmouseover="change(this.id);" id="php2" class="php">
                                                    <input type="hidden" id="php3_hidden" value="3">
                                                    <img src="img/star1.png" onmouseover="change(this.id);" id="php3" class="php">
                                                    <input type="hidden" id="php4_hidden" value="4">
                                                    <img src="img/star1.png" onmouseover="change(this.id);" id="php4" class="php">
                                                    <input type="hidden" id="php5_hidden" value="5">
                                                    <img  src="img/star1.png" onmouseover="change(this.id);" id="php5" class="php">
                                                </div>
                                                </div>
                                                <div class="form-group">
                                                <label for="pwd">Your Review About Product:</label>
                                                <textarea class="form-control" id="review" name="review" rows="3" maxlength="100"></textarea>
                                                <div style="font-size:9px;">Max <span id="txtleft" style="font-size:11px; color:red; margin:0px; padding:0px;white-space: nowrap !important;display: inline-block;">150</span> Characters Limit. </div>
                                                <input type="hidden" name="phprating" id="phprating" value="">
                                                <input type="hidden" name="upc" id="upc" value="'.$item_upc.'">
                                                <input type="hidden" name="uid" id="uid" value="'.$_SESSION['u_id'].'">
                                                </div>
                                                <button type="submit" class="btn btn-success" id="submitRating">Submit</button>
                                                <div id="ratresult" class="alert alert-success pull-right" style="padding:3px; margin:3px; font-size:10px; display:none;"></div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                            // ---------------------------------------------
                            //echo '<div class="top-right">';
                            
                            
                           // echo '</div>';
                        //    <!-- <img class="img-responsive" id="largeImage" src="http://placekitten.com/400/252" /> -->
                        //         <!-- <div id="description">First image description</div> -->

                            echo '
                            </div>';
                            if (isset($_SESSION['u_id'])) {
                                if ($permissions_level > 6) {
                            echo '<div id="thumbs">
                                         
                                    <img src='.$link1.' alt='.$item_name.' onerror=this.src="img/noimageavailable.png" />
                                    <img src='.$link2.' alt='.$item_name.' onerror=this.src="img/noimageavailable.png" />
                                    <img src='.$link3.' alt='.$item_name.' onerror=this.src="img/noimageavailable.png" />
                                    <img src='.$link4.' alt='.$item_name.' onerror=this.src="img/noimageavailable.png" />
                                    <img src='.$link5.' alt='.$item_name.' onerror=this.src="img/noimageavailable.png" />
                                  </div>';
                                }
                            }
                            echo '</div>
                            </div>
                            <!-- spacer -->
                            <div class="space-half"></div>
                            <!-- spacer end -->
                            ';
                            //---------------------Product Gallery Finished-------------------------------------------
                            
                            
                            if (isset($_SESSION['u_id'])) {
                                echo"
                            <form method='POST' action='includes/action.php' style='margin-left:-20px;'>
                            <input type=hidden id=$item_upc name=pid class=pid value=$item_upc>
                            <input type=hidden id=qty name=qty value=1>";
                            
                            $sql3 = "SELECT item_upc, item_quantity FROM grocery_lists WHERE item_upc = $item_upc AND user_id = ".$_SESSION['u_id']." LIMIT 1";
                            $results3 = mysqli_query($conn, $sql3);
                            $queryResult3 = mysqli_num_rows($results3);
                            if ($queryResult3 > 0) {
                                $row3 = mysqli_fetch_array($results3);
                                $quantity = $row3['item_quantity'];
                                echo "<button class='addButton btn btn-rounded btn-main' uid='".$uid."' id='".$item_upc."' type='submit' style='width:98%; margin-top:30px; height:45px;margin-left: 15px;'>Add To List <small>($quantity in list)</small></button>";
                            } else {
                            echo"<button class='addButton btn btn-rounded btn-main' uid=".$uid." id=".$item_upc." type='submit' style='width:98%; margin-left: 15px;'>Add To List</button>";
                            }
                           echo "</form>";
                            }    
                            //-----------------------add to list button end --------------------------------------             
					    echo '
                        <!-- spacer <div class="space-single hidden-sm hidden-xs"></div> -->
                        
                        <!-- spacer end -->
                        <div class="row">
                            <div class="col-md-12">
                            <ul class="nav nav-tabs panel-success">
                            <li class="active"><a href="#a" data-toggle="tab">Product Details</a></li>
                            <li><a href="#b" data-toggle="tab">Ingredients</a></li>
                            <li><a href="#c" data-toggle="tab">Nutrition Facts</a></li>
                            <li><a href="#d" data-toggle="tab">Reviews</a></li>
                         </ul>
                         
                         <div class="tab-content">
                            <div class="tab-pane fade in active" id="a">';
                            echo "<table style='width:100%; padding: 0 2em 1em 0; background-color:#fff;'>";
                        
                            echo"
                            <tr><td style='padding: 10px; width:150px !important;background-color:#333;color:#fff;'>Brand </td>
                            <td style='font-size:16px; padding: 10px; background-color:#adadad;color:#333;'>".$row['item_brand']."</td>
                            </tr>
                            <tr><td style='padding: 10px; width:150px !important;background-color:#333;color:#fff;'>Category </td>
                            <td style='font-size:16px; padding: 10px; background-color:#adadad;color:#333;'>".$row['item_cat']."</td>
                            </tr>
                            <tr><td style='padding: 10px; width:150px !important;background-color:#333;color:#fff;'>Sub-Category </td>
                            <td style='font-size:16px; padding: 10px; background-color:#adadad;color:#333;'>".$row['item_subcat']."</td>
                            </tr>
                            <tr><td style='padding: 10px; width:150px !important;background-color:#333;color:#fff;'>UPC </td>
                            <td style='font-size:16px; padding: 10px; background-color:#adadad;color:#333;'>".$item_upc."</td>
                            </tr>
                            </table>
                            <hr>
                            "; 
                            if (isset($_SESSION['u_id'])) {
                                $sql4 = "SELECT * FROM product_prices WHERE item_upc = $item_upc ORDER BY company_price ASC";
                                $results4 = mysqli_query($conn, $sql4);
                                $queryResults4 = mysqli_num_rows($results4);
                                if ($queryResults4 > 0) {
                                echo"<h5 style='text-transform: uppercase;'>Prices For This Item</h5><br><br>
                                <div id=storePriceContainer>
                                <tr>
                                <td>";
    
                                while ($row4 = mysqli_fetch_array($results4)) {
                                $state = $row4['state'];
                                $storeId2 = $row4['store_name_id'];
                                $filename2 = "img/store_icon/".$storeId2."*";
                                $fileinfo2 = glob($filename2);
                                $fileExt2 = explode(".", $fileinfo2[0]);
                                $fileActualExt2 = $fileExt2[1];
                                $file2 = "img/store_icon/".$storeId2.".".$fileActualExt2;
                                if ($state == $_SESSION['state']) {
                            echo "
                                <div class=storePrice-divs>
                                <div class=storeLogoDiv>
                                <img class=compare-photo src=$file2 alt=$item_name onerror=this.src='img/noimageavailable.png'>
                                </div>
                                <br>
                                <p class=companyPrice>$".$row4['company_price']."/".$row4['measurement']."</p>
                                </div>";
                                    }
                                }
                                echo"
                                <hr>
                                </td>
                                </tr>
                                </div>";
                                }
                                }
                        echo '<hr>';
                        
                        if (isset($_SESSION['u_id'])) {
                            $sql5 = "SELECT * FROM products LEFT OUTER JOIN product_prices ON products.item_upc = product_prices.item_upc WHERE item_subcat = '$item_sub_cat' AND products.item_upc != '$item_upc' AND item_subcat != '' AND store_name_id NOT IN (SELECT store_name_id FROM product_prices WHERE item_upc = '$item_upc') ORDER BY company_price ASC LIMIT 8";
                            $results5 = mysqli_query($conn, $sql5);
                            $queryResults5 = mysqli_num_rows($results5);
                            if ($queryResults5 > 0) {
                            echo"
                            <tr>
                            <td>
                            <div class=details-divs>
                            <h5 style='text-transform: uppercase;'>Closest Match From These Other Stores</h5><br><br>";

                            while ($row5 = mysqli_fetch_array($results5)) {
                            $state = $row5['state'];
                            $upc = $row5['item_upc'];
                            $storeId = $row5['store_name_id'];
                            
                            $sql6 = "SELECT * FROM products LEFT OUTER JOIN product_photos ON products.item_upc = product_photos.upc WHERE item_upc = '$upc'";
                            $results6 = mysqli_query($conn, $sql6);
                            $queryResults6 = mysqli_num_rows($results6);
                            if ($queryResults6 > 0) {
                            while ($row6 = mysqli_fetch_array($results6)) {
                                $link2 = $row6['link'];
                                $item_name2 = $row6['item_name'];
                            if ($state == $_SESSION['state']) {
                            if ($row6['has_image'] == 1) {
                                $filename3 = "img/".$upc."*";
                                $fileinfo3 = glob($filename3);
                                $fileExt3 = explode(".", $fileinfo3[0]);
                                $fileActualExt3 = $fileExt3[1];
                                $fileResized3 = "img/resized_".$upc.".".$fileActualExt3;
                        echo "<div class=storePrice-divs>
                            <div style='virtical-align:middle;'>
                            <a href=details.php?upc=".$upc.">
                            <div class=storeLogoDiv>
                            <img id=resultPhoto src=$fileResized3 alt=$item_name onerror=this.src='img/noimageavailable.png'>
                            </div>
                            </a>
                            </div>";
                            } else {
                        echo "<div class=storePrice-divs>
                            <div style='virtical-align:middle;'>
                            <a href=details.php?upc=".$upc.">
                            <div class=storeLogoDiv>
                            <img id=resultPhoto src='$link2' alt=$item_name onerror=this.src='img/noimageavailable.png'>
                            </div>
                            </a>
                            </div>";
                            }
                            echo "<p>$item_name2</p>
                            <br>
                            <p><b>".$row5['store_name']."</b></p>
                            <p>$".$row5['company_price']."/".$row5['measurement']."</p>
                            </div>"; 
                            }
                            }
                            }
                            }
                            echo"
                            <hr>
                            </td>
                            </tr>
                            </div>";
                            } else {
                                echo "
                                <div class=details-divs>
                                    <h5 style='text-transform: uppercase;'>Closest Match From These Other Stores</h5>
                                    <p>Unfortunately! There's No Product Matched Yet!</p>
                                </div>
                                ";
                            }
                            }
                        echo '<hr>';
                            //Contribute Price
                            if (isset($_SESSION['u_id'])) {
                                echo "<table style='width:100%; padding: 0 2em 1em 0; background-color:#fff;'>
                                <tr>
                                <td>
                                <div class='details-divs'>
                                <h5 style='text-transform: uppercase;'>Contribute Price</h5><br>
                                <form method='GET' action='includes/action.php'>
                                <input type=text class='detailsInput' id='storeName' name='storeName' placeholder='Store Name'>
                                <div class='searchList'></div>
                                <input type=hidden class='detailsInput' id='storeState' name='storeState' value=".$_SESSION['state'].">
                                <input type=number pattern=[0-9]* min=0.00 max=100.00 step=0.01 class='detailsInput' id='priceEntry' name='priceEntry' placeholder='Enter Price' oninput=this.value=parseInt(this.value.replace('.',''))/100>
                                <input type=hidden id='itemUPC' name='itemUPC' value=$item_upc>
                                <input type=hidden id='itemName' name='itemName' value='$item_name'>
                                <select class='detailsInput' id='measureSelct' name='measureSelect'>
                                    <option name='EA' value=ea>ea</option>
                                    <option name='LB' value=lb>lb</option>
                                </select>
                                <br>
                                <br>
                                <button name='priceSubmit' id='priceSubmit' type='submit'>Submit Price</button>
                                </form>
                                <br>
                                </div>
                                </td>
                                </tr></table>";
                                }
                            
                        echo '</div>
                            
                            <div class="tab-pane fade" id="b">';

                            $sql3 = "SELECT ingredients FROM item_ingredients WHERE item_upc=$item_upc LIMIT 1";
                            $results3 = mysqli_query($conn, $sql3);
                            $queryResults3 = mysqli_num_rows($results3);
                            if ($queryResults3 > 0) {
                            while ($row3 = mysqli_fetch_array($results3)) {
                        echo "<P>".strtoupper($row3['ingredients'])."</P>";
                                }
                            } else {
                          echo "<p>No ingredients currently available for this item.</p>";      
                            }
                            
                      echo '</div>
                            <div class="tab-pane fade" id="c">
                                <p>No Nutrition Facts currently available for this item.</p>
                            </div>
                            <div class="tab-pane fade" id="d">
                                
                                <!-- responsive nowrap table -->
                                <table class="datatable-init responsive nowrap table" id="rating_table" name="rating_table" style="width:100%;">
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
                         </div>
                            </div>
                        </div>';

                          
                            // if (isset($_SESSION['u_id'])) {
                            //     echo"<div class=details-divs>
                            // <form method='POST' action='includes/action.php'>
                            // <input type=hidden id=$item_upc name=pid class=pid value=$item_upc>
                            // <input type=hidden id=qty name=qty value=1>";
                            
                            // $sql3 = "SELECT item_upc, item_quantity FROM grocery_lists WHERE item_upc = $item_upc AND user_id = ".$_SESSION['u_id']." LIMIT 1";
                            // $results3 = mysqli_query($conn, $sql3);
                            // $queryResult3 = mysqli_num_rows($results3);
                            // if ($queryResult3 > 0) {
                            // $row3 = mysqli_fetch_array($results3);
                            //     $quantity = $row3['item_quantity'];
                            //     echo "<button class='addButton btn btn-rounded btn-main' uid=".$uid." id=".$item_upc." type=submit><p class=buttonText>Add To List ($quantity in list)</p></button>";
                            // } else {
                            // echo"<button class='addButton btn btn-rounded btn-main' uid=".$uid." id=".$item_upc." type=submit style='width:100%; '><p class=buttonText>Add To List</p></button>";
                            // }
                           // echo "</form>";
                            //}
                           // echo"</div>
                           // </td>
                           // </tr>";

                            //echo "</table>";
                        
                      }
                    }
                   ?>
                        <!-- <div class="post-image">
                            <img class="img-responsive" src="img/blog/img1.jpg" alt="blog-img" />
                            <div class="post-heading">
                                <h3><a href="#">link may comes here...</a></h3>
                            </div>
                        </div>
                        <p>detailed text....
                        </p>
                        <div class="bottom-article">
                            <ul class="meta-post">
                                <li><a href="#">Jan 12, 2017</a>
                                </li>
                            </ul>
                        </div> -->
                    </article>
                    <!-- article end -->



                </div>
            </div>
            <!-- left content end -->

            <!-- right content -->
            <div class="col-md-3 col-sm-10 col-xs-11 pull-right">
                <aside class="onStep" data-animation="fadeInUp" data-time="600">

                    <!-- widget -->
                    <div class="widget">
                        <h5>
                            List Quick View
                        </h5>
                        <form method='POST' action='my_list.php'>
                            <button class='finalize btn btn-rounded btn-yellow' style="margin-left:0px; width:90% !important;">Review - My List</button>
                        </form>

                        <!-- <div class="space-single devider-widget">
                        </div> -->

                        <div id="myList" class="recent">
                            

                            <?php 
                  
                  if (isset($_SESSION['u_id'])) {
                    $uid = $_SESSION['u_id'];
                    echo "<div class=list>";
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
                            if ($row6 = mysqli_fetch_assoc($result6)) {
                                $link22 = $row6['link'];
                            } else {
                                $link22 = '';
                            }
                            
                            echo "<div class='product-container-thumbnail'>
                                    <div id=product-photo-thumbnail>
                                        <a href=details.php?upc=".$item_upc.">";
                                        if ($row['has_image'] == 1) {
                                        $filename = "img/".$item_upc."*";
                                        $fileinfo = glob($filename);
                                        $fileExt = explode(".", $fileinfo[0]);
                                        $fileActualExt = $fileExt[1];
                                        $file = "img/resized".$item_upc.".".$fileActualExt;
                                        
                                        echo "<img id='resultPhoto-thumbnail' src=$file alt=$item_name onerror=this.src='img/noimageavailable.png'>";
                                        } else {
                                        echo "<img id='resultPhoto-thumbnail' src='$link22' alt=$item_name onerror=this.src='img/noimageavailable.png'>"; 
                                        }
                                        echo "</a>
                                        </div>
                                        <div id='listInfo' type='submit' name='item-details'>
                                            <div id=product-info-thumbnail>
                                                <a id=resultInfo-thumbnail href='details.php?upc=$item_upc'>".$row['item_name']."</a>   
                                            </div>
                                        </div>
                                        
                                        <div id=adjust>";
                                        //<div class='controlsBox'>
                                    if ($item_qty <= 1) {
                                            echo "
                                            <div id='deleteForm'>
                                            <form id='delete' method='POST' action='includes/action.php?dupc=".$item_upc."'>
                                                <input type='hidden' id='dupc' name='dupc' value=".$item_upc.">
                                                <button class='listDelete' uid=".$uid." qty=".$item_qty." id=".$item_upc." type='submit' value=".$item_upc." style='margin-top:20px;'>&times;</button>
                                            </form>
                                            </div>";
                                            } else {
                                              echo "
                                            <form id=adjustDownForm method='POST' action='includes/action.php'>
                                                <input type='hidden' id='item_to_adjust_d' name='item_to_adjust_d' value=".$item_upc.">
                                                <input type='hidden' id='quantityd' name='quantityd' value=".$item_qty.">
                                                <button class='adjustDownBtn' uid=".$uid." qty=".$item_qty." id=".$item_upc." type='submit' name='adjustDownBtn'>-</button>
                                            </form>";  
                                            }
                                            echo"<h5 id=resultQty-thumbnail>".$row['item_quantity']."</h5>
                                            <form id=adjustUpForm method='POST' action='includes/action.php'>
                                                <input type='hidden' id='item_to_adjust_u' name='item_to_adjust_u' value=".$item_upc.">
                                                <input type='hidden' id='quantityu' name='quantityu' value=".$item_qty.">
                                                <button class='adjustUpBtn' uid=".$uid." qty=".$item_qty." id=".$item_upc." type='submit' name='adjustUpBtn'>+</button>
                                            </form>
                                        </div>
                                    </div> 
                                ";
                            }  
                            // </div> 
                        
                    } else {
                        echo "<br>
                            <h4 id=listMessege>Items in your grocery list will appear here. Start adding some items to your list!</h4>
                            <br>";
                    }
                        echo "</div>";
                  }
                  
                  ?>


                        </div>
                    </div>
                    <!-- widget end -->




                </aside>
            </div>
            <!-- right content end -->

        </div>
        <!-- row content end -->
    </div>
</div>
<!-- wrapper end -->
<script type="text/javascript">



      function change(id)  {
    //console.log("hover");
     var cname=document.getElementById(id).className;
     var ab=document.getElementById(id+"_hidden").value;
     //console.log(cname +' | '+ ab);
     //document.getElementById(cname+"rating").innerHTML=ab;
     document.getElementById("phprating").value = ab;
     
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
</script>
<!-- spacer -->
<div class="space-single">
</div>

</div>
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
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap.min.css">
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap.min.js"></script>

<script>
    $(document).ready(function () {
        console.log(window.upc);
    $('#rating_table').DataTable({
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
        { "width": "5%" },
        { "width": "60%" }
    ]
    
    });
    $.fn.dataTable.ext.errMode = function (settings, helpPage, message) {
    };
    });
</script>