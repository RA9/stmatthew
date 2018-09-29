<?php
include('includes/functions.php');
ob_start();
session_start();
 session_unset();
session_destroy();

	Redirect_to('http://localhost/stmatthew/index.php');

 ?>
