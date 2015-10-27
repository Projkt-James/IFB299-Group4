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

    function formatBytes($bytes, $precision = 2) { 
        $units = array('B', 'KB', 'MB', 'GB', 'TB'); 

        $bytes = max($bytes, 0); 
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024)); 
        $pow = min($pow, count($units) - 1); 

        // Uncomment one of the following alternatives
        // $bytes /= pow(1024, $pow);
        $bytes /= (1 << (10 * $pow)); 

        return round($bytes, $precision) . ' ' . $units[$pow]; 
    } 
?>