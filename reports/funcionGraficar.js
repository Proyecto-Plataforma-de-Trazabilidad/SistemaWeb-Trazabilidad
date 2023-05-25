$(document).ready(function () {

    var opcion = sessionStorage.getItem("opcion");
    //comprobar valor  
    console.log("la opcion recibida es: " + opcion);

    var opcionEntero = parseInt(opcion);

    //tomar valor del elemento titulo 
    var texto = document.getElementById("texto");


    //validacion switch para generar los graficos 
    switch (opcionEntero) {
        //Reporte Envases mas ordenados 1
        case 1:
            var titulo =  "Reporte Envases mas ordenados";
            texto.innerText = titulo ; //escribir titulo de reporte
            //ajax para graficar
            $('#consu').click(function (e) {
                e.preventDefault();
                //       numOpcion, columnaConsulta, titulos para grafica, tipoGrafica
                consulta(opcionEntero, 'TipoEnvase', 'Tipo de Envase', 'bar');
            });

            //generar archivo csv
            $('#csv').click(function (e) {
                e.preventDefault();
                //funcion csv
                generaCSV(opcionEntero, titulo );
            });


            break;

        //Reporte de distribuidores más concurridos 2
        case 2:
            var titulo =  "Reporte de distribuidores más concurridos";
            texto.innerText = titulo ; //escribir titulo de reporte
            //ajax para graficar
            $('#consu').click(function (e) {
                e.preventDefault();
                //       numOpcion, columnaConsulta, titulos para grafica,  tipoGrafica
                consulta(opcionEntero, 'Nombre', 'Nombre Distribuidor', 'doughnut');
            });

            //generar archivo csv
            $('#csv').click(function (e) {
                e.preventDefault();
                //funcion csv
                generaCSV(opcionEntero, titulo );
            });
            break;

        //Reporte de contenedores más concurridos 3
        case 3:
            var titulo =  "Reporte de contenedores más concurridos";
            texto.innerText = titulo ; //escribir titulo de reporte
            //ajax para graficar
            $('#consu').click(function (e) {
                e.preventDefault();
                //       numOpcion, columnaConsulta, titulos para grafica,  tipoGrafica
                consulta(opcionEntero, 'Contenedor', 'Numero y Origen de Contenedor', 'bar');
            });

            //generar archivo csv
            $('#csv').click(function (e) {
                e.preventDefault();
                //funcion csv
                generaCSV(opcionEntero, titulo );
            });
            break;

        //Reporte de productores con más ordenes 4
        case 4:
            var titulo =  "Reporte de productores con más ordenes";
            texto.innerText = titulo; //escribir titulo de reporte
            //ajax para graficar
            $('#consu').click(function (e) {
                e.preventDefault();
                //       numOpcion, columnaConsulta, titulos para grafica,  tipoGrafica
                consulta(opcionEntero, 'Nombre', 'Nombre Productor', 'bar');
            });

            //generar archivo csv
            $('#csv').click(function (e) {
                e.preventDefault();
                //funcion csv
                generaCSV(opcionEntero, titulo );
            });
            break;

        //Reporte de municipios con menos entregas 5
        case 5:
            var titulo =  "Reporte de municipios con menos entregas";
            texto.innerText = titulo; //escribir titulo de reporte
            //ajax para graficar
            $('#consu').click(function (e) {
                e.preventDefault();
                //       numOpcion, columnaConsulta, titulos para grafica,  tipoGrafica
                consulta(opcionEntero, 'Nombre', 'Nombre de municipio', 'bar');
            });

            //generar archivo csv
            $('#csv').click(function (e) {
                e.preventDefault();
                //funcion csv
                generaCSV(opcionEntero, titulo );
            });
            break;

        //Reporte de distribuidores con menos entregas 6
        case 6:
            var titulo =  "Reporte de distribuidores con menos entregas";
            texto.innerText = titulo; //escribir titulo de reporte
            //ajax para graficar
            $('#consu').click(function (e) {
                e.preventDefault();
                //       numOpcion, columnaConsulta, titulos para grafica,  tipoGrafica
                consulta(opcionEntero, 'Nombre', 'Nombre de distribuidor', 'pie');
            });

            //generar archivo csv
            $('#csv').click(function (e) {
                e.preventDefault();
                //funcion csv
                generaCSV(opcionEntero, titulo );
            });
            break;

        default:
            console.log("Opcion no valida");
            break;
    }//fin switch 



    function consulta(opc, col1, titulo1, grafica) {
        let parametros = { "opcion": opc }
        //console.log(parametros);//parametros
        $.ajax({
            url: 'Reportes.php',
            data: parametros,
            type: 'POST',
            success: function (response) {
                console.log("response : " + response);//ver respuesta servidor
                let array = JSON.parse(response);//convertir a json
                //console.log(array);
                // let dat;
                // let enteros = [];

                var cant = [];
                var tipo = [];

                for (var i in array) {
                    //tomar la cantidad 
                    dat = (array[i].Total);//extraer valores del json
                    if (dat == null)//si la suma es 0 para que no marque error
                    {
                        let n = 0;
                        //console.log("valor parseado " + n);//convertirlo  a entero, para mandarlo a arreglo por que la grafica eso recibe valores en arreglos
                        cant.push(n);
                    }
                    else {
                        let n = parseInt(dat);
                        //console.log("valor parseado " + n);//convertirlo  a entero, para mandarlo a arreglo por que la grafica eso recibe valores en arreglos
                        cant.push(n);
                    }

                    var dat = array[i][col1];//extraer valores del json
                    console.log(dat);
                    //la grafica solo recibe arreglos de etiquetas o de datos
                    tipo.push(titulo1 + ": " + dat);//indicando que la etiqueta sera el productor y su nombre
                    console.log(tipo);
                }

                //   subtitulos, datos, tipoGrafica
                graficar(tipo, cant, grafica);        //Generar grafica

            }
        });
        $('#frm').trigger('reset');

    };


    function graficar(label, data, tipo,) {
        let chartStatus = Chart.getChart("myChart"); // <canvas> id
        if (chartStatus != undefined) {//si ya existe destruyelo, si no no entra
            chartStatus.destroy();
        }

        var graphTarget = $("#myChart");//asigno ala grafica
        //aqui todo lo dela grafica config
        var chartdata = {
            labels: label,
            datasets: [
                {
                    label: 'Piezas',
                    backgroundColor: ['#8C7472', '#D9A9A5', '#D4D9BA', '#A5BDD9', '#878C6B',],
                    borderColor: ['#8C7472', '#D9A9A5', '#D4D9BA', '#A5BDD9', '#878C6B',],
                    hoverBackgroundColor: '#3C7335',
                    hoverBorderColor: '#000000',
                    data: data,
                }
            ]
        };

        var barGraph = new Chart(graphTarget, {//asigancion de datos y tipo grafica
            type: tipo,
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
    };

    function generaCSV(opc,titulo) {
        let nombre = titulo.replace(/\s/g, "");  //quitar espacios del titulo   
        let parametros = { "opcion": opc }
        //console.log(parametros);//parametros
        $.ajax({
            url: 'Reportes.php',
            data: parametros,
            type: 'POST',
            success: function (response) {
                console.log("response : " + response);//ver respuesta servidor
                let array = JSON.parse(response);//convertir a json
                console.log(array);

                //generar archivo csv
                var csv = Papa.unparse(array, {
                    //delimiter: ";", // Delimitador personalizado
                    header: true, // Incluir encabezados
                    newline: "\n", // Salto de línea personalizado
                    quoteChar: '"', // Carácter de cita personalizado
                    encoding: "utf-8" // Codificación del archivo CSV
                });
                var csvData = '\ufeff' + csv; // Añadir el BOM (Byte Order Mark) para especificar UTF-8
                //console.log(csv);
                var blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
                var url = URL.createObjectURL(blob);
                var link = document.createElement('a');
                link.href = url;
                link.setAttribute('download', nombre+ '.csv');
                link.style.visibility = 'hidden';
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            }
        });
    };

});