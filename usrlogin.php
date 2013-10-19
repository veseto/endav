<?php
	include ("security.php");
  	sec_session_start();
  		include("connection.php");
  	$msg = "";
  	if (isset($_COOKIE['endav'])) {
  		//print_r($_COOKIE);
  		if ($stmt = $mysqli -> prepare("SELECT binar, email, refferal, activated, refLink FROM user where userId=?")) {
  			$stmt -> bind_param("s", $_COOKIE['endav']);
  			$stmt -> bind_result($binar, $email, $refferal, $activated, $refLink);
  			$stmt -> execute();
  			$stmt -> fetch();
  			$stmt -> close();
  			if ($activated === 1) {

				$_SESSION['uid'] = $_COOKIE['endav'];
				$_SESSION['binar'] = $binar;
				$_SESSION['email'] = $email;
				$_SESSION['refLink'] = $refLink;
				if ($refferal != '0' && $refferal != 0) {
					$_SESSION['ref'] = $refferal;
				}		
			} else if ($activated === 0) {
				$_SESSION['msg'] = 'ACCOUNT_NOT_ACTIVE';
				header("Location: login.php");
			}
  		}
  	} else {
  		//print_r($_POST);
		require_once('includes/phpass-0.3/PasswordHash.php');
		$email=$_POST["email"];
		$password=$_POST["password"];
		if (!empty($email) && !empty($password)) {
			$hasher = new PasswordHash(8, false);
			//$q="SELECT * FROM user WHERE email='".$mysqli->real_escape_string($email)."'";
			if ($stmt = $mysqli->prepare("SELECT userId, binar, email, refferal, activated, password, refLink FROM user WHERE email=?")) {
				$stmt->bind_param("s", $email);
				$stmt->execute();
				$stmt->bind_result($userId, $binar, $m, $refferal, $activated, $hashedPassword, $refLink);
				$stmt->fetch();
				if ($userId) {
					 if ($hasher->CheckPassword($password, $hashedPassword)) {
						if ($activated === 1) {
							if (isset($_POST['remember-me'])) {
								setcookie("endav", $userId, time()+60*60*24*30, "login.php");
							}
							$_SESSION['uid'] = $userId;
							$_SESSION['binar'] = $binar;
							$_SESSION['email'] = $m;
							$_SESSION['refLink'] = $refLink;
							if ($refferal != '0' && $refferal != 0) {
								$_SESSION['ref'] = $refferal;
							}		
						} else if ($activated === 0) {
							$_SESSION['msg'] = 'ACCOUNT_NOT_ACTIVE';
							header("Location: login.php");
							exit;
						} 
					} else {
						$_SESSION['msg'] = 'WRONG_PASSWORD';
						header("Location: login.php");
						exit;
					}
				} else {
					$_SESSION['msg'] = 'MISSING_USER';
					header("Location: login.php");
					exit;
				}
			$stmt->close();
		}
			
		}
	}
	//print_r($_SESSION);
			//$_SESSION['msg'] = $msg;
			header('Location: index.php') ;
?>