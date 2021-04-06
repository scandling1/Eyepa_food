<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/dbase.php';
    include_once '../../class/control.php';

    $dbase = new Dbase();
    $db = $dbase->getConnection();

    $item = new Control($db);

    $data = json_decode(file_get_contents("php://input"));

    if(isset($data->user_id) && isset($data->user_name) && isset($data->email) && isset($data->phone) && isset($data->picture) && isset($data->city_id)){

    $item->user_id = $data->user_id;
    $item->user_name = $data->user_name;
    $item->email = $data->email;
    $item->picture = $data->picture;
    $item->phone = $data->phone;
    $item->city_id = $data->city_id;  
    $item->created = date('Y-m-d H:i:s');
    
    if($item->createUser()){
        http_response_code(200);
        echo json_encode( array("message" => "user created successfully"));  
    } else{
        http_response_code(500);
        echo json_encode( array("message" => "an error occurred"));  
    }
     } else {
        http_response_code(400);
        echo json_encode( array("message" => "bad request"));  
     }
?>