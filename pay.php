<?php
	include('header.php');
	if (!isset($_SESSION["uid"])) {
		header('Location: index.php');
	}
?>
	<div id="payment" class="input-group">
		


<form id="paypal_form" class="paypal" action="paypal/payments.php" method="post">

	<select name="quantity" id="quantity">
		<option value="1">1</option>
		<option value="2">2</option>
		<option value="3">3</option>
		<option value="4">4</option>
	</select></br>

    <input name="cmd" type="hidden" value="_xclick" />
    <input name="no_note" type="hidden" value="1" />
    <input name="lc" type="hidden" value="UK" />
    <input name="no_shipping" type="hidden" value="1" />
    <input name="currency_code" type="hidden" value="USD" />
    <input name="bn" type="hidden" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHostedGuest" />
    <input name="payer_email" type="hidden" value=<?php echo $_SESSION['email'];?> />
    <input name="item_number" type="hidden" value="0001" />
    <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">

  </form>

	</div>
<?php
	include("footer.php");
?>