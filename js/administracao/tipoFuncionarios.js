function excluirTipo(){

var id = $(".excluirTipo").val();

		$.get("./../TipoFuncionario/excluirTipoById/"+id,
		  	function(data){
			if (data == "1") {
				alert("Excluido com Sucesso!");
				$("#"+ id ).fadeOut(500);
			};
		});
}

$(function() {


	

	$('#modalFormTipoFunc').submit(function(){
		var dados = $('#modalFormTipoFunc').serialize();

		$.ajax({
			type: "POST",
			url: "./../TipoFuncionario/novoTipoFuncionario/",
			data: dados,
			success: function( data )
					{
						alert(data);
						location.reload();
					}
		});
		
		return false;

	});

});