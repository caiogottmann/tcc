<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class EntradaSaida extends CI_Controller {
    
	public function __construct() {
		parent::__construct();
		$this->load->model('Arduino_model', 'arduino');
		$this->load->model('Usuario_model', 'usuario');
		$this->load->model('Fluxo_model', 'fluxo');
		$this->load->helper('date');
	}

	public function arduinoSenha($arduinoSenha, $token) {
		$this->validaToken($token);

		try {
			$idArduino = $this->arduino->exibirIdBySenha($arduinoSenha);
			if (!$idArduino) {
				echo '<Senha Invalida>';
				exit();
			}

			$usuario = $this->usuario->exibirIdNomeByIdArduino($idArduino);
			$usuarioNome = explode(' ', $usuario->usuario_nome);

			if ($usuarioNome) {
				echo '<Seja Bem Vindo ' .$usuarioNome[0]. '>';

				$datestring = "%Y-%m-%d %H:%i:%s";
				$time = time();

				$horario = mdate($datestring, $time);

				$dados = array('fluxo_id_usuario' 	=> $usuario->usuario_id_usuario,
								'fluxo_horario' 	=> $horario,
								'fluxo_situacao'	=> 'A');

				$this->fluxo->inserirFluxo($dados);
			}
		}
		catch (Exception $e) {

		}
	    
	}

	public function arduinoRfid($arduinoRfid, $token){
		$this->validaToken($token);

		try {
			$idArduino = $this->arduino->exibirIdByRfid($arduinoRfid);
			if (!$idArduino) {
				echo '<Tag Invalida>';
				exit();
			}

			$usuario = $this->usuario->exibirIdNomeByIdArduino($idArduino);

			$usuarioNome = explode(' ', $usuario->usuario_nome);

			if ($usuarioNome) {
				echo '<Seja Bem Vindo ' .$usuarioNome[0]. '>';

				$datestring = "%Y-%m-%d %H:%i:%s";
				$time = time();

				$horario = mdate($datestring, $time);

				$dados = array('fluxo_id_usuario' 	=> $usuario->usuario_id_usuario,
								'fluxo_horario' 	=> $horario,
								'fluxo_situacao'	=> 'A');

				$this->fluxo->inserirFluxo($dados);
			}
		}
		catch (Exception $e) {

		}
	}

	/**
	 * 
	 * @param string $token 
	 * @return boolean 
	 */
	public function validaToken($token) {
		if ($token != 'b0399d2029f64d445bd131ffaa399a42d2f8e7dc') {
			exit();
		}
		else {
			return true;
		}
	}
}

/* End of file EntradaSaida.php */
/* Location: ./application/controllers/EntradaSaida.php */