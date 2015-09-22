<?php 
session_start(); //start a session 
//include "../includes/activity.php"; ACTIVITY TODO
//clearActivity();

session_destroy(); //destroy all sessions 
header('location:index.php'); 
?> 