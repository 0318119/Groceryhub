<?php

include_once 'dbh.inc.php';

if ( isset($_POST['huid']) ) {

        $rcate = mysqli_real_escape_string($conn, $_POST['rcate']);
        $ralergy = implode(', ', (array)$_POST['ralergy']);
        $first = mysqli_real_escape_string($conn, $_POST['first_name']);
        $last = mysqli_real_escape_string($conn, $_POST['last_name']);
        //$email = mysqli_real_escape_string($conn, $_POST['email_book']);
        $state = mysqli_real_escape_string($conn, $_POST['state']);
        $city = mysqli_real_escape_string($conn, $_POST['city']);
        $uid = mysqli_real_escape_string($conn, $_POST['huid']);
        $uid = $uid * 1 ;
        //$pwd = mysqli_real_escape_string($conn, $_POST['password']);
        
        $sqlll = "UPDATE `users` SET `user_first` = '$first', `user_last` = '$last', `user_state` = '$state', `user_city` = '$city', `rcate` = '$rcate', `ralergy` = '$ralergy' WHERE `user_id`=" .$uid." ;";
        //echo $sqlll;
        if (mysqli_query($conn, $sqlll)) {
            echo '1';
            exit();
        } else {
            echo 'Error!';
        }

} else {



    if (isset($_POST['first_name'])) {
        
        $rcate = mysqli_real_escape_string($conn, $_POST['mcate']);
        //$ralergy = implode (',', $_POST['ralergy']);
        $ralergy = implode(', ', (array)$_POST['ralergy']);
        $first = mysqli_real_escape_string($conn, $_POST['first_name']);
        $last = mysqli_real_escape_string($conn, $_POST['last_name']);
        $email = mysqli_real_escape_string($conn, $_POST['email_book']);
        $state = mysqli_real_escape_string($conn, $_POST['state']);
        $city = mysqli_real_escape_string($conn, $_POST['city']);
        $uid = mysqli_real_escape_string($conn, $_POST['username']);
        $pwd = mysqli_real_escape_string($conn, $_POST['password']);
        //$pwd2 = mysqli_real_escape_string($conn, $_POST['password2']);
        $vkey = date('m/d/Y h:i:s a', time()).$uid;
        $hashVKey = password_hash($vkey, PASSWORD_DEFAULT);

        //-----------------check if user already exists or not-----------------------------------------
        $sql = "SELECT * FROM users WHERE user_uid='$uid'";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);

        if ($resultCheck > 0) {
            //header("Location: ../signup.php?signupError=user_taken");
            echo 'username alerady taken!';
            exit();
        } else {
            //Hashing the password
            $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
            //Insert the user into the database
            //$sql = "INSERT INTO users (user_first, user_last, user_email, user_state, user_city, user_uid, user_pwd, vkey) VALUES ('$first', '$last', '$email', '$state', '$city', '$uid', '$hashedPwd', '$hashVKey');";
            $sql = "INSERT INTO users (user_first, user_last, user_email, user_state, user_city, user_uid, user_pwd, vkey, rcate, ralergy) VALUES ('$first', '$last', '$email', '$state', '$city', '$uid', '$hashedPwd', '$hashVKey', '$rcate', '$ralergy');";
            //$insert = mysqli_query($conn, $sql);

            if (mysqli_query($conn, $sql)) {
                //send varification email
                $to = $email;
                $subject = "GroceryHub.us - Email Verification";
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
                
                            <h1>Welcome !</h1>
                            <p>We are so glad you decided to give GroceryHub.us a try.</p>
                            <p>Click this <a href="https://groceryhub.demo-lc.com/includes/verify.inc.php?vkey='.$hashVKey.'">link</a> or click the below button to verify your account!</p>
                
                            <p>
                            <table width="100%" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td>
                                        <table cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td style="border-radius: 2px;" bgcolor="#ED2939">
                                                    <a href="https://groceryhub.demo-lc.com/includes/verify.inc.php?vkey='.$hashVKey.'" target="_blank" style="padding: 8px 12px; border: 1px solid #ED2939;border-radius: 2px;font-family: Helvetica, Arial, sans-serif;font-size: 14px; color: #ffffff;text-decoration: none;font-weight:bold;display: inline-block;">
                                                    Verify Your Account            
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
                                <b>Michael E Davis</b><br>
                                Founder, <span style="color: #338708;">GruceryHub.us</span><br>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style="height: 70px; text-align:center;">&#169; 2021 <a href="https://groceryhub.us/" target="_blank">GroceryHub</a>. All Rights Reserved.</td>
                    </tr>
                </body>
                </html>';

                //$message = "<a href='https://groceryhub.demo-lc.com/includes/verify.inc.php?vkey=".$hashVKey."'>Click this link to verify your account!</a>";
                $headers = "From: GroceryHub <no_reply@groceryhub.us> \r\n";
                $headers .= "MIME-version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                //header("Location: ../thankyou.php?signup=success");
                echo '1';
                mail($to, $subject, $messagebody, $headers);
            }


            exit();
            }
        

        //Error handlers
        //Check for empty fields
        // if (empty($first) || empty($last) || empty($email) || empty($uid) || empty($pwd)) {
        // 	header("Location: ../signup.php?first=$first&last=$last&email=$email&state=$state&city=$city&userid=$uid&password=$hashedPwd");
        // 	exit();
        // } else {
        // 	//Check if input characters are valid
        // 	if (!preg_match("/^[a-zA-Z]*$/", $first) || !preg_match("/^[a-zA-Z]*$/", $last)) {
        // 		header("Location: ../signup.php?signupError=invalid");
        // 		exit();
        // 	} else {
        //         //Check that both passwords entered are the same
        //         if ($pwd2 !=$pwd) {
        //             header("Location: ../signup.php?signupError=passwords_do_not_match");
        // 		     exit();
        //         } else {
        //         //Check if email is valid
        //         if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        //             header("Location: ../signup.php?signupError=invalid_email");
        //             exit();
        //         } else {

        //             }
        //         }
        //     }
        // }

    } else {
        echo 'something happen!';
        //header("Location: ../signup.php");
        exit();
    }
}