<?php
	include ("security.php");
  	sec_session_start();
	$_SESSION = array();
	header("Location: index.php");

?>