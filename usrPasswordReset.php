<?
	include ("constants.php");
	include ("keyGenerator.php");
	include ("connection.php");
	include ("security.php");
  	sec_session_start();
  	require_once('includes/phpass-0.3/PasswordHash.php');
	
	if (isset($_POST['email'])) {
		echo "first";
		$email = $_POST['email'];
		$key = keyGen($email);
		$subject = "Reset password";
		$headers = "";
		$mailBody = "To reset your passwod please follow the link: ".$url."usrPasswordReset.php?id=".$key;
		$key = "'".$key."'";
		if ($stmt = $mysqli->prepare("UPDATE user SET salt=? WHERE email=?")) {
			$stmt -> bind_param("ss", $key, $email);
			$stmt -> execute();
			$stmt -> close();
			mail($email,$subject,$mailBody,$headers);
			$_SESSION['msg'] = "Reset mail sent";
			header('Location: index.php');
		
		}
	} else if (isset($_GET['id'])) {
		if ($stmt = $mysqli->prepare("SELECT email FROM user WHERE salt=?")){
			$id = "'".$_GET['id']."'";
			//echo $id;
			$stmt -> bind_param("s", $id);
			$stmt -> execute();
			$stmt -> bind_result($email);
			$stmt -> fetch();
			$_SESSION['reset']="true";
			$_SESSION['email']=$email;
			header('Location: resetPwd.php');
			exit;
			
		}
	} else if (isset($_POST['updemail']) && isset($_POST['password'])) {
		echo "third";
		if ($stmt = $mysqli->prepare("UPDATE user SET password=?, salt = NULL WHERE email=?")) {
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
	//header("Location: index.php");
?>