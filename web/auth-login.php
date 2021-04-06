<?php
  include('../include/views_controller.php');

  if(!$session->logged_in){
?>

<!DOCTYPE html>
<html lang="en">


<!-- auth-login.html  21 Nov 2019 03:49:32 GMT -->
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <?php $view_head->title('login');?>
  <!-- General CSS Files -->
  <?php $view_head->meta_head();?>
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
							window.location.href = "auth-login.php";
						} else {
							alert("Invalid Hash");
						}
					}
				});
			}
		});
	</script>
</head>
<?PHP

?>
<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <?php $view_body->login();?>
        </div>
      </div>
    </section>
  </div>
  <!-- General JS Scripts -->
  <script src="assets/js/app.min.js"></script>
  <!-- JS Libraies -->
  <!-- Page Specific JS File -->
  <!-- Template JS File -->
  <script src="assets/js/scripts.js"></script>
  <!-- Custom JS File -->
  <script src="assets/js/custom.js"></script>
</body>
<!-- auth-login.html  21 Nov 2019 03:49:32 GMT -->
</html>
<?PHP
  } else{
	  header('location: index.php');
  }
?>