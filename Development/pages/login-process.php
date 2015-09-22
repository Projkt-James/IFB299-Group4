<?php 
session_start();
include "../includes/connect.php"; 

//Save to variable to prevent SQL injection 
$username = mysqli_real_escape_string($con, $_POST['username']); 
$password = mysqli_real_escape_string($con, $_POST['password']); 

$sql = "(SELECT memberUsername, memberSalt, typeID FROM member WHERE memberUsername='$username')";
$result = mysqli_query($con, $sql) or die(mysqli_error($con)); 

$row = mysqli_fetch_array($result); //store the results 
$count = mysqli_num_rows($result); //count the returned results

if($count==1){ //IF USER EXISTS
            
        $username = $row['memberUsername'];
        $salt = $row['memberSalt'];
        $password = hash('sha256', $password.$salt); //generate the hashed salted password 
        
        //MEMBER LOGIN ATTEMPT
        if($row['typeID'] >= 1){
            
            $sql3 ="SELECT * FROM member WHERE memberUsername='$username' AND memberPassword='$password'";
            $result3 = mysqli_query($con, $sql3) or die(mysqli_error($con)); //run the query 

            $row3 = mysqli_fetch_array($result3); //store the results 
            $count3 = mysqli_num_rows($result3); //count the returned results 

            if($count3==1){ //IF SUCCESSFUL

                // Sessions
                $_SESSION['login'] = $row3['memberID']; 
                $_SESSION['username'] = $row3['memberUsername']; 

                $_SESSION['firstname'] = $row3['memberFirstName']; 
                $_SESSION['lastname'] = $row3['memberLastName'];
                $_SESSION['type'] = 'member';
                
                //Clear All Error Tags
                unset($_SESSION['errorFirstName']);
                unset($_SESSION['errorLastName']);
                unset($_SESSION['errorGender']);
                unset($_SESSION['errorCountry']);
                unset($_SESSION['errorPostCode']);
                unset($_SESSION['errorEmail']);
                unset($_SESSION['errorUser']);
                unset($_SESSION['errorPass']);

                //updateActivity();
                header('location:index.php'); 

            }else{ //IF FAIL
                header('location:login.php'); 
                Handle_Login_Error($username);
            }
            
        }else{
            header('location:login.php'); 
            Handle_Login_Error($username);
        }

    
}else{ //USER DOESN'T EXIST
    header('location:login.php'); 
    Handle_Login_Error($username);
}

function Handle_Login_Error($username){
    global $con;
    
    $sql4 = "(SELECT memberUsername FROM member WHERE memberUsername='$username')";   
    $result4 = mysqli_query($con, $sql4) or die(mysqli_error($con));
    
        if(mysqli_num_rows($result4) == 0){
            $_SESSION['errorUser'] = 'Invalid Username'; 
        }else{
            $_SESSION['username'] = $username;
            $_SESSION['errorPass'] = 'Invalid Password'; 
        }
    header('location:login.php'); 
}

?>