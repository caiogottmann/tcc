<!DOCTYPE html>
<html>
  <head>
    <title>Área Restrita</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/bootstrap/bootstrap.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/principal.css');?>">

    <script type="text/javascript" src="<?php echo base_url('js/jquery-1.11.3.min.js');?>" ></script>
    <script type="text/javascript" src="<?php echo base_url('js/bootstrap/bootstrap.js');?>" ></script>
    <script type="text/javascript" src="<?php echo base_url('js/login.js');?>" ></script>

  </head>
  <body>
    <form class="form-horizontal" action="<?php base_url('Login/index')?>" method="post">
      <div id='login'>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Login</label>
          <div class="col-sm-10">
          <input type="text" class="form-control" id="inputEmail3" placeholder="Login" name="username">
          </div>
        </div>

        <div class="form-group">
          <label for="inputPassword3" class="col-sm-2 control-label">Senha</label>
          <div class="col-sm-10">
          <input type="password" class="form-control" id="inputPassword3" placeholder="Senha" name="password">
          </div>
        </div>

        <div class="form-group col-sm-8">
          <div class="checkbox col-sm-12">
            <label>
            <input type="checkbox" name="lembra" value="1"> Remember me  
            </label>
          </div>

          <br><br>

          <div class="col-sm-12">
            <a type="button" id="esqueceu"  data-toggle="modal" data-target="#modalEsqueceu">Esqueceu sua senha?</a>
          </div>
          
        </div>

        <div class="form-group">

          <br>

          <div class="col-sm-4">
          <button type="submit" class="btn btn-primary">Entrar</button>   
          </div>    

        </div>

      </div>
    </form>



<!-- Modal -->
<div class="modal fade" id="modalEsqueceu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Recuperar senha</h4>
      </div>
      
      <form id="modalForm" >
      <div class="modal-body">
            
        <div class="form-group">
          <label for="inputemail_usuario" class="col-sm-6 control-label">E-mail</label>
          <div class="col-sm-10">
              <input type="text" class="form-control" id="inputemail_usuario" placeholder="E-mail" name="emailusername">
          </div>
        </div>
        <hr>

      </div> 
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary" >Recuperar</button>
      </div>
      </form>

    </div>
  </div>
</div>

      
    </body>
</html>