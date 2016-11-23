<?php
class RecuperarSenha_model extends CI_Model {

    /**
     * 
     * @param array $data 
     * @return boolean
     */
	public function inserirChaves($data) {

        $res = $this->db->insert('recuperarsenha', $data);

        return $res;
    }

    /**
     * 
     * @param string $data 
     * @return object
     */
	public function comparaChaves($data) {

        $query = $this->db->query("SELECT `rec_id_usuario`, `rec_chave`, `rec_data`, rec_data + INTERVAL 1 DAY as `datatermino` FROM `recuperarsenha` WHERE `rec_chave` = '$data'");

        if ($query->num_rows() > 0)
        {
            return $query->row();
            exit();
        }
        return false;
    }


}

/* End of file Recuperasenha_model.php */
/* Location: ./application/models/Recuperasenha_model.php */