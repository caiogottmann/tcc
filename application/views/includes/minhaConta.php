<div class="conteudo ">

	<h1 class="text-center">Dados da Conta</h1>

	<form id="minhaConta">
		<input type="hidden" name="end" value="<?php echo $endereco->end_id_end;?>">
		<input type="hidden" id="idEstado" value="<?php echo $endereco->end_id_estado;?>">

		<div class="form-group">
			<label for="recipient-name" class="control-label">Nome</label>
			<input type="text" class="form-control" name="nome" placeholder="Nome" value="<?php echo $usuario[0]->usuario_nome;?>" required>
		</div>

		<div class="form-group" id="formCpf">
			<label for="recipient-name" class="control-label">CPF</label>
			<input type="text" class="form-control" name="cpf" id="modalCpf" placeholder="CPF" value="<?php echo $usuario[0]->usuario_cpf;?>" required>
		</div>

		<div class="form-group">
			<label for="recipient-name" class="control-label">Rg</label>
			<input type="text" class="form-control" name="rg" id="modalRg" placeholder="Rg" value="<?php echo $usuario[0]->usuario_rg;?>" required>
		</div>

		<div class="form-group">
			<label for="recipient-name" class="control-label">E-mail</label>
			<input type="email" class="form-control" name="e-mail" placeholder="RSC@example.com" value="<?php echo $usuario[0]->usuario_email;?>" required>
		</div>

		<div class="form-group">
			<label for="recipient-name" class="control-label">Telefone</label>
			<input type="text" class="form-control" name="tel" id="modalTel" placeholder="Telefone" value="<?php echo $usuario[0]->usuario_tel;?>" >
		</div>

		<div class="form-group">
			<label for="recipient-name" class="control-label">Celular</label>
			<input type="text" class="form-control" name="cel" id="modalCel" placeholder="Celular" value="<?php echo $usuario[0]->usuario_cel;?>" >
		</div>

		<div class="form-group">
			<label for="recipient-name" class="control-label">Rua</label>
			<input type="text" class="form-control" name="rua"  placeholder="Rua" value="<?php echo $endereco->end_rua;?>" required>
		</div>

		<div class="form-group">
			<label for="recipient-name" class="control-label">Numero</label>
			<input type="text" class="form-control" name="numero" placeholder="Numero" value="<?php echo $endereco->end_numero;?>" required>
		</div>

		<div class="form-group">
			<label for="recipient-name" class="control-label">Complemento</label>
			<input type="text" class="form-control" name="complemento" placeholder="Complemento" value="<?php echo $endereco->end_complemento;?>" required>
		</div>

		<div class="form-group">
			<label for="recipient-name" class="control-label">Bairro</label>
			<input type="text" class="form-control" name="bairro" placeholder="Bairro" value="<?php echo $endereco->end_bairro;?>" required>
		</div>

		<div class="form-group">
			<label for="recipient-name" class="control-label">Estado</label>
          	<div id="selectEstadosConta"></div>
		</div>

		<div class="form-group">
			<label for="recipient-name" class="control-label">Login</label>
			<input type="text" class="form-control" name="login" placeholder="Login" value="<?php echo $login->login_usuario;?>" readonly>
		</div>

		<div class="form-group">
			<label for="recipient-name" class="control-label">Senha</label>
			<input type="password" class="form-control" name="senha" data-toggle="modal" data-target="#modalSenha" placeholder="Senha" value="********" readonly>
		</div>

		<button type="submit" class="btn btn-primary">Atualizar</button>
	
	</form>

</div>


<!-- Modal -->
<div class="modal fade" id="modalSenha" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="exampleModalLabel">Atualizar Senha</h4>
			</div>

		<form id="modalFormSenha" >
			<div class="modal-body">

			<div class="col-md-6">
				<div class="form-group" id="divSenha">
				<label for="recipient-name" class="control-label">Digite a nova Senha</label>
				<input type="password" class="form-control" name="senha" id="senha" placeholder="Senha" required>
				</div>
			</div>

			<div class="col-md-6">
				<div class="form-group" id="divSenha2">
				<label for="recipient-name" class="control-label">Digite novamente a nova Senha</label>
				<input type="password" class="form-control" name="senha2" id="senha2"  placeholder="Senha" required>
				</div>
			</div>

			<hr><hr>

			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
				<button type="submit" class="btn btn-primary" id="modalCadastrar">Atualizar</button>
			</div>
		</form>

		</div>
	</div>
</div>