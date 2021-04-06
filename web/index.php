<?php

  include('../include/views_controller.php');
   if(!$session->logged_in){
     header('location: auth-login.php');
   }else{
     
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php

    $view_head->title('Home');

    $view_head->meta_head();

  ?>
</head>
<body>
      <?php

          $view_head->header_navbar();

          $view_head->sidebar('index', 'dashboard');
      
          $view_body->index_bcnr();
          //  $view_body->index_revenueChart();
          $view_body->basic_data_table();
          //  $view_body->index_charts();
          //  $view_body->index_assignTaskTable()
          //  $view_body->index_stpp()

          $view_footer->settings();

          $view_footer->footer();

          $view_footer->footer_down()

      ?>
</body>
</html>
<?php

   }

?>