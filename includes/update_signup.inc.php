<?php

if (isset($_POST['first_name'])) {
	
	include_once 'dbh.inc.php';

    $userid = mysqli_real_escape_string($conn, $_POST['hid']);
    $rcate = mysqli_real_escape_string($conn, $_POST['rcate']);
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
    //$vkey = date('m/d/Y h:i:s a', time()).$uid;
    //$hashVKey = password_hash($vkey, PASSWORD_DEFAULT);

    // //-----------------check if user already exists or not-----------------------------------------
    // $sql = "SELECT * FROM users WHERE user_uid='$uid'";
    // $result = mysqli_query($conn, $sql);
    // $resultCheck = mysqli_num_rows($result);

    // if ($resultCheck > 0) {
    //     //header("Location: ../signup.php?signupError=user_taken");
    //     echo 'userid alerady taken';
    //     exit();
    // } else {
        //Hashing the password
        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
        //Insert the user into the database
        //$sql = "INSERT INTO users (user_first, user_last, user_email, user_state, user_city, user_uid, user_pwd, vkey) VALUES ('$first', '$last', '$email', '$state', '$city', '$uid', '$hashedPwd', '$hashVKey');";

        $sql = "UPDATE users SET rcate='{$rcate}', ralergy='{$ralergy}', user_first='{$first}', user_last='{$last}', user_email='{$email}', user_state='{$state}',user_city='{$city}',user_uid='{$uid}',user_pwd='{$hashedPwd}' WHERE user_id = '$userid' ";

        //$insert = mysqli_query($conn, $sql);

        if (mysqli_query($conn, $sql)) {
            $to = $email;
            $subject = "GroceryHub.us - Account Update";
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
            
                        <h1>Welcome Back!</h1>
                        <p>We are so glad you have been using GroceryHub.us</p>
                        <p>It\'s just to remind you that your account has been updated.</p>
                        
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

            $headers = "From: GroceryHub <no_reply@groceryhub.us> \r\n";
            $headers .= "MIME-version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            //header("Location: ../thankyou.php?signup=success");
            echo '1';
            mail($to, $subject, $messagebody, $headers);
        }

        exit();
        //}
    



} else {
    echo 'Form Data has some errors! please update it later.';
	//header("Location: ../signup.php");
	exit();
}