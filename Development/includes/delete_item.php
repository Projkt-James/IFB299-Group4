<?php
include "../includes/connect.php";

if(isset($_POST['xval'])){
    $idValue = mysqli_real_escape_string($con, $_POST['xval']);
}

if(empty($idValue)){
    echo json_encode(array('status' => 'Failure', 'message' => 'Error: No item'));   
}else{
    
    //Checks Username Availiblity
    $sql_itemCheck = "SELECT * FROM media WHERE mediaID = '$idValue'"; 
    $itemCheck = mysqli_query($con, $sql_itemCheck) or die(mysqli_error($con)); //run the query 

    if(mysqli_num_rows($itemCheck) >= 0){
        
        $sql_itemDelete = "DELETE FROM media WHERE mediaID = '$idValue'"; 
        $itemDelete = mysqli_query($con, $sql_itemDelete) or die(mysqli_error($con)); //run the query 
        
        echo json_encode(array('status' => 'Success', 'message' => ''));
    }else{
        echo json_encode(array('status' => 'Failure', 'message' => 'Database Error: Item not found'));
    }
    
}
?>