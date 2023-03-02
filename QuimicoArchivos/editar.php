<?php
  include "../Layout/navMenu2.php";
?>

<br><br>
<div class="container">
  <h1>Editar Tipo de Qímico</h1>
</div>
<br>

    <?php
        include "../conexion.php";
        $idtipo=$_GET['id'];
        $r="SELECT * FROM tipoquimico WHERE IdTipoQuimico=".$idtipo;
        $comando= mysqli_query($enlace, $r);
        $row=mysqli_fetch_array($comando);
        
    ?>
      <form class="row g-4 container-fluid" id="frm" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" onsubmit="return 0">
      <div class="col-4">
            <label for="inid" class="form-label">idTipoQuimico</label>
            <input type="number" class="form-control" id="inid" maxlength="5" name="inid" disabled value="<?php echo($row[0]);?>">
        </div>

      <div class="col-md-6">
          <label for="inconc" class="form-label">Concepto</label>
          <input type="text" class="form-control" id="inconc"  name="inconc" maxlength="60" required value="<?php echo($row[1]);?>">
        </div>
       
        <div class="col-12">
          <button type="button" class="btn btn-primary" id="btnGuardar" name="Registrar">Guardar</button>
        </div>
      </form>
      <?php
        mysqli_close($enlace);
      ?>
      <br><br>
      <br>
      <script type="text/javascript" src="../jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="../bootstrap-5.1.3-dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../datatables.min.js"></script>
    <script type="text/javascript" src="editar.js"></script>
    
</body>
</html>