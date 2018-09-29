<?php
    require_once("includes/functions.php");
    $title = "Admin Dashboard";
    require_once("includes/header.php");

    if(!isAdmin()) {
		$_SESSION['msg'] = "You must log in first";
		header('location: login.php');
    }

    include_once("includes/navbar.php");
?>
   <div class="content-wrapper">
    <div class="container-fluid">
	<div class="row"> <!--Row-->
		<div class="col-sm-8"> <!--Main Blog Area-->
		<?php
		global $conn;
		// Query when Search Button is Active
		if(isset($_GET["SearchButton"])){
			$Search=$_GET["Search"];

		$ViewQuery="SELECT * FROM admin_panel
		WHERE datetime LIKE '%$Search%' OR title LIKE '%$Search%'
		OR category LIKE '%$Search%' OR post LIKE '%$Search%' ORDER BY id desc";

		}
		// QUery When Category is active URL Tab
		elseif(isset($_GET["Category"])){
		$Category=$_GET["Category"];
	$ViewQuery="SELECT * FROM admin_panel WHERE category='$Category' ORDER BY id desc";
		}
		// Query When Pagination is Active i.e Blog.php?Page=1
		elseif(isset($_GET["Page"])){
		$Page=$_GET["Page"];

		if($Page == 0 || $Page < 1){
			$ShowPostFrom = 0;
		} else {
		$ShowPostFrom=($Page * 3)-3;}
	$ViewQuery="SELECT * FROM admin_panel ORDER BY id desc LIMIT $ShowPostFrom,3";
		}
		// The Default Query for Blog.php Page
		else{

		$ViewQuery="SELECT * FROM admin_panel ORDER BY id desc LIMIT 0,3";}
		$Execute=mysqli_query($conn,$ViewQuery);
		while($DataRows=mysqli_fetch_assoc($Execute)){
			$PostId=$DataRows["id"];
			$DateTime=$DataRows["datetime"];
			$Title=$DataRows["title"];
			$Category=$DataRows["category"];
			$Admin=$DataRows["author"];
			$Image=$DataRows["image"];
			$Post=$DataRows["post"];

		?>
<div class="card">
		<div class="card-body blogpost">
    			<img class="img-fluid img-rounded" src="upload/<?php echo $Image;  ?>" >
		<div class="caption">
			<h1 class="card-title" id="heading"> <?php echo e($Title); ?></h1>
		</div>
		<p class="description">Category: <?php echo e($Category); ?>
			 <p class="description">By:  <?php echo e($Admin); ?>
		<p class="description">Published on
		<?php echo e($DateTime);?></p>

<?php
$QueryApproved="SELECT COUNT(*) FROM comments WHERE admin_panel_id='$PostId' AND status='ON'";
$ExecuteApproved=mysqli_query($conn,$QueryApproved);
$RowsApproved = mysqli_fetch_assoc($ExecuteApproved);
$TotalApproved=array_shift($RowsApproved);

if($TotalApproved > 0){
?>
		 <button type="button" class="btn btn-primary"> Comments: <span class="badge badge-light"> <?php echo $TotalApproved;?> </span> </button>
<?php } ?>

		</p>
		<br>
		<p class="card-text post"><?php
		if(strlen($Post)>150){
		$Post=substr($Post,0,150).'...';
		}

		echo $Post; ?></p>
		<a href="full-post.php?id=<?php echo $PostId; ?>"><span class="btn btn-info">
			Read More &rsaquo;&rsaquo;
		</span></a>
			</div>
		</div><br>
		<?php } ?>
		 <nav aria-label="Page navigation example">
			<ul class="pagination pull-left pagination-sm">
	<!-- Creating backward Button -->
	<?php
	if(isset($Page))
	{
	       if($Page>1){
		?>
		<li class="page-item"><a class="page-link" href="blog.php?Page=<?php echo $Page-1; ?>"> &laquo; </a></li>
         <?php        }
	} ?>
		<?php
		global $conn;
		$QueryPagination="SELECT COUNT(*) FROM admin_panel";
		$ExecutePagination=mysqli_query($conn,$QueryPagination);
		$RowPagination=mysqli_fetch_array($ExecutePagination);
		  $TotalPosts=array_shift($RowPagination);
		 // echo $TotalPosts;
		  $PostPagination = $TotalPosts/3;
		  $PostPagination = ceil($PostPagination);
		  echo $PostPerPage;

		for($i=1;$i<=$PostPagination;$i++){
	if(isset($Page)){
		if($i==$Page){
		?>
		<li class="page-item active"><a class="page-link" href="blog.php?Page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
		<?php
		}else{ ?>
		<li class="page-item"><a class="page-link" href="blog.php?Page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
		<?php
		}
	}
		} ?>
		<!-- Creating Forward Button -->
		<?php
	if(isset($Page))
	{
	       if($Page+1 <=$PostPagination){
		?>
		<li class="page-item"><a class="page-link" href="blog.php?Page=<?php echo $Page+1; ?>"> &raquo; </a></li>
         <?php        }
	} ?>
		</ul>
		</nav>
  </div><!-- Pagination Ends -->
		 <!--Main Blog Area Ending-->
		<br>
<div class="col-sm-offset-2 col-sm-3"> <!--Side Area -->
    <div class="card card-primary ">
        <div class="card-body">
            <div class="card-header">
                Categories
            </div>
<?php
global $conn;
$ViewQuery="SELECT * FROM category ORDER BY id desc";
$Execute=mysqli_query($conn,$ViewQuery);
while($DataRows=mysqli_fetch_assoc($Execute)){
	$Id = $DataRows['id'];
	$Category = $DataRows['name'];
?>
<a href="blog.php?Category=<?php echo $Category; ?>">
<span id="heading"><?php echo $Category."<br>"; ?></span>
</a>
<?php } ?>
</div>
</div>

<br>
<div class="card card-primary">
   	<div class="card-body background">
	<div class="card-header">
		Recent Posts
	</div><!-- Card title Ends -->
<?php

$ViewQuery="SELECT * FROM admin_panel ORDER BY id desc LIMIT 0,5";

$Execute=mysqli_query($conn,$ViewQuery);

while($DataRows=mysqli_fetch_assoc($Execute)){
	$Id=$DataRows["id"];
	$Title=$DataRows["title"];
	$DateTime=$DataRows["datetime"];
	$Image=$DataRows["image"];
	if(strlen($DateTime)>11){
	$DateTime = substr($DateTime,0,12);}
	?>
<div class="thumbnail">
<img class="pull-left img-responsive" style="margin-top: 10px; margin-left: 0px;"  src="upload/<?php echo htmlentities($Image); ?>" width="120" height="60">
    <a href="full-post.php?id=<?php echo $Id;?>">
     <p id="heading" style="margin-left: 130px; padding-top: 10px;"><?php echo e($Title); ?></p>
     </a>
     <p class="description" style="margin-left: 130px;"><?php echo htmlentities($DateTime);?></p>
	<hr>
</div>
<?php } ?>
		</div> <!--Side Area Ending-->
	</div> <!--Row Ending-->


</div><br>
</div> <!--Row Ending-->
</div><!--Container Ending-->
</div>
 <!-- Footer and Links-->
<?php
 require_once("includes/footer.php");
?>
