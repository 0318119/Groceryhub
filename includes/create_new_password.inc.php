<?php




if (isset($_POST['selector'])) {
    
    require 'dbh.inc.php';
    
    //$userEmail = mysqli_real_escape_string($conn, $_POST['email']);
    $select = mysqli_real_escape_string($conn, $_POST['selector']);
    $validator = mysqli_real_escape_string($conn, $_POST['validator']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $passwordRepeat = mysqli_real_escape_string($conn, $_POST['passwordRepeat']);
    
    if(empty($password) || empty($passwordRepeat)) {
        header("Location: ../create_new_password.php?error=Password_Empty");
        exit();
    } else if ($password != $passwordRepeat){
        header("Location: ../create_new_password.php?error=Passwords_Do_Not_Match");
        exit();
    }
    
    $currentDate = date("U");
    
    $sql = "SELECT * FROM password_reset WHERE pwdResetSelector = ? AND pwdResetExpires >= ?";
    $stmt = mysqli_stmt_init($conn);
    
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "There was an error: 1.";
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "ss", $select, $currentDate);
        mysqli_stmt_execute($stmt);
        
        $result = mysqli_stmt_get_result($stmt);
        
        if (!$row = mysqli_fetch_assoc($result)) {
            echo "Error. Please re-submit your reset request.";
            exit();
        } else {
            
            $tokenBin = hex2bin($validator);
            $tokenCheck = password_verify($tokenBin, $row['pwdResetToken']);
            
            if ($tokenCheck === FALSE) {
                echo "Error. Please re-submit your reset request.";
                exit();
            } elseif ($tokenCheck === TRUE) {
                
                $tokenEmail = $row['pwdResetEmail'];
                
                $sql = "SELECT * FROM users WHERE `user_email` = ?";
                $stmt = mysqli_stmt_init($conn);
    
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    echo "There was an error: 2.";
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
                    mysqli_stmt_execute($stmt);
                    
                    $result = mysqli_stmt_get_result($stmt);
                    
                    if (!$row = mysqli_fetch_assoc($result)) {
                        echo "Error.";
                        exit();
                    } else {
                        $sql = "UPDATE users SET `user_password` = ? WHERE `user_email` = ?";
                        $stmt = mysqli_stmt_init($conn);
    
                        // if (!mysqli_stmt_prepare($stmt, $sql)) {
                        //     echo "There was an error: 3.";
                        //     exit();
                        // } else {
                            $newPwdHash = password_hash($password, PASSWORD_DEFAULT);
                            mysqli_stmt_bind_param($stmt, "ss", $newPwdHash, $tokenEmail);
                            mysqli_stmt_execute($stmt);
                            
                            $sql = "DELETE FROM `password_reset` WHERE `pwdResetEmail` = ?";
                            $stmt = mysqli_stmt_init($conn);

                            // if (!mysqli_stmt_prepare($stmt, $sql)) {
                            //     echo "There was an error: 4.";
                            //     exit();
                            // } else {
                                mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
                                mysqli_stmt_execute($stmt);
                                header("Location: ../create_new_password.php?reset=success");
                            //}
                        //}
                    }
                }
            }
        } 
    
    header("Location: ../index.php");
    exit();
    }
}