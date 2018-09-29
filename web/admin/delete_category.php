<?php
require_once("includes/functions.php");
$title = "Delete Category";
require_once("includes/header.php");
if(!isAdmin()) {
  array_push($errors, "You must log in first");
  header('location: login.php');
}

if(isset($_GET["id"])){
    $IdFromURL= $_GET["id"];
  global  $conn;
$Query="DELETE FROM category WHERE id='$IdFromURL' ";
$Execute= queryMysql($Query);
if($Execute){
	$_SESSION["SuccessMessage"]="Category Deleted Successfully";
	Redirect_to("category.php");
	}else{
	$_SESSION["ErrorMessage"]="Something Went Wrong. Try Again !";
	Redirect_to("category.php");
		
	}
    
    
}

?>