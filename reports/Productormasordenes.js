
$(document).ready(function () {


    //ajax para graficar
    $('#consu').click(function (e) {
        e.preventDefault();

        let opcion = '4';

        let parametros = { "opcion": opcion }

        console.log(parametros);//parametros
        $.ajax({
            url: '../reports/Reportes.php',
            data: parametros,
            type: 'POST',
            success: function (response) {
                console.log("response : " + response);//ver respuesta servidor
                let array = JSON.parse(response);//convertir a json
                

                var cant = [];
                var produc= [];

                for (var i in array) {
                    //tomar la cantidad 
                    dat = (array[i].Total);//extraer valores del json
                    if (dat == null)//si la suma es 0 para que no marque error
                    {
                        let n = 0;
                        console.log("valor parseado " + n);//convertirlo  a entero, para mandarlo a arreglo por que la grafica eso recibe valores en arreglos
                        cant.push(n);
                    }
                    else {
                        let n = parseInt(dat);
                        console.log("valor parseado " + n);//convertirlo  a entero, para mandarlo a arreglo por que la grafica eso recibe valores en arreglos
                        cant.push(n);
                    }

                    dat = (array[i].Nombre);//extraer valores del json
                    //la grafica solo recibe arreglos de etiquetas o de datos
                    produc.push("Nombre " + dat);//indicando que la etiqueta sera el productor y su nombre
                    console.log(produc);
                }



                let chartStatus = Chart.getChart("myChart"); // <canvas> id
                if (chartStatus != undefined) {//si ya existe destruyelo, si no no entra
                    chartStatus.destroy();
                }

                var graphTarget = $("#myChart");//asigno ala grafica

                //aqui todo lo dela grafica config
                var chartdata = {
                    labels: produc,
                    datasets: [
                        {
                            label: 'Piezas',
                            backgroundColor: ['#8C7472', '#D9A9A5', '#D4D9BA', '#A5BDD9', '#878C6B',],
                            borderColor: ['#8C7472', '#D9A9A5', '#D4D9BA', '#A5BDD9', '#878C6B',],
                            hoverBackgroundColor: '#3C7335',
                            hoverBorderColor: '#000000',
                            data: cant,
                        }
                    ]
                };

                var barGraph = new Chart(graphTarget, {//asigancion de datos y tipo grafica
                    type: 'bar',
                    data: chartdata,
                    onAnimationComplete: function () {
                        this.fillText(this.datasets[0].bars, true);
                    },
                    options: {
                        responsive: true, // Hace que el gráfico sea responsivo al tamaño del contenedor
                        maintainAspectRatio: false, // Permite cambiar la relación de aspecto del gráfico
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });


            }
        });
        $('#frm').trigger('reset');
    });

    //pdf


});