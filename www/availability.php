<!-- Include -->
<?php
include_once 'resources/inc/session.inc.php';
include_once 'resources/inc/language.inc.php';
include_once 'resources/inc/logout.inc.php';
include_once 'resources/inc/availability.inc.php';


if (isset($userID)) {



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

                <li role="presentation" class="dropdown">
                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-envelope-o"></i>
                    <span class="badge bg-green">6</span>
                  </a>
                  <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                    <li>
                      <a>
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <div class="text-center">
                        <a>
                          <strong>See All Alerts</strong>
                          <i class="fa fa-angle-right"></i>
                        </a>
                      </div>
                    </li>
                  </ul>
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
                  <h2><?= __('Availability Editing')?></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                  
                <button class="btn btn-info" onclick="window.location.href='availabilityEdit.php'"><?= __('Edit existing availabilities')?></button>

                <h3><?= __('Add New Availabilities')?></h3>
                  
                    <div>
                        <form method="post" action="">

                        <input type="hidden" name="SkipDay2" value="1";>
                        <input type="hidden" name="SkipDay3" value="1";>
                        <input type="hidden" name="SkipDay4" value="1";>
                        <input type="hidden" name="SkipDay5" value="1";>
                        <input type="hidden" name="SkipDay6" value="1";>
                        <input type="hidden" name="SkipDay7" value="1";>

                        <strong><?= __('Day ')?>1 </strong>
                        <label for="Date1"><?= __('Select the first day to be added')?>:</label>
                        <input type="date" name="Date1" min="<?= date('Y-m-d'); ?>" required> 
                        <label for="StartTime1"><?= __('Start time')?>:</label>
                        <input type="time" name="StartTime1" min="05:00" max="22:00" required> 
                        <label for="EndTime1"><?= __('End time')?>: </label>
                        <input type="time" name="EndTime1" min="05:00" max="22:00" required> <strong><?= __('Mandatory')?></strong>
                        
                        <br><br> <strong><?= __('Day ')?>2</strong>

                        <label for="StartTime2"><?= __('Start time')?>:</label>
                        <input type="time" name="StartTime2" min="05:00" max="22:00"> 
                        <label for="EndTime2"><?= __('End time')?>: </label>
                        <input type="time" name="EndTime2" min="05:00" max="22:00">
                        <label for="SkipDay2">&nbsp;&nbsp;<?= __('Tick to skip day')?> 2 :</label>
                        <input type="checkbox" name="SkipDay2" value="0">

                        <br><br> <strong><?= __('Day ')?>3</strong>

                        <label for="StartTime3"><?= __('Start time')?>:</label>
                        <input type="time" name="StartTime3" min="05:00" max="22:00"> 
                        <label for="EndTime3"><?= __('End time')?>: </label>
                        <input type="time" name="EndTime3" min="05:00" max="22:00">
                        <label for="SkipDay3">&nbsp;&nbsp;<?= __('Tick to skip day')?> 3 :</label>
                        <input type="checkbox" name="SkipDay3" value="0">

                        <br><br> <strong><?= __('Day ')?>4</strong>

                        <label for="StartTime4"><?= __('Start time')?>:</label>
                        <input type="time" name="StartTime4" min="05:00" max="22:00"> 
                        <label for="EndTime4"><?= __('End time')?>: </label>
                        <input type="time" name="EndTime4" min="05:00" max="22:00">
                        <label for="SkipDay4">&nbsp;&nbsp;<?= __('Tick to skip day')?> 4 :</label>
                        <input type="checkbox" name="SkipDay4" value="0" >

                        <br><br> <strong><?= __('Day ')?>5</strong>

                        <label for="StartTime5"><?= __('Start time')?>:</label>
                        <input type="time" name="StartTime5" min="05:00" max="22:00"> 
                        <label for="EndTime5"><?= __('End time')?>: </label>
                        <input type="time" name="EndTime5" min="05:00" max="22:00">
                        <label for="SkipDay5">&nbsp;&nbsp;<?= __('Tick to skip day')?> 5 :</label>
                        <input type="checkbox" name="SkipDay5" value="0" >

                        <br><br> <strong><?= __('Day ')?>6</strong>

                        <label for="StartTime6"><?= __('Start time')?>:</label>
                        <input type="time" name="StartTime6" min="05:00" max="22:00"> 
                        <label for="EndTime6"><?= __('End time')?>: </label>
                        <input type="time" name="EndTime6" min="05:00" max="22:00">
                        <label for="SkipDay6">&nbsp;&nbsp;<?= __('Tick to skip day')?> 6 :</label>
                        <input type="checkbox" name="SkipDay6" value="0" >

                        <br><br> <strong>Day 7</strong>

                        <label for="StartTime7"><?= __('Start time')?>:</label>
                        <input type="time" name="StartTime7" min="05:00" max="22:00"> 
                        <label for="EndTime7"><?= __('End time')?>: </label>
                        <input type="time" name="EndTime7" min="05:00" max="22:00">
                        <label for="SkipDay7">&nbsp;&nbsp;<?= __('Tick to skip day')?> 7 :</label>
                        <input type="checkbox" name="SkipDay7" value="0" >

                        <br><br>

                        <label for="HowManyWeeks"> <?= __('How many weeks?')?> </form>
                        <input type="number" name="NumberOfWeeks" min="1" max="22" value="1">
                        <input type="submit" />
                        </form>
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

    <!-- script to prevent resubmission of the forms on page refresh -->
    <script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
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
