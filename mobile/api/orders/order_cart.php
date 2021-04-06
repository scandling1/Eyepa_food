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

if (isset($data->city_id) && isset($data->res_id) && isset($data->userid) && isset($data->meal_id) && isset($data->meal_count)) {

  $item->city_id = $data->city_id;
  $item->res_id = $data->res_id;
  $item->userid = $data->userid;
  $item->meal_id = $data->meal_id;
  $item->meal_count = $data->meal_count;
  $item->dates = date('Y-m-d H:i:s');

  if ($stmt = $item->getSingleMeal()) {
    foreach ($stmt as $row) {
      $meal_price = $row['meal_price'];

      $item->meal_count_price = $meal_price * $data->meal_count;

      $stmt = $item->checkCart();
      $itemCount = $stmt->rowCount();

      if ($itemCount > 0) {
        if ($stmt = $item->updateMealToCart()) {
          http_response_code(200);
          echo json_encode(array("message" => "meal updated to cart"));
        } else {
          http_response_code(500);
          echo json_encode(array("message" => "cound not update meal"));
        }
      } else {


        if ($item->addMealToCart()) {
          http_response_code(200);
          echo json_encode(array("message" => "meal added to cart"));
        } else {
          http_response_code(500);
          echo json_encode(array("message" => "an error occurred"));
        }
      }
    }
  }
} else {
  http_response_code(400);
  echo json_encode(array("message" => "bad request"));
}
?>
