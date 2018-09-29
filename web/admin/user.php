<?php
    require_once("includes/functions.php");
    $title = "Manage Users";
    require_once("includes/header.php");

    if(!isAdmin()) {
		$_SESSION['msg'] = "You must log in first";
		header('location: login.php');
	}

    include_once("includes/navbar.php");
?>

<div class="content-wrapper">
<div class="container-fluid">
  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="dashboard.php">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">My Users</li>
      </ol>
    <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Manage Users</div>
        <div class="card-body">
	<?php
				 echo display_error();
				 echo Message();
				echo SuccessMessage();
			 ?>
	</div>
<div class="table-responsive">
	<table class="table table-bordered table-hover table-striped" id="dataTable" width="100%" cellspacing="0">
	<tr>
		<th>Sr No.</th>
		<th>Date &amp; Time</th>
		<th>Admin Name</th>
        <th>User Email</th>
		 <th>UserName</th>
		 <th>User Role</th>
         <th>Occupation</th>
		<th>Address</th>
        <th>Addedby</th>
        <th>Edit</th>
        <th>Delete</th>
	</tr>
<?php
global $conn;
$ViewQuery="SELECT * FROM user ORDER BY id desc";
$Execute=queryMysql($ViewQuery);
$SrNo=0;
while($DataRows=mysqli_fetch_array($Execute)){
	$Id=$DataRows["id"];
	$DateTime= $DataRows["date"];
    $Fullname= $DataRows["firstname"]." ". $DataRows["lastname"];
    $email = $DataRows["email"];
	$Username= $DataRows["username"];
    $role= $DataRows["roles"];
    $option = $DataRows["options"];
    $address = $DataRows["address"];
	$Admin= $DataRows["addedby"];
	$SrNo++;

?>
<tr>
	<td><?php echo $SrNo; ?></td>
	<td><?php echo $DateTime; ?></td>
	 	<td><?php echo $Fullname; ?></td>
         <td><?php echo $email; ?></td>
	<td><?php echo $Username; ?></td>
	 	<td><?php echo $role; ?></td>
         <td><?php echo $option; ?></td>
         <td><?php echo $address; ?></td>
	    <td><?php echo $Admin; ?></td>
      <td><a href="edit-admin.php?id=<?php echo $Id;?>">
  	     <span class="btn btn-info">Edit</span></a>
     </td>
     <td><a href="delete_admin.php?id=<?php echo $Id;?>">
	         <span class="btn btn-danger">Delete</span></a>
    </td>

</tr>

	<?php } ?>
	</table>
</div>
</div>
</div>
</div>


  <?php
      require_once("includes/footer.php");
   ?>
