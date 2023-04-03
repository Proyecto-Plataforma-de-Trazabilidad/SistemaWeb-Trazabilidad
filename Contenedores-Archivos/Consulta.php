<?php
  include "../Layout/navMenu2.php";
  $consulta = "Select * from usuarios where Correo = '$varses'";
  $res = mysqli_query($enlace, $consulta);
  $filas = mysqli_fetch_array($res);
?>
<script type="text/javascript" src="../jquery-3.6.0.min.js"></script>


<div class="container">
  <h1>Consulta Contenedor</h1>
</div>
<br>
    <?php
    include "../conexion.php";
    $idtipo = $_GET['id'];
    $nueva = base64_decode($idtipo);
        $r="SELECT c.IdContenedor, t.Concepto, c.Origen, c.Capacidad, c.Descripcion, c.Latitud, c.Longitud, c.UltimaFechaRecoleccion, c.InstruccionesManejo, c.ReferenciaPermiso, t.idTipoCont FROM tipocontenedor as t inner join contenedores as c on c.IdTipoCont=t.idTipoCont WHERE IdContenedor=".$nueva;
        $comando= mysqli_query($enlace, $r);
        $row=mysqli_fetch_array($comando);
        
    ?>
      <form class="row g-4 container-fluid" id="frm" method="POST" action="actualizar.php" onsubmit="return valdez()" enctype="multipart/form-data">

      <div class="col-md-2">
          <label for="inid" class="form-label">IdContenedor</label>
          <input type="text" class="form-control" id="inid"  name="inid" maxlength="60" required value="<?php echo($row[0]);?>" disabled>
        </div>

        <div class="col-md-2">
          <label for="intipocont" class="form-label">Tipo de contenedor</label>
          <select name="intipocont" id="intipocont" class="form-select" disabled required>
            <option value="<?php echo($row[10]);?>"><?php echo($row[1]);?></option>
            </select>
        </div>

        <div class="col-sm-2">
          <label for="intipoorigen" class="form-label">Tipo de origen</label>
          <select name="intipoorigen" id="intipoorigen" class="form-select" disabled>
          <option value="<?php echo($row[2]);?>"><?php echo($row[2]);?></option>
                <option value="Amocalli">Amocalli</option>
                <option value="Distribuidor">Dist.</option>
                <option value="CAT">CAT</option>
                <option value="Recicladora">Recicladora</option>
                <option value="Municipio">Municipio</option>
                <option value="Empresa">Empresa</option>
            </select>
        </div>
      
        <div class="col-2">
            <label for="incap" class="form-label">Capacidad (Kg)</label>
            <input type="number" class="form-control" id="incap" maxlength="10" name="incap" disabled required value="<?php echo($row[3]);?>">
        </div>

        <div class="col-sm-4">
          <label for="indes" class="form-label">Descripción</label>
          <input type="text" class="form-control" id="indes"  name="indes" maxlength="60" disabled required value="<?php echo($row[4]);?>">
        </div>
        
        <div class="col-sm-4">
          <label for="inulti" class="form-label">Última recolección</label>
          <input type="date" class="form-control" id="inulti"  name="inulti" maxlength="60" disabled required value="<?php echo($row[7]);?>">
        </div>

        <div class="col-md-4">
          <label for="infile" class="form-label">Referencia o permiso</label>
          <input type="file" name="infile" id="infile" class="form-file">
        </div>

        <div class="col-md-4">
          <label for="inarch" class="form-label">Permiso Actual</label>
          <a href="<?php echo($row[9]);?>" class="form-control">Permiso</a>
        </div>

        <div class="col-sm-4">
          <label for="inman" class="form-label">Instrucciones de manejo</label>
          <br>
          <textarea name="inman" id="inman" cols="30" rows="4" class="form-control" disabled required placeholder="Escribe las instrucciones" value="<?php echo($row[8]);?>"><?php echo($row[8]);?></textarea>
        </div>
        
        <div class="col-sm-4">
          <label for="inlat" class="form-label">Latitud</label>
          <input type="text" class="form-control" id="inlat"  name="inlat" maxlength="60" disabled required value="<?php echo($row[5]);?>">
        </div>

        <div class="col-sm-4">
          <label for="inlon" class="form-label">Longitud</label>
          <input type="text" class="form-control" id="inlon"  name="inlon" maxlength="60" disabled required value="<?php echo($row[6]);?>">
        </div>

        <br><br>

        <div class="col-2">
          <button type="button" class="btn btn-primary" onclick="habilitar();" name="Editar" id="btnEditar">Editar</button>
        </div>
        <div class="col-2">
          <button type="submit" class="btn btn-success" onclick="" name="guardar" id="btnGuardar">Guardar</button>
        </div>

        <br><br>

        <div class="row g-4 container-fluid">
          <div class="col-md-12">
              <div id="mapa" style="width: 100%; height: 500px">

              </div>
          </div>
        </div>

        <?php 
            mysqli_close($enlace)
        ?>
      </form>
      <script>
        function valdez(){
          let idcon=document.getElementById("inid").value;
          let des=document.getElementById("indes").value;
          let cap=document.getElementById("incap").value;
          let ulti=document.getElementById("inulti").value;
          let lat=document.getElementById("inlat").value;
          let lon=document.getElementById("inlon").value;
          let man=document.getElementById("inman").value;
          if(cap.length<2 || cap.length>6){
            alert("El campo: Capacidad debe ser de 2 a 6 digitos");
            return false;
          }
          document.getElementById("inid").disabled=false;
          document.getElementById("intipocont").disabled=false;
          document.getElementById("intipoorigen").disabled=false;
          return 0;
        }
        function habilitar()
        {
          document.getElementById("indes").disabled=false;
          document.getElementById("incap").disabled=false;
          document.getElementById("intipocont").disabled=false;
          document.getElementById("inulti").disabled=false;
          document.getElementById("inlat").disabled=false;
          document.getElementById("inlon").disabled=false;
          document.getElementById("inman").disabled=false;
          document.getElementById("btnGuardar").disabled=false;
          document.getElementById("btnEditar").disabled=true;
          document.getElementById("intipoorigen").disabled=false;
        }
        function initMap(){
          let latitud=document.getElementById("inlat").value;
          let longitud=document.getElementById("inlon").value;
          cordenadas={lat:latitud, lng:longitud}

          generarMapa(cordenadas);

        }
        function generarMapa(coordenadas){
          let mapa=new google.maps.Map(document.getElementById('mapa'),{
            zoom: 16,
            center: new google.maps.LatLng(coordenadas.lat, coordenadas.lng)
          });

          marcador = new google.maps.Marker({
            map: mapa,
            draggable: true,
            position: new google.maps.LatLng(coordenadas.lat, coordenadas.lng)
          });

          marcador.addListener("dragend", function(event){
            document.getElementById("inlat").value=this.getPosition().lat();
            document.getElementById("inlon").value=this.getPosition().lng();
          })
        }
      </script>

      <!--Código PHP para obtener el IDtiporol del usuario que inició sesión-->
      <?php
        $rol = $filas['Idtipousuario'];
      ?>

      <!--Código de JS para mandar a una variable de js el valor de una variable php-->
      <script type="text/javascript">

            var rol = "<?php echo $rol; ?>";

            //Si el id del rol obtenido, únicamente puede consultar -> ocultar los botones de guardar y editar
            if (rol == 3 || rol == 2 || rol == 11 || rol == 4) {
              $(function(){
                $('#btnEditar').hide();
                $('#btnGuardar').hide();
              });
            }   
      </script>
      

      
    <script type="text/javascript" src="../jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="../bootstrap-5.1.3-dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="funConculta.js"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAoIir0y0RhmeX5MIfoHdiUgxTRQ21HE4w&callback=initMap"></script>
    <script src="../Layout/menujs.js"></script>
</body>
</html>