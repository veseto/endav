<?php
	include("includes/connection.php");
	include("includes/header.php");	
		if (isset($_POST['optionsRadios']) && $_POST['optionsRadios'] == "yes") {
			if ($stmt = $mysqli->prepare("SELECT email from user where refLink=? OR email=?")){
				$stmt->bind_param("ss", $_POST['refMail'], $_POST['refMail']);
				//setcookie("ref", "", time() - 36000);
				$stmt->bind_result($refferalUser);
				$stmt->execute();
				$stmt->fetch();
				$stmt->close();
			}
			if ($refferalUser != NULL && $refferalUser != "") {
				$_SESSION['refMail'] = $refferalUser;
				header("Location: signup-user.php");
				//print_r($_SESSION);
			} else {
				$_SESSION['err'] = "Wrong or non existing referral ID or email";
			}
		} else if (isset($_POST['optionsRadios']) && $_POST['optionsRadios'] == "no"){
			if (isset($_SESSION['refMail'])) {
				unset($_SESSION['refMail']);
			} 
			header("Location: signup-user.php");
		}

?>
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
				<ol class="breadcrumb-mod">
				  <li><span class="glyphicon glyphicon-home"></span> <a href="index.php">Home</a></li>
				  <li><a href="signup.php">Choosing a plan</a></li>
				  <li class="active">Referrals</li>
				  <h2>Referrals</h2>
				</ol>
		        <div class="col-lg-4">
		        </div>
		        <div class="col-lg-3">
					<h3 class="form-signin-heading">Referral</h3>
					<form class="form-signin" role="form" method="post" action="">
					<div class="radio">
						
						<label>
						<input type="radio" name="optionsRadios" id="optionsRadios1" value="yes" checked>
						I have a referral:
						<input class="form-control" id="refMail" name="refMail" type="text" placeholder="Referral email or ID" required/>
						</label>
					</div>
					<div class="radio">
						<label>
						<input type="radio" name="optionsRadios" id="optionsRadios2" value="no">
						I don't have a referral
						</label>
						<button class="btn btn-md btn-warning btn-block" type="submit" id="next" name="next">Next</button>
					</div>
				</form>

		        </div>
		        <div class="col-lg-5">
		        </div>
	        </div>
	      </div>

	      <script type="text/javascript">
			$('input:radio[name="optionsRadios"]').change(
		    function(){
		        if ($(this).is(':checked')) {
		            if ($(this).val() == "no") {
		            	$("#refMail").prop("disabled", true);
		            	$("#refMail").prop("required", false);
		            } else {
		            	$("#refMail").prop("disabled", false);
		            	$("#refMail").prop("required", true);
		            }
		        }
		    });
		</script>
<?php
	include("includes/footer.php");
?>