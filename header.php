<?php
  include ("security.php");
  sec_session_start();
  include ("common.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../docs-assets/ico/favicon.png">

    <title>v2</title>

    <!-- Bootstrap core CSS -->
    <link href="v2/_depr_dist/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="v2/_depr_dist/css/main.css" rel="stylesheet">
<!--    <link href="dist/css/carousell.css" rel="stylesheet"> -->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
    <div id="wrap">
      <div class="container">
        <div class="row clearfix">
          <div class="col-md-12 column">
            <nav class="navbar navbar-inverse" role="navigation">
              <div class="navbar-header">
                 <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button> <a class="navbar-brand" href="#">endav.com</a>
              </div>
              <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                  <li class="dropdown">
                     <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <?php echo $lang['CATEGORY'];?> <strong class="caret"></strong></a>
                    <ul class="dropdown-menu">
                      <li class="dropdown-header">Group 1</li>
                      <li>
                        <a href="#">Category one</a>
                      </li>
                      <li>
                        <a href="#">Second</a>
                      </li>
                      <li>
                        <a href="#">More Category</a>
                      </li>
                      <li class="divider">
                      <li class="dropdown-header">Group two</li>
                      </li>
                      <li>
                        <a href="#">Something</a>
                      </li>
                      <li>
                        <a href="#">Else etc</a>
                      </li>
                      <li>
                        <a href="#">Grocery</a>
                      </li>
                    </ul>
                  </li>
                  <li>
                    <a href="#"><?php echo $lang['OR'];?></a>
                  </li>
                  <form class="navbar-form navbar-left" role="search">
                    <div class="form-group">
                      <input type="text" placeholder=<?php echo $lang['SEARCH'];?> class="form-control">
                    </div> <button type="submit" class="btn btn-warning">GO</button>
                  </form>
                  <li class="active">
                    <a href="#">Home</a>
                  </li>
                  <li>
                    <a href="../about.php">About</a>
                  </li>
                  <li>
                    <a href="#">Contact</a>
                  </li>
                  <li class="dropdown">
                     <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php if (isset ($_SESSION['lang']) && $_SESSION['lang'] == "en") {echo "EN";} else if (isset($_SESSION['lang']) && $_SESSION['lang'] == "bg") {echo "БГ";};?> <strong class="caret"></strong></a>
                    <ul class="dropdown-menu">
                      <li>
                        <a href=<?php echo $_SERVER['PHP_SELF']."?lang=bg"?>>BG</a>
                      </li>
                      <li>
                        <a href=<?php echo $_SERVER['PHP_SELF']."?lang=en"?>>EN</a>
                      </li>
                    </ul>
                  </li>
<?php if (isset($_SESSION['uid'])) { ?>
                  <li class="dropdown">
                     <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION['email'];?> <strong class="caret"></strong></a>
                    <ul class="dropdown-menu">
                      <li>
                        <a href="../profile.php">My Profile</a>
                      </li>
                      <li>
                        <a href="#">Balance</a>
                      </li>
                      <li>
                        <a href="#">Settings</a>
                      </li>
                      <li class="divider">
                      </li>
                      <li>
                        <a href="#"><span class="text-danger">Log out</span></a>
                      </li>
                    </ul>
                  </li>
<?php } else {?>
                  <li>
                    <a href="login.php"><span class="text-warning"><strong>Login</strong></span></a>
                  </li>
                  <?php }?>
                  <li>
                    <a href="register.php"><span class="text-warning"><strong>Sign Up</strong></span></a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <!-- end navbar -->
