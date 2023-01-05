<?php
session_start();
include_once 'dbh.inc.php';

define('KB', 1024);
define('MB', 1048576);
define('GB', 1073741824);
define('TB', 1099511627776);
////////////////////Rating & Review Listing As Per Product///////////////////////

//If the add button is clicked then do this code//
if (isset($_GET['review_upc'])) {
    $review_upc = mysqli_real_escape_string($conn, $_GET['review_upc']);  

    $sql = "SELECT a.*, b.user_id, b.user_first FROM rating_reviews AS a, users AS b WHERE a.user_id = b.user_id AND a.item_upc= '$review_upc'";
    $result = mysqli_query($conn, $sql);
    $queryResults = mysqli_num_rows($result);
    //$row = mysqli_fetch_array($result);
    $temp1 = "";
    $numrow = 0;
    if ($queryResults > 0) {
    
        $temp1 .= '{ "data": [';
        while ($row = mysqli_fetch_array($result)) {
            $numrow = $numrow +1;
//                $temp_1 .=
            //$temp_array[] = $row;
            $temp1 .= "\n[";
            $mdate=date_create($row['datetime']);
            $temp1 .= '"'.date_format($mdate,"Y/m/d").'",';
            //$temp1 .= '"<button title=\'View Profile\' id=\'view_\' class=\'btn btn-secondary btn-lg\'>'.$row['fname'].' '.$row['lname'].' - Profile</button>  <button title=\'Print Profile\' id=\'print_\' class=\'btn btn-primary btn-lg\'><em class=\'icon ni ni-printer\'></em></button>",';             
            $temp1 .= '"'.$row['user_first'].'",';
            //----------------------------------------------------
            if ($row['rating'] == 1) {
                $temp1 .= '"★☆☆☆☆",';
                
            }
            if ($row['rating'] == 2) {
                $temp1 .= '"★★☆☆☆",';
                
            }
            if ($row['rating'] == 3) {
                $temp1 .= '"★★★☆☆",';
                
            }
            if ($row['rating'] == 4) {
                $temp1 .= '"★★★★☆",';
                
            }
            if ($row['rating'] == 5) {
                $temp1 .= '"★★★★★",';
                
            }

            
            
            
            $temp1 .= '"'.$row['review'].'"';


            $temp1 .= "]";
            
            if ($queryResults==$numrow){
                $temp1 .= "";
            } else {
                $temp1 .= ",\n";
            }
            
        }
        $temp1 .= ']}';
        header('Content-Type: application/json');
        echo $temp1;
    
    exit();
    } else {
        $temp1 .= '{ "data": [] }';
        //header("Location: ../results.php"); 
        header('Content-Type: application/json');
        echo $temp1;
        exit(); 
    } }

////////////////////Reipe Editor///////////////////////
//If the add button is clicked then do this code//
if (isset($_GET['recipe_list'])) {

    //$recipe_list = (int) $_GET['recipe_list'];  
    $recipe_list = $_GET['recipe_list'];
    if ( $recipe_list == '0' ) {
        //echo "Zero: ".$recipe_list;
        $sql = "SELECT * FROM recipes";
        //exit(); 
    } else {
        //echo "NoZero: ".$recipe_list;
        $sql = "SELECT * FROM recipes WHERE rcate = '".$recipe_list."'";
        //exit(); 
    }
     
    $result = mysqli_query($conn, $sql);
    $queryResults = mysqli_num_rows($result);
    //$row = mysqli_fetch_array($result);
    $temp1 = "";
    $numrow = 0;
    if ($queryResults > 0) {
    
        $temp1 .= '{ "data": [';
        while ($row = mysqli_fetch_array($result)) {
            $numrow = $numrow +1;
//                $temp_1 .=
            //$temp_array[] = $row;
            $temp1 .= "\n[";
            
            if ($row['haspic'] != "") {
                $filee = "img/recipes/".$row['haspic'];
            } else {
                $filee = "img/noimageavailable.png";
            }
                $finalimg = "<img style='max-width:150px;' src='".$filee."' alt='".$row['recipe_name']."' >";
            $temp1 .= '"'.$finalimg.'",';
            
            $temp1 .= '"'.$row['recipe_name'].'",';
            $temp1 .= '"'.$row['rcate'].'",';
            $mdate=date_create($row['datetime']);
            $temp1 .= '"'.date_format($mdate,"Y/m/d").'",';

            $sqlreview = "SELECT AVG(rating) AS avg_stars, COUNT(id) AS totrating FROM rating_reviews WHERE isrecipe='1' AND item_upc= '".$row['recipe_id']."' LIMIT 1";
            $resultreview = mysqli_query($conn, $sqlreview);
            $queryResultsreview = mysqli_num_rows($resultreview);
            if ($queryResultsreview > 0) {
                $rowreview = mysqli_fetch_array($resultreview);
                $avg_stars = round($rowreview['avg_stars'], 0);
                $totrating = $rowreview['totrating'];
                //echo '<h1>'.$avg_stars.'</h1>';
                //----------------------------------------------------⯨
                if ($avg_stars == 1) {
                    $temp1 .= '"<span style=\'font-size:22px;margin-top:0px;\'>★☆☆☆☆</span> ('.$totrating.' Reviews)",';
                }
                if ($avg_stars == 2) {
                    $temp1 .= '"<span style=\'font-size:22px;margin-top:0px;\'>★★☆☆☆</span> ('.$totrating.' Reviews)",';
                }
                if ($avg_stars == 3) {
                    $temp1 .= '"<span style=\'font-size:22px;margin-top:0px;\'>★★★☆☆</span> ('.$totrating.' Reviews)",';
                }
                if ($avg_stars == 4) {
                    $temp1 .= '"<span style=\'font-size:22px;margin-top:0px;\'>★★★★☆</span> ('.$totrating.' Reviews)",';
                }
                if ($avg_stars == 5) {
                    $temp1 .= '"<span style=\'font-size:22px;margin-top:0px;\'>★★★★★</span> ('.$totrating.' Reviews)",';
                }
                if ($avg_stars < 1 || $avg_stars > 5 ) {
                    $temp1 .= '"No Reviews Yet!",';
                }
            } else {
                $temp1 .= '"No Reviews Yet!",';
            }

            $temp1 .= '"<a href=\'recipe_edit.php?rid='.$row['recipe_id'].'\' title=\'Edit Recipe\' id=\'view_\' class=\'btn btn-success \' style=\'color:white;margin:10px;\'>Update Recipe</a>&nbsp;&nbsp;<a href=\'#\' title=\'Edit Recipe\' id=\'delRecipe\' data-rname=\''.$row["recipe_name"].'\' data-rid=\''.$row["recipe_id"].'\' class=\'btn btn-danger \' style=\'color:white;margin:10px;\'>Delete Recipe</a>"';   //the last row          

           


            $temp1 .= "]";
            
            if ($queryResults==$numrow){
                $temp1 .= "";
            } else {
                $temp1 .= ",\n";
            }
            
        }
        $temp1 .= ']}';
        header('Content-Type: application/json');
        echo $temp1;
    
    exit();
    } else {
        $temp1 .= '{ "data": [] }';
        //header("Location: ../results.php"); 
        header('Content-Type: application/json');
        echo $temp1;
        exit(); 
    }    
    
        
     
}

////////////////////User's Managementr///////////////////////
//If the add button is clicked then do this code//
if (isset($_GET['users_list'])) {

    
        //echo "NoZero: ".$recipe_list;
        $sql = "SELECT * FROM users" ;
    
    $result = mysqli_query($conn, $sql);
    $queryResults = mysqli_num_rows($result);
    //$row = mysqli_fetch_array($result);
    $temp1 = "";
    $numrow = 0;
    if ($queryResults > 0) {
    
        $temp1 .= '{ "data": [';
        while ($row = mysqli_fetch_array($result)) {
            $numrow = $numrow +1;
//                $temp_1 .=
            //$temp_array[] = $row;
            $temp1 .= "\n[";
            
            if ($row['verified'] != 0) {
                $verified = 'Verified!';
            } else {
                $verified = 'Not Verified!';
            }     
            
            //$temp1 .= '"'.$finalimg.'",';
            //Name, Email, State/City, PermissionLevel, Verified, CreatedOn
            $temp1 .= '"'.$row['user_first'].' '.$row['user_last'].'",';
            $temp1 .= '"'.$row['user_email'].'",';
            $temp1 .= '"'.$row['user_city'].' / '.$row['user_state'].'",';
            
            if ( $row['permissions_level'] == 9 ) {
                $temp1 .= '"Administrator",';
            } else {
                $temp1 .= '"Standard Web User",';
            }
            
            $temp1 .= '"'.$verified.'",';

            $mdate=date_create($row['creation_date']);
            $temp1 .= '"'.date_format($mdate,"Y/m/d").'",';

            //onclick=""

            $temp1 .= '"<a href=# onclick=editUser('.$row['user_id'].'); title=\'Edit User\' id=\'view_\' class=\'btn btn-success btn-sm\' style=color:white;>Update</a> || <a href=# onclick=deleteUser('.$row['user_id'].'); title=\'Delete User\' id=\'del_\' class=\'btn btn-danger btn-sm\' style=color:white;>Delete</a>"';   //the last row          

           


            $temp1 .= "]";
            
            if ($queryResults==$numrow){
                $temp1 .= "";
            } else {
                $temp1 .= ",\n";
            }
            
        }
        $temp1 .= ']}';
        header('Content-Type: application/json');
        echo $temp1;
    
    exit();
    } else {
        $temp1 .= '{ "data": [] }';
        //header("Location: ../results.php"); 
        header('Content-Type: application/json');
        echo $temp1;
        exit(); 
    }    
    
        
     
}
//---------------------Delete Recipe----------------------------
//If the add button is clicked then do this code//
if (isset($_POST['delRecipeNow'])) {

    
    $rid = mysqli_real_escape_string($conn, $_POST['delRecipeNow']);
    $rid = intval($rid); 
    //recipe_directions[recipe_id], recipe_ingredients[recipe_id]
    $sql1 = "DELETE FROM recipes WHERE `recipe_id` = $rid ";
    mysqli_query($conn, $sql1);
    $sql2 = "DELETE FROM recipe_directions WHERE `recipe_id` = $rid ";
    mysqli_query($conn, $sql2);
    $sql3 = "DELETE FROM recipe_ingredients WHERE `recipe_id` = $rid ";
    mysqli_query($conn, $sql3); 
        //header("Location: ../recipe_details.php?rid=".$rid); 
    echo '110';
    exit(); 
     
}
////////////////////ADD TO Follow / UnFollow///////////////////////

