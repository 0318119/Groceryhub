<?php

if (isset($_POST['submitItem'])) {
	
	include_once 'dbh.inc.php';

	$iupc = mysqli_real_escape_string($conn, $_POST['iupc']);
    $igtin = mysqli_real_escape_string($conn, $_POST['igtin']);
	$ibrand = mysqli_real_escape_string($conn, $_POST['ibrand']);
    $imanufac = mysqli_real_escape_string($conn, $_POST['imanufacturer']);
	$iname = mysqli_real_escape_string($conn, $_POST['iname']);
	$inet = mysqli_real_escape_string($conn, $_POST['inet']);
    $mtype = mysqli_real_escape_string($conn, $_POST['measurementSelect']);
    $icat = mysqli_real_escape_string($conn, $_POST['ingredient-cat']);
    

	//Error handlers
	//Check for empty fields
	if (empty($iupc) || empty($ibrand) || empty($iname) ||  empty($inet) || empty($mtype)) {
		header("Location: ../enterprice.php?field=empty");
		exit();
	} else {
			//Check if iname is valid
        $sql = "SELECT * FROM products WHERE item_upc='$iupc'";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
				if ($resultCheck > 0) {
					header("Location: ../enterprice.php?enterprice=item-already-exists");
					exit();
				} else {
					//Insert the item into the database
					$sql = "INSERT INTO products (item_upc, item_gtin, item_brand, item_manufacturer, item_name, item_cat, item_net, measurement_type) VALUES ('{$iupc}', '{$igtin}', '{$ibrand}', '{$imanufac}', '{$iname}', '{$icat}', '{$inet}', '{$mtype}');";
					mysqli_query($conn, $sql);
					header("Location: ../enterprice.php?entry=success");
                    exit();
				}
			}
		} else {
	header("Location: ../enterprice.php");
	exit();
}