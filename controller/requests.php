<?php
if (isset($_POST['getCompanyInfo'])) {
    $getCompanyInfo = $_POST['getCompanyInfo'];
    
    if ($getCompanyInfo == "true") {
        // some action goes here under php        
        define('DB_SERVER', 'remotemysql.com');
        define('DB_USERNAME', 'RXWuaQvtL6');
        define('DB_PASSWORD', 'w3tA3C2xKM');
        define('DB_NAME', 'RXWuaQvtL6');

        $destino = $empresa = $nombre = "";
        $destino = $_POST['destiny'];
        $empresa = $_POST["company"];
        $nombre = $_POST["name"];

        /* Attempt to connect to MySQL database */
        $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        if($empresa){
            $routeInfo = getRoutesCompany($nombre, $link); 
        }else if($destino){
            $routeInfo = getRoutesDestiny($nombre, $link);
        }else{
            echo "Error al obtener rutas"
        }
        echo json_encode($routeInfo);
    }
}
function getRoutesCompany($nombre, $link)
{
    $sql = "SELECT r.latitude, r.longitude from Route r inner join Company c on r.idCompany = c.idCompany WHERE c.name LIKE '"."$nombre"."'";

            $temporal = array();
            $array = array();
            if ($result = mysqli_query($link, $sql)) {
                while ($row = mysqli_fetch_assoc($result)) {  
                        array_push($temporal, $row["latitude"]);
                        array_push($temporal, $row["longitude"]);
                        array_push($array, $temporal);
                        $temporal = array();
                    }
                    return array();
            }
            else{
                echo "Algo salió mal. Intentelo de nuevo.";
            }
            mysqli_close($link);
}

function getRoutesDestiny($nombre, $link)
{
    $sql = "SELECT r.latitude, r.longitude from Route r inner join Company c on r.idCompany = c.idCompany WHERE c.destinyzone like '"."$nombre"."'";

            $temporal = array();
            $array = array();
            if ($result = mysqli_query($link, $sql)) {
                while ($row = mysqli_fetch_assoc($result)) {  
                        array_push($temporal, $row["latitude"]);
                        array_push($temporal, $row["longitude"]);
                        array_push($array, $temporal);
                        $temporal = array();
                    }
                    return array();
            }
            else{
                echo "Algo salió mal. Intentelo de nuevo.";
            }
            mysqli_close($link);
            // Attempt to execute the prepared statement
}
?>