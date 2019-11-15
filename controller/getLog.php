<?php

if (isset($_POST['getLogInfo'])) {
    $getLogInfo = $_POST['getLogInfo'];
    
    if ($getLogInfo == "true") {
        // some action goes here under php      
        /*define('DB_SERVER', 'remotemysql.com');
        define('DB_USERNAME', 'RXWuaQvtL6');
        define('DB_PASSWORD', 'w3tA3C2xKM');
        define('DB_NAME', 'RXWuaQvtL6');*/
        define('DB_SERVER', '127.0.0.1');
        define('DB_USERNAME', 'root');
        define('DB_PASSWORD', '');
        define('DB_NAME', 'labPHP');
   
        /* Attempt to connect to MySQL database */
        
        $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

        //$logInfo = getRoutes($_POST['startDate'],$_POST['endDate'], $link);  
        
        $logInfo = getRoutes('2019-11-13 00:00:00','2019-11-15 23:00:00', $link); 
        echo json_encode($logInfo);

    }
}


function getRoutes($start,$end, $link)
{

    $sql = "SELECT username,accion,fechaHora from Log where fechaHora between ? AND ?";
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "ss", $paramInicio, $paramFinal);

        // Set parameters
        $paramInicio = $start;
        $paramFinal = $end;
        $temporal = array();
        $array = array();
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){

            mysqli_stmt_store_result($stmt);
            $resultado = mysqli_stmt_get_result($stmt);
            
            
            if(mysqli_stmt_num_rows($stmt) >= 1){

                while ($row = mysqli_fetch_array($stmt)) {
                //while($row = ->fetch_assoc() !== null){    
                    array_push($temporal, $row["username"]);
                    array_push($temporal, $row["acccion"]);
                    array_push($temporal, $row["fechaHora"]);
                    array_push($array, $temporal);
                    $temporal = array();
                }
                return $array;
            } else{
                echo "No hay";
            }/*
            */
        } else{
            echo "Algo salió mal. Intentelo de nuevo.";
        }
    }
    // Close statement
    mysqli_stmt_close($stmt);
}



?>