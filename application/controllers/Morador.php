<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Morador extends CI_Controller {
    
	public function __construct() {
		parent::__construct();
		$this->load->model('Login_model', 'login');
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
		$this->load->view('morador/home', $res);
		$this->load->view('morador/fim');
	    
	}

}

/* End of file Morador.php */
/* Location: ./application/controllers/Morador.php */