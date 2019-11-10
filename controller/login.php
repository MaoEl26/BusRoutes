<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: ./main.html");
    exit;
}
 
// Include config file
require_once "connection.php";
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    $username = trim($_POST["inputUser"]);

    $password = trim($_POST["inputPassword"]);

    // Prepare a select statement
    $sql = "SELECT username,`password` FROM Users WHERE username = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $param_username);
        
        // Set parameters
        $param_username = $username;
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            // Store result
            mysqli_stmt_store_result($stmt);
            
            // Check if username exists, if yes then verify password
            if(mysqli_stmt_num_rows($stmt) == 1){                    
                // Bind result variables
                mysqli_stmt_bind_result($stmt, $username, $hashed_password);
                if(mysqli_stmt_fetch($stmt)){
                    if($password == $hashed_password){
                        // Password is correct, so start a new session
                        session_start();
                        
                        // Store data in session variables
                        $_SESSION["loggedin"] = true;
                        $_SESSION["username"] = $username;                            
                        
                        // Close statement
                        mysqli_stmt_close($stmt);
                        // Redirect user to welcome page
                        header("location: ./main.php");


                    } else{
                        // Display an error message if password is not valid
                        $password_err = "La contraseña no es válida.";
                    }
                }
            } else{
                // Display an error message if username doesn't exist
                $username_err = "No se pudo encontrar un usuario con este correo.";
            }
        } else{
            echo "Algo salió mal. Intentelo de nuevo.";
        }
    }
    
    
}

// Close connection
mysqli_close($link);
}
?>