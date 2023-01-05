<?php

session_start();

// if (isset($_POST['submit'])) {
	
	include 'dbh.inc.php';

	$uid = mysqli_real_escape_string($conn, $_POST['uid']);
	$pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
	//$pwd = htmlentities(md5($_POST['pwd']));
     
	//Error handlers
	//Check if inputs are empty
	// if (empty($uid) || empty($pwd)) {
	// 	header("Location: ../login.php?login=Inputs_Empty");
	// 	exit();
	// } else {
		$sql = "SELECT * FROM users WHERE user_uid='$uid' OR user_email='$uid'";
		$result = mysqli_query($conn, $sql);
		$resultCheck = mysqli_num_rows($result);
		if ($resultCheck < 1) {
			//header("Location: ../login.php?login=User_Not_Found");
			echo 'User Not Found!';
			exit();
		} else {
             
			if ($row = mysqli_fetch_assoc($result)) {
				//De-hashing the password
				$hashedPwdCheck = password_verify($pwd, $row['user_pwd']);
				

                $verified = $row['verified'];
				if ($hashedPwdCheck == false) {
					//header("Location: ../login.php?login=Username_or_Password_Incorrect");
					echo 'Username or Password Incorrect!';
					exit();
				} else if ($hashedPwdCheck == true && $verified == '0') {
                    //header("Location: ../login.php?login=Email_Account_Not_Verified");
					echo 'Email Account Not Verified!';
					exit();
                } else if ($hashedPwdCheck == true && $verified == '1') {
					//Log in the user here
					$_SESSION['u_id'] = $row['user_id'];
					$_SESSION['u_first'] = $row['user_first'];
					$_SESSION['u_last'] = $row['user_last'];
					$_SESSION['u_email'] = $row['user_email'];
					$_SESSION['u_uid'] = $row['user_uid'];
                    $_SESSION['perms'] = $row['permissions_level'];
                    $_SESSION['state'] = $row['user_state'];
                    $_SESSION['city'] = $row['user_city'];
                    //$_SESSION['household_size'] = $row['household_size'];
					//header("Location: ../index.php?login=success");
					echo '1';
					exit();
				}
			}
		}
	//}
// } else {
// 	header("Location: ../index.php?login=error");
// 	exit();
// }