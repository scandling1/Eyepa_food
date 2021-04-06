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
  <script>
      function showUser(str) {
       if (str == "") {
            document.getElementById("txtHint").innerHTML = "";
           return;
        } else {
            var xmlhttp = new XMLHttpRequest();
              xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                  document.getElementById("txtHint").innerHTML = this.responseText;
                }
              };
            xmlhttp.open("GET","ajaz.php?q="+str,true);
             xmlhttp.send();
          }
      }
</script>
</head>
<body>
      <?php

          $view_head->header_navbar();

          $view_head->sidebar('restaurant', 'add restaurant');
     
          //  $view_body->index_bcnr();
          //  $view_body->index_revenueChart();
          // $view_body->basic_data_table();
         
          $view_body->sellect_city();
          echo'
          <div id="txtHint"></div>';
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