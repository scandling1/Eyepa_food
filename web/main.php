<?php
/**
 * Main.php
 *
 * This is an example of the main page of a website. Here
 * users will be able to login. However, like on most sites
 * the login form doesn't just have to be on the main page,
 * but re-appear on subsequent pages, depending on whether
 * the user has logged in or not.
 *
 * Written by: Jpmaster77 a.k.a. The Grandmaster of C++ (GMC)
 * Last Updated: June 15, 2011 by Ivan Novak
 */
include("../include/session.php");
$page = "main.php";
?>

<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>Justmeals Login </title>
	<link rel="stylesheet" href="-css/960/reset.css" type="text/css" />
	<link rel="stylesheet" href="-css/960/960.css" type="text/css" />
	<link rel="stylesheet" href="-css/960/text.css" type="text/css" />	
	<link rel="stylesheet" href="-css/style.css" type="text/css" />
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
	<script type="text/javascript">
		jQuery(function($){
			<?php
			if(isset($_GET['hash'])){
				$hash = $_GET['hash'];
			} else {
				$hash = '';
			}
			?>
			jp_hash = ('<?php echo $hash; ?>'.length)?'<?php echo $hash; ?>':window.location.hash;
			if(jp_hash){
				$.ajax({
					type: "POST",
					url: 'process.php',
					data: 'login_with_hash=1&hash='+jp_hash,
					success: function(msg){
						if(msg){
							alert(msg);
							window.location.href = "main.php";
						} else {
							alert("Invalid Hash");
						}
					}
				});
			}
		});
	</script>
</head>
<body>

<div id="main" class="container_12">


<?php
/**
 * User has already logged in, so display relavent links, including
 * a link to the admin center if the user is an administrator.
 */
if($session->logged_in){
	if(MAIL){
		$q = "SELECT mail_id FROM ".TBL_MAIL." WHERE UserTo = '$session->username' and status = 'unread'";
		$numUnreadMail = $database->query($q) or die('error');
		$numUnreadMail = mysqli_num_rows($numUnreadMail);

		echo "<div class='grid_5'><p class='right'>[<a href=\"mail.php\">You have $numUnreadMail Unread Mail</a>]&nbsp;</p></div>";
	}
	?>
		<h1 class="clear">Logged In</h1>
		<p>Welcome <b><?php echo $session->username; ?></b>, you are logged in.</p>
		<p>[<a href="userinfo.php?user=<?php echo $session->username; ?>">My Account</a>]&nbsp;[<a href="useredit.php">Edit Account</a>]
	<?php
   if($session->isAdmin()){
      echo "[<a href=\"admin/admin.php\">Admin Center</a>]&nbsp;";
   }
   echo "[<a href=\"process.php\">Logout</a>]";?></p><?php
}
else{
?>

<div id="login">
<h1>Login</h1>
<?php
/**
 * User not logged in, display the login form.
 * If user has already tried to login, but errors were
 * found, display the total number of errors.
 * If errors occurred, they will be displayed.
 */
if($form->num_errors > 0){
   echo "<font size=\"2\" color=\"#ff0000\">".$form->num_errors." error(s) found</font>";
}
?>

	<form action="process.php" method="POST">
		<p class="textinput">Username: </p><p><input type="text" name="user" maxlength="30" value="<?php echo $form->value("user"); ?>"><?php echo $form->error("user"); ?></p>
		<p class="textinput">Password: </p><p><input type="password" name="pass" maxlength="30" value="<?php echo $form->value("pass"); ?>"><?php echo $form->error("pass"); ?></p>
		<p>
			<input type="checkbox" name="remember" <?php if($form->value("remember") != ""){ echo "checked"; } ?>>Remember me next time
			<input type="hidden" name="sublogin" value="1">
			<input type="submit" value="Login">
		</p>
		<p><br />[<a href="forgotpass.php">Forgot Password?</a>]</p>
		<p>Not registered? <a href="register.php">Sign-Up!</a></p>
		<?php
		if(EMAIL_WELCOME){
			echo "<p>Do you need a Confirmation email? <a href='valid.php'>Send!</a></p>";
		}
		?>
	</form>
</div><!-- #login -->
<?php
}

/**
 * Just a little page footer, tells how many registered members
 * there are, how many users currently logged in and viewing site,
 * and how many guests viewing site. Active users are displayed,
 * with link to their user information.
 */
?>
<div id="footer"><br />
	<p><b>Member Total:</b><?php echo $database->getNumMembers(); ?>
	<br>There are <?php echo $database->num_active_users; ?> registered members and <?php $database->num_active_guests; ?> guests viewing the site.<br><br>
	<?php
	include("../include/view_active.php");
	?>
	</p>
</div><!-- #footer -->

</div><!-- #main -->


</body>
</html>
