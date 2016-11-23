<script type="text/javascript">
	$(function() {
		  $('#inicio').fadeIn(1200);

		  $('.alerta').fadeOut(15000);

		  $( "div.alerta" )
		  .on( "mouseenter", function() {
		  	$( this ).stop();
			$(this).animate({ opacity: 100 });
		  })
		  .on( "mouseleave", function() {
		  	$(this).fadeOut(15000);
		  });

		
	});
</script>
<div id="alerta-prin">
<?php if($correio[0]->total != 0)
{
?>
	<div class="alert alert-danger alerta" role="alert">


	  <a href="#" class="alert-link">Total de <?php echo $correio[0]->total?> corespondencia(s) pendente(s). <br>Favor comparecer a portaria.</a>
	</div>
<?php
}
?>

<?php if(@$area[0]->total != 0)
{
?>
	<div class="alert alert-danger alerta" role="alert">

	  <a href="<?php echo base_url('/AreaComum/verificarPendentes/'); echo '/'.$area[0]->al_id_al?>" class="alert-link">Total de <?php echo $area[0]->total?> requerimento(s) para avaliação.</a>
	</div>
<?php
}
foreach ($area_conf as $linha) {
?>

<?php if(@$linha->al_situacao == "A")
{
	
?>
	<div class="alert alert-success alerta" role="alert">

	  <a href="#" class="alert-link">Área comum (<?php echo $linha->ac_nome?>) confirmada para o dia <?php echo $linha->al_data ?></a>
	</div>
<?php

}
else if(@$linha->al_situacao == "I")
{
	?>
	<div class="alert alert-warning alerta" role="alert">

	  <a href="#" class="alert-link">Área comum negada para o dia <?php echo $linha->al_data ?></a>
	</div>
<?php
} else if(@$linha->al_situacao == "P")
{
	?>
		<div class="alert alert-info alerta" role="alert">

	  <a href="#" class="alert-link">Área comum em avaliação para o dia <?php echo $linha->al_data ?></a>
	</div>
	<?php

}	
}
?>
</div>



<div id="inicio">

<img src=' <?php echo base_url('images/logo.png')   ?>' />

	<h1>Seja bem-vindo</h1>

	<div id="nome">
		<u>
			<?php echo $obj[0]->usuario_nome?>
		</u>
	</div>
	
</div>