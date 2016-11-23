<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class AreaComum extends CI_Controller {
    
	public function __construct() {
		parent::__construct();
		$this->load->model('Correio_model', 'correio');
		$this->load->model('Usuario_model', 'usuario');
		$this->load->model('AreaComum_model', 'areaComum');
		$this->load->model('Aluguel_model', 'aluguel');
		$this->load->helper('date');

		$this->load->library('ValidaLogin', null, 'validaLogin');		
	}

	public function index() {
	  	$this->validaLogin->verificaPagina(7);

		$comeco['nivel'] = $this->session->userdata('nivel');
		$comeco['menu'] = $this->session->userdata('menu');

		$this->load->view('includes/comeco', $comeco);
		$this->load->view('areaComum/calendario');
		$this->load->view('includes/fim');
	  
	}

	public function agendar() {
		try {
			$id = $this->session->userdata('id_login');

			$id_usuario = $this->usuario->exibirIdByIdLogin($id);

			$data = $this->input->post('data');
			$area = $this->input->post('areas');

			$dados = array('al_id_usuario' 	=> $id_usuario[0]->usuario_id_usuario,
							'al_id_ac' 		=> $area,
							'al_data' 		=> $data,
							'al_situacao' 	=> 'P'); 

			$res = $this->aluguel->inserirAluguel($dados);

			if ($res) {
				echo 'Solicitacao enviada com sucesso, aguarde a aprovacao!';
			}
			else {
				echo 'Ocorreu um erro, tente novamente!';
			}

		}
		catch (Exception $e) {

		}

	}

	public function exibirAreasPorDia($data) {

		$res = $this->aluguel->exibirAluguelPorData($data);

		if ($res == null) {
			$res2 = $this->areaComum->exibirTodasAreasLivresNoDia();
		}
		else {
			$datas = array();

			foreach ($res as $linha) {
				$datas[] = $linha->al_id_ac;
			}

			$res2 = $this->areaComum->exibirAreasLivresNoDia($datas);
		}

		echo "<select class='form-control' name='areas'>";
		foreach ($res2 as $linha) {
			echo "<option selected value='$linha->ac_id_ac'>$linha->ac_nome</option>";
		}

		echo "</select>";
	}

	public function carrregarCalendario(){
		try {
			$nome = 'var0';
			$numero = 0;

			$res = $this->aluguel->exibirTodos();

			foreach ($res as $linha) {
				$$nome = array(	'title'	=> $linha->ac_nome,
								'start'	=> $linha->al_data);
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

	public function verificarPendentes($id) {

		$res = $this->areaComum->verificarPendentes($id);

		$comeco['nivel'] = $this->session->userdata('nivel');
		$comeco['menu'] = $this->session->userdata('menu');

		$area['area'] = $res;


		$this->load->view('includes/comeco', $comeco);
		$this->load->view('areaComum/calendario', $area);
		$this->load->view('includes/fim');


	}

	public function pendente($tipo, $id) {

		if($tipo == 0)
		{
			$vai = $this->areaComum->cancelarAluguel($id);
			if($vai)
			{
				echo "Cancelado";		
			}
		}
		else if ($tipo == 1)
		{
			$vai = $this->areaComum->confirmarAluguel($id);
			if($vai)
			{
				echo "Confirmado";		
			}
		}

		


	}

}

/* End of file AreaComum.php */
/* Location: ./application/controllers/AreaComum.php */