<?php //$rid=$_GET['rid']; 
    if ( isset($_GET['rid']) ) {
        $myyidd = $_GET['rid'];
        include_once 'includes/dbh.inc.php';
    }

    
?>

<div id="ilistshow33" style="margin:0px;">
    <table class='table table-bordered'>
        <tbody>
            
            <?php
            $sql3 = "SELECT * FROM recipes WHERE recipe_id=".$myyidd;
            //echo "<h1>".$sql."</h1>";
            $results3 = mysqli_query($conn, $sql3);
            $queryResults3 = mysqli_num_rows($results3);
            if ($queryResults3 > 0) {
                $row3=mysqli_fetch_array($results3);
                //$nrow2 = 0;
                //while()
                //{ 
                    //$nrow2++;
                    
                    echo '<tr>';
                    echo '<td style="background-color:#333;"><h6 style="color:#ffffff !important;">Picture</h6>';
                    echo '</td>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<td class="vcenter">';
                    //echo $nrow;
                    if ($row3['haspic']!="") {
                        echo '<img class="img-thumbnail" src="img/recipes/'.$row3['haspic'].'" alt='.$row3['recipe_name'].'  onerror=this.src="img/noimageavailable.png" /><br>';
                    } else {
                        echo '<img class="thumb" src="img/noimageavailable.png" alt='.$row3['recipe_name'].'  /><br>';                        
                    }
                    echo '</td>';
                    echo '</tr>';
                    
                    echo '<tr>';
                    echo '<td class="vcenter" style="background-color:#efefef;">';
                    echo '<button id="uploadPicture" data-rid="'.$row3['recipe_id'].'" class="btn btn-lg btn-warning center" style="">Upload New Picture</button>&nbsp;';
                    echo '<div class="alert alert-danger" id="error-alert3" style="display:none;margin-top:15px;"></div>';
                    echo '</td>';
                    echo '</tr>';

                    
                    echo '<tr>';
                    echo '<td style="background-color:#333;"><h6 style="color:#ffffff !important;">Video</h6>';
                    echo '</td>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<td class="vcenter">';
                    if ($row3['hasvid']!="") {
                        echo '
                        <div align="center" class="embed-responsive embed-responsive-16by9">
                            <video 
                            onmouseover="dataset.over=true;controls=true" 
                            onmouseout="delete dataset.over;if(paused)controls=false;"
                            class="embed-responsive-item" 
                            onplay="controls=true"
                            >
                                <source src="img/recipes/'.$row3['hasvid'].'" type="video/mp4" onerror=this.src="img/noimageavailable.png" >
                            </video>
                        </div>';

                    } else {
                        echo '<img class="thumbs" src="img/noimageavailable.png" alt='.$row3['recipe_name'].'  /><br>';                        
                    }
                    echo '</td>';
                    echo '</tr>';                   

                    echo '<tr>';
                    echo '<td class="vcenter" style="background-color: #efefef; text-algin:center;">';
                    echo '<button id="uploadVideo" data-rid="'.$row3['recipe_id'].'" class="btn btn-lg btn-justified btn-warning center" style="" >Upload New Video</button>&nbsp;';
                    echo '<div class="alert alert-danger" id="error-alert33" style="display:none;margin-top:15px;"></div>';
                    echo '</td>';
                    echo '</tr>';
                    
                //}
            } else {
                echo '
                <tr>
                    <td colspan="5">Nothing Defined Yet!</td>
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
