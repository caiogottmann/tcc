function validarCPF(cpf) {  
    cpf = cpf.replace(/[^\d]+/g,'');    
    if(cpf == '') return false; 
    // Elimina CPFs invalidos conhecidos    
    if (cpf.length != 11 || 
        cpf == "00000000000" || 
        cpf == "11111111111" || 
        cpf == "22222222222" || 
        cpf == "33333333333" || 
        cpf == "44444444444" || 
        cpf == "55555555555" || 
        cpf == "66666666666" || 
        cpf == "77777777777" || 
        cpf == "88888888888" || 
        cpf == "99999999999")
            return false;       
    // Valida 1o digito 
    add = 0;    
    for (i=0; i < 9; i ++)       
        add += parseInt(cpf.charAt(i)) * (10 - i);  
        rev = 11 - (add % 11);  
        if (rev == 10 || rev == 11)     
            rev = 0;    
        if (rev != parseInt(cpf.charAt(9)))     
            return false;       
    // Valida 2o digito 
    add = 0;    
    for (i = 0; i < 10; i ++)        
        add += parseInt(cpf.charAt(i)) * (11 - i);  
    rev = 11 - (add % 11);  
    if (rev == 10 || rev == 11) 
        rev = 0;    
    if (rev != parseInt(cpf.charAt(10)))
        return false;       
    return true;   
}

function excluirUser(){
	var id = $(".excluirUsu").val();
	
	$.get("./../Administracao/excluirUsuarioById/"+id,
		  	function(data){
			if (data == "1") {
				alert("Excluido com Sucesso!");
				$("#"+ id ).fadeOut(500);
				$('.child').fadeOut(500);
			};
		});
}

function excluirFunc(id){
	
	$.get("./Administracao/excluirFuncionarioById/"+id,
		  	function(data){
			if (data == "1") {
				alert("Excluido com Sucesso!");
				$("#"+ id ).fadeOut(500);
				$('.child').fadeOut(500);
			};
		});
}

function excluirCorreio(){
	var id = $(".excluirCorr").val();
	
	$.get("./Correio/excluirCorreioById/"+id,
			  	function(data){
				if (data == "1") {
					alert("Excluido com Sucesso!");
					$("#"+ id ).fadeOut(500);
					$('.child').fadeOut(500);
				}
			});
}

function confirmarCorreio(){
	var id = $(".confirmarCorr").val();
	
	$.get("./confirmarCorreioById/"+id,
			  	function(data){
				if (data == "1") {
					alert("Confirmado com Sucesso!");
					$("#"+ id ).fadeOut(500);
					$('.child').fadeOut(500);
				}
			});
}

