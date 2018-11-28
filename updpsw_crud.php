<?php 
require_once 'database-config.php';
require("PasswordHash.php");
if(count($_POST)>0) {
	$hash_pass = new PasswordHash(8, false);
	$password_encrypted = $hash_pass->HashPassword($_POST["newPassword"]);	
	$q = 'call user_authenticate(:username)';
	$query = $dbh->prepare($q);
	$query->execute(array(':username' => $useremail));
	$row = $query->fetch(PDO::FETCH_ASSOC);
	if ($hash_pass->CheckPassword($_POST["currentPassword"], $row['user_password'])){
	$q = 'call update_password(:user_id, :password)';
	$query = $dbh->prepare($q);
	$query->execute(array(':user_id' => $user_id, ':password' =>$password_encrypted));
	$message = "Password Changed";
	header("Location: logout.php");
	}
	else{
		$message= "password wrong";
	}
	}
?>
