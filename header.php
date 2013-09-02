<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Endav</title>

    <!-- Bootstrap core CSS -->
    <link href="js/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="sticky-footer.css" rel="stylesheet">
    <link href="signin.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="jumbotron-narrow.css" rel="stylesheet">
  </head>

  <body>
    <script type="text/javascript">
      $('ul.nav.nav-pills li').click(function() {           
        $(this).parent().addClass('active').siblings().removeClass('active');           
      });
    </script>
    <div id="wrap">
      <div class="container-narrow">
        <div class="header">
         <ul class="nav nav-pills pull-right">
           <li <?php if ($_SERVER['PHP_SELF']==="/index.php") echo "class='active';"?>><a href="index.php">Home</a></li>
           <li <?php if ($_SERVER['PHP_SELF']==="/about.php") echo "class='active';"?>><a href="about.php">About</a></li>
           <?php
             if (isset($_SESSION["uid"])) {
?>  
            <li <?php if ($_SERVER['PHP_SELF']==="/profile.php") echo "class='active';"?>><a href="profile.php">Profile</a></li>
           <li><a href="usrlogout.php">Logout</a></li>
           <?php 
             } else {
?>  
            <li <?php if ($_SERVER['PHP_SELF']==="/register.php") echo "class='active';"?>><a href="register.php">Register</a></li>
            <li <?php if ($_SERVER['PHP_SELF']==="/login.php") echo "class='active';"?>><a href="login.php">Login</a></li>
<?php
              }
            ?>
          </ul>
          <h3 class="text-muted">endav.com</h3>
        </div>