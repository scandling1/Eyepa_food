<?php
/**
 * Database.php
 * 
 * The Database class is meant to simplify the task of accessing
 * information from the website's database.
 *
 * Written by: Jpmaster77 a.k.a. The Grandmaster of C++ (GMC)
 * Last Updated: June 15, 2011 by Ivan Novak
 */
include("constants.php");
      
class MySQLDB
{
   var $connection;         //The MySQL database connection
   var $num_active_users;   //Number of active users viewing site
   var $num_active_guests;  //Number of active guests viewing site
   var $num_members;        //Number of signed-up users
   /* Note: call getNumMembers() to access $num_members! */

   /* Class constructor */
   function MySQLDB(){
      /* Make connection to database */
      $this->connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME)
 or die('Connect Error2 (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
      
      /**
       * Only query database to find out number of members
       * when getNumMembers() is called for the first time,
       * until then, default value set.
       */
      $this->num_members = -1;
      
      if(TRACK_VISITORS){
         /* Calculate number of users at site */
         $this->calcNumActiveUsers();
      
         /* Calculate number of guests at site */
         $this->calcNumActiveGuests();
      }
   }

   /**
    * confirmUserPass - Checks whether or not the given
    * username is in the database, if so it checks if the
    * given password is the same password in the database
    * for that user. If the user doesn't exist or if the
    * passwords don't match up, it returns an error code
    * (1 or 2). On success it returns 0.
    */
   function confirmUserPass($username, $password){
      /* Add slashes if necessary (for query) */

      /* Verify that user is in database */
      $q = sprintf("SELECT password FROM ".TBL_USERS." where username = '%s'",
            mysqli_real_escape_string($this->connection, $username));
      $result = mysqli_query( $this->connection, $q);
      if(!$result || (mysqli_num_rows($result) < 1)){
         return 1; //Indicates username failure
      }

      /* Retrieve password from result, strip slashes */
      $dbarray = mysqli_fetch_array($result);
      $dbarray['password'] = stripslashes($dbarray['password']);
      $password = stripslashes($password);

      /* Validate that password is correct */
      if($password == $dbarray['password']){
         return 0; //Success! Username and password confirmed
      }
      else{
         return 2; //Indicates password failure
      }
   }
   
   /**
    * confirmUserID - Checks whether or not the given
    * username is in the database, if so it checks if the
    * given userid is the same userid in the database
    * for that user. If the user doesn't exist or if the
    * userids don't match up, it returns an error code
    * (1 or 2). On success it returns 0.
    */
   function confirmUserID($username, $userid){
      /* Add slashes if necessary (for query) */

      /* Verify that user is in database */
      $q = sprintf("SELECT userid FROM ".TBL_USERS." WHERE username= '%s'",
            mysqli_real_escape_string($this->connection, $username));
      $result = mysqli_query( $this->connection, $q);
      if(!$result || (mysqli_num_rows($result) < 1)){
         return 1; //Indicates username failure
      }

      /* Retrieve userid from result, strip slashes */
      $dbarray = mysqli_fetch_array($result);
      $dbarray['userid'] = stripslashes($dbarray['userid']);
      $userid = stripslashes($userid);

      /* Validate that userid is correct */
      if($userid == $dbarray['userid']){
         return 0; //Success! Username and userid confirmed
      }
      else{
         return 2; //Indicates userid invalid
      }
   }
   
   /**
    * usernameTaken - Returns true if the username has
    * been taken by another user, false otherwise.
    */
   function usernameTaken($username){

      $q = sprintf("SELECT username FROM ".TBL_USERS." WHERE username = '%s'",
            mysqli_real_escape_string($this->connection, $username));
      $result = mysqli_query( $this->connection, $q);
      return (mysqli_num_rows($result) > 0);
   }
   
   
   /**
    * emailTaken - Returns true if the email has
    * been taken by another user, false otherwise.
    */
    function emailTaken($email){
      
       $q = sprintf("SELECT email FROM ".TBL_USERS." WHERE email = '%s'",
            mysqli_real_escape_string($this->connection, $email));
       $result = mysqli_query( $this->connection, $q);
       return (mysqli_num_rows($result) > 0);
    }
    
