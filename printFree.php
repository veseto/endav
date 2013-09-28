<?php
	  include ("security.php");
  sec_session_start();
	//header('Content-type:application/javascript');

	function addElement(&$tree, $elementId) {
		include("connection.php");
		$childrenArr = array();
		$userTmp = $mysqli->query("SELECT * from user where userId=$elementId")->fetch_array();
		$tree[] = array('id' => $elementId, 'name' => $userTmp['email'], 'data' => array(), 'children' => &$childrenArr);

		$element = $mysqli->query("SELECT * from relations_free where parentId=$elementId");
		while ($row=$element->fetch_array()) {
			addElement($childrenArr, $row["userId"]);
		}
	}

	$tree = array();
	if(isset($_SESSION['uid'])){
		addElement($tree, $_SESSION['uid']);
		echo json_encode($tree[0]);
	}
?>