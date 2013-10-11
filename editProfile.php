<?php
	include('header.php');
	include('connection.php');
	include('constants.php');
	if (!isset($_SESSION["uid"])) {
		header('Location: index.php');
	}
	if ($stmt = $mysqli->prepare("SELECT email, country, telephone, refferal FROM user WHERE userId=?")) {
		$stmt -> bind_param("s", $_SESSION['uid']);
		$stmt -> bind_result($email, $country, $telephone, $refferal);
		$stmt -> execute();
		$stmt -> fetch();
		$stmt -> close();
	}
?>

	<div class="control-group">
		<form id="editProfileForm" method="post" action="usrEditProfile.php">
	  <div class="controls">
	    <div class="input-prepend">
	      <span class="add-on"><i class="icon-envelope"></i></span>
	      <input class="span3" id="email" name="email" type="text" value=<?php echo $email?> disabled>
	    </div>
	  </div>
	  <div class="controls">
	    <div class="input-prepend">
	      <span class="add-on"><i class="icon-lock"></i></span>
	      <input class="span3" id="country" name="country" type="text" <?php if ($country){ echo "value=$country"; } else { echo "placeholder='country'";};?>>
	    </div>
	  </div>
	  <div class="controls">
	    <div class="input-prepend">
	      <span class="add-on"><i class="icon-lock"></i></span>
	      <input class="span3" id="telephone" name="telephone" type="text" <?php if ($telephone) { echo "value=$telephone";} else {echo "placeholder='telephone'";};?>>
	    </div>
	  </div>
		<button class="btn btn-success" name="submit" type="submit">Update profile info</button>
	</form>
	</div>
<?php
	include("footer.php");
?>