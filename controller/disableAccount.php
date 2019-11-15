<?php
session_start();

if (isset($_POST['btnDeshabilitar'])) {
    setUserInfo($_SESSION["username"]);
    //echo "me le cago malparido";
}

function setUserInfo($user)
{
    define('DB_SERVER', 'remotemysql.com');
    define('DB_USERNAME', 'RXWuaQvtL6');
    define('DB_PASSWORD', 'w3tA3C2xKM');
    define('DB_NAME', 'RXWuaQvtL6');

    /* Attempt to connect to MySQL database */
    $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    
    $sql = "UPDATE `RXWuaQvtL6`.`Users` SET `Active` = ? WHERE username = '" . $user . "'";

    $active = 0;
    if ($stmt = mysqli_prepare($link, $sql)) {

        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_Active);
        // Set parameters
        //$param_id = 3;            

        $param_Active = $active;

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            // Redirect to login page            
            header("Location: ../views/login.html");
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
?>