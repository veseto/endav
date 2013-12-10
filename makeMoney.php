<?php

	if (!isset($_SESSION['uid'])) {
		echo "<div> <h3>You have to activate your profile (activation email has been sent) and log in to start money making</h3></div>";		
	} else {
		?>
		<div>
			<h3> Start making money faster?</h3>
			<a data-toggle="modal" href="pay.php" class="btn btn-success">Proceed</a>
		</div>
		<?php
		include("adverts.php");
	}


?>