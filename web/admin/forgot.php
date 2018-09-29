<?php 
   require_once("includes/functions.php");
  $title = "St Matthew Alumina Association";
  require_once("includes/header.php");

?>
      <!-- Page Content -->
      <div class="container">
      <div class="container">
      <div class="card card-login mx-auto mt-5">
        <div class="card-header text-center">Forgot Your Password?</div>
        <div class="card-body">
            <form action="" method="post">
            <?php
				 echo display_error(); 
				 echo Message();
				echo SuccessMessage();
			 ?>
                <p class="card-text text-center">Hi there, please fill in the below form with your email address to create your new Password.</p><br>
                <div class="form-group">
                    <label for="Email">Enter your Email</label>
                    <input type="email" class="form-control">
                </div>
                <div class="form-group">
                        <input type="submit" class="btn btn-success btn-block" value="Forgot Password">
                    </div>
            </form>
          </div>
         <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
</body>

</html>
