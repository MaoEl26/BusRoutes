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
    $sql = "SELECT numroute FROM Route WHERE idCompany = " . "$id";
    $temporal = array();
    if ($result = mysqli_query($link, $sql)) {
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($temporal, $row['numroute']);
        }
        return $temporal;
    }

    mysqli_close($link);
}
?>