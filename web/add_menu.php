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
          
          $view_head->sidebar('restaurant', 'all restaurant');
      
          //  $view_body->index_bcnr();
          //  $view_body->index_revenueChart();
          // $view_body->basic_data_table();
          // $view_body->all_paticular_user(5, 'Restaurant Administrators');
      if(isset($_GET['res']) && isset($_GET['city'])){ 
          $res_id = $_GET['res'];
          $city_id = $_GET['city'];

          $view_body->res_stats_mini($city_id, $res_id);
          $view_body->add_meal($city_id, $res_id);
          //  $view_body->index_charts();
          //  $view_body->index_assignTaskTable()
          //  $view_body->index_stpp()
          
          $view_footer->settings();
          
          $view_body->meal_category_modal($city_id, $res_id);

      } else{
          echo'NO RESTAURANT SELECTED';
      }

          $view_footer->footer();

          $view_footer->footer_down()

      ?>
</body>
</html>
<?php

   }

?>