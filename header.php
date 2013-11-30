<?php
  include ("security.php");
  sec_session_start();
  include ("common.php");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>endav.com</title>

    <!-- Bootstrap core CSS -->
    <link href="js/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="sticky-footer.css" rel="stylesheet">
    <!--<link href="signin.css" rel="stylesheet"> -->

    <!-- Custom styles for this template -->
    <link href="jumbotron-narrow.css" rel="stylesheet">
  </head>

  <body>
    <div id="fb-root"></div>
<script>
  window.fbAsyncInit = function() {
    // init the FB JS SDK
    FB.init({
      appId      : '695374143814932',                        // App ID from the app dashboard
      status     : true,                                 // Check Facebook Login status
      xfbml      : true                                  // Look for social plugins on the page
    });

    // Additional initialization code such as adding Event Listeners goes here
    FB.Event.subscribe('edge.create',
    function(href, widget) {
        alert('You liked the URL: ' + href);
    }
  );
  };

  // Load the SDK asynchronously
  (function(){
     // If we've already installed the SDK, we're done
     if (document.getElementById('facebook-jssdk')) {return;}

     // Get the first script element, which we'll use to find the parent node
     var firstScriptElement = document.getElementsByTagName('script')[0];

     // Create a new script element and set its id
     var facebookJS = document.createElement('script'); 
     facebookJS.id = 'facebook-jssdk';

     // Set the new script's source to the source of the Facebook JS SDK
     facebookJS.src = '//connect.facebook.net/en_US/all.js';

     // Insert the Facebook JS SDK into the DOM
     firstScriptElement.parentNode.insertBefore(facebookJS, firstScriptElement);
   }());
</script>
    <script type="text/javascript">
      $('ul.nav.nav-pills li').click(function() {           
        $(this).parent().addClass('active').siblings().removeClass('active');           
      });
    </script>
    <div id="wrap">
      <div class="container-narrow">
        <div class="header">
         <ul class="nav nav-pills pull-right">
           <li <?php if ($_SERVER['PHP_SELF']==="/index.php") echo "class='active';"?>><a href="index.php">HOME</a></li>
           <li <?php if ($_SERVER['PHP_SELF']==="/about.php") echo "class='active';"?>><a href="about.php">ABOUT US</a></li>
           <li> <a href="#" class="inactive">|</a> </li>
           <?php
             if (isset($_SESSION["uid"])) {
?>  
            <li <?php if ($_SERVER['PHP_SELF']==="/profile.php") echo "class='active';"?>><a href="profile.php">PROFILE</a></li>
           <li><a href="usrlogout.php">LOG OUT</a></li>
           <?php 
             } else {
?>  
            <li <?php if ($_SERVER['PHP_SELF']==="/login.php") echo "class='active';"?>><a href="login.php">LOG IN</a></li>
            <li <?php if ($_SERVER['PHP_SELF']==="/register.php") echo "class='active';"?>><a href="register.php" class="text-success"><strong>SIGN UP</strong></a></li>
            <li> <a href=<?php echo $_SERVER['PHP_SELF']."?lang=en"?>>en</a></li>
            <li> <a href=<?php echo $_SERVER['PHP_SELF']."?lang=bg"?>>bg</a></li>

            
<?php
              }
            ?>
          </ul>
          <h3 class="text-muted"><a href="index.php" class="muted">ENDAV.COM</a></h3>
        </div>