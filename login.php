<?php
	include("header.php");
	if (isset($_SESSION["uid"])) {
		echo "You are logged in as ".$_SESSION["email"];
		echo "<br><a href='usrlogout.php'> Log out </a><br>";
	} else {
?>

<script src="js/validation/lib/jquery.js"></script>
<script src="js/validation/jquery.validate.js"></script>
<script src="js/validation/additional-methods.js"></script>

	<div class="input-group">
		<form class="form-signin" method="post" action="usrlogin.php" id="login">
  			<input type="text" name="email" id="email" class="input-block-level" placeholder="email"/>
			<input type="password" name="password" id="password" class="input-block-level" placeholder="password"/> <br>
	        <label class="checkbox">
	          <input type="checkbox" value="remember-me"> Remember me
	        </label>
	        <button class="btn btn-large btn-primary btn-block" type="submit">Log in</button>
		</form>
	</div>

	<script>
$( "#login" ).validate({
  rules: {
    email: {
      required: true,
      email: true
    },
    password: {
    	minlength: 5,
    	required: true
    }
  }
});
</script>

<?php 
	}
	include("footer.php"); 
?>