<?php
  include ("../security.php");
  sec_session_start();
include('../constants.php');
include("../processBinar.php");

	
	// assign posted variables to local variables
	$data['item_name']			= $_POST['item_name'];
	$data['item_number'] 		= $_POST['item_number'];
	$data['payment_status'] 	= $_POST['payment_status'];
	$data['payment_amount'] 	= $_POST['mc_gross'];
	$data['payment_currency']	= $_POST['mc_currency'];
	$data['txn_id']				= $_POST['txn_id'];
	$data['receiver_email'] 	= $_POST['receiver_email'];
	$data['payer_email'] 		= $_POST['payer_email'];
	$data['custom'] 			= $_POST['custom'];
	$data['quantity']			= $_POST['quantity'];
	  if (isset($_SESSION['uid'])) {
		  	for ($i = 0; $i < $data['quantity']; $i++) {
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
		   }
		    header("Location: ../index.php");
  }
	
?>