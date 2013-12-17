<?php include("includes/header.php"); ?>

		<div class="container">
			<?php
				if (isset($_SESSION['err'])) {
					echo '<div class="alert alert-warning fade in">  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> '.$_SESSION['err'].'</div>';
					unset($_SESSION['err']);
				}
				if (isset($_SESSION['succ'])) {
					echo '<div class="alert alert-success fade in">  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> '.$_SESSION['succ'].'</div>';
					unset($_SESSION['succ']);
				}
			?>
			<div class="signup">
		        <div class="col-lg-4">
		        </div>
		        <div class="col-lg-4">
			      <form class="form-signin" role="form" method="post" action="usrlogin.php">
			        <h3 class="form-signin-heading">Please log in</h3>
			        <input type="text" class="form-control" placeholder="Email" required autofocus name="email">
			        <input type="password" class="form-control" placeholder="Password" required name="password">
			        <label class="checkbox">
			          <input type="checkbox" name="remember-me" value="ok"> Remember me | <a href='password-retrieval.php' class="text-primary">Can't login?</a>
			        </label>
			        <button class="btn btn-md btn-warning btn-block" type="submit">Log in</button>
			      </form>
		        </div>
		        <div class="col-lg-4">
		        </div>
	        </div>
	      </div>

<?php include("includes/footer.php"); ?>