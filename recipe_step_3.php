<?php //$rid=$_GET['rid']; 
    if ( isset($_GET['rid']) ) {
        $myyid = $_GET['rid'];
        include_once 'includes/dbh.inc.php';
    }

    function get_snippet( $str, $wordCount = 10 ) {
        return implode( 
          '', 
          array_slice( 
            preg_split(
              '/([\s,\.;\?\!]+)/', 
              $str, 
              $wordCount*2+1, 
              PREG_SPLIT_DELIM_CAPTURE
            ),
            0,
            $wordCount*2-1
          )
        );
      }
?>

<div id="ilistshow22" style="margin:0px;">
    <table class='table table-hover'>
        <thead>
            <tr>
                <th>Step #</th>
                <th>Direction Details</th>
                <!-- <th>Quantity</th>
                <th>Measurement</th> 
                <th>Category</th>-->
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            
            <?php
            $sql2 = "SELECT * FROM recipe_directions WHERE recipe_id=".$myyid." ORDER BY directions_step asc";
            //echo "<h1>".$sql."</h1>";
            $results2 = mysqli_query($conn, $sql2);
            $queryResults2 = mysqli_num_rows($results2);
            if ($queryResults2 > 0) {
                //$row2 = mysqli_fetch_array($results2);
                $nrow2 = 0;
                while($row2=mysqli_fetch_array($results2))
                { 
                    //$nrow2++;
                    echo '<tr>';
                    echo '<td>';
                    //echo $nrow;
                    echo $row2['directions_step'].'<br>';
                    echo '</td>';
                                       
                    echo '<td>';
                    echo get_snippet($row2['directions_text'], 5).' ...';
                    echo '</td>';
                                       
                    // echo '<td>';
                    // echo $row['ingredient_qty'];
                    // echo '</td>';
                                        
                    // echo '<td>';
                    // echo $row['measurement_type'];
                    // echo '</td>';
                                       
                    // echo '<td>';
                    // echo $row['ingredient_cat'];
                    // echo '</td>';

                    echo '<td style=""width:100px;>';
                    echo '<button class="btn btn-sm btn-warning" style="display: inline-block;" onclick="editMeStep('.$row2['directions_id'].');" >Edit</button>&nbsp;';
                    echo '<button onclick="deleteMeStep('.$row2['directions_id'].');" data-steps="'.$row2['directions_text'].'" class="btn btn-sm btn-danger" style="display: inline-block;">Del</button>';
                    echo '</td>';

                    echo '</tr>';
                    
                }
            } else {
                echo '
                <tr>
                    <td colspan="5">No Steps Defined Yet!</td>
                </tr>
                ';
            }
                //echo $myid.' -> '.rand(1000,500);
//echo rand(1000,500);
                
?>
     
        </tbody>
    </table>
    <input type="hidden" id="hid_laststep" value="<?php echo $queryResults2; ?>" >
</div>
