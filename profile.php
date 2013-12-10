<?php
	include('header.php');
	include('connection.php');
	include('constants.php');
	if (!isset($_SESSION["uid"])) {
		header('Location: index.php');
	}
	if ($stmt = $mysqli -> prepare("SELECT refLink, country, telephone from user where userId=?")) {
		$stmt -> bind_param("s", $_SESSION['uid']);
		$stmt -> bind_result($refLink, $country, $telephone);
		$stmt -> execute();
		$stmt -> fetch();
		$stmt -> close();
	}
?>
	<h4> Welcome <?php echo $_SESSION['email']?>. Would you like to see:</h4>
	<a href='visualizationBinar.php' class="btn btn-primary">Binar tree</a> or <a href='visualizationFree.php'  class="btn btn-default">Free tree</a> 
	<h3>refferal link </h3>
	<div class="alert alert-success"><?php echo $url."register.php?ref=$refLink"?></div>
	<?php 
		//$money = $mysqli->query("SELECT money from user where userId='".$_SESSION['uid']."'")->fetch_array()['money'];
		$bounusLvl1 = $mysqli->query("SELECT COUNT( * ) FROM  `relations_binar` WHERE userId='".$_SESSION['uid']."' AND bonusArray1 = '[]'")->fetch_array()[0];
		$bounusLvl2 = $mysqli->query("SELECT COUNT( * ) FROM  `relations_binar` WHERE userId='".$_SESSION['uid']."' AND bonusArray2 = '[]'")->fetch_array()[0];
		echo "You have $bounusLvl1 bonus level 1 structures </br> You have $bounusLvl2 bonus level 2 structures</br>";
	?>
	<a href='editProfile.php' class="btn btn-primary">Edit profile</a> 
<?php
	echo "<br>Country: $country";
	echo "<br>";
	echo "Telephone: $telephone";

	$arr = $mysqli->query("SELECT * from user_money where userId='".$_SESSION['uid']."'")->fetch_assoc();
	echo "<br> Cash money ".$arr['cash'];
	echo "<br> In site money ".$arr['inSite'];
	
	include("footer.php");
?>