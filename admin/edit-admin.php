<?php
  require_once("includes/functions.php");
  $title = "Edit  User";
  require_once("includes/header.php");
  if(!isAdmin()) {
    $_SESSION['SuccessMessage'] = "You must log in first";
    header('location: login.php');
}


  include("includes/header.php");

  $IdFromURL= e($_GET["id"]);
  global  $conn;

if(isset($_POST['update_user'])) {
    $fname = e($_POST['firstname']);
    $lname = e($_POST['lastname']);
    $uname = e($_POST['username']);
    $email = e($_POST['email']);
    $dob = e($_POST['dob']);
    $address = e($_POST['address']);
    $occupation = e($_POST['options']);
    $roles = e($_POST['role']);
    $pwd = e($_POST['password']);
    $sdob = e($_POST['sdob']);
    $ldob = e($_POST['ldob']);
    if(count($errors) === 0) {
			$password = md5($pwd);
    $execute = queryMysql("UPDATE user SET firstname='$fname', lastname='$lname', username='$uname', email='$email', roles='$roles', dob='$dob', options='$occupation', sdob='$sdob', ldob='$ldob',password='$password', address='$address' WHERE id='$IdFromURL'");
    if($execute){
      $_SESSION["SuccessMessage"]="Admin Updated Successfully";
    	Redirect_to("user.php");
    }else{
  	$_SESSION["ErrorMessage"]="Something Went Wrong. Try Again !";
  	Redirect_to("edit-admin.php");
  	}
  }

}


$Query="SELECT * FROM user WHERE id='$IdFromURL' ";
$Execute= queryMysql($Query);
while ($rows = mysqli_fetch_array($Execute)){
  $firstname_update = $rows['firstname'];
  $lastname_update = $rows['lastname'];
  $username_update = $rows['username'];
  $email_update = $rows['email'];
  $roles = $rows['roles'];
  $dob_update = $rows["dob"];
  $address_update = $rows['address'];
  $occupation_update = $rows['options'];
  $pwd_update = $rows['password'];
  $sdob_update = $rows['sdob'];
  $ldob_update = $rows['ldob'];
}
include_once("includes/navbar.php");

?>

<!-- Page Content -->
<div class="content-wrapper">
<div class="container-fluid">
<div class="card  mx-auto mt-5">
<div class="card-header text-center">Edit User </div>
  <div class="card-body">
      <form action="edit-admin.php?id=<?php echo $IdFromURL; ?>" method="post" enctype="multipart/form-data">
          <?php
                  echo display_error();
                  echo Message();
                  echo SuccessMessage();
              ?>
           <div class="form-group">
              <div class="form-row">
              <div class="col-md-6">
              <label for="Firstname">Firstname</label>
              <input type="text" class="form-control" name="firstname" placeholder="Please enter your Firstname" value="<?php echo $firstname_update; ?>">
          </div>
          <div class="col-md-6">
              <label for="Lastname">Lastname</label>
              <input type="text" class="form-control" name="lastname" placeholder="Please enter your Lastname" value="<?php echo $lastname_update; ?>">
          </div>
      </div>
  </div>
      <div class="form-group">
                  <label for="Username">Username</label>
                  <input type="text" class="form-control" name="username" placeholder="Please enter username" value="<?php echo $username_update; ?>">
              </div>
          <div class="form-group">
                  <label for="Email">Email</label>
                  <input type="email" class="form-control" name="email" placeholder="cnah27@gmail.com" value="<?php echo $email_update; ?>">
              </div>
              <div class="form-group">
                      <label for="Address">Date of Birth</label>
                      <input type="date" class="form-control" name="dob" value="<?php echo $dob_update; ?>">
                  </div>
                  <div class="form-group">
                          <label for="Address">Address</label>
                          <input type="text" class="form-control" name="address" placeholder="Jamaica road, Monrovia" value="<?php echo $address_update; ?>">
                      </div>
                      <div class="form-group">
                              <label for="occupation">Occupation</label>
                              <select name="options" class="form-control" id="">
                                  <option value="<?php echo $occupation_update; ?>" selected><?php echo $occupation_update; ?></option>
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
                  <label for="Password">Password</label>
                  <input type="password" class="form-control" name="password" placeholder="Please Enter your Password" value="<?php echo $pwd_update; ?>">
      </div>
  </div>
          <h2 class="text-center">Educational Background</h2><br>
          <div class="form-group">
                  <label for="Address"><b> When did you enter the walls of St. Matthew United Methodist High School? </b></label>
                  <input type="date" class="form-control" name="sdob" value="<?php echo $sdob_update; ?>">
              </div>
              <div class="form-group">
                      <label for="Address"><b> When did you left the walls of St. Matthew United Methodist High School? </b></label>
                      <input type="date" class="form-control" name="ldob" value="<?php echo $ldob_update; ?>">
                  </div>
          <div class="form-group">
                  <input type="submit" class="btn btn-success btn-block" name="update_user" value="Update">
              </div>
      </form>
    </div>
</div>
</div>


<br>

<?php
require_once("includes/footer.php");
?>
