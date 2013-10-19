<?php
  include("header.php");
  //if (isset($_SESSION['status']) && $_SESSION['status'] === 'OK'){
  //  echo "<h3>You activated your account</h3>";
  //}
  //print_r($_SESSION);
  if (isset($_SESSION['uid'])) {
    if (isset($_SESSION['binar']) && $_SESSION['binar'] === '1') {
      echo "Congrats! You started making money <br />";
      
    }
    include('makeMoney.php');
  } else {
    if (isset($_SESSION['msg']) && $_SESSION['msg'] != "") {
      echo "  <div class='alert alert-success'>";
      echo $lang[$_SESSION['msg']];
      echo "</div>";
      unset($_SESSION['msg']);
    }
?>
      <div class="jumbotron">
        <h1><?php echo $lang["WELCOME"];?></h1>
        <p class="lead"><?php echo $lang["LONG_HEADER"];?></p>
        <p><div class="bs-example" style="padding-bottom: 24px;">
              <a data-toggle="modal" href="register.php" class="btn btn-primary btn-large">Register</a>
          </div></p>
      </div>
      <div class="row marketing">
        <div class="col-lg-6">
          <h4>Free user</h4>
          <p>You could start as free user and make money by .</p>

          <h4>Paid user</h4>
          <p>Blah-blah.</p>

          <h4>Company</h4>
          <p>Blah blah blah.</p>
        </div>

        <div class="col-lg-6">
          <h4>ticket</h4>
          <p>Donec id elit non mi porta gravida at eget metus. Maecenas faucibus mollis interdum.</p>

          <h4>Subheading</h4>
          <p>Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Cras mattis consectetur purus sit amet fermentum.</p>

          <h4>Subheading</h4>
          <p>Maecenas sed diam eget risus varius blandit sit amet non magna.</p>
        </div>
      </div>
<?php
  }
  include("footer.php");
?>