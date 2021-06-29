<?php 
    $hostname     = "127.0.0.1"; // enter your hostname
    $username     = "root";  // enter your table username
    $password     = "";   // enter your password
    $databasename = "shoeshopfinal";  // enter your database
    // Create connection 
    $conn = new mysqli($hostname ,$username,$password,$databasename);  
    // Check connection 
    if ($conn->connect_error) { 
        die("Unable to Connect database: " . $conn->connect_error);
    }
?>