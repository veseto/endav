<?php
	include("header.php");
	include("connection.php");
	if (!isset($_SESSION["reset"])) {
		header("Location: index.php");
	} else {
		$email = $_SESSION['email'];
		$_SESSION = array();
	}
?>

<script src="js/validation/lib/jquery.js"></script>
<script src="js/validation/jquery.validate.js"></script>
<script src="js/validation/additional-methods.js"></script>


	<div class="control-group">
		<form id="reset" method="post" action="usrPasswordReset.php">
	  <div class="controls">
	    <div class="input-prepend">
	      <span class="add-on"><i class="icon-envelope"></i></span>
	      <input class="span3" id="email" name="email" type="text" value=<?php echo $email ?> disabled>
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
	  	<input type="hidden" value=<?php echo $email;?> id="updemail" name="updemail"/>
		<button class="btn btn-success" name="submit" type="submit">change password</button>
	</form>
	</div>

<style type="text/css">
#reset label.error {
	margin-left: 10px;
	/*width: auto;*/
	display: inline;
}
</style>

<script>
$( "#reset" ).validate({
  rules: {
    updemail: {
      required: true,
      email: true
    }
    password: {
    	minlength: 5,
    	required: true
    },
    password_confirm: {
    	equalTo: "#password"
    }
  }
});
</script>



<?php
	include("footer.php");
?>