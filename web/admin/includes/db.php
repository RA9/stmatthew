<?php
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass =  "carlos";
    $dbname = "stmatthew";

    $conn = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

    if(!$conn){
    die("Error in Connection:".mysqli_connect_error($conn));
    }
?>