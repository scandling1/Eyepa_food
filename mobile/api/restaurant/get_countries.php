<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/dbase.php';
    include_once '../../class/control.php';

    $dbase = new Dbase();
    $db = $dbase->getConnection();

    $items = new Control($db);

    $stmt = $items->getCountries();
    $itemCount = $stmt->rowCount();


   // echo json_encode($itemCount);

    if($itemCount > 0){
        
        $countryArr = array();
       // $countryArr["body"] = array();
      //  $countryArr["itemCount"] = $itemCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "country_id" => $country_id,
                "country_name" => $country_name,
                "country_icon" => $country_icon,
                "dates" => $dates
            );

            array_push($countryArr, $e);
        }
        http_response_code(200);
        echo json_encode($countryArr);
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No Country found.")
        );
    }
?>