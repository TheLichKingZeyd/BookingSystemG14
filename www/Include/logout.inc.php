<?php

   if(isset($_REQUEST['logout'])){
      session_destroy();
      header("Location:index.php");
   }
?>