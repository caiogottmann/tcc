<div class="conteudo">
	<div id='calendar'></div>
</div>


<!-- Modal -->
<div class="modal fade" id="modalCalendario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Agendar uma Área</h4>
      </div>
      
      <form id="modalFormCalendario" >
      <div class="modal-body">
      <div class="container-fluid">
			<div class="col-md-6">
				<div class="form-group">
					<label for="recipient-name" class="control-label">Data Selecionada</label>
					<input type="text" class="form-control" name="data" id="dataSelecionada" readonly required>
				</div>
			</div>

			<div class="col-md-6">
				<div class="form-group">
					<label for="recipient-name" class="control-label">Areas</label>
					<div id="selectAreas"></div>
				</div>
			</div>   
          
      </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary" >Agendar</button>
      </div>
      </form>

    </div>
    </div>
  </div>
 <?php if(@$area)
 {
  ?>

  <!-- Modal -->
<div class="modal fade" id="modalCalendarioAreaP" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Area Comum Pendente</h4>
      </div>
      
      <div class="modal-body">
      <div class="container-fluid">
    <div class="col-md-12">
        <div class="form-group">
          <label for="recipient-name" class="control-label">Morador</label>
          <input type="text" class="form-control" name="morador" id="morador" value="<?php echo $area[0]->usuario_nome ?>" readonly required>
        </div>
      </div>

      <div class="col-md-6">
        <div class="form-group">
          <label for="recipient-name" class="control-label">Data Selecionada</label>
          <input type="text" class="form-control" name="data" id="dataSelecionada" value="<?php echo $area[0]->al_data ?>" readonly required>
        </div>
      </div>

      <div class="col-md-6">
        <div class="form-group">
          <label for="recipient-name" class="control-label">Area</label>
          <input type="text" class="form-control" name="data" id="dataSelecionada" value="<?php echo $area[0]->ac_nome ?>" readonly required>
        </div>
      </div>   
          
      </div>
      </div>
      '<input type="hidden" id="idAluguel" value="<?php echo $area[0]->al_id_al ?>"> 

      <div class="modal-footer">
        <button type="button" class="btn btn-default" id="cancelar">Cancelar</button>
        <button type="button" class="btn btn-primary" id="confirmar">Confirmar</button>
      </div>

    </div>
    </div>
  </div>
<?php } ?>