<?php
include "Layout/navMenu.php";
?>

<div class="container">
  <h1>Registrar Tipo de Químico</h1>
</div>
<br>
      <form class="row g-4 container-fluid" id="frm" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" onsubmit="return 0">
        <div class="col-md-6">
          <label for="inconc" class="form-label">Concepto</label>
          <input type="text" class="form-control" id="inconc"  name="inconc" maxlength="60"  placeholder="Ingresa el concepto">
        </div>
       
        <div class="col-12">
          <button type="submit" class="btn btn-primary" onclick="" name="Registrar">Registrar</button>
        </div>
      </form>

      <br><br>
      <div class="container text-center">
        <h5>Tpos de Químico Registrados</h5>
      </div>
      <div class="container col-12">
        <center>
        <table class="table table-striped" id="tabla">
            <thead>
                <tr>
                    <th scope="col">idTipoQuímico</th>
                    <th scope="col">Concepto</th>
                    <th scope="col">Opciones</th>
                </tr>
            </thead>
            <tbody id="bodyTabla">
                
            </tbody>
        </table>
        </center>
      </div>
      <br>
        
      <script type="text/javascript" src="jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="bootstrap-5.1.3-dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="datatables.min.js"></script>
    <script type="text/javascript" src="QuimicoArchivos/funcionesQuimico.js"></script>
    <script src="menujs.js"></script>
      
</body>
</html>