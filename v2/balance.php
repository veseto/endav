<?php include("includes/header.php"); ?>
<?
	include('includes/connection.php');
	include('includes/constants.php');
	if (!isset($_SESSION["uid"])) {
		header('Location: index.php');
	}
?>
<div class="container">
	<?php 
		//$money = $mysqli->query("SELECT money from user where userId='".$_SESSION['uid']."'")->fetch_array()['money'];
		$bounusLvl1 = $mysqli->query("SELECT COUNT( * ) FROM  `relations_binar` WHERE userId='".$_SESSION['uid']."' AND bonusArray1 = '[]'")->fetch_array()[0];
		$bounusLvl2 = $mysqli->query("SELECT COUNT( * ) FROM  `relations_binar` WHERE userId='".$_SESSION['uid']."' AND bonusArray2 = '[]'")->fetch_array()[0];
		echo "You have $bounusLvl1 bonus level 1 structures </br> You have $bounusLvl2 bonus level 2 structures</br>";
	?>
<?php

	$arr = $mysqli->query("SELECT * from user_money where userId='".$_SESSION['uid']."'")->fetch_assoc();
	echo "<br> Cash money ".$arr['cash'];
	echo "<br> In site money ".$arr['inSite'];
?>
</div>
<?php include("includes/footer.php"); ?>