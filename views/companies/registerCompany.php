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
  <?php
    session_start();
    if(!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)){
      header('Location: ../login.html');
      exit;
    }
  ?>
    <div id="nav-placeholder">

      </div>

 <div class="container" style="background-color: rgb(100,100,100); ">
 </div>
 <div>
    <br>
    <br>
    <h3 class="login-heading mb-4" style="text-align: center; ">Agregar Empresa</h3>
     <div class="container" style="width: 500px">
    <form action="../../controller/registerCompany.php" method="POST" >
          <div class="form-label-group" >
              <input type="text" name="inputName" id = "inputName" class="form-control" placeholder="Nombre" autofocus required>
              <label for="inputName">Nombre</label>
          </div>
          <div class="form-label-group" >
              <input type="text" name="inputNumTelefono" id="inputNumTelefono" class="form-control" placeholder="Número de Teléfono" required>
              <label for="inputNumTelefono">Número de Teléfono</label>
          </div>
          <div class="form-label-group" >
              <input type="text" name="inputEmail" id="inputEmail" class="form-control" placeholder="Correo" required>
              <label for="inputEmail">Correo</label>
          </div>
          <div>
            <h4 class="login-heading mb-4" style="text-align: center;">Zona de Servicio</h4>
            <div class="form-label-group" >
                <input type="text" name="inputZonaOrigen" id="inputZonaOrigen" class="form-control" placeholder="Origen" required>
                <label for="inputZonaOrigen">Zona Origen</label>
            </div>
            <div class="form-label-group">
                <input type="text" name="inputZonaDestino" id="inputZonaDestino" class="form-control" placeholder="Destino" required>
                <label for="inputZonaDestino">Zona Destino</label>
            </div>
          </div>
          <div>
                <h4 class="login-heading mb-4" style="text-align: center;">Dirección de la Terminal u Oficina</h4>
                <h5 class="login-heading mb-4">Ubicación en el mapa</h5>
                <div class="form-label-group" style="background-color: rgb(100,100,100);  ">
                  <div id="mapid" class="container-fluid" style="height: 200px;  ">
                    

                    
                  </div>
                  
                </div>
                <div class="form-label-group">
                    <input type="text" name="inputDireccionSenna" id="inputDireccionSenna" class="form-control" placeholder="Dirección" required>
                    <label for="inputDireccionSenna">Dirección exacta</label>
                    <input type="hidden" name="lat" id="lat" class="form-control" readonly>
                    <input type="hidden" name="lng" id="lng" class="form-control" readonly>
                </div>
          </div>
          <div>
            <h4 class="login-heading mb-4" style="text-align: center;">Horario de Atención</h4> 
            <div class="form-group">
                    <label for="inputDiasSemana">Seleccione los días</label>
                    <select name="inputDiasSemana[]" class="form-control" multiple>
                        <option>Lunes</option>
                        <option>Martes</option>
                        <option>Miercoles</option>
                        <option>Jueves</option>
                        <option>Viernes</option>
                        <option>Sábado</option>
                        <option>Domingo</option>
                    </select>
                </div>
            <div>
            <div class="form-label-group">
                <input type="time" name="inputHoraApertura" id="inputHoraApertura" class="sm-2 form-control" placeholder="Apertura" size="4" required>
                <label for="inputHoraApertura">Hora Apertura</label>
            </div>
            <div class="form-label-group">
                    <input type="time" name="inputHoraCierre" id="inputHoraCierre" class="form-control" placeholder="Cierre" size="4" required>
                    <label for="inputHoraCierre">Hora Cierre</label>
            </div>
            </div>
          </div>
          <h5 class="login-heading mb-4" style="text-align: center;">Reportes</h5>
            <div class="form-label-group">
                    <input type="text" name="inputContactoAnomalias" id="inputContactoAnomalias" class="form-control" placeholder="Contacto Anomalías" required>
                    <label for="inputContactoAnomalias">Contacto Anomalías</label>
                </div>
          <button class="btn btn-lg btn-primary btn-block btn-login text-uppercase font-weight-bold mb-2" type="submit" >Guardar</button>
            <div class="text-center">
              
      </form>
  
      </div>
  </div>
  <script src="../../public/mapCompany.js"></script>
 <script>
    $(function(){
      $("#nav-placeholder").load("../../public/nav.html");
    });
    </script>
  
    
  
  

</body>
</html>