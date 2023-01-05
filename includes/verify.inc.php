<?php
	
	

if (isset($_GET['vkey'])) {
    
    include_once 'dbh.inc.php';
    
    $vkey = mysqli_real_escape_string($conn, $_GET['vkey']);
    
    $sql = "SELECT vkey, verified FROM users WHERE vkey = '$vkey' AND verified = '0' LIMIT 1";
    $results = mysqli_query($conn, $sql);
    $queryResult = mysqli_num_rows($results);
    
    if ($queryResult > 0) {
        $sql2 = "UPDATE users SET verified = 1 WHERE vkey = '$vkey' AND verified = 0";
        mysqli_query($conn, $sql2);
        header("Location: ../login.php?verified=complete");
        exit();
    }
}