//If the add button is clicked then do this code//
if (isset($_POST['unfollowDEL'])) {

    
    $unfollowDEL = mysqli_real_escape_string($conn, $_POST['unfollowDEL']);
    $unfollowDEL = intval($unfollowDEL); 
    
    $sql = "DELETE FROM users_follow WHERE `id` = $unfollowDEL ";
  
        mysqli_query($conn, $sql); 
        //header("Location: ../recipe_details.php?rid=".$rid); 
        echo '110';
        exit(); 
     
}

//If the add button is clicked then do this code//
if (isset($_POST['follower'])) {


    $action = mysqli_real_escape_string($conn, $_POST['action']);
    $follower = mysqli_real_escape_string($conn, $_POST['follower']);
    $follower = intval($follower);
    $following = mysqli_real_escape_string($conn, $_POST['following']);
    $following = intval($following);
    $rid = mysqli_real_escape_string($conn, $_POST['rid']);
    $rid = intval($rid);

    if ($_POST['action'] == "Unfollow") {
        $sql = "INSERT INTO users_follow (`follower`, `following`) VALUES ({$follower}, {$following})";
    } else {
        $sql = "DELETE FROM users_follow WHERE `follower` = $follower AND `following` = $following";
    }
  
        mysqli_query($conn, $sql); 
        header("Location: ../recipe_details.php?rid=".$rid); 
        //echo 'true';
        exit(); 
     
}

////////////////////ADD TO Rating & Review///////////////////////

//If the add button is clicked then do this code//
if (isset($_POST['review'])) {
    $iupc = mysqli_real_escape_string($conn, $_POST['upc']);
    $review = mysqli_real_escape_string($conn, $_POST['review']);
    $uid = mysqli_real_escape_string($conn, $_POST['uid']);
    $prorating = mysqli_real_escape_string($conn, $_POST['prorating']);
    $prorating = intval($prorating);

    if (isset( $_POST['isrecipe'] )) {
        $sql = "SELECT * FROM rating_reviews WHERE isrecipe=1 AND user_id = '$uid' AND item_upc = '$iupc'";
    } else {
        $sql = "SELECT * FROM rating_reviews WHERE user_id = '$uid' AND item_upc = '$iupc'";
    }
    

    $result = mysqli_query($conn, $sql);
    $queryResults = mysqli_num_rows($result);
    $row = mysqli_fetch_array($result);
    if ($queryResults > 0) {
    //Update the quantity in the database if the item already is in the database//
    //$sql3 = "UPDATE grocery_lists SET item_quantity = (item_quantity + '1') WHERE user_id = '$uid' AND item_upc = '$iupc'";
    //mysqli_query($conn, $sql3);
    echo "you already rated this product!";
    //header("Location: ../results.php");
    exit();
    } else {
        //Insert the item into the database if it does not already exist in the database//
        if (isset( $_POST['isrecipe'] )) {
            $sql2="INSERT INTO rating_reviews (`user_id`, `item_upc`, `review`, `rating`, `isrecipe`) VALUES ('{$uid}', '{$iupc}', '{$review}', {$prorating}, 1)" ;
        } else {            
            $sql2="INSERT INTO rating_reviews (`user_id`, `item_upc`, `review`, `rating`) VALUES ('{$uid}', '{$iupc}', '{$review}', {$prorating})" ;
        }
         
        
        mysqli_query($conn, $sql2); 
        //header("Location: ../results.php"); 
        echo 'true';
        exit(); 
    } 
}

////////////////////ADD TO GROCERY LIST CODE///////////////////////
//Add to List from Recipe Details Page//
if (isset($_POST['rec_rid'])) {
    
    $irid = mysqli_real_escape_string($conn, $_POST['rec_rid']);
    $iuid = mysqli_real_escape_string($conn, $_POST['rec_uid']);
    
    $sql5 = "SELECT * FROM recipe_ingredients WHERE recipe_id = ".$irid;
    $results5 = mysqli_query($conn, $sql5);
    $queryResults5 = mysqli_num_rows($results5);

    if ($queryResults5 > 0) {

        while ($row5 = mysqli_fetch_array($results5)) {
            $preferred_upc = $row5['preferred_upc'];
            $ingredient_qty = $row5['ingredient_qty'] * 1;
            
            $sql = "SELECT * FROM grocery_lists WHERE user_id = '$iuid' AND item_upc = '$preferred_upc'";
            $result = mysqli_query($conn, $sql);
            $queryResults = mysqli_num_rows($result);
            $row = mysqli_fetch_array($result);
            if ($queryResults > 0) {
            //Update the quantity in the database if the item already is in the database//
            $sql3 = "UPDATE grocery_lists SET item_quantity = (item_quantity + '".$ingredient_qty."') WHERE user_id = '$iuid' AND item_upc = '$preferred_upc'";
            mysqli_query($conn, $sql3);
            //echo "true";
            //exit();
            } else if ($queryResults < 1){
                //Insert the item into the database if it does not already exist in the database//
                $sql2="INSERT INTO grocery_lists (user_id, item_upc, item_quantity) VALUES ('{$iuid}', '{$preferred_upc}', '".$ingredient_qty."')" ; 
                mysqli_query($conn, $sql2); 
                //echo "true";
                //exit(); 
            }
        }
        echo "true";
    } else {
        echo "false";
    }

}
    


//If the add button is clicked then do this code//
if (isset($_POST['upc'])) {
$iupc = mysqli_real_escape_string($conn, $_POST['upc']);
$iqty = mysqli_real_escape_string($conn, $_POST['add']);
$uid = mysqli_real_escape_string($conn, $_POST['uid']);
$sql = "SELECT * FROM grocery_lists WHERE user_id = '$uid' AND item_upc = '$iupc'";
$result = mysqli_query($conn, $sql);
$queryResults = mysqli_num_rows($result);
$row = mysqli_fetch_array($result);
if ($queryResults > 0) {
//Update the quantity in the database if the item already is in the database//
$sql3 = "UPDATE grocery_lists SET item_quantity = (item_quantity + '1') WHERE user_id = '$uid' AND item_upc = '$iupc'";
mysqli_query($conn, $sql3);
header("Location: ../results.php");
exit();
} else if ($queryResults < 1){
    //Insert the item into the database if it does not already exist in the database//
    $sql2="INSERT INTO grocery_lists (user_id, item_upc, item_quantity) VALUES ('{$uid}', '{$iupc}', '1')" ; mysqli_query($conn, $sql2); header("Location: ../results.php"); exit(); } }

//////////////////////MY LIST PAGE CODE///////////////////////////

//Delete item if the delete button is clicked//
if (isset($_POST['dupc'])) {
$dupc = mysqli_real_escape_string($conn, $_POST['dupc']);
$uid = mysqli_real_escape_string($conn, $_SESSION['u_id']);
//Delete the item from the database
$sql = "DELETE FROM grocery_lists WHERE user_id = '$uid' AND item_upc = '$dupc'";
mysqli_query($conn, $sql);
//header("Location: ../my_list.php");
header('Location: ' . $_SERVER['HTTP_REFERER']);
//header("Refresh:0");
exit();
}

// Adjust down button is code//
if (isset($_POST['item_to_adjust_d'])) {
$iupc = mysqli_real_escape_string($conn, $_POST['item_to_adjust_d']);
$iqty = mysqli_real_escape_string($conn, $_POST['quantity']);
$uid = mysqli_real_escape_string($conn, $_SESSION['u_id']);
//Delete the item from the database if there was only a quantity of one.
if ($iqty < 2) { $sql="DELETE FROM grocery_lists WHERE user_id='$uid' AND item_upc = '$iupc'" ; mysqli_query($conn, $sql); 
    //header("Location: ../my_list.php?removed-item"); 
    header("location:javascript://history.go(-1)");
    exit(); } else {
    //Adjust the item quantity in the database down by one.
    $sql="UPDATE grocery_lists SET item_quantity = (item_quantity - '1') WHERE user_id='$uid' AND item_upc = '$iupc'" ; mysqli_query($conn, $sql); 
    //header("Location: ../my_list.php?quantity-updated"); 
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    //header("location:javascript://history.go(-1)");
    exit(); } }
    

