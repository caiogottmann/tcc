$(function() {

	$(".excluir").click(function() {
		var id = $(this).attr("href").replace("#","");
		$(this).removeAttr("href");

		$.get("./excluirPorteiroById/"+id,
		  	function(data){
			if (data == "1") {
				alert("Excluido com Sucesso!");
				$("#"+ id ).fadeOut(500);
			};
		});

	});

	$("td").dblclick(function () {
	    var conteudoOriginal = $(this).text();
	    var coluna = $(this).attr("name");
		if((coluna !="#")&&(coluna !="excluir"))
		{
			$(this).addClass("celulaEmEdicao");
			if(coluna != "usuario_nivel")
			{

				$(this).html("<input type='text' id='" + coluna + "' value='" + conteudoOriginal + "' />");
			}
			else {
				$(this).html("<select id='" + coluna + "'><option value='Porteiro'>Porteiro</option><option value='Morador'>Morador</option></select>");
			}
			$(this).children().first().focus();
			
			$("#usuario_cpf").mask("999.999.999-99");
			$("#usuario_rg").mask("99.999.999-*");	
			$("#usuario_tel").mask("(999) 9999-9999");	
			$("#usuario_cel").mask("(999) 99999-9999");

			$(this).children().first().keypress(function (e) {
				if (e.which == 13) 
				{			
					var ID = $(this).parents("tr").attr("id");
					var coluna = $(this).parents("td").attr("name");
					var novoConteudo = $(this).val();

					if(novoConteudo == "") {
						alert("favor digitar corretamente");
						$(this).parent().text(conteudoOriginal);
					}
					else {
						$.get("./alterarUsuarios/"+ID+"/"+coluna+"/"+novoConteudo,  function(Resposta){
							if(Resposta == "1")
							{
								alert("Alterado com Sucesso!");
							}
							else
							{
								alert("Erro 001: Erro ao alterar !");
							}

						});
						
							
							$(this).parent().text(novoConteudo);
							$(this).parent().removeClass("celulaEmEdicao");
					}			
				}
		
			});
		
		}//fecha o if
		else
		{
			alert("Está coluna não pode ser editada!");
		   
		}
		
		$(this).children().first().blur(function(){
			$(this).parent().text(conteudoOriginal);
			$(this).parent().removeClass("celulaEmEdicao");
		});
	});

	$("#novoUsuario").click(function() {
		$.get("./exibirEstados",
		  	function(data){
			if (data != null) {
				$("#selectEstados").html(data);
			};
		});
	});

	$("#modalCpf").mask("999.999.999-99");
	$("#modalRg").mask("99.999.999-*");	
	$("#modalTel").mask("(999) 9999-9999");	
	$("#modalCel").mask("(999) 99999-9999");

	$('#modalForm').submit(function(){
		var dados = $('#modalForm').serialize();
 
		$.ajax({
			type: "POST",
			url: "./novoUsuario",
			data: dados
		})
		
		.always(function(s) {
			alert( s );
		  });
	});

});