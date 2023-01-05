<?php //$rid=$_GET['rid']; 
    if ( isset($_GET['rid']) ) {
        $myid = $_GET['rid'];
        include_once 'includes/dbh.inc.php';
    }
    
?>

<div id="ilistshow" style="margin:0px;">
    <table class='table table-hover'>
        <thead>
            <tr>
                <th>S.No.</th>
                <th>Ingredient Details</th>
                <!-- <th>Quantity</th>
                <th>Measurement</th> 
                <th>Category</th>-->
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            
            <?php

            $sql = "SELECT a.*, b.user_id FROM recipe_ingredients AS a, recipes AS b WHERE a.recipe_id = b.recipe_id AND a.recipe_id=".$myid;
            //echo "<h1>".$sql."</h1>";
            $results = mysqli_query($conn, $sql);
            $queryResults = mysqli_num_rows($results);
            if ($queryResults > 0) {
                //$row = mysqli_fetch_array($results);
                $nrow = 0;
                while($row=mysqli_fetch_array($results))
                { 
                    $nrow++;
                    echo '<tr>';
                    echo '<td>';
                    echo $nrow;
                    echo '</td>';
                                       
                    echo '<td>';
                    echo $row['ingredient_name'].'<br>';
                    echo '<br>'.$row['preferred_item'];
                    echo '<br>Quantity&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : '.$row['ingredient_qty'];
                    echo '<br>Measurement : '.$row['measurement_type'];
                    echo '<br>Category&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : '.$row['ingredient_cat'];
                    echo '</td>';

                    // echo '<td>';
                    // echo $row['ingredient_qty'];
                    // echo '</td>';
                                        
                    // echo '<td>';
                    // echo $row['measurement_type'];
                    // echo '</td>';
                                       
                    // echo '<td>';
                    // echo $row['ingredient_cat'];
                    // echo '</td>';  data-upc= data-iqty= data-userid= 

                    echo '<td style=""width:100px;>';
                    echo '<button class="btn btn-sm btn-warning" style="display: inline-block;" onclick="editMe('.$row['ingredient_id'].');" >Edit</button>&nbsp;';
                    echo '<button onclick="deleteMe('.$row['ingredient_id'].');" data-ingnam="'.$row['preferred_item'].'" class="btn btn-sm btn-danger" style="display: inline-block;">Del</button>';
                    //echo '<button onclick=addtoList("'.$row['preferred_upc'].'","'.$row['ingredient_qty'].'","'.$row['user_id'].'"); class="btn btn-sm btn-success" style="display: block;margin-top:10px !important;">Add to List</button>';
                    echo '</td>';

                    echo '</tr>';
                    
                }
            } else {
                echo '
                <tr>
                    <td colspan="5">No Ingredient Yet!</td>
                </tr>
                ';
            }
                //echo $myid.' -> '.rand(1000,500);
//echo rand(1000,500);
                
?>
     
        </tbody>
    </table>
    
</div>