//Adjust up button is code//
if (isset($_POST['item_to_adjust_u'])) {
    $iupc = mysqli_real_escape_string($conn, $_POST['item_to_adjust_u']);
    $iqty = mysqli_real_escape_string($conn, $_POST['quantity']);
    $uid = mysqli_real_escape_string($conn, $_SESSION['u_id']);
    //Adjust the item quantity in the database up by one.
    $sql = "UPDATE grocery_lists SET item_quantity = (item_quantity + '1') WHERE user_id='$uid' AND item_upc = '$iupc'";
    mysqli_query($conn, $sql);
    //header("Location: ../my_list.php?quantity-updated");
    //header("location:javascript://history.go(-1)");
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    //header("Refresh:0");
    //header( curPageURL() );
    exit(); 
}

//Replace item in My List//
if (isset($_POST['replaceBtn'])) {
    $oldUPC = mysqli_real_escape_string($conn, $_POST['oldUPC']);
    $newUPC = mysqli_real_escape_string($conn, $_POST['newUPC']);
    $uid = mysqli_real_escape_string($conn, $_POST['uid']);
    $sql = "UPDATE grocery_lists SET item_upc = '$newUPC' WHERE user_id='$uid' AND item_upc = '$oldUPC'";
    mysqli_query($conn, $sql);
    //header("Location: ../my_list.php?item-updated");
    //header("location:javascript://history.go(-1)");
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    //header("Refresh:0");
    exit();
}


///////////////////////Shop Page Code////////////////////////////////////////////////

//Do this code if the shop adjust down button is clicked//
if (isset($_POST['shop_item_to_adjust_d'])) {
$iupc = mysqli_real_escape_string($conn, $_POST['shop_item_to_adjust_d']);
$iqty = mysqli_real_escape_string($conn, $_POST['quantity']);
$storeId = mysqli_real_escape_string($conn, $_POST['storeId']);
$storeName = mysqli_real_escape_string($conn, $_POST['storeName']);
$uid = mysqli_real_escape_string($conn, $_SESSION['u_id']);
//Delete the item from the database if there was only a quantity of one.
if ($iqty < 2) { $sql="DELETE FROM grocery_lists WHERE user_id='$uid' AND item_upc = '$iupc'" ; mysqli_query($conn, $sql); header("Location: ../shop.php?storeId=$storeId&storeName=$storeName&removed-item"); exit(); } else {
    //Adjust the item quantity in the database down by one.
    $sql="UPDATE grocery_lists SET item_quantity = (item_quantity - '1') WHERE user_id='$uid' AND item_upc = '$iupc'" ; mysqli_query($conn, $sql); header("Location: ../shop.php?storeId=$storeId&storeName=$storeName&state=".$_SESSION['state']." &quantity-updated"); exit(); } }
    

//Do this code if the shop adjust up button is clicked//
if (isset($_POST['shop_item_to_adjust_u'])) {
$iupc = mysqli_real_escape_string($conn, $_POST['shop_item_to_adjust_u']);
$iqty = mysqli_real_escape_string($conn, $_POST['quantity']);
$storeId = mysqli_real_escape_string($conn, $_POST['storeId']);
$storeName = mysqli_real_escape_string($conn, $_POST['storeName']);
$uid = mysqli_real_escape_string($conn, $_SESSION['u_id']);
//Adjust the item quantity in the database up by one.
$sql = "UPDATE grocery_lists SET item_quantity = (item_quantity + '1') WHERE user_id='$uid' AND item_upc = '$iupc'";
mysqli_query($conn, $sql);
header("Location: ../shop.php?storeId=$storeId&storeName=$storeName&state=".$_SESSION['state']."&quantity-updated");
exit();
}

///Change the in_cart column from 0 to 1 when an item is CHECKED OFF while shopping in the store////
if (isset($_GET['list_upc_check'])) {
$uid = mysqli_real_escape_string($conn, $_GET['uid']);
$upc = mysqli_real_escape_string($conn, $_GET['list_upc_check']);
$storeId = mysqli_real_escape_string($conn, $_GET['storeId']);
$storeName = mysqli_real_escape_string($conn, $_GET['storeName']);

$sql = "UPDATE grocery_lists SET in_cart = 1, shop_date = CURDATE(), store_id = $storeId, store_name = '$storeName' WHERE user_id= $uid AND item_upc = $upc";
mysqli_query($conn, $sql);
header("Location: ../shop.php?upc=".$upc."&storeId=".$storeId."&storeName=".urlencode($storeName)."");
exit();
}


///Change the in_cart column from 1 to 0 to UNCHECK an item while shopping in the store////
if (isset($_GET['list_upc_uncheck'])) {
$uid = mysqli_real_escape_string($conn, $_GET['uid']);
$upc = mysqli_real_escape_string($conn, $_GET['list_upc_uncheck']);
$storeId = mysqli_real_escape_string($conn, $_GET['storeId']);
$storeName = mysqli_real_escape_string($conn, $_GET['storeName']);

$sql = "UPDATE grocery_lists SET in_cart = 0, shop_date = '0000-00-00', store_id = '', store_name = '' WHERE user_id= $uid AND item_upc = $upc";
mysqli_query($conn, $sql);
header("Location: ../shop.php?storeId=".$storeId."&storeName=".urlencode($storeName)."");
exit();
}




///////////////////////Cookbook and Recipes Code/////////////////////////////////////////

//If the Add To Cookbook button is clicked then do this code//
if (isset($_SESSION['u_id'])) {
if (isset($_POST['rsubmit'])) {
$rid = mysqli_real_escape_string($conn, $_POST['rid']);
$uid = mysqli_real_escape_string($conn, $_SESSION['u_id']);
$sql = "SELECT * FROM cookbook WHERE user_id = '{$uid}' AND recipe_id = '$rid'";
$result = mysqli_query($conn, $sql);
$queryResults = mysqli_num_rows($result);
$row = mysqli_fetch_array($result);
if ($queryResults > 0) {
//If the recipe is already in the user's cookbook then then don't add it and return user to recipes page//
header("Location: ../recipes.php?recipe-already-in-your-cookbook");
exit();
} else if ($queryResults < 1){
    //Insert the recipe into the cookbook table if it does not already exist//
    $sql2="INSERT INTO cookbook (user_id, recipe_id) VALUES ('{$uid}', '{$rid}')" ; mysqli_query($conn, $sql2); header("Location: ../recipes.php?recipe-added-to-cookbook"); exit(); } else { header("Location: ../recipes.php?error"); exit(); } } }


    // function array_implode($a) {
    //     return implode(',', $a);
    // }

