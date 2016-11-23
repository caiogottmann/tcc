<div class="conteudo">
<div class="table-responsive">
  <table class="table table-hover tabelabt table-striped table-bordered dt-responsive nowrap" name="usuario">
    <thead>
      <tr>
        <th><a type="button" id="novoUsuario" class='icon icon-plus' data-toggle="modal" data-target="#modalNovoUsuario"></a></th>
        <th>Nome</th>
        <th>CPF</th>
        <th>RG</th>
        <th>E-Mail</th>
        <th>Telefone</th>
        <th>Celular</th>
        <th>Rua</th>
        <th>Numero</th>
        <th>Bairro</th>
        <th>Complemento</th>
        <th>Excluir</th>
      </tr>
   	</thead>
   	<tbody>
<?php
  if ($obj) {
  	foreach ($obj as $linha) {
  		echo "<tr id='$linha->usuario_id_usuario'>";
  		echo "<td name='#'>$linha->usuario_id_usuario</td>";
  		echo "<td name='usuario_nome'>$linha->usuario_nome</td>";
  		echo "<td name='usuario_cpf'>$linha->usuario_cpf</td>";
  		echo "<td name='usuario_rg'>$linha->usuario_rg</td>";
      echo "<td name='usuario_email'>$linha->usuario_email</td>";
  		echo "<td name='usuario_tel'>$linha->usuario_tel</td>";
      echo "<td name='usuario_cel'>$linha->usuario_cel</td>";
      echo "<td name='end_rua'>$linha->end_rua</td>";
      echo "<td name='end_numero'>$linha->end_numero</td>";
      echo "<td name='end_bairro'>$linha->end_bairro</td>";
      echo "<td name='end_complemento'>$linha->end_complemento</td>";
    	echo "<td name='excluir'>";
      echo '<button type="button" onClick="excluirUser()" value="'.$linha->usuario_id_usuario.'" class="glyphicon glyphicon-trash btn btn-danger btn-xs excluirUsu"></button>';
    	echo "</td>";
      
      echo "</tr>";
    }
  }

	?>
      
    </tbody>
  </table>
</div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalNovoUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Cadastro de Usuario</h4>
      </div>
      
      <form id="modalForm" action="./../Administracao/novoUsuario/" method="POST">
      <div class="modal-body">
      <div class="container-fluid">
          <div class="col-md-12">
            <div class="form-group">
              <label for="recipient-name" class="control-label">Nome</label>
              <input type="text" class="form-control" name="nome" placeholder="Nome" required>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group" id="formCpf">
              <label for="recipient-name" class="control-label">CPF</label>
              <input type="text" class="form-control" name="cpf" id="modalCpf" placeholder="CPF" required>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label for="recipient-name" class="control-label">Rg</label>
              <input type="text" class="form-control" name="rg" id="modalRg" placeholder="Rg" required>
            </div>
          </div>

          
          <div class="col-md-12">
            <div class="form-group">
              <label for="recipient-name" class="control-label">E-mail</label>
               <input type="email" class="form-control" name="e-mail" placeholder="RSC@example.com" required>
            </div>
          </div>  

          <div class="col-md-6">
            <div class="form-group">
              <label for="recipient-name" class="control-label">Telefone</label>
              <input type="text" class="form-control" name="tel" id="modalTel" placeholder="Telefone" >
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label for="recipient-name" class="control-label">Celular</label>
              <input type="text" class="form-control" name="cel" id="modalCel" placeholder="Celular" >
            </div>
          </div>

          <div class="col-md-9">
            <div class="form-group">
              <label for="recipient-name" class="control-label">Rua</label>
              <input type="text" class="form-control" name="rua"  placeholder="Rua" required>
            </div>
          </div>

          <div class="col-md-3">
            <div class="form-group">
              <label for="recipient-name" class="control-label">Numero</label>
              <input type="text" class="form-control" id="modalNum" name="numero" placeholder="Numero" required>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label for="recipient-name" class="control-label">Complemento</label>
              <input type="text" class="form-control" name="complemento" placeholder="Ex apto 291" >
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label for="recipient-name" class="control-label">Bairro</label>
              <input type="text" class="form-control" name="bairro" placeholder="Bairro" required>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label for="recipient-name" class="control-label">RFID</label>
              <input type="text" class="form-control" name="rfid" placeholder="Tag RFID"  />
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label for="recipient-name" class="control-label">RFID Senha</label>
              <input type="text" class="form-control" name="rfidSenha" placeholder="Senha RFID" />
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label for="recipient-name" class="control-label">Estado</label>
              <div id="selectEstados"></div>
            </div>
          </div>       

          <div class="col-md-6">
            <div class="form-group">
              <label for="recipient-name" class="control-label">Login</label>
              <input type="text" class="form-control" name="login" placeholder="Login" required>
            </div>
          </div>

          <div class="col-md-6" >
            <div class="form-group" id="modalUsuarioSenha">
              <label for="recipient-name" class="control-label">Senha</label>
              <input type="password" class="form-control" name="senha" id="usuarioSenha" placeholder="Senha" required>
            </div>
          </div>

          <div class="col-md-6" >
            <div class="form-group" id="modalUsuarioSenha2">
              <label for="recipient-name" class="control-label">Confirmar Senha</label>
              <input type="password" class="form-control" name="senha2" id="usuarioSenha2" placeholder="Confirmar Senha" required>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group funcao" >
              <label for="recipient-name funcao"  class="control-label">Função</label>
              <div id="selectFuncionarios">
                
              </div>
            </div>
          </div>
          
          
      </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary" id="modalCadastrar">Cadastrar</button>
      </div>
      </form>

    </div>
  </div>
