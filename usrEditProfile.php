<?php
	include ("security.php");
  	sec_session_start();
	include("connection.php");
	
	if ($stmt = $mysqli -> prepare("UPDATE user SET country=?, telephone=? WHERE userId=?")) {
		$stmt -> bind_param("sss", $_POST['country'], $_POST['telephone'], $_SESSION['uid']);
		$stmt -> execute();
		$stmt -> close();
		header("Location: profile.php");
	} else {
		echo $mysqli->error;
	}

?>