<?php
    ob_start();
    session_start();
    require_once("db.php");

    // variable declaration
	$fullame  = "";
	$username = "";
	$email    = "";
	$dob 	  = "";
	$address  = "";
	$option   = "";
	$errors   = array();

    // call the register() function if register_btn is clicked
	if (isset($_POST['signup_btn'])) {
		register();
	}

	 // call the AddNewPost() function if the Submit btn is clicked
	 if (isset($_POST['Add'])) {
		AddNewPost();
	}

	// call the AddCategory() function if the Submit btn is clicked
	if (isset($_POST['add_category'])) {
		AddCategory();
	}



	// call the login() function if register_btn is clicked
	if (isset($_POST['login_btn'])) {
		login();
	}

    function register(){
		global $conn, $errors;

		// receive all input values from the form
		$firstname    =  e($_POST['firstname']);
		$lastname    =  e($_POST['lastname']);
		$username    =  e($_POST['username']);
		$email       =  e($_POST['email']);
		$dob         =  e($_POST['dob']);
		$role		 =  e($_POST['role']);
		$address     =  e($_POST['address']);
		$option      =  e($_POST['options']);
		$password_1  =  e($_POST['password_1']);
		$password_2  =  e($_POST['password_2']);
		$sdob    	 =  e($_POST['sdob']);
		$ldob        =  e($_POST['ldob']);
		date_default_timezone_set("Africa/Monrovia");
		$CurrentTime=time();
//$DateTime=strftime("%Y-%m-%d %H:%M:%S",$CurrentTime);
$DateTime=strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);
$DateTime;


		// form validation: ensure that the form is correctly filled
		 if (empty($firstname)) {
			array_push($errors, "Fullname is required");
		}
		if (empty($lastname)) {
			array_push($errors, "Lastname is required");
		}
		if (empty($username)) {
			array_push($errors, "Username is required");
		}
		if (empty($email)) {
			array_push($errors, "Email is required");
		}
		if (empty($dob)) {
			array_push($errors, "Date Of Birth is required");
		}
		if (empty($address)) {
			array_push($errors, "Address is required");
		}
		if (empty($option)) {
			array_push($errors, "Email is required");
		}
		if (empty($password_1)) {
			array_push($errors, "Password is required");
		}
		if ($password_1 != $password_2) {
			array_push($errors, "The two passwords do not match");
		}
		if (empty($sdob)) {
			array_push($errors, "Start Date is required");
		}
		if (empty($ldob)) {
			array_push($errors, "Last Date is required");
		}
			 // Ensure that no user is registered twice.
		// the fullname, email and usernames should be unique
		$query= mysqli_query($conn,"SELECT * FROM user WHERE firstname='$firstname' OR lastname='$lastname' OR username='$username'
								OR email='$email' LIMIT 1");


		$user = mysqli_fetch_assoc($query);

		if ($user) { // if user exists
		 if ($user['fullname'] === $firstname) {
			  array_push($errors, "Firstname already exists");
			}
			if ($user['username'] === $username) {
			  array_push($errors, "Username already exists");
			}
			if ($user['email'] === $email) {
			  array_push($errors, "Email already exists");
			}
		}


		//register user if there are no errors in the form
		if (count($errors) === 0) {
			$password = md5($password_1);//encrypt the password before saving in the database

			// if (isset($_POST['username'])) {
			// 	$user_type = e($_POST['role']);
			// 	$query = "INSERT INTO user ('firstname','lastname','username','email','roles',' dob','options','sdob','ldob','password','address') VALUES('$firstname','$lastname','$username','$email','$role',' $dob','$option','$sdob','$ldob','$password','$address')";
			// $result =	mysqli_query($conn, $query);
			// 	$_SESSION['success']  = "New user successfully created!!";
			// 	header('location: home.php');
			// }else{
				$query = "INSERT INTO user (firstname,lastname,username,email,roles,dob,options,sdob,ldob,password,address) VALUES ('$firstname','$lastname','$username','$email','$role',' $dob','$option','$sdob','$ldob','$password','$address')";
					$result = mysqli_query($conn, $query);

				// // get id of the created user
				$logged_in_user_id = mysqli_insert_id($result);

				$_SESSION['user'] = getUserById($logged_in_user_id); // put logged in user in session
				$_SESSION['success']  = "You are now logged in";
				header('location: index.php');
			}

		}


	// escape string
	function e($val){
		global $conn;
		return sanitizeString($val);
	}

	function sanitizeString($var)
		{
		global $conn;
		$var = strip_tags($var);
		$var = htmlentities($var);
		$var = stripslashes($var);
		return $conn->real_escape_string($var);
		}

	// LOGIN USER
	function login(){
		global $conn, $username, $errors;

		// grap form values
		$username = e($_POST['username']);
		$password = e($_POST['password']);

		// make sure form is filled properly
		if (empty($username)) {
			array_push($errors, "Username is required");
		}
		if (empty($password)) {
			array_push($errors, "Password is required");
		}

		// attempt login if no errors on form
		if (count($errors) == 0) {
			$password = md5($password);

			$query = "SELECT * FROM user WHERE username='$username' AND password='$password' LIMIT 1";;
			$results = mysqli_query($conn, $query);

			$rows = mysqli_num_rows($results);
			 if($rows) { // user found
				// check if user is admin or user
				$logged_in_user = mysqli_fetch_assoc($results);
				if ($logged_in_user['roles'] === 'Admin') {

					$_SESSION['user'] = $logged_in_user;
					$_SESSION['SuccessMessage']  = "You are now logged in";
					Redirect_to('dashboard.php');
				}else{
			 	$_SESSION['user'] = $logged_in_user;
					$_SESSION['SuccessMessage']  = "You are now logged in";
					Redirect_to('index.php');
					}
				}else{
				array_push($errors, "Wrong username/password combination");
			}
		}
	}
	// Add New Category
	function AddCategory(){
			$Category = e($_POST["Category"]);
			date_default_timezone_set("Africa/Monrovia");
			$CurrentTime=time();
			//$DateTime=strftime("%Y-%m-%d %H:%M:%S",$CurrentTime);
			$DateTime=strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);
			$DateTime;
			$Admin = $_SESSION['user']['firstname'].' '. $_SESSION['user']['lastname'];
			if(empty($Category)){
			$_SESSION["ErrorMessage"]="All Fields must be filled out";
			Redirect_to("category.php");
			}
		if(strlen($Category)>99){
		$_SESSION["ErrorMessage"] ="Too long Name for Category";
		Redirect_to("category.php");
		}
		// attempt login if no errors on form
		if (count($errors) == 0) {
		global $conn;
		$Query="INSERT INTO category(datetime,name,creatorname) VALUES('$DateTime','$Category','$Admin')";
		$Execute = queryMysql($Query);
		if($Execute){
		$_SESSION["SuccessMessage"] = "Category Added Successfully";
		Redirect_to("category.php");
		}else{
		$_SESSION["ErrorMessage"]="Category failed to Add";
		Redirect_to("category.php");

		}

	}

	}

	//Adding New Post function
	function AddNewPost(){

		global $conn,$errors;
		$Title    =   e($_POST["Title"]);
		$Category =   e($_POST["Category"]);
		$Post     =   e($_POST["Post"]);
		date_default_timezone_set("Africa/Monrovia");
		$CurrentTime=time();
		//$DateTime=strftime("%Y-%m-%d %H:%M:%S",$CurrentTime);
		$DateTime=strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);
		$DateTime;
		$Admin= $_SESSION['user']['firstname'].' '. $_SESSION['user']['lastname'];
		$Image=$_FILES["Image"]["name"];
		$Target="upload/".basename($_FILES["Image"]["name"]);
		if(empty($Title)){
			$_SESSION["ErrorMessage"]="Title can't be empty";
			Redirect_to("add-post.php");

		}
		if(strlen($Title)<2){
			$_SESSION["ErrorMessage"]="Title Should be at-least 2 Characters";
			Redirect_to("add-post.php");

		}
		// attempt login if no errors on form
		if (count($errors) == 0) {
			global $conn;
			$Query="INSERT INTO admin_panel(datetime,title,category,author,image,post)
			VALUES('$DateTime','$Title','$Category','$Admin','$Image','$Post')";
			$Execute=queryMysql($Query);
			 move_uploaded_file($_FILES["Image"]["tmp_name"],$Target);
			if($Execute){
			$_SESSION["SuccessMessage"]="Post Added Successfully";
			Redirect_to("dashboard.php");
			}else{
			$_SESSION["ErrorMessage"]="Something Went Wrong. Try Again !";
			Redirect_to("add-post.php");

			}
		}

	}



	function isLoggedIn()
	{
		if (isset($_SESSION['user'])) {
			return true;
		}else{
			return false;
		}
	}

	function isAdmin()
	{
		if (isset($_SESSION['user']) && $_SESSION['user']['roles'] === 'Admin' ) {
			return true;
		}else{
			return false;
		}
	}


	// return user array from their id
	function getUserById($id){
		global $conn;
		$query = "SELECT * FROM user WHERE id=" . $id;
		$result = queryMysql($query);

		$user = mysqli_fetch_assoc($result);
		return $user;
	}

	function createTable($name, $query)
		{
		queryMysql("CREATE TABLE IF NOT EXISTS $name($query)");
		echo "Table '$name' created or already exists.<br>";
		}


	function queryMysql($query)
		{
		global $conn;
		$result = $conn->query($query);
		if (!$result) die($conn->error);
		return $result;
		}


	function display_error() {
		global $errors;

		if (count($errors) > 0){
			echo '<div class="error">';
				foreach ($errors as $error){
					echo $error .'<br>';
				}
			echo '</div>';
		}
	}

	//redirect user to a specific location
	 function Redirect_to($New_Location){
    header("Location:".$New_Location);
	exit;
}

function Message(){
    if(isset($_SESSION["ErrorMessage"])){
       $Output="<div class=\"alert alert-danger\">" ;
       $Output.=htmlentities($_SESSION["ErrorMessage"]);
       $Output.="</div>";
       $_SESSION["ErrorMessage"]=null;
       return $Output;


    }
}

function SuccessMessage(){
    if(isset($_SESSION["SuccessMessage"])){
       $Output="<div class=\"alert alert-success\">" ;
       $Output.=htmlentities($_SESSION["SuccessMessage"]);
       $Output.="</div>";
       $_SESSION["SuccessMessage"]=null;
       return $Output;


    }
}


?>
