<?php
	session_start();
	include("constants.php");
	include("connection.php");
	include("processFree.php");
	$result = $mysqli->query("SELECT * FROM user");
	while ($u = $result->fetch_assoc()) {
		if (sha1('firstrandomstring'.$u['email'].'secondrandomstring') === $_GET['id']) {

			if($mysqli->query("UPDATE user SET activated='1' WHERE userId=".$u['userId'])) {
				addFreeUser($u['userId'], $u['refferal']);
				mail($u['email'], "Your refferal link", $url."register.php?ref=".$u['userId']);
				$_SESSION['status'] = 'OK';
				$_SESSION['msg'] = "Activation successful";
				header('Location: index.php');
			}
		}
	}
?>