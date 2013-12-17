<?php include("includes/header.php"); ?>

		<div class="container">
			<div class="signup">
		        <div class="col-lg-4">
		        </div>
		        <div class="col-lg-4">
			      <form class="form-signin" role="form"  method="post" action="usrPasswordReset.php">
			      	<h3 class="form-signin-heading">Enter your email</h3>
			        <input type="text" class="form-control" placeholder="Email address or username" required autofocus name="email">
			        <button class="btn btn-md btn-warning btn-block" type="submit">Reset password</button>
			      </form>
		        </div>
		        <div class="col-lg-4">
		        </div>
	        </div>
	      </div>

<?php include("includes/footer.php"); ?>