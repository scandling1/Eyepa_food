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

    if(isset($data->user_id) && isset($data->address) && isset($data->city) && isset($data->area) && isset($data->latitude) && isset($data->longitude) && isset($data->phone_number)){

    $item->user_id = $data->user_id;
    $item->address = $data->address;
    $item->city = $data->city;
    $item->area = $data->area;
    $item->latitude = $data->latitude;
    $item->longitude = $data->longitude; 
    $item->phone_number = $data->phone_number; 
    $item->dates = date('Y-m-d H:i:s');
    
    if($item->addDeliveryAddress()){
        http_response_code(200);
        echo json_encode( array("message" => "address created successfully"));  
    } else{
        http_response_code(500);
        echo json_encode( array("message" => "an error occurred"));  
    }
     } else {
        http_response_code(400);
        echo json_encode( array("message" => "bad request"));  
     }
?>