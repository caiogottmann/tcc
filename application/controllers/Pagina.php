<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pagina extends CI_Controller {
    
	public function __construct() {
		parent::__construct();
		$this->load->model('Pagina_model', 'pagina');
		$this->load->model('Usuario_model', 'usuario');
		$this->load->model('Login_model', 'login');
		$this->load->model('Grupo_model', 'grupo');

		$this->load->library('ValidaLogin', null, 'validaLogin');				
	}

	public function index() {
	  	$this->validaLogin->verificaPagina(8);

		$comeco['nivel'] = $this->session->userdata('nivel');
		$comeco['menu'] = $this->session->userdata('menu');

		$pagina['lista'] = $this->pagina->exibirTodosAtivos();

		$this->load->view('includes/comeco', $comeco);
		$this->load->view('pagina/lista', $pagina);
		$this->load->view('includes/fim');
	  
	}

	public function exibirListaByNome() {
		$nome = $this->input->post('usuario');
		$dados = explode(' | ', $nome);

		$idLogin = $this->usuario->exibirIdLoginByNomeCpf($dados[0], $dados[1]);
		$idUsuario = $this->usuario->exibirIdByNomeCpf($dados[0], $dados[1]);


		$login = $this->login->exibirLoginById($idLogin);

		$grupo_user = $this->grupo->exibirGrupoByIdUsuario($idUsuario[0]->usuario_id_usuario);

        if($grupo_user->gp_id_gp != 4) {
			$pgsUsuario = $grupo_user->gp_id_pags;
		} else {
			$pgsUsuario = $login->login_pags;
		}
		
		$paginas = explode('|', $pgsUsuario);

		$lista = $this->pagina->exibirTodosAtivos();

		$grupoAtual = $this->grupo->exibirGrupoByIdUsuario($idUsuario[0]->usuario_id_usuario);


		echo '<div class="alert alert-info" role="alert">Usuario pertencente ao grupo: <strong>'.$grupoAtual->gp_grupo.'</strong></div>';

		echo '<div class="col-md-6">';

		echo '<div class="panel panel-primary"><div class="panel-heading">Lista de Paginas</div><div class="checkbox">';
		echo '<form action="'.base_url('Pagina/atribuirPaginas').'" method="POST"><ul class="list-group">';
		foreach ($lista as $linha) {

			if($linha->pags_id_pags == 1)
			{

			} else if (in_array($linha->pags_id_pags, $paginas)) {
				echo '<li class="list-group-item"><label><input type="checkbox" name="pagina[]" value="'.$linha->pags_id_pags.'" checked>'. $linha->pags_apelido.'</label></li>';
				
			}
			else {
				echo '<li class="list-group-item"><label><input type="checkbox" name="pagina[]" value="'.$linha->pags_id_pags.'">'. $linha->pags_apelido.'</label></li>';
				
			}
			
		}
		echo '<input type="hidden" name="idUsuario" value="'.$idUsuario[0]->usuario_id_usuario.'"> 
		<input type="hidden" name="idLogin" value="'.$idLogin.'">';
		echo '</ul>';


		echo '<input type="submit" class="btn btn-primary"></div></div></div>';
		echo '<input type="hidden" class="btn btn-primary">';
		echo '</form>';


		echo '<div class="col-md-6">';
		echo '<div class="panel panel-primary"><div class="panel-heading">Grupos de Paginas</div><form id="atribuirGrupo" action="'.base_url('Pagina/atribuirGrupo').'" method="POST"><ul class="list-group">';

		echo '<input type="hidden" name="idUsuario" value="'.$idUsuario[0]->usuario_id_usuario.'"> 
		<input type="hidden" name="idLogin" value="'.$idLogin.'"><div class="radio">';

		$listaGrupos = $this->grupo->exibirTodosAtivos();
		foreach ($listaGrupos as $linha) {
			echo '<li class="list-group-item">';
			echo '<label>';
			echo '<input type="radio" name="listaGrupos" id="'.$linha->gp_id_gp.'" value="'.$linha->gp_id_gp.'">'.$linha->gp_grupo;
			echo '<label>';
			echo '</li>';
		}

		echo '</div>';
		echo '<input type="submit" class="btn btn-primary">';
		echo '</form>';
		echo '</ul>';
		echo '</div></div>';
	}

	public function atribuirGrupo(){
		$idGrupo = $this->input->post('listaGrupos');

		$idUsuario =  $this->input->post('idUsuario');
		$idLogin =  $this->input->post('idLogin');

		$res = $this->grupo->exibirGrupoByIdUsuario($idUsuario);

		if($idGrupo == $res->gp_id_gp)
		{
			echo "<script> alert('Usuario ja pertence a este grupo!');   window.location.href='".base_url(Pagina)."';</script>";
		}
		else
		{
			$grupoPert = explode('|', $res->gp_users);


			$key = array_search($idUsuario, $grupoPert);
			if($key!==false){
			    unset($grupoPert[$key]);
			}

			$grupoJunto = implode("|", $grupoPert);

			//retira ele do grupo antigo
			$res1 = $this->pagina->alterarGrupo($res->gp_id_gp, $grupoJunto);

			$res2 = $this->pagina->exibirgrupoById($idGrupo);

			if($res2->gp_users == "")
			{
				$res3 = $this->pagina->inserirNoGrupo($idGrupo, $idUsuario.'|');
			}
			else
			{
				$res3 = $this->pagina->inserirNoGrupo($idGrupo, $res2->gp_users.$idUsuario.'|');
				
			}

			$res4 = $this->pagina->retiraDoLogin($idLogin);

			if($res4)
			{
				echo "<script> alert('Alterado com sucesso');  window.location.href='".base_url('Pagina')."';</script>";

			} 
			else
			{
				echo "<script> alert('Erro ao alterar'); location.reload();</script>";
			}


		}
	}

	public function atribuirPaginas(){

		$idPagina = $this->input->post('pagina[]');

		$grupoJuntoNovo = implode("|", $idPagina);


		$idUsuario =  $this->input->post('idUsuario');
		$idLogin =  $this->input->post('idLogin');

		$res = $this->grupo->exibirGrupoByIdUsuario($idUsuario);


		$grupoPert = explode('|', $res->gp_users);


		$key = array_search($idUsuario, $grupoPert);
			if($key!==false){
			    unset($grupoPert[$key]);
			}

			$grupoJunto = implode("|", $grupoPert);

		$res1 = $this->pagina->alterarGrupo($res->gp_id_gp, $grupoJunto);	

		$res2 = $this->pagina->exibirgrupoById('4');


		if($res2->gp_users == "")
			{
				$res3 = $this->pagina->inserirNoGrupo(4, $idUsuario.'|');
			}
			else
			{
				$res3 = $this->pagina->inserirNoGrupo(4, $res2->gp_users.$idUsuario.'|');
				
			}

			$res3 = $this->pagina->inserirnoLogin($idLogin, $grupoJuntoNovo);

			if($res3)
			{
				echo "<script> alert('Alterado com sucesso');  window.location.href='".base_url('Pagina')."';</script>";

			} 
			else
			{
				echo "<script> alert('Erro ao alterar'); location.reload();</script>";
			}










	}

}

/* End of file Pagina.php */
/* Location: ./application/controllers/Pagina.php */