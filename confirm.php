<?php
	include ("security.php");
  	sec_session_start();
	include("constants.php");
	include("connection.php");
	include("processFree.php");
	$result = $mysqli->query("SELECT * FROM user");
	while ($u = $result->fetch_assoc()) {
		if (sha1('firstrandomstring'.$u['email'].'secondrandomstring') === $_GET['id']) {
			$activated = $mysqli->query("SELECT activated from user where userId=".$u['userId'])->fetch_array()[0];
			if ($activated === '0') {
			if($mysqli->query("UPDATE user SET activated='1' WHERE userId=".$u['userId'])) {
				addFreeUser($u['userId'], $u['refferal']);
				mail($u['email'], "Your refferal link", $url."register.php?ref=".sha1("rand1".$u['userId']."q1w2e3r4"));
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
	}
?>h