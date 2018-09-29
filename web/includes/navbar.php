
<?php
if(isAdmin()){
	 // Navigation
echo '
 <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="">ASMUMSA</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="dashboard.php"> <i class="fa fa-fw fa-dashboard"></i>
              Dashboard
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="user.php">
              <i class="fa fa-fw fa-user"></i>
              Manage Users
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="services.php">Services</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="contact.php">Contact</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="admin/logout.php">
                <i class="fa fa-fw fa-sign-out"></i>
                Logout
                </a>
              </li>
          </ul>
        </div>
      </div>
    </nav> <br>
    ';
 } else {
    	 // Navigation
echo '
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
     <div class="container">
       <a class="navbar-brand" href="index.php">ASMUMSA</a>
       <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
         <span class="navbar-toggler-icon"></span>
       </button>
       <div class="collapse navbar-collapse" id="navbarResponsive">
         <ul class="navbar-nav ml-auto">
           <li class="nav-item active">
             <a class="nav-link" href="index.php">Home
               <span class="sr-only">(current)</span>
             </a>
           </li>
           <li class="nav-item">
             <a class="nav-link" href="about.php">About</a>
           </li>
           <li class="nav-item">
             <a class="nav-link" href="services.php">Services</a>
           </li>
           <li class="nav-item">
             <a class="nav-link" href="contact.php">Contact</a>
           </li>
           <li class="nav-item">
               <a class="nav-link" href="admin/login.php">Login</a>
             </li>
         </ul>
       </div>
     </div>
   </nav> <br>
   ';
  }


?>