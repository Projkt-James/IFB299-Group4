/***************************
Signup-process.php
***************************/
<?php 
session_start();
include "../includes/connect.php"; //include the database connection 

$errorcount = 1;

/***************************
NAME Validation
***************************/

    //FIRST
    if(empty($_POST['sign_firstname'])){
        $firstname = "";
        $errorcount = $errorcount++;
        $_SESSION['errorFirstName'] = 'First Name Required';
    }else if(ctype_alpha ($_POST['sign_firstname'])){
        $firstname = mysqli_real_escape_string($con, $_POST['sign_firstname']);
        $_SESSION['sign_firstname'] = $firstname;
    }else{
        $errorcount = $errorcount++;
        $_SESSION['errorFirstName'] = 'Invalid First Name (Letters Only)';
    }

    //Last
    if(empty($_POST['sign_lastname'])){
        $lastname = "";
        $errorcount = $errorcount++;
        $_SESSION['errorLastName'] = 'Last Name Required';
    }else if(ctype_alpha ($_POST['sign_lastname'])){
        $lastname = mysqli_real_escape_string($con, $_POST['sign_lastname']);
        $_SESSION['sign_lastname'] = $lastname;
    }else{
        $errorcount = $errorcount++;
        $_SESSION['errorLastName'] = 'Invalid Last Name (Letters Only)';
    }

/***************************
GENDER Validation
***************************/
    
    if(empty($_POST['sign_gender'])){
        $gender = "";
        $errorcount = $errorcount++;
        $_SESSION['errorGender'] = 'Gender Required';
    }else if($_POST['sign_gender'] != "Gender"){
        $gender = mysqli_real_escape_string($con, $_POST['sign_gender']);
        $_SESSION['errorGender'] = 'Please Select Again';
    }else{
        $errorcount = $errorcount++;
        $_SESSION['errorGender'] = 'Gender Required';
    }

/***************************
COUNTRY Validation
***************************/
    
    if(empty($_POST['sign_country'])){
        $country = "";
        $errorcount = $errorcount++;
        $_SESSION['errorCountry'] = 'Your Region Is Required';
    }else if($_POST['sign_country'] != "Select A Country"){
        $country = mysqli_real_escape_string($con, $_POST['sign_country']);
        $_SESSION['errorCountry'] = 'Please Select Again';
    }else{
        $errorcount = $errorcount++;
        $_SESSION['errorCountry'] = 'Your Region Is Required';
    }

/***************************
POSTCODE Validation
***************************/

    if(empty($_POST['sign_postcode'])){
        $postcode = "";
        $errorcount = $errorcount++;
        $_SESSION['errorPostCode'] = 'Your Region Is Required';
    }else if(ctype_digit($_POST['sign_postcode'])){
        $postcode = mysqli_real_escape_string($con, $_POST['sign_postcode']);
        $_SESSION['sign_postcode'] = $postcode;
    }else{
        $errorcount = $errorcount++;
        $_SESSION['errorPostCode'] = 'Your Region Is Required';
    }

/***************************
EMAIL Validation
***************************/
    if(empty($_POST['sign_email'])){
        $email = "";
        $errorcount = $errorcount++;
        $_SESSION['errorEmail'] = 'Email Required';
        
    }else if(preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $_POST['sign_email'])){
        //Looks to be safe, save to email vaariable
        $email = mysqli_real_escape_string($con, $_POST['sign_email']);
        $_SESSION['sign_email'] = $email;
        
        //Checks Email Availiblity
        $sql_emailcheck = "SELECT * FROM member WHERE memberEmail='$email'"; //SQL Query to check email againstdatabase 
        $emailresult = mysqli_query($con, $sql_emailcheck) or die(mysqli_error($con)); //run the query 

        if(mysqli_num_rows($emailresult) != 0 && !empty($_POST['sign_email'])){
            $errorcount = $errorcount++;
            $_SESSION['errorEmail'] = 'Email is already in use';
        }
        
    }else{
        $errorcount = $errorcount++;
        $_SESSION['errorEmail'] = 'Invalid Email';
    }	

