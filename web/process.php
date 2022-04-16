<?php

include('../include/views_controller.php');

class Process
{

   /* Class constructor */
   function Process(){
      global $session;
      /* User submitted login form */
      if(isset($_POST['sublogin'])){
         $this->procLogin();
      }
      /* User submitted registration form */
      else if(isset($_POST['subjoin'])){
         $this->procRegister();
      }
      /* User submitted forgot password form */
      else if(isset($_POST['subforgot'])){
         $this->procForgotPass();
      }
      /* User submitted edit account form */
      else if(isset($_POST['subedit'])){
         $this->procEditAccount();
      }
      elseif(isset($_POST['subarea'])){
         $this->procArea();
      }
      elseif(isset($_POST['subrestaurant'])){
         $this->procRestaurant();
      }
      elseif(isset($_POST['subaddmealcat'])){
         $this->procAddMealCat();
      }
      elseif(isset($_POST['subaddmeal'])){
         $this->procAddMeal();
      }
      else if(isset($_POST['subConfirm'])){
      	$this->procSendConfirm();
      }
      else if(isset($_POST['login_with_hash'])){
      	$this->procHashLogin($_POST['hash']);
      }
      /**
       * The only other reason user should be directed here
       * is if he wants to logout, which means user is
       * logged in currently.
       */
      else if($session->logged_in){
         $this->procLogout();
      }
      /**
       * Should not get here, which means user is viewing this page
       * by mistake and therefore is redirected.
       */
       else{
          header("Location: auth-login.php");
       }
   }

   /**
    * procLogin - Processes the user submitted login form, if errors
    * are found, the user is redirected to correct the information,
    * if not, the user is effectively logged in to the system.
    */
   function procLogin(){
      global $session, $form;
      /* Login attempt */
      $_POST = $session->cleanInput($_POST);
      $retval = $session->login($_POST['user'], $_POST['pass'], isset($_POST['remember']));
      
      /* Login successful */
      if($retval){
         header("Location: ".$session->referrer);
      }
      /* Login failed */
      else{
         $_SESSION['value_array'] = $_POST;
         $_SESSION['error_array'] = $form->getErrorArray();
         header("Location: ".$session->referrer);
      }
   }
   
   /**
    * procLogout - Simply attempts to log the user out of the system
    * given that there is no logout form to process.
    */
   function procLogout(){
      global $session;
      $retval = $session->logout();
      header("Location: auth-login.php");
   }
   
   /**
    * procRegister - Processes the user submitted registration form,
    * if errors are found, the user is redirected to correct the
    * information, if not, the user is effectively registered with
    * the system and an email is (optionally) sent to the newly
    * created user.
    */
   function procRegister(){
      global $session, $form;
      $_POST = $session->cleanInput($_POST);
      /* Convert username to all lowercase (by option) */
      if(ALL_LOWERCASE){
         $_POST['user'] = strtolower($_POST['user']);
      }
      if(isset($_FILES['res_picture'])){
         $allowed = array('png', 'jpg');
             $extension1 = pathinfo($_FILES['res_picture']['name'], PATHINFO_EXTENSION);
                 if(!in_array(strtolower($extension1), $allowed)){
                      echo '{"status":"error1"}';
                         } 
                           else{
                             move_uploaded_file($_FILES['res_picture']['tmp_name'], 'uploads/'.$_FILES['res_picture']['name']);    
                             $resname1 = 'uploads/'.$_FILES['res_picture']['name'];

      /* Registration attempt */
      $retval = $session->register($_POST['user'], $_POST['pass'], $_POST['email'], $_POST['name'], $resname1, $_POST['city_id'], $_POST['phone'],  $_POST['user_level']);
      
      /* Registration Successful */
      if($retval == 0){
         $_SESSION['reguname'] = $_POST['user'];
         $_SESSION['regsuccess'] = true;
         header("Location: ".$session->referrer."?succ=we");
      }
      /* Error found with form */
      else if($retval == 1){
         $_SESSION['value_array'] = $_POST;
         $_SESSION['error_array'] = $form->getErrorArray();
         header("Location: ".$session->referrer."?not=we");
      }
      /* Registration attempt failed */
      else if($retval == 2){
         $_SESSION['reguname'] = $_POST['user'];
         $_SESSION['regsuccess'] = false;
         header("Location: ".$session->referrer);
      }
     }
    }
   }
   
