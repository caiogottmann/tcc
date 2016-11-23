$(function() {
$('#modalVisitante').submit(function(){
		var dados = $('#modalVisitante').serialize();

		$.ajax({
			type: "POST",
			url: "./Visitante/novoVisitante/",
			data: dados,
			success: function( data )
					{
						if(data == 1)
						{
							alert("Erro ao cadastrar");
						}
						else
						{
							alert("cadastrado com sucesso");
						}
						location.reload();
					}
		});
		
		return false;

	});

});