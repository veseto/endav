<?php include("includes/header.php"); ?>
<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js"></script>
<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/additional-methods.js"></script>

		<div class="container">
			<ol class="breadcrumb-mod">
			  <li><span class="glyphicon glyphicon-home"></span> <a href="index.php">Home</a></li>
			  <li class="active">Reset your password</li>
			  <h2>Reset your password</h2>
			</ol>
			<?php
				if (isset($_SESSION['err'])) {
					echo '<div class="alert alert-warning fade in">  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> '.$_SESSION['err'].'</div>';
					unset($_SESSION['err']);
				}
			?>
			<div class="col-lg-3">
				
			</div>
			<div class="col-lg-6">
				<div class="panel panel-default">
					<div class="panel-body">
				<form role="form"  method="post" action="usrPasswordReset.php" id="sendMail">
				<div class="input-group">
				  <input type="text" class="form-control" placeholder="Email" required autofocus name="email">
				  <span class="input-group-btn">
				    <input class="btn btn-primary" type="submit" value="Reset" />
				  </span>
				</div>
				</form>  
				</div>
				</div>

			</div>
			<div class="col-lg-3">
				
			</div>
		</div>

		<script type="text/javascript">
			$("#sendMail").validate({
				rules: {
					email: {
						required: true,
						email: true
					}
				},
				messages: {
					email: "Please enter a valid email."
				}
			});
		</script>

<?php include("includes/footer.php"); ?>