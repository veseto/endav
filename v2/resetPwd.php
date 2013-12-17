<?php
	include("includes/header.php");
	include("includes/connection.php");
	if (!isset($_SESSION["reset"])) {
		//header("Location: index.php");
	} else {
		$email = $_SESSION['email'];
		$_SESSION = array();
	}
?>
<div class="container">
			<div class="signup">
		        <div class="col-lg-4">
		        </div>
		        <div class="col-lg-4">
			      <form class="form-signin" role="form" method="post" action="usrPasswordReset.php">
			        <h3 class="form-signin-heading">Fill new password</h3>
			        <input type="text" class="form-control" id="email" name="email" value=<?php echo $email ?> disabled>
			        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
			        <input type="password" class="form-control" id="password_confirm" name="password_confirm" placeholder="Verify password" required>
			        <input type="hidden" value=<?php echo $email;?> id="updemail" name="updemail"/>
			        <button class="btn btn-md btn-warning btn-block" type="submit">Change password</button>
			      </form>
		        </div>
		        <div class="col-lg-4">
		        </div>
	        </div>
	      </div>
<?php
	include("includes/footer.php");
?>