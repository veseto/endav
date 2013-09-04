<?php
  include("processBinar.php");
  if (isset($_SESSION['uid']) && isset($_POST['group1'])) {
  	if (isset($_SESSION['binar']) && $_SESSION['binar'] == '1') {
      $state = addBinarUserWithReffer($_SESSION['uid'], $_SESSION['uid']);
    } else if (isset($_SESSION['ref'])) {
  		$state = addBinarUserWithReffer($_SESSION['uid'], $_SESSION['ref']);
    } else {	
    	$state = addBinarUser($_SESSION['uid']);
  	}
    if ($state === "OK") {
      $_SESSION['binar'] = '1';
    }
    //header("Location: index.php");
  }

?>