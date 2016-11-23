<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Sindico extends CI_Controller {
    
	public function __construct() {
		parent::__construct();
		$this->load->model('Estado_model', 'estado');
		$this->load->model('Endereco_model', 'endereco');
		$this->load->model('Login_model', 'login');
		$this->load->model('Rfid_model', 'rfid');
		$this->load->model('Usuario_model', 'usuario');

		$this->load->library('ValidaLogin');
	}

	public function index() {

		$id = $this->session->userdata('id_login');

		$obj = $this->usuario->exibirUsuarioByLogin($id);

		$res['obj'] = $obj;
		$comeco['nivel'] = $this->session->userdata('nivel');
		$comeco['menu'] = $this->session->userdata('menu');

		$this->load->view('includes/comeco', $comeco);
		$this->load->view('sindico/home', $res);
		$this->load->view('includes/fim');
	    
	}

	public function funcionarios() {
	  
		$obj['obj'] = $this->usuario->exibirFuncionariosAtivos();
		$obj['pag'] = 'F';

		$comeco['nivel'] = $this->session->userdata('nivel');
		$comeco['menu'] = $this->session->userdata('menu');

		$this->load->view('includes/comeco', $comeco);
		$this->load->view('administracao/tabela',$obj);
		$this->load->view('includes/fim');

	}

	public function moradores() {
		
		$obj['obj'] = $this->usuario->exibirMoradoresAtivos();
		$obj['pag'] = 'M';

		$comeco['nivel'] = $this->session->userdata('nivel');
		$comeco['menu'] = $this->session->userdata('menu');

		$this->load->view('includes/comeco', $comeco);
		$this->load->view('administracao/tabela',$obj);
		$this->load->view('includes/fim');

	}
}

/* End of file Sindico.php */
/* Location: ./application/controllers/Sindico.php */