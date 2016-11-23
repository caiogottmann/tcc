<div class="conteudo">
<div class="table-responsive">
  <table class="table table-hover tabelabt table-striped table-bordered dt-responsive nowrap" name="funcionario">
    <thead>
      <tr>
        <th><a type="button" id="novoFuncionario" class='icon icon-plus' data-toggle="modal" data-target="#modalNovoFuncionario"></a></th>
        <th>Nome</th>
        <th>CPF</th>
        <th>RG</th>
        <th>E-Mail</th>
        <th>Telefone</th>
        <th>Celular</th>
        <th>Tipo</th>
        <th>Excluir</th>
      </tr>
    </thead>
    <tbody>
<?php
  if ($obj) {
    foreach ($obj as $linha) {
      echo "<tr id='$linha->func_id_func'>";
      echo "<td name='#'>$linha->func_id_func</td>";
      echo "<td name='usuario_nome'>$linha->usuario_nome</td>";
      echo "<td name='usuario_cpf'>$linha->usuario_cpf</td>";
      echo "<td name='usuario_rg'>$linha->usuario_rg</td>";
      echo "<td name='usuario_email'>$linha->usuario_email</td>";
      echo "<td name='usuario_tel'>$linha->usuario_tel</td>";
      echo "<td name='usuario_cel'>$linha->usuario_cel</td>";
      echo "<td name='tipofunc_tipo'>$linha->tipofunc_tipo</td>";
      echo "<td name='excluir'>";
      echo '<button type="button" onClick="excluirFunc('.$linha->func_id_func.')" type="button" class="glyphicon glyphicon-trash btn btn-danger btn-xs excluirFunc" ></button>';
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
<div class="modal fade" id="modalNovoFuncionario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Cadastro de Funcionario</h4>
      </div>
      
      <form id="modalFormFuncionario" action="./Funcionario/novoFuncionario/" method="POST">
      <div class="modal-body">
      <div class="container-fluid">

        <div class="col-md-12">
          <div class="form-group">
            <label for="recipient-name" class="control-label">Usuarios</label>
            <input type="text" class="form-control" name="usuario" id="usuarios" placeholder="Digite o Nome" required>
          </div>
        </div>

        <div class="col-md-12">
          <div class="form-group">
            <label for="recipient-name" class="control-label">Funções</label>
            <div id="selectTipos"></div>
          </div>
        </div>

      </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary" >Cadastrar</button>
      </div>
      </form>

    </div>
  </div>
</div>