$(function() {

	$("td").dblclick(function () {
		var url = $(this).parent().parent().parent().attr("name");

	    var conteudoOriginal = $(this).text();
	    var coluna = $(this).attr("name");
		if((coluna !="#")&&(coluna !="excluir")&&(coluna !="correio_data")&&(coluna !="usuario_nomes")&&(url !="funcionario")&&(url !="visitante"))
		{
				$(this).addClass("celulaEmEdicao");

				if(coluna == "tipoFunc_obs")
				{
					$(this).html("<textarea id='" + coluna + "' >" + conteudoOriginal + "</textarea>");
				}
				else
				{
					$(this).html("<input type='text' id='" + coluna + "' value='" + conteudoOriginal + "' />");
				}
			

				
			
			$(this).children().first().focus();
			
			$("#usuario_cpf").mask("999.999.999-99");
			$("#usuario_rg").mask("99.999.999-*");
			$("#correio_rg_correio").mask("99.999.999-*");
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
						if(url == "correio") {

							$.get("./Correio/alterarCorreio/"+ID+"/"+coluna+"/"+novoConteudo,  function(Resposta){
							if(Resposta == "1")
							{
								alert("Alterado com Sucesso!");
							}
							else
							{
								alert("Erro 001: Erro ao alterar !");
							}

						});

						}
						else if (url == "usuario") {

								$.get("./../Administracao/alterarUsuarios/"+ID+"/"+coluna+"/"+novoConteudo,  function(Resposta){
											if(Resposta == "1")
											{
												alert("Alterado com Sucesso!");
											}
											else
											{
												alert("Erro 001: Erro ao alterar !");
											}

										});

						}
						else if (url == "tipoUsuario")
						{
							$.get("./../TipoFuncionario/alterarTipo/"+ID+"/"+coluna+"/"+novoConteudo,  function(Resposta){
							if(Resposta == "1")
							{
								alert("Alterado com Sucesso!");
							}
							else
							{
								alert("Erro 001: Erro ao alterar !");
							}
							});
						}


							
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

	$("#modalCpf").mask("999.999.999-99");
	$("#rgVisitante").mask("99.999.999-*");	
	$("#cpfVisitante").mask("999.999.999-99");
	$("#modalRg").mask("99.999.999-*");	
	$("#rg_empregador").mask("99.999.999-*");	
	$("#modalTel").mask("(999) 9999-9999");	
	$("#modalCel").mask("(999) 99999-9999");
	$("#modalCel").mask("(999) 99999-9999");

	$('#modalForm').submit(function(){
		var dados = $('#modalForm').serialize();

		$.ajax({
			type: "POST",
			url: "./../Administracao/novoUsuario/",
			data: dados,
			success: function( data )
					{
						alert(data);
						location.reload();
					}
		});
		
		return false;

	});

	//tabela de usuario
	$('.funcao').fadeOut(100);
	$('.nivel').change(function(){

			var id_nivel = $('.nivel').val();

			if(id_nivel == "F")
			{
				$('.funcao').fadeIn(1200);
				$.get("./../Administracao/exibirTiposFuncionarios",
		  		function(data){
					if (data != null) {
						$("#selectFuncionarios").html(data);
					};
				});
			}
			else
			{
				$('.funcao').fadeOut(1200);
			}
		});






	$('#usuarios').keyup(function(){
		var nome = $('#usuarios').val();
		$.get("./Correio/exibirUsuarioLikeNome/" +nome,
			  	function(data){
					$("#usuarios").autocomplete({ source: $.parseJSON(data) });				
			});
	});

	$('#modalFormEntrega').submit(function(){
		var dados = $('#modalFormEntrega').serialize();

		$.ajax({
			type: "POST",
			url: "./Correio/Cadastro/",
			data: dados,
			success: function( data )
					{
						if (data == 0) {
							alert('Cadastro feito com Sucesso !');
							location.reload();
						}
						else {
							alert('Algo deu errado !');
						}
					}
		});
		
		return false;

	});

	$('#modalFormFuncionario').submit(function(){
		var dados = $('#modalFormFuncionario').serialize();

		$.ajax({
			type: "POST",
			url: "./Funcionario/novoFuncionario/",
			data: dados,
			success: function( data )
					{
						if (data == 0) {
							alert('Cadastro feito com Sucesso !');
							location.reload();
						}
						else {
							alert('Algo deu errado !');
						}
					}
		});
		
		return false;

	});



	$('.tabelabt').DataTable( {
		"language": {
            "lengthMenu":     "Mostrando _MENU_ registros por pagina",
		    "emptyTable":     "Não há registros disponíveis",
		    "info":           "Pagina _PAGE_ de _PAGES_",
		    "infoEmpty":      "Não há registros disponíveis",
		    "infoFiltered":   "(filtered from _MAX_ total entries)",
		    "loadingRecords": "Carregando...",
		    "processing":     "Carregando...",
		    "search":         "Buscar: ",
		    "zeroRecords":    "Sem registros - Desculpe :(",
		    "paginate": {
		        "first":      "Primeiro",
		        "last":       "Ultimo",
		        "next":       "Proximo",
		        "previous":   "Anterior"
		    }
        },
        "scrollX": false,
        "scrollY": false,
        "order": [[ 1, "asc" ]],
        "pageLength": 10,
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todos"]]
    } );

    $('#modalNovoFuncionario').on('show.bs.modal', function (e) {
    	$.get("./TipoFuncionario/exibirTipos",
		  	function(data){
			if (data != null) {
				$("#selectTipos").html(data);
			};
		});
	})

    $('#modalNovoUsuario').on('show.bs.modal', function (e) {
    	$.get("./../Administracao/exibirEstados",
		  	function(data){
			if (data != null) {
				$("#selectEstados").html(data);
			};
		});
	});

    $('#modalCpf').focusout(function() {
    	var cpf = $(this).val();
    	var res = validarCPF(cpf);
    	if (res) {
    		$('#formCpf').removeClass();
    		$('#formCpf').toggleClass( "form-group has-success" );

    		$('#modalCadastrar').removeClass();
    		$('#modalCadastrar').toggleClass('btn btn-primary');
    	} else {
    		$('#formCpf').removeClass();
    		$('#formCpf').toggleClass( "form-group has-error" );

    		alert('Digite um CPF valido!');

    		$('#modalCpf').focus();

    		$('#modalCadastrar').removeClass();
    		$('#modalCadastrar').toggleClass('btn btn-danger disabled');
    	}
    });

    $('#usuarioSenha').focusout(function() {
    	senha = $('#usuarioSenha').val();
		senha2 = $('#usuarioSenha2').val();

   		if (senha == senha2) {
			$("#modalUsuarioSenha").removeClass();
			$("#modalUsuarioSenha").toggleClass("form-group has-success");
			$("#modalUsuarioSenha2").removeClass();
			$("#modalUsuarioSenha2").toggleClass("form-group has-success");
    		$('#modalCadastrar').removeClass();
    		$('#modalCadastrar').toggleClass('btn btn-primary');
		}
		else {
			$("#modalUsuarioSenha").removeClass();
			$("#modalUsuarioSenha").toggleClass("form-group has-error");
			$("#modalUsuarioSenha2").removeClass();
			$("#modalUsuarioSenha2").toggleClass("form-group has-error");
    		$('#modalCadastrar').removeClass();
    		$('#modalCadastrar').toggleClass('btn btn-danger disabled');
		}
    });

    $('#usuarioSenha2').focusout(function() {
    	senha = $('#usuarioSenha').val();
		senha2 = $('#usuarioSenha2').val();

   		if (senha == senha2) {
			$("#modalUsuarioSenha").removeClass();
			$("#modalUsuarioSenha").toggleClass("form-group has-success");
			$("#modalUsuarioSenha2").removeClass();
			$("#modalUsuarioSenha2").toggleClass("form-group has-success");
    		$('#modalCadastrar').removeClass();
    		$('#modalCadastrar').toggleClass('btn btn-primary');
		}
		else {
			$("#modalUsuarioSenha").removeClass();
			$("#modalUsuarioSenha").toggleClass("form-group has-error");
			$("#modalUsuarioSenha2").removeClass();
			$("#modalUsuarioSenha2").toggleClass("form-group has-error");
    		$('#modalCadastrar').removeClass();
    		$('#modalCadastrar').toggleClass('btn btn-danger disabled');
		}
    });

});