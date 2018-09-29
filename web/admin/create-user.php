<?php
  require_once("includes/functions.php");
  $title = "Create User";
  require_once("includes/header.php");
  if(!isAdmin()) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}


include_once("includes/navbar.php");

?>
      <!-- Page Content -->
 <div class="content-wrapper">
    <div class="container-fluid">
    <div class="card  mx-auto mt-5">
     <div class="card-header text-center">Signup to ASMUMHSA </div>
        <div class="card-body">
            <form action="" method="post">
                <?php
                        echo display_error();
                        echo Message();
                        echo SuccessMessage();
                    ?>
                 <div class="form-group">
                    <div class="form-row">
                    <div class="col-md-6">
                    <label for="Firstname">Firstname</label>
                    <input type="text" class="form-control" name="firstname" placeholder="Please enter your Firstname">
                </div>
                <div class="col-md-6">
                    <label for="Lastname">Lastname</label>
                    <input type="text" class="form-control" name="lastname" placeholder="Please enter your Lastname">
                </div>
            </div>
        </div>
            <div class="form-group">
                        <label for="Username">Username</label>
                        <input type="text" class="form-control" name="username" placeholder="Please enter username">
                    </div>
                <div class="form-group">
                        <label for="Email">Email</label>
                        <input type="email" class="form-control" name="email" placeholder="cnah27@gmail.com">
                    </div>
                    <div class="form-group">
                            <label for="DOB">Date of Birth</label>
                            <input type="date" class="form-control" name="dob" placeholder="09/10/1998">
                        </div>
                        <div class="form-group">
                                <label for="Address">Address</label>
                                <input type="text" class="form-control" name="address" placeholder="Jamaica road, Monrovia">
                            </div>
                            <div class="form-group">
                                    <label for="occupation">Occupation</label>
                                    <select name="options" class="form-control" id="">
                                        <option value="" selected>Nothhing</option>
                                        <option value="Student/ studying">Student/ studying</option>
                                        <option value="Working">Working</option>
                                        <option value="Not Employed">Not Employed</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="role">User Role</label>
                                    <select name="role" class="form-control" id="">
                                        <option value="Member" selected>Member</ption>
                                        <option value="Admin">Admin</option>
                                    </select>
                                </div>
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-6">
                        <label for="Password">Password</label>
                        <input type="password" class="form-control" name="password_1" placeholder="Please Enter your Password">
                </div>
                <div class="col-md-6">
                        <label for="Password">Confirm Password</label>
                        <input type="password" class="form-control" name="password_2" placeholder="Confirm your Password">
                </div>
            </div>
        </div>
                <h2 class="text-center">Educational Background</h2><br>
                <div class="form-group">
                        <label for="Address"><b> When did you enter the walls of St. Matthew United Methodist High School? </b></label>
                        <input type="date" class="form-control" name="sdob">
                    </div>
                    <div class="form-group">
                            <label for="Address"><b> When did you left the walls of St. Matthew United Methodist High School? </b></label>
                            <input type="date" class="form-control" name="ldob">
                        </div>
                <div class="form-group">
                        <input type="submit" class="btn btn-success btn-block" name="signup_btn" value="Signup">
                    </div>
            </form>
          </div>
    </div>
</div>


 <br>

<?php
 require_once("includes/footer.php");
?>
