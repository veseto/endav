<?php
	include ("security.php");
  	sec_session_start();
	include("constants.php");
	include("keyGenerator.php");
	include("connection.php");
	include("processFree.php");
	$salt = "'".$_GET['id']."'";
	$q = "SELECT * FROM user where salt=$salt";
	if($result = $mysqli->query($q)){
		$u = $result->fetch_array();
		$refLink = keyGen($u['userId']);
		if ($u['activated'] === '0' || $u['activated'] === 0) {
			if($stmt = $mysqli->prepare("UPDATE user SET activated = '1', refLink=?, salt = NULL WHERE userId='".$u['userId']."'")) {
				$stmt->bind_param("s", $refLink);
				$stmt->execute();
				addFreeUser($u['userId'], $u['refferal']);
				mail($u['email'], "Your refferal link", $url."register.php?ref=".$refLink);
				$stmt->close();
				$_SESSION = array();
				$_SESSION['status'] = 'OK';
				$_SESSION['msg'] = "Activation successful";
				header('Location: index.php');
			} else {
				echo $mysqli->error;
			}
		} else {
				//echo "<script> alert('user is already activated');</script>";
			$_SESSION['msg'] = "USER_ACTIVATED";
			header('Location: index.php');
		}		
	} else {
		echo $mysqli->error;
	}
	
	
?>