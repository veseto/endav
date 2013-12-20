<?php
	require_once ("includes/security.php");
  	sec_session_start();
	$params = session_get_cookie_params();
	setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
	setcookie('endav', '', time() - 42000);
	$_SESSION = array();
	session_destroy();
	print_r($_COOKIE);
	header("Location: index.php");

?>