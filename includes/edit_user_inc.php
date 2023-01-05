<?php
//session_start();
include_once 'dbh.inc.php';

if ( isset($_GET['uid']) ) {
    $uid = $_GET['uid'];

    $sql = "SELECT * FROM users WHERE user_id=".$uid;
    //echo "<h1>".$sql."</h1>";
    $results = mysqli_query($conn, $sql);
    $queryResults = mysqli_num_rows($results);
    if ($queryResults > 0) {
        $row = mysqli_fetch_array($results);
        $permissions_level = $row['permissions_level'] * 1;
        $verified = $row['verified'] * 1;
        $hid = $row['user_id'];
        
    }

}


?>

<div class="form-group">
    <label for="plevel">Permission Level 
    <?php 
    
    if ($permissions_level == 9 ) {
        echo '<br><input type="radio" name="plevel" id="plevel" value="9"  checked> Administrator';
        echo '<br><input type="radio" name="plevel" id="plevel" value="0" > Standard Web User';
    } else {
        echo '<br><input type="radio" name="plevel" id="plevel" value="9" > Administrator';
        echo '<br><input type="radio" name="plevel" id="plevel" value="0" checked> Standard Web User';
        
    }

    ?>
    </label>    
</div>
<div class="form-group">
    <label for="iname">Account Verified?</label>
    
    <?php 
    
    if ($verified == 1 ) {
        echo '<br><input type="checkbox" name="verified" id="verified" value="0" checked> Verified!';      
    } else {
        echo '<br><input type="checkbox" name="verified" id="verified" value="1" > Not Verified!';
    }

    ?>   
     
    </div>
</div>



</div>

<div class="form-group">
    <input type="hidden" id="hid" name="hid" value="<?php echo $hid; ?>" >
</div>