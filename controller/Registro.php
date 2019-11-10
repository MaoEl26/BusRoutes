<?php
// Include config file
require_once "./connection.php";
 
// Define variables and initialize with empty values
$nombre = $apellido1 = $apellido2 = $password = $correo = $id=  "";
$password_err = $correo_err = $id_err  = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    // Validate username
    if(empty(trim($_POST["inputUserName"]))){
        $id_err = "Ingrese un número de identificación";
    } else{
        $sql = "SELECT username FROM Users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            // Set parameters
            $param_id = trim($_POST["id"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $id_err = "Este usuario ya se encuentra registrad.";
                } else{
                    $id = trim($_POST["inputUserName"]);
                }
            } else{
                echo "Algo salió mal. Intentelo de nuevo.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }

        // Validate correo
        if(empty(trim($_POST["inputEmail"]))){
            $correo_err = "El campo no puede estar vacío";
        }else{
            // Prepare a select statement
            $sql = "SELECT username FROM Users WHERE email = ?";
            
            if($stmt = mysqli_prepare($link, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s", $param_correo);
                
                // Set parameters
                $param_correo = trim($_POST["inputEmail"]);
                
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    /* store result */
                    mysqli_stmt_store_result($stmt);
                    
                    if(mysqli_stmt_num_rows($stmt) == 1){
                        $correo_err = "Este correo ya se encuentra registrado";
                    } else{
                        $correo = trim($_POST["inputEmail"]);
                    }
                } else{
                    echo "Algo salió mal. Intentelo de nuevo.";
                }
            }
             
            // Close statement
            mysqli_stmt_close($stmt);
        }
    
    // Validate password
    if(strlen(trim($_POST["password"])) < 6){
        $password_err = "La contraseña debe tener mínimo 6 caracteres";
    } else{
        $password = trim($_POST["password"]);
    
    // Validate nombre
    $nombre = trim($_POST["nombre"]);

    $apellido1 = trim($_POST["apellido1"]);
    
    $apellido2 = trim($_POST["apellido2"]);


    // Check input errors before inserting in database
    if(empty($password_err) && empty($id_err) && empty($correo_err))
    {
        
        // Prepare an insert statement
        $sql = "INSERT INTO `RXWuaQvtL6`.`Users`(`username`, `name`, `lastname1`, `lastname2`, `email`, `password`,`Active`) VALUES (?,?,?,?,?,?,?)";
        $active = 1;
        //$sql = "CALL insertarUsuario(?,?,?,?,?,?,?,?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssssi", $param_id, $param_nombre, $param_a1 , $param_a2, $param_pass , $param_correo , $param_area , $param_telefono);
            
            // Set parameters
            $param_id = $id;
            $param_nombre = $nombre;
            $param_a1 = $apellido1;
            $param_a2 = $apellido2;
            $param_pass = $password;
            $param_correo = $correo;
            $param_telefono = $active;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: ../views/login.html");
            } else{
                echo "Algo salió mal. Intentelo de nuevo.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
        // Prepa
?>