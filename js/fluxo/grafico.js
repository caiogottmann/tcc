$(function() {
	var $grafico = $('#chartContainer');

    if ($grafico.length){

		setInterval(function() {
    		$('#loadingGrafico').hide(300);
			$.get("./Fluxo/exibirFluxoSemanal/",
					  	function(dados){
							var json = $.parseJSON(dados);
							var chart = new CanvasJS.Chart("chartContainer", {

						      title:{
						        text: "Relatorio Semanal"              
						      },
						      data: [             
						        {
						         type: "column",
						         dataPoints: json
						       }
						       ]
						     });

						    chart.render();
			});

			$.get("./Fluxo/exibirFluxoQuinzenal/",
					  	function(dados){
							var json = $.parseJSON(dados);
							var chart = new CanvasJS.Chart("chartContainer2", {

						      title:{
						        text: "Relatorio Quinzenal"              
						      },
						      data: [             
						        {
						         type: "column",
						         dataPoints: json
						       }
						       ]
						     });

						    chart.render();
			});
		}, 1000);

    }
});