<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/dbase.php';
    include_once '../../class/control.php';

    $dbase = new Dbase();
    $db = $dbase->getConnection();

    $item = new Control($db);
    
    $item->country_id = isset($_GET['country_id']) ? $_GET['country_id'] : die();

    $stmt = $item->getCities();
   // $itemCount = $stmt->rowCount();


   // echo json_encode($itemCount);

    if($item->country_id != null){
        
        $citiesArr = array();
       // $citiesArr["body"] = array();
      // $citiesArr["itemCount"] = $itemCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "id" => $id,
                "city_name" => $city_name,
                "service_fee" => $service_fee,
                "country_id" => $country_id,
                "dates" => $dates
            );

            array_push($citiesArr, $e);
        }
        http_response_code(200);
        echo json_encode($citiesArr);
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>