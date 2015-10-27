<?php
session_start();
include "../includes/connect.php"; //include the database connection 

function updateAccountDetail($column, $value){
    global $con;
    $userID = $_SESSION['login'];
    
    if($value == "NULL"){
        $sql = "UPDATE member SET ".$column." = NULL WHERE memberID = '$userID'";
    }else{
        $sql = "UPDATE member SET ".$column." = '$value' WHERE memberID = '$userID'";
    }
    $result = mysqli_query($con, $sql) or die(mysqli_error($con));
}

$userID = $_SESSION['login'];

/***********************************
ACCOUNT DETAILS UPDATE
***********************************/
if(isset($_POST['Update_Details'])){
    
    /***************************
    NAME Validation
    ***************************/
    
    //FIRST
    if(empty($_POST['update_firstname'])){
        $firstname = "";
        $_SESSION['errorFirstName'] = 'First Name Required';
    }else if(ctype_alpha ($_POST['update_firstname'])){
        $firstname = mysqli_real_escape_string($con, $_POST['update_firstname']);
        updateAccountDetail("memberFirstName", $firstname); 
        $_SESSION['firstname'] = $firstname; 
                
    }else{
        $_SESSION['errorFirstName'] = 'Invalid First Name (Letters Only)';
    }
    
    //LAST
    if(empty($_POST['update_lastname'])){
        $lastname = "";
        $_SESSION['errorLastName'] = 'Last Name Required';
    }else if(ctype_alpha ($_POST['update_lastname'])){
        $lastname = mysqli_real_escape_string($con, $_POST['update_lastname']);
        updateAccountDetail("memberLastName", $lastname);
        $_SESSION['lastname'] = $lastname;
    }else{
        $_SESSION['errorLastName'] = 'Invalid Last Name (Letters Only)';
    }
    
    /***************************
    GENDER Validation
    ***************************/
    
    if(empty($_POST['update_gender'])){
        $gender = "";
        $_SESSION['errorGender'] = 'Gender Required';
    }else if($_POST['update_gender'] != "Gender"){
        $gender = mysqli_real_escape_string($con, $_POST['update_gender']);
        updateAccountDetail("memberGender", $gender);
    }else{
        $_SESSION['errorGender'] = 'Gender Required';
    }
    
    /***************************
    COUNTRY Validation
    ***************************/
    
    if(empty($_POST['update_country'])){
        $country = "";
        $_SESSION['errorCountry'] = 'Your Region Is Required';
    }else if($_POST['update_country'] != "Select A Country"){
        $country = mysqli_real_escape_string($con, $_POST['update_country']);
        updateAccountDetail("CountryID", $country);
    }else{
        $_SESSION['errorCountry'] = 'Your Region Is Required';
    }
    
    /***************************
    POSTCODE Validation
    ***************************/
    if(empty($_POST['update_postcode'])){
        $postcode = "";
        $_SESSION['errorPostCode'] = 'Your Region Is Required';
    }else if(ctype_digit($_POST['update_postcode']) && strlen($_POST['update_postcode']) == 4){
        $postcode = mysqli_real_escape_string($con, $_POST['update_postcode']);
        updateAccountDetail("memberPostCode", $postcode);
    }else{
        $_SESSION['errorPostCode'] = 'Your Region Is Required';
        
        if(strlen($_POST['update_postcode']) < 4){
            $_SESSION['errorPostCode'] = 'Four (4) Numbers Required';
        }
    }    

    /***************************
    EMAIL Validation
    ***************************/
    if(empty($_POST['update_email'])){
        $email = "";
        $_SESSION['errorEmail'] = 'Email Required';
        
    }else if(preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $_POST['update_email'])){
        //Looks to be safe, save to email variable
        $email = mysqli_real_escape_string($con, $_POST['update_email']);
        
        //Checks Email Availiblity
        $sql_emailcheck = "SELECT * FROM member WHERE memberID != '$userID' AND memberEmail='$email' "; //SQL Query to check email against database 
        $emailresult = mysqli_query($con, $sql_emailcheck) or die(mysqli_error($con)); //run the query 

        if(mysqli_num_rows($emailresult) > 0 && !empty($_POST['update_email'])){
            $_SESSION['errorEmail'] = 'Email in use by another user';
        }else{
            updateAccountDetail("memberEmail", $email);   
        }
        
    }else{
        $_SESSION['errorEmail'] = 'Invalid Email';
    }    
    
    header('Location:settings.php');
    exit();
}

/***********************************
PROFILE PICTURE UPDATE
***********************************/
if(isset($_POST['Update_Image'])){
    $userID = $_SESSION['login'];
    
    if($_FILES['image']['name']){
        $randomDigit = rand(0000,9999);
        
        $dir ="../users/". $userID ."/profile";
        if(!is_dir($dir)){
            mkdir($dir, 0755);
        }
            
        $ImageName = $_FILES['image']['name'];
        $newImageName = strtolower($randomDigit . "_" . $ImageName);
        $target = "../users/". $userID ."/profile/". $newImageName;
        $ImageName = $newImageName;
        
        $allowedExts = array('jpg', 'jpeg', 'gif', 'png'); 
        $tmp = explode('.', $_FILES['image']['name']); 
        $extension = end($tmp); 
        
        if($_FILES['image']['size'] > 10240000){ //image maximum size is 10mb
            
            $_SESSION['errorProfilePicture'] = '10Mb Max Image Size'; 
            header("location:settings.php"); 
            exit();
            
        }else if(($_FILES['image']['type'] == 'image/jpg') || ($_FILES['image']['type'] == 'image/jpeg') || ($_FILES['image']['type'] == 'image/gif') || ($_FILES['image']['type'] == 'image/png') && in_array($extension, $allowedExts)){ 
            
            try{
                move_uploaded_file($_FILES['image']['tmp_name'], $target);
                chmod($target, 0755);
                
            } catch(Exception $e) {
                $_SESSION['errorProfilePicture'] = 'Something went wrong :('; 
                header("location:settings.php"); 
                exit();
            }
            
            
            $sql="UPDATE member SET memberImage='$ImageName' WHERE memberID='$userID'";
            $result = mysqli_query($con, $sql) or die(mysqli_error($con));
            
            header("location:settings.php"); 
            exit(); 
        }else{  
            $_SESSION['errorProfilePicture'] = 'Invalid File Extension'; 
            header("location:settings.php"); 
            exit();   
        }         
    }else{
        $_SESSION['errorProfilePicture'] = 'No File Uploaded';
        header("location:settings.php"); 
        exit(); 
    }
}

?>