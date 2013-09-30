<?php
	function keyGen($userData){
		$salt = time();
		$hash = sha1(md5($userData."randomstring".$salt."secondrandomstring".rand()));
		return $hash;
	}
?>