/***************************
USERNAME Validation
***************************/
    if(empty($_POST['sign_username'])){
        $username = "";
        $errorcount = $errorcount++;
        $_SESSION['errorUser'] = 'Username Required';
    }else if(ctype_alnum ($_POST['sign_username'])){
        $username = mysqli_real_escape_string($con, $_POST['sign_username']);
        $_SESSION['sign_username'] = $username;
    }else{
        $errorcount = $errorcount++;
        $_SESSION['errorUser'] = 'Invalid Username (Letters (A-z) and Numbers Only)';
    }

    //Checks Username Availiblity
    $sql_usercheck = "SELECT * FROM member WHERE memberUsername='$username'"; //SQL Query to check username against database
    $userresult = mysqli_query($con, $sql_usercheck) or die(mysqli_error($con)); //run the query 

    if(mysqli_num_rows($userresult) != 0){
        $errorcount = $errorcount+1;
        $_SESSION['errorUser'] = 'Username is already in use';
    }

/***************************
PASSWORD Validation
***************************/
    if(!empty($_POST['sign_password'])){
        $password_length = strlen(mysqli_real_escape_string($con, $_POST['sign_password']));
        
        if($password_length < 6 || $password_length > 20){
            $errorcount = $errorcount+1;
            $_SESSION['errorPass'] = 'Password must be between 6-20 Characters';
        }else if($password_length > 5){
            //Everything looks good write Password to variable
            $password = mysqli_real_escape_string($con, $_POST['sign_password']);
            $salt = md5(uniqid(rand(), true)); //create a random salt value
            $password = hash('sha256', $password.$salt); //generate the hashed password 
        }
    }else if(empty($_POST['sign_password'])){
        $password = "noneset";
        $errorcount = $errorcount+1;
        $_SESSION['errorPass'] = 'Password Required';
    }

/***************************
DATABASE INSERT OR THROWBACK
***************************/
    if($errorcount == 1){
        /* If no Errors. Move insert into Database and send activation Email.*/
        //Final check to ensure no entry repeating
        $sql = "SELECT * FROM member WHERE memberEmail='$email' OR memberUsername='$username' ";
        $result = mysqli_query($con, $sql) or die(mysqli_error($con)); //run the query 
        
        if(mysqli_num_rows($result) == 0){
            $activation = md5(uniqid(rand(), true));
            
            $sql_insert = "INSERT INTO member (memberID,memberFirstName,memberLastName,memberEmail,memberUsername,memberPassword, memberGender, countryID, memberSalt, memberPostCode, memberJoinDate) VALUES ('', '$firstname', '$lastname', '$email','$username','$password', '$gender', '$country', '$salt', '$postcode', NOW())"; 
            $insertresult = mysqli_query($con, $sql_insert) or die(mysqli_error($con)); //run the query 
            
            if(!$insertresult){
                die('Could not insert into database: '.mysql_error());
            }else{
                /*Activate Email
                $activateURL = "localhost".'/activate.php?email='.urlencode($email)."&key=$activation";*/
                
                //Clears All Sessions that handle storing stuff
                unset($_SESSION['sign_firstname']);
                unset($_SESSION['sign_lastname']);
                unset($_SESSION['sign_gender']);
                unset($_SESSION['sign_country']);
                unset($_SESSION['sign_gender']);      
                unset($_SESSION['sign_email']);
                unset($_SESSION['sign_postcode']);
                
                //Clears All Error Tags
                unset($_SESSION['errorFirstName']);
                unset($_SESSION['errorLastName']);
                unset($_SESSION['errorGender']);
                unset($_SESSION['errorCountry']);
                unset($_SESSION['errorPostCode']);
                unset($_SESSION['errorEmail']);
                unset($_SESSION['errorUser']);
                unset($_SESSION['errorPass']);
                
                //Forward to login with username already filled in
                $_SESSION['username'] = $username;
                header('Location:login.php');
            }
        }
    }else{
        header('Location:signup.php');
    }
?>





/***************************
Upload-files.php
***************************/
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