<?php 
	require 'database-config.php';
	require("PasswordHash.php");
	session_start();

	$username = "";
	$password = "";
	$user_role= "";
	if(isset($_POST['username'])){
		$username = $_POST['username'];
	}
	if (isset($_POST['password'])) {
		$password = $_POST['password'];

	}
	
	#echo $username ." : ".$password;
	
	$q = 'call user_authenticate(:username)';
	$query = $dbh->prepare($q);
	
	$query->execute(array(':username' => $username));


	if($query->rowCount() == 0){
		header('Location: index.php?err=1');
	}else{
	
		$row = $query->fetch(PDO::FETCH_ASSOC);
		$hash_pass = new PasswordHash(8, false);
		if ($hash_pass->CheckPassword($password, $row['user_password'])){
		session_regenerate_id();
		$_SESSION['sess_user_id'] = $row['user_login_id'];
		$_SESSION['sess_user_email'] = $row['user_email_id'];
		$_SESSION['sess_userrole']= $row['user_role'];
		$_SESSION['sess_username']= $row['user_name'];
        echo $_SESSION['sess_username'];
		session_write_close();

		if( $_SESSION['sess_userrole'] == "dean"){
			header('Location: dean.php');
		}else if( $_SESSION['sess_userrole'] == "secretary"){
			header('Location: secretary.php');
		}else if( $_SESSION['sess_userrole'] == "event_handler"){
			header('Location: events.php');
		}
	
	}else{
		header('Location: index.php?err=1');
	}
	}
