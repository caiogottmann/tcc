<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class ValidaLogin {

/**
 * array das paginas
 * @var array
 */
private $ids_paginas;

	public function __construct() {
		$this->CI =& get_instance();
        $this->CI->load->library('session');

        if ($this->tempoLimite()) {
			redirect('Login/tempoLimite');
        }

		$this->ids_paginas = explode('|', $this->CI->session->userdata('paginas'));
	}

	/**
	 * Testa se a sessao expirou
	 * @return boolean
	 */
	public function tempoLimite() {
		if ($this->CI->session->userdata('logado') == false) {
			$this->CI->session->sess_destroy();
			delete_cookie('3e680fc2dd7cb7ab7b84f37ced2b27dc');
			return true;
		}
		return false;
	}

	/**
	 * [verificaPagina description]
	 * @param  int $id_pagina 
	 * @return boolean 
	 */
	public function verificaPagina($id_pagina){
		if (in_array($id_pagina, $this->ids_paginas)) { 
		    return true;
		}

		redirect('');
		return false;
	}
}	

/* End of file ValidaLogin.php */
/* Location: ./application/libaries/ValidaLogin.php */