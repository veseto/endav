<?php
	include ("includes/security.php");
  	sec_session_start();
	include("includes/connection.php");
	
	if ($stmt = $mysqli -> prepare("UPDATE user_details SET country=?, phone=?, city=?, address=?, bday=? WHERE userId=?")) {
		$stmt -> bind_param("ssssss", $_POST['country'], $_POST['phone'], $_POST['city'], $_POST['address'], $_POST['bday'], $_SESSION['uid']);
		$stmt -> execute();
		$stmt -> close();
		header("Location: profile.php");
	} else {
		echo $mysqli->error;
	}

?>