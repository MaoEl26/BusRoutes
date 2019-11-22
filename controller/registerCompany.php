<?php
// Include config file
session_start();
require_once "./connection.php";
// Define variables and initialize with empty values
$nombre = $numTelefono = $origen = $destino = $correo = $numTelefono = $direccion = $dias = "" ;
$latitude = $longitud = $apertura = $cierre = $anomalias = "";
$correo_err = $id_err  = ""; 


// Processing form data when form is submitted

if($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $sql = "SELECT name FROM Company WHERE name = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        // Set parameters
        $param_id = trim($_POST["inputName"]);
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
             
            mysqli_stmt_store_result($stmt);
            
            if(mysqli_stmt_num_rows($stmt) == 1){
                $id_err = "Esta compañia ya se encuentra registrada.";
            } else{
                $nombre = trim($_POST["inputName"]);
            }
        } else{
            echo "Algo salió mal. Intentelo de nuevo.";
        }
    }
        
    // Close statement
    mysqli_stmt_close($stmt);

    // Prepare a select statement
    $sql = "SELECT name FROM Company WHERE email = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $param_correo);
        
        // Set parameters
        $param_correo = trim($_POST["inputEmail"]);
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            
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
    
    
    $numTelefono = trim($_POST["inputNumTelefono"]);
    
    $origen = trim($_POST["inputZonaOrigen"]);

    $destino = trim($_POST["inputZonaDestino"]);

    $direccion = trim($_POST["inputDireccionSenna"]);
    
    $latitude = trim($_POST["lat"]);
    $longitud = trim($_POST["lng"]);

    $dias = $_POST["inputDiasSemana"];
    $stringDias = implode(',', $dias); // Convierte el array de días a string separado por comas.
    //var_dump($stringDias);
    
    $apertura = trim($_POST["inputHoraApertura"]);
    $cierre = trim($_POST["inputHoraCierre"]);

    $anomalias = trim($_POST["inputContactoAnomalias"]);

    
    $id_err = "";
    $correo_err  = "";

    // Check input errors before inserting in database
    if(empty($id_err) && empty($correo_err))
    {
        
        // Prepare an insert statement
        $sql = "INSERT INTO `RXWuaQvtL6`.`Company`(`name`, `phone`, `sourcezone`, `destinyzone`, `email`,`anomalycontact`,`addresssigns`,`latitude`,`longitude`,`daysattention`,`openingtime`,`closingtime`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
           
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssssssssss", $param_name,$param_phone,$param_sourcezone,$param_destinyzone,$param_email,$param_anomalycontact,$param_addresssigns,$param_latitude,$param_longitude,$param_daysattention,$param_openingtime,$param_closingtime);
            
            // Set parameters
            //$param_id = 3;            
            $param_name = $nombre;
            $param_phone = $numTelefono;
            $param_sourcezone = $origen;
            $param_destinyzone = $destino;
            $param_email = $correo;
            $param_anomalycontact = $anomalias;
            $param_addresssigns = $direccion;
            $param_latitude = $latitude;
            $param_longitude = $longitud;
            $param_daysattention = $stringDias;
            $param_openingtime = $apertura;
            $param_closingtime = $cierre;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                //------Crear registro en el log--------------------------------------- 

                        // Prepare an insert statement
                        $sql = "INSERT INTO `RXWuaQvtL6`.`Log`(`username`,`accion`,`fechaHora`) VALUES (?,?,CURRENT_TIMESTAMP);";

                        if ($stmt = mysqli_prepare($link, $sql)) {
                            // Bind variables to the prepared statement as parameters
                            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_accion);

                            // Set parameters
                            $param_username = $_SESSION["username"];
                            $param_accion = "Registro de compañía";
                            
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
                // Redirect to login page
                header("Location: ../views/companies/registerCompany.html");
                
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