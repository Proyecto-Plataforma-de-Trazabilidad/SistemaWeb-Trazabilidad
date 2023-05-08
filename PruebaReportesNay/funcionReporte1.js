$(document).ready(function(){

    $.ajax({
        url:'PruebaReportesNay/metodoReporte1.php',
        type:'POST',
        data: {"tipo":"combo1"},
        success:function(response){
            $('#inprod').html(response);
        }
    });
    
   

    $('#frm').submit(function(e){
        e.preventDefault();
        
        let prod=document.getElementById("inprod").value;
        let tipofuncion="registrar";

        console.log(prod);

        let parametros={"prod":prod,"tipo":tipofuncion}
        $.ajax({
            url:'PruebaReportesNay/metodoReporte1.php',
            data:parametros,
            type:'POST',
            success:function(response){
                const respuesta = response.json();
                const $grafica = document.querySelector("#myChart");
                const etiquetas = respuesta.etiquetas; 

                const datos = {
                    label: "Total piezas del Productor",
                    // Pasar los datos igualmente desde PHP
                    data: respuesta.datos, // <- Aquí estamos pasando el valor traído usando AJAX
                    backgroundColor: 'rgba(54, 162, 235, 0.2)', // Color de fondo
                    borderColor: 'rgba(54, 162, 235, 1)', // Color del borde
                    borderWidth: 1, // Ancho del borde
                };
                new Chart($grafica, {
                    type: 'bar', // Tipo de gráfica
                    data: {
                        labels: etiquetas,
                        datasets: [
                            datos,
                        ]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }],
                        },
                    }
                });

                //$('#myChart').html(response);
            }
        });
        $('#frm').trigger('reset');

    });



});