   /**
    * usernameBanned - Returns true if the username has
    * been banned by the administrator.
    */
   function usernameBanned($username){
      
      $q = sprintf("SELECT username FROM ".TBL_BANNED_USERS." WHERE username = '%s'",
            mysqli_real_escape_string($this->connection, $username));
      $result = mysqli_query( $this->connection, $q);
      return (mysqli_num_rows($result) > 0);
   }
   
   /**
    * addNewUser - Inserts the given (username, password, email)
    * info into the database. Appropriate user level is set.
    * Returns true on success, false otherwise.
    */
   function addNewUser($username, $password, $email, $userid, $name, $resname1, $city_id, $phone, $ulevel){
      $time = time();
      /* If admin sign up, give admin user level */
      
       $q = sprintf("INSERT INTO ".TBL_USERS." (username, password, userid, userlevel, email, timestamp, valid, name, res_id, city_id, profile_picture, phone, hash, hash_generated) 
                  VALUES ('%s', '%s', '%s', '%s', '%s', '$time', '0', '%s', '', '%s', '%s', '%s', '0', '0')",
            mysqli_real_escape_string($this->connection, $username),
            mysqli_real_escape_string($this->connection, $password),
            mysqli_real_escape_string($this->connection, $userid),
            mysqli_real_escape_string($this->connection, $ulevel),
            mysqli_real_escape_string($this->connection, $email),
            mysqli_real_escape_string($this->connection, $name),
            mysqli_real_escape_string($this->connection, $city_id),
            mysqli_real_escape_string($this->connection, $resname1),
            mysqli_real_escape_string($this->connection, $phone));
          return mysqli_query($this->connection, $q);
   }
   
   /**
    * updateUserField - Updates a field, specified by the field
    * parameter, in the user's row of the database.
    */
   function updateUserField($username, $field, $value){
      $q = sprintf("UPDATE ".TBL_USERS." SET %s = '%s' WHERE username = '%s'",
            mysqli_real_escape_string($this->connection, $field),
            mysqli_real_escape_string($this->connection, $value),
            mysqli_real_escape_string($this->connection, $username));
      return mysqli_query( $this->connection, $q);
   }
   
   /**
    * getUserInfo - Returns the result array from a mysql
    * query asking for all information stored regarding
    * the given username. If query fails, NULL is returned.
    */
   function getUserInfo($username){
      $q = sprintf("SELECT * FROM ".TBL_USERS." WHERE username = '%s'",
            mysqli_real_escape_string($this->connection, $username));
      $result = mysqli_query( $this->connection, $q);
      /* Error occurred, return given name by default */
      if(!$result || (mysqli_num_rows($result) < 1)){
         return NULL;
      }
      /* Return result array */
      $dbarray = mysqli_fetch_array($result);
      return $dbarray;
   }
   
   function getUserInfoFromHash($hash){
   		$q = sprintf("SELECT * FROM ".TBL_USERS." WHERE hash = '%s'",
   				mysqli_real_escape_string($this->connection, $hash));
   		$result = mysqli_query( $this->connection, $q);
   		if(!$result || (mysqli_num_rows($result) < 1)){
   			return NULL;
   		}
   		$dbarray = mysqli_fetch_array($result);
   		return $dbarray;
   }
   
   /**
    * getNumMembers - Returns the number of signed-up users
    * of the website, banned members not included. The first
    * time the function is called on page load, the database
    * is queried, on subsequent calls, the stored result
    * is returned. This is to improve efficiency, effectively
    * not querying the database when no call is made.
    */
   function getNumMembers(){
      if($this->num_members < 0){
         $q = "SELECT * FROM ".TBL_USERS;
         $result = mysqli_query( $this->connection, $q);
         $this->num_members = mysqli_num_rows($result);
      }
      return $this->num_members;
   }
   
