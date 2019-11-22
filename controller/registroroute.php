<?php

//$data = $_REQUEST['data'];
require_once "./connection.php";

// Define variables and initialize with empty values
$ruta = $descrip = $ticket = $time = $silla = $freq = $lat = $long = $inicio = $fin = $idCompany =  "";
$ruta_err  = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $sql = "SELECT numroute FROM Route WHERE numroute = ?";
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_numRuta);
        
        // Set parameters
        $param_numRuta = trim($_POST["inputNumRuta"]);
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){

            mysqli_stmt_store_result($stmt);

            if(mysqli_stmt_num_rows($stmt) == 1){
                $ruta_err = "Este numero de ruta ya se encuentra registrada.";
            } else{
                $ruta = trim($_POST["inputNumRuta"]);
            }
        } else{
            echo "Algo salió mal. Intentelo de nuevo.";
        }
    }
    // Close statement
    mysqli_stmt_close($stmt);

    $descrip = trim($_POST["inputDescripcion"]);
    $ticket = trim($_POST["inputCost"]);
    $inicio = trim($_POST["inputHoraInicio"]);
    $fin = trim($_POST["inputHoraFinal"]);
    $freq = trim($_POST["inputFrecuencia"]);
    $time = trim($_POST["inputDuracion"]);
    $silla = $_POST["inputDiscapacidad"];
    $long = trim($_POST["lng"]);
    $lat = trim($_POST["lat"]);
    $idCompany = trim($_POST["inputCompany"]);

    if(empty($ruta_err))
    {   
        $sql = "INSERT INTO Route(numroute,description,ticketCost,durationtime,disability,frecuency,latitude,longitude,starttime,finishtime,idCompany)Values(?,?,?,?,?,?,?,?,?,?,?)";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssisssssi", $param_ruta,$param_descrip,$param_ticket,$param_time,$param_silla,$param_freq,$param_lat,$param_long,$param_inicio,$param_fin,$param_company);
            
            // Set parameters
            //$param_id = 2;
            $param_ruta = $ruta;
            $param_descrip = $descrip;
            $param_ticket = $ticket;
            $param_time = $time;
            $param_silla = $silla;
            $param_freq = $freq;
            $param_lat = $lat;
            $param_long = $long;
            $param_inicio = $inicio;
            $param_fin = $fin;
            $param_company = $idCompany;

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                //------Crear registro en el log--------------------------------------- 

                        // Prepare an insert statement
                        $sql = "INSERT INTO `RXWuaQvtL6`.`Log`(`username`,`accion`,`fechaHora`) VALUES (?,?,CURRENT_TIMESTAMP);";

                        if ($stmt = mysqli_prepare($link, $sql)) {
                            // Bind variables to the prepared statement as parameters
                            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_accion);

                            // Set parameters
                            $param_username = $_SESSION["username"];
                            $param_accion = "Registro de ruta";
                            
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
                header("location: ../views/busRoutes/registerRoute.php");
                 
            } else{
                echo "Algo salió mal. Intentelo de nuevo.";
            }
        }
        // Close statement
        mysqli_stmt_close($stmt);
    }else{
        //header("location: ../views/busRoutes/registerRoute.php");
        //Validar Mensaje de error
        echo $ruta_err;
    }
// Close connection
mysqli_close($link);
    
}
?>