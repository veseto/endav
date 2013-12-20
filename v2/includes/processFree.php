<?php
	function addFreeUser($userId, $refferal) {
		include("includes/connection.php");
		if ($refferal == 0 || $refferal == -1) {
			$refferal = $mysqli->query("SELECT userId from relations_binar ORDER BY RAND() LIMIT 1")->fetch_array()[0];
		} 
		$grandParent = $mysqli -> query("SELECT parentId from relations_free where userId=$refferal") -> fetch_array()[0];
		$q3="INSERT INTO relations_free  (userId, parentId, grandParentId) VALUES ($userId, $refferal, $grandParent)";
		$mysqli -> query($q3);
		$mysqli -> query("INSERT INTO user_money (userId, cash, inSite) VALUES ($userId, 0, 0)");
		$mysqli -> query("INSERT INTO user_details (userId) VALUES ($userId)");

	}

?>
