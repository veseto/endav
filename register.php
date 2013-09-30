<?php
	include("header.php");
	include("connection.php");

	$_SESSION = array();
?>

<?php
	$code = (isset($_SESSION['code']) ? $_SESSION['code'] : null);
	if ($code === 1) {
		echo "Email already in use";
	}
	unset($_SESSION['code']);
	if (isset($_SESSION['msg'])) {
		echo $_SESSION['msg'];
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
		if (!isset($_GET["ref"])) {
			$_SESSION['ref'] = 0;
			echo '<input class="span3" id="refMail" name="refMail" type="text" placeholder="referral">';
			//echo '<input type="text" name="refMail" id="refMail" class="input-block-level" placeholder="refferal email"/> <br>';
		} else {
			$email = "";
			$res = $mysqli->query("SELECT * from user");
			$found = false;
			while ($row = $res->fetch_array()) {
				if (sha1("rand1".$row['userId']."q1w2e3r4") === $_GET["ref"]) {
					$_SESSION["ref"] = $row["userId"];		
					$email = $row['email'];
					$found = true;
					break;
				}
			}
			if ($found) {
				$refferalUser = $mysqli->query("SELECT email from user where userId=".$_SESSION['ref'])->fetch_array()['email'];
			//echo '<input type="text" name="refMail" id="refMail" class="input-block-level" value='.$refferalUser.' disabled/> <br>';
				echo '<input class="span3" name="refMail" id="refMail" type="text" value='.$refferalUser.' disabled/>';
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