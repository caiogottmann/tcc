$(function() {

	$('#listaUsuarios').keyup(function(){
		var nome = $('#listaUsuarios').val();
		$.get("./Correio/exibirUsuarioLikeNome/" +nome,
			  	function(data){
					$("#listaUsuarios").autocomplete({ source: $.parseJSON(data) });				
			});
	});

	$('#botaoLista').click(function(){
		var nome = $('#listaUsuarios').val();

		if (nome != '') {
			var dados = $('#formListaUsuarios').serialize();

			$.ajax({
			  type: "POST",
			  url: "./Pagina/exibirListaByNome/",
			  data: dados,
			  success: function( data )
						{
							$("#listaPaginas").html(data);
						}
			});
		}
		else {
			alert('Selecione um Usuario valido!!');
		};
	});

});