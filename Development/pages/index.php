<?php
    include '../includes/head.php';
    include '../includes/connect.php';
    
    if (!isset($_SESSION['login'])) { 
        header('location:login.php'); 
    }

    //Webpage Title
    $Title = "All Media";

    displayHead($Title);
    displayNav();
    displayTopBar();
?>
        <div class="Libhead-Container">
            
             <form class="testing" action="../actions/upload-files.php" method="post" enctype="multipart/form-data">
                <div class="upload-input upload-input-hidden">
                    <input class="tested" type="file" multiple name="media[]" />
                </div>
                
                <div class="btn Library-Upload"><span>Upload</span></div>
                <input type="submit" name="Upload-Media" class="Upload-Trigger hidden" value="Upload" />
            </form>
            
        </div>

        <div class="Library-Container"> 
            
            <?php

            $userID = $_SESSION['login'];

            $sql = "SELECT * FROM media WHERE memberID='$userID'";
            $result = mysqli_query($con, $sql) or die(mysqli_error($con)); //run the query
    
            while ($row = mysqli_fetch_array($result)){
                $MediaTitle = $row['mediaTitle'];
                $MediaURL = '../users/' . $userID . '/' . $row['mediaFileName']; 
                
                switch($row['mediaTypeID']){
                    case 1:
                        $MediaType = 'I';    
                        break;
                    case 2:
                        $MediaType = 'V';    
                        break;
                    case 3:
                        $MediaType = 'A';    
                        break;
                           
                }
                
                echo '  	<div class="Library-Item col-xs-6 col-sm-4 col-md-2">
                                <a href="'.$MediaURL.'" download="'.$MediaTitle.'"><div class="Item-Preview">'.$MediaType.'</div></a>
                                <div class="Item-Title">'.$MediaTitle.'</div>
                            </div>';
            }
            ?>
            
        

        </div>

        

    </body>
</html>
        
        
        
        
        
    