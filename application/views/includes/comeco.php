<!DOCTYPE html>
<html>
    <head>
        <title>R.S.C</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

        <link rel="icon" href="<?php echo base_url('images/icone.ico');?>" sizes="128x128" />

        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/bootstrap/bootstrap.css');?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/DataTables/datatables.min.css');?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/DataTables/datatables.bootstrap.min.css');?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/DataTables/responsive.bootstrap.min.css');?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/menu/styles.css');?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/menu/normalize.css');?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/menu/demo.css');?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/menu/component.css');?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/menu/fontes.css');?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/principal.css');?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/jquery-ui.css');?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/fullcalendar/fullcalendar.css');?>" />

        <script type="text/javascript" src="<?php echo base_url('js/jquery-1.11.3.min.js');?>" ></script>
        <script type="text/javascript" src="<?php echo base_url('js/bootstrap/bootstrap.js');?>" ></script>
        <script type="text/javascript" src="<?php echo base_url('js/DataTables/datatables.min.js');?>" ></script>
        <script type="text/javascript" src="<?php echo base_url('js/DataTables/datatables.bootstrap.min.js');?>" ></script>
        <script type="text/javascript" src="<?php echo base_url('js/DataTables/datatables.responsive.min.js');?>" ></script>
        <script type="text/javascript" src="<?php echo base_url('js/menu/script.js');?>" ></script>
        <script type="text/javascript" src="<?php echo base_url('js/menu/classie.js');?>" ></script>
        <script type="text/javascript" src="<?php echo base_url('js/menu/gnmenu.js');?>" ></script>
        <script type="text/javascript" src="<?php echo base_url('js/moment-with-locales.js');?>" ></script>
        <script type="text/javascript" src="<?php echo base_url('js/jquery.maskedinput.min.js');?>" ></script>
        <script type="text/javascript" src="<?php echo base_url('js/administracao/tabela.js');?>" ></script>
        <script type="text/javascript" src="<?php echo base_url('js/minhaConta.js');?>" ></script>
        <script type="text/javascript" src="<?php echo base_url('js/jquery-ui.js');?>" ></script>
        <script type="text/javascript" src="<?php echo base_url('js/fullcalendar/fullcalendar.js');?>" ></script>
        <script type="text/javascript" src="<?php echo base_url('js/fullcalendar/pt-br.js');?>" ></script>
        <script type="text/javascript" src="<?php echo base_url('js/areaComum/calendario.js');?>" ></script>
        <script type="text/javascript" src="<?php echo base_url('js/pagina/lista.js');?>" ></script>
        <script type="text/javascript" src="<?php echo base_url('js/visitante/tabela.js');?>" ></script>
        <script type="text/javascript" src="<?php echo base_url('js/canvasjs/jquery.canvasjs.min.js');?>" ></script>
        <script type="text/javascript" src="<?php echo base_url('js/fluxo/grafico.js');?>" ></script>
        <script type="text/javascript" src="<?php echo base_url('js/administracao/tipoFuncionarios.js');?>" ></script>

        <script type="text/javascript">
			$(function() {
				moment.lang("pt-br");
				$(".hora").html( moment().format('h:mm:ss a') );

				setInterval( function() {
					$(".hora").html( moment().format('h:mm:ss a') );
					}, 1000
				);
			});
		</script>

    </head>

    <body>
    <?php echo $menu;?>