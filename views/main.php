<!DOCTYPE html>
<html>
<head>
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
if(isset($_POST['guest'])&& $_POST['guest']=="true"){
  echo "";
}else{
  echo "";
}
?>    
    
    <div id="nav-placeholder">

      </div>

      <br>
      <br>
      <div class="container">
        <h4>Realice consultas de los transportes publicos en Costa Rica de una manera sencilla </h4>
        <br>
        <br>

      <div class="input-group mb-3">
          <div class="input-group-prepend">
            <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Buscar por </button>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="#">Empresa</a>
              <a class="dropdown-item" href="#">Ruta</a>
              <a class="dropdown-item" href="#">DestinoFinal</a>
              <div role="separator" class="dropdown-divider"></div>
            </div>
          </div>
          <input type="text" class="form-control" aria-label="Text input with dropdown button">
          <div class="input-group-append">
              <button class="btn btn-outline-secondary" type="button">Consultar</button>
            </div>
        </div>
      
     
      <br>
      <br>
      <br>
      <br>


      </div>


 <div class="container" style="background-color: rgb(100,100,100);  ">
    <div class="container-fluid" id="mapid" style="height: 80%; width: 80%; position: absolute; ">

    </div>

 </div>
 <br>
 <br>
 <script src="../public/mapRoutes.js"></script>


 <script>
    $(function(){
      $("#nav-placeholder").load("../public/nav.html");
    });
    
    </script>

</body>
</html>