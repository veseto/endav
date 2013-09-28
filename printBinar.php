<?php
	  include ("security.php");
  sec_session_start();
	include("connection.php");
	header('Content-type:application/javascript');

	function addElement(&$tree, $elementId) {
		include("connection.php");
		$childrenArr = array();
		$q0 = "SELECT * from user LEFT JOIN relations_binar ON (user.userId = relations_binar.userId) where relations_binar.bIndex=$elementId";
		$userTmp = $mysqli->query($q0)->fetch_array();
		$tree[] = array('id' => $elementId, 'name' => $userTmp['email'], 'data' => array(), 'children' => &$childrenArr);

		//$element = $mysqli->query("SELECT * from relations_binar where userId=$elementId") -> fetch_array();
		if ($userTmp['child0'] != NULL) {
			addElement($childrenArr, $elementId * 2 + 1);
		} else {
			return;
		}

		if ($userTmp['child1'] != NULL) {
			addElement($childrenArr, $elementId * 2 + 2);
		} else {
			return;
		}
				

	}


	$tree = array();

	if (isset($_SESSION['uid']) && isset($_SESSION['binar']) && $_SESSION['binar'] === '1') {
		$uid = $_SESSION['uid'];
		$q="SELECT bIndex from relations_binar where userId = $uid ORDER BY bIndex ASC";
		$index = $mysqli->query($q)->fetch_array()[0];
		addElement($tree, $index);
		echo json_encode($tree[0]);
	}
	
?>