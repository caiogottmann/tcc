<div class="conteudo ">
<div class="table-responsive">
  <table class="table table-hover tabelabt table-striped table-bordered dt-responsive nowrap" name="tipoUsuario">
    <thead>
      <tr>
        <th><a type="button" id="novoTipo" class='icon icon-plus' data-toggle="modal" data-target="#modalNovoTipo"></a></th>
        <th>Função</th>
        <th>Observação</th>
        <th>Excluir</th>
      </tr>
   	</thead>
   	<tbody>
<?php
  if ($obj) {
  	foreach ($obj as $linha) {
  		echo "<tr id='$linha->tipoFunc_id_tipoFunc'>";

  		echo "<td name='#'>$linha->tipoFunc_id_tipoFunc</td>";
  		echo "<td name='tipoFunc_tipo'>$linha->tipoFunc_tipo</td>";
  		echo "<td name='tipoFunc_obs'>$linha->tipoFunc_obs</td>";
    	echo "<td name='excluir'>";
    	echo '<button type="button" onClick="excluirTipo()" value="'.$linha->tipoFunc_id_tipoFunc.'" class="glyphicon glyphicon-trash btn btn-danger btn-xs excluirTipo" ></button>';

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
<div class="modal fade" id="modalNovoTipo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Cadastro da Função do Funcionario</h4>
      </div>
      
      <form id="modalFormTipoFunc" >
      <div class="modal-body">
          <div class="col-md-12">
            <div class="form-group">
              <label for="recipient-name" class="control-label">Função</label>
              <input type="text" class="form-control" name="funcao" placeholder="Função" required>
            </div>
          </div>

          <div class="col-md-12">
            <div class="form-group">
              <label for="recipient-name" class="control-label">Observação</label>
              <textarea class="form-control" rows="3" name="obs" id="modalObs" placeholder="Observação" required></textarea>
            </div>
          </div>
          
          <hr><hr><hr><hr><hr>
          <hr><hr><hr>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary" >Cadastrar</button>
      </div>
      </form>

    </div>
  </div>
</div>