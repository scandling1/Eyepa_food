<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/dbase.php';
    include_once '../../class/control.php';

    $dbase = new Dbase();
    $db = $dbase->getConnection();

    $item = new Control($db);
    
    $item->user_id = isset($_GET['user_id']) ? $_GET['user_id'] : die();

    $stmt = $item->getDeliveryAddress();
   // $itemCount = $stmt->rowCount();


   // echo json_encode($itemCount);

    if($item->user_id != null){
        
        $allmealArr = array();
       // $allmealArr["body"] = array();
      // $allmealArr["itemCount"] = $itemCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "user_id" => $user_id,
                "address" => $address,
                "city" => $city,
                "area" => $area,
                "latitude" => $latitude,
                "longitute" => $longitude,
                "phone_number" => $phone_number,
                "dates" => $dates
            );

            array_push($allmealArr, $e);
        }
        http_response_code(200);
        echo json_encode($allmealArr);
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>