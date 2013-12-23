<?php
	  include ("security.php");
  sec_session_start();
	include("connection.php");
	header('Content-type:application/javascript');
	if (isset($_SESSION['uid'])) {
		$uid = $_SESSION['uid'];
		$arr = array();
		$arr['cols'] = array();
		$arr['rows'] = array();
		array_push($arr['cols'], array('id' => 'name', 'label' => 'name', 'type' => 'string'));
		array_push($arr['cols'], array('id' => 'parent', 'label' => 'upline', 'type' => 'string'));

		$row = array();
		$indexes = array();
		$i = 0;
		array_push($indexes, $uid);
		$count = 1;
		while ($i < $count) {
			$index = $indexes[$i];
			$position = $mysqli->query("SELECT a.email, b.parentId FROM user a INNER JOIN relations_free b ON a.userId = b.userId WHERE b.userId=$index")->fetch_assoc();
			$res = $mysqli->query("SELECT userId from relations_free where parentId=$index");
			while($child = $res -> fetch_assoc()) {
				array_push($indexes, $child['userId']);
				$count ++;
			}
			$firstElement = array();
			$firstElement['f'] = "".$position['email'];
			$firstElement['v'] = "".$index;

			$row = array();
			$secondElement = array();
			if ($i == 0) {
				$secondElement['v'] = "";
			} else {
				$secondElement['v'] = "".$position['parentId'];
			}
			$row['c'] = array();
			array_push($row['c'], $firstElement);
			array_push($row['c'], $secondElement);
			array_push($arr['rows'], $row);
			$i ++;
		}
		//print_r($indexes);
		echo json_encode($arr);
	}
?>