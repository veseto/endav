<?php
	require_once ("includes/security.php");
  	sec_session_start();
	$email = $_POST['email'];
	$body = $_POST['mailBody'];
	$subject = "mail from contact.php";
	$headers = "From: $email" . "\r\n";
	$headers .= "Cc: $email" . "\r\n";


	echo "$email <br> $body <br> $headers";
	if (mail("wpopowa@gmail.com",$subject,$body,$headers)) { 
		$_SESSION['succ'] = 'MAIL_SENT';
	} else {
		$_SESSION['err'] = 'MAIL_NOT_SENT';
	}
	header("Location: contact.php");
	
?>