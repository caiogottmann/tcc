$(function() {

	$('#modalEsqueceu').on('shown.bs.modal', function () {
	  	$('#inputemail_usuario').focus();
	});
		
	$('#modalEsqueceu').submit(function(){
		
		var dados = $('#inputemail_usuario').serialize();


		$.ajax({
			type: "POST",
			url: "./Login/recuperar/",
			data: dados,
			success: function( data )
					{
						alert(data);
						
					}
		});

		//javascript:alert('Email enviado com Sucesso!');
		//javascript:window.location='index.php';

location.reload();

/*<b>O código de recuperação foi enviado em seu email!</b>
<p>Não esqueça de verificar a caixa de SPAM de seu e-mail, para ter certeza do recebimento do código de recuperação de senha</p>
<p>Atenciosamente, Balão da Informática</p>*/



	});

});