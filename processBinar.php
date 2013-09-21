<?php
	function addBinarUserBonusArray1($userIndex) {
		include('constants.php');
		$arr = array($userIndex);
		for ($i=0; $i<(pow(2, $levelsToBonus1) - 1); $i++) {
			$current = $arr[$i];
			$tmp = ($current * 2) + 1;
			array_push($arr, $tmp);
			$tmp += 1;
			array_push($arr, $tmp);
		}
		unset($arr[0]);

		return json_encode($arr);
	}

	function addBinarUserBonusArray2($userIndex) {
		include('constants.php');
		$arr = array($userIndex);
		for ($i=0; $i<(pow(2, $levelsToBonus2) - 1); $i++) {
			$current = $arr[$i];
			$tmp = ($current * 2) + 1;
			array_push($arr, $tmp);
			$tmp += 1;
			array_push($arr, $tmp);
		}
		unset($arr[0]);

		return json_encode($arr);
	}

	function updateUplines($userIndex) {
		include("connection.php");
		include("constants.php");
		$current = $userIndex;
		for ($i = 0; $i < $levelsToBonus2 - 1; $i ++) {
			$current = round(($current-1)/2, 0, PHP_ROUND_HALF_DOWN);
			if ($current < 0) {
				break;
			}
			$q0 = "SELECT bonusArray1, bonusArray2 from relations_binar where bIndex=$current";
			$strs = $mysqli->query($q0)->fetch_array();
			$barr1 = json_decode($strs['bonusArray1'], true);
			if(($key = array_search($userIndex, $barr1)) !== false) {
    			unset($barr1[$key]);
			}
			$barr1 = json_encode($barr1);
			$barr2 = json_decode($strs['bonusArray2'], true);
			if(($key = array_search($userIndex, $barr2)) !== false) {
    			unset($barr2[$key]);
			}
			$barr2 = json_encode($barr2);
			$q1 = "UPDATE relations_binar SET bonusArray1='".$barr1."', bonusArray2='".$barr2."' where bIndex=$current";
			$mysqli->query($q1);
		}
	}
	function addBinarUser($userId) {
		include("connection.php");
		$array = $mysqli->query("SELECT * FROM machine_current_states")->fetch_array();
		$index = $array['lastServedBinar'];
		$added = False;
		$q0="SELECT * FROM relations_binar WHERE bIndex=$index";
		$res = $mysqli->query($q0);
		while ($current = $res -> fetch_array()) {
			$index = $current['bIndex'];
			if ($current['child0'] === NULL) {
				$newIndex = $index * 2 + 1;
				$strarray1 = addBinarUserBonusArray1($newIndex);
				$strarray2 = addBinarUserBonusArray2($newIndex);
				$id=$current['userId'];
				$q="INSERT INTO relations_binar (userId, child0, child1, bIndex, bonusArray1, bonusArray2) values ($userId, NULL, NULL, $newIndex, '".$strarray1."', '".$strarray2."')";
				$mysqli->query($q);
				$q1 = "UPDATE relations_binar SET child0=$userId WHERE bIndex=$index";
				$mysqli->query($q1);
				$mysqli->query("UPDATE machine_current_states SET lastServedBinar=$index");
				$mysqli->query("UPDATE user SET binar=1 WHERE userId=$userId");
				updateUplines($newIndex);
				return "OK";
			} else if ($current['child1'] === NULL) {
				$newIndex = $index * 2 + 2;
				$strarray1 = addBinarUserBonusArray1($newIndex);
				$strarray2 = addBinarUserBonusArray2($newIndex);
				$id=$current['userId'];
				$q="INSERT INTO relations_binar (userId, child0, child1, bIndex, bonusArray1, bonusArray2) values ($userId, NULL, NULL, $newIndex, '".$strarray1."', '".$strarray2."')";
				$mysqli->query($q);
				$q1 = "UPDATE relations_binar SET child1=$userId WHERE bIndex=$index";
				$mysqli->query($q1);
				$mysqli->query("UPDATE machine_current_states SET lastServedBinar=$index");
				$mysqli->query("UPDATE user SET binar=1 WHERE userId=$userId");
				updateUplines($newIndex);
				return "OK"; 
			} else {
				$index +=1;
				$res = $mysqli->query("SELECT * FROM relations_binar WHERE bIndex=$index");
				
			}
		}
		return "";
	}


	function addBinarUserWithReffer($userId, $reffer) {
		include("connection.php");
		$q2 = "SELECT bIndex FROM relations_binar WHERE userId=$reffer ORDER BY bIndex ASC";
		$bInd = $mysqli->query($q2)->fetch_array()['0'];
		$children = array('0' => $bInd);
		for($i = 0; $i < count($children); $i ++) {
			$index = $children[$i];
			$position = $mysqli->query("SELECT * FROM relations_binar WHERE bIndex=$index")->fetch_array();

			if ($position['child0'] === NULL) {
				$newIndex = $index * 2 + 1;
				$strarray1 = addBinarUserBonusArray1($newIndex);
				$strarray2 = addBinarUserBonusArray2($newIndex);
				$id=$position['userId'];
				$q="INSERT INTO relations_binar (userId, child0, child1, bIndex, bonusArray1, bonusArray2) values ($userId, NULL, NULL, $newIndex, '".$strarray1."', '".$strarray2."')";
				$mysqli->query($q);
				$mysqli->query("UPDATE relations_binar SET child0=$userId WHERE bIndex=$index");
				$mysqli->query("UPDATE user SET binar=1 WHERE userId=$userId");
				updateUplines($newIndex);
				return "OK";
			} else if ($position['child1'] === NULL) {
				$newIndex = $index * 2 + 2;
				$strarray1 = addBinarUserBonusArray1($newIndex);
				$strarray2 = addBinarUserBonusArray2($newIndex);
				$id=$position['userId'];
				$q="INSERT INTO relations_binar (userId, child0, child1, bIndex, bonusArray1, bonusArray2) values ($userId, NULL, NULL, $newIndex, '".$strarray1."', '".$strarray2."')";
				$mysqli->query($q);
				$mysqli->query("UPDATE relations_binar SET child1=$userId WHERE bIndex=$index");
				$mysqli->query("UPDATE user SET binar=1 WHERE userId=$userId");
				updateUplines($newIndex);
				return "OK";
			} else {
				$newIndex = $index * 2 + 1;
				array_push($children, $newIndex);
				array_push($children, $newIndex + 1);
			}
		}

	}
	
?>