<?php
  include('../include/views_controller.php');
   if(!$session->logged_in){
     header('location: auth-login.php');
   }else{

?>

<!DOCTYPE html>
<html lang="en">


<!-- index.php  21 Dec 2020 03:44:50 GMT -->
<head>
  <?php
    $view_head->title('Home');

    $view_head->meta_head();
  ?>
</head>

<body>
      <?php

          $view_head->header_navbar();

          $view_head->sidebar('users', 'drivers');
     
          //  $view_body->index_bcnr();
          //  $view_body->index_revenueChart();
          // $view_body->basic_data_table();
          $view_body->all_paticular_user(3, 'Drivers');
          //  $view_body->index_charts();
          //  $view_body->index_assignTaskTable()
          //  $view_body->index_stpp()
          $view_footer->settings();

          $view_footer->footer();

          $view_footer->footer_down()

      ?>
</body>


<!-- index.html  21 Dec 2020 03:47:04 GMT -->
</html>
<?php
   }
?>