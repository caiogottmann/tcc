<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Funcionario extends CI_Controller {
    
	public function __construct() {
		parent::__construct();
		$this->load->model('Estado_model', 'estado');
		$this->load->model('Endereco_model', 'endereco');
		$this->load->model('Login_model', 'login');
		$this->load->model('Arduino_model', 'rfid');
		$this->load->model('Usuario_model', 'usuario');
		$this->load->model('Funcionario_model', 'funcionario');

		$this->load->library('ValidaLogin', null, 'validaLogin');
	}

	public function index() {
		$this->validaLogin->verificaPagina(5);

		$obj = $this->usuario->exibirFuncionariosAstivos();

		$res['obj'] = $obj;

		$comeco['nivel'] = $this->session->userdata('nivel');
		$comeco['menu'] = $this->session->userdata('menu');

		$this->load->view('includes/comeco', $comeco);
		$this->load->view('funcionario/tabela', $res);
		$this->load->view('includes/fim');
	    
	}

	public function novoFuncionario() {

		$nome = $this->input->post('usuario');
		$dados = explode(' | ', $nome);

		$idUsuario = $this->usuario->exibirIdByNomeCpf($dados[0], $dados[1]);

		$func = array('func_id_usuario' => $idUsuario[0]->usuario_id_usuario,
		                  'func_id_tipoFunc' => $this->input->post('tipo'),
		                  'func_situacao' => 'A'
		);

		$res1 = $this->funcionario->inserirFuncionario($func);
		if($res1)
		{
			echo "0";
		}
	}
}

/* End of file Funcionario.php */
/* Location: ./application/controllers/Funcionario.php */