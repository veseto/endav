<?php
  include ("../security.php");
  sec_session_start();
  include('../constants.php');
include("../processBinar.php");


// PayPal settings
$paypal_email = 'ludataaa-facilitator@mail.bg';
$return_url = "http://dev.endav.com/paypal/paymentsResponse.php";
$cancel_url = $url.'payment-cancelled.php';
$notify_url = "http://dev.endav.com/paypal/paymentsResponse.php";


// Include Functions
include("functions.php");
include("../connection.php");
$count = $mysqli->query("SELECT COUNT(*) from relations_binar where userId=".$_SESSION['uid'])->fetch_array()[0];
if ($count + $_POST['quantity'] <= $maxBinarPositions) {

// Check if paypal request or response


	// Firstly Append paypal account to querystring
	$querystring .= "?business=".urlencode($paypal_email)."&";	
	
	// Append amount& currency (£) to quersytring so it cannot be edited in html
	
	//The item name and amount can be brought in dynamically by querying the $_POST['item_number'] variable.
	$querystring .= "item_name=".urlencode($item_name)."&";
	$querystring .= "amount=".urlencode($binarPositionPrice)."&";
	
	//loop for posted values and append to querystring
	foreach($_POST as $key => $value){
		$value = urlencode(stripslashes($value));
		$querystring .= "$key=$value&";
	}
	
	// Append paypal return addresses
	$querystring .= "return=".urlencode(stripslashes($return_url))."&";
	$querystring .= "cancel_return=".urlencode(stripslashes($cancel_url))."&";
	$querystring .= "notify_url=".urlencode(stripcslashes($notify_url));
	
	// Append querystring with custom field
	//$querystring .= "&custom=".USERID;
	
	// Redirect to paypal IPN
	header('location:https://www.sandbox.paypal.com/cgi-bin/webscr'.$querystring);
	exit();
} else {
	$_SESSION['msg'] = "MAX_BINAR_REACHED";
	header("Location: ../pay.php");
	exit;
}

	
?>