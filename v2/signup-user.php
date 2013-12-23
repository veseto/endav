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

<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js"></script>
<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/additional-methods.js"></script>
<script type="text/javascript" src="js/jquery.tooltipster.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/tooltipster.css" />
	

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
				  <li><a href="refferal.php">Referrals</a></li>
				  <li class="active">Sign Up as an End User</li>
				  <h2>Sign Up as an End User</h2>
				</ol>
		        <div class="col-lg-3">
		        </div>
		        <div class="col-lg-6">
				<div class="panel panel-default">
					<div class="panel-body">
					      <form class="form-signin" role="form" method="post" action="usrregister.php" id="regForm">
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
					        <input type="text" class="form-control" placeholder="Your email" autofocus name="email">
					        <input type="password" class="form-control" placeholder="Password" name="password1" id="password1">
							<div class="input-group">
						        <input type="password" class="form-control" placeholder="Repeat password" name="password_confirm">
								<span class="input-group-btn">
									<input class="btn btn-primary" type="submit" value="Go" />
								</span>
							</div>
					        <label class="checkbox">
			      				<input type="checkbox" name="agree" value="agree"/> I agree with <strong><a class="text-primary" data-toggle="modal" data-target="#myModal">Terms of use</a>.</strong>
					        </label>
					      </form>
				      </div>
			      </div>
		        </div>
		        <div class="col-lg-3">
		        </div>
	        </div>
	      </div>

<script type="text/javascript">
	$(document).ready(function () {

    // initialize tooltipster on form input elements
    $('#regForm input').tooltipster({ 
        trigger: 'custom', // default is 'hover' which is no good here
        onlyOne: false,    // allow multiple tips to be open at a time
        position: 'left',  // display the tips to the right of the element
        theme: '.tooltipster-shadow',
        timer: 5000
    });

});

	$("#regForm").validate({
		 errorPlacement: function (error, element) {
            $(element).tooltipster('update', $(error).text());
            $(element).tooltipster('show');
        },
        success: function (label, element) {
            $(element).tooltipster('hide');
        },
		rules: {
			password1: {
				required: true,
				minlength: 5
			},
			password_confirm: {
				required: true,
				minlength: 5,
				equalTo: "#password1"
			},
			email: {
				required: true,
				email: true
			},
			agree: "required"
		},
		messages: {
			password1: {
				required: "Please provide a password",
				minlength: "Your password must be at least 5 characters long"
			},
			confirm_password: {
				required: "Please provide a password",
				minlength: "Your password must be at least 5 characters long",
				equalTo: "Please enter the same password as above"
			},
			email: "Please enter a valid email address",
			agree: "Please accept our policy"
		}
	});

	
</script>


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
        <button type="button" class="btn btn-primary" data-dismiss="modal">Sounds good!</button>
<!--         <button type="button" class="btn btn-warning" id="agree">I agree</button>-->      
	</div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php
	include("includes/footer.php");
?>