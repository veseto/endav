<?php
	include("includes/header.php");
	include("includes/connection.php");
?>
<?php
	if (isset($_SESSION['msg'])) {
		//echo "	<div class='alert alert-error'>";
		//echo $lang[$_SESSION['msg']];
		//echo "</div>";
		unset($_SESSION['msg']);
	}

	if (isset($_SESSION['uid'])) {
		$page = $_SERVER['PHP_SELF'];
		setcookie("endav", "", time() - 36000);
		$_SESSION = array();
		if (isset($_GET['ref'])) {
			$page = $page."?ref=".$_GET['ref'];
		}
		//header("Location: $page");
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
				<div class="well">Text</div>
		        <div class="col-lg-4">
		        </div>
		        <div class="col-lg-4">
			      <form class="form-signin" role="form" method="post" action="usrregister.php">
			        <h3 class="form-signin-heading">Enter your details</h3>
			        <?php
			        	if (isset($_SESSION['refMail'])) {
			        		echo '<input class="form-control" name="r" id="r" type="text" value='.$_SESSION['refMail'].' disabled/>';
							echo '<input name="refMail" id="refMail" type="hidden" value='.$_SESSION['refMail'].'>';
			        	} else if (isset($_GET['ref'])) {
							$ref = "'".$_GET['ref']."'";
							if ($stmt = $mysqli->prepare("SELECT email from user where refLink=?")){
								$stmt->bind_param("s", $_GET['ref']);
								//setcookie("ref", "", time() - 36000);
								$stmt->bind_result($refferalUser);
								$stmt->execute();
								$stmt->fetch();
								echo '<input class="form-control" name="r" id="r" type="text" value='.$refferalUser.' disabled/>';
								echo '<input name="refMail" id="refMail" type="hidden" value='.$refferalUser.'>';

								$stmt->close();
							} else {
								echo '<script> alert("Refferal link is incorrect") </script>';
								echo '<input class="form-control" id="refMail" name="refMail" type="text" placeholder="referral">';
							}
						}
					?>
			        <input type="text" class="form-control" placeholder="Your email" required autofocus name="email">
			        <input type="password" class="form-control" placeholder="Password" name="password" required>
			        <input type="password" class="form-control" placeholder="Repeat password" name="password_confirm" required>
			        <label class="checkbox">
	      				<input type="checkbox" name="agree" id="agree" value="agree" required> I agree with <strong><a class="text-primary" data-toggle="modal" data-target="#myModal">Terms of use</a>.</strong>
			        </label>
			        <button class="btn btn-md btn-warning form-inline" type="submit">Sign up</button> or <strong><a href="signup.php" class="form-inline text-primary">select another plan</a></strong>.
			      </form>
		        </div>
		        <div class="col-lg-4">
		        </div>
	        </div>
	      </div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Terms of Use</h4>
      </div>
      <div class="modal-body">
		<h3>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h3>
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent a nunc id arcu auctor placerat. Praesent et eleifend erat. Mauris sit amet purus pulvinar, auctor est vitae, facilisis mauris. Etiam facilisis laoreet tellus at faucibus. Praesent at ligula felis. Donec feugiat turpis id adipiscing ultrices. Maecenas non porta nulla, vitae fermentum eros.</p>
		<p>Sed vel posuere nunc. Aliquam eget sem eu nunc fringilla bibendum. Nunc gravida quis urna scelerisque euismod. Donec tempor eget mauris non laoreet. Ut aliquam est eu nulla tempus, in ullamcorper mauris aliquam. Morbi auctor iaculis nunc, nec egestas mauris. Proin mollis, ante nec rhoncus scelerisque, dui est pretium est, in imperdiet tortor lorem vel nunc. Proin eu consequat sapien. Maecenas rhoncus felis ac tortor convallis egestas et et elit. Nullam ut lorem tempus, aliquet justo vitae, gravida sem. Cras augue magna, lacinia ut augue in, condimentum faucibus erat. Pellentesque elementum id purus quis sodales. Suspendisse tempus lacus in gravida semper. Donec magna ipsum, tincidunt at iaculis a, pellentesque id nisl. Cras blandit malesuada mauris, sed imperdiet ante. Duis pharetra leo a ultrices ornare.</p>
		<p>Nunc sit amet tempor mi. Donec condimentum quam fringilla sem feugiat, id malesuada sapien ultrices. Nulla porttitor odio quis nulla interdum, id tempus augue molestie. Fusce sit amet arcu eu tortor gravida laoreet. Duis malesuada odio sit amet tincidunt laoreet. Vestibulum tincidunt lectus et odio ultrices, at mattis nisi blandit. Fusce tempor at ligula eu fringilla.</p>
		<h3>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h3>
		<p>Integer faucibus purus at lorem tempus, eget bibendum felis aliquam. Praesent sit amet ultrices nunc. Morbi congue, mi non pharetra cursus, justo lacus faucibus nisi, et accumsan tellus diam in libero. Cras semper auctor nulla, non eleifend elit eleifend quis. Sed dictum leo eu eleifend facilisis. Mauris bibendum quis tortor in scelerisque. Nulla facilisi. Vestibulum a suscipit turpis. Nulla facilisi. Nullam bibendum eleifend nisl et condimentum. Sed suscipit dolor ac condimentum tincidunt. Ut luctus gravida leo venenatis rhoncus. Integer massa mi, sollicitudin sit amet aliquet non, consectetur ac elit. Integer at lorem in diam lobortis ullamcorper. Nullam non enim fermentum, volutpat urna id, rutrum sem. Etiam in massa in velit lobortis convallis.</p>
		<p>Duis tempor adipiscing ipsum at ultricies. Fusce odio est, rutrum id sem et, pretium facilisis turpis. Pellentesque bibendum lorem in erat dictum ornare. Etiam imperdiet convallis pretium. Vestibulum ut justo congue, pretium risus in, faucibus elit. Aenean tempus convallis nisi, malesuada eleifend justo feugiat at. Ut et dolor diam. Pellentesque sagittis vulputate ultricies. Nulla dui velit, bibendum a rutrum et, sodales vel nisi. Pellentesque id elit pellentesque odio pharetra volutpat.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Nope, changed my mind</button>
        <button type="button" class="btn btn-warning">I agree</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php
	include("includes/footer.php");
?>