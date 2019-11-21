<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" type="text/css" href="../../public/css/logIn.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
  <script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js"></script>
  <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
  <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>

  <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
  <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>


  <title></title>

</head>

<body>  
    <div id="nav-placeholder">
    </div>
  <?php 
    session_start();
    if(!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)){
      header('Location: ../login.html');
      exit;
    }
    include_once '../../controller/getCompanies.php';
    $companies = getCompanies();
   //var_dump($companies);
  ?>
 <div class="container" style="background-color: rgb(100,100,100); ">
 </div>
 <div>
    <br>
    <br>
    <h3 class="login-heading mb-4" style="text-align: center; ">Agregar Ruta</h3>
     <div class="container" style="width: 900px">
     <?php
        if(!empty($ruta_error)){
          echo '<div class="alert alert-danger"> <strong>Atención! </strong>'.$ruta_error."</div>";
        }
     ?>
    <form  method="POST" action="../../controller/registroRoute.php">
          <div class="form-group" >
              <label for="inputCompany">Seleccione la empresa a la que pertenece</label>
              <select name="inputCompany" id="inputCompany" class="form-control">
              <option value="" selected>Ninguna empresa seleccionada</option>
              <?php 
                foreach ($companies as $company) {
                 echo '<option value="'. $company[0].'" onclick="">'. $company[1] ."</option>";
                }
              ?>
              </select>
          </div>
          <div class="form-label-group" >
              <input type="text" name="inputNumRuta" id = "inputNumRuta" class="form-control" placeholder="Número Ruta" autofocus required>
              <label for="inputNumRuta">Número Ruta</label>
          </div>
          <div class="form-label-group" >
              <input type="text" name="inputDescripcion" id="inputDescripcion" class="form-control" placeholder="Descripción" required>
              <label for="inputDescripcion">Descripción</label>
          </div>
          <div class="form-label-group" >
              <input type="text" name="inputCost" id="inputCost" class="form-control" placeholder="Costo" required>
              <label for="inputCost">Costo Pasaje</label>
          </div>
          <div>
            <h4 class="login-heading mb-4" style="text-align: center;">Horario de Servicio</h4>
            <div class="form-label-group">
                    <input type="time" name="inputHoraInicio" id="inputHoraInicio" class="form-control" placeholder="Inicio" required>
                    <label for="inputHoraInicio">Hora Inicio</label>
            </div>
            <div class="form-label-group">
                    <input type="time" name="inputHoraFinal" id="inputHoraFinal" class="form-control" placeholder="Fin" required>
                    <label for="inputHoraFinal">Hora Fin</label>
            </div>
            <div class="form-label-group">
                    <input type="text" name="inputFrecuencia" id="inputFrecuencia" class="form-control" placeholder="Frecuencia" required>
                    <label for="inputFrecuencia">Frecuencia de Salida</label>
            </div>
          </div>
          <div class="form-label-group">
                <input type="text" name="inputDuracion" id="inputDuracion" class="form-control" placeholder="Duración" required>
                <label for="inputDuracion">Duración del viaje</label>
        </div>
        <div class="form-label-group">
                <input type="checkbox" name="inputDiscapacidad" id="inputDiscapacidad" value="1" placeholder="Discapacidad">
                <label for="inputDiscapacidad" class="login-heading mb-2"><h6>Posee transporte para personas con Discapacidad </h6></label>
        </div>
          <div>
                <h4 class="login-heading mb-2" style="text-align: center;">Ruta del Viaje</h4>
                <div class="form-label-group" >
                  <div id="mapid" class="container-fluid" style="height: 600px;  ">
                
                  </div>  

                </div>
                <button class="btn btn-lg btn-secondary btn-block btn-login text-uppercase font-weight-bold mb-2" Type= "button" onclick="getCoordinates()" >Guardar Mapa</button>
                <input type="hidden" name="lat" id="lat" class="form-control" readonly>
                <input type="hidden" name="lng" id="lng" class="form-control" readonly>
                
          </div>
          <br>
          <button class="btn btn-lg btn-primary btn-block btn-login text-uppercase font-weight-bold mb-2" type="submit"  name ="save"  >Guardar</button>
              
      </form>
  
      
      </div>
  </div>
  <script src="../../public/mapRoutes.js"></script>
 <script>
    $(function(){
      $("#nav-placeholder").load("../../public/nav.html");
    });
    </script>
  
    
  
  

</body>
</html>