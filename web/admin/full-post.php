<?php
    require_once("includes/functions.php");
    $title = "Full Post/Admin Dashboard";
    require_once("includes/header.php");

    if(!isAdmin()) {
		$_SESSION['ErrorMessage'] = "You must log in first";
		header('location: login.php');
    }

    include_once("includes/navbar.php");


if(isset($_POST["Submit"])){
$Name = e($_POST["Name"]);
$Email = e($_POST["Email"]);
$Comment= e($_POST["Comment"]);
$Image = $_FILES["avatar"]["name"];
$Target="images/".basename($_FILES["avatar"]["name"]);
date_default_timezone_set("Africa/Monrovia");
$CurrentTime = time();
//$DateTime=strftime("%Y-%m-%d %H:%M:%S",$CurrentTime);
$DateTime=strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);
$DateTime;
$PostId = $_GET["id"];

if(empty($Name)||empty($Email) ||empty($Comment)){
	$_SESSION["ErrorMessage"]="All Fields are required";

}elseif(strlen($Comment)>500){
	$_SESSION["ErrorMessage"]="only 500  Characters are Allowed in Comment";
}else{
	global $conn;
	$PostIDFromURL=$_GET['id'];
        $Query="INSERT into comments (datetime,name,email,avatar,comment,approvedby,status,admin_panel_id)
	VALUES ('$DateTime','$Name','$Email','$Image','$Comment','Pending','OFF','$PostIDFromURL')";
	$Execute= queryMysql($Query);
  move_uploaded_file($_FILES["avatar"]["tmp_name"],$Target);
	if($Execute){
	$_SESSION["SuccessMessage"]="Comment Submitted Successfully";
	Redirect_to("full-post.php?id={$PostId}");
	}else{
	$_SESSION["ErrorMessage"]="Something Went Wrong. Try Again !";
	Redirect_to("full-post.php?id={$PostId}");

	}

}

}

?><br><br>

<div class="content-wrapper">
    <div class="container-fluid"> <!--Container-->
	<div class="row"> <!--Row-->
		<div class="col-sm-8"> <!--Main Blog Area-->
		<?php echo Message();
	      echo SuccessMessage();
	?>
		<?php
		global $conn;
		if(isset($_GET["SearchButton"])){
			$Search=$_GET["Search"];
		$ViewQuery="SELECT * FROM admin_panel WHERE datetime LIKE '%$Search%' OR title LIKE '%$Search%' OR category LIKE '%$Search%' OR post LIKE '%$Search%'";
		}else{
			$PostIDFromURL=$_GET["id"];
		$ViewQuery="SELECT * FROM admin_panel WHERE id='$PostIDFromURL'
		ORDER BY datetime desc";}
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
		<div class="blogpost thumbnail">
			<img class="img-fluid  img-thumbnail" src="upload/<?php echo $Image;  ?>" >
		<div class="caption">
			<h1 id="heading"> <?php echo e($Title); ?></h1>
		<p class="description">Category: <?php echo e($Category); ?><br>
  By: <?php echo e($Admin);?><br>
		 Published on
		<?php echo e($DateTime);?></p>
		<p class="post"><?php
		echo nl2br($Post); ?></p>
		</div>

		</div>
		<?php } ?>
		<br><br>
		<br><br>
		<span class="FieldInfo">Comments</span>
<?php

$PostIdForComments=$_GET["id"];
$ExtractingCommentsQuery="SELECT * FROM comments WHERE admin_panel_id='$PostIdForComments' AND status='ON' ";
$Execute=mysqli_query($conn,$ExtractingCommentsQuery);
while($DataRows=mysqli_fetch_assoc($Execute)){
	$CommentDate=$DataRows["datetime"];
	$CommenterName=$DataRows["name"];
	$Comments=$DataRows["comment"];
  $CommentsImg = $DataRows["avatar"];


?>
<div class="CommentBlock">
	<img style="margin-left: 10px; margin-top: 10px;" class="pull-left" src="images/<?php echo $CommentsImg ?>" width=70px; height=70px;>
	<p style="margin-left: 90px;" class="Comment-info"><?php echo $CommenterName; ?></p>
	<p style="margin-left: 90px;"class="description"><?php echo $CommentDate; ?></p>
	<p style="margin-left: 90px;" class="Comment"><?php echo nl2br($Comments); ?></p>

</div>

	<hr>
<?php } ?>


		<br>
		<span class="FieldInfo">Share your thoughts about this post</span>


