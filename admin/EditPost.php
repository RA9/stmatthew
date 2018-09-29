<?php
    require_once("includes/functions.php");
    $title = "Edit Post/Admin Dashboard";
    require_once("includes/header.php");

    if(!isAdmin()) {
		$_SESSION['ErrorMessage'] = "You must log in first";
		header('location: login.php');
    }

    include_once("includes/navbar.php");
?>
<?php
if(isset($_POST["Submit"])){
$Title= e($_POST["Title"]);
$Category= e($_POST["Category"]);
$Post= e($_POST["Post"]);
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
	Redirect_to("EditPost.php");
}elseif(strlen($Title)<2){
	$_SESSION["ErrorMessage"]="Title Should be at-least 2 Characters";
	Redirect_to("EditPost.php");

}else{
	global $conn;
	$EditFromURL=$_GET['Edit'];
	$Query="UPDATE admin_panel SET datetime='$DateTime', title='$Title', category='$Category', author='$Admin',image='$Image',post='$Post'	WHERE id='$EditFromURL'";

	$Execute=mysqli_query($conn,$Query);
	move_uploaded_file($_FILES["Image"]["tmp_name"],$Target);
	if($Execute){
	$_SESSION["SuccessMessage"]="Post Updated Successfully";
	Redirect_to("dashboard.php");
	}else{
	$_SESSION["ErrorMessage"]="Something Went Wrong. Try Again !";
	Redirect_to("dashboard.php");

	}

}

}

?>
<div class="content-wrapper">
<div class="container-fluid">
<div class="row">

	<div class="col-sm-12">
	<h1>Update Post</h1>
    <?php
          echo Message();
	      echo SuccessMessage();
	?>
	<?php
	$SerachQueryParameter=$_GET['Edit'];
	$conn;
	$Query="SELECT * FROM admin_panel WHERE id='$SerachQueryParameter'";
	$ExecuteQuery=mysqli_query($conn,$Query);
	while($DataRows=mysqli_fetch_array($ExecuteQuery)){
		$TitleToBeUpdated=$DataRows['title'];
		$CategoryToBeUpdated=$DataRows['category'];
		$ImageToBeUpdated=$DataRows['image'];
		$PostToBeUpdated=$DataRows['post'];

	}


	?>
<form action="EditPost.php?Edit=<?php echo $SerachQueryParameter; ?>" method="post" enctype="multipart/form-data">
	<fieldset>
	<div class="form-group">
	<label for="title"><span class="FieldInfo">Title:</span></label>
	<input value="<?php echo $TitleToBeUpdated; ?>" class="form-control" type="text" name="Title" id="title" placeholder="Title">
	</div>
	<div class="form-group">
	<span class="FieldInfo"> Existing Category: </span>
	<?php echo $CategoryToBeUpdated;?>
	<br>
	<label for="categoryselect"><span class="FieldInfo">Category:</span></label>
	<select class="form-control" id="categoryselect" name="Category" >
	<?php
global $conn;
$ViewQuery="SELECT * FROM category ORDER BY datetime desc";
$Execute=mysqli_query($conn,$ViewQuery);
while($DataRows=mysqli_fetch_array($Execute)){
	$Id=$DataRows["id"];
	$CategoryName=$DataRows["name"];
?>
	<option><?php echo $CategoryName; ?></option>
	<?php } ?>

	</select>
	</div>
	<div class="form-group">
		<span class="FieldInfo"> Existing Image: </span>
	<img src="upload/<?php echo $ImageToBeUpdated;?>" width="170px" height="70px">
	<br>
	<label for="imageselect"><span class="FieldInfo">Select Image:</span></label>
	<input type="file" class="form-control" name="Image" id="imageselect">
	</div>
	<div class="form-group">
	<label for="postarea"><span class="FieldInfo">Post:</span></label>
	<textarea  class="editor form-control" id="editor" name="Post">
		<?php echo $PostToBeUpdated; ?>
	</textarea>
	<br>
<input  type="submit"  class="btn btn-success btn-block" name="Submit" value="Update Post">
	</fieldset>
	<br>
</form>
</div>



	</div> <!-- Ending of Main Area-->

</div> <!-- Ending of Row-->

</div> <!-- Ending of Container-->


<?php
 require_once("includes/footer.php");
?>
