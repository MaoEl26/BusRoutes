<?php
require_once "./connection.php";
$data = $_REQUEST['data'];

/*if($_SERVER["REQUEST_METHOD"] == "POST") {

    $sql = "SELECT username FROM Users WHERE username = ?";
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        // Set parameters
        $param_id = trim($_POST["inputNumRuta"]);
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
             store result 
            mysqli_stmt_store_result($stmt);
            
            if(mysqli_stmt_num_rows($stmt) == 1){
                $id_err = "Este numero de ruta ya se encuentra registrad.";
            } else{
                $id = trim($_POST["inputNumRuta"]);
            }
        } else{
            echo "Algo salió mal. Intentelo de nuevo.";
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
*/



?>