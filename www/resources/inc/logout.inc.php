<?php

   //runs if logout form is submitted
   //destroys users current session
   if(isset($_REQUEST['logout'])){
      session_destroy();
      header("Location:index.php");
   }
?>