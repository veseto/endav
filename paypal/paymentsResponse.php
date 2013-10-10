<?php
  	include ("../security.php");
  	sec_session_start();
	include("../constants.php");
	include("../processBinar.php");
	include("../connection.php");
	
	  if (isset($_SESSION['uid'])) {
			$q0 = "INSERT INTO `paymets`(`paymentId`, `paymentDate`, `paymentStatus`, `paymentType`, `paymentFee`, `tax`, `payerId`, `payerEmail`, `firstName`, `lastName`, `payerStatus`, `quantity`, `intemNumber`, `currency`, `itemName`, `finalPrice`, `shipping`, `auth`, `verifySign`, `business`, `receiverEmail`, `receiverId`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
			if ($stmt = $mysqli->prepare($q0)) {
				$stmt->bind_param("ssssddsssssiissddsssss", $_POST['txn_id'], $_POST['payment_date'], $_POST['payment_status'], $_POST['payment_type'], $_POST['payment_fee'], $_POST['tax'], $_POST['payer_id'], $_POST['payer_email'], $_POST['first_name'], $_POST['last_name'], $_POST['payer_status'], $_POST['quantity'], $_POST['item_number'], $_POST['mc_currency'], $_POST['item_name'], $_POST['payment_gross'], $_POST['shipping'], $_POST['auth'], $_POST['verify_sign'], $_POST['business'], $_POST['receiver_email'], $_POST['receiver_id']);
				$stmt->execute();
				$stmt->close();
			}
		  	for ($i = 0; $i < $_POST['quantity']; $i++) {
		  		if (isset($_SESSION['binar']) && $_SESSION['binar'] == '1') {
		      		$state = addBinarUserWithReffer($_SESSION['uid'], $_SESSION['uid']);
			    } else if (isset($_SESSION['ref'])) {
			  		$state = addBinarUserWithReffer($_SESSION['uid'], $_SESSION['ref']);
			    } else {	
			    	$state = addBinarUser($_SESSION['uid']);
			    	
			  	}
			    if ($state === "OK") {
			      $_SESSION['binar'] = '1';
			      $_SESSION['msg'] = 'BUY_SUCCESS';
			    }
		   }
		   header("Location: ../index.php");
  }
	
?>