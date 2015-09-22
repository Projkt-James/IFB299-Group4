<?php 

$con = mysqli_connect("localhost", "root", "", "media-db"); 

// check connection and, if broken, display an error message 
if (mysqli_connect_error($con)) { 
    echo "Unable to connect to the database: " . mysqli_connect_error(); 
    exit(); 
}
?>