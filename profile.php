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
	<div class="alert alert-success"><?php echo $url."register.php?ref=".$mysqli->query("SELECT refLink FROM user where userId='".$_SESSION['uid']."'")->fetch_array()[0]; ?></div>
	<?php 
		//$money = $mysqli->query("SELECT money from user where userId='".$_SESSION['uid']."'")->fetch_array()['money'];
		$bounusLvl1 = $mysqli->query("SELECT COUNT( * ) FROM  `relations_binar` WHERE userId='".$_SESSION['uid']."' AND bonusArray1 = '[]'")->fetch_array()[0];
		$bounusLvl2 = $mysqli->query("SELECT COUNT( * ) FROM  `relations_binar` WHERE userId='".$_SESSION['uid']."' AND bonusArray2 = '[]'")->fetch_array()[0];
		echo "You have $bounusLvl1 bonus level 1 structures </br> You have $bounusLvl2 bonus level 2 structures";
	?>
<?php
	include("footer.php");
?>