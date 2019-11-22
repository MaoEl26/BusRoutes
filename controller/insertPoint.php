<?php
require_once './conection.php';

        $descripcion = trim($_POST['des']);
        $latitud = trim($_POST['lat']);
        $longitud = trim($_POST['lon']);
        $sql = "Insert into table(descripcion,lat,lon) Values(?,?,?)";
        
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "sss",$descripcion,$latitud,$longitud);
            if(mysqli_stmt_execute($stmt)){
                $sql = "INSERT INTO `RXWuaQvtL6`.`Log`(`username`,`accion`,`fechaHora`) VALUES (?,?,CURRENT_TIMESTAMP);";

                        if ($stmt = mysqli_prepare($link, $sql)) {
                            // Bind variables to the prepared statement as parameters
                            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_accion);

                            // Set parameters
                            $param_username = $_SESSION["username"];
                            $param_accion = "Punto Registrado";
                            
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
                        }
                    }else{
                        echo "Algo salió mal. Intentelo de nuevo.";
                    }
                }
                mysqli_stmt_close($stmt);
                mysqli_close($link);

?>