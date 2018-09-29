<?php
    require_once("includes/functions.php");
    $title = "Admin Dashboard";
    require_once("includes/header.php");

    if(!isAdmin()) {
		$_SESSION['ErrorMessage'] = "You must log in first";
		header('location: login.php');
    }

    include_once("includes/navbar.php");
?>

  <div class="content-wrapper">
    <div class="container-fluid">
	<!-- Breadcrumbs-->
	<ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">My Dashboard</li>
      </ol>
	  <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Manage Post</div>
        <div class="card-body">
          <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
		<tr>
			<th>No</th>
			<th>Post Title</th>
			<th>Date &amp; Time</th>
			<th>Author</th>
			<th>Category</th>
			<th>Banner</th>
			<th>Comments</th>
			<th>Action</th>
			<th>Details</th>

		</tr>
	</thead>
		<?php
				 echo display_error();
				 echo Message();
				echo SuccessMessage();
			 ?>
<?php
 $conn;
$ViewQuery="SELECT * FROM admin_panel ORDER BY id desc;";
$Execute=mysqli_query($conn,$ViewQuery);
$SrNo=0;
while($DataRows=mysqli_fetch_assoc($Execute)){
	$Id=$DataRows["id"];
	$DateTime=$DataRows["datetime"];
	$Title=$DataRows["title"];
	$Category=$DataRows["category"];
	$Admin=$DataRows["author"];
	$Image=$DataRows["image"];
	$Post=$DataRows["post"];
	$SrNo++;
	?>
	<tbody>
	<tr>

	<td><?php echo $SrNo; ?></td>
	<td style="color: #5e5eff;"><?php
	if(strlen($Title)>19){$Title=substr($Title,0,19).'..';}
	echo $Title;
	?></td>
	<td><?php
	if(strlen($DateTime)>12){$DateTime=substr($DateTime,0,12);}
	echo $DateTime;
	?></td>
	<td><?php
	if(strlen($Admin)>9){$Admin=substr($Admin,0,9);}
	echo $Admin; ?></td>
	<td><?php
	if(strlen($Category)>10){$Category=substr($Category,0,10);}
	echo $Category;
	?></td>
	<td><img src="upload/<?php echo $Image; ?>" width="170px" height="50px"></td>
	<td>
<?php
global $conn;
$QueryApproved="SELECT COUNT(*) FROM comments WHERE admin_panel_id='$Id' AND status='ON'";
$ExecuteApproved= mysqli_query($conn,$QueryApproved);
$RowsApproved= mysqli_fetch_assoc($ExecuteApproved);
$TotalApproved= array_shift($RowsApproved);
if($TotalApproved>0){
?>
<span class="label pull-right label-success">
<?php echo $TotalApproved;?>
</span>

<?php } ?>

<?php
global $conn;
$QueryUnApproved="SELECT COUNT(*) FROM comments WHERE admin_panel_id='$Id' AND status='OFF'";
$ExecuteUnApproved= mysqli_query($conn,$QueryUnApproved);
$RowsUnApproved= mysqli_fetch_assoc($ExecuteUnApproved);
$TotalUnApproved= array_shift($RowsUnApproved);
if($TotalUnApproved>0){
?>
<span class="label  bg-danger">
<?php echo $TotalUnApproved;?>
</span>

<?php } ?>

	</td>
	<td>
	<a href="EditPost.php?Edit=<?php echo $Id; ?>">
	<span class="btn btn-warning">Edit</span>
	</a>
	<a href="DeletePost.php?Delete=<?php echo $Id; ?>">
	<span class="btn btn-danger">Delete</span>
	</a>
	</td>
	<td>
	<a href="full-post.php?id=<?php echo $Id; ?>" target="_blank">
	<span class="btn btn-primary"> Live Preview</span>
	</a>
	</td>
	</tr>


<?php } ?>

	</tbody>
	</table>
</div>


	</div> <!-- Ending of Main Area-->

</div> <!-- Ending of Row-->

</div> <!-- Ending of Container-->
</div>

<?php
 require_once("includes/footer.php");
?>
