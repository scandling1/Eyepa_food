<?php
    class Control{

        // Connection
        private $conn;

        // Table
        private $db_table = "Employee";
        private $dbt_customers = "customers";
        private $dbt_restaurant = "restaurant";
        private $dbt_cities = "cities";
        private $dbt_country = "country";
        private $dbt_meal_category = "meal_category";
        private $dbt_meals = "meals";
        private $dbt_cart = "order_cart";
        private $dbt_delivery_address = "delivery_address";

        // Columns
        public $id;
        public $name;
        public $email;
        public $age;
        public $designation;
        public $created;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET RESTAURANTS
        public function getRestaurants(){
            $sqlQuery = "SELECT * FROM ".$this->dbt_restaurant."
                          WHERE city_id = ?";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->city_id);

            $stmt->execute();
             return $stmt;
        }

         // GET RESTAURANTS
         public function searchRestaurants(){
            $sqlQuery = "SELECT * FROM ".$this->dbt_restaurant."
                          WHERE city_id = ? AND res_name LIKE ?";

            $stmt = $this->conn->prepare($sqlQuery);
            $this->res_name = "%".$this->res_name."%";

            $stmt->bindParam(1, $this->city_id);
            $stmt->bindParam(2, $this->res_name);

            $stmt->execute();
             return $stmt;
        }

        // GET ALL MEALS FORM ONE RESTAURANT
        public function getAllMeals(){
            $sqlQuery = "SELECT * FROM ".$this->dbt_meals."
                          WHERE res_id = ?";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->res_id);

            $stmt->execute();
             return $stmt;
        }

         // GET MEAL CATEGORIES
         public function getMealCategoty(){
            $sqlQuery = "SELECT * FROM ".$this->dbt_meal_category."
                          WHERE res_id = ?";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->res_id);

            $stmt->execute();
             return $stmt;
        }

         // GET MEAL WITH CATEGORIES
         public function getMeals(){
            $sqlQuery = "SELECT * FROM ".$this->dbt_meals."
                          WHERE res_id = ? AND meal_category = ?";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->res_id);
            $stmt->bindParam(2, $this->meal_category);

            $stmt->execute();
             return $stmt;
        }

         // GET COUNTRIES
         public function getCountries(){
            $sqlQuery = "SELECT * FROM ".$this->dbt_country."
                          ORDER BY country_id DESC";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->execute();
             return $stmt;
        }

         // GET CITIES
         public function getCities(){
            $sqlQuery = "SELECT * FROM ".$this->dbt_cities."
                          WHERE ".$this->dbt_cities.".country_id = ?";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->country_id);

            $stmt->execute();
             return $stmt;
        }

        // CREATE USER
        public function createUser(){
            $sqlQuery = "INSERT INTO
                        ". $this->dbt_customers ."
                    SET
                        user_id = :user_id, 
                        user_name = :user_name, 
                        email = :email, 
                        picture = :picture,
                        phone = :phone,
                        city_id = :city_id, 
                        date = :created";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->user_id=htmlspecialchars(strip_tags($this->user_id));
            $this->user_name=htmlspecialchars(strip_tags($this->user_name));
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->picture=htmlspecialchars(strip_tags($this->picture));
            $this->phone=htmlspecialchars(strip_tags($this->phone));
            $this->city_id=htmlspecialchars(strip_tags($this->city_id));
            $this->created=htmlspecialchars(strip_tags($this->created));
        
            // bind data
            $stmt->bindParam(":user_id", $this->user_id);
            $stmt->bindParam(":user_name", $this->user_name);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":picture", $this->picture);
            $stmt->bindParam(":phone", $this->phone);
            $stmt->bindParam(":city_id", $this->city_id);
            $stmt->bindParam(":created", $this->created);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

         // ADD MEAL TO CART
         public function addMealToCart(){
            $sqlQuery = "INSERT INTO
                        ". $this->dbt_cart ."
                    SET
                        city_id = :city_id, 
                        res_id = :res_id, 
                        userid = :userid, 
                        meal_id = :meal_id,
                        meal_count = :meal_count,
                        meal_count_price = :meal_count_price,
                        dates = :dates";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->city_id=htmlspecialchars(strip_tags($this->city_id));
            $this->res_id=htmlspecialchars(strip_tags($this->res_id));
            $this->userid=htmlspecialchars(strip_tags($this->userid));
            $this->meal_id=htmlspecialchars(strip_tags($this->meal_id));
            $this->meal_count=htmlspecialchars(strip_tags($this->meal_count));
            $this->meal_count_price=htmlspecialchars(strip_tags($this->meal_count_price));
            $this->dates=htmlspecialchars(strip_tags($this->dates));
        
            // bind data
            $stmt->bindParam(":city_id", $this->city_id);
            $stmt->bindParam(":res_id", $this->res_id);
            $stmt->bindParam(":userid", $this->userid);
            $stmt->bindParam(":meal_id", $this->meal_id);
            $stmt->bindParam(":meal_count", $this->meal_count);
            $stmt->bindParam(":meal_count_price", $this->meal_count_price);
            $stmt->bindParam(":dates", $this->dates);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // UPDATE MEAL TO CART
        public function updateMealToCart(){
            $sqlQuery = "UPDATE
                        ". $this->dbt_cart ."
                    SET
                        city_id = :city_id, 
                        res_id = :res_id, 
                        userid = :userid, 
                        meal_id = :meal_id,
                        meal_count = :meal_count,
                        meal_count_price = :meal_count_price,
                        dates = :dates
                    WHERE 
                        userid = :userid AND meal_id = :meal_id";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->city_id=htmlspecialchars(strip_tags($this->city_id));
            $this->res_id=htmlspecialchars(strip_tags($this->res_id));
            $this->userid=htmlspecialchars(strip_tags($this->userid));
            $this->meal_id=htmlspecialchars(strip_tags($this->meal_id));
            $this->meal_count=htmlspecialchars(strip_tags($this->meal_count));
            $this->meal_count_price=htmlspecialchars(strip_tags($this->meal_count_price));
            $this->dates=htmlspecialchars(strip_tags($this->dates));
        
            // bind data
            $stmt->bindParam(":city_id", $this->city_id);
            $stmt->bindParam(":res_id", $this->res_id);
            $stmt->bindParam(":userid", $this->userid);
            $stmt->bindParam(":meal_id", $this->meal_id);
            $stmt->bindParam(":meal_count", $this->meal_count);
            $stmt->bindParam(":meal_count_price", $this->meal_count_price);
            $stmt->bindParam(":dates", $this->dates);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

         // GET MEAL WITH CATEGORIES
         public function getCountCart(){
            $sqlQuery = "SELECT * FROM ".$this->dbt_cart."
                          ORDER BY id DESC";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->execute();
             return $stmt;
        }

        // GET SINGLE MEAL
        public function getSingleMeal(){
                $sqlQuery = "SELECT * FROM ".$this->dbt_meals."
                              WHERE id = ?";
    
                $stmt = $this->conn->prepare($sqlQuery);
    
                $stmt->bindParam(1, $this->meal_id);
    
                $stmt->execute();
                 return $stmt;
        }

         // CHECK CART
         public function checkCart(){
            $sqlQuery = "SELECT * FROM ".$this->dbt_cart."
                          WHERE meal_id = ? AND userid = ?";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->meal_id);
            $stmt->bindParam(2, $this->userid);

            $stmt->execute();
             return $stmt;
        }

         // ADD DELIVERY ADDRESS
         public function addDeliveryAddress(){
            $sqlQuery = "INSERT INTO
                        ".$this->dbt_delivery_address."
                    SET
                        user_id = :user_id, 
                        address = :address, 
                        city = :city, 
                        area = :area,
                        latitude = :latitude,
                        longitude = :longitude, 
                        phone_number = :phone_number,
                        dates = :dates";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->user_id=htmlspecialchars(strip_tags($this->user_id));
            $this->address=htmlspecialchars(strip_tags($this->address));
            $this->city=htmlspecialchars(strip_tags($this->city));
            $this->area=htmlspecialchars(strip_tags($this->area));
            $this->latitude=htmlspecialchars(strip_tags($this->latitude));
            $this->longitude=htmlspecialchars(strip_tags($this->longitude));
            $this->phone_number=htmlspecialchars(strip_tags($this->phone_number));
            $this->dates=htmlspecialchars(strip_tags($this->dates));
        
            // bind data
            $stmt->bindParam(":user_id", $this->user_id);
            $stmt->bindParam(":address", $this->address);
            $stmt->bindParam(":city", $this->city);
            $stmt->bindParam(":area", $this->area);
            $stmt->bindParam(":latitude", $this->latitude);
            $stmt->bindParam(":longitude", $this->longitude);
            $stmt->bindParam(":phone_number", $this->phone_number);
            $stmt->bindParam(":dates", $this->dates);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

          // GET DELIVERY ADDRESS
        public function getDeliveryAddress(){
            $sqlQuery = "SELECT * FROM ".$this->dbt_delivery_address."
                          WHERE user_id = ?";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->user_id);

            $stmt->execute();
             return $stmt;
        }

        // READ SINGLE
        public function getSingleEmployee(){
            $sqlQuery = "SELECT
                        id, 
                        name, 
                        email, 
                        age, 
                        designation, 
                        created
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       id = ?
                    LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->id);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->name = $dataRow['name'];
            $this->email = $dataRow['email'];
            $this->age = $dataRow['age'];
            $this->designation = $dataRow['designation'];
            $this->created = $dataRow['created'];
        }        

        // UPDATE
        public function updateEmployee(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        name = :name, 
                        email = :email, 
                        age = :age, 
                        designation = :designation, 
                        created = :created
                    WHERE 
                        id = :id";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->age=htmlspecialchars(strip_tags($this->age));
            $this->designation=htmlspecialchars(strip_tags($this->designation));
            $this->created=htmlspecialchars(strip_tags($this->created));
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            // bind data
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":age", $this->age);
            $stmt->bindParam(":designation", $this->designation);
            $stmt->bindParam(":created", $this->created);
            $stmt->bindParam(":id", $this->id);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        function deleteEmployee(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            $stmt->bindParam(1, $this->id);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    }
?>
