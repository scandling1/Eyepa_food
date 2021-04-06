<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/dbase.php';
    include_once '../class/control.php';

    $dbase = new Dbase();
    $db = $dbase->getConnection();

    $item = new Control($db);

    $data = json_decode(file_get_contents("php://input"));

    $item->name = $data->name;
    $item->email = $data->email;
    $item->age = $data->age;
    $item->designation = $data->designation;
    $item->created = date('Y-m-d H:i:s');
     
     if(empty($item->name)){
         echo 'No data';
     } else{
    
    if($item->createUser()){
        http_response_code(200);
        echo json_encode( array("message" => "No record found."));
    } else{
        http_response_code(500);
        echo json_encode( array("message" => "No record found."));
    }
     }
?>