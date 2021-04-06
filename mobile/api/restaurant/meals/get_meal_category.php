<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../../config/dbase.php';
    include_once '../../../class/control.php';

    $dbase = new Dbase();
    $db = $dbase->getConnection();

    $item = new Control($db);
    
    $item->res_id = isset($_GET['res_id']) ? $_GET['res_id'] : die();

    $stmt = $item->getMealCategoty();
   // $itemCount = $stmt->rowCount();


   // echo json_encode($itemCount);

    if($item->res_id != null){
        
        $mealcategotytArr = array();
       // $mealcategotytArr["body"] = array();
      //  $mealcategotytArr["itemCount"] = $itemCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "id" => $id,
                "city_id" => $city_id,
                "res_id" => $res_id,
                "title" => $title,
                "description" => $description,
                "dates" => $dates
            );

            array_push($mealcategotytArr, $e);
        }
        http_response_code(200);
        echo json_encode($mealcategotytArr);
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>