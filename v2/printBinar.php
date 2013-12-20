<?php
	  include ("includes/security.php");
  sec_session_start();
	include("includes/connection.php");
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
		$q="SELECT bIndex from relations_binar where userId = $uid ORDER BY bIndex ASC";
		$index = $mysqli->query($q)->fetch_array()[0];
		array_push($indexes, $index);
		$count = 1;
		while ($i < $count) {
			$index = $indexes[$i];
			$position = $mysqli->query("SELECT a.email, b.child0, b.child1 FROM user a INNER JOIN relations_binar b ON a.userId = b.userId WHERE b.bindex=$index")->fetch_assoc();
			if ($position['child0'] != NULL) {
				array_push($indexes, $index * 2 + 1);
				$count ++;
			}
			if ($position['child1'] != NULL) {
				array_push($indexes, $index * 2 + 2);
				$count ++;
			}
			$firstElement = array();
			$firstElement['f'] = "".$position['email'];
			$firstElement['v'] = "".$index;

			$parent = round ($index / 2 - 1, 0 , PHP_ROUND_HALF_UP);
			if ($parent < 0) {
				$parent = "";
			}
			$row = array();
			$secondElement = array();
			$secondElement['v'] = "".$parent;
			$row['c'] = array();
			array_push($row['c'], $firstElement);
			array_push($row['c'], $secondElement);
			array_push($arr['rows'], $row);
			$i ++;
		}
		echo json_encode($arr);
	}
?>