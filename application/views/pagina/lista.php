<div class="conteudo">
<div class="container-fluid">
	<h1 class="text-center">Atribuir Páginas</h1>
	<div class="checkboxPaginas">

	<form id="formListaUsuarios">
	<div class="col-md-10">
		<div class="form-group">
			<label for="recipient-name" class="control-label">Usuario: </label>
			<input type="text" class="form-control" name="usuario" id="listaUsuarios" placeholder="Digite o Nome" required>
		</div>
	</div>
	</form>

	<div class="col-md-2">
		<div class="form-group">
			<label for="recipient-name" class="control-label">Buscar</label>
        	<button type="button" class="btn btn-default glyphicon glyphicon-ok" id="botaoLista" data-dismiss="modal"> </button>
		</div>
	</div>
    <br><br><br><br>

    <div id="listaPaginas"></div>	

<?php
	/*foreach ($lista as $linha) {
		echo '<div class="checkbox"><label>';
		echo '<input type="checkbox" name="pagina" value="'.$linha->pags_id_pags.'">';
		echo $linha->pags_apelido;
		echo '</label></div>';
	}*/

?>
	</div>
</div>
</div>