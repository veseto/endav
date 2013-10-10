<?php
	include("header.php");

?>
<script src="js/validation/lib/jquery.js"></script>
<script src="js/validation/jquery.validate.js"></script>
<script src="js/validation/additional-methods.js"></script>


	<div class="control-group">
		<form id="reset" method="post" action="usrPasswordReset.php">
	  <div class="controls">
	    <div class="input-prepend">
	      <span class="add-on"><i class="icon-envelope"></i></span>
	      <input class="span3" id="email" name="email" type="text" placeholder="email address">
	    </div>
	  </div>
		<button class="btn btn-success" name="submit" type="submit">Reset</button>
	</form>
	</div>


<style type="text/css">
#registerForm label.error {
	margin-left: 10px;
	/*width: auto;*/
	display: inline;
}
</style>

<script>
$( "#reset" ).validate({
  rules: {
    email: {
      required: true,
      email: true
    }
  }
});
</script>



<?php
	include("footer.php");
?>