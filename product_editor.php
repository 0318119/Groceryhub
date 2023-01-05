
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
                        Product Editor!

                        </div>
                    </div>
                    <!-- </div> -->
                </div>
                <div class="row">
                    <div class="no-gutter">


                        <!-- content right -->
                        <div class="col-md-12 onStep" data-animation="fadeInLeft" data-time="0" style="">
                            <!-- spacer -->
                            <!-- <div class="space-single hidden-sm hidden-xs"></div> -->
                            <div class="space-half"></div>
                            <!-- spacer end -->
                            

                                <div style="margin-bottom:15px !important;">
                                        <h5 style='text-transform: uppercase;'> Product Editor! </h5>
                                </div>

<?php

//catagory was here before

if (isset($_SESSION['u_id'])) {

    if (isset($_GET['productEditorCat']))   {
        $PECat = htmlspecialchars($_GET['productEditorCat']);
        $sql = "SELECT * FROM products LEFT OUTER JOIN product_photos ON products.item_upc = product_photos.upc WHERE products.item_cat = '$PECat' ORDER BY item_subcat";
    } else {
        $PECat = "Uncategorized";
       $sql = "SELECT * FROM products LEFT OUTER JOIN product_photos ON products.item_upc = product_photos.upc WHERE products.item_cat = 'Uncategorized' ORDER BY popularity DESC"; 
    }
    //Otherwise if a category was selected then the query only returns results matching the search term in the selected category. 
    $results = mysqli_query($conn, $sql);//execute query without limit to get total number of rows
    $queryResult = mysqli_num_rows($results);//total number of rows
    
    if ($queryResult > 0) {
        $page_rows = 24;//the page size (number of rows in each page)
        $last = ceil($queryResult/$page_rows);//total number of pages //use ceil to avoid fractions
        //Start of new pagination code
        if (isset($_GET['pagenum'])) {
            $pagenum = $_GET['pagenum'];//get the page number user want to view
        } else {
            $_GET['pagenum'] = 1;//if user hasn't given page number set page to page number 1
        }
        if ($_GET['pagenum'] < 2)  {  //if user gives negative page number. set page number to 1
        $_GET['pagenum'] = 1;  //this will happen if user clicked the Previous page link when current page is 1
        } else if ($_GET['pagenum'] >= $last) { //if page number is greater than calculated number of pages . set page number to last page
        $_GET['pagenum'] = $last;  //this will happen if user clicked the next page link when current page is the last page
        } else {
            $pagenum = 1;//if user hasn't given page number set page to page number 1
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
    echo "<div id='resultsHeader'>
    
            <p class='searchResults'>Showing results ".$lower." through ".$upper." of $queryResult for $PECat.</p>
            <div id='pagination'>             
                 <h6>Page ".mysqli_real_escape_string($conn, $_GET['pagenum'])."-of-</h6>
                 <a class=pages href=?productEditorCat=".urlencode($PECat)."&pagenum=".$last."> ".$last."</a>";
            if ($lower > $page_rows) {
                echo " <a class=pages href=?productEditorCat=".urlencode($PECat)."&pagenum=".(mysqli_real_escape_string($conn, $_GET['pagenum'])-1).">Prev</a>";
            }
        
            if ($upper < $queryResult) {
                echo " <a class='pages' href=?productEditorCat=".urlencode($PECat)."&pagenum=".(mysqli_real_escape_string($conn, $_GET['pagenum'])+1).">Next</a>";
            }
                 
             echo  "<br>
            </div>
            <br>
        </div>
        <div class='space-half'></div>
        ";
        //Runs a loop to display the search results and enters each one into its own box with picture, title, and an Add To List button.
        echo '
        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading">Product Catagory: 
            
            <form style="display:inline-block;">
            <select class="productEditorCatSelect" style="width:200px;" id=productEditorCat name=productEditorCat onchange="this.form.submit()">
                <option name=products value=Products>All Categories</option>';

            $sql2 = "SELECT cat_name FROM categories ORDER BY cat_name ASC";
            $results2 = mysqli_query($conn, $sql2);
            $queryResult2 = mysqli_num_rows($results2);
            if ($queryResult2 > 0) {
                while ($row2 = mysqli_fetch_array($results2)) {
                    $cat_name = htmlspecialchars($row2['cat_name']);
                    echo "<option name='$cat_name' value=\"$cat_name\">$cat_name</option>";
                }
            }

    echo '
            </select></form>
            </div>
            
            <div class="panel-body">
            <div class="table-responsive">
            ';

        echo"<table id='' class='table table-striped table-bordered table-condensed table-hover '>
            <thead class='thead-dark'>
                <tr>
                    <th>Photo</th>
                    <th>Title</th>
                    <th>UPC</th>
                    <th>Brand</th>
                    <th>Category</th>
                    <th>Sub-Cat</th>
                    <th>Net</th>
                    <th>Measure</th>
                    <th>Update</th>            
                </tr>
            </thead>
        ";
            
        while ($row = mysqli_fetch_array($results)) {
            $uid = $_SESSION['u_id'];
            $permissions_level = $_SESSION['perms'];
            $item_upc = $row['item_upc'];
            $item_name = $row['item_name'];
            $item_cat = $row['item_cat'];
            $item_subcat = $row['item_subcat'];
            $link = $row['link'];
            
        echo "<tr>
            <form method=POST action='includes/action.php'>";

                if ($row['has_image'] == 1) {
                    $filename = "img/".$item_upc."*";
                    $fileinfo = glob($filename);
                    $fileExt = explode(".", $fileinfo[0]);
                    $fileActualExt = strtolower(end($fileExt));
                    $file = "img/".$item_upc.".".$fileActualExt;
                    
                echo "<td>
                        <a href=details.php?upc=".$item_upc.">
                        <img id=resultPhoto-thumbnail src=$file alt=$item_name onerror=this.src='img/noimageavailable.png'>
                        </a>
                        </td>";
                        } else {
                echo "<td>
                        <a href=details.php?upc=".$item_upc.">
                        <img id=resultPhoto-thumbnail src='$link' alt=$item_name onerror=this.src='img/noimageavailable.png'>
                        </a>
                        </td>";
                        }
                   echo "<td>".$row['item_name']."</td>
                        <td><a href=details.php?upc=".$item_upc.">$item_upc</a></td>
                        <td>".$row['item_brand']."</td>
                        <td>";
                            if ($permissions_level > 6) {
                            echo " 
                            
                            <input type=hidden name='ic_upc' id='ic_upc' value='$item_upc'>
                            <select class='productEditorCatSelect' id=catSelect name=catSelect>
                            <option name='$item_cat' value='$item_cat'>$item_cat</option>";
                            $sql2 = "SELECT cat_name FROM categories ORDER BY cat_name ASC";
                            $results2 = mysqli_query($conn, $sql2);
                            $queryResult2 = mysqli_num_rows($results2);
                            if ($queryResult2 > 0) {
                                
                                while ($row2 = mysqli_fetch_array($results2)) {
                                    $cat_name = $row2['cat_name'];
                                echo "<option name='$cat_name' value='$cat_name'>$cat_name</option>";
                                }
                            }
                                echo"</select>";
                            }
                        echo "</td>
                        <td id='subcatTd'>";
                            if ($permissions_level > 6) {
                            echo " 
                            
                            
                            <input type=hidden name=isc_cat id=isc_cat value='$item_cat'>
                            <input type=hidden name=pagenum id=pagenum value=".$_GET['pagenum'].">
                            <select class='productEditorCatSelect' id=subCatSelect name=subCatSelect>
                            <option name='$item_subcat' value='$item_subcat'>$item_subcat</option>";
                            $sql3 = "SELECT * FROM sub_categories WHERE item_cat = '$item_cat' ORDER BY sub_cat ASC";
                            $results3 = mysqli_query($conn, $sql3);
                            $queryResult3 = mysqli_num_rows($results3);
                            if ($queryResult3 > 0) {
                                while ($row3 = mysqli_fetch_array($results3)) {
                                    $sub_cat = $row3['sub_cat'];
                                echo "<option name='$sub_cat' value='$sub_cat'>$sub_cat</option>";
                                }
                            }
                                echo"</select>";
                            }
                        echo "</td>
                        <td>
                        <input id=itemNet name=itemNet style='width:50px;' value=".$row['item_net'].">
                        </td>
                        <td>
                        <select class='productEditorCatSelect' id=measure name=measure>
                        <option name=".$row['measurement_type']." value=".$row['measurement_type'].">".$row['measurement_type']."</option>
                        <option name=ea value=ea>ea</option>
                        <option name=oz value=oz>oz</option>
                        <option name=lb value=lb>lb</option>
                        <option name='fl oz' value='fl oz'>fl oz</option>
                        <option name=g value=g>g</option>
                        <option name=kg value=kg>kg</option>
                        <option name=ml value=ml>ml</option>
                        <option name=L value=L>L</option>
                        </select>

                        </td>
                        
                        <input type=hidden name=productEditorUpc id=productEditorUpc value='$item_upc'>
                        <td><button class='btn btn-success' type='submit'>Update</button></td>
                        </form>
                </tr>";

            }
        echo "
        <tfoot class='thead-dark'>
                <tr>
                    <th>Photo</th>
                    <th>Title</th>
                    <th>UPC</th>
                    <th>Brand</th>
                    <th>Category</th>
                    <th>Sub-Cat</th>
                    <th>Net</th>
                    <th>Measure</th>
                    <th>Update</th>            
                </tr>
            </tfoot>
        </table>";
        echo '
            </div>
            </div>
            </div>
        
        ';
       /////////End of Table////////// 
        
        ///////Lower Pagination
        echo "<div id='resultsHeader'>
            <div id='pagination'>             
                 <h6>Page ".$_GET['pagenum']."-of-</h6>
                 <a class='pages' href=?productEditorCat=".urlencode($PECat)."&pagenum=".$last."> ".$last."</a>";
            if ($lower > $page_rows) {
                echo " <a class='pages' href=?productEditorCat=".urlencode($PECat)."&pagenum=".($_GET['pagenum']-1).">Prev</a>";
            }
        
            if ($upper < $queryResult) {
                echo " <a class='pages' href=?productEditorCat=".urlencode($PECat)."&pagenum=".($_GET['pagenum']+1).">Next</a>";
            }

             echo  "<br>
            </div>
            <br>
        </div>";
        } else if ($queryResult < 1){
        
        echo "<h4 id='searchResults'>There are $queryResult results in the \"Uncategorized\" Category.</h4>";
        
    } else {
        "<h4 id='searchResults'>There are $queryResult results in the \"Uncategorized\" Category.</h4>";
    }
    
}
?>
<!--</div>-->



                            </div>
                            <!-- wrapper -->
                            <!-- <div class="row"> -->
                            <!-- <div class="col-md-10 col-md-offset-1 col-sm-11 col-sm-offset-1 col-xs-11 col-xs-offset-1 pull-left"> -->

                           
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