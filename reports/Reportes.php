<?php
// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//     include('database.php');
//     $conn = new PDO('mysql:host=' . $host_name . ';dbname=' . $database, $host_user, $host_password);

include("../conexion.php");

//verificar conexion
if ($enlace->connect_error) {
    //mandar mensaje y salir
    die("Conexion fallida: " . $enlace->connect_error);
} else {
    session_start();

    switch ($_POST['opcion']) {
        //Reporte Envases mas ordenados1
        case '1':
            $query = "SELECT TipoEnvase, SUM(CantidadPiezas) as Total from detalleorden GROUP BY TipoEnvase order by Total DESC";
            $result = mysqli_query($enlace, $query);
            $data = array();
            foreach ($result as $row) {
                $data[] = $row;
            }
            echo json_encode($data);
            mysqli_free_result($result); //limpiar comand
            break;

        //Reporte de distribuidores más concurridos 2
        case '2':
            $query = "SELECT D.Nombre , COUNT(*) as total FROM ordenproductos as OP INNER JOIN distribuidores as D on OP.IdDistribuidor = D.IdDistribuidor GROUP by D.Nombre ORDER BY total ASC";
            $result = mysqli_query($enlace, $query);
            $data = array();
            foreach ($result as $row) {
                $data[] = $row;
            }
            echo json_encode($data);
            mysqli_free_result($result); //limpiar comand
            break;

        //Reporte de contenedores más concurridos 3
        case '3':
            $query = "SELECT D.Nombre , COUNT(*) as total FROM ordenproductos as OP INNER JOIN distribuidores as D on OP.IdDistribuidor = D.IdDistribuidor GROUP by D.Nombre ORDER BY total ASC";
            $result = mysqli_query($enlace, $query);
            $data = array();
            foreach ($result as $row) {
                $data[] = $row;
            }
            echo json_encode($data);
            mysqli_free_result($result); //limpiar comand
            break;
        //Reporte de productores con más ordenes 4
        case '4':
            $query = "SELECT P.Nombre, count(*) as Total from productores as P INNER JOIN ordenproductos as OP on P.IdProductor = OP.IdProductor GROUP by P.Nombre Order By Total DESC";
            $result = mysqli_query($enlace, $query);
            $data = array();
            foreach ($result as $row) {
                $data[] = $row;
            }
            echo json_encode($data);
            mysqli_free_result($result); //limpiar comand
            break;
        //Reporte de municipios con menos entregas 5
        case '5':
            $query = "SELECT U.Nombre, count(*) as Total from entregas as E inner JOIN usuarios as U on E.IdUsuario = U.IdUsuario inner join tipousuario as TU on U.Idtipousuario=TU.Idtipousuario where TU.Idtipousuario=4 GROUP by U.Nombre Order BY total ASC";
            $result = mysqli_query($enlace, $query);
            $data = array();
            foreach ($result as $row) {
                $data[] = $row;
            }
            echo json_encode($data);
            mysqli_free_result($result); //limpiar comand
            break;
        //Reporte de distribuidores con menos entregas 6
        case '6':
            $query = "SELECT U.Nombre, count(*) as Total from entregas as E inner JOIN usuarios as U on E.IdUsuario = U.IdUsuario inner join tipousuario as TU on U.Idtipousuario=TU.Idtipousuario where TU.Idtipousuario='3' GROUP by U.Nombre Order BY total ASC";
            $result = mysqli_query($enlace, $query);
            $data = array();
            foreach ($result as $row) {
                $data[] = $row;
            }
            echo json_encode($data);
            mysqli_free_result($result); //limpiar comand
            break;
        //Reporte de contenedores con menos salidas 7


        }
    //echo json_encode($res);
    //$conn = null; //Limpia la conexión
    mysqli_close($enlace);

}