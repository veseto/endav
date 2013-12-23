<?php
	include("includes/header.php");
	include("includes/connection.php");
?>
	<div class="container">
		<ol class="breadcrumb-mod">
		  <li><span class="glyphicon glyphicon-home"></span> <a href="index.php">Home</a></li>
		  <li class="active">Password reset successfully</li>
		  <h2>Password reset successfully</h2>
		</ol>

		<div class="container">
			<div class="col-lg-3">
			</div>
			<div class="col-lg-6">
				<div class="panel panel-success">
					<div class="panel-heading">
						<h3 class="panel-title">Password reset successfully</h3>
					</div>
					<div class="panel-body">
						<p>Instructions how to proceed have been sent to your email.</p>
						<p>You can immediately return <a href="index.php" class="text-primary">home</a> or wait 10 seconds to be redirected automatically.</p>
					</div>
				</div>	
			</div>
			<div class="col-lg-3">
			</div>
		</div>
	</div>
<?
	include("includes/footer.php");
?>