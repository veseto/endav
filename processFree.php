<?php
	function addFreeUser($userId, $refferal) {
		include("connection.php");
		if ($refferal == 0 || $refferal == -1) {
			$refferal = $mysqli->query("SELECT userId from relations_binar ORDER BY RAND() LIMIT 1")->fetch_array()[0];
		} 
		$q3="INSERT INTO relations_free  (userId, parentId) VALUES ($userId, $refferal)";
		$mysqli -> query($q3);
		$mysqli -> query("INSERT INTO user_money (userId, cash, inSite) VALUES ($userId, 0, 0)");
		
	}

?>
