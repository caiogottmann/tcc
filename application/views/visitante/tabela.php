<div class="conteudo">
<div class="table-responsive">
  <table class="table table-hover tabelabt table-striped table-bordered dt-responsive nowrap" name="visitante">
    <thead>
      <tr>
        <th><a type="button" id="novoUsuario" class='icon icon-plus' data-toggle="modal" data-target="#modalNovoVisitante"></a></th>
        <th>Morador</th>
        <th>Visitante</th>
        <th>CPF</th>
        <th>RG</th>
        <th>Data</th>
        
      </tr>
    </thead>
    <tbody>
<?php
  if ($obj) {

    foreach ($obj as $linha) {
      echo "<tr id='$linha->vis_id_vis'>";
      echo "<td name='#'>$linha->vis_id_vis</td>";
      echo "<td name='usuario_nome'>$linha->usuario_nome</td>";
      echo "<td name='vis_nome'>$linha->vis_nome</td>";
      echo "<td name='vis_cpf'>$linha->vis_cpf</td>";
      echo "<td name='vis_rg'>$linha->vis_rg</td>";
      echo "<td name='vis_tel'>$linha->vis_data</td>";

      echo "</tr>";
    }
  }

  ?>
      
    </tbody>
  </table>
</div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalNovoVisitante" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Cadastro de Visitante</h4>
      </div>
      
      <form id="modalVisitante" >
      <div class="modal-body">
      <div class="container-fluid">

        <div class="col-md-12">
          <div class="form-group">
            <label for="recipient-name" class="control-label">Morador</label>
            <input type="text" class="form-control" name="usuario" id="usuarios" placeholder="Digite o Nome" required>
          </div>
        </div>

        <div class="col-md-12">
          <div class="form-group">
            <label for="recipient-name" class="control-label">Visitante</label>
            <input type="text" class="form-control" name="visitante" id="visitante" placeholder="Digite o Nome" required>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label for="recipient-name" class="control-label">CPF</label>
            <input type="text" class="form-control" name="cpf" id="cpfVisitante" placeholder="Digite o CPF" required>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label for="recipient-name" class="control-label">RG</label>
            <input type="text" class="form-control" name="rg" id="rgVisitante" placeholder="Digite o RG" required>
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