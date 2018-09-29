<?php
  require_once("includes/functions.php");
  $title = "Category";
  require_once("includes/header.php");
  if(!isAdmin()) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}


//include_once("includes/navbar.php");

?>
<?php
if(isset($_GET["id"])){
    $IdFromURL=$_GET["id"];
    $conn;
$Query="DELETE FROM comments WHERE id='$IdFromURL' ";
$Execute= queryMysql($Query);
if($Execute){
	$_SESSION["SuccessMessage"]="Comment Deleted Successfully";
	Redirect_to("comments.php");
	}else{
	$_SESSION["ErrorMessage"]="Something Went Wrong. Try Again !";
	Redirect_to("comments.php");

	}



}

?>