<div>
<form action="full-post.php?id=<?php echo $PostId; ?>" method="post" enctype="multipart/form-data">
	<fieldset>
	<div class="form-group">
	<label for="Name"><span class="FieldInfo">Name</span></label>
	<input class="form-control" type="text" name="Name" id="Name" placeholder="Name">
	</div>
	<div class="form-group">
	<label for="Email"><span class="FieldInfo">Email</span></label>
	<input class="form-control" type="email" name="Email" id="Email" placeholder="Email">
	</div>
  <div class="form-group">
	<label for="avatar"><span class="FieldInfo">Avatar</span></label>
	<input class="form-control" type="file" name="avatar" id="avatar">
	</div>
	<div class="form-group">
	<label for="commentarea"><span class="FieldInfo">Comment</span></label>
	<textarea class="editor form-control" name="Comment" id="commentarea"></textarea>
	<br>
<input class="btn btn-primary" type="submit" name="Submit" value="Submit">
	</fieldset>
	<br>
</form>
</div>

		</div> <!--Main Blog Area Ending-->
		<div class="col-sm-offset-1 col-sm-3"> <!--Side Area -->
		<h2>About me </h2>
	<img class="img-fluid rounded-circle img-thumbnail" src="images/Bunny.jpg">
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit
		, sed do eiusmod tempor incididunt ut labore et dolore magna
		aliqua. Ut enim ad minim veniam, quis nostrud exercitation ul
		lamco laboris nisi ut aliquip ex ea commodo consequat. Duis a
		ute irure dolor in reprehenderit in voluptate velit esse cill
		um dolore eu fugiat nulla pariatur. Excepteur sint occaecat c
		upidatat non proi
		dent, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
<div class="card card-primary">
	<div class="card-header">
		Categories
	</div>
	<div class="card-body">
<?php

$ViewQuery="SELECT * FROM category ORDER BY id desc";
$Execute=mysqli_query($conn,$ViewQuery);
while($DataRows = mysqli_fetch_assoc($Execute)){
	$Id=$DataRows['id'];
	$Category= $DataRows['name'];
?>
<a href="Blog.php?Category=<?php echo $Category; ?>">
<span id="heading"><?php echo $Category."<br>"; ?></span>
</a>
<?php } ?>

	</div>
</div>




<div class="card card-primary mx-auto mt-5">
	<div class="card-header">
		Recent Posts
	</div>
	<div class="card-body background">
<?php
$ViewQuery="SELECT * FROM admin_panel ORDER BY id desc LIMIT 0,5";
$Execute = mysqli_query($conn,$ViewQuery);
while($DataRows= mysqli_fetch_assoc($Execute)){
	$Id=$DataRows["id"];
	$Title=$DataRows["title"];
	$DateTime=$DataRows["datetime"];
	$Image=$DataRows["image"];
	if(strlen($DateTime)>11){$DateTime=substr($DateTime,0,12);}
	?>
<div>
<img class="pull-left" style="margin-top: 10px; margin-left: 0px;"  src="upload/<?php echo e($Image); ?>" width="120" height="60">
    <a href="full-post.php?id=<?php echo $Id;?>">
     <p id="heading" style="margin-left: 130px; padding-top: 10px;"><?php echo e($Title); ?></p>
     </a>
     <p class="description" style="margin-left: 130px;"><?php echo e($DateTime);?></p>
	<hr>
</div>


<?php } ?>

	</div>
</div> <br>




		</div> <!--Side Area Ending-->
	</div> <!--Row Ending-->


</div><!--Container Ending-->
<!-- Footer -->
<?php
 require_once("includes/footer.php");
?>
