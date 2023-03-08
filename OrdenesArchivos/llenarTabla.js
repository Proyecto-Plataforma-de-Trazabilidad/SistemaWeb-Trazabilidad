$(document).ready(function() {
    $('#aceptar').click(function() {
        let valQuimico = document.getElementById("tipoQuimi").value;
        let valEnvase = document.getElementById("tipoEnva").value;
        let valColor = document.getElementById("color").value;
        let valPiezas = document.getElementById("cantiPza").value;
        let i = 1;
        let fila = '<tr id="row' + i + '"><td>' + i + '</td><td>' + valQuimico + '</td><td>' + valEnvase + '</td><td>' + valColor + '</td><td>' + valPiezas + '</td><td><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">Eliminar</button></td></tr>';
        i++;
        
        
        $('#detalle tbody:first').after(fila);

        document.getElementById("tipoQuimi").value ="";
        document.getElementById("tipoEnva").value = "";
        document.getElementById("color").value = "";
        document.getElementById("cantiPza").value = "";
        document.getElementById("tipoQuimi").focus();
    });
    0
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
            
            Swal.fire(
              'Borrado!',
              'El elemento se borro correctamente.',
              'success'
            )
          }
        })
    });
});