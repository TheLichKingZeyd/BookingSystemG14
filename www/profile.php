<!-- Include -->
<?php
session_start();
include("resources/inc/session.inc.php");
include("resources/inc/language.inc.php");
include("resources/inc/logout.inc.php");

// If user is logged in
if (isset($userID)) {

  include 'resources/inc/getAllUserInformation.inc.php';
  include 'resources/inc/getCourses.inc.php';
  include 'resources/inc/getAllCourses.inc.php';
  include 'resources/inc/updateProfile.inc.php';

  // get user data (who we are messeging)
  $userInformation = getAllUserInformation($userID, $pdo);
  $coursename = getCourses($userID, $pdo);
  $allCourses = getAllCourses($pdo);
  $messageOutput = $_messageOutput['message'];

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
                  <li><a href="admin.booking.php" ><i class="fa fa-bug"></i> <?= __('Check bookings')?></a></li>
                  <li><a href="admin.calendar.php" ><i class="fa fa-calendar"></i> <?= __('Edit Calendar')?></a></li>
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
                      <h3><?php echo $userInformation['FirstName'] . " " . $userInformation['LastName']; ?></h3>

                      <ul class="list-unstyled user_data">

                        <li>
                          <i class="fa fa-envelope-o user-profile-icon"></i><?php echo " ".$userInformation['Email']; ?>
                        </li>
                        <li>
                          <i class="fa fa-user user-profile-icon"></i><?php $isAssistant = $userInformation['IsAssistant'] == 1 ? __('Assistant'):"Student"; echo " $isAssistant"; ?>
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
                      <?php if($userType == 1){?>
                      <h4><?= __('Experience')?></h4>
                      <ul class="list-unstyled user_data" style="width: 50%;">
                        <li>
                          <?php echo " ".$userInformation['ProfileExperience']; ?>
                        </li>
                      </ul>
                      <?php }?>
                      <br />
                      <!-- end of skills -->

                      <!-- Large modal -->
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg-1"><?= __('Edit Profile')?></button>
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg-2"><?= __('Edit Password')?></button>
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg-3"><?= __('Edit Courses')?></button>
                      <br><br>

                      <h4><?= __('Allow Email')?></h4>
                      <form method="POST">
                        <?php if($userInformation['AllowEmail'] == 1) {?>
                        <button type="submit" name="update_disallow_email" class="btn btn-primary"><?= __('On') ?></button>
                        <?php } else {?>
                          <button type="submit" name="update_allow_email" class="btn btn-primary"><?= __('Off') ?></button>
                        <?php }?>
                      </form>

                      <br>
                      <?php echo $messageOutput?>

                      <!-- Modal 1 user information -->
                      <div class="modal fade bs-example-modal-lg-1" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title" id="myModalLabel"><?= __('Edit profile information')?></h4>
                          </div>
                          <form method="POST">
                          <div class="modal-body">

                          <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                            <input type="text" class="form-control has-feedback-left" name="editFirstName" placeholder="First Name" value="<?php echo $userInformation['FirstName'];?>">
                            <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                          </div>

                          <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                            <input type="text" class="form-control has-feedback-left" name="editLastName" placeholder="Last Name" value="<?php echo $userInformation['LastName'];?>">
                            <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                          </div>

                          <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                            <input type="text" class="form-control has-feedback-left" name="editEmail" placeholder="Email" value="<?php echo $userInformation['Email'];?>">
                            <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
                          </div>

                          <?php if($userType == 1){?>
                          <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                          <textarea class="form-control" rows="3" placeholder='Experience' name="editExp"><?php echo $userInformation['ProfileExperience'];?></textarea>
                          </div>
                          <?php }?>

                          </div>

                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal"><?= __('Close')?></button>
                            <button type="submit" name="update_user_data" class="btn btn-primary"><?= __('Save changes')?></button>
                          </div>
                          </form>
                        </div>
                      </div>
                    </div>
                    <!-- Modal 1 user information -->

                    <!-- Modal 2 password -->
                      <div class="modal fade bs-example-modal-lg-2" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title" id="myModalLabel"><?= __('Edit password')?></h4>
                          </div>
                          <form method="POST">
                          <div class="modal-body">

                          <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                            <input type="text" class="form-control has-feedback-left" name="editOldPassword" placeholder="Old Password">
                            <span class="fa fa-keyboard-o form-control-feedback left" aria-hidden="true"></span>
                          </div>

                          <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                            <input type="text" class="form-control has-feedback-left" name="editNewPassword" placeholder="New Password">
                            <span class="fa fa-keyboard-o form-control-feedback left" aria-hidden="true"></span>
                          </div>

                          </div>

                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal"><?=__('Close')?></button>
                            <button type="submit" name="update_user_password" class="btn btn-primary"><?= __('Save changes')?></button>
                          </div>
                          </form>
                        </div>
                      </div>
                    </div>

                    <!-- Modal 3 Courses -->
                    <div class="modal fade bs-example-modal-lg-3" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title" id="myModalLabel"><?= __('Edit Courses')?></h4>
                          </div>
                          <form method="POST">
                          <div class="modal-body">

                          <label><?= __('Add Courses:')?></label>
                          <p style="padding: 5px;">
                          <?php
                          $courseIDS = array_column($coursename, 'CourseID');
                          for ($row = 0; $row < count($allCourses); $row++) {
                            for ($col = 0; $col < 1; $col++) {
                              $id = $allCourses[$row][0];
                              if(!in_array($id, $courseIDS)) {
                                echo "<input type='checkbox' name='insert[]' data-parsley-mincheck='2' class='flat' value='$id'/> ".$allCourses[$row][1].": " .$allCourses[$row][2];
                                echo "<br />";
                              }
                            }
                          }
                          ?>
                          </p>

                          <label><?= __('Remove Courses:')?></label>
                          <p style="padding: 5px;">
                          <?php
                          $courseIDS = array_column($coursename, 'CourseID');
                          for ($row = 0; $row < count($allCourses); $row++) {
                            for ($col = 0; $col < 1; $col++) {
                              $id = $allCourses[$row][0];
                              if(in_array($id, $courseIDS)) {
                                echo "<input type='checkbox' name='delete[]' data-parsley-mincheck='2' class='flat' value='$id'/> ".$allCourses[$row][1].": " .$allCourses[$row][2];
                                echo "<br />";
                              }
                            }
                          }
                          ?>
                          </p>

                          <?php if($userType == 1){?>
                          <br>
                          <h4 class="modal-title" id="myModalLabel"><?= __('Assistant teacher tools')?></h4>
                          <br>
                          <label><?= __('Add that I am an assistant teacher:')?></label>
                          <p style="padding: 5px;">
                          <?php
                          for ($row = 0; $row < count($coursename); $row++) {
                            for ($col = 0; $col < 1; $col++) {
                              if ($coursename[$row][2] == 0) {
                                $id = $coursename[$row][0];
                                echo "<input type='checkbox' name='addAssistant[]' data-parsley-mincheck='2' class='flat' value='$id'/> ".$coursename[$row][4].": " .$coursename[$row][5];
                                echo "<br />";
                              }
                            }
                          }
                          ?>
                          </p>

                          <label><?= __('Remove that I am an assistant teacher:')?></label>
                          <p style="padding: 5px;">
                          <?php
                          for ($row = 0; $row < count($coursename); $row++) {
                            for ($col = 0; $col < 1; $col++) {
                              if ($coursename[$row][2] == 1) {
                                $id = $coursename[$row][0];
                                echo "<input type='checkbox' name='removeAssistant[]' data-parsley-mincheck='2' class='flat' value='$id'/> ".$coursename[$row][4].": " .$coursename[$row][5];
                                echo "<br />";
                              }
                            }
                          }
                          ?>
                          </p>
                          <?php }?>

                          </div>

                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal"><?=__('Close')?></button>
                            <button type="submit" name="update_course_access" class="btn btn-primary"><?= __('Save changes')?></button>
                          </div>
                          </form>
                        </div>
                      </div>
                    </div>
                    <!-- Large modal -->

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