$(function() {

	var senha = "";
	var senha2 = "";

	$('#senha').change(function() {
		senha = $('#senha').val();
		senha2 = $('#senha2').val();

   		if (senha == senha2) {
			$("div[id=divSenha]").removeClass();
			$("div[id=divSenha]").toggleClass("form-group has-success");
			$("div[id=divSenha2]").removeClass();
			$("div[id=divSenha2]").toggleClass("form-group has-success");
		}
		else {
			$("div[id=divSenha]").removeClass();
			$("div[id=divSenha]").toggleClass("form-group has-error");
			$("div[id=divSenha2]").removeClass();
			$("div[id=divSenha2]").toggleClass("form-group has-error");
		}

		$('#teste').val(senha);
		$('#teste2').val(senha2);
	});

	$('#senha2').change(function() {
		senha = $('#senha').val();
		senha2 = $('#senha2').val();

   		if (senha == senha2) {
			$("div[id=divSenha]").removeClass();
			$("div[id=divSenha]").toggleClass("form-group has-success");
			$("div[id=divSenha2]").removeClass();
			$("div[id=divSenha2]").toggleClass("form-group has-success");
		}
		else {
			$("div[id=divSenha]").removeClass();
			$("div[id=divSenha]").toggleClass("form-group has-error");
			$("div[id=divSenha2]").removeClass();
			$("div[id=divSenha2]").toggleClass("form-group has-error");
		}

		$('#teste').val(senha);
		$('#teste2').val(senha2);
	});

	$('#modalFormSenha').submit(function(){

		senha = $('#senha').val();
		senha2 = $('#senha2').val();

		if (senha != senha2) {
			alert('Erro: as senhas não são iguais!');
			$("div.form-group").toggleClass("has-error");
		}
		else {
			var dados = $('#modalFormSenha').serialize();

			$.ajax({
				type: "POST",
				url: "./../Login/updateSenha/",
				data: dados,
				success: function( data )
						{
							alert(data);
						}
			});
			
			return false;
		}
		
	});

	//usado para alterar a senha assim quando o usuario entrar no link que foi enviado por email
	$('#modalFormSenhaByEmail').submit(function(){

		senha = $('#senha').val();
		senha2 = $('#senha2').val();

		if (senha != senha2) {
			alert('Erro: as senhas não são iguais!');
			$("div.form-group").toggleClass("has-error");
		}
		else {
			var dados = $('#modalFormSenhaByEmail').serialize();

			$.ajax({
				type: "POST",
				url: "./../updateSenhaByIdWithHidden/",
				data: dados,
				success: function( data )
						{
							alert(data);
							window.location.href = "./../../Login";
						}
			});
			
			return false;
		}
		
	});

	$('#minhaConta').submit(function(){

		var dados = $('#minhaConta').serialize();

		$.ajax({
			type: "POST",
			url: "./../Administracao/updateConta/",
			data: dados,
			success: function( data )
					{
						alert(data);
					}
		});
		
		return false;
		
	});

	var estado = $("#idEstado").val();
	
	$.get("./../Administracao/exibirEstados/" + estado,
	  	function(data){
		if (data != null) {
			$("#selectEstadosConta").html(data);
		};
	});



});