<html>
<?php include 'main.php';?>
   <body bgcolor = "#FFFFFF">
   <?php 

      $deleted = Delete($_GET);
      if ($deleted) {
        header('Location: welcome.php' );
      }

   ?>
   </body>
   </html>
