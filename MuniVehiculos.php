<?php
  include "navMEnu.php"
?>

<br><br>
<div class="container">
  <h1>Registrar Vehículos Municipio</h1>
</div>
<br>
      <form class="row g-4 container-fluid" id="frm" method="POST" action="MuniVehiculosArchivos/insertar.php" onsubmit="return valdez()" enctype="multipart/form-data">

      <div class="col-sm-4">
      <label for="inmuni" class="form-label">Municipio</label>
      <select name="inmuni" id="inmuni" class="form-select">
      </select>
    </div>

        <div class="col-sm-4">
          <label for="indes" class="form-label">Descripción</label>
          <input type="text" class="form-control" id="indes"  name="indes" maxlength="60" required placeholder="Ingresa la descripción">
        </div>

        <div class="col-sm-4">
          <label for="intipo" class="form-label">Tipo vehículo</label>
          <input type="text" class="form-control" id="intipo"  name="intipo" maxlength="60" required placeholder="Ingresa el tipo de vehículo">
        </div>

        <div class="col-4">
            <label for="incap" class="form-label">Capacidad (kg)</label>
            <input type="number" class="form-control" id="incap" maxlength="10" name="incap" required placeholder="Ingresa la capacidad">
        </div>

        <div class="col-4">
          <label for="inmarca" class="form-label">Marca</label>
          <input type="text" class="form-control" id="inmarca"  name="inmarca" maxlength="30" required placeholder="Ingresa la marca">
        </div>

        <div class="col-4">
          <label for="inplaca" class="form-label">Placa</label>
          <input type="text" class="form-control" id="inplaca"  name="inplaca" maxlength="10" required placeholder="Ingresa la placa">
        </div>

        <div class="col-2">
          <label for="infile" class="form-label">SCT</label>
          <input type="file" name="infile" id="infile" class="form-file">
        </div>

        <div class="col-12">
          <button type="submit" class="btn btn-success" onclick="" name="Registrar">Registrar</button>
        </div>

      </form>
      

      <br><br>
      <div class="container text-center">
        <h5>Vehiculos Municipios Registrados</h5>
      </div>
      <div class="container col-12">
        <center>
        <table class="table table-striped" id="tabla">
            <thead>
                <tr>
                    <th scope="col">idMunicipio</th>
                    <th scope="col">Concecutivo</th>
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
          const conce =document.getElementById("inconc").value;
          const des=document.getElementById("indes").value;
          let tipo=document.getElementById("intipo").value;
          let cap=document.getElementById("incap").value;
          let marca=document.getElementById("inmarca").value;
          let placa=document.getElementById("inplaca").value;
          if(conce.length>10){
            alert("Campo concecutivo demasiado largo");
            return false;
          }
          if(des.length>30){
            alert("El campo: Descripcion, es demasiado largo");
            return false;
          }
          if(tipo.length>30){
            alert("El campo: Tipo, es demasiado largo");
            return false;
          }
          if(cap.length>30){
            alert("El campo: Capacidad(kg), es demasiado largo");
            return false;
          }
          if(marca.length>30){
            alert("El campo: Marca, es demasiado largo");
            return false;
          }
          if(placa.length>6 || placa.length<6){
            alert("El campo: Placa, es invalido");
            return false;
          }
          return 0;   
        }
    </script>
      <script type="text/javascript" src="jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="bootstrap-5.1.3-dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="datatables.min.js"></script>
    <script type="text/javascript" src="MuniVehiculosArchivos/funcionesMuniVehiculos.js"></script>
    <script src="menujs.js"></script>
      
</body>
</html>