   /**
    * procForgotPass - Validates the given username then if
    * everything is fine, a new password is generated and
    * emailed to the address the user gave on sign up.
    */
   function procForgotPass(){
      global $database, $session, $mailer, $form;
      $_POST = $session->cleanInput($_POST);
      /* Username error checking */
      $subuser = $_POST['user'];
      $field = "user";  //Use field name for username
      if(!$subuser || strlen($subuser = trim($subuser)) == 0){
         $form->setError($field, "* Username not entered<br>");
      }
      else{
         /* Make sure username is in database */
         $subuser = stripslashes($subuser);
         if(strlen($subuser) < 5 || strlen($subuser) > 30 ||
            !ctype_alnum($subuser) ||
            (!$database->usernameTaken($subuser))){
            $form->setError($field, "* Username does not exist<br>");
         }
      }
      
      /* Errors exist, have user correct them */
      if($form->num_errors > 0){
         $_SESSION['value_array'] = $_POST;
         $_SESSION['error_array'] = $form->getErrorArray();
      }
      /* Generate new password and email it to user */
      else{
         /* Generate new password */
         $newpass = $session->generateRandStr(8);
         
         /* Get email of user */
         $usrinf = $database->getUserInfo($subuser);
         $email  = $usrinf['email'];
         
         /* Attempt to send the email with new password */
         if($mailer->sendNewPass($subuser,$email,$newpass)){
            /* Email sent, update database */
            $database->updateUserField($subuser, "password", md5($newpass));
            $_SESSION['forgotpass'] = true;
         }
         /* Email failure, do not change password */
         else{
            $_SESSION['forgotpass'] = false;
         }
      }
      
      header("Location: ".$session->referrer);
   }
   
   /**
    * procEditAccount - Attempts to edit the user's account
    * information, including the password, which must be verified
    * before a change is made.
    */
   function procEditAccount(){
      global $session, $form;
      $_POST = $session->cleanInput($_POST);
      /* Account edit attempt */
      $retval = $session->editAccount($_POST['curpass'], $_POST['newpass'], $_POST['email'], $_POST['name']);

      /* Account edit successful */
      if($retval){
         $_SESSION['useredit'] = true;
         header("Location: ".$session->referrer);
      }
      /* Error found with form */
      else{
         $_SESSION['value_array'] = $_POST;
         $_SESSION['error_array'] = $form->getErrorArray();
         header("Location: ".$session->referrer);
      }
   }
   
   /**
   	* procSendConfirm - only needs to be used if the administrator
   	* changes the EMAIL_WELCOME from false to true and wants
   	* the users to confirm themselves. (why not?!)
   	*/
   function procSendConfirm(){
       global $session, $form, $database, $mailer;
       $_POST = $session->cleanInput($_POST);
       
       $user	=	$_POST['user'];
       $pass	=	$_POST['pass'];
       
      /* Checks that username is in database and password is correct */
      $user = stripslashes($user);
      $result = $database->confirmUserPass($user, md5($pass));

      /* Check error codes */
      if($result == 1){
         $field = "user";
         $form->setError($field, "* Username not found");
      }
      elseif($result == 2){
         $field = "pass";
         $form->setError($field, "* Invalid password");
      }
      
      /* Check to see if the user is already valid */
      $q = "SELECT valid FROM ".TBL_USERS." WHERE username='$user'";
      $valid = $database->query($q);
      $valid = mysqli_fetch_array($valid);
      $valid = $valid['valid'];
      
      if($valid == 1){
         $field = 'user';
         $form->setError($field, "* Username already confirmed.");
      }
      
      /* Return if form errors exist */
      if($form->num_errors > 0){
         $_SESSION['value_array'] = $_POST;
         $_SESSION['error_array'] = $form->getErrorArray();
         header("Location: ".$session->referrer);
      }
      else{
	      $q = "SELECT username, userid, email FROM ".TBL_USERS." WHERE username='$user'";
	      $info = $database->query($q) or die('error');
	      $info = mysqli_fetch_array($info);
	      
		      $username = $info['username'];
		      $userid = $info['userid'];
		      $email = $info['email'];
	      
	      if($mailer->sendConfirmation($username,$userid,$email)){
	      	  echo "Your confirmation email has been sent! Back to <a href='main.php'>Main</a>";
	      }
	  }
   }
   
   function procHashLogin($hash){
   		global $session, $database;
   		if(substr($hash,0,1) === "#"){
   			$hash = substr($hash,1);
   		}
   		
   		$user_info = $database->getUserInfoFromHash($hash);
		
   		if($user_info['hash_generated'] < (time() - (60*60*24*3))){
   			// if the hash was generated more than 3 days ago, the hash is invalid.
   			// let's invalidate and refuse the hash.
   			$database->updateUserField($user_info['username'], 'hash', $session->generateRandID());
	        $database->updateUserField($user_info['username'], 'hash_generated', time());
	        return false;
   		}
   		
   		if($user_info['username'] && $user_info['userid']){  
   			$_SESSION['username'] = $user_info['username'];
	   		$_SESSION['userid'] = $user_info['userid'];
	   		$session->checkLogin();
	   		die("Logging In...");
	   	} else {
	   		die();
	   	}
   }

