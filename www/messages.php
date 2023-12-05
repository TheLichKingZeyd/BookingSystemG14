<!-- Include -->
<?php
session_start();
include("resources/inc/session.inc.php");
include("resources/inc/language.inc.php");
include("resources/inc/logout.inc.php");

if (isset($userID)) {

  include 'resources/inc/getAllUsers.inc.php';
  include 'resources/inc/conversations.inc.php';
  include 'resources/inc/lastChat.inc.php';

  //include 'app/helpers/user.php';
  //include 'app/helpers/conversations.php';
  //include 'app/helpers/timeAgo.php';
  //include 'app/helpers/last_chat.php';

  # Getting User conversations
  $conversations = getConversation($userID, $pdo);
  
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
                  <div class="x_title">
                    <h2><?= __('Messages')?></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                  <div class="col-md-4 col-sm-4 col-xs-12 profile_details">
                    <?php 
                      foreach($brukere as $bruker) {
                        if($bruker->UserID != $userID) {
                          echo '<div class="well profile_view" style="width:100%;">';
                          echo '<div class="col-sm-12">';
                          $isAssistant = $bruker->IsAssistant == 1 ? __('Assistant'):"Student";
                          echo "<h4 class='brief'><i>". $isAssistant . "</i></h4>";
                          echo '<div class="left col-xs-7">';
                          echo "<h3>" . $bruker->FirstName . " " . $bruker->LastName ."</h3>";
                          echo '<ul class="list-unstyled">';
                          echo "<li><i class='fa fa-envelope-o user-profile-icon'></i> ". __('E-mail') . ": " . $bruker->Email . "</li>";
                          echo '</ul>';
                          echo '</div>';
                          echo '<div class="right col-xs-5 text-center">';
                          echo '<img src="../node_modules/gentelella/production/images/user.png" alt="" class="img-circle profile_img img-responsive">';
                          echo '</div>';
                          echo '</div>';
                          echo '<div class="col-xs-12 bottom text-center">';
                          echo '<div class="col-xs-12 col-sm-6 emphasis">';
                          echo '</div>';
                          echo '<div class="col-xs-12 col-sm-12 emphasis">';
                          echo "<a href=chat.php?user=$bruker->UserID>";
                          echo "<button type='button' class='btn btn-success btn-xs'>";
                          echo "<i class='fa fa-user'>";
                          echo "</i> <i class='fa fa-comments-o'></i> " . __('Chat') . "</button>";
                          echo '</a>';
                          echo '<button type="button" class="btn btn-primary btn-xs">';
                          echo '<i class="fa fa-user"> </i> ' . __('View Profile');
                          echo '</button>';
                          echo '</div>';
                          echo '</div>';
                          echo '</div>';
                        }
                      }
                    ?>

                  </div>
                  
                  <div class="col-md-8 col-sm-8 col-xs-12">
                    <div>
                      <div>
    			              <div>
                        <div class="col-sm-12">
                        <br>
                        </div>

                        <ul id="chatList" class="list-group mvh-50 overflow-auto"><?php if (!empty($conversations)) { ?>

                        <?php 
                          foreach ($conversations as $conversation){ ?>
                          <li class="list-group-item">
                            <a href="chat.php?user=<?=$conversation['UserID']?>" class="d-flex justify-content-between align-items-center p-2">
                            <div class="d-flex align-items-center">
                              <h3 class="fs-xs m-2"><?=$conversation['FirstName']. " " . $conversation['LastName']?><br>
                              <small>
                                <?php echo lastChat($userID, $conversation['UserID'], $pdo);?>
                              </small>
                            </h3>            	
                          </div>
                          </a>
                        </li>
                        <?php } ?>
                        <?php }else{ ?>
                          <div class="alert alert-info text-center">
                            <i class="fa fa-comments d-block fs-big"></i> <?= __('No messages yet, Start the conversation')?>
                          </div>
                          <?php } ?>
                        </ul>
                      </div>
                    </div>
                      
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
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