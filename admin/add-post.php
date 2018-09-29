<?php
    require_once("includes/functions.php");
    $title = "Add New Post";
    require_once("includes/header.php");

    if(!isAdmin()) {
		array_push($errors,"You must log in first");
		header('location: login.php');
    }
    include_once("includes/navbar.php");
?>
 <!-- Page Content -->
 <div class="content-wrapper">
 <div class="container">
      <div class="card  mx-auto mt-5">
        <div class="card-header text-center">Add New Post</div>
        <div class="card-body">
			<?php
				 echo display_error(); 
				 echo Message();
				echo SuccessMessage();
			 ?>
            <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
	<label for="title"><span class="FieldInfo">Title:</span></label>
	<input class="form-control" type="text" name="Title" id="title" placeholder="Title">
	</div>
	<div class="form-group">
	<label for="categoryselect"><span class="FieldInfo">Category:</span></label>
	<select class="form-control" id="categoryselect" name="Category" >
	<?php
global $conn;
$ViewQuery="SELECT * FROM category ORDER BY id desc";
$Execute=mysqli_query($conn,$ViewQuery);
while($DataRows=mysqli_fetch_array($Execute)){
	$Id= $DataRows["id"];
	$CategoryName= $DataRows["name"];
?>	
	<option><?php echo $CategoryName; ?></option>
	<?php } ?>
			
	</select>
	</div>
	<div class="form-group">
	<label for="imageselect"><span class="FieldInfo">Select Image:</span></label>
	<input type="file" class="form-control" name="Image" id="imageselect">
	</div>
	<div class="form-group">
	<label for="postarea"><span class="FieldInfo">Post:</span></label>
	<textarea  class="editor form-control" name="Post" id="postarea" ></textarea>
	<br>
<input class="btn btn-success btn-block" type="submit" name="Add" value="Add New Post">
</form>
</div>



	</div> <!-- Ending of Main Area-->
	
</div> <!-- Ending of Row-->
	
</div> <!-- Ending of Container-->
<br>
<?php 
      require_once("includes/footer.php");
?>
