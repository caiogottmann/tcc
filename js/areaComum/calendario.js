$(function() {

	calendario();

	if ($("#modalCalendarioAreaP").length){
		
		$('#modalCalendarioAreaP').modal('show');
	};

	$("#cancelar").click(function() {


		var id = $('#idAluguel').val();

		$.ajax({
			type: "POST",
			url: "./../pendente/0/" +id,
			success: function( data )
					{
						alert(data);
						window.location.href = "./../";
					}
		});

	});

	$("#confirmar").click(function() {

		var id = $('#idAluguel').val();

		$.ajax({
			type: "POST",
			url: "./../pendente/1/" +id,
			success: function( data )
					{
						alert(data);
						
					}
		});
		window.location.href = "./../../AreaComum";

	});


	$('#modalFormCalendario').submit(function(){
		var dados = $('#modalFormCalendario').serialize();

		$.ajax({
			type: "POST",
			url: "./AreaComum/agendar/",
			data: dados,
			success: function( data )
					{
						alert(data);
						location.reload();
					}
		});
		
		return false;

	});

	function calendario()
	{
		$('#calendar').fullCalendar({
		selectable: true,
		select: function(start, end) {

		    var dataCalendario = start.format();

	        $('#modalCalendario').modal('show');
	        $('#modalCalendario').on('shown.bs.modal', function (e) {
	        	$('#dataSelecionada').val(dataCalendario);	
	        	$.get("./AreaComum/exibirAreasPorDia/" + dataCalendario,
				  	function(data){
					if (data != null) {
						$("#selectAreas").html(data);
					};
				});
			})
		},

    	header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
    	lang: 'pt-br',
		events: './AreaComum/carrregarCalendario',
		eventLimit: true
    });

	}

});