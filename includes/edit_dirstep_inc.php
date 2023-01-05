<?php
//session_start();
include_once 'dbh.inc.php';

if ( isset($_GET['did']) ) {
    $directions_id = $_GET['did'];

    $sql = "SELECT * FROM recipe_directions WHERE directions_id=".$directions_id;
    //echo "<h1>".$sql."</h1>";
    $results = mysqli_query($conn, $sql);
    $queryResults = mysqli_num_rows($results);
    if ($queryResults > 0) {
        $row = mysqli_fetch_array($results);
        $dstep = $row['directions_step'];
        $dtext = $row['directions_text'];
        $did = $row['directions_id'];      
    }

}
?>

<div class="form-group">
    <label for="dstep">Step Number</label>
    <input type="text" class="form-control" id="dstep" name="dstep" aria-describedby="dstep" value="<?php echo $dstep; ?>" readonly>
</div>
<div class="form-group nopadding">
    <label for="dtext">Direction of the Step!</label>
    <textarea class="form-control" cols="45" rows="8" id='dtext' name='dtext' placeholder='Enter Directions for This Step...' ><?php echo $dtext; ?></textarea>
</div>

<div class="form-group">
    <input type="text" id="directions_hid" name="directions_hid" value="<?php echo $did; ?>" >
</div>