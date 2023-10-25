<!-- Include -->
<?php

session_start();

include("Include/connection.inc.php");
include("Include/login.inc.php");
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
    <link href="../node_modules/gentelella//vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../node_modules/gentelella//vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="../node_modules/gentelella//vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../node_modules/gentelella//build/css/custom.min.css" rel="stylesheet">
  </head>


  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form method="POST" action="">
              <h1>Login Form</h1>
              <div>
                <input type="text" name="user" class="form-control" placeholder="Username"/>
              </div>
              <div>
                <input type="password" name="pass" class="form-control" placeholder="Password"/>
              </div>

              <button type="submit" name="submitLogin">Login</button>
              <a class="reset_pass" href="#">Lost your password?</a>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">New to site?
                  <a href="#signup" class="to_register"> Create Account </a>
                </p>

                <div class="clearfix"></div>
                <br />
              </div>
            </form>
          </section>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <form method="POST" action="">
              <h1>Create Account</h1>
              <div>
                <input type="text" name="userReg" class="form-control" placeholder="Username" required="" />
              </div>
              <div>
                <input type="email" name="emailReg" class="form-control" placeholder="Email" required="" />
              </div>
              <div>
                <input type="password" name="passReg" class="form-control" placeholder="Password" required="" />
              </div>

              <button type="submit" name="submitRegister">Register</button>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="#signin" class="to_register"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>
