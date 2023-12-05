<!-- Include -->
<?php
session_start();
include("resources/inc/session.inc.php");
include("resources/inc/language.inc.php");
include("resources/inc/logout.inc.php");

// If user is logged in
if (isset($userID)) {

  include 'resources/inc/getOtherUserprofile.inc.php';
  include 'resources/inc/getCourses.inc.php';

  // If user is not set in the header
	if (!isset($_GET['user'])) {
        header("Location: message.php");
        exit;
    }

    // get user data, profile we are viewing
    $userProfile = getOtherUserprofile($_GET['user'], $pdo);

  // If no return exit
    if (empty($userProfile)) {
        header("Location: messages.php");
        exit;
    }

  // get user data (who we are viewing)
  $coursename = getCourses($_GET['user'], $pdo);

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Booking System</title>

    <!-- Bootstrap -->
    <link href="../node_modules/gentelella/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../node_modules/gentelella/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../node_modules/gentelella/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="../node_modules/gentelella/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    
    <!-- Custom Theme Style -->
    <link href="../node_modules/gentelella/build/css/custom.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"><i class="fa fa-search"></i> <span>Booking System</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="../node_modules/gentelella/production/images/user.png" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span><?= __('Welcome!')?></span>
                <h2><?php echo $firstName . " " . $lastName; ?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3><?= __('General')?></h3>
                <ul class="nav side-menu">

                  <li><a href="homepage.php"><i class="fa fa-home"></i> <?= __('Homepage')?></a></li>

                  <li><a><i class="fa fa-edit"></i> <?= __('Booking')?><span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="booking.php"><?= __('Book help')?></a></li>
                      <li><a href="mybooking.php"><?= __('My bookings')?></a></li>
                    </ul>
                  </li>
                  

                  <li><a href="calendar.php"><i class="fa fa-calendar"></i> <?= __('Calendar')?></a></li>

                  <li><a href="messages.php"><i class="fa fa-comments-o"></i> <?= __('Messages')?></span></a></li>
                </ul>
              </div>

              <?php  
                if ($userType){
              ?>
              
              <div class="menu_section">
                <h3><?= __('Assisant Teacher tools')?></h3>
                <ul class="nav side-menu">
                  <li><a href="assistant.bookings.php" ><i class="fa fa-bug"></i> <?= __('Check bookings')?></a></li>
                  <li><a href="assistant.calendars.php" ><i class="fa fa-calendar"></i> <?= __('Edit Calendar')?></a></li>
                </ul>
              </div>
              
              <?php
                }
              ?>             

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <button data-toggle="tooltip" data-placement="top" title="<?= __('Settings')?>">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </button>
              <button onclick="location.href='?lang=en';" data-toggle="tooltip" data-placement="top" title="English">
                <span class="glyphicon glyphicon glyphicon-bold" aria-hidden="true"></span>
              </button>
              <button onclick="location.href='?lang=no';" data-toggle="tooltip" data-placement="top" title="Norsk">
                <span class="glyphicon glyphicon glyphicon-font" aria-hidden="true"></span>
              </button>
              <form method="POST">
              <button type="submit" name="logout" data-toggle="tooltip" data-placement="top" title="<?= __('Logout')?>">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </button>
              </form>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="../node_modules/gentelella/production/images/user.png" alt=""><?php echo $firstName . " " . $lastName; ?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="profile.php"> <?= __('Profile')?></a></li>
                    <li><a href="index.php"><i class="fa fa-sign-out pull-right"></i> <?= __('Logout')?></a></li>
                  </ul>
                </li>
                <li class="">
                  <a href="messages.php">
                    <i class="fa fa-envelope-o"></i>
                    <span class="badge bg-green"></span>
                  </a>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><?= __('User Profile')?></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                      <div class="profile_img">
                        <div id="crop-avatar">
                          <!-- Current avatar -->
                          <img class="img-responsive avatar-view" src="../node_modules/gentelella/production/images/user.png" alt="Avatar" title="Change the avatar">
                        </div>
                      </div>
                      <h3><?php echo $userProfile['FirstName'] . " " . $userProfile['LastName']; ?></h3>

                      <ul class="list-unstyled user_data">

                        <li>
                          <i class="fa fa-envelope-o user-profile-icon"></i><?php echo " ".$userProfile['Email']; ?>
                        </li>
                        <li>
                          <i class="fa fa-user user-profile-icon"></i><?php $isAssistant = $userProfile['IsAssistant'] == 1 ? __('Assistant'):"Student"; echo " $isAssistant"; ?>
                        </li>
                        <li>
                          <i class="fa fa-book user-profile-icon"></i><?= __(' Subjects')?>
                          <?php
                          echo "<ul>";
                          for ($row = 0; $row < count($coursename); $row++) {
                            for ($col = 0; $col < 1; $col++) {
                              $courseAff = $coursename[$row][2] == 1 ? __('Assistant'):"Student";
                              echo "<li>".$coursename[$row][4].": " .$coursename[$row][5]." (".$courseAff.")"."</li>";
                            }
                          }
                          echo "</ul>";
                          ?>
                        </li>
                      </ul>


                      <!-- start skills -->
                      <?php if($userProfile['IsAssistant'] == 1){?>
                      <h4><?= __('Experience')?></h4>
                      <ul class="list-unstyled user_data" style="width: 50%;">
                        <li>
                          <?php echo " ".$userProfile['ProfileExperience']; ?>
                        </li>
                      </ul>
                      <?php }?>
                      <br />
                      <!-- end of skills -->

                    </div>
                    </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="../node_modules/gentelella/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../node_modules/gentelella/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../node_modules/gentelella/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../node_modules/gentelella/vendors/nprogress/nprogress.js"></script>
    <!-- morris.js -->
    <script src="../node_modules/gentelella/vendors/raphael/raphael.min.js"></script>
    <script src="../node_modules/gentelella/vendors/morris.js/morris.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="../node_modules/gentelella/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="../node_modules/gentelella/vendors/moment/min/moment.min.js"></script>
    <script src="../node_modules/gentelella/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    
    <!-- Custom Theme Scripts -->
    <script src="../node_modules/gentelella/build/js/custom.min.js"></script>

  </body>
</html>
<?php
  }
  // If user is not logged in
  else{
  	header("Location: index.php");
   	exit;
  }
 ?>