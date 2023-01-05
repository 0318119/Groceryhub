<!DOCTYPE html>
<html lang="en">

<?php 
error_reporting( 0 );
include_once 'includes/dbh.inc.php';
include 'includes/header.php'; 
//Request URL: http://localhost/groceryhub/assets/img/noimageavailable.png

?>
<!-- spacer -->

<div class="space-single hidden-sm hidden-xs">
</div>
<!-- spacer end -->

<!-- wrapper -->
<div class="row">
    <!-- <div class="col-md-12 col-md-offset-1 col-sm-12 col-sm-offset-1 col-xs-12 pull-left"> -->
    <div class="col-md-11 col-md-offset-1 col-sm-12 col-sm-offset-1 col-xs-12 pull-left">

        <!-- row content -->
        <div class="row">

            <!-- left content -->
            <div class="col-md-9" style="padding-right:15px;">
                <!-- php code -->
                <?php 
                                        
                if (isset($_GET['search'])) {
                    $htype = mysqli_real_escape_string($conn, $_GET['htype']);//Stores posted hub type.
                    $search = mysqli_real_escape_string($conn, $_GET['search']);//Stores posted search term.
                    $filterCat = mysqli_real_escape_string($conn, $_GET['catSelect']);//Stores posted category selected to search in.
                    $limit = " LIMIT 200";
                    //If category to search in was left to the default of "products" then the query will return results matching the search term from all categories.

                    if ($htype == 'Recipes') {
                        //$sql ="SELECT * FROM recipes ORDER BY recipe_id;";
                        $sql = "SELECT * FROM recipes WHERE MATCH (recipes.recipe_name) AGAINST ('$search') ORDER BY recipe_id";
                    } else {
                        if ($_GET['catSelect'] == "Products") {
                            $sql = "SELECT * FROM products LEFT OUTER JOIN product_photos ON products.item_upc = product_photos.upc WHERE MATCH (products.item_upc, products.item_gtin, products.item_brand, products.item_manufacturer, products.item_name, products.item_keywords, products.item_cat) AGAINST ('$search') ORDER BY has_image DESC, has_link DESC, popularity DESC";
                        //Otherwise if a category was selected then the query only returns results matching the search term in the selected category. 
                        } else if ($_GET['catSelect'] == "$filterCat") {
                            if (!empty($search)) {
                                $sql = "SELECT * FROM products LEFT OUTER JOIN product_photos ON products.item_upc = product_photos.upc WHERE MATCH (products.item_upc, products.item_gtin, products.item_brand, products.item_manufacturer, products.item_name, products.item_keywords, products.item_cat) AGAINST ('$search)') AND products.item_cat LIKE ('$filterCat') ORDER BY has_image DESC, has_link DESC, popularity DESC";
                            } else {
                                if (!empty($_GET['subCatSelect'])) {
                                    $filterSubCat = mysqli_real_escape_string($conn, $_GET['subCatSelect']);//Stores posted sub category selected to search in.
                                    $sql = "SELECT * FROM products LEFT OUTER JOIN product_photos ON products.item_upc = product_photos.upc WHERE item_cat LIKE ('$filterCat') AND item_subcat LIKE ('$filterSubCat') ORDER BY has_image DESC, has_link DESC, popularity DESC";
                                } else {
                                $sql = "SELECT * FROM products LEFT OUTER JOIN product_photos ON products.item_upc = product_photos.upc WHERE item_cat LIKE ('$filterCat') ORDER BY has_image DESC, has_link DESC, popularity DESC";
                                }
                            }
                        }
                    }
                    //echo $sql;
                    $results = mysqli_query($conn, $sql);//execute query without limit to get total number of rows
                    $queryResult = mysqli_num_rows($results);//total number of rows
                    
                    if ($queryResult > 0) {
                        $page_rows = 20;//the page size (number of rows in each page)
                        $last = ceil($queryResult/$page_rows);//total number of pages //use ceil to avoid fractions
                        
                        //Start of new pagination code
                        if (isset($_GET['pagenum'])) {
                            $pagenum = $_GET['pagenum'];//get the page number user want to view
                            
                        } else {
                            $_GET['pagenum'] = 1;//if user hasn't give page number set page to page number 1
                            
                        }
                        if ($_GET['pagenum'] < 2)  {  //if user give negative page number. set page number to 1
                        $_GET['pagenum'] = 1;  //this will happen if user clicked the Previous page link when current page is 1
                        
                        } else if ($_GET['pagenum'] >= $last) { //if page number is greater than calculated number of pages . set page number to last page
                        $_GET['pagenum'] = $last;  //this will happen if user clicked the next page link when current page is the last page
                        
                        } else {
                            $pagenum = 1;//if user hasn't give page number set page to page number 1
                            
                        }
                        
                        //($pagenum - 1) * $page_rows calculates where to start the lmit
                        
                        $sql .= " LIMIT ".($_GET['pagenum'] - 1) * $page_rows.", ".$page_rows;//limit result
                        $results = mysqli_query($conn, $sql);//execute query with limits
                        $queryResults = mysqli_num_rows($results);//total number of rows
                        $lower = (($_GET['pagenum'] - 1) * $page_rows +1);
                        $upper = (($_GET['pagenum'] - 1) * $page_rows + $page_rows);
                        if ($upper >= $queryResult) {
                            $upper = $queryResult;
                        }
                        
                    // If there are search results then we're displaying a message that says how many search results there were for the search term and the category searched in.
                    //--------------------------------------------------------------------------------------------
                    echo '
                        <!-- article -->
                        <div class="col-md-12 ">
                            <h3 class="onStep" data-animation="fadeInRight" data-time="0">'.$htype.' - Search Results!</h3>
                            <p class=searchResults>Showing search results '.$lower.' through '.$upper.' of '.$queryResult.' for <b style="font-size:16px;color:red;">'.$search.'</b> in the <b style="font-size:16px;color:red;">'.$_GET['catSelect'].'</b> category.</p>

                            <!-- spacer-->
                            <!-- <div class="space-single"></div> -->
                            <!-- spacer end -->

                        </div>
                        <!-- article end -->';
                    echo '
                        <!-- filter project -->
                        <div class="onStep" data-animation="fadeInUp" data-time="900">
                            <div class="filter-wraper">
                                <ul id="filter-porto">

                                    <li class="filt-projects active">
                                    Page '.mysqli_real_escape_string($conn, $_GET['pagenum']).'-of-
                                    <a class=pages href=?htype='.urlencode($htype).'&catSelect='.urlencode($filterCat).'&search='.urlencode($search).'&pagenum='.$last.'> '.$last.'</a>';

                                    if ($lower > $page_rows) {
                                        echo "<a class=pages href=?htype=".urlencode($htype)."&catSelect=".urlencode($filterCat)."&search=".urlencode($search)."&pagenum=".($_GET['pagenum']-1).">Previous Page</a>";
                                    }
                                echo '</li>
                                    <li class="space">
                                    </li>
                                    <li class="space">
                                    </li>
                                    <li class="space">
                                    </li>
                                    <li class="filt-projects" >';
                                    if ($upper < $queryResult) {
                                        echo " <a class=pages href=?htype=".urlencode($htype)."&catSelect=".urlencode($filterCat)."&search=".urlencode($search)."&pagenum=".($_GET['pagenum']+1).">Next Page</a>";
                                    }
                                    echo '</li>
                                </ul>
                            </div>
                        </div>
                        <!-- filter project end -->';
                        //-----------------------------------------------------------------------------------------------------
                        echo '<div class="no-gutter onStep" data-animation="fadeInUp" data-time="600" id="projects-wrap">';
                        while ($row = mysqli_fetch_array($results)) {
                            if (isset($_SESSION['u_id'])) {
                            $uid = $_SESSION['u_id'];
                            }
                            //recipe_id
                            if ($htype == 'Recipes') {
                                $item_upc = $row['recipe_id'];
                                $item_name = $row['recipe_name'];
                                $link = '';
                            } else {
                                $item_upc = $row['item_upc'];
                                $item_name = $row['item_name'];
                                $link = $row['link'];
                            }

                            echo '
                            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 item pho pers">
                            <article>
                                <div class="post-image">';

                                if ($row['has_image'] == 1) {

                                    if (isset($_SESSION['u_id'])) {
                                        $filename = "img/".$item_upc."*";
                                        $fileinfo = glob($filename);
                                        $fileExt = explode(".", $fileinfo[0]);
                                        $fileActualExt = strtolower(end($fileExt));
                                        $fileResized = "img/resized_".$item_upc.".".$fileActualExt;
                                        if ($htype == 'Recipes') {
                                            echo "<a href=recipe_details.php?rid=".$item_upc.">";
                                        } else {
                                            echo "<a href=details.php?upc=".$item_upc.">";
                                        }
                                            echo "<img id=resultPhoto src=$fileResized alt=$item_name onerror=this.src='img/noimageavailable.png' class='img-responsive' style='margin: 0 auto; min-width:260px; min-height:260px;'>
                                            </a>";
                                    //} else {
                                    //    echo '<img alt="blog-img" class="img-responsive" src="img/blog/img1.jpg">';
                                    } 
                                } else {  
                                   
                                    if (isset($_SESSION['u_id'])) {
                                        if ($htype == 'Recipes') {
                                            echo "<a href=recipe_details.php?rid=".$item_upc.">";
                                        } else {
                                            echo "<a href=details.php?upc=".$item_upc.">";
                                        }

                                            echo "<img id=resultPhoto src='$link' alt=$item_name onerror=this.src='img/noimageavailable.png' class='img-responsive' style='margin: 0 auto;'>
                                            </a>";
                                    } else {
                                        echo '<a href=details.php?upc='.$item_upc.'>
                                        <img alt="product-img" class="img-responsive" src="img/noimageavailable.png" style="margin: 0 auto;">
                                        </a>';
                                    }
                                }

                                //echo"</div>";
                                // -- end of photo

                                echo '
                                    <div class="post-heading" style="min-height: 150px !important;">
                                        <h3>';
                                        if ($htype == 'Recipes') {
                                            echo "<a href=details.php?htype=".urlencode($htype)."&catSelect=".urlencode($filterCat)."&search=".urlencode($search)."&upc=".$item_upc.">
                                            ".$row['recipe_name']."</a>";
                                        } else {
                                            echo '<a href=details.php?upc='.$item_upc.'>
                                            '.$row['item_brand'].', '.$row['item_name'].'
                                            </a>';
                                        }
                                            

                                      echo '</h3>
                                    </div>
                                </div>';

                                $sql2 = "SELECT * FROM product_prices WHERE item_upc = $item_upc ORDER BY company_price ASC LIMIT 1";
                                $results2 = mysqli_query($conn, $sql2);
                                $queryResult2 = mysqli_num_rows($results2);
                                if ($queryResult2 > 0) {
                                while ($row2 = mysqli_fetch_array($results2)) {
                                    $price = $row2['company_price'];
                                    $measurement = $row2['measurement'];
                                    echo"<p id=resultPrice>From: $".$price."".$measurement."</p>";
                                    }
                                    } else if ($queryResult2 < 1) {
                                    $sqle = "SELECT * FROM price_estimate WHERE item_upc = $item_upc LIMIT 1";
                                    //echo $sqle;
                                    $resultse = mysqli_query($conn, $sqle);
                                    $queryResulte = mysqli_num_rows($resultse);
                                    if ($queryResulte > 0) {
                                    while ($rowe = mysqli_fetch_array($resultse)) {
                                        $price_estimate = $rowe['price_estimate']; 
                                        echo"<p id=resultPrice>Estimate: $".$price_estimate."</p>";
                                    }
                                    } else if ($queryResulte < 1) {
                                        echo"<p id=resultPrice>No Price Contributed</p>";
                                    }        
                                    }
                            
                            
                                echo"<form method='POST' action='includes/action.php'>
                                    <input type=hidden id=$item_upc name=upc value=$item_upc>
                                    <input type=hidden id=quantity name=quantity value=1>";
                                if (isset($_SESSION['u_id'])) {
                            $sql3 = "SELECT item_upc, item_quantity FROM grocery_lists WHERE item_upc = $item_upc AND user_id = ".$_SESSION['u_id']." LIMIT 1";
                                    $results3 = mysqli_query($conn, $sql3);
                                    $queryResult3 = mysqli_num_rows($results3);
                                    
                                    if ($queryResult3 > 0) {
                                    while ($row3 = mysqli_fetch_array($results3)) {
                                        $quantity = $row3['item_quantity'];
                                        echo "<button type=submit class='addButton btn btn-rounded btn-main' uid=".$uid." id=".$item_upc.">Add To List ($quantity in list)</button>"; 
                                    }
                                    } else if ($queryResult3 < 1) {
                                    echo"<button type=submit class='addButton btn btn-rounded btn-main' uid=".$uid." id=".$item_upc." style='width:99% !important;'>Add To List</button>";
                                    
                                    }
                                    } else {
                                     echo"<button class='btn btn-blcok btn-success' style='width:99% !important;'><a href='myaccount.php' >Log-in => Add To List</a></button>";   
                                    }
                                    
                        
                            echo"</form>";
                                


                            echo'
                            </article>
                        </div>';

                        }
                        echo '</div>';
                        //-----------------------------------------------------------------------------------------------------
                        echo '
                        <!-- filter project -->
                        <div class="onStep" data-animation="fadeInUp" data-time="900">
                            <div class="filter-wraper">
                                <ul id="filter-porto">

                                    <li class="filt-projects active">
                                    Page '.mysqli_real_escape_string($conn, $_GET['pagenum']).'-of-
                                    <a class=pages href=?htype='.urlencode($htype).'&catSelect='.urlencode($filterCat).'&search='.urlencode($search).'&pagenum='.$last.'> '.$last.'</a>';

                                    if ($lower > $page_rows) {
                                        echo "<a class=pages href=?htype=".urlencode($htype)."&catSelect=".urlencode($filterCat)."&search=".urlencode($search)."&pagenum=".($_GET['pagenum']-1).">Previous Page</a>";
                                    }
                                echo '</li>
                                    <li class="space">
                                    </li>
                                    <li class="space">
                                    </li>
                                    <li class="space">
                                    </li>
                                    <li class="filt-projects" >';
                                    if ($upper < $queryResult) {
                                        echo " <a class=pages href=?htype=".urlencode($htype)."&catSelect=".urlencode($filterCat)."&search=".urlencode($search)."&pagenum=".($_GET['pagenum']+1).">Next Page</a>";
                                    }
                                    echo '</li>
                                </ul>
                            </div>
                        </div>
                        <!-- filter project end -->';
                        //-----------------------------------------------------------------------------------------------------
                    } else if ($queryResult < 1){
                        
                        echo '<h3 class="onStep" data-animation="fadeInRight" data-time="0">Search Results!</h3>';
                        echo '<p class=searchResults>There are '.$queryResult.' search results for <b style="font-size:16px;color:red;">'.$search.'</b> in the <b style="font-size:16px;color:red;">'.$filterCat.'</b> category.</p>';

                       // echo "<h4 id=searchResults>There are $queryResult search results for ".$search." in the $filterCat category.</h4>";
                       
                    } else {
                                    echo '<h3 class="onStep" data-animation="fadeInRight" data-time="0">Search Results!</h3>';
                                    echo '<p class=searchResults>There are '.$queryResult.' search results for <b style="font-size:16px;color:red;">'.$search.'</b> in the <b style="font-size:16px;color:red;">'.$filterCat.'</> category.</p>';
                    }
                   
                }
                ?>

                

                <!-- spacer-->
                <div class="space-single">
                </div>
                <!-- spacer end -->
            </div>
            <!-- left content end -->

            <!-- right content -->
            <div class="col-md-3 col-sm-10 col-xs-11 pull-right" style="padding-left:10px; padding-right:15px;">
                
            <!-- <div class="space-single hidden-sm hidden-xs"></div> -->

                <aside class="onStep" data-animation="fadeInUp" data-time="600">

                    <!-- widget -->
                    <div class="widget">
                        <h5>
                            List Quick View
                        </h5>
                        <div class="space-single devider-widget" style="margin-top:-25px !important;">
                        </div>
                        <form method='POST' action='my_list.php'>
                            <button class='finalize btn btn-rounded btn-yellow'>Review List</button>
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
                    </div>
                    <!-- widget end -->

                    <!-- widget -->
                    <div class="widget">
                        <h5>
                            Tags
                        </h5>

                        <div class="space-single devider-widget">
                        </div>

                        <div class="tags">
                            <div>
                                <a href="#">Photography</a>
                            </div>

                            <div>
                                <a href="#">Trends</a>
                            </div>

                            <div>
                                <a href="#">Interactive</a>
                            </div>

                            <div>
                                <a href="#">Interior</a>
                            </div>

                            <div>
                                <a href="#">Responsive</a>
                            </div>

                            <div>
                                <a href="#">Creative</a>
                            </div>

                            <div>
                                <a href="#">Design</a>
                            </div>

                            <div>
                                <a href="#">website</a>
                            </div>

                            <div>
                                <a href="#">application</a>
                            </div>
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