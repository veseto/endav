<?php include("includes/header.php"); ?>

	<div class="container">
<!--
	  <ol class="breadcrumb well text-danger">
	    <li><a href="index.php">Home</a></li>
	    <li class="active">About</li>
	  </ol>
-->
		<ol class="breadcrumb-mod">
		  <li><span class="glyphicon glyphicon-home"></span> <a href="index.php">Home</a></li>
		  <li class="active">Contact Us</li>
		  <h2>Contact Us</h2>
		</ol>
		<div class="panel panel-default">
		  <div class="panel-body">
			<!-- right panel -->
			<div class="col-lg-1">
			</div>
			<div class="panel panel-info col-lg-4 pull-right">
			  <div class="panel-body">
				<address>
					<strong>Endav, Inc.</strong><br>
					795 Folsom Ave, Suite 600<br>
					San Francisco, CA 94107<br>
					<abbr title="Phone">P:</abbr> (123) 456-7890<br>
					<abbr title="Cell">C:</abbr> (999) 456-7890
				</address>
				<address>
					<strong>George Georgiev</strong><br>
					<a href="mailto:info@endav.com?subject=contact">info@endav.com</a>
				</address>
			  </div>
			</div><!-- //right panel -->
			<div class="col-lg-6">
				<h5>Please allow up to 24 hours response time to your emails.</h5>
					<form class="" role="form" method="post" action="usrlogin.php">
					<input type="text" class="form-control" placeholder="Email" required autofocus name="email">
					<textarea class="form-control" rows="5"></textarea>
					<button class="btn btn-md btn-primary" type="submit">Send</button>
					</form>
				<small><strong>Please note:</strong> All requests are logged by time, ip address.</small>
			</div>
			<div class="col-lg-1">
			</div>
		  </div>
		</div>
	</div>
      
<?php include("includes/footer.php"); ?>