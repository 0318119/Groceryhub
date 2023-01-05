<?php
//session_start();
include_once 'dbh.inc.php';

if ( isset($_GET['rid']) ) {
    $ingredient_id = $_GET['rid'];

    $sql = "SELECT * FROM recipe_ingredients WHERE ingredient_id=".$ingredient_id;
    //echo "<h1>".$sql."</h1>";
    $results = mysqli_query($conn, $sql);
    $queryResults = mysqli_num_rows($results);
    if ($queryResults > 0) {
        $row = mysqli_fetch_array($results);
        $ingredient_name = $row['ingredient_name'];
        $preferred_upc = $row['preferred_upc'];
        $preferred_item = $row['preferred_item'];
        $ingredient_cat = $row['ingredient_cat'];
        $ingredient_qty = $row['ingredient_qty'];
        $measurement_type = $row['measurement_type'];
        
    }

}


?>

<div class="form-group">
    <label for="iname">Ingredient Name </label>
    <input type="text" class="form-control" id="iname" name="iname" aria-describedby="iname" placeholder="Enter Ingredient Name" value="<?php echo $ingredient_name; ?>" >
</div>
<div class="form-group">
    <label for="iname">Preferred Exact Ingredient Name</label>
    <input type="text" class="form-control" id="ingredientsearchinput" name="ingredientsearchinput" aria-describedby="iname" placeholder="Auto Suggestions Comming up when type!" autocomplete="off" value="<?php echo $preferred_item; ?>">
    <div class='ingredientSearchList'>
        <ul>
        </ul>
    </div>
</div>
<div class="form-group">
    <label for="iqty">Item UPC</label>
    <input type="text" class="form-control" id="ingredient-upc" name="ingredient-upc" aria-describedby="ingredient-upc" value="<?php echo $preferred_upc; ?>" readonly >
</div>
<div class="form-group">
    <label for="ingredient-cat">Ingredient Category</label>
    <input type='text' class="form-control" id=ingredient-catt name=ingredient-catt value="<?php echo $ingredient_cat; ?>" readonly >
</div>

<div class="form-group">
    <label for="iqty">Quantity</label>
    <input type="text" class="form-control" id="iqty" name="iqty" aria-describedby="iqty" placeholder="Enter Quantity" value="<?php echo $ingredient_qty; ?>" >
</div>

<div class="form-group">
    <label for="iname">Measurement</label>
    <select class="form-control form-control-lg" id="measurementSelectt" name="measurementSelectt" >
        <?php 
        
        if ($measurement_type == 'count' ) {
            echo "<option name=count value=count selected>Count (ct)</option>";
        } else {
            echo "<option name=count value=count>Count (ct)</option>";
        }
        
        if ($measurement_type == 'ounces' ) {
            echo "<option name=ounces value=ounces selected>Ounces (oz)</option>";
        } else {
            echo "<option name=ounces value=ounces>Ounces (oz)</option>";
        }
        
        if ($measurement_type == 'pounds' ) {
            echo "<option name=pounds value=pounds selected>Pounds (lb)</option>>";
        } else {
            echo "<option name=pounds value=pounds>Pounds (lb)</option>";
        }
        
        if ($measurement_type == 'flOunces' ) {
            echo "<option name=flOunces value='fl ounces' ounces selected>Fuild Ounces (fl oz)</option>";
        } else {
            echo "<option name=flOunces value='fl ounces' ounces>Fuild Ounces (fl oz)</option>";
        }

        if ($measurement_type == 'cup' ) {
            echo "<option name=cup value=cup selected>Cup (c)</option>";
        } else {
            echo "<option name=cup value=cup>Cup (c)</option>";
        }

        if ($measurement_type == 'quarts' ) {
            echo "<option name=quarts value=quarts selected>Quarts (qt)</option>";
        } else {
            echo "<option name=quarts value=quarts>Quarts (qt)</option>";
        }

        if ($measurement_type == 'gallons' ) {
            echo "<option name=quarts value=quarts selected>Quarts (qt)</option>";
        } else {
            echo "<option name=quarts value=quarts>Quarts (qt)</option>";
        }

        if ($measurement_type == 'grams' ) {
            echo "<option name=grams value=grams selected>Grams (g)</option>";
        } else {
            echo "<option name=grams value=grams>Grams (g)</option>";
        }


        ?>
        

    </select>
</div>

<div class="form-group">
    <input type="hidden" id="ingredient_hid" name="ingredient_hid" value="<?php echo $ingredient_id; ?>" >
</div>