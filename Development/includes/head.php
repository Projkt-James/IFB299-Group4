<?php
    
function displayHead($pageTitle){
    $head_HTML = '  <html>
                        <head>
                            <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
                            <meta charset="UTF-8">

                            <!-- JQuery/Javascript -->
                            <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
                            <script type="text/javascript" src="js/animate.js"></script>

                            <!--<script type="text/javascript" src="plugins/jquery.autosize.js"></script>-->

                            <!-- BootStrap -->
                            <link href="plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
                            <script type="text/javascript" src="plugins/bootstrap/js/bootstrap.min.js"></script>

                            <!-- Font Awesome -->
                            <link rel="stylesheet" href="plugins/font-awesome/css/font-awesome.min.css"/>

                            <!-- CSS -->
                            <link href="css/animate.css" rel="stylesheet" type="text/css">
                            <link href="css/normalize.css" rel="stylesheet" type="text/css">
                            <link href="css/main.css" rel="stylesheet" type="text/css">


                            <title>'.$pageTitle.'</title>                      
                        </head>
                    <body>
                        <!-- Top Page Anchor --> 
                        <a name="Top-Page"></a>';
    
    echo $head_HTML;
}
?>