<?php include("includes/header.php"); ?>
<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js"></script>
<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/additional-methods.js"></script>

		<div class="container">
			<ol class="breadcrumb-mod">
			  <li><span class="glyphicon glyphicon-home"></span> <a href="index.php">Home</a></li>
			  <li class="active">Log in</li>
			  <h2>Log in</h2>
			</ol>
		</div>
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
			<div class="col-lg-3">
				
			</div>
			<div class="col-lg-6">
				<div class="panel panel-default">
					<div class="panel-body">
				      <form class="form-signin" role="form" method="post" action="usrlogin.php" id="loginForm">
				        <input type="text" class="form-control" placeholder="Email" autofocus name="email" id="email">
						<div class="input-group">
						  <input type="password" class="form-control" placeholder="Password" name="password" id="password">
						  <span class="input-group-btn">
						    <input class="btn btn-primary" type="submit" value="Login" />
						  </span>
						</div>
				        <label class="checkbox">
				          <input type="checkbox" name="rememberme" value="ok" id="remember-me"> Remember me | <a href='password-retrieval.php' class="text-primary">Can't login?</a>
				        </label>
				      </form>
					</div>
				</div>	
			</div>
			<div class="col-lg-3">
				
			</div>
		</div>

<script type="text/javascript">
	$("#loginForm").validate({
		rules: {
			password: {
				required: true,
				minlength: 5
			},
			email: {
				required: true,
				email: true
			}
		},
		messages: {
			password: {
				required: "Please provide a password",
				minlength: "Your password must be at least 5 characters long"
			},
			email: "Please enter a valid email address",
		}
	});

	
</script>

<?php include("includes/footer.php"); ?>