<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Visitante extends CI_Controller {
    
	public function __construct() {
		parent::__construct();
		$this->load->model('Usuario_model', 'usuario');
		$this->load->model('Visitante_model', 'visitante');
		$this->load->helper('date');

		$this->load->library('ValidaLogin', null, 'validaLogin');
	}

	public function index() {
		$this->validaLogin->verificaPagina(8);

		$datestring = "%d/%m/%Y - %h:%i %a";
		$obj = $this->visitante->exibirVisitante();

		$res['obj'] = $obj;

		foreach ($res['obj'] as $linha) {
		
			$linha->vis_data = mdate($datestring, human_to_unix($linha->vis_data) );
		
		}

   	 

		$comeco['nivel'] = $this->session->userdata('nivel');
		$comeco['menu'] = $this->session->userdata('menu');

		$this->load->view('includes/comeco', $comeco);
		$this->load->view('visitante/tabela', $res);
		$this->load->view('includes/fim');
	    
	}

	public function novoVisitante() {

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
			


			$entrega = array('vis_id_usuario' => $id_usuario[0]->usuario_id_usuario,
			                  'vis_nome' => $this->input->post('visitante'),
			                  'vis_cpf' => $this->input->post('cpf'),
			                  'vis_rg' => $this->input->post('rg'),
			                  'vis_data' => $date
			                  
			);
			
			$res = $this->visitante->inserirVisitante($entrega);

			exit(var_dump($res));

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

}

/* End of file Funcionario.php */
/* Location: ./application/controllers/Funcionario.php */