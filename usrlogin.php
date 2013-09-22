<?php
	session_start();
	include("connection.php");
	require_once('includes/phpass-0.3/PasswordHash.php');
	$email=$_POST["email"];
	$password=$_POST["password"];
	if (!empty($email) && !empty($password)) {
		$hasher = new PasswordHash(8, false);
		$q="SELECT * FROM user WHERE email='".$mysqli->real_escape_string($email)."'";
		$result=$mysqli->query($q);
		$array=$result->fetch_array();
		$hashedPassword = $array['password'];
		if ($hasher->CheckPassword($mysqli->real_escape_string($password), $hashedPassword)) {
		if ($array['activated'] === '1') {
				$_SESSION["uid"] = $array["userId"];
				$_SESSION['binar'] = $array["binar"];
				$_SESSION['email'] = $array["email"];
				if ($array["refferal"] != '0') {
					$_SESSION['ref'] = $array["refferal"];
				}
				
		} else if ($array['activated'] === '0') {
			$msg = "your account is not activated";
		} else {
			$q1 = "SELECT * FROM user WHERE email='".$mysqli->real_escape_string($email)."'";
			$result1=$mysqli->query($q1);
			$array1=$result1->fetch_array();
			if ($array1) {
				$msg = "wrong password";
			} else {
				$msg = "no such user";
			}
		}
		}
		//$_SESSION['msg'] = $msg;
		header('Location: index.php') ;
	}
?>