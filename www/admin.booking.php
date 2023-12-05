<!-- Include -->
<?php

session_start();
include("resources/inc/session.inc.php");
include("resources/inc/language.inc.php");
include("resources/inc/logout.inc.php");

if (isset($userID)) {

  include 'resources/inc/getAssistantBookings.inc.php';
  include 'resources/inc/updateTime.inc.php';

  # Getting User conversations
  $bookings = getAssistantBookings($userID, $pdo);
  $int = "";
  $messageOutput = $_messageOutput['message'];
}
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
    <!-- jQuery custom content scroller -->
    <link href="../node_modules/gentelella/vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="../node_modules/gentelella/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <!-- bootstrap-datetimepicker -->
    <link href="../node_modules/gentelella/vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../node_modules/gentelella/build/css/custom.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col menu_fixed">
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
                  <li><a href="admin.booking.php" ><i class="fa fa-bug"></i> <?= __('Check bookings')?></a></li>
                  <li><a href="availability.php" ><i class="fa fa-calendar"></i> <?= __('Edit Availability')?></a></li>
                </ul>
              </div>

              <?php
                }
              ?>

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <button onclick="location.href='profile.php';" data-toggle="tooltip" data-placement="top" title="<?= __('Settings')?>">
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
                    <h2><?= __('Assistant teacher check bookings')?></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                  <!-- Modal 1 booking edit -->
                  <?php if (isset($_GET['bookingID'])){ ?>
                  <div class='col-md-4 col-sm-4'>
                  <div class='col-md-12 col-sm-12 text-center'>
                    <h4><?= __('Edit booking time')?></h4>
                  </div>
                    <form method="POST">
                      <div class='col-md-12 col-sm-12'>

                      <div class='col-sm-12'><?= __('From Date & Time')?>
                        <div class="form-group">
                          <div class='input-group date' id='myDatepicker'>
                            <input type='text' class="form-control" name="editFrom"/>
                            <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                          </div>
                        </div>
                      </div>

                      <div class='col-sm-12'><?= __('To Date & Time')?>
                        <div class="form-group">
                          <div class='input-group date' id='myDatepicker2'>
                            <input type='text' class="form-control" name="editTo"/>
                            <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                        <a class="btn btn-primary" type="button" href="admin.booking.php"><?= __('Cancel')?></a>
                        <button class="btn btn-success" type="submit" name="submitChange"><?= __('Submit')?></button></a>
                        <br>
                        <?php echo $messageOutput; ?>
                      </div>
                      </div>

                    </form>
                    </div>
                    <!-- Modal 2 user information -->
                    <?php } else {?>
                      <!-- Booking table -->
                      <table class="table table-striped projects">
                        <thead>
                          <tr>
                            <th style="width: 1%">#</th>
                            <th style="width: 19%"><?= __('Booking Time')?></th>
                            <th style="width: 10%"><?= __('Course')?></th>
                            <th style="width: 10%">Student</th>
                            <th style="width: 30%"><?= __('Title & Description')?></th>
                            <th style="width: 10%">Status</th>
                            <th style="width: 10%"><?= __('#Edit')?></th>
                            <th style="width: 20%"><?= __('#Cancel')?></th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach($bookings as $booking) {
                            if($date_now < $booking['BookingStart']) {
                            $int++;
                            ?>
                          <tr>
                          <td><?= $int ?></td>
                            <td>
                              <a><?= __('From')?> <?= $booking['BookingStart']?></a>
                              <br />
                              <small><?= __('To')?> <?= $booking['BookingEnd']?></small>
                            </td>
                            <td>
                              <a><?= $booking['CourseCode'] ." ". $booking['CourseName'] ?></a>
                            </td>
                            <td>
                              <a><?= $booking['FirstName'] ." ". $booking['LastName']?></a>
                            </td>
                            <td>
                              <a><?= $booking['BookingTitle']?></a>
                              <br />
                              <small><?= $booking['BookingDescr']?></small>
                            </td>
                            <td>
                            <?php if($booking['BookingStatus'] == 1) {?>
                            <button type="button" class="btn btn-success btn-xs" style="pointer-events: none;"><?= __('Approved')?></button>
                            </td>
                            <td>
                              <a href="admin.booking.php?bookingID=<?= $booking['BookingID'] ?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> <?= __('Edit')?></a>
                            </td>
                            <td>
                              <form method="POST">
                                <input type="hidden" name="cancelBookID" value="<?= $booking['BookingID'] ?>">
                              <button type="submit" class="btn btn-danger btn-xs" name="cancelBook"><i class="fa fa-trash-o"></i> <?= __('Cancel ')?></button>
                              </form>
                            </td>
                            <?php } else {?>
                            <button type="button" class="btn btn-danger btn-xs" style="pointer-events: none;"><?= __('Cancelled')?></button>
                            </td>
                            <td></td>
                            <td></td>
                            <?php } ?>
                          </tr>
                          <?php } } ?>
                        </tbody>
                      </table>
                  <!-- Booking table -->
                      <?php }?>
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
    <!-- jQuery custom content scroller -->
    <script src="../node_modules/gentelella/vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
    <!-- bootstrap-datetimepicker -->    
    <script src="../node_modules/gentelella/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="../node_modules/gentelella/vendors/moment/min/moment.min.js"></script>
    <script src="../node_modules/gentelella/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- bootstrap-datetimepicker -->    
    <script src="../node_modules/gentelella/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
 
    
    <!-- Custom Theme Scripts -->
    <script src="../node_modules/gentelella/build/js/custom.js"></script>
    <script>
    $('#myDatepicker').datetimepicker({
        format: 'YYYY-MM-DD hh:mm:ss'
    });
    $('#myDatepicker2').datetimepicker({
      format: 'YYYY-MM-DD hh:mm:ss'
    });
    </script>
  </body>
</html>