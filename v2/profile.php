<?php include("includes/header.php"); ?>
<?
	include('includes/connection.php');
	include('includes/constants.php');
	if (!isset($_SESSION["uid"])) {
		header('Location: index.php');
	}
	if ($stmt = $mysqli -> prepare("SELECT refLink, country, telephone from user where userId=?")) {
		$stmt -> bind_param("s", $_SESSION['uid']);
		$stmt -> bind_result($refLink, $country, $telephone);
		$stmt -> execute();
		$stmt -> fetch();
		$stmt -> close();
	}
?>
<div class="container">
	<h3> Welcome, <?php echo $_SESSION['email']?></h3>
      <div class="row">
        <div class="col-sm-4 pull-right">
          <div class="panel panel-danger">
            <div class="panel-heading">
              <h3 class="panel-title">Available Cash</h3>
            </div>
            <div class="panel-body">
            	51€
            </div>
          </div>
          <div class="panel panel-warning">
            <div class="panel-heading">
              <h3 class="panel-title">Bonus Positions in Level 1</h3>
            </div>
            <div class="panel-body">
              9
            </div>
          </div>
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title">Bonus Positions in Level 2</h3>
            </div>
            <div class="panel-body">
              9
            </div>
          </div>
          <div class="panel panel-success">
            <div class="panel-heading">
              <h3 class="panel-title">Bonus Positions in Level 3</h3>
            </div>
            <div class="panel-body">
              9
            </div>
          </div>
        </div><!-- /.col-sm-4 -->
        <div class="col-sm-8">
			<div class="panel panel-warning">
			  <!-- Default panel contents -->
			  <div class="panel-heading">Panel heading</div>
			  <div class="panel-body">
			  	Referral ID: <span class="text-success"><strong><?php echo $refLink ?></strong></span>
			  </div>

			  <!-- List group -->
			  <ul class="list-group">
			    <li class="list-group-item">Country: Bulgaria</li>
			    <li class="list-group-item">Phone Number: +359 888 888 888</li>
			    <li class="list-group-item">City: Sofia</li>
			    <li class="list-group-item">Address: Vitosha blvd.</li>
			    <li class="list-group-item">Birth Date: 01-JAN-1970</li>
			  </ul>
			</div>
		  <div class="row">
		  	<div class="col-md-2">
		  			<h5>Referral ID2</h5>
		  	</div>
		  	<div class="col-md-6">
		  		<div class="well well-sm inline">
					<?php echo $refLink ?>
		  		</div>
		  	</div>
		  </div>
      </div>
</div>
<?php include("includes/footer.php"); ?>