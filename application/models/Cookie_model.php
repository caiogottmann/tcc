<?php
class Cookie_model extends CI_Model {

	/**
	 * 
	 * @param int $id_login 
	 * @param string $valor 
	 * @param string $data_expira
	 */
    public function inserirCookie($id_login, $valor, $data_expira) {

    	$data = array('cookie_id_login' => $id_login,
    				'cookie_valor' => $valor,
    				'cookie_data_expira' => $data_expira );

        $res = $this->db->insert('cookie', $data);

        return $res;
    }

}

/* End of file Cookie_model.php */
/* Location: ./application/models/Cookie_model.php */