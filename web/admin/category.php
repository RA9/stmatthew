<?php
  require_once("includes/functions.php");
  $title = "Category";
  require_once("includes/header.php");
  if(!isAdmin()) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}


include_once("includes/navbar.php");

?>
<br>

<div class="content-wrapper">
    <div class="container-fluid">
        <div class="card  mx-auto mt-5">
            <div class="card-header text-center">Manage Categories</div>
            <div class="card-body">
        <form action="" method="post">
        <?php
				 echo display_error();
				 echo Message();
				echo SuccessMessage();
			 ?>
	<div class="form-group">
	<label for="categoryname"><span class="FieldInfo">Name:</span></label>
	<input class="form-control" type="text" name="Category" id="categoryname" placeholder="Name">
	</div>
	<br>
<input type="submit" name="add_category" class="btn btn-success btn-block" value="Add New Category">
<br>
</form>
</div>
</div> <br>
<div class="table-responsive">
	<table class="table table-striped table-hover">
	<tr>
		<th>Sr No.</th>
		<th>Date &amp; Time</th>
		<th>Category Name</th>
		<th>Creator Name</th>
		<th>Action</th>

	</tr>
<?php
global $conn;
$ViewQuery="SELECT * FROM category ORDER BY id desc";
$Execute=mysqli_query($conn,$ViewQuery);
$SrNo=0;
while($DataRows=mysqli_fetch_array($Execute)){
	$Id=$DataRows["id"];
	$DateTime=$DataRows["datetime"];
	$CategoryName=$DataRows["name"];
	$CreatorName=$DataRows["creatorname"];
	$SrNo++;






?>
<tr>
	<td><?php echo $SrNo; ?></td>
	<td><?php echo $DateTime; ?></td>
	<td><?php echo $CategoryName; ?></td>
	<td><?php echo $CreatorName; ?></td>
	<td><a href="delete_category.php?id=<?php echo $Id;?>">
	<span class="btn btn-danger">Delete</span>
	</a></td>

</tr>

	<?php } ?>
	</table>
</div> <br> <br>
	</div> <!-- Ending of Main Area-->
</div>
</div> <!-- Ending of Row-->
</div> <!-- Ending of Container-->
<!-- Footer -->
<?php include("includes/footer.php");?>
