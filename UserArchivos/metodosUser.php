<?php
    include '../conexion.php';
    $tipo = $_POST['tipo'];

    if ($tipo == null) {
        cargarTabla();
    }

    function cargarTabla(){
        include '../conexion.php';
        $r = "SELECT U.IdUsuario, U.Nombre, U.Correo, T.Descripcion FROM usuarios as U inner join tipousuario as T on U.IdtipoUsuario = T.Idtipousuario";
        $comando = mysqli_query($enlace, $r);
        while($row = mysqli_fetch_array($comando)){
            echo "
                <tr>
                    <td>".$row[0]."</td>
                    <td>".$row[1]."</td>
                    <td>".$row[2]."</td>
                    <td>".$row[3]."</td>
                    <td><a href='UserArchivos/Consulta.php?id=".$row[0]."'><input type='button' value='Consultar' class='btn btn-primary'></td>
                </tr>
            ";
        }
        mysqli_close($enlace);
    }

?>