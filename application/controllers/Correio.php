<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Correio extends CI_Controller {
    
	public function __construct() {
		parent::__construct();
		$this->load->model('Correio_model', 'correio');
		$this->load->model('Usuario_model', 'usuario');
		$this->load->helper('date');
		
		$this->load->library('ValidaLogin', null, 'validaLogin');
	}

	public function index() {
	  	$this->validaLogin->verificaPagina(6);

		$datestring = "%d/%m/%Y - %h:%i %a";
		$res = $this->correio->exibirTodosAtivos();

		$obj['obj'] = $res;

		foreach ($res as $linha) {
		
			$linha->correio_data = mdate($datestring, human_to_unix($linha->correio_data) );
		
		}

		$comeco['nivel'] = $this->session->userdata('nivel');
		$comeco['menu'] = $this->session->userdata('menu');

		$this->load->view('includes/comeco', $comeco);
		$this->load->view('correio/tabela', $obj);
		$this->load->view('includes/fim');

	
	  
	}

	public function excluirCorreioById($id) {

		$res = $this->correio->excluirCorreioById($id);
		echo $res;
	}

	public function confirmarCorreioById($id) {

		$res = $this->correio->confirmarCorreioById($id);
		echo $res;
	}

	public function alterarCorreio($id, $coluna, $texto) {

		
		$texto = urldecode($texto);

		$vai = $this->correio->alterarCorreio($id, $coluna, $texto);
		echo $vai;

	}

	public function exibirUsuarioLikeNome($nome = '') {

		$vai = $this->usuario->exibirNomeLikeNome($nome);
		
		foreach ($vai as $x ) {
			$teste[] = $x->usuario_nome . " | " . $x->usuario_cpf;
		}
		echo json_encode($teste);
	}

	public function cadastro() {

		try {
			$usuario = $this->input->post('usuario');

			$quebra = explode(' | ', $usuario);

			$nome = $quebra[0];
			$cpf = $quebra[1];

			$id_usuario = $this->usuario->exibirIdByNomeCpf($nome, $cpf);
			if ($id_usuario == null) {
				echo '1';
				exit();
			}

			date_default_timezone_set('America/Sao_Paulo');
			$date = date('Y-m-d H:i');

			$entrega = array('correio_id_usuario' => $id_usuario[0]->usuario_id_usuario,
			                  'correio_nome_correio' => $this->input->post('nome_empregador'),
			                  'correio_rg_correio' => $this->input->post('rg_empregador'),
			                  'correio_empre_correio' => $this->input->post('empresa'),
			                  'correio_data' => $date,
			                  'correio_situacao' => 'P'
			);
			
			$res = $this->correio->inserirEntrega($entrega);

			if ($res) {
				echo '0';
			}
			else {
				echo '1';
			}
		}
		catch(Exception $e){
			echo '1';
		}

	}

	public function pendente() {
	  	$this->validaLogin->verificaPagina(11);

		$datestring = "%d/%m/%Y - %h:%i %a";
		$res = $this->correio->exibirTodosPendentes();

		$obj['obj'] = $res;

		foreach ($res as $linha) {
		
			$linha->correio_data = mdate($datestring, human_to_unix($linha->correio_data) );
		
		}

		$comeco['nivel'] = $this->session->userdata('nivel');
		$comeco['menu'] = $this->session->userdata('menu');

		$this->load->view('includes/comeco', $comeco);
		$this->load->view('correio/pendente', $obj);
		$this->load->view('includes/fim');
	}

}

/* End of file Correio.php */
/* Location: ./application/controllers/Correio.php */