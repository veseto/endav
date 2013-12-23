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
	<ol class="breadcrumb-mod">
	  <li><span class="glyphicon glyphicon-home"></span> <a href="index.php">Home</a></li>
	  <li class="active">My Profile</li>
	  <h2>My Profile</h2>
	</ol>
	<div class="row">
		<div class="col-sm-4 pull-right">
	  <div class="panel panel-info">
	    <div class="panel-heading">
	      <h3 class="panel-title">Balance<button class="btn btn-default btn-xs pull-right disabled">Add</button></h3>
	    </div>
	    <div class="panel-body">
	    	<p>Cash: <strong><?php echo number_format($arr["cash"], 2); ?></strong></p>
	      	<p>In-site money: <strong><?php echo number_format($arr["inSite"], 2); ?></strong></p>
			<div class="btn-group btn-group-justified">
				<a class="btn btn-default disabled" role="button" href="#">Cashflow</a>
				<a class="btn btn-default disabled" role="button" href="#">History</a>
				<a class="btn btn-default disabled" role="button" href="#">Withdraw</a>
			</div>
	    </div>
	  </div>
	  <div class="panel panel-info">
	    <div class="panel-heading">
	      <h3 class="panel-title">Bonus Positions<a href="pay.php" class="btn btn-default btn-xs pull-right">Buy</a></h3>
	    </div>
	    <div class="panel-body">
			<p>Bonus Positions in Level 1: <span class="text-danger"><strong><?php echo $bounusLvl1; ?></strong></span></p>
			<p>Bonus Positions in Level 2: <strong><?php echo $bounusLvl2; ?></strong></p>
			<div class="btn-group btn-group-justified">
				<a class="btn btn-default" role="button" href="visualizationFree.php" target="_blank">Standard</a>
				<a class="btn btn-warning" role="button" href="visualizationBinar.php" target="_blank">Binar</a>
			</div>
	    </div>
	  </div>
		</div><!-- /.col-sm-4 -->
		<div class="col-sm-6">
		<div class="panel panel-primary">
		  <div class="panel-body" id="detailsPannel">Referral ID
		  	<span class="text-default pull-right"><strong><abbr title="Send this to your friends"><?php echo $refLink ?></abbr></strong></span>
		  </div>
		</div>

		<div class="panel panel-primary">
		  <!-- personal details panel -->
		  <div class="panel-heading" id="detailsPannel">Personal Details <button id="editDetails" class="btn btn-default btn-xs pull-right">Edit</button> <button id="saveDetails" style="display: none;" class="btn btn-default btn-xs pull-right">Save</button> <button id="cancelEdit" style="display: none;" class="btn btn-default btn-xs pull-right">Cancel</button></div>



		  <!-- List group -->
		  <ul class="list-group" >
		  	<form id="details" action="" method="post">
			    <li class="list-group-item"><select id="countries_phone1" class="form-control bfh-countries" data-country=<?php echo $country;?> disabled name="country" data-flags="true"></select></li>
			    <li class="list-group-item"><input id="phone" name="phone" type="text" class="form-control bfh-phone" data-country="countries_phone1" value=<?php echo substr($phone, strpos($phone, " ") + 1);?> disabled ></input></li>
			    <li class="list-group-item">City <span class="val pull-right"><?php echo $city; ?></span></li>
			    <li class="list-group-item">Address <span class="val pull-right"><?php echo $address; ?></span></li>
			    <li class="list-group-item">Birth Date <span class="val pull-right"><?php echo $bday; ?></span></li>
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
			if ($(this).index() == 0) {	
				$(this).find("#countries_phone1").removeProp("disabled");
			} else if ($(this).index() == 1) {
				$(this).find("#phone").removeProp("disabled");
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