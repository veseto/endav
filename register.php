<?php
	include("header.php");
	include("connection.php");
?>
<?php
	if (isset($_SESSION['msg'])) {
		echo "	<div class='alert alert-error'>";
		echo $lang[$_SESSION['msg']];
		echo "</div>";
		unset($_SESSION['msg']);
	}

	if (isset($_SESSION['uid'])) {
		$page = $_SERVER['PHP_SELF'];
		setcookie("endav", "", time() - 36000);
		$_SESSION = array();
		if (isset($_GET['ref'])) {
			$page = $page."?ref=".$_GET['ref'];
		}
		header("Location: $page");
	}
?>
<script src="js/validation/lib/jquery.js"></script>
<script src="js/validation/jquery.validate.js"></script>
<script src="js/validation/additional-methods.js"></script>


	<div class="control-group">
		<form id="registerForm" method="post" action="usrregister.php">
	  <div class="controls">
	    <div class="input-prepend">
	      <span class="add-on"><i class="icon-thumbs-up"></i></span>
	      <?php
		if (!isset($_GET['ref'])) {
			$_SESSION['ref'] = 0;
			echo '<input class="span3" id="refMail" name="refMail" type="text" placeholder="referral">';
			//echo '<input type="text" name="refMail" id="refMail" class="input-block-level" placeholder="refferal email"/> <br>';
		} else {
			$email = "";
			//$ref = "'".$_GET['ref']."'";
			if ($stmt = $mysqli->prepare("SELECT email from user where refLink=?")){
				$stmt->bind_param("s", $_GET['ref']);
				//setcookie("ref", "", time() - 36000);
				$stmt->bind_result($refferalUser);
				$stmt->execute();
				$stmt->fetch();
				echo '<input class="span3" name="r" id="r" type="text" value='.$refferalUser.' disabled/>';
				echo '<input name="refMail" id="refMail" type="hidden" value='.$refferalUser.'>';

				$stmt->close();
			} else {
				echo '<script> alert("Refferal link is not correct") </script>';
				echo '<input class="span3" id="refMail" name="refMail" type="text" placeholder="referral">';
			}
		}
	?>
	      
	    </div>
	  </div>
	  <div class="controls">
	    <div class="input-prepend">
	      <span class="add-on"><i class="icon-envelope"></i></span>
	      <input class="span3" id="email" name="email" type="text" placeholder="email address">
	    </div>
	  </div>
	  <div class="controls">
	    <div class="input-prepend">
	      <span class="add-on"><i class="icon-lock"></i></span>
	      <input class="span3" id="password" name="password" type="password" placeholder="password">
	    </div>
	  </div>
	  <div class="controls">
	    <div class="input-prepend">
	      <span class="add-on"><i class="icon-lock"></i></span>
	      <input class="span3" id="password_confirm" name="password_confirm" type="password" placeholder="verify password">
	    </div>
	  </div>
	    <label class="checkbox">
	      <input type="checkbox" name="agree" id="agree" value="agree"> I agree with <a href="#">terms of use</a>.
	    </label>
	    <label class="checkbox">
	      <input type="checkbox" name="advertiser" id="advertiser" value="1"> I want to be advertiser.
	    </label>
		<button class="btn btn-success" name="submit" type="submit">SIGN UP</button>
	</form>
	</div>

<style type="text/css">
#registerForm label.error {
	margin-left: 10px;
	/*width: auto;*/
	display: inline;
}
</style>

<script>
$( "#registerForm" ).validate({
  rules: {
    email: {
      required: true,
      email: true
    },
    refMail: {
    	email: true
    },
    password: {
    	minlength: 5,
    	required: true
    },
    password_confirm: {
    	equalTo: "#password"
    },
    agree: {
    	required: true
    }
  }
});
</script>



<?php
	include("footer.php");
?>