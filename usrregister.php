<?php
	include ("security.php");
  	sec_session_start();
	include("connection.php");
	include("constants.php");
	include("keyGenerator.php");
	require_once('includes/phpass-0.3/PasswordHash.php');
	
	$email = $_POST['email'];
	$password = $_POST['password'];
	$message = "";
	$refferal = $_SESSION["ref"];
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
			$q1 = "INSERT INTO user (email, password, refferal, activated, binar, salt) Values ('$email','".$hashedPassword."', $refferal, 0, 0, '".$key."')";
			if ($mysqli -> query($q1)) {
				$userId=$mysqli->insert_id;
				$subject = "Confirm registration";
				$headers = "";
				$mailBody = "To confirm your account please follow the link: ".$url."confirm.php?id=$key\nYour password is $password";
				mail($email,$subject,$mailBody,$headers);
				$_SESSION['msg'] = 'REGISTRATION_SUCCESS';
				header('Location: index.php');
				exit;
			} else {
				echo $mysqli->error;
			}
		} else {
			$_SESSION['msg'] = 'EMAIL_IN_USE';
			header('Location: register.php');
			exit;
		}
	} else {
		$_SESSION['msg'] = 'REGISTRATION_FAILED';
		header('Location: register.php');
	}
?>