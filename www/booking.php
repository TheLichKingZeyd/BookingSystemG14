<!-- Include -->
<?php
session_start();
include("resources/inc/session.inc.php");
include("resources/inc/language.inc.php");
include("resources/inc/logout.inc.php");
include("resources/inc/bookings.inc.php");



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

                    <?php 
                    
                      if (isset($_GET['assistant_id']) && isset($_GET['course_id'])){
                        // 
                        foreach($assistants as $assistant){
                          if ($assistant->UserID == $_GET['assistant_id']){
                            $chosenAssistant = $assistant;
                          }
                        }
                        
                        foreach($courses as $course){
                          if ($course->CourseID == $_GET['course_id']){
                            $chosenCourse = $course;
                          }
                        }
                    
                    ?>


                        <!-- WHAT YOU NEED
                              1. CourseID FROM POST
                              2. AssistantID FROM POST
                              3. Title
                              4. Description
                              5. Start time
                              6. Do end time in include file
                       -->

                    <div class="x_title">
                      <h2>Class: <?= $chosenCourse->CourseCode . " " . $chosenCourse->CourseName . "<br>" ?>Assistant Teacher: <?= $chosenAssistant->FirstName . " " . $chosenAssistant->LastName ?></h2>
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                      <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="POST">
                        <div class="form-group">                          
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="hidden" id="booking-assistant" name="bookingAssistant" value=<?= $chosenAssistant->UserID ?> class="form-control col-md-7 col-xs-12">
                          </div>
                        </div>
                        <div class="form-group">                          
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="hidden" id="booking-course" name="bookingCourse" value=<?= $chosenCourse->CourseID ?> class="form-control col-md-7 col-xs-12">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="booking-title">Title <span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="booking-title" name="bookingTitle" required="required" class="form-control col-md-7 col-xs-12">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="booking-description">Description <span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <textarea id="booking-description" name="bookingDescription" required="required" placeholder="Please describe what you need help with, and the place you want it to be held." class="form-control col-md-7 col-xs-12"></textarea>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="booking-date">Date <span class="required">*</span>
                          </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <input type="date" id="booking-date" name="bookingDate" required="required" class="form-control col-md-7 col-xs-12">
                            </div>
                          </div>                        
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="booking-time">Time <span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="time" id="booking-time" name="bookingTime" step="900" min="08:00" max="23:45" class="date-picker form-control col-md-7 col-xs-12" required="required">
                          </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="form-group">
                          <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <a class="btn btn-primary" type="button" href="booking.php">Cancel</a>
                            <button class="btn btn-primary" type="reset">Reset</button>
                            <button class="btn btn-success" type="submit" name="submitBooking">Submit</a>
                          </div>
                        </div>
                      </form>
                    </div>

                    <?php                 
                      
                      } else {                        
                    
                    ?>

                    <div class="x_title">
                      <h2>Classes</h2>
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                      <?php

                        foreach($courses as $course){

                      ?>

                      <div class="x_content">
                        <div class="x_title">
                          <h3><?= $course->CourseCode . " - " . $course->CourseName ?></h3>
                          <div class="clearfix"></div>
                        </div>
                        <div style="display:flex; flex-direction:row;">
                        
                          <?php 
                  
                            foreach($assistants as $assistant){
                              if ($course->CourseID == $assistant->CourseID){                            

                          ?>

                          <div class="col-md-4 col-sm-4 col-xs-12 profile_details">
                            <div class="well profile_view">
                              <div class="col-sm-12">                              
                                <div class="left col-xs-7">
                                  <h2><?= $assistant->FirstName . " " . $assistant->LastName ?></h2>                           
                                </div>
                                <div class="right col-xs-5 text-center">
                                  <img src="images/img.jpg" alt="" class="img-circle img-responsive">
                                </div>
                              </div>
                              <div class="col-xs-12 bottom text-center">
                                <div class="col-xs-12 col-sm-6 emphasis" style="display:flex; flex-direction:row;">
                                  <button type="button" class="btn btn-success btn-xs"> 
                                    <i class="fa fa-user"></i> 
                                    <i class="fa fa-comments-o"></i> 
                                  </button>
                                  <button type="button" class="btn btn-primary btn-xs">
                                    <i class="fa fa-user"> </i> View Profile
                                  </button>
                                  <a type="button" class="btn btn-primary btn-xs" href="booking.php?assistant_id=<?= $assistant->UserID ?>&course_id=<?= $course->CourseID ?>">
                                    <i class="fa fa-arrow-right"> </i> Choose
                                    
                                  </a>
                                </div>
                              </div>
                            </div>
                          </div>

                          <?php

                              }
                            }                                      

                          ?>
                        </div>
                      </div>
                      
                      <?php 

                          }
                        }                                    

                      ?>
                    
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

    <!-- Custom Theme Scripts -->
    <script src="../node_modules/gentelella/build/js/custom.min.js"></script>
  </body>
</html>