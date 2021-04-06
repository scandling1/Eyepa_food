<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../../config/dbase.php';
    include_once '../../../class/control.php';

    $dbase = new Dbase();
    $db = $dbase->getConnection();

    $item = new Control($db);
    
    $item->res_id = isset($_GET['res_id']) ? $_GET['res_id'] : die();
    $item->meal_category = isset($_GET['meal_category']) ? $_GET['meal_category'] : die();

    $stmt = $item->getMeals();
   // $itemCount = $stmt->rowCount();


   // echo json_encode($itemCount);

    if($item->res_id != null && $item->meal_category != null){
        
        $mealcategotytArr = array();
       // $mealcategotytArr["body"] = array();
      //  $mealcategotytArr["itemCount"] = $itemCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "mid" => $mid,
                "city_id" => $city_id,
                "res_id" => $res_id,
                "meal_name" => $meal_name,
                "meal_price" => $meal_price,
                "meal_picture" => $meal_picture,
                "meal_category" => $meal_category,
                "meal_description" => $meal_description,
                "meal_status" => $meal_status,
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