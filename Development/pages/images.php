<?php
    include '../includes/head.php';
    include '../includes/connect.php';
    
    if (!isset($_SESSION['login'])) { 
        header('location:login.php'); 
    }

    //Webpage Title
    $Title = "All Images";

    displayHead($Title);
    displayNav(2);
    displayTopBar();
?>
        <!-------------------------------------
        // LIBRARY HEAD ~ START
        -------------------------------------->
        <div class="Libhead-Container">
            
             <form class="testing" action="../actions/upload-files.php" method="post" enctype="multipart/form-data">
                <div class="upload-input upload-input-hidden">
                    <input class="tested" type="file" multiple name="media[]" />
                </div>
                
                <div class="btn Library-Upload"><span>Upload</span></div>
                <input type="submit" name="Upload-Media" class="Upload-Trigger hidden" value="Upload" />
            </form>
            
        </div>
        <!-------------------------------------
        // LIBRARY HEAD ~ END
        -------------------------------------->
        
        <!-------------------------------------
        // LIBRARY CONTAINER ~ START
        -------------------------------------->
        <div class="Library-Container"> 
            
            <div class="Library-Head">
                <h1>All Images</h1>
                <div class="Search-Trigger"><i class="fa fa-search"></i></div>
            </div>
            
            <!-------------------------------------
            // LIBRARY SEARCH ~ START
            // Note: Hidden on page load
            -------------------------------------->
            <div class="Library-Search"> 
                
                <div class="center-vert">
                    <form class="Search-Bar" action="" method="post" id="search">
                        <input id="filter" type="text" name="search" maxlength="120" placeholder="Search Keyphrase or File Type" autocomplete="off" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Search Keyphrase or File Type'"/>
                    </form> 
                </div>
                
            </div>
            <!-------------------------------------
            // LIBRARY SEARCH ~ END
            -------------------------------------->
            
            <!-- MEDIA ITEMS START -->
            <?php
    
            $userID = $_SESSION['login'];

            $sql = "SELECT * FROM media WHERE memberID='$userID' AND mediaTypeID=1";
            $result = mysqli_query($con, $sql) or die(mysqli_error($con)); //run the query
    
            while ($row = mysqli_fetch_array($result)){
                $MediaTitle = $row['mediaTitle'];
                $MediaURL = '../users/' . $userID . '/' . $row['mediaFileName']; 
                
                switch($row['mediaTypeID']){
                    case 1:
                        $MediaType = 'I'; 
                        $Content = 'Image';
                        
                        $DataNames = array("File Type:", "Size:", "Dimensions", "Added:");
                        $DataValues = array($row['mediaFileType'], $row['mediaSize'], $row['mediaDimensions'], date("g:ia j M Y",strtotime($row['mediaAddDate'])));
                        
                        $PreviewHTML = '<div class="Item-View-Container Item-Image">
                                            <div class="Item-View-Left">
                                                <img class="center-vert center-hoz" src="'.$MediaURL.'"></img>
                                            </div>
                                            <div class="Item-View-Right">
                                                <div class="Item-View-Title">
                                                    <div class="Item-View-Title-Top"><i class="fa fa-close"></i></div>
                                                    <h1>'.$MediaTitle.'</h1>
                                                </div>
                                                
                                                <div class="Item-View-Info">
                                                    <h1>Information</h1>
                                                    <table>
                                                        <tr>
                                                            <td>'.$DataNames[0].'</td>
                                                            <td>'.$DataValues[0].'</td>
                                                        </tr>
                                                        <tr>
                                                            <td>'.$DataNames[1].'</td>
                                                            <td>'.$DataValues[1].'</td>
                                                        </tr>
                                                        <tr>
                                                            <td>'.$DataNames[2].'</td>
                                                            <td>'.$DataValues[2].'</td>
                                                        </tr>
                                                        <tr>
                                                            <td>'.$DataNames[3].'</td>
                                                            <td>'.$DataValues[3].'</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                
                                                <div class="Item-View-Bottom">
                                                    <div class="Item-View-Bottom-Delete" id="'.$row['mediaID'].'"><h1>Delete</h1></div>
                                                    
                                                    <a href="'.$MediaURL.'" download>
                                                        <div class="Item-View-Bottom-Download"><h1>Download</h1></div>
                                                    </a>
                                                </div>
                                                
                                            </div><!-- End Item-View-Right -->
                                        </div>';
                        break;
                    case 2:
                        $MediaType = 'V';
                        $Content = 'Video';
                        
                        $DataNames = array("File Type:", "Size:", "Added:");
                        $DataValues = array($row['mediaFileType'], $row['mediaSize'], date("g:ia j M Y",strtotime($row['mediaAddDate'])));
                        
                        $PreviewHTML = '<div class="Item-View-Container Item-Image">
                                            <div class="Item-View-Left">
                                                <video controls>
                                                    <source src="'.$MediaURL.'" type="video/'.$DataValues[0].'">
                                                        Your browser does not support the video tag.
                                                </video>
                                            </div>
                                            <div class="Item-View-Right">
                                                <div class="Item-View-Title">
                                                    <div class="Item-View-Title-Top"><i class="fa fa-close"></i></div>
                                                    <h1>'.$MediaTitle.'</h1>
                                                </div>
                                                
                                                <div class="Item-View-Info">
                                                    <h1>Information</h1>
                                                    <table>
                                                        <tr>
                                                            <td>'.$DataNames[0].'</td>
                                                            <td>'.$DataValues[0].'</td>
                                                        </tr>
                                                        <tr>
                                                            <td>'.$DataNames[1].'</td>
                                                            <td>'.$DataValues[1].'</td>
                                                        </tr>
                                                        <tr>
                                                            <td>'.$DataNames[2].'</td>
                                                            <td>'.$DataValues[2].'</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                
                                                <div class="Item-View-Bottom">
                                                    <div class="Item-View-Bottom-Delete" id="'.$row['mediaID'].'"><h1>Delete</h1></div>
                                                    <a href="'.$MediaURL.'" download>
                                                        <div class="Item-View-Bottom-Download"><h1>Download</h1></div>
                                                    </a>
                                                </div>
                                                
                                            </div><!-- End Item-View-Right -->
                                        </div>';
                        
                        break;
                    case 3:
                        $MediaType = 'A'; 
                        $Content = 'Audio';
                        
                        $DataNames = array("File Type:", "Size:", "Added:");
                        $DataValues = array($row['mediaFileType'], $row['mediaSize'], date("g:ia j M Y",strtotime($row['mediaAddDate'])));
                        
                        $PreviewHTML = '<div class="Item-View-Container Item-Image">
                                            <div class="Item-View-Left">
                                                <div class="center-hoz center-vert">
                                                <audio controls>
                                                    <source src="'.$MediaURL.'" type="audio/'.$DataValues[0].'">
                                                        Your browser does not support the audio element.
                                                </audio>
                                                </div>
                                            </div>
                                            <div class="Item-View-Right">
                                                <div class="Item-View-Title">
                                                    <div class="Item-View-Title-Top"><i class="fa fa-close"></i></div>
                                                    <h1>'.$MediaTitle.'</h1>
                                                </div>
                                                
                                                <div class="Item-View-Info">
                                                    <h1>Information</h1>
                                                    <table>
                                                        <tr>
                                                            <td>'.$DataNames[0].'</td>
                                                            <td>'.$DataValues[0].'</td>
                                                        </tr>
                                                        <tr>
                                                            <td>'.$DataNames[1].'</td>
                                                            <td>'.$DataValues[1].'</td>
                                                        </tr>
                                                        <tr>
                                                            <td>'.$DataNames[2].'</td>
                                                            <td>'.$DataValues[2].'</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                
                                                <div class="Item-View-Bottom">
                                                    <div class="Item-View-Bottom-Delete" id="'.$row['mediaID'].'"><h1>Delete</h1></div>
                                                    <a href="'.$MediaURL.'" download>
                                                        <div class="Item-View-Bottom-Download"><h1>Download</h1></div>
                                                    </a>
                                                </div>
                                                
                                            </div><!-- End Item-View-Right -->
                                        </div>';
                        
                        break;        
                }
                
                echo '  	<div class="Library-Item col-xs-6 col-sm-4 col-md-2">
                                '.$PreviewHTML.'
                                <div class="hidden">'.$Content.'</div>
                                <div class="Item-Thumb">'.$MediaType.'</div>
                                <div class="Item-Title">'.$MediaTitle.'</div>
                            </div>';
            }
            ?>
            <!-- MEDIA ITEMS END -->

        </div>
        <!-------------------------------------
        // LIBRARY CONTAINER ~ END
        -------------------------------------->

    </body>
</html>
        
        
        
        
        
    