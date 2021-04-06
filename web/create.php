<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include("../include/session.php");

    $data = json_decode(file_get_contents("php://input"));

    $data->username;
    $data->pass;
    $data->email;
    $data->name;
    
        $retval = $session->register($data->username, $data->pass, $data->email, $data->name);
      
        /* Registration Successful */
        if($retval == 0){
           echo'Success';
        }
        /* Error found with form */
        else if($retval == 1){
           echo'could not insert';
        }
        /* Registration attempt failed */
        else if($retval == 2){
          echo'error occured';
        }
?>