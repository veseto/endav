<?php
	include('header.php');
	include('connection.php');
	include('constants.php');
	if (!isset($_SESSION["uid"])) {
		header('Location: index.php');
	}
?>
	<h4> Welcome <?php echo $_SESSION['email']?>. Would you like to see:</h4>
	<a href='visualizationBinar.php' class="btn btn-primary">Binar tree</a> or <a href='visualizationFree.php'  class="btn btn-default">Free tree</a> 
	<h3>refferal link </h3>
	<div class="alert alert-success"><?php echo $url."register.php?ref=".sha1("rand1".$_SESSION['uid']."q1w2e3r4") ?></div>
	<?php 
		$money = $mysqli->query("SELECT money from user where userId='".$_SESSION['uid']."'")->fetch_array()['money'];
		$bounusLvl1 = $mysqli->query("SELECT COUNT( * ) FROM  `relations_binar` WHERE userId='".$_SESSION['uid']."' AND bonusArray1 = '[]'")->fetch_array()[0];
		$bounusLvl2 = $mysqli->query("SELECT COUNT( * ) FROM  `relations_binar` WHERE userId='".$_SESSION['uid']."' AND bonusArray2 = '[]'")->fetch_array()[0];
		echo "Your current balance is $money euro </br> you have $bounusLvl1 bonus level 1 structures and $bounusLvl2 level 2 structures";
	?>
<?php
	include("footer.php");
?>