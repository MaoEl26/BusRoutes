<?php
if (isset($_POST['getCompanyInfo'])) {
    $getCompanyInfo = $_POST['getCompanyInfo'];
    
    if ($getCompanyInfo == "true") {
        // some action goes here under php        
        define('DB_SERVER', 'remotemysql.com');
        define('DB_USERNAME', 'RXWuaQvtL6');
        define('DB_PASSWORD', 'w3tA3C2xKM');
        define('DB_NAME', 'RXWuaQvtL6');
        /* Attempt to connect to MySQL database */
        $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        $routeInfo = getRoutes($_POST['company'], $link);        
        
        echo json_encode($routeInfo);
    }
}
function getRoutes($id, $link)
{
    //require_once "../../controller/connection.php";
    $sql = "SELECT numroute,description,ticketCost,durationtime,
    disability,frecuency,latitude,longitude,starttime,finishtime 
    FROM Route WHERE numroute = " . "$id";
    $temporal = array();
    if ($result = mysqli_query($link, $sql)) {
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($temporal, $row['numroute']);
            array_push($temporal, $row['description']);
            array_push($temporal, $row['ticketCost']);
            array_push($temporal, $row['durationtime']);
            array_push($temporal, $row['disability']);
            array_push($temporal, $row['frecuency']);
            array_push($temporal, $row['latitude']);
            array_push($temporal, $row['longitude']);
            array_push($temporal, $row['starttime']);
            array_push($temporal, $row['finishtime']);
        }
        return $temporal;
    }
    mysqli_close($link);
}
?>