   /**
    * calcNumActiveUsers - Finds out how many active users
    * are viewing site and sets class variable accordingly.
    */
   function calcNumActiveUsers(){
      /* Calculate number of users at site */
      $q = "SELECT * FROM ".TBL_ACTIVE_USERS;
      $result = mysqli_query( $this->connection, $q);
      $this->num_active_users = mysqli_num_rows($result);    
   }
   
   /**
    * calcNumActiveGuests - Finds out how many active guests
    * are viewing site and sets class variable accordingly.
    */
   function calcNumActiveGuests(){
      /* Calculate number of guests at site */
      $q = "SELECT * FROM ".TBL_ACTIVE_GUESTS;
      $result = mysqli_query( $this->connection, $q);
      $this->num_active_guests = mysqli_num_rows($result);
   }
   
   /**
    * addActiveUser - Updates username's last active timestamp
    * in the database, and also adds him to the table of
    * active users, or updates timestamp if already there.
    */
   function addActiveUser($username, $time){
      $q = sprintf("UPDATE ".TBL_USERS." SET timestamp = '%s' WHERE username = '%s'",
            mysqli_real_escape_string($this->connection, $time),
            mysqli_real_escape_string($this->connection, $username));
      mysqli_query( $this->connection, $q);
      
      if(!TRACK_VISITORS) return;
      $q = sprintf("REPLACE INTO ".TBL_ACTIVE_USERS." VALUES ('%s', '%s')",
            mysqli_real_escape_string($this->connection, $username),
            mysqli_real_escape_string($this->connection, $time));
      mysqli_query( $this->connection, $q);
      $this->calcNumActiveUsers();
   }
   
   /* addActiveGuest - Adds guest to active guests table */
   function addActiveGuest($ip, $time){
      if(!TRACK_VISITORS) return;
      $q = sprintf("REPLACE INTO ".TBL_ACTIVE_GUESTS." VALUES ('%s', '%s')",
            mysqli_real_escape_string($this->connection, $ip),
            mysqli_real_escape_string($this->connection, $time));
      mysqli_query( $this->connection, $q);
      $this->calcNumActiveGuests();
   }
   
   /* These functions are self explanatory, no need for comments */
   
   /* removeActiveUser */
   function removeActiveUser($username){
      if(!TRACK_VISITORS) return;
      $q = sprintf("DELETE FROM ".TBL_ACTIVE_USERS." WHERE username = '%s'",
            mysqli_real_escape_string($this->connection, $username));
      mysqli_query( $this->connection, $q);
      $this->calcNumActiveUsers();
   }
   
   /* removeActiveGuest */
   function removeActiveGuest($ip){
      if(!TRACK_VISITORS) return;
      $q = sprintf("DELETE FROM ".TBL_ACTIVE_GUESTS." WHERE ip = '$ip'",
            mysqli_real_escape_string($this->connection, $ip));
      mysqli_query( $this->connection, $q);
      $this->calcNumActiveGuests();
   }
   
   /* removeInactiveUsers */
   function removeInactiveUsers(){
      if(!TRACK_VISITORS) return;
      $timeout = time()-USER_TIMEOUT*60;
      $q = sprintf("DELETE FROM ".TBL_ACTIVE_USERS." WHERE timestamp < %s", 
            mysqli_real_escape_string($this->connection, $timeout));
      mysqli_query( $this->connection, $q);
      $this->calcNumActiveUsers();
   }

   /* removeInactiveGuests */
   function removeInactiveGuests(){
      if(!TRACK_VISITORS) return;
      $timeout = time()-GUEST_TIMEOUT*60;
      $q = sprintf("DELETE FROM ".TBL_ACTIVE_GUESTS." WHERE timestamp < %s",
            mysqli_real_escape_string($this->connection, $timeout));
      mysqli_query( $this->connection, $q);
      $this->calcNumActiveGuests();
   }
   
   /**
    * query - Performs the given query on the database and
    * returns the result, which may be false, true or a
    * resource identifier.
    */
   function query($query){
      return mysqli_query($this->connection, $query);
   }

   function connect(){
      return $this->connection;
   }
};

/* Create database connection */
$database = new MySQLDB;

?>
