<?php 
session_start(); 
include "db_conn.php";
$opw=$_SESSION['password'];
$cid=$_SESSION['id'];
echo $opw;

if ( isset($_POST['new_password'])&& isset($_POST['old_password']) && isset($_POST['re_new_password'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$pass = validate($_POST['new_password']);
	$re_pass = validate($_POST['re_new_password']);
	$old_password = validate($_POST['old_password']);
	//$user_data = 'uname='. $uname. '&name='. $name;


	if(empty($pass)){
        header("Location: change_pw.php?error=Password is required");
	    exit();
	}
	else if(empty($re_pass)){
        header("Location: change_pw.php?error=Re Password is required");
	    exit();
	}

	else if(empty($old_password)){
        header("Location: change_pw.php?error=old_password is required");
	    exit();
	}

	else if($pass !== $re_pass){
        header("Location: change_pw.php?error=The confirmation password  does not match");
	    exit();
	}
    else if($opw !== $old_password){
        header("Location: change_pw.php?error=wrong origin password");
		
	    exit();
	}

	else{

		// hashing the password
        //$pass = md5($pass);
	    //$sql = "SELECT * FROM db_account WHERE email='$uname' ";
        $sql=" UPDATE db_account SET password='$pass' WHERE id=$cid ";
		
           //$sql2 = "INSERT INTO db_account(email, password, name) VALUES('$uname', '$pass', '$name')";
           $result2 = mysqli_query($conn, $sql);
           if ($result2) {
           	 header("Location: change_pw.php?success=Your account has been change successfully");
			  $_SESSION['password'] = $pass;
				
	         exit();
           }else {
	           	header("Location: change_pw.php?error=unknown error occurred");
		        exit();
           }
		
	}
	
}else{
	header("Location: change_pw.php");
	exit();
}
