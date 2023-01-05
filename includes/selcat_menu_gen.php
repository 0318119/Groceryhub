<?php 
include_once 'dbh.inc.php';

if ( $_GET['id'] == '1' ) {
    $sql = "SELECT cat_name FROM categories ORDER BY cat_name ASC";
} else {
    $sql = "SELECT cat_name FROM categories WHERE isrecipe=1 ORDER BY cat_name ASC";
}



    $results = mysqli_query($conn, $sql);
    $queryResult = mysqli_num_rows($results);
    if ($queryResult > 0) {
        while ($row = mysqli_fetch_array($results)) {
            $cat_name = $row['cat_name'];
            echo "<option class=catSelectOption name='$cat_name' value='$cat_name'>$cat_name</option>\n";
            }
        }

?>