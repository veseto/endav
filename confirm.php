<?php
	include ("security.php");
  	sec_session_start();
	include("constants.php");
	include("keyGenerator.php");
	include("connection.php");
	include("processFree.php");
	$salt = "'".$_GET['id']."'";
	if($result = $mysqli->query("SELECT * FROM user where salt=$salt")){
		$u = $result->fetch_array();
		if ($u['activated'] == '0') {
			if($mysqli->query("UPDATE user SET activated = '1', salt = NULL WHERE userId=".$u['userId'])) {
				addFreeUser($u['userId'], $u['refferal']);
				mail($u['email'], "Your refferal link", $url."register.php?ref=".keygen($u['userId']));
				$_SESSION = array();
				$_SESSION['status'] = 'OK';
				$_SESSION['msg'] = "Activation successful";
				header('Location: index.php');
			}
		} else {
				//echo "<script> alert('user is already activated');</script>";
			$_SESSION['msg'] = "user already activated";
			header('Location: index.php');
		}		
	}
	
	
?>