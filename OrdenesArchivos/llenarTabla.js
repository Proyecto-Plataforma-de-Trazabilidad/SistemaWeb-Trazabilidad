
$(document).ready(function(){
    let numDetalle = document.getElementById("numDetalle");
    let i = 1;
    $('#aceptar').click(function() {
        let valQuimico = document.getElementById("tipoQuimi").value;
        let valEnvase = document.getElementById("tipoEnva").value;
        let valColor = document.getElementById("color").value;
        let valPiezas = document.getElementById("cantiPza").value;

        let fila = '<tr id="row' + i + '"><td>' + i + '</td><td>' + valQuimico + '</td><td>' + valEnvase + '</td><td>' + valColor + '</td><td>' + valPiezas + '</td><td><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">Eliminar</button></td></tr>';
        i++;
        numDetalle.textContent = "Detalle de orden: 00" + i;
        
        $('#detalle tbody:first').before(fila);

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
            //Recalcular indices
            i--;
            numDetalle.textContent = "Detalle de orden: 00" + i;
      
            let container = document.querySelector('#detalle');
            let celdasId = container.querySelectorAll('tr');
            
            if(celdasId.length > 1){
              for (let i = 1; i < celdasId.length; i++) {
                celdasId[i].id = "row"+i;
                celdasId[i].firstChild.textContent = i; 
                celdasId[i].lastChild.childNodes[0].id = i;
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
