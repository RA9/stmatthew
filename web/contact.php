<?php 
  require_once("includes/functions.php");
  $title = "St Matthew Alumina Association";
  require_once("includes/header.php");
  include("includes/navbar.php");

?>
      <!-- Page Content -->
      <div class="container">
          <br><br>
            <form action="" method="post">
                <h2 class="h1 text-center">Contact Us</h2>
                <div class="form-group">
                    <label for="Fullname">FullName</label>
                    <input type="text" class="form-control">
                </div>
                <div class="form-group">
                        <label for="Email">Email</label>
                        <input type="text" class="form-control">
                </div>
                <div class="form-group">
                    <label for="comment">What's on your mind?</label>
                   <textarea name="comment" class="form-control" id="" cols="30" rows="10"></textarea>
                 </div>
                 <div class="form-group">
                     <input type="submit" class="form-control btn btn-info btn-block" value="Submit">
                 </div>
            </form>
          </div>
      
        <?php 
          require_once("includes/footer.php");
         ?>