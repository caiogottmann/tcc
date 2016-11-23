<html>
  <head>
    <title>Área Restrita</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/bootstrap/bootstrap.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/principal.css');?>">

    <script type="text/javascript" src="<?php echo base_url('js/jquery-1.11.3.min.js');?>" ></script>
    <script type="text/javascript" src="<?php echo base_url('js/bootstrap/bootstrap.js');?>" ></script>
    <script type="text/javascript" src="<?php echo base_url('js/login.js');?>" ></script>
    <script type="text/javascript" src="<?php echo base_url('js/minhaConta.js');?>" ></script>

    <style>

    body {
		background: #01579B;
	}

    </style>
  </head>
  <body>
  <div class="conteudo">
  	<div class="col-md-12">
	    <h4 align="center">Atualizar Senha</h4>
	</div>

			<form id="modalFormSenhaByEmail" >
				<div class="modal-body">
				<input type="hidden" id="iduser" name="iduser" value="<?php echo $id;?>">

				<div class="col-md-6">
					<div class="form-group" id="divSenha">
					<label for="recipient-name" class="control-label">Digite a nova Senha</label>
					<input type="password" class="form-control" name="senha" id="senha" placeholder="Senha" required>
					</div>
					<hr>
				</div>

				<div class="col-md-6">
					<div class="form-group" id="divSenha2">
					<label for="recipient-name" class="control-label">Digite novamente a nova Senha</label>
					<input type="password" class="form-control" name="senha2" id="senha2"  placeholder="Senha" required>
					</div>
					<hr>
				</div>

				</div>

				<div class="modal-footer">
					<button type="submit" class="btn btn-primary" >Atualizar</button>
				</div>
			</form>
	</div>

			
</body>
</html>