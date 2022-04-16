<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/dbase.php';
    include_once '../../class/control.php';

    $dbase = new Dbase();
    $db = $dbase->getConnection();

    $item = new Control($db);
    
    $item->city_id = isset($_GET['city_id']) ? $_GET['city_id'] : die('error');
    $item->res_name = isset($_GET['res_name']) ? $_GET['res_name'] : die('error');

    $stmt = $item->searchRestaurants();
   // $itemCount = $stmt->rowCount();


   // echo json_encode($itemCount);

    if($item->city_id != null){
        
        $restaurantArr = array();
       // $restaurantArr["body"] = array();
      //  $restaurantArr["itemCount"] = $itemCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "restaurant_id" => $restaurant_id,
                "city_id" => $city_id,
                "res-owner" => $res_owner,
                "res_name" => $res_name,
                "res_address" => $res_address,
                "res_description" => $res_description,
                "res_email" => $res_email,
                "res_picture" => $res_picture,
                "res_featured_image" => $res_featured_image,
                "res_subscription_type" => $res_subscription_type,
                "res_hours" => $res_hours
            );

            array_push($restaurantArr, $e);
        }
        http_response_code(200);
        echo json_encode($restaurantArr);
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>