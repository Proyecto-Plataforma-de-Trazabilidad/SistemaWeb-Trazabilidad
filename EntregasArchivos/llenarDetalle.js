$(document).ready(function(){
    let numDetalle = document.getElementById("numDetalle");
    let i = 1;

    $('#aceptar').click(function() {
        let valEnvase = document.getElementById("tipoEnva").value;
        let valPiezas = document.getElementById("cantiPza").value;
        let valPeso = document.getElementById("peso").value;
        let valObser = document.getElementById("observa").value;

        let fila = '<tr id="row' + i + '"> <td>' + i + '</td> <td>'+valEnvase+'</td> <td>'+valPiezas+'</td> <td>'+valPeso+'</td> <td>'+valObser+'</td> <td><button style="background-color: #dc3545 !important" type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">Eliminar</button></td></tr>';

        i++;
        
        numDetalle.textContent = "Detalle de entrega: 00" + i;

        $('#detalle tbody:first').before(fila);
        document.getElementById("tipoEnva").value = "";
        document.getElementById("cantiPza").value = "";
        document.getElementById("peso").value = "";
        document.getElementById("observa").value = "";
    });

    $(document).on('click', '.btn_remove', function() {
        Swal.fire({
            title: 'Desea borrar el elemento?',
            text: "Esta acción no se puede revertir",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, borrar!'
        }).then((result) => {
          if (result.isConfirmed) {
            //Borrar el elemento de la tabla
            var button_id = $(this).attr("id");
            $('#row' + button_id + '').remove();
            //Recalcular indices
            i--;
            numDetalle.textContent = "Detalle de entrega: 00" + i;
            let container = document.querySelector('#detalle');
            let celdasId = container.querySelectorAll('tr');

            if(celdasId.length > 1){
                
                for (let i = 1; i < celdasId.length; i++) {
                    celdasId[i].id = "row"+i;   //Cambia el id de la fila
                    celdasId[i].childNodes[1].textContent = i;      //Coloca la numeración en la primera columna
                    celdasId[i].lastChild.childNodes[0].id = i;     //Reasigna la id del botón que elimina
                }
            }
            Swal.fire(
              'Borrado!',
              'El elemento se borro correctamente.',
              'success'
            )
          }
        })
    });

});