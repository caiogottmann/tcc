<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Administracao extends CI_Controller {
    
	public function __construct() {
		parent::__construct();
		$this->load->model('Estado_model', 'estado');
		$this->load->model('Endereco_model', 'endereco');
		$this->load->model('Login_model', 'login');
		$this->load->model('Arduino_model', 'arduino');
		$this->load->model('Usuario_model', 'usuario');
		$this->load->model('Tipofuncionario_model', 'tipoFuncionario');
		$this->load->model('Funcionario_model', 'funcionario');
		$this->load->model('Notificacao_model', 'notificacao');
		$this->load->model('Grupo_model', 'grupo');

		$this->load->library('ValidaLogin', null, 'validaLogin');
	}

	public function index() {
	  	// ARRUMAR !!! $this->validaLogin->verificaPagina(1);

		$id_login = $this->session->userdata('id_login');
		$id_user = $this->session->userdata('id_usuario');
		$grupo = $this->session->userdata('grupo');
		$res = $this->usuario->exibirUsuarioByLogin($id_login);
		$res2 = $this->notificacao->exibirNotificacaoCorreio($id_user);

		if($grupo == '1')
		{
			$res3 = $this->notificacao->exibirNotificacaoAluguel($id_user);
		}


		$res4 = $this->notificacao->exibirNotificacaoAluguelAI($id_user);

		$obj['obj'] = $res;
		$obj['correio'] = $res2;
		@$obj['area'] = $res3;
		$obj['area_conf'] = $res4;

		$comeco['nivel'] = $this->session->userdata('grupo');
		$comeco['menu'] = $this->session->userdata('menu');

		$this->load->view('includes/comeco', $comeco);
		$this->load->view('administracao/home', $obj);
		$this->load->view('includes/fim');
	  
	}

	/**
	 * 
	 * @param int $id 
	 * @param string $coluna 
	 * @param string $texto 
	 */
	public function alterarUsuarios($id, $coluna, $texto) {

		if($coluna == "usuario_nivel") {
		  	switch ($texto) {
			    case 'Administrador':
			        $texto = "A";
			        break;
			    case 'Sindico':
			        $texto = "S";
			        break;
			    case 'Funcionario':
			       $texto = "F";
			        break;
			    case 'Morador':
			        $texto = "M";
			        break;
		  	}    
		}
		$texto = urldecode($texto);

		$vai = $this->usuario->alterarUsuario($id, $coluna, $texto);
		echo $vai;

	}

	/**
	 * 
	 * @param int $id
	 */
	public function excluirUsuarioById($id) {

		$res = $this->usuario->excluirUsuarioById($id);
		echo $res;
	}

	public function excluirFuncionarioById($id) {

		$res = $this->funcionario->excluirFuncionarioById($id);
		echo $res;
	}

	/**
	 * 
	 * @param string|null $uf
	 */
	public function exibirEstados($uf = '') {
		$res = $this->estado->exibirEstados();
		echo "<select class='form-control' name='estado'>";
		foreach ($res as $linha) {
			if ($uf == $linha->estado_id_estado) {
				echo "<option selected value='$linha->estado_id_estado'>$linha->estado_nome</option>";
			}
			else {
				echo "<option value='$linha->estado_id_estado'>$linha->estado_nome</option>";
			}
		}

		echo "</select>";
	}

	public function exibirUsuarios() {
		$res = $this->usuario->exibirTodosAtivos();
		echo "<select class='form-control' name='usuarios'>";
		foreach ($res as $linha) {
			echo "<option selected value='$linha->usuario_id_usuario'>$linha->usuario_nome</option>";
		}

		echo "</select>";
	}

	public function exibirTiposFuncionarios() {
		$res = $this->tipoFuncionario->exibirTiposFuncionariosAtivos();
		echo "<select class='form-control' name='tFuncionario'>";echo "<option value=''>Selecione</option>";
		foreach ($res as $linha) {
		  echo "<option value='$linha->tipoFunc_id_tipoFunc'>$linha->tipoFunc_tipo</option>";
		}

		echo "</select>";
	}

	public function minhaConta() {
		$this->validaLogin->verificaPagina(4);

		$id = $this->session->userdata('id_login');

		$obj['usuario'] = $this->usuario->exibirUsuarioByLogin($id);
		$obj['endereco'] = $this->endereco->exibirEnderecoByIdUsuario($id);
		$obj['login'] = $this->login->exibirLoginById($id);

		$comeco['nivel'] = $this->session->userdata('nivel');
		$comeco['menu'] = $this->session->userdata('menu');

		$this->load->view('includes/comeco', $comeco);
		$this->load->view('includes/minhaConta', $obj);
		$this->load->view('includes/fim');
	}

	public function novoUsuario() {

		$endereco = array('end_rua' => $this->input->post('rua'),
		                  'end_bairro' => $this->input->post('bairro'),
		                  'end_numero' => $this->input->post('numero'),
		                  'end_complemento' => $this->input->post('complemento'),
		                  'end_id_estado' => $this->input->post('estado')
		);

		$res1 = $this->endereco->inserirEndereco($endereco);

		if ($res1) {
		  $end_id_end = $this->endereco->exibirUltimoId();
		}

		$arduino = array('arduino_rfid'		=> $this->security->xss_clean($this->input->post('rfid')),
						'arduino_senha'		=> $this->security->xss_clean($this->input->post('rfidSenha')),
						'arduino_situacao'	=> 'A' 
		);

		$res2 = $this->arduino->inserirRfid($arduino);

		if ($res2) {
		  $arduino_id_arduino = $this->arduino->exibirUltimoId();
		}

		$login = array('login_usuario'		=> $this->security->xss_clean($this->input->post('login')),
		                'login_senha'		=> md5($this->input->post('senha')),
		                'login_id_pags'		=> '1',
		                'login_situacao'	=> 'A' 
		);

		$res3 = $this->login->inserirLogin($login);

		if ($res3) {
		  $login_id_login = $this->login->exibirUltimoId();
		}


		$usuario = array('usuario_nome' 		=> $this->security->xss_clean($this->input->post('nome')),
		                  'usuario_cpf' 		=> $this->security->xss_clean($this->input->post('cpf')),
		                  'usuario_rg'			=> $this->security->xss_clean($this->input->post('rg')),
		                  'usuario_email' 		=> $this->security->xss_clean($this->input->post('e-mail')),
		                  'usuario_tel' 		=> $this->security->xss_clean($this->input->post('tel')),
		                  'usuario_cel' 		=> $this->security->xss_clean($this->input->post('cel')),
		                  'usuario_id_end'		=> $end_id_end,
		                  'usuario_id_arduino' 	=> $arduino_id_arduino,
		                  'usuario_id_login'	=> $login_id_login,
		                  'usuario_situacao' 	=> 'A'
		);

		$res4 = $this->usuario->inserirUsuario($usuario);

		if($this->input->post('tFuncionario') != "")
		{
			if ($res4) {
		  		$usuario_id_usuario = $this->usuario->exibirUltimoId();
			}

			$funcionario = array('func_id_usuario' => $usuario_id_usuario,
		                  'func_id_tipoFunc' => $this->input->post('tFuncionario'),
		                  'func_situacao' => 'A'
						);

			$res5 = $this->funcionario->inserirFuncionario($funcionario);

			if ($res5) {
				echo "Cadastrado com sucesso!";
		  		exit();
			}
		}

		if ($res4) {
			$usuario_id_usuario = $this->usuario->exibirUltimoId();
			$this->grupo->adicionarUserGrupo($usuario_id_usuario, 4);
		  	echo 'Cadastrado com sucesso!';
		  	exit();
		}

	}

	public function usuarios() {
	  	$this->validaLogin->verificaPagina(2);

		$obj['obj'] = $this->usuario->exibirCompletoTodosAtivos();
		$grupo = $this->session->userdata('grupo');


		$obj['pag'] = $grupo;

		$comeco['nivel'] = $this->session->userdata('nivel');
		$comeco['menu'] = $this->session->userdata('menu');

		$this->load->view('includes/comeco', $comeco);
		$this->load->view('administracao/tabela',$obj);
		$this->load->view('includes/fim');
	}

	public function updateConta() {
		$id_login = $this->session->userdata('id_login');
		$id_end = $this->input->post('end');

		$endereco = array('end_rua'			=> $this->input->post('rua'),
		                  'end_bairro'		=> $this->input->post('bairro'),
		                  'end_numero'		=> $this->input->post('numero'),
		                  'end_complemento'	=> $this->input->post('complemento'),
		                  'end_id_estado'	=> $this->input->post('estado') 
		);

		$res = $this->endereco->updateEndereco($endereco, $id_end);

		if (!$res) {
			echo "Erro 002: Tente Novamente!";
			exit();
		}

		$usuario = array('usuario_nome'			=> $this->input->post('nome'),
		                  'usuario_cpf'			=> $this->input->post('cpf'),
		                  'usuario_rg'			=> $this->input->post('rg'),
		                  'usuario_email'		=> $this->input->post('e-mail'),
		                  'usuario_tel'			=> $this->input->post('tel'),
		                  'usuario_cel'			=> $this->input->post('cel'),
		                  'usuario_situacao'	=> 'A'
		);

		$res2 = $this->usuario->updateUsuario($usuario, $id_login);

		if (!$res2) {
			echo "Erro 003: Tente Novamente!";
			exit();
		}

		echo "Conta atualizada com sucesso!";
	}

	public function TipoFuncionarios() {
	  	$this->validaLogin->verificaPagina(3);
		
		$obj['obj'] = $this->tipoFuncionario->exibirTiposFuncionariosAtivos();
		$obj['pag'] = 'TF';

		$comeco['nivel']	= $this->session->userdata('nivel');
		$comeco['menu']		= $this->session->userdata('menu');

		$this->load->view('includes/comeco', $comeco);
		$this->load->view('administracao/TipoFuncionarios',$obj);
		$this->load->view('includes/fim');

	}
}

/* End of file Administracao.php */
/* Location: ./application/controllers/Administracao.php */