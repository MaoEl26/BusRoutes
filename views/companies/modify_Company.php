<!DOCTYPE html>
<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" type="text/css" href="../../public/css/logIn.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin="" />
  <script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js" integrity="sha512-GffPMF3RvMeYyc1LWMHtK8EbPv0iNZ8/oTtHPx9/cc2ILxQ+u905qIwdpULaqDkyBKgOaB57QTMg7ztg8Jm2Og==" crossorigin=""></script>
  <title></title>

</head>



<body>

  <div id="nav-placeholder">

  </div>
  <div class="container" style="background-color: rgb(100,100,100); ">

    <?php
    //require_once "../../controller/connection.php";
    include_once '../../controller/modifyCompany.php';
    $companies = getCompanies();
    //var_dump($companies);
    //$companyInfo = getData(1, $link);    
    //var_dump($companyInfo);
    ?>
  </div>
  <div>
    <br>
    <br>
    <h3 class="login-heading mb-4" style="text-align: center; ">Modificar Empresa</h3>
    <div class="container" style="width: 500px">
      <form action="/modifyCompany" method="POST">
        <div class="form-group">
          <label for="inputCompany">Seleccione la empresa</label>
          <select name="inputCompany" id="inputCompany" class="form-control">
            <option value="" selected>Ninguna empresa seleccionada</option>
            <?php
            foreach ($companies as $company) {
              //echo '<option value="' . $company[0] . '" onclick="myAjax(' . $company[0] . ')">' . $company[1] . "</option>";
              echo '<option value="' . $company[0] . '">' . $company[1] . "</option>";
            }
            ?>
          </select>
        </div>
        <div class="form-label-group">
          <input type="text" name="inputName" id="inputName" class="form-control" placeholder="Nombre" autofocus>
          <label for="inputName">Nombre Nuevo</label>
        </div>
        <div class="form-label-group">
          <input type="text" name="inputNumTelefono" id="inputNumTelefono" class="form-control" placeholder="Número de Teléfono" required>
          <label for="inputNumTelefono">Número de Teléfono</label>
        </div>
        <div class="form-label-group">
          <input type="text" name="inputEmail" id="inputEmail" class="form-control" placeholder="Correo" required>
          <label for="inputEmail">Correo</label>
        </div>
        <div>
          <h4 class="login-heading mb-4" style="text-align: center;">Zona de Servicio</h4>
          <div class="form-label-group">
            <input type="text" name="inputZonaOrigen" id="inputZonaOrigen" class="form-control" placeholder="Origen" required>
            <label for="inputZonaOrigen">Zona Origen</label>
          </div>
          <div class="form-label-group">
            <input type="text" name="inputZonaDestino" id="inputZonaDestino" class="form-control" placeholder="Destino" required>
            <label for="inputZonaDestino">Zona Destino</label>
          </div>
        </div>
        <div>
          <h4 class="login-heading mb-2" style="text-align: center;">Dirección de la Terminal u Oficina</h4>
          <h5 class="login-heading mb-4">Ubicación en el mapa</h5>
          <div class="form-label-group" style="background-color: rgb(100,100,100);  ">
            <div id="mapid" class="container-fluid" style="height: 200px;  ">

            </div>
          </div>
          <div class="form-label-group">
            <input type="text" name="inputDireccionSenna" id="inputDireccionSenna" class="form-control" placeholder="Dirección" required>
            <label for="inputDireccionSenna">Dirección exacta</label>
          </div>
        </div>
        <div>
          <h4 class="login-heading mb-2" style="text-align: center;">Horario de Atención</h4>
          <div class="form-group">
            <label for="inputDiasSemana">Seleccione los días</label>
            <select name="inputDiasSemana[]" id="inputDiasSemana" class="form-control" multiple>
              <option>Lunes</option>
              <option>Martes</option>
              <option>Miercoles</option>
              <option>Jueves</option>
              <option>Viernes</option>
              <option>Sábado</option>
              <option>Domingo</option>
            </select>
          </div>
          <div class="form-label-group">
            <input type="time" name="inputHoraApertura" id="inputHoraApertura" class="form-control" placeholder="Apertura" required>
            <label for="inputHoraApertura">Hora Apertura</label>
          </div>
          <div class="form-label-group">
            <input type="time" name="inputHoraCierre" id="inputHoraCierre" class="form-control" placeholder="Cierre" required>
            <label for="inputHoraCierre">Hora Cierre</label>
          </div>
        </div>
        <h5 class="login-heading mb-4" style="text-align: center;">Reportes</h5>
        <div class="form-label-group">
          <input type="text" name="inputContactoAnomalias" id="inputContactoAnomalias" class="form-control" placeholder="Contacto Anomalías" required>
          <label for="inputContactoAnomalias">Contacto Anomalías</label>
        </div>
        <div>
          <button class="btn btn-lg btn-primary btn-block btn-login text-uppercase font-weight-bold mb-2" type="submit">Guardar</button>
        </div>
      </form>

    </div>
  </div>
  <script src="../../public/map.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <script>
    $(function() {
      $("#nav-placeholder").load("../../public/nav.html");
    });

    $('#inputCompany').on('change', function(e) {
      var select = document.getElementById('inputCompany');
      var selectedOption = this.options[select.selectedIndex];
      //alert(selectedOption.value);               
      e.preventDefault // prevent form submission
      $.ajax({
        url: '../../controller/modifyCompany.php',
        type: "POST",
        dataType: 'json',
        data: {
          getCompanyInfo: "true",
          company: selectedOption.value
        },
        success: function(result) {

          document.getElementById("inputName").value = result[1];
          document.getElementById("inputNumTelefono").value = result[2];
          document.getElementById("inputZonaOrigen").value = result[3];
          document.getElementById("inputZonaDestino").value = result[4];
          document.getElementById("inputEmail").value = result[5];
          document.getElementById("inputContactoAnomalias").value = result[6];
          document.getElementById("inputDireccionSenna").value = result[7];

          var arrayDias = result[10].split(",");

          for (var i = 0; i < arrayDias.length; i++){            
            document.getElementById('inputDiasSemana').getElementsByTagName('option')[i].selected = 'selected'
          }          
          
          document.getElementById("inputHoraApertura").value = result[11];
          document.getElementById("inputHoraCierre").value = result[12];
        },
        error: function(request, status, error) {
          alert('Ha surgido un error procesando su petición.');
        }
      });
    });
  </script>
</body>

</html>