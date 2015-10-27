<?php
session_start();
include "../includes/connect.php"; //include the database connection 
include "../includes/functions.php";

$userID = $_SESSION['login'];

if(isset($_POST['Upload-Media'])){
    
    //Counts number of files uploaded
    $numUpload = count($_FILES['media']['name']);
    
    //If greater than 0
    if($numUpload > 0){
        
        //Make directory for user
        $dir ="../users/". $userID;
        if(!is_dir($dir)){
            mkdir($dir, 0755);
        }
        
        //For Each File
        for($i=0; $i < $numUpload; $i++){
            
            $FileName = $_FILES['media']['name'][$i];
            $formatFileName = strtolower(time() . "_" . $FileName); 
            
            $target = "../users/". $userID ."/". $formatFileName;
            $FileSize = formatBytes($_FILES['media']['size'][$i]);

            $allowedImage = array('jpg', 'jpeg', 'gif', 'png'); 
            $allowedVideo = array('mp4', 'webM', 'ogg');
            $allowedAudio = array('mp3', 'wav', 'ogg'); 
            
            $tmp = explode('.', $_FILES['media']['name'][$i]); 
            $extension = end($tmp); 
            
            if($_FILES['media']['size'][$i] > 104857600 ){ //media maximum size is 100mb
                //Handle File Too Large
                return;
            
            //------------------------------------------
            // IMAGE    
            //------------------------------------------    
            }else if(in_array($extension, $allowedImage)){
                
                try{
                    move_uploaded_file($_FILES['media']['tmp_name'][$i], $target);
                    chmod($target, 0755);
                } catch(Exception $e) {
                    //Hande Error Unable to Upload
                    return;
                }  
                
                list($width, $height, $type, $attr) = getimagesize($target);
                $FileDimensions = $width . " x " . $height;
                
                //Save Info To DataBase
                $sql_insert = "INSERT INTO media (mediaID, mediaTitle, mediaFileName, memberID, mediaFileType, mediaDimensions, mediaSize, mediaAddDate, mediaTypeID) VALUES ('', '$FileName', '$formatFileName', '$userID', '$extension', '$FileDimensions', '$FileSize', NOW(), '1')";
                
                $insertresult = mysqli_query($con, $sql_insert) or die(mysqli_error($con)); //run the query 
            
                if(!$insertresult){
                    die('Could not insert into database: '.mysql_error());
                }
            //end Image
                
            //------------------------------------------
            // VIDEO 
            //------------------------------------------    
            }else if(in_array($extension, $allowedVideo)){

                try{
                    move_uploaded_file($_FILES['media']['tmp_name'][$i], $target);
                    chmod($target, 0755);
                } catch(Exception $e) {
                    //Hande Error Unable to Upload
                    return;
                }  

                //Save Info To DataBase
                $sql_insert = "INSERT INTO media (mediaID, mediaTitle, mediaFileName, memberID, mediaFileType, mediaSize, mediaAddDate, mediaTypeID) VALUES ('', '$FileName', '$formatFileName', '$userID', '$extension', '$FileSize', NOW(), '2')";

                $insertresult = mysqli_query($con, $sql_insert) or die(mysqli_error($con)); //run the query 

                if(!$insertresult){
                    die('Could not insert into database: '.mysql_error());
                } 
            //end Video
                
            //------------------------------------------
            // AUDIO
            //------------------------------------------    
            }else if(in_array($extension, $allowedAudio)){

                try{
                    move_uploaded_file($_FILES['media']['tmp_name'][$i], $target);
                    chmod($target, 0755);
                } catch(Exception $e) {
                    //Hande Error Unable to Upload
                    return;
                }  

                //Save Info To DataBase
                $sql_insert = "INSERT INTO media (mediaID, mediaTitle, mediaFileName, memberID, mediaFileType, mediaSize, mediaAddDate, mediaTypeID) VALUES ('', '$FileName', '$formatFileName', '$userID', '$extension', '$FileSize', NOW(), '3')";

                $insertresult = mysqli_query($con, $sql_insert) or die(mysqli_error($con)); //run the query 

                if(!$insertresult){
                    die('Could not insert into database: '.mysql_error());
                }
            //end Audio
                
            }else{
                //Handle Invalid Media Ext    
            }
        }//end for
        
        header("location:../pages/index.php"); 
    }
}

?>