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

 <div class="container" style="background-color: rgb(100,100,100); ">
 	


 </div>
 <div>
    <br>
    <br>
    <h3 class="login-heading mb-4" style="text-align: center; ">Modificar Ruta</h3>
     <div class="container-fluid" style="width: 700px">
    <form action="/modifyRoute" method="POST" >
          <div class="form-group" >
              <label for="inputCompany">Seleccione la empresa</label>
              <select name="inputCompany" id="inputCompany" class="form-control">
              </select>
          </div>
          <div class="form-group" >
              <label for="inputRoute">Seleccione la ruta:</label>
              <select name="inputRoute" id="inputRoute" class="form-control">
              </select>
          </div>
          <div class="form-label-group" >
              <input type="text" name="inputNumRuta" id = "inputNumRuta" class="form-control" placeholder="Numero Ruta" >
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
                <input type="checkbox" name="inputDiscapacidad" id="inputDiscapacidad" class="" placeholder="Discapacidad" required>
                <label for="inputDiscapacidad" class="login-heading mb-2"><h6>Posee transporte para personas con Discapacidad </h6></label>
        </div>
          <div>
                <h4 class="login-heading mb-2" style="text-align: center;">Ruta del Viaje</h4>
                <div class="form-label-group" >
                    <label for="inputDireccionMarcador">Mapa con Ruta</label>
                    <div id="mapid" class="container" style="height: 700px; width: 650px ">
                
                    </div>
                    <button class="btn btn-lg btn-secondary btn-block btn-login text-uppercase font-weight-bold mb-2" type="submit" value ="Save_Map" onclick="getCoordinates()" >Guardar Mapa</button>
                <input type="text" name="lat" id="lat" class="form-control" readonly>
                <input type="text" name="lng" id="lng" class="form-control" readonly>
                </div>
          </div>
          <button class="btn btn-lg btn-primary btn-block btn-login text-uppercase font-weight-bold mb-2" type="submit" value= "save">Guardar</button>
              
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