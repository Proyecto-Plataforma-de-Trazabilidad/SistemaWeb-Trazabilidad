<?php
    include "navMenu.php";
?>
<br><br>
<div class="container">
  <h1>Registrar Vehículos Distribuidores</h1>
</div>
<br>
      <form class="row g-4 container-fluid" id="frm" method="POST" action="DistVehicArchivos/insertar.php" onsubmit="return valdez()" enctype="multipart/form-data">

      <div class="col-sm-4">
      <?php
      //se incluye la conexion para hacer lo mismo que en sql 
      include 'conexion.php';

      //creamos una variable que guardara la instruccion que usaremos en sql
      $n = "SELECT COUNT(*) FROM distribuidorvehiculos";
      //en la variable resultado guardamos todos lo encontrado en ofertas 
      //el comando mysqli_query nos permite crear comandos de sql 
      $resultado = mysqli_query($enlace, $n);
      //con el comando mysqli_num_rows cuentas todos los campos que existen en ofertas
      $row= mysqli_num_rows($resultado);
      $row = $row+1;
      echo"<label for='incon' class='form-label'>Concecutivo</label>";
      echo"<input type='number' class='form-control' id='incon' maxlength='10' name='incon' value='$row' readonly>";
      ?>
      </div> 
         
      
        <div class="col-sm-4">
          <label for="indes" class="form-label">Descripción</label>
          <input type="text" class="form-control" id="indes"  name="indes" maxlength="30" required placeholder="Ingrese la descripción">
        </div>

        <div class="col-sm-4">
          <label for="intipo" class="form-label">Tipo vehículo</label>
          <input type="text" class="form-control" id="intipo"  name="intipo" maxlength="60" required placeholder="Ingrese el tipo de vehículo">
        </div>

        <div class="col-sm-4">
          <label for="inmarca" class="form-label">Marca</label>
          <input type="text" class="form-control" id="inmarca"  name="inmarca" maxlength="30" required placeholder="Ingrese la marca del vehículo">
        </div>

        <div class="col-4">
            <label for="incap" class="form-label">Capacidad (kg)</label>
            <input type="number" class="form-control" id="incap" maxlength="10" name="incap" required placeholder="Ingrese la capacidad">
        </div>

        <div class="col-4">
          <label for="inplaca" class="form-label">Placa</label>
          <input type="text" class="form-control" id="inplaca"  name="inplaca" maxlength="10" required placeholder="Ingrese la placa">
        </div>

        <div class="col-sm-2">
          <label for="infile" class="form-label">SCT</label>
          <input type="file" name="infile" id="infile" class="form-file">
        </div>

        <div class="col-12">
          <button type="submit" class="btn btn-success" name="Registrar">Registrar</button>
        </div>

      </form>
      

      <br><br>
      <div class="container text-center">
        <h5>Vehiculos Distribuidores Registrados</h5>
      </div>
      <div class="container col-12">
        <center>
        <table class="table table-striped" id="tabladistv">
            <thead>
                <tr>
                    <th scope="col">idDistrinuidor</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">TipoVehículo</th>
                    <th scope="col">Capacidad (kg)</th>
                    <th scope="col">Marca</th>
                    <th scope="col">Placa</th>
                    <th scope="col">SCT</th>
                    <th scope="col">Opciones</th>
                </tr>
              </thead>
            <tbody id="bodyTabla">

            </tbody>
        </table>
        </center>
      </div>
      <br>
       <script>
        function valdez()
        {
            let placa=document.getElementById("inplaca").value
            if(placa.length<6 || placa.length>7){
              alert("El campo Placa, no es valido");
              return false;
            }
            return 0;
            
        }
      </script>
      <script type="text/javascript" src="jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="bootstrap-5.1.3-dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="datatables.min.js"></script>
    <script type="text/javascript" src="DistVehicArchivos/funcionesDistVehic.js"></script>
    <script src="menujs.js"></script>
      
</body>
</html>