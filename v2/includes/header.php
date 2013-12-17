<?php 
  ob_start();
  require_once ("includes/security.php");
  sec_session_start();
  require_once ("includes/common.php");
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

    <title>endav.com v2</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/main.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>


<!--    <link href="dist/css/carousell.css" rel="stylesheet"> -->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
    <div class="container">
      <div class="row clearfix">
        <div class="col-md-12 column">
          <nav class="navbar navbar-inverse" role="navigation">
            <div class="navbar-header">
               <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button> <a class="navbar-brand" href="index.php"><img class="img-rounded" src="img/logo-small.png" alt="endav.com"> <?php echo $lang['ENDAV'];?></a>
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
                  <p class="navbar-text"><?php echo $lang['OR'];?></p>
                </li>
                <li>
                <form class="navbar-form navbar-left" role="search">
                  <div class="form-group">
                    <input type="text" placeholder=<?php echo $lang['SEARCH'];?> class="form-control">
                  </div> <button type="submit" class="btn btn-warning disabled">GO</button>
                </form>
              </li>
                <li>
                  <a href="about.php"><?php echo $lang['ABOUT'];?></a>
                </li>
                <li>
                  <a href="contact.php"><?php echo $lang['CONTACT'];?></a>
                </li>
                <li class="dropdown">
                   <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <?php if ((isset ($_SESSION['lang']) && $_SESSION['lang'] == "en") || !isset ($_SESSION['lang'])){echo "EN";?> <strong class="caret"></strong></a>
                  <ul class="dropdown-menu">
                    <li>
                      <a href=<?php echo $_SERVER['PHP_SELF'].'?lang=bg';?>>BG</a>
                    </li>
                  <?php } else if (isset($_SESSION['lang']) && $_SESSION['lang'] == "bg") {echo "БГ";?>
                  <strong class="caret"></strong></a>
                  <ul class="dropdown-menu">
                      <li>
                      <a href=<?php echo $_SERVER['PHP_SELF'].'?lang=en';?>>EN</a>
                    </li>
                  <?php };?>
                  <li class="divider">
                    <li class="dropdown-header">Coming soon</li>
                    <li>
                      <a href="#">FR</a>
                    </li>
                    <li>
                      <a href="#">DE</a>
                    </li>
                    <li>
                      <a href="#">RU</a>
                    </li>
                  </ul>
                <?php if (isset($_SESSION['uid'])) {?>
                  <li class="dropdown">
                   <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION['email'];?> <strong class="caret"></strong></a>
                  <ul class="dropdown-menu">
                    <li>
                      <a href="profile.php"><?php echo $lang['MY_PROFILE'];?></a>
                    </li>
                    <li>
                      <a href="balance.php"><?php echo $lang['BALANCE'];?></a>
                    </li>
                    <li>
                      <a href="#"><span class="text-danger">Inbox</span><span class="badge pull-right text-danger">3</span></a>
                    </li>
                    <li class="disabled">
                      <a href="#"><?php echo $lang['SETTINGS'];?></a>
                    </li>
                    <li class="divider">
                    </li>
                    <li>
                      <a href="usrlogout.php"><span class="text-danger"><?php echo $lang['LOGOUT'];?></span></a>
                    </li>
                  </ul>
                </li>
                <!--<li class="dropdown">
                   <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> Log In <strong class="caret"></strong></a>
                  <ul class="dropdown-menu">
                    <li>
                      <a href="#">My Profile</a>
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
                      <a href="../usrlogout.php"><span class="text-danger">Log out</span></a>
                    </li>
                  </ul>
                </li> -->
                <?php } else {?>
                  <li class="signup">
                  <a href="signup.php" class="btn btn-md btn-warning"><strong><?php echo $lang['SIGNUP'];?></strong></a>
                </li>
                <li>
                  <p class="navbar-text">|</p>
                </li>
                <li>
                  <a href="login.php"><span><?php echo $lang['LOGIN'];?></span></a>
                </li>
                <?php }?>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <!-- end navbar -->    