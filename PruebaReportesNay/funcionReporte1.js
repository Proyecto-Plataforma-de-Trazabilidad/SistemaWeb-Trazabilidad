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
        console.log(tipofuncion);

        let parametros={"inprod":prod,"tipo":tipofuncion}

        console.log(parametros);
        $.ajax({
            url:'PruebaReportesNay/metodoReporte1.php',
            data:parametros,
            type:'POST',
            success:function(response){
               console.log(response);

        
               var valor = [];

                for (var i in data) { valor.push(data[i].TotalPiezas); }

                    var chartdata = {
                        labels: "Total Piezas",
                        datasets: [
                            {
                                label: 'Piezas',
                                backgroundColor: '#49e2ff',
                                borderColor: '#46d5f1',
                                hoverBackgroundColor: '#CCCCCC',
                                hoverBorderColor: '#666666',
                                data: valor
                            }
                        ]
                    };

                    var graphTarget = $("#myChart");

                    var barGraph = new Chart(graphTarget, {
                        type: 'bar',
                        data: chartdata
                    });
            
            }
        });
        $('#frm').trigger('reset');

    });



});