//----video upload for Recipe Update page-------------------
if (isset($_POST['ridoftenPic'])) {
    $rid = mysqli_real_escape_string($conn, $_POST['ridoftenPic']);

    $mylog = "";
        
        
        $target_dir = "../img/recipes/.";

        $filename   = uniqid() . "-" . time(); // 5dab1961e93a7-1571494241
        $extension  = pathinfo( $_FILES["file"]["name"], PATHINFO_EXTENSION ); // jpg
        $basename   = $filename . "." . $extension; // 5dab1961e93a7_1571494241.jpg
        //$destination  = $target_dir.$basename;
        $destination  = "../img/recipes/{$basename}";

        $target_file = $target_dir . basename($_FILES["file"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        if(isset($_FILES["file"])) {
        $check = getimagesize($_FILES["file"]["tmp_name"]);
            if($check !== false) {
                $mylog .= "File is an image - " . $check["mime"] . ".";

                $uploadOk = 1;
            } else {
                $mylog .= "File is not an image.";
                $uploadOk = 0;
            }
        }


        // Check if file already exists
        if (file_exists($target_file)) {
        $mylog .= "Sorry, file already exists.";
        $uploadOk = 0;
        }
        
        // Check file size            5242880
        if ($_FILES["file"]["size"] > 600*KB) {
            $mylog .= "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            $mylog .= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // // Allow certain file formats
        // if($imageFileType != "mp4" ) {
        //     $mylog .= "Sorry, only MP4 files are allowed.";
        //     $uploadOk = 0;
        // }
        
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            $mylog .= "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $destination)) {
                $mylog .= "The file ". htmlspecialchars( basename( $_FILES["file"]["name"])). " has been uploaded.";
            } else {
                $mylog .= "Sorry, there was an error uploading your file.";
            }
        }
        //-----------------END File Uploading---------------------------------------------------
        $insrt = false;
        $sql = "UPDATE recipes SET `haspic` = '{$basename}' WHERE `recipe_id`=".$rid;
        
        if ($uploadOk == 1) {
            if ( mysqli_query($conn, $sql) ) {
                //$last_id = $conn->insert_id;
                //echo "Recipe inserted Successfully!, ID: " . $last_id;
                //echo 'true,'.$last_id;
                //$rid = $last_id;
        
                //header('Content-Type: application/json');
                //echo json_encode(array("insertrecipe"=>$rid, "status"=>$mylog));
                echo $mylog;
        
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
    
        //header("Location: ../create_recipe_2.php?recipe_name=$rname");
        exit();
        } else {
            echo $mylog;
            exit();
        }      
}    

//----video upload for Recipe Update page-------------------
if (isset($_POST['ridoften'])) {
    $rid = mysqli_real_escape_string($conn, $_POST['ridoften']);

    $mylog = "";
        
        
        $target_dir = "../img/recipes/.";

        $filename   = uniqid() . "-" . time(); // 5dab1961e93a7-1571494241
        $extension  = pathinfo( $_FILES["file"]["name"], PATHINFO_EXTENSION ); // jpg
        $basename   = $filename . "." . $extension; // 5dab1961e93a7_1571494241.jpg
        //$destination  = $target_dir.$basename;
        $destination  = "../img/recipes/{$basename}";

        $target_file = $target_dir . basename($_FILES["file"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        
        // Check if file already exists
        if (file_exists($target_file)) {
        $mylog .= "Sorry, file already exists.";
        $uploadOk = 0;
        }
        
        // Check file size            5242880
        if ($_FILES["file"]["size"] > 100*MB) {
            $mylog .= "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        
        // Allow certain file formats
        if ( $imageFileType != "mp4" || $imageFileType != "mov" ) {
            $mylog .= "Sorry, only MP4 & MOV files are allowed.";
            $uploadOk = 0;
        }
        
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            $mylog .= "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $destination)) {
                $mylog .= "The file ". htmlspecialchars( basename( $_FILES["file"]["name"])). " has been uploaded.";
            } else {
                $mylog .= "Sorry, there was an error uploading your file.";
            }
        }
        //-----------------END File Uploading---------------------------------------------------
        $insrt = false;
        $sql = "UPDATE recipes SET `hasvid` = '{$basename}' WHERE `recipe_id`=".$rid;
        
        if ($uploadOk == 1) {
            if ( mysqli_query($conn, $sql) ) {
                //$last_id = $conn->insert_id;
                //echo "Recipe inserted Successfully!, ID: " . $last_id;
                //echo 'true,'.$last_id;
                //$rid = $last_id;
        
                //header('Content-Type: application/json');
                //echo json_encode(array("insertrecipe"=>$rid, "status"=>$mylog));
                echo $mylog;
        
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
    
        //header("Location: ../create_recipe_2.php?recipe_name=$rname");
        exit(); 
        } else {
            echo $mylog;
            exit();
        }       
}

//Do this code if the submitName button is clicked// Recipies Addition Module.......
if (isset($_POST['submitStep1'])) {
    $rname = mysqli_real_escape_string($conn, $_POST['rname']);
    $rcate = mysqli_real_escape_string($conn, $_POST['rcate']);
    $rid = mysqli_real_escape_string($conn, $_POST['rid']);
    //$ralergy = implode (',', $_POST['ralergy']);
    $ralergy = implode(', ', (array)$_POST['ralergy']);
    
    $sql = "UPDATE recipes SET recipe_name='{$rname}', rcate='{$rcate}', ralergy='{$ralergy}' WHERE recipe_id = '$rid' ";

    if ( mysqli_query($conn, $sql) ) {
        //header('Content-Type: application/json');
        //echo json_encode(array("insertrecipe"=>$rid, "status"=>$mylog));
        echo 'true';

    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    

    exit();   
}

//Do this code if the submitName button is clicked// Recipies Addition Module.......
if (isset($_POST['rname'])) {
    $uid = mysqli_real_escape_string($conn, $_SESSION['u_id']);
    $rname = mysqli_real_escape_string($conn, $_POST['rname']);
    $rcate = mysqli_real_escape_string($conn, $_POST['rcate']);
    //$ralergy = implode (',', $_POST['ralergy']);
    $ralergy = implode(', ', (array)$_POST['ralergy']);
    

    if ($_POST['chkfile']=="checked") {

        $mylog = "";
        
        
        $target_dir = "../img/recipes/.";

        $filename   = uniqid() . "-" . time(); // 5dab1961e93a7-1571494241
        $extension  = pathinfo( $_FILES["file"]["name"], PATHINFO_EXTENSION ); // jpg
        $basename   = $filename . "." . $extension; // 5dab1961e93a7_1571494241.jpg
        //$destination  = $target_dir.$basename;
        $destination  = "../img/recipes/{$basename}";

        $target_file = $target_dir . basename($_FILES["file"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        if(isset($_FILES["file"])) {
        $check = getimagesize($_FILES["file"]["tmp_name"]);
            if($check !== false) {
                $mylog .= "File is an image - " . $check["mime"] . ".";

                $uploadOk = 1;
            } else {
                $mylog .= "File is not an image.";
                $uploadOk = 0;
            }
        }

        // Check if file already exists
        if (file_exists($target_file)) {
        $mylog .= "Sorry, file already exists.";
        $uploadOk = 0;
        }
        
        // Check file size            5242880
        if ($_FILES["file"]["size"] > 50000000) {
            $mylog .= "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            $mylog .= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            $mylog .= "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $destination)) {
                $mylog .= "The file ". htmlspecialchars( basename( $_FILES["file"]["name"])). " has been uploaded.";
            } else {
                $mylog .= "Sorry, there was an error uploading your file.";
            }
        }
        //-----------------END File Uploading---------------------------------------------------
        $insrt = false;
        $sql = "INSERT INTO recipes (`recipe_name`, `user_id`, `rcate`, `ralergy`, `haspic`) VALUES ('{$rname}', {$uid}, '{$rcate}', '{$ralergy}', '{$basename}')";

    } else {

        $sql = "INSERT INTO recipes (recipe_name, user_id, rcate, ralergy) VALUES ('{$rname}', {$uid}, '{$rcate}', '{$ralergy}')";

    }

    
    //mysqli_query($conn, $sql);

    if ( mysqli_query($conn, $sql) ) {
        $last_id = $conn->insert_id;
        //echo "Recipe inserted Successfully!, ID: " . $last_id;
        //echo 'true,'.$last_id;
        $rid = $last_id;
        //Ingredients Table generating its rows----------------------
        $obj1 = json_decode($_POST['Ingredients']);
        foreach($obj1 as $json){
            $sql_ingred = "";
            //$sql = "INSERT INTO recipe_ingredients (ingredient_name, recipe_id, preferred_upc, preferred_item, ingredient_cat, ingredient_qty, measurement_type) VALUES ('{$iname}', '{$rid}', '{$preferredUPC}', '{$preferredName}', '{$icat}', '{$iqty}', '{$mtype}')";

            $sql_ingred = "INSERT INTO recipe_ingredients (ingredient_name, recipe_id, preferred_upc, preferred_item, ingredient_cat, ingredient_qty, measurement_type) VALUES ('{$json->iname}', '{$rid}', '{$json->ingredientupc}', '{$json->ingredientsearchinput}', '{$json->ingredientcat}', '{$json->iqty}', '{$json->measurementSelect}')";
            mysqli_query($conn, $sql_ingred);
        }
        //Directions/Steps Table generating its rows----------------------
        $obj2 = json_decode($_POST['Direction']);
        foreach($obj2 as $jsonn){
            $sql_direction = "";
            $sql_direction = "INSERT INTO recipe_directions (recipe_id, directions_step, directions_text) VALUES ('{$rid}', '{$jsonn->dstep}', '{$jsonn->dtext}')";
            mysqli_query($conn, $sql_direction);
        }

        header('Content-Type: application/json');
        echo json_encode(array("insertrecipe"=>$rid, "status"=>$mylog));

    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    //header("Location: ../create_recipe_2.php?recipe_name=$rname");
    exit(); 
}

//Do this code if the ingredientName delete button is clicked//
if (isset($_POST['ingideleteid'])) {

    $ingideleteid = mysqli_real_escape_string($conn, $_POST['ingideleteid']);  
    
    $sql = "DELETE FROM recipe_ingredients WHERE ingredient_id = '$ingideleteid'";
   
    if ( mysqli_query($conn, $sql) ) {
        echo "true";
      } else {
        //echo "Error: " . $sql . "<br>" . $conn->error;
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    }
    //header("Location: ../create_recipe_2.php?recipe_name=$rname");
    exit();
}

//Do this code if the users delete button is clicked//
if (isset($_POST['userdeleteid'])) {

    $userdeleteid = mysqli_real_escape_string($conn, $_POST['userdeleteid']);  
    
    //$sql = "DELETE FROM users WHERE user_id = '$userdeleteid'";
   
    if ( mysqli_query($conn, $sql) ) {
        echo "true";
      } else {
        //echo "Error: " . $sql . "<br>" . $conn->error;
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    }
    //header("Location: ../create_recipe_2.php?recipe_name=$rname");
    exit();
}

//Do this code if the Direction Step delete button is clicked//
if (isset($_POST['directiondelid'])) {

    $directiondelid = mysqli_real_escape_string($conn, $_POST['directiondelid']);  
    
    $sql = "DELETE FROM recipe_directions WHERE directions_id = '$directiondelid'";
   
    if ( mysqli_query($conn, $sql) ) {
        echo "true";
      } else {
        //echo "Error: " . $sql . "<br>" . $conn->error;
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    }
    //header("Location: ../create_recipe_2.php?recipe_name=$rname");
    exit();
}

//Do this code if the Update User Functions button is clicked//
if (isset($_POST['submitUserUpdate'])) {

    $hid = mysqli_real_escape_string($conn, $_POST['hid']);
    $permissions_level = mysqli_real_escape_string($conn, $_POST['permissions_level']);  
    $verified = mysqli_real_escape_string($conn, $_POST['verified']);
    
    $sql = "UPDATE users SET permissions_level='{$permissions_level}', verified='{$verified}' WHERE user_id = '$hid' ";
       
    if ( mysqli_query($conn, $sql) ) {
        echo "true";
      } else {
        //echo "Error: " . $sql . "<br>" . $conn->error;
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    }
    //header("Location: ../create_recipe_2.php?recipe_name=$rname");
    exit();
}

//Do this code if the ingredientName button is clicked//
if (isset($_POST['submitIng'])) {

    if ( isset($_POST['ingredient_hid']) ) {
        $ingredient_hid = mysqli_real_escape_string($conn, $_POST['ingredient_hid']);
    } else {
        $rid = mysqli_real_escape_string($conn, $_POST['rid']);
    }

    $iname = mysqli_real_escape_string($conn, $_POST['iname']);  
    $icat = mysqli_real_escape_string($conn, $_POST['ingredientcat']);
    $iqty = mysqli_real_escape_string($conn, $_POST['iqty']);
    $mtype = mysqli_real_escape_string($conn, $_POST['measurementSelect']);
    $rname = mysqli_real_escape_string($conn, $_POST['ingredientsearchinput']);
    $ingredientupc = mysqli_real_escape_string($conn, $_POST['ingredientupc']);
    //Insert new ingredients into the ingredients table.
    if ( isset($_POST['ingredient_hid']) ) {
        $sql = "UPDATE recipe_ingredients SET ingredient_name='{$iname}', preferred_upc='{$ingredientupc}', preferred_item='{$rname}', ingredient_cat='{$icat}', ingredient_qty='{$iqty}', measurement_type='{$mtype}' WHERE ingredient_id = '$ingredient_hid' ";
    } else {
        $sql = "INSERT INTO recipe_ingredients (ingredient_name, recipe_id, preferred_upc, preferred_item, ingredient_cat, ingredient_qty, measurement_type) VALUES ('{$iname}', '{$rid}', '{$ingredientupc}','{$rname}', '{$icat}', '{$iqty}', '{$mtype}')";
    }
    

    
    if ( mysqli_query($conn, $sql) ) {
        echo "true";
      } else {
        //echo "Error: " . $sql . "<br>" . $conn->error;
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    }
    //header("Location: ../create_recipe_2.php?recipe_name=$rname");
    exit();
}

//Do this code if the ingredientName button is clicked//
if (isset($_POST['submitStep'])) {

    if ( isset($_POST['directions_hid']) ) {
        $directions_hid = mysqli_real_escape_string($conn, $_POST['directions_hid']);
    } else {
        $rid = mysqli_real_escape_string($conn, $_POST['rid']);
    }

    $dstep = mysqli_real_escape_string($conn, $_POST['dstep']);  
    $dtext = mysqli_real_escape_string($conn, $_POST['dtext']);
    
    //Insert new ingredients into the ingredients table. directions_step='{$dstep}',
    if ( isset($_POST['directions_hid']) ) {
        $sql = "UPDATE recipe_directions SET directions_text='{$dtext}' WHERE directions_id = '$directions_hid' ";
    } else {
        $sql = "INSERT INTO recipe_directions (directions_step, directions_text, recipe_id) VALUES ('{$dstep}','{$dtext}', '{$rid}')";
    }
    

    
    if ( mysqli_query($conn, $sql) ) {
        echo "true";
      } else {
        //echo "Error: " . $sql . "<br>" . $conn->error;
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    }
    //header("Location: ../create_recipe_2.php?recipe_name=$rname");
    exit();
}

//Do this code if the ingredientName button is clicked//
if (isset($_POST['submitIngredient'])) {
$iname = mysqli_real_escape_string($conn, $_POST['iname']);
$rid = mysqli_real_escape_string($conn, $_POST['rid']);
$icat = mysqli_real_escape_string($conn, $_POST['ingredient-cat']);
$iqty = mysqli_real_escape_string($conn, $_POST['iqty']);
$mtype = mysqli_real_escape_string($conn, $_POST['measurementSelect']);
$rname = mysqli_real_escape_string($conn, $_POST['rname']);
//Insert new ingredients into the ingredients table.
$sql = "INSERT INTO ingredients (ingredient_name, recipe_id, ingredient_cat, ingredient_qty, measurement_type) VALUES ('{$iname}', '{$rid}', '{$icat}', '{$iqty}', '{$mtype}')";
mysqli_query($conn, $sql);
header("Location: ../create_recipe_2.php?recipe_name=$rname");
exit();
}

//Do this code if the submitDirections button is clicked//
if (isset($_POST['submitDirections'])) {
$rid = mysqli_real_escape_string($conn, $_POST['rid']);
$dstep = mysqli_real_escape_string($conn, $_POST['dstep']);
$dtext = mysqli_real_escape_string($conn, $_POST['dtext']);
//Insert new directions into the recipe_directions table.
$sql = "INSERT INTO recipe_directions (recipe_id, directions_step, directions_text) VALUES ('{$rid}', '{$dstep}', '{$dtext}')";
mysqli_query($conn, $sql);
header("Location: ../create_recipe_3.php?rid=$rid");
exit();
}


////////////CODE TO TRANSFER PRODUCTS FROM THE GROCERY LIST TO THE PANTRY/////////////////

//Copies products from the grocery_lists table to the pantry table and then deletes them from the grocery_lists table when the button is clicked//
if (isset($_POST['listReceived'])) {
$uid = mysqli_real_escape_string($conn, $_SESSION['u_id']);
$storeId= mysqli_real_escape_string($conn, $_POST['storeId']);
//copies and inserts items from grocery list to pantry
$sql = "INSERT INTO pantry (user_id, item_upc, item_quantity) SELECT user_id, item_upc, item_quantity FROM grocery_lists WHERE user_id = '$uid'";
mysqli_query($conn, $sql);
//adds today's date as the date_received to everything that was just put into the pantry table
$sql2 = "UPDATE pantry SET date_received = CURDATE(), quantity_remaining = item_quantity WHERE user_id = '$uid' AND date_received IS NULL";
mysqli_query($conn, $sql2);
//updates the popularity in the products table
$sql3 = "UPDATE products SET products.popularity = (popularity + '1') WHERE EXISTS(SELECT * FROM grocery_lists WHERE grocery_lists.item_upc = products.item_upc AND user_id = '$uid')";
mysqli_query($conn, $sql3);
//copies and inserts items from the grocery list into past purchases
$sql4 = "INSERT INTO past_purchases (user_id, item_upc, item_quantity, item_price, company_id) SELECT grocery_lists.user_id, grocery_lists.item_upc, grocery_lists.item_quantity, product_prices.company_price, product_prices.store_name_id FROM grocery_lists LEFT OUTER JOIN product_prices ON grocery_lists.item_upc = product_prices.item_upc WHERE grocery_lists.user_id = '$uid' AND product_prices.store_name_id = '$storeId'";
mysqli_query($conn, $sql4);
//deletes the products from the grocery list after they have been put in the pantry table
$sql5 = "DELETE FROM grocery_lists WHERE user_id = '$uid'";
mysqli_query($conn, $sql5);
//adds today's date as the date_received to everything that was just put into the past purchases table
$sql6 = "UPDATE past_purchases SET past_purchases.date_received = CURDATE() WHERE past_purchases.user_id = '$uid' AND past_purchases.date_received IS NULL";
mysqli_query($conn, $sql6);
header("Location: ../pantry.php");
exit();
}



/////////////////////////PANTRY CODE////////////////////////////////////////////

//Delte button code for pantry page//
if (isset($_POST['pdupc'])) {
$pdupc = mysqli_real_escape_string($conn, $_POST['pdupc']);
$date = mysqli_real_escape_string($conn, $_POST['date']);
$uid = mysqli_real_escape_string($conn, $_SESSION['u_id']);
//Delete the item from the Pantry table
$sql = "DELETE FROM pantry WHERE user_id = '$uid' AND item_upc = '$pdupc' AND date_received = '$date'";
mysqli_query($conn, $sql);
header("Location: ../pantry.php");
exit();
}

//Adjust quantity down button code for the pantry page//
if (isset($_POST['pantry_item_to_adjust_down'])) {
$iupc = mysqli_real_escape_string($conn, $_POST['pantry_item_to_adjust_down']);
$iqty = mysqli_real_escape_string($conn, $_POST['quantity_remaining']);
$date = mysqli_real_escape_string($conn, $_POST['date']);
$uid = mysqli_real_escape_string($conn, $_SESSION['u_id']);
$today = mysqli_real_escape_string($conn, $_POST['today']);
//Delete the item from the pantry table if there was only a quantity of one left.
if ($iqty <= 1) {
    $sql="UPDATE pantry SET quantity_remaining = 0, date_depleted = CURDATE(), modifier = DATEDIFF(CURDATE(), date_received), avg_daily_consumption = (item_quantity / DATEDIFF(CURDATE(), date_received)) WHERE user_id='$uid' AND item_upc = '$iupc' AND date_received = '$date'" ; mysqli_query($conn, $sql); header("Location: ../pantry.php?removed-item");
    exit();
    } else {
    //Otherwise adjust the item quantity_remaining in the pantry table down by one.
    $sql="UPDATE pantry SET quantity_remaining = (quantity_remaining - '1') WHERE user_id='$uid' AND item_upc = '$iupc' AND date_received = '$date'" ; mysqli_query($conn, $sql);
    header("Location: ../pantry.php?quantity-updated");
    exit();
    }
}
    

//Adjust quantity up button code for the pantry page//
if (isset($_POST['pantry_item_to_adjust_up'])) {
$iupc = mysqli_real_escape_string($conn, $_POST['pantry_item_to_adjust_up']);
$iqty = mysqli_real_escape_string($conn, $_POST['quantity_remaining']);
$date = mysqli_real_escape_string($conn, $_POST['date']);
$uid = mysqli_real_escape_string($conn, $_SESSION['u_id']);
//Adjust the item quantity in the pantry table up by one.
$sql = "UPDATE pantry SET quantity_remaining = (quantity_remaining + '1') WHERE user_id='$uid' AND item_upc = '$iupc' AND date_received = '$date'";
mysqli_query($conn, $sql);
header("Location: ../pantry.php?quantity-updated");
exit();
}

//Add single item to pantry ///
if (isset($_POST['pantryAdd'])) {
$uid = mysqli_real_escape_string($conn, $_SESSION['u_id']);
$upc = mysqli_real_escape_string($conn, $_POST['iupc']);
$qty = mysqli_real_escape_string($conn, $_POST['qty']);
//Insert the item into the pantry table//
$sql = "INSERT INTO pantry (user_id, item_upc, item_quantity, quantity_remaining, date_received) VALUES ('{$uid}', '{$upc}', '{$qty}', '{$qty}', CURDATE())";
mysqli_query($conn, $sql);
header("Location: ../pantry-add.php?added=success");
exit();
}



/////////////////UPLOAD PRODUCT IMAGES//////////////////////////////////////////////
//Add product image
if (isset($_POST['submitPhoto'])) {
$files = $_FILES['file'];
$upc = mysqli_real_escape_string($conn, $_POST['pupc']);
$fileName = $_FILES['file']['name'];
$fileTmpName = $_FILES['file']['tmp_name'];
$fileSize = $_FILES['file']['size'];
$fileError = $_FILES['file']['error'];
$fileType = $_FILES['file']['type'];
$fileExt = explode('.', $fileName);
$fileActualExt = strtolower(end($fileExt));
$allowed = array('jpg', 'jpeg', 'png', 'gif');
if (in_array($fileActualExt, $allowed)) {
if ($fileError === 0) {
if ($fileSize < 10000000) { $fileNameNew=$upc.".".$fileActualExt; $fileDestination="../img/" .$fileNameNew; print_r(realpath($fileDestination)); move_uploaded_file($fileTmpName, $fileDestination);
// ---------- Include Universal Image Resizing Function --------
include_once("image_resizer.php"); $target_file="../img/$fileNameNew" ; $resized_file="../img/resized_$fileNameNew" ; $wmax=200; $hmax=150; ak_img_resize($target_file, $resized_file, $wmax, $hmax, $fileExt);
// ----------- End Universal Image Resizing Function -----------
$sql="UPDATE products SET has_image = '1' WHERE item_upc = '$upc'";
mysqli_query($conn, $sql);
header("Location: ../details.php?upc=$upc");
exit();
} else {
header("Location: ../details.php#contributePhoto?upc=$upc");
echo "That photo is larger than the 1 MB size limit.";
}
} else {
header("Location: ../details.php#contributePhoto?upc=$upc");
echo "There was an error and we were unable to upload the photo.";
}
} else {
header("Location: ../details.php#contributePhoto?upc=$upc");
echo "You cannot upload that type of file.";
}
}


////////////////////STORE NAME AUTOCOMPLETE////////////////////////////////
if(isset($_POST['suggestion'])) { $suggestion=mysqli_real_escape_string($conn, $_POST['suggestion']); $sql="SELECT * FROM store_names WHERE store_name LIKE '%$suggestion%' LIMIT 8" ; $result=mysqli_query($conn, $sql); $queryResult=mysqli_num_rows($result); if($queryResult> 0) {
while($row = mysqli_fetch_array($result)) {
$name = $row['store_name'];
// $streetAddress = $row['store_street_address'];
// $city = $row['store_city'];
// $state = $row['store_sate'];
// $zip = $row['store_zip'];
echo "<p class='storeHint'>$name</p><br>";
}
}
exit();
}

////////////////////EXACT INGREDIENT SEARCH AUTOCOMPLETE////////////////////////////////
if(isset($_POST['ingredientSuggestion'])) {
    $ingredientSuggestion = mysqli_real_escape_string($conn, $_POST['ingredientSuggestion']);//Stores posted search term.
    $sql = "SELECT * FROM products WHERE MATCH (products.item_upc, products.item_gtin, products.item_brand, products.item_manufacturer, products.item_name, products.item_keywords, products.item_cat) AGAINST ('$ingredientSuggestion') ORDER BY popularity DESC LIMIT 30";
    //$sql = "SELECT * FROM products WHERE item_name LIKE '%$searchSuggestion%' LIMIT 20";
    $result = mysqli_query($conn, $sql);
    $queryResult = mysqli_num_rows($result);
    if($queryResult > 0) {
    while($row = mysqli_fetch_array($result)) {
    $item_name = $row['item_name'];
    $item_upc = $row['item_upc'];
    $category = $row['item_cat'];
    echo "<div class='recipeHintContainer'><b>
            <p class='searchHint'>$item_name</b></p>
            <p class='inCat'>$category</p>
            <p class='hiddenUPC'>$item_upc</p>
            </div>";
    }
    }
    exit();
    }

////////////////////ADDRESS AUTOCOMPLETE////////////////////////////////
if(isset($_POST['suggestion'])) {
$suggestion = mysqli_real_escape_string($conn, $_POST['suggestion']);
$sql = "SELECT * FROM store_address LEFT OUTER JOIN store_names ON store_address.store_name_id = store_names.store_name_id WHERE store_name = '{$suggestion}'";
$result = mysqli_query($conn, $sql);
$queryResult = mysqli_num_rows($result);
if($queryResult > 0) {
while($row = mysqli_fetch_array($result)) {
$address = $row['store_address'];
// $streetAddress = $row['store_street_address'];
// $city = $row['store_city'];
// $state = $row['store_sate'];
// $zip = $row['store_zip'];
echo "<p class='storeHint'>$address</p><br>";
}
exit();
}
}


////////////////////SEARCH AUTOCOMPLETE////////////////////////////////

if(isset($_POST['searchSuggestion'])) {
    $searchvar = mysqli_real_escape_string($conn, $_POST['searchSuggestion']);//Stores posted search term.
    $searchvar =  explode("|",$searchvar);
    $searchSuggestion = $searchvar[0];
    $htype = $searchvar[1];

    if ($htype == 'Groceries'){
        $sql = "SELECT * FROM products WHERE MATCH (products.item_upc, products.item_gtin, products.item_brand, products.item_manufacturer, products.item_name, products.item_keywords, products.item_cat) AGAINST ('$searchSuggestion') ORDER BY popularity DESC LIMIT 30";
        //echo $sql;
        $result = mysqli_query($conn, $sql);
        $queryResult = mysqli_num_rows($result);

        if($queryResult > 0) {
            while($row = mysqli_fetch_array($result)) {
                $item_name = $row['item_name'];
                $category = $row['item_cat'];
                echo "<div class='searchHintContainer'>
                        <p class='searchHint'><strong>$item_name</strong></p>
                        <p class='inCat'>$category</p>
                </div>";
            }
        } 
    } else {
        $sql = "SELECT * FROM recipes WHERE MATCH (recipes.recipe_name) AGAINST ('$searchSuggestion') ORDER BY recipe_id DESC LIMIT 30";

        $result = mysqli_query($conn, $sql);
        $queryResult = mysqli_num_rows($result);
        
        if($queryResult > 0) {
            while($row = mysqli_fetch_array($result)) {
                $item_name = $row['recipe_name'];
                //$category = $row['item_cat'];
                echo "<div class='searchHintContainer'>
                        <p class='searchHint'><strong>$item_name</strong></p>
                </div>";
            }
        } 
    }

    //$sql = "SELECT * FROM products WHERE item_name LIKE '%$searchSuggestion%' LIMIT 20";
    
    exit();
}

////////////////////CITY AUTOCOMPLETE////////////////////////////////

if(isset($_POST['cityQuery'])) {
$citySuggestion = mysqli_real_escape_string($conn, $_POST['cityQuery']);//Stores posted search term.
$state = mysqli_real_escape_string($conn, $_POST['state']);//Stores posted search term.
$sql = "SELECT * FROM us_cities WHERE name LIKE '%$citySuggestion%' AND state_code = '{$state}' LIMIT 8";
$result = mysqli_query($conn, $sql);
$queryResult = mysqli_num_rows($result);
if($queryResult > 0) {
while($row = mysqli_fetch_array($result)) {
$city = $row['name'];
$county = $row['county'];
echo "<p class='cityHint'>$city</p>
<p id='county'>$county</p>";
}
}
exit();
}

//--------zip code------------------------------
if(isset($_POST['zipQuery'])) {
    $zipSuggestion = mysqli_real_escape_string($conn, $_POST['zipQuery']);//Stores posted search term.
    //$state = mysqli_real_escape_string($conn, $_POST['state']);//Stores posted search term.
    $sql = "SELECT * FROM us_cities WHERE zip_codes LIKE '%$zipSuggestion%' LIMIT 8";
    $result = mysqli_query($conn, $sql);
    $queryResult = mysqli_num_rows($result);
    if($queryResult > 0) {
    while($row = mysqli_fetch_array($result)) {
    $city = $row['name'];
    $county = $row['state_code'];
    echo "<p class='zipHint'>".$city.", ".$county."</p>";
    }
    }
    exit();
}

// Change Location ---------------------
if (isset($_POST['mylocat'])) {

    $mylocat = mysqli_real_escape_string($conn, $_POST['mylocat']);
    $tatto = explode(',', $mylocat);
    $_SESSION['city'] = $tatto[0];
    $_SESSION['state'] = $tatto[1];
    $_SESSION['muserloc'] = $mylocat;

    //$sql = "UPDATE products SET item_cat = '$iCat', item_subcat = '$iSubCat', item_net = '$iNet', measurement_type = '$measure' WHERE item_upc = '$productEditorUpc'";
    //mysqli_query($conn, $sql);
    echo "champa";
    //echo $tatto[0];
    exit();
    }
    


////////////CODE TO UPDATE PRODUCTS ON PRODUCT EDITOR PAGE/////////////////
if (isset($_POST['productEditorUpc'])) {
$productEditorUpc = mysqli_real_escape_string($conn, $_POST['productEditorUpc']);
$iCat = mysqli_real_escape_string($conn, $_POST['catSelect']);
$iNet = mysqli_real_escape_string($conn, $_POST['itemNet']);
$measure = mysqli_real_escape_string($conn, $_POST['measure']);
$iSubCat = mysqli_real_escape_string($conn, $_POST['subCatSelect']);
$pagenum = mysqli_real_escape_string($conn, $_POST['pagenum']);
////CODE TO SUBMIT ANY CHANGES TO ITEM///
$sql = "UPDATE products SET item_cat = '$iCat', item_subcat = '$iSubCat', item_net = '$iNet', measurement_type = '$measure' WHERE item_upc = '$productEditorUpc'";
mysqli_query($conn, $sql);
//Returns header to product_editor page
header("Location: ../product_editor.php?productEditorCat=".htmlspecialchars($iCat)."&pagenum=$pagenum&update=success");
exit();
}


////CODE TO SUBMIT CATEGORY FROM DETAILS PAGE///
if (isset($_POST['details_ic_upc'])) {
$iCatUPC = mysqli_real_escape_string($conn, $_POST['details_ic_upc']);
$iCat = mysqli_real_escape_string($conn, $_POST['details_catSelect']);
$sql = "UPDATE products SET item_cat = '$iCat' WHERE item_upc = '$iCatUPC'";
mysqli_query($conn, $sql);
header("Location: ../details.php?upc=$iCatUPC&cat_entry=success");
exit();
} /*else {
header("Location: ../details.php?upc=$iCatUPC&submit=error");
exit();
}*/

////CODE TO SUBMIT SUB_CATEGORY FROM DETAILS PAGE///
if (isset($_POST['details_isc_upc'])) {
$iSubCatUPC = mysqli_real_escape_string($conn, $_POST['details_isc_upc']);
$iSubCat = mysqli_real_escape_string($conn, $_POST['details_subCatSelect']);
$iSubCatCat = mysqli_real_escape_string($conn, $_POST['details_isc_cat']);
$sql = "UPDATE products SET item_subcat = '$iSubCat' WHERE item_upc = '$iSubCatUPC'";
mysqli_query($conn, $sql);
header("Location: ../details.php?upc=$iSubCatUPC&sub_cat_entry=success");
exit();
} /*else {
header("Location: ../details.php?upc=$iSubCatUPC&submit=error");
exit();
}*/

//CODE TO ADD PRICE TO THE PRODUCT PRICES TABLE FROM DETAILS PAGE//
if (isset($_GET['priceSubmit'])) {
$itemUPC = mysqli_real_escape_string($conn, $_GET['itemUPC']);
$itemName = mysqli_real_escape_string($conn, $_GET['itemName']);
$priceEntry = mysqli_real_escape_string($conn, $_GET['priceEntry']);
$storeName = mysqli_real_escape_string($conn, $_GET['storeName']);
$storeState = mysqli_real_escape_string($conn, $_GET['storeState']);
$measureSelect = mysqli_real_escape_string($conn, $_GET['measureSelect']);
$storeAddress = '';
$sql = "SELECT * FROM store_address LEFT OUTER JOIN store_names ON store_address.store_name_id = store_names.store_name_id WHERE store_name = '{$storeName}' AND store_street_address = '{$storeAddress}'";
$result = mysqli_query($conn, $sql);
$queryResults = mysqli_num_rows($result);
$row = mysqli_fetch_array($result);
if ($queryResults > 0) {
    //If the name and address of the store is found in the store_names table then enter the price and store id into the product_prices table//
    $storeID = $row['store_name_id'];
    $storeAddressID = $row['store_address_id'];
    $sql4 = "SELECT * FROM product_prices WHERE store_name_id = '$storeID' AND item_upc = '$itemUPC'";
    $result4 = mysqli_query($conn, $sql4);
    $queryResults4 = mysqli_num_rows($result4);
    if ($queryResults4 > 0) {
    $sql = "UPDATE product_prices SET company_price = '$priceEntry' WHERE store_name_id = '$storeID3' AND item_upc = '$itemUPC'";
    mysqli_query($conn, $sql);
    header("Location: ../details.php?upc=$itemUPC&price_entry=success");
    exit();
    } else if ($queryResults4 < 1) { 
        $sql2="INSERT INTO product_prices (store_address_id, store_name_id, store_name, state, item_upc, item_name, measurement, company_price) VALUES ('{$storeAddressID}', '{$storeID}', '{$storeName}', '{$storeState}', '{$itemUPC}', '{$itemName}', '{$measureSelect}', '{$priceEntry}')" ; mysqli_query($conn, $sql2); header("Location: ../details.php?upc='$itemUPC' &price_entry=success"); 
    exit(); 
    } 
} else if ($queryResults < 1){
    //In case the store address is not found then just insert the record with only the store name.//
    $sql3="SELECT * FROM store_names WHERE store_name = '{$storeName}'" ; 
    $result3=mysqli_query($conn, $sql3); 
    $queryResults3=mysqli_num_rows($result3); 
    $row3=mysqli_fetch_array($result3);

    if ($queryResults3> 0) {
        $storeID3 = $row3['store_name_id'];
        $sql4 = "SELECT * FROM product_prices WHERE store_name_id = '$storeID3' AND item_upc = '$itemUPC'";
        $result4 = mysqli_query($conn, $sql4);
        $queryResults4 = mysqli_num_rows($result4);

        if ($queryResults4 > 0) {
        $sql = "UPDATE product_prices SET company_price = '$priceEntry' WHERE store_name_id = '$storeID3' AND item_upc = '$itemUPC'";
        mysqli_query($conn, $sql);
        header("Location: ../details.php?upc=$itemUPC&price_entry=success");
       echo 'chumpa1';
        exit();
        } else if ($queryResults4 < 1) {
            //$sql5="INSERT INTO product_prices (store_name_id, store_name, `state`, item_upc, item_name, measurement, company_price) VALUES ({$storeID3}, '{$storeName}', '{$storeState}', '{$itemUPC}', '{$itemName}', '{$measureSelect}', '{$priceEntry}')" ; 
            $sql5="INSERT INTO product_prices (store_name_id, store_name, `state`, item_upc, measurement, company_price) VALUES ({$storeID3}, '{$storeName}', '{$storeState}', '{$itemUPC}', '{$measureSelect}', '{$priceEntry}')" ; 
            mysqli_query($conn, $sql5); 
            echo $sql5;
            echo 'chumpa2';
            header("Location: ../details.php?upc=$itemUPC&price_entry=success"); 
            exit();
        }
    } else if ($queryResults3 < 1){
        //Error in case the store name is not found either//
        header("Location: ../details.php?upc=$itemUPC&submit=error/store_not_on_file"); 
        exit(); 
        } else {
            //Error for any other reason//
            header("Location: ../details.php?upc=$itemUPC&submit=error"); 
            exit(); 
        }
}
 }


//////////////////////CONFIRM PRICE FROM SHOP PAGE//////////////////////////////

//CODE TO ADD PRICE TO THE PRODUCT PRICES TABLE//
if (isset($_GET['priceConfirmYes'])) {
$itemUPC = mysqli_real_escape_string($conn, $_GET['itemUPC']);
$itemName = mysqli_real_escape_string($conn, $_GET['itemName']);
$priceEntry = mysqli_real_escape_string($conn, $_GET['priceEntry']);
$storeName = mysqli_real_escape_string($conn, $_GET['storeName']);
$storeState = mysqli_real_escape_string($conn, $_GET['storeState']);
$measureSelect = mysqli_real_escape_string($conn, $_GET['measureSelect']);
$storeAddress = '';
$sql = "SELECT * FROM store_address LEFT OUTER JOIN store_names ON store_address.store_name_id = store_names.store_name_id WHERE store_name = '{$storeName}' AND store_street_address = '{$storeAddress}'";
$result = mysqli_query($conn, $sql);
$queryResults = mysqli_num_rows($result);
$row = mysqli_fetch_array($result);
if ($queryResults > 0) {
//If the name and address of the store is found in the store_names table then enter the price and store id into the product_prices table//
$storeID = $row['store_name_id'];
$storeAddressID = $row['store_address_id'];
$sql4 = "SELECT * FROM product_prices WHERE store_name_id = '$storeID' AND item_upc = '$itemUPC'";
$result4 = mysqli_query($conn, $sql4);
$queryResults4 = mysqli_num_rows($result4);
if ($queryResults4 > 0) {
$sql = "UPDATE product_prices SET company_price = '$priceEntry' WHERE store_name_id = '$storeID' AND item_upc = '$itemUPC'";
mysqli_query($conn, $sql);
header("Location: ../shop.php?storeId=".$storeID."&storeName=".urlencode($storeName)."&price=confirmed");
exit();
} else if ($queryResults4 < 1) { $sql2="INSERT INTO product_prices (store_address_id, store_name_id, store_name, state, item_upc, item_name, measurement, company_price) VALUES ('{$storeAddressID}', '{$storeID}', '{$storeName}', '{$storeState}', '{$itemUPC}', '{$itemName}', '{$measureSelect}', '{$priceEntry}')" ; mysqli_query($conn, $sql2); header("Location: ../shop.php?storeId=".$storeID." &storeName=".urlencode($storeName)." &price=confirmed"); exit(); } } else if ($queryResults < 1){
    //In case the store address is not found then just insert the record with only the store name.//
    $sql3="SELECT * FROM store_names WHERE store_name = '{$storeName}'" ; $result3=mysqli_query($conn, $sql3); $queryResults3=mysqli_num_rows($result3); $row3=mysqli_fetch_array($result3); if ($queryResults3> 0) {
    $storeID3 = $row3['store_name_id'];
    $sql4 = "SELECT * FROM product_prices WHERE store_name_id = '$storeID3' AND item_upc = '$itemUPC'";
    $result4 = mysqli_query($conn, $sql4);
    $queryResults4 = mysqli_num_rows($result4);
    if ($queryResults4 > 0) {
    $sql = "UPDATE product_prices SET company_price = '$priceEntry' WHERE store_name_id = '$storeID3' AND item_upc = '$itemUPC'";
    mysqli_query($conn, $sql);
    header("Location: ../shop.php?storeId=".$storeID3."&storeName=".urlencode($storeName)."&price=confirmed");
    exit();
    } else if ($queryResults4 < 1) { $sql5="INSERT INTO product_prices (store_name_id, store_name, state, item_upc, item_name, measurement, company_price) VALUES ('{$storeID3}', '{$storeName}', '{$storeState}', '{$itemUPC}', '{$itemName}', '{$measureSelect}', '{$priceEntry}')" ; mysqli_query($conn, $sql5); header("Location: ../shop.php?storeId=".$storeID3." &storeName=".urlencode($storeName)." &price=confirmed"); exit(); } } else if ($queryResults3 < 1){
    //Error in case the store name is not found either//
    header("Location: ../shop.php?storeId=".$storeID." &storeName=".urlencode($storeName)." &submit=error/store_not_on_file"); exit(); } else {
    //Error for any other reason//
    header("Location: ../shop.php?storeId=".$storeID." &storeName=".urlencode($storeName)." C&submit=error"); exit(); } } }


/////////////////////Price Adjust From Shop Page////////////////////////////////
    
//CODE TO ADD PRICE TO THE PRODUCT PRICES TABLE//
if (isset($_GET['priceSubmitShop'])) {
$itemUPC = mysqli_real_escape_string($conn, $_GET['itemUPC']);
$itemName = mysqli_real_escape_string($conn, $_GET['itemName']);
$priceEntry = mysqli_real_escape_string($conn, $_GET['priceEntry']);
$storeName = mysqli_real_escape_string($conn, $_GET['storeName']);
$storeState = mysqli_real_escape_string($conn, $_GET['storeState']);
$measureSelect = mysqli_real_escape_string($conn, $_GET['measureSelect']);
$storeAddress = '';
$sql = "SELECT * FROM store_address LEFT OUTER JOIN store_names ON store_address.store_name_id = store_names.store_name_id WHERE store_name = '{$storeName}' AND store_street_address = '{$storeAddress}'";
$result = mysqli_query($conn, $sql);
$queryResults = mysqli_num_rows($result);
$row = mysqli_fetch_array($result);
if ($queryResults > 0) {
//If the name and address of the store is found in the store_names table then enter the price and store id into the product_prices table//
$storeID = $row['store_name_id'];
$storeAddressID = $row['store_address_id'];
$sql4 = "SELECT * FROM product_prices WHERE store_name_id = '$storeID' AND item_upc = '$itemUPC'";
$result4 = mysqli_query($conn, $sql4);
$queryResults4 = mysqli_num_rows($result4);
if ($queryResults4 > 0) {
$sql = "UPDATE product_prices SET company_price = '$priceEntry' WHERE store_name_id = '$storeID' AND item_upc = '$itemUPC'";
mysqli_query($conn, $sql);
header("Location: ../shop.php?storeId=".$storeID."&storeName=".urlencode($storeName)."&price=updated");
exit();
} else if ($queryResults4 < 1) { $sql2="INSERT INTO product_prices (store_address_id, store_name_id, store_name, state, item_upc, item_name, measurement, company_price) VALUES ('{$storeAddressID}', '{$storeID}', '{$storeName}', '{$storeState}', '{$itemUPC}', '{$itemName}', '{$measureSelect}', '{$priceEntry}')" ; mysqli_query($conn, $sql2); header("Location: ../shop.php?storeId=".$storeID." &storeName=".urlencode($storeName)." &price=updated"); exit(); } } else if ($queryResults < 1){
    //In case the store address is not found then just insert the record with only the store name.//
    $sql3="SELECT * FROM store_names WHERE store_name = '{$storeName}'" ; $result3=mysqli_query($conn, $sql3); $queryResults3=mysqli_num_rows($result3); $row3=mysqli_fetch_array($result3); if ($queryResults3> 0) {
    $storeID3 = $row3['store_name_id'];
    $sql4 = "SELECT * FROM product_prices WHERE store_name_id = '$storeID3' AND item_upc = '$itemUPC'";
    $result4 = mysqli_query($conn, $sql4);
    $queryResults4 = mysqli_num_rows($result4);
    if ($queryResults4 > 0) {
    $sql = "UPDATE product_prices SET company_price = '$priceEntry' WHERE store_name_id = '$storeID3' AND item_upc = '$itemUPC'";
    mysqli_query($conn, $sql);
    header("Location: ../shop.php?storeId=".$storeID3."&storeName=".urlencode($storeName)."&price=updated");
    exit();
    } else if ($queryResults4 < 1) { $sql5="INSERT INTO product_prices (store_name_id, store_name, state, item_upc, item_name, measurement, company_price) VALUES ('{$storeID3}', '{$storeName}', '{$storeState}', '{$itemUPC}', '{$itemName}', '{$measureSelect}', '{$priceEntry}')" ; mysqli_query($conn, $sql5);
    header("Location: ../shop.php?storeId=".$storeID3." &storeName=".urlencode($storeName)." &price=updated");
    exit();
    }
    } else if ($queryResults3 < 1){
        //Error in case the store name is not found either//
        header("Location: ../shop.php?storeId=".$storeID." &storeName=".urlencode($storeName)." &submit=error/store_not_on_file"); exit(); } else { //Error for any other reason//
        header("Location: ../shop.php?storeId=".$storeID." &storeName=".urlencode($storeName)." &submit=error"); exit(); } } }


////CODE TO SELECT CATEGORY ON PRODUCT EDITOR PAGE///
/*if (isset($_GET['productEditorCat'])) {
$PECat = mysqli_real_escape_string($conn, $_GET['productEditorCat']);
$sql = "SELECT * FROM products INNER JOIN product_photos ON products.item_upc = product_photos.upc WHERE products.item_cat = $PECat ORDER BY popularity DESC";
mysqli_query($conn, $sql);
header("Location: ../product_editor.php?productEditorCat='$PECat'");
exit();
} /*else {
header("Location: ../details.php?upc=$iCatUPC&submit=error");
exit();
}*/


////////////PRIMARY IMAGE SELECTOR//////////////////////

if(isset($_POST['primaryPhotoSelector'])) {
$primaryPhotoSelector = mysqli_real_escape_string($conn, $_POST['primaryPhotoSelector']);
$photoUPC = mysqli_real_escape_string($conn, $_POST['photoUPC']);
$sql = "UPDATE product_photos SET link = '$primaryPhotoSelector' WHERE upc = '$photoUPC'";
mysqli_query($conn, $sql);
header("Location: ../details.php?upc=$photoUPC");
exit();
}