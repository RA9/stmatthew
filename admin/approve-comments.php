<?php
    require_once("includes/functions.php");
    $title = "Admin Dashboard";
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
    $Admin= $_SESSION['user']['firstname'].' '. $_SESSION['user']['lastname'];
$Query="UPDATE comments SET status='ON', approvedby='$Admin' WHERE id='$IdFromURL' ";
$Execute=mysqli_query($conn,$Query);
if($Execute){
	$_SESSION["SuccessMessage"]="Comment Approved Successfully";
	Redirect_to("comments.php");
	}else{
	$_SESSION["ErrorMessage"]="Something Went Wrong. Try Again !";
	Redirect_to("comments.php");

	}

}

?>
