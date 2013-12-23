<?php
	include('includes/header.php');

	if (!isset($_SESSION["uid"])) {
		header('Location: index.php');
	}
?>
<div class="container">
	<ol class="breadcrumb-mod">
	  <li><span class="glyphicon glyphicon-home"></span> <a href="index.php">Home</a></li>
	  <li class="active">Purchase positions in the binar tree</li>
	  <h2>Purchase positions in the binar tree</h2>
	</ol>
</div>
<div class="container">
	<div class="col-lg-3">
		
	</div>
	<div class="col-lg-6">
		<div class="panel panel-default">
			<div class="panel-body">
				<form id="paypal_form" class="paypal" action="paypal/payments.php" method="post">
<!-- 					<div class="bfh-slider" id="quantity" name="quantity" data-name="slider3" data-min="1" data-max="25">
						
					</div>
 -->				<span>I'd like to purchase 
				<?php
				include("includes/connection.php");
				include("includes/constants.php");
				$count = $mysqli->query("SELECT COUNT(*) from relations_binar where userId=".$_SESSION['uid'])->fetch_array()[0];
				if ($count + 1 <= $maxBinarPositions) {
					echo '<select name="quantity" id="quantity">
						<option value="1">1</option>';
				}
				for ($i = 2; $i < 21; $i ++) {
					if ($count + $i <= $maxBinarPositions){	
					echo "<option value=$i>$i</option>";
					}
				}
				if ($count + 1 <= $maxBinarPositions){
					?>
					  
					</select> postions.</span>
				    <input name="cmd" type="hidden" value="_xclick" />
				    <input name="no_note" type="hidden" value="1" />
				    <input name="lc" type="hidden" value="UK" />
				    <input name="no_shipping" type="hidden" value="1" />
				    <input name="currency_code" type="hidden" value="USD" />
				    <input name="bn" type="hidden" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHostedGuest" />
				    <input name="payer_email" type="hidden" value=<?php echo $_SESSION['email'];?> />
				    <input name="item_number" type="hidden" value="0001" />
				    <input type="image" src="https://www.paypalobjects.com/webstatic/mktg/logo/pp_cc_mark_37x23.jpg" class="pull-right" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">


					<?php
				} else {
					echo "$lang[MAX_BINAR_POSITIONS]</br>";
				}
				?>
				</form>
			</div>
		</div>	
	</div>
	<div class="col-lg-3">
		
	</div>
</div>
<?php
	include("includes/footer.php");
?>