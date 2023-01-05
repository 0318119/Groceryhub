<?php

if (isset($_POST['email_addressforgot'])) {
    
    require 'dbh.inc.php';
    
    $userEmail = mysqli_real_escape_string($conn, $_POST['email_addressforgot']);
        
    $select = bin2hex(random_bytes(8));
    $token = random_bytes(32);
    
    $url = "https://groceryhub.demo-lc.com/create_new_password.php?selector=" . $select . "&validator=" . bin2hex($token);
    
    $expires = date("U") + 1800;
    
    $sql = "DELETE FROM password_reset WHERE pwdResetEmail = ?";
    $stmt = mysqli_stmt_init($conn);
    
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "There was an error in database connection please try again later!";
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "s", $userEmail);
        mysqli_stmt_execute($stmt);
    }
    
    $sql2 = "INSERT INTO password_reset (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires) VALUES (?, ?, ?, ?)";
    $stmt2 = mysqli_stmt_init($conn);
    
    if (!mysqli_stmt_prepare($stmt2, $sql2)) {
        //header("Location: ../forgot_password.php?email=Error");
        echo 'Error Occurred in Database!';
        exit();
    } else {
        $hashedToken = password_hash($token, PASSWORD_DEFAULT);
        mysqli_stmt_bind_param($stmt2, "ssss", $userEmail, $select, $hashedToken, $expires);
        mysqli_stmt_execute($stmt2);
    }
    
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    
    $to = $userEmail;
    $subject = "Reset Your Password For GroceryHub";
    //$message = "<p>We recieved a request to reset your password. The link to reset your password is below. If you did not make this request then you can ignor this message.</p><br><br><a class='addButton' href=" . $url . ">Click here to reset your password</a>";
    $headers = "From: GroceryHub <no_reply@groceryhub.us> \r\n";
    $headers .= "MIME-version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $messagebody = '
            <!DOCTYPE html>
            <html lang="en">
            <head></head>
            <body style="font-family: Verdana, Geneva, Tahoma, sans-serif; background-color: #f0ffff;">
            <table style="margin-top:50px; border-collapse: collapse; width:65%;margin-left: auto;margin-right: auto;">
                <tr>
                    <td style="height: 150px; text-align:center;"><img src="https://groceryhub.demo-lc.com/img/grocery_logo-03.png" alt="GroceryHub"></td>
                </tr>
                <tr>
                    <td style="border: 1px solid #efefef;padding:45px; background-color: #fff; color:#333;">
            
                        <h1>Forget Password!</h1>
                        <p>We recieved a request to reset your password. The link to reset your password is below. If you did not make this request then you can ignor this message.</p>
                        <p>Click this <a href="'.$url.'">link</a> or click the below button to reset your account password!</p>
            
                        <p>
                        <table width="100%" cellspacing="0" cellpadding="0">
                            <tr>
                                <td>
                                    <table cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td style="border-radius: 2px;" bgcolor="#ED2939">
                                                <a href="'.$url.'" target="_blank" style="padding: 8px 12px; border: 1px solid #ED2939;border-radius: 2px;font-family: Helvetica, Arial, sans-serif;font-size: 14px; color: #ffffff;text-decoration: none;font-weight:bold;display: inline-block;">
                                                Reset Your Account Password!
                                                </a>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                        </p>
                        
                        
                        <p>If you have any questions, feel free to email our customer success team. (We are lightning quick at replying.)</p>
                        <p>Talk soon,<br><br>
                            <b>SiteAdmin</b><br>
                            Founder, <span style="color: #338708;">GruceryHub.us</span><br>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td style="height: 70px; text-align:center;">&#169; 2021 <a href="https://groceryhub.us/" target="_blank">GroceryHub</a>. All Rights Reserved.</td>
                </tr>
            </body>
            </html>';
    echo '1';
    //mail($to, $subject, $message, $headers);
    mail($to, $subject, $messagebody, $headers);
    
    //header("Location: ../forgot_password.php?reset=success");
        
} else {
    
    echo 'Nothing Happend Please make sure the email id would be valid!';
    exit();
    }
