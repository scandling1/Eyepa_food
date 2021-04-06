<?php

 class ViewDbs{
  var $conn;
  var $result = array();

      
    function __construct(){
        global $database;
        $this->conn = $database->connect();
    }
      
         /**
     * To get database results
     *
     * @param string $query
     * @param string $paramType
     * @param array $paramArray
     * @return array
     */

    public function select($query, $paramType = "", $paramArray = array()){

        $stmt = $this->conn->prepare($query);

        if (! empty($paramType) && ! empty($paramArray)) {

            $this->bindQueryParams($stmt, $paramType, $paramArray);
        }
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $resultset[] = $row;
            }
        }

        if (! empty($resultset)) {
            return $resultset;
        }
    }

     /**
     * To insert
     *
     * @param string $query
     * @param string $paramType
     * @param array $paramArray
     * @return int
     */
    public function insert($query, $paramType, $paramArray){

        $stmt = $this->conn->prepare($query);
        $this->bindQueryParams($stmt, $paramType, $paramArray);

        $stmt->execute();
        $insertId = $stmt->insert_id;
        return $insertId;
    }

     /**
     * To execute query
     *
     * @param string $query
     * @param string $paramType
     * @param array $paramArray
     */
    public function execute($query, $paramType = "", $paramArray = array()){

        $stmt = $this->conn->prepare($query);

        if (! empty($paramType) && ! empty($paramArray)) {
            $this->bindQueryParams($stmt, $paramType, $paramArray);
        }
        $stmt->execute();
    }

     /**
     * 1.
     * Prepares parameter binding
     * 2. Bind prameters to the sql statement
     *
     * @param string $stmt
     * @param string $paramType
     * @param array $paramArray
     */
    public function bindQueryParams($stmt, $paramType, $paramArray = array()){

        $paramValueReference[] = & $paramType;
        for ($i = 0; $i < count($paramArray); $i ++) {
            $paramValueReference[] = & $paramArray[$i];
        }
        call_user_func_array(array(
            $stmt,
            'bind_param'
        ), $paramValueReference);
    }

    /**
     * To get database results
     *
     * @param string $query
     * @param string $paramType
     * @param array $paramArray
     * @return array
     */
    public function getRecordCount($query, $paramType = "", $paramArray = array()){
      
        $stmt = $this->conn->prepare($query);
        if (! empty($paramType) && ! empty($paramArray)) {

            $this->bindQueryParams($stmt, $paramType, $paramArray);
        }
        $stmt->execute();
        $stmt->store_result();
        $recordCount = $stmt->num_rows;

        return $recordCount;
    }

    function getallusers(){

        $query = "SELECT * FROM users";

         $this->results = mysqli_query($this->conn, $query);

          if(!$this->results || (mysqli_num_rows($this->results) < 1)){

             echo'Voter does not Exist';

          } else{

              return $this->results;

          }   

    }

    function getusers($field, $item){

        $query = sprintf("SELECT * FROM ".TBL_USERS." WHERE %s = '%s'",

           mysqli_real_escape_string($this->conn, $field),

           mysqli_real_escape_string($this->conn, $item));

             $this->results = mysqli_query($this->conn, $query);

               if(!$this->results || (mysqli_num_rows($this->results) < 1)){

                  echo'User does not Exist';

               } else{

                   return $this->results;

               }      

    }

    function import($import){
        if (isset($import)) {
    
          $fileName = $_FILES["file"]["tmp_name"];
          
          if ($_FILES["file"]["size"] > 0) {
              
              $file = fopen($fileName, "r");
              
              while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
                  
                  $country_name = "";
                  if (isset($column[0])) {
                      $country_name = mysqli_real_escape_string($this->conn, $column[0]);
                  }
                  $country_icon = "";
                  if (isset($column[1])) {
                      $country_icon = mysqli_real_escape_string($this->conn, $column[1]);
                  }
                  
                  $sqlInsert = "INSERT into ".TBL_COUNTRY." (country_name, country_icon)
                         values (?,?)";
                  $paramType = "ss";
                  $paramArray = array(
                      $country_name,
                      $country_icon
                  );
                  $insertId = $this->insert($sqlInsert, $paramType, $paramArray);
                  
                  if (! empty($insertId)) {
                      $type = "success";
                      $message = "CSV Data Imported into the Database";
                  } else {
                      $type = "error";
                      $message = "Problem in Importing CSV Data";
                  }
              }
          }
       }

    }

    function allcountries(){
        $query = "SELECT * FROM ".TBL_COUNTRY."";

         $this->results = mysqli_query($this->conn, $query);

          if(!$this->results || (mysqli_num_rows($this->results) < 1)){

             echo'No Country Exist';

          } else{

              return $this->results;

          } 
    }

    function get_countries_areas(){
        $query = "SELECT * FROM ".TBL_COUNTRY." INNER JOIN ".TBL_CITIES." 
                   WHERE ".TBL_COUNTRY.".country_id = ".TBL_CITIES.".country_id 
                   ORDER BY ".TBL_CITIES.".id";

         $this->results = mysqli_query($this->conn, $query);

          if(!$this->results || (mysqli_num_rows($this->results) < 1)){

          } else{

              return $this->results;

          } 
    }

    function create_cities($city_name, $country_id, $service_fee){

           $q = sprintf("INSERT INTO ".TBL_CITIES." (city_name, country_id, service_fee) 
           VALUES ('%s', '%s', '%s')",
           mysqli_real_escape_string($this->conn, $city_name),
           mysqli_real_escape_string($this->conn, $country_id),
           mysqli_real_escape_string($this->conn, $service_fee));
           return mysqli_query($this->conn, $q);
    }

    function get_cities(){
        $query = "SELECT * FROM ".TBL_CITIES." 
                   ORDER BY id";

         $this->results = mysqli_query($this->conn, $query);

          if(!$this->results || (mysqli_num_rows($this->results) < 1)){

          } else{

              return $this->results;

          } 
    }

    function get_restaurants(){
         $query = "SELECT * FROM (((restaurant
         INNER JOIN cities ON cities.id = restaurant.city_id)
         INNER JOIN country ON country.country_id = cities.country_id)
         INNER JOIN users ON restaurant.res_owner = users.username)
        ORDER BY restaurant.restaurant_id DESC";

         $this->results = mysqli_query($this->conn, $query);

          if(!$this->results || (mysqli_num_rows($this->results) < 1)){

          } else{

              return $this->results;

          } 
    }

    function create_restaurant($res_name, $res_address, $res_description, $res_email, $res_type, $res_hours, $res_picture, $res_featured_image, $res_city, $res_admin){
           
        $q = sprintf("INSERT INTO ".TBL_RESTAURANT." (city_id, res_owner, res_name, res_address, res_description, res_email, res_picture, res_featured_image, res_subscription_type, res_hours) 
        VALUES ('%s', '%s', '%s','%s', '%s', '%s', '%s', '%s','%s', '%s')",
        mysqli_real_escape_string($this->conn, $res_city),
        mysqli_real_escape_string($this->conn, $res_admin),
        mysqli_real_escape_string($this->conn, $res_name),
        mysqli_real_escape_string($this->conn, $res_address),
        mysqli_real_escape_string($this->conn, $res_description),
        mysqli_real_escape_string($this->conn, $res_email),
        mysqli_real_escape_string($this->conn, $res_picture),
        mysqli_real_escape_string($this->conn, $res_featured_image),
        mysqli_real_escape_string($this->conn, $res_type),
        mysqli_real_escape_string($this->conn, $res_hours));
        
        return mysqli_query($this->conn, $q);
    }

    function get_paticular_users($userlevel){
        $query = "SELECT * FROM (( users
        INNER JOIN cities ON cities.id = users.city_id)
        INNER JOIN country ON country.country_id = cities.country_id)
        WHERE users.userlevel= '$userlevel'";

        $this->results = mysqli_query($this->conn, $query);

         if(!$this->results || (mysqli_num_rows($this->results) < 1)){

         } else{

             return $this->results;

         } 
    }

    function get_all_customers(){
        $query = "SELECT * FROM (( customers
        INNER JOIN cities ON cities.id = customers.city_id)
        INNER JOIN country ON country.country_id = cities.country_id)";

        $this->results = mysqli_query($this->conn, $query);

         if(!$this->results || (mysqli_num_rows($this->results) < 1)){

         } else{

             return $this->results;

         } 
    }

   function get($field){
       
             $query = sprintf("SELECT * FROM ".TBL_USERS." WHERE city_id = '%s' AND userlevel = 5",

           mysqli_real_escape_string($this->conn, $field));

             $this->results = mysqli_query($this->conn, $query);

               if(!$this->results || (mysqli_num_rows($this->results) < 1)){

                  echo'User does not Exist';

               } else{
                   return $this->results;

               }      
   }

   function create_meal_category($city_id, $res_id, $title, $description){

    $q = sprintf("INSERT INTO ".TBL_MEAL_CATEGORY." (city_id, res_id, title, description) 
    VALUES ('%s', '%s', '%s', '%s')",
    mysqli_real_escape_string($this->conn, $city_id),
    mysqli_real_escape_string($this->conn, $res_id),
    mysqli_real_escape_string($this->conn, $title),
    mysqli_real_escape_string($this->conn, $description));
    return mysqli_query($this->conn, $q);
   }

   function get_meal_category($city_id, $res_id){
    $query = "SELECT * FROM ".TBL_MEAL_CATEGORY." 
                WHERE city_id = '$city_id' AND res_id = '$res_id'
                ORDER BY id DESC";

     $this->results = mysqli_query($this->conn, $query);

      if(!$this->results || (mysqli_num_rows($this->results) < 1)){

      } else{

          return $this->results;

      } 
   }

   function get_single_restaurant($city_id, $res_id){
    $query = "SELECT * FROM (restaurant
    INNER JOIN cities ON cities.id = '$city_id')
    WHERE restaurant.restaurant_id = '$res_id'
    ORDER BY restaurant.restaurant_id DESC";

    $this->results = mysqli_query($this->conn, $query);

     if(!$this->results || (mysqli_num_rows($this->results) < 1)){

     } else{

         return $this->results;

     } 
   }

   function add_meal($city_id, $res_id, $meal_name, $meal_price, $meal_picture, $meal_category, $meal_description, $meal_status){
           
    $q = sprintf("INSERT INTO meals (city_id, res_id, meal_name, meal_price, meal_picture, meal_category, meal_description, meal_status) 
    VALUES ('%s', '%s', '%s','%s', '%s', '%s','%s', '%s')",
    mysqli_real_escape_string($this->conn, $city_id),
    mysqli_real_escape_string($this->conn, $res_id),
    mysqli_real_escape_string($this->conn, $meal_name),
    mysqli_real_escape_string($this->conn, $meal_price),
    mysqli_real_escape_string($this->conn, $meal_picture),
    mysqli_real_escape_string($this->conn, $meal_category),
    mysqli_real_escape_string($this->conn, $meal_description),
    mysqli_real_escape_string($this->conn, $meal_status));
    
    return mysqli_query($this->conn, $q);
   }

   function get_meals($res_id){
     $query = "SELECT * FROM (meals
              INNER JOIN meal_category ON meal_category.id = meals.meal_category)
              WHERE meals.res_id = '$res_id'
              ORDER BY meals.mid DESC";

     $this->results = mysqli_query($this->conn, $query);

      if(!$this->results || (mysqli_num_rows($this->results) < 1)){

      } else{

          return $this->results;

      } 
   }

}

?>