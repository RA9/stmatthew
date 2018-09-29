<?php
  require_once("includes/functions.php");
  $title = "Delete User";
  require_once("includes/header.php");
  if(!isAdmin()) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}




if(isset($_GET["id"])){
    $IdFromURL=$_GET["id"];
  global  $conn;
$Query="DELETE FROM user WHERE id='$IdFromURL' ";
$Execute= queryMysql($Query);
if($Execute){
	$_SESSION["SuccessMessage"]="Admin Deleted Successfully";
	Redirect_to("user.php");
	}else{
	$_SESSION["ErrorMessage"]="Something Went Wrong. Try Again !";
	Redirect_to("user.php");
		
	}
    
    
    
    
    
}

?>