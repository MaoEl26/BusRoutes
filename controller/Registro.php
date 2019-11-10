<?php
// Include config file
require_once "connection.php";
 
// Define variables and initialize with empty values
$nombre = $apellido1 = $apellido2 = $password = $correo = $area = "";
$username_err = $password_err = $a1_err = $a2_err = $correo_err = $area_err = $id_err = $telefono_error = "";
$id = $telefono = 0;
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["id"]))){
        $id_err = "Ingrese un número de identificación";
    } else{
        // Prepare a select statement
        $sql = "SELECT idUsuario FROM Usuarios WHERE Identificacion = ?";
        
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
                    $id_err = "Esta identificación ya se encuentra registrada.";
                } else{
                    $id = trim($_POST["id"]);
                }
            } else{
                echo "Algo salió mal. Intentelo de nuevo.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }

        // Validate correo
        $correo = trim($_POST["correo"]);
        if(empty(trim($_POST["correo"]))){
            $correo_err = "El campo no puede estar vacío";
        }elseif (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            $correo_err = "Formato de correo inválido";
        }else{
            // Prepare a select statement
            $sql = "SELECT idUsuario FROM Usuarios WHERE Correo = ?";
            
            if($stmt = mysqli_prepare($link, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s", $param_correo);
                
                // Set parameters
                $param_correo = trim($_POST["correo"]);
                
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    /* store result */
                    mysqli_stmt_store_result($stmt);
                    
                    if(mysqli_stmt_num_rows($stmt) == 1){
                        $correo_err = "Este correo ya se encuentra registrado";
                    } else{
                        $correo = trim($_POST["correo"]);
                    }
                } else{
                    echo "Algo salió mal. Intentelo de nuevo.";
                }
            }
             
            // Close statement
            mysqli_stmt_close($stmt);
        }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Ingrese una contraseña.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "La contraseña debe tener mínimo 6 caracteres";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate nombre
    if(empty(trim($_POST["nombre"]))){
        $username_err= "Debe llenar el espacio.";     
    } else{
        $nombre = trim($_POST["nombre"]);
    }
    
    // Validate Apellido1
    if(empty(trim($_POST["apellido1"]))){
        $a1_err= "Debe llenar el espacio.";     
    } else{
        $apellido1 = trim($_POST["apellido1"]);
    }

     // Validate Apellido2
     if(empty(trim($_POST["apellido2"]))){
        $a2_err= "Debe llenar el espacio.";     
    } else{
        $apellido2 = trim($_POST["apellido2"]);
    }

    // Validate Area
    if(empty(trim($_POST["codigoArea"]))){
        $area_err= "Debe llenar el espacio.";     
    } else{
        $area = trim($_POST["codigoArea"]);
    }

    // Validate Telefono
    if(empty(trim($_POST["numTelefono"]))){
        $telefono_error= "Debe llenar el espacio.";     
    } else{
        $telefono = trim($_POST["numTelefono"]);
    }



    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($correo_err) && empty($id_err) && empty($a1_err) && empty($a2_err) && empty($area_err) && empty($telefono_error))
    {
        
        // Prepare an insert statement
        $sql = "CALL insertarUsuario(?,?,?,?,?,?,?,?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "issssssi", $param_id, $param_nombre, $param_a1 , $param_a2, $param_pass , $param_correo , $param_area , $param_telefono);
            
            // Set parameters
            $param_id = $id;
            $param_nombre = $nombre;
            $param_a1 = $apellido1;
            $param_a2 = $apellido2;
            $param_pass = $password;
            $param_correo = $correo;
            $param_area = $area;
            $param_telefono = $telefono;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");
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
?>