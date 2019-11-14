<?php
require_once "./connection.php";

$correo_err = "";
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST") {
    

    // Prepare a select statement
    $nombre = trim($_POST["inputName"]);
    $numTelefono = trim($_POST["inputNumTelefono"]);
    $correo = trim($_POST["inputEmail"]);
    $origen = trim($_POST["inputZonaOrigen"]);

    $destino = trim($_POST["inputZonaDestino"]);

    $direccion = trim($_POST["inputDireccionSenna"]);
    
    $latitude = trim($_POST["inputDireccionSenna"]);
    $longitud = trim($_POST["inputDireccionSenna"]);
   

    $dias = $_POST["inputDiasSemana"];
    $stringDias = implode(',', $dias); // Convierte el array de días a string separado por comas.
    //var_dump($stringDias);
    
    $apertura = trim($_POST["inputHoraApertura"]);
    $cierre = trim($_POST["inputHoraCierre"]);

    $anomalias = trim($_POST["inputContactoAnomalias"]);

    // Check input errors before inserting in database
    
        
        // Prepare an insert statement
        $sql = "UPDATE `RXWuaQvtL6`.`Company` SET `phone` = ?, `sourcezone` = ?, destinyzone = ?, `email` = ?,`anomalycontact`= ?,`addresssigns`= ?,`latitude` = ?,`longitude` = ? ,`daysattention` = ? ,`openingtime` = ? ,`closingtime` = ?  where name = ?";
         
        if($stmt = mysqli_prepare($link, $sql)){
           
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssssssssss", $param_phone,$param_sourcezone,$param_destinyzone,$param_email,$param_anomalycontact,$param_addresssigns,$param_latitude,$param_longitude,$param_daysattention,$param_openingtime,$param_closingtime, $param_name);
            
            // Set parameters
            //$param_id = 3;            
            
            $param_phone = $numTelefono;
            $param_sourcezone = $origen;
            $param_destinyzone = $destino;
            $param_email = $correo;
            $param_anomalycontact = $anomalias;
            $param_addresssigns = $direccion;
            $param_latitude = $direccion;
            $param_longitude = $direccion;
            $param_daysattention = $stringDias;
            $param_openingtime = $apertura;
            $param_closingtime = $cierre;
            $param_name = $nombre;
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("Location: ../views/companies/modify_Company.php");
                
            } else{
                echo "Algo salió mal. Intentelo de nuevo.";
                mysqli_stmt_close($stmt);
    }
}else {
    echo "Error". mysqli_error($link);

}
        
        echo $correo_err;
        // Close statement
        
    // Close connection
    mysqli_close($link);
}

?>
