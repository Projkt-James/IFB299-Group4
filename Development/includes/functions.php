<?php 

    //Function to return contents of session
    function getField($session){
    if (isset($_SESSION[$session])){
            $field = $_SESSION[$session];
            unset($_SESSION[$session]); 
        return $field;
    }else{
        return "";
    }
        
}
?>