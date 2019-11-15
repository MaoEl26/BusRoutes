<?php

if (isset($_POST['getLogInfo'])) {
    $getLogInfo = $_POST['getLogInfo'];
    
    if ($getLogInfo == "true") {
        // some action goes here under php        
        define('DB_SERVER', 'remotemysql.com');
        define('DB_USERNAME', 'RXWuaQvtL6');
        define('DB_PASSWORD', 'w3tA3C2xKM');
        define('DB_NAME', 'RXWuaQvtL6');
   
        /* Attempt to connect to MySQL database */
        
        $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

        $logInfo = getRoutes($_POST['startDate'],$_POST['endDate'], $link);        
        echo "prueba";
        echo json_encode($logInfo);

    }
}


function getRoutes($start,$end, $link)
{
    //require_once "../../controller/connection.php";
    $sql = "SELECT username,accion,fechaHora from log where fechaHora between"."$start". "And" ."$end";
    $temporal = array();
    $array = array();
    if ($result = mysqli_query($link, $sql)) {
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($temporal, $row['username']);
            array_push($temporal, $row['acccion']);
            array_push($temporal, $row['fechaHora']);
            array_push($array, $temporal);
            $temporal = array();
        }
        return $array;
    }

    mysqli_close($link);
}



?>