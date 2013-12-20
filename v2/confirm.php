<?php
	include("includes/header.php");
	include("includes/constants.php");
	include("includes/keyGenerator.php");
	include("includes/connection.php");
	include("includes/processFree.php");
	
	if (!isset($_GET['id'])) {
		header('Location: index.php');
	}
	$salt = "'".$_GET['id']."'";

	$q = "SELECT * FROM user where salt=$salt";
	if($result = $mysqli->query($q)){
		$u = $result->fetch_array();
		$refLink = keyGen($u['userId']);
		if ($u['activated'] === '0' || $u['activated'] === 0) {
			if($stmt = $mysqli->prepare("UPDATE user SET activated = '1', refLink=?, salt = NULL WHERE userId='".$u['userId']."'")) {
				$stmt->bind_param("s", $refLink);
				$stmt->execute();
				addFreeUser($u['userId'], $u['refferal']);
				mail($u['email'], "Your refferal link", $url."signup-user.php?ref=".$refLink);
				$stmt->close();
				$_SESSION = array();
				$_SESSION['status'] = 'OK';
				$_SESSION['succ'] = 'ACCOUNT_ACTIVATION_OK';
				//header('Location: index.php');
			} else {
				echo $mysqli->error;
			}
		} else {
				//echo "<script> alert('user is already activated');</script>";
			$_SESSION['err'] = "USER_ALREADY_ACTIVATED";
			//header('Location: index.php');
		}		
	} else {
		echo $mysqli->error;
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
			<div class="col-lg-3">
				
			</div>
			<div class="col-lg-6">
					
						<h3> Your account has been activated - you can now log in </h3>
				     	<a class="btn btn-warning" href="index.php"> Navigate home </a>
			</div>
			<div class="col-lg-3">
				
			</div>
		</div>

<?php include("includes/footer.php"); ?>