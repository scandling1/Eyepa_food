<?php 
 
class Mailer
{
   /**
    * sendWelcome - Sends a welcome message to the newly
    * registered user, also supplying the username and
    * password.
    */
   function sendWelcome($user, $email, $pass, $userid){
      $from = "From: ".EMAIL_FROM_NAME." <".EMAIL_FROM_ADDR.">";
      $subject = "JustMeals GH - Welcome!";
      $body = $user.",\n\n"
             ."Welcome! You've just registered at JustMeals GH "
             ."with the following information:\n\n"
             ."Username: ".$user."\n"
             ."Password: ".$pass."\n\n"
             ."Before you can login you need to activate your\n"
             ."account by clicking on this link:\n\n"
             .BASEURL."valid.php?qs1=".$user."&qs2=".$userid."\n\n"
             ."If you ever lose or forget your password, a new "
             ."password will be generated for you and sent to this "
             ."email address, if you would like to change your "
             ."email address you can do so by going to the "
             ."My Account page after signing in.\n\n"
             ."- JustMeals GH -- Created by StagesHub";

      return mail($email,$subject,$body,$from);
   }
   
   /**
    * sendConfirmation - Sends a confirmation to users
    * who click a "Send confirmation" button.  This
    * only needs to be used if the EMAIL_WELCOME constant
    * is changed to true and the user's 'valid' field is 0
    */
   function sendConfirmation($user, $userid, $email){
       $from = "From: ".EMAIL_FROM_NAME." <".EMAIL_FROM_ADDR.">";
       $subject = "JustMeals GH - Welcome!";
       $body = $user.",\n\n"
               ."We're sorry for the inconvenience.  We are making\n"
               ."our website more secure for both your and our \n"
               ."benefit.\n\n"
               ."To activate your account you can either click on the\n"
               ."following link or copy the link and paste it into your\n"
               ."address bar.\n\n"
               .BASEURL."valid.php?qs1=".$user."&qs2=".$userid."\n\n"
               ."We here at JustMeals GH hope you continue to\n"
               ."enjoy our wonderful service.\n\n"
               ."Sincerely,\n\n"
               ."- JustMeals GH -- Created by StagesHub";
               
      return mail($email,$subject,$body,$from);
   }
   
   
   /**
    * sendNewPass - Sends the newly generated password
    * to the user's email address that was specified at
    * sign-up.
    */
   function sendNewPass($user, $email, $pass){
      $from = "From: ".EMAIL_FROM_NAME." <".EMAIL_FROM_ADDR.">";
      $subject = "JustMeals GH - Your new password";
      $body = $user.",\n\n"
             ."We've generated a new password for you at your "
             ."request, you can use this new password with your "
             ."username to log in to Jpmaster77's Site.\n\n"
             ."Username: ".$user."\n"
             ."New Password: ".$pass."\n\n"
             ."It is recommended that you change your password "
             ."to something that is easier to remember, which "
             ."can be done by going to the My Account page "
             ."after signing in.\n\n"
             ."- JustMeals GH -- Created by StagesHub";
             
      return mail($email,$subject,$body,$from);
   }
};

/* Initialize mailer object */
$mailer = new Mailer;
 
?>
