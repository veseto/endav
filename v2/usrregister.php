<?php
	include ("includes/security.php");
  	sec_session_start();
	include("includes/connection.php");
	include("includes/constants.php");
	include("includes/keyGenerator.php");
	require_once('includes/phpass-0.3/PasswordHash.php');
	
	$email = $_POST['email'];
	$password = $_POST['password1'];
	$message = "";
	$refferal = 0;
	print_r($_POST);
	if (isset($_POST['refMail']) && $_POST['refMail'] != "") {
		if ($stmt = $mysqli->prepare("SELECT userId From user where email=?")) {
			$stmt -> bind_param("s", $_POST['refMail']);
			$stmt -> execute();
			$stmt -> bind_result($refferal);
			$stmt -> fetch();
			$_SESSION['ref'] = $refferal;
			$stmt -> close();	
		}
	}
	if (!empty($email) && !empty($password)) {
		$password = $mysqli->real_escape_string($password);
		$email = $mysqli->real_escape_string($email);
		$hasher = new PasswordHash(8, false);
		$hashedPassword = $hasher->HashPassword($password);	
		$q="SELECT COUNT(userId) FROM user where email='$email'";
		$count = $mysqli->query($q)->fetch_array()[0];
		if ($count === NULL || $count === '0') {
			$key = keyGen($email);
			$advertiser = 0;
			$zero = 0;
			if (isset($_POST['advertiser'])) {
				$advertiser = 1;
			}
			if ($stmt = $mysqli -> prepare("INSERT INTO user (email, password, refferal, activated, binar, salt, advertiser) Values (?,?,?, 0, 0, ?, ?)")){
				$stmt -> bind_param("ssisi", $email, $hashedPassword, $refferal, $key, $advertiser);
				$stmt -> execute();
				$stmt -> close();
				$subject = "Confirm registration";
				$headers = "";
				$mailBody = "To confirm your account please follow the link: ".$url."confirm.php?id=$key\nYour password is $password";
				mail($email,$subject,$mailBody,$headers);
				header('Location: signupConfirm.php');
				exit;
			} else {
				echo $stmt->error;
			}
		} else {
			$_SESSION['err'] = 'EMAIL_IN_USE';
			header('Location: signup-user.php');
			exit;
		}
	} else {
		$_SESSION['err'] = 'REGISTRATION_FAILED';
		header('Location: signup-user.php');
	}
?>