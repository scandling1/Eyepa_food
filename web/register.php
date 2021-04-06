<?php
/**
 * Register.php
 * 
 * Displays the registration form if the user needs to sign-up,
 * or lets the user know, if he's already logged in, that he
 * can't register another name.
 *
 * Written by: Jpmaster77 a.k.a. The Grandmaster of C++ (GMC)
 * Last Updated: August 2, 2009 by Ivan Novak
 */
include("../include/views_controller.php");
?>

<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>Justmeals Login Script</title>
	<link rel="stylesheet" href="-css/960/reset.css" type="text/css" />
	<link rel="stylesheet" href="-css/960/960.css" type="text/css" />
	<link rel="stylesheet" href="-css/960/text.css" type="text/css" />	
	<link rel="stylesheet" href="-css/style.css" type="text/css" />
</head>
<body>
<div id="main" class="container_12">
<?php
/**
 * The user is already logged in, not allowed to register.
 */
if($session->logged_in){
   echo "<h1>Registered</h1>";
   echo "<p>We're sorry <b>$session->username</b>, but you've already registered. "
       ."<a href=\"main.php\">Main</a>.</p>";
}
/**
 * The user has submitted the registration form and the
 * results have been processed.
 */
else if(isset($_SESSION['regsuccess'])){
   /* Registration was successful */
   if($_SESSION['regsuccess']){
      echo "<h1>Registered!</h1>";
      if(EMAIL_WELCOME){
         echo "<p>Thankyou <b>".$_SESSION['reguname']."</b>, you have been sent a confirmation email which should be arriving shortly.  Please confirm your registration before you continue.<br />Back to <a href='main.php'>Main</a></p>";
      }else{
      echo "<p>Thank you <b>".$_SESSION['reguname']."</b>, your information has been added to the database, "
          ."you may now <a href=\"main.php\">log in</a>.</p>";
      }
   }
   /* Registration failed */
   else{
      echo "<h1>Registration Failed</h1>";
      echo "<p>We're sorry, but an error has occurred and your registration for the username <b>".$_SESSION['reguname']."</b>, "
          ."could not be completed.<br>Please try again at a later time.</p>";
   }
   unset($_SESSION['regsuccess']);
   unset($_SESSION['reguname']);
}
/**
 * The user has not filled out the registration form yet.
 * Below is the page with the sign-up form, the names
 * of the input fields are important and should not
 * be changed.
 */
else{
?>

<h1>Register</h1>
<?php
if($form->num_errors > 0){
   echo "<td><font size=\"2\" color=\"#ff0000\">".$form->num_errors." error(s) found</font></td>";
}
?>
<div id="register">
	<form action="process.php" method="POST" enctype="multipart/form-data">
		<p class="textinput">Name: </p><p><input type="text" name="name" maxlength="30" value="<?php echo $form->value("name"); ?>"><?php echo $form->error("name"); ?></p>
		<p class="textinput">Username: </p><p><input type="text" name="user" maxlength="30" value="<?php echo $form->value("user"); ?>"><?php echo $form->error("user"); ?></p>
		<p class="textinput">Password: </p><p><input type="password" name="pass" maxlength="30" value="<?php echo $form->value("pass"); ?>"><?php echo $form->error("pass"); ?></p>
      <p class="textinput">Email: </p><p><input type="text" name="email" maxlength="50" value="<?php echo $form->value("email"); ?>"><?php echo $form->error("email"); ?></p>
      <p class="textinput">Phone Number: </p><p><input type="number" name="phone" maxlength="50" value="<?php echo $form->value("phone"); ?>"><?php echo $form->error("phone"); ?></p>
      <?php
      echo'
     <p> <label for="frist_name">Select Admin</label>
      <select class="form-control selectric" name="city_id" value="" required="">
        <option></option>';
          if ($results = $view_dbs->get_cities()){
           foreach ($results as $row) {
             $city_name = $row['city_name'];
             $city_id = $row['id'];

             echo '<option value="'.$city_id.'">'.$city_name.'</option>';
            }
          }
     echo'
      </select> </p>';
      ?>
      <p><label for="frist_name">Restaurant Picture</label>
           <input type="file" name="res_picture" id="image-upload" required="">
      </p>
      <p> <label for="frist_name">Select Admin</label>
      <select class="form-control selectric" name="user_level" value="" required="">
        <option value="7">County Admin</option>
        <option value="6">City Admin</option>
        <option value="5">Restaurant Admin</option>
        <option value="3">Driver</option>
        </select> 
      </p> 
		<p class="textinput"><input type="hidden" name="subjoin" value="1"><input type="submit" value="Join!"></p>
		<p><a href="main.php">[Back to Main]</a></p>
	</form>
</div>
<?php
}
?>
</div>
</body>
</html>
