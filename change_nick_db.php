<?php 
session_start(); 
include "db_conn.php";
$opw=$_SESSION['password'];
$cnick=$_SESSION['name'];
$cid=$_SESSION['id'];

if ( isset($_POST['nick_name'])&& isset($_POST['nick_password']) ) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$nick_name = validate($_POST['nick_name']);
	$re_pass = validate($_POST['nick_password']);
	
	//$user_data = 'uname='. $uname. '&name='. $name;


	if(empty($nick_name)){
        header("Location: change_nick.php?error=nick_name is required");
	    exit();
	}
	else if(empty($re_pass)){
        header("Location: change_nick.php?error=Password is required");
	    exit();
	}

	

    else if($opw !== $re_pass){
        header("Location: change_nick.php?error=wrong  password");
		
	    exit();
	}

	else{

		// hashing the password
        //$pass = md5($pass);
       
		$sql=" UPDATE db_account SET name='$nick_name' WHERE id=$cid ";
		
           //$sql2 = "INSERT INTO db_account(email, password, name) VALUES('$uname', '$pass', '$name')";
           $result2 = mysqli_query($conn, $sql);
           if ($result2) {
           	 header("Location: change_nick.php?success=Your nick name has been change successfully");
			  $_SESSION['name'] = $nick_name;
			  
				
	         exit();
           }else {
	           	header("Location: change_nick.php?error=unknown error occurred");
		        exit();
           }
		
	}
	
}else{
	header("Location: change_nick.php");
	exit();
}
