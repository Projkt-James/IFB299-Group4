<?php
/*
*
*   AUTHOR: James Hanford
*   CREATED: 05/09/2015
*   VERSION: 1.0.0
*
*/

include "functions.php";

session_start();

function displayHead($pageTitle){
    $head_HTML = '  <html>
                        <head>
                            <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
                            <meta charset="UTF-8">

                            <!-- JQuery/Javascript -->
                            <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
                            <script type="text/javascript" src="../js/animate.js"></script>
                            <script type="text/javascript" src="../js/transformicons.js"></script>

                            <!--<script type="text/javascript" src="../plugins/jquery.autosize.js"></script>-->

                            <!-- BootStrap -->
                            <link href="../plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
                            <script type="text/javascript" src="../plugins/bootstrap/js/bootstrap.min.js"></script>

                            <!-- Font Awesome -->
                            <link rel="stylesheet" href="../plugins/font-awesome/css/font-awesome.min.css"/>

                            <!-- CSS -->
                            <link href="../css/animate.css" rel="stylesheet" type="text/css">
                            <link href="../css/normalize.css" rel="stylesheet" type="text/css">
                            <link href="../css/main.css" rel="stylesheet" type="text/css">


                            <title>'.$pageTitle.'</title>                      
                        </head>
                    <body>
                        <!-- Top Page Anchor --> 
                        <a name="Top-Page"></a>';
    
    echo $head_HTML;
}

function displayTopBar(){
    $topbar_HTML = '<div class="Page-Container">   
                        <section class="TopBar">

                            <!-- TOP BAR Left Align -->
                            <div class="Left">

                                <!-- NAVBAR TOGGLE -->
                                <div class="Nav-Toggle btn">
                                
                                    <div class="Nav-Icon center-vert"><i class="fa fa-bars"></i></div>
                                    <div class="Close-Icon center-vert hidden"><i class="fa fa-angle-up"></i></div>

                                </div>
                            </div>

                            <!-- TOP BAR Right Align -->
                            <div class="TopBar-Right">
                                
                                <div class="TopBar-Profile">
                                    <div class="TopBar-ProfilePic circle center-vert"'. getProfilePic($_SESSION['login']) .'></div>
                                    <span>Hello, '.$_SESSION['firstname'].' '.$_SESSION['lastname'].'</span> 
                                </div>
                                
                                <ul>
                                    <li>Settings</li>
                                    <li><a href="logout.php">Logout</href></li></a>
                                </ul>
                                
                            </div>


                        </section>';
    
    echo $topbar_HTML;
}

function displayNav(){
    $nav_HTML = '   <nav>
                        <div class="Logo">
                            
                        </div>
                        <ul>
                            <li class="active">All Media</li>
                            <li>Images</li>
                            <li>Videos</li>
                            <li>Audio</li>
                        </ul>
                    </nav>';
    
    echo $nav_HTML;
}

/*
*
* FUNCTION TO GET PROFILE PIC FROM MEMBER ID
*
*/
function getProfilePic($userID){
    global $con;
    
    $sql = "SELECT memberImage FROM member WHERE memberID='$userID' AND memberImage IS NOT NULL";  
    $result = mysqli_query($con, $sql) or die(mysqli_error($con));
    $row = mysqli_fetch_array($result);

    if(mysqli_num_rows($result) == 1){  
        return 'style="background-image: url(\'../users/'.$userID.'/profile/'.$row['memberImage'].'\');"';        
    }
}
?>