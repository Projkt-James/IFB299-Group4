<?php
session_start();
include "../includes/connect.php"; //include the database connection 

$userID = $_SESSION['login'];

if(isset($_POST['Upload-Media'])){
    
    //Counts number of files uploaded
    $numUpload = count($_FILES['media']['name']);
    
    //If greater than 0
    if($numUpload > 0){
        
        //Make directory for user
        $dir ="../users/". $userID;
        if(!is_dir($dir)){
            mkdir($dir, 0700);
        }
        
        //For Each File
        for($i=0; $i < $numUpload; $i++){
            
            $FileName = $_FILES['media']['name'][$i];
            $formatFileName = strtolower(time() . "_" . $FileName); 
            
            $target = "../users/". $userID ."/". $formatFileName;

            //VIDEO .mkv .flv .gifv .avi .wmv .mp4 .m4v .mpg .mp2 .mpeg .mpe .mpv
            //IMAGE 
            //AUDIO
            
            $allowedExts = array('jpg', 'jpeg', 'gif', 'png', 'mp4'); 
            
            $tmp = explode('.', $_FILES['media']['name'][$i]); 
            $extension = end($tmp); 
            
            if($_FILES['media']['size'][$i] > 104857600 ){ //media maximum size is 100mb
                //Handle File Too Large
                return;
            
            }else if(in_array($extension, $allowedExts)){
                
                try{
                    move_uploaded_file($_FILES['media']['tmp_name'][$i], $target);
                } catch(Exception $e) {
                    //Hande Error Unable to Upload
                    return;
                }  
                
                //Save Info To DataBase
                $sql_insert = "INSERT INTO media (mediaID, mediaTitle, mediaFileName, memberID, mediaTypeID) VALUES ('', '$FileName', '$formatFileName', '$userID', '1')";
                
                $insertresult = mysqli_query($con, $sql_insert) or die(mysqli_error($con)); //run the query 
            
                if(!$insertresult){
                    die('Could not insert into database: '.mysql_error());
                }
                
            }else{
                //Handle Invalid Media Ext    
            }
        }//end for
        
        header("location:../pages/index.php"); 
    }
}

?>