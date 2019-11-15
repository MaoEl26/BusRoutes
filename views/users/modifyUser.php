<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" type="text/css" href="../../public/css/logIn.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css" />  
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />  
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
    
  <title></title>

</head>



<body>
    <div id="nav-placeholder">

      </div>
 <div class="container" style="background-color: rgb(100,100,100); ">
 	
<?php 
include_once "../../controller/modifyUser.php";

$userInfo = getUserInfo();
$name = $userInfo[0];
$lastName1 = $userInfo[1];
$lastName2 = $userInfo[2];
$email = $userInfo[3];
?>
 </div>
 <div>
    <br>
    <br>
    <h3 class="login-heading mb-4" style="text-align: center; ">Modificar  usuario</h3>
     <div class="container" style="width: 500px">
    <form action="../../controller/modifyUser.php" method="POST" >
          <div class="form-label-group" >
              <input type="text" name="inputName" id = "inputName" class="form-control" placeholder="Nombre" value="<?php echo $name;?>" autofocus required>
              <label for="inputName">Nombre</label>
          </div>
          <div class="form-label-group" >
              <input type="text" name="inputLastName1" id="inputLastName1" class="form-control" placeholder="Apellido 1" value="<?php echo $lastName1;?>" required>
              <label for="inputLastName1">Apellido 1</label>
          </div>
          <div class="form-label-group" >
              <input type="text" name="inputLastName2" id="inputLastName2" class="form-control" placeholder="Apellido 2" value="<?php echo $lastName2;?>" required>
              <label for="inputLastName2">Apellido 2</label>
          </div>
          <div class="form-label-group" >
              <input type="text" name="inputEmail" id="inputEmail" class="form-control" placeholder="Correo" value="<?php echo $email;?>" required>
              <label for="inputEmail">Correo</label>
          </div>
          
          <div class="form-label-group">
            <button class="btn btn-lg btn-primary btn-block btn-login text-uppercase font-weight-bold mb-2" type="submit" id="btnCambiarInfo" name="btnCambiarInfo">Guardar</button>
          </div>                      
              
      </form>
  
      </div>
  </div>
  <script src="../../public/mapCompany.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
  <script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js"></script>
  <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
  <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
 <script>
    $(function(){
      $("#nav-placeholder").load("../../public/nav.html");
    });
    </script>
  
    
  

</body>
</html>