   function procArea(){
       global $session, $view_dbs;

      $_POST = $session->cleanInput($_POST);
      /* Convert username to all lowercase (by option) */
      if(FIRST_UPPER){
         $_POST['city_name'] = ucwords($_POST['city_name']);
      }
      /* Registration attempt */
      $retval = $view_dbs->create_cities($_POST['city_name'], $_POST['country_id'], $_POST['service_fee']);
      
      /* Registration Successful */
      if($retval){
        header('location: cities.php');
      } else {
         echo 'Cound not create City';
      }
   }

   function procRestaurant(){
      global $session, $view_dbs;

     $_POST = $session->cleanInput($_POST);
     /* Convert username to all lowercase (by option) */
     if(FIRST_UPPER){
        $_POST['res_name'] = ucwords($_POST['res_name']);
     }

     if(isset($_FILES['res_picture']) || isset($_FILES['res_featured_image'])){
         $allowed = array('png', 'jpg', 'jpeg');
             $extension1 = pathinfo($_FILES['res_picture']['name'], PATHINFO_EXTENSION);
             $extension2 = pathinfo($_FILES['res_featured_image']['name'], PATHINFO_EXTENSION);
                 if(!in_array(strtolower($extension1), $allowed) || !in_array(strtolower($extension2), $allowed)){
                      echo '{"status":"error1"}';
                         } 
                           else{
                             move_uploaded_file($_FILES['res_picture']['tmp_name'], 'uploads/'.$_FILES['res_picture']['name']); 
                             move_uploaded_file($_FILES['res_featured_image']['tmp_name'], 'uploads/'.$_FILES['res_featured_image']['name']);    
                             $resname1 = 'uploads/'.$_FILES['res_picture']['name'];
                             $resname2 = 'uploads/'.$_FILES['res_featured_image']['name'];

     /* Registration attempt */
     $retval = $view_dbs->create_restaurant($_POST['res_name'], $_POST['res_address'], $_POST['res_description'], $_POST['res_email'], $_POST['res_type'], $_POST['res_hours'], $resname1, $resname2, $_POST['res_city'], $_POST['res_admin']);
     
     /* Registration Successful */
     if($retval){
       header('location: all_restaurants.php');
     } else {
        echo 'Cound not create Restaurant';
     }
    }
    }
   }

   function procAddMealCat(){
      global $session, $view_dbs;

     $_POST = $session->cleanInput($_POST);
     /* Convert username to all lowercase (by option) */
     if(FIRST_UPPER){
        $_POST['title'] = ucwords($_POST['title']);
     }

    
     /* Registration attempt */
     $retval = $view_dbs->create_meal_category($_POST['city_id'], $_POST['res_id'], $_POST['title'], $_POST['description']);
     
     /* Registration Successful */
     if($retval){
       header('location: add_menu.php?city='.$_POST['city_id'].'&res='.$_POST['res_id'].'');
     } else {
        echo 'Cound not create City';
     }
   }

   function procAddMeal(){
      global $session, $view_dbs;

     $_POST = $session->cleanInput($_POST);
     /* Convert username to all lowercase (by option) */
     if(FIRST_UPPER){
        $_POST['meal_name'] = ucwords($_POST['meal_name']);
     }

     if(isset($_FILES['image'])){
         $allowed = array('png', 'jpg', 'jpeg');
             $extension1 = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                 if(!in_array(strtolower($extension1), $allowed)){
                      echo '{"status":"error1"}';
                         } 
                           else{
                             move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/'.$_FILES['image']['name']);    
                             $resname1 = 'uploads/'.$_FILES['image']['name'];

     /* Registration attempt */
     $retval = $view_dbs->add_meal($_POST['city_id'], $_POST['res_id'], $_POST['meal_name'], $_POST['meal_price'], $resname1, $_POST['meal_category'], $_POST['meal_description'], $_POST['meal_status']);
     
     /* Registration Successful */
     if($retval){
       header('location: meals.php?res='.$_POST['res_id'].'&city='.$_POST['city_id'].'');
     } else {
        echo 'Cound not add meal';
     }
    }
    }
   }

};

/* Initialize process */
$process = new Process;

?>
