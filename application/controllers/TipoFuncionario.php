<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class TipoFuncionario extends CI_Controller {
    
	public function __construct() {
		parent::__construct();
		$this->load->model('Estado_model', 'estado');
		$this->load->model('Endereco_model', 'endereco');
		$this->load->model('Login_model', 'login');
		$this->load->model('Arduino_model', 'rfid');
		$this->load->model('Usuario_model', 'usuario');
		$this->load->model('Tipofuncionario_model', 'tipoFuncionario');
		$this->load->model('Funcionario_model', 'Funcionario');

		$this->load->library('ValidaLogin');
	}

	public function alterarTipo($id, $coluna, $texto) {

		$texto = urldecode($texto);

		$vai = $this->tipoFuncionario->alterarTipo($id, $coluna, $texto);
		echo $vai;

	}

	public function excluirTipoById($id) {

		$res = $this->tipoFuncionario->excluirTipoById($id);
		echo $res;
	}

	public function exibirTipos() {
		$res = $this->tipoFuncionario->exibirTiposFuncionariosAtivos();
		echo "<select class='form-control' name='tipo'>";
		foreach ($res as $linha) {
			echo "<option value='$linha->tipoFunc_id_tipoFunc'>$linha->tipoFunc_tipo</option>";
		}

		echo "</select>";
	}

	public function novoTipoFuncionario() {

		$this->load->library('form_validation');

		$funcao = $this->security->xss_clean($this->input->post('funcao'));
		$obs = $this->security->xss_clean($this->input->post('obs'));

		$tipoFuncionario = array('tipoFunc_tipo' => $funcao,
		                  			'tipoFunc_obs' => $obs
		);

		$res = $this->tipoFuncionario->inserirTipoFunc($tipoFuncionario);

		if ($res) {
		  	echo "Cadastrado com sucesso!";
		  	exit();
		}

			echo "erro!";

	}
}

/* End of file TipoMorador.php */
/* Location: ./application/controllers/TipoMorador.php */