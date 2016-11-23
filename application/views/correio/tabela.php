<div class="conteudo">


<div class="table-responsive">
  <table class="table table-hover tabelabt table-striped table-bordered dt-responsive nowrap" name="correio">
    <thead>
      <tr>
      <th><a type="button" id="novoUsuario" class='icon icon-plus' data-toggle="modal" data-target="#modalNovaEntrega"></a></th>
        <th>Morador</th>
        <th>Nome do Remetente</th>
        <th>RG do Remetente</th>
        <th>Empresa Remetente</th>
        <th>Data de Entrega</th>
        <th>Excluir</th>
      </tr>
   	</thead>
   	<tbody>
<?php
  if ($obj) {
  	foreach ($obj as $linha) {
  		echo "<tr id='$linha->correio_id_correio'>";
  		echo "<td name='#'>$linha->correio_id_correio</td>";
  		echo "<td name='usuario_nomes'>$linha->usuario_nome</td>";
  		echo "<td name='correio_nome_correio'>$linha->correio_nome_correio</td>";
  		echo "<td name='correio_rg_correio'>$linha->correio_rg_correio</td>";
      echo "<td name='correio_empre_correio'>$linha->correio_empre_correio</td>";
      echo "<td name='correio_data'>$linha->correio_data</td>";
    	echo "<td name='excluir'>";
      echo '<button type="button" onClick="excluirCorreio()" value="'.$linha->correio_id_correio.'" class="icon icon-remove2 btn btn-danger btn-xs excluirCorr"></button>';
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
<div class="modal fade" id="modalNovaEntrega" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Cadastro de Entrega</h4>
      </div>
      
      <form id="modalFormEntrega" >
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
            <label for="recipient-name" class="control-label">Nome do Entregador</label>
            <input type="text" class="form-control" name="nome_empregador" id="nome_empregador" placeholder="Nome do Entregador" required>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label for="recipient-name" class="control-label">RG do Entregador</label>
            <input type="text" class="form-control" name="rg_empregador" id="rg_empregador" placeholder="Rg do Entregador" required>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label for="recipient-name" class="control-label">Nome da Empresa</label>
            <input type="text" class="form-control" name="empresa" id="empresa" placeholder="Nome da Empresa" required>
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