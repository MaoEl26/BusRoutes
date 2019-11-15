<?php
session_start();

if (isset($_POST['btnCambiarInfo'])) {
    setUserInfo($_SESSION["username"]);
}

function getUserInfo()
{
    define('DB_SERVER', 'remotemysql.com');
    define('DB_USERNAME', 'RXWuaQvtL6');
    define('DB_PASSWORD', 'w3tA3C2xKM');
    define('DB_NAME', 'RXWuaQvtL6');

    /* Attempt to connect to MySQL database */
    $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    
    $sql = "SELECT name,username,lastname1,lastname2,email FROM Users WHERE username = " . "'" . $_SESSION["username"] . "'";    
    $temporal = array();

    if ($result = mysqli_query($link, $sql)) {        
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($temporal, $row['name']);
            array_push($temporal, $row['lastname1']);
            array_push($temporal, $row['lastname2']);
            array_push($temporal, $row['email']);
        }
        return $temporal;
    }

    mysqli_close($link);
}

function setUserInfo($user)
{
    define('DB_SERVER', 'remotemysql.com');
    define('DB_USERNAME', 'RXWuaQvtL6');
    define('DB_PASSWORD', 'w3tA3C2xKM');
    define('DB_NAME', 'RXWuaQvtL6');

    /* Attempt to connect to MySQL database */
    $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    
    $nombre = trim($_POST["inputName"]);
    $lastname1 = trim($_POST["inputLastName1"]);
    $lastname2 = trim($_POST["inputLastName2"]);
    $correo = trim($_POST["inputEmail"]);

    $sql = "UPDATE `RXWuaQvtL6`.`Users` SET `name` = ?, `lastname1` = ?, lastname2 = ?, `email` = ? WHERE username = '" . $user . "'";

    if ($stmt = mysqli_prepare($link, $sql)) {

        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "ssss", $param_name, $param_lastname1, $param_lastname2, $param_email);
        // Set parameters
        //$param_id = 3;            

        $param_name = $nombre;
        $param_lastname1 = $lastname1;
        $param_lastname2 = $lastname2;
        $param_email = $correo;
        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            // Redirect to login page            
            header("Location: ../views/users/modifyUser.php");
            //------Crear registro en el log--------------------------------------- 

                        // Prepare an insert statement
                        $sql = "INSERT INTO `RXWuaQvtL6`.`Log`(`username`,`accion`,`fechaHora`) VALUES (?,?,CURRENT_TIMESTAMP);";

                        if ($stmt = mysqli_prepare($link, $sql)) {
                            // Bind variables to the prepared statement as parameters
                            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_accion);

                            // Set parameters
                            $param_username = $_SESSION["username"];
                            $param_accion = "Modificación de usuario";
                            
                            // Attempt to execute the prepared statement
                            if (mysqli_stmt_execute($stmt)) {
                                // Redirect to login page                
                                //header('Location: ../views/main.html');
                                echo "Log realizado";
                            } else {
                                echo "Algo salió mal. No se pudo realizar el registro en el log.";
                            }
                                            // Close statement
                            mysqli_stmt_close($stmt);
                        }else{
                            // Aqui se debe hacer un redirect al formulario de registro
                            // que indique los errores ya sea del password, username,
                            // o correo.
                        }

                        //------Termina Registro de Log--------------------------------------- 
        } else {
            echo "Algo salió mal. Intentelo de nuevo.";
            mysqli_stmt_close($stmt);
        }
    } else {
        echo "Error" . mysqli_error($link);
    }

    // Close statement
    mysqli_stmt_close($stmt);

    // Close connection
    mysqli_close($link);
}
