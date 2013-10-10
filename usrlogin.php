<?php
	  include ("security.php");
  sec_session_start();
	include("connection.php");
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
						$_SESSION['uid'] = $userId;
						$_SESSION['binar'] = $binar;
						$_SESSION['email'] = $m;
						$_SESSION['refLink'] = $refLink;
						if ($refferal != '0' && $refferal != 0) {
							$_SESSION['ref'] = $refferal;
						}		
					} else if ($activated === 0) {
						$msg = 'ACCOUNT_NOT_ACTIVE';
					} 
				} else {
					$msg = 'WRONG_PASSWORD';
				}
			} else {
				$msg = 'MISSING_USER';
			}
		$stmt->close();
	}
		//print_r($_SESSION);
		$_SESSION['msg'] = $msg;
		header('Location: index.php') ;
	}
?>