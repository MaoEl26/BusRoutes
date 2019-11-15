<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect to login page
/*if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header('Location: ../views/main.html');
    exit;
    

}*/
 
// Include config file
require_once "connection.php";
 
// Define variables and initialize with empty values
$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = $confirm_pass ="";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate new password
    if(empty(trim($_POST["inputNewPassword"]))){
        $new_password_err = "Por favor ingrese la nueva contraseña.";     
    } elseif(strlen(trim($_POST["inputNewPassword"])) < 6){
        $new_password_err = "La contraseña debe tener mínimo 6 caracteres.";
    } else{
        $new_password = trim($_POST["inputNewPassword"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["inputPasswordConfirm"]))){
        $confirm_password_err = "Por favor confirme la contraseña.";
    } else{
        $confirm_password = trim($_POST["inputPasswordConfirm"]);
        if(empty($new_password_err) && ($new_password != $confirm_password)){
            $confirm_password_err = "Las contraseñas no coinciden.";
        }
    }
        
    // Check input errors before updating the database
    if(empty($new_password_err) && empty($confirm_password_err)){
        // Prepare an update statement
        $sql = "UPDATE `RXWuaQvtL6`.`Users` SET `password` = ? WHERE `username` = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_password, $param_id);
            
            // Set parameters
            $param_password = $new_password;
            $param_id = $_SESSION["username"];
            debug_to_console("Test");
            debug_to_console($param_id);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Password updated successfully. Destroy the session, and redirect to login page
                $confirm_pass = "Cambio de contraseña exitoso.";
                session_destroy();
                exit();
                // Close statement
                mysqli_stmt_close($stmt);
            } else{
                echo "Algo salió mal. Intentelo de nuevo.";
            }
        }
        
        
    }
    
    // Close connection
    mysqli_close($link);
}

function debug_to_console($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}

?>