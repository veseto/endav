<?
	include ("constants.php");
	include ("connection.php");
	include ("security.php");
  	sec_session_start();
  	require_once('includes/phpass-0.3/PasswordHash.php');
	
	if (isset($_POST['email'])) {
		$subject = "Reset password";
		$headers = "";
		$mailBody = "To reset your passwod please follow the link: ".$url."usrPasswordReset.php?id=".sha1('resetstring'.$_POST['email'].'secondrandomstring');
		mail($_POST['email'],$subject,$mailBody,$headers);
		$_SESSION['msg'] = "Reset mail sent";
		header('Location: index.php');
	} else if (isset($_GET['id'])) {
		$res = $mysqli->query("SELECT * FROM user");
		while ($row = $res->fetch_array()) {
			if ($_GET['id'] == sha1('resetstring'.$row['email'].'secondrandomstring')) {
				$_SESSION['reset']="true";
				$_SESSION['email']=$row['email'];
				header('Location: resetPwd.php');
				exit;
			}
		}
	}	else if (isset($_POST['updemail']) && isset($_POST['password'])) {
		if ($stmt = $mysqli->prepare("UPDATE user SET password=? WHERE email=?")) {
			$hasher = new PasswordHash(8, false);
			$hashedPassword = $hasher->HashPassword($_POST['password']);	
			$stmt->bind_param("ss", $hashedPassword, $_POST['updemail']);
			$stmt->execute();
			$stmt->close();
			$_SESSION["msg"] = "password updated";
			header("Location: index.php");
			exit;
		}
	}
	header("Location: index.php");
?>