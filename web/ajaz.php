<?php

  include('../include/views_controller.php');
   if(!$session->logged_in){
     header('location: auth-login.php');
   }else{

    if(isset($_GET['q'])){
      $q = $_GET['q'];
      
      $view_body->add_restaurant($q);
   }
  }
?>