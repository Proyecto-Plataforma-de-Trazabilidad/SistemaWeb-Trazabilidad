
$(document).ready(function(){
    let numDetalle = document.getElementById("numDetalle");
    let i = 1;
    $('#aceptar').click(function() {
        //let valQuimico = document.getElementById("tipoQuimi").textContent; tomar el texto de option quimico
        let valQuimico = $("#tipoQuimi option:selected").text(); //texto del tipoquimico
        let numQuimco= document.getElementById('tipoQuimi').value;
        let valEnvase = document.getElementById("tipoEnva").value;
        let valColor = document.getElementById("color").value;
        let valPiezas = document.getElementById("cantiPza").value;
        
        //                                                          en DOM SE GUARDA COMO 'tableIdquimico'
        let fila = '<tr  id="row' + i + '"><td>' + i + '</td><td id="celdaIdQuimico" data-table-idQuimico='+numQuimco+'>' + valQuimico + '</td><td>' + valEnvase + '</td><td>' + valColor + '</td><td>' + valPiezas + '</td><td><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">Eliminar</button></td></tr>';
        
        numDetalle.textContent = "Detalle de orden: 00" + i;
        i++;
        $('#detalle tbody:first').after(fila);

        document.getElementById("tipoQuimi").value ="";
        document.getElementById("tipoEnva").value = "";
        document.getElementById("color").value = "";
        document.getElementById("cantiPza").value = "";
        document.getElementById("tipoQuimi").focus();
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
            i--;
            numDetalle.textContent = "Detalle de orden: 00" + i;
            Swal.fire(
              'Borrado!',
              'El elemento se borro correctamente.',
              'success'
            )
          }
        })
    });
});
