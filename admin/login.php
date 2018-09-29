<?php
    require_once("includes/functions.php");
    $title = "Login to St. Matthew Alumina Assocation";
    require_once("includes/header.php");
?>

      <!-- Page Content -->
      <div class="container">
      <div class="card card-login mx-auto mt-5">
        <div class="card-header text-center">Login to ASMUMHSA</div>
        <div class="card-body">
        <?php
				 echo display_error(); 
				 echo Message();
				echo SuccessMessage();
			 ?>
            <form action="" method="post">
            <div class="form-group">
                    <label for="Username">Username</label>
                    <input type="text" class="form-control" name="username">
                </div>
                <div class="form-group">
                        <label for="Password">Password</label>
                        <input type="password" class="form-control" name="password">
                </div>
                <div class="form-group">
                        <input type="submit" class="btn btn-success btn-block"  name="login_btn" value="Login">
                    </div>
            </form>
            <div class="text-center">
                <a class="d-block small mt-3" href="forgot.php">Forgot Password?</a>
        </div>
          </div>
          </div>
    </div>

    <br>

      <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
</body>

</html>
