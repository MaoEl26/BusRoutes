<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header('Location: ../views/main.html');
    exit;
}
 
// Include config file
require_once "./connection.php";
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    $username = trim($_POST["inputUser"]);

    $password = trim($_POST["inputPassword"]);

    // Prepare a select statement
    $sql = "SELECT username,`password`,Active FROM Users WHERE username = ?";
    
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
                mysqli_stmt_bind_result($stmt, $username, $hashed_password,$active);
                if(mysqli_stmt_fetch($stmt)){
                    if($password == $hashed_password && $active==1){
                        // Password is correct, so start a new session
                        session_start();
                        
                        // Store data in session variables
                        $_SESSION["loggedin"] = true;
                        $_SESSION["username"] = $username;                            
                        
                        // Close statement
                        mysqli_stmt_close($stmt);
                        // Redirect user to welcome page
                        header('Location: ../views/main.html');

                        //------Crear registro en el log--------------------------------------- 

                        // Prepare an insert statement
                        $sql = "INSERT INTO `RXWuaQvtL6`.`Log`(`username`,`accion`,`fechaHora`) VALUES (?,?,CURRENT_TIMESTAMP);";

                        if ($stmt = mysqli_prepare($link, $sql)) {
                            // Bind variables to the prepared statement as parameters
                            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_accion);

                            // Set parameters
                            $param_username = $_SESSION["username"];
                            $param_accion = "Inicio de Sesión";
                            
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

                    } else{
                        // Display an error message if password is not valid
                        $password_err = "La contraseña no es válida.";
                        echo "La contraseña no es válida.";
                    }
                }
                else{
                // Display an error message if username doesn't exist
                $username_err = "No se pudo encontrar un usuario con este correo.";
                echo "No se pudo encontrar un usuario con este correo.";
            }
        } else{
            echo "Algo salió mal. Intentelo de nuevo.";
            
         }
    }
    
    
}
}


// Close connection
    mysqli_close($link);

    function debug_to_console($data) {
        $output = $data;
        if (is_array($output))
            $output = implode(',', $output);
    
        echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
    }

?>