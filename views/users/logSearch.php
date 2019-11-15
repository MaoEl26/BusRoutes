<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" type="text/css" href="../public/css/logIn.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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
    <h3 class="login-heading mb-4" style="text-align: center; ">Log de Actividades</h3>
    <div class="container" style="width: 500px">
        <form action="javascript:getLogInfo();" method="POST" >
            <div>
                <div class="form-label-group" >
                    <label for="inputStartDate">Fecha Inicio</label>
                    <input type="date" name="inputStartDate" id = "inputStartDate" class="form-control" placeholder="Fecha Inicio" required>
                </div>
                <div class="form-label-group" >
                    <label for="inputEndDate">Fecha Final</label>
                    <input type="date" name="inputEndDate" id="inputEndDate" class="form-control" placeholder="Fecha Final" required>
                </div>
                <div class="form-label-group" >
                    <br>
                    <button class="btn btn-lg btn-primary btn-block btn-login text-uppercase font-weight-bold mb-2" type="submit">Buscar</button>    
                    <br>
                </div>
            </div>
        </form>
    </div>
    <div class="container" >
        <table class="table table-striped" id="tableLog">
            <thead>
                <tr>
                    <th>Usuario</th>
                    <th>Acción</th>
                    <th>Fecha y Hora</th>
                </tr>
            </thead>
            <tbody>
                <td>corolla78</td>
                <td>Modificacion de Ruta</td>
                <td>14/11/2019</td>
            </tbody>
        </table>
    </div> 
    <script>
    $(function(){
      $("#nav-placeholder").load("../../public/nav.html");
    });

    var selectStart,selectedOptionStart,selectEnd,selectedOptionEnd ;
    function getLogInfo(){
      console.log("Entre");
      selectStart = document.getElementById('inputStartDate');
      selectedOptionStart = selectStart.getdate;//this.options[select.selectedIndex];//
      selectEnd = document.getElementById('inputEndDate');
      selectedOptionEnd = selectEnd.getdate;//this.options[select.selectedIndex];//
      //alert(selectedOption.value); 
      //e.preventDefault // prevent form submission

      $.ajax({
        url: '../../controller/getLog.php',
        type: "POST",
        dataType: 'json',
        data: {
          getLogInfo: "true",
          startDate: selectedOptionStart,
          endDate: selectedOptionEnd
        },
        
        success: function(result) {
          
          var salida = '<table class="table table-striped" id="tableLog"><thead><tr>'+
          '<th>Usuario</th><th>Acción</th><th>Fecha y Hora</th></tr></thead><tbody>';                   
          $("#tableLog").html("");
          for(var i = 0; i < result.length; i++) {
                salida += '<tr><td>'+result[i][0]+'</td>';
                salida += '<td>'+result[i][1]+'</td>';
                salida += '<td>'+result[i][2]+'</td></tr>';
            }
          salida += "</tbody></table>";
          $("#tableLog").html(salida);
          console.log("success");
        },
        error: function(request, status, error) {
          alert('Ha surgido un error procesando su petición.');
          console.log(error);
        }
      });
    };
    </script> 
  
</body>
</html>