<?php

if (isset($_POST['getUserInfo'])) {
    $getUserInfo = $_POST['getUserInfo'];
    
    if ($getUserInfo == "true") {
        // some action goes here under php        
        define('DB_SERVER', 'remotemysql.com');
        define('DB_USERNAME', 'RXWuaQvtL6');
        define('DB_PASSWORD', 'w3tA3C2xKM');
        define('DB_NAME', 'RXWuaQvtL6');

        /* Attempt to connect to MySQL database */
        $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

        $userInfo = getUserInfo($_POST['username'], $link);        
        
        echo json_encode($userInfo);
    }
}

public function getUserInfo($user,$link)
{
    $sql = "SELECT name,lastname1,lastname2,email from Users"

    if ($result = mysqli_query($link, $sql)) {
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($temporal, $row['name']);
            array_push($temporal, $row['lastname1']);
            array_push($temporal, $row['lastname2']);
        }
        return $temporal;
    }

    mysqli_close($link);

}
 
public function getUserInfo($user,$link)
{
    $nombre = trim($_POST["inputName"]);
    $lastname1 = trim($_POST["inputLastName1"]);
    $lastname2 = trim($_POST["inputLastName2"]);
    $correo = trim($_POST["inputEmail"]);

    $sql = "UPDATE name,lastname1,lastname2,email from Users"

    $sql = "UPDATE `RXWuaQvtL6`.`Users` SET `name` = ?, `lastname1` = ?, lastname2 = ?, `email` = ?"; 
        if($stmt = mysqli_prepare($link, $sql)){
           
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssss", $param_name,$param_lastname1,$param_lastname2,$param_email);
            // Set parameters
            //$param_id = 3;            
            
            $param_name = $nombre;
            $param_lastname1 = $lastname1;
            $param_lastname2 = $lastname2;
            $param_email = $correo;
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("Location: ../views/companies/modifyUser.php");
                
            } else{
                echo "Algo salió mal. Intentelo de nuevo.";
                mysqli_stmt_close($stmt);
    }
}else {
    echo "Error". mysqli_error($link);

}
        
        // Close statement
        mysqli_stmt_close($stmt);

    // Close connection
    mysqli_close($link);

?>