<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Fluxo extends CI_Controller {
    
	public function __construct() {
		parent::__construct();
		$this->load->model('Fluxo_model', 'fluxo');
		$this->load->helper('date');

		$this->load->library('ValidaLogin', null, 'validaLogin');		
	}

	public function index() {
	  	$this->validaLogin->verificaPagina(10);
	  	//exit(var_dump($this->fluxo->exibirCountByDiaMesAno()));

		$comeco['nivel'] = $this->session->userdata('nivel');
		$comeco['menu'] = $this->session->userdata('menu');

		$this->load->view('includes/comeco', $comeco);
		$this->load->view('fluxo/inicio');
		$this->load->view('includes/fim');
	  
	}

	public function exibirFluxoSemanal(){
		try {
			$nome = 'var0';
			$numero = 0;

			$res = $this->fluxo->exibirCountSemanal();
			$datestring = "%d/%m";
			
			foreach ($res as $linha) {
				$horario = mdate($datestring, human_to_unix($linha->fluxo_horario));
				$$nome = array(	'label'	=> $horario,
								'y'	=> intval($linha->contador));
				$nome++;
				$numero++;
			}

			$nome = 'var0';
			$numero--;

			echo '[';
			while ($numero >= 0) {
				echo json_encode($$nome);
				$nome++;
				$numero--;
				if ($numero >= 0) {
					echo ',';
				}
			}
			echo ']';
		}
		catch (Exception $e) {

		}
	}

	public function exibirFluxoQuinzenal(){
		try {
			$nome = 'var0';
			$numero = 0;

			$res = $this->fluxo->exibirCountQuinzenal();
			$datestring = "%d/%m";
			
			foreach ($res as $linha) {
				$horario = mdate($datestring, human_to_unix($linha->fluxo_horario));
				$$nome = array(	'label'	=> $horario,
								'y'	=> intval($linha->contador));
				$nome++;
				$numero++;
			}

			$nome = 'var0';
			$numero--;

			echo '[';
			while ($numero >= 0) {
				echo json_encode($$nome);
				$nome++;
				$numero--;
				if ($numero >= 0) {
					echo ',';
				}
			}
			echo ']';
		}
		catch (Exception $e) {

		}
	}

}

/* End of file Fluxo.php */
/* Location: ./application/controllers/Fluxo.php */