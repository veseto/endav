<?php include("includes/header.php"); ?>
<?
	include('includes/connection.php');
	include('includes/constants.php');
	if (!isset($_SESSION["uid"])) {
		header('Location: index.php');
	}
	if ($stmt = $mysqli -> prepare("SELECT refLink from user where userId=?")) {
		$stmt -> bind_param("s", $_SESSION['uid']);
		$stmt -> bind_result($refLink);
		$stmt -> execute();
		$stmt -> fetch();
		$stmt -> close();
	}
	if ($stmt = $mysqli -> prepare("SELECT country, phone, city, address, bday from user_details where userId=?")) {
		$stmt -> bind_param("s", $_SESSION['uid']);
		$stmt -> bind_result($country, $phone, $city, $address, $bday);
		$stmt -> execute();
		$stmt -> fetch();
		$stmt -> close();
	}
		//$money = $mysqli->query("SELECT money from user where userId='".$_SESSION['uid']."'")->fetch_array()['money'];
		$bounusLvl1 = $mysqli->query("SELECT COUNT( * ) FROM  `relations_binar` WHERE userId='".$_SESSION['uid']."' AND bonusArray1 = '[]'")->fetch_array()[0];
		$bounusLvl2 = $mysqli->query("SELECT COUNT( * ) FROM  `relations_binar` WHERE userId='".$_SESSION['uid']."' AND bonusArray2 = '[]'")->fetch_array()[0];
		
		$arr = $mysqli->query("SELECT * from user_money where userId='".$_SESSION['uid']."'")->fetch_assoc();

?>
<div class="container">
	<ol class="breadcrumb well text-danger">
	  <li><a href="index.php">Home</a></li>
	  <li class="active">My Profile</li>
	</ol>
	<div class="row">
		<div class="col-sm-4 pull-right">
	  <div class="panel panel-success">
	    <div class="panel-heading">
	      <h3 class="panel-title">Balance<button class="btn btn-default btn-xs pull-right">Add</button></h3>
	    </div>
	    <div class="panel-body">
	    	<p>Cash: <strong><?php echo number_format($arr["cash"], 2); ?></strong></p>
	      	<p>In-site money: <strong><?php echo number_format($arr["inSite"], 2); ?></strong></p>
	    </div>
	    <div class="panel-footer">
	    	<a href="#" class="text-default">Cashflow</a> | 
	    	<a href="#" class="text-default">Stats</a> | 
	    	<a href="#" class="text-default">Withdraw</a>
	    </div>
	  </div>
	  <div class="panel panel-warning">
	    <div class="panel-heading">
	      <h3 class="panel-title">Bonus Positions<a href="pay.php" class="btn btn-default btn-xs pull-right">Buy</a></h3>
	    </div>
	    <div class="panel-body">
	      <p>Bonus Positions in Level 1: <strong><?php echo $bounusLvl1; ?></strong></p>
	      <p>Bonus Positions in Level 2: <strong><?php echo $bounusLvl2; ?></strong></p>
	    </div>
	    <div class="panel-footer">
	    	<span class="text-default">Display:
	    	<a href="#" class="text-default">Standard Tree</a> | 
	    	<a href="visualizationBinar.php" class="text-default">Binar</a>
	    </div>
	  </div>
		</div><!-- /.col-sm-4 -->
		<div class="col-sm-8">
		<div class="panel panel-warning">
		  <!-- Default panel contents -->
		  <div class="panel-heading" id="detailsPannel">Personal Details <button id="editDetails" class="btn btn-default btn-xs pull-right">Edit</button> <button id="saveDetails" style="display: none;" class="btn btn-default btn-xs pull-right">Save</button> <button id="cancelEdit" style="display: none;" class="btn btn-default btn-xs pull-right">Cancel</button></div>
		  <div class="panel-body">
		  	Referral ID: <span class="text-success pull-right"><strong><?php echo $refLink ?></strong></span>
		  </div>

		  <!-- List group -->
		  <ul class="list-group" >
		  	<form id="details" action="" method="post">
			    <li class="list-group-item">Country: <span class="val pull-right"><?php echo $country; ?></span></li>
			    <li class="list-group-item">Phone Number: <span class="val pull-right"><?php echo $phone; ?></span></li>
			    <li class="list-group-item">City: <span class="val pull-right"><?php echo $city; ?></span></li>
			    <li class="list-group-item">Address: <span class="val pull-right"><?php echo $address; ?></span></li>
			    <li class="list-group-item">Birth Date: <span class="val pull-right"><?php echo $bday; ?></span></li>
			</form>
		  </ul>
		</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$("#editDetails").on("click", function(){
		$(this).remove();
		$("#saveDetails").css("display", "block");
		$("#cancelEdit").css("display", "block");

		$("#details li").each(function(){
			var val = $(this).find(".val");
			var text = val.text();
			val.text("");
			if ($(this).index() == 0) {	
				val.append('<input type="text" id="country" name="country" value="'+ text + '">');
			} else if ($(this).index() == 1) {
				val.append('<input type="text" id="phone" name="phone" value="'+ text + '">');
			} else if ($(this).index() == 2) {
				val.append('<input type="text" id="city" name="city" value="'+ text + '">');
			} else if ($(this).index() == 3) {
				val.append('<input type="text" id="address" name="address" value="'+ text + '">');
			} else if ($(this).index() == 4) {
				val.append('<input type="text" id="bday" name="bday" value="'+ text + '">');
			}
		});
	});

	$("#saveDetails").on("click", function(){
		$("#details").attr("action", "usrEditProfile.php");
		$("#details").submit();
	});

	$("#cancelEdit").on("click", function(){
		$("#details").attr("action", "");
		$("#details").submit();
	});

</script>
<?php include("includes/footer.php"); ?>