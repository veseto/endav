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


<div class="input-group">
<form class="form-signin" id="registerForm" method="post" action="usrregister.php">
	<?php
		if (!isset($_GET["ref"])) {
			$_SESSION["ref"] = -1;
			echo '<input type="text" name="refMail" id="refMail" class="input-block-level" placeholder="refferal email"/> <br>';
		} else {
			$_SESSION["ref"] = $_GET["ref"];
			$refferalUser = $mysqli->query("SELECT email from user where userId=".$_SESSION['ref'])->fetch_array()['email'];
			echo '<input type="text" name="refMail" id="refMail" class="input-block-level" value='.$refferalUser.' disabled/> <br>';
		}
	?>
	<input type="text" name="email" id="email" class="input-block-level" placeholder="email"/>
	<input type="password" name="password" id="password" class="input-block-level" placeholder="password"/>
	<input type="password" name="password_confirm" id="password_confirm" class="input-block-level" placeholder="confirm password"/>
    <label class="checkbox">
      <input type="checkbox" name="agree" value="agree"> I agree with <a href="#">terms of use</a>.
    </label>
	<button class="btn btn-large btn-primary btn-block" name="submit" type="submit">Register</button>
</form>

<style type="text/css">
#registerForm label.error {
	margin-left: 10px;
	/*width: auto;*/
	/*display: inline;*/
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


</div>
<?php
	include("footer.php");
?>