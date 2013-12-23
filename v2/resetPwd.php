<?php
	include("includes/header.php");
	include("includes/connection.php");
	if (!isset($_SESSION["reset"])) {
		header("Location: index.php");
	} else {
		$email = $_SESSION['email'];
		$_SESSION = array();
	}
?>

<div class="container">
	<ol class="breadcrumb-mod">
	  <li><span class="glyphicon glyphicon-home"></span> <a href="index.php">Home</a></li>
	  <li class="active">New Password</li>
	  <h2>New Password</h2>
	</ol>
</div>
<div class="container">
	<div class="col-lg-3">
		
	</div>
	<div class="col-lg-6">
		<div class="panel panel-default">
			<div class="panel-body">
			      <form class="form-signin" role="form" method="post" action="usrPasswordReset.php">
					<div class="form-group has-warning">
			        <input type="text" class="form-control" id="email" name="email" value=<?php echo $email ?> disabled>
					</div>
			        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
			        <input type="hidden" value=<?php echo $email;?> id="updemail" name="updemail"/>
					<div class="input-group">
					<input type="password" class="form-control" id="password_confirm" name="password_confirm" placeholder="Verify password" required>
					  <span class="input-group-btn">
					    <input class="btn btn-primary" type="submit" value="Go" />
					  </span>
					</div>


			      </form>
			</div>
		</div>	
	</div>
	<div class="col-lg-3">
		
	</div>
</div>
<?php
	include("includes/footer.php");
?>