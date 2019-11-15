<?php
// Include config file 
// Define variables and initialize with empty values
$nombre = $apellido1 = $apellido2 = $password = $correo = $id =  "";
$password_err = $correo_err = $id_err  = "";

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

        $companyInfo = getData($_POST['company'], $link);        
        echo json_encode($companyInfo);
    }
}

function getData($id, $link)
{
    //require_once "../../controller/connection.php";
    $sql = "SELECT idCompany, name, phone, sourcezone, destinyzone, 
    email,anomalycontact,addresssigns,latitude,longitude,
    daysattention,openingtime,closingtime 
    FROM Company WHERE idCompany = " . "$id";
    $array = array();
    $temporal = array();
    if ($result = mysqli_query($link, $sql)) {
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($temporal, $row['idCompany']);
            array_push($temporal, $row['name']);
            array_push($temporal, $row['phone']);
            array_push($temporal, $row['sourcezone']);
            array_push($temporal, $row['destinyzone']);
            array_push($temporal, $row['email']);
            array_push($temporal, $row['anomalycontact']);
            array_push($temporal, $row['addresssigns']);
            array_push($temporal, $row['latitude']);
            array_push($temporal, $row['longitude']);
            array_push($temporal, $row['daysattention']);
            array_push($temporal, $row['openingtime']);
            array_push($temporal, $row['closingtime']);
            //array_push($array, $temporal);
            //$temporal = array();
        }
        return $temporal;
    }

    mysqli_close($link);
}


function getCompanies()
{
    require_once "../../controller/connection.php";
    $sql = "SELECT idCompany,name FROM Company";
    $array = array();
    $temporal = array();
    if ($result = mysqli_query($link, $sql)) {
        while ($row = mysqli_fetch_assoc($result)) {
            //$id = $row['username'];
            array_push($temporal, $row['idCompany']);
            array_push($temporal, $row['name']);
            array_push($array, $temporal);
            $temporal = array();
        }
        return $array;
    }
    mysqli_close($link);
}
?>